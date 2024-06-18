
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $compdata->comp_name; ?> |LOAN WITHDRAWAL CATEGORY
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
<?php //$day = date("d-m-Y"); ?>
</p>
<p style="font-size:12px;text-align:center;" class="c"><?php echo $blanch_data->blanch_name ?> / LOAN WITHDRAWAL </p>
<p style="font-size:12px;text-align:center;" class="c">Loan Category: 
  <?php if (@$category_data->category_id == TRUE) {
  ?>
  <?php echo @$category_data->loan_name; ?>
<?php  }else{ ?>
  all Category
  <?php } ?>
  
    
  </p>
</div>
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
  background-color: ;
}

</style>
</head>
<body>
 <hr>


<table>
  <thead>  
    <tr>
    <th style="font-size:12px;border: none;">S/No.</th>
     <th style="font-size:12px;border: none;">Customer Name</th>
     <th style="font-size:12px;border: none;">Phone Number</th>
    <th style="font-size:12px;border: none;">Loan Ac</th>
    <th style="font-size:12px;border: none;">Loan product</th>
    <th style="font-size:12px;border: none;">Loan Withdrawal</th>
    <th style="font-size:12px;border: none;">Principal + Interest</th>
    <th style="font-size:12px;border: none;">Method</th>
    <th style="font-size:12px;border: none;">Duration Type </th>
    <th style="font-size:12px;border: none;">Number Of Repayment</th>
    <th style="font-size:12px;border: none;">Restoration</th>
   <!--  <th style="font-size:12px;border: none;">Restoration Instalment</th> -->
    <th style="font-size:12px;border: none;">Withdrawal Date</th>
    <th style="font-size:12px;border: none;">End Date</th>
  </tr>
  </thead>

   <?php $no = 1; ?>
  <?php foreach ($data_loan as $loan_withdrawals): ?>
 <tr>
    <td style="font-size:12px;border: none;" class="c"><?php echo $no++; ?>.</td>
    <td style="font-size:12px;border: none;" class="c"><?php echo $loan_withdrawals->f_name; ?> <?php echo $loan_withdrawals->m_name; ?> <?php echo $loan_withdrawals->l_name; ?></td>
     <td style="font-size:12px;border: none;" class="c"><?php echo $loan_withdrawals->phone_no; ?></td>
    <td style="font-size:12px;border: none;" class="c">
      <?php echo $loan_withdrawals->loan_code; ?> 
      </td>
      <td style="font-size:12px;border: none;" class="c">
      <?php echo $loan_withdrawals->loan_name; ?> 
      </td>
    <td style="font-size:12px;border: none;" class="c"><?php echo number_format($loan_withdrawals->loan_aprove); ?></td>
    <td style="font-size:12px;border: none;" class="c"><?php echo number_format($loan_withdrawals->loan_int); ?></td>

    <td style="font-size:12px;border: none;"><?php echo $loan_withdrawals->account_name; ?></td>
    <td style="font-size:12px;border: none;">
      <?php if ($loan_withdrawals->day == 1) {
                           echo "Daily";
                         ?>
                        <?php }elseif($loan_withdrawals->day == 7){
                                                  echo "Weekly";
                         ?>
                        
                      <?php }elseif($loan_withdrawals->day == 30 || $loan_withdrawals->day == 31 || $loan_withdrawals->day == 29 || $loan_withdrawals->day == 28){
                              echo "Monthly"; 
                        ?>
                        <?php } ?>
    </td>
    <td style="font-size:12px;border: none;"><?php echo $loan_withdrawals->session; ?></td>
    <td style="font-size:12px;border: none;"><?php echo number_format($loan_withdrawals->restration); ?></td>
    <!-- <td style="font-size:12px;border: none;"><?php //echo $loan_withdrawals->renew_loan; ?></td> -->
    <td style="font-size:12px;border: none;"><?php echo substr($loan_withdrawals->loan_stat_date, 0,10); ?></td>
    <td style="font-size:12px;border: none;"><?php echo substr($loan_withdrawals->loan_end_date, 0,10); ?></td>
  </tr>
 <?php endforeach; ?>
 <tr>
    
    <td style="font-size:12px;border: none;" class="c"><?php //echo $customers->customer_code; ?></td>
    <td style="font-size:13px;border: none;" class="c"><b>TOTAL</b></td>
    <td style="font-size:12px;border: none;" class="c">
       
      </td>
      <td style="font-size:12px;border: none;" class="c">
       
      </td>
       <td style="font-size:12px;border: none;" class="c">
       
      </td>

    <td style="font-size:12px;border: none;" class="c"><b><?php echo number_format($sum_loan->total_principal); ?></b></td>
   <!--  <td style="font-size:12px;border: none;"><?php //echo $customers->date_birth; ?></td> -->
    <td style="font-size:12px;border: none;"><b><?php echo number_format($sum_loan->total_loan_interest); ?></b></td>
    <td style="font-size:12px;border: none;"><?php //echo $customers->blanch_name; ?></td>
    <td style="font-size:12px;border: none;"><?php //echo $customers->region_name; ?></td>
    <td style="font-size:12px;border: none;"><?php //echo $customers->district; ?></td>
    <td style="font-size:12px;border: none;"><?php //echo $customers->ward; ?></td>
    <td style="font-size:12px;border: none;"><?php //echo $customers->ward; ?></td>
  </tr>

</table>

  </div>

</div>

</body>
</html>




