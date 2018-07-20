<?php 
   
  include '../classes/Catagory.php'; 
   $cat=new Catagory();
?>

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
   
  if(!isset($_GET['catid']) or $_GET['catid']==NULL)
  {
    echo "<script>window.location='catlist.php'</script>";
  }
  else
  {
    $id=$_GET['catid'];
  }


?>

<?php 
  
  if($_SERVER['REQUEST_METHOD']== 'POST')
  {
    $catname=$_POST['catname'];
   
    $editcat=$cat->editcatagory($catname,$id);
  }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Catagory</h2>
                <?php 
                   if (isset($editcat)) {
                      echo $editcat;
                   }


                ?>
                <?php 
                 $getcat=$cat->getcatbyId($id);
                 if ($getcat) {
                   while ($value=$getcat->fetch_assoc()) {
                     # code...
                   
              
                ?>
               <div class="block copyblock"> 
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catname" value="<?php echo $value['catname']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>