<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php $brand = new brand();
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$brandName = $_POST['brandName'];

		$insertBrand = $brand->insert_brand($brandName);
   }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm thương hiệu</h2>
                <span>
                    <?php 
                        if (isset($insertBrand)) {
                        echo $insertBrand;
                        }
                    ?>
                </span>
               <div class="block copyblock"> 
                 <form method='post' action="brandadd.php">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name ="brandName" placeholder="Thêm thương hiệu sản phẩm...." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Lưu" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>