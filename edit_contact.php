<?php /*
if (isset($_GET['update']) && ctype_digits($_GET['update']))
{
	$id = $_GET['update'];
}
else
{
	header('Location: index.php');
} */
?>

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

$colname_editCon = "-1";
if (isset($_GET['update'])) {
  $colname_editCon = $_GET['update'];
}
mysql_select_db($database_dbcon, $dbcon);
$query_editCon = sprintf("SELECT * FROM contact WHERE id = %s", GetSQLValueString($colname_editCon, "int"));
$editCon = mysql_query($query_editCon, $dbcon) or die(mysql_error());
$row_editCon = mysql_fetch_assoc($editCon);
$totalRows_editCon = mysql_num_rows($editCon);

mysql_select_db($database_dbcon, $dbcon);
$query_eConType = "SELECT * FROM contact_type";
$eConType = mysql_query($query_eConType, $dbcon) or die(mysql_error());
$row_eConType = mysql_fetch_assoc($eConType);
$totalRows_eConType = mysql_num_rows($eConType);
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
 <?php
$inputfirstname = '';
$inputlasttname = '';
$inputdob = '';
$inputemail = '';
$inputtele = '';
$select = '';

if (isset($_POST['submit']))
{
	$ok = true;
	
	if (!isset($_POST['inputfirstname']) || $_POST['inputfirstname'] === '') 
	{
		$ok = false;
	}
	else
	{
		$inputfirstname = $_POST['inputfirstname'];
	}

	if (!isset($_POST['inputlasttname']) || $_POST['inputlasttname'] === '') 
	{
		$ok = false;
	}
	else
	{
		$inputlasttname = $_POST['inputlasttname'];
	}
	
	if (!isset($_POST['inputdob']) || $_POST['inputdob'] === '') 
	{
		$ok = false;
	}
	else
	{
		$inputdob = $_POST['inputdob'];
	}
	
	if (!isset($_POST['inputemail']) || $_POST['inputemail'] === '') 
	{
		$ok = false;
	}
	else
	{
		$inputemail = $_POST['inputemail'];
	}
	if (!isset($_POST['inputtele']) || $_POST['inputtele'] === '') 
	{
		$ok = false;
	}
	else
	{
		$inputtele = $_POST['inputtele'];
	}
	if (!isset($_POST['select']) || $_POST['select'] === '') 
	{
		$ok = false;
	}
	else
	{
		$select = $_POST['select'];
	}
	

	if($ok)
	{
		//add db code here
		$db = mysqli_connect('localhost', 'root', 'root', 'inspired');
		$sql = sprintf("UPDATE contact SET first_name='%s', last_name='%s', data_of_birth='%s', email='%s', telephone='%s', contact_type='%s' WHERE id=%s",
		mysqli_real_escape_string($db, $inputfirstname),
		mysqli_real_escape_string($db, $inputlasttname),
		mysqli_real_escape_string($db, $inputdob),
		mysqli_real_escape_string($db, $inputemail),
		mysqli_real_escape_string($db, $inputtele),
		mysqli_real_escape_string($db, $select),
		$colname_editCon);
		mysqli_query($db, $sql);
		echo '<div class="alert alert-success" role="alert">User updated successfully.</div>';
		mysqli_close($db);
		
	}
}
else
{
	//$db = mysql_select_db($database_dbcon, $dbcon);
	$db = mysqli_connect('localhost', 'root', 'root', 'inspired');
	$sql = sprintf("SELECT * FROM contact WHERE id=%s", $colname_editCon);
	$result = mysqli_query($db, $sql);
	foreach ($result as $row)
	{
		$inputfirstname = $row['first_name'];
		$inputlasttname = $row['last_name'];
		$inputdob = $row['data_of_birth'];
		$inputemail = $row['email'];
		$inputtele = $row['telephone'];
		$select = $row['contact_type'];
		
	}
	mysqli_close($db);
	
}


?>
 <h3>Create New Contact</h3>
    <div class="col-sm-8" style="height:130px;">
<form method="POST" name="form" class="form-horizontal" id="form">
<input type="hidden" name="id">
    
    <div class="form-group">
      <label for="inputfirstname" class="col-lg-2 control-label">First Name</label>
      <div class="col-lg-10">
        <input name="inputfirstname" type="text" class="form-control" id="inputfirstname" value="<?php echo htmlspecialchars($inputfirstname); ?>">
      </div>
    </div>
    
     <div class="form-group">
      <label for="inputlasttname" class="col-lg-2 control-label">Last Name</label>
      <div class="col-lg-10">
        <input name="inputlasttname" type="text" class="form-control" id="inputlasttname" value="<?php echo htmlspecialchars($inputlasttname); ?>">
      </div>
    </div>
    
         <div class="input-daterange form-group">
         <label for="inputdob" class="col-lg-2 control-label">Date of Birth</label>
         <div class="col-lg-10">
        <div class="input-group" id="datepicker">
                <input name="inputdob" type='text' class="form-control" id="inputdob" value="<?php echo htmlspecialchars($inputdob); ?>" />
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
        <input name="inputemail"  type="text" class="form-control" id="inputemail" value="<?php echo htmlspecialchars($inputemail); ?>">
      </div>
    </div>
    
    <div class="form-group">
      <label for="inputtele" class="col-lg-2 control-label">Telephone</label>
      <div class="col-lg-10">
        <input name="inputtele" type="text" class="form-control" id="inputtele" value="<?php echo htmlspecialchars($inputtele); ?>">
      </div>
    </div>
    
     <div class="form-group">
      <label for="select" class="col-lg-2 control-label">Contact Type</label>
      <div class="col-lg-10">
        <select name="select" class="form-control" id="select" >
          <?php
do {  
?>
          <option value="<?php echo $row_eConType['contact_type']?>"<?php if (!(strcmp($row_eConType['contact_type'], $row_eConType['contact_type']))) {echo "selected=\"selected\"";} ?>><?php echo $row_eConType['contact_type']?></option>
          <?php
} while ($row_eConType = mysql_fetch_assoc($eConType));
  $rows = mysql_num_rows($eConType);
  if($rows > 0) {
      mysql_data_seek($eConType, 0);
	  $row_eConType = mysql_fetch_assoc($eConType);
  }
?>
        </select>
        
       </div>
      </div>
        
      <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="submit" name="submit" value="Submit" class="btn btn-default">Submit</button>
      </div>
    </div>
   
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
mysql_free_result($editCon);

mysql_free_result($eConType);
?>
