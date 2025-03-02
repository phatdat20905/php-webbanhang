<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
	$login_check = Session::get('customer_login');
	if($login_check==false){
		header('Location: login.php');
	}
?>
<?php 
	if(isset($_GET['confirm'])){
		$id = $_GET['confirm'];
		$confirm_recieved = $ct->confirm_recieved($id);
		if($confirm_recieved){
            echo "<script>window.location='history_order.php';</script>";
        }
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
				<h3>Lịch sử đơn hàng</h3>
				</div>
				<div class="clear"></div>
				<div class="wrapper_method">
					<table id="example">
						<thead>
							<tr>
								<th>No.</th>
								<th>Order Time</th>
								<th>Order Code</th>
								<th>Customer Name</th>
								<th>Action</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$ct = new Cart();
							$fm = new Format();
							$get_inbox_cart = $ct->get_inbox_cart_history(Session::get('customer_id'));
							if($get_inbox_cart){
								$i = 0;
								while($result = $get_inbox_cart->fetch_assoc()){
									$i++;
							?>
							<tr class="odd gradeX">
								<td><?php echo $i;?></td>
								<td><?php echo $fm->formatDate($result['date_created'])?></td>
								<td><?php echo $result['order_code']?></td>
								<td><?php echo $result['name']?></td>
								<td><a href="hisrory_order_details.php?customerid=<?php echo $result['customer_id']?>&order_code=<?php echo $result['order_code']?>">View Order</a></td>
								<td>
									<?php
										if($result['status'] == 1){
										?>
										<a href="?confirm=<?php echo $result['order_code']?>">Đã nhận hàng</a>
									<?php
										} elseif($result['status'] == 2){
											echo 'Đơn thành công';
										}
										?>
								</td>
							</tr>
							<?php }}?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
	include 'inc/footer.php';
?>
	