<?php
session_start();
require_once "pdo.php";

$stmt = $pdo->query("SELECT state, district, city_village, patient_name,
require_type, requirement, phone1, time, status FROM application ORDER BY time DESC;");

$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<html>
    <head>
    <meta charset="UTF-8">
    <title>Help Me</title>
    <link rel="icon" type="png/image" href="media/icon.png">
    <script src=""></script>
    <link rel="stylesheet" href="template2.css">
    <link rel="stylesheet" href="nav.css">
    <script src="index.js"></script>

    </head>
    <body>

    <header>
        <nav>
            <a href="signup.php" id="signup">Sign Up</a>
            <a href="login.php" id="login"> Login </a>
            <a href="signout.php" id="logout"> Logout </a>
            <a href="application.php" id="application"> Application </a>

    </header>
<?php

if(isset($_SESSION["success"])===FALSE){

    echo("<script type='text/javascript'>");
    echo('loggedout();');
    echo("</script>");
}
    else{
    echo("<script type='text/javascript'>");
    echo('loggedin();');
    echo("</script>");
}

?>
 

    <section class="one">


    <?php
        foreach($rows as $row)
        {
            echo('<section class="two"><div class="three"><div class="five"><img src="media/medi.jpg"/></div><div class="six">');
            echo('<span class="require_type">');
            echo(htmlentities($row["require_type"]));
            echo('</span></br><span class="address">');
            echo(htmlentities($row["state"]).", ".htmlentities($row["district"]).", ".htmlentities($row["city_village"]));
            echo('</span></br><span class="date">');
            echo($row["time"]);
            echo('</span><span class="status">');
            echo($row["status"]);
            echo('</span><br><span class="name">');
            echo(htmlentities($row["patient_name"]));
            echo('</span></div></div><div class="four"><span class="requirement">');
            echo(htmlentities($row["requirement"]));
            echo('</span></br><span class="phone">');
            echo(htmlentities($row["phone1"]));
            echo('</span></div></section>');

        }

        ?>


</section></body></html>






