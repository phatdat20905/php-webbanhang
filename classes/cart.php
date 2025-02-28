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
            $query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
            $result = $this->db->delete($query);
            return $result;
        }
        public function del_compare($customer_id){
            $query = "DELETE FROM tbl_cart WHERE customer_id = '$customer_id'";
            $result = $this->db->delete($query);
            return $result;
        }
        public function insertOrder($customer_id){
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $get_product = $this->db->select($query);
            if($get_product){
                while($result = $get_product->fetch_assoc()){
                    $product_id = $result['productId'];
                    $productName = $result['productName'];
                    $quantity = $result['quantity'];
                    $price = $result['price'] * $quantity;
                    $image = $result['image'];
                    $customer_id = $customer_id;
                    $query_order = "INSERT INTO tbl_order(customer_id, productId, productName, price, quantity, image) 
                                    VALUES('$customer_id', '$product_id', '$productName', '$price', '$quantity', '$image')";                
                    $insert_order = $this->db->insert($query_order);
                }
            }
        }
        public function getAmountPrice($customer_id){
            $query = "SELECT price FROM tbl_order WHERE customer_id = $customer_id";
            $result = $this->db->select($query);
            return $result;
        }
        public function get_cart_ordered($customer_id){
            $query = "SELECT * FROM tbl_order WHERE customer_id = $customer_id";
            $result = $this->db->select($query);
            return $result;
        }

        public function check_order($customer_id){
            $query = "SELECT * FROM tbl_order WHERE customer_id = $customer_id";
            $result = $this->db->select($query);
            return $result;
        }
        public function get_inbox_cart(){
            $query = "SELECT * FROM tbl_order ORDER BY date_order DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function shifted($id, $time, $price){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $time = mysqli_real_escape_string($this->db->link, $time);
            $price = mysqli_real_escape_string($this->db->link, $price);
            $query = "UPDATE tbl_order SET 
                    status = '1'
                    WHERE id = '$id' AND date_order='$time' AND price = '$price'";
            $result = $this->db->update($query);
            if($result) {
                $msg = "<span class='success'>Updated Order successfully</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Update Order failed</span>";
                return $msg;
            }
        }
        public function delShifted($id, $time, $price){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $time = mysqli_real_escape_string($this->db->link, $time);
            $price = mysqli_real_escape_string($this->db->link, $price);
            $query = "DELETE FROM tbl_order
                    WHERE id = '$id' AND date_order='$time' AND price = '$price'";
            $result = $this->db->delete($query);
            if($result) {
                $msg = "<span class='success'>Delete Order successfully</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Delete Order failed</span>";
                return $msg;
            }
        }
        public function shifted_confirm($id, $time, $price){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $time = mysqli_real_escape_string($this->db->link, $time);
            $price = mysqli_real_escape_string($this->db->link, $price);
            $query = "UPDATE tbl_order SET 
                    status = '2'
                    WHERE customer_id = '$id' AND date_order='$time' AND price = '$price'";
            $result = $this->db->update($query);
            if($result) {
                $msg = "<span class='success'>Confirm Order successfully</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Confirm Order failed</span>";
                return $msg;
            }
        }
    }
?>