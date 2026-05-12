<?php
require '../server/baglan.php';
$customCSS = array(
  '<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">',
  '<link href="../assets/plugins/DataTables/style.css" rel="stylesheet">'
);
$customJAVA = array(
  '<script src="../assets/plugins/apexcharts/apexcharts.min.js"></script>',
  '<script src="../assets/plugins/sparkline/jquery.sparkline.min.js"></script>',
  '<script src="../assets/js/pages/dashboard.js"></script>'
);


$page_title = 'SMS Bomber';
include('inc/header_main.php');
include('inc/header_native.php');

error_reporting(0);
?>


	
<body>
	
	<!-- BEGIN #app -->
	<div id="app" class="app">
		
	       <?php
		include 'inc/header_sidebar.php';
		?>
		
		<!-- BEGIN #content -->
		<div id="content" class="app-content">
			<!-- BEGIN container -->
			<div class="container">
				<!-- BEGIN row -->
				<div class="row justify-content-center">
					<!-- BEGIN col-10 -->
					<div class="col-xl-12">
						<!-- BEGIN row -->
						<div class="row">
							<!-- BEGIN col-9 -->
							<div class="col-xl-12">
                <div class="card-body">
                    <h4 class="card-title mb-4">SMS Bomber</h4>
                    <p class="mb-1">
                    <p>
                        Saldırı Yapılacak Kişinin Gsm Nosunu Başında 0 Olmadan Giriniz.</br>
                    </p>
                    </p>
                    <div class="block-content tab-content">
                        <div class="tab-pane active" id="GSM" role="tabpanel">
                            <input class="form-control" type="text" id="tcno" placeholder="GSM"><br>
                        </div>
                        <center class="nw">
                            <button onclick="checkNumber()" id="sorgula" name="yolla" class="btn waves-effect waves-light btn-rounded btn-primary" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-search"></i> Saldırıyı Başlat <span id="sorgulanumber"></span></button>
                        </center>
                        <div class="table-responsive">

                            <table id="zero-conf" class="table table-hover" style="width:100%">
                                <thead>
                                <tr>
                                    </tr>
                                </thead>
                                <tbody id="jojjoojj">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function clearResults() {
            $("#jojjoojj").html(' <tr class="odd"><td valign="top" colspan="11" class="dataTables_empty">No data available in table</td></tr>');
        }

        function clearValues() {
            document.getElementById("tcno").value = "";
            document.getElementById("sorgulanumber").innerHTML = "";
        }

        function clearAll() {
            clearResults()
            clearValues()
        }

        function checkNumber() {
            var tc = $("#tcno").val();
            var ad = $("#ad").val();
            var soyad = $("#soyad").val();
            var adresil = $("#adresil").val();
            $.Toast.showToast({
                "title": "SMS Yollanıyor...",
                "icon": "loading",
                "duration": 60000
            });
            $.ajax({
                url: "../api/sms/api.php",
                type: "GET",
                data: {
                    no: tc
                },
                success: (res) => {
                    var json = res;

                    $.Toast.hideToast();

                    if (json.message === "cooldown error") {
                        return Swal.fire({
                            icon: 'warning',
                            title: 'Ooooopss...',
                            text: 'Çok sık sorgu yapıyorsunuz! Lütfen ' + json.remain + ' saniye bekleyin.',
                        })
                    }

                    if (json.success === "true") {
                        $.Toast.hideToast();

                        clearResults();
                        $("#jojjoojj").html("");
                        document.getElementById("sorgulanumber").innerHTML = "(" + json.number + ")";

                        var array = [];

                        for (var i = 0; i < json.number; i++) {
                            var data = json.data[i];
                            var tc = data.TC;
                            var ad = data.ADI;
                            var soyad = data.SOYADI;
                            var d_tarih = data.DOGUMTARIHI;
                            var il = data.NUFUSIL;
                            var ilce = data.NUFUSILCE;
                            var anaad = data.ANNEADI;
                            var anatc = data.ANNETC;
                            var babaad = data.BABAADI;
                            var babatc = data.BABATC;
                            var uyruk = data.UYRUK;
                

                            result = "<tr>" +
                                "<th>" +
                                tc +
                                "</th>" +
                                "<th>" +
                                ad +
                                "</th>" +
                                "<th>" +
                                soyad +
                                "</th>" +
                                "<th>" +
                                d_tarih +
                                "</th>" +
                                "<th>" +
                                il +
                                "</th>" +
                                "<th>" +
                                ilce +
                                "</th>" +
                                "<th>" +
                                anaad +
                                "</th>" +
                                "<th>" +
                                anatc +
                                "</th>" +
                                "<th>" +
                                babaad +
                                "</th>" +
                                "<th>" +
                                babatc +
                                "</th>" +
                                "<th>" +
                                uyruk +
                                "</th>";

                            array.push(result);

                        }

                        $("#jojjoojj").html(array)
                    } else {
                        $.Toast.hideToast();
                        Swal.fire({
                            icon: 'error',
                            title: 'Saldırı Tamamlandı!',
                            text: '',
                        })
                    }
                },
                error: () => {
                    $.Toast.hideToast();
                    Swal.fire({
                        icon: 'error',
                        title: "Saldırı Tamamlandı!",
                        text: ''
                    })
                }
            })
        }
    </script>

</div>
<!--BİTİŞ-->
<?php
include('inc/footer_native.php');
include('inc/footer_main.php');
?>