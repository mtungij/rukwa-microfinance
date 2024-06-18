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
                            <li class="breadcrumb-item active">Default Loan</li>
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
                            <h2>Default Outsystem Loan</h2>
                            <div class="pull-right">
                                <a href="" data-toggle="modal" data-target="#addcontact1" class="btn btn-primary"><i class="icon-pencil">Add Amount</i></a>
                                <!--  <a href="<?php //echo base_url("oficer/out_ofsyastem"); ?>" class="btn btn-primary"><i class="icon-eye">Default Out System </i></a> -->
                            </div>    
                         </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                        <th>S/no.</th>
                                        <th>Branch</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                        
                                       <!--  <th>Action</th> -->
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                       <?php $no = 1 ?>        
                                <?php foreach($data_blanch_out as $data_blanch_outs): ?>
                                        <tr>
                                    <td><?php echo $no++; ?>.</td>
                                    <td class="c"><?php echo $data_blanch_outs->blanch_name; ?></td>
                                    <td><?php echo number_format($data_blanch_outs->out_amount - $data_blanch_outs->total_deposit_out); ?></td>
                                   <td><a href="" data-toggle="modal" data-target="#addcontact1<?php echo $data_blanch_outs->id;?>" class="btn btn-primary btn-sm"><i class="icon-pencil"></i></a></td> 
                                 </tr>

    <div class="modal fade" id="addcontact1<?php echo $data_blanch_outs->id;?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Edit Form</h6>
            </div>
            <?php echo form_open("admin/update_out_prepaid/{$data_blanch_outs->id}"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                 <div class="col-lg-12 col-12">
                <span>Amount:</span>
                <input type="number" name="out_amount" value="<?php echo $data_blanch_outs->out_amount; ?>" class="form-control" placeholder="Enter Amount" required>
                 </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="icon-pencil">Update</i></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
                            <?php endforeach; ?>
                                    </tbody>
                                     <tr>
                                    <td><b>TOTAL:</b></td>
                                    <td></td>
                                    <td><b><?php echo $total_out_balance->total_amount_out; ?></b></td>
                                    <td></td>
                                </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div> 



                <div class="col-lg-12">
                    <div class="card">
                         <div class="header">
                            <h2>Today Depost List </h2> 
                            <div class="pull-right">
                              <a href="" class="btn btn-sm btn-icon btn-pure btn-primary on-default m-r-5 button-edit"
                                            data-toggle="modal" data-target="#addcontact3" data-original-title="Edit"><i class="icon-pencil"></i>Deposit</a> 
                           <a href="" data-toggle="modal" data-target="#addcontact4" class="btn btn-primary"><i class="icon-calendar">Filter </i></a>
                            </div>   
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                                <th>S/no.</th>
                                                <th>Branch</th>
                                                <th>Customer Name</th>
                                                <th>Account</th>
                                                <th>Amount</th>
                                                <th>Employee</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no =1; ?>
                                        <?php foreach ($out_deposit as $transactions): ?>
                                        <tr>
                                            <td><?php echo $no++; ?>.</td>
                                            <td class="c"><?php echo $transactions->blanch_name ?></td>
                                            <td><?php echo $transactions->customer_name; ?></td>
                                            <td><?php echo $transactions->account_name; ?></td>
                                            <td><?php echo number_format($transactions->amount); ?></td>
                                            <td>
                                                <?php if ($transactions->empl_name == FALSE) {
                                                    echo "ADMIN";
                                                ?>
                                            <?php  }else{ ?>
                                                <?php echo $transactions->empl_name; ?>
                                                <?php } ?>
                                                    
                                                </td>
                                            <td><?php echo $transactions->date; ?></td>
                                            <td><a href="<?php echo base_url("admin/delete_outstand_system/{$transactions->id}"); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure?')"><i class="icon-trash"></i></a></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td><b>TOTAL:</b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b><?php echo number_format($sum_depost->total_outsystem); ?></b></td>
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



<div class="modal fade" id="addcontact4" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Filter</h6>
            </div>
            <?php echo form_open(""); ?>
            <div class="modal-body">
                <div class="row clearfix">
                <div class="col-lg-12 col-12">
                <span>Select Branch:</span>
                <select type="number" class="form-control" name="blanch_id"  required>
                <option value="">Select Branch </option>
                <?php foreach ($blanch as $blanchs): ?>
                <option value="<?php echo $blanchs->blanch_id; ?>"><?php echo $blanchs->blanch_name; ?></option>
                <?php endforeach; ?>
                    </select>
                 </div>
                 <?php $date = date("Y-m-d"); ?>
                 <div class="col-lg-6 col-6">
                <span>From:</span>
                <input type="date" name="from" class="form-control" value="<?php echo $date; ?>" required>
                 </div>
                 <div class="col-lg-6 col-6">
                <span>To:</span>
                <input type="date" name="to" class="form-control" value="<?php echo $date; ?>" required>
                 </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="icon-pencil">Filter</i></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>



<div class="modal fade" id="addcontact1" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Add Amount</h6>
            </div>
            <?php echo form_open("admin/create_default_loan_out"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                <div class="col-lg-12 col-12">
                <span>Select Branch:</span>
                <select type="number" class="form-control" name="blanch_id"  required>
                <option value="">Select Branch </option>
                <?php foreach ($blanch as $blanchs): ?>
                <option value="<?php echo $blanchs->blanch_id; ?>"><?php echo $blanchs->blanch_name; ?></option>
                <?php endforeach; ?>
                    </select>
                 </div>
                 <div class="col-lg-12 col-12">
                <span>Amount:</span>
                <input type="number" name="out_amount" class="form-control" placeholder="Enter Amount" required>
                 </div>
                 <input type="hidden" name="comp_id" value="<?php echo $_SESSION['comp_id']; ?>">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="icon-pencil">Add</i></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>



<div class="modal fade" id="addcontact3" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Deposit</h6>
            </div>
            <?php echo form_open("admin/create_deposit_out"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <?php $date = date("Y-m-d"); ?>
                    <div class="col-md-6 col-6">
                    <span>Customer Name</span>
                    <input type="text" class="form-control" placeholder="Enter Customer Name" name="customer_name" required>    
                    </div>
                    <div class="col-md-6 col-6">
                    <span>Amount</span>
                    <input type="number" class="form-control" name="amount" placeholder="Enter Amount" required>           
                    </div>

                    <div class="col-md-6 col-6">
                    <span>Branch</span>
                    <select type="number" class="form-control" name="blanch_id" id="blanch" required>
                        <option value="">Select Branch</option>
                        <?php foreach ($blanch as $blanchs): ?>
                        <option value="<?php echo $blanchs->blanch_id; ?>"><?php echo $blanchs->blanch_name; ?></option>
                         <?php endforeach; ?>
                    </select>           
                    </div>

                    <div class="col-md-6 col-6">
                    <span>Account</span>
                    <select type="number" class="form-control" name="trans_id" id="account" required>
                        <option value="">Select Account</option>
                    </select>           
                    </div>
                   <?php $date=date("Y-m-d"); ?>
                   
                    <input type="hidden" name="comp_id" value="<?php echo $_SESSION['comp_id']; ?>">
                    <input type="hidden" name="date" value="<?php echo $date; ?>">
            </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Deposit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>




<script>
$(document).ready(function(){
$('#blanch').change(function(){
var blanch_id = $('#blanch').val();
//alert(blanch_id)
if(blanch_id != ''){

$.ajax({
url:"<?php echo base_url(); ?>admin/fetch_blanch_account",
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







