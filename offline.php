<style type="text/css">

.ftblone
{
  width: 100% !important;
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
  
  color:black !important;
  background-color: gray !important;
  border-radius: 5px;
}
.offline
{
  width:50%;
  float: left;
} 
.ordernow {
  margin: 0 auto;
  width: 100px;
  padding: 10px 0;
}
.ordernow a
{
  color: black;
  background-color: red;
  display: block;
  text-align: center;
  text-transform: uppercase;
  border-radius: 5px;
  padding: 5px;
}
</style>




<?php include 'inc/header.php'; ?>

<?php 
  $login=Session::get('userlogin');
  $id=Session::get('userid');
  if($login==false)
  {
  echo "<script>window.location='login.php'</script>";
  }

?>
<?php 
   if (isset($_GET['orderid']) && $_GET['orderid']=='order') {
       $id=Session::get('userid');
       $isertorderData = $ct->orderproduct($id);
       $deldata=$ct->delcudtomercart();
       echo "<script>window.location='success.php'</script>";
   }




?>




  <div class="main">
    <div class="content">
    	<div class="section group">
        <div class="offline">
            <table class="tblone">
              <tr>
                 <th width="20%">Serial No</th>
                <th width="20%">Product Name</th>
               
                <th width="20%">Price</th>
                <th width="20%">Quantity</th>
                <th width="20%">Total Price</th>
               
              </tr>
              <?php 
                            $getpro=$ct->getcartproduct();
                             if ($getpro) {
                              $i=0;
                              $sum=0;
                              $quantity=0;
                              while ($result=$getpro->fetch_assoc()) {
                                $i++;
                              
                             
              ?>
              <tr>
                 <td><?php echo $i; ?></td>
                <td><?php echo $result['productName']; ?></td>
                
                <td>$<?php echo $result['price']; ?></td>
                <td>
                 <?php echo $result['quantity']; $quantity=$quantity+$result['quantity']; ?>

                </td>
                <td>$<?php 
                                  $total=$result['price']*$result['quantity'];
                echo $total; ?></td>
                
              </tr>
              <?php $sum=$sum+$total;  ?>

              <?php } } ?>
              
            </table>
            <?php
            $getData=$ct->checkCarttbl();
                                if($getData){
                                  ?>
            <table style="float:right;text-align:left;" width="40%">
              <tr>
                <th>Sub Total : </th>
                <td><?php
                                  if(isset($sum))
                                  {
                 echo $sum; 
                 }?></td>
              </tr>
              <tr>
                <th>VAT : </th>
                <td>10%</td>
              </tr>
              <tr>
                <th>Grand Total :</th>
                <td><?php
                   if(isset($sum)) 
                   {
                                   $vat=$sum*0.1;
                                   $gtotal=$sum+$vat;
                                   
                               }
                                   if(isset($gtotal))
                                   {
                                    echo $gtotal;
                                }
                ?></td>
              </tr>
               <tr>
                <th>Total Quantity:</th>
                <td><?php
                  if(isset($quantity)){
                   echo $quantity;
                  }
                ?></td>
              </tr>
             </table> 
             <?php } ?>
        </div>
        <div class="offline">
        <?php 
             $getuserdata=$user->getuserdata($id);
              if ($getuserdata) {
                  while ($result=$getuserdata->fetch_assoc()) {
                    
                  
              

        ?>
            <form action="" method="POST">
          <table class="tblone ftblone">
              <tr>
              <td colspan="3">User Profile</td>
              
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
                          
                           
                          <a class="ca" href="profile.php?userid=<?php echo $result['cId'];  ?>">To Update Click Here</a>
                       
                       <?php } ?>
                     
              </td>
            </tr>
          </table>
          </form>
          <?php } } ?>
      
        </div>
        
    	
 		 </div>
 		</div>
     <div class="ordernow"><a href="?orderid=order">Order</a></div>
 	</div>



<?php  include 'inc/footer.php' ; ?>