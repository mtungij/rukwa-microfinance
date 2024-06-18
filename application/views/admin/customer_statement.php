<?php include('incs/header.php'); ?>
<?php include('incs/nav.php'); ?>
<?php include('incs/side.php'); ?>

    <div id="main-content" class="profilepage_2 blog-page">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url("admin/index"); ?>"><i class="icon-home"></i></a></li>
                            
                            <li class="breadcrumb-item active">Report</li>
                            <li class="breadcrumb-item active">Customer Account Statement</li>
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
                     <?php if ($das = $this->session->flashdata('error')): ?> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="alert alert-dismisible alert-danger"> <a href="" class="close">&times;</a> 
                                    <?php echo $das;?> </div> 
                            </div> 
                        </div> 
                    <?php endif; ?>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">

                    <div class="card">
                        <div class="row profile_state">
                            <div class="col-lg-6 col-6">
                                <div class="body">
                                   <!--  <i class=""></i> -->
                                     <div class="profile-image"> <img src="<?php echo base_url().'assets/img/male.jpeg'; ?>" class="rounded-circle" alt="customer image" style="width: 135px;height: 135px;">
                                      </div>
                                    <small><?php echo @$customer->f_name; ?> <?php echo @$customer->m_name; ?> <?php echo @$customer->l_name; ?></small>
                                </div>
                            </div>
                            <div class="col-lg-6 col-6">
                                <div class="body">
                                    <!-- <i class=""></i> -->
                                   <div class="profile-image"> <img src="<?php echo base_url().'assets/img/sig.jpg'; ?>" class="rounded-circle" alt="Gualantors image" style="width: 135px;height: 135px;">
                                      </div>
                                    <small>Signature</small>
                                </div>
                            </div>
                           
                            
                        </div>
                    </div>
                </div>

                <style>
                    .sam{
                        display: flex;
                    }
                </style>  
                <div class="col-lg-12">
                    <div class="card">
                          <div class="body">
                     
                            
                            <div class="table-responsive">
                                <table class="table table-hover j-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                        <th>Customer Name</th>
                                        <th>Phone Number</th>
                                        <th>District</th>
                                        <th>Ward</th>
                                        <th>Street</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                
                                      <?php //@$customer_loan = $this->queries->get_loan_active_customer($customer->customer_id);
                                         //@$total_deposit = $this->queries->get_total_amount_paid_loan($customer_loan->loan_id);

                                        // @$out_stand = $this->queries->get_outstand_loan_customer($customer_loan->loan_id);
                                       ?>



                                   <?php //print_r($out_stand); ?>
                                        <tr>
                                            <td><?php echo @$customer->f_name; ?> <?php echo @$customer->m_name; ?> <?php echo @$customer->l_name; ?></td>
                                            <td><?php echo @$customer->phone_no; ?></td> 
                                                
                                            <td><?php echo @$customer->district; ?></td>
                                            <td><?php echo @$customer->ward; ?></td>
                                            <td><?php echo @$customer->street; ?></td>
                                        
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>





                  <div class="col-lg-12">
                    <?php echo form_open("admin/search_acount_statement"); ?>
                            <div class="sam">
                                
                                <select type="number" class="form-control select2" name="customer_id" required>
                                    <option>Search Customer</option>
                                    <?php foreach ($customery as $customer_datas): ?>
                                    <option value="<?php echo $customer_datas->customer_id; ?>"><?php echo $customer_datas->f_name; ?> <?php echo $customer_datas->m_name; ?> <?php echo $customer_datas->l_name; ?> / <?php echo $customer_datas->customer_code; ?> </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit" class="btn btn-primary"><i class="icon-magnifier-add">Search</i></button>
                                
                            </div>
                            <?php echo form_close(); ?>
                    <div class="card">
                          <div class="body">
                             <div class="pull-right">
                             <a href="" class="btn btn-success" data-toggle="modal" data-target="#addcontact1"><i class="icon-pencil">Filter</i></a> 
                             </div>
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Deposit</th>
                                        <th>Withdrawal</th>
                                        <th>Balance</th> 
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                
                                      <?php @$loan_desc = $this->queries->get_total_pay_description_customer($customer->customer_id);
                                      //@$remain_balance = $this->queries->get_total_remain_with($customer_loan->loan_id);
                                      //@$total_recovery = $this->queries->get_total_loan_pend($customer_loan->loan_id);
                                      //@$total_penart =   $this->queries->get_total_penart_loan($customer_loan->loan_id);
                                      //@$total_deposit_penart =  $this->queries->get_total_paypenart($customer_loan->loan_id);
                                      //@$end_deposit = $this->queries->get_end_deposit_time($customer_loan->loan_id);
                                       ?>

                                    <?php //print_r($loan_desc); ?>

                                           <?php foreach ($loan_desc as $payisnulls): ?>
                                            <tr>
                                              <td class="c"><?php echo $payisnulls->date_data; ?></td>
                                              <td class="c">  <?php echo $payisnulls->emply; ?>
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
                                               <?php echo @$payisnulls->description; ?>  <?php echo @$payisnulls->loan_name ; ?>
                                         <?php if(@$payisnulls->day == 1){
                                           echo "Daily";
                                    }elseif(@$payisnulls->day == 7){
                                         echo "Weekly";
                                    }elseif (@$payisnulls->day == 30 || @$payisnulls->day == 31 || @$payisnulls->day == 28 || @$payisnulls->day == 29) {
                                        echo "Monthly";
                                     ?> 
                                    <?php } ?><?php //echo $payisnulls->session; ?>  / AC/No. <?php echo @$payisnulls->loan_code; ?></td>
                                              <td>
                                                <?php if($payisnulls->depost == TRUE){ ?>
                                                <?php echo round(@$payisnulls->depost,2); ?>
                                            <?php }elseif($payisnulls->depost == FALSE){ ?>
                                            0.00
                                                <?php } ?>
                                            </td>
                                              <td>
                                                <?php if (@$payisnulls->withdrow == TRUE) {
                                                 ?>
                                                <?php echo round(@$payisnulls->withdrow,2); ?>
                                                <?php }elseif (@$payisnulls->withdrow == FALSE) {
                                                 ?>
                                                 0.00
                                            <?php } ?>
                                            </td>
                                              <td>
                                                <?php if (@$payisnulls->balance == TRUE) {
                                                 ?>
                                                <?php echo round(@$payisnulls->balance,2); ?>
                                                <?php }elseif (@$payisnulls->balance == FALSE) {
                                                 ?>
                                                 0.00
                                                 <?php } ?>
                                            </td>
                                              </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

                

                </div> 
              </div>
            </div>
   



<?php include('incs/footer.php'); ?>

 <div class="modal fade" id="addcontact1" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h7 class="title" id="defaultModalLabel">Filter customer Account Statement</h7>
            </div>
            <?php echo form_open("admin/filter_customer_statement"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <?php $date = date("Y-m-d"); ?>
                    <div class="col-md-6 col-6">
                    <span>From:</span>
                    <input type="date" class="form-control" value="<?php echo $date; ?>" name="from" required>       
                    </div>
                      <div class="col-md-6 col-6">
                    <span>To:</span>
                    <input type="date" class="form-control" value="<?php echo $date; ?>" name="to" required> 
                    <input type="hidden" name="customer_id" value="<?php echo $customer->customer_id; ?>">      
                    </div>
                   
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



 


 







