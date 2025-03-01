<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/post.php';?>
<?php include '../classes/blog.php';?>
<?php include_once '../helpers/format.php';?>
<?php 
	$blog = new Blog();
	$fm = new Format();
	if(isset($_GET['blogId'])) {
        $id = $_GET['blogId'];
		$delpro = $blog->delete_blog($id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Blog List</h2>
        <div class="block">
		<?php 
			if(isset($delpro)){
				echo $delpro;
			}
		?>    
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Blog Title</th>
					<th>Blog Image</th>
					<th>Blog Desc</th>
					<th>Blog Content</th>
					<th>Category Post</th>
					<th>Blog Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$bloglist = $blog->show_blog();
					if($bloglist){
						$i = 0;
                        while($result = $bloglist->fetch_assoc()){
							$i++;
                ?>
				<tr class="odd gradeX">
					<td><?php echo $i?></td>
					<td><?php echo $result['blog_title']?></td>
					<td><img src="uploads/<?php echo $result['image']?>" alt="Ảnh sản phẩm" width="80"></td>
					<td><?php echo $fm->textShorten($result['description'], 20)?></td>
					<td><?php echo $fm->textShorten($result['content'], 20)?></td>
					<td><?php echo $result['title']?></td>
					<td>
						<?php 
							if($result['status'] == 1){
								echo "Hiển thị";
							} else {
								echo "Ẩn";
							}
						?>
					</td>
					<td><a href="blogedit.php?blogId=<?php echo $result['id']?>">Edit</a> || <a  
							onclick="return confirm('Are you sure you want to delete <?php echo $result['title']?>?')"
							href="?blogId=<?php echo $result['id']?>">Delete
						</a>
					</td>
				</tr>
				<?php } }?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
