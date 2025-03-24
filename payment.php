<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
    // if(!isset($_GET['proid']) || $_GET['proid'] == NULL) {
    //     echo "<script>window.location='404.php';</script>";
    // }else {
    //     $id = $_GET['proid'];
    // }
	// if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
	// 	$quantity = $_POST['quantity'];
	// 	$AddtoCart = $ct->add_to_cart($quantity, $id);
    // }
	$login_check = Session::get('customer_login');
	if($login_check==false){
		header('Location: login.php');
	}
?>
<style>
	h3.payment{
		text-align: center;
		font-size: 20px;
		font-weight: bold;
		text-decoration: underline;
	}
	.wrapper_method{
        text-align: center;
		padding: 20px;
		margin: 0 auto;
		border: 1px solid #ccc;
		width: 550px;
		background: cornsilk;
    }
	.wrapper_method a{
		padding: 10px;
        background-color: red;
		color: #fff;
    }
	.wrapper_method h3{
        margin-bottom: 20px;
    }
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
			<div class="content_top">
				<div class="heading">
				<h3>Phương thức thanh toán</h3>
				</div>
				<div class="clear"></div>
				<div class="wrapper_method">
					<h3>Chọn phương thức thanh toán của bạn:</h3>
                    <a href="offlinepayment.php">Thanh toán khi nhận hàng</a>
                    <a href="onlinepayment.php">Thanh toán online</a> <br><br><br>
					<a href="cart.php" style="background-color: grey;"><< Previous</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
	include 'inc/footer.php';
?>
	