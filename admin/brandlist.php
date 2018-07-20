<?php

 include 'inc/header.php';
 ?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php';  ?>
<?php 
 $brand=new Brand();
  if(isset($_GET['brandid']))
  {
  	$id=$_GET['brandid'];
  	$delbrand=$brand->delbrandbyId($id);
  } 

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block"> 
                <?php 
                  if (isset($delbrand)) {
                  	echo $delbrand;
                  }


                ?>       
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					$result=$brand->getallbrand();
					if($result)
					{
						$i=0;
						while ($value=$result->fetch_assoc()) {
							$i++;
						
					
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $value['brandName']; ?></td>
							<td><a href="editbrand.php?brandid=<?php echo $value['brandId'] ;?>">Edit</a> || <a onclick="return confirm('Are You Sure');" href="?brandid=<?php echo $value['brandId'] ;?>">Delete</a></td>
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

