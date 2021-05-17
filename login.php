<?php
session_start();
require_once "pdo.php";

if(isset($_POST["email"]) && isset($_POST["password"]))
{ unset($_SESSION["account"]);
    $login = "SELECT name,user_id FROM users WHERE email = :em AND password=:pw";

    $stmt = $pdo->prepare($login);
    $stmt->execute(array(
        ":em"=>$_POST["email"],
        ":pw"=>$_POST["password"]
    ));

        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        if($row===FALSE){
            $_SESSION["error"]="Incorrect password or Email ID";
            header("Location: login.php");
            return;
        }
        else {

            $_SESSION["account"]=$row['user_id'];
            $_SESSION["success"] = "Logged_in";
            // echo($row['user_id']);

            header("Location: index.php");
            return;
        }
}

?>



<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="icon" type ="png/image" href="media/icon.png">
        <link rel="stylesheet" href="nav.css">
        <link rel="stylesheet" href="login.css">
       
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
    <main>
        <?php
        if (isset($_SESSION["error"])){
            echo("<script>alert('Incorrect password or Email ID');</script>");
            unset($_SESSION["error"]);
        }

        ?>

<div id="formdiv">
        <form method="post">
            <!-- <label for="email">Email ID: </label> -->
            <input type="email" name="email" id="email" required placeholder="example@one.com"></br>
            <!-- <label for="password">Password: </label> -->
            <input type="password" name="password" id="password" required placeholder="Password"></br>
            <input type="submit" value="Login" id="sub">
</form>
    </div>
</main>
</body>
</html>