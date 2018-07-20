<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
include '../classes/User.php';
?>
<?php 
   
  if(!isset($_GET['cid']) or $_GET['cid']==NULL)
  {
    echo "<script>window.location='inbox.php'</script>";
  }
  else
  {
    $id=$_GET['cid'];
  }


?>


 <?php 
$user=new User();
 ?>
 <?php 

  if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['submit']))
  {
    
   
    echo "<script>window.location='inbox.php'</script>";
  }
  ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Customer Profile</h2>

        <div class="block">
        <?php 
                 $getcustomerDetails=$user->getcustomerDetails($id);
                 if ($getcustomerDetails) {
                   while ($value=$getcustomerDetails->fetch_assoc()) {
              
                ?>   

         <form action="" method="POST" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" readonly="" name="name" value="<?php echo $value['cName'];  ?>" class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>City</label>
                    </td>
                    <td>
                        <input type="text" readonly="" name="city" value="<?php echo $value['cCity'];  ?>" class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>Zip Code</label>
                    </td>
                    <td>
                        <input type="text" readonly="" name="zip" value="<?php echo $value['cZip'];  ?>" class="medium" />
                    </td>
                </tr>
                  <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" readonly="" name="email" value="<?php echo $value['cEmail'];  ?>" class="medium" />
                    </td>
                </tr>
                   <tr>
                    <td>
                        <label>Address</label>
                    </td>
                    <td>
                        <input type="text" readonly="" name="add" value="<?php echo $value['cAdd'];  ?>" class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>Country</label>
                    </td>
                    <td>
                        <input type="text" readonly="" name="country" value="<?php echo $value['cCountry'];  ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Phone Number</label>
                    </td>
                    <td>
                        <input type="text" readonly="" name="phone" value="<?php echo $value['cPhone'];  ?>" class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        
                    </td>
                    <td>
                        <input type="submit"  name="submit" value="Ok" class="medium" />
                    </td>
                </tr>
		
				</table>
            </form>
            <?php } } ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>