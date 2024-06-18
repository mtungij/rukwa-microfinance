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
                            <h2>Expectation Receivable</h2>
                            <div class="pull-right">
                                <a href="" data-toggle="modal" data-target="#addcontact2" class="btn btn-primary"><i class="icon-calendar">Filter</i></a>
                            </div>    
                         </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                        <th><b>Customer Name</b></th>
                                        <th><b>Branch Name</b></th>
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
                                <?php //foreach($loan_with as $loan_aproveds): ?>
                                        <tr>
                                    <td><?php //echo $no++; ?></td>
                                    <td><?php //echo $loan_aproveds->f_name; ?> <?php //echo substr($loan_aproveds->m_name, 0,1); ?> <?php //echo $loan_aproveds->l_name; ?></td>
                                   <!--  <td><?php //echo $loan_aproveds->blanch_name; ?></td> -->
                                    <td><?php //echo $loan_aproveds->loan_code; ?></td>
                                    <td><?php //echo $loan_aproveds->loan_name ?></td>
                                    <td><?php //echo $loan_aproveds->interest_formular; ?></td>
                                    <td><?php //echo number_format($loan_aproveds->loan_aprove); ?></td>
                                    <td><?php //echo number_format($loan_aproveds->loan_aprove); ?></td>
                                    <td><?php //echo number_format($loan_aproveds->loan_aprove); ?></td>
                                    

                           
                                 </tr>

                            <?php //endforeach; ?>
                                <tr>
                                    <td><b>TOTAL</b></td>
                                    <td></td>
                                   <!--  <td></td> -->
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b><?php //echo number_format($total_loanwith->total_loan_with); ?></b></td>
                                    <td><b><?php //echo number_format($total_loanwith->total_loan_int); ?></b></td>
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
            <?php echo form_open("admin/next_expectation_report"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12 col-12">
                        
                        <span>Select Branch</span>
                       <select type="number" class="form-control" name="blanch_id" required>
                           <option value="">--select Branch--</option>
                           <?php foreach ($blanch as $blanchs): ?>
                           <option value="<?php echo $blanchs->blanch_id; ?>"><?php echo $blanchs->blanch_name; ?></option>
                           <?php endforeach; ?>
                           <option value="all">ALL</option>
                       </select>
                    </div>
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
                    <input type="hidden" name="comp_id" value="<?php echo $_SESSION['comp_id']; ?>">
                   
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



