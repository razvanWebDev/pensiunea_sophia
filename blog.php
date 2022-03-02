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
						<?php
						//pagination
						$rowCounter_per_page = 0;
						//the number of posts per page
						$articles_per_page = 6;
					
						if(isset($_GET['page'])){
							$page = $_GET['page'];
						}else{
							$page = 1;
						}
				
						if($page == "" || $page == 1){
							$page_1 = 0;
						}else{
							$page_1 = ($page * $articles_per_page) - $articles_per_page;
						}
				
						$post_query_count = "SELECT * FROM blog WHERE status='public'";
						$select_post_query_count = mysqli_query($connection, $post_query_count);
						$count = mysqli_num_rows($select_post_query_count);
						$count = ceil($count / $articles_per_page); 
				
						$query = "SELECT * FROM blog WHERE status='public' ORDER BY date DESC LIMIT $page_1, $articles_per_page";
						$select_posts = mysqli_query($connection, $query);
				
						while ($row = mysqli_fetch_assoc($select_posts)) {
						  $rowCounter_per_page++;
						  $totalRowCounter = $rowCounter_per_page + (($page-1) * $articles_per_page);
						  
						  $id = $row['id'];
						  $title = (!empty($row['title']) ? $row['title'] : "");
						  $date = (!empty($row['date']) ? $row['date'] : "");
						  $formated_date = date('d.m.Y',strtotime($date));
						  $posted_by = (!empty($row['posted_by']) ? $row['posted_by'] : "");
						  $link_to = (!empty($row['link_to']) ? $row['link_to'] : "");
						  $description = (!empty($row['description']) ? $row['description'] : ""); 
						  //get short text for expandable table
						  // $short_text = strip_tags($description);
						  $short_text = $description;
						  if (strlen($short_text) > 400) {
				
							// truncate string
							$stringCut = substr($short_text, 0, 400);
							$endPoint = strrpos($stringCut, ' ');
						
							//if the string doesn't contain any space then it will cut without word basis.
							$short_text = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
							$short_text .= '...';
						  }
				
						  $folder_name = $image = "";

						?>

						<div class="entry col-12">
							<div class="grid-inner">
								<div class="entry-image">
									<div class="fslider" data-arrows="false" data-lightbox="gallery">
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

								<div class="entry-title">
									<h2><a href="post.php?article=<?php echo $link_to ?>">
											<?php echo $title ?>
										</a></h2>
								</div>
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
										<li><i class="icon-picture"></i></li>
									</ul>
								</div>
								<div class="entry-content">
									<?php echo $short_text ?><br><br>
									<a href="post.php?article=<?php echo $link_to ?>" class="more-link">Deschide
										articol</a>
								</div>
							</div>
						</div>
						<?php }?>

					</div><!-- #posts end -->

					<!-- Pagination
					============================================= -->
					<ul class="pagination mt-5 pagination-circle justify-content-center">
						<?php
							if($count > 1){
								for($i = 1; $i <= $count; $i++){
									if($i == $page){
										echo "<li class='page-item active'><a class='page-link' href='blog.php?page={$i}'>$i</a></li>";
									}else{
										echo "<li class='page-item'><a class='page-link' href='blog.php?page={$i}'>$i</a></li>";
									}
								}
							}
						?>
					</ul>

				</div><!-- .postcontent end -->

				<!-- Sidebar============================================= -->
				<?php include "PHP/blog_sidebar.php"; ?>

			</div><!-- .sidebar end -->
		</div>

	</div>
	</div>
</section><!-- #content end -->
<?php include "PHP/call_now_banner.php"; ?>
<?php include "PHP/footer.php"; ?>