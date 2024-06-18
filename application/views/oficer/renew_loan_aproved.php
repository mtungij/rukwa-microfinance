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
                            <li class="breadcrumb-item active">Loan</li>
                            <li class="breadcrumb-item active">Renew Loan List Aproved</li>
                            
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
                <div class="col-lg-12">
                    <div class="card">
                         <div class="header">
                            <h2>Renew Loan List</h2>
                            <div class="pull-right">
                                <a href="" data-toggle="modal" data-target="#addcontact2" class="btn btn-primary"><i class="icon-calendar">Filter</i></a>
                                

                               
                            </div>    
                         </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                        <th>Branch Name</th>
                                        <th>Customer Name</th>
                                        <th>New Loan Amount</th>
                                        <th>Paid Amount</th>
                                        <th>Remain</th>
                                        <th>Renew Amount</th>
                                        <th>Loan Interest</th>
                                        <th>Principal + interest</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                       <?php $no = 1 ?>        
                                <?php foreach($aproved_renew as $renew_lists): ?>
                                        <tr>
                                    <td><?php echo $renew_lists->blanch_name; ?> </td>
                                    <td><?php echo $renew_lists->f_name; ?> <?php echo $renew_lists->m_name; ?> <?php echo $renew_lists->l_name; ?> </td>
                                    <td><?php echo number_format($renew_lists->loan_int); ?></td>
                                    <td><?php echo number_format($renew_lists->total_deposit) ; ?></td>
                                    <td><?php echo number_format($renew_lists->loan_int - $renew_lists->total_deposit); ?></td>
                                    <td><b><?php echo number_format($renew_lists->renew_amount); ?></b></td>
                                     <td><b><?php echo number_format($renew_lists->interest_formular); ?>%</b></td>
                                     <td><b><?php echo number_format($renew_lists->interest_formular /100 * $renew_lists->renew_amount + ($renew_lists->renew_amount)); ?></b></td>
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
                                 <!-- <td> -->

                                  
                                  <!-- <a href="" data-toggle="modal" data-target="#addcontact1<?php echo $renew_lists->renew_id; ?>" class="btn btn-sm btn-success" title="Edit"><i class="icon-pencil"></i>Aprove</a> -->                      
                                <!--   <a href="<?php //echo base_url("admin/delete_renew_loan_data/{$renew_lists->renew_id}"); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure?')" title="Remove"><i class="icon-trash"></i></a> -->
                                <!-- </td>   -->         
                                 </tr>
    <div class="modal fade" id="addcontact1<?php echo $renew_lists->renew_id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel"><?php echo $renew_lists->f_name; ?> <?php echo $renew_lists->m_name; ?> <?php echo $renew_lists->l_name; ?></h6>
            </div>
            <?php echo form_open("admin/aprove_loan_renew/{$renew_lists->renew_id}"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                  <?php $acount = $this->queries->get_customer_account_verfied($renew_lists->blanch_id); ?>  
                    <div class="col-md-12 col-12">
                        <span>Renew Amount</span>
                       <input type="number" name="renew_amount" readonly value="<?php echo $renew_lists->renew_amount; ?>"  class="form-control" required>
                    </div>
                     <div class="col-md-12 col-12">
                        <span>Select Account</span>
                       <select style="number" class="form-control" name="method_renew" required>
                           <option value="">Select Account</option>
                           <?php foreach ($acount as $acounts): ?>
                           <option value="<?php echo $acounts->trans_id; ?>"><?php echo $acounts->account_name; ?> - <?php echo number_format($acounts->blanch_capital); ?></option>
                           <?php endforeach; ?>
                       </select>
                    </div>

                    <input type="hidden" name="blanch_id" value="<?php echo $renew_lists->blanch_id; ?>">
                    
                 
                   
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Aprove</button>
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
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b><?php echo number_format($renew_total->total_renew); ?></b></td>
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


<div class="modal fade" id="addcontact2" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Filter By</h6>
            </div>
            <?php echo form_open("oficer/filter_renew_loan"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                
                    <?php $date = date("Y-m-d"); ?>
                      <div class="col-md-6 col-6">
                        <span>From:</span>
                       <input type="date" name="from"  value="<?php echo $date; ?>" class="form-control">
                    </div>
                    <div class="col-md-6 col-6">
                        <span>To:</span>
                       <input type="date" name="to"  value="<?php echo $date; ?>" class="form-control">
                    </div>
                    <input type="hidden" name="blanch_id" value="<?php echo $empl_data->blanch_id; ?>">
                   
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



