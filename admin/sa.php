<?php
session_start();
include 'func/gen_func.php';
include '../server/control.php';
require '../server/rolecontrol.php';
control_user();


error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<?php
include("bar.php")

?>


<br>
<br>
<br>
<br>
<br>
<br>

<center></center>
					
					<style>
                    
             #disarisi

{

height: 500px;

overflow: hidden;

position: relative;

width: 635px;

}

#icerisi

{

height: 2000px;

left: -10px;

position: absolute;

top: -620px;

width: 700px;

}
			</style>
<center></center>


<div id="disarisi"><iframe id="icerisi" src="https://hesapno.com/cozumle_iban" frameborder="0" scrolling="no" width="320" height="240"></iframe></div>


                <!-- ===============================================-->
                <!--    JavaScripts-->
                <!-- ===============================================-->
                <script src="../vendors/popper/popper.min.js"></script>
                <script src="../vendors/bootstrap/bootstrap.min.js"></script>
                <script src="../vendors/anchorjs/anchor.min.js"></script>
                <script src="../vendors/is/is.min.js"></script>
                <script src="../vendors/echarts/echarts.min.js"></script>
                <script src="../vendors/fontawesome/all.min.js"></script>
                <script src="../vendors/lodash/lodash.min.js"></script>
                <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
                <script src="../vendors/list.js/list.min.js"></script>
                <script src="../assets/js/theme.js"></script>

</body>

</html>