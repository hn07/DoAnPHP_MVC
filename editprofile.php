<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php
$login_check = Session::get('login_customer');
if ($login_check == false) {
    header('Location:login.php');
}
?>
<?php
    $id = Session::get('id_customer');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {

    $updateCustomer = $cs->update_customer($_POST,$id);
}
?>

<div class="main">
    <div class="content">
        <div class="section group">
            <form action="" method="post">
            <table class="tblone">
                <?php
                $id = Session::get('id_customer');
                $get_customer_profile = $cs->showCustomerProfile($id);
                if ($get_customer_profile) {
                    while ($result = $get_customer_profile->fetch_assoc()) {

                ?>
                        <tr>
                            <td colspan="3"><h2 style="font-size: 28px;" href="editprofile.php">Update My Profile</h2></td>
                            <td>
                                <?php
                                if(isset($updateCustomer)){
                                   echo $updateCustomer;
                                }
                                ?>
                            </td>

                        </tr>
                        <tr>
                            <td style="display: flex; justify-content: left;">>Tên</td>
                            <td>:</td>
                            <td style="display: flex; justify-content: left;"><input type="text" name = 'name' value = '<?php echo $result['name'] ?>'></td>
                            </tr>
                        <tr>
                            <td style="display: flex; justify-content: left;">>Địa chỉ </td>
                            <td>:</td>
                            <td style="display: flex; justify-content: left;"><input type="text" name = 'address' value = '<?php echo $result['address'] ?>'></td>
                            
                        </tr>
                        <tr>
                            <td style="display: flex; justify-content: left;">>Số điện thoại</td>
                            <td>:</td>
                            <td style="display: flex; justify-content: left;"><input type="text" name = 'phone' value = '<?php echo $result['phone'] ?>'></td>
                        </tr>
                        <tr>
                            <td style="display: flex; justify-content: left;">>Email</td>
                            <td>:</td>
                            <td style="display: flex; justify-content: left;"><input type="text" name = 'email' value = '<?php echo $result['email'] ?>'></td>
                        </tr>
                        <tr>
                            <td style="display: flex; justify-content: left;">>Địa chỉ bưu chính</td>
                            <td>:</td>
                            <td style="display: flex; justify-content: left;"><input type="text" name = 'country' value = '<?php echo $result['country'] ?>'></td>
                        </tr>
                        <tr>
                            <td style="display: flex; justify-content: left;">>Mã bưu chính</td>
                            <td>:</td>
                            <td style="display: flex; justify-content: left;"><input type="text" name = 'zipcode' value = '<?php echo $result['zipcode'] ?>'></td>
                        </tr>
                        <tr>
                            <td colspan="3"><input type="submit" name="save" value="Save"></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </table>
            </form>
        </div>
    </div>
    <?php
    include 'inc/footer.php';
    ?>