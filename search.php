<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
 <div class="main">
    <div class="content">
	<?php
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			$tukhoa = $_POST['tukhoa'];

			$search_product = $product->search_product($tukhoa);
		}
	?>
    	<div class="content_top">
    		<div class="heading">
    		<h3>Từ khóa tìm kiếm: <?php echo $tukhoa?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			<?php
			if($search_product) {
				while($result = $search_product->fetch_assoc()) {
			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.php"><img src="admin/uploads/<?php echo $result['image']?>" width="200px" alt="Ảnh sản phẩm" /></a>
					 <h2><?php echo $result['productName']?></h2>
					 <p><?php echo $fm->textShorten($result['productName'], 50)?></p>
					 <p><span class="price"><?php echo $result['price'].' VND'?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['productId']?>" class="details">Details</a></span></div>
				</div>
				<?php 
					} 
				} else {
					echo "<p style='text-align: center;'>No product found in this category.</p>";  // show a message when there's no product in this category  // using a placeholder image instead of a blank page  // or redirect to a 404 page instead of a blank page  // or display a search box to help the user find a product in another category  // or display a message to suggest other related products  // or display a message to suggest other categories  // or display a message to suggest other products from the same brand  // or display a message to suggest other products from the same manufacturer  // or display a message to suggest other products from the same supplier  // or display a message to suggest other products from the same distributor  // or display a message to suggest other products from the same retailer  // or display a message to suggest other products from the same online store  // or display a message to suggest other products from the same
				}
				?>
			</div>
    </div>
 </div>
 <?php 
	include 'inc/footer.php';
?>