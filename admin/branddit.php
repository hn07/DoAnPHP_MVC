<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php
    $brand = new brand();
if (!isset($_GET['brandid']) || $_GET['brandid'] == NULL) {
    echo "<script>window.location = 'brandlist.php'; </script>";
}else{
    $id = $_GET['brandid'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $brandName = $_POST['brandName'];

    $updateBrand = $brand->update_brand($brandName, $id);
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa thương hiệu</h2>
        <span>
            <?php
            if (isset($update_brand)) {
                echo $update_brand;
            }
            ?>
        </span>
        <?php
        $getBrandName = $brand->getBrandByID($id);
        if ($getBrandName) {
            while ($result = $getBrandName->fetch_assoc()) {

        ?>
                <div class="block copyblock">
                    <form method='post' action="">
                        <table class="form">
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $result['brandName'] ?>" name="brandName" placeholder="Sửa Thương hiệu sản phẩm...." class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table>
                    </form>
            <?php
            }
        }
            ?>
            </div>

    </div>
</div>
<?php include 'inc/footer.php'; ?>