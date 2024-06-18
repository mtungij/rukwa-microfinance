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
                            <li class="breadcrumb-item active">Saving Deposit</li>
                             <li class="breadcrumb-item active">Deposit Amount</li>
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
                            <h2>Deposit Saving</h2>
                            
                        </div>
                        <div class="text-center">
                                        <img id="loaderIcon" style="visibility:hidden; display:none;width: 100px; height: 100px;"
                                    src="https://c.tenor.com/I6kN-6X7nhAAAAAj/loading-buffering.gif" alt="Please wait" />
                                </div>
                        <div class="body">
                            <?php echo form_open_multipart("admin/deposit_loan_saving",['id'=>'login_form']); ?>
                            <div class="row">
                                 <div class="col-lg-4 col-12"> 
                                 <span>Search Customer</span> 
                                 <select type="number" class="form-control select2" name="customer_id" id="customer" required>
                                     <option value="">Search Customer</option>
                                     <?php foreach ($customer as $customers): ?>
                                     <option value="<?php echo $customers->customer_id; ?>"><?php echo $customers->f_name; ?> <?php echo $customers->m_name; ?> <?php echo $customers->l_name; ?> / <?php echo $customers->customer_code; ?></option>
                                 <?php endforeach; ?>
                                 </select>
                                </div>
                                 <div class="col-lg-4 col-6">
                                    <span>Amount</span>
                                    <input type="number" name="depost" value="<?php echo $data_saving->amount; ?>" class="form-control" readonly required>
                                </div>
                                <input type="hidden" name="blanch_id" value="<?php echo $data_saving->blanch_id; ?>">
                                <input type="hidden" name="comp_id" value="<?php echo $data_saving->comp_id; ?>">
                                <input type="hidden" name="p_method" value="<?php echo $data_saving->provider; ?>">
                                 <input type="hidden" value="LOAN RETURN" name="description">
                                  <input type="hidden" name="double" value="NO" class="form-control">

                                 <input type="hidden" id="loan">
                                 <input type="hidden" id="day">
                                 <div class="col-lg-4 col-6">
                                    <?php $date = date("Y-m-d"); ?>
                                    <span>Deposit Date</span>
                                    <input type="date" name="deposit_date" value="<?php echo $date; ?>" class="form-control" required>
                                </div>
                                </div>
                                
                            </div>
                                <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="icon-pencil">Deposit</i></button>
                               
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
    $(document).ready(function(){
        $('#login_form').submit(function() {
            $('#loaderIcon').css('visibility', 'visible');
            $('#loaderIcon').show();
        });
    })
</script>


<script>
$(document).ready(function(){

// $('#blanch').change(function(){
// var blanch_id = $('#blanch').val();
// //alert(blanch_id)
// if(blanch_id != ''){

// $.ajax({
// url:"<?php //echo base_url(); ?>admin/fetch_ward_data",
// method:"POST",
// data:{blanch_id:blanch_id},
// success:function(data)
// {
// $('#customer').html(data);
// //$('#district').html('<option value="">All</option>');
// }
// });
// }
// else
// {
// $('#customer').html('<option value="">Select customer</option>');
// //$('#district').html('<option value="">All</option>');
// }
// });



$('#customer').change(function(){
var customer_id = $('#customer').val();
 //alert(customer_id)
if(customer_id != '')
{
$.ajax({
url:"<?php echo base_url(); ?>admin/fetch_active_loan",
method:"POST",
data:{customer_id:customer_id},
success:function(data)
{
$('#loan').html(data);
//$('#malipo_name').html('<option value="">select center</option>');
}
});
}
else
{
$('#loan').html('<input value="">');
//$('#malipo_name').html('<option value="">chagua vipimio</option>');
}
});


$('#customer').change(function(){
var customer_id = $('#customer').val();
 //alert(customer_id)
if(customer_id != '')
{
$.ajax({
url:"<?php echo base_url(); ?>admin/fetch_loan_day",
method:"POST",
data:{customer_id:customer_id},
success:function(data)
{
$('#day').html(data);
//$('#malipo_name').html('<option value="">select center</option>');
}
});
}
else
{
$('#day').html('<input value="">');
//$('#malipo_name').html('<option value="">chagua vipimio</option>');
}
});

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








