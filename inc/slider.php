<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php
				$getLastestDell = $product->getLastestDell();
				if ($getLastestDell){
					while ($resultdell = $getLastestDell->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php"> <img src="admin/uploads/<?php echo $resultdell['image']?>" alt="Ảnh sản phẩm" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $resultdell['productName']?></h2>
						<p><?php echo $resultdell['product_desc']?></p>
<<<<<<< HEAD
						<div class="button"><span><a href="details.php?proid=<?php echo $resultdell['productId']?>">Add to cart</a></span></div>
=======
						<div class="button"><span><a href="details.php?proid=<?php echo $resultdell['productId']?>">Thêm Giỏ Hàng</a></span></div>
>>>>>>> f77bac6 (tien)
				   </div>
			   </div>			
			   <?php 
					}}  
			   ?>
				<?php
				$getLastestSS = $product->getLastestSS();
				if ($getLastestSS){
					while ($resultSS = $getLastestSS->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php"> <img src="admin/uploads/<?php echo $resultSS['image']?>" alt="Ảnh sản phẩm" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $resultSS['productName']?></h2>
						<p><?php echo $resultSS['product_desc']?></p>
<<<<<<< HEAD
						<div class="button"><span><a href="details.php?proid=<?php echo $resultSS['productId']?>">Add to cart</a></span></div>
=======
						<div class="button"><span><a href="details.php?proid=<?php echo $resultSS['productId']?>">Thêm Giỏ Hàng</a></span></div>
>>>>>>> f77bac6 (tien)
				   </div>
			   </div>			
			   <?php 
					}}  
			   ?>
			</div>
			<div class="section group">
			<?php
				$getLastestApple = $product->getLastestApple();
				if ($getLastestApple){
					while ($resultApple = $getLastestApple->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php"> <img src="admin/uploads/<?php echo $resultApple['image']?>" alt="Ảnh sản phẩm" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $resultApple['productName']?></h2>
						<p><?php echo $resultApple['product_desc']?></p>
<<<<<<< HEAD
						<div class="button"><span><a href="details.php?proid=<?php echo $resultApple['productId']?>">Add to cart</a></span></div>
=======
						<div class="button"><span><a href="details.php?proid=<?php echo $resultApple['productId']?>">Thêm Giỏ Hàng</a></span></div>
>>>>>>> f77bac6 (tien)
				   </div>
			   </div>			
			   <?php 
					}}  
			   ?>
				<?php
				$getLastestMSI = $product->getLastestMSI();
				if ($getLastestMSI){
					while ($resultMSI = $getLastestMSI->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php"> <img src="admin/uploads/<?php echo $resultMSI['image']?>" alt="Ảnh sản phẩm" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $resultMSI['productName']?></h2>
						<p><?php echo $resultMSI['product_desc']?></p>
<<<<<<< HEAD
						<div class="button"><span><a href="details.php?proid=<?php echo $resultMSI['productId']?>">Add to cart</a></span></div>
=======
						<div class="button"><span><a href="details.php?proid=<?php echo $resultMSI['productId']?>">Thêm Giỏ Hàng</a></span></div>
>>>>>>> f77bac6 (tien)
				   </div>
			   </div>			
			   <?php 
					}}  
			   ?>
			</div>
		  <div class="clear"></div>
		</div>
		<div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
					<?php
						$getSlider = $product->show_slider();
						if ($getSlider){
							while ($resultSlider = $getSlider->fetch_assoc()){
						?>
						<li><img src="admin/uploads/<?php echo $resultSlider['slider_image']?>" alt="<?php echo $resultSlider['sliderName']?>"/></li>
						<?php 
							}
						}
						?>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	