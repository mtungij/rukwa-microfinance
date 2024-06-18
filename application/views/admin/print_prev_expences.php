
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $compdata->comp_name; ?> | EXPENSES REPORT</title>
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

<!-- <div class="pull">
<img src="<?php //echo base_url().'assets/img/'.$compdata->comp_logo ?>" style="width: 50px;height: 50px;">
<p style="font-size:14px;" class="c"> <?php //echo $compdata->comp_name; ?><br>
<?php //echo $compdata->adress; ?> <br>
<?php //$day = date("d-m-Y"); ?>
</p>
<p style="font-size:12px;">BRANCH LIST</p>
</div>  -->


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
<?php if ($data_blanch == FALSE) {
 ?>
 <p style="font-size:12px;text-align:center;" class="c">ALL BRANCH -EXPENSES REPORT From: <?php echo $from; ?> To: <?php echo $to; ?></p>
<?php }else{ ?>
<p style="font-size:12px;text-align:center;" class="c"><?php echo $data_blanch->blanch_name ?> -EXPENSES REPORT From: <?php echo $from; ?> To: <?php echo $to; ?></p>
<?php } ?>
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



<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                                         <thead>
                                              <tr>
                                                <th>Branch</th>
                                                <th>Expenses</th>
                                                <th>Amount</th>
                                                <th>Descrption </th>
                                                <!-- <th>Comment</th> -->
                                                <th>From Account Type</th>
                                                <th>Date</th>
                                                <!-- <th>status</th> -->
                                                    
                                                    
                                                 </tr>
                                          </thead>
            
                                    <tbody>
                                          <?php $no = 1; ?>
                                    <?php foreach ($blanch_exp as $blanch_exps): ?>
                                              <tr>
                                     <td><?php echo $blanch_exps->blanch_name; ?></td> 
                                    <td><?php //echo $datas->ex_name; ?></td>
                                    <td><?php //echo number_format($datas->req_amount); ?></td>
                                    <td><?php //echo $datas->req_description; ?></td>
                                    <!--  <td><?php //echo $datas->req_comment; ?></td> -->
                                     <td><?php //echo $datas->account_name; ?></td>
                                     <td><?php //echo $datas->req_date; ?></td>
                                                                                    
                                       </tr>
                                   <?php $data_recod = $this->queries->get_prev_expences($from,$to,$blanch_exps->blanch_id); ?>
                                   <?php foreach ($data_recod as $data_recods): ?>
                                          <tr>
                                     <td><?php //echo $blanch_exps->blanch_name; ?></td> 
                                     <td><?php echo $data_recods->ex_name; ?></td>
                                     <td><?php echo number_format($data_recods->req_amount); ?></td>
                                     <td><?php echo $data_recods->req_description; ?></td>
                                    <!--  <td><?php //echo $datas->req_comment; ?></td> -->
                                     <td><?php echo $data_recods->account_name; ?></td>
                                     <td><?php echo $data_recods->req_date; ?></td>                                         
                                       </tr>
                            <?php endforeach; ?>
                            <?php @$total_blanch = $this->queries->get_total_prevExpences($from,$to,$data_recods->blanch_id); ?>
                            <?php foreach (@$total_blanch as $total_blanchs): ?>
                                   <tr>
                                     <td><?php //echo $blanch_exps->blanch_name; ?><b>BRANCH TOTAL</b></td> 
                                     <td><?php //echo $data_recods->ex_name; ?></td>
                                     <td><b><?php echo number_format($total_blanchs->total_exp); ?></b></td>
                                     <td><?php //echo $data_recods->req_description; ?></td>
                                    <!--  <td><?php //echo $datas->req_comment; ?></td> -->
                                     <td><?php //echo $data_recods->account_name; ?></td>
                                     <td><?php //echo $data_recods->req_date; ?></td>                                           
                                       </tr>
                           <?php endforeach; ?>
                          <?php endforeach; ?>
                                    
                    </tbody>
                    <tfoot>
                    <tr>
                    <th>TOTAL</th> 
                    <th></th>
                    <th><?php echo number_format($total_exp->total_request_comapany); ?></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    </tr>
                   </tfoot>
                   </table>
</div>

</div>

</body>
</html>




