<?php

include "../../server/authcontrol.php";
include "../../server/baglan.php";

function sendhook($username, $title, $description)
{
    $url = "https://discord.com/api/webhooks/1045442078726959135/MTEyAQ6J0l5vD2efcneQ3hGVJor6RCmhg6lyFx2zn1B5_AxP6LsahMJBp4Ul8gqa7lHD";
    $content = "Hey Yetkili Bir Hesap Düzenlendi!";
    $headers = ['Content-Type: application/json; charset=utf-8'];
    $timestamp = date("c", strtotime("now"));
    $query = json_encode([
        "content"=> $content,
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

if (isset($_POST['id'])) {
    $id = htmlspecialchars($_POST['id']);
    $islem = htmlspecialchars($_POST['islem']);

    if ($islem != "active" && $islem != "deactive") {
        echo json_encode(array("success" => false));
        die();
    } else {
        $sql = "SELECT * FROM `sh_kullanici` WHERE `id`=?";
        $res = $conn->prepare($sql);
        $res->bind_param("s", $id);
        $res->execute();
        $result = $res->get_result();

        if ($res->errno > 0) {
            echo json_encode(array("success" => false));
            die();
        } else {
            if ($result->num_rows < 1) {
                echo json_encode(array("success" => false));
                die();
            } else {
                $queryArray = $result->fetch_array();
                $kullaniciAdi = $queryArray["k_adi"];
                $kullaniciKeyi = $queryArray["k_key"];
                if ($islem == "active") {
                    $islem = "true";
                    $sql = "UPDATE `sh_kullanici` SET `k_verified`=?, `k_lastlogin`='' WHERE `id`=?";
                    $res = $conn->prepare($sql);
                    $res->bind_param("ss", $islem, $id);
                    $res->execute();
                    $result = $res->get_result();

                    if ($res->errno > 0) {
                        echo json_encode(array("success" => false));
                        die();
                    } else {
                        echo json_encode(array("success" => true));
                        sendhook($kullaniciURL, "Kullanıcı Denetleyicisi - Üye Ayarları Değiştirildi", "**$kadi** isimli yönetici bir kullanıcının üyelik durumunu aktif hale getirdi! Üyelik bilgileri; **Kullanıcı Adı: $kullaniciAdi** - **Anahtar: $kullaniciKeyi**");
                        die();
                    }
                } else if ($islem == "deactive") {
                    $islem = "false";
                    $sql = "UPDATE `sh_kullanici` SET `k_verified`=? WHERE `id`=?";
                    $res = $conn->prepare($sql);
                    $res->bind_param("ss", $islem, $id);
                    $res->execute();
                    $result = $res->get_result();

                    if ($res->errno > 0) {
                        echo json_encode(array("success" => false));
                        die();
                    } else {
                        echo json_encode(array("success" => true));
                        sendhook($kullaniciURL, "Kullanıcı Denetleyicisi - Üye Ayarları Değiştirildi", "**$kadi** isimli yönetici bir kullanıcının üyelik durumunu pasif hale getirdi! Üyelik bilgileri; **Kullanıcı Adı: $kullaniciAdi** - **Anahtar: $kullaniciKeyi**");
                        die();
                    }
                }
            }
        }
    }
} else {
    echo json_encode(array("success" => false));
    die();
}
