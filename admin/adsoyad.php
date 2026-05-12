<?php
$customCSS = array(
);
$customJAVA = array(
	'<script src="../../assets/plugins/@highlightjs/cdn-assets/highlight.min.js"></script>',
	'<script src="../../assets/js/demo/highlightjs.demo.js"></script>',
	'<script src="../../assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>',
	'<script src="../../assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>',
	'<script src="../../assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>',
	'<script src="../../assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js"></script>',
	'<script src="../../assets/plugins/datatables.net-buttons/js/buttons.flash.min.js"></script>',
	'<script src="../../assets/plugins/datatables.net-buttons/js/buttons.html5.min.js"></script>',
	'<script src="../../assets/plugins/datatables.net-buttons/js/buttons.print.min.js"></script>',
	'<script src="../../assets/plugins/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>',
	'<script src="../../assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>',
	'<script src="../../assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>',
	'<script src="../../assets/plugins/bootstrap-table/dist/bootstrap-table.min.js"></script>',
	'<script src="../../assets/js/demo/table-plugins.demo.js"></script>',
	'<script src="../../assets/js/demo/sidebar-scrollspy.demo.js"></script>',
	'<script src="../../assets/plugins/jquery.toast/jquery.toast.js"></script>',
	'<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>',
	

);

$page_title = 'Ad Soyad';
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
			<!-- BEGIN row -->
				<div class="row justify-content-center">
					<!-- BEGIN col-10 -->
					<div class="col-xl-12">
						<!-- BEGIN row -->
						<div class="row">
							<!-- BEGIN col-9 -->
							<div class="col-xl-12">
                <div class="card-body">
                    <p>
                        Sorgulanacak Kisinin Adi, Soyadi, Il Veya Ilçesini Giriniz.</br>
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
                            <input class="form-control" type="text" id="nufusilce" placeholder="Ilçe"><br>
                        </div>
                        <center class="nw">
                            <button onclick="checkNumber()" id="sorgula" name="yolla" class="btn waves-effect waves-light btn-rounded btn-primary" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-search"></i> Sorgula <span id="sorgulanumber"></span></button>
                            <button onclick="clearAll()" id="durdurButon" type="button" class="btn waves-effect waves-light btn-rounded btn-danger" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-trash-alt"></i> Sifirla </button>
                            <button onclick="printTable()" id="yazdirTable" type="button" class="btn waves-effect waves-light btn-rounded btn-warning" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-print"></i> Yazdir Detay </button><br><br>
                        </center>
                        <div class="table-responsive">

                            <table id="zero-conf" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>TC</th>
                                        <th>AD</th>
                                        <th>SOYAD</th>
                                        <th>DOGUM TARIHI</th>
                                        <th>ADRES IL</th>
                                        <th>ADRES ILÇE</th>
                                        <th>ANNE ADI</th>
                                        <th>ANNE TC</th>
                                        <th>BABA ADI</th>
                                        <th>BABA TC</th>
                                        <th>UYRUK</th>
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
                "title": "Sorgulaniyor...",
                "icon": "loading",
                "duration": 60000
            });
            $.ajax({
                url: "../api/adsoyad/api.php",
                type: "POST",
                data: {
                    ad: ad,
                    soyad: soyad,
                    nufusil: nufusil,
                    nufusilce: nufusilce,
                },
                success: (res) => {
                    var json = res;

                    $.Toast.hideToast();

                    if (json.message === "cooldown error") {
                        return Swal.fire({
                            icon: 'warning',
                            title: 'Ooooopss...',
                            text: 'Çok sik sorgu yapiyorsunuz! Lütfen ' + json.remain + ' saniye bekleyin.',
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
                            title: 'Bulunamadi!',
                            text: 'Girdiginiz bilgiler ile eslesen bir kisi bulunamadi.',
                        })
                    }
                },
                error: () => {
                    $.Toast.hideToast();
                    Swal.fire({
                        icon: 'error',
                        title: "Sunucu hatasi!",
                        text: 'Lütfen yönetici ile iletisime geçin.'
                    })
                }
            })
        }
    </script>

</div>
<!--BITIS-->
<?php
include('inc/footer_native.php');
include('inc/footer_main.php');
?>