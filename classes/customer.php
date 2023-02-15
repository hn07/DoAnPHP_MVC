<!-- dam nhiem danh muc san pham -->
<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . ('/../lib/database.php');
include_once $filepath . ('/../helpers/format.php');
?>


<?php
class customer
{

    private $db;
    private $fm; //format
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_customer($data)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if ($name == "" || $city == "" || $zipcode == "" || $email == "" || $address == "" || $country == "" || $phone == ""|| $password == "") {
            $alert = "<span class ='error_span'>Các trường không được trống!</span>";
            return $alert;
        }else{
            $check_email = "SELECT * FROM tbl_customer WHERE email = '$email' limit 1";
            $result_check = $this->db->select($check_email);
            if($result_check){
                $alert = "<span class ='error_span'>Email đã tồn tại</span>";
                return $alert;
            }else {
                $query = "INSERT INTO tbl_customer(name,address,city, country, zipcode, phone, email, password ) 
                VALUES ('$name','$address','$city','$country','$zipcode','$phone','$email','$password')";
                $result = $this->db->insert($query);
    
                if ($result != false) {
                    $alert = "<span class ='succsess'> Đăng ký thành công</span>";
                    return $alert;
                } else {
                    $alert = "<span class ='error'> Đăng ký thành công</span>";
                    return $alert;
                }
            }
        }
    }
    public function login_customer($data){
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if ($password =='' || $email =='') {
            $alert = "<span class ='error_span'>Email hoặc Password không được để trống </span>";
            return $alert;
        }else{
            $check_email = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password' ";
            $result_check = $this->db->select($check_email);
            if($result_check){
                $result = $result_check->fetch_assoc();
                Session::set('login_customer',true);
                Session::set('id_customer',$result['id']);
                Session::set('name_customer',$result['name']);
                header('Location:index.php');
            }else {
                $alert = "<span class ='error_span'>Email hoặc Password không trùng khớp</span>";
                return $alert;
            }
        }
    }
}
?>