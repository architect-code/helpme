<?php
session_start();
require_once "pdo.php";

if(isset($_POST["name"]) && isset($_POST["email"]) &&
isset($_POST["password"])){
    // $_SESSION["error"]=FALSE;
    unset($_SESSION["account"]);
    unset($_SESSION["success"]);
$previous_user_check="SELECT email FROM users WHERE email = :em";
$stmt1 = $pdo->prepare($previous_user_check);
$stmt1->execute(array(
    ":em"=>$_POST["email"],)
);

$row = $stmt1->fetch(PDO::FETCH_ASSOC);
if( $row === FALSE) {

    $signup="INSERT INTO users (name, email, password)
    VALUES (:name, :email, :password)";
    $stmt=$pdo->prepare($signup);
    $stmt->execute(array(
        ":name"=>$_POST["name"],
        ":email"=>$_POST["email"],
        ":password"=>$_POST["password"]
        
    ));
 unset($_SESSION["account"]);
 unset($_SESSION["success"]);
    $login = "SELECT name,user_id FROM users WHERE email = :em AND password=:pw";

    $stmt2 = $pdo->prepare($login);
    $stmt2->execute(array(
        ":em"=>$_POST["email"],
        ":pw"=>$_POST["password"]
    ));

        $row2=$stmt2->fetch(PDO::FETCH_ASSOC);


            $_SESSION["account"]=$row2['user_id'];
            $_SESSION["success"] = "Logged_in";
            // echo($row['user_id']);

            header("Location: index.php");
            return;
}

else{
    $_SESSION["error"]="USER ALREADY EXIXTS WITH SAME EMAIL ID";
    // echo ("<p style='color:red' ></p>");
    header("Location: signup.php");
    return;
   }
}
?>



<html>
<head>
        <meta charset="UTF-8">
        <title>Sign Up</title>
        <link rel="icon" type="png/image" href="media/icon.png">
        <link rel="stylesheet" href="nav.css">
        <link rel="stylesheet" href="signup.css">
   
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

    
       
        <div id="formdiv">
        
<form method="post">
<!-- <label for="name">Name: </label> -->
<input type="text" name="name" id="name" pattern="[A-Za-z ]+" placeholder="Name" required></br>
<!-- <label for="email" >Email ID: </label> -->
<input type="email" name="email" id="email" placeholder="Email address" required></br>
<!-- <label for="password">Password: </label> -->
<input type="password" name="password" id="password" placeholder="Password" required></br>
<input id="sub" type="submit" value="Sign Up">

</form>
</div>
<?php
if(isset($_SESSION["error"])){
   echo("<script>alert('USER ALREADY EXIXTS WITH SAME EMAIL ID');</script>");
   unset($_SESSION["error"]);
}
   ?>

</main>
</body>

</html>