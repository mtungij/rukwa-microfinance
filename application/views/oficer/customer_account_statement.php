
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $compdata->comp_name; ?> |CUSTOMER ACCOUNT STATEMENT
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


  <?php @$customer_loan = $this->queries->get_loan_account_statement($loan_id);
     @$total_deposit = $this->queries->get_total_amount_paid_loan($loan_id);

    // @$out_stand = $this->queries->get_outstand_loan_customer($customer_loan->loan_id);
   ?>
<div style="width: 20%;">
<img src="<?php echo base_url().'assets/img/'.$compdata->comp_logo ?>" style="width: 100px;height: 80px;">
</div> 

</td>
<td style="border: none">
<div class="pull">
<p style="font-size:14px;" class="c"><b> <?php echo $compdata->comp_name; ?></b><br>
<b><?php echo $compdata->adress; ?></b> <br>
<?php //$day = date("d-m-Y"); ?>
</p>
<p style="font-size:12px;text-align:center;" class="c">CUSTOMER ACCOUNT STATEMENT</p>
<p style="font-size:12px;text-align:center;" class="c"><?php echo $customer_data->f_name; ?> <?php echo $customer_data->m_name; ?> <?php echo $customer_data->l_name; ?></p>
</div>
</td>
<td>
  <p>Loan Aproved : <?php echo number_format($customer_data->loan_aprove); ?></p>
  <p>Interest + Fee : <?php echo $customer_data->interest_formular; ?>%</p>
  <p>Restoration Type : <?php 
  if ($customer_data->day == '1') {
    echo "Daily";
  }elseif ($customer_data->day == '7') {
   echo "Weekly";
  }elseif ($customer_data->day == '30') {
     echo "Monthly";
  }
   ?>
</p>
  <p>Number Of Repayment : <?php echo $customer_data->session; ?></p>
  <p>Loan + Interest : <?php echo number_format($customer_data->loan_int); ?></p>
  <p>Paid Amount : <?php echo number_format($total_deposit->total_Deposit + $total_deposit->total_double) ?> </p>
  <p>Remain Amount : <?php echo number_format(($customer_loan->loan_int) - ($total_deposit->total_Deposit + $total_deposit->total_double) ) ?></p>
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
  padding: 5px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

</style>
</head>
<body>
 <hr>

<?php  @$loan_desc = $this->queries->get_total_pay_description_acount_statement($loan_id); ?>
<table>
  <thead>  
    <tr>
   
     <th style="font-size:12px;border: none;">Date</th>
     <th style="font-size:12px;border: none;">Description</th>
     <th style="font-size:12px;border: none;">Deposit</th>
     <th style="font-size:12px;border: none;">Withdrawal</th>
     <th style="font-size:12px;border: none;">Balance</th>
     <th style="font-size:12px;border: none;">Remain Debit</th>

  </tr>
  </thead>

   <?php $no = 1; ?>
  <?php foreach ($loan_desc as $payisnulls): ?>
 <tr>
    <td style="font-size:12px;border: none;" class="c"><?php echo $payisnulls->date_data; ?></td>
    <td style="font-size:12px;border: none;" class="c">
       <?php echo $payisnulls->emply; ?>
                                              <?php if ($payisnulls->emply == TRUE) {   
                                               ?>
                                               /
                                           <?php }else{ ?>
                                            <?php } ?>
                                               <?php echo $payisnulls->description; ?>
                                               <?php if($payisnulls->p_method == TRUE){ ?>
                                                /<?php echo $payisnulls->account_name; ?>
                                                <?php }else{ ?> 
                                                     
                                                    <?php } ?>
                                               <?php if ($payisnulls->fee_id == TRUE || $payisnulls->fee_id == '0' ) {
                                              ?>
                                              / <?php echo $payisnulls->fee_desc; ?> <?php echo $payisnulls->fee_percentage; ?> <?php echo $payisnulls->symbol; ?>
                                          <?php }else{ ?>
                                            <?php } ?>
                                            <?php if($payisnulls->p_method == FALSE){ ?>
                                            <?php }else{ ?>
                                               / 
                                               <?php } ?>
                                               <?php //echo @$payisnulls->description; ?>  <?php echo @$payisnulls->loan_name ; ?>
                                         <?php if(@$payisnulls->day == 1){
                                           echo "Daily";
                                    }elseif(@$payisnulls->day == 7){
                                         echo "Weekly";
                                    }elseif (@$payisnulls->day == 30 || @$payisnulls->day == 31 || @$payisnulls->day == 28 || @$payisnulls->day == 29) {
                                        echo "Monthly";
                                     ?> 
                                    <?php } ?><?php //echo $payisnulls->session; ?>  / AC/No. <?php echo @$payisnulls->loan_code; ?>
    </td>
    <td style="font-size:12px;border: none;" class="c"> <?php if($payisnulls->depost == TRUE){ ?>
                                                <?php echo round(@$payisnulls->depost,2); ?>
                                            <?php }elseif($payisnulls->depost == FALSE){ ?>
                                            0.00
                                                <?php } ?></td>
    <td style="font-size:12px;border: none;" class="c">
      <?php if (@$payisnulls->withdrow == TRUE) {
                                                 ?>
                                                <?php echo round(@$payisnulls->withdrow,2); ?>
                                                <?php }elseif (@$payisnulls->withdrow == FALSE) {
                                                 ?>
                                                 0.00
                                            <?php } ?></td>
    <td style="font-size:12px;border: none;" class="c"><?php if (@$payisnulls->balance == TRUE) {
                                                 ?>
                                                <?php echo round(@$payisnulls->balance,2); ?>
                                                <?php }elseif (@$payisnulls->balance == FALSE) {
                                                 ?>
                                                 0.00
                                                 <?php } ?></td>
                                       <td style="font-size:12px;border: none;" class="c">
                                           <?php if (@$payisnulls->rem_debt == TRUE || @$payisnulls->rem_debt == '0') {
                             ?>
                            <?php echo @$payisnulls->rem_debt ?>
                        <?php }else{ ?>
                            -
                            <?php } ?>
                                       </td>
    
  </tr>
 <?php endforeach; ?>
 
</table>

  </div>

</div>

</body>
</html>




