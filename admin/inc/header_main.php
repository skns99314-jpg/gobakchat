<?php
@session_start();
include 'func/gen_func.php';
include '../server/control.php';
control_user();
loginBAN($uid, $session_agent);
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
    <title><?php echo $page_title ?> - JitemPro</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	
	<!-- ================== BEGIN core-css ================== -->
	<link href="../../assets/css/vendor.min.css" rel="stylesheet" />
	<link href="../../assets/css/app.min.css" rel="stylesheet" />
	<!-- ================== END core-css ================== -->
	
	<!-- ================== BEGIN page-css ================== -->
	<link href="../../assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
	<!-- ================== END page-css ================== -->

    <?php
    foreach ($customCSS as $css) {
        echo $css . "\n";
    } ?>
</head>
 



<body class="<?php if (!empty($body_class)) {
                    echo $body_class;
                } ?>">