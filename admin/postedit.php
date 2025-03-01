<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/post.php'?>
<?php
    $post = new Post();
    if(!isset($_GET['catId']) || $_GET['catId'] == NULL) {
        echo "<script>window.location='postlist.php';</script>";
    }else {
        $id = $_GET['catId'];
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$catName = $_POST['catName'];
        $description = $_POST['description'];
        $catStatus = $_POST['catStatus'];
		$updateCat = $post->update_category_post($catName, $description, $catStatus, $id);
    }

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa danh mục tin tức</h2>
               <div class="block copyblock">
               <?php 
                    if(isset($updateCat)){
                        echo $updateCat;
                    }
                ?> 
                <?php 
                    $get_cat_post = $post->get_cat_by_id($id);
                    if($get_cat_post){
                        while($result = $get_cat_post->fetch_assoc()){

                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['title']?>" name="catName" placeholder="Sửa danh mục sản phẩm ..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['description']?>" name="description" placeholder="Nhập mô tả" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name="catStatus">
                                    <?php 
                                        if($result['status'] == 1){
                                    ?>
                                        <option selected value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    <?php 
                                        }else{
                                    ?>
                                            <option value="1">Hiển thị</option>
                                            <option selected value="0">Ẩn</option>
                                    <?php
                                        }    
                                    ?>
                                </select>
                            </td>
                        </tr>
						<tr> 
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
<?php include 'inc/footer.php';?>