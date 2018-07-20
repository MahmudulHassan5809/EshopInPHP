<?php  
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php') ;
include_once ($filepath.'/../helpers/Format.php') ;
?>
<?php 
class Brand{
private $db;
private $fm;
public function __construct()
{
  $this->db=new Database();
  $this->fm=new Format();
}
public function addbrand($brandName)
{
   $brandName=$this->fm->validation($brandName);
   $brandName=mysqli_real_escape_string($this->db->link,$brandName);
   if (empty($brandName)) {
   	  $loginmsg="<span style='color:red;font-size:18px;'>Field Must Not Be Empty</span>";
   	  return $loginmsg;
   }else
   {
   	$query="INSERT INTO tbl_brand(brandName)
   	  VALUES('$brandName')";
   	$result=$this->db->insert($query);
   	if($result)
   	{
   		$msg="<span style='color:green;font-size:18px;'>Brand Inserted Successfully</span>";
   		return $msg;
   	}
   	else
   	{
       $msg="<span style='color:red;font-size:18px;'>Brand NOT Inserted Successfully</span>";
   		return $msg;
   	}
   }

}
public function getallbrand()
{
   $query="SELECT * FROM tbl_brand order by brandId desc";
   $result=$this->db->select($query);
   return $result;

}
public function getbrandbyId($id)
{
	   $query="SELECT * FROM tbl_brand where brandId='$id'";
        $result=$this->db->select($query);
        return $result;
}
public function editbrand($brandName,$id)
{
	 $brandName=$this->fm->validation($brandName);
   $brandName=mysqli_real_escape_string($this->db->link,$brandName);
   $id=mysqli_real_escape_string($this->db->link,$id);
   if (empty($brandName)) {
   	  $loginmsg="<span style='color:red;font-size:18px;'>Field Must Not Be Empty</span>";
   	  return $loginmsg;
   	}else{
	$query="UPDATE tbl_brand
            SET brandName='$brandName'
            where brandId='$id'
            ";
        $result=$this->db->update($query);
       if($result)
   	{
   		$msg="<span style='color:green;font-size:18px;'>Brand Updated Successfully</span>";
   		return $msg;
   	}
   	else
   	{
       $msg="<span style='color:red;font-size:18px;'>Brand NOT Updated Successfully</span>";
   		return $msg;
   	}
   }
}
public function delbrandbyId($id)
{
	$id=mysqli_real_escape_string($this->db->link,$id);
	$query="DELETE FROM tbl_brand WHERE brandId='$id'";
	$result=$this->db->delete($query);
	 if($result)
   	{
   		$msg="<span style='color:green;font-size:18px;'>Delete Brand Successfully</span>";
   		return $msg;
   	}
   	else
   	{
       $msg="<span style='color:red;font-size:18px;'>Not Deleted</span>";
   		return $msg;
   	}
}




}






?>