<?php require_once('Connections/riddelsql.php'); ?>
<?php require_once('GetSql.php'); ?>
<!DOCTYPE html >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
    #MainIframe 
    {
        width:100%;
        height:90%;
        position:absolute;
        top:150px;
        left:0px;
    }
    body
    {
        margin:0;
        padding:0;
    }
    a
    {
        height:30px;
        position:absolute;
        cursor:pointer;
    }
</style>
<title>Dashboard</title>
</head>
<body>
    <a target="MainIframe" onClick="week(dateinput.value)">Weekly</a>
    <a target="MainIframe" style="left:100px;"onClick="month(dateinput.value)">Monthly</a>
</br>
</br>
    <input type="date" id="dateinput" name="dateinput" onChange="datesubmit(dateinput.value)"/>
<iframe src="Weekly.php" id="MainIframe" name="MainIframe"> 
</iframe>
<script>
    var toets=1;
    function month(date) {
        toets=0;
        if(date=="")
        {
            document.getElementById("MainIframe").src = "Monthly.php";
        }
        else
        {
            document.getElementById("MainIframe").src = "Monthly.php?q="+date;
        }
    }
    function week(date) {
        toets=1;
        if(date=="")
        {
            document.getElementById("MainIframe").src = "Weekly.php";
        }
        else
        {
            document.getElementById("MainIframe").src = "Weekly.php?q="+date;
        }
    }
    function datesubmit(date)
    {
        if(toets==1) {
            document.getElementById("MainIframe").src = "Weekly.php?q="+date;
        }
        else if(toets==0) {
            document.getElementById("MainIframe").src = "Monthly.php?q="+date;
        }
        
    }
</script>
</body>
</html>