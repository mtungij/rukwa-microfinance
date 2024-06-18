<?php include('incs/header.php'); ?>
<?php include('incs/nav.php'); ?>
<?php include('incs/side.php'); ?>

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url("oficer/index"); ?>"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">Transaction From Branch To Branch</li>
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
                            <h2>Transfor Amount From Branch Account To Another Branch</h2>
                        </div>
                        <div class="body">
                            <?php echo form_open("oficer/transfor_amount_from_blanch_to_branch") ?>
                            <div class="row">
                               <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <span>From Branch Account</span>
                                    <select type="number" class="form-control" name="from_blanch_account" required>
                                        <option value="">---Select Account---</option>
                                        <?php foreach ($acount as $acounts): ?>
                                        <option value="<?php echo $acounts->receive_trans_id; ?>"><?php echo $acounts->account_name; ?> / <?php echo number_format($acounts->blanch_capital); ?></option>
                                         <?php endforeach;?>
                                    </select>
                                    <?php $date = date("Y-m-d"); ?>
                                    <input type="hidden" name="from_blanch" value="<?php echo $empl_data->blanch_id; ?>">
                                    <input type="hidden" name="comp_id" value="<?php echo $empl_data->comp_id; ?>">
                                    <input type="hidden" name="date_trans" value="<?php echo $date; ?>">
                                </div>
                                </div>
                                 <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <span>Amount</span>
                                    <input type="number" name="from_amount" class="form-control" placeholder="Enter Amount" required>
                                </div>
                                </div>
                                <div class="col-md-4 col-6">
                                <div class="form-group">
                                    <span>To Branch</span>
                                    <select type="number" class="form-control" name="to_branch" id="blanch" required>
                                        <option value="">---Select Account---</option>
                                        <?php foreach ($blanch as $blanchs): ?>
                                        <option value="<?php echo $blanchs->blanch_id; ?>"><?php echo $blanchs->blanch_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    
                                </div>
                                </div>

                                <div class="col-md-6 col-6">
                                <div class="form-group">
                                    <span>To Branch Account</span>
                                    <select type="number" class="form-control" name="to_branch_account" id="account" required>
                                        <option value="">---Select Account---</option>
                                    </select>
                                    
                                </div>
                                </div>
                                 <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <span>Chargers Fee</span>
                                    <input type="number" name="charger_fee" class="form-control" placeholder="Enter Charger Fee" required>
                                </div>
                                </div>
                                <br>
                                </div>
                                <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="icon-drawer">Transfor</i></button>
                                </div>
                            
                            <?php echo form_close();  ?>
                        </div>
                    </div>
                </div>


                <div class="col-lg-12">
                    <div class="card">
                         <div class="header">
                            <h2>Transaction List</h2>    
                             </div>
                          <div class="body">
                            <div class="table-responsive">

                                
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                            <th>S/No.</th>
                                            <th>From Branch</th>
                                            <th>From Branch Account</th>
                                            <th>From Amount</th>
                                            <th>To Branch </th>
                                            <th>To Branch Account</th>
                                            <th>To Amount</th>
                                            <th>Chargers Fee</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $no = 1; ?>
                                       <?php foreach ($transaction as $transactions): ?>
                                        <tr>
                                            <td><?php echo $no++; ?>.</td>
                                            <td><?php echo $transactions->from_blanch; ?></td>
                                            <td><?php echo $transactions->from_account; ?></td>
                                            <td><?php echo number_format($transactions->from_amount); ?></td>
                                            <td><?php echo $transactions->toBlanch; ?></td>
                                            <td><?php echo $transactions->to_account; ?></td>
                                            <td><?php echo number_format($transactions->to_amount); ?></td>
                                            <td><?php echo number_format($transactions->charger_fee); ?></td>
                                            <td><?php echo $transactions->date_trans; ?></td>
                                            <td>
                                                <?php $date = date("Y-m-d"); ?>
                                                <?php if ($transactions->date_trans == $date) {
                                                ?>
                                            <a href="<?php echo base_url("oficer/remove_transaction_float/{$transactions->id}"); ?>" class="btn btn-sm btn-icon btn-pure btn-primary on-default m-r-5 button-edit" data-original-title="Delete" onclick="return confirm('Are you sure?')"><i class="icon-pencil"></i></a>
                                        <?php  }else{ ?>
                                            <?php } ?>
                                        </td>
                                        </tr>
                                         <?php endforeach; ?>
                                    </tbody>
                                    <tr>
                                        <td><b>TOTAL:</b></td>
                                        <td></td>
                                        <td></td>
                                        <td><b><?php echo number_format($sum_trans->total_amount_trans); ?></b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b><?php echo number_format($sum_trans->total_fee); ?></b></td>
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
url:"<?php echo base_url(); ?>oficer/fetch_blanch_account",
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
$('#account').html('<option value="">Select Employee</option>');
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


