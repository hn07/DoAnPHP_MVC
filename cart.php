<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<div class="main">
	<div class="content">
		<div class="cartoption">
			<div style="display: flex; justify-content: center; align-items: center;">
				<h2>Giỏ Hàng Của Bạn</h2>
			</div>
			<div class="cartpage">
				<table class="tblone">
					<tr>
						<th width="20%">Tên Sản Phẩm</th>
						<th width="10%">Hình Ảnh</th>
						<th width="15%">Giá Sản Phẩm</th>
						<th width="25%">Số Lượng</th>
						<th width="20%">Tổng Giá</th>
						<th width="10%">Xóa Khỏi</th>
					</tr>
					<?php
					$get_product_cat = $ct->get_product_cat();
					if ($get_product_cat) {
						$sub_total = 0;
						while ($result = $get_product_cat->fetch_assoc()) {


					?>
							<tr>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></td>
								<td><?php echo $result['price'] ?></td>
								<td>
									<form action="" method="post">
										<input type="number" name="quantity" min="1" value="<?php echo $result['quantity'] ?>" />
										<input type="submit" name="submit" value="Update" />
									</form>
								</td>
								<td><?php
									$total_price = ((int)$result['price'] * (int)$result['quantity']);
									echo $total_price;
									?></td>
								<td><a href="">X</a></td>
							</tr>
					<?php
							$sub_total += $total_price;
						}
					}
					$vat = $sub_total * 0.1;
					$Grand_Total = $sub_total + $vat;
					?>
				</table>
				<table style="float:right;text-align:left;" width="40%">
					<tr>
						<th>Tổng Thu : </th>
						<td><?php echo $sub_total ?> vnđ </td>
					</tr>
					<tr>
						<th>Thuế VAT 10% : </th>
						<td><?php echo $vat ?> vnđ</td>
					</tr>
					<tr>
						<th>Tổng Hóa Đơn :</th>
						<td><?php echo $Grand_Total ?> vnđ </td>
					</tr>
				</table>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="login.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
include 'inc/footer.php';
?>