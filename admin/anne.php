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


$page_title = 'Aile Sorgu';
include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');
?>
<!--<div class="page-content">-->
<!--BAÞLANGIC-->

<head>

</head>

<div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Aile Sorgu</h4>
                    <p class="mb-1">
                    <p>
                        Sorgulanacak Kiþinin  T.C. Nosunu Giriniz.</br>
                    </p>
                    </p>
                    <div class="block-content tab-content">
                        <div class="tab-pane active" id="tc" role="tabpanel">
                            <input class="form-control" type="text" id="tcno" placeholder="TC"><br>

                        </div>
                        <center class="nw">
                            <button onclick="checkNumber()" id="sorgula" name="yolla" class="btn waves-effect waves-light btn-rounded btn-primary" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-search"></i> Sorgula <span id="sorgulanumber"></span></button>
                            <button onclick="clearAll()" id="durdurButon" type="button" class="btn waves-effect waves-light btn-rounded btn-danger" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-trash-alt"></i> Sýfýrla </button>
                            <button onclick="printTable()" id="yazdirTable" type="button" class="btn waves-effect waves-light btn-rounded btn-warning" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-print"></i> Yazdýr Detay </button><br><br>
                        </center>
                        <div class="table-responsive">

                            <table id="zero-conf" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                    <th>YAKINLIK</th>
                                    <th>TC</th>
                                        <th>AD</th>
                                        <th>SOYAD</th>
                                        <th>DOÐUM TARÝHÝ</th>
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
            var tcno = $("#tcno").val();
            $.Toast.showToast({
                "title": "Sorgulanýyor...",
                "icon": "loading",
                "duration": 60000
            });
            $.ajax({
                url: "../api/anne/api.php",
                type: "GET",
                data: {
                    tc: tcno,
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
                        
                            var yakýnlýk = data.Yakinlik;
                            var tc = data.TC;
                            var ad = data.ADI;
                            var soyad = data.SOYADI;
                            var d_tarih = data.DOGUMTARIHI;

                            result = "<tr>" +
                                "<th>" +
                                yakýnlýk +
                                "</th>" +
                                "<th>" +
                                tc +
                                "</th>" +
                                "<th>" +
                                ad +
                                "</th>" +
                                "<th>" +
                                soyad+
                                "</th>" +
                                "<th>" +
                                d_tarih +
                                "</th>";

                            array.push(result);

                        }

                        $("#jojjoojj").html(array)
                    } else {
                        $.Toast.hideToast();
                        Swal.fire({
                            icon: 'error',
                            title: 'Bulunamadý!',
                            text: 'Girdiðiniz bilgiler ile eþleþen bir kiþi bulunamadý.',
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