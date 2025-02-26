<?php 

    include_once '../lib/database.php';
    include_once '../helpers/format.php';
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

            if($productName == '' || $brand == '' || $category == '' || $product_desc == '' || $price == '' || $type == '' || $file_name == '') {
                $alert = "<span class='error'>Fields must be not empty</span>";
                return $alert;
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_product(productName,catId,brandId,product_desc,type,price,image) VALUES('$productName','$category', '$brand', '$product_desc','$type', '$price', '$unique_image')";
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
            if($productName == '' || $brand == '' || $category == '' || $product_desc == '' || $price == '' || $type == '') {
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
    }
?>