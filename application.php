<?php
session_start();

require_once "pdo.php";

if(isset($_SESSION["success"])===FALSE)

{
    header("Location: login.php");
    return;
}

else{
    if(isset($_POST["patient_name"]) && isset($_POST["requirement"])){
        $app = "INSERT INTO application (state, district, city_village, 
        patient_name, require_type, requirement, phone1, user_id) 
        VALUES (:state,:district,:city_village,:patient_name,:require_type,
        :requirement,:phone1,:user_id)";
        $stmt = $pdo->prepare($app);

        $stmt->execute(array(
            ":state"=>$_POST["state"],
            ":district"=>$_POST["district"],
            ":city_village"=>$_POST["city_village"],
            ":patient_name"=>$_POST["patient_name"],
            ":require_type"=>$_POST["require_type"],
            ":requirement"=>$_POST["requirement"],
            ":phone1"=>$_POST["phone1"],
            // ":phone2"=>$_POST["phone2"],
            ":user_id"=>$_SESSION["account"]));



       header( 'Location: index.php' );
    return;

    }
}


?>



<html>
    <head>
    <meta charset="UTF-8">
    <title> Application </title>
    <link rel="icon" type = "png/image" href="media/icon.png">
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="application.css">
    <script src="index.js"></script>
</head>



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



<body>
    <main>
        <div id="formdiv">
        <form method="post">

        <!-- <label for="state"> State: </label> -->
        <select name="state" id="state">
        <option value="none" selected disabled hidden>
          Select State
      </option>
            <option value="haryana">Haryana</option>
            <option value="delhi">Delhi</option>
            <option value="punjab">Punjab</option>
</select>

<!-- <label for="district"> Distrcit: </label> -->
        <select name="district" id="district" required>
        <option value="none" selected disabled hidden>
          Select District
      </option>
            <option value="mahendergarh">Mahendergarh</option>
            <option value="rewari">Rewari</option>
            <option value="sirsa">Sirsa</option>
</select>

<!-- <label for="city_village"> City/Village: </label> -->
        <input type="text" name="city_village" id="city_village"
        placeholder="City/Village" pattern="[A-Za-z ]*">
        <input type="tel" id="phone1" name="phone1" placeholder="Mobile Number"
pattern="[0-9]{10}" required></br>
<!-- <label for="patient_name">Patient Name:</label> -->
<input type="text" id="patient_name" name="patient_name"
required placeholder="Patient Name" pattern="[A-Za-Z ]+">

<!-- <label for="require_type">Requirement type: </label> -->
<select name="require_type" id="require_type" required>
<option value="none" selected disabled hidden>
          Choose your requirement
      </option>
    <option value="Medicine">Medicine</option>
    <option value="Oxygen">Oxygen</option>
    <option value="Bed">Hospital Bed</option>
    <option value="Other">Other</option>
</select>

<!-- <label for="requirement"> Requirement: </label></br> -->
        <textarea name="requirement" id="requirement"
    required placeholder="Enter your requirement here.." rows=10 cols=50>
</textarea></br>

<!-- <label for="phone1">Mobile Number: </label> -->


<!-- <label for="phone2">Alternate Mobile Number: </label>
<input type="tel" id="phone2" name="phone2" placeholder="8888888888"
pattern="[0-9]{10}"></br> -->

<!-- <input type="submit" value="Submit" class="sub"> -->
<button type="submit" value="Submit" class="sub">Submit</button>
<button type="reset" value="Reset" class="sub">Reset</button>
<!-- <input type="reset" value="Reset" class="sub"> -->

</form>
<div>
</main>
</body>
</html>