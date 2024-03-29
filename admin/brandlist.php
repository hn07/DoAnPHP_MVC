<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php'; ?>
< <?php 
$brand = new brand();
if (isset($_GET['brandid'])) {
	$id = $_GET['brandid'];
	$delBrand = $brand->del_brand($id);
}
?> 

<div class="grid_10">
	<div class="box round first grid">
		<h2>Category List</h2>
		<div class="block">
				<?php 
                     if (isset($delBrand)) {
                     echo $delBrand;
                     }
                ?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Serial No.</th>
						<th>Brand Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$showBrand = $brand->show_brand();
					if ($showBrand) {
						$id = 0;
						while ($result = $showBrand->fetch_assoc()) {
							$id++;

					?>
							<tr class="odd gradeX">
								<td><?php echo $id; ?></td>
								<td><?php echo $result['brandName']; ?></td>
								<td><a href="branddit.php?brandid=<?php echo $result['brandId'] ?>">Edit</a> ||
								 <a onclick="return confirm('Are you want to delete?')" href="?brandid=<?php echo $result['brandId'] ?>">Delete
								</a></td>
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