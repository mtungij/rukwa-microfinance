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
                            <li class="breadcrumb-item active">Branchwise loan Report</li>
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
                            <h2>Branchwise Loan Summary </h2> 
                            <!-- <div class="pull-right">
                               <a href="" data-toggle="modal" data-target="#addcontact2" class="btn btn-primary"><i class="icon-calendar">Filter</i></a>  
                            </div> -->   
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <th>Disbursed Loan</th>
                                        <th>Receivable</th>
                                        <th>Received</th>
                                        <th>Pending</th>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $no = 1; ?>
                                <?php foreach ($blanch_wise as $blanch_wises): ?>
                                              <tr>
                                    <td><?php echo number_format($blanch_wises->total_loan_with); ?></td>
                                    <td><?php echo number_format($blanch_wises->total_loan_int); ?></td>
                                    <td><?php echo number_format($blanch_wises->total_depost + $blanch_wises->total_double); ?></td>
                                    <td>
                                        <?php if ($blanch_wises->total_loan_int < ($blanch_wises->total_depost + $blanch_wises->total_double)) {
                                         ?>
                                         0 <span style="color:red">(<?php  echo number_format(($blanch_wises->total_depost + $blanch_wises->total_double) - $blanch_wises->total_loan_int); ?>)</span>
                                     <?php }else{ ?>
                                        <?php echo number_format($blanch_wises->total_loan_int - ($blanch_wises->total_depost + $blanch_wises->total_double)); ?>
                                        <?php } ?>
                                            
                                        </td>
                                    </tr>

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


 <div class="modal fade" id="addcontact2<?php //echo $employees->empl_id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Filter Cash Transaction</h6>
            </div>
            <?php echo form_open("oficer/filter_cashTransaction"); ?>
            <div class="modal-body">
                <div class="row clearfix">

                                <div class="col-md-6 col-6 ">
                                    <?php $date = date("Y-m-d"); ?>
                                    <span>*From:</span>
                                    <input type="date" name="from" autocomplete="off" value="<?php echo $date; ?>" class="form-control" required>
                                </div>
                                <div class="col-md-6 col-6 ">
                                    <span>*To:</span>
                                    <input type="date" name="to" autocomplete="off" value="<?php echo $date; ?>" class="form-control" required>
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


