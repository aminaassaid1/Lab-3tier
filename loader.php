<?php
define('Root', dirname(__FILE__));
error_reporting(E_ALL);

require_once Root . '../Application/DatabaseConnection.php';
require_once Root . '../Application/DAL/StagiaireDAO.php';
require_once Root . '../Application/BLL/StagiaireBLO.php';
require_once Root . '../Application/Entities/Stagiaire.php';
require_once Root . '../Assets/Styles/Styles.css';


?>