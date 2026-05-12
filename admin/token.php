<?php
include_once "../server/rolecontrol.php";

$customCSS = array();
$customJAVA = array();

$page_title = 'Discord Token';
include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');
?>
<!--BAŞLANGIC-->
<div class="card-body">
    <div class="md-form">
        <div class="col-md-12">
            <center>
                <div class="md-form">
                    <h4 class="card-title mb-4"><i class="fas fa-user-circle"></i> Sky Discord TOKEN Checker</h4>
                    <p>Bu bölümden Tokenlerinizi kolaylıkla checkleyebilirsiniz!</p>
                    <textarea type="text" style="text-align: center; background-color: rgba(255, 255, 255, .1); color: black;" placeholder="Hesaplarınızı buraya giriniz." id="lista" class="md-textarea form-control" rows="4"></textarea>
                    <div class="mb-3 mt-3"><label class="form-label"></label>
                        <button id="testar" onclick="enviar()" type="button" class="btn waves-effect waves-light btn-rounded btn-primary" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-play"></i> Başlat</button>
                        <button id="stoper" type="button" class="btn waves-effect waves-light btn-rounded btn-danger" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-stop"></i> Durdur</button>
                        <button id="temizleButon" type="button" class="btn waves-effect waves-light btn-rounded btn-warning" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-trash-alt"></i> Temizle</button>
                    </div>
                </div>
        </div>
        </center>
    </div>

    <div class="card-body" style="text-align: center;">
        <div class="alert alert-success" role="alert">AKTIF TOKEN <span id="cCharge2"></span></h6>
        </div>
        <div id="bode1"><span id=".aprovadas" class="aprovadas"></span>
        </div>
        <div class="alert alert-danger" role="alert">KAPALI TOKEN <span id="cDie2"></span></h6>
        </div>
        <div id="bode2"><span id=".reprovadas" class="reprovadas"></span>
        </div>
    </div>
</div>
</div>

<script>
    function enviar() {
        var roleNumber = "<?= $k_rol ?>";
        if (parseInt(roleNumber) == 1 || parseInt(roleNumber) == 2) {
            var linha = $("#lista").val();
            var linhaenviar = linha.split("\n");
            var total = linhaenviar.length;
            var ap = 0;
            var ed = 0;
            var rp = 0;
            linhaenviar.forEach(function(value, index) {
                if (value !== "") {
                    var url = 'https://discord.com/api/v9/users/@me';
                    setTimeout(
                        function() {
                            $.ajax({
                                url: '../api/discord/api.php?lista=' + value,
                                type: 'GET',
                                async: true,
                                success: function(resultado) {
                                    if (resultado === "başarılı") {
                                        removelinha();
                                        ap++;
                                        aprovadas(value + "");
                                    } else {
                                        removelinha();
                                        rp++;
                                        reprovadas(value + "");
                                    }
                                    $('#carregadas').html(total);
                                    var fila = parseInt(ap) + parseInt(ed) + parseInt(rp);
                                    $('#cCharge2').html(ap);
                                    $('#cWarn').html(ed);
                                    $('#cDie').html(rp);
                                    $('#total').html(fila);
                                    $('#cCharge2').html(ap);
                                    $('#cWarn2').html(ed);
                                    $('#cDie2').html(rp);
                                }
                            });
                        }, 500 * index);
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Bu çözümü kullanman için yeterli yetkin bulunmuyor!',
            })
        }
    }

    function aprovadas(str) {
        $(".aprovadas").append(str + "<br>");
    }

    function reprovadas(str) {
        $(".reprovadas").append(str + "<br>");
    }

    function edrovadas(str) {
        $(".edrovadas").append(str + "<br>");
    }

    function removelinha() {
        var lines = $("#lista").val().split('\n');
        lines.splice(0, 1);
        $("#lista").val(lines.join("\n"));
    }

    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }
</script>
<br>
<!--BİTİŞ-->
<?php
include('inc/footer_native.php');
include('inc/footer_main.php');
?>