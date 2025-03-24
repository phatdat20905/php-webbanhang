<?php
	include 'inc/header.php';
?>
<?php 
	$login_check = Session::get('customer_login');
	if($login_check) {
		header('Location: order.php');
		exit();
	}

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
		$loginCustomer = $cs->login_customer($_POST);
	}
?>
<div class="main">
    <div class="content">
        <div class="login_panel">
            <h3>Đăng nhập</h3>
            <p>Đăng nhập theo mẫu dưới đây.</p>
            <?php
                if(isset($loginCustomer)){
                    echo $loginCustomer;
                }
            ?>
            <form action="" method="POST">
                <input name="email" type="text" class="field" placeholder="Nhập Email..." required>
                <input name="password" type="password" class="field" placeholder="Nhập mật khẩu..." required>
                <p class="note">Nếu bạn quên mật khẩu, nhập email của bạn và nhấp <a href="#">vào đây.</a></p>
                <div class="buttons"><input type="submit" class="grey" name="login" value="Đăng nhập"></div>
            </form>
            <p>Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
        </div>
    </div>
</div>
<?php 
	include 'inc/footer.php';
?>
