<?php
include 'lib/session.php';
Session::init();
//check nếu đã đăng nhập thành công ->được vào trang index
?>
<?php
include_once 'lib/database.php';
include_once 'helpers/format.php';

spl_autoload_register(function ($class) {
	include_once "classes/" . $class . ".php";
});

$db = new Database();
$fm = new Format();
$us = new User();
$ct = new cart();
$cs = new customer();
$cat = new category();
$product = new product();
$brand = new brand();
?>
<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>


<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE php>

<head>
	<title>Store Website</title>
	<meta http-equiv="Content-Type" content="text/php; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<script src="js/jquerymain.js"></script>
	<script src="js/script.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/nav.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript" src="js/nav-hover.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
	<link rel="SHORTCUT ICON" href="images/logo.png">

	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
	<!-- Font Awesome -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
	<!-- MDB -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" /><!-- MDB -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function($) {
			$('#dc_mega-menu-orange').dcMegaMenu({
				rowItems: '4',
				speed: 'fast',
				effect: 'fade'
			});
		});
	</script>
</head>

<body>
	<div class="wrap">
		<div class="header">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" style="width: 150px;height: 100px;" alt="" /></a>
			</div>
			<div class="header_top_right">
				<div class="search_box">
					<form class="d-flex input-group w-auto">
						<input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
						<span class="input-group-text border-0" id="search-addon">
							<i class="fas fa-search"></i>
						</span>
					</form>
				</div>

				<div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
							<span class="cart_title">Cart</span>
							<span class="no_product">
								<?php
								$check_cart = $ct->check_cart();
								if ($check_cart) {
									$sum = Session::get("sum");
									echo $fm->product_price($sum);
								} else {
									echo "empty";
								}
								?>
							</span>
						</a>
					</div>
				</div>

				<?php
				if (isset($_GET['customerid'])) {
					$del_cart = $ct->del_all_data_cart();
					Session::destroy();
				}
				?>
				<div class="btn bg-danger">
					<?php
					$login_check = Session::get('login_customer');
					if ($login_check == false) {
						echo '<a href ="login.php">Đăng nhập</a>';
					} else {
						echo '<a href="?customerid=' . Session::get('id_customer') . '">Đăng xuất</a>';
					}
					?>

				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="menu">
			<ul id="dc_mega-menu-orange" class="dc_mm-orange">

				<li><a href="index.php">Home</a></li>
				<li><a href="products.php">Products</a> </li>
				<li><a href="cart.php">Cart</a></li>

				<?php
				$login_check = Session::get('login_customer');
				if ($login_check == false) {
					echo '';
				} else {
					echo '<li><a href="profile.php">Profile</a></li>';
				}
				?>

				<li><a href="contact.php">Contact</a> </li>
				<div class="clear"></div>
			</ul>
		</div>