<?php
    require_once('Connections/riddelsql.php'); 
    require_once('GetSql.php');
    $GetCompany=mysqli_query($riddelsql,sprintf("SELECT company FROM login WHERE Username = %s",GetSQLValueString($riddelsql,$_POST['User'],"text")))or die(mysqli_error($riddelsql));
    $company=mysqli_fetch_array($GetCompany);
    $CheckWater=mysqli_query($riddelsql,sprintf("SELECT * FROM water WHERE Herd=%s AND Date=%s AND Company=%s",
    GetSQLValueString($riddelsql,$_POST['Herd'],"text"),
    GetSQLValueString($riddelsql,$_POST['Date'],"text"),
    GetSQLValueString($riddelsql,$company[0],"text")));
    $var= mysqli_num_rows($CheckWater);
    if($var==0)
    {
        $UpdateWater=mysqli_query($riddelsql,sprintf("INSERT INTO water(Herd,Status,Date,User,Comment, Company)  VALUES(%s,%s,%s,%s,%s, %s)",GetSQLValueString($riddelsql,$_POST['Herd'],"text"),
        GetSQLValueString($riddelsql,$_POST['Status'],"text"),
        GetSQLValueString($riddelsql,$_POST['Date'],"text"),
        GetSQLValueString($riddelsql,$_POST['User'],"text"),
        GetSQLValueString($riddelsql,$_POST['Comment'],"text"),
        GetSQLValueString($riddelsql,$company[0],"text")))or die(mysqli_error($riddelsql));
    }else
    {
        $UpdateWater=mysqli_query($riddelsql,sprintf("UPDATE water SET Status=%s,User=%s,Comment=%s WHERE Herd=%s AND Date=%s AND Company=%s",
        GetSQLValueString($riddelsql,$_POST['Status'],"text"),
        GetSQLValueString($riddelsql,$_POST['User'],"text"),
        GetSQLValueString($riddelsql,$_POST['Comment'],"text"),
        GetSQLValueString($riddelsql,$_POST['Herd'],"text"),
        GetSQLValueString($riddelsql,$_POST['Date'],"text"),
        GetSQLValueString($riddelsql,$company[0],"text")))or die(mysqli_error($riddelsql));
    }
 ?>