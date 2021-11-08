<?php require_once('Connections/riddelsql.php'); ?>
<?php require_once('GetSql.php'); ?>
<!DOCTYPE html >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
</style>

<title>Add Herd</title>
</head>
<body>
<div id="blackout" onClick="hideError()">
        <div id="error" onClick="hideError()">
            <p id="message" style="top:30%;position:relative"></p>
        </div>
    </div>
    <input type="text" name="HerdName" id="HerdName"/>
    <input type="number" name="Size" id="Size"/>
    <input type="submit" value="Submit" onClick="submit(HerdName.value,Size.value)"/>

</body>
<script>
    function submit(HerdName, HerdSize){
        var xmlhttp1 = new XMLHttpRequest();
                xmlhttp1.onreadystatechange = function()
                {
                    if (this.readyState == 4 && this.status == 200)
                    {
                        document.getElementById("blackout").style.display = "block";
                        document.getElementById("message").innerHTML = "Updated";
                    }
                };
                xmlhttp1.open("GET", "AddHerdSQL.php?q="+HerdName +"||" + HerdSize, true);
                xmlhttp1.send();
    }
    function hideError()
    {
        document.getElementById("blackout").style.display = "none";
        var text = document.getElementById("message").innerHTML;
        location.reload();
    }
</script>
</html>