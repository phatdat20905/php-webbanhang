<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';?>
<?php
	$product = new Product();
	if(isset($_GET['sliderid']) && isset($_GET['type'])){
        $id = $_GET['sliderid'];
		$type = $_GET['type'];
        $updateSlider = $product->updateSlider($id, $type);
	}
	if(isset($_GET['del_slider'])){
		$id = $_GET['del_slider'];
        $deleteSlider = $product->deleteSlider($id);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">
			<?php
				if($deleteSlider){
					echo $deleteSlider;
				}
			?>  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Slider Title</th>
					<th>Slider Image</th>
					<th>Slider Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$product = new Product();
					$getSlider = $product->show_slider_list();
					if ($getSlider){
						$i=0;
						while ($resultSlider = $getSlider->fetch_assoc()){
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $resultSlider['sliderName']?></td>
					<td><img src="uploads/<?php echo $resultSlider['slider_image']?>" height="120px" width="500px"/></td>
					<td>
						<?php 
						if($resultSlider['type'] == 1){
						?>
						<a href="?sliderid=<?php echo $resultSlider['sliderId']?>&type=0">OFF</a> 
						<?php
						}else{
                        ?>
                        <a href="?sliderid=<?php echo $resultSlider['sliderId']?>&type=1">ON</a> 
                        <?php
						}
						?>
					</td>
					<td>
						<a href="?del_slider=<?php echo $resultSlider['sliderId']?>" onclick="return confirm('Are you sure to Delete!');" >Delete</a> 
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
