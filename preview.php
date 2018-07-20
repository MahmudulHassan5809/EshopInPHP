<style type="text/css">
	.mybutton
	{
		width: 100px;
		float: left;
		margin-right: 30px;
	}
</style>


<?php include 'inc/header.php'; ?>

<?php 
   
  if(!isset($_GET['pid']) or $_GET['pid']==NULL)
  {
    echo "<script>window.location='index.php'</script>";
  }
  else
  {
    $id=$_GET['pid'];
  }


?>
<?php 
  if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])) {
  	 $quantity=$_POST['quantity'];
  	 $cartproduct=$ct->cartproduct($quantity,$id);
  }


?>
<?php 

  if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['compare']))
  {
    $cid=Session::get('userid');
    $productId=$_POST['productId'];
    $insertCompare=$pd->insertCompare($productId,$cid);
  }


?>
<?php 

  if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['wlist']))
  {
    $cid=Session::get('userid');
    $productId=$_POST['productId'];
    $saveWlistProduct=$pd->saveWlistProduct($productId,$cid);
  }


?>

<?php 
  if (isset($_GET['id'])) {
  	echo "<meta http-equiv='refresh' content='0;URL=?id=live'/>";
  }


?>

 <div class="main">
    <div class="content">
    	<div class="section group">
    	<?php  
             $getproduct=$pd->getfproductbyid($id);
             if($getproduct)
             {
             	while ($result=$getproduct->fetch_assoc()) {
             		# code...
             

	      ?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $result['image'] ;?>"  alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName'];?></h2>
					<p><?php echo $fm->textShorten($result['body'],150) ;?></p>					
					<div class="price">
						<p>Price: <span>$<?php echo $result['price'] ;?></span></p>
						<p>Category: <span><?php echo $result['catname'] ;?></span></p>
						<p>Brand:<span><?php echo $result['brandName'] ;?></span></p>
					</div>
					
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>				
				</div>
				<span style='color:red;font-size:20px;'>
				  <?php 
                  if (isset($cartproduct)) {
                  	echo $cartproduct;
                  }

				?>
				</span>
				   <?php 
                  if (isset($insertCompare)) {
                  	echo $insertCompare;
                  }

				?>
				<?php 
                  if (isset($saveWlistProduct)) {
                  	echo $saveWlistProduct;
                  }

				?>
				<?php 
                    $login=Session::get('userlogin');
                 if($login==true)
  { ?>
             <div class="add-cart">
                      <div class="mybutton">
					<form action="" method="post">

					    <input type="hidden" class="buyfield" name="productId" value="<?php echo $result['productId'] ;?>"/>
						<input type="submit" class="buysubmit" name="compare" value="Add To Compare"/>
						
					</form>	
                   </div>
                     <div class="mybutton">
					<form action="" method="post">

					    <input type="hidden" class="buyfield" name="productId" value="<?php echo $result['productId'] ;?>"/>
						<input type="submit" class="buysubmit" name="wlist" value="Add To Wish List"/>
						
					</form>	
                   </div>
                 				
				</div>
    <?php }
	?>
				
			</div>
			<div class="product-desc">

			<h2>Product Details</h2>
			<p><?php echo $result['body']; ?></p>
			<?php } } ?>
	    </div>
				
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<?php 
                      $getcatagory=$ca->getcatagory();
                      if ($getcatagory) {
                      	 while ($result=$getcatagory->fetch_assoc()) {
                      	 	
                      	 
                      

					?>
					<ul>
				      <li><a href="productbycat.php?catid=<?php echo $result['catid'];  ?>"><?php
                      
				       echo $result['catname'] ;   ?></a></li>
				      
    				</ul>
    				<?php } } ?>
    	
 				</div>
 		</div>
 	</div>
	</div>
<?php  include 'inc/footer.php' ; ?>


