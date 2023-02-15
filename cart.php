<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
	$cartId = $_POST['cartId'];
	$quantity = $_POST['quantity'];
	$UpdateCart = $ct->UpdateCart($quantity, $cartId);
	if ($quantity <= 0) {
		$delCart = $ct->del_cart($cartId);
	}
}
?>
<?php
if (!isset($_GET['id'])) {
	echo "<meta http-equiv='refresh' content='0;url=?id=live'>";
}
?>
<?php
if (isset($_GET['cartId'])) {
	$cartId = $_GET['cartId'];
	$delCart = $ct->del_cart($cartId);
}
?>
<div class="main">
	<div class="content">
		<div class="cartoption">
			<div style="display: flex; justify-content: center; align-items: center;">
				<h2>Giỏ Hàng Của Bạn</h2>
			</div>
			<?php
			if (isset($UpdateCart)) {
				echo $UpdateCart;
			}
			?>
			<?php
			if (isset($del_cart)) {
				echo $del_cart;
			}
			?>
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
								<td><?php
									echo $fm->product_price($result['price']);
									?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" min="0" value="<?php echo $result['cartId'] ?>" />
										<input type="number" name="quantity" min="0" value="<?php echo $result['quantity'] ?>" />
										<input type="submit" name="submit" value="Update" />
									</form>
								</td>
								<td><?php
									$total_price = ((int)$result['price'] * (int)$result['quantity']);
									echo $fm->product_price($total_price);
									?></td>
								<td><a onclick="return confirm('Are you want to delete?')" href="?cartId=<?php echo $result['cartId'] ?>">X</a></td>

							</tr>
					<?php
							$sub_total += $total_price;
						}
					}

					?>
				</table>
				<?php
				$check_cart = $ct->check_cart();
				if ($check_cart) {
					$vat = $sub_total * 0.1;
					$Grand_Total = $sub_total + $vat;
				?>
					<table style="float:right;text-align:left;" width="40%">
						<tr>
							<th>Tổng Thu : </th>
							<td>
								<?php
								echo $fm->product_price($sub_total);
								Session::set('sum', $sub_total);
								?> </td>
						</tr>
						<tr>
							<th>Thuế VAT 10% : </th>
							<td><?php echo $fm->product_price($vat);
								?></td>
						</tr>
						<tr>
							<th>Tổng Hóa Đơn :</th>
							<td><?php echo $fm->product_price($Grand_Total);
								?></td>
						</tr>
					</table>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="login.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
				<?php
				} else {
					echo "<h2 style='width: 100%; font-size: 25px;'>Không có sản phẩm nào trong giỏ hàng</h2>";				
				?>
				<div class="shop" style="display: flex; justify-content: center;">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<?php 
				}
				?>
			</div>

		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
include 'inc/footer.php';
?>