<?php
class StudentDAO
{
    private $db;
    private $databaseConnectionObj;

    public function __construct()
    {
        $this->databaseConnectionObj = new DatabaseConnection();
        $this->db = $this->databaseConnectionObj->connect();
    }

    public function GetAllStudents()
    {
        $sql = "SELECT * FROM Student";
        $raw_result = $this->db->prepare($sql);
        if (!$raw_result->execute()) {
            $raw_result = null;
            exit();
        }
        $allStudentsData = $raw_result->fetchAll(PDO::FETCH_ASSOC);
        $dataArr = [];
        foreach ($allStudentsData as $data) {
            $studentInfo = new Student($data['Id'], $data['Name'], $data['Email'], $data['DateOfBirth']);
            array_push($dataArr, $studentInfo);
        }
        return $dataArr;
    }

    public function GetStudent($studentId)
    {
        if ($studentId <= 0) {
            return false;
        }
        $sql = "SELECT * FROM Student WHERE Id = :studentId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
        $stmt->execute();
        $aStudent = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($aStudent !== false) {
            $aStudent = new Student($aStudent['Id'], $aStudent['Name'], $aStudent['Email'], $aStudent['DateOfBirth']);
            return $aStudent;
        }

        return false;
    }

    public function UpdateStudent($student)
    {
        $sql = "UPDATE Student 
                SET
                    Name='" . $student->GetName() . "',
                    Email='" . $student->GetEmail() . "',
                    DateOfBirth='" . $student->GetDateOfBirth() . "'
                WHERE Id=" . $student->GetId();
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->rowCount();
    }

    public function DeleteStudent($studentId)
    {
        $sql = "DELETE FROM Student WHERE Id=" . $studentId;
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->rowCount();
    }

    public function IsIdExists($id)
    {
        $sql = "SELECT * FROM Student WHERE Id = $id";
        $raw_result = $this->db->prepare($sql);
        $raw_result->execute();
        if (!$raw_result->rowCount() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function IsEmailExists($email, $id = 0)
    {
        $sql = "SELECT * FROM Student WHERE Email='" . $email . "' AND Id != $id";
        $raw_result = $this->db->prepare($sql);
        $raw_result->execute();
        $isEmail = $raw_result->fetch();
        if ($isEmail !== false) {
            return true;
        } else {
            return false;
        }
    }
}