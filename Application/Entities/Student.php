<?php

class Student
{
    private $id;
    private $name;
    private $email;
    private $dateOfBirth;

    public function __construct($id, $name, $email, $dateOfBirth)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }
}
