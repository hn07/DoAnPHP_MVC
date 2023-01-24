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
    public function show_category()
    {
        //chon tat car trong bang tbl_category va sap xep theo id
        $query = "SELECT * FROM tbl_category order by catId desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function getCatByID($id)
    {
        $query = "SELECT * FROM tbl_category WHERE catId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_category($catName, $id)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($catName)) {
            $alert = "Category must be not empty";
            return $alert;
        } else {
            $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id'";
            $result = $this->db->update($query);

            if ($result != false) {
                $alert = "<span class ='succsess'> Update Category Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class ='succsess'>Category UPDATE NOT Success</span>";
                return $alert;
            }
        }
    }

    public function del_category($id){
        $query = "DELETE FROM tbl_category WHERE catId = '$id'";
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