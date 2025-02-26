<?php 

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php
    class Cart 
    {   
        private $db;
        public $fm;
        
        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }
        
        public function add_to_cart($quantity, $id) {
            $quantity = $this->fm->validation($quantity);
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $id = mysqli_real_escape_string($this->db->link, $id);
            $sId = session_id();
            
            $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->select($query)->fetch_assoc();

            $productName = $result['productName'];
            $price = $result['price'];
            $image = $result['image'];

            // $check_cart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sId = '$sId'";
            // if($check_cart){
            //     $msg = "Product Already Exists";
            //     return $msg;
            // } else {
                $query_insert = "INSERT INTO tbl_cart(productId,sId,productName,price,quantity,image) 
                VALUES('$id','$sId', '$productName', '$price','$quantity', '$image')";
                $insert_cart = $this->db->insert($query_insert);
                
                if($insert_cart) {
                    header('Location:cart.php');
                } else {
                    header('Location:404.php');
                }
            // }
        }
        
        public function get_product_cart() {
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function update_quantity_cart($quantity, $cartId) {
            $quantity = $this->fm->validation($quantity);
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $cartId = mysqli_real_escape_string($this->db->link, $cartId);
            
            $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = '$cartId'";
            $result = $this->db->update($query);
            
            if($result) {
                $msg = "<span class='success'>Cart quantity updated successfully</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Cart quantity update failed</span>";
                return $msg;
            }
        }
        
        public function delete_product_cart($cartId) {
            $cartId = mysqli_real_escape_string($this->db->link, $cartId);
            
            $query = "DELETE FROM tbl_cart WHERE cartId = '$cartId'";
            $result = $this->db->delete($query);
            
            if($result) {
                header('Location:cart.php');
            } else {
                $msg = "<span class='error'>Product Deleted failed</span>";
                return $msg;
            }
        }
        
        public function check_cart() {
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $result = $this->db->select($query);
            return $result;
        }
        public function del_all_data_cart(){
            $sId = session_id();
            $query = "DELETE * FROM tbl_cart WHERE sId = '$sId'";
            $result = $this->db->delete($query);
            return $result;
        }
    }
?>