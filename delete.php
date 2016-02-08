<?php

    if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header('Location: index.php');
    }

?><!DOCTYPE>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/mydate.css">
<title>Contact</title>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">The Contact</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="index.php">View Contact <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Edit Contact</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
<?php
    $db = mysqli_connect('localhost', 'root', 'root', 'inspired');
    $sql = "DELETE FROM contact WHERE id=$id";
    mysqli_query($db, $sql);
   	echo '<div class="alert alert-success" role="alert">User deleted successfully.</div>';
    mysqli_close($db);
?>
</div>
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="js/npm.js"></script>
<script src="js/mydate.js"></script>
</body>
</html>