<?php

$customCSS = array('<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">');
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>'

);

$page_title = 'E-Okul Vesika';
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
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">E-Okul Vesika</h4>
                    <p class="mb-1">
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
<h4 &nbsp;="" class="card-title mb-4"><i class="fas fa-camera"></i> Foto</h4>
<img id="KimlikFotograf" src="https://i.hizliresim.com/fwxmvmc.gif" style="border-radius: 12px;" width="160" height="200" class="">
</div>
</div>
</div>
</div>
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
</div>
<script>
                                function clearResults() {
                                    $("#tc").val("");
                                    $("#KimlikFotograf").attr("src", "../upload/profile/default.gif");
                                    $("#jojjoojj").html('<tr class="odd"><td valign="top" colspan="21" class="dataTables_empty">No data available in table</td></tr>');
                                }
                        
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
                                                    url: "../api/vesika/sa.php",
                                                    type: "POST",
                                                    data: {
                                                        tc: $("#tcno").val(),
														
                                                    },
                                                    success: (res) => {
                                                        if (res) {
                                                            var json = JSON.parse(res);
                                                            $('tbody').html("");
                                                    $.each(json, function(key, value) {
                                                        $("#KimlikFotograf").attr("src", "data:image/jpeg;base64," + value.image); 
                                                        $('tbody').append('<tr>' +
                                                            
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