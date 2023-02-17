<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php
if (!isset($_GET['productid']) || $_GET['productid'] == NULL) {
	echo "<script>window.location = '404.php'; </script>";
} else {
	$id = $_GET['productid'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
	$quantity = $_POST['quantity'];
	$Addcart = $ct->addToCart($quantity,$id);
}
?>
<div class="main">
	<div class="content">
		<div class="section group">
			<?php
			$get_product_detail = $product->getproducts_detail($id);
			if ($get_product_detail) {
				while ($result_details = $get_product_detail->fetch_assoc()) {

			?>
					<div class="cont-desc">
						<div class="grid images_3_of_2">
							<img src="admin/uploads/<?php echo $result_details['image'] ?>" alt="" style="object-fit: scale-down;" />
						</div>
						<div class="desc span_3_of_2">
							<h2><?php echo $result_details['productName'] ?></h2>
							<p><?php echo $fm->textShorten($result_details['description']) ?></p>
							<div class="price">
								<p>Price: <span><?php echo $result_details['price'] . " VNĐ" ?></span></p>
								<p>Category: <span><?php echo $result_details['catName'] ?></span></p>
								<p>Brand:<span><?php echo $result_details['brandName'] ?></span></p>
							</div>
							<div class="add-cart">
								<form action="" method="post">
									<input type="number" class="buyfield" name="quantity" value="1" min="1" />
									<input type="submit" class="buysubmit" name="submit" value="Buy Now" />
								</form>
									<?php
									if(isset($Addcart)){
										echo "<hr>";
										echo "<span style = 'color: blue'>Sản phẩm đã được thêm thành công</span>";
									}
									?>
							</div>
						</div>
						<div class="product-desc">
							<h2>Product Details</h2>
							<p><?php echo $result_details['description']?></p>
						</div>

					</div>
			<?php
				}
			}
			?>

		</div>
	</div>
	<?php
	include 'inc/footer.php';
	?>