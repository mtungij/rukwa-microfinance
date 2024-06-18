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
                            <li class="breadcrumb-item active">Today Pending</li>
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
                            <h2>Pending</h2>
                            <div class="pull-right">
                                <a href="" data-toggle="modal" data-target="#addcontact2" class="btn btn-primary"><i class="icon-calendar">Today Loan Pending</i></a>
                            </div>    
                         </div>
                          <div class="body">

                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                        <th>S/no.</th>
                                        <th>Customer Name</th>
                                        <th>Phone Number</th>
                                        <th>Loan Amount</th>
                                        <th>Duration Type</th>
                                        <th>Pending Amount</th>
                                        <th>Penart</th>
                                        <th>Date</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                       <?php $no = 1 ?>        
                                <?php foreach($loan_pending_new as $loan_pending_new): ?>
                                        <tr>
                                    <td><?php echo $no++; ?>.</td>
                                    <td><?php echo $loan_pending_new->f_name; ?> <?php echo substr($loan_pending_new->m_name, 0,1); ?> <?php echo $loan_pending_new->l_name; ?></td>
                                   <!--  <td><?php //echo $loan_aproveds->blanch_name; ?></td> -->
                                    <td><?php echo $loan_pending_new->phone_no; ?></td>
                                    <td><?php echo number_format($loan_pending_new->loan_int) ?></td>
                                    <td>
                                        <?php if ($loan_pending_new->day == 1) {
                                                 echo "Daily";
                                             ?>
                                            <?php }elseif($loan_pending_new->day == 7){
                                                  echo "Weekly";
                                             ?>
                                            
                                        <?php }elseif($loan_pending_new->day == 30 || $loan_pending_new->day == 31 || $loan_pending_new->day == 29 || $loan_pending_new->day == 28){
                                                echo "Monthly"; 
                                            ?>
                                            <?php } ?>
                                    </td>
                                    <td><?php echo number_format($loan_pending_new->total_pend); ?></td>
                                    <td>
                                        <?php if ($loan_pending_new->total_penart_amount < $loan_pending_new->total_paid_penart) {
                                        ?>
                                        0.00
                                    <?php  }else{ ?>
                                        <?php echo number_format($loan_pending_new->total_penart_amount - $loan_pending_new->total_paid_penart); ?>
                                        <?php } ?>
                                            
                                        </td>
                                  
                                    <td>
                                 <?php echo $loan_pending_new->date; ?>
                                    </td>
                    
                                 </tr>

                            <?php endforeach; ?>
                                <tr>
                                    <td><b>TOTAL:</b></td>
                                    <td></td>
                                   <!--  <td></td> -->
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b><?php echo number_format($new_total_pending->total_pending); ?></b></td>
                                    <td><b><?php //echo number_format($total_loanwith->total_loan_int); ?></b></td>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Today Loan Pending</h6>
            </div>
     
            <div class="modal-body">
              <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                        <th>S/no.</th>
                                        <th>Customer Name</th>
                                        <th>Phone Number</th>
                                        <th>Loan Amount</th>
                                        <th>Duration Type</th>
                                        <th>Pending Amount</th>
                                        <th>Date</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                       <?php $no = 1 ?>        
                                <?php foreach($loan_pend as $loan_pends): ?>
                                        <tr>
                                    <td><?php echo $no++; ?>.</td>
                                    <td><?php echo $loan_pends->f_name; ?> <?php echo substr($loan_pends->m_name, 0,1); ?> <?php echo $loan_pends->l_name; ?></td>
                                   <!--  <td><?php //echo $loan_aproveds->blanch_name; ?></td> -->
                                    <td><?php echo $loan_pends->phone_no; ?></td>
                                    <td><?php echo number_format($loan_pends->loan_int) ?></td>
                                    <td>
                                        <?php if ($loan_pends->day == 1) {
                                                 echo "Daily";
                                             ?>
                                            <?php }elseif($loan_pends->day == 7){
                                                  echo "Weekly";
                                             ?>
                                            
                                        <?php }elseif($loan_pends->day == 30 || $loan_pends->day == 31 || $loan_pends->day == 29 || $loan_pends->day == 28){
                                                echo "Monthly"; 
                                            ?>
                                            <?php } ?>
                                    </td>
                                    <td><?php echo number_format($loan_pends->return_total); ?></td>
                                   
                                  
                                    <td>
                                 <?php echo $loan_pends->pend_date; ?>
                                    </td>
                    
                                 </tr>

                            <?php endforeach; ?>
                                <tr>
                                    <td><b>TOTAL:</b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo number_format($pend->total_pending); ?></td>
                                    <td><b><?php //echo number_format($total_loanwith->total_loan_with); ?></b></td>
                                   
                                </tr>
                                    </tbody>
                                </table>
                            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
           
        </div>
    </div>
</div>



