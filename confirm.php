<?php
    include 'template/header_cus.php';

?>
<section class="content">
    <div class="container">
        
        <!-- hotel -->
        <div class="row">
            <div class="col-12">
           <h3>Dear Customer ,</h3>
           <p>Room booking process is compltete and thank you for making room reservaation.We will contact you within one business days.If there any enquiry you can contact by using following informations.<br/><p><b>Email:</b>Service@mango.com</p><p><b>BookingID:</b><?php echo $_REQUEST['bid'];?></p>
            </div>
          
        </div>
    </div>
</section>
<?php
include 'template/footer.php';
?>