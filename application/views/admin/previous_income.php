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
                            <li class="breadcrumb-item active">Previous Non Deducted Income</li>
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
                <div class="col-lg-12">
                    <div class="card">
                         <div class="header">
                            <h2>Previous Non Deducted Income / <?php if (@$blanch_data->blanch_id == FALSE) {
                                echo "ALL";
                             
                            }else{
                            ?><?php echo $blanch_data->blanch_name; ?> 
                            <?php  } ?>/ From:<?php echo $from; ?> - To:<?php echo $to; ?></h2> 
                            <div class="pull-right">
                              <a href="" class="btn btn-sm btn-icon btn-pure btn-primary on-default m-r-5 button-edit"
                                            data-toggle="modal" data-target="#addcontact1" data-original-title="Edit"><i class="icon-calendar"></i>Filter</a>
                                <?php if (count($data) > 0) {
                                 ?> 
                                <a href="<?php echo base_url("admin/print_previous_report/{$from}/{$to}/{$comp_id}/{$blanch_id}") ?>" class="btn btn-primary btn-sm" target="_blank"><i class="icon-printer">Print</i></a>
                            <?php }else{ ?>
                                <?php } ?>
                                <a href="<?php echo base_url("admin/income_dashboard"); ?>" class="btn btn-primary btn-sm"><i class="icon-logout">Back</i></a>
                            </div>   
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover j-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                               <th>Branch Name</th>
                                                <th>Customer Name</th>
                                                <th>Loan Aproved</th>
                                                <th>Incomes Type</th>
                                                <th>Income Amount</th>
                                                <th>User Employee</th>
                                                <th>Date</th>
                                                <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                              <?php $no = 1; ?>
                                    <?php foreach ($data as $customer_incomes): ?>
                                    <tr>
                                <td><?php echo $customer_incomes->blanch_name; ?></td>
                                    <td><?php echo $customer_incomes->f_name; ?> <?php echo $customer_incomes->m_name; ?> <?php echo $customer_incomes->l_name; ?></td>
                                    <td><?php echo number_format($customer_incomes->loan_aprove); ?></td>
                                    <td><?php echo $customer_incomes->inc_name; ?></td>
                                    <td><?php echo number_format($customer_incomes->receve_amount); ?></td>
                                    <td><?php if ($customer_incomes->empl_name == FALSE) {
                                     ?>
                                     -
                                 <?php }else{ ?>
                                        <?php echo $customer_incomes->empl_name; ?>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $customer_incomes->receve_day; ?></td>
                               <!--  <td>
                                <a href="<?php //echo base_url("admin/delete_receved_prev/{$customer_incomes->receved_id}") ?>" class="btn btn-sm btn-icon btn-pure btn-danger on-default m-r-5 button-edit" data-original-title="Delete" onclick="return confirm('Are You Sure?')"><i class="icon-trash"></i>
                                        </a>
                                </td> -->                                                                                   
                                 </tr>
                                
                                 <?php endforeach; ?>
                                 <tr>
                                   <td><b>GENERAL TOTAL</b></td>
                                    <td><?php //echo $customer_incomes->f_name; ?> <?php //echo $customer_incomes->m_name; ?> <?php //echo $customer_incomes->l_name; ?></td>
                                    <td><?php //echo number_format($total_receives->total_receive); ?></td>
                                    <td></td>
                                    <td><b><?php echo number_format($sum_income->total_receved_blanch); ?></b></td>
                                    <td>
                                    </td>
                                    <td></td>                                              
                                 </tr>
                                    </tbody>
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

