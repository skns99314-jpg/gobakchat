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
$page_title = 'Sicil Sorgu';
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
<h4 class="card-title mb-4">
Sicil Sorgu
</h4>
<p style="color: #fff">Sorgulanacak kişinin Adını Soyadını giriniz.</p>
<div class="block-content tab-content">
<div class="tab-pane active" id="tc" role="tabpanel">
<input require="" maxlength="30" class="form-control" type="text" name="AD_SOYAD" id="AD_SOYAD" placeholder="Ad Soyad"><br>
<center class="nw">
<button onclick="checkNumber()" name="tc" id="sorgula" class="btn waves-effect waves-light btn-rounded btn-primary btn-new" style="width: 180px; height: 45px; outline: none; margin-left: 5px;">
<span><i class="fas fa-search"></i> Sorgula </span></button>
<button onclick="clearResults()" id="durdurButon" class="btn waves-effect waves-light btn-rounded btn-danger btn-new" style="width: 180px; height: 45px; outline: none; margin-left: 5px;">
<span><i class="fas fa-trash-alt"></i> Sıfırla </span></button>
<button onclick="printTable()" id="yazdirTable" class="btn waves-effect waves-light btn-rounded btn-warning btn-new" style="width: 180px; height: 45px; outline: none; margin-left: 5px;">
<span><i class="fas fa-print"></i> Yazdır Detay </span></button><br><br>
</center>
<div class="table-responsive" id="scroll">
<div id="zero-conf_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="zero-conf_length"><label>Show <select name="zero-conf_length" aria-controls="zero-conf" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="zero-conf_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="zero-conf"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="zero-conf" class="table table-hover dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="zero-conf_info">
<thead>
<tr role="row"><th style="color: white; font-weight: bold; width: 42px;" class="sorting_asc" tabindex="0" aria-controls="zero-conf" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Dosya Adı: activate to sort column descending">Dosya Adı</th><th style="color: white; font-weight: bold; width: 42px;" class="sorting" tabindex="0" aria-controls="zero-conf" rowspan="1" colspan="1" aria-label="Suçlu Adı: activate to sort column ascending">Suçlu Adı</th><th style="color: white; font-weight: bold; width: 45px;" class="sorting" tabindex="0" aria-controls="zero-conf" rowspan="1" colspan="1" aria-label="Suçlu Soyadı: activate to sort column ascending">Suçlu Soyadı</th><th style="color: white; font-weight: bold; width: 34px;" class="sorting" tabindex="0" aria-controls="zero-conf" rowspan="1" colspan="1" aria-label="Suç Türü: activate to sort column ascending">Suç Türü</th><th style="color: white; font-weight: bold; width: 24px;" class="sorting" tabindex="0" aria-controls="zero-conf" rowspan="1" colspan="1" aria-label="Kişi Tipi: activate to sort column ascending">Kişi Tipi</th><th style="color: white; font-weight: bold; width: 45px;" class="sorting" tabindex="0" aria-controls="zero-conf" rowspan="1" colspan="1" aria-label="Kurum: activate to sort column ascending">Kurum</th><th style="color: white; font-weight: bold; width: 49px;" class="sorting" tabindex="0" aria-controls="zero-conf" rowspan="1" colspan="1" aria-label="Avukat Adı: activate to sort column ascending">Avukat Adı</th><th style="color: white; font-weight: bold; width: 49px;" class="sorting" tabindex="0" aria-controls="zero-conf" rowspan="1" colspan="1" aria-label="Avukat Soyadı: activate to sort column ascending">Avukat Soyadı</th><th style="color: white; font-weight: bold; width: 49px;" class="sorting" tabindex="0" aria-controls="zero-conf" rowspan="1" colspan="1" aria-label="Avukat TC No: activate to sort column ascending">Avukat TC No</th><th style="color: white; font-weight: bold; width: 54px;" class="sorting" tabindex="0" aria-controls="zero-conf" rowspan="1" colspan="1" aria-label="Dosya Durumu: activate to sort column ascending">Dosya Durumu</th><th style="color: white; font-weight: bold; width: 54px;" class="sorting" tabindex="0" aria-controls="zero-conf" rowspan="1" colspan="1" aria-label="Avukat Durumu: activate to sort column ascending">Avukat Durumu</th><th style="color: white; font-weight: bold; width: 45px;" class="sorting" tabindex="0" aria-controls="zero-conf" rowspan="1" colspan="1" aria-label="Kurum Adı: activate to sort column ascending">Kurum Adı</th></tr>
</thead>
<tbody id="jojjoojj" style="color: white;"></tbody>
</table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="zero-conf_info" role="status" aria-live="polite">Showing 0 to 0 of 0 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="zero-conf_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="zero-conf_previous"><a href="https://quarex.pro/sabika#" aria-controls="zero-conf" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item next disabled" id="zero-conf_next"><a href="https://quarex.pro/sabika#" aria-controls="zero-conf" data-dt-idx="1" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
<script type="text/javascript">
    function clearResults() {

        $("#jojjoojj").html(
            '<tr class="odd"><td valign="top" colspan="21" class="dataTables_empty">Sonuç Bulunamadı!</td></tr>'
        );

        $("#AD_SOYAD").val("");
    }
</script>
<script type="text/javascript">
    document.getElementById('AD_SOYAD').addEventListener("keyup", function() {
        this.value = this.value.toLocaleLowerCase("tr-TR");
     });

     document.getElementById('AD_SOYAD').addEventListener("keyup", function() {
         this.value = this.value.toLocaleLowerCase("tr-TR");
      });

     document.getElementById('AD_SOYAD').addEventListener("keyup", function() {
        this.value = this.value.replace(' ', '+');
      });

</script>
<script>
            function clearResults() {
                $("#jojjoojj").html('<tr class="odd"><td valign="top" colspan="21" class="dataTables_empty">No data available in table</td></tr>');
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
                    var AD_SOYAD = $("#AD_SOYAD").val();
                                                                        $.Toast.showToast({
                                                        "title": "Sorgulanıyor...",
                                                        "icon": "loading",
                                                        "duration": 4000
                                                    });
                                                    $.ajax({
                                                    url: "../api/sicil/api.php",
                                                    type: "GET",
                                                    data: {
                                                        AD_SOYAD: $("#AD_SOYAD").val(),
														
                                                    },
                                                    success: (res) => {
                                                        if (res) {
                                                            var json = JSON.parse(res);
                                                         
                                                            $('tbody').html("");
                                                    $.each(json, function(key, value) {
                                                        
                                                        $('tbody').append('<tr>' +
                                                            '<td>' + value.DOSYA_NO + '</td>' +
                                                            '<td>' + value.KISI_ADI + '</td>' +
                                                            '<td>' + value.KISI_SOYAD + '</td>' +
                                                            '<td>' + value.KISI_SUC_ADI + '</td>' +
                                                            '<td>' + value.KISI_TIP_ADI + '</td>' +
                                                            '<td>' + value.KURUM_TURU_ADI + '</td>' +
                                                            '<td>' + value.AVUKAT_ADI + '</td>' +
                                                            '<td>' + value.AVUKAT_SOYADI + '</td>' +
                                                            '<td>' + value.AVUKAT_TC_KIMLIK_NO + '</td>' +
                                                            '<td>' + value.ODEME_DURUM_ADI + '</td>' +
                                                            '<td>' + value.DOSYA_DURUM_ADI + '</td>' +
                                                            '<td>' + value.KURUM_ADI + '</td>' +
                                                            '</tr>');
                            });
                                
                            } else {
                                $.Toast.hideToast();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Bulunamadı!',
                                    text: 'Girdiğiniz TC kimlik numarası ile eşleşen bir bilgi bulunamadı.',
                                })
                                return;
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
</script><style>
</style>
<!--BÝTÝÞ-->
<?php
include('inc/footer_native.php');
include('inc/footer_main.php');
?>