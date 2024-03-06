<?php include "./inc/koneksi.php";
$a = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_toko"));
$background = $a['background'];
$headerfooter = $a['headerfooter'];
$tombol = $a['tombol'];
$logo = $a['logo'];
$toko = $a['nm_toko'];
?>

<?php
//start session
session_start();
require_once './inc/config.php';

if (isset($_GET['code'])) {
	$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
	$client->setAccessToken($token);

	// getting user profile
	$gauth = new Google_Service_Oauth2($client);
	$google_info = $gauth->userinfo->get();

	$_SESSION['info'] = [
		'name' => $google_info->name,
		'email' => $google_info->email,
		'picture' => $google_info->picture
	];
	header('Location: /p/aut/google-login/login_google.php');
}
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<title>.:SANTRIGO:.</title>
	<link rel="apple-touch-icon" href="images/ico/apple-icon-120.png">
	<link rel="shortcut icon" type="image/x-icon" href="images/ico/favicon.ico">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
	<!-- <link rel="shortcut icon" type="image/x-icon" href="w/logo.png"> -->

	<!-- <link rel="shortcut icon" type="image/x-icon" href="../img/<?php echo $logo; ?>"> -->
	<!-- <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/vendors.min.css"> -->

	<link href="app-assets/font/css/fontawesome.min.css" rel="stylesheet" type="text/css">
	<link href="app-assets/font/css/all.min.css" rel="stylesheet" type="text/css">

	<!-- BEGIN: Vendor CSS-->
	<link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
	<!-- END: Vendor CSS-->

	<!-- BEGIN: Theme CSS-->
	<link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.css">
	<link rel="stylesheet" type="text/css" href="app-assets/css/colors.css">
	<link rel="stylesheet" type="text/css" href="app-assets/css/components.css">
	<link rel="stylesheet" type="text/css" href="app-assets/css/themes/dark-layout.css">
	<link rel="stylesheet" type="text/css" href="app-assets/css/themes/semi-dark-layout.css">

	<!-- BEGIN: Page CSS-->
	<link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/horizontal-menu.css">
	<link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
	<link rel="stylesheet" type="text/css" href="app-assets/css/pages/authentication.css">
	<link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/select/select2.min.css">
	<!-- END: Page CSS-->

	<!-- BEGIN: Custom CSS-->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body
	class="horizontal-layout horizontal-menu 1-column  navbar-floating footer-static bg-full-screen-image  blank-page blank-page"
	data-open="hover" data-menu="horizontal-menu" data-col="1-column"
	style="background-image: url('images/backgrounds/bg.jpg');background-repeat: no-repeat;background-attachment: fixed;background-position: center; ">
	<!-- BEGIN: Content-->
	<div class="app-content content pb-5">
		<div class="content-overlay"></div>
		<div class="header-navbar-shadow"></div>
		<div class="content-wrapper">
			<div class="content-header row">
			</div>
			<div class="content-body m-0">
				<section class="row flexbox-container">
					<div class="col-xl-7 col-10 justify-content-center d-flex">
						<div class="card bg-white rounded-0 mb-0 w-100">
							<div class="row m-0">
								<div class="col-lg-12 col-12 p-0">
									<div class="card rounded-0 mb-0 p-1">
										<div class="divider mt-1">
											<div class="divider-text mb-1">
												<h3 class="text-uppercase text-info border-info p-1">Daftar Kurir
												</h3>
											</div>
										</div>

										<div class="card-body pt-0">
											<form action="./aut/google-login/add_kurir_baru.php" method="POST"
												enctype="multipart/form-data">
												<input type="hidden" name="lat_kurir" id="lat_kurir"
													class="form-control" readonly>
												<input type="hidden" name="lon_kurir" id="lon_kurir"
													class="form-control" readonly>
												<fieldset
													class="form-label-group form-group position-relative has-icon-left">
													<input type="text" class="form-control" name="nama"
														placeholder="Nama" required>
													<div class="form-control-position">
														<i class="feather icon-user"></i>
													</div>
													<label for="user-name">Nama</label>
												</fieldset>

												<fieldset
													class="form-label-group form-group position-relative has-icon-left">
													<input type="email" class="form-control" name="email"
														placeholder="Email" required>
													<div class="form-control-position">
														<i class="feather icon-mail"></i>
													</div>
													<label for="user-name">Email</label>
												</fieldset>

												<fieldset class="form-label-group position-relative has-icon-left">
													<input type="password" class="form-control" name="pass"
														placeholder="Password" required>
													<div class="form-control-position">
														<i class="feather icon-lock"></i>
													</div>
													<label for="user-password">Password</label>
												</fieldset>

												<fieldset class="form-label-group position-relative has-icon-left">
													<input type="password" class="form-control" name="pass1"
														placeholder="Ketik Ulang Password" required>
													<div class="form-control-position">
														<i class="feather icon-lock"></i>
													</div>
													<label for="user-password">Ketik Ulang Password</label>
												</fieldset>

												<fieldset
													class="form-label-group form-group position-relative has-icon-left">
													<input type="number" class="form-control" name="no_tlv"
														placeholder="No. HP (Yang masih aktif)" required>
													<div class="form-control-position">
														<i class="feather icon-phone"></i>
													</div>
													<label for="user-name">No. HP (Yang masih aktif)</label>
												</fieldset>

												<fieldset
													class="form-label-group form-group position-relative has-icon-left">
													<input type="text" class="form-control" name="alamat"
														placeholder="Alamat Lengkap" required>
													<div class="form-control-position">
														<i class="feather icon-home"></i>
													</div>
													<label for="user-name">Alamat Lengkap</label>
												</fieldset>

												<p class="font-small-2 nama-user text-bold-700 text-danger text-right">
													<i>Documen yang di upload berupa file gambar (.jpg/.jpeg) max.
														1Mb.</i>
												</p>

												<fieldset
													class="form-label-group form-group position-relative has-icon-left">
													<div class="custom-file">
														<input type="file" class="custom-file-input" name="image_ktp"
															id="image_ktp" required>
														<label class="custom-file-label pl-3" for="image_ktp">Upload
															KTP</label>
													</div>
													<div class="form-control-position">
														<i class="feather icon-image"></i>
													</div>
												</fieldset>

												<fieldset
													class="form-label-group form-group position-relative has-icon-left">
													<div class="custom-file">
														<input type="file" class="custom-file-input" name="image_sim"
															id="image_sim" required>
														<label class="custom-file-label pl-3" for="image_sim">Upload
															SIM</label>
													</div>
													<div class="form-control-position">
														<i class="feather icon-image"></i>
													</div>
												</fieldset>

												<h6 class="">Data Kendaraan</h6>
												<hr>

												<fieldset
													class="form-label-group form-group position-relative has-icon-left">
													<input type="text" class="form-control" name="sepeda_motor"
														placeholder="Merk / Type Sepeda Motor" required>
													<div class="form-control-position">
														<i class="fas fa-motorcycle"></i>
													</div>
													<label for="user-name">Merk / Type Sepeda Motor</label>
												</fieldset>

												<fieldset
													class="form-label-group form-group position-relative has-icon-left">
													<input type="number" class="form-control" name="sepeda_motor_tahun"
														placeholder="Tahun" required>
													<div class="form-control-position">
														<i class="feather icon-calendar"></i>
													</div>
													<label for="user-name">Tahun</label>
												</fieldset>

												<fieldset
													class="form-label-group form-group position-relative has-icon-left">
													<input type="text" class="form-control" name="nomor_polisi"
														placeholder="Nomor Polisi" required>
													<div class="form-control-position">
														<i class="fas fa-window-maximize"></i>
													</div>
													<label for="user-name">Nomor Polisi</label>
												</fieldset>

												<fieldset
													class="form-label-group form-group position-relative has-icon-left">
													<input type="text" class="form-control" name="nm_bank"
														placeholder="Nama Bank" required>
													<div class="form-control-position">
														<i class="fas fa-window-maximize"></i>
													</div>
													<label for="user-name">Nama Bank</label>
												</fieldset>

												<fieldset
													class="form-label-group form-group position-relative has-icon-left">
													<input type="text" class="form-control" name="an_bank"
														placeholder="Atas Nama Bank" required>
													<div class="form-control-position">
														<i class="fas fa-window-maximize"></i>
													</div>
													<label for="user-name">Atas Nama Bank</label>
												</fieldset>

												<fieldset
													class="form-label-group form-group position-relative has-icon-left">
													<input type="text" class="form-control" name="nomor_rekening"
														placeholder="Nomor Rekening" required>
													<div class="form-control-position">
														<i class="fas fa-window-maximize"></i>
													</div>
													<label for="user-name">Nomor Rekening</label>
												</fieldset>

												<div class="form-group row">
													<div class="col-12">
														<fieldset class="checkbox">
															<div class="vs-checkbox-con vs-checkbox-primary">
																<input type="checkbox" checked name="validasi">
																<span class="vs-checkbox">
																	<span class="vs-checkbox--check">
																		<i class="vs-icon feather icon-check"></i>
																	</span>
																</span>
																<span class="font-small-2"> Saya setuju dengan seluruh
																	kebijakkan
																	<?php echo $a['nm_toko']; ?>.
																</span>
															</div>
														</fieldset>
													</div>
												</div>

												<a href="login.php" class="btn btn-outline-primary btn-inline mb-50">
													Masuk
												</a>
												<button type="submit" name="daftar-merchant"
													class="btn btn-primary btn-inline mb-50" name="submit_kurir"
													id="submit_kurir">
													Daftar
												</button>
											</form>
										</div>
										<!-- Google & Facebook -->
										<div class="divider mt-1">
											<div class="divider-text mb-1">
												<h5 class="text-uppercase text-info border-info p-1">Atau</h5>
											</div>
											<div class="row justify-content-center text-center">
												<div class="col-12">
													<a href="<?= $client->createAuthUrl() ?>" class="btn btn-danger">
														<i class="fa-brands fa-google"></i>
														Daftar dengan Google
													</a>
												</div>
												<!--div class="col-6">
									   <a href="#" class="btn btn-primary" style="width:100%">
										  <i class="fa-brands fa-facebook-f" style="margin-right:5px"></i>
										 Masuk dengan Facebook
									   </a>
										</div-->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
	<!-- END: Content-->


	<!-- BEGIN: Vendor JS-->
	<script src="app-assets/vendors/js/vendors.min.js"></script>
	<!-- BEGIN Vendor JS-->

	<!-- BEGIN: Page Vendor JS-->
	<script src="app-assets/vendors/js/ui/jquery.sticky.js"></script>
	<!-- END: Page Vendor JS-->

	<!-- BEGIN: Theme JS-->
	<script src="app-assets/js/core/app-menu.js"></script>
	<script src="app-assets/js/core/app.js"></script>
	<script src="app-assets/js/scripts/components.js"></script>
	<script src="app-assets/vendors/js/forms/select/select2.full.min.js"></script>
	<script src="app-assets/js/scripts/forms/select/form-select2.js"></script>
	<!-- END: Theme JS-->

	<!-- BEGIN: Page JS-->
	<!-- END: Page JS-->
	<script>
		$(document).ready(function () {
			navigator.geolocation.getCurrentPosition((position) => {
				$("#lat_kurir").val(`${position.coords.latitude}`);
				$("#lon_kurir").val(`${position.coords.longitude}`);
			});
		});

		$("#submit_kurir").click(() => {
			if (!navigator.geolocation)
				return alert("Geolocation is not supported.");

			navigator.geolocation.getCurrentPosition((position) => {
				$("#lat_kurir").val(`${position.coords.latitude}`);
				$("#lon_kurir").val(`${position.coords.longitude}`);
			});
		});
	</script>
</body>
<!-- END: Body-->

</html>