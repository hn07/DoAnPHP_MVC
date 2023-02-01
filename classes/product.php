<!-- dam nhiem san pham -->
<?php
include_once '../lib/database.php';
include_once '../helpers/format.php';
?>


<?php
class product
{

    private $db;
    private $fm; //format
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_product($data, $files)
    {
        $proName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $proBrand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $prodCategory = mysqli_real_escape_string($this->db->link, $data['category']);
        $proDesc = mysqli_real_escape_string($this->db->link, $data['description']);
        $proPrice = mysqli_real_escape_string($this->db->link, $data['price']);
        $proType = mysqli_real_escape_string($this->db->link, $data['type']);

        // kiem tra va lay hinh anh cho vao folder upload
        $permited = array('jpg','png','jpeg','gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'. $file_ext;
        $uploadde_image = 'uploads/'.$unique_image;

        if ($proName == "" ||$proBrand == "" ||$prodCategory == "" ||$proDesc == "" ||$proPrice == "" ||$proType == ""|| $file_name == "") {
            $alert = "Các trường không được rỗng";
            return $alert;
        } else {
            // có hình anh sẽ đưa vào folder uploads
            move_uploaded_file($file_temp, $uploadde_image);
            $query = "INSERT INTO tbl_product(productName,catid,brandid,description,type,price, image) 
            VALUES ('$proName','$prodCategory','$proBrand','$proDesc','$proType','$proPrice','$unique_image')";
            $result = $this->db->insert($query);

            if ($result != false) {
                $alert = "<span class ='succsess'> Insert Product Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class ='error'> Insert Product NOT Success</span>";
                return $alert;
            }
        }
    }
    public function show_product()
    {
        //chon tat car trong bang tbl_product va sap xep theo id
        $query = "SELECT * FROM tbl_product order by catId desc";
        $result = $this->db->select($query);
        return $result;
    }
    // public function getCatByID($id)
    // {
    //     $query = "SELECT * FROM tbl_category WHERE catId = '$id'";
    //     $result = $this->db->select($query);
    //     return $result;
    // }

    // public function update_category($catName, $id)
    // {
    //     $catName = $this->fm->validation($catName);
    //     $catName = mysqli_real_escape_string($this->db->link, $catName);
    //     $id = mysqli_real_escape_string($this->db->link, $id);

    //     if (empty($catName)) {
    //         $alert = "Category must be not empty";
    //         return $alert;
    //     } else {
    //         $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id'";
    //         $result = $this->db->update($query);

    //         if ($result != false) {
    //             $alert = "<span class ='succsess'> Update Category Successfully</span>";
    //             return $alert;
    //         } else {
    //             $alert = "<span class ='error'>Category UPDATE NOT Success</span>";
    //             return $alert;
    //         }
    //     }
    // }

    // public function del_category($id){
    //     $query = "DELETE FROM tbl_category WHERE catId = '$id'";
    //     $result = $this->db->delete($query);
    //     if($result){
    //         $alert = "<span class ='succsess'> Delete Category Successfully</span>";
    //         return $alert;
    //     } else {
    //         $alert = "<span class ='error'>Category DELETE NOT Success</span>";
    //         return $alert;
    //     }
    // }
}
?>