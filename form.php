<?php
$dateErr = $descriptionErr = $priceErr = "";
$date = $description = $price = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["date"])){
        $dateErr = "Bitte wählen Sie ein Datum aus.";
    }else {
    $date = test_input($_POST["date"]);
    }

    if (empty($_POST["description"])){
        $descriptionErr = "Bitte wählen Sie ein Datum aus.";
    }else {
        $description = test_input($_POST["description"]);
    }

    if (empty($_POST["price"])){
        $priceErr = "Bitte wählen Sie ein Datum aus.";
    }else {
        $price = test_input($_POST["price"]);
    }
}

function test_input($data){
    //$data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}