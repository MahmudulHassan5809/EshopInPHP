<?php include 'inc/header.php'; ?>
<?php 
   
  if(!isset($_GET['catid']) or $_GET['catid']==NULL)
  {
    echo "<script>window.location='preview.php'</script>";
  }
  else
  {
    $id=$_GET['catid'];
  }


?>
 <div class="main">
    <div class="content">
     
    	<div class="content_top">
    	    <?php $getcatname=$ca->getcatname($id) ; ?>
    		<div class="heading">
    		 <?php if ($getcatname) {
    		 	while ($result=$getcatname->fetch_assoc()) {
    		 		
    		 	
    		  ?>
    		<h3>Latest from <?php echo $result['catname']; ?></h3>
    		<?php } } ?>
    		</div>

    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	             <?php 
             $getproductbycatid=$pd->getproductbycatid($id);
             if ($getproductbycatid) {
             	while ($result=$getproductbycatid->fetch_assoc()) {

             	
             

    	 ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?pid=<?php echo $result['productId'];  ?>"> <img src="admin/<?php echo $result['image'];  ?>" alt="" /></a>
					 <h2><?php echo $result['productName'];  ?></h2>
					 <p><?php echo $fm->textShorten($result['body'],100);  ?></p>
					 <p><span class="price">$<?php echo $result['price'];  ?></span></p>
				     <div class="button"><span><a href="preview.php?pid=<?php echo $result['productId'];  ?>">Add to cart</a></span></div>
				</div>
                  <?php } } ?>
				</div>
				
				

	
	
    </div>
 </div>

<?php  include 'inc/footer.php' ; ?>