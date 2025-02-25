<?php 

    include '../lib/database.php';
    include '../helpers/format.php';
?>
<?php
    class Brand 
    {   
        private $db;
        public $fm;
        
        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }

        
        public function insert_brand($brandName) {
            $brandName = $this->fm->validation($brandName);

            $brandName = mysqli_real_escape_string($this->db->link, $brandName);
            
            if(empty($brandName)) {
                $alert = "<span class='error'>Brand must be not empty</span>";
                return $alert;
            } else {
                $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
                $result = $this->db->insert($query);
                
                if($result) {
                    $alert = "<span class='success'>Brand Inserted Successfully</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Brand Insert Failed</span>";
                    return $alert;    
                }
            }
        }
        
        public function show_brand() {
            $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function update_brand($brandName, $brandId) {
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);
            
            $brandId = mysqli_real_escape_string($this->db->link, $brandId);
            if(empty($brandName)) {
                $alert = "<span class='error'>Brand must be not empty</span>";
                return $alert;
            } else {
                $query = "UPDATE tbl_brand SET brandName='$brandName' WHERE brandId='$brandId'";
                $result = $this->db->update($query);
                
                if($result) {
                    $alert = "<span class='success'>Brand Updated Successfully</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Brand Update Failed</span>";
                    return $alert;    
                }
            }
        }
        
        public function delete_brand($brandId) {
            
            $query = "DELETE FROM tbl_brand WHERE brandId = '$brandId'";
            $result = $this->db->delete($query);
            
            if($result) {
                $alert = "<span class='success'>Brand Deleted Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Brand Delete Failed</span>";
                return $alert;    
            }
        }
        
        public function get_brand_by_id($brandId) {
            $query = "SELECT * FROM tbl_brand WHERE brandId = '$brandId'";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>