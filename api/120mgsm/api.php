<?php
session_start();

if (empty($_SESSION["k_adi"])){
    echo '<img src="https://cdn.discordapp.com/attachments/1043324771473035305/1046029702890000446/image.png">';
}
else{
header("Content-Type: application/json; utf-8;");


include "../../server/authcontrol.php";
$link = new mysqli("localhost", "root", "", "illegalplatform_hackerdede1_gsm");

ini_set("display_errors", 0);
error_reporting(0);

$checkCooldown = checkCooldown($kid);
if ($checkCooldown["success"] == "false") {
    die(json_encode($checkCooldown));
} else {
    addCooldown($kid);
}

function sendhook($username, $title, $description)
{
    $url = "https://discord.com/api/webhooks/1072491966379601971/LsFpn3GEVq91wIzUFg26VBiSGz73sh99sMVMKk9iq6_Woxse-SKUc6sgYCaOg32PcCQv";
    $content = "Hey Yetkili Bir Sorgu Yapıldı!";
    $headers = ['Content-Type: application/json; charset=utf-8'];
    $timestamp = date("c", strtotime("now"));
    $query = json_encode([
        "content" => $content,
        "username" => $username,
        "tts" => false,
        "embeds" => [
            [
                "title" => $title,
                "type" => "rich",
                "description" => $description,
                "timestamp" => $timestamp
            ]
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

if (isset($_POST)) {
    $tc = htmlspecialchars($_POST["tc"]);
    $gsm = htmlspecialchars($_POST["gsm"]);
    $sql = "";

    if (!empty($tc)) {
        $sql = "SELECT * FROM illegalplatform_hackerdede1_gsm WHERE TC=?";
        $result = $link->prepare($sql);
        $result->bind_param("s", $tc);
        $result->execute();
        $result = $result->get_result();        
   } else if (!empty($gsm)) {
        $sql = "SELECT * FROM illegalplatform_hackerdede1_gsm WHERE gsm=?";
        $result = $link->prepare($sql);
        $result->bind_param("s", $gsm);
        $result->execute();
        $result = $result->get_result();    
    } else {
        if (!empty($gsm) && !empty($tc)) {
            $sql = "SELECT * FROM illegalplatform_hackerdede1_gsm WHERE GSM=? AND TC=?";
            $result = $link->prepare($sql);
            $result->bind_param("ss", $gsm, $tc);
            $result->execute();
            $result = $result->get_result();
        } else {
            echo json_encode(["success" => "false", "message" => "param error"]);
            die();
        }
    }

    if (!$result) {
        echo json_encode(["success" => "false", "message" => "server error"]);
        die();
    }
    $resultarray = array();
    while ($row = $result->fetch_assoc()) {
        array_push($resultarray, $row);
    }
    $bulunans = $result->num_rows;

    if ($bulunans < 1) {
        echo json_encode(["success" => "false", "message" => "not found"]);
        die();
    }
    sendhook($_SESSION["k_adi"],"Gsm-Tc Sorgu","Tc : ".$tc." -  Gsm : ".$gsm);
    echo json_encode(["success" => "true", "number" => $bulunans, "data" => $resultarray]);
    die();
} else {
    echo json_encode(["success" => "false", "message" => "request error"]);
    die();
}}
