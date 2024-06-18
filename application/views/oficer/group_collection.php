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
                            <li class="breadcrumb-item active">Groups & Members</li>
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
                            <h2>Group Collection Sheet </h2>
                             <div class="pull-right">
                                 <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addcontact3"><i class="icon-size-actual">filter</i></a>
                                 <a href="<?php echo base_url("oficer/print_group_collection/{$blanch_id}/{$loan_status}") ?>" class="btn btn-sm btn-primary" target="_blank"><i class="icon-printer"></i></a>
                             </div>
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover j-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                    <th>Groups Name</th>
                                    <th>Customer Name</th>
                                    <th>Loan Aproved</th>
                                    <th>Loan + Interest</th>
                                    <th>Collection</th>
                                    <th>Duration</th>
                                    <th>Paid Amount</th>
                                    <th>Remain Amount</th>
                                    <th>Penart</th>
                                    <th>Loan Status</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                    <?php
                                   $comp_id = $this->session->userdata('comp_id');
                                   if ($blanch_id == 'all') {
                                  $group_status = $this->queries->get_group_loan($comp_id);
                                   }else{
                                    $group_status = $this->queries->get_group_loan_blanch($blanch_id);
                                    }
                                     ?>
                      <?php foreach($group_status as $group_loans): ?>
                                              <tr>
                                    <td><b><?php echo $group_loans->group_name; ?></b></td>
                                    <td><?php //echo $loan_pendings->loan_code; ?></td>
                                    <td><?php //echo $loan_pendings->f_name; ?> <?php //echo substr($loan_pendings->m_name, 0,1); ?> <?php //echo $loan_pendings->l_name; ?></td>
                                    <td><?php //echo $loan_pendings->phone_no; ?></td>
                                    <td><?php //echo $loan_pendings->bussiness_type; ?></td>
                                    <td><?php //echo $loan_pendings->blanch_name; ?></td>
                                    <td><?php //echo number_format($loan_pendings->loan_aprove); ?></td>
                                    <td><?php //echo number_format($loan_pendings->loan_int); ?></td>
                                    <td><?php //echo number_format($loan_pendings->loan_int); ?></td>

                                        <td>
                                            </td>
                                
                            </tr>
                               <?php 
                               $customers_loan = $this->queries->get_loan_group_customer_status($group_loans->group_id,$loan_status);
                              // echo "<pre>";
                              // print_r($customers_loan);
                              //      exit();
                                ?>

                                 <?php foreach ($customers_loan as $customers_loans): ?>
                                  <tr>
                                    <td class="c"></td>
                                    <td class="c"><?php echo $customers_loans->f_name; ?> <?php echo $customers_loans->m_name; ?> <?php echo $customers_loans->l_name; ?></td>
                                    <td><?php echo number_format($customers_loans->loan_aprove); ?> </td>
                                    <td><?php echo number_format($customers_loans->loan_int); ?></td>
                                    <td><?php echo number_format($customers_loans->restration); ?></td>
                                    <td class="c">  <?php if ($customers_loans->day == 1) {
                                                 echo "Daily";
                                             ?>
                                            <?php }elseif($customers_loans->day == 7){
                                    echo "Weekly";
                                             ?>
                                            
                                        <?php }elseif($customers_loans->day == 30 || $customers_loans->day == 31 || $customers_loans->day == 28 || $customers_loans->day == 29){
                                                echo "Monthly"; 
                                            ?>
                                            <?php } ?></td>
                                    <td><?php echo number_format($customers_loans->total_depost); ?></td>
                                    <td><?php echo number_format($customers_loans->loan_int - $customers_loans->total_depost); ?></td>
                                    <td><?php echo number_format($customers_loans->total_penart - $customers_loans->total_paid_penart); ?></td>
                                    <td>
                                        <?php if ($customers_loans->loan_status == 'withdrawal') {
                                         ?>
                                        <a href="javascript" class="badge badge-success">Active</a>
                                    <?php }elseif ($customers_loans->loan_status == 'pending') {
                                     ?>
                                        <a href="javascript" class="badge badge-warning">Pending</a>
                                    <?php }elseif ($customers_loans->loan_status == 'aproved') {
                                     ?>
                                        <a href="javascript" class="badge badge-primary">Aproved</a>
                                    <?php }elseif ($customers_loans->loan_status == 'disbarsed') {
                                     ?>
                                        <a href="javascript" class="badge badge-info">Disbursed</a>
                                    <?php }elseif ($customers_loans->loan_status == 'done') {
                                     ?>
                                        <a href="javascript" class="badge badge-secondary">Done</a>
                                    <?php }elseif ($customers_loans->loan_status == 'out') {
                                     ?>
                                        <a href="javascript" class="badge badge-danger">Default</a>
                                        <?php } ?>
                                    </td>
                                
                            </tr>
                              <?php endforeach; ?> 
                              <?php
                              $total = $this->queries->get_total_group_loan_status($group_loans->group_id,$loan_status);
                              // echo "<pre>";
                              // print_r($total);
                              //       exit(); 
                               ?>
                                 <?php foreach ($total as $totals): ?>
     
                                  <tr>
                                    <td><b></b></td>
                                    <td><b>TOTAL:</b></td>
                                    <td><b><?php echo number_format($totals->total_loangroup); ?></b></td>
                                    <td><b><?php echo number_format($totals->total_int); ?></b></td>
                                    <td><b><?php echo number_format($totals->total_restoration); ?></b></td>
                                    <td><b></b></td>
                                    <td><b><?php echo number_format($totals->total_depost_groups); ?></b></td>
                                    <td><b><?php echo number_format($totals->total_int - $totals->total_depost_groups); ?></td>
                                    <td><b><?php echo number_format($totals->total_penart_group - $totals->total_paid); ?></b></td>
                                    <td><b><?php //echo number_format($total_groups->total_loan_aprove_empl); ?></b></td>
                                </tr> 

                                <?php endforeach; ?>      
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


<div class="modal fade" id="addcontact3" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Filter By</h6>
            </div>
            <?php echo form_open("oficer/filter_group_collection"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                
                     
                     <div class="col-md-12 col-12">
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






