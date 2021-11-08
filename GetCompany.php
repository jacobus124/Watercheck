<?php
    require_once('Connections/riddelsql.php'); 
    require_once('GetSql.php');
    $user=$_SESSION['MM_Username'];
    $getCompanySQL=mysqli_query($riddelsql,sprintf("SELECT Company FROM login WHERE Username='$user'"))or die(mysqli_error($riddelsql));
    $com=mysqli_fetch_array($getCompanySQL);
    $company=$com[0];
    ?>