<!DOCTYPE HTML>
<html>
	<head>
		<title>@yield('title')</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link href="{{URL('/')}}/assets/css/table.css" rel="stylesheet" type="text/css" media="all">
		<link rel="stylesheet" href="{{URL('/')}}/assets/css/main.css" />
		<link rel="stylesheet" type="text/css" href="{{URL('/')}}/assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="{{URL('/')}}/assets/datatables/Buttons-1.5.2/css/buttons.bootstrap.css"/>
		<link rel="stylesheet" href="{{URL('/')}}/assets/css/jquery-ui.css">
		<link rel="stylesheet" href="{{URL('/')}}/assets/js/lib/dist/sweetalert.css" type="text/css" />
		<style>
		.swal-button {
		    padding: 0em 1em 1em 1em;
    		background-color: #934040;
    		color: white !important;
		}

		.swal-button:hover {
		    padding: 0em 1em 1em 1em;
    		background-color: white;
    		color: #934040 !important;
		}
		</style>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">
							<!-- Header -->
								<header id="header">
									@if(Auth::check())
									<a href="#" onclick="return false;" class="logo"><strong>Todo</strong> by {{Auth::user()->name}}</a>
									@endif
								</header>

							<!-- Banner -->
								@if(!Auth::check())
								<section id="banner">
								@endif
									<div class="content">
										@yield('content')
									</div>
								@if(!Auth::check())
								</section>
								@endif

							<!-- Section -->

						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">
							@yield('menu')
							<!-- Menu -->
								
							<!-- Footer -->
								<footer id="footer">
									<p class="copyright">&copy; To Do. All rights reserved.</p>
								</footer>

						</div>
					</div>

			</div>

		<!-- Scripts -->
			<script src="{{URL('/')}}/assets/js/jquery.min.js"></script>
			<script src="{{URL('/')}}/assets/js/browser.min.js"></script>
			<script src="{{URL('/')}}/assets/js/breakpoints.min.js"></script>
			<script src="{{URL('/')}}/assets/js/util.js"></script>
			<script src="{{URL('/')}}/assets/js/main.js"></script>
			<script type="text/javascript" src="{{URL('/')}}/assets/datatables/JSZip-2.5.0/jszip.js"></script>
			<script type="text/javascript" src="{{URL('/')}}/assets/datatables/pdfmake-0.1.36/pdfmake.js"></script>
			<script type="text/javascript" src="{{URL('/')}}/assets/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
			<script type="text/javascript" src="{{URL('/')}}/assets/datatables/DataTables-1.10.18/js/jquery.dataTables.js"></script>
			<script type="text/javascript" src="{{URL('/')}}/assets/datatables/DataTables-1.10.18/js/dataTables.bootstrap.js"></script>
			<script type="text/javascript" src="{{URL('/')}}/assets/datatables/Buttons-1.5.2/js/dataTables.buttons.js"></script>
			<script type="text/javascript" src="{{URL('/')}}/assets/datatables/Buttons-1.5.2/js/buttons.bootstrap.js"></script>
			<script type="text/javascript" src="{{URL('/')}}/assets/datatables/Buttons-1.5.2/js/buttons.colVis.js"></script>
			<script type="text/javascript" src="{{URL('/')}}/assets/datatables/Buttons-1.5.2/js/buttons.flash.js"></script>
			<script type="text/javascript" src="{{URL('/')}}/assets/datatables/Buttons-1.5.2/js/buttons.html5.js"></script>
			<script type="text/javascript" src="{{URL('/')}}/assets/datatables/Buttons-1.5.2/js/buttons.print.js"></script>
			<script src="{{URL('/')}}/assets/js/lib/dist/sweetalert.min1.js"></script>
			<script src="{{URL('/')}}/assets/js/jquery-ui.js"></script>
			@yield('page-script')
	</body>
</html>