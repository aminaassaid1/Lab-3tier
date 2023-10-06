<?php

require_once('loader.php');

$addSuccess = false;
$updateSuccess = false;
$errorMessage = "";

if (isset($_POST['studentSubmitButton']) && $_POST["studentSubmitButton"] == 'Update Student') {
    $studentBllObj = new StudentBLO();
    $studentId = $_POST['studentId'];
    $studentName = $_POST['studentName'];
    $studentEmail = $_POST['studentEmail'];
    $studentDateOfBirth = $_POST['studentDateOfBirth'];

    $aStudent = new Student($studentId, $studentName, $studentEmail, $studentDateOfBirth);
    $updateResult = $studentBllObj->UpdateStudent($aStudent);

    if ($updateResult > 0) {
        $updateSuccess = true;
    } else {
        if ($studentBllObj->errorMessage != '') {
            $errorMessage = $studentBllObj->errorMessage;
        } else {
            $errorMessage = 'Record cannot be updated. Operation failed.';
        }
    }
} elseif (isset($_GET['id']) && (int)$_GET['id'] > 0) {
    $studentId = (int)$_GET['id']; 
    $action = '';
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    }
    $studentBllObj = new StudentBLO();
    $aStudent = $studentBllObj->GetStudent($studentId);

    if ($action == 'add') {
        $addSuccess = true;
    }
} else {
    header("location:index.php");
}

$pageTitle = "Edit Student";
include_once("Templates/header.php");

?>

<div class="page-header">
    <h1>Edit Student</h1>
</div>

<?php if ($addSuccess === true): ?>
    <div class="alert alert-success">Record added successfully</div>
<?php endif; ?>

<?php if ($updateSuccess === true): ?>
    <div class="alert alert-success">Record updated successfully</div>
<?php endif; ?>

<?php if ($errorMessage != ''): ?>
    <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
<?php endif; ?>

<form action="edit.php" method="post" name="studentInform" id="studentInfoForm" class="form-horizontal">

    <div class="form-group">
        <label for="studentName" class="col-sm-2">Name</label>
        <div class="col-sm-4">
            <input type="text" value="<?php echo $aStudent->getName();?>" name="studentName" id="studentName" class="form-control" placeholder="Name">
        </div>
    </div>
    <div class="form-group">
        <label for="studentEmail" class="col-sm-2">Email</label>
        <div class="col-sm-4">
            <input type="email" value="<?php echo $aStudent->getEmail();?>" name="studentEmail" id="studentEmail" class="form-control" placeholder="Email">
        </div>
    </div>
    <div class="form-group">
        <label for="studentDateOfBirth" class="col-sm-2">Date Of Birth</label>
        <div class="col-sm-4">
            <input type="date" value="<?php echo $aStudent->getDateOfBirth();?>" name="studentDateOfBirth" id="studentDateOfBirth" class="form-control" placeholder="Date of birth">
        </div>
    </div>

    <input type="hidden" value="<?php echo $aStudent->GetId(); ?>" name="studentId" id="studentId" />
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-4">
            <input type="submit" name="studentSubmitButton" id="studentSubmitButton" value="Update Student" class="btn  btn-primary" />
        </div>
    </div>

</form>

<?php include_once("Templates/footer.php"); ?>
