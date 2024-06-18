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
                            <li class="breadcrumb-item active">Non Deducted Income</li>
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
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Non Deducted Income Form</h2>
                        </div>
                        <div class="body">
                            <?php echo form_open("admin/create_income_detail"); ?>
                            <div class="row">
                                        <div class="col-lg-4 form-group-sub">
                                    <span>Branch:</span>
                                    <select type="number" name="blanch_id" class="form-control kt-selectpicker" id="blanch" data-live-search="true">
                                        <option value="">Select Branch</option>
                                        <?php foreach ($blanch as $blanchs): ?>
                                        <option value="<?php echo $blanchs->blanch_id; ?>"><?php echo $blanchs->blanch_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div> 

                                
                
                <div class="col-lg-4 form-group-sub">
                    <span>Customer:</span>
                <select class="form-control select2" name="customer_id" id="customer">
                        <option value="">Select customer</option>
                    </select>
                </div>

                <div class="col-lg-4 form-group-sub">
                    <span>Active Loan:</span>
                <select class="form-control select2" name="loan_id" id="loan" required>
                <option value="">Select Active Loan </option>
                    </select>
                 </div>

                 <div class="col-lg-4 form-group-sub">
                    <span>Income Type:</span>
                <select class="form-control kt-selectpicker" name="inc_id" required data-live-search="true">
                <option value="">Select Income type</option>
                    <?php foreach ($income as $incomes): ?>
                   <option value="<?php echo $incomes->inc_id; ?>"><?php echo $incomes->inc_name; ?></option>
                    <?php endforeach; ?>
                    </select>
                 </div>

                 <div class="col-lg-4 form-group-sub">
                    <span>Account Type:</span>
                <select class="form-control kt-selectpicker" name="trans_id" id="account" required data-live-search="true">
                <option value="">Select Account</option> 
                </select>
                 </div>


                <div class="col-lg-4 form-group-sub">
                <span>*Income Amount</span>
            <input type="number" name="receve_amount" autocomplete="off" class="form-control" placeholder="Enter Amount" required>
                                </div>
                <input type="hidden" name="comp_id" value="<?php echo $_SESSION['comp_id']; ?>">
            <!-- <input type="hidden" name="empl" value=""> -->
                <?php $day = date("Y-m-d"); ?>
            <input type="hidden" name="receve_day" value="<?php echo $day;?>">
                                
                                </div>
                                 <br>
                                <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="icon-drawer">Save</i></button>
                                </div>
                            
                            <?php echo form_close();  ?>
                        </div>
                    </div>
                </div>


                <div class="col-lg-12">
                    <div class="card">
                         <div class="header">
                            <h2>Today Income List</h2> 
                            <div class="pull-right">
                              <a href="" class="btn btn-sm btn-icon btn-pure btn-primary on-default m-r-5 button-edit"
                                            data-toggle="modal" data-target="#addcontact1" data-original-title="Edit"><i class="icon-calendar"></i>Filter</a> 
                            </div>   
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                                <th>Customer Name</th>
                                                <th>Loan Aproved</th>
                                                <th>Branch Name</th>
                                                <th>Incomes Type</th>
                                                <th>Income Amount</th>
                                                <th>Account Type</th>
                                                <th>User Employee</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                              <?php $no = 1; ?>
                                    <?php foreach ($detail_income as $detail_incomes): ?>
                                              <tr>
                                    <td><?php echo $detail_incomes->f_name; ?> <?php echo $detail_incomes->m_name; ?> <?php echo $detail_incomes->l_name; ?></td>
                                    <td><?php echo number_format($detail_incomes->loan_aprove); ?></td>
                                    <td><?php echo $detail_incomes->blanch_name; ?></td>
                                    <td><?php echo $detail_incomes->inc_name; ?></td>
                                    <td><?php echo number_format($detail_incomes->receve_amount); ?></td>
                                    <td><?php echo $detail_incomes->account_name; ?></td>
                                    <td><?php if ($detail_incomes->empl_name == FALSE) {
                                     ?>
                                     -
                                 <?php }else{ ?>
                                        <?php echo $detail_incomes->empl_name; ?>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $detail_incomes->receve_day; ?></td>
                                <td>
                                <a href="<?php echo base_url("admin/delete_receved/{$detail_incomes->receved_id}") ?>" class="btn btn-sm btn-icon btn-pure btn-danger on-default m-r-5 button-edit" data-original-title="Delete" onclick="return confirm('Are You Sure?')"><i class="icon-trash"></i>
                                        </a>
                                </td>                                                                                   
                            </tr>
   
                                         <?php endforeach; ?>
                                    </tbody>
                                     <tr>
                                             <td><b>TOTAL:</b></td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td><b><?php echo number_format($total_receved->total_receved) ?></b></td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                         </tr>
                                </table>
                            </div>
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
url:"<?php echo base_url(); ?>admin/fetch_ward_data",
method:"POST",
data:{blanch_id:blanch_id},
success:function(data)
{
$('#customer').html(data);
//$('#district').html('<option value="">All</option>');
}
});
}
else
{
$('#customer').html('<option value="">Select customer</option>');
//$('#district').html('<option value="">All</option>');
}



});



$('#customer').change(function(){
var customer_id = $('#customer').val();
 //alert(customer_id)
if(customer_id != '')
{
$.ajax({
url:"<?php echo base_url(); ?>admin/fetch_data_vipimioData",
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



 <div class="modal fade" id="addcontact1" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Filter Income</h6>
            </div>
            <?php echo form_open("admin/previous_income"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12">
                    <span>Select Branch:</span>
                    <select type="number" class="form-control" name="blanch_id" required>
                        <option value="">---Select Branch---</option>
                        <?php foreach ($blanch as $blanchs): ?>
                        <option value="<?php echo $blanchs->blanch_id; ?>"><?php echo $blanchs->blanch_name; ?></option>
                        <?php endforeach; ?>
                        <option value="all">All</option>
                    </select>            
                    </div>
                    <?php $date = date("Y-m-d"); ?>
                    <div class="col-md-6">
                    <span>From:</span>
                    <input type="date" class="form-control" value="<?php echo $date; ?>" name="from" required>    <input type="hidden" name="comp_id" value="<?php echo $_SESSION['comp_id']; ?>">       
                    </div>
                    <div class="col-md-6">
                    <span>To:</span>
                    <input type="date" class="form-control" name="to" value="<?php echo $date; ?>" required>           
                    </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Filter</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>


