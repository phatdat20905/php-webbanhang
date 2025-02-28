<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
	if(isset($_GET['proid'])) {
		$customer_id = Session::get('customer_id');
        $proid = $_GET['proid'];
		$delwishlist = $product->delete_wishlist($proid, $customer_id);
    }
?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Wishlist</h2>
						<table class="tblone">
							<tr>
								<th width="10%">ID Compare</th>
								<th width="10%">Product Name</th>
								<th width="40%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Action</th>
							</tr>
							<?php
							$customer_id = Session::get('customer_id');
							$get_wishlist = $product->get_wishlist($customer_id);
							if($get_wishlist){
								$i = 0;
								while($result = $get_wishlist->fetch_assoc()){
									$i++;
							?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $result['productName']?></td>
								<td><img src="admin/uploads/<?php echo $result['image']?>" alt="Ảnh sản phẩm"/></td>
								<td><?php echo $result['price'].' VND'?></td>
								<td>
									<a href="details.php?proid=<?php echo $result['productId']?>">Buy Now</a> ||
									<a href="?proid=<?php echo $result['productId']?>">Delete</a>
								</td>
							</tr>
							<?php
								}
							}
							?>
					   </table>
			</div>
				<div class="shopping">
					<div class="shopleft">
						<a href="index.php"> <img src="images/shop.png" alt="" /></a>
					</div>
				</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php 
	include 'inc/footer.php';
?>