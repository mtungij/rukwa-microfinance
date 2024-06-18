
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $compdata->comp_name; ?> |DAILY REPORT
 </title>
</head>
<body>

<div id="container">
  <style>
    .display{
      display: flex;
      
    }
  </style>
     <style>
             .c {
               text-transform: uppercase;
               }
                
      </style>
<table  style="border: none">
<tr style="border: none">
<td style="border: none">


<div style="width: 20%;">
<img src="<?php echo base_url().'assets/img/'.$compdata->comp_logo ?>" style="width: 100px;height: 80px;">
</div> 

</td>
<td style="border: none">
<div class="pull">
<p style="font-size:14px;" class="c"><b> <?php echo $compdata->comp_name; ?></b><br>
<b><?php echo $compdata->adress; ?></b> <br>
<?php $day = date("d-m-Y"); ?>
</p>
<p style="font-size:12px;text-align:center;" class="c"><b><?php echo $blanch_data->blanch_name ?> - DAILY REPORT / FROM: <?php echo date('F, j, Y', strtotime($from)) ?> - TO: <?php echo date('F, j, Y', strtotime($to)) ?></b></p>
<!-- <p style="font-size:12px;text-align:center;" class="c"> <?php //echo $from; ?></p>
 --></div>
</td>
</tr>
</table>

    
 
  <div id="body">
  <style> 
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 1px;
}

tr:nth-child(even) {
  background-color: ;
}

</style>
</head>
<body>
 <hr>


                                   <table>
                                    <thead>
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

</body>
</html>




