<?php
    $currentPageName = pathinfo(basename($_SERVER['PHP_SELF']), PATHINFO_FILENAME);
?>
<body class="stretched page-transition" data-loader="1" data-animation-in="fadeIn" data-speed-in="1000"
	data-animation-out="fadeOut" data-speed-out="500">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Header
		============================================= -->
		<header id="header" class="full-header transparent-header style-6 sticky" data-sticky-class="not-dark">
			<div id="header-wrap">
				<div class="container">
					<div class="header-row">

						<!-- Logo
						============================================= -->
						<div id="logo">
							<a href="index.html" class="standard-logo" data-dark-logo="images/logo-dark.png"><img
									src="images/logo.png" alt="Canvas Logo"></a>
							<a href="index.html" class="retina-logo" data-dark-logo="images/logo-dark@2x.png"><img
									src="images/logo@2x.png" alt="Canvas Logo"></a>
						</div><!-- #logo end -->


						<div id="primary-menu-trigger">
							<svg class="svg-trigger" viewBox="0 0 100 100">
								<path
									d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20">
								</path>
								<path d="m 30,50 h 40"></path>
								<path
									d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20">
								</path>
							</svg>
						</div>

						<!-- Primary Navigation
						============================================= -->
						<nav class="primary-menu">

							<ul class="menu-container">
								<li class="menu-item <?php echo $currentPageName === "index" ? "current" : ""; ?>">
									<a class="menu-link" href="/">
										<div>Acasa</div>
									</a>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="index.html">
										<div>Despre Noi</div>
									</a>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="index.html">
										<div>Atractii Turistice</div>
									</a>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="index.html">
										<div>Galerie Foto</div>
									</a>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="index.html">
										<div>Blog</div>
									</a>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="index.html">
										<div>Contact</div>
									</a>
								</li>

							</ul>

						</nav><!-- #primary-menu end -->


					</div>
				</div>
			</div>
			<div class="header-wrap-clone"></div>
		</header><!-- #header end -->