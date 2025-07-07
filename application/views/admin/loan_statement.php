<?php include('incs/header.php'); ?>
<?php include('incs/nav.php'); ?>
<?php include('incs/side.php'); ?>

<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url("ad/index"); ?>"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Report</li>
                        <li class="breadcrumb-item active">Loan Collection</li>
                    </ul>
                </div>
            </div>
        </div>

        <?php if ($this->session->flashdata('message')): ?>
        <div class="row"> 
            <div class="col-md-12"> 
                <div class="alert alert-dismissible alert-success"> <a href="" class="close">&times;</a> 
                    <?php echo $this->session->flashdata('message'); ?> 
                </div> 
            </div> 
        </div> 
        <?php endif; ?>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Loan Collection</h2>
                        <div class="pull-right">
                            <a href="" data-toggle="modal" data-target="#addcontact2" class="btn btn-primary"><i class="icon-calendar">Filter</i></a>
                             <a href="<?php echo base_url("admin/loan_collection_pdf"); ?>"  class="btn btn-danger"><i class="icon-printer"> Print PDF</i></a>
                            <a  href="<?php echo base_url("admin/loan_collection_excel") ?>" class="btn btn-success"><i class="icon-file"> Export to Excel</i></a>
                        </div>    
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example dataTable table-custom">
                                <thead class="thead-primary">
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Employee</th>
                                        <th>Principal</th>
                                        <th>Interest</th>
                                        <th>Loan Amount</th>
                                        <th>Duration Type</th>
                                        <th>Collection</th>
                                        <th>Paid Amount</th>
                                        <th>Remain Amount</th>
                                        <th>Penart Amount</th>
                                        <th>Loan Status</th>
                                        <th>Withdrawal Date</th>
                                        <th>End Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($loan_collection as $loan): ?>
                                    <tr>
                                        <td><?php echo $loan->f_name . ' ' . $loan->m_name . ' ' . $loan->l_name; ?></td>
                                        <td><?php echo $loan->empl_name ? $loan->empl_name : 'Admin'; ?></td>
                                        <td><?php echo number_format($loan->loan_aprove); ?></td>
                                        <td><?php echo number_format($loan->loan_int - $loan->loan_aprove); ?></td>
                                        <td><?php echo number_format($loan->loan_int); ?></td>
                                        <td>
                                            <?php
                                            if ($loan->day == 1) {
                                                echo "Daily";
                                            } elseif ($loan->day == 7) {
                                                echo "Weekly";
                                            } elseif (in_array($loan->day, [28, 29, 30, 31])) {
                                                echo "Monthly";
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo number_format($loan->restration); ?></td>
                                        <td><?php echo number_format($loan->total_depost + $loan->total_double); ?></td>
                                        <td><?php echo number_format($loan->loan_int - ($loan->total_depost + $loan->total_double)); ?></td>
                                        <td><?php echo number_format($loan->total_penart_amount - $loan->penart_paid); ?></td>
                                        <td>
                                            <?php if ($loan->loan_status == 'open'): ?>
                                                <a href="javascript:;" class="badge badge-warning">Pending</a>
                                            <?php elseif ($loan->loan_status == 'aproved'): ?>
                                                <a href="javascript:;" class="badge badge-info">Approved</a>
                                            <?php elseif ($loan->loan_status == 'withdrawal'): ?>
                                                <a href="javascript:;" class="badge badge-primary">Active</a>
                                            <?php elseif ($loan->loan_status == 'done'): ?>
                                                <a href="javascript:;" class="badge badge-success">Done</a>
                                            <?php elseif ($loan->loan_status == 'out'): ?>
                                                <a href="javascript:;" class="badge badge-danger">Default</a>
                                            <?php elseif ($loan->loan_status == 'disbarsed'): ?>
                                                <a href="javascript:;" class="badge badge-secondary">Disbursed</a>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $loan->loan_stat_date; ?></td>
                                        <td><?php echo substr($loan->loan_end_date, 0, 10); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tr>
                                    <td><b>TOTAL:</b></td>
                                    <td colspan="11"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('incs/footer.php'); ?>

<!-- Filter Modal -->
<div class="modal fade" id="addcontact2" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Filter Loan Collection</h6>
            </div>
            <?php echo form_open("admin/search_loanSatatus"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-6 col-6">
                        <span>Select Branch</span>
                        <select class="form-control" name="blanch_id" required>
                            <option value="">--select Branch--</option>
                            <?php foreach ($blanch as $blanchs): ?>
                            <option value="<?php echo $blanchs->blanch_id; ?>"><?php echo $blanchs->blanch_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 col-6">
                        <span>Select Loan Status</span>
                        <select name="loan_status" class="form-control" required>
                            <option value="">Select Loan Status</option>
                            <option value="open">Pending</option>
                            <option value="aproved">Approved</option>
                            <option value="disbarsed">Disbursed</option>
                            <option value="withdrawal">Active</option>
                            <option value="done">Done</option>
                            <option value="out">Default</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-6">
                        <span>Start Date</span>
                        <input type="date" class="form-control" name="start_date" />
                    </div>
                    <div class="col-md-6 col-6">
                        <span>End Date</span>
                        <input type="date" class="form-control" name="end_date" />
                    </div>
                    <input type="hidden" name="comp_id" value="<?php echo $_SESSION['comp_id']; ?>" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Filter</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
