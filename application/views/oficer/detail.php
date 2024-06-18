<?php include('incs/header.php'); ?>
<?php include('incs/nav.php'); ?>
<?php include('incs/side.php'); ?>

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url("admin/index"); ?>"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">Customer</li>
                            <li class="breadcrumb-item active">Customer Additinal Details</li>
                        </ul>
                    </div>            
                 
                </div>
            </div>
                  <?php if ($das = $this->session->flashdata('massage')): ?> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="alert alert-dismisible alert-success"> <a href="" class="close">&times;</a> 
                                    <?php echo $das;?> </div> 
                            </div> 
                        </div> 
                    <?php endif; ?>
                     <?php if ($das = $this->session->flashdata('error')): ?> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="alert alert-dismisible alert-danger"> <a href="" class="close">&times;</a> 
                                    <?php echo $das;?> </div> 
                            </div> 
                        </div> 
                    <?php endif; ?>
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Customer Additinal Details</h2>
                        </div>
                        <div class="body">
                            <?php echo form_open("oficer/create_lastDetail/{$customer->customer_id}") ?>
                            <div class="row">

                            
                                    <div class="col-lg-4 col-12">
                                    <span>Account Type:</span>
                            <select type="number" name="account_id" class="form-control input-sm">
                                <option value="">Select</option>
                                <?php foreach ($account as $accounts): ?>
                                <option value="<?php echo $accounts->account_id; ?>"><?php echo $accounts->account_name; ?></option>
                                <?php endforeach; ?>
                                
                            </select>
                                </div>
                                
                                <div class="col-lg-2 col-6">
                                    <span>ID Type:</span>
                                   <select type="text" name="id_type" class="form-control">
                                       <option value="">Select</option>
                                       <option value="voter ID">voter ID</option>
                                       <option value="National  ID (NIDA)">National  ID (NIDA)</option>
                                       <option value="Driver's license">Driver's license</option>
                                   </select>
                                </div>
                                <div class="col-lg-2 col-6">
                                    <br>
                                    <span></span>
                                    <input type="text" name="natinal_identity" placeholder="Enter Id Cresidentials" autocomplete="off" class="form-control input-sm">
                                </div>

                            
                                <input type="hidden" name="customer_id" value="<?php echo $customer->customer_id; ?>">
                                <br>
                                </div>
                            </div>
                                <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="icon-arrow-right">Next</i></button>
                            <!--     <a href="<?php //echo base_url("oficer/customer_profile/{$customer->customer_id}") ?>" class="btn btn-info btn-elevate btn-pill"><i class="icon-arrow-right">Next</i></a> -->
                                </div>
                            
                            <?php echo form_close();  ?>
                        </div>
                    </div>
                </div>
             
            </div>
        </div>
    </div>
</div>

<?php include('incs/footer.php'); ?>


<script>
    function getDate(data){
  let now = new Date();
  let bod = (new Date(data));

  let age = now.getFullYear() - bod.getFullYear();
   let _age = document.querySelector("#age");
   _age.value = age;
 //alert(age)
}
</script>


<script>
$(document).ready(function(){
$('#blanch').change(function(){
var blanch_id = $('#blanch').val();
//alert(blanch_id)
if(blanch_id != ''){

$.ajax({
url:"<?php echo base_url(); ?>admin/fetch_employee_blanch",
method:"POST",
data:{blanch_id:blanch_id},
success:function(data)
{
$('#empl').html(data);
//$('#district').html('<option value="">All</option>');
}
});
}
else
{
$('#empl').html('<option value="">Select Employee</option>');
//$('#district').html('<option value="">All</option>');
}
});



// $('#customer').change(function(){
// var customer_id = $('#customer').val();
//  //alert(customer_id)
// if(customer_id != '')
// {
// $.ajax({
// url:"<?php echo base_url(); ?>admin/fetch_data_vipimioData",
// method:"POST",
// data:{customer_id:customer_id},
// success:function(data)
// {
// $('#loan').html(data);
// //$('#malipo_name').html('<option value="">select center</option>');
// }
// });
// }
// else
// {
// $('#loan').html('<option value="">Select Active loan</option>');
// //$('#malipo_name').html('<option value="">chagua vipimio</option>');
// }
// });

// $('#social').change(function(){
//  var district_id = $('#social').val();
//  if(district_id != '')
//  {
//   $.ajax({
//    url:"<?php echo base_url(); ?>user/fetch_data_malipo",
//    method:"POST",
//    data:{district_id:district_id},
//    success:function(data)
//    {
//     $('#malipo_name').html(data);
//     //$('#malipo').html('<option value="">chagua malipo</option>');
//    }
//   });
//  }
//  else
//  {
//   //$('#vipimio').html('<option value="">chagua vipimio</option>');
//   $('#malipo_name').html('<option value="">chagua vipimio</option>');
//  }
// });


});
</script>


