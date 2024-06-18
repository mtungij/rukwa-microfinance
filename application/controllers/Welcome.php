<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {
	public function __construct(){
    parent::__construct();
    $lang = ($this->session->userdata('lang')) ?
    $this->session->userdata('lang') : config_item('language');
    $this->lang->load('menu',$lang);
}
	public function index(){
		$this->load->model('queries');
		$this->load->view('home/index');
	}

	// 	public function forgot_password(){
	// 	$this->load->view('home/forgot_password');
	// }

	public function create_company(){
		$this->form_validation->set_rules('region_id','region','required');
		$this->form_validation->set_rules('comp_name','company name','required');
		$this->form_validation->set_rules('comp_phone','company phone number','required');
		$this->form_validation->set_rules('adress','adress','required');
		$this->form_validation->set_rules('comp_number','Registration number','required');
		$this->form_validation->set_rules('comp_email','company Email','required');
		$this->form_validation->set_rules('sms_status','sms','required');
		$this->form_validation->set_rules('password','password','required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
		if ($this->form_validation->run() ) {
		     $data = $this->input->post();
		     $data['password'] = sha1($this->input->post('password'));
		      //   echo "<pre>";
		      // print_r($data);
		      // echo "</pre>";
		      //      exit();
		     $this->load->model('queries');
		      if ($this->queries->insert_company_data($data)) {
		           $this->session->set_flashdata('massage','Your Company Registration Successfully ');
		      }else{
		      	 $this->session->set_flashdata('error','Data Failed');
		      }
		      return redirect('welcome/register');
		}
		$this->register();
	}

	public function login(){
		$this->load->view('home/login');
	}


	public function  register(){
		$this->load->model('queries');
		$region = $this->queries->get_region();
		$this->load->view('home/register',['region'=>$region]);
	}



   // user sing in

		public function signin(){
		$this->form_validation->set_rules('comp_phone','company phone number','required');
		$this->form_validation->set_rules('password','password','required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
		if ($this->form_validation->run()){
			$comp_phone = $this->input->post('comp_phone');
			$password = sha1($this->input->post('password'));
			$this->load->model('queries');
			$userexit = $this->queries->user_data($comp_phone,$password);
			     // print_r($userexit);
			     //           exit();
		if ($userexit){
				if ($userexit->role == 'admin') {
					$sessionData = [
					'comp_id' => $userexit->comp_id,
					'comp_phone' => $userexit->comp_phone,
					'comp_number' => $userexit->comp_number,
					'comp_name' => $userexit->comp_name,
					'role' => $userexit->role,
					];
					// print_r($userexit);
					//     exit();
					if ($userexit->comp_status == 'close'){
               $this->session->set_flashdata('mass','Your Account Is Blocked');
                  return redirect("welcome/login");  	
                      }elseif ($userexit->comp_status == 'open') {
                    $this->session->set_userdata($sessionData);
                    $this->session->set_flashdata('massage',$this->lang->line('login_menu'));
                      	return redirect('admin/index');
					return redirect("admin/index");
                      }
				}
				
			}else{
				$this->session->set_flashdata('mass','Your Phone number or password is invalid please try again');
				return redirect("welcome/index");
			}
		}
		else{
			$this->login();	
		}
	}
	public function employee_login(){
		$this->load->view('home/employee');
	}


	public function Employee_signin(){
		$this->form_validation->set_rules('empl_no','Employee Phone number','required');
		$this->form_validation->set_rules('password','password','required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
		if ($this->form_validation->run()){
			$empl_no = $this->input->post('empl_no');
			$password = sha1($this->input->post('password'));
			$this->load->model('queries');
			$userexit = $this->queries->employee_user_data($empl_no,$password);
			     //  echo "<pre>";
			     // print_r($userexit);
			     //           exit();
		if ($userexit){
				if ($userexit->position_id == '1') {
					$sessionData = [
					'empl_id' => $userexit->empl_id,
					//'comp_id' => $userexit->comp_id,
					'blanch_id' => $userexit->blanch_id,
					'username' => $userexit->username,
					'empl_name' => $userexit->empl_name,
					];
					 // echo "<pre>";
			   //   print_r($userexit);
			   //             exit();
					if ($userexit->empl_status == 'open'){
                      	$this->session->set_userdata($sessionData);
                      	$this->session->set_flashdata('massage',$this->lang->line("login_menu"));
                      	return redirect('oficer/index');
                      }elseif ($userexit->empl_status == 'close') {
                    $this->session->set_userdata($sessionData);
                    $this->session->set_flashdata('mass',$this->lang->line("blocked_menu"));
					return redirect("welcome/employee_login");
                      }
				}elseif($userexit->position_id == '2'){
					$sessionData = [
					'empl_id' => $userexit->empl_id,
					//'comp_id' => $userexit->comp_id,
					'blanch_id' => $userexit->blanch_id,
					'username' => $userexit->username,
					'empl_name' => $userexit->empl_name,
					];
                    

					if ($userexit->empl_status == 'open'){
                      	$this->session->set_userdata($sessionData);
                      	$this->session->set_flashdata('massage',$this->lang->line("login_menu"));
                      	return redirect('oficer/index');
                      }elseif ($userexit->empl_status == 'close') {
                    $this->session->set_userdata($sessionData);
                    $this->session->set_flashdata('mass',$this->lang->line("blocked_menu"));
					return redirect("welcome/employee_login");
                      }

				}elseif($userexit->position_id == '6'){
					$sessionData = [
					'empl_id' => $userexit->empl_id,
					//'comp_id' => $userexit->comp_id,
					'blanch_id' => $userexit->blanch_id,
					'username' => $userexit->username,
					'empl_name' => $userexit->empl_name,
					];
        //       echo "<pre>";
        // print_r($userexit);
        //      exit();
				

				   if ($userexit->empl_status == 'open'){
                   $this->session->set_userdata($sessionData);
                   $this->session->set_flashdata('massage',$this->lang->line("login_menu"));
                    return redirect('oficer/index');
                  }elseif ($userexit->empl_status == 'close') {
                    $this->session->set_userdata($sessionData);
                    $this->session->set_flashdata('mass',$this->lang->line("blocked_menu"));
				  return redirect("welcome/employee_login");
                      }

				}elseif ($userexit->position_id == '17') {
					$sessionData = [
					'empl_id' => $userexit->empl_id,
					//'comp_id' => $userexit->comp_id,
					'blanch_id' => $userexit->blanch_id,
					'username' => $userexit->username,
					'empl_name' => $userexit->empl_name,
					];

						   	 // echo "<pre>";
			        // print_r($userexit);
			        //        exit();

					if ($userexit->empl_status == 'open'){
                   $this->session->set_userdata($sessionData);
                   $this->session->set_flashdata('massage',$this->lang->line("login_menu"));
                    return redirect('oficer/index');
                  }elseif ($userexit->empl_status == 'close') {
                    $this->session->set_userdata($sessionData);
                    $this->session->set_flashdata('mass',$this->lang->line("blocked_menu"));
				  return redirect("welcome/employee_login");
                      }
				}elseif($userexit->position_id == '22') {
					$sessionData = [
					'empl_id' => $userexit->empl_id,
					'blanch_id' => $userexit->blanch_id,
					'username' => $userexit->username,
					'empl_name' => $userexit->empl_name,
					'comp_id' => $userexit->comp_id,
					'position_id' => $userexit->position_id,
					];

						   	 // echo "<pre>";
			        // print_r($userexit);
			        //        exit();

					if ($userexit->empl_status == 'open'){
                   $this->session->set_userdata($sessionData);
                   $this->session->set_flashdata('massage',$this->lang->line("login_menu"));
                   //$txt = "samwel";
                  // $encrypttext = urlencode($this->encrypt->encode($txt));
                    return redirect('admin/index');
                  }elseif ($userexit->empl_status == 'close') {
                    $this->session->set_userdata($sessionData);
                    $this->session->set_flashdata('mass',$this->lang->line("blocked_menu"));
				  return redirect("welcome/employee_login");
                      }
                  }
				
			}else{
				$this->session->set_flashdata('mass',$this->lang->line("invalid_account_menu"));
				return redirect("welcome/employee_login");
			}
		}
		else{
			$this->employee_login();	
		}

	}
	 public function get_reminder_smsData(){
       	 $date = date("Y-m-d");
         $front = date('Y-m-d 23:59', strtotime('+1 day', strtotime($date)));
         // print_r($front);
         //    exit();
       	$data = $this->db->query("SELECT * FROM tbl_loans l  JOIN tbl_company ca ON ca.comp_id = l.comp_id WHERE l.loan_status = 'withdrawal'  AND l.return_date = '$front'");
       	    //echo "<pre>";
       	 $loans = $data->result();
       	      //exit();
       	  foreach($loans as $all_loans){
             //echo "<br>";
        	    //echo $all_loans->loan_id;
        	    //echo "<br>";
        	     //exit();
        	 $this->send_automatic_sms($all_loans->loan_id);
       	   }   
       }

       public function send_automatic_sms($loan_id){
       	$this->load->model('queries');
       	$data_loan = $this->queries->get_reminder_loan($loan_id);
       	 if (!empty($data_loan)) {
       	 	$phone_number = $data_loan->phone_no;
       	 	$comp_name = $data_loan->comp_name;
       	 	   // print_r($phone_number);
       	 	   // print_r($comp_name);
       	 	             //exit();
       	 	  $sms = $comp_name.' Inakukumbusha kulipa rejesho lako siku ya kesho Ahsante ';
            $massage = $sms;
            $phone = $phone_number;
            $this->sendsms($phone,$massage);
       	 }
       }





     //begin withdrawal function
	//withdrow auto matic time
	public function get_autodata(){
      $data = $this->db->query("SELECT * FROM tbl_loans WHERE loan_status = 'withdrawal'");
      $all_loans = $data->result();
        foreach($all_loans as $loan){
        	  //  echo "<br>";
        	  //  echo $loan->loan_id;
        	  //   echo "<br>";
        	  // exit();
      $this->withdraw_automatic_loan($loan->loan_id);
        }

      }

      //update return date
public function update_returntime($loan_id,$day,$dis_date){
$now = date("Y-m-d H:i");
$someDate = DateTime::createFromFormat("Y-m-d H:i",$now);
$someDate->add(new DateInterval('P'.$day.'D'));
     $return_data = $someDate->format("Y-m-d 23:59");
     $rtn = $someDate->format("Y-m-d 23:59");
$sqldata="UPDATE `tbl_loans` SET `dis_date`='$now',`return_date`= '$return_data',`date_show`='$rtn',`dep_status`='open' WHERE `loan_id`= '$loan_id'";
  $query = $this->db->query($sqldata);
   return true;
}

       public function withdraw_automatic_loan($loan_id){
      	ini_set("max_execution_time", 3600);
      	$this->load->model('queries');
      	$loan_data = $this->queries->get_loan_LoandataAutomatic($loan_id);
         if (!empty($loan_data)) {
      	  $loan_id = $loan_data->loan_id;
      	  $loan_aprove = $loan_data->loan_aprove;
      	  $session = $loan_data->session;
      	  $balance = $loan_data->balance;
      	  $description = $loan_data->description;
      	  $comp_id = $loan_data->comp_id;
      	  $blanch_id = $loan_data->blanch_id;
      	  $customer_id = $loan_data->customer_id;
      	  $group_id = $loan_data->group_id;
      	  $loan_status = $loan_data->loan_status;
      	  $loan_end_date = $loan_data->loan_end_date;
      	  $depost = $loan_data->depost;
      	  $restoration = $loan_data->restration;
      	  $loan_int = $loan_data->loan_int;
      	  $kumaliza = $depost;
      	    // print_r($group_id);
      	    //      exit();
      	  $day = $loan_data->day;
      	  $disburse_day = $loan_data->disburse_day;
      	  $dis_date = $loan_data->dis_date;
      	  //$rtn_date = $loan_data->rtn_date;
      	  $return_date = $loan_data->return_date;

      	  $old_balance_data = $balance;

      	  $interest_formular = $loan_data->interest_formular;
      	  $day = $loan_data->day;
      	  $interest = $interest_formular /100 * $loan_aprove;
      	  $total_loan_interest = $interest + $loan_aprove;

      	  $totalloan =  $loan_int;

      	  $total_session = $session;
      	  $time_return = $total_session;

      	  //$loan_returnday = $totalloan / $time_return;

      	  $loan_returnday = $restoration;

      	  $loanreturn = $loan_returnday;
           
      	  $withdraw_ba = $old_balance_data - $loanreturn;
      	  $remain = $withdraw_ba;
      	  $chukua_chote = $old_balance_data - $old_balance_data;

      	  $today = date("Y-m-d 23:59");
      	  //$today = date("2022-10-12 23:59");
      	  @$loans = $this->queries->get_sum_deposit($loan_id);
      	  $depost_data = @$loans->depos;
      	  $rem = $totalloan - $depost_data;
      	      // print_r($depost_data);
      	      //  exit();
      	  //loan penart by samwel
      	   $penart_data = $loan_data->penat_status;
      	   $penart_status = $penart_data;
      	   $action_penart = $loan_data->action_penart;
      	   $action = $action_penart;
      	   $penart_value = $loan_data->penart;
      	   $money_value = $penart_value;
      	   $restoration_loan = $loan_data->restration;
      	   $lejesho = $restoration_loan;
           
      	   //asilimia lejesho
      	   $percent_calc = $money_value / 100 * $lejesho;
            
           if ($old_balance_data >= $loanreturn) {
      	       $sua = 0;
      	  
      	   }elseif($old_balance_data == 0){
      	   	    $sua = 0;
      	   }elseif($loanreturn >= $old_balance_data) {
      	   	$sua = $loanreturn - $old_balance_data;
            }

           @$loan_balance_check = $this->queries->get_Desc_balance($loan_id);
           $pay_balance_check = @$loan_balance_check->balance;
           $reamain_kulipwa = $lejesho - $pay_balance_check;

            @$deni_ckeck = $this->queries->check_loan_pending($loan_id);
            $total_pend = @$deni_ckeck->total_pend;
            $deni_baki = $total_pend + $reamain_kulipwa;

                 if($loan_end_date == $today and $loan_status == 'withdrawal'){
                  $this->insert_outStandLoan($comp_id,$blanch_id,$loan_id,$group_id,$customer_id,$rem,$group_id);
                  	$this->update_loastatus_outstand($loan_id);
                  	$this->update_customer_status_out($customer_id);
                  	$this->update_recovery($loan_id);
                    }elseif($depost_data >= $totalloan){
                    $this->update_loastatus($loan_id);
                    $this->insert_loan_kumaliza($comp_id,$blanch_id,$customer_id,$loan_id,$kumaliza,$group_id);
                    //$this->update_shedure_paid($loan_id);
                    $this->update_customer_status($customer_id);
                       	//echo"tayali";
                       }elseif($return_date == NULL){
                       	//echo "bado sana";
                    }elseif($return_date == $today){
                    if($old_balance_data < $loanreturn and $penart_status == 'YES' and $action == 'MONEY VALUE'){ 
                    	//insert penart money value
                    	//echo "penati ya hela";
                   $this->insert_loanPenart_moneyValue($comp_id,$blanch_id,$customer_id,$loan_id,$money_value,$group_id);
                       // insert pending loan
                   $this->insert_pending_data($comp_id,$blanch_id,$customer_id,$loan_id,$totalloan,$day,$loanreturn,$old_balance_data,$group_id);
                   if ($total_pend == TRUE || $total_pend == '0') {
                   $this->update_pending_total($loan_id,$deni_baki);
                   }elseif ($total_pend == FALSE) {
                   $this->insert_pending_total($comp_id,$customer_id,$blanch_id,$loan_id,$reamain_kulipwa);	
                   }
                   
                   //insert customer report money value
                   $this->insert_loan_pending_report($comp_id,$blanch_id,$customer_id,$loan_id,$loanreturn,$sua,$money_value,$group_id);
                   $this->witdrow_balanceAutoYote($loan_id,$comp_id,$blanch_id,$customer_id,$old_balance_data,$chukua_chote,$description,$group_id);
                   //$this->update_shedure_notpaid($loan_id);
                       //echo "anadaiwa";
                   }elseif($old_balance_data < $loanreturn and $penart_status == 'YES' and $action == 'PERCENTAGE VALUE'){
                   //	echo "penati ya asilimia";
                   	//insert loanpenart percentage value
                   $this->insert_loanPenart_percentage_Value($comp_id,$blanch_id,$customer_id,$loan_id,$percent_calc,$group_id);
                   $this->witdrow_balanceAutoYote($loan_id,$comp_id,$blanch_id,$customer_id,$old_balance_data,$chukua_chote,$description,$group_id);
                   	   //insert pending loan
                   $this->insert_pending_data($comp_id,$blanch_id,$customer_id,$loan_id,$totalloan,$day,$loanreturn,$old_balance_data,$group_id);
                   if ($total_pend == TRUE || $total_pend == '0') {
                   $this->update_pending_total($loan_id,$deni_baki);
                   }elseif ($total_pend == FALSE) {
                   $this->insert_pending_total($comp_id,$customer_id,$blanch_id,$loan_id,$reamain_kulipwa);	
                   }
                   	   //update return date
                      //insert customer report percentage value
                   $this->insert_loan_pending_reportPercentage_value($comp_id,$blanch_id,$customer_id,$loan_id,$loanreturn,$sua,$percent_calc,$group_id);
                   //$this->update_shedure_notpaid($loan_id);
                   }elseif($old_balance_data < $loanreturn and $penart_status == 'NO'){
                   	 //echo "hakuna penart";
                   	 //insert loan penart
                   $this->insert_pending_data($comp_id,$blanch_id,$customer_id,$loan_id,$totalloan,$day,$loanreturn,$old_balance_data,$group_id);
                    //insert customer report no penart 
                   $this->insert_loan_penart_free($comp_id,$blanch_id,$customer_id,$loan_id,$loanreturn,$sua,$group_id);
                   $this->witdrow_balanceAutoYote($loan_id,$comp_id,$blanch_id,$customer_id,$old_balance_data,$chukua_chote,$description,$group_id);
                   if ($total_pend == TRUE || $total_pend == '0') {
                   $this->update_pending_total($loan_id,$deni_baki);
                   }elseif ($total_pend == FALSE) {
                   $this->insert_pending_total($comp_id,$customer_id,$blanch_id,$loan_id,$reamain_kulipwa);	
                   }
                   //$this->update_shedure_notpaid($loan_id);
                   
                   }if($old_balance_data >= $loanreturn){
                   	  //echo "makato yanaendelea";
                    $this->witdrow_balanceAuto($loan_id,$comp_id,$blanch_id,$customer_id,$loanreturn,$remain,$description,$group_id);
                    $this->insert_loan_penartPaid($comp_id,$blanch_id,$customer_id,$loan_id,$loanreturn,$group_id); 
                    //$this->update_shedure_paid($loan_id); 
                    }
                    //ilinitesa sana hii update return time
                    $this->update_returntime($loan_id,$day,$dis_date);
                    }
                  }
                 }

                 // elseif($old_balance_data < $loanreturn){
                 // {
                 //    }
      public function update_recovery($loan_id){
       //$today = date("Y-m-d");
     $sqldata="UPDATE `tbl_pending_total` SET `total_pend`= '0' WHERE `loan_id`= '$loan_id'";
     $query = $this->db->query($sqldata);
     return true;	
      }           
      public function update_pending_total($loan_id,$deni_baki){
      //$today = date("Y-m-d");
     $sqldata="UPDATE `tbl_pending_total` SET `total_pend`= '$deni_baki' WHERE `loan_id`= '$loan_id'";
     $query = $this->db->query($sqldata);
     return true;	
      }

      public function insert_pending_total($comp_id,$customer_id,$blanch_id,$loan_id,$reamain_kulipwa){
      	$date = date("Y-m-d");
         $this->db->query("INSERT INTO  tbl_pending_total (`comp_id`,`customer_id`,`blanch_id`,`loan_id`,`total_pend`,`date`) VALUES ('$comp_id','$customer_id','$blanch_id','$loan_id','$reamain_kulipwa','$date')");	
        }

     public function update_shedure_paid($loan_id){
     $today = date("Y-m-d");
     //$today = date("2022-02-16");
     $sqldata="UPDATE `tbl_test_date` SET `date_status`= 'paid' WHERE `loan_id`= '$loan_id' AND `date` ='$today'";
    // print_r($sqldata);
    //    exit();
     $query = $this->db->query($sqldata);
     return true;	
     }


     public function update_shedure_notpaid($loan_id){
     $today = date("Y-m-d");
     //$today = date("2022-02-16");
     $sqldata="UPDATE `tbl_test_date` SET `date_status`= 'not paid' WHERE `loan_id`= '$loan_id' AND `date` ='$today'";
    // print_r($sqldata);
    //    exit();
     $query = $this->db->query($sqldata);
     return true;	
     }



public function update_customer_status_out($customer_id){
$sqldata="UPDATE `tbl_customer` SET `customer_status`= 'out' WHERE `customer_id`= '$customer_id'";
$query = $this->db->query($sqldata);
 return true;
}     



         //update customer status
public function update_customer_status($customer_id){
$sqldata="UPDATE `tbl_customer` SET `customer_status`= 'close' WHERE `customer_id`= '$customer_id'";
    // print_r($sqldata);
    //    exit();
  $query = $this->db->query($sqldata);
   return true;
}



   //insert penart in fixed amount by samwel damian
           public function insert_loanPenart_moneyValue($comp_id,$blanch_id,$customer_id,$loan_id,$money_value,$group_id){
    	$day_penart = date("Y-m-d H:i");
    $this->db->query("INSERT INTO tbl_store_penalt (`comp_id`,`blanch_id`,`customer_id`,`loan_id`,`total_penart`,`penart_day`,`group_id`) VALUES ('$comp_id','$blanch_id','$customer_id','$loan_id','$money_value','$day_penart','$group_id')");
       }  

       //insert penart in percentage by samwel damian
     public function insert_loanPenart_percentage_Value($comp_id,$blanch_id,$customer_id,$loan_id,$percent_calc,$group_id){
    	$day_penart = date("Y-m-d H:i");
    $this->db->query("INSERT INTO tbl_store_penalt (`comp_id`,`blanch_id`,`customer_id`,`loan_id`,`total_penart`,`penart_day`,`group_id`) VALUES ('$comp_id','$blanch_id','$customer_id','$loan_id','$percent_calc','$day_penart','$group_id')");
       }
      //insert receivable pending penart report yes/money value
       public function insert_loan_pending_report($comp_id,$blanch_id,$customer_id,$loan_id,$loanreturn,$sua,$money_value,$group_id){
       	$report_day = date("Y-m-d");
    $this->db->query("INSERT INTO tbl_customer_report (`comp_id`,`blanch_id`,`customer_id`,`loan_id`,`recevable_amount`,`pending_amount`,`penart_amount`,`rep_date`,`group_id`) VALUES ('$comp_id','$blanch_id','$customer_id','$loan_id','$loanreturn','$sua','$money_value','$report_day','$group_id')");
       }

         //insert receivable pending penart report yes/percentage value
       public function insert_loan_pending_reportPercentage_value($comp_id,$blanch_id,$customer_id,$loan_id,$loanreturn,$sua,$percent_calc,$group_id){
       	$report_day = date("Y-m-d");
    $this->db->query("INSERT INTO tbl_customer_report (`comp_id`,`blanch_id`,`customer_id`,`loan_id`,`recevable_amount`,`pending_amount`,`penart_amount`,`rep_date`,`group_id`) VALUES ('$comp_id','$blanch_id','$customer_id','$loan_id','$loanreturn','$sua','$percent_calc','$report_day','$group_id')");
       }



       //insert loan free penart
       public function insert_loan_penart_free($comp_id,$blanch_id,$customer_id,$loan_id,$loanreturn,$sua,$group_id){
       		$report_day = date("Y-m-d");
    $this->db->query("INSERT INTO tbl_customer_report (`comp_id`,`blanch_id`,`customer_id`,`loan_id`,`recevable_amount`,`pending_amount`,`rep_date`,`group_id`) VALUES ('$comp_id','$blanch_id','$customer_id','$loan_id','$loanreturn','$sua','$report_day','$group_id')");
       }

            //insert paid not penart
       public function insert_loan_penartPaid($comp_id,$blanch_id,$customer_id,$loan_id,$loanreturn,$group_id){
       		$report_day = date("Y-m-d");
    $this->db->query("INSERT INTO tbl_customer_report (`comp_id`,`blanch_id`,`customer_id`,`loan_id`,`recevable_amount`,`pending_amount`,`rep_date`,`group_id`) VALUES ('$comp_id','$blanch_id','$customer_id','$loan_id','$loanreturn','$loanreturn','$report_day','$group_id')");
       }

               //insert paid kumaliza
       public function insert_loan_kumaliza($comp_id,$blanch_id,$customer_id,$loan_id,$kumaliza,$group_id){
       		$report_day = date("Y-m-d");
    $this->db->query("INSERT INTO tbl_customer_report (`comp_id`,`blanch_id`,`customer_id`,`loan_id`,`recevable_amount`,`pending_amount`,`rep_date`,`group_id`) VALUES ('$comp_id','$blanch_id','$customer_id','$loan_id','$kumaliza','$kumaliza','$report_day','$group_id')");
       }

  //insert pending report by samwel
       public function insert_pending_data($comp_id,$blanch_id,$customer_id,$loan_id,$totalloan,$day,$loanreturn,$old_balance_data,$group_id){
    $day_pend = date("Y-m-d");
    $someDate = DateTime::createFromFormat("Y-m-d",$day_pend);
    $someDate->add(new DateInterval("P1D"));
    $action = $someDate->format("Y-m-d");
    $this->db->query("INSERT INTO tbl_loan_pending (`comp_id`,`blanch_id`,`customer_id`,`loan_id`,`total_loan`,`return_day`,`return_total`,`pend_date`,`action_date`,`group_id`) VALUES ('$comp_id','$blanch_id','$customer_id','$loan_id','$totalloan','$day','$loanreturn'-$old_balance_data,'$day_pend','$action','$group_id')");
      }


             //insert paid customer report and  penart status  No
     public function insert_loan_customer_report_loanStatusNo($comp_id,$blanch_id,$customer_id,$loan_id,$loanreturn,$sua){
       		$report_day = date("Y-m-d");
      $this->db->query("INSERT INTO tbl_customer_report (`comp_id`,`blanch_id`,`customer_id`,`loan_id`,`recevable_amount`,`pending_amount`,`rep_date`) VALUES ('$comp_id','$blanch_id','$customer_id','$loan_id','$loanreturn','$sua','$report_day')");
       }

       public function insert_outStandLoan($comp_id,$blanch_id,$loan_id,$group_id,$customer_id,$rem){
       	$out_day = date("Y-m-d");
        $this->db->query("INSERT INTO tbl_outstand_loan (`comp_id`,`blanch_id`,`customer_id`,`loan_id`,`group_id`,`outstand_date`,`remain_amount`) VALUES ('$comp_id','$blanch_id','$customer_id','$loan_id','$group_id','$out_day','$rem')");

       }

         //update loan out_stand
    public function update_loastatus_outstand($loan_id){
  $sqldata="UPDATE `tbl_loans` SET `loan_status`= 'out' WHERE `loan_id`= '$loan_id'";
    // print_r($sqldata);
    //    exit();
  $query = $this->db->query($sqldata);
   return true;
}

          //update loan status
  public function update_loastatus($loan_id){
  $sqldata="UPDATE `tbl_loans` SET `loan_status`= 'done' WHERE `loan_id`= '$loan_id'";
    // print_r($sqldata);
    //    exit();
  $query = $this->db->query($sqldata);
   return true;
  }


  public function witdrow_balanceAuto($loan_id,$comp_id,$blanch_id,$customer_id,$loanreturn,$remain,$description,$group_id){
    $date = date("Y-m-d");
    $this->db->query("INSERT INTO tbl_pay (`loan_id`,`blanch_id`,`comp_id`,`customer_id`,`withdrow`,`balance`,`description`,`auto_date`,`group_id`,`date_data`) VALUES ('$loan_id','$blanch_id','$comp_id','$customer_id','$loanreturn','$remain','SYSTEM/LOAN RETURN','$date','$group_id','$date')");
         //echo "good data";
  }


      
    public function witdrow_balanceAutoYote($loan_id,$comp_id,$blanch_id,$customer_id,$old_balance_data,$chukua_chote,$description,$group_id){
    $date = date("Y-m-d");
    $this->db->query("INSERT INTO tbl_pay (`loan_id`,`blanch_id`,`comp_id`,`customer_id`,`withdrow`,`balance`,`description`,`auto_date`,`group_id`,`date_data`) VALUES ('$loan_id','$blanch_id','$comp_id','$customer_id','$old_balance_data','$chukua_chote','SYSTEM/LOAN RETURN','$date','$group_id','$date')");
         //echo "good data";
    }

      //end withdrawal function


	public function admin_login(){
		$this->load->view('home/admin');
	}

	public function forgot_password(){
	$this->load->view('home/forgot_password');
	}

	public function search_phone_number(){
	$this->load->model('queries');
	$comp_phone = $this->input->post('comp_phone');
	$phone_data = $this->queries->search_phone($comp_phone);
	@$comp_id = $phone_data->comp_id;
	@$comp_data = $this->queries->view_com($comp_id);
	 // print_r($comp_data);
	 //         exit();
     $this->load->view('home/password',['phone_data'=>$phone_data,'comp_data'=>$comp_data]);
	}

	public function update_password($comp_id){
      $this->form_validation->set_rules('new_password','New pasword','required|matches[password]');
      $this->form_validation->set_rules('password','pasword','required');
      $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
      if ($this->form_validation->run()) {
      	   //$data = $this->input->post();
      	   $data['password'] = sha1($this->input->post('password'));
      	   // print_r($data);
      	   //      exit();
      	   $this->load->model('queries');
      	  if ($this->queries->update_comppassword($comp_id,$data)) {
      	       $this->session->set_flashdata('massage','Password changed successfully');
      	   }else{
      	       $this->session->set_flashdata('error','Failed');

      	   }
      	   return redirect('welcome/search_phone_number');
      }
      $this->search_phone_number();
	}

	//super login

	public function super(){
	$this->load->view('home/super_admin');
	}
   public function super_signin(){
		$this->form_validation->set_rules('email','email','required');
		$this->form_validation->set_rules('password','password','required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
		if ($this->form_validation->run()){
			$email = $this->input->post('email');
			$password = sha1($this->input->post('password'));
			$this->load->model('queries');
			$userexit = $this->queries->super_user_data($email, $password);
			     //print_r($userexit);
			               // exit();
		if ($userexit){
				if ($userexit) {
					$sessionData = [
					'admin_id' => $userexit->admin_id,
					'email' => $userexit->email,
					];
					// print_r($userexit);
					//     exit();
					if ($userexit->email == true){
                      	$this->session->set_userdata($sessionData);
                      	$this->session->set_flashdata('massage','Log in successsfuly');
                      	return redirect('super_admin/index');
                      }elseif ($userexit->email == false) {
                    $this->session->set_userdata($sessionData);
                    $this->session->set_flashdata('massage','Log in successsfuly please update your account');
					return redirect("super_admin/profile");
                      }
				}
				
			}else{
				$this->session->set_flashdata('mass','Your Email or password is invalid Please try again');
				return redirect("welcome/super");
			}
		}
		else{
			$this->super();	
		}
	}

 


// 	//send sms function
// function sendsms($phone,$massage){
//     $message = urlencode($massage);
//     $sender = 'SEDEMO'; 
//     $api_key = 'd4af7dff16f3ab47';
//     $secret_key = 'MjIyNWIwODNmNTNjZTg3OTI2MDBlNGQyYThjNTFjMzAwNmIzMjBhMmJhMGFjNDUxYjRmNmRhOTYxZGY3ZGZiOA==';
    
// $postData = array(
//     'source_addr' => 'INFO',
//     'encoding'=>0,
//     'schedule_time' => '',
//     'message' => $massage,
//     'recipients' => [array('recipient_id' => '1','dest_addr'=>$phone)]
// );

// $Url ='https://apisms.beem.africa/v1/send';

// $ch = curl_init($Url);
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
// curl_setopt_array($ch, array(
//     CURLOPT_POST => TRUE,
//     CURLOPT_RETURNTRANSFER => TRUE,
//     CURLOPT_HTTPHEADER => array(
//         'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
//         'Content-Type: application/json'
//     ),
//     CURLOPT_POSTFIELDS => json_encode($postData)
// ));

// $response = curl_exec($ch);

// if($response === FALSE){
//         echo $response;

//     die(curl_error($ch));
// }
// //var_dump($response);
// return true;

// }


	//Admin log out
	public function logout(){
		$this->session->unset_userdata("comp_id");
		$this->session->set_flashdata('massage',$this->lang->line('logout_menu'));
		return  redirect("welcome/index");
	}

	//Manager log out
	public function empl_logout(){
		$this->session->unset_userdata("empl_id");
		$this->session->set_flashdata('massage',$this->lang->line("logout_menu"));
		return  redirect("welcome/Employee_signin");
	}


	//super log out
	public function super_logout(){
		$this->session->unset_userdata("admin_id");
		$this->session->set_flashdata('massage','');
		return  redirect("welcome/super");
	}

		//general Manager log out
	public function general_manager_logout(){
		$this->session->unset_userdata("empl_id");
		$this->session->set_flashdata('massage','');
		return  redirect("welcome/Employee_signin");
	}

	// public function test_month()
	// {
	// $day_data = 168;
	// $months = floor($day_data / 30);
 //  $days = $day_data-($months*30);
 //  echo  $months ."Months " . $days ."days";
	// }






}
