
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $compdata->comp_name; ?> | NEXT EXPECTATION REPORT </title>
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
<p style="font-size:12px;text-align:center;" class="c"><?php if ($branch_data == FALSE) {
         ?>
         ALL BRANCH
        <?php }else{ ?>
        <?php echo $branch_data->blanch_name ?>
           <?php } ?> - NEXT EXPECTATION RECEIVABLE / FROM:<?php echo $from; ?> TO:<?php echo $to; ?></p>

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
  padding: 2px;
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
                       <th><b>Customer Name</b></th>
                    <!-- <th><b>Branch Name</b></th> -->
                    <th><b>Phone Number</b></th>
                    <th><b>Duration Type</b></th>
                    <th><b>Loan Amount</b></th>
                    <th><b>Receivable Amount</b></th>
                    <th><b>Employee</b></th>
                    <th><b>Date</b></th>  
                               </tr>
                              </thead>
      
                    <tbody>
                                        
                  <?php foreach($data_expected as $today_recevables): ?>
                            <tr>
                    <td><?php echo $today_recevables->f_name; ?> <?php echo $today_recevables->m_name; ?> <?php echo $today_recevables->l_name; ?></td>
                  <!--   <td><?php //echo $today_recevables->blanch_name; ?></td> -->
                    <td><?php echo $today_recevables->phone_no; ?></td>
                    
                    <td><?php if ($today_recevables->day == 1) {
                           echo "Daily";
                         ?>
                        <?php }elseif($today_recevables->day == 7){
                                                  echo "Weekly";
                         ?>
                        
                      <?php }elseif($today_recevables->day == 30 || $today_recevables->day == 31 || $today_recevables->day == 28 || $today_recevables->day == 29){
                              echo "Monthly"; 
                        ?>
                        <?php } ?></td>
                    <td><?php echo number_format($today_recevables->loan_int); ?></td>
                    <td><?php echo number_format($today_recevables->restration); ?></td>
                    <td><?php echo $today_recevables->empl_name; ?></td>
                    <td>
                     <?php echo $today_recevables->date_show; ?>      
                    </td>
                                                
                                   </tr>

                       <?php endforeach; ?>
                  
                  </tbody>
                  <tfoot>
                    <tr>
                    <th><b>TOTAL</b></th>
                   <!--  <th><b></b></th> -->
                    <th><b></b></th>
                    <th><b></b></th>
                    <th><b></b></th>
                    <th><b><?php echo number_format($sum_expectation->total_expectation); ?></b></th>
                    <th><b></b></th>
                    <th><b></b></th>
                    
                  
                    </tr>
                   </tfoot>
                   </table>

  </div>

</div>

</body>
</html>




