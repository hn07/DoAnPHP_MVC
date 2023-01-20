<?php
include '../lib/session.php';
Session::checkLogin();
// kiem tra dang nhap
include '../lib/database.php';
include '../helpers/format.php';
?>


<?php
   class adminlogin{

    private $db;
    private $fm; //format
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function loginAdmin($adminUser, $adminPass)
    {
        // kiem tra hop le cua user va pass
        $adminUser = $this->fm->validation($adminUser);
        $adminPass = $this->fm->validation($adminPass);


        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

        if(empty($adminUser) || empty($adminPass)){
            $alert = "User and password not empty";
            return $alert;
        }
        else{
            $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass'";
            $result = $this->db->select($query);

            if($result != false){
                $value = $result->fetch_assoc(); //hàm tìm nạp một hàng kết quả dưới dạng một mảng kết hợp

                Session::set('adminlogin', true);

                Session::set('adminId', $value['adminId']);
                Session::set('adminUser', $value['adminUser']);
                Session::set('adminName', $value['adminName']);
                header('Location:index.php'); //quay ve trang 
            }
            else{
                $alert = "User or password not match";
                return $alert;
            }
        }
    }


   }
    

?>