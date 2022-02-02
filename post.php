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
				<!-- Post Content============================================= -->
				<div class="postcontent col-lg-9">
					<?php
					$link_to = "";
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
								<h2><?php echo $title ?></h2>
							</div><!-- .entry-title end -->

							<!-- Entry Meta============================================= -->
							<div class="entry-meta">
								<ul>
									<li><i class="icon-calendar3"></i> <?php echo $formated_date ?></li>
									<li><i class="icon-user"></i> <?php echo $posted_by ?></li>
									<li><i class="icon-comments"></i> 43 comentarii</li>
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

							<h3 id="comments-title"><span>3</span> Comentarii</h3>

							<!-- Comments List============================================= -->
							<ol class="commentlist clearfix">

								<li class="comment even thread-even depth-1" id="li-comment-1">

									<div id="comment-1" class="comment-wrap clearfix">

										<div class="comment-content clearfix">

											<div class="comment-author">John Doe<span><a href="#"
														title="Permalink to this comment">April 24, 2012 at 10:46
														am</a></span></div>

											<p>Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Nullam id
												dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante
												venenatis dapibus posuere velit aliquet.</p>
										</div>

										<div class="clear"></div>

									</div>

								</li>

							</ol><!-- .commentlist end -->

							<div class="clear"></div>

							<!-- Comment Form============================================= -->
							<div id="respond">

								<h3>Lasa un <span>comentariu</span></h3>

								<form class="row" action="#" method="post" id="commentform">
									<div class="col-md-6 form-group">
										<label for="author">Nume</label>
										<input type="text" name="author" id="author" value="" size="22" tabindex="1"
											class="sm-form-control" />
									</div>

									<div class="col-md-6 form-group">
										<label for="email">Email</label>
										<input type="text" name="email" id="email" value="" size="22" tabindex="2"
											class="sm-form-control" />
									</div>

									<div class="w-100"></div>

									<div class="col-12 form-group">
										<label for="comment">Comentariu</label>
										<textarea name="comment" cols="58" rows="7" tabindex="4"
											class="sm-form-control"></textarea>
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
				<div class="sidebar col-lg-3">
					<div class="sidebar-widgets-wrap">

						<div class="widget clearfix">

							<h4>Galerie Foto</h4>
							<div class="masonry-thumbs grid-container grid-4" data-lightbox="gallery">
								<?php
							$fotos_query = "SELECT * FROM  photo_gallery ORDER BY id DESC LIMIT 32";
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
									<?php
									$query = "SELECT * FROM blog WHERE status='public' ORDER BY id DESC LIMIT 8";
									$select_posts = mysqli_query($connection, $query);
							
									while ($row = mysqli_fetch_assoc($select_posts)) {
									  $id = $row['id'];
									  $title = (!empty($row['title']) ? $row['title'] : "");
									  $link_to = (!empty($row['link_to']) ? $row['link_to'] : "");
									?>
										<div class="entry col-12">
											<div class="grid-inner row g-0">
												<div class="col-auto">
												<?php
													//display last image
													$image_query = "SELECT * FROM blog_fotos WHERE post_id = {$id} ORDER BY id DESC LIMIT 1";
													$image_result = mysqli_query($connection, $image_query);
													while($row = mysqli_fetch_assoc($image_result)){
														$folder_name = (!empty($row['folder_name']) ? $row['folder_name'] : ""); 
														$image = (!empty($row['image']) ? $row['image'] : ""); 
												?>
													<div class="entry-image">
														<a href="post.php?article=<?php echo $link_to ?>"><img class="rounded-circle sidebar-blog-image"
																src="images/<?php echo $folder_name ?>/<?php echo $image ?>" alt="Image"></a>
													</div>
												<?php } ?>
												</div>
												<div class="col ps-3">
													<div class="entry-title">
														<h4><a href="post.php?article=<?php echo $link_to ?>"><?php echo $title ?></a>
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
									<?php } ?>
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