<!-- dam nhiem danh muc san pham -->
<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . ('/../lib/database.php');
include_once $filepath . ('/../helpers/format.php');
?>


<?php
class cart
{

    private $db;
    private $fm; //format
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function addToCart($quantity, $id)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $sid = session_id();
        $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->select($query)->fetch_assoc();

        // $checkcart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sId = '$sid'";
        // if ($checkcart) {
        //     $msg = "Sản phẩm đã được thêm vào giỏ hàng";
        //     return $msg;
        // } else {
        $image = $result["image"];
        $price = $result["price"];
        $productName = $result["productName"];

        $query_insert = "INSERT INTO tbl_cart(productId,quantity,sId,image,price,productName) 
            VALUES ('$id','$quantity','$sid','$image','$price', '$productName')";
        $insert_cart = $this->db->insert($query_insert);

        if ($result) {
            header('Location:cart.php');
        } else {
            header('Location:404.php');
        }
        // }
    }

    public function get_product_cat()
    {
        $sid = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sid'";
        $result = $this->db->select($query);
        return $result;
    }
    public function UpdateCart($quantity, $cartId)
    {
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $query = "UPDATE tbl_cart SET
            quantity = '$quantity'
            WHERE cartId = '$cartId'";
        $result = $this->db->update($query);
        if ($result != false) {
            header('Location:cart.php');
            $alert = "<span class ='succsess'> Update Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class ='error'>Update NOT Success</span>";
            return $alert;
        }
    }

    public function del_cart($cartId){
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $query = "DELETE FROM tbl_cart WHERE cartId = '$cartId'";
        $result = $this->db->delete($query);
        if($result){
            header('Location:cart.php');

        } else {
            $alert = "<span class ='succsess'>Cart DELETE NOT Success</span>";
            return $alert;
        }
    }
   
       public function check_cart()
    {
        $sid = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sid'";
        $result = $this->db->select($query);
        return $result;
    }
    
}
?>