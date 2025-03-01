<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/post.php';?>
<?php include '../classes/blog.php';?>
<?php
    $blog = new Blog();
    if(!isset($_GET['blogId']) || $_GET['blogId'] == NULL) {
        echo "<script>window.location='bloglist.php';</script>";
    }else {
        $id = $_GET['blogId'];
    }
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
		$updateBlog = $blog->update_blog($_POST, $_FILES, $id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa tin tức</h2>
        <div class="block">
        <?php 
            if(isset($updateBlog)){
                echo $updateBlog;
            }
        ?>
        <?php
            $get_blog_by_id = $blog->get_blog_by_id($id);
            if($get_blog_by_id){
                while($result_product = $get_blog_by_id->fetch_assoc()){
        ?>                
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Blog Title</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result_product['blog_title']?>" name="blog_title" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category Post</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>Select Category</option>
                            <?php 
                                $post = new Post();
                                $catlist = $post->show_category_post();
                                if ($catlist){
                                    while($result = $catlist->fetch_assoc()){
                            ?>
                            <option 
                            <?php
                            if($result['id_cate_post'] == $result_product['category_post']){ echo 'selected';}
                            ?>
                            value="<?php echo $result['id_cate_post']?>"><?php echo $result['title']?></option>
                            
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
                        <textarea class="tinymce" name="description"><?php echo $result_product['description']?></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="content"><?php echo $result_product['content']?></textarea>
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
                        <label>Blog Status</label>
                    </td>
                    <td>
                        <select id="select" name="status">
                            <option>Select Type</option>
                            <?php 
                                if($result_product['status'] == 1){
                            ?>
                                <option selected value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            <?php 
                                }else{
                            ?>
                                    <option value="1">Hiển thị</option>
                                    <option selected value="0">Ân</option>
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


