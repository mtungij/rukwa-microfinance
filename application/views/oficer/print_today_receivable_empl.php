
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $compdata->comp_name; ?> | TODAY RECEIVABLE REPORT</title>
</head>
<body>

<div id="container">
<div style='width: 100%;align-items: center; display: flex;justify-content:space-between;flex-direction: row;'>
</div>
<style>
.pull{
text-align: center;
/*  margin-top: 100px;
margin-bottom: 0px;
margin-right: 150px;
margin-left: 80px;*/

}
</style>
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
<p style="font-size:14px;" class="c"> <b><?php echo $compdata->comp_name; ?></b><br>
<b><?php echo $compdata->adress; ?></b> <br>
<?php $day = date("d-m-Y"); ?>
</p>
<p style="font-size:12px;text-align:center;" class="c"><b><?php //echo $blanch->blanch_name; ?>TODAY RECEIVABLE REPORT / <?php echo $day; ?></b></p>
<p style="font-size:12px;text-align:center;" class="c"><b></b></p>

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
                                        <th style="font-size: 12px;">Employee</th>
                                        <th style="font-size: 12px;">S/no.</th>
                                        <th style="font-size: 12px;">Branch</th>
                                        <th style="font-size: 12px;">Customer Name</th>
                                        <th style="font-size: 12px;">Phone Number</th>
                                        <th style="font-size: 12px;">Loan Amount</th>
                                        <th style="font-size: 12px;">Duration Type</th>
                                        <th style="font-size: 12px;">Receivable Amount</th>
                                        <th style="font-size: 12px;">Date</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                       <?php //$no = 1 ?>        
                                <?php foreach($empl_receivable as $empl_receivables): ?>
                                        <tr>
                                    <td style="font-size:12px;"><b><?php echo $empl_receivables->empl_name; ?></b></td>
                                    <td style="font-size:12px;"><?php //echo $no++; ?></td>
                                    <td class="c" style="font-size:12px;"><?php //echo $loan_pending_new->blanch_name; ?></td>
                                    <td style="font-size:12px;"><?php //echo $loan_pending_new->f_name; ?> <?php //echo $loan_pending_new->m_name; ?> <?php //echo $loan_pending_new->l_name; ?></td>
                                   <!--  <td><?php //echo $loan_aproveds->blanch_name; ?></td> -->
                                    <td style="font-size:12px;"><?php //echo $loan_pending_new->phone_no; ?></td>
                                    <td style="font-size:12px;"><?php //echo number_format($loan_pending_new->loan_int) ?></td>
                                    <td style="font-size:12px;">
                                        <?php //if ($loan_pending_new->day == 1) {
                                                 //echo "Daily";
                                             ?>
                                            <?php //}elseif($loan_pending_new->day == 7){
                                                  //echo "Weekly";
                                             ?>
                                            
                                        <?php //}elseif($loan_pending_new->day == 30 || $loan_pending_new->day == 31 || $loan_pending_new->day == 29 || $loan_pending_new->day == 28){
                                                //echo "Monthly"; 
                                            ?>
                                            <?php //} ?>
                                    </td>
                                    <td style="font-size:12px;"><?php //echo number_format($loan_pending_new->restration); ?></td>
                                   
                                  
                                    
                                       <td style="font-size:12px;">
                                 <?php //echo $loan_pending_new->date_show; ?>
                                    </td>
                    
                                 </tr>

                                   
                            <?php $today_recevable = $this->queries->get_today_recevable_loan($empl_receivables->empl_id); ?>
                                      <?php $no = 1; ?>
                                  <?php foreach ($today_recevable as $loan_pending_new): ?>
                                    <tr>
                                    <td style="font-size:12px;"><?php //echo $no++; ?></td>
                                    <td style="font-size:12px;"><?php echo $no++; ?>.</td>
                                    <td class="c" style="font-size:12px;"><?php echo $loan_pending_new->blanch_name; ?></td>
                                    <td style="font-size:12px;"><?php echo $loan_pending_new->f_name; ?> <?php echo $loan_pending_new->m_name; ?> <?php echo $loan_pending_new->l_name; ?></td>
                                   <!--  <td><?php //echo $loan_aproveds->blanch_name; ?></td> -->
                                    <td style="font-size:12px;"><?php echo $loan_pending_new->phone_no; ?></td>
                                    <td style="font-size:12px;"><?php echo number_format($loan_pending_new->loan_int) ?></td>
                                    <td style="font-size:12px;">
                                        <?php if ($loan_pending_new->day == 1) {
                                                 echo "Daily";
                                             ?>
                                            <?php }elseif($loan_pending_new->day == 7){
                                                  echo "Weekly";
                                             ?>
                                            
                                        <?php }elseif($loan_pending_new->day == 30 || $loan_pending_new->day == 31 || $loan_pending_new->day == 29 || $loan_pending_new->day == 28){
                                                echo "Monthly"; 
                                            ?>
                                            <?php } ?>
                                    </td>
                                    <td style="font-size:12px;"><?php echo number_format($loan_pending_new->restration); ?></td>
                                   
                                  
                                   
                                       <td style="font-size:12px;">
                                 <?php echo $loan_pending_new->date_show; ?>
                                    </td>
                    
                                 </tr>
                                 <?php endforeach; ?>
                                        <?php $total_empl = $this->queries->get_total_recevable_employee($empl_receivables->empl_id) ?>
                              <?php foreach ($total_empl as $total_empls): ?>
                                 <tr>
                                     <td style="font-size:13px;"></td>
                                     <td style="font-size:13px;">Employee Total:</td>
                                     <td style="font-size:13px;"></td>
                                     <td style="font-size:13px;"></td>
                                     <td style="font-size:13px;"></td>
                                     <td style="font-size:13px;"></td>
                                     <td style="font-size:13px;"></td>
                                     <td style="font-size:13px;"><b><?php echo number_format($total_empls->total_rejesho_empl); ?></b></td>
                                     <td></td>
                                 </tr>
                                 <?php endforeach; ?>

                            <?php endforeach; ?>
                                    </tbody>
                                     <tr>
                                    <td><b>GENERAL TOTAL:</b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b><?php echo number_format($rejesho->total_rejesho); ?></b></td>
                                    <td></td>
                                    </tr>
                                </table>
</div>

</div>

</body>
</html>


