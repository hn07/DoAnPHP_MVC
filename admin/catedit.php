<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php'; ?>
<?php
    $cat = new category();
if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
    echo "<script>window.location = 'catlist.php'; </script>";
}else{
    $id = $_GET['catid'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $catName = $_POST['catName'];

    $updateCat = $cat->update_category($catName, $id);
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa danh mục</h2>
        <span>
            <?php
            if (isset($update_category)) {
                echo $update_category;
            }
            ?>
        </span>
        <?php
        $getCatName = $cat->getCatByID($id);
        if ($getCatName) {
            while ($result = $getCatName->fetch_assoc()) {

        ?>
                <div class="block copyblock">
                    <form method='post' action="">
                        <table class="form">
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $result['catName'] ?>" name="catName" placeholder="Sửa mục sản phẩm...." class="medium" />
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