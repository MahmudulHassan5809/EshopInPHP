
<?php  
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php') ;
include_once ($filepath.'/../helpers/Format.php') ;

?>
<?php 

 class Cart
 {
	 	private $db;
	    private $fm;
		public function __construct()
		{
		  $this->db=new Database();
		  $this->fm=new Format();
		}
		public function cartproduct($quantity,$id)
		{
			$quantity=$this->fm->validation($quantity);
			$quantity=mysqli_real_escape_string($this->db->link,$quantity);

            $id =mysqli_real_escape_string($this->db->link,$id);
            $sesid=session_id();

            $squery="SELECT * FROM tbl_product WHERE productId='$id'";
            $result=$this->db->select($squery)->fetch_assoc();
            $productName=$result['productName'];
            $price=$result['price'];
            $image=$result['image'];
            $chquery="SELECT * FROM tbl_cart WHERE productId='$id' and sesId='$sesid'";
            $getpro=$this->db->select($chquery);
            if ($getpro) {
            	$msg="Product Already Added";
            	return $msg;
            }
            else{
            $query="INSERT INTO tbl_cart(sesId,productId,productName,price,quantity,image)
                VALUES('$sesid','$id','$productName','$price','$quantity','$image')";
                $value=$this->db->insert($query);
                if($value)
		   	{
		   		echo "<script>window.location='cart.php'</script>";
		   	}
		   	else
		   	{
		       echo "<script>window.location='404.php'</script>";
		   	}
		   }
				}


	 public function getcartproduct()
	 {
      $sesid=session_id();
      $query="SELECT * FROM tbl_cart where sesId='$sesid'";
        $result=$this->db->select($query);
        return $result;

	 }	

	 public function updatecart($quantity,$cartId)
	 {
             $quantity=$this->fm->validation($quantity);
			$quantity=mysqli_real_escape_string($this->db->link,$quantity);
			$cartId=$this->fm->validation($cartId);
			$cartId=mysqli_real_escape_string($this->db->link,$cartId);
			

			$query="UPDATE tbl_cart
			       SET quantity='$quantity'
			       WHERE cartId='$cartId'";

			$result=$this->db->update($query);
			if($result)
			{
				echo "<script>window.location='cart.php'</script>";
			}
			else
			{
				 $msg="<span style='color:red;font-size:20px;'>Cart Not Updated<span>";
				return $msg;
			}      


	 }
	 public function delcart($id)
	 {
		    $delquery="DELETE FROM tbl_cart where cartId='$id'";
		  $deldata=$this->db->delete($delquery);
		  if($deldata)
		  {
		    echo "<script>alert('Data Deleted Successfully');</script>";
		    echo "<script>window.location='cart.php'</script>";
		  }
		  else
		  {
		    echo "<script>alert('Data Not Deleted ');</script>";
		    echo "<script>window.location='cart.php'</script>";

		  }

	 }	

	 public function checkCarttbl()
	 {
	 	$sesid=session_id();
	 	$query="SELECT * FROM tbl_cart Where sesId='$sesid' ";
	 	$result=$this->db->select($query);
	 	return $result;
	 }

	 public function delcudtomercart()
	 {
       $sesid=session_id();
       $query="DELETE FROM tbl_cart WHERE sesId='$sesid'";
       $result=$this->db->delete($query);

	 }	

	 public function chkCart()
	 {
	$sesid=session_id();
       $query="SELECT * FROM tbl_cart WHERE sesId='$sesid'";
       $result=$this->db->select($query);
       return $result;
	 }

	 public function orderproduct($id) 
	 {
	 	$sesid=session_id();
	 	$query="SELECT * FROM tbl_cart WHERE sesId='$sesid'";
        $result=$this->db->select($query);
        if ($result) {
        	while ($value=$result->fetch_assoc()) {
        		$productId=$value['productId'];
        		$productName=$value['productName'];
        		$quantity=$value['quantity'];
        		$price=$value['price']*$quantity;
        		$image=$value['image'];
        		$query="INSERT INTO tbl_order(cId,productId,productName,quantity,price,image)
                VALUES('$id','$productId','$productName','$quantity','$price','$image')";
                $value=$this->db->insert($query);
        		
        	}
        }
        
	 }

	 public function payableAmount($id)
	 {
	   $query="SELECT tbl_order.price FROM tbl_order WHERE cId='$id' and date=now()";
       $result=$this->db->select($query);
       return $result;
	 }

	 public function getorder($id)
	 {
	 	 $query="SELECT * FROM tbl_order WHERE cId='$id' order by date desc ";
        $result=$this->db->select($query);
        return $result;
	 }
	 public function chkorder($id)
	 {
	 	$query="SELECT * FROM tbl_order WHERE cId='$id'";
       $result=$this->db->select($query);
       return $result;
	 }
	 public function getorderproduct()
	 {
	 	 $query="SELECT * FROM tbl_order order by date";
         $result=$this->db->select($query);
         return $result;
	 }

	 public function productShift($id,$time,$price)
	 {
         
         $id=mysqli_real_escape_string($this->db->link,$id);
         $time=mysqli_real_escape_string($this->db->link,$time);
         $price=mysqli_real_escape_string($this->db->link,$price);

         $query="UPDATE tbl_order
			       SET status='1'
			       WHERE cId='$id' and date='$time' and price='$price'";

			$result=$this->db->update($query);
			if($result)
			{
				$msg="<span style='color:green;font-size:18px;'> Updated Successfully</span>";
            return $msg;
			}
			else
			{
				$msg="<span style='color:green;font-size:18px;'>Not Updated Successfully</span>";
            return $msg;
			}      


	 }

	 public function delshiftedorder($id,$time,$price)
	 {
        $id=mysqli_real_escape_string($this->db->link,$id);
         $time=mysqli_real_escape_string($this->db->link,$time);
         $price=mysqli_real_escape_string($this->db->link,$price);

          $delquery="DELETE FROM tbl_order  WHERE cId='$id' and date='$time' and price='$price'";
		  $deldata=$this->db->delete($delquery);
		  if($deldata)
		  {
		    echo "<script>alert('Data Deleted Successfully');</script>";
		    echo "<script>window.location='inbox.php'</script>";
		  }
		  else
		  {
		    echo "<script>alert('Data Not Deleted ');</script>";
		    echo "<script>window.location='inbox.php'</script>";

		  }

	 }

	 public function productConfirm($id,$time,$price)
	 {
         $id=mysqli_real_escape_string($this->db->link,$id);
         $time=mysqli_real_escape_string($this->db->link,$time);
         $price=mysqli_real_escape_string($this->db->link,$price);

         $query="UPDATE tbl_order
			       SET status='2'
			       WHERE cId='$id' and date='$time' and price='$price'";

			$result=$this->db->update($query);
			if($result)
			{
			$msg="<span style='color:green;font-size:18px;'> Updated Successfully</span>";
            return $msg;
			}
			else
			{
				$msg="<span style='color:green;font-size:18px;'>Not Updated Successfully</span>";
            return $msg;
			}      

	 }

 }








?>