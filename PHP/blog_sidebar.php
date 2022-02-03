<div class="sidebar col-lg-3">
					<div class="sidebar-widgets-wrap">

						<div class="widget clearfix">

							<a href="galerie-foto" target="_blank">
                                <h4>Galerie Foto</h4>
                            </a>
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
									$query = "SELECT * FROM blog WHERE status='public' ORDER BY date DESC LIMIT 8";
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
													<a href="post.php?article=<?php echo $link_to ?>"><img
															class="rounded-circle sidebar-blog-image"
															src="images/<?php echo $folder_name ?>/<?php echo $image ?>"
															alt="Image"></a>
												</div>
												<?php } ?>
											</div>
											<div class="col ps-3">
												<div class="entry-title">
													<h4><a href="post.php?article=<?php echo $link_to ?>">
															<?php echo $title ?>
														</a>
													</h4>
												</div>
												<?php
														$query = "SELECT * FROM blog_comments WHERE post_id={$id}";
														$select_comments = mysqli_query($connection, $query);
														$num_comments = mysqli_num_rows($select_comments);
														$comments = ($num_comments === 1 ? "comentariu" : "comentarii")
													?>
												<div class="entry-meta">
													<ul>
														<li><i class="icon-comments-alt"></i>
															<?php echo $num_comments." ".$comments ?>
														</li>
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