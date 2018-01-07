<?php
$host = $_POST['hostn'];
$userN = $_POST['uname'];
$upass = $_POST['paswor'];


function checkname ($hos,$uname,$upas){

        $conn = new mysqli($hos,$uname,$upas);

        // Check connection
        if ($conn->connect_error) {
            die("<div  id = 'alertdiv' role='alert' class='alert alert-danger errdon' >
            <p id='datares'>Connection failed: " . $conn->connect_error."</p></div>");
        }
        echo "<div  id = 'alertdiv' role='alert' class='alert alert-success dones' >
        <p id='datares'>Connected successfully</p></div>";
}

checkname($host,$userN,$upass);