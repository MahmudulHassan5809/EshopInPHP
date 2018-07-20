<?php 

include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php' ;  ?>
<?php 
  $pd=new Product();
  $fm=new Format();

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
			
				<tr>
					<th width="5%">Serial</th>
					<th width="15%">Product Name</th>
					<th width="15%">Catagory Name</th>
					<th width="15%">Brand Name</th>
					<th width="15%%">Description</th>
					<th width="5%">Price</th>
					<th width="10%">Image</th>
					<th width="10%">Type</th>
					<th width="10%">Action</th>
				</tr>
				
			</thead>
			
			<tbody>
			  <?php 
					$result=$pd->getallproduct();
					if($result)
					{
						$i=0;
						while($value=$result->fetch_assoc()) {
							$i++;
						
					
					?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $value['productName'] ;?></td>
					<td><?php echo $value['catname'] ;?></td>
					<td> <?php echo $value['brandName'] ;?></td>
					<td><?php echo $fm->textshorten($value['body'],50) ;?></td>
					<td>$<?php echo $value['price'] ;?></td>
					<td><img src="<?php echo $value['image'] ;?>" width="30%"></td>
					<td>
					 <?php 
					     if ($value['type']==0)
					     {
					     	echo "Featured";
					     } else
					     {
                            echo "General";
					     }
					     	
					     ?>
				    </td>
					<td><a href="editproduct.php?pid=<?php echo $value['productId']; ?>">Edit</a> || 
					<a onclick="return confirm('Are You Sure');" href="delproduct.php?pid=<?php echo $value['productId']; ?>">Delete</a></td>
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
