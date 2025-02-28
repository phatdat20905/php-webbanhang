<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<style type="text/css">
	h2.success_order {
		text-align: center;
        font-size: 30px;
        color: #333;
        margin-bottom: 30px;
        margin-top: 30px;
        font-weight: bold;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
        margin-bottom: 20px;
        margin-top: 20px;
        padding-top: 10px;
        padding-left: 15px;
        padding-right: 15px;
        background-color: #f7f7f7;
        border-radius: 5px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
	}
	p.success_note {
		text-align: center;
        font-size: 18px;
        color: #333;
        margin-bottom: 30px;
        margin-top: 30px;
        font-weight: bold;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
        margin-bottom: 20px;
        margin-top: 20px;
        padding-top: 10px;
        padding-left: 15px;
        padding-right: 15px;
        background-color: #f7f7f7;
        border-radius: 5px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        margin-bottom: 10px;
	}
</style>
<form action="" method="POST">
	<div class="main">
		<div class="content">
			<div class="section group">
				<h2 class="success_order">Success Order</h2>
				<?php
				$customer_id = Session::get('customer_id');
				$get_amount = $ct->getAmountPrice($customer_id);
				if($get_amount) {
					$amount = 0;
					while($result = $get_amount->fetch_assoc()) {
						$price = $result['price'];
						$amount += $price; 
					}
				}
				?>
				<p class="success_note">Total Price You Have Bought From My Website: 
					<?php
						$vat = $amount * 0.1;
						$total_amount = $amount + $vat;
						echo $total_amount.' VND';
					?>
				</p>
				<p class="success_note">We will contact as soon as possiable. Please see your order details here <a href="orderdetails.php">Click here</a></p>
			</div>	
		</div>
	</div>
</form>
<?php 
	include 'inc/footer.php';
?>
	