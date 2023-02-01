<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
include_once '../classes/category.php';
include_once '../classes/brand.php';
include_once '../classes/product.php';
include_once '../helpers/format.php';
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
						<th>Mô tả</th>
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
								<td><img src="uploads/<?php echo $result['image'] ?>" width = '50'></td>
								<td><?php echo $result['catid'] ?></td>
								<td><?php echo $result['brandid'] ?></td>
								<td><?php echo $fm->textShorten($result['description'],100) ?></td>
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
								<td><a href="">Sửa</a> || <a href="">Xóa</a></td>
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