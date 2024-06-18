  <?php $empl_id = $this->session->userdata('empl_id'); ?>
   <?php $privillage = $this->queries->get_empl_privillage($empl_id); ?>

  <div id="left-sidebar" class="sidebar">
        <div class="sidebar-scroll">
            <div class="user-account">
                <img src="<?php echo base_url() ?>assets/img/male.jpeg" class="rounded-circle user-photo" alt="User Profile Picture">
                <div class="dropdown">
                    <span><?php echo $this->lang->line('karibu_menu'); ?>,</span>
                    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong><?php echo $_SESSION['empl_name']; ?></strong></a>
                    <ul class="dropdown-menu dropdown-menu-right account">
                        <li><a href="javascript:;"><i class="icon-user"></i><?php echo $this->lang->line("myprofile_menu"); ?></a></li>
                        <li><a href="<?php echo base_url("oficer/setting"); ?>"><i class="icon-settings"></i><?php echo $this->lang->line("setting_menu") ?></a></li>
                        <li class="divider"></li>
                        <li><a href="javascript:void(0);"><i class="icon-power"></i><?php echo $this->lang->line("logout_data_menu"); ?></a></li>
                    </ul>
                </div>
               <!--  <hr> -->
                <!-- <ul class="row list-unstyled">
                    <li class="col-4">
                        <small>Employee</small>
                        <h6>14</h6>
                    </li>
                    <li class="col-4">
                        <small>Customer</small>
                        <h6>13</h6>
                    </li>
                    <li class="col-4">
                        <small>Admin</small>
                        <h6>213</h6>
                    </li>
                </ul> -->
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#menu"><?php echo $this->lang->line("menu_line_menu"); ?></a></li>
                <?php foreach ($privillage as $privillages): ?>
                        <?php if ($privillages->privillage == 'report') {
                         ?>                         
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sub_menu"><?php echo $this->lang->line("report_menu"); ?></i></a></li>
                <?php } ?>
                <?php endforeach; ?>
                <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Chat"><i class="icon-book-open"></i></a></li> -->
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#setting"><i class="icon-settings"></i></a></li>                
            </ul>
                
            <!-- Tab panes -->
            <div class="tab-content p-l-0 p-r-0">
                <div class="tab-pane active" id="menu">
                    <nav class="sidebar-nav">
                        <ul class="main-menu metismenu">
                            <li class="active"><a href="<?php echo base_url("oficer/index"); ?>"><i class="icon-home"></i><span><?php echo $this->lang->line("dashboard_menu"); ?></span></a></li>

                          

                             <!-- <li><a href="javascript:;"><i class="icon-users"></i>Group</a></li> -->
                           
                            <?php foreach ($privillage as $privillages): ?>
                                <?php if ($privillages->privillage == 'income') {
                                ?>
                            <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-wallet"></i><span><?php echo $this->lang->line("income_menu"); ?></span> </a>
                                <ul>
                                    <li><a href="<?php echo base_url("oficer/income_dashboard"); ?>"><?php echo $this->lang->line("income_non_menu"); ?></a></li>
                                    <li><a href="<?php echo base_url("oficer/deducted_income"); ?>"><?php echo $this->lang->line("income_deducted_menu"); ?></a></li>
                                    <!-- <li><a href="javascript:;">Transfor Income To Branch Account</a></li> -->
                                    <!-- <li><a href="javascript:;">Transfor Income Branch To Company</a></li> -->
                                    <!-- <li><a href="<?php //echo base_url("oficer/income_balance"); ?>"><?php echo $this->lang->line("total_income_menu"); ?></a></li> -->
                                </ul>
                            </li>
                        <?php  }elseif ($privillages->privillage == 'expenses') {
                         ?>
                          <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-credit-card"></i><span>Expenses</span> </a>
                                <ul>
                                    <li><a href="<?php echo base_url("oficer/expnses_requisition_form"); ?>">Request Expenses</a></li>
                                   <!--  <li><a href="<?php //echo base_url("admin/get_recomended_request"); ?>">All Expenses Request</a></li> -->
                                </ul>
                            </li>
                            <?php }elseif($privillages->privillage == 'loan'){ ?>
                            
                            <li>
                                <a href="#Widgets" class="has-arrow"><i class="icon-list"></i><span>Loan</span></a>
                                <ul>
                                    <li><a href="<?php echo base_url("oficer/loan_application"); ?>">Loan Application</a></li>
                                    <li><a href="<?php echo base_url("oficer/loan_pending"); ?>">Loan Pending Approve</a></li>
                                    
                                    <li><a href="<?php echo base_url("oficer/disburse_loan"); ?>">Loan Disbursed</a></li>
                                    <li><a href="<?php echo base_url("oficer/get_loan_withdrawal_data"); ?>">Loan Withdrawal</a></li>
                                    <li><a href="<?php echo base_url("oficer/loan_rejected"); ?>">Loan Rejected</a></li>
                                    <!-- <li><a href="javascript:;">Individual Loan</a></li>
                                    <li><a href="javascript:;">Group Loan</a></li> -->
                                </ul>
                            </li>


                            <li>
                                <a href="#Widgets" class="has-arrow"><i class="icon-list"></i><span>Renew Loan</span></a>
                                <ul>
                                    <li><a href="<?php echo base_url("oficer/renew_request"); ?>">Loan Request</a></li>
                                    <li><a href="<?php echo base_url("oficer/renew_loan_aproved"); ?>">Aproved Request</a></li>
                                </ul>
                            </li>
                                <?php }elseif($privillages->privillage == 'customer'){ ?>
                            <li>
                                <a href="#Authentication" class="has-arrow"><i class="icon-user"></i><span>Customer</span></a>
                                <ul>
                                    <li><a href="<?php echo base_url("oficer/customer"); ?>">Register Customer</a></li>
                                    <li><a href="<?php echo base_url("oficer/all_customer"); ?>">All Customer</a></li>
                                </ul>
                            </li>
                                    <?php }elseif ($privillages->privillage == 'group') {
                                     ?>
                            <li>
                                <a href="#Authentication" class="has-arrow"><i class="icon-users"></i><span>Groups</span></a>
                                <ul>
                                    <li><a href="<?php echo base_url("oficer/grops"); ?>">Register Group</a></li>
                                    <li><a href="<?php echo base_url("oficer/group_members"); ?>">Groups & Loans</a></li>
                                    <li><a href="<?php echo base_url("oficer/loan_group_pending"); ?>">Groups Loan Pending</a></li>
                                    <li><a href="<?php echo base_url("oficer/group_list"); ?>">Groups Collection Sheet</a></li>
                                </ul>
                             </li>  
                                     <?php }elseif ($privillages->privillage == 'teller') {
                                      ?>
                           <li><a href="<?php echo base_url("oficer/teller_dashboard"); ?>"><i class="icon-list"></i>Teller Dashboard</a></li>

                            <li><a href="<?php echo base_url("oficer/saving_deposit"); ?>"><i class="icon-list"></i>Saving Deposit</a></li>
                                      <?php }elseif ($privillages->privillage == 'float') {
                                       ?>
                                 <li>
                                <a href="#Widgets" class="has-arrow"><i class="icon-list"></i><span>Float</span></a>
                                <ul>
                                    <li><a href="<?php echo base_url("oficer/transfor_float_branch"); ?>">Transfor Float</a></li>
                                    <li><a href="<?php echo base_url("oficer/receive_float"); ?>">Received Float</a></li>  
                                </ul>
                            </li>  
                                 <?php }else{ ?>

                                    <?php } ?>
                        <?php endforeach; ?>

                        </ul>
                    </nav>
                    <br><br><br><br>
                </div>

                <div class="tab-pane" id="sub_menu">
                    <nav class="sidebar-nav">
                        <ul class="main-menu metismenu">
                        	<li><a href="<?php echo base_url("oficer/cash_transaction"); ?>"><i class="icon-wallet"></i>Cash Transaction</a></li>
                        	<li><a href="<?php echo base_url("oficer/blanchwise_loan"); ?>"><i class="icon-list"></i>Branch Wise Report</a></li>
                        	<li><a href="<?php echo base_url("oficer/loan_pending_time"); ?>"><i class="icon-list"></i>Loan Pending</a></li>
                        	<li><a href="<?php echo base_url("oficer/loan_repayment"); ?>"><i class="icon-list"></i>Loan Repayment</a></li>
                        	<li><a href="<?php echo base_url("oficer/oustand_loan"); ?>"><i class="icon-list"></i>Default Loan</a></li>
                        	<li><a href="<?php echo base_url("oficer/loan_collection"); ?>"><i class="icon-list"></i>Loan Collection</a></li>
                        	<!-- <li><a href="javascript:;"><i class="icon-list"></i>Customer Loan Report</a></li> -->
                        	<li><a href="<?php echo base_url("oficer/customer_account_statement"); ?>"><i class="icon-list"></i>Customer Account</a></li>
                        	<li><a href="<?php echo base_url("oficer/get_today_receivable"); ?>"><i class="icon-list"></i>Today Receivable</a></li>
                        	<li><a href="<?php echo base_url("oficer/today_received"); ?>"><i class="icon-list"></i>Today Received</a></li>
                        	<!-- <li><a href="javascript:;"><i class="icon-list"></i>Teller Officer Transaction</a></li> -->
                        	<li><a href="<?php echo base_url("oficer/next_expectation"); ?>"><i class="icon-list"></i>Expectation Receivable</a></li>
                        	<li><a href="<?php echo base_url("oficer/daily_report"); ?>"><i class="icon-list"></i>Daily Report</a></li>
                           <!--  <li>
                                <a href="#uiElements" class="has-arrow"><i class="icon-wallet"></i> <span>Accounting Report</span></a>
                                <ul>
                                    <li><a href="javascript:;">Profit & Loss</a></li>
                                    <li><a href="ui-tabs.html">Cash flow</a></li>
                                    <li><a href="ui-buttons.html">Saving Deposit</a></li>
                                </ul>
                            </li> -->
                            <!-- <li><a href="javascript:;"><i class="icon-wallet"></i>Cashbook</a></li> -->                            
                        </ul>
                    </nav>
                    <br><br><br>
                </div>
               
                <div class="tab-pane p-l-15 p-r-15" id="setting">
                    <h6>Choose Skin</h6>
                    <ul class="choose-skin list-unstyled">
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>                   
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="cyan" class="active">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="blush">
                            <div class="blush"></div>
                            <span>Blush</span>
                        </li>
                    </ul>

               
                </div>             
            </div>          
        </div>
    </div>