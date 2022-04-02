<?php include "PHP/header.php"; ?>
<?php include "PHP/nav.php"; ?>

<!-- Page Title
	============================================= -->
<section id="page-title" class="page-title-parallax page-title-dark"
	style="background-image: url('images/page_titles/Pensiunea_Sophia_15.jpg'); background-size: cover; padding: 120px 0;"
	data-bottom-top="background-position:0px 0px;" data-top-bottom="background-position:0px -450px;">

	<div class="bg-overlay z-1" style="background-color: rgba(0,0,0,0.5);"></div>
	<div class="container clearfix z-2">
		<h1>GALERIE FOTO</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/">Acasă</a></li>
			<li class="breadcrumb-item"><a href="galerie-foto">Galerie Foto</a></li>
		</ol>
	</div>

</section><!-- #page-title end -->

<!-- Content
	============================================= -->
<section id="content">
	<div class="content-wrap">
		<div class="container clearfix">

			<div class="masonry-thumbs grid-container grid-4" data-big="4" data-lightbox="gallery">
				<?php
						$fotos_query = "SELECT * FROM  photo_gallery ORDER BY id DESC";
						$fotos_result = mysqli_query($connection, $fotos_query);
						while($row = mysqli_fetch_assoc($fotos_result)){
							$image = (!empty($row['image_name']) ? $row['image_name'] : ""); 

							echo '<a class="grid-item" href="images/photo_gallery/'.$image.'" data-lightbox="gallery-item"><img src="images/photo_gallery/'.$image.'" alt="Poza Galerie"></a>';
						}
					?>
			</div>
		</div>
	</div>
</section><!-- #content end -->
<?php include "PHP/call_now_banner.php"; ?>

<?php include "PHP/footer.php"; ?>