
<?php  
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php') ;
?>
<?php  
class Product 
{
private $db;
private $fm;
public function __construct()
{
  $this->db=new Database();
  $this->fm=new Format();
}

public function addproduct($data,$file)
{

  $productName   =mysqli_real_escape_string($this->db->link,$data['productName']);

  $catid         =mysqli_real_escape_string($this->db->link,$data['catid']);

  $brandId       =mysqli_real_escape_string($this->db->link,$data['brandId']);

  $body          =mysqli_real_escape_string($this->db->link,$data['body']);
 
  $price         =mysqli_real_escape_string($this->db->link,$data['price']);
  
  $type          =mysqli_real_escape_string($this->db->link,$data['type']);

   
    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $file['image']['name'];
    $file_size = $file['image']['size'];
    $file_temp = $file['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "upload/".$unique_image;
    if($productName==""|| $catid==""|| $brandId==""|| $body==""|| $price==""|| $type==""|| $file_name=="")
    {
    	$msg="<span style='color:red;font-size:18px;'>Field Must Not Be Empty</span>";
   	  return $msg;
    }
    elseif ($file_size >1048567) {
     echo "<span class='error'>Image Size should be less then 1MB!
     </span>";
    } elseif (in_array($file_ext, $permited) === false) {
     echo "<span class='error'>You can upload only:-"
     .implode(', ', $permited)."</span>";
    }
    else
    {
    	move_uploaded_file($file_temp, $uploaded_image);
    	$query="INSERT INTO tbl_product(productName,catid,brandId,body,price,image,type)
        VALUES('$productName','$catid','$brandId','$body','$price','$uploaded_image','$type')";
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
public function getallproduct()
{
   $query="SELECT tbl_product.*,
          tbl_catagory.catname,tbl_brand.brandName
          FROM tbl_product
          INNER JOIN tbl_catagory
          on tbl_product.catid=tbl_catagory.catid
          INNER JOIN tbl_brand
          on tbl_product.brandId=tbl_brand.brandId
          order by productId desc";
   $result=$this->db->select($query);
   return $result;
}


public function getproductbyId($id)
{
   $query="SELECT * FROM tbl_product where productId='$id'";
        $result=$this->db->select($query);
        return $result;
}

 public function updateproduct($data,$file,$id)
 {
   $productName  =mysqli_real_escape_string($this->db->link,$data['productName']);

  $catid         =mysqli_real_escape_string($this->db->link,$data['catid']);

  $brandId       =mysqli_real_escape_string($this->db->link,$data['brandId']);

  $body          =mysqli_real_escape_string($this->db->link,$data['body']);
 
  $price         =mysqli_real_escape_string($this->db->link,$data['price']);
  
  $type          =mysqli_real_escape_string($this->db->link,$data['type']);
    

     $permited=array('jpg','jpeg','png','gif');
             $file_name=$_FILES['image']['name'];
             $file_size=$_FILES['image']['size'];
             $file_tmp=$_FILES['image']['tmp_name'];

             $div=explode('.', $file_name);
             $file_ext=strtolower(end($div));
            $unique_image=substr(md5(time()), 0,10).'.'.$file_ext;
            $uploaded_image="upload/".$unique_image;
            if($productName==""||$catid==""||$brandId==""||$body==""||$price==""||$type=="") 
            {
                 echo "<span style=color:red>Field Must Not Be empty.</span>";
            }
             else{
         
            if(!empty($file_name))
            {
              
            
            if($file_size>1048567)
            {
               echo "<span class='success'>Image Size Should Be less Than 1 MB.</span>";
            }
            if(in_array($file_ext, $permited)===false)
            {
             echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
            }
        else{
         
       
        move_uploaded_file($file_tmp,$uploaded_image);
        $query="UPDATE tbl_product
                set
                productName='$productName',
                catid='$catid',
                brandId='$brandId',
                body='$body',
                price='$price',
                image='$uploaded_image',
                type='$type'

               
             WHERE productId='$id'   
        ";
        $result = $this->db->update($query);
        if ($result) {
         echo "<span style='color:green;font-size:20px;'>Product Updated Successfully.</span>";
        }else {
         echo "<span style='color:green;font-size:20px;'>Product Not Updates !</span>";
        }
    }
}else
{
     $query="UPDATE tbl_product
                set
                productName='$productName',
                catid='$catid',
                brandId='$brandId',
                body='$body',
                price='$price',
                
                type='$type'

               
             WHERE productId='$id'   
        ";
        $result = $this->db->update($query);
        if ($result) {
         echo "<span style='color:green;font-size:20px;'>Product Updated Successfully.</span>";
        }else {
         echo "<span style='color:red;font-size:20px;'>Product Not Updates !</span>";
        }
}
}

 }
 public function delproduct($id)
 {
    $productId   =mysqli_real_escape_string($this->db->link,$id);

  $query="SELECT * FROM tbl_product where productId='$productId'";
  $getdata=$this->db->select($query);
  if($getdata)
  {
    while ($delimg=$getdata->fetch_assoc()) {
      $dellink=$delimg['image'];
      unlink($dellink);
    }
  }
  $delquery="DELETE FROM tbl_product where productId='$productId'";
  $deldata=$this->db->delete($delquery);
  if($deldata)
  {
    echo "<script>alert('Data Deleted Successfully');</script>";
    echo "<script>window.location='productlist.php'</script>";
  }
  else
  {
    echo "<script>alert('Data Not Deleted ');</script>";
    echo "<script>window.location='productlist.php'</script>";

  }

 }

 public function getfproduct()
 {
      $query="SELECT * FROM tbl_product where type='0' order by productId desc limit 4";
      $result=$this->db->select($query);
      return $result;

 }
 public function getfproductbyid($id)
 {
     $productId   =mysqli_real_escape_string($this->db->link,$id);
   $query="SELECT tbl_product.*,
          tbl_catagory.catname,tbl_brand.brandName
          FROM tbl_product 
          INNER JOIN tbl_catagory
          on tbl_product.catid=tbl_catagory.catid
          INNER JOIN tbl_brand
          on tbl_product.brandId=tbl_brand.brandId
          where tbl_product.productId='$id'
          ";
      $result=$this->db->select($query);
      return $result;

 }
 public function getnproduct()
 {
  $query="SELECT * FROM tbl_product  order by productId desc limit 4";
      $result=$this->db->select($query);
      return $result;
 }
 public function getIphone()
 {
  
   $query="SELECT * FROM tbl_product,tbl_brand where tbl_product.brandId=tbl_brand.brandId and tbl_brand.brandName='IPHONE'   order by productId desc limit 1";
      $result=$this->db->select($query);
      return $result;

 }
 public function getSamsung()
 {
  
   $query="SELECT * FROM tbl_product,tbl_brand where tbl_product.brandId=tbl_brand.brandId and tbl_brand.brandName='SAMSUNG'   order by productId desc limit 1";
      $result=$this->db->select($query);
      return $result;

 }
 public function getAcer()
 {
  
   $query="SELECT * FROM tbl_product,tbl_brand where tbl_product.brandId=tbl_brand.brandId and tbl_brand.brandName='ACER'   order by productId desc limit 1";
      $result=$this->db->select($query);
      return $result;

 }
  public function getCanon()
 {
  
   $query="SELECT * FROM tbl_product,tbl_brand where tbl_product.brandId=tbl_brand.brandId and tbl_brand.brandName='CANON'   order by productId desc limit 1";
      $result=$this->db->select($query);
      return $result;

 }

 public function getproductbycatid($id)
 {
   $query="SELECT * FROM tbl_product where catid='$id'";
   $result=$this->db->select($query);
      return $result;


 }
  public function insertCompare($productId,$cid)
  {

      $productId   =mysqli_real_escape_string($this->db->link,$productId);
      $cId   =mysqli_real_escape_string($this->db->link,$cid);
      $cmpquery="SELECT * FROM tbl_cmp where productId='$productId' and cId='$cId'";
        $check=$this->db->select($cmpquery);
        if($check)
        {
          $msg= "<span style='color:green;font-size:20px;'>Already Added.</span>";
         return $msg;
        }

        $query="SELECT * FROM tbl_product WHERE productId='$productId'";
        $result=$this->db->select($query)->fetch_assoc();
        if ($result) {
             

        

          
            $productId=$result['productId'];
            $productName=$result['productName'];
           
            $price=$result['price'];
            $image=$result['image'];
            $query="INSERT INTO tbl_cmp(cId,productId,productName,price,image)
                VALUES('$cId','$productId','$productName','$price','$image')";
                $value=$this->db->insert($query);
               if ($result) {
         $msg= "<span style='color:green;font-size:20px;'>Add To Compare.</span>";
         return $msg;
        }else {
         $msg= "<span style='color:red;font-size:20px;'>Not add To Compare</span>";
         return $msg;
        }
      }
          
        }

  public function getcmpproductById($cid)
  {

     $cId   =mysqli_real_escape_string($this->db->link,$cid);
     $query="SELECT * FROM tbl_cmp WHERE cId='$cId'";
     $result=$this->db->select($query);
     return $result;
  }
  
  public function checkcmp($cid)
  {
     $cId   =mysqli_real_escape_string($this->db->link,$cid);
     $query="SELECT * FROM tbl_cmp WHERE cId='$cId'";
     $result=$this->db->select($query);
     return $result;
  }
  public function delcmpdata($cid)
  {
     $cId   =mysqli_real_escape_string($this->db->link,$cid);
     $query="DELETE  FROM tbl_cmp where cId='$cId'";
     $result=$this->db->delete($query);
  }

  public function saveWlistProduct($productId,$cid)
  {
      $cId   =mysqli_real_escape_string($this->db->link,$cid);
      $productId   =mysqli_real_escape_string($this->db->link,$productId); 

     $cmpquery="SELECT * FROM tbl_wlist where productId='$productId' and cId='$cId'";
        $check=$this->db->select($cmpquery);
        if($check)
        {
          $msg= "<span style='color:green;font-size:20px;'>Already Added.</span>";
         return $msg;
        }

        $query="SELECT * FROM tbl_product WHERE productId='$productId'";
        $result=$this->db->select($query)->fetch_assoc();
        if ($result) {
             
            $productId=$result['productId'];
            $productName=$result['productName'];
           
            $price=$result['price'];
            $image=$result['image'];
            $query="INSERT INTO tbl_wlist(cId,productId,productName,price,image)
                VALUES('$cId','$productId','$productName','$price','$image')";
                $value=$this->db->insert($query);
               if ($result) {
         $msg= "<span style='color:green;font-size:20px;'>Add To Wish List.</span>";
         return $msg;
        }else {
         $msg= "<span style='color:red;font-size:20px;'>Not add To Wish List</span>";
         return $msg;
        }
      }
          
  }

  public function checkwishlist($id)
  {
     $cId   =mysqli_real_escape_string($this->db->link,$id);
     $query="SELECT * FROM tbl_wlist WHERE cId='$cId'";
     $result=$this->db->select($query);
     return $result;

  }

  public function getwishlistById($cid)
  {
    $cId   =mysqli_real_escape_string($this->db->link,$cid);
     $query="SELECT * FROM tbl_wlist WHERE cId='$cId'";
     $result=$this->db->select($query);
     return $result;

  }

  public function delwishlist($pid,$cid)
  {
     $pid   =mysqli_real_escape_string($this->db->link,$pid);
     $cid   =mysqli_real_escape_string($this->db->link,$cid);

     $query="DELETE FROM tbl_wlist Where productId='$pid' AND cId='$cid'";
     $result=$this->db->delete($query);

  }


}












?>