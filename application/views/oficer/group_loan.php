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
                    <?php if ($das = $this->session->flashdata('error')): ?> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="alert alert-dismisible alert-danger"> <a href="" class="close">&times;</a> 
                                    <?php echo $das;?> </div> 
                            </div> 
                        </div> 
                    <?php endif; ?>
            <div class="row clearfix">
               
                <div class="col-lg-12">
                    <div class="card">
                         <div class="header">
                            <h2>Loan  List (<?php echo $group_data->group_name; ?>)</h2>
                             <div class="pull-right">
                                 <a href="<?php echo base_url("oficer/group_members"); ?>" class="btn btn-sm btn-primary"><i class="icon-arrow-left"></i></a>
                                 <a href="<?php echo base_url("oficer/print_loangroup/{$comp_id}/{$group_id}") ?>" class="btn btn-primary btn-sm" target="_blank"><i class="icon-printer"></i></a>
                             </div>
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                    <th>S/No.</th>
                                    <th>Loan AC/No</th>
                                    <th>customer name</th>
                                    <th>Phone Number</th>
                                    <th>Busines/Job Name</th>
                                    <th>Branch</th>
                                    <th>Loan Amount</th>
                                    <th>Loan Amount + Interest</th>
                                    <th>Loan duration</th>
                                    <th>Number of Repayments </th>
                                    <th>Loan Status</th>
                                    <th>Deposit status</th>
                                    <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                            <?php $no = 1; ?>
                            <?php foreach($loan_pending as $loan_pendings): ?>
                                              <tr>
                                    <td><?php echo $no++; ?>.</td>
                                    <td><?php echo $loan_pendings->loan_code; ?></td>
                                    <td><?php echo $loan_pendings->f_name; ?> <?php echo substr($loan_pendings->m_name, 0,1); ?> <?php echo $loan_pendings->l_name; ?></td>
                                    <td><?php echo $loan_pendings->phone_no; ?></td>
                                    <td><?php echo $loan_pendings->bussiness_type; ?></td>
                                    <td><?php echo $loan_pendings->blanch_name; ?></td>
                                    <td><?php echo number_format($loan_pendings->loan_aprove); ?></td>
                                    <td><?php echo number_format($loan_pendings->loan_int); ?></td>

                                        <td>
                                            <?php if ($loan_pendings->day == 1) {
                                                 echo "Daily";
                                             ?>
                                            <?php }elseif($loan_pendings->day == 7){
                                                  echo "Weekly";
                                             ?>
                                            
                                        <?php }elseif($loan_pendings->day == 30 || $loan_pendings->day == 31 || $loan_pendings->day == 28 || $loan_pendings->day == 29){
                                                echo "Monthly"; 
                                            ?>
                                            <?php } ?>
                                                
                                            </td>
                                        <td><?php echo $loan_pendings->session; ?></td>
                                        <td>
                                    <?php if ($loan_pendings->loan_status == 'open') {
                                 ?>
                                 <a href="#" class="badge badge-danger">Pending</a>
                                <?php }elseif ($loan_pendings->loan_status == 'aproved') {
                                 ?>
                                 <a href="#" class="badge badge-success">Approved</a>
                                 <?php }elseif($loan_pendings->loan_status == 'disbarsed'){
                                  ?>
                            <a href="#" class="badge badge-info">Disbursed</a>

                                  <?php }elseif ($loan_pendings->loan_status == 'reject') {
                                   ?>
                                 <a href="#" class="badge badge-warning">Rejected</a>
                                   <?php }elseif ($loan_pendings->loan_status == 'withdrawal') {
                                    ?>
                                 <a href="#" class="badge badge-success">Active</a>
                                    <?php }elseif ($loan_pendings->loan_status == 'done') {
                                     ?>
                                <a href="#" class="badge badge-info">Done</a>
                                     <?php  } ?>
                                                        </td>
                              <td>
                                <?php if ($loan_pendings->dep_status == 'open') {
                                 ?>
                                <a href="javascript:;" class="btn btn-sm btn-danger"><i class="icon-close"></i></a>
                            <?php }elseif ($loan_pendings->dep_status == 'close') {
                             ?>
                                <a href="javascript:;" class="btn btn-sm btn-success"><i class="icon-like"></i></a>
                                <?php } ?>
                              </td>
                            <td>  
                        <?php if (@$loan_pendings->loan_status == 'withdrawal' || @$loan_pendings->loan_status == 'out') {
                                 ?>
                       <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addcontact1<?php echo $loan_pendings->loan_id ?>"><i class="icon-pencil">Deposit</i></a>
                    <?php }elseif (@$loan_pendings->loan_status == 'disbarsed') {
                          ?>
                     <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addcontact2<?php echo $loan_pendings->loan_id; ?>">Withdrawal<a> 
                      <?php }else{ ?>
                            <?php } ?></td>
                                                
                                            </tr>
<!-- <p>begin withdrawal</p> -->
<div class="modal fade" id="addcontact2<?php echo $loan_pendings->loan_id; ?>" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">

<?php 
 @$remain_balance = $this->queries->get_total_remain_with($loan_pendings->loan_id);
 @$acount = $this->queries->get_customer_account_verfied($loan_pendings->blanch_id);
 @$customer_loan = $this->queries->get_loan_active_customer_group($loan_pendings->loan_id);

 @$total_recovery = $this->queries->get_total_loan_pend($loan_pendings->loan_id);
 @$total_penart =   $this->queries->get_total_penart_loan($loan_pendings->loan_id);
 @$total_deposit_penart =  $this->queries->get_total_paypenart($loan_pendings->loan_id);
 @$end_deposit = $this->queries->get_end_deposit_time($loan_pendings->loan_id);
 @$today_dep = $this->queries->get_end_deposit_time_date($loan_pendings->loan_id);
  @$total_deposit = $this->queries->get_total_amount_paid_loan($loan_pendings->loan_id);
 @$out_stand = $this->queries->get_outstand_loan_customer($loan_pendings->loan_id);
 ?>

<h6 class="title" id="defaultModalLabel"><?php echo $loan_pendings->f_name; ?> <?php echo $loan_pendings->m_name; ?> <?php echo $loan_pendings->l_name; ?></h6>


</div>
           <div class="text-center">
                    <img id="loaderIconwith" style="visibility:hidden; display:none;width: 100px; height: 100px;"
                src="https://c.tenor.com/I6kN-6X7nhAAAAAj/loading-buffering.gif" alt="Please wait" />
            </div>
<?php echo form_open("oficer/create_withdrow_balance_group/{$customer_loan->customer_id}/{$group_id}",['id'=>'login_with']); ?>
<div class="modal-body">
<div class="row clearfix">
<div class="col-md-6 col-6">
<span>Total Withdrawal</span>
<input type="number" class="form-control" name="withdrow" value="<?php echo $remain_balance->balance; ?>" readonly>     
</div>
<div class="col-md-6 col-6">
<span>Select Account:</span>
<select type="number" class="form-control" name="method" required>
    <option value="">---Select Account---</option>
    <?php foreach ($acount as $acounts): ?>
    <option value="<?php echo $acounts->trans_id; ?>"><?php echo $acounts->account_name; ?></option>
    <?php endforeach; ?>
</select>            
</div>

 <input type="hidden" value="CASH WITHDRAWALS" name="description">
<input type="hidden" value="withdrawal" name="loan_status">
<input type="hidden" value="<?php echo $loan_pendings->loan_id; ?>" name="loan_id">

<input type="hidden" value="<?php echo $customer_loan->customer_id; ?>" name="customer_id">
<input type="hidden" value="<?php echo $customer_loan->comp_id; ?>" name="comp_id">
<input type="hidden" value="<?php echo $customer_loan->blanch_id; ?>" name="blanch_id">
<input type="hidden" class="form-control" name="code" value="1" required>     

<?php $date = date("Y-m-d"); ?>
<div class="col-md-12 col-12">
<span>withdrawal Date</span>
<input type="date" class="form-control" value="<?php echo $date; ?>" name="with_date" required>       
</div>

</div>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-success">Withdrawal</button>
<!-- <a href="" class="btn btn-primary">Resend Code</a> -->
<button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
</div>
<?php echo form_close(); ?>
</div>
</div>
</div>

<!-- <p>end withdrawal</p> -->



<div class="modal fade" id="addcontact1<?php echo $loan_pendings->loan_id ?>" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h7 class="title" id="defaultModalLabel"><?php echo $loan_pendings->f_name; ?> <?php echo $loan_pendings->m_name; ?> <?php echo $loan_pendings->l_name; ?><br>With Date:<?php if (@$customer_loan->loan_stat_date == TRUE) {
                             ?>
                            <?php echo @$customer_loan->loan_stat_date; ?>
                        <?php }elseif (@$customer_loan->loan_stat_date == FALSE) {
                         ?>
                         YY-MM-DD
                         <?php } ?> - End Date:  <?php if (@$customer_loan->loan_end_date == TRUE) {
                             ?>
                             <?php echo substr(@$customer_loan->loan_end_date, 0,10); ?>
                        <?php }elseif (@$customer_loan->loan_end_date == FALSE) {
                         ?>
                         YY-MM-DD
                         <?php } ?> <br> End Deposit Amount : <?php echo number_format(@$end_deposit->depost); ?> <br>Deposit Time : <?php echo @$end_deposit->deposit_day; ?> </h7>


</div>
                 <div class="text-center">
                    <img id="loaderIcons" style="visibility:hidden; display:none;width: 100px; height: 100px;"
                src="https://c.tenor.com/I6kN-6X7nhAAAAAj/loading-buffering.gif" alt="Please wait" />
            </div>
<?php echo form_open("oficer/deposit_loan_group/{$customer_loan->customer_id}/{$group_id}",['id'=>'login_data']); ?>
<div class="modal-body">
<div class="row clearfix">
<div class="col-md-4 col-6">
<span>Total Loan</span>
<input type="text" class="form-control" value="<?php echo number_format(@$customer_loan->loan_int); ?>" readonly>     
</div>
 <div class="col-md-4 col-6">
<span>Amount Paid</span>
<input type="text" class="form-control" value="<?php if (@$total_deposit->total_Deposit > @$customer_loan->loan_int) {
                             ?>
                    <?php echo number_format(@$customer_loan->loan_int); ?>
                     (<?php echo number_format(@$total_deposit->total_Deposit - @$customer_loan->loan_int); ?>)
                         <?php }else{ ?><?php echo number_format(@$total_deposit->total_Deposit); ?>
                             <?php } ?>" readonly>     
</div>
 <div class="col-md-4 col-12">
<span>Remain Debit</span>
<input type="text" class="form-control" value="<?php if (@$total_deposit->total_Deposit > @$customer_loan->loan_int) {
                             ?>
                             0.00
                             <?php }else{ ?><?php echo number_format(@$customer_loan->loan_int - @$total_deposit->total_Deposit ); ?>
                            <?php } ?>" readonly>     
</div>
 <div class="col-md-6 col-6">

 <?php if ($customer_loan->loan_status == 'withdrawal') {
  ?>
<span>Recovery Amount</span>
<input type="text" class="form-control" value="<?php echo number_format($total_recovery->total_pending); ?>.00" readonly style="color:red"> 
<?php }elseif ($customer_loan->loan_status == 'out') {
?>
<span style="color:red;">Default Amount</span>
<input type="text" class="form-control" value="<?php echo number_format($out_stand->total_out); ?>.00" readonly style="color:red"> 
<?php }else{ ?>
<span>Recovery Amount</span>
<input type="text" class="form-control" value="0.00" readonly style="color:red"> 
<?php } ?>

</div>

<div class="col-md-6 col-6">
<span>Penart</span>
<input type="text" class="form-control" value="<?php echo number_format($total_penart->total_penart - $total_deposit_penart->total_penart_paid); ?>.00" readonly style="color:red">     
</div>
<div class="col-md-6 col-6">
<span style="color:green">Deposit Amount </span>
<input type="number" class="form-control" name="depost" placeholder="Enter Deposit Amount" required style="color: green;">     
</div>
<div class="col-md-6 col-6">
<span>Select Account:</span>
<select type="number" class="form-control" name="p_method" required>
    <option value="">---Select Account---</option>
    <?php foreach ($acount as $acounts): ?>
    <option value="<?php echo $acounts->trans_id; ?>"><?php echo $acounts->account_name; ?></option>
    <?php endforeach; ?>
</select>           
</div>
<input type="hidden" value="<?php echo $customer_loan->customer_id; ?>" name="customer_id">
<input type="hidden" value="<?php echo $customer_loan->comp_id; ?>" name="comp_id">
<input type="hidden" value="<?php echo $customer_loan->blanch_id; ?>" name="blanch_id">
<input type="hidden" value="<?php echo $customer_loan->loan_id; ?>" name="loan_id">
 <input type="hidden" value="LOAN RETURN" name="description">
 <input type="hidden" value="<?php echo $customer_loan->day; ?>" name="day_id">
<?php $date = date("Y-m-d"); ?>

<div class="col-md-6 col-6">
<span>Double (optional)</span>
<?php if ($customer_loan->loan_status == 'withdrawal') {
 ?>
<select type="text" class="form-control" name="double">
    <option value="NO">NO</option>
    <option value="YES">YES</option>
</select>
<?php }else{
?>
<input type="text" name="double"  value="NO" class="form-control" readonly>
<?php  } ?>     
</div>
<div class="col-md-6 col-6">
<span>Deposit Date</span>
<input type="date" class="form-control" value="<?php echo $date; ?>" name="deposit_date" required>       
</div>

</div>
</div>
<div class="modal-footer">
<?php if (@$today_dep->deposit_day == TRUE) {
?>
<button type="submit" class="btn btn-primary" onclick="return confirm('Are you Sure To Deposit Again?')">Deposit</button>
<?php }elseif(@$today_dep->deposit_day == FALSE){ ?>
<button type="submit" class="btn btn-primary">Deposit</button>
<?php } ?>
<button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
</div>
<?php echo form_close(); ?>
</div>
</div>
</div>





                                <?php endforeach; ?>
                                    </tbody>
                                                 <tr>
        <th><b>TOTAL</b></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th><?php echo number_format($total_loan_group->total_loan); ?></th>
        <th><?php echo number_format($total_loan_group->total_loanint); ?></th>
        <th><b>Paid  : <?php echo number_format($total_depost_group->total_depost); ?></b></th>
        <th><b>Remain : <?php echo number_format($total_loan_group->total_loanint - $total_depost_group->total_depost ); ?></b></th>
        <th></th>
        <th></th>
        <th></th>
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




 
      
  
    





