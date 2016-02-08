<?php require_once('Connections/dbcon.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_vewDetails = "-1";
if (isset($_GET['view'])) {
  $colname_vewDetails = $_GET['view'];
}
mysql_select_db($database_dbcon, $dbcon);
$query_vewDetails = sprintf("SELECT * FROM contact WHERE id = %s", GetSQLValueString($colname_vewDetails, "int"));
$vewDetails = mysql_query($query_vewDetails, $dbcon) or die(mysql_error());
$row_vewDetails = mysql_fetch_assoc($vewDetails);
$totalRows_vewDetails = mysql_num_rows($vewDetails);
?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
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
<div class="col-md-8"><h1><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $row_vewDetails['first_name']; ?> <?php echo $row_vewDetails['last_name']; ?></h1> 
<hr>
<p>Telephone: <?php echo $row_vewDetails['telephone']; ?></p>
<hr>
Email: <?php echo $row_vewDetails['email']; ?>
<hr>
Birthday: <?php echo $row_vewDetails['data_of_birth']; ?>
<hr>
Contact Type: <?php echo $row_vewDetails['contact_type']; ?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<button class="btn-default" onclick="goBack()"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back</button>

</div>

</div>



<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="js/npm.js"></script>
<script>
function goBack() {
    history.back();
}
</script>

</body>
</html>
<?php
mysql_free_result($vewDetails);
?>
