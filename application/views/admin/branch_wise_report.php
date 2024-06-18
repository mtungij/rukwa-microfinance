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
                            <li class="breadcrumb-item active">Branchwise Report</li>
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
                            <h2>Branchwise Report </h2> 
                            <div class="pull-right">
                               <a href="<?php echo base_url("admin/print_blanchWisereport"); ?>" class="btn btn-primary" target="_blank"><i class="icon-printer">print</i></a>  
                            </div>   
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <th>S/No.</th>
                                        <th>Branch Name</th>
                                        <th>Disbursed Loan</th>
                                        <th>Receivable</th>
                                        <th>Received</th>
                                        <th>Pending</th>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $no = 1; ?>
                                <?php foreach ($data_blanch as $data_blanchs): ?>
                                              <tr>
                                    <td><?php echo $no++; ?>.</td>
                                    
                                    <td><?php echo $data_blanchs->blanch_name; ?></td>
                                    <td><?php echo number_format($data_blanchs->total_loan_with); ?></td>
                                    <td><?php echo number_format($data_blanchs->total_loan_int); ?></td>
                                    <td><?php echo number_format($data_blanchs->total_depost + $data_blanchs->total_double); ?></td>
                                    <td><?php echo number_format($data_blanchs->total_loan_int - ($data_blanchs->total_depost + $data_blanchs->total_double )); ?></td>
                                    </tr>

                                    <?php endforeach; ?>
                                    <tr>
                                        <td><b>TOTAL:</b></td>
                                        <td></td>
                                        <td><b><?php echo number_format($total_allblanch->total_with_loan); ?></b></td>
                                        <td><b><?php echo number_format($total_allblanch->total_loan_int); ?></b></td>
                                        <td><b><?php echo number_format($total_depost_comp->total_depost + $total_depost_comp->total_double); ?></b></td>
                                        <td><b><?php echo number_format($total_allblanch->total_loan_int - ($total_depost_comp->total_depost + $total_depost_comp->total_double)); ?></b></td>
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


 <div class="modal fade" id="addcontact2<?php //echo $employees->empl_id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Filter Cash Transaction</h6>
            </div>
            <?php echo form_open("admin/cash_transaction_blanch"); ?>
            <div class="modal-body">
                <div class="row clearfix">

                                <div class="col-md-12 col-12">
                                    <span>*Select Branch:</span>
                                     <select type="number" class="form-control" name="blanch_id" required>
                                         <option value="">Select Branch</option>
                                         <?php foreach ($blanch as $blanchs): ?>
                                         <option value="<?php echo $blanchs->blanch_id; ?>"><?php echo $blanchs->blanch_name; ?></option>
                                         <?php endforeach; ?>
                                         <option value="all">All</option>
                                     </select>
                                </div>
                                <div class="col-md-6 col-6 ">
                                    <?php $date = date("Y-m-d"); ?>
                                    <span>*From:</span>
                                    <input type="date" name="from" autocomplete="off" value="<?php echo $date; ?>" class="form-control" required>
                                </div>
                                <div class="col-md-6 col-6 ">
                                    <span>*To:</span>
                                    <input type="date" name="to" autocomplete="off" value="<?php echo $date; ?>" class="form-control" required>
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


