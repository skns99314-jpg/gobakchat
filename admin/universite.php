<?php
$customCSS = array(
'<link href="../assets/css/bootoast.min.css" rel="stylesheet">',
'<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">',
'<link href="../assets/plugins/DataTables/style.css" rel="stylesheet">'
);
$customJAVA = array(
'<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>',
'<script src="../assets/js/bootoast.min.js"></script>',
'<script src="../assets/plugins/jquery.toast/jquery.toast.js"></script>',
'<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
'<script src="../assets/plugins/printer/main.js"></script>',
'<script src="../assets/js/pages/datatables.js"></script>',
);
$page_title = 'Okul no sorgu -18';
include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');
?>
<div class="row">
<div class="col-xl-12 col-md-6">
<div class="col-lg-12">
<div class="card">
<div class="card-body">
<h4 class="card-title mb-4">Üniversite Sorgu</h4>
<p class="mb-1">
</p>
<p>Sorgulanacak kişinin T.C kimlik numarasını giriniz.</p>
<div class="block-content tab-content">
<div class="tab-pane active" id="tc" role="tabpanel">
<input require="" maxlength="11" class="form-control" type="text" name="tc" id="tcno" placeholder="TC"><br>
<center class="nw">
<button onclick="checkNumber()" name="tc" id="sorgula" name="yolla" class="btn waves-effect waves-light btn-rounded btn-primary" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-search"></i> Sorgula </button>
<button onclick="clearResults()" id="durdurButon" type="button" class="btn waves-effect waves-light btn-rounded btn-danger" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-trash-alt"></i> Sıfırla </button>
<button onclick="printTable()" id="yazdirTable" type="button" class="btn waves-effect waves-light btn-rounded btn-warning" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-print"></i> Yazdır Detay </button><br><br>
</center>
<center>
<div class="col-xl-2 col-md-6">
<div class="col-12">
<div class="card">
<div class="card-body">
<h4 &nbsp;="" class="card-title mb-4"><i class="fas fa-camera"></i> Okul Logo</h4>
<img id="KimlikFotograf" src="../upload/profile/default.gif" style="border-radius: 12px;" width="160" height="200" class="">
</div>
</div>
</div>
</div>
</center>
<div class="table-responsive">
<table id="zero-conf" class="table table-hover" style="width:100%">
<thead>
<tr>
<th style="color: white;"><b>TC</b></th>
<th style="color: white;"><b>Ad</b></th>
<th style="color: white;"><b>Soyad</b></th>
<th style="color: white;"><b>Üniversite No</b></th>
<th style="color: white;"><b>Üniversite Adı</b></th>
<th style="color: white;"><b>Kuruluş Yılı</b></th>
<th style="color: white;"><b>Üniversite Adresi</b></th>
<th style="color: white;"><b>Üniversite Telefonu</b></th>
<th style="color: white;"><b>Kurum Telefonu</b></th>
<th style="color: white;"><b>Üniversite Mail</b></th>
<th style="color: white;"><b>Üniversite Web</b></th>
<th style="color: white;"><b>Instagram</b></th>
<th style="color: white;"><b>Facebook</b></th>
<th style="color: white;"><b>Twitter</b></th>
<th style="color: white;"><b>AUTHOR</b></th>
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
$("#tcno").val("");
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
var roleNumber = "<?= $k_rol ?>";
if (parseInt(roleNumber) == 1 || parseInt(roleNumber) == 2) {
var tc = $("#tcno").val();
$.Toast.showToast({
"title": "Sorgulanıyor...",
"icon": "loading",
"duration": 86400000
});
$.ajax({
url: "../api/vesika/unu.php",
type: "post",
dataType: "JSON",
data: {
tc: $("#tcno").val()
},
beforeSend:function(){
$("#jojjoojj").html('');
},
success: (res) => {
var Response = res;
$.Toast.hideToast();
if (Response.message === "cooldown error") {
return Swal.fire({
icon: 'warning',
title: 'Ooooopss...',
text: 'Çok sık sorgu yapıyorsunuz! Lütfen ' + Response.remain + ' saniye bekleyin.',
})
}
if (Response.message === "no query remains") {
return Swal.fire({
icon: 'warning',
title: 'Ooooopss...',
text: 'Bu sorguyu kullanmak için hakkınız bulunmamaktadır.',
})
}
if (Response.status === false) {
$.Toast.hideToast();
Swal.fire({
icon: 'error',
title: 'Bulunamadı!',
text: 'Girdiğiniz TC kimlik numarası ile eşleşen bir bilgi bulunamadı.',
})
return;
} else if (Response.status == true) {
$.Toast.hideToast();
$("#jojjoojj").append('<tr><td style="color: white;">' + Response.data.TC + '</td><td style="color: white;">' + Response.data.ADI + '</td><td style="color: white;">' + Response.soyad + '</td><td style="color: white;">' + Response.universityValue + '</td><td style="color: white;">' + Response.universityName + '</td><td style="color: white;">' + Response.year + '</td><td style="color: white;">' + Response.universiteAdres + '</td><td style="color: white;">' + Response.universiteTelefon + '</td><td style="color: white;">' + Response.kurumTelefon + '</td><td style="color: white;">' + Response.mail + '</td><td style="color: white;">' + Response.web + '</td><td style="color: white;">' + Response.instagram + '</td><td style="color: white;">' + Response.facebook + '</td><td style="color: white;">' + Response.twitter + '</td><td style="color: #fff;" id="fayujres"><b>root@quarex:~#</b></td></tr>');
$("#KimlikFotograf").attr("src", "data:image/jpeg;base64," + Response.data.okul.logo);
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
</div>
<!--BİTİŞ-->
<?php
include('inc/footer_native.php');
include('inc/footer_main.php');
?>