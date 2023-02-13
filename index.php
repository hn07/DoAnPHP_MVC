<?php
include 'inc/header.php';
include 'inc/slider.php';
?>


<div class="main" >
	
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Sản phẩm nỗi bật</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$Product_feathered = $product->getproducts_feathered();
			if ($Product_feathered) {
				while ($result = $Product_feathered->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php?productid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
						<h2><?php echo $result['productName'] ?></h2>
						<p><?php echo $fm->textShorten($result['description'],50) ?></p>
						<p><span class="price"><?php echo $result['price']." VNĐ" ?></span></p>
						<div class="button"><span><a href="details.php?productid=<?php echo $result['productId'] ?>" class="details">Details</a></span></div>
					</div>
					
			<?php
				}
			}
			?>
		</div>
		<div class="content_bottom">
			<div class="heading">
				<h3>Sản phẩm mới</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$Product_new = $product->getproducts_new();
			if ($Product_new) {
				while ($result_new = $Product_new->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php?productid=<?php echo $result_new['productId'] ?>"><img src="admin/uploads/<?php echo $result_new['image'] ?>" alt="" /></a>
						<h2><?php echo $result_new['productName'] ?></h2>
						<p><?php echo $fm->textShorten($result_new['description'],50) ?></p>
						<p><span class="price"><?php echo $result_new['price']." VNĐ" ?></span></p>
						<div class="button"><span><a href="details.php?productid=<?php echo $result_new['productId'] ?>" class="details">Details</a></span></div>
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