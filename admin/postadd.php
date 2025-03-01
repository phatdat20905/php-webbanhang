<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/post.php'?>
<?php
    $post = new Post();
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$catName = $_POST['catName'];
        $description = $_POST['description'];
        $catStatus = $_POST['catStatus'];
		$insertCatPost = $post->insert_categor_post($catName, $description, $catStatus);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm danh mục</h2>
               <div class="block copyblock">
               <?php 
                    if(isset($insertCatPost)){
                        echo $insertCatPost;
                    }
                ?> 
                 <form action="postadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" placeholder="Nhập danh mục" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="description" placeholder="Nhập mô tả" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name="catStatus">
                                    <option value="1">Hiển thị</option>
                                    <option value="0">Ẩn</option>
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
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>