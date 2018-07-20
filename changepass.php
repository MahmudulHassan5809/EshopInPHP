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
  $id=Session::get('userid');
?>
 <?php 

  if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['changepass']))
  {
    
   
    $updateuserpass=$user->updateuserpass($_POST,$id);
  }


?>
     <div class="main">
    <div class="content">
    	<div class="section group">
    	 
    	   <form action="" method="POST">
    	    <table class="tblone ftblone">
    	        <tr>
    	    		<td colspan="3">User Password Change</td>
    	    		
    	    	</tr>
    	    	<tr>
    	    		<td colspan="3"><?php if (isset($updateuserpass)) {
    	    			echo $updateuserpass;
    	    		}   ?></td>
    	    		
    	    	</tr>
    	    	<tr>
    	    		<td width="20%">Old Password</td>
    	    		<td width="5%">:</td>
    	    		<td width="75%"><input type="text" name="oldpass" value=""></td>
    	    	</tr>
    	    	<tr>
    	    		<td>New Password</td>
    	    		<td>:</td>
    	    		<td><input type="text" name="newpass" value=""></td>
    	    	</tr>
    	    	
    	    	
    	    	
    	    	
    	    	<tr>
    	    		<td></td>
    	    		<td></td>
    	    		<td>
                       
                          
                           <input type="submit" name="changepass" value="Change Password">
                         
                       
                       
                     
    	    		</td>
    	    	</tr>
    	    </table>
    	    </form>
    	  
    	
 		 </div>
 		</div>
 	</div>



<?php  include 'inc/footer.php' ; ?>