<!-- dam nhiem danh muc san pham -->
<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath.('/../lib/database.php');
include_once $filepath.('/../helpers/format.php');
?>


<?php
class category
{

    private $db;
    private $fm; //format
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_category($catName)
    {
        // kiem tra hop le cua catName
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);

        if (empty($catName)) {
            $alert = "Category must be not empty";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_category(catName) VALUES ('$catName')";
            $result = $this->db->insert($query);

            if ($result != false) {
                $alert = "<span class ='succsess'> Insert Category Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class ='succsess'> Insert Category NOT Success</span>";
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
                $alert = "<span class ='error'>Category UPDATE NOT Success</span>";
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
            $alert = "<span class ='error'>Category DELETE NOT Success</span>";
            return $alert;
        }
    }
}
?>