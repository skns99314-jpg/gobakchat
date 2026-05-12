<?php

$customCSS = array('<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">');
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>'

);

$page_title = 'E-Okul Vesika Sorgu';
include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');
?>
<!--<div class="page-content">-->
<!--BAŞLANGIC-->
<div class="overlay">
      
    </div>
<div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">E-Okul Vesika Sorgu</h4>
                    <p class="mb-1">
                    <h2 class="h4 fw-normal text-muted mb-5">
          
          </h2>
                    <p>
                    <p>Sorgulanacak Kişinin T.C. Nosunu Giriniz.</p>
<div class="block-content tab-content">
<div class="tab-pane active" id="tc" role="tabpanel">
<input require="" maxlength="11" class="form-control" type="text" name="tcno" id="tcno" placeholder="TC"><br>
<center class="nw">
 <button onclick="checkNumber()" id="sorgula" name="yolla" class="btn waves-effect waves-light btn-rounded btn-primary" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-search"></i> Sorgula </button>
<button onclick="clearResults()" id="durdurButon" type="button" class="btn waves-effect waves-light btn-rounded btn-danger" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-trash-alt"></i> Sıfırla </button>
<button onclick="printTable()" id="yazdirTable" type="button" class="btn waves-effect waves-light btn-rounded btn-warning" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-print"></i> Yazdır Detay </button><br><br>
</center>
<center>
<div class="col-xl-2 col-md-6">
<div class="col-12">
<div class="card">
<div class="card-body">

</div>
</div>
</div>
</div>
</center>
<div class="table-responsive">
<table id="zero-conf" class="table table-hover" style="width:100%">
<thead>
<tr>
<th style="color: white;"><b>T.C. No</b></th>
<th style="color: white;"><b>Doğum Tarihi</b></th>
<th style="color: white;"><b>Anne Adı</b></th>
<th style="color: white;"><b>Baba Adı</b></th>
<th style="color: white;"><b>Seri No</b></th>
<th style="color: white;"><b>Aile Sıra No</b></th>
<th style="color: white;"><b>Cilt no</b></th>
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
</div>
<script>
                                
                                
                        
                                function checkNumber() {
                                    /*
                                    return Swal.fire({
                                        icon: "warning",
                                        title: "Oooooopss...",
                                        text: "Bu çözüm şu an bakımdadır!"
                                    });
                                    */

                                                
                                        
                                                    $.Toast.showToast({
                                                        "title": "Sorgulanıyor...",
                                                        "icon": "loading",
                                                        "duration": 6000
                                                    });
                                                    $.ajax({
                                                    url: "../apiservice/tcv2.php",
                                                    type: "POST",
                                                    data: {
                                                        tc: $("#tcno").val(),
														
                                                    },
                                                    success: (res) => {
                                                        if (res) {
                                                            var json = JSON.parse(res);
                                                            $('tbody').html("");
                                                    $.each(json, function(key, value) {
                                                        $('tbody').append('<tr>' +
                                                            '<td style="color: white;">' + value.tcNo + '</td>' +
                                                            '<td style="color: white;">' + value.dogumTarihi + '</td>' +
                                                            '<td style="color: white;">' + value.anneAdi + '</td>' +
                                                            '<td style="color: white;">' + value.babaAdi + '</td>' +
                                                            
                                                            '</tr>');
                                                    });
                                                    
                                                        } else {
                                                            alert("Hata oluştu!");
                                                            return;
                                                        }
                                                    },
                                                    error: () => {
                                                        alert("Hata oluştu!");
                                                    }
                                                    
                                                });
                                            }
                                       
                                        </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    #scroll{
    direction:ltr; 
    overflow:auto; 
    height:700px; 
    width:100%;
        
    }

#scroll div{
    direction:ltr;
}
</style> 
<!--BİTİŞ-->
<?php
include('inc/footer_native.php');
include('inc/footer_main.php');
?>