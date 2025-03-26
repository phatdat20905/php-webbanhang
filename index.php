<?php
	include 'inc/header.php';
	include 'inc/slider.php';
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
    	<div class="content_top">
    		<div class="heading">
    		<h3>Sản phẩm nổi bật</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
				<?php
				$product_featured = $product->get_product_featured();
				if ($product_featured){
					while ($result = $product_featured->fetch_assoc()){
				?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php"><img src="admin/uploads/<?php echo $result['image']?>" alt="Ảnh sản phẩm" /></a>
					 <h2><?php echo $result['productName']?></h2>
					 <p><?php echo $fm->textShorten($result['product_desc'], 30)?></p>
					 <p><span class="price"><?php echo $fm->format_currency($result['price']).' VND'?></span></p>
					 <form method="post">
						<input type="hidden" name="product_stock" value="<?php echo $result['productQuantity']?>">
						<input type="hidden" name="quantity" value="1"/>
						<input type="hidden" name="productId" value="<?php echo $result['productId']?>"/>
						<input type="submit" name="themgiohang" value="Thêm giỏ hàng" class="button"/>
					 </form>
<<<<<<< HEAD
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['productId']?>" class="details">Details</a></span></div>
=======
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['productId']?>" class="details">Xem</a></span></div>
>>>>>>> f77bac6 (tien)
				</div>
				<?php
					}
				}
				?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
<<<<<<< HEAD
    		<h3>New Products</h3>
=======
    		<h3>Sản Phẩm Mới</h3>
>>>>>>> f77bac6 (tien)
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php
					$product_new = $product->get_product_new();
					if ($product_new){
						while ($result_new = $product_new->fetch_assoc()){
				?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php"><img src="admin/uploads/<?php echo $result_new['image']?>" alt="Ảnh sản phẩm" /></a>
					 <h2><?php echo $result_new['productName']?></h2>
					 <p><?php echo $fm->textShorten($result_new['product_desc'], 30)?></p>
					 <p><span class="price"><?php echo $result_new['price']." VND"?></span></p>
					 <form method="post">
						<input type="hidden" name="product_stock" value="<?php echo $result_new['productQuantity']?>">
						<input type="hidden" name="quantity" value="1"/>
						<input type="hidden" name="productId" value="<?php echo $result_new['productId']?>"/>
						<input type="submit" name="themgiohang" value="Thêm giỏ hàng" class="button"/>
					 </form>
<<<<<<< HEAD
				     <div class="button"><span><a href="details.php?proid=<?php echo $result_new['productId']?>" class="details">Details</a></span></div>
=======
				     <div class="button"><span><a href="details.php?proid=<?php echo $result_new['productId']?>" class="details">Xem</a></span></div>
>>>>>>> f77bac6 (tien)
				</div>
				<?php
						}
					}
				?>
			</div>
		<div class="">
			<?php
			$product_all = $product->get_all_product();
			$product_count = mysqli_num_rows($product_all);
			$product_button = ceil($product_count/4);
			$i = 1;
			echo '<p>Trang: </p>';
			while ($i <= $product_button){
                echo '<a href="?trang='.$i.'">'.$i.'</a> | ';
                $i++;
            }
			?>
		</div>
    </div>
 </div>

<?php 
	include 'inc/footer.php';
?>