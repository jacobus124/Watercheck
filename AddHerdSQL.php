<?php 
    session_start();
    $user=$_SESSION['MM_Username'];
    require_once('Connections/riddelsql.php'); 
    require_once('GetSql.php');
    $GetCompany=mysqli_query($riddelsql,sprintf('SELECT Company FROM login WHERE Username=%s',GetSQLValueString($riddelsql,$user,"text")))or die(mysqli_error($riddelsql));
    $company=mysqli_fetch_array($GetCompany);
    $q=explode("||",$_GET['q']);
    $herdName=$q[0];
    $herdSize=$q[1];
    $addHerd=mysqli_query($riddelsql,sprintf('INSERT INTO herds (Name,Size,Company) VALUES(%s,%s,%s)',
    GetSQLValueString($riddelsql,$herdName,"text"),
    GetSQLValueString($riddelsql,$herdSize,"int"),
    GetSQLValueString($riddelsql,$company[0],"text")))or die(mysqli_error($riddelsql));
?>