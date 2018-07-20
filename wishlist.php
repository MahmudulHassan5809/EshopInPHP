<?php include 'inc/header.php'; ?>
<?php 
  $login=Session::get('userlogin');
  if($login==false)
  {
  echo "<script>window.location='login.php'</script>";
  }

?>
<?php 
  if(isset($_GET['pid']))
  {
   
  
    $pid=$_GET['pid'];
    $cid=Session::get('userid');
    $delwishlist=$pd->delwishlist($pid,$cid);
  }



?>


 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Compare Product</h2>
			    	 <span style="color: green;font-size: 20px;">
			    	 <?php 
                       if (isset($delwishlist)) {
                        echo "List Is deleted";
                       }


			    	 ?>
			    	 </span>
						<table class="tblone">
							<tr>
							   <th>Serial No</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Image</th>
								
								<th>Action</th>
							</tr>
						   <?php 
						      $cid=Session::get('userid');
                             $getwishlist=$pd->getwishlistById($cid);
				             if($getwishlist)
				             {
				             	$i=0;
				             	while ($result=$getwishlist->fetch_assoc()) {
				             		 $i++;
				             

					      ?>

							<tr>
							   <td><?php echo $i;  ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td><?php echo $result['price']; ?></td>
								<td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
								<td><a href="preview.php?pid=<?php echo $result['productId'] ;  ?>">View</a>

                                   --<a href="?pid=<?php echo $result['productId'];?>"> Remove From List</a>
								</td>
								
								
								
							</tr>
							

							<?php } } ?>
							
						</table>
						
						
					   
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
						 <?php 
                            $login=Session::get('userlogin');
                            if ($login==true) {?>
                            <a href="payment.php"> <img src="images/check.png" alt="" /></a>	
                     <?php } else { ?>
						  
							<a href="login.php"> <img src="images/check.png" alt="" /></a>
							<?php } ?>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
    <?php  include 'inc/footer.php' ; ?>