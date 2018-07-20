<?php 
 include 'classes/Cart.php';


?>



<?php  
if (!isset($_GET['cartId'])or $_GET['cartId']==NULL) {
  echo "<script>window.location='cart.php'</script>";
  //header("Location:catlist.php");
}else
{
   $ct=new Cart();
  $id=$_GET['cartId'];
  $delcart=$ct->delcart($id);
  


  /**/
}