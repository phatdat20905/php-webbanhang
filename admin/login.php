<?php
    include 'inc/header.php';
    $login_check = Session::get('customer_login');
    if($login_check == true) {
        header('Location:order.php');
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        $loginCustomer = $cs->login_customer($_POST);
    }
?>
<div class="main">
    <div class="content">
        <div class="login_panel">
            <h3>Existing Customers</h3>
            <p>Sign in with the form below.</p>
            <?php
            if(isset($loginCustomer)){
                echo $loginCustomer;
            }
            ?>
            <form action="" method="POST">
                <input name="email" type="text" class="field" placeholder="Enter Email...">
                <input name="password" type="password" class="field" placeholder="Enter Password...">
                <p class="note">If you forgot your password just enter your email and click <a href="#">here</a></p>
                <div class="buttons"><input type="submit" class="grey" name="login" value="Sign In"></div>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>
<?php
    include 'inc/header.php';
    $login_check = Session::get('customer_login');
    if($login_check == true) {
        header('Location:order.php');
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        $loginCustomer = $cs->login_customer($_POST);
    }
?>
<div class="main">
    <div class="content">
        <div class="login_panel">
            <h3>Existing Customers</h3>
            <p>Sign in with the form below.</p>
            <?php
            if(isset($loginCustomer)){
                echo $loginCustomer;
            }
            ?>
            <form action="" method="POST">
                <input name="email" type="text" class="field" placeholder="Enter Email...">
                <input name="password" type="password" class="field" placeholder="Enter Password...">
                <p class="note">If you forgot your password just enter your email and click <a href="#">here</a></p>
                <div class="buttons"><input type="submit" class="grey" name="login" value="Sign In"></div>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>
<?php
    include 'inc/header.php';
    $login_check = Session::get('customer_login');
    if($login_check == true) {
        header('Location:order.php');
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        $loginCustomer = $cs->login_customer($_POST);
    }
?>
<div class="main">
    <div class="content">
        <div class="login_panel">
            <h3>Existing Customers</h3>
            <p>Sign in with the form below.</p>
            <?php
            if(isset($loginCustomer)){
                echo $loginCustomer;
            }
            ?>
            <form action="" method="POST">
                <input name="email" type="text" class="field" placeholder="Enter Email...">
                <input name="password" type="password" class="field" placeholder="Enter Password...">
                <p class="note">If you forgot your password just enter your email and click <a href="#">here</a></p>
                <div class="buttons"><input type="submit" class="grey" name="login" value="Sign In"></div>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>
