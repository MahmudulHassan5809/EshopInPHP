<?php 
$filepath=realpath(dirname(__FILE__));  
include_once ($filepath.'/../lib/Database.php') ;
include_once ($filepath.'/../helpers/Format.php') ;

?>
<?php 

 class User
 {
	    private $db;
	    private $fm;
		public function __construct()
		{
		  $this->db=new Database();
		  $this->fm=new Format();
		}

	public function customerReg($data)
	{
        $name=$this->fm->validation($data['name']);
        $name=mysqli_real_escape_string($this->db->link,$data['name']);
        $city=$this->fm->validation($data['city']);
        $city=mysqli_real_escape_string($this->db->link,$data['city']);
        $zip=$this->fm->validation($data['zip']);
        $zip=mysqli_real_escape_string($this->db->link,$data['zip']);
        $email=$this->fm->validation($data['email']);
        $email=mysqli_real_escape_string($this->db->link,$data['email']);
        $add=$this->fm->validation($data['add']);
        $add=mysqli_real_escape_string($this->db->link,$data['add']);
        $country=$this->fm->validation($data['country']);
        $country=mysqli_real_escape_string($this->db->link,$data['country']);
        $phone=$this->fm->validation($data['phone']);
        $phone=mysqli_real_escape_string($this->db->link,$data['phone']);
        $pass=$this->fm->validation($data['password']);
        $pass=mysqli_real_escape_string($this->db->link,$data['password']);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        
        if($name==""|| $city==""|| $zip==""|| $email==""|| $add==""|| $country==""|| $phone=="" || $pass=="")
        {
        	$msg="<span style='color:red;font-size:20px;'>Field Must Not Be Empty</span>";
        	return $msg;
        }
        $mailcheck="SELECT tbl_customer.cEmail FROM tbl_customer Where cEmail='$email'";
        $mailres=$this->db->select($mailcheck);
        if ($mailres!=false) {
                $msg="<span style='color:red;font-size:20px;'>Email already Esits</span>";
                return $msg;
        }
        elseif (filter_var($email, FILTER_VALIDATE_EMAIL)==false) {
        	$msg="<span style='color:red;font-size:20px;'>Invalid Email</span>";
        	return $msg;
        }
        elseif(!preg_match('/^\+?([0-9]{1,4})\)?[-. ]?([0-9]{10})$/',$phone)) {
                $msg="<span style='color:red;font-size:20px;'>Invalid Phone</span>";
                return $msg;
        }

        elseif (!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/',$pass)) {
                    $msg="<span style='color:red;font-size:20px;'>Password must contain at least one lowercase char, at least one uppercase char and at least one digit and at least one special sign of @#-_$%^&+=§!?.</span>";
                    return $msg;
                }
        else
        {
        	$pass=md5($pass);
        	$query="INSERT INTO tbl_customer(cName,cCity,cZip,cEmail,cAdd,cCountry,cPhone,cPass)
	        VALUES('$name','$city','$zip','$email','$add','$country','$phone','$pass')";
	    $result=$this->db->insert($query);
	   	if($result)
	   	{
	   		$msg="<span style='color:green;font-size:18px;'>Product Inserted Successfully</span>";
	   		return $msg;
	   	}
	   	else
	   	{
	       $msg="<span style='color:red;font-size:18px;'>Product NOT Inserted Successfully</span>";
	   		return $msg;
	   	}
        }
      


	}
      public function customerLogin($data)
      {
        $email=$this->fm->validation($data['email']);
        $email=mysqli_real_escape_string($this->db->link,$data['email']);
        $pass=$this->fm->validation($data['pass']);
        $pass=mysqli_real_escape_string($this->db->link,$data['pass']);
        if ($email=="" or $pass=="") {
            $msg="<span style='color:red;font-size:20px;'>Field Must Not Be Empty</span>";
            return $msg;
        }
        elseif (filter_var($email, FILTER_VALIDATE_EMAIL)==false) {
            $msg="<span style='color:red;font-size:20px;'>Invalid Email</span>";
            return $msg;
        }
        $mailcheck="SELECT tbl_customer.cEmail FROM tbl_customer Where cEmail='$email'";
        $mailres=$this->db->select($mailcheck);
        if ($mailres==false) {
                $msg="<span style='color:red;font-size:20px;'>Email Doesn't Esits</span>";
                return $msg;
        }

        else
        {   
            $pass=md5($pass);
            $query="SELECT  * FROM tbl_customer WHERE cEmail='$email' and cPass='$pass'";
            $result=$this->db->select($query);
            if($result!=false)
            {
                $value=$result->fetch_assoc();
                Session::set("userlogin",true);
                Session::set("userid",$value['cId']);
                Session::set("username",$value['cName']);
                echo "<script>window.location='cart.php'</script>";
            }
            else
            {
               $msg="<span style='color:red;font-size:20px;'>Email or Password not matched</span>";
                return $msg; 
            }
        
		}

 }

  public function getuserdata($id)
  {
      $id=mysqli_real_escape_string($this->db->link,$id);
      $query="SELECT * FROM tbl_customer where cId='$id'";
      $result=$this->db->select($query);
      return $result;


  }

  public function updateuserData($data,$id)
  {     
        $id=$this->fm->validation($id);
        $id=mysqli_real_escape_string($this->db->link,$id);
        $name=$this->fm->validation($data['name']);
        $name=mysqli_real_escape_string($this->db->link,$data['name']);
        $city=$this->fm->validation($data['city']);
        $city=mysqli_real_escape_string($this->db->link,$data['city']);
        $zip=$this->fm->validation($data['zip']);
        $zip=mysqli_real_escape_string($this->db->link,$data['zip']);
        $email=$this->fm->validation($data['email']);
        $email=mysqli_real_escape_string($this->db->link,$data['email']);
        $add=$this->fm->validation($data['add']);
        $add=mysqli_real_escape_string($this->db->link,$data['add']);
        $country=$this->fm->validation($data['country']);
        $country=mysqli_real_escape_string($this->db->link,$data['country']);
        $phone=$this->fm->validation($data['phone']);
        $phone=mysqli_real_escape_string($this->db->link,$data['phone']);
        
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        
        if($name==""|| $city==""|| $zip==""|| $email==""|| $add==""|| $country==""|| $phone=="" )
        {
            $msg="<span style='color:red;font-size:20px;'>Field Must Not Be Empty</span>";
            return $msg;
        }
        
       
        elseif (filter_var($email, FILTER_VALIDATE_EMAIL)==false) {
            $msg="<span style='color:red;font-size:20px;'>Invalid Email</span>";
            return $msg;
        }
        elseif(!preg_match('/^\+?([0-9]{1,4})\)?[-. ]?([0-9]{10})$/',$phone)) {
                $msg="<span style='color:red;font-size:20px;'>Invalid Phone</span>";
                return $msg;
        }

       
        else
        {
            
            $query="UPDATE tbl_customer
                   SET cName='$name',
                       cCity='$city',
                       cZip='$zip',
                       cEmail='$email',
                       cAdd='$add',
                       cCountry='$country',
                       cPhone='$phone'
                        Where cId='$id'
                       ";
        $result=$this->db->update($query);
        if($result)
        {
            $msg="<span style='color:green;font-size:18px;'>Profile Updated Successfully</span>";
            return $msg;
        }
        else
        {
           $msg="<span style='color:red;font-size:18px;'>Profile NOT Updated Successfully</span>";
            return $msg;
        }
        }


  }

  public function updateuserpass($data,$id)
  { 
        $id=$this->fm->validation($id);
        $id=mysqli_real_escape_string($this->db->link,$id);
        $oldpass=$this->fm->validation($data['oldpass']);
        $oldpass=mysqli_real_escape_string($this->db->link,$data['oldpass']);
        $newpass=$this->fm->validation($data['newpass']);
        $newpass=mysqli_real_escape_string($this->db->link,$data['newpass']);

        if($oldpass==""|| $newpass=="")
        {
            $msg="<span style='color:red;font-size:20px;'>Field Must Not Be Empty</span>";
            return $msg;
        }
        $oldpass=md5($oldpass);
        $checkpass="SELECT tbl_customer.cPass from tbl_customer where cPass='$oldpass' and cId='$id'";
        $checkpassresult=$this->db->select($checkpass);
        if ($checkpassresult==false) {
             
             $msg="<span style='color:red;font-size:20px;'>Plz Enter A valid Old Password</span>";
            return $msg;
        }
        else
        {
            $newpass=md5($newpass);
            $query="UPDATE tbl_customer
                   SET cPass='$newpass'
                        Where cId='$id' and cPass='$oldpass'
                       ";
        $result=$this->db->update($query);
        if($result)
        {
            $msg="<span style='color:green;font-size:18px;'>User Password Updated Successfully</span>";
            return $msg;
        }
        else
        {
           $msg="<span style='color:red;font-size:18px;'>User Password NOT Updated Successfully</span>";
            return $msg;
        }
        }

  }

  public function getcustomerDetails($id)
  {
      $id=mysqli_real_escape_string($this->db->link,$id);
      $query="SELECT * FROM tbl_customer where cId='$id'";
      $result=$this->db->select($query);
      return $result;

  }



}








?>