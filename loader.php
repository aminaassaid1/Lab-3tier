<?php
define('Root',dirname(__FILE__));
    error_reporting(E_ALL);

    require_once Root .'../application/DatabaseConnrctionne.php';
    require_once Root .'../application/DAL/StudentDAO.php';
    require_once Root .'../application/BLL/StudentBLO.php';
    require_once Root .'../application/Entities/Student.php';


