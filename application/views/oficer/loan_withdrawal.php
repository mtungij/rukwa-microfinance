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
                            <h2>Today Loan Withdrawal</h2>
                            <div class="pull-right">
                                <a href="" data-toggle="modal" data-target="#addcontact2" class="btn btn-primary"><i class="icon-calendar">Filter</i></a>

                                <a href="" data-toggle="modal" data-target="#addcontact3" class="btn btn-primary btn-sm"><i class="icon-calendar">Filter by Category</i></a>
                            </div>    
                         </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                        <th>S/no.</th>
                                        <th>Customer Name</th>
                                      <!--   <th>Branch Name</th> -->
                                        <th>Loan Ac</th>
                                        <th>Loan Product</th>
                                        <th>Loan Interest</th>
                                        <th>Loan Withdrawal</th>
                                        <th>Principal + interest</th>
                                        <th>Method</th>
                                        <th>Duration Type</th>
                                        <th>Number of Repayment</th>
                                        <th>Restoration</th>
                                        <!-- <th>Restoration Instalment</th> -->
                                        <th>Withdrawal Date</th>
                                        <th>End Date</th>
                                       <!--  <th>Action</th> -->
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                       <?php $no = 1 ?>        
                                <?php foreach($loan_with as $loan_aproveds): ?>
                                        <tr>
                                    <td><?php echo $no++; ?>.</td>
                                    <td><?php echo $loan_aproveds->f_name; ?> <?php echo substr($loan_aproveds->m_name, 0,1); ?> <?php echo $loan_aproveds->l_name; ?></td>
                                   <!--  <td><?php //echo $loan_aproveds->blanch_name; ?></td> -->
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
                              <!--   <td><?php //echo $loan_aproveds->renew_loan; ?> </td> --> 
                                <td><?php echo $loan_aproveds->loan_stat_date; ?> </td> 
                                <td><?php echo substr($loan_aproveds->loan_end_date, 0,10); ?> </td> 

                           
                                 </tr>

                            <?php endforeach; ?>
                                <tr>
                                    <td><b>TOTAL:</b></td>
                                    <td></td>
                                   <!--  <td></td> -->
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b><?php echo number_format($total_loanwith->total_loan_with); ?></b></td>
                                    <td><b><?php echo number_format($total_loanwith->total_loan_int); ?></b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                 <!--    <td></td> -->
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
            <?php echo form_open("oficer/filter_loan_with"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-6 col-6">
                        <?php $date = date("Y-m-d"); ?>
                        <span>From:</span>
                       <input type="date" name="from" value="<?php echo $date; ?>" class="form-control">
                    </div>
                      <div class="col-md-6 col-6">
                        <span>To:</span>
                       <input type="date" name="to" value="<?php echo $date; ?>" class="form-control">
                    </div>

                    <input type="hidden" name="loan_status" value="withdrawal">
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


<div class="modal fade" id="addcontact3" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Filter Loan Withdrawal By Category</h6>
            </div>
            <?php echo form_open("oficer/filter_loan_with_category"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                   
                     <div class="col-md-6 col-6">
                        <span>Select Category</span>
                       <select type="number" class="form-control" name="category_id" required>
                           <option value="">Select Category</option>
                           <?php foreach ($category as $categorys): ?>
                           <option value="<?php echo $categorys->category_id; ?>"><?php echo $categorys->loan_name; ?></option>
                           <?php endforeach; ?>
                           <option value="all">All</option>
                       </select>
                    </div>
                    <div class="col-md-6 col-6">
                        <span>Select Status</span>
                       <select type="number" class="form-control" name="loan_status" required>
                           <option value="">Select Status</option>
                                <option value="withdrawal">ACTIVE</option>
                                <option value="open">PENDING</option>
                                <option value="aproved">APROVED</option>
                                <option value="disbarsed">DISBURSED</option>
                                <option value="done">DONE</option>
                                <option value="out">DEFALT</option>
                       </select>
                    </div>

                       <input type="hidden" name="comp_id" value="<?php echo $empl_data->comp_id; ?>">
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



