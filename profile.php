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

<div class="main">
    <div class="content">
        <div class="section group">
            <table class="table table-striped">
                <?php
                $id = Session::get('id_customer');
                $get_customer_profile = $cs->showCustomerProfile($id);
                if ($get_customer_profile) {
                    while ($result = $get_customer_profile->fetch_assoc()) {

                ?>
                        <tr>
                            <td colspan="3">
                                <h2 style="font-size: 28px;" href="editprofile.php">My Profile</h2>
                            </td>

                        </tr>
                        <tr>
                            <td style="display: flex; justify-content: left;">> Tên</td>
                            <td>:</td>
                            <td style="display: flex; justify-content: left;"><?php echo $result['name'] ?></td>
                        </tr>
                        <tr>
                            <td style="display: flex; justify-content: left;">> Địa chỉ </td>
                            <td>:</td>
                            <td style="display: flex; justify-content: left;"><?php echo $result['address'] ?></td>
                        </tr>
                        <tr>
                            <td style="display: flex; justify-content: left;">> Thành phố</td>
                            <td>:</td>
                            <td style="display: flex; justify-content: left;"><?php echo $result['city'] ?></td>
                        </tr>
                        <tr>
                            <td style="display: flex; justify-content: left;">> Số điện thoại</td>
                            <td>:</td>
                            <td style="display: flex; justify-content: left;"><?php echo $result['phone'] ?></td>
                        </tr>
                        <tr>
                            <td style="display: flex; justify-content: left;">> Email</td>
                            <td>:</td>
                            <td style="display: flex; justify-content: left;"><?php echo $result['email'] ?></td>
                        </tr>
                        <tr>
                            <td style="display: flex; justify-content: left;">> Địa chỉ bưu chính</td>
                            <td>:</td>
                            <td style="display: flex; justify-content: left;"><?php echo $result['country'] ?></td>
                        </tr>
                        <tr>
                            <td style="display: flex; justify-content: left;">> Mã bưu chính</td>
                            <td>:</td>
                            <td style="display: flex; justify-content: left;"><?php echo $result['zipcode'] ?></td>
                        </tr>
                        <tr>
                            <!-- <button type="button" class="btn btn-primary"><a href="editprofile.php">Đặt hàng</a></button> -->

                            <td colspan="3"><button type="button" class="btn btn-primary"><a class="text-reset" href="editprofile.php">Đặt hàng</a></button></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
    <?php
    include 'inc/footer.php';
    ?>