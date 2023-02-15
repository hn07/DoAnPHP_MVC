<!-- dam nhiem san pham -->
<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . ('/../lib/database.php');
include_once $filepath . ('/../helpers/format.php');

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
        $permited = array('jpg', 'png', 'jpeg', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploadde_image = 'uploads/' . $unique_image;

        if ($proName == "" || $proBrand == "" || $prodCategory == "" || $proDesc == "" || $proPrice == "" || $proType == "" || $file_name == "") {
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
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName

        FROM tbl_product INNER JOIN tbl_category ON  tbl_product.catId = tbl_category.catId 

        INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId 

        ORDER BY tbl_product.productId desc";

        $result = $this->db->select($query);
        return $result;
    }
    public function getProductByID($id)
    {
        $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_product($data, $files, $id)
    {
        $proName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $proBrand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $prodCategory = mysqli_real_escape_string($this->db->link, $data['category']);
        $proDesc = mysqli_real_escape_string($this->db->link, $data['description']);
        $proPrice = mysqli_real_escape_string($this->db->link, $data['price']);
        $proType = mysqli_real_escape_string($this->db->link, $data['type']);

        // kiem tra va lay hinh anh cho vao folder upload
        $permited = array('jpg', 'png', 'jpeg', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploadde_image = 'uploads/' . $unique_image;

        if ($proName == "" || $proBrand == "" || $prodCategory == "" || $proDesc == "" || $proPrice == "" || $proType == "") {
            $alert = "Các trường không được rỗng";
            return $alert;
        } else {
            if (!empty($file_name)) {
                // neu nguoi dung chon anh
                if ($file_size > 10.240) {
                    $alert = "<span class ='succsess'>Tập tin hình ảnh nên có kích thước dưới 2MB </span>";
                    return $alert;
                } elseif (in_array($file_ext, $permited) === false) {
                    $alert = "<span class ='succsess'>Chỉ được up load các file có phần mở rộng là: " . implode(', ', $permited) . "</span>";
                    return $alert;
                }
                $query = "UPDATE tbl_product SET productName = '$proName',catid = '$prodCategory',brandid = '$proBrand', description = '$proDesc', type = '$proType', price = '$proPrice',image = '$unique_image' WHERE productId = '$id'";
            } else {
                // neu nguoi dung kh chon anh

                $query = "UPDATE tbl_product SET productName = '$proName', catid = '$prodCategory', brandid = '$proBrand', description = '$proDesc', type = '$proType', 
            price = '$proPrice'

            WHERE productId = '$id'";
            }
        }
        $result = $this->db->update($query);

        if ($result != false) {
            $alert = "<span class ='succsess'> Update   Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class ='error'>Update NOT Success</span>";
            return $alert;
        }
    }

    public function del_product($id)
    {
        $query = "DELETE FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class ='succsess'> Delete Product Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class ='error'>Product DELETE NOT Success</span>";
            return $alert;
        }
    }

    // ================================================================= Fontend =================================================================

    public function getproducts_feathered()
    {
        $query = "SELECT * FROM tbl_product WHERE type = 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function getproducts_new()
    {
        $query = "SELECT * FROM tbl_product WHERE type = 0";
        $result = $this->db->select($query);
        return $result;
    }
    public function getproducts_detail($id)
    {
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName

        FROM tbl_product INNER JOIN tbl_category ON  tbl_product.catId = tbl_category.catId 

        INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId 
        WHERE tbl_product.productId = '$id' ";

        $result = $this->db->select($query);
        return $result;
    }
}
?>