<?php
include 'inc/header.php';
include 'inc/slider.php';
?>
<?php
$login_check = Session::get('login_customer');
if ($login_check ) {
	header('Location:index.php');
} 
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

	$insertCustomer = $cs->insert_customer($_POST);
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {

	$loginCustomer = $cs->login_customer($_POST);
}
?>
<div class="main">
	<div class="content" style="display: flex; flex-wrap: nowrap;">
		<div class="login_panel">
			<h3>Existing Customers</h3>
			<p>Sign in with the form below.</p>
			<?php
			if (isset($loginCustomer)) {
				echo "<br><p>$loginCustomer</p>";
			}
			?>
			<form action="" method="POST">
				<input type="text" name="email" class="field" placeholder="Email..">
				<input type="password" name="password" class="field" placeholder="Password..">
				<p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
				<div class="buttons">
					<div><input type="submit" name="login" value="Đăng nhập" class="grey" style="text-align: center; font-size: 20px; background: #ced8e0; width: 160px;"></input></div>
				</div>
			</form>
		</div>
		<div class="register_account">
			<h3>Register New Account</h3>
			<?php
			if (isset($insertCustomer)) {
				echo $insertCustomer;
			}
			?>
			<form action="" method="POST">
				<table>
					<tbody>
						<tr>
							<td>
								<div>
									<input type="text" name="name" placeholder="Họ và tên ...">
								</div>

								<div>
									<input type="text" name="city" placeholder="Địa chỉ Bưu Chính..">
								</div>

								<div>
									<input type="text" name="zipcode" placeholder="Mã Bưu Chính ...">
								</div>
								<div>
									<input type="text" name="email" placeholder="Email ...">
								</div>
							</td>
							<td>
								<div>
									<input type="text" name="address" placeholder="Địa chỉ...">
								</div>
								<div>
									<select id="country" name="country">
										<option value="null">Thành phố.</option>
										<option value="HCM">Hồ Chí Minh</option>
										<option value="CT">Cần Thơ</option>
										<option value="ĐN">Đà Nẵng</option>
										<option value="HN">Hà Nội</option>


									</select>
								</div>

								<div>
									<input type="text" name="phone" placeholder="Số điện thoại...">
								</div>

								<div>
									<input type="text" name="password" placeholder="Mật khẩu..">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="search">
					<div><button type="sumit" name="submit" value="Đăng ký" class="grey" style="text-align: center; font-size: 20px; background: #ced8e0; width: 160px;">Đăng ký</button></div>
				</div>
				<p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
				<div class="clear"></div>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
include 'inc/footer.php';
?>