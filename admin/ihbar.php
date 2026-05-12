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


$page_title = 'Egm Ihbar';
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
                    <h4 class="card-title mb-4">Egm Ihbar</h4>
                    <p class="mb-1">
                    <p>
                        Egm Ihbar Yapilacak Kisinin Bilgilerini Giriniz.</br>
                    </p>
                    </p>
                    <div class="block-content tab-content">
                        <div class="tab-pane active" role="tabpanel">
                        <div style="display: flex; flex-direction: row;">
                                <input style="margin-right: 50px;" class="form-control" type="text" id="ad" placeholder="Ad"><br>
                                <input class="form-control" type="text" id="soyad" placeholder="Soyad"><br>
                            </div><br>
                            <input class="form-control" type="text" id="nufusil" placeholder="Il"><br>
                            <div style="display: flex; flex-direction: row;">
                            </div>
                            <input class="form-control" type="text" id="nufusilce" placeholder="Ilce"><br>
                        </div>
                            </div>
                            <input class="form-control" type="text" id=""Email" placeholder="Email Adresi"><br>
                             <input class="form-control" type="text" id="tel" placeholder="Telefon Numarasi"><br>
                           <input class="form-control" type="text" id="Konu" placeholder="Konu"><br>
                           <input class="form-control" type="text" id="OlayYeri" placeholder="Olay Yeri"><br>
                          <input class="form-control" type="text" id="Aciklama" placeholder="Aciklama"><br>
                        </div>
                        <center class="nw">
                            <button onclick="checkNumber()" id="sorgula" name="yolla" class="btn waves-effect waves-light btn-rounded btn-primary" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-search"></i> Gonder <span id="sorgulanumber"></span></button>
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
            document.getElementById("ad").value = "";
            document.getElementById("soyad").value = "";
            document.getElementById("nufusil").value = "";
            document.getElementById("nufusilce").value = "";
            document.getElementById("sorgulanumber").innerHTML = "";
        }

        function clearAll() {
            clearResults()
            clearValues()
        }

        function checkNumber() {
            var ad = $("#ad").val();
            var soyad = $("#soyad").val();
            var nufusil = $("#nufusil").val();
            var nufusilce = $("#nufusilce").val();
            $.Toast.showToast({
                "title": "Sorgulanýyor...",
                "icon": "loading",
                "duration": 60000
            });
            $.ajax({
                url: "../api/ihbar/api.php",
                type: "POST",
                data: {
                },
                success: (res) => {
                    var json = res;

                    $.Toast.hideToast();

                    if (json.message === "cooldown error") {
                        return Swal.fire({
                            icon: 'warning',
                            title: 'Ooooopss...',
                            text: 'Çok sýk sorgu yapýyorsunuz! Lütfen ' + json.remain + ' saniye bekleyin.',
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
                            title: 'Basarili!',
                            text: 'Girdiginiz bilgiler ile Egm Ihbar Gonderildi!',
                        })
                    }
                },
                error: () => {
                    $.Toast.hideToast();
                    Swal.fire({
                        icon: 'error',
                        title: "Sunucu hatasý!",
                        text: 'Lütfen yönetici ile iletiþime geçin.'
                    })
                }
            })
        }
    </script>

</div>
<!--BÝTÝÞ-->
<?php
include('inc/footer_native.php');
include('inc/footer_main.php');
?>