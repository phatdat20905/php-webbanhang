﻿<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/product.php';?>
<?php
    $pd = new Product();
    if(!isset($_GET['productId']) || $_GET['productId'] == NULL) {
        echo "<script>window.location='productlist.php';</script>";
    }else {
        $id = $_GET['productId'];
    }
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
		$updateProduct = $pd->update_product($_POST, $_FILES, $id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm sản phẩm</h2>
        <div class="block">
        <?php 
            if(isset($updateProduct)){
                echo $updateProduct;
            }
        ?>
        <?php
            $get_product_by_id = $pd->get_product_by_id($id);
            if($get_product_by_id){
                while($result_product = $get_product_by_id->fetch_assoc()){
        ?>                
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result_product['productName']?>" name="productName" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Product Quantity</label>
                    </td>
                    <td>
                        <input type="number" name="productQuantity" min="1" value="<?php echo $result_product['productQuantity']?>" placeholder="Nhập số lượng..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>Select Category</option>
                            <?php 
                                $cat = new Category();
                                $catlist = $cat->show_category();
                                if ($catlist){
                                    while($result = $catlist->fetch_assoc()){
                            ?>
                            <option 
                            <?php
                            if($result['catId'] == $result_product['catId']){ echo 'selected';}
                            ?>
                            value="<?php echo $result['catId']?>"><?php echo $result['catName']?></option>
                            
                            <?php 
                                } 
                            }
                            ?> 
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brand">
                            <option>Select Brand</option>
                            <?php 
                                $brand = new Brand();
                                $brandlist = $brand->show_brand();
                                if ($brandlist){
                                    while($result = $brandlist->fetch_assoc()){
                            ?>
                            <option 
                            <?php
                            if($result['brandId'] == $result_product['brandId']){ echo 'selected';}
                            ?>
                            value="<?php echo $result['brandId']?>"><?php echo $result['brandName']?></option>
                            <?php 
                                } 
                            }
                            ?> 
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="product_desc"><?php echo $result_product['product_desc']?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result_product['price']?>" name="price" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="uploads/<?php echo $result_product['image']?>" alt="Ảnh sản phẩm" width="80">
                        <input type="file" name="image"/>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php 
                                if($result_product['type'] == 1){
                            ?>
                                <option selected value="1">Featured</option>
                                <option value="0">Non-Featured</option>
                            <?php 
                                }else{
                            ?>
                                    <option value="1">Featured</option>
                                    <option selected value="0">Non-Featured</option>
                            <?php
                                }    
                            ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


