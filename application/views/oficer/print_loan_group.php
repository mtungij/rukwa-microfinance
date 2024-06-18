
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $compdata->comp_name; ?> | Loan Group Report</title>
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
<p style="font-size:12px;text-align:center;" class="c"><?php //echo $blanch->blanch_name ?>
Loan Group /   <?php echo $group_data->group_name; ?></p>

</div>
</td>
</tr>
</table>

 <hr>    
 
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



<table>
  <tr>
    <th style="font-size:12px;border: none;">S/No.</th>
    <th style="font-size:12px;border: none;">Loan AC/No</th>
    <th style="font-size:12px;border: none;">Customer Name</th>
    <th style="font-size:12px;border: none;">Phone Number</th>
    <th style="font-size:12px;border: none;">Bussines/Job Name</th>
    <th style="font-size:12px;border: none;">Branch</th>
    <th style="font-size:12px;border: none;">Loan Amount</th>
    <th style="font-size:12px;border: none;">Loan Amount + Interest</th>
    <th style="font-size:12px;border: none;">Loan Duration</th>
    <th style="font-size:12px;border: none;">Number Of Repayment</th>
    <th style="font-size:12px;border: none;">Loan Status</th>
  </tr>
  <?php $no = 1; ?>
  <?php foreach ($loan_pending as $data_loan): ?>
 <tr>
  
    <td style="font-size:12px;border: none;" class="c"><?php echo $no++; ?>.</td>
    <td style="font-size:12px;border: none;" class="c">
      <?php echo $data_loan->loan_code; ?>
      </td>
    <td style="font-size:12px;border: none;" class="c">
      <?php echo $data_loan->f_name; ?> <?php echo $data_loan->m_name; ?> <?php echo $data_loan->l_name; ?>
      </td>
    <td style="font-size:12px;border: none;" class="c"><?php echo $data_loan->phone_no; ?></td>
    <td style="font-size:12px;border: none;" class="c"><?php echo $data_loan->bussiness_type; ?></td>
    <td style="font-size:12px;border: none;" class="c"><?php echo $data_loan->blanch_name; ?></td>
    <td style="font-size:12px;border: none;" class="c"><?php echo number_format($data_loan->loan_aprove); ?></td>
    <td style="font-size:12px;border: none;" class="c"><?php echo number_format($data_loan->loan_int); ?></td>
    <td style="font-size:12px;border: none;" class="c">
    <?php if ($data_loan->day == 1) {
				  								 echo "Daily";
				  							 ?>
				  							<?php }elseif($data_loan->day == 7){
                                                  echo "Weekly";
				  							 ?>
				  							
				  						<?php }elseif($data_loan->day == 30 || $data_loan->day == 31 || $data_loan->day == 28 || $data_loan->day == 29){
				  						        echo "Monthly"; 
				  							?>
				  							<?php } ?>
</td>
    <td style="font-size:12px;border: none;" class="c"><?php echo $data_loan->session; ?></td>
    <td style="font-size:12px;border: none;" class="c">
    <?php if ($data_loan->loan_status == 'open') {
				 ?>
				 Pending
				<?php }elseif ($data_loan->loan_status == 'aproved') {
				 ?>
				 Approved
				 <?php }elseif($data_loan->loan_status == 'disbarsed'){
				  ?>
			Disbursed

				  <?php }elseif ($data_loan->loan_status == 'reject') {
				   ?>
				Rejected
				   <?php }elseif ($data_loan->loan_status == 'withdrawal') {
				    ?>
			     Active
					<?php }elseif ($data_loan->loan_status == 'done') {
					 ?>
				       Done
					 <?php  } ?>
</td>
  </tr>
 <?php endforeach; ?>
 <tr>  
     <td style="border:none;">TOTAL</td>
     <td style="border:none;"></td>
     <td style="border:none;"></td>
     <td style="border:none;"></td>
     <td style="border:none;"></td>
     <td style="border:none;"></td>
     <td style="border:none;"><?php echo number_format($total_loan_group->total_loan); ?></td>
     <td style="border:none;"><?php echo number_format($total_loan_group->total_loanint); ?></td>
     <td style="border:none;"></td>
     <td style="border:none;"></td>
     <td style="border:none;"></td>
     <td style="border:none;"></td>
 </tr>
 <tr>  
     <td style="border:none;">PAID</td>
     <td style="border:none;"></td>
     <td style="border:none;"></td>
     <td style="border:none;"></td>
     <td style="border:none;"></td>
     <td style="border:none;"></td>
     <td style="border:none;"><?php //echo number_format($total_loan_group->total_loan); ?></td>
     <td style="border:none;"><?php echo number_format($total_depost_group->total_depost); ?></td>
     <td style="border:none;"></td>
     <td style="border:none;"></td>
     <td style="border:none;"></td>
     <td style="border:none;"></td>
 </tr>

 <tr>  
     <td style="border:none;">REMAIN</td>
     <td style="border:none;"></td>
     <td style="border:none;"></td>
     <td style="border:none;"></td>
     <td style="border:none;"></td>
     <td style="border:none;"></td>
     <td style="border:none;"><?php //echo number_format($total_loan_group->total_loan); ?></td>
     <td style="border:none;"><?php echo number_format($total_loan_group->total_loanint - $total_depost_group->total_depost ); ?></td>
     <td style="border:none;"></td>
     <td style="border:none;"></td>
     <td style="border:none;"></td>
     <td style="border:none;"></td>
 </tr>


</table>
  </div>

</div>

</body>
</html>




