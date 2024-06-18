<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}



#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;

  .data {
      float: left; /* Align data to the left */
      
    }
    .company {
      text-align: center; /* Center-align text in company div */
      margin: 0 auto; /* Centering using margin auto trick */
      width: fit-content; /* Adjust width to fit content */
      margin-top: 20px; /* Adding some margin for better spacing */
    }

  
}
</style>
</head>
<body>
<div style="width: 20%;">
<img src="<?php echo base_url().'assets/img/'.$compdata->comp_logo ?>" style="width: 100px;height: 80px;">
</div> 

<div class="data">
<span><?= $compdata->comp_name; ?></span>
<br>
<span><?= $compdata->comp_phone; ?></span>
<br>
<span><?= $compdata->adress; ?></span>

</div>

<div class="company">
   
    <strong>Jina La Mteja:</strong> <?= $customer_data->f_name ?> <?= $customer_data->m_name ?> <?= $customer_data->l_name ?>
    
    <strong>Namba Ya Simu:</strong> <?= $customer_data->phone_no ?>
       <br>
    <strong>Kiasi cha Mkopo:</strong> <?= $customer_data->loan_aprove ?>
    <strong>Rejesho:</strong> <?= $customer_data->restration ?>
    <strong>Tarehe ya Mkopo Kupitishwa:</strong> <?= $customer_data->disburse_day ?>
</div>

<table id="customers">
  <tr>
    <th>S/no</th>
    <th>Tarehe ya kurejesha</th>
    <th>Rejesho la Mkopo</th>
   
    <th>Sahihi ya Msimamizi</th>

  </tr>
  <?php 
    $total = 0;
    $j = 0;
    $start_date = new DateTime($loan->loan_stat_date);
    if($loan->day == 30): 
      for($i = 29; $i <= $total_days; $i += (int)$loan->day):
        $loan_start_date = clone $start_date;
        $total += $loan->restration;
  ?>
        <tr>
          <td ><?= ++$j ?></td>
          <td><?= $loan_start_date->modify("+$i days")->format('d-m-Y') ?></td>
          <td><?= number_format($loan->restration ?? 0) ?></td>
          <td></td>
          
        </tr>
  <?php 
      endfor;
    elseif($loan->day == 7): 
      for($i = 6; $i <= $total_days; $i += (int) $loan->day):
        $loan_start_date = clone $start_date;
        $total += $loan->restration;
  ?>
        <tr>
          <td><?= ++$j ?></td>
          <td><?= $loan_start_date->modify("+$i days")->format('d-m-Y') ?></td>
          <td><?= number_format($loan->restration ?? 0) ?></td>
          
          <td></td>
        </tr>
  <?php 
      endfor;
    else: 
      for($i = 1; $i <= $total_days; $i += (int) $loan->day):
        $loan_start_date = clone $start_date;
        $total += $loan->restration;
  ?>
        <tr>
          <td><?= ++$j ?> </td>
          <td><?= $loan_start_date->modify("+$i days")->format('d-m-Y') ?></td>
          <td><?= number_format($loan->restration ?? 0) ?></td>
          
          <td></td>
        </tr>
  <?php 
      endfor;
    endif;
  ?>
</table>
<br>
Mimi ....................................................................................Tarehe .................................... Ninathibitisha kwamba kiasi cha tsh(tarakimu).................................................................. Kwa maneno ...................................................................................nimepokea kama mkopo kampuni ya <?= $compdata->comp_name; ?> <?= $compdata->adress; ?> <?= $customer_data->blanch_name ?>
 Ninakubali muongozo wa Ratiba ya kurejesha(Loan schedule) wa kufuata na kuhakikisha kufanya marejesho ya mkopo kila inapofika siku ya kurejesha bila kusumbua

SAHIHI YA MKOPAJI .......................................................... SAHIHI YA MSIMAMIZI.....................


</body>
</html>
