<?php
    
include '../classes/Brand.php';  ?>

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php 
  $brand=new Brand();
  if($_SERVER['REQUEST_METHOD']== 'POST')
  {
    $brandName=$_POST['brandName'];
   
    $addbrand=$brand->addbrand($brandName);
  }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
                <?php 
                   if (isset($addbrand)) {
                      echo $addbrand;
                   }


                ?>
               <div class="block copyblock"> 
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" placeholder="Enter Brand Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>