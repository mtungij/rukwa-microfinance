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
                            <li class="breadcrumb-item active">Loan</li>
                            <li class="breadcrumb-item active">Default loan </li>
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
                            <h2>Default Amount Out Of System</h2>
                        </div>
                        <div class="body">
                <?php 
                $blanch_id = $this->session->userdata('blanch_id');
                @$out_data = $this->queries->get_default_loan_out($blanch_id);
                 ?>
                <?php //print_r($out_data); ?>
                <?php if (@$out_data == TRUE) {
                ?> 
                <?php echo form_open("oficer/modify_out_loan/{$out_data->id}"); ?>
                <div class="row">
                <div class="col-lg-12 col-12">
                <span>*Amount</span>
               <input type="number" name="out_amount" readonly value="<?php echo @$out_data->out_amount - @$sum_out->total_out; ?>" autocomplete="off" class="form-control" placeholder="Enter Amount" required>
                </div>
            </div>
             <br>
           <!--  <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="icon-drawer">Update</i></button>
            </div> -->
                            
            <?php echo form_close();  ?>
            <?php  }else{ ?>
                <?php echo form_open("oficer/create_default_loan_out"); ?>
                <div class="row">
                <div class="col-lg-12 col-12">
                <span>*Amount</span>
               <input type="number" name="out_amount" readonly autocomplete="off" class="form-control" placeholder="Enter Amount" required>
                </div>
              <input type="hidden" name="comp_id" value="<?php echo $empl_data->comp_id; ?>">
              <input type="hidden" name="blanch_id" value="<?php echo $empl_data->blanch_id; ?>">
    
            </div>
             <br>
           <!--  <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="icon-drawer">Save</i></button>
            </div> -->
                            
            <?php echo form_close();  ?>
                <?php } ?>
            
                        </div>
                    </div>
                </div>
            <div class="col-lg-12">
                    <div class="card">
                         <div class="header">
                            <h2>Today Depost List </h2> 
                            <div class="pull-right">
                              <a href="" class="btn btn-sm btn-icon btn-pure btn-primary on-default m-r-5 button-edit"
                                            data-toggle="modal" data-target="#addcontact1" data-original-title="Edit"><i class="icon-pencil"></i>Deposit</a> 
                           <a href="" data-toggle="modal" data-target="#addcontact2" class="btn btn-primary"><i class="icon-calendar">Filter </i></a>
                            </div>   
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                                <th>S/no.</th>
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
                                        <?php foreach ($out_system as $transactions): ?>
                                        <tr>
                                            <td><?php echo $no++; ?>.</td>
                                            <td><?php echo $transactions->customer_name; ?></td>
                                            <td><?php echo $transactions->account_name; ?></td>
                                            <td><?php echo number_format($transactions->amount); ?></td>
                                            <td><?php echo $transactions->empl_name; ?></td>
                                            <td><?php echo $transactions->date; ?></td>
                                            <td><a href="<?php echo base_url("oficer/delete_outstand_system/{$transactions->id}"); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure?')"><i class="icon-trash"></i></a></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td><b>TOTAL:</b></td>
                                            <td></td>
                                            <td></td>
                                            <td><b><?php echo number_format($today_deposit->total_out_today); ?></b></td>
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



 <div class="modal fade" id="addcontact1" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Deposit</h6>
            </div>
            <?php echo form_open("oficer/create_deposit_out"); ?>
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

                    <div class="col-md-12 col-12">
                    <span>Amount</span>
                    <select type="number" class="form-control" name="trans_id" required>
                        <option value="">Select Account</option>
                        <?php foreach ($acount as $acounts): ?>
                        <option value="<?php echo $acounts->receive_trans_id; ?>"><?php echo $acounts->account_name; ?></option>
                         <?php endforeach; ?>
                    </select>           
                    </div>
                   <?php $date=date("Y-m-d"); ?>
                    <input type="hidden" name="blanch_id" value="<?php echo $_SESSION['blanch_id']; ?>">
                    <input type="hidden" name="comp_id" value="<?php echo $empl_data->comp_id; ?>">
                    <input type="hidden" name="empl_id" value="<?php echo $empl_data->empl_id; ?>">
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


<div class="modal fade" id="addcontact2" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Filter Deposit Default Out of System</h6>
            </div>
            <?php echo form_open(""); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <?php $date = date("Y-m-d"); ?>
                    <div class="col-md-6 col-6">
                    <span>From:</span>
                    <input type="date" class="form-control" name="from" value="<?php echo $date; ?>" required>    
                    </div>
                    <div class="col-md-6 col-6">
                    <span>To:</span>
                    <input type="date" class="form-control" name="to" value="<?php echo $date; ?>" required>           
                    </div>

                    
                   <?php $date=date("Y-m-d"); ?>
                    <input type="hidden" name="blanch_id" value="<?php echo $_SESSION['blanch_id']; ?>">
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



