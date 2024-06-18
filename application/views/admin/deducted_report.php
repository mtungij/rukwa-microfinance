
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $compdata->comp_name; ?> |DEDUCTED INCOME REPORT</title>
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
<?php //$day = date("d-m-Y"); ?>
</p>
<p style="font-size:12px;text-align:center;" class="c"><b>
    <?php if (@$blanch_data->blanch_name == FALSE) {
     ?>
     ALL BRANCH
 <?php }else{ ?>
    <?php echo @$blanch_data->blanch_name; ?> 
    <?php } ?>
    
    - DEDUCTED INCOME REPORT / From : <?php echo $from; ?> To : <?php echo $to; ?></b></p>

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
                                    <thead class="thead-primary">
                                        <tr>    <th>Branch Name</th>
                                                <th>Customer Name</th>
                                                <th>Loan Amount</th>
                                                <th>Income Amount</th>
                                                <th>User</th>
                                                <th>Date</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                              <?php $no = 1; ?>
                                    <?php foreach ($data_deducted as $detail_incomes): ?>
                                              <tr>
                                    <td><?php echo $detail_incomes->blanch_name; ?></td>
                                    <td><?php //echo $detail_incomes->f_name; ?> <?php //echo $detail_incomes->m_name; ?> <?php //echo $detail_incomes->l_name; ?></td>
                                    
                                    <td><?php //echo number_format($detail_incomes->loan_aprove); ?></td>
                                    <td><?php //echo number_format($detail_incomes->deducted_balance); ?></td>
                                    <td></td>
                                    <td><?php //echo $detail_incomes->deducted_date; ?></td>                                                           
                                    </tr>
                             <?php $customer_filter = $this->queries->get_deducted_incomeFilter_blanch($from,$to,$detail_incomes->blanch_id); ?>
                              
                             <?php foreach ($customer_filter as $customer_filters): ?>
                                     <tr>
                                    <td><?php //echo $detail_incomes->blanch_name; ?></td>
                                    <td><?php echo $customer_filters->f_name; ?> <?php echo $customer_filters->m_name; ?> <?php echo $customer_filters->l_name; ?></td>
                                    
                                    <td><?php echo number_format($customer_filters->loan_aprove); ?></td>
                                    <td><?php echo number_format($customer_filters->deducted_balance); ?></td>
                                    <td>System Deducted</td>
                                    <td><?php echo $customer_filters->deducted_date; ?></td>                                                           
                                    </tr>
                                <?php endforeach; ?>
                             <?php $total_deducted = $this->queries->get_total_blanch_deducted($from,$to,$detail_incomes->blanch_id) ?>
                             <?php foreach ($total_deducted as $total_deducteds): ?>
                                <tr>
                                    <td>TOTAL BRANCH:</td>
                                    <td><?php //echo $customer_filters->f_name; ?> <?php //echo $customer_filters->m_name; ?> <?php //echo $customer_filters->l_name; ?></td>
                                    
                                    <td><?php //echo number_format($customer_filters->loan_aprove); ?></td>
                                    <td><b><?php echo number_format($total_deducteds->total_deducted); ?></b></td>
                                    <td></td>
                                    <td><?php //echo $customer_filters->deducted_date; ?></td>                                                           
                                    </tr>
                                     <?php endforeach; ?>
                                     <?php endforeach; ?>

                                         <tr>
                                             <td><b>TOTAL:</b></td>
                                             <td></td>
                                             <td></td>
                                             <td><b><?php echo number_format($total_deducted_data->total_deducted_comps); ?></b></td>
                                             <td></td>
                                             <td></td>
                                         </tr>
                                    </tbody>
                                </table>
</div>

</div>

</body>
</html>


