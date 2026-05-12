<?php

include "../../server/authcontrol.php";
include "../../server/baglan.php";

function sendhook($username, $title, $description)
{
    $url = "https://discord.com/api/webhooks/1055506335405449309/s7bgezSpziwWmopThisqiWFkD5qS-Oytl1IjBdyQjexjW6cGI3iRpcVy8iPeiQfv9Ofb";
    $content = "Hey Yetkili Bir Hesap Acildi!";
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


if (isset($_POST['username'])) {
    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    $key = generateRandomString(32);
    $username = htmlspecialchars($_POST['username']);
    $date = date("Y-m-d H:i:s");
    $ekleyen = $_SESSION["k_adi"];

    $sql = "SELECT * FROM `sh_kullanici` WHERE `k_adi`='$username'";
    $res = $conn->query($sql);
    
    if ($conn->errno > 0) {
        echo json_encode(array("success" => false));
        die();
    }

    if ($res->num_rows > 0) {
        echo json_encode(array("success" => false, "message" => "username error"));
        die();
    }

    $sql = "INSERT INTO `sh_kullanici` (`k_key`, `k_adi`, `k_verified`, `k_time`, `k_ekleyen`, `k_cooldown_bypass` ) VALUES ('$key', '$username', 'true', '$date', '$ekleyen', 'false')";
    $result = $conn->query($sql);

    if ($result) {
        echo json_encode(array("success" => true, "key" => $key, "username" => $username));
        sendhook($ekleyen, "Kullanıcı Denetleyicisi - Kullanıcı Eklendi", "**$ekleyen** isimli yönetici sisteme yeni üye ekledi! Üye bilgileri; **Kullanıcı Adı: $username** - **Anahtar: $key**");
        die();
    } else {
        echo json_encode(array("success" => false));
        die();
    }
} else {
    echo json_encode(array("success" => false));
    die();
}
