<?php include('incs/header.php'); ?>
<?php include('incs/nav.php'); ?>
<?php include('incs/side.php'); ?>

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">

                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h7><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo $manager_data->comp_name; ?> - <?php echo $manager_data->blanch_name; ?> </h7>

                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url("oficer/index"); ?>"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active"><?php echo $this->lang->line("home_menu"); ?></li>                            
                            <li class="breadcrumb-item active"><?php echo $this->lang->line("dashboard_menu"); ?></li>  

                        </ul>
                    </div>
                    <?php $blanch_id = $this->session->userdata('blanch_id'); ?>
                     <?php $blanch_account = $this->queries->get_Account_balance_blanch_data($blanch_id); ?>
                     <?php //print_r($blanch_account); ?>
                     <?php foreach ($privillage as $privillages): ?>
                     <?php if ($privillages->privillage == 'report') {
                      ?>
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                        <?php foreach ($blanch_account as $blanch_account): ?>
                        <div class="bh_chart hidden-xs">
                            <div class="float-left m-r-15">
                                <small><?php echo $blanch_account->account_name; ?></small>
                                <h6 class="mb-0 mt-1"><i class="icon-wallet"></i><?php echo number_format($blanch_account->blanch_capital); ?></h6>
                            </div>
                            
                        </div>
                       <?php endforeach; ?>
                       
                    </div>
                <?php }else{ ?>
                    <?php } ?>
                     <?php endforeach; ?>
                </div>
            </div>
           <?php if ($das = $this->session->flashdata('massage')): ?> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                                <div class="alert alert-dismisible alert-success"> <a href="" class="close">&times;</a> <?php echo $das;?> </div> 
                            </div> 
                        </div> 
                    <?php endif; ?>
            <div class="row clearfix">
                
                <div class="col-lg-12 col-md-12">
                    <?php foreach ($privillage as $privillages): ?>
                              <?php if ($privillages->privillage == 'report') {
                               ?>
                    <div class="card">
                        <div class="header">
                            <h2><?php echo $this->lang->line("revenue_menu"); ?></h2>
                            <ul class="header-dropdown">
                                <!-- <li><a class="tab_btn" href="javascript:void(0);" title="Weekly">W</a></li>
                                <li><a class="tab_btn" href="javascript:void(0);" title="Monthly">M</a></li>
                                <li><a class="tab_btn active" href="javascript:void(0);" title="Yearly">Y</a></li> -->
                              <!--   <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li> -->
                            </ul>

                        </div>
                        <?php $blanch_id = $this->session->userdata('blanch_id'); ?>
                        <?php 
                        $blanch_capital = $this->queries->get_blanch_capital_blanch($blanch_id);
                        $disburse_loan = $this->queries->get_total_loan_with($blanch_id);
                        $outstand = $this->queries->get_outstand_loanBranch($blanch_id);
                         ?>
                        <?php //print_r($blanch_capital); ?>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <div class="body bg-success text-light">

                                        <h4><i class="icon-wallet"></i><?php echo number_format($blanch_capital->total_blanch_capital); ?></h4>
                                        <span><?php echo $this->lang->line("branch_balance_menu"); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="body bg-info text-light">
                                        <h4><i class="icon-wallet"></i><?php echo number_format($disburse_loan->total_loanAprove); ?></h4>
                                        <span><?php echo $this->lang->line("disburse_loan_menu"); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="body bg-primary text-light">
                                        <h4><i class="icon-wallet"></i><?php echo number_format($disburse_loan->total_loanInt); ?></h4>
                                        <span><?php echo $this->lang->line("expectation_menu"); ?></span>
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <div class="body bg-danger text-light">
                                        <h4><i class="icon-wallet"></i><?php echo number_format($outstand->total_outstand); ?></h4>
                                        <span><?php echo $this->lang->line("outstand_menu"); ?></span>
                                    </div>
                                </div>
                            </div>
                              
                            <!-- <div id="total_revenue" class="ct-chart m-t-20"></div> -->
                        </div>
                    </div>
                     <?php } ?>
                <?php endforeach; ?>
                </div>
            </div>

           <?php foreach ($privillage as $privillages): ?>
            <?php if ($privillages->privillage == 'report') {
             ?>
            <div class="row clearfix w_social3">
                <div class="col-lg-4 col-md-4 col-6">
                    <div class="card facebook-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/walet.png" style="width: 44px; height: 44px;"></div>
                        <?php
                         $deduct_income = $this->queries->get_today_income_deducted($blanch_id);
                         $non_deduct_income = $this->queries->get_today_non_deducted($blanch_id);

                         $deposit_in = $this->queries->get_in_deposit_blanch($blanch_id);
                          //print_r($deposit_in);
                              //exit();
                         $deposit_out = $this->queries->get_out_deposit_blanch($blanch_id);
                         $expenses = $this->queries->get_today_expenses_datablanch($blanch_id);
                          ?>
                        <div class="content">
                            <div class="text" style="color: black;">Today Income</div>
                            <div class="number"><b><?php echo number_format($deduct_income->total_deducted_data + $non_deduct_income->total_nondata); ?></b></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-6">
                    <div class="card instagram-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/walet.png" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black;">Today Deposit</div>
                            <div class="number"><b><?php echo number_format($deposit_in->total_deposit_in  + $deposit_out->total_deposit_out)    ?></b></div>
                        </div>
                    </div>
            </div>

            <div class="col-lg-4 col-md-4 col-12">
                    <div class="card instagram-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/expenses.png" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black;">Today Expenses</div>
                            <div class="number"><b><?php echo number_format($expenses->total_request); ?></b></div>
                        </div>
                    </div>
            </div>
                
            </div>
            <?php } ?>
        <?php endforeach; ?>








           <div class="row clearfix w_social3">
             <?php foreach ($privillage as $privillages): ?>
                   <?php if ($privillages->privillage == 'customer') {
                    ?>
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php echo base_url("oficer/customer"); ?>"><div class="card facebook-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/user.png" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color: black;"><?php echo $this->lang->line("registercustomer_menu") ?></div>
                            <!-- <div class="number">123</div> -->
                        </div>
                    </div></a>
                </div>
            <?php }elseif ($privillages->privillage == 'loan') {
             ?>
             <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php echo base_url("oficer/loan_application"); ?>"><div class="card instagram-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/request.jpg" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black;"><?php echo $this->lang->line("applyloan_menu") ?></div>
                            <!-- <div class="number">231</div> -->
                        </div>
                    </div></a>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php echo base_url("oficer/loan_pending"); ?>">
                        <div class="card facebook-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/aplication.png" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black;"><?php echo $this->lang->line("loanRequest_menu"); ?></div>
                            <!-- <div class="number">123</div> -->
                        </div>
                    </div>
                    </a>
                </div>
                 <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php echo base_url("oficer/disburse_loan"); ?>">
                        <div class="card instagram-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/aproveds.jpg" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black"><?php echo $this->lang->line("loanAproved_menu"); ?></div>
                            <!-- <div class="number">231</div> -->
                        </div>
                    </div>
                </a>
                </div>
                  <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php echo base_url("oficer/loan_rejected"); ?>">
                        <div class="card twitter-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/rejected.jpg" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black;"><?php echo $this->lang->line("rejectedloan_menu") ?></div>
                            <!-- <div class="number">31</div> -->
                        </div>
                    </div>
                    </a>
                </div>
         <?php }elseif ($privillages->privillage == 'teller') {
          ?>
          <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php echo base_url("oficer/teller_dashboard") ?>"><div class="card twitter-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/deposit.jpg" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text"style="color:black;"><?php echo $this->lang->line("deposit_menu"); ?></div>
                            <!-- <div class="number">31</div> -->
                        </div>
                    </div></a>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php echo base_url("oficer/teller_dashboard") ?>"><div class="card google-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/withdrawal.png" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black;"><?php echo $this->lang->line("withdrawal_menu"); ?></div>
                            <!-- <div class="number">254</div> -->
                        </div>
                    </div></a>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php echo base_url("oficer/saving_deposit"); ?>">
                        <div class="card twitter-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/saving.png" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black;"><?php echo $this->lang->line("savingdEPOSIT_menu"); ?></div>
                            <!-- <div class="number">31</div> -->
                        </div>
                    </div>
                    </a>
                </div>
          <?php }elseif ($privillages->privillage == 'report') {
          ?>
          <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php echo base_url("oficer/daily_report"); ?>"><div class="card linkedin-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/daily.png" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black"><?php echo $this->lang->line("Daily_report_menu"); ?></div>
                            <!-- <div class="number">2510</div> -->
                        </div>
                    </div></a>
                </div>
                
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php echo base_url("oficer/cash_transaction"); ?>">
                        <div class="card facebook-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/transaction.png" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black;"><?php echo $this->lang->line("transaction_menu"); ?></div>
                            <!-- <div class="number">123</div> -->
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php echo base_url("oficer/loan_pending_time"); ?>"><div class="card instagram-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/default.jpeg" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black;"><?php echo $this->lang->line("pending_menu") ?></div>
                            <!-- <div class="number">231</div> -->
                        </div>
                    </div></a>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php echo base_url("oficer/get_today_receivable"); ?>">
                        <div class="card twitter-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/receivable.png" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black;"><?php echo $this->lang->line("receivable_menu") ?></div>
                            <!-- <div class="number">31</div> -->
                        </div>
                    </div></a>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php echo base_url("oficer/today_received"); ?>">
                        <div class="card google-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/received.png" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black;"><?php echo $this->lang->line("received_menu"); ?> &nbsp;&nbsp;&nbsp;</div>
                            <!-- <div class="number" style="color:green;">1,000,000,000</div> -->
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php echo base_url("oficer/get_loan_withdrawal_data"); ?>">
                        <div class="card linkedin-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/withdrawal.png" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black;"><?php echo $this->lang->line("loanwithin_contract_menu"); ?></div>
                            <!-- <div class="number">2510</div> -->
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php echo base_url("oficer/oustand_loan"); ?>">
                        <div class="card behance-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/default.jpeg" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black;"><?php echo $this->lang->line("loanDefault_menu"); ?>&nbsp;&nbsp;&nbsp;&nbsp;</div>
                            <!-- <div class="number">121</div> -->
                        </div>
                    </div>
                    </a>
                </div>
         
               
                    <?php }elseif ($privillages->privillage =='expenses') {
                     ?>
                     <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php echo base_url("oficer/expnses_requisition_form"); ?>"><div class="card behance-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/expenses.png" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black"><?php echo $this->lang->line("expenses_menu"); ?></div>
                            <!-- <div class="number">121</div> -->
                        </div>
                    </div></a>
                </div>
                     <?php }elseif ($privillages->privillage =='float') {
                      ?>
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php echo base_url("oficer/transfor_float_branch"); ?>"><div class="card twitter-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/stoo.png" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black">Float</div>
                            <!-- <div class="number">1</div> -->
                        </div>
                    </div></a>
                </div>
                      <?php }elseif ($privillages->privillage =='income') {
                       ?>
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php echo base_url("oficer/income_dashboard"); ?>">
                        <div class="card twitter-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/income.png" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black;"><?php echo $this->lang->line("income_menu") ?></div>
                            <!-- <div class="number">31</div> -->
                        </div>
                    </div>
                    </a>
                </div>
                       <?php } ?>
                <?php endforeach; ?>
            </div>

           
        </div>
    </div>
    
</div>

<?php include('incs/footer.php'); ?>