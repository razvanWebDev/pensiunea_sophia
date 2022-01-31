<?php include "PHP/header.php"; ?>
<?php include "PHP/nav.php"; ?>

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
				<!-- Post Content
						============================================= -->
				<div class="postcontent col-lg-9">

					<!-- Posts
							============================================= -->
					<div id="posts" class="row grid-container gutter-30">

						<div class="entry col-12">
							<div class="grid-inner">
								<div class="entry-image">
									<div class="fslider" data-arrows="false" data-lightbox="gallery">
										<div class="flexslider">
											<div class="slider-wrap">
												<div class="slide"><a href="images/blog/full/10.jpg"
														data-lightbox="gallery-item"><img
															src="images/blog/standard/10.jpg"
															alt="Standard Post with Gallery"></a></div>
												<div class="slide"><a href="images/blog/full/20.jpg"
														data-lightbox="gallery-item"><img
															src="images/blog/standard/20.jpg"
															alt="Standard Post with Gallery"></a></div>
												<div class="slide"><a href="images/blog/full/21.jpg"
														data-lightbox="gallery-item"><img
															src="images/blog/standard/21.jpg"
															alt="Standard Post with Gallery"></a></div>
											</div>
										</div>
									</div>
								</div>
								<div class="entry-title">
									<h2><a href="blog-single-small.html">This is a Standard post with a Slider
											Gallery</a></h2>
								</div>
								<div class="entry-meta">
									<ul>
										<li><i class="icon-calendar3"></i> 31.01.2022</li>
										<li><i class="icon-user"></i> admin</li>
										<li><i class="icon-comments"></i> 21
											comentarii</li>
										<li><i class="icon-picture"></i></li>
									</ul>
								</div>
								<div class="entry-content">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione, voluptatem,
										dolorem animi nisi autem blanditiis enim culpa reiciendis et explicabo tenetur
										voluptate rerum molestiae eaque possimus exercitationem eligendi fuga. Maiores,
										sunt eveniet doloremque porro hic exercitationem distinctio sequi adipisci.
										Nulla, fuga perferendis voluptatum beatae voluptate architecto laboriosam
										provident deserunt. Saepe!</p>
									<a href="blog-single-small.html" class="more-link">Read More</a>
								</div>
							</div>
						</div>

					</div><!-- #posts end -->

					<!-- Pager
							============================================= -->
					<div class="d-flex justify-content-between mt-5">
						<a href="#" class="btn btn-outline-secondary">&larr; Older</a>
						<a href="#" class="btn btn-outline-dark">Newer &rarr;</a>
					</div>
					<!-- .pager end -->

				</div><!-- .postcontent end -->

				<!-- Sidebar
						============================================= -->
				<div class="sidebar col-lg-3">
					<div class="sidebar-widgets-wrap">

						<div class="widget clearfix">

							<h4>Galerie Foto</h4>
							<div class="masonry-thumbs grid-container grid-4" data-lightbox="gallery">
								<?php
							$fotos_query = "SELECT * FROM  photo_gallery ORDER BY id DESC LIMIT 20";
							$fotos_result = mysqli_query($connection, $fotos_query);
							while($row = mysqli_fetch_assoc($fotos_result)){
								$image = (!empty($row['image_name']) ? $row['image_name'] : ""); 

								echo '<a class="grid-item" href="images/photo_gallery/'.$image.'" data-lightbox="gallery-item"><img src="images/photo_gallery/'.$image.'" alt="Poza Galerie"></a>';
							}
							?>
							</div>

						</div>

					</div>

					<div class="widget clearfix">

						<div class=" mb-0 clearfix">
							<h4>Ultimele Articole</h4>
							<div class=" clearfix">
								<div class="posts-sm row col-mb-30" id="popular-post-list-sidebar">
									<div class="entry col-12">
										<div class="grid-inner row g-0">
											<div class="col-auto">
												<div class="entry-image">
													<a href="#"><img class="rounded-circle"
															src="images/magazine/small/3.jpg" alt="Image"></a>
												</div>
											</div>
											<div class="col ps-3">
												<div class="entry-title">
													<h4><a href="#">Lorem ipsum dolor sit amet, consectetur</a>
													</h4>
												</div>
												<div class="entry-meta">
													<ul>
														<li><i class="icon-comments-alt"></i> 35 Comentarii</li>
													</ul>
												</div>
											</div>
										</div>
									</div>

									<div class="entry col-12">
										<div class="grid-inner row g-0">
											<div class="col-auto">
												<div class="entry-image">
													<a href="#"><img class="rounded-circle"
															src="images/magazine/small/2.jpg" alt="Image"></a>
												</div>
											</div>
											<div class="col ps-3">
												<div class="entry-title">
													<h4><a href="#">Elit Assumenda vel amet dolorum quasi</a>
													</h4>
												</div>
												<div class="entry-meta">
													<ul>
														<li><i class="icon-comments-alt"></i> 24 Comentarii</li>
													</ul>
												</div>
											</div>
										</div>
									</div>

									<div class="entry col-12">
										<div class="grid-inner row g-0">
											<div class="col-auto">
												<div class="entry-image">
													<a href="#"><img class="rounded-circle"
															src="images/magazine/small/1.jpg" alt="Image"></a>
												</div>
											</div>
											<div class="col ps-3">
												<div class="entry-title">
													<h4><a href="#">Debitis nihil placeat, illum est nisi</a>
													</h4>
												</div>
												<div class="entry-meta">
													<ul>
														<li><i class="icon-comments-alt"></i> 19 Comentarii</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>

					</div>
				</div>

			</div><!-- .sidebar end -->
		</div>

	</div>
	</div>
</section><!-- #content end -->

<?php include "PHP/footer.php"; ?>