<?php 
    session_start();
    $user=$_SESSION['MM_Username'];
    require_once('Connections/riddelsql.php'); 
    require_once('GetSql.php');
    $GetCompany=mysqli_query($riddelsql,sprintf('SELECT Company FROM login WHERE Username=%s',GetSQLValueString($riddelsql,$user,"text")))or die(mysqli_error($riddelsql));
    $company=mysqli_fetch_array($GetCompany);
    $q=explode("||",$_GET['q']);
    $Username=$q[0];
    $Password=$q[1];
    $GetUsername=mysqli_query($riddelsql,sprintf('SELECT * FROM login WHERE Username=%s',GetSQLValueString($riddelsql,$Username,"text")))or die(mysqli_error($riddelsql));
    $check=mysqli_num_rows($GetUsername);
    if($check>0)
    {
        echo "Username already exists";
    }
    else
    {
        $addHerd=mysqli_query($riddelsql,sprintf('INSERT INTO Login (Username,Password,Company) VALUES (%s,%s,%s)',
        GetSQLValueString($riddelsql,$Username,"text"),
        GetSQLValueString($riddelsql,$Password,"text"),
        GetSQLValueString($riddelsql,$company[0],"text")))or die(mysqli_error($riddelsql));
    }
    
?>