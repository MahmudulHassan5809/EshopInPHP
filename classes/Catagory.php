<?php  
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php') ;
include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
class Catagory{
private $db;
private $fm;
public function __construct()
{
  $this->db=new Database();
  $this->fm=new Format();
}
public function addcatagory($catname)
{
   $catname=$this->fm->validation($catname);
   $catname=mysqli_real_escape_string($this->db->link,$catname);
   if (empty($catname)) {
   	  $loginmsg="<span style='color:red;font-size:18px;'>Field Must Not Be Empty</span>";
   	  return $loginmsg;
   }else
   {
   	$query="INSERT INTO tbl_catagory(catname)
   	  VALUES('$catname')";
   	$result=$this->db->insert($query);
   	if($result)
   	{
   		$msg="<span style='color:green;font-size:18px;'>Catagory Inserted Successfully</span>";
   		return $msg;
   	}
   	else
   	{
       $msg="<span style='color:red;font-size:18px;'>Catagory NOT Inserted Successfully</span>";
   		return $msg;
   	}
   }

}
public function getallCat()
{
   $query="SELECT * FROM tbl_catagory order by catid desc";
   $result=$this->db->select($query);
   return $result;

}
public function getcatbyId($id)
{
	   $query="SELECT * FROM tbl_catagory where catid='$id'";
        $result=$this->db->select($query);
        return $result;
}
public function editcatagory($catname,$id)
{
	 $catname=$this->fm->validation($catname);
   $catname=mysqli_real_escape_string($this->db->link,$catname);
   $id=mysqli_real_escape_string($this->db->link,$id);
   if (empty($catname)) {
   	  $loginmsg="<span style='color:red;font-size:18px;'>Field Must Not Be Empty</span>";
   	  return $loginmsg;
   	}else{
	$query="UPDATE tbl_catagory
            SET catname='$catname'
            where catid='$id'
            ";
        $result=$this->db->update($query);
       if($result)
   	{
   		$msg="<span style='color:green;font-size:18px;'>Catagory Updated Successfully</span>";
   		return $msg;
   	}
   	else
   	{
       $msg="<span style='color:red;font-size:18px;'>Catagory NOT Updated Successfully</span>";
   		return $msg;
   	}
   }
}
public function delcatbyId($id)
{
	$id=mysqli_real_escape_string($this->db->link,$id);
	$query="DELETE FROM tbl_catagory WHERE catid='$id'";
	$result=$this->db->delete($query);
	 if($result)
   	{
   		$msg="<span style='color:green;font-size:18px;'>Delete Catagory Successfully</span>";
   		return $msg;
   	}
   	else
   	{
       $msg="<span style='color:red;font-size:18px;'>Not Deleted</span>";
   		return $msg;
   	}
}
 public function getcatagory()
 {
     $query="SELECT * FROM tbl_catagory";
     $result=$this->db->select($query);
     return $result;

 }

   public function getcatname($id)
   {
    $query="SELECT tbl_catagory.catname FROM tbl_catagory where catid='$id'";
    $result=$this->db->select($query);
     return $result;
   }




}






?>