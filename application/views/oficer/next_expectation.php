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
                            <li class="breadcrumb-item active">Report</li>
                            <li class="breadcrumb-item active">Expectation Receivable</li>
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
                            <h2>Expectation Receivable /FROM: <?php echo $from; ?> TO: <?php echo $to; ?></h2>
                            <div class="pull-right">
                                <a href="" data-toggle="modal" data-target="#addcontact2" class="btn btn-primary"><i class="icon-calendar">Filter</i></a>
                                <?php if (count($data_expected) > 0) {
                                 ?>
                                 <a href="<?php echo base_url("oficer/print_expected_receivable/{$from}/{$to}/{$blanch_id}"); ?>" class="btn btn-primary" target="_blank">
                                    <i class="icon-printer"></i>
                                    Print
                                </a>
                                <?php }else{ ?>
                                
                            <?php } ?>
                            </div>    
                         </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                        <th><b>Customer Name</b></th>
                                        <th><b>Phone Number</b></th>
                                        <th><b>Duration Type</b></th>
                                        <th><b>Loan Amount</b></th>
                                        <th><b>Receivable Amount</b></th>
                                        <th><b>Employee</b></th>
                                        <th><b>Date</b></th>    
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                       <?php $no = 1 ?>        
                                <?php foreach($data_expected as $today_recevables): ?>
                                              <tr>
                                    <td><?php echo $today_recevables->f_name; ?> <?php echo $today_recevables->m_name; ?> <?php echo $today_recevables->l_name; ?></td>
                                    <!-- <td><?php //echo $today_recevables->blanch_name; ?></td> -->
                                    <td><?php echo $today_recevables->phone_no; ?></td>
                                    
                                    <td><?php if ($today_recevables->day == 1) {
                                                 echo "Daily";
                                             ?>
                                            <?php }elseif($today_recevables->day == 7){
                                                  echo "Weekly";
                                             ?>
                                            
                                        <?php }elseif($today_recevables->day == 30 || $today_recevables->day == 31 || $today_recevables->day == 28 || $today_recevables->day == 29){
                                                echo "Monthly"; 
                                            ?>
                                            <?php } ?></td>
                                    <td><?php echo number_format($today_recevables->loan_int); ?></td>
                                    <td><?php echo number_format($today_recevables->restration); ?></td>
                                    <td><?php echo $today_recevables->empl_name; ?></td>
                                    <td>
                                     <?php echo $today_recevables->date_show; ?>            
                                    </td>
                                                                                        
                                   </tr>

                       <?php endforeach; ?>
                                <tr>
                                    <td><b>TOTAL</b></td>
                                    <td></td>
                                   <!--  <td></td> -->
                                    <td></td>
                                    <td></td>
                                    <td><b><?php echo number_format($sum_expectation->total_expectation); ?></td>
                                    <td><b><?php //echo number_format($total_loanwith->total_loan_with); ?></b></td>
                                    <td><b><?php //echo number_format($total_loanwith->total_loan_int); ?></b></td>
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
                <h6 class="title" id="defaultModalLabel">Filter Next Expectation Receivable</h6>
            </div>
            <?php echo form_open("oficer/next_expectation_report"); ?>
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



