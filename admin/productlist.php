<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
include_once '../classes/category.php';
include_once '../classes/brand.php';
include_once '../classes/product.php';
include_once '../helpers/format.php';
?>
< <?php 
$pd = new product();
if (isset($_GET['productid'])) {
	$id = $_GET['productid'];
	$delproduct = $pd->del_product($id);
}
?> 
<div class="grid_10">
	<div class="box round first grid">
		<h2>Danh sách bài đăng</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Thứ tự</th>
						<th>Tên sản phẩm</th>
						<th>Giá</th>
						<th>Hình ảnh</th>
						<th>Danh mục</th>
						<th>Thương hiệu</th>
						<th>Loại</th>
						<th>Tùy chỉnh</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$pd = new product();
					$fm = new Format();
					$pdlist = $pd->show_product();
					if ($pdlist) {
						$id = 0;
						while ($result = $pdlist->fetch_assoc()) {
							$id +=1;
					?>
							<tr class="odd gradeX">
								<td><?php echo $id ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><?php echo $result['price'] ?></td>
								<td><img src="uploads/<?php echo $result['image'] ?>" width = '80' ></td>
								<td><?php echo $result['catName'] ?></td>
								<td><?php echo $result['brandName'] ?></td>
								<td class="center">
								<?php 
								if($result['type'] == 0){
									echo 'Không nỗi bật';
								}
								else{
									echo 'Nỗi bật';
								}
								?>
								</td>
								<td><a href="productedit.php?productid=<?php echo $result['productId'] ?>">Sửa</a> || <a href="?productid=<?php echo $result['productId'] ?>">Xóa</a></td>
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
	$(document).ready(function() {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>