<?php
   
 include '../classes/Brand.php'; 
   $brand=new Brand();
?>

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
   
  if(!isset($_GET['brandid']) or $_GET['brandid']==NULL)
  {
    echo "<script>window.lobrandion='brandlist.php'</script>";
  }
  else
  {
    $id=$_GET['brandid'];
  }


?>

<?php 
  
  if($_SERVER['REQUEST_METHOD']== 'POST')
  {
    $brandName=$_POST['brandName'];
   
    $editbrand=$brand->editbrand($brandName,$id);
  }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Catagory</h2>
                <?php 
                   if (isset($editbrand)) {
                      echo $editbrand;
                   }


                ?>
                <?php 
                 $getbrand=$brand->getbrandbyId($id);
                 if ($getbrand) {
                   while ($value=$getbrand->fetch_assoc()) {
                     # code...
                   
              
                ?>
               <div class="block copyblock"> 
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" value="<?php echo $value['brandName']; ?>" class="medium" />
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