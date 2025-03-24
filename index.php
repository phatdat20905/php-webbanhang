<?php
	include 'inc/header.php';
	include 'inc/slider.php';
?>
<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading"><h3>Sản phẩm nổi bật</h3></div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
            $product_featured = $product->get_product_featured();
            if ($product_featured){
                while ($result = $product_featured->fetch_assoc()){
            ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="details.php"><img src="admin/uploads/<?php echo $result['image']?>" alt="Ảnh sản phẩm" /></a>
                <h2><?php echo $result['productName']?></h2>
                <p><?php echo $fm->textShorten($result['product_desc'], 30)?></p>
                <p><span class="price"><?php echo $fm->format_currency($result['price']).' VND'?></span></p>
                <form method="post">
                    <input type="hidden" name="product_stock" value="<?php echo $result['productQuantity']?>">
                    <input type="hidden" name="quantity" value="1"/>
                    <input type="hidden" name="productId" value="<?php echo $result['productId']?>"/>
                    <input type="submit" name="themgiohang" value="Thêm giỏ hàng" class="button"/>
                </form>
                <div class="button"><a href="details.php?proid=<?php echo $result['productId']?>" class="details">Chi tiết</a></div>
            </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php 
	include 'inc/footer.php';
?>
