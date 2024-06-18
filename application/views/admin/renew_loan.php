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
                            <li class="breadcrumb-item active">Loan Withdrawal</li>
                            <li class="breadcrumb-item active">Renew Loan</li>
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
                            <h2>Renew loan List</h2>
                            <div class="pull-right">
                                <a href="" data-toggle="modal" data-target="#addcontact2" class="btn btn-primary"><i class="icon-refresh">Renew</i></a>
                                <a href="<?php echo base_url("admin/loan_withdrawal"); ?>" class="btn btn-primary"><i class="icon-arrow-left">Back</i></a>

                               
                            </div>    
                         </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                        
                                       
                                        <th>Customer Name</th>
                                        <th>Renew Amount</th>
                                        <th>Loan Interest</th>
                                        <th>Principal + interest</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                       <?php $no = 1 ?>        
                                <?php foreach($renew_list as $renew_lists): ?>
                                        <tr>
                                    <td><?php echo $renew_lists->f_name; ?> <?php echo $renew_lists->m_name; ?> <?php echo $renew_lists->l_name; ?></td>
                                    <td><?php echo number_format($renew_lists->renew_amount); ?> </td>
                                    <td><?php echo $renew_lists->interest_formular; ?>%</td>
                                    <td><?php echo number_format(($renew_lists->interest_formular /100 * $renew_lists->renew_amount) + ($renew_lists->renew_amount) ); ?></td>
                                    <td>
                                        <?php if ($renew_lists->status_renew == 'open') {
                                         ?>
                                         <span class="badge badge-warning">Pending</span>
                                     <?php }elseif ($renew_lists->status_renew == 'close') {
                                      ?>
                                      <span class="badge badge-success">Aproved</span>
                                      <?php } ?>
                                        
                                            
                                    </td>
                                    <td><?php echo $renew_lists->date_renew; ?></td>
                                 <td>

                                  
                                  <a href="" data-toggle="modal" data-target="#addcontact1<?php echo $renew_lists->renew_id; ?>" class="btn btn-sm btn-primary" title="Edit"><i class="icon-pencil"></i></a>                      
                                  <a href="<?php echo base_url("admin/delete_renew_loan/{$renew_lists->renew_id}"); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure?')" title="Remove"><i class="icon-trash"></i></a>
                                </td>           
                                 </tr>
    <div class="modal fade" id="addcontact1<?php echo $renew_lists->renew_id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel"><?php echo $loan_data->f_name; ?> <?php echo $loan_data->m_name; ?> <?php echo $loan_data->l_name; ?></h6>
            </div>
            <?php echo form_open("admin/update_renew_loan/{$renew_lists->renew_id}"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    
                    <div class="col-md-4 col-4">
                        <span>Total Amount:</span>
                       <input type="text" name="" readonly value="<?php echo number_format($loan_data->loan_int); ?>" class="form-control">
                    </div>
                      <div class="col-md-4 col-4">
                        <span>Paid Amount</span>
                       <input type="text" name="" readonly value="<?php echo number_format($deposit->total_deposit); ?>" class="form-control">
                    </div>
                    <div class="col-md-4 col-4">
                        <span>Remain Amount</span>
                       <input type="text" name="" readonly value="<?php echo number_format($loan_data->loan_int - $deposit->total_deposit); ?>" class="form-control">
                    </div>
                    <div class="col-md-12 col-12">
                        <span>Renew Amount</span>
                       <input type="number" name="renew_amount" value="<?php echo $renew_lists->renew_amount; ?>"  class="form-control" required>
                    </div>
                    <input type="hidden" name="" value="<?php echo $_SESSION['comp_id']; ?>">
                    <input type="hidden" name="" value="<?php echo $loan_data->blanch_id; ?>">
                    <input type="hidden" name="" value="<?php echo $loan_data->empl_id; ?>">
                    <input type="hidden" name="" value="<?php echo $loan_data->loan_id; ?>">
                 
                   
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>


                            <?php endforeach; ?>
                              
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


<div class="modal fade" id="addcontact2" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel"><?php echo $loan_data->f_name; ?> <?php echo $loan_data->m_name; ?> <?php echo $loan_data->l_name; ?></h6>
            </div>
            <?php echo form_open("admin/create_renew_loan/{$loan_data->loan_id}"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    
                    <div class="col-md-4 col-4">
                        <span>Total Amount:</span>
                       <input type="text" name="" readonly value="<?php echo number_format($loan_data->loan_int); ?>" class="form-control">
                    </div>
                      <div class="col-md-4 col-4">
                        <span>Paid Amount</span>
                       <input type="text" name="" readonly value="<?php echo number_format($deposit->total_deposit); ?>" class="form-control">
                    </div>
                    <div class="col-md-4 col-4">
                        <span>Remain Amount</span>
                       <input type="text" name="" readonly value="<?php echo number_format($loan_data->loan_int - $deposit->total_deposit); ?>" class="form-control">
                    </div>
                    <div class="col-md-12 col-12">
                        <span>Renew Amount</span>
                       <input type="number" name="renew_amount"   class="form-control" required>
                    </div>
                    <input type="hidden" name="comp_id" value="<?php echo $_SESSION['comp_id']; ?>">
                    <input type="hidden" name="blanch_id" value="<?php echo $loan_data->blanch_id; ?>">
                    <input type="hidden" name="empl_id" value="<?php echo $loan_data->empl_id; ?>">
                    <input type="hidden" name="loan_id" value="<?php echo $loan_data->loan_id; ?>">
                    <?php $date  = date("Y-m-d"); ?>
                    <input type="hidden" name="date_renew" value="<?php echo $date; ?>">
                   
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Renew</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>



