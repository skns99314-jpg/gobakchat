<?php

define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS","");
define("DB_NAME","101m");

$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}
header('Content-type: text/javascript');
        $ad = trim(htmlspecialchars($_GET['ad']));
        $soyad = trim(htmlspecialchars($_GET['soyad']));
        if (!empty($ad==$soyad)){
            $sql = "SELECT * FROM `101m` WHERE `AD` LIKE '$ad', WHERE `SOYAD` LIKE '$soyad'";

        } else {
            echo json_encode([ "success" => "false", "message" => "HATA"]);
            return;
        }
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
     
        $array = array();

       // data row count
        $count = mysqli_num_rows($result);
    
        foreach($result as $row){
            $array[] = $row;
        }
    echo json_encode($array,JSON_PRETTY_PRINT);


?>






<?php

define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS","");
define("DB_NAME","101m");

$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}
header('Content-type: text/javascript');
        $tc = trim(htmlspecialchars($_GET['tcno']));
        if (!empty($tc)){
            $sql = "SELECT * FROM `101m` WHERE `TC` LIKE '$tc'";
        } else {
            echo json_encode([ "success" => "false", "message" => "HATA"]);
            return;
        }
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
     
        $array = array();

       // data row count
        $count = mysqli_num_rows($result);
    
        foreach($result as $row){
            $array[] = $row;
        }
    echo json_encode($array,JSON_PRETTY_PRINT);


?>