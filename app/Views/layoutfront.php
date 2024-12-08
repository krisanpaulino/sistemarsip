<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="Admin, Dashboard, Bootstrap" />
	<link rel="shortcut icon" sizes="196x196" href="<?= base_url('assets') ?>/images/logo.png">
	<title>Website BKD Sikka</title>

	<link rel="stylesheet" href="<?= base_url('assets/libs') ?>/bower/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/libs') ?>/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css">
	<link rel="stylesheet" href="<?= base_url('assets/libs') ?>/bower/animate.css/animate.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/libs') ?>/bower/perfect-scrollbar/css/perfect-scrollbar.css">
	<link rel="stylesheet" href="<?= base_url('assets') ?>/css/bootstrap.css">
	<link rel="stylesheet" href="<?= base_url('assets') ?>/css/core.css">
	<link rel="stylesheet" href="<?= base_url('assets') ?>/css/app.css">
	<!-- endbuild -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
	<script src="<?= base_url('assets/libs') ?>/bower/breakpoints.js/dist/breakpoints.min.js"></script>
	<script>
		Breakpoints();
	</script>
	<style>
		.row.display-flex {
			display: flex;
			flex-wrap: wrap;
		}

		.row.display-flex>[class*='col-'] {
			display: flex;
			flex-direction: column;
		}

		.aligned-row {
			display: flex;
			flex-flow: row wrap;

			&::before {
				display: block;
			}
		}
	</style>
</head>

<body class="menubar-top menubar-light theme-primary">
	<!--============= start main area -->

	<!-- APP NAVBAR ==========-->
	<nav id="app-navbar" class="navbar navbar-inverse navbar-fixed-top primary">

		<!-- navbar header -->
		<div class="navbar-header">
			<button type="button" id="menubar-toggle-btn" class="navbar-toggle visible-xs-inline-block navbar-toggle-left hamburger hamburger--collapse js-hamburger">
				<span class="sr-only">Toggle navigation</span>
				<span class="hamburger-box"><span class="hamburger-inner"></span></span>
			</button>

			<button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="zmdi zmdi-hc-lg zmdi-more"></span>
			</button>

			<button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="zmdi zmdi-hc-lg zmdi-search"></span>
			</button>

			<a href="../index.html" class="navbar-brand">
				<span class="brand-icon"><i class="fa fa-gg"></i></span>
				<span class="brand-name">BKD Kabupaten Sikka</span>
			</a>
		</div><!-- .navbar-header -->

		<div class="navbar-container container-fluid">
			<div class="collapse navbar-collapse" id="app-navbar-collapse">
				<ul class="nav navbar-toolbar navbar-toolbar-left navbar-left">
					<li class="hidden-float hidden-menubar-top">
						<a href="javascript:void(0)" role="button" id="menubar-fold-btn" class="hamburger hamburger--arrowalt is-active js-hamburger">
							<span class="hamburger-box"><span class="hamburger-inner"></span></span>
						</a>
					</li>
				</ul>

				<ul class="nav navbar-toolbar navbar-toolbar-right navbar-right">
					<li class="nav-item dropdown hidden-float">
						<a href="javascript:void(0)" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false">
							<i class="zmdi zmdi-hc-lg zmdi-search"></i>
						</a>
					</li>

				</ul>
			</div>
		</div><!-- navbar-container -->
	</nav>
	<!--========== END app navbar -->

	<!-- APP ASIDE ==========-->
	<!--========== END app aside -->

	<!-- navbar search -->
	<div id="navbar-search" class="navbar-search collapse">
		<div class="navbar-search-inner">
			<form action="#">
				<span class="search-icon"><i class="fa fa-search"></i></span>
				<input class="search-field" type="search" placeholder="search..." />
			</form>
			<button type="button" class="search-close" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false">
				<i class="fa fa-close"></i>
			</button>
		</div>
		<div class="navbar-search-backdrop" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false"></div>
	</div><!-- .navbar-search -->

	<!-- APP MAIN ==========-->
	<main id="app-main" class="app-main">
		<div class="wrap">
			<section class="app-content">
				<?= $this->renderSection('content'); ?>
			</section><!-- #dash-content -->
		</div><!-- .wrap -->
	</main>
	<!--========== END app main -->


	<script src="<?= base_url('assets/libs') ?>/bower/jquery/dist/jquery.js"></script>
	<script src="<?= base_url('assets/libs') ?>/bower/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?= base_url('assets/libs') ?>/bower/jQuery-Storage-API/jquery.storageapi.min.js"></script>
	<script src="<?= base_url('assets/libs') ?>/bower/bootstrap-sass/assets/javascripts/bootstrap.js"></script>
	<script src="<?= base_url('assets/libs') ?>/bower/jquery-slimscroll/jquery.slimscroll.js"></script>
	<script src="<?= base_url('assets/libs') ?>/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
	<script src="<?= base_url('assets/libs') ?>/bower/PACE/pace.min.js"></script>
	<!-- endbuild -->

	<script src="<?= base_url('assets') ?>/js/library.js"></script>
	<script src="<?= base_url('assets') ?>/js/plugins.js"></script>
	<script src="<?= base_url('assets') ?>/js/app.js"></script>
	<!-- endbuild -->
	<script src="<?= base_url('assets/libs') ?>/bower/moment/moment.js"></script>
</body>

</html>