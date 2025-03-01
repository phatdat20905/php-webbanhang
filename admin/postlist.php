<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/post.php';?>
<?php 
	$post = new Post();
	if(isset($_GET['delId'])) {
        $id = $_GET['delId'];
		$delcatpost = $post->delete_category_post($id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category Post List</h2>
                <div class="block"> 
				<?php 
                    if(isset($delcatpost)){
                        echo $delcatpost;
                    }
                ?>        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Post Name</th>
							<th>Category Post Desc</th>
							<th>Category Post Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<t>
						<?php 
							$show_cat = $post->show_category_post();
							if($show_cat){
                                $i = 0;
                                while($result = $show_cat->fetch_assoc()){
                                    $i++;
                        ?>
							<tr class="odd gradeX">
								<td><?php echo $i?></td>
								<td><?php echo $result['title']?></td>
								<td><?php echo $result['description']?></td>
								<td>
									<?php 
                                        if($result['status'] == 0) {
                                            echo "Ẩn";
                                        } else {
                                            echo "Hiển thị";
                                        }
                                   ?>
                                </td>
								</td>
								<td><a href="postedit.php?catId=<?php echo $result['id_cate_post']?>">Edit</a> || <a  
										onclick="return confirm('Are you sure you want to delete <?php echo $result['title']?>?')"
										href="?delId=<?php echo $result['id_cate_post']?>">Delete
									</a>
								</td>
							</tr>
						<?php
								}
							}

						?>    
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

