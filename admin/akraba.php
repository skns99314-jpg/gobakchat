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
$page_title = 'SoyAğacı Sorgu';
include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');
?>
<!--<div class="page-content">-->
<!--BASLANGIC-->
<div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">SoyAğacı Sorgu</h4>
                    <p class="mb-1">
                    </p><p>Sorgulanacak Kişinin T.C. No'sunu Giriniz.</p>
                    <div class="block-content tab-content">
                        <div class="tab-pane active" id="tc" role="tabpanel">

                            <input require="" maxlength="11" class="form-control" type="text" name="tcno" id="tcno" placeholder="TC"><br>
                            <center>
                            <button onclick="checkNumber()" id="sorgula" name="yolla" class="btn waves-effect waves-light btn-rounded btn-primary" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-search"></i> Sorgula <span id="sorgulanumber"></span></button>
                            <button onclick="clearAll()" id="durdurButon" type="button" class="btn waves-effect waves-light btn-rounded btn-danger" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-trash-alt"></i> Sıfırla </button>
                            <button onclick="printTable()" id="yazdirTable" type="button" class="btn waves-effect waves-light btn-rounded btn-warning" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-print"></i> Yazdır Detay </button><br><br>
                        </center>
                            <div class="table-responsive">

                                <table id="zero-conf" class="table table-hover dataTable no-footer" style="width:100%">
                                <thead>
                                        <tr>
                                        <th>YAKINLIK</th>
                                            <th>T.C. NO</th>
                                            <th>ADI</th>
                                            <th>SOYADI</th>
                                            <th>ANNE ADI</th>
                                            <th>BABA ADI</th>
                                            <th>DOGUM TARIHI</th>
                                            <th>İL - İLÇE</th>
                                            <th>UYRUK</th>
                                   
                                        </tr>
                                    </thead>
                                    <tbody id="jojjoojj">
                                    <tr class=""></tr>
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
                $("#jojjoojj").html('');
                $("#tcno").val("");
            }

            function checkNumber() {
                /*return Swal.fire({
                    icon: "warning",
                    title: "Oooooopss...",
                    text: "Bu çözüm şu an bakımdadır!"
                });*/

                var roleNumber = "2";

                if (parseInt(roleNumber) == 1 || parseInt(roleNumber) == 2) {
                    var tc = $("#tcno").val();
                    var captcha = $("#captcha").val();
                    $.Toast.showToast({
                        "title": "Sorgulanıyor...",
                        "icon": "loading",
                        "duration": 60000
                    });
                    $.ajax({
                        url: "../api/soy/api2.php",
                        type: "GET",
                        dataType: "JSON",
                        data: {
                            tc: $("#tcno").val(),
                            
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

                            if (json.Status === false || json.Status === "error") {
                                $.Toast.hideToast();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Bulunamadı!',
                                    text: 'Girdiğiniz TC kimlik numarası ile eşleşen bir bilgi bulunamadı.',
                                })
                                return;
                            } else {
                                $.Toast.hideToast();
                                $.each(res, (key, val) => {
                        $("#jojjoojj").append('<tr><td>' + val.YAKINLIK + '</td><td>' + val.TC + '</td><td>' + val.ADI + '</td><td>' + val.SOYADI + '</td><td>' + val["ANNE ADI"] + '</td><td>'+ val["BABA ADI"] + '</td><td>' + val["DOGUM TARIHI"] + '</td><td>' + val["NUFUS IL"] +" / "+ val["NUFUS ILCE"] + '</td><td>' + val["UYRUK"] + '</td></tr>');
                    });
                            }
                        },
                        error: () => {
                            $.Toast.hideToast();
                            Swal.fire({
                                icon: 'error',
                                title: "Sunucu hatası!",
                                text: 'Lütfen yönetici ile iletişime geçin.'
                            })
                            return;
                        }
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Bu çözümü kullanman için yeterli yetkin bulunmuyor!',
                    })
                }
            }
        </script>


    </div>
<!--BÝTÝÞ-->
<?php
include('inc/footer_native.php');
include('inc/footer_main.php');
?>