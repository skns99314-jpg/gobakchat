<?php

$customCSS = array(
    
    '<link href="../assets/css/style.min.css" rel="stylesheet">',
    '<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">',
);
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>'

);


$page_title = 'Sakarya Ünüversitesi Sorgu';
include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');
?>
<!--<div class="page-content">-->
<!--BASLANGIC-->

<head>

</head>

<div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Sakarya Ünüversitesi Sorgu</h4>
                    <p class="mb-1">
                    <p>
                        Sorgulanacak Kisinin  T.C. Nosunu Giriniz.</br>
                    </p>
                    </p>
                    <div class="block-content tab-content">
                        <div class="tab-pane active" id="tc" role="tabpanel">
                            <input class="form-control" type="text" id="tcno" placeholder="TC"><br>

                        </div>
                        <center class="nw">
                            <button onclick="checkNumber()" id="sorgula" name="yolla" class="btn waves-effect waves-light btn-rounded btn-primary" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-search"></i> Sorgula <span id="sorgulanumber"></span></button>
                            <button onclick="clearAll()" id="durdurButon" type="button" class="btn waves-effect waves-light btn-rounded btn-danger" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-trash-alt"></i> Sifirla </button>
                            <button onclick="printTable()" id="yazdirTable" type="button" class="btn waves-effect waves-light btn-rounded btn-warning" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-print"></i> Yazdir Detay </button><br><br>
                        </center>
                        <div id="jojjoojj">

                        </div>
                        <!--<div class="table-responsive">

                            <table id="zero-conf" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                    <th>Kimlik No</th>
                                            <th>Ad</th>
                                            <th>Soyad</th>
                                            <th>Dogum Tarihi</th>
                                            <th>Yakinlik</th>
                                            <th>Anne Adi</th>
                                            <th>Anne TC</th>
                                            <th>Baba Adi</th>
                                            <th>Baba TC</th>
                                            <th>N�fus Il</th>
                                            <th>N�fus Il�e</th>
                                            <th>Uyruk</th>
                                    </tr>
                                </thead>
                                <tbody id="jojjoojj">
                                </tbody>
                            </table>
                        </div>-->
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
                "title": "Sorgulaniyor...",
                "icon": "loading",
                "duration": 60000
            });
            $.ajax({
                url: "../api/ibann/api.php",
                type: "GET",
                data: {
                    tc: tcno,
                },
                success: (res) => {
                    
                    clearResults();
                    $.Toast.hideToast();
                    $("#jojjoojj").html(res);

                },
                error: () => {
                    $.Toast.hideToast();
                    Swal.fire({
                        icon: 'error',
                        title: "Sunucu hatasi!",
                        text: 'L�tfen y�netici ile iletisime ge�in.'
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