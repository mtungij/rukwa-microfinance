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
                            <li class="breadcrumb-item active">Default  Balance</li>
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
                            <h2>Transifor Default Balance To Blanch Account</h2>
                        </div>
                        <div class="body">
                        <?php echo form_open("oficer/create_transaction_default"); ?>
                        <div class="row">
                
                <div class="col-lg-4 col-12">
                    <span>*Default Type:</span>
                <select class="form-control" name="trans_type"  required>
                <option value="">Select Default Type </option>
                <option value="outsystem">Default Laon Out of System - <?php echo number_format($total_outsystem->total_out_systemData);
                $out_system_account = $this->queries->get_njeya_mfumo_data_account($total_outsystem->blanch_id)
                 ?>
                 /
                 <?php foreach ($out_system_account as $out_system_accounts): ?>
                     <?php echo @$out_system_accounts->account_name ?> - <?php echo @$out_system_accounts->amount_receive; ?>  
                 <?php endforeach; ?></option>
                <option value="insystem">Default Loan In System / <?php echo number_format($total_insystem->total_out_blanch);
               $insystem_account = $this->queries->get_outstand_account_balance($total_insystem->blanch_id);
                 ?>
                 /
                 <?php foreach ($insystem_account as  $insystem_accounts): ?>
                   <?php echo $insystem_accounts->account_name ?> - <?php echo $insystem_accounts->out_balance; ?>  
                 <?php endforeach; ?>
                    
                </option>
                    </select>
                 </div>

                 <div class="col-lg-4 col-12">
                    <span>*From Default account:</span>
                <select class="form-control " name="from_trans_id" required data-live-search="true">
                <option value="">Select Branch Account</option>
                    <?php foreach ($acount as $acounts): ?>
                   <option value="<?php echo $acounts->receive_trans_id; ?>"><?php echo $acounts->account_name; ?></option>
                    <?php endforeach; ?>
                    </select>
                 </div>

                 <div class="col-lg-4 col-12">
                    <span>*To Branch account:</span>
                <select class="form-control " name="to_trans_id" required data-live-search="true">
                <option value="">Select Branch Account</option>
                    <?php foreach ($acount as $acounts): ?>
                   <option value="<?php echo $acounts->receive_trans_id; ?>"><?php echo $acounts->account_name; ?></option>
                    <?php endforeach; ?>
                    </select>
                 </div>


                <div class="col-lg-6 col-6">
                <span>*Amount</span>
            <input type="number" name="amount_trans" autocomplete="off" class="form-control" placeholder="Enter Amount" required>
                </div>
                <div class="col-lg-6 col-6">
                <span>*With/Chargers</span>
            <input type="number" name="trans_fee" autocomplete="off" placeholder="Enter Chargers" class="form-control" required>
                </div>
                <input type="hidden" name="comp_id" value="<?php echo $empl_data->comp_id; ?>">
                <input type="hidden" name="empl_id" value="<?php echo $empl_data->empl_id; ?>">
                <input type="hidden" name="blanch_id" value="<?php echo $empl_data->blanch_id; ?>">
            <!-- <input type="hidden" name="empl" value=""> -->
                <?php $day = date("Y-m-d"); ?>
            <input type="hidden" name="date" value="<?php echo $day;?>">
                                
                                </div>
                                 <br>
                                <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="icon-drawer">Transifor</i></button>
                                </div>
                            
                            <?php echo form_close();  ?>
                        </div>
                    </div>
                </div>
            <div class="col-lg-12">
                    <div class="card">
                         <div class="header">
                            <h2>Transaction List </h2> 
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
                                                <th>S/no.</th>
                                                <th>Default Type</th>
                                                <th>From Default Account</th>
                                                <th>To Branch Account</th>
                                                <th>Amount</th>
                                                <th>Withdrawal Chargers</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no =1; ?>
                                        <?php foreach ($miamala_out as $miamala_outs): ?>
                                        <tr>    
                                            <td><?php echo $no++; ?>.</td>
                                            <td><?php echo $miamala_outs->trans_type; ?></td>
                                            <td><?php echo $miamala_outs->from_account; ?></td>
                                            <td><?php echo $miamala_outs->toaccount; ?></td>
                                            <td><?php echo number_format($miamala_outs->amount_trans); ?></td>
                                            <td><?php echo number_format($miamala_outs->trans_fee); ?></td>
                                            <td><?php echo $miamala_outs->date; ?></td>
                                            <td><a href="<?php echo base_url("oficer/delete_transaction_mistak/{$miamala_outs->id}"); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="icon-trash"></i></a></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td><b>TOTAL:</b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b><?php echo number_format($out_transaction->total_outtrans); ?></b></td>
                                            <td></td>
                                            <td></td>
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
url:"<?php echo base_url(); ?>oficer/fetch_data_vipimioData",
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
                <h6 class="title" id="defaultModalLabel">Filter Transaction</h6>
            </div>
            <?php echo form_open(""); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <?php $date = date("Y-m-d"); ?>
                    <div class="col-md-6">
                    <span>From:</span>
                    <input type="date" class="form-control" value="<?php echo $date; ?>" name="from" required>    
                    </div>
                    <div class="col-md-6">
                    <span>To:</span>
                    <input type="date" class="form-control" name="to" value="<?php echo $date; ?>" required>           
                    </div>
                    <input type="hidden" name="blanch_id" value="<?php echo $_SESSION['blanch_id']; ?>">
                    <input type="hidden" name="comp_id" value="<?php echo $empl_data->comp_id; ?>">
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


