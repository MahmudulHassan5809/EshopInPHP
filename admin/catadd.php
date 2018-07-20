<?php
  
 include '../classes/Catagory.php' ;  ?>

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php 
  $cat=new Catagory();
  if($_SERVER['REQUEST_METHOD']== 'POST')
  {
    $catname=$_POST['catname'];
   
    $addcat=$cat->addcatagory($catname);
  }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
                <?php 
                   if (isset($addcat)) {
                      echo $addcat;
                   }


                ?>
               <div class="block copyblock"> 
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catname" placeholder="Enter Category Name..." class="medium" />
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