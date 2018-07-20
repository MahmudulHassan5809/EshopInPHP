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
.ca 
{
	padding: 2px !important;
	margin-left: 5px !important;
	color:black !important;
	background-color: gray !important;
	border-radius: 5px;
}	
.payment
{
   width: 400px;
   min-height: 200px;
   text-align: center;
   border:1px solid gray;
   margin:0 auto;
   padding: 50px;
   position: relative;
}
.payment h2
{
  
}
.payment a
{
 color: black;
 padding: 5px;
 background-color: gray;
 margin-left: 10px;
 border-radius: 5px; 
}
.back a {
  background-color: #555;
  border: 1px solid gray;
  border-radius: 3px;
  bottom: 48%;
  color: white;
  left: 34%;
  margin-top: 10px;
  padding-bottom: 4px;
  position: absolute;
  text-align: center;
  width: 145px;
}

</style>



<?php include 'inc/header.php'; ?>






  <div class="main">
    <div class="content">
    	<div class="section group">
        <div class="payment">
            <h2>Choose Yor Payment Option</h2>
            <a href="offline.php">Offline Payment</a>
            <a href="online.php">Online Payment</a>
            
            <div class="back">
           <a href="cart.php">Previous</a>
            </div>

        </div>
        
    	
 		 </div>
 		</div>
 	</div>



<?php  include 'inc/footer.php' ; ?>