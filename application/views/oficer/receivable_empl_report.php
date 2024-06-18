
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
<p style="font-size:12px;text-align:center;" class="c"><b><?php echo $loan_type; ?> Loan</b> /<?php echo $employee->empl_name; ?></p>

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



                                    <?php if ($loan_type == 'group') {
                                 ?>

                                <table>
                                    <thead>
                                        <tr>
                                        <th style="font-size: 12px;">Group Name</th>
                                        <th style="font-size: 12px;">Customer Name</th>
                                        <th style="font-size: 12px;">Phone Number</th>
                                        <th style="font-size: 12px;">Loan Amount</th>
                                        <th style="font-size: 12px;">Duration Type</th>
                                        <th style="font-size: 12px;">Receivable Amount</th>
                                        <th style="font-size: 12px;">Date</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                       <?php $no = 1 ?>        
                                <?php foreach($group_data as $group_datas): ?>
                                        <tr>
                                    <td class="c" style="font-size: 12px;"><b><?php echo $group_datas->group_name; ?></b></td>
                                    <td><?php //echo $loan_pending_new->f_name; ?> <?php //echo $loan_pending_new->m_name; ?> <?php //echo $loan_pending_new->l_name; ?></td>
                                   <!--  <td><?php //echo $loan_aproveds->blanch_name; ?></td> -->
                                    <td><?php //echo $loan_pending_new->phone_no; ?></td>
                                    <td><?php //echo number_format($loan_pending_new->loan_int) ?></td>
                                    <td>
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
                                    <td><?php //echo number_format($loan_pending_new->restration); ?></td>
                                       <td>
                                 <?php //echo $loan_pending_new->date_show; ?>
                                    </td>
                    
                                 </tr>

                             <?php $loan_group = $this->queries->get_group_loan_receivable($group_datas->group_id,$group_datas->empl_id);
                             //        echo "<pre>";
                             // print_r($loan_group);
                             //        exit();

                              ?>

                                  <?php foreach ($loan_group as $loan_groups): ?>
                                   <tr>
                                    <td><?php //echo $no++; ?></td>
                                    <td style="font-size:12px;"><?php echo $loan_groups->f_name; ?> <?php echo $loan_groups->m_name; ?> <?php echo $loan_groups->l_name; ?></td>
                                   <!--  <td><?php //echo $loan_aproveds->blanch_name; ?></td> -->
                                    <td style="font-size:12px;"><?php echo $loan_groups->phone_no; ?></td>
                                    <td style="font-size:12px;"><?php echo number_format($loan_groups->loan_int) ?></td>
                                    <td style="font-size:12px;">
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
                                    <td style="font-size:12px;"><?php echo number_format($loan_groups->restration); ?></td>
                                       <td style="font-size:12px;">
                                        
                                 <?php echo $loan_groups->date_show; ?>
                                    </td>
                    
                                 </tr>
                                 <?php endforeach; ?>
                            <?php $total_group = $this->queries->get_group_loan_receivable_sum($group_datas->group_id,$group_datas->empl_id) ?>
                            <?php foreach ($total_group as $total_groups): ?>
                                 <tr>
                                     <td></td>
                                     <td><b>Total Group:</b></td>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td><?php echo number_format($total_groups->total_restration_group); ?></td>
                                     <td></td>
                                 </tr>
                            <?php endforeach; ?>
                            <?php endforeach; ?>
                                    </tbody>
                                     <tr>
                                    <td><b>TOTAL:</b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b><?php echo number_format($rejesho->total_rejesho); ?></b></td>
                                    <td></td>
                                    </tr>
                                </table>

                             <?php }elseif ($loan_type == 'individual') {
                              ?>
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                        <th style="font-size:12px;border: none;">S/no.</th>
                                        <th style="font-size:12px;border: none;">Branch</th>
                                        <th style="font-size:12px;border: none;">Customer Name</th>
                                        <th style="font-size:12px;border: none;">Phone Number</th>
                                        <th style="font-size:12px;border: none;">Loan Amount</th>
                                        <th style="font-size:12px;border: none;">Duration Type</th>
                                        <th style="font-size:12px;border: none;">Receivable Amount</th>
                                        <th style="font-size:12px;border: none;">Date</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                       <?php $no = 1 ?>        
                                <?php foreach($today_receivable as $loan_pending_new): ?>
                                        <tr>
                                    <td style="font-size:12px; border: none;"><?php echo $no++; ?>.</td>
                                    <td class="c" style="font-size:12px; border: none;"><?php echo $loan_pending_new->blanch_name; ?></td>
                                    <td style="font-size:12px; border: none;"><?php echo $loan_pending_new->f_name; ?> <?php echo $loan_pending_new->m_name; ?> <?php echo $loan_pending_new->l_name; ?></td>
                                   <!--  <td><?php //echo $loan_aproveds->blanch_name; ?></td> -->
                                    <td style="font-size:12px; border: none;"><?php echo $loan_pending_new->phone_no; ?></td>
                                    <td style="font-size:12px; border: none;"><?php echo number_format($loan_pending_new->loan_int) ?></td>
                                    <td style="font-size:12px; border: none;">
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
                                    <td style="font-size:12px; border: none;"><?php echo number_format($loan_pending_new->restration); ?></td>
                                   
                                  
                                
                                       <td style="font-size:12px; border: none;">
                                 <?php echo $loan_pending_new->date_show; ?>
                                    </td>
                    
                                 </tr>

                            <?php endforeach; ?>
                                    </tbody>
                                     <tr>
                                    <td style="font-size:12px; border:none;"><b>TOTAL:</b></td>
                                    <td style="font-size:12px; border:none;"></td>
                                    <td style="font-size:12px; border:none;"></td>
                                    <td style="font-size:12px; border:none;"></td>
                                    <td style="font-size:12px; border:none;"></td>
                                    <td style="font-size:12px; border:none;"></td>
                                    <td style="font-size:12px; border:none;"><b><?php echo number_format($rejesho->total_rejesho); ?></b></td>
                                    <td style="font-size:12px; border:none;"></td>
                                    </tr>
                                </table>
                                
                                <?php } ?>
</div>

</div>

</body>
</html>


