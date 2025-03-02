<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>
<?php
    class Product 
    {   
        private $db;
        public $fm;
        
        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }

        
        public function insert_product($data, $files) {
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $productQuantity = mysqli_real_escape_string($this->db->link, $data['productQuantity']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);
            
            
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10). '.'. $file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($productName == '' || $productQuantity == '' || $brand == '' || $category == '' || $product_desc == '' || $price == '' || $type == '' || $file_name == '') {
                $alert = "<span class='error'>Fields must be not empty</span>";
                return $alert;
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_product(productName,productQuantity,catId,brandId,product_desc,type,price,image) VALUES('$productName','$productQuantity','$category', '$brand', '$product_desc','$type', '$price', '$unique_image')";
                $result = $this->db->insert($query);
                
                if($result) {
                    $alert = "<span class='success'>Product Inserted Successfully</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Product Insert Failed</span>";
                    return $alert;    
                }
            }
        }
        
        public function show_product() {
            $query = "SELECT p.*, c.catName, b.brandName 
                    FROM tbl_product as p, tbl_category as c, tbl_brand as b WHERE p.catId = c.catId
                    AND p.brandId = b.brandId
                    ORDER BY p.productId";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function update_product($data, $files, $id) {
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $productQuantity = mysqli_real_escape_string($this->db->link, $data['productQuantity']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);
            
            
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10). '.'. $file_ext;
            $uploaded_image = "uploads/".$unique_image;
            if($productName == '' || $productQuantity == '' || $brand == '' || $category == '' || $product_desc == '' || $price == '' || $type == '') {
                $alert = "<span class='error'>Fields must be not empty</span>";
                return $alert;
            } else {
                if(!empty($file_name)){
                    if($file_size > 20480){
                        $alert = "<span class='error'>Image Size should be less than 2MB</span>";
                        return $alert;
                    }
                    elseif(in_array($file_ext, $permited) === false){
                        $alert = "<span class='error'>You can upload only:- ".implode(', ', $permited)."</span>";
                        return $alert;
                    }
                    $query = "UPDATE tbl_product SET 
                    productName='$productName',
                    productQuantity='$productQuantity, 
                    catId='$category', 
                    brandId='$brand', 
                    product_desc='$product_desc', 
                    type='$type', 
                    price='$price',
                    image='$unique_image' 
                    WHERE productId='$id'";
                } else{
                    $query = "UPDATE tbl_product SET 
                    productName='$productName', 
                    productQuantity = $productQuantity,
                    catId='$category', 
                    brandId='$brand', 
                    product_desc='$product_desc', 
                    type='$type', 
                    price='$price' 
                    WHERE productId='$id'";
                }
                $result = $this->db->update($query);
                if($result) {
                    $alert = "<span class='success'>Product Updated Successfully</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Product Update Failed</span>";
                    return $alert;    
                }
            }
        }
        
        public function delete_product($productId) {
            
            $query = "DELETE FROM tbl_product WHERE productId = '$productId'";
            $result = $this->db->delete($query);
            
            if($result) {
                $alert = "<span class='success'>Product Deleted Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Product Delete Failed</span>";
                return $alert;    
            }
        }
        
        public function get_product_by_id($productId) {
            $query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function get_product_featured() {
            $query = "SELECT * FROM tbl_product WHERE type = '1'";
            $result = $this->db->select($query);
            return $result;
        }
        public function get_product_new() {
            $sp_tungtrang = 4;
            if(!isset($_GET['trang'])){
                $trang = 1;
            }else {
                $trang = $_GET['trang'];
            }
            $tung_trang = ($trang - 1) * $sp_tungtrang;
            $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT $tung_trang,$sp_tungtrang";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_all_product() {
            $query = "SELECT * FROM tbl_product";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function get_product_details($id) {
            $query = "SELECT p.*, c.catName, b.brandName 
                    FROM tbl_product as p, tbl_category as c, tbl_brand as b WHERE p.catId = c.catId
                    AND p.brandId = b.brandId 
                    AND p.productId = '$id' 
                    ORDER BY p.productId";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function getLastestDell() {
            $query = "SELECT * FROM tbl_product WHERE brandId = '2' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function getLastestMSI() {
            $query = "SELECT * FROM tbl_product WHERE brandId = '1' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function getLastestApple() {
            $query = "SELECT * FROM tbl_product WHERE brandId = '4' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function getLastestSS() {
            $query = "SELECT * FROM tbl_product WHERE brandId = '5' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function insertCompare($productid, $customer_id){
            $productid = mysqli_real_escape_string($this->db->link, $productid);
            $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

            $check_compare = "SELECT * FROM tbl_compare WHERE productId = '$productid' AND customer_id = '$customer_id'";
            $check_result = $this->db->select($check_compare);
            if($check_result){
                $msg = "<span class='error'>Product Already Exists to compare</span>";
                return $msg;
            } else {
                $query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
                $result = $this->db->select($query)->fetch_assoc();

                $productName = $result['productName'];
                $price = $result['price'];
                $image = $result['image'];
                $query_insert = "INSERT INTO tbl_compare(productId,price,image,customer_id,productName) 
                VALUES('$productid','$price', '$image', '$customer_id','$productName')";
                $insert_wishlist = $this->db->insert($query_insert);
                
                if($insert_wishlist) {
                    $alert = "<span class='success'>Added Compare Successfully</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Added Compare Failed</span>";
                    return $alert;    
                }
            }
        }
        
        public function get_compare($customer_id) {
            $query = "SELECT * FROM tbl_compare WHERE customer_id = '$customer_id' ORDER BY id DESC";
            $result = $this->db->select($query);
            return $result;
        }
        public function inserWishlist($productid, $customer_id){
            $productid = mysqli_real_escape_string($this->db->link, $productid);
            $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

            $check_wishlist = "SELECT * FROM tbl_wishlist WHERE productId = '$productid' AND customer_id = '$customer_id'";
            $check_result = $this->db->select($check_wishlist);
            if($check_result){
                $msg = "<span class='error'>Product Already Exists to Wishlist</span>";
                return $msg;
            } else {
                $query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
                $result = $this->db->select($query)->fetch_assoc();

                $productName = $result['productName'];
                $price = $result['price'];
                $image = $result['image'];
                $query_insert = "INSERT INTO tbl_wishlist(productId,price,image,customer_id,productName) 
                VALUES('$productid','$price', '$image', '$customer_id','$productName')";
                $insert_wishlist = $this->db->insert($query_insert);
                
                if($insert_wishlist) {
                    $alert = "<span class='success'>Added Wishlist Successfully</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Added Wishlist Failed</span>";
                    return $alert;    
                }
            }
        }
        public function get_wishlist($customer_id) {
            $query = "SELECT * FROM tbl_wishlist WHERE customer_id = '$customer_id' ORDER BY id DESC";
            $result = $this->db->select($query);
            return $result;
        }
        public function delete_wishlist($proid, $customer_id) {
            $query = "DELETE FROM tbl_wishlist WHERE productId = '$proid' AND customer_id = '$customer_id'";
            $result = $this->db->delete($query);
            return $result;
        }
        public function insert_slider($data, $files){
            $sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);
            
            
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10). '.'. $file_ext;
            $uploaded_image = "uploads/".$unique_image;
            if($sliderName == '' || $type == '') {
                $alert = "<span class='error'>Fields must be not empty</span>";
                return $alert;
            } else {
                if(!empty($file_name)){
                    if($file_size > 2048000){
                        $alert = "<span class='error'>Image Size should be less than 2MB</span>";
                        return $alert;
                    }
                    elseif(in_array($file_ext, $permited) === false){
                        $alert = "<span class='error'>You can upload only:- ".implode(', ', $permited)."</span>";
                        return $alert;
                    }
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "INSERT INTO tbl_slider(sliderName,slider_image,type) VALUES('$sliderName','$unique_image', '$type')";
                    $result = $this->db->insert($query);
                    
                    if($result) {
                        $alert = "<span class='success'>Slider Inserted Successfully</span>";
                        return $alert;
                    } else {
                        $alert = "<span class='error'>Slider Insert Failed</span>";
                        return $alert;    
                    }
                }
                
            }
        }
        public function show_slider(){
            $query = "SELECT * FROM tbl_slider WHERE type = '1' ORDER BY sliderId DESC";
            $result = $this->db->select($query);
            return $result;
        }
        public function show_slider_list(){
            $query = "SELECT * FROM tbl_slider ORDER BY sliderId DESC";
            $result = $this->db->select($query);
            return $result;
        }
        public function updateSlider($id, $type){
            $type = mysqli_real_escape_string($this->db->link, $type);
            $query = "UPDATE tbl_slider SET type = '$type' WHERE sliderId = '$id'";
            $result = $this->db->update($query);
            if($result) {
                $msg = "<span class='success'>Slider Updated Successfully</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Slider Updated Failed</span>";
                return $msg;    
            }
        }
        public function deleteSlider($id){
            $query = "DELETE FROM tbl_slider WHERE sliderId = '$id'";
            $result = $this->db->delete($query);
            if($result) {
                $msg = "<span class='success'>Slider Deleted Successfully</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Slider Deleted Failed</span>";
                return $msg;    
            }
        }
        public function search_product($tukhoa){
            $tukhoa = mysqli_real_escape_string($this->db->link, $tukhoa);
            $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$tukhoa%' ORDER BY productId DESC";
            $result = $this->db->select($query);
            return $result;
        }
        public function get_start($id, $customer_id){
            $query = "SELECT * FROM tbl_rating WHERE product_id = '$id' AND customer_id = $customer_id";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>