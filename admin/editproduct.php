<?php 

include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php';  ?>
<?php include '../classes/Catagory.php' ;  ?>
<?php include '../classes/Product.php';  ?>

<?php 
    if(!isset($_GET['pid']) or $_GET['pid']==NULL)
  {
    echo "<script>window.lobrandion='productlist.php'</script>";
  }
  else
  {
    $id=$_GET['pid'];
  }


?>
<?php 
$pd=new Product();
  if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['submit']))
  {
    
   
    $updateproduct=$pd->updateproduct($_POST,$_FILES,$id);
  }


?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>

        <div class="block">
         
                         <?php 
      if (isset($updateproduct)) {
         echo $updateproduct;
      }

        ?>      

            <?php 
                 $getproduct=$pd->getproductbyId($id);
                 if ($getproduct) {
                   while ($value=$getproduct->fetch_assoc()) {
                    
                   
              
                ?>   

         <form action="" method="POST" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $value['productName'];  ?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catid">
                            <option>Select Catagory</option>
                            <?php 
                             $cat=new Catagory();
                              $getcat= $cat->getallCat();
                              if ($getcat) {
                                 while ($result=$getcat->fetch_assoc()) {
                                    
                                ?>
                            
                            <option <?php 
                               if($value['catid']==$result['catid'])
                               {?>

                                     selected="selected"
                                      <?php
                               }
                            ?> value="<?php echo $result['catid'] ; ?>" >
                             


                            <?php echo $result['catname'] ; ?></option>
                            <?php } } ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandId">
                            <option >Select Brandname</option>
                            
                            <?php 
                             $brand=new Brand();
                              $getbrand= $brand->getallbrand();
                              if ($getbrand) {
                                 while ($result=$getbrand->fetch_assoc()) {
                                    
                                 
                              
                                   
                            ?>
                            
                            <option value="<?php echo $result['brandId'] ; ?>" <?php 
                               if($value['brandId']==$result['brandId'])
                               {?>

                                     selected="selected"
                                      <?php
                               }
                            ?>>

                               


                            <?php echo $result['brandName'] ; ?></option>
                            <?php } } ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body">
                            <?php echo $value['body'] ; ?>
                        </textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $value['price'] ; ?>"  class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                       <img src="<?php echo $value['image'] ;  ?>" width="30%"><br>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                        
                            <option>Select Type</option>
                            <?php
                             if ($value['type']==0) {?>
                               <option value="0" selected="">Featured</option>
                            <option value="1">Non-Featured</option> 
                            <?php } else{
                            ?>
                            <option value="0">Featured</option>
                            <option value="1" selected="">Non-Featured</option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
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


