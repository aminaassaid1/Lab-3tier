<?php
require_once ('loader.php');

$studentBlo = new StudentBLO();
$all_students_html = '' ;
$all_students = $studentBlo->GetAllStudents();

$studentBllObj = new StudentBLO();
$deleteSuccess = false ;
$errorMessage = '';

if (isset($_REQUEST['delete']) && $_REQUEST['delete'] == 'yes')
{
    $studentId = (int) $_REQUEST['id'];
    $deleteResult = $studentBllObj->DeleteStudent($studentId);

    if($deleteResult>0){
        $deleteSuccess = true ;
    }else{
        if ($studentBllObj->errorMessage != ''){
            $errorMessage = $studentBllObj->errorMessage;
        }else{
            $errorMessage = "record can not be delete . Operation failed.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="This is a simple implementation of OOP in PHP. This application is created for educational purpose." />
    <meta name="author" content="Arif Uddin" />

    <!-- Bootstrap core CSS -->
    <link href="Assets/bootstrap-3.3.5/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom styles for this application -->
    <link href="Assets/Styles/Styles.css" rel="stylesheet" />
    <title>List of Students</title>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./">Student Information</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="add.php"><span class="glyphicon glyphicon-plus"></span> Add New</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<header class="page-header">
    <h1>List of Students</h1>
</header>
<?php if ($deleteSuccess === true): ?>
    <div class="alert alert-danger">
        Record deleted successfully.
    </div>
<?php endif; ?>
<?php if ($errorMessage != )

</body>
</html>
