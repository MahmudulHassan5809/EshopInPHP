<?php 

   include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Catagory.php' ;  ?>
<?php 
 $cat=new Catagory();
  if(isset($_GET['catid']))
  {
  	$id=$_GET['catid'];
  	$delcat=$cat->delcatbyId($id);
  } 

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block"> 
                <?php 
                  if (isset($delcat)) {
                  	echo $delcat;
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
					$result=$cat->getallCat();
					if($result)
					{
						$i=0;
						while ($value=$result->fetch_assoc()) {
							$i++;
						
					
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $value['catname']; ?></td>
							<td><a href="editcat.php?catid=<?php echo $value['catid'] ;?>">Edit</a> || <a onclick="return confirm('Are You Sure');" href="?catid=<?php echo $value['catid'] ;?>">Delete</a></td>
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

