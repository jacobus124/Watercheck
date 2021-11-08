<?php
    require_once('Connections/riddelsql.php'); 
    require_once('GetSql.php');
    require_once('GetCompany.php');
    require_once('GetDateSQL.php');
    ?>
    <!DOCTYPE html>
    <html>
        <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
            <link href="amadevcss.css?0.15" rel="stylesheet" type="text/css"/>
            <script>
            function DisplayDiv(id)
            {
                var toets=document.getElementById("div"+id).style.display;
                if(toets=="none")
                    document.getElementById("div"+id).style.display="block";
                else
                    document.getElementById("div"+id).style.display="none";
            }
        </script>
            <style>
                th
                {
                    width:10%;
                }
                table
                {
                    width:100%;
                }
                td
                {
                    cursor: pointer;
                }
            </style>
        </head>
        <body>
            <table>
                <thead>
                    <th>Herd</th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                    <th>Sun</th>
                </thead>
                <tbody>
                <?php
                    $class= new GetDate();
                    $getHerdsSQL=mysqli_query($riddelsql,sprintf("SELECT DISTINCT Herd FROM water WHERE company='$company'"))or die(mysqli_error($riddelsql));
                    while($array=mysqli_fetch_array($getHerdsSQL))
                    {
                        if(isset($_GET['q']))
                        {
                            $date=new DateTime(date("Y-m-d",strtotime($_GET['q'])));
                            $date2 =new DateTime(date("Y-m-d",strtotime($_GET['q'])));
                            $date3 =new DateTime(date("Y-m-d",strtotime($_GET['q'])));
                        }
                        else
                        {
                            $date= new DateTime(date("Y-m-d"));
                            $date2 = new DateTime(date("Y-m-d"));
                            $date3 = new DateTime(date("Y-m-d"));
                        }
                        $endDate="";
                        $startDate="";
                        switch($date->format("D"))
                        {
                            case "Mon":
                                $endDate = $date->modify("+6 day");
                                $startDate = $date2;
                                break;
                            case "Tue":
                                $endDate = $date->modify("+5 day");
                                $startDate = $date2->modify("-1 day");
                                break;
                            case "Wed":
                                $endDate = $date->modify("+4 day");
                                $startDate = $date2->modify("-2 day");
                                break;  
                            case "Thu":
                                $endDate = $date->modify("+3 day");
                                $startDate = $date2->modify("-3 day");
                                break;
                            case "Fri":
                                $endDate = $date->modify("+2 day");
                                $startDate = $date2->modify("-4 day");
                                break;
                            case "Sat":
                                $endDate = $date->modify("+1 day");
                                $startDate = $date2->modify("-5 day");
                                break;
                            case "Sun":
                                $startDate = $date->modify("-6 day");
                                $endDate = $date2;
                                break;
                        }
                        $dates = $startDate->format("Y-m-d") .'</br>';
                        $datee =  $endDate->format("Y-m-d") .'</br>';
                        echo '<tr>';
                        echo '<td>'.$array['Herd'].'</td>';
                        $getWaterSQL=mysqli_query($riddelsql, sprintf("SELECT * FROM water WHERE Herd=%s ORDER BY Date ASC",GetSQLValueString($riddelsql,$array['Herd'],"text")))or die(mysqli_error($riddelsql));
                        while($herd=mysqli_fetch_array($getWaterSQL))
                        {
                            for($i=0;$i<7;$i++)
                            {
                                $stuur=$startDate->format("Y-m-d");
                                if($startDate<=$endDate)
                                {
                                    $class->GetDateEntry($herd['Herd'],$stuur);
                                    $startDate=$startDate->modify("+1 day");
                                }
                            }
                        }
                        echo '</tr>';
                    }                
                ?>
                </tbody>
            </table>
        </body>
    </html>