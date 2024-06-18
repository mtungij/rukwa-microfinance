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
                            <li class="breadcrumb-item active">Expenses Requisition Form</li>
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
                            <h2>Request Expenses</h2>
                        </div>
                        <div class="body">
    <?php echo form_open("admin/create_requstion_form") ?>
    <div class="row">
    <div class="col-lg-3">
    <div class="form-group">
      <span>Select Branch:</span>
        <select type="text" name="blanch_id" id="blanch" class="form-control">
         <option type="">Select Branch</option>
        <?php foreach ($blanch as $blanchs): ?>
          <option value="<?php echo $blanchs->blanch_id; ?>"><?php echo $blanchs->blanch_name; ?></option>
          <?php endforeach; ?>
        </select>
    </div>
    </div>
         <div class="col-lg-3">
    <div class="form-group">
      <span>Select Expenses:</span>
        <select type="number" name="ex_id"  class="form-control">
         <option type="">Select Expenses</option>
        <?php foreach ($expns as $expnss): ?>
          <option value="<?php echo $expnss->ex_id; ?>"><?php echo $expnss->ex_name; ?></option>
          <?php endforeach; ?>
        </select>
    </div>
    </div>

    <div class="col-lg-3">
    <div class="form-group">
      <span>Amount:</span>
        <input type="number" class="form-control" placeholder="Amount" name="req_amount" autocomplete="off" required>
    </div>
    </div>
        <div class="col-lg-3">
    <div class="form-group">
      <span>Account Type:</span>
        <select type="text" name="trans_id" id="account"  class="form-control" required>
         <option type="">Select Account Type</option>
        </select>
    </div>
    </div>

     <div class="col-lg-12">
    <div class="form-group">
      <span>Description:</span>
        <textarea type="text" class="form-control"  rows="4" placeholder="Description" name="req_description" autocomplete="off" required></textarea>
    </div>
    </div>
    <input type="hidden" name="comp_id"   value="<?php echo $_SESSION['comp_id']; ?>">
    <?php $date = date("Y-m-d"); ?>
    <input type="hidden" name="req_date" value="<?php echo $date; ?>">
                                
                               
                                </div>
                                 <br>
                                <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="icon-drawer">Save</i></button>
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
$('#blanch').change(function(){
var blanch_id = $('#blanch').val();
//alert(blanch_id)
if(blanch_id != ''){

$.ajax({
url:"<?php echo base_url(); ?>admin/fetch_account_blanch",
method:"POST",
data:{blanch_id:blanch_id},
success:function(data)
{
$('#account').html(data);
//$('#district').html('<option value="">All</option>');
}
});
}
else
{
$('#account').html('<option value="">Select Account</option>');
//$('#district').html('<option value="">All</option>');
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





