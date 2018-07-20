<?php include 'inc/header.php'; ?>
<?php 
  $login=Session::get('userlogin');
  if($login==false)
  {
  echo "<script>window.location='login.php'</script>";
  }

?>

<?php 
 if (isset($_GET['shiftid'])&&isset($_GET['time'])&&isset($_GET['price'])) {
 	$id=$_GET['shiftid'];
 	$time=$_GET['time'];
 	$price=$_GET['price'];
 	$confirm=$ct->productConfirm($id,$time,$price);
 }
 ?>
 
  <div class="main">
    <div class="content">
    	<div class="section group">
         <div class="order">
         	<h2>Your Order Details</h2>
         	<table class="tblone">
							<tr>
							   <th >Serial No</th>
								<th >Product Name</th>
								<th >Image</th>
								
								<th >Quantity</th>
								<th >Total Price</th>
								<th >Date</th>
								<th >Status</th>
								<th >Action</th>
							</tr>
							<?php 
							$id=Session::get('userid');
                            $getorder=$ct->getorder($id);
                             if ($getorder) {
                             	$i=0;
                             	$sum=0;
                             	while ($result=$getorder->fetch_assoc()) {
                             		$i++;
                             	
                             
							?>
							<tr>
							   <td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
								<td><?php echo $result['quantity']; ?></td>
								
								<td><?php echo $result['price']; ?></td>
								<td><?php echo $fm->formatDate($result['date']); ?></td>
								<td><?php 
                                   if ($result['status']==0) {
                                   	 echo "Pending";
                                   }elseif($result['status']==1)
                                   { 
                                       echo "Shifted";
                                   	?>
                                       
                                   	 
                                <?php   }else
                                   {
                                     echo "Confirm"; 
                                   }

								?></td>
                                 <?php 
                                    if ($result['status']==1) {
                                    	
                                    
                                 ?>
								<td> <a href="?shiftid=<?php echo $result['cId'];?>&price=<?php echo $result['price'];?>&time=<?php echo $result['date'];?>">Confirm</a></td>
								<?php }elseif($result['status']==2) { ?>
                                     <td>OK<td>
								<?php  }elseif($result['status']==0) {?>
								   <td>N/A<td>
								   <?php } ?>
							</tr>
							

							<?php } } ?>
							
						</table>
						
         </div>
        
    	
 		 </div>
 		</div>
 	</div>

<?php  include 'inc/footer.php' ; ?>