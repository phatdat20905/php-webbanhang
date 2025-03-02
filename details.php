<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
    if(!isset($_GET['proid']) || $_GET['proid'] == NULL) {
        echo "<script>window.location='404.php';</script>";
    }else {
        $id = $_GET['proid'];
    }
	$customer_id = Session::get('customer_id');
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['compare'])) {
		$productid = $_POST['productid'];
		$insertCompare = $product->insertCompare($productid, $customer_id);
    }
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['wishlist'])) {
		$productid = $_POST['productid'];
		$insertCompare = $product->inserWishlist($productid, $customer_id);
    }
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
		$product_stock = $_POST['product_stock'];
		$quantity = $_POST['quantity'];
		$AddtoCart = $ct->add_to_cart($quantity,$product_stock, $id);
    }
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitComment'])) {
		$insertComment = $cs->insert_comment();
    }
?>
<style type="text/css">
	.bt-details input[type=submit]{
		float: left;
		margin: 5px;
	}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
			<?php
			$get_product_details = $product->get_product_details($id);
			if($get_product_details) {
				while($result_details = $get_product_details->fetch_assoc()) {
			?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="images/preview-img.jpg" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result_details['productName']?></h2>
					<p><?php echo $fm->textShorten($result_details['product_desc'], 150)?></p>					
					<div class="price">
						<p>Price: <span><?php echo $fm->format_currency($result_details['price']).' VND'?></span></p>
						<p>Category: <span><?php echo $result_details['catName']?></span></p>
						<p>Brand:<span><?php echo $result_details['brandName']?></span></p>
						<p>Brand:<span><?php echo $result_details['productQuantity']?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="hidden" name="product_stock" value="<?php echo $result_details['productQuantity']?>">
						<input type="number" class="buyfield" name="quantity" value="1" min="1"/>
						<?php 
						if($result_details['productQuantity'] > 0) {
							echo '<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>';
						}
						?>
						
					</form>
					<?php
						if(isset($AddtoCart)){
							echo '<span style="color:red;font-size:10px;">Product Already Exits</span>';
						}
						?>					
				</div>
				<div class="add-cart">
					<div class="bt-details">
						<form action="" method="post">
							<input type="hidden" name="productid" value="<?php echo $result_details['productId']?>">
							<?php
							if($login_check) {
								echo '<input type="submit" class="buysubmit" name="compare" value="Compare Product">'.'   ';
							}
							?>
							
						</form>
						<form action="" method="post">
							<input type="hidden" name="productid" value="<?php echo $result_details['productId']?>">
							<?php
							if($login_check) {
								echo '<input type="submit" class="buysubmit" name="wishlist" value="Save ti Wishlist">';
							}
							?>
							
						</form>
					</div>
					<div class="clear"></div>
					<p>
					<?php
							if(isset($insertCompare)){
								echo $insertCompare;
							}
							?>
					<?php
						if(isset($inserWishlist)){
							echo $inserWishlist;
						}
						?>
					</p>            
                </div>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<?php echo $fm->textShorten($result_details['product_desc'], 150)?>
	    </div>
		<?php
		}
	}
	?>			
	</div>
		<div class="rightsidebar span_3_of_1">
		<h2>CATEGORIES</h2>
			<ul>
			<?php 
			$getall_category = $cat->show_category_fontend();
			if($getall_category) {
				while($result_allcat = $getall_category->fetch_assoc()) {
			?>
				<li><a href="productbycat.php?catId=<?php echo $result_allcat['catId']?>"><?php echo $result_allcat['catName']?></a></li>
			<?php
				}}
			?>
			</ul>

		</div>
	</div>
	<div class="comment">
		<h2>Ý kiến sản phẩm</h2>
		<?php
		if(isset($insertComment)){
			echo $insertComment;
		}
		?>
        <form action="" method="post">
            <input type="hidden" name="productId" value="<?php echo $id?>">
            <p><input type="text" name="commentName" placeholder="Tên của bạn"></p>
            <p><textarea rows="5" name="comment" placeholder="Bình luận của bạn"></textarea></p>
            <input type="submit" name="submitComment" value="Gửi bình luân">
        </form>
	</div>
</div>

<?php 
	include 'inc/footer.php';
?>
	