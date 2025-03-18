<?php
    include 'inc/header.php';
    
    if(isset($_GET['cartid'])) {
        $cartId = $_GET['cartid'];
        $delcart = $ct->delete_product_cart($cartId);
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $cartId = $_POST['cartId'];
        $stock = $_POST['stock'];
        $quantity = $_POST['quantity'];
        
        if($quantity == 0) {
            $delcart = $ct->delete_product_cart($cartId);
        } else {
            $updateQuantityCart = $ct->update_quantity_cart($quantity, $cartId, $stock);
        }
    }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5 cart-container">
        <h2 class="cart-title">🛒 Giỏ hàng của bạn</h2>
        <?php
            if(isset($updateQuantityCart)) echo "<div class='alert alert-success'>$updateQuantityCart</div>";
            if(isset($delcart)) echo "<div class='alert alert-danger'>$delcart</div>";
        ?>
        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead class="table-primary">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Kho hàng</th>
                        <th>Hình ảnh</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng giá</th>
                        <th>Mua</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $get_product_cart = $ct->get_product_cart();
                    if($get_product_cart){
                        $subtotal = 0;
                        while($result = $get_product_cart->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $result['productName']; ?></td>
                        <td><?php echo $result['stock']; ?></td>
                        <td><img src="admin/uploads/<?php echo $result['image']; ?>" class="img-thumbnail" width="80"></td>
                        <td><strong><?php echo number_format($result['price']); ?> VND</strong></td>
                        <td>
                            <form action="" method="post" class="d-flex align-items-center justify-content-center">
                                <input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>">
                                <input type="hidden" name="stock" value="<?php echo $result['stock']; ?>">
                                <input type="number" name="quantity" class="form-control w-50 text-center" min="0" value="<?php echo $result['quantity']; ?>">
                                <button type="submit" name="submit" class="btn btn-primary btn-sm ms-2">Cập nhật</button>
                            </form>
                        </td>
                        <td><strong><?php echo number_format($result['price'] * $result['quantity']); ?> VND</strong></td>
                        <td>
                            <input type="checkbox" class="form-check-input" <?php echo $result['status'] == 1 ? 'checked' : ''; ?>>
                        </td>
                        <td>
                            <a href="?cartid=<?php echo $result['cartId']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa <?php echo $result['productName']; ?>?')">Xóa</a>
                        </td>
                    </tr>
                    <?php
                        $subtotal += $result['price'] * $result['quantity'];
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php if($ct->check_cart()) { ?>
        <div class="row justify-content-end">
            <div class="col-md-4">
                <table class="table table-bordered">
                    <tr>
                        <th>Tạm tính:</th>
                        <td><strong><?php echo number_format($subtotal); ?> VND</strong></td>
                    </tr>
                    <tr>
                        <th>VAT (10%):</th>
                        <td><strong><?php echo number_format($vat = $subtotal * 0.1); ?> VND</strong></td>
                    </tr>
                    <tr>
                        <th>Tổng cộng:</th>
                        <td><strong class="text-danger"><?php echo number_format($subtotal + $vat); ?> VND</strong></td>
                    </tr>
                </table>
            </div>
        </div>
        <?php } else { echo "<div class='alert alert-warning text-center'>🛍 Giỏ hàng của bạn đang trống!</div>"; } ?>
        <div class="d-flex justify-content-between mt-4">
            <a href="index.php" class="btn btn-outline-primary btn-custom">🛒 Tiếp tục mua sắm</a>
            <a href="payment.php" class="btn btn-success btn-custom">💳 Thanh toán</a>
        </div>
    </div>
    <?php include 'inc/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>