<?php include('incs/header.php'); ?>
<?php include('incs/nav.php'); ?>
<?php include('incs/side.php'); ?>

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url("oficer/index"); ?>"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">Report</li>
                            <li class="breadcrumb-item active">Today Receivable</li>
                        </ul>
                    </div>            
                 
                </div>
            </div>
                  <?php if ($das = $this->session->flashdata('massage')): ?> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="alert alert-dismisible alert-success"> <a href="" class="close">&times;</a> 
                                    <?php echo $das;?> </div> 
                            </div> 
                        </div> 
                    <?php endif; ?>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                         <div class="header">
                            <h2>Today Receivable / <?php echo $blanch_data->blanch_name; ?> / <?php echo $employee->empl_name; ?> / <?php echo $loan_type ?></h2>
                            <div class="pull-right">
                              <a href="" data-toggle="modal" data-target="#addcontact2" class="btn btn-primary btn-sm"><i class="icon-calendar">Filter</i></a>
                              <a href="<?php echo base_url("oficer/print_receivable_group/{$blanch_id}/{$empl_id}/{$loan_type}") ?>" class="btn btn-sm btn-primary" target="_blank"><i class="icon-printer"></i></a>
                            </div>    
                         </div>
                          <div class="body">

                            <div class="table-responsive">
                                <?php if ($loan_type == 'group') {
                                 ?>

                          <table class="table table-hover j-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                        <th>Group Name</th>
                                        <th>Customer Name</th>
                                        <th>Phone Number</th>
                                        <th>Loan Amount</th>
                                        <th>Duration Type</th>
                                        <th>Receivable Amount</th>
                                        <th>Date</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                       <?php $no = 1 ?>        
                                <?php foreach($group_data as $group_datas): ?>
                                        <tr>
                                    <td class="c"><b><?php echo $group_datas->group_name; ?></b></td>
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
                                    <td><?php echo $loan_groups->f_name; ?> <?php echo $loan_groups->m_name; ?> <?php echo $loan_groups->l_name; ?></td>
                                   <!--  <td><?php //echo $loan_aproveds->blanch_name; ?></td> -->
                                    <td><?php echo $loan_groups->phone_no; ?></td>
                                    <td><?php echo number_format($loan_groups->loan_int) ?></td>
                                    <td>
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
                                    <td><?php echo number_format($loan_groups->restration); ?></td>
                                       <td>
                                        
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
                                        <th>S/no.</th>
                                        <th>Branch</th>
                                        <th>Customer Name</th>
                                        <th>Phone Number</th>
                                        <th>Loan Amount</th>
                                        <th>Duration Type</th>
                                        <th>Receivable Amount</th>
                                        <th>Date</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                       <?php $no = 1 ?>        
                                <?php foreach($today_receivable as $loan_pending_new): ?>
                                        <tr>
                                    <td><?php echo $no++; ?>.</td>
                                    <td class="c"><?php echo $loan_pending_new->blanch_name; ?></td>
                                    <td><?php echo $loan_pending_new->f_name; ?> <?php echo $loan_pending_new->m_name; ?> <?php echo $loan_pending_new->l_name; ?></td>
                                   <!--  <td><?php //echo $loan_aproveds->blanch_name; ?></td> -->
                                    <td><?php echo $loan_pending_new->phone_no; ?></td>
                                    <td><?php echo number_format($loan_pending_new->loan_int) ?></td>
                                    <td>
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
                                    <td><?php echo number_format($loan_pending_new->restration); ?></td>
                                   
                                  
                                
                                       <td>
                                 <?php echo $loan_pending_new->date_show; ?>
                                    </td>
                    
                                 </tr>

                            <?php endforeach; ?>
                                    </tbody>
                                     <tr>
                                    <td><b>TOTAL:</b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b><?php echo number_format($rejesho->total_rejesho); ?></b></td>
                                    <td></td>
                                    </tr>
                                </table>
                                
                                <?php } ?>




                            </div>
                        </div>

                    </div>
                </div> 


             
            </div>
        </div>
    </div>
</div>

<?php include('incs/footer.php'); ?>


<div class="modal fade" id="addcontact2" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Filter by</h6>
            </div>
            <?php echo form_open("oficer/filter_loan_receivable"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    
                    <div class="col-md-6 col-6">
                    <span>Select Employee</span>
                    <select type="number" class="form-control" name="empl_id" id="empl" required>
                        <option value="">--Select Employee--</option>
                        <?php foreach ($empl_receivable as $employees): ?>
                        <option value="<?php echo $employees->empl_id; ?>"><?php echo $employees->empl_name; ?></option>
                        <?php endforeach; ?>
                    </select>           
                    </div>
                    <div class="col-md-6 col-6">
                    <span>Select Loan Type</span>
                    <select type="number" class="form-control" name="loan_type" required>
                        <option value="">--Select Loan Type--</option>
                        <option value="group" class="c">Group Loan</option>
                        <option value="individual" class="c">Individual Loan</option>
                    </select>           
                    </div>
                    <input type="hidden" name="blanch_id" value="<?php echo $empl_data->blanch_id; ?>">
            </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Filter</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>


<script>
$(document).ready(function(){
$('#blanch').change(function(){
var blanch_id = $('#blanch').val();
//alert(blanch_id)
if(blanch_id != ''){

$.ajax({
url:"<?php echo base_url(); ?>admin/fetch_employee_blanch",
method:"POST",
data:{blanch_id:blanch_id},
success:function(data)
{
$('#empl').html(data);
//$('#district').html('<option value="">All</option>');
}
});
}
else
{
$('#empl').html('<option value="">Select Employee</option>');
//$('#district').html('<option value="">All</option>');
}
});



// $('#customer').change(function(){
// var customer_id = $('#customer').val();
//  //alert(customer_id)
// if(customer_id != '')
// {
// $.ajax({
// url:"<?php echo base_url(); ?>admin/fetch_data_vipimioData",
// method:"POST",
// data:{customer_id:customer_id},
// success:function(data)
// {
// $('#loan').html(data);
// //$('#malipo_name').html('<option value="">select center</option>');
// }
// });
// }
// else
// {
// $('#loan').html('<option value="">Select Active loan</option>');
// //$('#malipo_name').html('<option value="">chagua vipimio</option>');
// }
// });

// $('#social').change(function(){
//  var district_id = $('#social').val();
//  if(district_id != '')
//  {
//   $.ajax({
//    url:"<?php echo base_url(); ?>user/fetch_data_malipo",
//    method:"POST",
//    data:{district_id:district_id},
//    success:function(data)
//    {
//     $('#malipo_name').html(data);
//     //$('#malipo').html('<option value="">chagua malipo</option>');
//    }
//   });
//  }
//  else
//  {
//   //$('#vipimio').html('<option value="">chagua vipimio</option>');
//   $('#malipo_name').html('<option value="">chagua vipimio</option>');
//  }
// });


});
</script>





