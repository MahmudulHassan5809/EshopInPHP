<style type="text/css">
.ftblone
{
	width: 550px !important;
	margin: 0 auto !important;
	border:2px solid gray !important;
	
}
.ftblone tr td
{
	text-align: justify;
}
.ftblone tr td input[type="text"]
{
	width:80%;
	padding: 5px;
}
.ca 
{
	padding: 2px !important;
	margin-left: 5px !important;
	color:black !important;
	background-color: gray !important;
	border-radius: 5px;
}	

</style>



<?php include 'inc/header.php'; ?>
<?php 
  $login=Session::get('userlogin');
  if($login==false)
  {
  echo "<script>window.location='login.php'</script>";
  }

?>

<?php 
   
  if(!isset($_GET['userid']) or $_GET['userid']==NULL)
  {
    echo "<script>window.location='index.php'</script>";
  }
  else
  {
    $id=$_GET['userid'];
  }


?>
 <?php 

  if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['update']))
  {
    
   
    $updateuserData=$user->updateuserData($_POST,$id);
  }


?>


  <div class="main">
    <div class="content">
    	<div class="section group">
    	  <?php 
             $getuserdata=$user->getuserdata($id);
              if ($getuserdata) {
              	  while ($result=$getuserdata->fetch_assoc()) {
              	  	
              	  
              

    	  ?>
    	   <form action="" method="POST">
    	    <table class="tblone ftblone">
    	        <tr>
    	    		<td colspan="3">User Profile</td>
    	    		<?php 
                      if (isset($updateuserData)) {
                      	echo $updateuserData;
                      }
    	    		?>
    	    	</tr>
    	    	<tr>
    	    		<td width="20%">Name</td>
    	    		<td width="5%">:</td>
    	    		<td width="75%"><input type="text" name="name" value="<?php echo $result['cName']; ?>"></td>
    	    	</tr>
    	    	<tr>
    	    		<td>Phone</td>
    	    		<td>:</td>
    	    		<td><input type="text" name="phone" value="<?php echo $result['cPhone']; ?>"></td>
    	    	</tr>
    	    	<tr>
    	    		<td>Email</td>
    	    		<td>:</td>
    	    		<td><input type="text" name="email" value="<?php echo $result['cEmail']; ?>"></td>
    	    	</tr>
    	    	<tr>
    	    		<td>City</td>
    	    		<td>:</td>
    	    		<td><input type="text" name="city" value="<?php echo $result['cCity']; ?>"></td>
    	    	</tr>
    	    	<tr>
    	    		<td>Addres</td>
    	    		<td>:</td>
    	    		<td><input type="text" name="add" value="<?php echo $result['cAdd']; ?>"></td>
    	    	</tr>
    	    	<tr>
    	    		<td>Zip Code</td>
    	    		<td>:</td>
    	    		<td><input type="text" name="zip" value="<?php echo $result['cZip']; ?>"></td>
    	    	</tr>
    	    	<tr>
    	    		<td>Country</td>
    	    		<td>:</td>
    	    		<td><input type="text" name="country" value="<?php echo $result['cCountry']; ?>"></td>
    	    	</tr>
    	    	<tr>
    	    		<td></td>
    	    		<td></td>
    	    		<td>
                       <?php  if ($id==$result['cId']) {
                         
                         ?>
                          
                           <input type="submit" name="update" value="Update">
                          <a class="ca" href="changepass.php">Change Password</a>
                       
                       <?php } ?>
                     
    	    		</td>
    	    	</tr>
    	    </table>
    	    </form>
    	    <?php } } ?>
    	
 		 </div>
 		</div>
 	</div>



<?php  include 'inc/footer.php' ; ?>