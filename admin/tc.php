<?php
require '../server/baglan.php';



$page_title = 'Tc Sorgu';
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
                    <h4 class="card-title mb-4">Tc Sorgu</h4>
                    <p class="mb-1">
                    <p>
                        Sorgulanacak T.C. Nosunu Giriniz.</br>
                    </p>
                    </p>
                    <div class="block-content tab-content">
                        <div class="tab-pane active" id="tc" role="tabpanel">
                            <input class="form-control" type="text" id="tcno" placeholder="TC"><br>
                        </div>
                        <center class="nw">
                            <button onclick="checkNumber()" id="sorgula" name="yolla" class="btn waves-effect waves-light btn-rounded btn-primary" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-search"></i> Sorgula <span id="sorgulanumber"></span></button>
                            <button onclick="clearAll()" id="durdurButon" type="button" class="btn waves-effect waves-light btn-rounded btn-danger" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-trash-alt"></i> Sıfırla </button>
                            <button onclick="printTable()" id="yazdirTable" type="button" class="btn waves-effect waves-light btn-rounded btn-warning" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-print"></i> Yazdır Detay </button><br><br>
                        </center>
                        <div class="table-responsive">

                            <table id="zero-conf" class="table table-hover" style="width:100%">
                                <thead>
                                <tr>
                                        <th>TC</th>
                                        <th>AD</th>
                                        <th>SOYAD</th>
                                        <th>DOĞUM TARİHİ</th>
                                        <th>ADRES İL</th>
                                        <th>ADRES İLÇE</th>
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
                "title": "Sorgulanıyor...",
                "icon": "loading",
                "duration": 60000
            });
            $.ajax({
                url: "../api/adsoyad/api.php",
                type: "GET",
                data: {
                    tc: tc
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
                            title: 'Bulunamadı!',
                            text: 'Girdiğiniz bilgiler ile eşleşen bir kişi bulunamadı.',
                        })
                    }
                },
                error: () => {
                    $.Toast.hideToast();
                    Swal.fire({
                        icon: 'error',
                        title: "Sunucu hatası!",
                        text: 'Lütfen yönetici ile iletişime geçin.'
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