<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/customer.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php
    $cs = new Customer();
    $fm = new Format();
    if(!isset($_GET['customerid']) || $_GET['customerid'] == NULL) {
        echo "<script>window.location='inbox.php';</script>";
    }else {
        $id = $_GET['customerid'];
        $order_code = $_GET['order_code'];
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
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa danh mục</h2>
               <div class="block copyblock">
                <?php 
                    $get_customer = $cs->getCustomerById($id);
                    if($get_customer){
                        while($result = $get_customer->fetch_assoc()){
                ?>
                 <form action="" method="post">
                    <h3>Thông tin người đặt</h3>
                    <table class="form">					
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['name']?>" name="name" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['phone']?>" name="phone" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['city']?>" name="city" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['country']?>" name="country" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['address']?>" name="address" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Zipcode</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['zipcode']?>" name="zipcode" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['email']?>" name="email" class="medium" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php 
                        }
                    }
                    ?>
                </div>
                <table>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Giá sản phẩm</th>
                        <th>Số lượng sản phẩm</th>
                        <th>Thành tiền</th>
                    </tr>
                    <?php 
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
                        <td><img src="uploads/<?php echo $result_order['image']?>" alt="Ảnh sản phẩm" width="80"></td>
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
<?php include 'inc/footer.php';?>