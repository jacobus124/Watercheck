<?php 
    require_once('Connections/riddelsql.php'); 
    require_once('GetSql.php'); 
    $q=$_GET['q'];
    $i=0;$j=0;
    $GetCompany=mysqli_query($riddelsql,sprintf("SELECT company FROM login WHERE Username = %s",GetSQLValueString($riddelsql,$q,"text")))or die(mysqli_error($riddelsql));
    $company=mysqli_fetch_array($GetCompany);
    $GetHerds=mysqli_query($riddelsql,sprintf("SELECT * FROM water WHERE Company=%s",GetSQLValueString($riddelsql,$company[0],"text")))or die(mysqli_error($riddelsql));
    while($gebruik=mysqli_fetch_array($GetHerds))
    {
        $array[$i]=$gebruik;
        $i++;
    }
    $arr1=array("toets"=>$array);
    $json=json_encode($arr1);
    print($json);
 ?>