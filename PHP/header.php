<?php include "PHP/db.php" ?>
<?php include "admin/includes/functions.php" ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html dir="ltr" lang="ro-RO">

<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description"
		content="Cauți cazare la o pensiune în Sălaj? Pensiunea Sophia din Sărmășag are toate facilitățile: 8 camere, ciubăr, loc de joacă pentru copii, grătar, ceaun, parcare. Acceptăm tichete de vacanță.">
	<meta name="keywords"
		content="pensiune/pensiuni sălaj, pensiune/pensiuni salaj, cazare sălaj, cazare salaj, cabană sărmășag, cabana sarmasag,  pensiune sărmășag, pensiune sarmasag">
	<meta name="author" content="Pensiunea Sophia" />

	<!-- Stylesheets
	============================================= -->
	<link
		href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap"
		rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="css/swiper.css" type="text/css" />
	<link rel="stylesheet" href="css/dark.css" type="text/css" />
	<!-- attractions page stylesheet -->
	<link rel="stylesheet" href="demos/crowdfunding/crowdfunding.css" type="text/css" />
	<link rel="stylesheet" href="demos/crowdfunding/css/fonts.css" type="text/css" />
	<!-- / -->
	<link rel="stylesheet" href="css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="css/animate.css" type="text/css" />
	<link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />
	<link rel="stylesheet" href="css/colors.css" type="text/css" />

	<link rel="stylesheet" href="css/custom.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $site_key ?>"></script>

	<!-- Document Title
	============================================= -->
	<title>Pensiunea Sophia</title>

	<!-- Meta Pixel Code -->
	<script>
		!function (f, b, e, v, n, t, s) {
			if (f.fbq) return; n = f.fbq = function () {
				n.callMethod ?
				n.callMethod.apply(n, arguments) : n.queue.push(arguments)
			};
			if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
			n.queue = []; t = b.createElement(e); t.async = !0;
			t.src = v; s = b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t, s)
		}(window, document, 'script',
			'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '2097567453733656');
		fbq('track', 'PageView');
		fbq('track', 'Purchase', 'Lead');
	</script>
	<noscript><img height="1" width="1" style="display:none"
			src="https://www.facebook.com/tr?id=2097567453733656&ev=PageView&noscript=1" /></noscript>
	<!-- End Meta Pixel Code -->

</head>