<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
    if(!isset($_GET['orderid']) || $_GET['orderid'] =='order') {
		$customer_id = Session::get('customer_id');
		$inserOrder = $ct->insertOrder($customer_id);
		// $delcart = $ct->del_all_data_cart();
		// header('Location:success.php');
	}
?>
<style type="text/css">
	.box_left {
		float: left;
        width: 50%;
		border: 1px solid #666;
		padding: 4px;
	}
	.box_right {
        float: right;
        width: 45%;
        border: 1px solid #666;
		padding: 4px;
    }
	a.submit_order {
		background-color: red;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
	}
</style>
<form action="" method="POST">
	<div class="main">
		<div class="content">
			<div class="section group">
				<div class="heading">
					<h3>Offline Payment</h3>
				</div>
				<div class="clear"></div>
				<div class="box_left">
					<div class="cartpage">
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
									<th width="5%">ID</th>
									<th width="15%">Product Name</th>
									<th width="15%">Price</th>
									<th width="25%">Quantity</th>
									<th width="20%">Total Price</th>
								</tr>
								<tr>
								<?php
								$get_product_cart = $ct->get_product_cart_checkout();
								if($get_product_cart){
									$subtotal = 0;
									$qty = 0;
									$i = 0;
									while($result = $get_product_cart->fetch_assoc()){
										$i++;
								?>	
									<td><?php echo $i?></td>
									<td><?php echo $result['productName']?></td>
									<td><?php echo $result['price'].' VND'?></td>
									<td><?php echo $result['quantity']?></td>
									<td>
									<?php
									$total = $result['price'] * $result['quantity'];
									echo $total.' VND';
									?>
									</td>
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
							<table style="float:right;text-align:left;margin: 5px;" width="40%">
								<tr>
									<th>Sub Total : </th>
									<td>
									<?php 
									
									echo $subtotal.' VND';
									Session::set('sum', $subtotal);
									Session::set('qty', $qty);
									?></td>
								</tr>
								<tr>
									<th>VAT : </th>
									<td>10% (<?php echo $vat = $subtotal *0.1;?>)</td>
								</tr>
								<tr>
									<th>Grand Total :</th>
									<td>
										<?php 
										$vat = $subtotal * 0.1;
										$gtotal = $subtotal + $vat;
										echo $gtotal.' VND';
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
				</div>
				<div class="box_right">
					<table class="tblone">
						<?php 
						$id = Session::get('customer_id');
						$get_customers = $cs->getCustomerById($id);
						if($get_customers){
							while($result = $get_customers->fetch_assoc()){
						?>
						<tr>
							<td>Name</td>
							<td>:</td>
							<td><?php echo $result['name']?></td>
						</tr>
						<tr>
							<td>Address</td>
							<td>:</td>
							<td><?php echo $result['address']?></td>
						</tr>
						<tr>
							<td>City</td>
							<td>:</td>
							<td><?php echo $result['city']?></td>
						</tr>
						<tr>
							<td>Country</td>
							<td>:</td>
							<td><?php echo $result['country']?></td>
						</tr>
						<tr>
							<td>Zipcode</td>
							<td>:</td>
							<td><?php echo $result['zipcode']?></td>
						</tr>
						<tr>
							<td>Phone</td>
							<td>:</td>
							<td><?php echo $result['phone']?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td><?php echo $result['email']?></td>
						</tr>
						<td colspan="3"><a href="editprofile.php">Update Profile</a></td>
						<?php } }?>
					</table>
				</div>		
			</div>	
		</div>
		<center><a href="?orderid=order" class="submit_order">Order Now</a></center>
	</div>
</form>
<?php 
	include 'inc/footer.php';
?>
	