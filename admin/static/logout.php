<?php
include '../../server/baglan.php';
@session_start();

$kadi = $_SESSION["k_adi"];
$online = "0";
$sql = "UPDATE `sh_kullanici` SET `k_online`=? WHERE `k_adi`=?";
$res = $conn->prepare($sql);
$res->bind_param("ss", $online, $kadi);
$res->execute();




@session_start();
@setcookie("k_mail", "", -86400);
@setcookie("k_adi", "", -86400);
@setcookie("k_profil", "", -86400);
@setcookie(session_name(), '', 0, '/');
@session_unset();
@session_write_close();
@session_regenerate_id(true);
@session_destroy();




header('location: /login/');

