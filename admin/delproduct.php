<?php 
  $filepath=realpath(dirname(__FILE__));
 include ($filepath.'/../classes/Brand.php');  ?>
<?php include ($filepath.'/../classes/Catagory.php') ;  ?>
<?php include ($filepath.'/../classes/Product.php');  ?>



<?php  
if (!isset($_GET['pid'])or $_GET['pid']==NULL) {
  echo "<script>window.location='postlist.php'</script>";
  //header("Location:catlist.php");
}else
{
   $pd=new Product();
  $id=$_GET['pid'];
  $delpro=$pd->delproduct($id);


  /**/
}