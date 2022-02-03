<?php include "PHP/header.php"; ?>
<?php include "PHP/nav.php"; ?>

<!-- check for comment post errors -->
<?php
    $message = "";
    $display_message = "none";
    if(isset($_GET['error']) == "captcha_failed"){
        $display_message = "block";
		if($_GET['error'] == "unknown"){
			$message = "Eroare captcha. Formularul nu a fost trimis!";
		}elseif($_GET['error'] == "captcha_failed"){
			$message = "Eroare captcha. Formularul nu a fost trimis!";
		}
    }

?>

<!-- Page Title
	============================================= -->
<section id="page-title" class="page-title-parallax page-title-dark"
	style="background-image: url('images/page_titles/Pensiunea_Sophia_15.jpg'); background-size: cover; padding: 120px 0;"
	data-bottom-top="background-position:0px 0px;" data-top-bottom="background-position:0px -450px;">

	<div class="bg-overlay z-1" style="background-color: rgba(0,0,0,0.5);"></div>
	<div class="container clearfix z-2">
		<h1>BLOG</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/">Acasa</a></li>
			<li class="breadcrumb-item"><a href="galerie-foto">Blog</a></li>
		</ol>
	</div>

</section><!-- #page-title end -->

<!-- Content
		============================================= -->
<section id="content">
	<div class="content-wrap">
		<div class="container clearfix">

			<div class="row gutter-40 col-mb-80">
				<!-- Post Content============================================= -->
				<div class="postcontent col-lg-9">
					<?php
					$link_to = $id = "";
					if(isset($_GET['article'])){
						$link_to = $_GET['article'];
					}
					$query = "SELECT * FROM blog WHERE status='public' AND link_to='{$link_to}' ORDER BY id DESC LIMIT 1";
					$select_posts = mysqli_query($connection, $query);
			
					while ($row = mysqli_fetch_assoc($select_posts)) {
					  $id = $row['id'];
					  $title = (!empty($row['title']) ? $row['title'] : "");
					  $date = (!empty($row['date']) ? $row['date'] : "");
					  $formated_date = date('d.m.Y',strtotime($date));
					  $posted_by = (!empty($row['posted_by']) ? $row['posted_by'] : "");
					  $description = (!empty($row['description']) ? $row['description'] : ""); 

					?>

					<div class="single-post mb-0">

						<!-- Single Post============================================= -->
						<div class="entry clearfix">

							<!-- Entry Title============================================= -->
							<div class="entry-title">
								<h2>
									<?php echo $title ?>
								</h2>
							</div><!-- .entry-title end -->

							<!-- Entry Meta============================================= -->
							<div class="entry-meta">
								<ul>
									<li><i class="icon-calendar3"></i>
										<?php echo $formated_date ?>
									</li>
									<li><i class="icon-user"></i>
										<?php echo $posted_by ?>
									</li>
									<?php
										$query = "SELECT * FROM blog_comments WHERE post_id={$id}";
										$select_comments = mysqli_query($connection, $query);
										$num_comments = mysqli_num_rows($select_comments);
										$comments = ($num_comments === 1 ? "comentariu" : "comentarii")
									?>
									<li><i class="icon-comments"></i>
										<?php echo $num_comments." ".$comments ?>
									</li>
									<li><i class="icon-camera-retro"></i></li>
								</ul>
							</div><!-- .entry-meta end -->

							<!-- Entry Image============================================= -->
							<div class="entry-image">
								<div class="fslider vh-20" data-arrows="false" data-lightbox="gallery">
									<div class="flexslider ">
										<div class="slider-wrap ">
											<?php
													//display images
													$image_query = "SELECT * FROM blog_fotos WHERE post_id = {$id} ORDER BY id DESC";
													$image_result = mysqli_query($connection, $image_query);
													while($row = mysqli_fetch_assoc($image_result)){
														$folder_name = (!empty($row['folder_name']) ? $row['folder_name'] : ""); 
														$image = (!empty($row['image']) ? $row['image'] : ""); 
												?>
											<div class="slide blog-title-slide"><a
													href="images/<?php echo $folder_name ?>/<?php echo $image ?>"
													data-lightbox="gallery-item"><img
														src="images/<?php echo $folder_name ?>/<?php echo $image ?>"
														alt="blog image gallery" class="blog-image"></a>
											</div>

											<?php }?>
										</div>
									</div>
								</div>
							</div>

							<!-- Entry Content============================================= -->
							<div class="entry-content mt-0">
								<?php echo $description ?>

								<!-- Post Single - Content End -->

								<div class="clear"></div>

							</div>
						</div><!-- .entry end -->

						<!-- Post Navigation============================================= -->
						<div class="row justify-content-between col-mb-30 post-navigation">
							<?php
								$query = "SELECT * FROM blog WHERE date > '{$date}' ORDER BY date LIMIT 1";
								$select_posts = mysqli_query($connection, $query);
						
								while ($row = mysqli_fetch_assoc($select_posts)) {
									$link_to = (!empty($row['link_to']) ? $row['link_to'] : "");
								
							?>
							<div class="col-12 col-md-auto text-center">
								<a href="post.php?article=<?php echo $link_to ?>">&lArr; Articolul anterior</a>
							</div>

							<?php } ?>

							<?php
								$query = "SELECT * FROM blog WHERE date < '{$date}' ORDER BY date LIMIT 1";
								$select_posts = mysqli_query($connection, $query);
						
								while ($row = mysqli_fetch_assoc($select_posts)) {
									$link_to = (!empty($row['link_to']) ? $row['link_to'] : "");
								
							?>
							<div class="col-12 col-md-auto text-center">
								<a href="post.php?article=<?php echo $link_to ?>">Articolul urmator &rArr;</a>
							</div>
							<?php } ?>
						</div><!-- .post-navigation end -->

						<!-- Comments============================================= -->
						<div id="comments" class="clearfix">

							<h3 id="comments-title"><span>
									<?php echo $num_comments ?>
								</span>
								<?php echo $comments ?>
							</h3>

							<!-- Comments List============================================= -->
							<ol class="commentlist clearfix">
								<?php
								while ($row = mysqli_fetch_assoc($select_comments)) {
									$name = (!empty($row['name']) ? $row['name'] : "");
									$timestamp = (!empty($row['timestamp']) ? $row['timestamp'] : "");
									$comment = (!empty($row['comment']) ? $row['comment'] : "");

							?>

								<li class="comment even thread-even depth-1" id="li-comment-1">
									<div class="comment-wrap clearfix">
										<div class="comment-content clearfix">
											<div class="comment-author">
												<?php echo $name ?><span>
													<?php echo $timestamp ?>
												</span>
											</div>

											<p>
												<?php echo $comment ?>
											</p>
										</div>
										<div class="clear"></div>
									</div>
								</li>
								<?php } ?>

							</ol><!-- .commentlist end -->

							<div class="clear"></div>

							<!-- Comment Form============================================= -->
							<div id="respond">

								<h3>Lasa un <span>comentariu</span></h3>

								<form class="row" action="PHP/blog_comments.php" method="post" id="commentform">
									<p class="text-danger captcha-failed-p"
										style="display: <?php echo $display_message ?>">
										<?php echo $message ?>
									</p>
									<!-- input needed for reCaptcha -->
									<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
									<input type="hidden" name="post_id" value="<?php echo $id ?>">
									<div class="col-md-6 form-group">
										<label for="name">Nume *</label>
										<input type="text" name="name" value="" size="22" tabindex="1"
											class="sm-form-control" required />
									</div>

									<div class="col-md-6 form-group">
										<label for="email">Email *</label>
										<input type="text" name="email" id="email" value="" size="22" tabindex="2"
											class="sm-form-control" required />
									</div>

									<div class="w-100"></div>

									<div class="col-12 form-group">
										<label for="comment">Comentariu *</label>
										<textarea name="comment" cols="58" rows="7" tabindex="4" class="sm-form-control"
											required></textarea>
									</div>

									<div class="col-12 form-group">
										<button name="submit" type="submit" id="submit-button" tabindex="5"
											value="Submit" class="button button-3d m-0">Trimite comentariul</button>
									</div>
								</form>

							</div><!-- #respond end -->

						</div><!-- #comments end -->

					</div>
					<!-- end of while ($row = mysqli_fetch_assoc($select_posts)) -->
					<?php } ?>

				</div><!-- .postcontent end -->


				<!-- Sidebar============================================= -->
				<?php include "PHP/blog_sidebar.php"; ?>

			</div><!-- .sidebar end -->
		</div>

	</div>
	</div>
</section><!-- #content end -->
<!-- CAPTCHA -->
<script>
	function getReCaptcha() {
		grecaptcha.ready(function () {
			grecaptcha.execute("<?php echo $site_key ?>", { action: 'homepage' }).then(function (token) {
				document.getElementById("g-recaptcha-response").value = token;
			});
		});

	}
	getReCaptcha();
	//Refesh token Every 110 Seconds
	setInterval(function () {
		getReCaptcha();
	}, 110 * 1000)
</script>

<?php include "PHP/footer.php"; ?>