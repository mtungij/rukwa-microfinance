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
                            <li class="breadcrumb-item active">Daily Report</li>
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
                            <?php $date = date("Y-m-d"); ?>
                            <h2>Daily Report / From:<?php echo date('F, j, Y', strtotime($from)) ?> - To:<?php echo date('F, j, Y', strtotime($to)) ?></h2> 
                            <div class="pull-right">
                                 <a href="" data-toggle="modal" data-target="#addcontact1" class="btn btn-primary btn-sm"><i class="icon-calendar">Filter</i></a>
                              <a href="<?php echo base_url("oficer/print_daily_report_data/{$blanch_id}/{$from}/{$to}"); ?>" class="btn btn-sm btn-icon btn-pure btn-primary on-default m-r-5 button-edit"
                                           data-original-title="print" target="_blank"><i class="icon-printer"></i>Print</a> 
                            </div>   
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover j-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>    <!-- <th>Branch Name</th> -->
                                                <th>Description</th>
                                                <th>Amount</th>
                                        </tr>

                                    </thead>
                                   
                                    <tbody>
                                    <?php foreach ($data_account_data as $data_account_datas): ?>
                                    <tr>
                                    <td><b><?php echo $data_account_datas->account_name ?></b></td>
                                    <td><?php //echo number_format(@$data_account_datas->cash_amount); ?></td>                                                       
                                    </tr>
                                    <?php $opening_balace = $this->queries->get_yesterday_data($data_account_datas->blanch_id,$data_account_datas->receive_trans_id); 
                                      //print_r($opening_balace);
                                    ?>
                                    <?php foreach ($opening_balace as $opening_balaces): ?>
                                    <tr>
                                    <td><b>OPENING BALANCE</b></td>
                                    <td><b><?php echo number_format($opening_balaces->yester_day_total); ?></b></td>                                                       
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php $income_today = $this->queries->get_today_income_data_prev($data_account_datas->blanch_id,$data_account_datas->receive_trans_id,$from,$to) ?>
                          
                                    <?php 
                                    // echo "<pre>";
                                    // print_r($income_today); 
                                    ?>
                                    <tr>
                                        <td style="text-align:center; color: green;">DEDUCTED INCOME COLLECTION</td>
                                        <td></td>
                                    </tr>
                                    <?php foreach ($income_today as $income_todays): ?>
                                    <tr>
                                        <td><?php echo $income_todays->description; ?></td>
                                        <td><?php echo $income_todays->total_deduct; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                     <tr>
                                        <td style="text-align:center; color:green;">NON-DEDUCTED INCOME COLLECTION</td>
                                        <td></td>
                                    </tr>
                                    <?php $non_deducted = $this->queries->get_nondeducted_income_account_prev($data_account_datas->blanch_id,$data_account_datas->receive_trans_id,$from,$to);
                                    // echo "<pre>"; 
                                    //  print_r($non_deducted);
                                    ?>
                                    <?php foreach ($non_deducted as $non_deducteds): ?>
                                    <tr>
                                        <td><?php echo $non_deducteds->inc_name; ?></td>
                                        <td><?php echo number_format($non_deducteds->total_nondeducted); ?></td>
                                    </tr>
                                     <?php endforeach; ?>

                                     <?php $prepaid = $this->queries->get_today_prepaid_prev($data_account_datas->blanch_id,$data_account_datas->receive_trans_id,$from,$to);
                                       //    echo "<pre>";
                                       // print_r($prepaid);
                                      ?>
                                <?php foreach ($prepaid as $prepaids): ?>
                                     <tr>
                                        <td>PREPAID</td>
                                        <td><?php echo number_format($prepaids->total_prepaid); ?></td>
                                    </tr>
                                     <?php endforeach ?>

                                     <?php $accrual_income = $this->queries->get_out_deposit_today_prev($data_account_datas->blanch_id,$data_account_datas->receive_trans_id,$from,$to);
                                     // echo "<pre>";
                                     // print_r($accrual_income);
                                      ?>
                                      <?php foreach ($accrual_income as $accrual_incomes): ?>
                                     <tr>
                                        <td>ACCRUAL INCOME</td>
                                        <td><?php echo number_format($accrual_incomes->total_deposit_out); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                      <?php $daily_deposit = $this->queries->get_daily_deposit_prev($data_account_datas->blanch_id,$data_account_datas->receive_trans_id,$from,$to);
                                      // echo "<pre>";
                                      // print_r($daily_deposit);
                                       ?>
                                       <?php foreach ($daily_deposit as $daily_deposits): ?>
                                    <tr>
                                        <td>DAILY RECEIVED</td>
                                        <td><?php echo number_format($daily_deposits->total_dailyDeposit); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    
                                    <?php $weekly_deposit = $this->queries->get_weekly_deposit_prev($data_account_datas->blanch_id,$data_account_datas->receive_trans_id,$from,$to);
                                         	
                                     ?>
                                     <?php foreach ($weekly_deposit as $weekly_deposits): ?>
                                    <tr>
                                        <td>WEEKLY RECEIVED</td>
                                        <td><?php echo number_format($weekly_deposits->total_weekly_deposit); ?></td>
                                    </tr>
                                    <?php endforeach; ?>

                                <?php $monthly_deposit = $this->queries->get_monthly_deposit_prev($data_account_datas->blanch_id,$data_account_datas->receive_trans_id,$from,$to);
                                //       echo "<pre>";
                                // print_r($monthly_deposit) ?>
                                 <?php foreach ($monthly_deposit as $monthly_deposits): ?>
                                    <tr>
                                        <td>MONTHLY RECEIVED</td>
                                        <td><?php echo number_format($monthly_deposits->total_monthly_deposit); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                 <?php $loan_pending = $this->queries->get_system_loan_return_prev($data_account_datas->blanch_id,$data_account_datas->receive_trans_id,$from,$to);
                                  //print_r($loan_pending);
                                  ?>
                                   <?php foreach ($loan_pending as $loan_pendings): ?>
                                    <tr>
                                        <td>LOAN RETURN</td>
                                        <td><?php echo number_format($loan_pendings->total_loan_pending); ?></td>
                                    </tr>
                                    <?php endforeach; ?>

                                    <?php $double_loan = $this->queries->get_double_amount_prev($data_account_datas->blanch_id,$data_account_datas->receive_trans_id,$from,$to);
                                    //print_r($double_loan);
                                    ?>
                                     
                                    <?php foreach ($double_loan as $double_loans):?>
                                    <tr>
                                        <td>DOUBLE</td>
                                        <td><?php echo number_format($double_loans->total_double); ?></td>
                                    </tr>
                                     <?php endforeach; ?>

                                    <?php $from_main_account = $this->queries->get_transaction_from_mainAccount_prev($data_account_datas->blanch_id,$data_account_datas->receive_trans_id,$from,$to); ?>
                                    <?php //print_r($from_main_account); ?>
                                    <?php foreach ($from_main_account as $from_main_accounts): ?>
                                    <tr>
                                        <td>RECEIVE FLOAT FROM MAIN ACCOUNT</td>
                                        <td><?php echo number_format($from_main_accounts->total_blanch_transfor); ?></td>
                                    </tr>
                                     <?php endforeach; ?>

                                     <?php $from_blanch_blanch = $this->queries->get_transaction_from_blanch_prev($data_account_datas->blanch_id,$data_account_datas->receive_trans_id,$from,$to);
                                     // echo "<pre>";
                                     // print_r($from_blanch_blanch)
                                      ?>
                                      <?php foreach ($from_blanch_blanch as $from_blanch_blanchs): ?>
                                     <tr>
                                         <td>RECEIVE FLOAT FROM OTHER BRANCH</td>
                                         <td><?php echo number_format($from_blanch_blanchs->total_transfor); ?></td>
                                     </tr>
                                     <?php endforeach; ?>

                                     <?php $saving_deposit = $this->queries->get_blanch_saving_deposit($data_account_datas->blanch_id,$data_account_datas->receive_trans_id);
                                     ?>
                                     <?php foreach ($saving_deposit as $saving_deposits): ?>
                                         
                                     <tr>
                                         <td>SAVING DEPOSIT</td>
                                         <td><?php echo number_format($saving_deposits->total_saving); ?></td>
                                     </tr>
                                     <?php endforeach ?>

                                     <tr>
                                         <td style="text-align:center;color: red;">EXPENSES</td>
                                         <td></td>
                                     </tr>

                                     <?php $loan_with = $this->queries->get_loan_withdrawal_account_prev($data_account_datas->blanch_id,$data_account_datas->receive_trans_id,$from,$to);
                                     // echo "<pre>";
                                     // print_r($loan_with) ?>
                                     <?php foreach ($loan_with as $loan_withs): ?>
                                     <tr>
                                         <td>LOAN WITHDRAWAL</td>
                                         <td><?php echo number_format($loan_withs->total_loan_with); ?></td>
                                     </tr>
                                     <?php endforeach; ?>

                                     <?php 
                                      if ($blanch_id == 'all') {
                                    $all_renew = $this->queries->get_loan_renew_prev_comp($data_account_datas->comp_id,$data_account_datas->receive_trans_id,$from,$to);
                                      }else{
                                    $all_renew = $this->queries->get_loan_renew_prev($data_account_datas->blanch_id,$data_account_datas->receive_trans_id,$from,$to);
                                        }
                                    //       echo "<pre>";
                                    // print_r($all_renew);
                                       ?>
                                    <?php foreach ($all_renew as $all_renews): ?>
                                     <tr>
                                         <td>RENEW LAON</td>
                                         <td><?php echo number_format($all_renews->total_renew); ?></td>
                                     </tr>
                                     <?php endforeach; ?>

                                     <?php $expenses = $this->queries->get_expenses_datas_prev($data_account_datas->blanch_id,$data_account_datas->receive_trans_id,$from,$to);
                                      //    echo "<pre>";
                                      // print_r($expenses) 
                                     ?>
                                     <?php foreach ($expenses as $expensess): ?>
                                     <tr>
                                         <td><?php echo $expensess->ex_name; ?></td>
                                         <td><?php echo number_format($expensess->total_expenses); ?></td>
                                     </tr>
                                     <?php endforeach; ?>


                                     <?php $transactions_float = $this->queries->get_transaction_day_toBlanch_prev($data_account_datas->blanch_id,$data_account_datas->receive_trans_id,$from,$to);
                                     // echo "<pre>";
                                     // print_r($transactions_float);
                                      ?>
                                      <?php foreach ($transactions_float as $transactions_floats): ?>
                                          
                                     <tr>
                                         <td>TRANSFOR FLOAT TO OTHER BRANCH</td>
                                         <td><?php echo number_format($transactions_floats->total_transaction); ?></td>
                                     </tr>
                                      <?php endforeach; ?>

                                      <?php $closing = $this->queries->get_today_data_close($data_account_datas->blanch_id,$data_account_datas->receive_trans_id); ?>
                                      <?php foreach ($closing as $closings): ?>
                                      <tr>
                                          <td><b>CLOSING</b></td>
                                          <td><b><?php echo number_format($closings->close_day_total); ?></b></td>
                                      </tr>
                                       <?php endforeach; ?>

                                    <?php endforeach; ?>
                                    
                                    </tbody>
                                    <tr>
                                          <td style="text-align:center"><b>MAIN TOTAL</b></td>
                                          <td><b><?php //echo number_format($closings->close_day_total); ?></b></td>
                                      </tr>
                                      <tr>
                                          <td><b>TOTAL OPENNING BALANCE</b></td>
                                          <td><b><?php echo number_format($opening_total->total_opening_yesterday); ?></b></td>
                                      </tr>
                                      <tr>
                                          <td><b>TOTAL INCOME COLLECTED</b></td>
                                          <td><b><?php echo number_format(($deduct_income->total_deduct_blanch + $non_deducted_data->total_non) + ($income_deposit->total_all_deposit + $income_deposit->total_double_loan + $from_mainAccount->total_blanch_main + $from_blanch_branch->total_transfor_total)); ?></b></td>
                                      </tr>
                                      <tr>
                                          <td><b>TOTAL EXPENSES</b></td>
                                          <td><b><?php echo number_format(@$expenses_blanch->total_expenses_blanch + $withdrawal_today_expenses->total_loan_with + $transaction_float->total_transaction_float + $renew_loan->total_renew); ?></b></td>
                                      </tr>
                                      <tr>
                                          <td><b>TOTAL CLOSING BALANCE</b></td>
                                          <td><b><?php echo number_format($closing_data->close_day_blanch); ?></b></td>
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



 <div class="modal fade" id="addcontact1" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Filter By Date</h6>
            </div>
            <?php echo form_open("oficer/filter_daily_report"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    
                    <?php $date = date("Y-m-d"); ?>
                    <div class="col-md-6 col-6">
                    <span>From:</span>
                    <input type="date" class="form-control" value="<?php echo $date; ?>" name="from" required>        
                    <input type="hidden" name="blanch_id" value="<?php echo $empl_data->blanch_id; ?>">       
                    </div>
                    <div class="col-md-6 col-6">
                    <span>To:</span>
                    <input type="date" class="form-control" name="to" value="<?php echo $date; ?>" required>           
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


