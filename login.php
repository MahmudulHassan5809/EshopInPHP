<?php include 'inc/header.php'; ?>
<?php 
  $login=Session::get('userlogin');
  if($login==true)
  {
  echo "<script>window.location='order.php'</script>";
  }

?>
<?php 

  if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['register']))
  {
    
   
    $customerReg=$user->customerReg($_POST);
  
  }


?>
<?php 

  if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['login']))
  {
    
   
    $customerLogin=$user->customerLogin($_POST);
  
  }


?>

 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<?php 
               if (isset($customerLogin)) {
                   echo $customerLogin;
               }

        	?>
        	<form action="" method="POST" >
                	<input name="email" type="text" placeholder="Email">
                    <input name="pass" type="password" placeholder="Password">
                    <div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>
                 </form>
               
                    
                    </div>
    	<div class="register_account">
    		<h3>Register New Account</h3>
    		<?php 
             if (isset($customerReg)) {
             	echo $customerReg;
             }

    		?>
    		<form action="" method="POST">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Your Name" >
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="Your City" >
							</div>
							
							<div>
								<input type="text" name="zip" placeholder="Your Zipcode" >
							</div>
							<div>
								<input type="text" name="email" placeholder="Your Email" >
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="add" placeholder="Your Address" >
						</div>
		    		<div>
						<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Select a Country</option>         
							<option value="AF">Afghanistan</option>
							<option value="AL">Albania</option>
							<option value="DZ">Algeria</option>
							<option value="AR">Argentina</option>
							<option value="AM">Armenia</option>
							<option value="AW">Aruba</option>
							<option value="AU">Australia</option>
							<option value="AT">Austria</option>
							<option value="AZ">Azerbaijan</option>
							<option value="BS">Bahamas</option>
							<option value="BH">Bahrain</option>
							<option value="BD">Bangladesh</option>

		         </select>
				 </div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="Your Phone Number">
		          </div>
				  
				  <div>
					<input type="text" name="password" placeholder="Your Password" ">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button class="grey" name="register">Create Account</button></div></div>
		    
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php  include 'inc/footer.php' ; ?>

