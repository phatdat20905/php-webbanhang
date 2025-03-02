<?php
	include 'inc/header.php';
	include 'inc/slider.php';
?>
<?php
    if(!isset($_GET['catId']) || $_GET['catId'] == NULL) {
        echo "<script>window.location='404.php';</script>";
    }else {
        $id = $_GET['catId'];
    }
?>
<?php
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['themgiohang'])) {
	$product_stock = $_POST['product_stock'];
	$quantity = $_POST['quantity'];
	$id = $_POST['productId'];
	$AddtoCart = $ct->add_to_cart($quantity,$product_stock, $id);
	if($AddtoCart){
		echo "<script>window.location='cart.php';</script>";
	}
}
?>
 <div class="main">
    <div class="content">
		<?php 
		$nameCat = $cat->get_name_by_cat($id);
		if($nameCat) {
			    while($result_cat = $nameCat->fetch_assoc()){
            ?>
    	<div class="content_top">
    		<div class="heading">
    		<h3>Category: <?php echo $result_cat['catName']?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
		<?php } }?>
	      <div class="section group">
			<?php
			$productbycat = $cat->get_product_by_cat($id);
			if($productbycat) {
				while($result_pro = $productbycat->fetch_assoc()) {
			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.php"><img src="admin/uploads/<?php echo $result_pro['image']?>" width="200px" alt="Ảnh sản phẩm" /></a>
					 <h2><?php echo $result_pro['productName']?></h2>
					 <p><?php echo $fm->textShorten($result_pro['productName'], 50)?></p>
					 <p><span class="price"><?php echo $result_pro['price'].' VND'?></span></p>
					 <form method="post">
						<input type="hidden" name="product_stock" value="<?php echo $result_pro['productQuantity']?>">
						<input type="hidden" name="quantity" value="1"/>
						<input type="hidden" name="productId" value="<?php echo $result_pro['productId']?>"/>
						<input type="submit" name="themgiohang" value="Thêm giỏ hàng" class="button"/>
					 </form>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result_pro['productId']?>" class="details">Details</a></span></div>
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