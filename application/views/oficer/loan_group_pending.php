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
                            <li class="breadcrumb-item active">Loan Group</li>
                            <li class="breadcrumb-item active">Loan Pending</li>
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
                            <h2>Group Loan Pending List </h2>    
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover j-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                    <th>Group Name</th>
                                    <th>S/no.</th>
                                    <th>Loan AC</th>
                                    <th>customer name</th>
                                    <th>Phone Number</th>
                                    <th>Branch</th>
                                    <th>Loan Amount</th>
                                    <th>Loan Duration</th>
                                    <th>Number of repayments</th>
                                    <th>Loan Status</th>
                                    <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                    <?php $no = 1; ?>     
                              <?php foreach($group_pend as $group_pends):?>
                                    <tr>
                                    <td class="c"><b><?php echo $group_pends->group_name; ?></b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                              
                                    <td></td>
                                       <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        </tr>

                          <?php $loan_group = $this->queries->get_loan_group_pend($group_pends->group_id); ?>
                          <?php   $no2 = 1; ?>
                          <?php foreach ($loan_group  as $loan_groups): ?>
                                 <tr>
                                    <td></td>
                                    <td><?php echo $no2++; ?>.</td>
                                    <td><?php echo $loan_groups->loan_code; ?></td>
                                    <td><?php echo $loan_groups->f_name; ?> <?php echo $loan_groups->m_name; ?> <?php echo $loan_groups->l_name; ?></td>
                                    
                                    <td><?php echo $loan_groups->phone_no; ?></td>
                                        <td><?php echo $loan_groups->blanch_name; ?></td>
                                        <td><?php echo number_format($loan_groups->how_loan); ?></td>
                                        <td>
                                            <?php if ($loan_groups->day == 1) {
                                                 echo "Daily";
                                             ?>
                                            <?php }elseif($loan_groups->day == 7){
                                                  echo "Weekly";
                                             ?>
                                            
                                        <?php }elseif($loan_groups->day == 30 || $loan_groups->day == 31 || $loan_groups->day == 29 || $loan_groups->day == 28){
                                                echo "Monthly"; 
                                            ?>
                                            <?php } ?>
                                                
                                            </td>

                                        <td><?php echo $loan_groups->session; ?></td>
                                        
                                        <td>
                                            <?php if ($loan_groups->loan_status == 'open') {
                                         ?>
                                         <a href="#" class="badge badge-danger">Pending</a>
                                        <?php }elseif ($loan_groups->loan_status == 'aprove') {
                                         ?>
                                         <a href="#" class="badge badge-success">Approved</a>
                                         <?php }elseif($loan_groups->loan_status == 'disburse'){
                                          ?>
                                    <a href="#" class="badge badge-info">Disbursed</a>

                                          <?php } ?>
                                        </td>
                                         
                                            <td>
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item" href="<?php echo base_url("oficer/view_Dataloan/{$loan_groups->customer_id}/{$loan_groups->comp_id}") ?>"><i class="icon-eye">view</i></a>
                    
                  <a class="dropdown-item" href="<?php echo base_url("oficer/reject_loan/{$loan_groups->loan_id}") ?>" onclick="return confirm('Are You Sure?')"><i class="icon-trash">Reject</i></a>

                     <a class="dropdown-item" href="<?php echo base_url("oficer/delete_loan/{$loan_groups->loan_id}") ?>" onclick="return confirm('Are you sure?')"><i class="icon-trash">Delete</i></a>
                    </div>
                </div>
                </div>
                                            </td>
                                            
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


