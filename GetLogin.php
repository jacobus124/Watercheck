<?php
    require_once('Connections/riddelsql.php'); 
    require_once('GetSql.php');
    $q=explode("||",$_GET['q']);
    $GetLogin=mysqli_query($riddelsql,sprintf("SELECT * FROM login WHERE Username=%s AND Password=%s", GetSQLValueString($riddelsql,$q[0],"text"),GetSQLValueString($riddelsql,$q[1],"text")))or die(mysqli_error($riddelsql));
    while($gebruik=mysqli_fetch_array($GetLogin))
    {
        $json=json_encode($gebruik);
        print($json);
    }
 ?>