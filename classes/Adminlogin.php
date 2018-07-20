<?php 
$filepath=realpath(dirname(__FILE__)); 

include ($filepath.'/../lib/Session.php') ;
Session::checkLogin();
include_once ($filepath.'/../lib/Database.php') ;
include_once ($filepath.'/../helpers/Format.php') ;

?>

<?php 

class Adminlogin{
private $db;
private $fm;
public function __construct()
{
  $this->db=new Database();
  $this->fm=new Format();
}

public function adminLogin($adminUser,$adminPass)
{
   $adminUser=$this->fm->validation($adminUser);
   $adminPass=$this->fm->validation($adminPass);
   $adminUser=mysqli_real_escape_string($this->db->link,$adminUser)	;
   $adminPass=mysqli_real_escape_string($this->db->link,$adminPass)	;
   if (empty($adminUser) or empty($adminPass)) {
   	  $loginmsg="User Name Or Password Must Not Empty";
   	  return $loginmsg;
   }else
   {
   	$query="SELECT  * FROM tbl_admin WHERE adminUser='$adminUser' and adminPass='$adminPass'";
   	$result=$this->db->select($query);
   	if($result!=false)
   	{
   		$value=$result->fetch_assoc();
   		Session::set("adminlogin",true);
   		Session::set("adminId",$value['adminId']);
   		Session::set("adminUser",$value['adminUser']);
   		Session::set("adminName",$value['adminName']);
   		header("Location:index.php");
   	}else
   	{
   		  $loginmsg="User Name Or Password Not Match";
   	      return $loginmsg;
   	}
   }
}



}

?>