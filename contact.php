<?php include "PHP/header.php"; ?>
<?php include "PHP/nav.php"; ?>

	<!-- Page Title
	============================================= -->
	<section id="page-title" class="page-title-parallax page-title-dark" style="background-image: url('images/page_titles/Pensiunea_Sophia_15.jpg'); background-size: cover; padding: 120px 0;" data-bottom-top="background-position:0px 0px;" data-top-bottom="background-position:0px -450px;">

	<div class="bg-overlay z-1" style="background-color: rgba(0,0,0,0.5);"></div>
		<div class="container clearfix z-2">
			<h1>CONTACT</h1>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="/">Acasa</a></li>
				<li class="breadcrumb-item"><a href="galerie-foto">Contact</a></li>
			</ol>
		</div>

	</section><!-- #page-title end -->

			<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container">

					<div class="row gutter-40 col-mb-80">
						<!-- Postcontent
						============================================= -->
						<div class="postcontent col-lg-9">

							<h3>Trimite-ne un mesaj</h3>

							<div class="form-widget">

								<div class="form-result"></div>

								<form class="mb-0" id="template-contactform" name="template-contactform" action="include/form.php" method="post">

									<div class="form-process">
										<div class="css3-spinner">
											<div class="css3-spinner-scaler"></div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-4 form-group">
											<label for="template-contactform-name">Nume <small>*</small></label>
											<input type="text" id="template-contactform-name" name="template-contactform-name" value="" class="sm-form-control required" />
										</div>

										<div class="col-md-4 form-group">
											<label for="template-contactform-email">Email <small>*</small></label>
											<input type="email" id="template-contactform-email" name="template-contactform-email" value="" class="required email sm-form-control" />
										</div>

										<div class="col-md-4 form-group">
											<label for="template-contactform-phone">Telefon</label>
											<input type="text" id="template-contactform-phone" name="template-contactform-phone" value="" class="sm-form-control" />
										</div>

										<div class="w-100"></div>

										<div class="col-md-4 form-group">
											<label for="template-contactform-subject">Check-in</label>
											<input type="date" id="template-contactform-subject" name="subject" value="" class="sm-form-control" />
										</div>

										<div class="col-md-4 form-group">
											<label for="template-contactform-persons">Nr Persoane</label>
											<input type="number" id="template-contactform-persons" name="persons" value="" class="sm-form-control" />
										</div>

										<div class="col-md-4 form-group">
											<label for="template-contactform-service">Nopti</label>
											<select id="template-contactform-service" name="template-contactform-service" class="sm-form-control">
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
												<option value="13">13</option>
												<option value="14">14</option>
											
											</select>
										</div>

										<div class="w-100"></div>

										<div class="col-12 form-group">
											<label for="template-contactform-message">Mesaj <small>*</small></label>
											<textarea class="required sm-form-control" id="template-contactform-message" name="template-contactform-message" rows="6" cols="30"></textarea>
										</div>

										<div class="col-12 form-group d-none">
											<input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value="" class="sm-form-control" />
										</div>

										<div class="col-12 form-group">
											<button class="button button-3d m-0" type="submit" id="template-contactform-submit" name="template-contactform-submit" value="submit">Trimite msesaj</button>
										</div>
									</div>

									<input type="hidden" name="prefix" value="template-contactform-">

								</form>
							</div>

						</div><!-- .postcontent end -->

						<!-- Sidebar
						============================================= -->
						<div class="sidebar col-lg-3">

							<address>
								<strong>Adresa:</strong><br>
								Str. Țărmure, Nr. 31 <br>
								Sărmășag, județul Sălaj<br>
							</address>
							<abbr title="Phone Number"><strong>Telefon:</strong></abbr> +40-757-548-653<br>
							<abbr title="Email Address"><strong>Email:</strong></abbr> sophiapensiune@gmail.com

							<div class="widget border-0 pt-0">

								<a href="https://www.facebook.com/pensiuneasophiasalaj/" target="_blank" class="social-icon si-small si-dark si-facebook">
									<i class="icon-facebook"></i>
									<i class="icon-facebook"></i>
								</a>

								<a href="#" class="social-icon si-small si-dark si-twitter">
									<i class="icon-twitter"></i>
									<i class="icon-twitter"></i>
								</a>

								<a href="#" class="social-icon si-small si-dark si-instagram">
									<i class="icon-instagram"></i>
									<i class="icon-instagram"></i>
								</a>

								<a href="#" class="social-icon si-small si-dark si-linkedin">
									<i class="icon-linkedin"></i>
									<i class="icon-linkedin"></i>
								</a>
							</div>

						</div><!-- .sidebar end -->
					</div>

				</div>
			</div>
		</section><!-- #content end -->


	<!-- Google Map
		============================================= -->
		<div class="gmap" style="height: 250px;" data-address="Turda, Romania" data-zoom="12" data-markers='[{address: "Melbourne, Australia",html: "Melbourne, Australia"}]' data-icon='{image: "one-page/images/icons/map-icon-red.png",iconsize: [32, 32],iconanchor: [14,44]}'></div>

		<!-- <section class="gmap slider-parallax vh-60" data-address="Melbourne, Australia" data-markers='[{address: "Melbourne, Australia", html: $("#map-marker-1").html(), icon:{ image: "images/icons/map-icon-red.png", iconsize: [32, 39], iconanchor: [32,39] } }]'></section> -->
		<div id="map-marker-1" class="d-none"><div style="width: 300px;"><h4 class="mb-2">Hi! We are <span>Envato!</span></h4><p class="mb-0" style="font-size:1rem;">Our mission is to help people to <strong>earn</strong> and to <strong>learn</strong> online. We operate <strong>marketplaces</strong> where hundreds of thousands of people buy and sell digital goods every day.</p></div></div>


<?php include "PHP/footer.php"; ?>