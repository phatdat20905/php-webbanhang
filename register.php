<?php
	include 'inc/header.php';
?>
<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
		$insertCustomer = $cs->insert_customer($_POST);
	}
?>
<div class="main">
    <div class="content">
        <div class="register_account">
            <h3>Đăng ký tài khoản mới</h3>
            <?php
                if(isset($insertCustomer)){
                    echo $insertCustomer;
                }
            ?>
            <form action="" method="POST">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <div><input type="text" name="name" placeholder="Nhập tên..." required></div>
                                <div><input type="text" name="city" placeholder="Nhập thành phố..." required></div>
                                <div><input type="text" name="zipcode" placeholder="Nhập mã Zip..." required></div>
                                <div><input type="text" name="email" placeholder="Nhập Email..." required></div>
                            </td>
                            <td>
                                <div><input type="text" name="address" placeholder="Nhập địa chỉ..." required></div>
                                <div>
                                    <select id="country" name="country" required>
                                        <option value="">Chọn thành phố</option>         
                                        <option value="HCM">Tp.Hồ Chí Minh</option>
                                        <option value="DN">Tp.Đà Nẵng</option>
                                        <option value="HN">Hà Nội</option>
                                    </select>
                                </div>		        
                                <div><input type="text" name="phone" placeholder="Nhập SĐT..." required></div>
                                <div><input type="password" name="password" placeholder="Nhập mật khẩu..." required></div>
                            </td>
                        </tr> 
                    </tbody>
                </table> 
                <div class="submit">
  
  <p>Bằng cách nhấp vào 'Tạo tài khoản' bạn đồng ý với <a href="#">Điều khoản & Điều kiện</a>.</p>
  <input type="submit" value="Tạo tài khoản" class="btn">
</div>

            </form>
            <p>Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
        </div>
    </div>
</div>
<?php 
	include 'inc/footer.php';
?>
