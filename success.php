<style type="text/css">

.success
{
   width: 400px;
   min-height: 200px;
   text-align: center;
   border:1px solid gray;
   margin:0 auto;
   padding: 50px;
   position: relative;
}
.success h2
{
  border-bottom: 1px solid #ddd;margin-bottom: 20px;
  padding-bottom: 10px;
}
.success p
{
  line-height: 25px;

}


</style>



<?php include 'inc/header.php'; ?>






  <div class="main">
    <div class="content">
    	<div class="section group">
        <div class="success">
            <h2>Success</h2>
            <p>Payment Successfully</p>
            <?php 
              $id=Session::get('userid');
              $amount=$ct->payableAmount($id);
              if ($amount) {
                 $sum=0;
                while ($result=$amount->fetch_assoc()) {
                       $price=$result['price'];
                       $sum=$sum+$price;
                }
              }

            ?>
            <p>Total Payable Amount(including VAT): $
              <?php
              
                 
                
              $vat=$sum * 0.1;
              $total=$sum+$vat;
              echo $total;
            
              ?>
            </p> 
            <p>THnakx For Purchase .Receive Your Order Successfully.Will you Contact You ASAP with delivery details.Here Is your order details.....<a href="orderdetails.php">View Here</a></p>
            
            

        </div>
        
    	
 		 </div>
 		</div>
 	</div>



<?php  include 'inc/footer.php' ; ?>