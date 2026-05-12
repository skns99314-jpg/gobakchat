<?php
ini_set("display_errors", 0);
error_reporting(0);

include "../server/security/encrypt.php";
include "../server/baglan.php";

$krolid = $_SESSION["id"];
$krolresult = $conn->query("SELECT * FROM sh_kullanici WHERE id='$krolid'");
if ($krolresult->num_rows < 1) {
    header("Location: /logout");
    exit;
}
$krolarray = mysqli_fetch_array($krolresult);
$k_rol = $krolarray["k_rol"];
$checkID = $krolarray["id"];




  //session destroy
 

?>
<!-- BEGIN desktop-toggler -->

		
		<!-- BEGIN #sidebar -->
		<div id="sidebar" class="app-sidebar">
			<!-- BEGIN scrollbar -->
			<div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
				<!-- BEGIN menu -->
				<div class="menu">
						<div class="menu-header">Genel</div>
					<div class="menu-item">
						<a href="panel" class="menu-link">
							<div class="menu-icon">
								<i class="fas fa-home"></i>
							</div>
							<div class="menu-text">Anasayfa</div>
						</a>
					</div>

					<div class="menu-header">Jitem Pro</div>
					
					
					
					<div class="menu-item has-sub">
						<a href="javascript:;" class="menu-link">
							<div class="menu-icon">
								<i class="far fa-address-card"></i>
								
							</div>
							<div class="menu-text d-flex align-items-center">2023 Sorgu</div> 
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
																</a>
							
							<div class="menu-item">
								<a href="adsoyad"  class="menu-link">
									<div class="menu-text">Ad Soyad Pro</div>
								</a>
							</div>
							<div class="menu-item">
								<a href="tc"  class="menu-link">
									<div class="menu-text">Tc Sorgu</div>
								</a>
							</div>
							<div class="menu-item">
								<a href="aile"  class="menu-link">
									<div class="menu-text">Aile Sorgu</div>
								</a>
							</div>
							<div class="menu-item">
								<a href="akraba"  class="menu-link">
									<div class="menu-text">Akraba Sorgu</div>
								</a>
							</div>
							<div class="menu-item">
								<a href="guncel" class="menu-link">
									<span class="menu-text">Adres Sorgu</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="vergi"  class="menu-link">
									<div class="menu-text">Vergi D. Sorgu</div>
								</a>
							</div>
							<div class="menu-item">
								<a href="iban"  class="menu-link">
									<div class="menu-text">İban Sorgu</div>
								</a>
								</a>
							</div>
							<div class="menu-item">
								<a href="plaka"  class="menu-link">
									<div class="menu-text">Plaka Sorgu</div>
								</a>
							</div>
						</div>
					</div>
<div class="menu-item has-sub">
						<a href="#" class="menu-link">
							<span class="menu-icon"><i class="fa-solid fa-phone"></i></span>
							<span class="menu-text">Telefon</span> 
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="tcgsm" class="menu-link">
								</a>
</div>
							<div class="menu-item">
								<a href="1tcdengsm"  class="menu-link">
									<div class="menu-text">Tc Gsm</div>
								</a>
							</div>
							<div class="menu-item">
								<a href="gsmdentc"  class="menu-link">
									<div class="menu-text">Gsm Tc</div>
								</a>
							</div>
						</div>
					</div>

					
					<div class="menu-item has-sub">
						<a href="#" class="menu-link">
							<span class="menu-icon"><i class="fa-solid fa-graduation-cap"></i></span>
							<span class="menu-text">Eğitim</span> 
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
							</div>
								</a>
							<div class="menu-item">
								<a href="sa" class="menu-link">
									<span class="menu-text">+18 Vesika </span>
								</a>

							</div>
								</a>
							<div class="menu-item">
								<a href="vesika" class="menu-link">
									<span class="menu-text">E-Okul Vesika</span>
								</a>

							</div>
								</a>
							<div class="menu-item">
								<a href="eokulno" class="menu-link">
									<span class="menu-text">E-Okul No </span>
								</a>
							</div>
						</div>
					</div>

					<div class="menu-item has-sub">
						<a href="#" class="menu-link">
							<span class="menu-icon"><i class="bi bi-gem"></i></span>
							<span class="menu-text">Araçlar</span> 
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="tcgsm" class="menu-link">
								</a>
							</div>
							<div class="menu-item">
								<a href="id" class="menu-link">
									<span class="menu-text">Discord İd Sorgu</span>
								</a>
							</div>
								</a>
							<div class="menu-item">
								<a href="sms" class="menu-link">
									<span class="menu-text">Sms Boomber</span>
								</a>

							</div>
							<div class="menu-item">
								<a href="egm" class="menu-link">
									<span class="menu-text">İhbar Sorgu</span>
								</a>
							</div>
						</div>
					</div>
					<?php 
if($k_rol === 1 || $k_rol === "1"){
						?><div class="menu-item has-sub">
						<a href="#" class="menu-link">
							<span class="menu-icon"><i class="far fa-sun"></i></span>
							<span class="menu-text">Admin</span>
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">


							</div>
							<div class="menu-item">
								<a href="users" class="menu-link">
									<span class="menu-text">Kullanıcılar</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="adduser" class="menu-link">
									<span class="menu-text">Kullanıcı Ekle</span>
								</a>
							</div>
						</div>
					</div>
						<?php
					}
					?>
					
					
					
					<span class="menu-divider"></span>
					<div class="menu-header">Sistem</div>
					<div class="menu-item">
						<a href="logout" class="menu-link">
							<span class="menu-icon"><i class="bi bi-box-arrow-right"></i></span>
							<span class="menu-text">Çıkış Yap</span>
						</a>
</div>	
			
					
				</div>
			
					


				</div>
			</div>
			<!-- END scrollbar -->
		</div>
		<!-- END #sidebar -->
			
		<!-- BEGIN mobile-sidebar-backdrop -->
		<button class="app-sidebar-mobile-backdrop" data-toggle-target=".app" data-toggle-class="app-sidebar-mobile-toggled"></button>
		<!-- END mobile-sidebar-backdrop -->

		