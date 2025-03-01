<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
    if(isset($_GET['cartid'])) {
        $cartId = $_GET['cartid'];
		$delcart = $ct->delete_product_cart($cartId);
    }
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
		$cartId = $_POST['cartId'];
		$stock = $_POST['stock'];
		$quantity = $_POST['quantity'];
		$updateQuantityCart = $ct->update_quantity_cart($quantity, $cartId, $stock);
		if($quantity == 0) {
			$delcart = $ct->delete_product_cart($cartId);
		}
    }
?>
<?php
	if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
	}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
					<?php
						if(isset($updateQuantityCart)){
							echo $updateQuantityCart;
						}
						if(isset($delcart)){
							echo $delcart;
						}
					?>
						<table class="tblone">
							<tr>
								<th width="20%">Product Name</th>
								<th width="20%">Product Stock</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Buy</th>
								<th width="10%">Action</th>
							</tr>
							<?php
							$get_product_cart = $ct->get_product_cart();
							if($get_product_cart){
								$subtotal = 0;
								$qty = 0;
								while($result = $get_product_cart->fetch_assoc()){
							?>
							<tr>
								<td><?php echo $result['productName']?></td>
								<td><?php echo $result['stock']?></td>
								<td><img src="admin/uploads/<?php echo $result['image']?>" alt="Ảnh sản phẩm"/></td>
								<td><?php echo $fm->format_currency($result['price']).' VND'?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId']?>"/>
										<input type="hidden" name="stock" value="<?php echo $result['stock']?>"/>
										<input type="number" name="quantity" min="0" value="<?php echo $result['quantity']?>"/>
										<input type="submit" name="submit" value="Cập nhật"/>
									</form>
								</td>
								<td>
								<?php
								$total = $result['price'] * $result['quantity'];
								echo $total;
								?>
								</td>
								<td>
								<form>
									<input type="checkbox" 
									<?php echo $result['status'] == 1 ? 'checked' : ''?> 
									class="buy_checked" id="buy" name="buy" value="<?php echo $result['cartId']?>">
									<label for="buy">Mua hàng</label><br>
								</form>
								</td>
								<td><a onclick="return confirm('Are you sure you want to delete <?php echo $result['productName']?>?')"
									href="?cartid=<?php echo $result['cartId']?>">Xóa</a></td>
							</tr>
							<?php
								$subtotal += $total;
								$qty = $qty + $result['quantity'];
								}
							}
							?>
					   </table>
					   <?php 
							$check_cart = $ct->check_cart();
							if($check_cart) {
						?>
					   <table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>
								<?php 
								
								echo $subtotal;
								Session::set('sum', $subtotal);
								Session::set('qty', $qty);
								?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>
									<?php 
                                    $vat = $subtotal * 0.1;
                                    echo $subtotal + $vat;
                                    ?> 
                                    </td>
								</td>
							</tr>
					   </table>
					   <?php
							}else{
								echo "Your Cart is Empty! Please Shopping Now!";
							}  
					   ?>
			</div>
				<div class="shopping">
					<div class="shopleft">
						<a href="index.php"> <img src="images/shop.png" alt="" /></a>
					</div>
					<div class="shopright">
						<a href="payment.php"> <img src="images/check.png" alt="" /></a>
					</div>
				</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

 <?php 
	include 'inc/footer.php';
?>