  <?php if (@$_SESSION['position_id'] == '22') {
  ?>

     <?php 
$comp_id = $this->session->userdata('comp_id');
$empl_id = $this->session->userdata('empl_id');
$company = $this->queries->get_comp_data($comp_id);
 ?>
  <div id="left-sidebar" class="sidebar">
        <div class="sidebar-scroll">
            <div class="user-account">
                <img src="<?php echo base_url() ?>assets/img/male.jpeg" class="rounded-circle user-photo" alt="User Profile Picture">
                <div class="dropdown">
                    <span><?php echo $this->lang->line('karibu_menu'); ?>,</span>
                    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong><?php echo $company->comp_name; ?></strong></a>
                    <ul class="dropdown-menu dropdown-menu-right account">
                        <li><a href="javascript:;"><i class="icon-user"></i>My Profile</a></li>
                        <li><a href="<?php echo base_url("admin/setting"); ?>"><i class="icon-settings"></i>Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="javascript:void(0);"><i class="icon-power"></i>Logout</a></li>
                    </ul>
                </div>
                <!-- <hr> -->
               <!--  <ul class="row list-unstyled">
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
              <?php
                 $employee_priv = $this->queries->get_admin_privillage($empl_id);
                  ?>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#menu">Menu</a></li>
                    <?php foreach ($employee_priv as $employee_privs): ?>
                        <?php if ($employee_privs->privillage == 'report') {
                         ?>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sub_menu">Report</i></a></li>
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
                            <li class="active"><a href="<?php echo base_url("admin/index"); ?>"><i class="icon-home"></i><span>Dashboard</span></a></li>


                  
                  <?php foreach ($employee_priv as $employee_privs): ?>
                      
                            <?php if ($employee_privs->privillage == 'setting') {
                             ?>
                          <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-settings"></i><span>Setup</span> </a>
                                <ul>
                                    <li><a href="<?php echo base_url("admin/loan_category"); ?>">Loan Category</a></li>
                                    <li><a href="<?php echo base_url("admin/loan_fee") ?>">Loan Fee</a></li>
                                    <li><a href="<?php echo base_url("admin/penart_setting"); ?>">Penart Setting</a></li>
                                    <li><a href="<?php echo base_url("admin/formular_setting"); ?>">Interest Formular Setting</a></li>
                                    <li><a href="<?php echo base_url("admin/transaction_account"); ?>">Transaction Accounts</a></li>
                                </ul>
                            </li>
                        <?php }elseif ($employee_privs->privillage == 'capital') {
                        ?>

                          <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-wallet"></i><span>Capital</span> </a>
                                <ul>
                                    <li><a href="<?php echo base_url("admin/shareHolder"); ?>">Share Holders</a></li>
                                    <li><a href="<?php echo base_url("admin/capital"); ?>">Add Capitals</a></li>
                                    <li><a href="<?php echo base_url("admin/transfar_amount"); ?>">Float</a></li>
                                    <!-- <li><a href="javascript:;">Float From Blanch Account to Company Account </a></li> -->
                                </ul>
                            </li>
                        <?php  }elseif ($employee_privs->privillage == 'branch') {
                         ?>
                             <li><a href="<?php echo base_url("admin/blanch"); ?>"><i class="icon-size-actual"></i>Branch</a></li>
                             <!-- <li><a href="javascript:;"><i class="icon-users"></i>Group</a></li> -->
                            <?php }elseif ($employee_privs->privillage == 'income') {
                             ?>
                            <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-wallet"></i><span>Income</span> </a>
                                <ul>
                                    <li><a href="<?php echo base_url("admin/income_detail"); ?>">Register Income</a></li>
                                    <li><a href="<?php echo base_url("admin/income_dashboard"); ?>">Non-Deducted Income</a></li>
                                    <li><a href="<?php echo base_url("admin/deducted_income"); ?>">Deducted Income</a></li>
                                    <!-- <li><a href="javascript:;">Transfor Income Branch To Branch</a></li>
                                    <li><a href="javascript:;">Transfor Income Branch To Company</a></li> -->
                                    <!-- <li><a href="<?php //echo base_url("admin/income_balance"); ?>">Income Balance</a></li> -->
                                </ul>
                            </li>
                        <?php }elseif ($employee_privs->privillage == 'expenses') {
                         ?>
                            <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-credit-card"></i><span>Expenses</span> </a>
                                <ul>
                                    <li><a href="<?php echo base_url("admin/expenses"); ?>">Register Expenses</a></li>
                                    <li><a href="<?php echo base_url("admin/expnses_requisition_form"); ?>">Request Expenses</a></li>
                                    <li><a href="<?php echo base_url("admin/get_recomended_request"); ?>">All Expenses Request</a></li>
                                </ul>
                            </li>
                        <?php }elseif ($employee_privs->privillage == 'employee') {
                         ?>

                            <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-layers"></i><span>Employee</span> </a>
                                <ul>
                                    <li><a href="<?php echo base_url("admin/employee"); ?>">Register Employee</a></li>
                                    <li><a href="<?php echo base_url("admin/all_employee"); ?>">All Employee</a></li>
                                  <!--   <li><a href="javascript:void(0);">All Branchs & Employee</a></li>
                                    <li><a href="javascript:void(0);">Employee Leave</a></li>
                                    <li><a href="javascript:void(0);">Sallary Sheet</a></li>
                                    <li><a href="javascript:void(0);">Employee Allowance</a></li>
                                    <li><a href="javascript:void(0);">Employee Deduction</a></li> -->
                                </ul>
                            </li>
                        <?php }elseif ($employee_privs->privillage == 'customer') {
                         ?>
                            
                            <li>
                                <a href="#Authentication" class="has-arrow"><i class="icon-user"></i><span>Customer</span></a>
                                <ul>
                                    <li><a href="<?php echo base_url("admin/customer"); ?>">Register Customer</a></li>
                                    <li><a href="<?php echo base_url("admin/all_customer"); ?>">All Customer</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="#Authentication" class="has-arrow"><i class="icon-users"></i><span>Groups</span></a>
                                <ul>
                                    <li><a href="<?php echo base_url("admin/grops"); ?>">Register Group Name</a></li>
                                    <li><a href="<?php echo base_url("admin/group_members"); ?>">All Group & Loans</a></li>
                                     <li><a href="<?php echo base_url("admin/loan_group_pending"); ?>">Group Loan Pending</a></li>
                                     <li><a href="<?php echo base_url("admin/group_list"); ?>">Group Collection Sheet</a></li>                                
                                 </ul>
                            </li>

                            <?php }elseif ($employee_privs->privillage == 'loan') {
                             ?>
                            <li>
                                <a href="#Widgets" class="has-arrow"><i class="icon-list"></i><span>Loan</span></a>
                                <ul>
                                    <li><a href="<?php echo base_url("admin/loan_application"); ?>">Loan Application</a></li>
                                    <li><a href="<?php echo base_url("admin/loan_pending"); ?>">Loan Pending Approve</a></li>
                                    
                                    <li><a href="<?php echo base_url("admin/disburse_loan"); ?>">Loan Disbursed</a></li>
                                    <li><a href="<?php echo base_url("admin/loan_withdrawal"); ?>">Loan Withdrawal</a></li>
                                    <li><a href="<?php echo base_url("admin/all_loan_lejected"); ?>">Loan Rejected</a></li>
                                    <!-- <li><a href="javascript:;">Individual Loan</a></li>
                                    <li><a href="javascript:;">Group Loan</a></li> -->
                                </ul>
                            </li>

                             <li>
                                <a href="#Widgets" class="has-arrow"><i class="icon-list"></i><span>Renew Loan</span></a>
                                <ul>
                                    <li><a href="<?php echo base_url("admin/renew_request"); ?>">Loan Request</a></li>
                                    <li><a href="<?php echo base_url("admin/renew_loan_aproved"); ?>">Aproved Request</a></li>
                                </ul>
                            </li>
                        <?php }elseif ($employee_privs->privillage == 'teller') {
                         ?>
                            <li><a href="<?php echo base_url("admin/teller_dashboard"); ?>"><i class="icon-list"></i>Teller Dashboard</a></li>
                        <?php }elseif ($employee_privs->privillage == 'comnication') {
                        ?>

                            <li>

                                <a href="#Pages" class="has-arrow"><i class="icon-docs"></i><span>Commnication</span></a>
                                <ul>
                                    <li><a href="<?php echo base_url("admin/reminder_sms") ?>">Via SMS</a> </li>
                                    <li><a href="javascript:;">Via Email</a></li>
                                </ul>
                            </li>
                        <?php  }else{ ?>
                            <?php } ?>

                            <?php endforeach; ?>

                        </ul>
                    </nav>
                    <br><br><br><br>
                </div>

                <div class="tab-pane" id="sub_menu">
                    <nav class="sidebar-nav">
                        <ul class="main-menu metismenu">
                            <li><a href="<?php echo base_url("admin/cash_transaction"); ?>"><i class="icon-wallet"></i>Cash Transaction</a></li>
                            <li><a href="<?php echo base_url("admin/blanchiwise_report"); ?>"><i class="icon-list"></i>Branch Wise Report</a></li>
                            <li><a href="<?php echo base_url("admin/loan_pending_time"); ?>"><i class="icon-list"></i>Loan Pending</a></li>
                            <li><a href="<?php echo base_url("admin/repaymant_data"); ?>"><i class="icon-list"></i>Loan Repayment</a></li>
                            <li><a href="<?php echo base_url("admin/Default_loan"); ?>"><i class="icon-list"></i>Default Loan</a></li>
                            <li><a href="<?php echo base_url("admin/loan_collection"); ?>"><i class="icon-list"></i>Loan Collection</a></li>
                            <!-- <li><a href="javascript:;"><i class="icon-list"></i>Customer Loan Report</a></li> -->
                            <li><a href="<?php echo base_url("admin/customer_account_statement"); ?>"><i class="icon-list"></i>Customer Account</a></li>
                            <li><a href="<?php echo base_url("admin/today_recevable_loan"); ?>"><i class="icon-list"></i>Today Receivable</a></li>
                            <li><a href="<?php echo base_url("admin/today_receved_loan"); ?>"><i class="icon-list"></i>Today Received</a></li>
                            <!-- <li><a href="javascript:;"><i class="icon-list"></i>Teller Officer Transaction</a></li> -->
                            <li><a href="<?php echo base_url("admin/next_expectation"); ?>"><i class="icon-list"></i>Expectation Receivable</a></li>
                            <!-- <li>
                                <a href="#uiElements" class="has-arrow"><i class="icon-wallet"></i> <span>Accounting Report</span></a>
                                <ul>
                                    <li><a href="javascript:;">Profit & Loss</a></li>
                                    <li><a href="ui-tabs.html">Cash flow</a></li>
                                    <li><a href="ui-buttons.html">Saving Deposit</a></li>
                                </ul>
                            </li> -->
                            <li><a href="<?php echo base_url("admin/daily_report"); ?>"><i class="icon-wallet"></i>Daily Report</a></li>                            
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

<?php  }else{ ?>
  <div id="left-sidebar" class="sidebar">
        <div class="sidebar-scroll">
            <div class="user-account">
                <img src="<?php echo base_url() ?>assets/img/male.jpeg" class="rounded-circle user-photo" alt="User Profile Picture">
                <div class="dropdown">
                    <span><?php echo $this->lang->line('karibu_menu'); ?>,</span>
                    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong><?php echo $_SESSION['comp_name']; ?></strong></a>
                    <ul class="dropdown-menu dropdown-menu-right account">
                        <li><a href="javascript:;"><i class="icon-user"></i>My Profile</a></li>
                        <li><a href="<?php echo base_url("admin/setting"); ?>"><i class="icon-settings"></i>Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="javascript:void(0);"><i class="icon-power"></i>Logout</a></li>
                    </ul>
                </div>
                <!-- <hr> -->
               <!--  <ul class="row list-unstyled">
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
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#menu">Menu</a></li>                
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sub_menu">Report</i></a></li>
                <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Chat"><i class="icon-book-open"></i></a></li> -->
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#setting"><i class="icon-settings"></i></a></li>                
            </ul>
                
            <!-- Tab panes -->
            <div class="tab-content p-l-0 p-r-0">
                <div class="tab-pane active" id="menu">
                    <nav class="sidebar-nav">
                        <ul class="main-menu metismenu">
                            <li class="active"><a href="<?php echo base_url("admin/index"); ?>"><i class="icon-home"></i><span>Dashboard</span></a></li>

                          <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-settings"></i><span>Setup</span> </a>
                                <ul>
                                    <li><a href="<?php echo base_url("admin/loan_category"); ?>">Loan Category</a></li>
                                    <li><a href="<?php echo base_url("admin/loan_fee") ?>">Loan Fee</a></li>
                                    <li><a href="<?php echo base_url("admin/penart_setting"); ?>">Penart Setting</a></li>
                                    <li><a href="<?php echo base_url("admin/formular_setting"); ?>">Interest Formular Setting</a></li>
                                    <li><a href="<?php echo base_url("admin/transaction_account"); ?>">Transaction Accounts</a></li>
                                </ul>
                            </li>

                          <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-wallet"></i><span>Capital</span> </a>
                                <ul>
                                    <li><a href="<?php echo base_url("admin/shareHolder"); ?>">Share Holders</a></li>
                                    <li><a href="<?php echo base_url("admin/capital"); ?>">Add Capitals</a></li>
                                    <li><a href="<?php echo base_url("admin/transfar_amount"); ?>">Float</a></li>
                                    <!-- <li><a href="javascript:;">Float From Blanch Account to Company Account </a></li> -->
                                </ul>
                            </li>
                             <li><a href="<?php echo base_url("admin/blanch"); ?>"><i class="icon-size-actual"></i>Branch</a></li>
                             <!-- <li><a href="javascript:;"><i class="icon-users"></i>Group</a></li> -->
                            
                            <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-wallet"></i><span>Income</span> </a>
                                <ul>
                                    <li><a href="<?php echo base_url("admin/income_detail"); ?>">Register Income</a></li>
                                    <li><a href="<?php echo base_url("admin/income_dashboard"); ?>">Non-Deducted Income</a></li>
                                    <li><a href="<?php echo base_url("admin/deducted_income"); ?>">Deducted Income</a></li>
                                    <!-- <li><a href="javascript:;">Transfor Income Branch To Branch</a></li>
                                    <li><a href="javascript:;">Transfor Income Branch To Company</a></li> -->
                                    <!-- <li><a href="<?php //echo base_url("admin/income_balance"); ?>">Income Balance</a></li> -->
                                </ul>
                            </li>
                            <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-credit-card"></i><span>Expenses</span> </a>
                                <ul>
                                    <li><a href="<?php echo base_url("admin/expenses"); ?>">Register Expenses</a></li>
                                    <li><a href="<?php echo base_url("admin/expnses_requisition_form"); ?>">Request Expenses</a></li>
                                    <li><a href="<?php echo base_url("admin/get_recomended_request"); ?>">All Expenses Request</a></li>
                                </ul>
                            </li>

                            <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-layers"></i><span>Employee</span> </a>
                                <ul>
                                    <li><a href="<?php echo base_url("admin/employee"); ?>">Register Employee</a></li>
                                    <li><a href="<?php echo base_url("admin/all_employee"); ?>">All Employee</a></li>
                                  <!--   <li><a href="javascript:void(0);">All Branchs & Employee</a></li>
                                    <li><a href="javascript:void(0);">Employee Leave</a></li>
                                    <li><a href="javascript:void(0);">Sallary Sheet</a></li>
                                    <li><a href="javascript:void(0);">Employee Allowance</a></li>
                                    <li><a href="javascript:void(0);">Employee Deduction</a></li> -->
                                </ul>
                            </li>
                            
                            <li>
                                <a href="#Authentication" class="has-arrow"><i class="icon-user"></i><span>Customer</span></a>
                                <ul>
                                    <li><a href="<?php echo base_url("admin/customer"); ?>">Register Customer</a></li>
                                    <li><a href="<?php echo base_url("admin/all_customer"); ?>">All Customer</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="#Authentication" class="has-arrow"><i class="icon-users"></i><span>Groups</span></a>
                                <ul>
                                    <li><a href="<?php echo base_url("admin/grops"); ?>">Register Group Name</a></li>
                                    <li><a href="<?php echo base_url("admin/group_members"); ?>">All Group & Loans</a></li>
                                    <li><a href="<?php echo base_url("admin/loan_group_pending"); ?>">Group Loan Pending</a></li>
                                       <li><a href="<?php echo base_url("admin/group_list"); ?>">Group Collection Sheet</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#Widgets" class="has-arrow"><i class="icon-list"></i><span>Loan</span></a>
                                <ul>
                                    <li><a href="<?php echo base_url("admin/loan_application"); ?>">Loan Application</a></li>
                                    <li><a href="<?php echo base_url("admin/loan_pending"); ?>">Loan Pending Approve</a></li>
                                    
                                    <li><a href="<?php echo base_url("admin/disburse_loan"); ?>">Loan Disbursed</a></li>
                                    <li><a href="<?php echo base_url("admin/loan_withdrawal"); ?>">Loan Withdrawal</a></li>
                                    <li><a href="<?php echo base_url("admin/all_loan_lejected"); ?>">Loan Rejected</a></li>
                                    <!-- <li><a href="javascript:;">Individual Loan</a></li>
                                    <li><a href="javascript:;">Group Loan</a></li> -->
                                </ul>
                            </li>
                             <li>
                                <a href="#Widgets" class="has-arrow"><i class="icon-list"></i><span>Renew Loan</span></a>
                                <ul>
                                    <li><a href="<?php echo base_url("admin/renew_request"); ?>">Loan Request</a></li>
                                    <li><a href="<?php echo base_url("admin/renew_loan_aproved"); ?>">Aproved Request</a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url("admin/teller_dashboard"); ?>"><i class="icon-list"></i>Teller Dashboard</a></li>

                            <li>

                                <a href="#Pages" class="has-arrow"><i class="icon-docs"></i><span>Commnication</span></a>
                                <ul>
                                    <li><a href="<?php echo base_url("admin/reminder_sms") ?>">Via SMS</a> </li>
                                    <li><a href="javascript:;">Via Email</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <br><br><br><br>
                </div>

                <div class="tab-pane" id="sub_menu">
                    <nav class="sidebar-nav">
                        <ul class="main-menu metismenu">
                        	<li><a href="<?php echo base_url("admin/cash_transaction"); ?>"><i class="icon-wallet"></i>Cash Transaction</a></li>
                        	<li><a href="<?php echo base_url("admin/blanchiwise_report"); ?>"><i class="icon-list"></i>Branch Wise Report</a></li>
                        	<li><a href="<?php echo base_url("admin/loan_pending_time"); ?>"><i class="icon-list"></i>Loan Pending</a></li>
                        	<li><a href="<?php echo base_url("admin/repaymant_data"); ?>"><i class="icon-list"></i>Loan Repayment</a></li>
                        	<li><a href="<?php echo base_url("admin/Default_loan"); ?>"><i class="icon-list"></i>Default Loan</a></li>
                        	<li><a href="<?php echo base_url("admin/loan_collection"); ?>"><i class="icon-list"></i>Loan Collection</a></li>
                        	<!-- <li><a href="javascript:;"><i class="icon-list"></i>Customer Loan Report</a></li> -->
                        	<li><a href="<?php echo base_url("admin/customer_account_statement"); ?>"><i class="icon-list"></i>Customer Account</a></li>
                        	<li><a href="<?php echo base_url("admin/today_recevable_loan"); ?>"><i class="icon-list"></i>Today Receivable</a></li>
                        	<li><a href="<?php echo base_url("admin/today_receved_loan"); ?>"><i class="icon-list"></i>Today Received</a></li>
                        	<!-- <li><a href="javascript:;"><i class="icon-list"></i>Teller Officer Transaction</a></li> -->
                        	<li><a href="<?php echo base_url("admin/next_expectation"); ?>"><i class="icon-list"></i>Expectation Receivable</a></li>
                            <!-- <li>
                                <a href="#uiElements" class="has-arrow"><i class="icon-wallet"></i> <span>Accounting Report</span></a>
                                <ul>
                                    <li><a href="javascript:;">Profit & Loss</a></li>
                                    <li><a href="ui-tabs.html">Cash flow</a></li>
                                    <li><a href="ui-buttons.html">Saving Deposit</a></li>
                                </ul>
                            </li> -->
                            <li><a href="<?php echo base_url("admin/daily_report"); ?>"><i class="icon-wallet"></i>Daily Report</a></li>                            
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
    <?php } ?>