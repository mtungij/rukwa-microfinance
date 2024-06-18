<?php include('incs/header.php'); ?>
<?php include('incs/nav.php'); ?>
<?php include('incs/side.php'); ?>
<?php $comp_id = $this->session->userdata('comp_id'); ?>
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">

                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h7 class="c"><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo $compdata->comp_name; ?> / <?php echo $blanch_datas->blanchNic_name; ?></h7>

                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url("admin/index"); ?>"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active"><?php echo $this->lang->line("dashboard_menu"); ?></li>  

                        </ul>
                    </div>

                    <?php $blanch_account = $this->queries->get_blanch_account_name($blanch_id);
                    //print_r($blanch_account);
                     ?>

                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                        <?php foreach ($blanch_account as $account_capitals): ?>
                        <div class="bh_chart hidden-xs">
                            <div class="float-left m-r-15">
                                <small><?php echo $account_capitals->account_name; ?></small>
                                <h6 class="mb-0 mt-1"><i class="icon-wallet"></i> <?php echo number_format($account_capitals->blanch_capital); ?></h6>
                            </div>
                            
                        </div>
                       <?php endforeach; ?>
                       
                    </div>
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
                    <div class="card">
                        <div class="header">
                            <h2><?php echo $this->lang->line("revenue_menu"); ?></h2>
                            <ul class="header-dropdown">
                                
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle btn btn-primary" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="icon-size-actual"></i>Branches</a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <?php foreach ($blanch as $blanchs):
                                        $blanch_total_capital = $this->queries->get_total_blanch_account($blanchs->blanch_id);
                                         //print_r($blanch_total_capital);
                                         ?>

                                        <li class="c"><a href="<?php echo base_url("admin/view_blanchPanel/{$blanchs->blanch_id}") ?>"><?php echo $blanchs->blanch_name; ?> - <?php echo number_format($blanch_total_capital->total_blanch_amount); ?></a></li>
                                         <?php endforeach; ?>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                        <?php 
                        $blanch_total = $this->queries->get_total_blanch_account($blanch_id);
                        $loan_dis_int = $this->queries->get_loan_with_drawal($blanch_id);
                        $default = $this->queries->get_default_loan($blanch_id);
                        //print_r($default);
                         ?>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <div class="body bg-success text-light">
                                        <h4><i class="icon-wallet"></i> <?php echo number_format($blanch_total->total_blanch_amount); ?></h4>
                                        <span><?php echo $this->lang->line("main_account_menu"); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="body bg-warning text-light">
                                        <h4><i class="icon-wallet"></i> <?php echo number_format($loan_dis_int->toptal_loan_disbures); ?></h4>
                                        <span><?php echo $this->lang->line("disburse_loan_menu"); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="body bg-primary text-light">
                                        <h4><i class="icon-wallet"></i>  <?php echo number_format($loan_dis_int->total_loan_int); ?></h4>
                                        <span><?php echo $this->lang->line("expectation_menu"); ?></span>
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                <?php //print_r($loan_out); ?>
                                    <div class="body bg-danger text-light">
                                        <h4><i class="icon-wallet"></i> <?php echo number_format($default->total_default); ?></h4>
                                        <span><?php echo $this->lang->line("outstand_menu"); ?></span>
                                    </div>
                                </div>
                            </div>
                            <!-- <div id="total_revenue" class="ct-chart m-t-20"></div> -->
                        </div>
                    </div>
                </div>
            
     
                <?php 
             $all_customer = $this->db->query("SELECT * FROM tbl_customer WHERE blanch_id = '$blanch_id'");
             $all_male = $this->db->query("SELECT * FROM tbl_customer WHERE blanch_id = '$blanch_id' AND gender = 'male'");
             $all_female = $this->db->query("SELECT * FROM tbl_customer WHERE blanch_id = '$blanch_id' AND gender = 'female'");
             $employee = $this->db->query("SELECT * FROM tbl_group WHERE blanch_id = '$blanch_id'");
             ?>

            
                 <div class="col-lg-3 col-md-3 col-12">
                   <div class="card">
                        <div class="header">
                            <h2>All Customer & Groups</h2>
                        </div>
                        <div class="body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="c">All Customer</td>
                                        <td class="align-right"><span class="badge badge-success"><?php echo $all_customer->num_rows(); ?></span></td>
                                    </tr>

                                    <tr>
                                        <td class="c">Male</td>
                                        <td class="align-right"><span class="badge badge-info"><?php echo $all_male->num_rows(); ?></span></td>
                                    </tr>
                                    <tr>
                                        <td class="c">Female</td>
                                        <td class="align-right"><span class="badge badge-danger"><?php echo $all_female->num_rows(); ?></span></td>
                                    </tr>
                                    <tr>
                                        <td class="c">Groups</td>
                                        <td class="align-right"><span class="badge badge-default"><?php echo $employee->num_rows(); ?></span></td>
                                    </tr>                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
        <?php 
        $deposit_daily = $this->queries->fetch_today_deposit_daily($blanch_id);
        $depist_weekly = $this->queries->fetch_today_deposit_weekly($blanch_id);
        $deposit_monthly = $this->queries->fetch_today_deposit_monthly($blanch_id);
        $all_deposit = $this->queries->fetch_today_deposit($blanch_id);
        //print_r($all_deposit);
         ?>

                    <div class="col-lg-3 col-md-3 col-12">
                   <div class="card">
                        <div class="header">
                            <h2>Today Deposit</h2>
                        </div>
                        <div class="body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="c">Daily</td>
                                        <td class="align-right"><span class="badge badge-warning"><?php echo number_format($deposit_daily->total_deposit + $deposit_daily->total_double); ?></span></td>
                                    </tr>

                                    <tr>
                                        <td class="c">Weekly</td>
                                        <td class="align-right"><span class="badge badge-info"><?php echo number_format($depist_weekly->total_deposit_weekly + $depist_weekly->total_double_wekly); ?></span></td>
                                    </tr>
                                    <tr>
                                        <td class="c">Monthly</td>
                                        <td class="align-right"><span class="badge badge-secondary"><?php echo number_format($deposit_monthly->total_deposit_monthly + $deposit_monthly->total_double_month); ?></span></td>
                                    </tr>
                                    <tr>
                                        <td class="c"><b>TOTAL</b></td>
                                        <td class="align-right"><b><span class="badge badge-success"><?php echo number_format($all_deposit->total_deposit_all + $all_deposit->total_double_all); ?></span></b></td>
                                    </tr>                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>

                    <?php 
                 $loan_with_day = $this->queries->get_today_withdrawal_daily($blanch_id);
                 $loan_with_weekly = $this->queries->get_today_withdrawal_weekly($blanch_id);
                 $loan_with_monthy = $this->queries->get_today_withdrawal_monthly($blanch_id);
                 $ll_loanwith = $this->queries->get_today_withdrawal_all($blanch_id);
                 //print_r($ll_loanwith);
                     ?>

                     <div class="col-lg-3 col-md-3 col-12">
                   <div class="card">
                        <div class="header">
                            <h2>Today Loan Withdrawal</h2>
                        </div>
                        <div class="body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="c">Daily</td>
                                        <td class="align-right"><span class="badge badge-warning"><?php echo number_format($loan_with_day->total_loanWith_day); ?></span></td>
                                    </tr>

                                    <tr>
                                        <td class="c">Weekly</td>
                                        <td class="align-right"><span class="badge badge-info"><?php echo number_format($loan_with_weekly->total_loanWith_weekly); ?></span></td>
                                    </tr>
                                    <tr>
                                        <td class="c">Monthly</td>
                                        <td class="align-right"><span class="badge badge-secondary"><?php echo number_format($loan_with_monthy->total_loanWith_monthly); ?></span></td>
                                    </tr>
                                    <tr>
                                        <td class="c"><b>TOTAL</b></td>
                                        <td class="align-right"><b><span class="badge badge-success"><?php echo number_format($ll_loanwith->total_loanWith_all); ?></span></b></td>
                                    </tr>                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>

             <?php 
             $deducted_balance = $this->queries->get_today_deducted_income_dahboard($blanch_id);
             $non_balance = $this->queries->get_today_nonDeducted_receive($blanch_id);
             $expenses = $this->queries->get_today_expenses_blanch_data($blanch_id);
             // print_r($expenses);
             //         exit();
              ?>
                     <div class="col-lg-3 col-md-3 col-12">
                   <div class="card">
                        <div class="header">
                            <h2>Today Income & Expensess</h2>
                        </div>
                        <div class="body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="c">Deducted Income</td>
                                        <td class="align-right"><span class="badge badge-warning"><?php echo number_format($deducted_balance->total_deducted); ?></span></td>
                                    </tr>

                                    <tr>
                                        <td class="c">Non -Deducted Income</td>
                                        <td class="align-right"><span class="badge badge-info"><?php echo number_format($non_balance->total_non); ?></span></td>
                                    </tr>
                                    <tr>
                                        <td class="c"><b>TOTAL INCOME</b></td>
                                        <td class="align-right"><span class="badge badge-success"><?php echo number_format($deducted_balance->total_deducted + $non_balance->total_non); ?></span></td>
                                    </tr>
                                    <tr>
                                        <td class="c">Expenses</td>
                                        <td class="align-right"><b><span class="badge badge-danger"><?php echo number_format($expenses->total_expenses); ?></span></b></td>
                                    </tr>                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
             
            </div>

            
                
           

             <div class="row clearfix w_social3">
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php echo base_url("admin/get_customer_blanch/{$blanch_id}"); ?>"><div class="card facebook-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/user.png" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color: black;"><?php echo $this->lang->line("customer_menu"); ?></div>
                            <!-- <div class="number">123</div> -->
                        </div>
                    </div></a>
                </div>
                
                
               
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="javascript:;"><div class="card linkedin-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/daily.png" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black"><?php echo $this->lang->line("Daily_report_menu"); ?></div>
                            <!-- <div class="number">2510</div> -->
                        </div>
                    </div></a>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php echo base_url("admin/get_blanch_expenses/{$blanch_id}"); ?>"><div class="card behance-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/expenses.png" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black"><?php echo $this->lang->line("expenses_menu"); ?></div>
                            <!-- <div class="number">121</div> -->
                        </div>
                    </div></a>
                </div>
         



        
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php echo base_url("admin/get_today_cashtransaction_blanch/{$blanch_id}"); ?>">
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
                    <a href="<?php echo base_url("admin/get_today_loan_pending_blanch/{$blanch_id}"); ?>"><div class="card instagram-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/default.jpeg" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black;"><?php echo $this->lang->line("pending_menu"); ?></div>
                            <!-- <div class="number">231</div> -->
                        </div>
                    </div></a>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php echo base_url("admin/receivable_blanch/{$blanch_id}"); ?>">
                        <div class="card twitter-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/receivable.png" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black;"><?php echo $this->lang->line("receivable_menu"); ?></div>
                            <!-- <div class="number">31</div> -->
                        </div>
                    </div></a>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php echo base_url("admin/get_blanch_received/{$blanch_id}"); ?>">
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
                    <a href="<?php echo base_url("admin/loan_withdrawal_branch/{$blanch_id}"); ?>">
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
                    <a href="<?php echo base_url("admin/get_default_loan_blanch/{$blanch_id}"); ?>">
                        <div class="card behance-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/default.jpeg" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black;"><?php echo $this->lang->line("outstand_menu"); ?></div>
                            <!-- <div class="number">121</div> -->
                        </div>
                    </div>
                    </a>
                </div>
           

                <!-- <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php //echo base_url("admin/transfar_amount"); ?>"><div class="card twitter-widget">
                        <div class="icon"><img src="<?php //echo base_url() ?>assets/img/stoo.png" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black">Float</div>
                            <div class="number">1</div>
                        </div>
                    </div></a>
                </div> -->

                  <div class="col-lg-2 col-md-4 col-6">
                    <a href="javascript:;">
                        <div class="card twitter-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/income.png" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black;"><?php echo $this->lang->line("income_menu") ?></div>
                            <!-- <div class="number">31</div> -->
                        </div>
                    </div>
                    </a>
                </div>
                

                 <div class="col-lg-2 col-md-4 col-6">
                    <a href="javascript:;">
                        <div class="card twitter-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/rejected.jpg" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black;"><?php echo $this->lang->line("rejectedloan_menu"); ?></div>
                            <!-- <div class="number">31</div> -->
                        </div>
                    </div>
                    </a>
                </div>
                 <div class="col-lg-2 col-md-4 col-6">
                    <a href="<?php echo base_url("admin/saving_deposit"); ?>">
                        <div class="card twitter-widget">
                        <div class="icon"><img src="<?php echo base_url() ?>assets/img/saving.png" style="width: 44px; height: 44px;"></div>
                        <div class="content">
                            <div class="text" style="color:black;"><?php echo $this->lang->line("savingdEPOSIT_menu") ?></div>
                            <!-- <div class="number">31</div> -->
                        </div>
                    </div>
                    </a>
                </div>

        </div>

    </div>
    
</div>

<?php include('incs/footer.php'); ?>