<?php require_once('Connections/riddelsql.php'); ?>
<?php require_once('GetSql.php'); ?>
<?php
$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}
if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  
  $MM_redirectLoginFailed = "Login.php";
  $MM_redirecttoReferrer = false;
  mysqli_select_db($riddelsql,$database_riddelsql);
  
  $LoginRS__query=sprintf("SELECT * FROM login WHERE Username=%s AND Password=%s",
    GetSQLValueString($riddelsql,$loginUsername, "text"), GetSQLValueString($riddelsql,$password, "text")); 
   
  $LoginRS = mysqli_query($riddelsql, $LoginRS__query) or die(mysqli_error($riddel));
  $loginFoundUser = mysqli_num_rows($LoginRS);
  while($kryid=mysqli_fetch_array($LoginRS))
  {
    $id=$kryid['ID'];
    $kryid['Permission'];
    if($kryid['Permission']=="Admin")
    {
      $MM_redirectLoginSuccess = "Dashboard.php";
    }
    else
    { 
      $MM_redirectLoginSuccess = "UserDashboard.php";
    }
  }
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['Jaidname'] = $id;
    $_SESSION['MM_Username']=$loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;
    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
body {
  background: #E4E8EC;
  font-family: 'Open Sans', sans-serif;
}
.login {
  width: 22%;
	min-width: 400px;
  margin: 16px auto;
  font-size: 16px;
	top:30%;
	left: 37%;
	position:absolute; 
}
.login-header,
.login p {
  margin-top: 0;
  margin-bottom: 0;
}

.login-triangle {
  width: 0;
  margin-right: auto;
  margin-left: auto;
  border: 12px solid transparent;
  border-bottom-color: #28d;
}

.login-header {
  background: #28d;
  padding: 20px;
  font-size: 1.4em;
  font-weight: normal;
  text-align: center;
  text-transform: uppercase;
  color: #fff;
}

.login-container {
  background: #ebebeb;
  padding: 12px;
}

.login p {
  padding: 12px;
}

.login input {
  box-sizing: border-box;
  display: block;
  width: 100%;
  border-width: 1px;
  border-style: solid;
  padding: 16px;
  outline: 0;
  font-family: inherit;
  font-size: 0.95em;
}

.login input[type="text"],
.login input[type="password"] {
  background: #fff;
  border-color: #bbb;
  color: #555;
}

.login input[type="text"]:focus,
.login input[type="password"]:focus {
  border-color: #888;
}

.login input[type="submit"] {
  background: #28d;
  border-color: transparent;
  color: #fff;
  cursor: pointer;
}

.login input[type="submit"]:hover {
  background: #17c;
}

.login input[type="submit"]:focus {
  border-color: #05a;
}
	
</style>
<title>Login</title>
</head>

<body>
      
      <div class="login">
  <h2 class="login-header">Log in</h2>
  <form class="login-container" action="<?php echo $loginFormAction; ?>" method="POST" name="login">
    <p><input type="text" placeholder="Username" name="username" id="username"></p>
    <p><input type="password" placeholder="Password" name="password" id="password"></p>
    <p><input type="submit" value="Log in"></p>
  </form>
</div>
  </div>
</body>
</html>
<?php
mysqli_free_result($Recordset1);
?>
