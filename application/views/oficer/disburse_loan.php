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
                            <li class="breadcrumb-item active">Loan Disbursed</li>
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
                            <h2>Loan Disbursed List</h2>    
                         </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                       <th>S/no.</th>
                                       <th>Customer Name</th>
                                       <!--  <th>Branch Name</th> -->
                                        <th>Loan Ac</th>
                                        <th>Loan Disbursed</th>
                                        <th>Loan Interest</th>
                                        <th>Principle + Interest</th>
                                        <th>Restoration Type</th>
                                        <th>Number of Repayment</th>
                                       <!--  <th>Restoration Instalment</th> -->
                                        <th>Restoration</th>
                                        <th>Date</th>
                                        <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $no = 1; ?>
                                               
                                   <?php foreach($disburse as $loan_aproveds): ?>
                                        <tr>
                                    <td><?php echo $no++; ?>.</td>
                                    <td><?php echo $loan_aproveds->f_name; ?> <?php echo substr($loan_aproveds->m_name, 0,1); ?> <?php echo $loan_aproveds->l_name; ?></td>
                                   <!--  <td><?php //echo $loan_aproveds->blanch_name; ?></td> -->
                                    <td><?php echo $loan_aproveds->loan_code; ?></td>
                                    <td><?php echo number_format($loan_aproveds->loan_aprove); ?></td>
                                    <td><?php echo $loan_aproveds->interest_formular; ?>%</td>
                                    <td><?php echo number_format($loan_aproveds->loan_int); ?></td>
                                    <td><?php if ($loan_aproveds->day == 1) {
                                                 echo "Daily";
                                             ?>
                                            <?php }elseif($loan_aproveds->day == 7){
                                                  echo "Weekly";
                                             ?>
                                            
                                        <?php }elseif($loan_aproveds->day == 30 || $loan_aproveds->day == 31 || $loan_aproveds->day == 29 || $loan_aproveds->day == 28){
                                                echo "Monthly"; 
                                            ?>
                                            <?php } ?></td>
                                    <td><?php echo $loan_aproveds->session ?></td>
                                   <!--  <td><?php //echo $loan_aproveds->renew_loan ?></td> -->
                                    <td>
                               <?php echo number_format($loan_aproveds->restration); ?>
                                    </td>
                    
                                        <td>
                                <?php echo substr($loan_aproveds->loan_day, 0,10); ?> 
                                </td> 

                                <!-- <td><a href="<?php //echo base_url("admin/delete_loanDisbursed/{$loan_aproveds->loan_id}") ?>" class="btn btn-sm btn-icon btn-pure btn-danger on-default button-remove"
                                            data-toggle="tooltip" data-original-title="Remove" onclick="return confirm('Are You Sure?')"><i class="icon-trash" aria-hidden="true"></i></a></td>  -->          
                                 </tr>
                            <?php endforeach; ?>
                                <tr>
                                    <td><b>TOTAL:</b></td>
                                    <td></td>
                                   <!--  <td></td> -->
                                    <td></td>
                                    <td><b><?php echo number_format($total_loanDis->total_loan); ?></b></td>
                                    <td></td>
                                    <td><b><?php echo number_format($total_interest_loan->total_loan_int); ?></b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <!-- <td></td> -->
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


