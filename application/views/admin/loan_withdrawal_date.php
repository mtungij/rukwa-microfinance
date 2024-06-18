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
                            <h2>Loan Withdrawal /<?php echo $blanch_data->blanch_name ?> / From:<?php echo $from; ?> - To:<?php echo $to; ?> </h2>
                            <div class="pull-right">
                                <a href="" data-toggle="modal" data-target="#addcontact2" class="btn btn-primary"><i class="icon-calendar">Filter</i></a>
                                <?php if (count($data) > 0) {
                                 ?>
                                 <a href="<?php echo base_url("admin/print_loan_withdrawalFilter/{$from}/{$to}/{$blanch_id}/{$loan_status}") ?>" class="btn btn-primary" target="_blank"><i class="icon-printer">Print</i></a>
                             <?php }else{ ?>
                                <?php } ?>
                            </div>    
                         </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                        
                                        <th>Branch Name</th>
                                        <th>Customer Name</th>
                                        <th>Loan Ac</th>
                                        <th>Loan Product</th>
                                        <th>Loan Interest</th>
                                        <th>Loan Withdrawal</th>
                                        <th>Principal + interest</th>
                                        <th>Method</th>
                                        <th>Duration Type</th>
                                        <th>Number of Repayment</th>
                                        <th>Restoration</th>
                                       <!--  <th>Restoration Instalment</th> -->
                                        <th>Withdrawal Date</th>
                                        <th>End Date</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                       <?php $no = 1 ?>        
                                <?php foreach($data as $loan_aproveds): ?>
                                        <tr>
                                    <td><?php echo $loan_aproveds->blanch_name; ?></td>
                                    <td><?php echo $loan_aproveds->f_name; ?> <?php echo $loan_aproveds->m_name; ?> <?php echo $loan_aproveds->l_name; ?></td>
                                    <td><?php echo $loan_aproveds->loan_code; ?></td>
                                    <td><?php echo $loan_aproveds->loan_name ?></td>
                                    <td><?php echo $loan_aproveds->interest_formular; ?>%</td>
                                    <td><?php echo number_format($loan_aproveds->loan_aprove); ?></td>
                                    <td><?php echo number_format($loan_aproveds->loan_int); ?></td>
                                    <td><?php echo $loan_aproveds->account_name; ?></td>
                                    <td>
                               <?php if ($loan_aproveds->day == 1) {
                                                 echo "Daily";
                                             ?>
                                            <?php }elseif($loan_aproveds->day == 7){
                                                  echo "Weekly";
                                             ?>
                                            
                                        <?php }elseif($loan_aproveds->day == 30 || $loan_aproveds->day == 31 || $loan_aproveds->day == 29 || $loan_aproveds->day == 28){
                                                echo "Monthly"; 
                                            ?>
                                            <?php } ?>
                                    </td>
                    
                                        
                                <td><?php echo $loan_aproveds->session; ?> </td> 
                                <td><?php echo number_format($loan_aproveds->restration); ?> </td>
                              <!--   <td><?php //echo $loan_aproveds->renew_loan; ?></td> --> 
                                <td><?php echo $loan_aproveds->loan_stat_date; ?> </td> 
                                <td><?php echo substr($loan_aproveds->loan_end_date, 0,10); ?> </td> 

                                <td>
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                      <?php if ($loan_aproveds->penat_status == 'NO') {
                                             ?>
                         <a class="dropdown-item" href="<?php echo base_url("admin/start_penart/$loan_aproveds->loan_id"); ?>" onclick="return confirm('Are You Sure?')"><i class="icon-pencil">Start Penart</i></a>
                    
                   <?php }elseif ($loan_aproveds->penat_status == 'YES') {
                                             ?>
                <a class="dropdown-item" href="<?php //echo base_url("admin/view_Dataloan/{$loan_aproveds->loan_id}/{$loan_pendings->comp_id}") ?>" data-toggle="modal" data-target="#addcontact1<?php echo $loan_aproveds->loan_id; ?>"><i class="icon-pencil">Stop Penart</i></a>
                  
                        <?php } ?>
                    
                  

                     <a class="dropdown-item" href="<?php echo base_url("admin/delete_loanwith/{$loan_aproveds->loan_id}"); ?>" onclick="return confirm('Are you sure?')"><i class="icon-trash">Delete</i></a>
                     <a class="dropdown-item" href="<?php echo base_url("admin/renew_loan/{$loan_aproveds->loan_id}"); ?>"><i class="icon-refresh">Renew Loan</i></a>
                    </div>
                </div>
                </div>
                                        
                                        </td>           
                                 </tr>
        <div class="modal fade" id="addcontact1<?php echo $loan_aproveds->loan_id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Leason To Stop Penart</h6>
            </div>
            <?php echo form_open("admin/stop_penart/{$loan_aproveds->loan_id}"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <span>Leason</span>
                       <textarea type="text" placeholder="Enter Leason" class="form-control" rows="3" name="description"></textarea>
                    </div>

                     <input type="hidden" value="<?php echo $_SESSION['comp_id']; ?>" name="comp_id">
                    <input type="hidden" value="<?php echo $loan_aproveds->blanch_id; ?>" name="blanch_id">
                    <input type="hidden" value="<?php echo $loan_aproveds->loan_id; ?>" name="loan_id">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>


                            <?php endforeach; ?>
                                <tr>
                                    <td><b>TOTAL:</b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b><?php echo number_format(@$sum_loan_withdrawal->total_loan_aprove); ?></b></td>
                                    <td><b><?php echo number_format(@$sum_loan_withdrawal->total_loan_int); ?></b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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


<div class="modal fade" id="addcontact2" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Filter Loan Withdrawal</h6>
            </div>
            <?php echo form_open("admin/filter_loan_withdrawal"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12 col-12">
                        <span>Select Branch</span>
                       <select type="number" class="form-control" name="blanch_id" required>
                           <option value="">Select Branch</option>
                           <?php foreach ($blanch as $blanchs): ?>
                           <option value="<?php echo $blanchs->blanch_id; ?>"><?php echo $blanchs->blanch_name; ?></option>
                           <?php endforeach; ?>
                       </select>
                    </div>
                    <div class="col-md-6 col-6">
                        <?php $date = date("Y-m-d"); ?>
                        <span>From:</span>
                       <input type="date" name="from" value="<?php echo $date; ?>" class="form-control" required>
                    </div>
                      <div class="col-md-6 col-6">
                        <span>To:</span>
                       <input type="date" name="to" value="<?php echo $date; ?>" class="form-control" required>
                    </div>
                    <input type="hidden" name="loan_status" value="withdrawal">
                   
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



