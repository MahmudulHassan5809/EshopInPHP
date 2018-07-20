<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
include '../classes/Cart.php';
$ct=new Cart();
$fm=new Format();

?>
<?php 
 if (isset($_GET['shiftid'])&&isset($_GET['time'])&&isset($_GET['price'])) {
 	$id=$_GET['shiftid'];
 	$time=$_GET['time'];
 	$price=$_GET['price'];
 	$shift=$ct->productShift($id,$time,$price);
 	
 }

 if (isset($_GET['delproid'])&&isset($_GET['time'])&&isset($_GET['price'])) {
 	$id=$_GET['delproid'];
 	$time=$_GET['time'];
 	$price=$_GET['price'];
 	$delorder=$ct->delshiftedorder($id,$time,$price);
 }



?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php 
                  if (isset($shift)) {
                  	echo $shift;
                  }


                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Product ID</th>
							<th>Date & Time</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Address</th>
							<th>Customer Id</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					  <?php 
                         
                         $getorder=$ct->getorderproduct();
                         if ($getorder) {
                            	while ($result=$getorder->fetch_assoc()) {
                            		
                            	
                              

					  ?>
						<tr class="odd gradeX">
							<td><?php echo $result['productId'] ;?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td><?php echo $result['productName']; ?></td>
							<td><?php echo $result['quantity']; ?></td>
							<td><?php echo $result['price']; ?></td>
							<td><a href="customer.php?cid=<?php echo $result['cId'];  ?>">View Details</a></td>
							
							
							<td><?php echo $result['cId']; ?></td>
							
                             <?php 
                                if($result['status']==0)
                                {?>
                               <td> <a href="?shiftid=<?php echo $result['cId'];?>&price=<?php echo $result['price'];?>&time=<?php echo $result['date'];?>">Shifted</a></td>
                                <?php }elseif($result['status']==1) { ?>
                                   <td>Pending</td>
                            <?php }else { ?>
							     <td> <a href="?delproid=<?php echo $result['cId'];?>&price=<?php echo $result['price'];?>&time=<?php echo $result['date'];?>">Remove</a></td>

                            <?php }  ?>
						
						</tr>
						<?php } } ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
