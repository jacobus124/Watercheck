<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_riddelsql = "localhost";
$database_riddelsql = "Veearts";
$username_riddelsql = "root";
$password_riddelsql = "";
$riddelsql=mysqli_connect($hostname_riddelsql, $username_riddelsql, $password_riddelsql);

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

/*
$riddelsql =  or trigger_error(mysqli_error($riddelsql),E_USER_ERROR); */
?>