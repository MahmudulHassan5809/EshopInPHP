<?php include 'inc/header.php'; ?>



<?php 
  if ($_SERVER['REQUEST_METHOD']=='POST') {
  	  $quantity=$_POST['quantity'];
  	  $cartId=$_POST['cartId'];
  	  $updatecart=$ct->updatecart($quantity,$cartId);
  	  if ($quantity<=0) {
  	  	$delcart=$ct->delcart($cartId);
  	  }
  }


?>
<?php 
  if (!isset($_GET['id'])) {
  	echo "<meta http-equiv='refresh' content='0;URL=?id=live'/>";
  }


?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			    	<?php 
                        if (isset($updatecart)) {
                        	echo $updatecart;
                        }

			    	?>
						<table class="tblone">
							<tr>
							   <th width="5%">Serial No</th>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="10%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="20%">Action</th>
							</tr>
							<?php 
                            $getpro=$ct->getcartproduct();
                             if ($getpro) {
                             	$i=0;
                             	$sum=0;
                             	while ($result=$getpro->fetch_assoc()) {
                             		$i++;
                             	
                             
							?>
							<tr>
							   <td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
								<td>$<?php echo $result['price']; ?></td>
								<td>
									<form action="" method="post">
										<input type="number" name="quantity" value="<?php echo $result['quantity']; ?>"/>
										<input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>$<?php 
                                  $total=$result['price']*$result['quantity'];
								echo $total; ?></td>
								<td><a onclick="return confirm('Are You Sure');" href="delcart.php?cartId=<?php echo $result['cartId'];  ?>">X</a></td>
							</tr>
							<?php $sum=$sum+$total;  ?>

							<?php } } ?>
							
						</table>
						<?php
						$getData=$ct->checkCarttbl();
                                if($getData){
                                	?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td><?php
                                  if(isset($sum))
                                  {
								 echo $sum; 
								 }?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td><?php
								   if(isset($sum)) 
								   {
                                   $vat=$sum*0.1;
                                   $gtotal=$sum+$vat;
                                   Session::set('total',$gtotal);
                               }
                                   if(isset($gtotal))
                                   {
                                    echo $gtotal;
                                }
								?></td>
							</tr>
					   </table>
					   
					   <?php }else {
					   	  echo "<script>window.location='index.php'</script>";
					   	}  ?>
					   
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