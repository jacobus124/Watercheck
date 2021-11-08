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
                    width:1%;
                }
                td
                {
                    height:30px;
                }
                td
                {
                    cursor: pointer;
                }
            </style>
        </head>
        <body>
            <table>
                <?php
                    $class= new GetDate();
                    if(isset($_GET['q']))
                        {
                            $date=new DateTime(date("Y-m-d",strtotime($_GET['q'])));
                        }
                        else
                        {
                            $date= new DateTime(date("Y-m-d"));
                        }
                    $fill=$date->format("Y")."-".$date->format("m")."-01";
                    $startDate=new DateTime($fill);
                    $endDate=new DateTime($fill);
                    $endDate->modify("+1 month");
                    while($startDate<$endDate)
                    {
                        echo "<th>".$startDate->format("d")."</th>";
                        $startDate->modify("+1 day");
                    }
                    $getHerdsSQL=mysqli_query($riddelsql,sprintf("SELECT DISTINCT Herd FROM water WHERE company='$company'"))or die(mysqli_error($riddelsql));
                    while($array=mysqli_fetch_array($getHerdsSQL))
                    {
                        if(isset($_GET['q']))
                        {
                            $date=new DateTime(date("Y-m-d",strtotime($_GET['q'])));
                        }
                        else
                        {
                            $date= new DateTime(date("Y-m-d"));
                        }
                        $fill=$date->format("Y")."-".$date->format("m")."-01";
                        $startDate=new DateTime($fill);
                        $endDate=new DateTime($fill);
                        $endDate->modify("+1 month");
                        echo "<tr>";
                        while($startDate<$endDate)
                        {
                            $class->GetDateEntry($array['Herd'],$startDate->format("Y-m-d"));
                            $startDate->modify("+1 day");
                        }
                        echo "</tr>";
                    }
                ?>
            </table>
        </body>
    </html>