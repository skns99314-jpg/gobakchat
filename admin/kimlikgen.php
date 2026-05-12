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

$page_title = 'Kimlik Gen';
include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');
?>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Türkiye Kimlik Kartı Oluşturucu</title>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&amp;display=swap" rel="stylesheet">

<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(75617293, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/75617293" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</head>
<body>

    <div class="container">


        <div class="card text-white bg-primary rounded shadow mt-4">
            <div class="card-body">
                <form action="#" class="row" id="form">
                    <div class="col-lg-6">
                        <div>İsim:</div>
                        <input class="form-control d-block mt-2 shadow" name="name"
                            placeholder="Kimlik üzerinde yazacak ismi girin." required>
                    </div>
                    <div class="col-lg-6 mt-3 mt-lg-0">
                        <div>Soyisim:</div>
                        <input class="form-control d-block mt-2 shadow" name="surname"
                            placeholder="Kimlik üzerinde yazacak soyismi girin." required>
                    </div>
                    <div class="col-lg-6 mt-3">
                        <div>Doğum Tarihi:</div>
                        <input class="form-control d-block mt-2 shadow" name="birth_date" type="date" required>
                    </div>
                    <div class="col-lg-6 mt-3">
                        <div>Cinsiyet:</div>
                        <select name="gender" class="form-control d-block mt-2 shadow">
                            <option value="E / M" option>Erkek</option>
                            <option value="K / F">Kadın</option>
                        </select>
                    </div>
                    <div class="col-lg-6 mt-3">
                        <div>T.C. Kimlik No:</div>
                        <input class="form-control d-block mt-2 shadow" name="tckn"
                            placeholder="Kimlik üzerinde yazacak TC numarasını girin." required>
                    </div>
                    <div class="col-lg-6 mt-3">
                        <div>Seri No:</div>
                        <input class="form-control d-block mt-2 shadow" name="document_number"
                            placeholder="Kimlik üzerinde yazacak seri numarasını girin." required>
                    </div>
                    <div class="col-lg-6 mt-3">
                        <div>Son Geçerlilik Tarihi:</div>
                        <input class="form-control d-block mt-2 shadow" name="valid_until" type="date" required>
                    </div>
                    <div class="col-lg-6 mt-3">
                        <div>Uyruk:</div>
                        <input class="form-control d-block mt-2 shadow" value="T.C./TUR" readonly>
                    </div>
                    <div class="col-lg-6 mt-3">
                        <div>Anne İsmi:</div>
                        <input class="form-control d-block mt-2 shadow" name="mother_name"
                            placeholder="Kimlik üzerinde yazacak anne ismini girin." required>
                    </div>
                    <div class="col-lg-6 mt-3">
                        <div>Baba Adı:</div>
                        <input class="form-control d-block mt-2 shadow" name="father_name"
                            placeholder="Kimlik üzerinde yazacak baba ismini girin." required>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <div>Kimlik Fotoğrafı:</div>
                        <input class="form-control d-block mt-2 shadow" type="file" name="image" accept="image/*"
                            required>
                    </div>
                    <div class="col-lg-12 mt-4 d-flex">
                        <div class="flex-grow-1">
                            <button type="submit" class="btn btn-primary shadow">Kimlik Oluştur</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card text-white bg-primary rounded shadow my-4">
            <div class="card-body">
                <div class="row">
                    <div class="h4 mb-2">Oluşturulan Kimlik Görselleri</div>
                    <div class="text-one">Yukarıdaki form aracılığı ile kimlik oluşturduğunuzda burada gözükecektir.
                    </div>
                    <div class="text-two d-none">Oluşturulan kimlik görselleri aşağıda gösterilmiştir. Butona tıklayarak
                        cihazınıza indirebilirsiniz.</div>
                    <div class="col-lg-6 mt-3">
                        <img src="../assets/img/front-empty.png" class="front-image mw-100">
                        <button class="btn btn-primary shadow mt-3" id="download-front" disabled>Görseli İndir</button>
                    </div>
                    <div class="col-lg-6 mt-3">
                        <img src="../assets/img/back-empty.png" class="back-image mw-100">
                        <button class="btn btn-primary shadow mt-3" id="download-back" disabled>Görseli İndir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="side-container">
        <div class="front">
            <img src="#" class="face">
            <img src="#" class="face-right">
            <div class="tckn"></div>
            <div class="name"></div>
            <div class="surname"></div>
            <div class="birth_date"></div>
            <div class="gender"></div>
            <div class="document_number"></div>
            <div class="valid_until"></div>
        </div>
        <div class="back">
            <div class="mother_name"></div>
            <div class="father_name"></div>
            <div class="mrz"></div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/domtoimage.min.js"></script>
    <script src="js/script.min.js"></script>
<!--BİTİŞ-->
<?php
include('inc/footer_main.php');
include('inc/footer_native.php');
?>
</body>
</html>