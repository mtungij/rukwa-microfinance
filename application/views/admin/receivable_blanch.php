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
                            <li class="breadcrumb-item active">Today Receivable</li>
                            <li class="breadcrumb-item active"><?php echo $blanch_data->blanch_name; ?></li>
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
                            <h2>Today Receivable & Not Receivable</h2>
                            <div class="pull-right">
                              <!-- <a href="" data-toggle="modal" data-target="#addcontact2" class="btn btn-primary"><i class="icon-calendar">Filter</i></a> -->
                              <a href="<?php echo base_url("admin/view_blanchPanel/{$blanch_id}"); ?>" class="btn btn-primary">Back</a>
                            </div>    
                         </div>
                          <div class="body">

                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                        <th>S/no.</th>
                                        <!-- <th>Branch</th> -->
                                        <th>Customer Name</th>
                                        <th>Phone Number</th>
                                        <th>Loan Amount</th>
                                        <th>Duration Type</th>
                                        <th>Receivable Amount</th>
                                        <th>Employee</th>
                                        <th>Date</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                       <?php $no = 1 ?>        
                                <?php foreach($today_recevable as $loan_pending_new): ?>
                                        <tr>
                                    <td><?php echo $no++; ?>.</td>
                                    <!-- <td class="c"><?php echo $loan_pending_new->blanch_name; ?></td> -->
                                    <td><?php echo $loan_pending_new->f_name; ?> <?php echo $loan_pending_new->m_name; ?> <?php echo $loan_pending_new->l_name; ?></td>
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
                                    <td><?php echo number_format($loan_pending_new->restration); ?></td>
                                   
                                  
                                    <td>
                                 <?php echo $loan_pending_new->empl_name; ?>
                                    </td>
                                       <td>
                                 <?php echo $loan_pending_new->date_show; ?>
                                    </td>
                    
                                 </tr>

                            <?php endforeach; ?>
                                    </tbody>
                                     <tr>
                                    <td><b>TOTAL:</b></td>
                                    <!-- <td></td> -->
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b><?php echo number_format($rejesho->total_rejesho); ?></b></td>
                                    <td><b><?php //echo number_format($total_loanwith->total_loan_int); ?></b></td>
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
                <h6 class="title" id="defaultModalLabel">Filter by Branch</h6>
            </div>
            <?php echo form_open("admin/filter_loan_receivable"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12 col-12">
                    <span>Select Branch</span>
                    <select type="number" class="form-control" name="blanch_id" required>
                        <option value="">--select Branch--</option>
                        <?php foreach($blanch as $blanchs): ?>
                        <option value="<?php echo $blanchs->blanch_id; ?>" class="c"><?php echo $blanchs->blanch_name; ?></option>
                        <?php endforeach; ?>
                    </select>           
                    </div>
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





