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
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

tr:hover {background-color: coral;}
</style>

 <div class="main">
    <div class="content">
    	<div class="section group">
			<div class="content_top">
				<div class="heading">
				<h3>Lịch sử đơn hàng chi tiết</h3>
				</div>
				<div class="clear"></div>
				<div class="wrapper_method">
                <table>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Giá sản phẩm</th>
                        <th>Số lượng sản phẩm</th>
                        <th>Thành tiền</th>
                    </tr>
                    <?php 
                        $order_code = $_GET['order_code'];
                        $get_order = $cs->show_order($order_code);
                        $subtotal = 0;
                        $total = 0;
                        if($get_order){
                            while($result_order = $get_order->fetch_assoc()){
                                $subtotal += $result_order['price'] * $result_order['quantity'];
                                $total += $subtotal;
                    ?>
                    <tr>
                        <td><?php echo $result_order['productName']?></td>
                        <td><img src="admin/uploads/<?php echo $result_order['image']?>" alt="Ảnh sản phẩm" width="80"></td>
                        <td><?php echo $fm->format_currency($result_order['price']).' VND'?></td>
                        <td><?php echo $result_order['quantity']?></td>
                        <td><?php echo $fm->format_currency($subtotal).' VND'?></td>
                    </tr>
                    <?php
                            }
                        }
                    ?>
                    <tr>
                        <td colspan="5">Thành tiền: <?php echo $total?></td>
                    </tr>
                </table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
	include 'inc/footer.php';
?>
	