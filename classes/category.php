<!-- dam nhiem danh muc san pham -->
<?php
include '../lib/database.php';
include '../helpers/format.php';
?>


<?php
   class category{

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

        if(empty($catName)){
            $alert = "Category must be not empty";
            return $alert;
        }
        else{
            $query = "INSERT INTO tbl_category(catName) VALUES ('$catName')";
            $result = $this->db->insert($query);

            if($result != false){
                $alert = "<span class ='succsess'> Insert Category Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class ='succsess'> Insert Category NOT Success</span>";
                return $alert;
            }
            
        }
    }


   }
    

?>