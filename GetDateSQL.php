<?php
    class GetDate 
    {
        public $hostname_riddelsql = "";
        public $database_riddelsql = "";
        public $username_riddelsql = "";
        public $password_riddelsql = "";
        function __construct()
        {
            include('Connections/riddelsql.php');
            $this->hostname_riddelsql = $hostname_riddelsql;
            $this->database_riddelsql= $database_riddelsql;
            $this->username_riddelsql = $username_riddelsql;
            $this->password_riddelsql = $password_riddelsql;
        }
        function GetDateEntry($herd,$date)
        {
            $riddelsql = mysqli_connect($this->hostname_riddelsql, $this->username_riddelsql, $this->password_riddelsql) or trigger_error(mysqli_error($riddelsql),E_USER_ERROR); 
            mysqli_select_db($riddelsql,$this->database_riddelsql);
            require_once('GetSql.php');
            include('GetCompany.php');
            $GetEntrySQL=mysqli_query($riddelsql,sprintf("SELECT * FROM water WHERE Herd=%s AND Date=%s AND Company=%s",
            GetSQLValueString($riddelsql,$herd,"text"),GetSQLValueString($riddelsql,$date,"text"),GetSQLValueString($riddelsql,$company,"text")))or die(mysqli_error($riddelsql));
            $entry=mysqli_fetch_array($GetEntrySQL);
            switch($entry['Status'])
            {
                case "Great":
                    $color="green";
                    break;
                case "Orange":
                    $color="orange";
                    break;
                case "Bad":
                    $color="red";
                    break;
                default:
                    $color="grey";
                    break;
            }
                echo '<td style="background-color:'.$color.'" onClick="DisplayDiv('.$entry['ID'].')"><div id="div'.$entry['ID'].'" style="display:none;">'.$entry['Comment'].'</br>'.$entry['User'].'</div></td>';
        }
    }
?>