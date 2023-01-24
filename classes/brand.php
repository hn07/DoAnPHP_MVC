<!-- dam nhiem danh muc san pham -->
<?php
include '../lib/database.php';
include '../helpers/format.php';
?>


<?php
class brand
{

    private $db;
    private $fm; //format
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_brand($brandName)
    {
        // kiem tra hop le cua brandName
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);

        if (empty($brandName)) {
            $alert = "Brand must be not empty";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_brand(brandName) VALUES ('$brandName')";
            $result = $this->db->insert($query);

            if ($result != false) {
                $alert = "<span class ='succsess'> Insert Brand Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class ='succsess'> Insert Brand NOT Success</span>";
                return $alert;
            }
        }
    }
    public function show_brand()
    {
        //chon tat car trong bang tbl_brand va sap xep theo id
        $query = "SELECT * FROM tbl_brand order by brandId desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function getBrandByID($id)
    {
        $query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_brand($brandName, $id)
    {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($brandName)) {
            $alert = "Brand must be not empty";
            return $alert;
        } else {
            $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$id'";
            $result = $this->db->update($query);

            if ($result != false) {
                $alert = "<span class ='succsess'> Update Brand Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class ='error'>Brand UPDATE NOT Success</span>";
                return $alert;
            }
        }
    }

    public function del_brand($id){
        $query = "DELETE FROM tbl_brand WHERE brandId = '$id'";
        $result = $this->db->delete($query);
        if($result){
            $alert = "<span class ='succsess'> Delete Category Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class ='succsess'>Category DELETE NOT Success</span>";
            return $alert;
        }
    }
}
?>