<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>
<?php
    class Blog 
    {   
        private $db;
        public $fm;
        
        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }

        
        public function insert_blog($data, $files) {
            $blog_title = mysqli_real_escape_string($this->db->link, $data['blog_title']);
            $content = mysqli_real_escape_string($this->db->link, $data['content']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $description = mysqli_real_escape_string($this->db->link, $data['description']);
            $status = mysqli_real_escape_string($this->db->link, $data['status']);
            
            
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10). '.'. $file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($blog_title == '' || $content == '' || $category == '' || $description == '' || $status == '' || $file_name == '') {
                $alert = "<span class='error'>Fields must be not empty</span>";
                return $alert;
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_blog(blog_title,content,description,category_post,status,image) VALUES('$blog_title','$content', '$description', '$category','$status', '$unique_image')";
                $result = $this->db->insert($query);
                
                if($result) {
                    $alert = "<span class='success'>Blog Inserted Successfully</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Blog Insert Failed</span>";
                    return $alert;    
                }
            }
        }
        
        public function show_blog() {
            $query = "SELECT b.*, c.title
                    FROM tbl_blog as b, tbl_category_post as c WHERE b.category_post = c.id_cate_post
                    ORDER BY b.id";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function update_blog($data, $files, $id) {
            $blog_title = mysqli_real_escape_string($this->db->link, $data['blog_title']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $content = mysqli_real_escape_string($this->db->link, $data['content']);
            $description = mysqli_real_escape_string($this->db->link, $data['description']);
            $status = mysqli_real_escape_string($this->db->link, $data['status']);            
            
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10). '.'. $file_ext;
            $uploaded_image = "uploads/".$unique_image;
            if($blog_title == '' || $content == '' || $category == '' || $description == '' || $status == '') {
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
                    $query = "UPDATE tbl_blog SET 
                    blog_title='$blog_title', 
                    category_post='$category', 
                    content='$content', 
                    description='$description', 
                    status='$status',
                    image='$unique_image' 
                    WHERE id='$id'";
                } else{
                    $query = "UPDATE tbl_blog SET 
                    blog_title='$blog_title', 
                    category_post='$category', 
                    content='$content', 
                    description='$description', 
                    status='$status' 
                    WHERE id='$id'";
                }
                $result = $this->db->update($query);
                if($result) {
                    $alert = "<span class='success'>Blog Updated Successfully</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Blog Update Failed</span>";
                    return $alert;    
                }
            }
        }
        
        public function delete_blog($id) {
            
            $query = "DELETE FROM tbl_blog WHERE id = '$id'";
            $result = $this->db->delete($query);
            
            if($result) {
                $alert = "<span class='success'>Blog Deleted Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Blog Delete Failed</span>";
                return $alert;    
            }
        }
        
        public function get_blog_by_id($id) {
            $query = "SELECT * FROM tbl_blog WHERE id = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        

        public function get_all_product() {
            $query = "SELECT * FROM tbl_product";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>