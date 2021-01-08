<section class="footer">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-12">
                 <p>copyright(c)2020</p>
                 </div>
             </div>
         </div>
    </section>                    
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">

function show(data)
{
    alert(data);
}
$('.spanbtn').click(function(){
    var id = $(this).attr('id');

    //alert($('#text_'+id).val());
    //alert($('#rno_'+id).val());
    $.ajax({
               type:"POST",
               url:"addtocart.php",
               data:$('#text_'+id).val()+"&roomno="+$('#rno_'+id).val(),
               success:function(msg)
               {
                   window.location.href = 'hoteldisplay.php?msg=Successfully Selecting the room !';
                   //alert(msg);
                  // $('#roomtype').html(msg);
               }
           });
    
});

</script>
</body>
</html>