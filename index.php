<?php
include 'inc/header.php';
include 'inc/slider.php';
?>
<?php
$login_check = Session::get('login_customer');
if ($login_check == false) {
	header('Location:login.php');
}
?>

<div class="main">

	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Sản phẩm nỗi bật</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<section style="background-color: #eee;">
				<div class="text-center container py-3">
					<div class="row">
						<?php
						$Product_feathered = $product->getproducts_feathered();
						if ($Product_feathered) {
							while ($result = $Product_feathered->fetch_assoc()) {
						?>
								<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
									<div class="card rounded" style="width:fit-content; height: fit-content;">
										<div class="bg-image hover-zoom ripple" data-mdb-ripple-color="light">
											<a href="details.php?productid=<?php echo $result['productId'] ?>"><img class="rounded-top" src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
											<a href="details.php?productid=<?php echo $result['productId'] ?>">
												<div class="mask">
													<div class="d-flex justify-content-start align-items-end h-100">
														<h5>
															<span class="badge bg-success ms-2">Eco</span><span class="badge bg-danger ms-2">-10%</span>
														</h5>
													</div>
												</div>
												<div class="hover-overlay">
													<div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
												</div>
											</a>
										</div>
										<div class="card-body">
											<div class="text-reset" style="height: 68px;">
												<h3 class="card-title mb-3"><?php echo $fm->textShorten($result['productName'], 15) ?></h3>
											</div>
											<s><?php echo $fm->product_price($result['price'] * 1.3) . " VNĐ" ?></s>
											<div href="" class="text-reset">
												<h3 style="color: red;"><?php echo $fm->product_price($result['price']) . " VNĐ" ?></h3>
											</div>
											<!-- <a href="" class="text-reset">
                                                <p class="mb-3"><?php echo $fm->textShorten($result['description'], 30) ?></p>
                                            </a> -->

											<a href="details.php?productid=<?php echo $result['productId'] ?>" ><input type="submit" class="buysubmit" name="submit" value="Đặt hàng" /></a>
											
										</div>

									</div>
								</div>
						<?php
							}
						}
						?>
					</div>
				</div>
			</section>
		</div>
		<div class="content_bottom">
			<div class="heading">
				<h3>Sản phẩm mới</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<section style="background-color: #eee;">
				<div class="text-center container py-3">
					<div class="row">
						<?php
						$Product_new = $product->getproducts_new();
						if ($Product_new) {
							while ($result_new = $Product_new->fetch_assoc()) {
						?>
								<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
									<div class="card" style="width:fit-content; height: fit-content;">
										<div class="bg-image hover-zoom ripple" data-mdb-ripple-color="light">
											<a href="details.php?productid=<?php echo $result_new['productId'] ?>"><img style="height: 255px; width: 400px;" src="admin/uploads/<?php echo $result_new['image'] ?>" alt="" /></a>
											<a href="details.php?productid=<?php echo $result_new['productId'] ?>">
												<div class="mask">
													<div class="d-flex justify-content-start align-items-end h-100">
														<h5>
															<span class="badge bg-success ms-2">Eco</span><span class="badge bg-danger ms-2">-10%</span>
														</h5>
													</div>
												</div>
												<div class="hover-overlay">
													<div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
												</div>
											</a>
										</div>
										<div class="card-body">
											<div class="text-reset" style="height: 68px;">
												<h3 class="card-title mb-3"><?php echo $fm->textShorten($result_new['productName'], 25) ?></h3>
											</div>
											<s><?php echo $fm->product_price($result_new['price'] * 1.3) . " VNĐ" ?></s>
											<div href="" class="text-reset">
												<h3 style="color: red;"><?php echo $fm->product_price($result_new['price']) . " VNĐ" ?></h3>
											</div>

											<button type="button" class="btn btn-primary"><a class="text-reset" href="details.php?productid=<?php echo $result_new['productId'] ?>" class="details">Đặt hàng</a></button>

										</div>

									</div>
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