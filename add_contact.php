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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO contact (first_name, last_name, data_of_birth, email, telephone, contact_type) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['inputfirstname'], "text"),
                       GetSQLValueString($_POST['inputlasttname'], "text"),
                       GetSQLValueString($_POST['inputdob'], "text"),
                       GetSQLValueString($_POST['inputemail'], "text"),
                       GetSQLValueString($_POST['inputtele'], "double"),
                       GetSQLValueString($_POST['select'], "text"));

  mysql_select_db($database_dbcon, $dbcon);
  $Result1 = mysql_query($insertSQL, $dbcon) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_dbcon, $dbcon);
$query_addContact = "SELECT * FROM contact";
$addContact = mysql_query($query_addContact, $dbcon) or die(mysql_error());
$row_addContact = mysql_fetch_assoc($addContact);
$totalRows_addContact = mysql_num_rows($addContact);

mysql_select_db($database_dbcon, $dbcon);
$query_conType = "SELECT * FROM contact_type";
$conType = mysql_query($query_conType, $dbcon) or die(mysql_error());
$row_conType = mysql_fetch_assoc($conType);
$totalRows_conType = mysql_num_rows($conType);
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
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

 <div class="container" id="sandbox-container">
 <h3>Create New Contact</h3>
    <div class="col-sm-8" style="height:130px;">
<form method="POST" action="<?php echo $editFormAction; ?>" name="form" class="form-horizontal">
    
    <div class="form-group">
      <label for="inputfirstname" class="col-lg-2 control-label">First Name</label>
      <div class="col-lg-10">
        <input name="inputfirstname" type="text" class="form-control" id="inputfirstname" placeholder="First Name">
      </div>
    </div>
    
     <div class="form-group">
      <label for="inputlasttname" class="col-lg-2 control-label">Last Name</label>
      <div class="col-lg-10">
        <input name="inputlasttname" type="text" class="form-control" id="inputlasttname" placeholder="Last Name">
      </div>
    </div>
    
         <div class="input-daterange form-group">
         <label for="inputdob" class="col-lg-2 control-label">Date of Birth</label>
         <div class="col-lg-10">
        <div class="input-group" id="datepicker">
                <input name="inputdob" type='text' class="form-control" id="inputdob"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar">
                    </span>
                </span>
           </div>
        </div>
        </div>
        
        <div class="form-group">
      <label for="inputemail" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-10">
        <input name="inputemail"  type="text" class="form-control" id="inputemail" placeholder="Email">
      </div>
    </div>
    
    <div class="form-group">
      <label for="inputtele" class="col-lg-2 control-label">Telephone</label>
      <div class="col-lg-10">
        <input name="inputtele" type="text" class="form-control" id="inputtele" placeholder="Telephone">
      </div>
    </div>
    
     <div class="form-group">
      <label for="select" class="col-lg-2 control-label">Contact Type</label>
      <div class="col-lg-10">
        <select name="select" class="form-control" id="select">
          <?php
do {  
?>
  <option value="<?php echo $row_conType['contact_type']?>"<?php if (!(strcmp($row_conType['contact_type'], $row_conType['contact_type']))) {echo "selected=\"selected\"";} ?>><?php echo $row_conType['contact_type']?></option>
  <?php
} while ($row_conType = mysql_fetch_assoc($conType));
  $rows = mysql_num_rows($conType);
  if($rows > 0) {
      mysql_data_seek($conType, 0);
	  $row_conType = mysql_fetch_assoc($conType);
  }
?>
        </select>
        
       </div>
      </div>
        
      <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
      <script type="text/javascript">
        $(function () {
            $('#datetimepicker10').datetimepicker({
                viewMode: 'years',
                format: 'MM/YYYY'
            });
        });
    </script>

<input type="hidden" name="MM_insert" value="form">


   </form>
   </div>
   
   
  

  
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="js/npm.js"></script>
<script src="js/mydate.js"></script>
</body>

</html>
<?php
mysql_free_result($addContact);

mysql_free_result($conType);
?>
