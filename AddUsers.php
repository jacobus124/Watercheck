<?php require_once('Connections/riddelsql.php'); ?>
<?php require_once('GetSql.php'); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
</style>
<title>Add Users</title>
</head>
<body>
<div id="blackout" onClick="hideError()">
        <div id="error" onClick="hideError()">
            <p id="message" style="top:30%;position:relative"></p>
        </div>
    </div>
    <input type="text" id="Username"/>
    <input type="text" id="Password"/>
    <input type="submit" value="submit" onClick="submit(Username.value,Password.value)"/>
    <script>
    function submit(Username, Password){
        var xmlhttp1 = new XMLHttpRequest();
                xmlhttp1.onreadystatechange = function()
                {
                    if (this.readyState == 4 && this.status == 200)
                    {
                        document.getElementById("blackout").style.display = "block";
                        document.getElementById("message").innerHTML = xmlhttp1.responseText;
                    }
                };
                xmlhttp1.open("GET", "AddUserSQL.php?q="+Username +"||" + Password, true);
                xmlhttp1.send();
    }
    function hideError()
    {
        document.getElementById("blackout").style.display = "none";
        var text = document.getElementById("message").innerHTML;
        location.reload();
    }
</script>
</body>
</html>