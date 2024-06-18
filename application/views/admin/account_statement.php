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
                            <li class="breadcrumb-item active">Report</li>
                             <li class="breadcrumb-item active">Customer Account Statement</li>
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
                            <h2>Search Customer</h2>
                        </div>
                        <div class="body">
                            <?php echo form_open_multipart("admin/search_acount_statement"); ?>
                            <div class="row">

                              <div class="col-lg-6 col-6">
                                  <select type="number" class="form-control select2" name="customer_id" id="customer"required>
                                     <option value="">Search Customer</option>
                                     <?php foreach ($customer as $customers): ?>
                                     <option value="<?php echo $customers->customer_id; ?>"><?php echo $customers->f_name; ?> <?php echo $customers->m_name; ?> <?php echo $customers->l_name; ?> / <?php echo $customers->customer_code; ?></option>
                                 <?php endforeach; ?>
                                 </select>
                                </div>
                                 <div class="col-lg-6 col-6">
                                 <select type="number" class="form-control select2" name="loan_id" id="loan"required>
                                     <option value="">Select Loan</option>
                                 </select>
                                </div>
                                </div>
                               
                                
                            </div>
                                <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="icon-pencil">Search</i></button>
                               
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

$('#customer').change(function(){
var customer_id = $('#customer').val();
 //alert(customer_id)
if(customer_id != '')
{
$.ajax({
url:"<?php echo base_url(); ?>admin/fetch_data_loanActive",
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
$('#loan').html('<option value="">Select Active loan</option>');
//$('#malipo_name').html('<option value="">chagua vipimio</option>');
}
});



$('#blanch').change(function(){
 var blanch_id = $('#blanch').val();
 //alert (blanch_id)
 if(blanch_id != '')
 {
  $.ajax({
   url:"<?php echo base_url(); ?>admin/fetch_blanch_account",
   method:"POST",
   data:{blanch_id:blanch_id},
   success:function(data)
   {
    $('#account').html(data);
    //$('#malipo').html('<option value="">chagua malipo</option>');
   }
  });
 }
 else
 {
  //$('#vipimio').html('<option value="">chagua vipimio</option>');
  $('#account').html('<option value="">Select Account</option>');
 }
});


});
</script>








