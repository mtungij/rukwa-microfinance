<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Oficer extends CI_Controller {
	public function index()
	{
	$this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $blanch_id = $manager_data->blanch_id;

    // print_r($manager_data);
    //    exit();

	$this->load->view('oficer/index',['manager_data'=>$manager_data]);
	}

    public function loan_return_statement($customer_id) {
        $this->load->model('queries');
        $loan = $this->queries->get_loan_active_customer($customer_id);
        $total_days = $loan->day * $loan->session;


        $this->load->view('oficer/loan_shedule', [
            'loan' => $loan,
            'total_days' => $total_days,
        ]);
    }

    public function customer_schedule($customer_id,$loan_id) {
      // Fetch customer loan data
          $this->load->model('queries');
          $loan = $this->queries->get_loan_active_customer($customer_id);
          $comp_id = $this->session->userdata('comp_id');
          $blanch_id = $this->session->userdata('blanch_id');
        $empl_id = $this->session->userdata('empl_id');
          $compdata = $this->queries->get_companyData($comp_id);
          $customer_data = $this->queries->get_loan_schedule_customer($loan_id);
          $total_days = $loan->day * $loan->session;
          $blanch_id = $this->session->userdata('blanch_id');
        $empl_id = $this->session->userdata('empl_id');
        $manager_data = $this->queries->get_manager_data($empl_id);
        $comp_id = $manager_data->comp_id;
        $company_data = $this->queries->get_companyData($comp_id);
        $blanch_data = $this->queries->get_blanchData($blanch_id);
        $empl_data = $this->queries->get_employee_data($empl_id);

    $group_loan = $this->queries->get_group_loan_blanch($blanch_id);
    $blanch = $this->queries->get_blanch_data($blanch_id);
    $compdata = $this->queries->get_companyData($comp_id);
  
        $loan_id = $loan->loan_id;
   
  
      // Calculate total days
  
  // echo "<pre>";
  // print_r($compdata);
  // exit();
   
     
      $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']); // 'L' for landscape orientation
      $html = $this->load->view('admin/loan_schedule', [
          'compdata' => $compdata,
          'customer_data' => $customer_data,
          'total_days' => $total_days,
          'loan' => $loan
      ], true);
      
      $mpdf->WriteHTML($html);
      
      // Output the PDF
      $mpdf->Output('loan_schedule.pdf', \Mpdf\Output\Destination::INLINE);
  
      
  }


    public function setting(){
    $this->load->model('queries');
    $empl_id = $this->session->userdata('empl_id');
    $empl_data = $this->queries->get_employee_data($empl_id);
    $this->load->view('oficer/setting',['empl_data'=>$empl_data]);
    }

    //change password
  public function change_password(){
        $this->load->model('queries');
        $blanch_id = $this->session->userdata('blanch_id');
        $empl_id = $this->session->userdata('empl_id');
        $manager_data = $this->queries->get_manager_data($empl_id);
        $comp_id = $manager_data->comp_id;
        $company_data = $this->queries->get_companyData($comp_id);
        $blanch_data = $this->queries->get_blanchData($blanch_id);
        $empl_data = $this->queries->get_employee_data($empl_id);
        $old = $empl_data->password;
        $this->form_validation->set_rules('oldpass', 'old password', 'required');
        $this->form_validation->set_rules('newpass', 'new password', 'required');
        $this->form_validation->set_rules('passconf', 'confirm password', 'required|matches[newpass]');
        $this->form_validation->set_error_delimiters('<strong><div class="text-danger">', '</div></strong>');

        if($this->form_validation->run()) {
          $data = $this->input->post();
          $oldpass = $data['oldpass'];
          $newpass = $data['newpass'];
          $passconf = $data['passconf'];
             // print_r(sha1($newpass));
                 // echo "<br>";
                 // print_r($oldpass);
                 //  echo "<br>";
                 // print_r($old);
                 //    exit();
           if($old !== sha1($oldpass)){
           $this->session->set_flashdata('error','Old Password not Match') ; 
             return redirect('oficer/setting');
         }elseif($old == sha1($oldpass)){
         $this->queries->update_password_dataEmployee($empl_id, array('password' => sha1($newpass)));
         $this->session->set_flashdata('massage','Password changed successfully'); 
        $empl_data = $this->queries->get_employee_data($empl_id);
        $privillage = $this->queries->get_position_empl($empl_id);
        $manager = $this->queries->get_position_manager($empl_id);
        $this->load->view("oficer/setting",['empl_data'=>$empl_data,'privillage'=>$privillage,'manager'=>$manager]);
        
          }else{
           $empl_data = $this->queries->get_employee_data($empl_id);
           $privillage = $this->queries->get_position_empl($empl_id);
           $manager = $this->queries->get_position_manager($empl_id);
        $this->load->view("oficer/setting",['empl_data'=>$empl_data,'privillage'=>$privillage,'manager'=>$manager]);
          }
        }
        }
// check old password is match
        public function password_check($oldpass)
    {
        $this->load->model('queries');
        $blanch_id = $this->session->userdata('blanch_id');
        $empl_id = $this->session->userdata('empl_id');
        $manager_data = $this->queries->get_manager_data($empl_id);
        $comp_id = $manager_data->comp_id;
        $company_data = $this->queries->get_companyData($comp_id);
        $blanch_data = $this->queries->get_blanchData($blanch_id);
        $empl_data = $this->queries->get_employee_data($empl_id);
        $user = $this->queries->get_employee_data($empl_id);
          
        if($user->password !== sha1($oldpass)) {
            $this->form_validation->set_message('error', 'Old Password not Match');
            //return false;
        }

        return redirect("oficer/setting");
    }



	 public function income_dashboard(){
        $this->load->model('queries');
         $blanch_id = $this->session->userdata('blanch_id');
         $empl_id = $this->session->userdata('empl_id');
         $manager_data = $this->queries->get_manager_data($empl_id);
         $comp_id = $manager_data->comp_id;
         $company_data = $this->queries->get_companyData($comp_id);
         $blanch_data = $this->queries->get_blanchData($blanch_id);
         $empl_data = $this->queries->get_employee_data($empl_id);

        $income = $this->queries->get_income($comp_id);
        $detail_income = $this->queries->get_income_detailBlanchData($blanch_id);
        $total_receved = $this->queries->get_sum_incomeBlanchData($blanch_id);
        $customer = $this->queries->get_allcutomerblanchData($blanch_id);
        $acount = $this->queries->get_customer_account_verfied($blanch_id);
        
         // echo "<pre>";
         //   print_r($detail_income);
         //         exit();
        $this->load->view('oficer/income_dashboard',['income'=>$income,'detail_income'=>$detail_income,'total_receved'=>$total_receved,'customer'=>$customer,'empl_data'=>$empl_data,'acount'=>$acount]);
    }

  function fetch_data_vipimioData()
{
$this->load->model('queries');
if($this->input->post('customer_id'))
{
echo $this->queries->fetch_vipmios($this->input->post('customer_id'));
}
}


public function create_income_detail(){
        $this->form_validation->set_rules('comp_id','company','required');
        $this->form_validation->set_rules('blanch_id','company','required');
        $this->form_validation->set_rules('customer_id','company','required');
        $this->form_validation->set_rules('inc_id','Income','required');
        $this->form_validation->set_rules('receve_amount','Amount','required');
        $this->form_validation->set_rules('receve_day','company','required');
        $this->form_validation->set_rules('empl','employee','required');
        $this->form_validation->set_rules('loan_id','Loan','required');
        $this->form_validation->set_rules('trans_id','Account','required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
        if ($this->form_validation->run()) {
             $data = $this->input->post();
             // echo "<pre>";
             // print_r($data);
             //    exit();
            $this->load->model('queries');
            $blanch_id = $data['blanch_id'];
             //$blanch_id = $data['blanch_id'];
            $loan_id = $data['loan_id'];
            $comp_id = $data['comp_id'];
            $penart_paid = $data['receve_amount'];
            $username = $data['empl'];
            $customer_id = $data['customer_id'];
            $penart_date = $data['receve_day'];
            $account = $data['trans_id'];
            $receve_amount = $data['receve_amount'];
            @$blanch_account = $this->queries->get_blanchAccountremain($blanch_id,$account);
             $old_balance = @$blanch_account->blanch_capital;
             $total_new = $old_balance + $receve_amount;
               // print_r($total_new);
               //        exit();
             $inc_id = $data['inc_id'];
             $income_data = $this->queries->get_income_data($inc_id);
             $income_name = $income_data->inc_name;
             $alphabet = $income_name;
             $empl = $username;
             $penart = $this->queries->get_paidPenart($loan_id);

             $loan_income = $this->queries->get_loan_income($loan_id);
             $group_id = $loan_income->group_id;
             
             @$non_deducted = $this->queries->check_nonDeducted_balance($comp_id,$blanch_id);
              $deducted_blanch = @$non_deducted->blanch_id;
              $deducted_balance = @$non_deducted->non_balance;
              $another_deducted = $deducted_balance + $receve_amount;


              
              // print_r($amount);
              //            exit();

              if ($deducted_blanch == TRUE) {
               $this->update_nonDeducted_balance($comp_id,$blanch_id,$another_deducted);
                //echo "update";
              }else{

             $this->insert_non_deducted_balance($comp_id,$blanch_id,$receve_amount);
                //echo "ingiza";
              }

             //  echo "<pre>";
             // print_r($penart);
             //           exit();
                 if($alphabet == 'Penart'|| $alphabet == 'PENART' || $alphabet == 'penart'|| $alphabet == 'faini' || $alphabet == 'FAINI' || $alphabet == 'Faini' || $alphabet == 'fine' || $alphabet == 'FAINI KULALA' || $alphabet == 'faini kulala' || $alphabet == 'Faini kulala' || $alphabet == 'FAINI (PENALTY)' || $alphabet == 'penalt' || $alphabet == 'PENALT' || $alphabet == 'FAINI LALA' || $alphabet == 'PENATI' || $alphabet == 'penati' || $alphabet == 'Penati' || $alphabet == 'Adhabu' || $alphabet == 'ADHABU' || $alphabet == 'adhabu' || $alphabet == 'PENALTY' || $alphabet == 'Penarty' || $alphabet == 'penarty') {
                    if ($penart == TRUE) {
                 $old_paid = $penart->penart_paid;
                $update_paid = $old_paid + $penart_paid;
                $this->update_paidPenart($loan_id,$update_paid);
                $this->insert_income($comp_id,$inc_id,$blanch_id,$customer_id,$username,$penart_paid,$penart_date,$loan_id,$group_id,$account);
                 $this->update_blanch_capital_income($blanch_id,$account,$total_new);
                $this->session->set_flashdata('massage','Tsh. '.$penart_paid .' Paid successfully');
                    }elseif($penart == FALSE){
                 $this->insert_income($comp_id,$inc_id,$blanch_id,$customer_id,$username,$penart_paid,$penart_date,$loan_id,$group_id,$account);
                 $this->insert_penartPaid($loan_id,$inc_id,$blanch_id,$comp_id,$penart_paid,$username,$customer_id,$penart_date,$group_id);
                 $this->update_blanch_capital_income($blanch_id,$account,$total_new);
                 $this->session->set_flashdata('massage','Tsh. '.$penart_paid .' Paid successfully');
                        }
                 
                 }else{ 
              $this->insert_income($comp_id,$inc_id,$blanch_id,$customer_id,$username,$penart_paid,$penart_date,$loan_id,$group_id,$account);
              $this->update_blanch_capital_income($blanch_id,$account,$total_new);
              $this->session->set_flashdata('massage','Tsh. '.$penart_paid .' Paid successfully');
                 }
              // //print_r($alphabet);
              //      exit();
             return redirect('oficer/income_dashboard');
        }
        $this->income_dashboard();
    }


    public function update_blanch_capital_income($blanch_id,$account,$total_new){
    $sqldata="UPDATE `tbl_blanch_account` SET `blanch_capital`= '$total_new' WHERE `blanch_id`= '$blanch_id' AND receive_trans_id = '$account'";
    $query = $this->db->query($sqldata);
    return true;  
    }


    public function insert_penartPaid($loan_id,$inc_id,$blanch_id,$comp_id,$penart_paid,$username,$customer_id,$penart_date,$group_id){
   $this->db->query("INSERT INTO tbl_pay_penart (`loan_id`,`inc_id`,`blanch_id`,`comp_id`,`penart_paid`,`username`,`customer_id`,`penart_date`,`group_id`) VALUES ('$loan_id','$inc_id','$blanch_id','$comp_id','$penart_paid','$username','$customer_id','$penart_date','$group_id')");
  }

    

//insert non-deducted
    public function insert_non_deducted_balance($comp_id,$blanch_id,$receve_amount){
    $this->db->query("INSERT INTO tbl_receive_non_deducted (`comp_id`,`blanch_id`,`non_balance`) VALUES ('$comp_id','$blanch_id','$receve_amount')");
    }

public function update_nonDeducted_balance($comp_id,$blanch_id,$another_deducted){
$sqldata="UPDATE `tbl_receive_non_deducted` SET `non_balance`= '$another_deducted' WHERE `blanch_id`= '$blanch_id'";
$query = $this->db->query($sqldata);
return true;    
}

      public function update_paidPenart($loan_id,$update_paid){
   $sqldata="UPDATE `tbl_pay_penart` SET `penart_paid`= '$update_paid' WHERE `loan_id`= '$loan_id'";
   $query = $this->db->query($sqldata);

   return true;
  }

  public function insert_income($comp_id,$inc_id,$blanch_id,$customer_id,$username,$penart_paid,$penart_date,$loan_id,$group_id,$account){
     $this->db->query("INSERT INTO tbl_receve (`comp_id`,`inc_id`,`blanch_id`,`customer_id`,`empl`,`receve_amount`,`receve_day`,`loan_id`,`group_id`,`trans_id`) VALUES ('$comp_id','$inc_id','$blanch_id','$customer_id','$username','$penart_paid','$penart_date','$loan_id','$group_id','$account')");
  }



  public function delete_receved($receved_id){
        $this->load->model('queries');
        $data_receive = $this->queries->income_receive_delete($receved_id);
        $loan_id = $data_receive->loan_id;
        $receve_amount = $data_receive->receve_amount;
        $blanch_id = $data_receive->blanch_id;

        $pay_penart = $this->queries->get_data_paypenart($loan_id);
        $penart_paid = @$pay_penart->penart_paid;

        $remove_receive = @$penart_paid - $receve_amount;

        $received_non = $this->queries->get_receive_nonDeducted($blanch_id);
        $non_balance = $received_non->non_balance;

        $remain_receive = $non_balance - $receve_amount;

       $this->remove_nondeducted_blanch_accout($blanch_id,$remain_receive);
       $this->remove_paid_penart_loan($loan_id,$remove_receive);
        //    echo "<pre>";
        // print_r($remain_receive);
        //     exit();
        if($this->queries->remove_receved($receved_id));
        $this->session->set_flashdata('massage','Data Deleted successfully');
        return redirect('oficer/income_dashboard');
    }

    public function remove_paid_penart_loan($loan_id,$remove_receive){
    $sqldata="UPDATE `tbl_pay_penart` SET `penart_paid`= '$remove_receive' WHERE `loan_id`= '$loan_id'";
    $query = $this->db->query($sqldata);
    return true;    
    }


    public function remove_nondeducted_blanch_accout($blanch_id,$remain_receive){
    $sqldata="UPDATE `tbl_receive_non_deducted` SET `non_balance`= '$remain_receive' WHERE `blanch_id`= '$blanch_id'";
    $query = $this->db->query($sqldata);
    return true;   
    }



    public function previous_income(){
        $this->load->model('queries');
        $blanch_id = $this->session->userdata('blanch_id');
        $empl_id = $this->session->userdata('empl_id');
        $manager_data = $this->queries->get_manager_data($empl_id);
        $comp_id = $manager_data->comp_id;
        $company_data = $this->queries->get_companyData($comp_id);
        $blanch_data = $this->queries->get_blanchData($blanch_id);
        $empl_data = $this->queries->get_employee_data($empl_id);

        $blanch = $this->queries->get_blanch($comp_id);
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $blanch_id = $this->input->post('blanch_id');
        $comp_id = $this->input->post('comp_id');
        $data = $this->queries->get_previous_income($from,$to,$comp_id,$blanch_id);
        $sum_income = $this->queries->get_sum_previousIncome($from,$to,$comp_id,$blanch_id);

          //   echo "<pre>";
          // print_r($data);
          //     exit();
        $this->load->view('oficer/previous_income',['data'=>$data,'sum_income'=>$sum_income,'from'=>$from,'to'=>$to,'comp_id'=>$comp_id,'blanch_id'=>$blanch_id,'blanch'=>$blanch,'empl_data'=>$empl_data]);
    }



     public function deducted_income(){
        $this->load->model('queries');
        $blanch_id = $this->session->userdata('blanch_id');
        $empl_id = $this->session->userdata('empl_id');
        $manager_data = $this->queries->get_manager_data($empl_id);
        $comp_id = $manager_data->comp_id;
        $company_data = $this->queries->get_companyData($comp_id);
        $blanch_data = $this->queries->get_blanchData($blanch_id);
        $empl_data = $this->queries->get_employee_data($empl_id);

        $deducted_data = $this->queries->get_deducted_balance_blanch($blanch_id);
        $total_deducted = $this->queries->get_today_deducted_feeblanch($blanch_id);
        //  echo "<pre>";
        // print_r($total_deducted);
        //        exit();

        $this->load->view('oficer/deducted_income',['deducted_data'=>$deducted_data,'total_deducted'=>$total_deducted,'empl_data'=>$empl_data]);
      }


      public function filter_deducted_income(){
      	$this->load->model('queries');
      	$blanch_id = $this->session->userdata('blanch_id');
        $empl_id = $this->session->userdata('empl_id');
        $manager_data = $this->queries->get_manager_data($empl_id);
        $comp_id = $manager_data->comp_id;
        $company_data = $this->queries->get_companyData($comp_id);
        $blanch_data = $this->queries->get_blanchData($blanch_id);
        $empl_data = $this->queries->get_employee_data($empl_id);
      	$from = $this->input->post('from');
      	$to = $this->input->post('to');
      	$blanch_id = $this->input->post('blanch_id');
      	$data_deducted = $this->queries->get_deducted_fee_prev($from,$to,$blanch_id);
      	$total_deducted = $this->queries->get_total_deducted($from,$to,$blanch_id);
      	  //    echo "<pre>";
         // print_r($total_deducted);
         //       exit();
      	$this->load->view('oficer/filter_deducted_income',['empl_data'=>$empl_data,'data_deducted'=>$data_deducted,'from'=>$from,'to'=>$to,'total_deducted'=>$total_deducted]);
      }


      public function income_balance(){
      	$this->load->model('queries');
      	$blanch_id = $this->session->userdata('blanch_id');
        $empl_id = $this->session->userdata('empl_id');
        $manager_data = $this->queries->get_manager_data($empl_id);
        $comp_id = $manager_data->comp_id;
        $company_data = $this->queries->get_companyData($comp_id);
        $blanch_data = $this->queries->get_blanchData($blanch_id);
        $empl_data = $this->queries->get_employee_data($empl_id);

        $deducted_balance = $this->queries->get_deducted_income_blanch($blanch_id);
        $non_balance = $this->queries->get_non_deducted_income_blanch($blanch_id);

        $acount = $this->queries->get_customer_account_verfied($blanch_id);

        $transaction = $this->queries->get_income_transaction($blanch_id);

        //         echo "<pre>";
        // print_r($transaction);
        //        exit();

      	$this->load->view('oficer/income_balance',['empl_data'=>$empl_data,'deducted_balance'=>$deducted_balance,'non_balance'=>$non_balance,'acount'=>$acount,'transaction'=>$transaction]);
      }


      public function transfor_income_data(){
        $this->load->model('queries');
        $this->form_validation->set_rules('comp_id','Company','required');
        $this->form_validation->set_rules('deduct_type','Deduction','required');
        $this->form_validation->set_rules('from_blanch_id','blanch','required');
        $this->form_validation->set_rules('from_mount','Amount','required');
        $this->form_validation->set_rules('to_blanch_account_id','Acount','required');
        $this->form_validation->set_rules('trans_fee','Fee','required');
        $this->form_validation->set_rules('user_trans','employee','required');
        $this->form_validation->set_rules('date_transfor','Date','required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

        if ($this->form_validation->run()) {
            $data = $this->input->post();
            $deduct_type = $data['deduct_type'];
            $account = $data['to_blanch_account_id'];
            $amount = $data['from_mount'];
            $fee = $data['trans_fee'];
            $comp_id = $data['comp_id'];
            $emply = $data['user_trans'];
            $blanch = $data['from_blanch_id'];
            $date = $data['date_transfor'];
            $blanch_id = $blanch;

            $amount_fee = $amount + $fee;

            $deducted_income = $this->queries->get_deducted_income_blanch($blanch_id);
            $total_deducted = $deducted_income->total_deducted;
            $remove_deduction = $total_deducted - $amount_fee;

            $non = $this->queries->get_non_deducted_income_blanch($blanch_id);
            $total_nonbalance = $non->total_nonbalance;
            $remove_non = $total_nonbalance - $amount_fee;

            $blanch_account = $this->queries->get_blanch_capital_account($blanch_id,$account);
            $blanch_balance =  $blanch_account->blanch_capital;

            $new_added = $blanch_balance + $amount;

    
            if($deduct_type == 'deducted'){

                if ($total_deducted < $amount_fee) {
                    $this->session->set_flashdata("error",'You don`t Have Enough Balance');
                    return redirect("oficer/income_balance");
                                   
                }else{
                 $this->update_deducted_income_balance($blanch_id,$remove_deduction);   
                  $this->update_account_blanch_balance($blanch_id,$account,$new_added); 
                }
             
            }elseif($deduct_type == 'non deducted'){
            if ($total_nonbalance < $amount_fee) {
               $this->session->set_flashdata("error",'You don`t Have Enough Balance');
                return redirect("oficer/income_balance"); 
            }else{
             $this->update_nondeducted_income_balance($blanch_id,$remove_non);
             $this->update_account_blanch_balance($blanch_id,$account,$new_added);
            }

            }
            
            $this->insert_transaction_fee($comp_id,$blanch_id,$emply,$amount,$account,$fee,$deduct_type,$date);
            $this->session->set_flashdata("massage",'Transaction successfully');
            return redirect('oficer/income_balance');
          }
         $this->income_balance();
       }

       public function update_account_blanch_balance($blanch_id,$account,$new_added){
        $sqldata="UPDATE `tbl_blanch_account` SET `blanch_capital`= '$new_added' WHERE `blanch_id`= '$blanch_id' AND `receive_trans_id`='$account'";

      $query = $this->db->query($sqldata);
      return true;
       }

       public function update_nondeducted_income_balance($blanch_id,$remove_non){
       $sqldata="UPDATE `tbl_receive_non_deducted` SET `non_balance`= '$remove_non' WHERE `blanch_id`= '$blanch_id'";
      $query = $this->db->query($sqldata);
      return true; 
       }

     public function update_deducted_income_balance($blanch_id,$remove_deduction){
      $sqldata="UPDATE `tbl_receive_deducted` SET `deducted`= '$remove_deduction' WHERE `blanch_id`= '$blanch_id'";
      $query = $this->db->query($sqldata);
      return true;  
     }


      public function insert_transaction_fee($comp_id,$blanch_id,$emply,$amount,$account,$fee,$deduct_type,$date){
        $this->db->query("INSERT INTO tbl_transfor_blanch_blanch (`comp_id`,`from_blanch_id`,`user_trans`,`from_mount`,`to_blach_account_id`,`trans_fee`,`deduct_type`,`date_transfor`) VALUES ('$comp_id','$blanch_id','$emply','$amount','$account','$fee','$deduct_type','$date')");
      }



       public function delete_transaction($id){
        $this->load->model('queries');
        $blanch_id = $this->session->userdata('blanch_id');
        $transaction = $this->queries->get_transaction_blanch($id);
        $account = $transaction->to_blach_account_id;
        $type_deduct = $transaction->deduct_type;
        $blanch_id = $transaction->from_blanch_id;
        $amount = $transaction->from_mount;
        $fee = $transaction->trans_fee;

        $amount_fee = $amount + $fee;

        $total_deducted_income = $this->queries->get_deducted_income_blanch($blanch_id);
        $total_deducted = $total_deducted_income->total_deducted;

        $return_deducted = $total_deducted + $amount_fee;
        $remove_deduction = $return_deducted;

        $non_deducted = $this->queries->get_non_deducted_income_blanch($blanch_id);
        $total_non = $non_deducted->total_nonbalance;

        $return_non = $total_non + $amount_fee;
        $remove_non = $return_non;

        $blanch_account = $this->queries->get_blanch_capital_account($blanch_id,$account);
        $blanch_balance =  $blanch_account->blanch_capital;

        $remove_balance = $blanch_balance - $amount;
        $new_added = $remove_balance;


       
        if ($type_deduct == 'deducted') {
         $this->update_deducted_income_balance($blanch_id,$remove_deduction);   
         $this->update_account_blanch_balance($blanch_id,$account,$new_added);   
        }elseif ($type_deduct == 'non deducted') {
        $this->update_nondeducted_income_balance($blanch_id,$remove_non);
        $this->update_account_blanch_balance($blanch_id,$account,$new_added);    
        }

        $this->remove_transaction_fee($id);
        $this->session->set_flashdata("massage",'Adjustiment Successfully');
        return redirect('oficer/income_balance');
        // print_r($amount);
        //      exit();
    }

    public function remove_transaction_fee($id){
    return $this->db->delete('tbl_transfor_blanch_blanch',['id'=>$id]);  
 }


      public function customer(){
      	$this->load->model('queries');
      	$blanch_id = $this->session->userdata('blanch_id');
        $empl_id = $this->session->userdata('empl_id');
        $manager_data = $this->queries->get_manager_data($empl_id);
        $comp_id = $manager_data->comp_id;
        $company_data = $this->queries->get_companyData($comp_id);
        $blanch_data = $this->queries->get_blanchData($blanch_id);
        $empl_data = $this->queries->get_employee_data($empl_id);
        $employee = $this->queries->get_blanch_employee($blanch_id);
        $region = $this->queries->get_region($comp_id);
        // print_r($comp_id);
        //        exit();

      	$this->load->view('oficer/customer',['empl_data'=>$empl_data,'employee'=>$employee,'region'=>$region, 'comp_id' => $comp_id]);
      }



      public function create_customer(){
        $this->form_validation->set_rules('comp_id','company','required');
        $this->form_validation->set_rules('blanch_id','blanch','required');
        $this->form_validation->set_rules('f_name','First name','required');
        $this->form_validation->set_rules('m_name','Middle name','required');
        $this->form_validation->set_rules('l_name','Last name','required');
        $this->form_validation->set_rules('gender','gender','required');
        $this->form_validation->set_rules('phone_no','phone number','required');
        $this->form_validation->set_rules('region_id','region','required');
        // $this->form_validation->set_rules('reg_date','reg_date','required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

		if ($this->form_validation->run()) {
			 $data = $this->input->post();
			 $f_name = $data['f_name'];
			 $m_name = $data['m_name'];
			 $l_name = $data['l_name'];
			 $date = date("Y-m-d");
			 $data['phone_no'] = ('255'.$this->input->post('phone_no'));
    //           echo "<pre>";
			 // print_r($data);
    //               exit();

			 $this->load->model('queries');
			 $check = $this->queries->check_name($f_name,$m_name,$l_name);
			 if ($check == TRUE) {
			 $this->session->set_flashdata('error','This customer Aledy Registered');
		      return redirect('oficer/customer');
			 }elseif($check == FALSE){
			 $customer_id = $this->queries->insert_customer($data);
            
             $number = 'C'.substr($date ,0, 4).substr($date ,5, 2).$customer_id;
             $this->update_customer_number($customer_id,$number);
                // print_r($test);
                //  exit();
			 
			 if ($customer_id > 0){
			 		$this->session->set_flashdata('massage','');
			 		
			 }else{
			 		$this->session->set_flashdata('error','');
			 	}
			return redirect('oficer/customer_details/'.$customer_id);
			 }
			      //      echo "<pre>";
			      // print_r($check);
			              //exit();
			 }
			 $this->customer_details();
		}


		public function update_customer_number($customer_id,$number){
		$sqldata="UPDATE `tbl_customer` SET `customer_code`= '$number' WHERE `customer_id`= '$customer_id'";
       // print_r($sqldata);
        //    exit();
       $query = $this->db->query($sqldata);
        return true;	
		}



		public function customer_details($customer_id){
			$this->load->model('queries');
			$customer = $this->queries->get_customer_data($customer_id);
			$account = $this->queries->get_accountTYpe();
			  // print_r($account);
			  //    exit();
			$this->load->view('oficer/detail',['customer'=>$customer,'account'=>$account]);
		}


        public function create_lastDetail($customer_id){
            //Prepare array of user data
            $data = array(
            'customer_id'=> $this->input->post('customer_id'),
            'account_id'=> $this->input->post('account_id'),
            'natinal_identity' => $this->input->post('natinal_identity'),
            );

            // print_r($data);
            //     exit();

            //Pass user data to model
            $customer_id = $data['customer_id'];
            $natinal_identity = $data['natinal_identity'];
                  
           $this->load->model('queries'); 
           $check_nation_id = $this->queries->check_national_Id($natinal_identity);
             if ($check_nation_id == TRUE) {
            $this->session->set_flashdata('error','Identity Number Aledy Registered'); 
            return redirect('oficer/customer_details/'.$customer_id);
            }elseif ($check_nation_id == FALSE) {
            $data = $this->queries->insert_custome_detail($data);
            //Storing insertion status message.
            if($data){
                $this->update_customer_pendData($customer_id);
                $this->session->set_flashdata('','');
             }else{
                $this->session->set_flashdata('error','Data failed!!');
            }
            }
            return redirect('oficer/viw_ID_sig/'.$customer_id);
          }


          public function viw_ID_sig($customer_id){
            $this->load->model('queries');
            $customer = $this->queries->get_customer_data($customer_id);

            $this->load->view('oficer/customer_id',['customer'=>$customer]);
          }




  public function update_customer_pendData($customer_id){
      $sqldata="UPDATE `tbl_customer` SET `customer_status`= 'pending' WHERE `customer_id`= '$customer_id'";
    // print_r($sqldata);
    //    exit();
  $query = $this->db->query($sqldata);
   return true;  
    }




		// public function update_customerID($customer_id){
  //       if(!empty($_FILES['passport']['name'])){
  //               $config['upload_path'] = 'assets/img/';
  //               $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
  //               $config['file_name'] = $_FILES['passport']['name'];
  //               $config['max_size']      = '8192'; 
  //               $config['remove_spaces']=TRUE;  //it will remove all spaces
  //               $config['encrypt_name']=TRUE;   //it wil encrypte the original file name
  //                   //die($config);
  //               //Load upload library and initialize configuration
  //               $this->load->library('upload',$config);
  //               $this->upload->initialize($config);
                
  //               if($this->upload->do_upload('passport')){
  //                   $uploadData = $this->upload->data();
  //                   $passport = $uploadData['file_name'];
  //               }else{
  //                   $passport = '';
  //               }
  //           }else{
  //               $passport = '';
  //           }
  //           if(!empty($_FILES['signature']['name'])){
  //               $config['upload_path'] = 'assets/img/';
  //               $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
  //               $config['file_name'] = $_FILES['signature']['name'];
  //               $config['max_size']      = '8192'; 
  //               $config['remove_spaces']=TRUE;  //it will remove all spaces
  //               $config['encrypt_name']=TRUE;   //it wil encrypte the original file name
  //                   //die($config);
  //               //Load upload library and initialize configuration
  //               $this->load->library('upload',$config);
  //               $this->upload->initialize($config);
                
  //               if($this->upload->do_upload('signature')){
  //                   $uploadData = $this->upload->data();
  //                   $signature = $uploadData['file_name'];
  //               }else{
  //                   $signature = '';
  //               }
  //           }else{
  //               $signature = '';
  //           }
            
  //           //Prepare array of user data
  //           $data = array(
  //           'customer_id' => $this->input->post('customer_id'),
  //           'signature' => $signature,
  //           'passport' => $passport,
  //           );

  //           $customer_id = $data['customer_id'];
  //           //   echo "<pre>";
  //           // print_r($customer_id);
  //           //  echo "</pre>";
  //           //   exit();
  //          $this->load->model('queries'); 
  //           //Storing insertion status message.
  //           if($data){
  //               $this->queries->update_customer_profile($customer_id,$data);
  //               $this->session->set_flashdata('massage','Customer Registration Successfully');
  //              }else{
  //               $this->session->set_flashdata('error','Data failed!!');
  //           }
  //           return redirect('oficer/customer_profile/'.$customer_id);

  //   }

    function fetch_employee_blanch()
{
$this->load->model('queries');
if($this->input->post('blanch_id'))
{
echo $this->queries->fetch_employee($this->input->post('blanch_id'));
}

}
               


    	public function customer_profile($customer_id){
				$this->load->model('queries');
                $blanch_id = $this->session->userdata('blanch_id');
                $empl_id = $this->session->userdata('empl_id');
		        $manager_data = $this->queries->get_manager_data($empl_id);
		        $comp_id = $manager_data->comp_id;
		        $company_data = $this->queries->get_companyData($comp_id);
		        $blanch_data = $this->queries->get_blanchData($blanch_id);
		        $empl_data = $this->queries->get_employee_data($empl_id);
				$customer_profile = $this->queries->get_customer_profileData($customer_id);

				$blanch = $this->queries->get_blanch($comp_id);
				$sponser = $this->queries->get_guarantors_data($customer_id);
                $loan_customer = $this->queries->get_loan_customer($customer_id);
                $region = $this->queries->get_region($comp_id);
                $account = $this->queries->get_accountTYpe();
				   //   echo "<pre>";
				   // print_r($loan_customer);
				   //          exit();
	    $this->load->view('oficer/customer_profile',['customer_profile'=>$customer_profile,'blanch'=>$blanch,'sponser'=>$sponser,'loan_customer'=>$loan_customer,'region'=>$region,'account'=>$account]);
      }


      public function update_customer_info($customer_id){
		$this->form_validation->set_rules('blanch_id','blanch','required');
		$this->form_validation->set_rules('f_name','First name','required');
		$this->form_validation->set_rules('m_name','Middle name','required');
		$this->form_validation->set_rules('l_name','Last name','required');
		$this->form_validation->set_rules('gender','gender','required');
		$this->form_validation->set_rules('date_birth','date_birth','required');
		$this->form_validation->set_rules('phone_no','phone number','required');
		$this->form_validation->set_rules('region_id','region','required');
		$this->form_validation->set_rules('district','district','required');
		$this->form_validation->set_rules('ward','ward','required');
		$this->form_validation->set_rules('street','street','required');
		$this->form_validation->set_rules('age','age','required');
        $this->form_validation->set_rules('empl_id','empl','required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
		if ($this->form_validation->run()) {
			 $data = $this->input->post();
			 // echo "<pre>";
			 // print_r($data);
			 //     exit();
			 $this->load->model('queries');
			 if ($this->queries->update_customer_info($data,$customer_id)) {
			 	$this->session->set_flashdata('massage','Customer Updated Successfully');
			 }else{
			 $this->session->set_flashdata('error','Failed');	
			 }
			 return redirect('oficer/customer_profile/'.$customer_id);
			}
            $this->customer_profile();
		}


  public function all_customer(){
	$this->load->model('queries');
	$blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);

	$customer = $this->queries->get_customer_blanch($blanch_id);
	
	   //  echo"<pre>";
	   // print_r($customer);
	   // echo"</pre>";
	   //      exit();
	$this->load->view('oficer/all_customer',['customer'=>$customer,'customer'=>$customer]);
}


public function loan_application(){
	$this->load->model('queries');
	$blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);

	$customer = $this->queries->get_allcutomerblanchData($blanch_id);
	  //   echo "<pre>";
	  // print_r($customer);
	  //      exit();
	$this->load->view('oficer/loan_application',['customer'=>$customer]);
}


public function search_customer(){
$this->load->model('queries');
$blanch_id = $this->session->userdata('blanch_id');
$empl_id = $this->session->userdata('empl_id');
$manager_data = $this->queries->get_manager_data($empl_id);
$comp_id = $manager_data->comp_id;
$company_data = $this->queries->get_companyData($comp_id);
$blanch_data = $this->queries->get_blanchData($blanch_id);
$empl_data = $this->queries->get_employee_data($empl_id);

$customer_id = $this->input->post('customer_id');
$customer = $this->queries->search_CustomerID($customer_id,$comp_id);
$sponser = $this->queries->get_sponser($customer_id);
$sponsers_data = $this->queries->get_sponserCustomer($customer_id);
$region = $this->queries->get_region();

if ($customer->member_status == 'group') {
   $this->loan_applicationForm($customer_id);
}else{
$this->load->view('oficer/search_customer',['customer'=>$customer,'sponser'=>$sponser,'sponsers_data'=>$sponsers_data,'region'=>$region]);
}
}



public function modify_sponser($sp_id,$customer_id){
    	$this->form_validation->set_rules('sp_name','Sponser first name','required');
    	$this->form_validation->set_rules('sp_mname','Sponser midle name','required');
    	$this->form_validation->set_rules('sp_lname','Sponser last name','required');
    	$this->form_validation->set_rules('sp_phone_no','Sponser phone number','required');
    	$this->form_validation->set_rules('sp_relation','Sponser relation','required');
        $this->form_validation->set_rules('sp_region','Sponser region','required');
        $this->form_validation->set_rules('sp_district','Sponser district','required');
        $this->form_validation->set_rules('sp_ward','Sponser ward','required');
        $this->form_validation->set_rules('sp_street','Sponser street','required');
    	$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
    	if ($this->form_validation->run()) {
    		$data = $this->input->post();
      //         echo "<pre>";
    		// print_r($data);
    		//       exit();
    		$this->load->model('queries');
    		if ($this->queries->update_sponser($sp_id,$data)) {
    			$this->session->set_flashdata('massage','Sponsers information Updated successfully');
    		}else{
    		$this->session->set_flashdata('error','Failed');	
    		}
    		$sponser = $this->queries->get_sponser($customer_id);
    		$customer_id = $sponser->customer_id;
              // print_r($customer_id);
              //     exit();
    		return redirect('oficer/edit_viewSponser/'.$customer_id);
    	}
    	$this->edit_viewSponser();
    }


    public function edit_viewSponser($customer_id){
    	$this->load->model('queries');
    	$blanch_id = $this->session->userdata('blanch_id');
		$empl_id = $this->session->userdata('empl_id');
		$manager_data = $this->queries->get_manager_data($empl_id);
		$comp_id = $manager_data->comp_id;
		$company_data = $this->queries->get_companyData($comp_id);
		$blanch_data = $this->queries->get_blanchData($blanch_id);
		$empl_data = $this->queries->get_employee_data($empl_id);
    	$sponser = $this->queries->get_sponser($customer_id);
        $sponsers_data = $this->queries->get_sponserCustomer($customer_id);
        $customer = $this->queries->get_search_dataCustomer($customer_id);
        $region = $this->queries->get_region();
        //   echo "<pre>";
        // print_r($customer);
        //        exit();
        $this->load->view('oficer/sponser_view',['sponser'=>$sponser,'sponsers_data'=>$sponsers_data,'customer'=>$customer,'region'=>$region]);

    }


    public function create_sponser($customer_id){
            //Prepare array of user data
            $data = array(
            'sp_name'=> $this->input->post('sp_name'),
            'sp_mname'=> $this->input->post('sp_mname'),
            'customer_id'=> $this->input->post('customer_id'),
            'comp_id'=> $this->input->post('comp_id'),
            'sp_lname'=> $this->input->post('sp_lname'),
            'sp_phone_no'=> $this->input->post('sp_phone_no'),
            'sp_relation'=> $this->input->post('sp_relation'),
            'sp_region'=> $this->input->post('sp_region'),
            'sp_district'=> $this->input->post('sp_district'),
            'sp_ward'=> $this->input->post('sp_ward'),
            'sp_street'=> $this->input->post('sp_street'),
            );
            //   echo "<pre>";
            // print_r($data);
            //  echo "</pre>";
            //   exit();

           $this->load->model('queries'); 
           $data = $this->queries->insert_sponser_info($data);
            //Storing insertion status message.
            if($data){
            	$this->session->set_flashdata('massage','Gualantors information Saved successfully');
               }else{
                $this->session->set_flashdata('error','Data failed!!');
            }
        return redirect("oficer/edit_viewSponser/".$customer_id);        
    }


    public function loan_applicationForm($customer_id){
    	$this->load->model('queries');
    	$blanch_id = $this->session->userdata('blanch_id');
		$empl_id = $this->session->userdata('empl_id');
		$manager_data = $this->queries->get_manager_data($empl_id);
		$comp_id = $manager_data->comp_id;
		$company_data = $this->queries->get_companyData($comp_id);
		$blanch_data = $this->queries->get_blanchData($blanch_id);
		$empl_data = $this->queries->get_employee_data($empl_id);
        $mpl_data_blanch = $this->queries->get_blanchEmployee($blanch_id);

    	$customer = $this->queries->get_customer_data($customer_id);
    	$blanch_id = $customer->blanch_id;
    	$loan_category = $this->queries->get_loancategory($comp_id);
    	$group = $this->queries->get_blanch_group_data($blanch_id);
    	$region = $this->queries->get_region();
    	$blanch = $this->queries->get_blanch($comp_id);
    	$loan_form_request = $this->queries->get_customerDataLOANform($customer_id);
    	$loan_option = $this->queries->get_loan_done($customer_id);
    	$skip_next = $this->queries->get_loanOpen_skip($customer_id);
    	$reject_skip = $this->queries->get_loanOpen_skipReject($customer_id);
    	$formular = $this->queries->get_interestFormular($comp_id);
    	$loan_fee_category = $this->queries->get_loanfee_categoryData($comp_id);
    	
          // echo "<pre>";
          //   print_r($customer);
          //   echo "</pre>";
          //        exit();
    	     
    	$this->load->view('oficer/loan_aplication_form',['customer'=>$customer,'loan_category'=>$loan_category,'group'=>$group,'region'=>$region,'blanch'=>$blanch,'loan_form_request'=>$loan_form_request,'loan_option'=>$loan_option,'skip_next'=>$skip_next,'reject_skip'=>$reject_skip,'formular'=>$formular,'loan_fee_category'=>$loan_fee_category,'mpl_data_blanch'=>$mpl_data_blanch,'empl_data'=>$empl_data]);
    }


    public function loan_group_pending(){
        $this->load->model('queries');
        $blanch_id = $this->session->userdata('blanch_id');
        $empl_id = $this->session->userdata('empl_id');
        $manager_data = $this->queries->get_manager_data($empl_id);
        $comp_id = $manager_data->comp_id;
        $company_data = $this->queries->get_companyData($comp_id);
        $blanch_data = $this->queries->get_blanchData($blanch_id);
        $empl_data = $this->queries->get_employee_data($empl_id);

       $group_pend = $this->queries->get_loan_group_pending_blanch($blanch_id);
       //  echo "<pre>";
       // print_r($group_pend);
       //         exit();
        $this->load->view('oficer/loan_group_pending',['group_pend'=>$group_pend]);
    }



    public function create_loanapplication($customer_id){
    	$this->load->helper('string');
        $this->form_validation->set_rules('comp_id','Company','required');
        $this->form_validation->set_rules('blanch_id','Blanch','required');
        $this->form_validation->set_rules('customer_id','Customer','required');
        $this->form_validation->set_rules('category_id','category','required');
        $this->form_validation->set_rules('group_id','group');
        $this->form_validation->set_rules('how_loan','How loan','required');
        $this->form_validation->set_rules('day','day','required');
        $this->form_validation->set_rules('session','session','required');
        $this->form_validation->set_rules('rate','rate','required');
        $this->form_validation->set_rules('reason','reason','required');
        $this->form_validation->set_rules('renew_loan','instalment','required');
        if ($this->form_validation->run()) {
        	  $data = $this->input->post();
        	  // print_r($data);
        	  //           exit();
        	  $data['loan_code'] = random_string('numeric',14);
        	  
        	  $this->load->model('queries');
        	   $category_id = $data['category_id'];
        	   $how_loan = $data['how_loan'];
        	   $cat = $this->queries->get_loancategoryData($category_id);
        	   $loan_price = $cat->loan_price;
        	   $loan_perday = $cat->loan_perday;
        	   $zaidi = $loan_perday;
        	      // print_r($zaidi);
        	      //       exit();
        	   $input = $how_loan;
        	   $output = $loan_price;
                
                if ($input < $output) {
                $this->session->set_flashdata('mass','Amount of Loan Is Less');
                return redirect('oficer/loan_applicationForm/'.$customer_id);
                }elseif($input > $zaidi){
                	$this->session->set_flashdata('mass','Amount of Loan Is Greater');
                    return redirect('oficer/loan_applicationForm/'.$customer_id);
        	  }else{
        	  $loan_id =  $this->queries->insert_loan($data);
               $this->session->set_flashdata('massage','');	
        	  }
        	  return redirect('oficer/collelateral_session/'.$loan_id);
           }
    		 
          $this->collelateral_session();
    	}




    	public function collelateral_session($loan_id){
    		$this->load->model('queries');
            $loan_attach = $this->queries->get_loanAttach($loan_id);
            $collateral = $this->queries->get_colateral_data($loan_id);
              //   echo "<pre>";
              // print_r($loan_attach);
              //      exit();
    		$this->load->view('oficer/collelateral',['loan_attach'=>$loan_attach,'collateral'=>$collateral]);
    	}


    	public function create_colateral($loan_id){
          
            //Prepare array of user data
            $data = array(
            'description' =>$this->input->post('description'),
            'loan_id' =>$this->input->post('loan_id'),
            'co_condition' =>$this->input->post('co_condition'),
            'value' =>$this->input->post('value'),
            );
            //   echo "<pre>";
            // print_r($data);
            //  echo "</pre>";
            //   exit();
           $this->load->model('queries'); 
            //Storing insertion status message.
            if($data){
                $this->queries->insert($data);
                $this->session->set_flashdata('massage','Colateral Uploaded  Successfully');
               }else{
                $this->session->set_flashdata('error','Data failed!!');
            }
            return redirect('oficer/collelateral_session/'.$loan_id);

    }

     public function view_collateral_photo($col_id,$loan_id){
     $this->load->model('queries');
     $col_image = $this->queries->get_colateral_image($col_id);
     // print_r($col_image);
     //    exit();
     $this->load->view('oficer/collateral_photo',['col_id'=>$col_id,'loan_id'=>$loan_id,'col_image'=>$col_image]);
    }

    public function update_collateral_data(){
     $folder_Path = 'assets/upload/';

        // print_r($_POST['image']);
        // die();
        
        if(isset($_POST['image']) ){
           $col_id = $_POST['id'];
           $image = $_POST['image'];
             // $_POST['id'];
            // print_r($col_id);
            //     die();
             
             $image_parts = explode(";base64,",$_POST['image']);
             $image_type_aux = explode("image/",$image_parts[0]);

             $image_type = $image_type_aux[1];
             $data = $_POST['image'];// base64_decode($image_parts[1]);


            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
             
             $file = $folder_Path .uniqid() .'.png';
            file_put_contents($file, $data);
    
            $this->update_collateral_picture($file,$col_id);
            echo json_encode("Corrateral uploaded Successfully");
           
        }
    }

    public function update_collateral_picture($file,$col_id){
    $sqldata="UPDATE `tbl_collelateral` SET `file_name`= '$file' WHERE `col_id`= '$col_id'";
   $query = $this->db->query($sqldata);
   return true;
   }


    public function modify_loanapplication($customer_id,$loan_id){
    	$this->load->helper('string');
        $this->form_validation->set_rules('comp_id','Company','required');
        $this->form_validation->set_rules('blanch_id','Blanch','required');
        $this->form_validation->set_rules('customer_id','Customer','required');
        $this->form_validation->set_rules('category_id','category','required');
        $this->form_validation->set_rules('empl_id','Employee','required');
        $this->form_validation->set_rules('how_loan','How loan','required');
        $this->form_validation->set_rules('day','day','required');
        $this->form_validation->set_rules('session','session','required');
        $this->form_validation->set_rules('rate','rate','required');
        $this->form_validation->set_rules('loan_status','loan status','required');
        $this->form_validation->set_rules('fee_status','status','required');
        $this->form_validation->set_rules('reason','reason','required');
        $this->form_validation->set_rules('group_id','group','required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
        if ($this->form_validation->run()) {
        	  $data = $this->input->post();

        	  // print_r($data);
        	  //    exit();
        	  
        	  //$data['loan_code'] = random_string('numeric',14);
        	  
        	  $this->load->model('queries');
        	   $category_id = $data['category_id'];
        	   $how_loan = $data['how_loan'];
        	   $cat = $this->queries->get_loancategoryData($category_id);
        	   $loan_price = $cat->loan_price;
        	   $loan_perday = $cat->loan_perday;
        	   $zaidi = $loan_perday;
        	      // print_r($zaidi);
        	      //       exit();
        	   $input = $how_loan;
        	   $output = $loan_price;
                
                if ($input < $output) {
                $this->session->set_flashdata('mass','Amount of Loan Is Less');
                return redirect('oficer/loan_applicationForm/'.$customer_id);
                }elseif($input > $zaidi){
                	$this->session->set_flashdata('mass','Amount of Loan Is Greater');
                    return redirect('oficer/loan_applicationForm/'.$customer_id);
        	  }else{
        	  $this->queries->upadete_loan($data,$loan_id);
               $this->session->set_flashdata('massage','Loan Application Upated successfully');	
        	  }
        	  return redirect('oficer/loan_applicationForm/'.$customer_id);
           }
    		 
          $this->loan_applicationForm();
    	}


    	public function modify_colateral($loan_id,$col_id){
            
            //Prepare array of user data
            $data = array(
            'description' =>$this->input->post('description'),
            //'loan_id' =>$this->input->post('loan_id'),
            'co_condition' =>$this->input->post('co_condition'),
            'value' =>$this->input->post('value'),
            //'file_name' => $file_name,
            );
            //   echo "<pre>";
            // print_r($data);
            //  echo "</pre>";
            //   exit();
           $this->load->model('queries'); 
            //Storing insertion status message.
            if($data){
                $this->queries->queries->update_collateral($data,$col_id);
                $this->update_loan_status($loan_id);
                $this->session->set_flashdata('massage','Colateral Updated  Successfully');
               }else{
                $this->session->set_flashdata('error','Data failed!!');
            }
            return redirect('oficer/collelateral_session/'.$loan_id."/".$col_id);

    }


    public function update_loan_status($loan_id){
     $sqldata="UPDATE `tbl_loans` SET `loan_status`= 'open' WHERE `loan_id`= '$loan_id'";
    // print_r($sqldata);
    //    exit();
  $query = $this->db->query($sqldata);
   return true;   
    }


    public function modify_colateral_picture($loan_id,$col_id){
            if(!empty($_FILES['file_name']['name'])){
                $config['upload_path'] = 'assets/img/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
                $config['file_name'] = $_FILES['file_name']['name'];
                $config['max_size']      = '8192'; 
                $config['remove_spaces']=TRUE;  //it will remove all spaces
                $config['encrypt_name']=TRUE;   //it wil encrypte the original file name
                    //die($config);
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('file_name')){
                    $uploadData = $this->upload->data();
                    $file_name = $uploadData['file_name'];
                }else{
                    $file_name = '';
                }
            }else{
                $file_name = '';
            }
            
            //Prepare array of user data
            $data = array(
            'file_name' => $file_name,
            );
            //   echo "<pre>";
            // print_r($data);
            //  echo "</pre>";
            //   exit();
           $this->load->model('queries'); 
            //Storing insertion status message.
            if($data){
                $this->queries->queries->update_collateral($data,$col_id);
                $this->update_loan_status($loan_id);
                $this->session->set_flashdata('massage','Colateral Updated  Successfully');
               }else{
                $this->session->set_flashdata('error','Data failed!!');
            }
            return redirect('oficer/collelateral_session/'.$loan_id."/".$col_id);

    }


     public function delete_colateral($loan_id,$col_id){
    	$this->load->model('queries');
    	if($this->queries->remove_collateral($col_id));
    	$this->session->set_flashdata('massage','Colateral Deleted successfully');
    	return redirect('oficer/collelateral_session/'.$loan_id."/".$col_id);
    }


    public function local_government($loan_id){
    	$this->load->model('queries');
      $loan_attach = $this->queries->get_loanAttach($loan_id);
      $region = $this->queries->get_region();
      $local_gov = $this->queries->get_localgovernmentDetail($loan_id);
       @$attach_id = $local_gov->attach_id;
      $alert_loan = $this->queries->get_loan_status_alert_group($loan_id);
        // print_r($local_gov);
        //           exit();
    	$this->load->view('oficer/local_government',['loan_attach'=>$loan_attach,'region'=>$region,'local_gov'=>$local_gov,'alert_loan'=>$alert_loan,'attach_id'=>$attach_id]);
    }


    public function Update_local_govDetails($loan_id,$attach_id){
    	$this->load->model('queries');     
            //Prepare array of user data
            $data = array(
            //'loan_id'=> $this->input->post('loan_id'),
            'oficer'=> $this->input->post('oficer'),
            'phone_oficer'=> $this->input->post('phone_oficer'),
            );
           //    echo "<pre>";
           // print_r($data);
           //      exit();
            //Pass user data to model
           $this->load->model('queries'); 
           $data = $this->queries->update_localDetail($data,$attach_id);
           $this->update_loan_status($loan_id);
            //Storing insertion status message.
            if($data){
            	$this->session->set_flashdata('massage','Local government information Updated Successfully');
               }else{
                $this->session->set_flashdata('error','Data failed!!');
            }
           $group = $this->queries->get_loan_status_alert_group($loan_id);
            $group_id = $group->group_id;
              // echo "<pre>";
              // print_r($group_id);
              //      exit();
             if($group_id == TRUE){
            return redirect('oficer/local_government/'.$loan_id."/".$attach_id);
                }else{     
            return redirect('oficer/local_government/'.$loan_id."/".$attach_id);
            }
            
	}


	public function create_local_govDetails($loan_id){
    	$this->load->model('queries');
            //Prepare array of user data
            $data = array(
            'loan_id'=> $this->input->post('loan_id'),
            'oficer'=> $this->input->post('oficer'),
            'phone_oficer'=> $this->input->post('phone_oficer'),
            );
	           //    echo "<pre>";
	           // print_r($data);
	           //      exit();
            //Pass user data to model
           $this->load->model('queries'); 
           $data = $this->queries->insert_localgov_details($data);
          
            //Storing insertion status message.
            if($data){
            	$this->session->set_flashdata('massage','Loan Application Sent Successfully');
               }else{
                $this->session->set_flashdata('error','Data failed!!');
            }
            $group = $this->queries->get_groupLoanData($loan_id);
            $group_id = $group->group_id;
			$customer_id = $group->customer_id;
            //   echo "<pre>";
            //   print_r($customer_id);
            //        exit();
              if ($group_id == TRUE) {
              	 //echo "machemba";
              return redirect('oficer/loan_group_pending/');
                   }else{     
            return redirect('oficer/loan_pending/');
            }
	}


  public function loan_pending(){
    	$this->load->model('queries');
    	$blanch_id = $this->session->userdata('blanch_id');
		$empl_id = $this->session->userdata('empl_id');
		$manager_data = $this->queries->get_manager_data($empl_id);
		$comp_id = $manager_data->comp_id;
		$company_data = $this->queries->get_companyData($comp_id);
		$blanch_data = $this->queries->get_blanchData($blanch_id);
		$empl_data = $this->queries->get_employee_data($empl_id);

        $loan_pending = $this->queries->get_loanPendingBlanch($blanch_id);
        $total_request = $this->queries->get_total_loanPendingBlanch($blanch_id);
            //     echo "<pre>";
            // print_r($loan_pending);
            //     echo "<pre>";
            //         exit();
    	$this->load->view('oficer/loan_pending',['loan_pending'=>$loan_pending,'total_request'=>$total_request,'empl_id'=>$empl_id]);
    }


     public function view_Dataloan($customer_id,$comp_id){
        $this->load->model('queries');
        $blanch_id = $this->session->userdata('blanch_id');
        $empl_id = $this->session->userdata('empl_id');
        $manager_data = $this->queries->get_manager_data($empl_id);
        $comp_id = $manager_data->comp_id;
        $company_data = $this->queries->get_companyData($comp_id);
        $blanch_data = $this->queries->get_blanchData($blanch_id);
        $empl_data = $this->queries->get_employee_data($empl_id);

         $customer = $this->queries->get_loanData($customer_id,$comp_id);
         $sponser_detail = $this->queries->get_sponser_data($customer_id,$comp_id);
         $loan_form = $this->queries->get_formloanData($customer_id,$comp_id);
         $loan_id = $loan_form->loan_id;
         $collateral = $this->queries->get_colateral_data($loan_id);
         $local_oficer = $this->queries->get_loacagovment_data($loan_id);
         $inc_history = $this->queries->get_loanIncomeHistory($customer_id);
 
            // echo "<pre>";
            // print_r($collateral);
            // echo "</pre>";
            // exit();
        $this->load->view('oficer/view_loan_customer',['customer'=>$customer,'sponser_detail'=>$sponser_detail,'loan_form'=>$loan_form,'collateral'=>$collateral,'local_oficer'=>$local_oficer,'inc_history'=>$inc_history,'customer_id'=>$customer_id,'loan_id'=>$loan_id]);
    }





    public function group_list(){
        $this->load->model('queries');
       $blanch_id = $this->session->userdata('blanch_id');
        $empl_id = $this->session->userdata('empl_id');
        $manager_data = $this->queries->get_manager_data($empl_id);
        $comp_id = $manager_data->comp_id;
        $company_data = $this->queries->get_companyData($comp_id);
        $blanch_data = $this->queries->get_blanchData($blanch_id);
        $empl_data = $this->queries->get_employee_data($empl_id);

        $group_loan = $this->queries->get_group_loan_blanch($blanch_id);
        //$blanch = $this->queries->get_blanch($comp_id);
        // echo "<pre>";
        // print_r($group_loan);
        //         exit();
        $this->load->view('oficer/group_list',['group_loan'=>$group_loan,'empl_data'=>$empl_data]);
    }

    public function print_collection_sheet(){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
        $empl_id = $this->session->userdata('empl_id');
        $manager_data = $this->queries->get_manager_data($empl_id);
        $comp_id = $manager_data->comp_id;
        $company_data = $this->queries->get_companyData($comp_id);
        $blanch_data = $this->queries->get_blanchData($blanch_id);
        $empl_data = $this->queries->get_employee_data($empl_id);

    $group_loan = $this->queries->get_group_loan_blanch($blanch_id);
    $blanch = $this->queries->get_blanch_data($blanch_id);
    $compdata = $this->queries->get_companyData($comp_id);


    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8','format' => 'A4-L','orientation' => 'L']);
    $html = $this->load->view('oficer/print_collection_sheet',['compdata'=>$compdata,'blanch'=>$blanch,'group_loan'=>$group_loan],true);
    $mpdf->SetFooter('Generated By Brainsoft Technology');
    $mpdf->WriteHTML($html);
    $mpdf->Output();
    }


    public function filter_group_collection(){
        //exit();
    $this->load->model('queries');
        $blanch_id = $this->session->userdata('blanch_id');
        $empl_id = $this->session->userdata('empl_id');
        $manager_data = $this->queries->get_manager_data($empl_id);
        $comp_id = $manager_data->comp_id;
        $company_data = $this->queries->get_companyData($comp_id);
        $blanch_data = $this->queries->get_blanchData($blanch_id);
        $empl_data = $this->queries->get_employee_data($empl_id);

    $blanch_id = $this->input->post('blanch_id');
    $loan_status = $this->input->post('loan_status');
    $blanch = $this->queries->get_blanch($comp_id);
    $blanch_data = $this->queries->get_blanch_data($blanch_id); 

    $this->load->view('oficer/group_collection',['blanch_id'=>$blanch_id,'loan_status'=>$loan_status,'blanch'=>$blanch,'blanch_data'=>$blanch_data,'empl_data'=>$empl_data]);
    }


    public function print_group_collection($blanch_id,$loan_status){
    $this->load->model('queries');
    $this->load->model('queries');
        $blanch_id = $this->session->userdata('blanch_id');
        $empl_id = $this->session->userdata('empl_id');
        $manager_data = $this->queries->get_manager_data($empl_id);
        $comp_id = $manager_data->comp_id;
        $company_data = $this->queries->get_companyData($comp_id);
        $blanch_data = $this->queries->get_blanchData($blanch_id);
        $empl_data = $this->queries->get_employee_data($empl_id);
    $compdata = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanch_data($blanch_id);

    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8','format' => 'A4-L','orientation' => 'L']);
    $html = $this->load->view('oficer/print_blanch_group_collection',['compdata'=>$compdata,'blanch_data'=>$blanch_data,'blanch_id'=>$blanch_id,'loan_status'=>$loan_status],true);
    $mpdf->SetFooter('Generated By Brainsoft Technology');
    $mpdf->WriteHTML($html);
    $mpdf->Output();
    //$this->load->view('admin/print_blanch_group_collection');
    }


     public function aprove_loan($loan_id){
        $this->load->helper('string');
            //Prepare array of user data
        $day = date('Y-m-d H:i');
            $data = array(
            'loan_aprove'=> $this->input->post('loan_aprove'),
            'penat_status'=> $this->input->post('penat_status'),
            'loan_status'=> 'aproved',
            'loan_day' => $day,
            'code' => random_string('numeric',4),
           
            );
            //   echo "<pre>";
            // print_r($data);
            //  echo "</pre>";
            //   exit();
            
            //Pass user data to model
           $this->load->model('queries');
            $loan_data = $this->queries->get_loan_data($loan_id);
            // echo "<pre>";
            // print_r($loan_data);
            //         exit();
            $data = $this->queries->update_status($loan_id,$data);
           if ($loan_data->fee_status == 'YES') {
             $this->disburse($loan_id);
             }elseif ($loan_data->fee_status == 'NO') {
             $this->disburse_lonnottfee($loan_id);
             }
            //Storing insertion status message.
            if($data){
                
                $this->session->set_flashdata('massage','Loan Approved successfully');
            }else{
                $this->session->set_flashdata('error','Data failed!!');
            }
            return redirect('oficer/loan_pending');
    }



    public function disburse($loan_id){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);
   
    //$admin_data = $this->queries->get_admin_role($comp_id);
    $loan_fee = $this->queries->get_loanfee($comp_id);
    $loan_data = $this->queries->get_loanDisbarsed($loan_id);
    $loan_data_interst = $this->queries->get_loanInterest($loan_id);
    $loan_fee_sum = $this->queries->get_sumLoanFee($comp_id);
    $total_loan_fee = $loan_fee_sum->total_fee;
        
      $loan_id = $loan_data->loan_id;
      $blanch_id = $loan_data->blanch_id;
      $comp_id = $loan_data->comp_id;
      $customer_id = $loan_data->customer_id;
      $balance = $loan_data->loan_aprove;
      $group_id = $loan_data->group_id;
      $loan_codeID = $loan_data->loan_code;
      $code = $loan_data->code;
      $comp_name = $loan_data->comp_name;
      $phones = $loan_data->phone_no;
       if ($loan_data->day == '7') {
      $day = $loan_data->day + 1;
      }else{
      $day = $loan_data->day;
      }
      $session = $loan_data->session;

      //admin data
      $role = $empl_data->username;
// print_r($loan_data);
//        exit();
      $interest_loan = $loan_data_interst->interest_formular;
      $interest = $interest_loan;
      $end_date = $day * $session;
      if($loan_data_interst->rate == 'FLAT RATE') {

        $day_data = $end_date;
        $months = floor($day_data / 30);
       
      $loan_interest = $interest /100 * $balance * $months;
      $total_loan = $balance + $loan_interest;

      }elseif($loan_data_interst->rate == 'SIMPLE'){
      $loan_interest = $interest /100 * $balance;
      $total_loan = $balance + $loan_interest;
      }elseif($loan_data_interst->rate == 'REDUCING'){
       $month = date("m");
       $year = date("Y");
       $d=cal_days_in_month(CAL_GREGORIAN,$month,$year);
       $months = $end_date / $d;
       $interest = $interest_loan / 1200;
       $loan = $balance;
       $amount = $interest * -$loan * pow((1 + $interest), $months) / (1 - pow((1 + $interest), $months));
       $total_loan = $amount * 1 * $months;
       $loan_interest = $total_loan - $loan;
       $res = $amount;
      }

      // print_r($total_loan);
      //      echo "<br>";
      //   print_r($loan_interest);
      //      echo "<br>";
      //    print_r($res);
      //      exit();
      //data inorder to send sms
      $sms_data = $total_loan_fee /100 * $balance;
      $remain_balance = $balance - $sms_data;
        
     
      // $sms = 'Taasisi ya '.$comp_name.' Imeingiza Mkopo Kiasi cha Tsh.'.$remain_balance.' kwenye Acc Yako ' . $loan_codeID .' Namba yasiri ya kutolea mkopo ni '.$code;
      // $massage = $sms;
      // $phone = $phones;

      $loan_fee_type = $this->queries->get_loanfee_type($comp_id);
      $type = $loan_fee_type->type;
      $this->insert_loan_aprovedDisburse($comp_id,$loan_id,$customer_id,$blanch_id,$balance,$role,$group_id,$total_loan,$total_loan);
      $unchangable_balance = $balance;
        if ($type == 'PERCENTAGE VALUE') {
      for ($i=0; $i<count($loan_fee); $i++) { 
        $interest = $loan_fee[$i]->fee_interest;
        $fee_description = $loan_fee[$i]->description;
        $fee_number = $loan_fee[$i]->fee_interest;
        $withdraw_balance = $unchangable_balance * ($interest / 100);

        $new_balance = $balance - $withdraw_balance;
        $pay_id = $this->insert_loanfee($loan_fee[$i]->fee_id,$loan_fee[$i]->fee_interest,$loan_fee[$i]->description,$loan_fee[$i]->fee_interest,$loan_id,$blanch_id,$comp_id,$customer_id,$new_balance, $withdraw_balance,$group_id);
     //Update Balance in this Loop
        $balance = $new_balance;   
    }
   }elseif ($type == 'MONEY VALUE') {
     for ($i=0; $i<count($loan_fee); $i++) { 
        $interest = $loan_fee[$i]->fee_interest;
        $fee_description = $loan_fee[$i]->description;
        $fee_number = $loan_fee[$i]->fee_interest;
        $withdraw_balance = $interest;

        $new_balance = $balance - $withdraw_balance;
        $pay_id = $this->insert_loanfee_money($loan_fee[$i]->fee_id,$loan_fee[$i]->fee_interest,$loan_fee[$i]->description,$loan_fee[$i]->fee_interest,$loan_id,$blanch_id,$comp_id,$customer_id,$new_balance, $withdraw_balance,$group_id);

     //Update Balance in this Loop
        $balance = $new_balance;   
    }
   }

           $this->insert_loan_lecord($comp_id,$customer_id,$loan_id,$blanch_id,$total_loan,$loan_interest,$group_id);
           $this->update_loaninterest($pay_id,$total_loan);
           //$this->sendsms($phone,$massage);
           $this->aprove_disbas_status($loan_id);
           
          return redirect('oficer/loan_pending');      
         
         }

         
        public function insert_loan_aprovedDisburse($comp_id,$loan_id,$customer_id,$blanch_id,$balance,$role,$group_id,$total_loan){
        $day = date("Y-m-d");
      $this->db->query("INSERT INTO tbl_pay (`comp_id`,`loan_id`,`customer_id`,`blanch_id`,`balance`,`depost`,`emply`,`description`,`group_id`,`date_data`,`rem_debt`) VALUES ('$comp_id','$loan_id', '$customer_id','$blanch_id','$balance','$balance','$role','CASH DEPOST','$group_id','$day','$total_loan')");
      }


     public function insert_loanfee($loan_fee,$interest,$fee_description,$fee_number,$loan_id,$blanch_id,$comp_id,$customer_id,$new_balance, $withdraw_balance,$group_id){
    $date = date("Y-m-d");
    $this->db->query("INSERT INTO tbl_pay (`fee_id`,`fee_desc`,`fee_percentage`,`loan_id`,`blanch_id`,`comp_id`,`customer_id`,`balance`,`withdrow`,`p_today`,`emply`,`symbol`,`group_id`,`date_data`) VALUES ('$loan_fee','$fee_description','$fee_number','$loan_id','$blanch_id','$comp_id','$customer_id','$new_balance','$withdraw_balance','$date','SYSTEM WITHDRAWAL','%','$group_id','$date')");
   return $this->db->insert_id();
      }

      public function insert_loanfee_money($loan_fee,$interest,$fee_description,$fee_number,$loan_id,$blanch_id,$comp_id,$customer_id,$new_balance, $withdraw_balance,$group_id){
    $date = date("Y-m-d");
    $this->db->query("INSERT INTO tbl_pay (`fee_id`,`fee_desc`,`fee_percentage`,`loan_id`,`blanch_id`,`comp_id`,`customer_id`,`balance`,`withdrow`,`p_today`,`emply`,`symbol`,`group_id`,`date_data`) VALUES ('$loan_fee','$fee_description','$fee_number','$loan_id','$blanch_id','$comp_id','$customer_id','$new_balance','$withdraw_balance','$date','SYSTEM WITHDRAWAL','Tsh','$group_id','$date')");
   return $this->db->insert_id();
      }



         //update loan + interest in pay table
    public function update_loaninterest($pay_id,$total_loan){
  $sqldata="UPDATE `tbl_pay` SET `interest_loan`= '$total_loan' WHERE `pay_id`= '$pay_id'";
    // print_r($sqldata);
    //    exit();
  $query = $this->db->query($sqldata);
   return true;
}




      public function insert_loan_lecord($comp_id,$customer_id,$loan_id,$blanch_id,$total_loan,$loan_interest,$group_id){
        $day = date("Y-m-d");
      $this->db->query("INSERT INTO tbl_prev_lecod (`comp_id`,`customer_id`,`loan_id`,`blanch_id`,`total_loan`,`total_int`,`lecod_day`,`group_id`) VALUES ('$comp_id', '$customer_id','$loan_id','$blanch_id','$total_loan','$loan_interest','$day','$group_id')");
      }




      public function aprove_disbas_status($loan_id){
            //Prepare array of user data
        $this->load->model('queries');
        $blanch_id = $this->session->userdata('blanch_id');
        $empl_id = $this->session->userdata('empl_id');
        $manager_data = $this->queries->get_manager_data($empl_id);
        $comp_id = $manager_data->comp_id;
        $company_data = $this->queries->get_companyData($comp_id);
        $blanch_data = $this->queries->get_blanchData($blanch_id);
        $empl_data = $this->queries->get_employee_data($empl_id);

        $loan_data = $this->queries->get_loanInterest($loan_id);
        $loan_fee_sum = $this->queries->get_sumLoanFee($comp_id);
        $loan_datas = $this->queries->get_loanDisbarsed($loan_id);
        $total_loan_fee = $loan_fee_sum->total_fee;

         //sms count function
          @$smscount = $this->queries->get_smsCountDate($comp_id);
          $sms_number = @$smscount->sms_number;
          $sms_id = @$smscount->sms_id;
           //echo "<pre>";
        // print_r($loan_data);
        //             exit();

        $interest_loan = $loan_data->interest_formular;
        $loan_aproved = $loan_data->loan_aprove;
        $session_loan = $loan_data->session;
         if ($loan_data->day == '7') {
         $day = $loan_data->day + 1;
          }else{
        $day = $loan_data->day;
         }
        $end_date = $day * $session_loan;
      if ($loan_data->rate == 'FLAT RATE') {
      $day_data = $end_date;
      $months = floor($day_data / 30);
           
      $interest = $interest_loan;
      $loan_interest = $interest /100 * $loan_aproved * $months;

      $total_loan = $loan_aproved + $loan_interest; 

      $restoration = ($loan_interest + $loan_aproved) / ($session_loan);
      $res = $restoration;
   }elseif ($loan_data->rate == 'SIMPLE') {
      $interest = $interest_loan;
      $loan_interest = $interest /100 * $loan_aproved;
      $total_loan = $loan_aproved + $loan_interest; 
      $restoration = ($loan_interest + $loan_aproved) / ($session_loan);
      $res = $restoration;
   }elseif($loan_data->rate == 'REDUCING'){
        $month = date("m");
        $year = date("Y");
        $d = cal_days_in_month(CAL_GREGORIAN,$month,$year);
       $months = $end_date / $d;
       $interest = $interest_loan / 1200;
       $loan = $loan_aproved;
       $amount = $interest * -$loan * pow((1 + $interest), $months) / (1 - pow((1 + $interest), $months));
       $total_loan = $amount * 1 * $months;
       $loan_interest = $total_loan - $loan;
       $res = $amount;
   }
             // print_r($total_loan);
             // echo "<br>";
             // print_r($loan_interest);
             //     echo "<br>";
             //  print_r($res);
            //     echo "<br>";
            //  print_r($loan_interest);
            //      echo "<br>";
            //  print_r($total_loan);
            //       exit();
        $day = date('Y-m-d H:i');
        $day_data = date('Y-m-d H:i');
            $data = array(
            'loan_status'=> 'disbarsed',
            'loan_day' => $day,
            'loan_int' => $total_loan,
            'disburse_day' => $day_data,
            'dis_date' => $day_data,
            'restration' => $res,
            );

      $loan_codeID = $loan_datas->loan_code;
      $code = $loan_datas->code;
      $comp_name = $loan_datas->comp_name;
      $comp_phone = $loan_datas->comp_phone;
      $phones = $loan_datas->phone_no;

            //data inorder to send sms
      $sms_data = $total_loan_fee /100 * $loan_aproved;
      $remain_balance = $loan_aproved - $sms_data;
            //   echo "<pre>";
            // print_r($data);
            //  echo "</pre>";
            //   exit();
           //send sms function
         $sms = $comp_name.' Imeingiza Mkopo Kiasi cha Tsh.'.$remain_balance.' kwenye Acc Yako ' . $loan_codeID .' Namba ya Siri Ni' .$code. ' Kwa msaada zaidi piga simu Namba '.$comp_phone;
           $massage = $sms;
           $phone = $phones;
               // print_r($massage);
               //     exit();
            //Pass user data to model
           $this->load->model('queries'); 
            $data = $this->queries->update_status($loan_id,$data);
            
            //Storing insertion status message.
            if($data){
                if (@$smscount->sms_number == TRUE) {
                $new_sms = 1;
                $total_sms = @$sms_number + $new_sms;
                $this->update_count_sms($comp_id,$total_sms,$sms_id);
              }elseif (@$smscount->sms_number == FALSE) {
             $sms_number = 1;
             $this->insert_count_sms($comp_id,$sms_number);
             }
                //$this->sendsms($phone,$massage);
                $this->session->set_flashdata('massage','Loan disbarsed successfully');
            }else{
                $this->session->set_flashdata('error','Data failed!!');
            }

           $group = $this->queries->get_loan_status_alert_group($loan_id);
            if($group->group_id == TRUE) {
            return redirect('oficer/loan_group_pending');    
            }else{
            return redirect('oficer/loan_pending');
        }
    }



        //insert sms counter
    public function insert_count_sms($comp_id,$sms_number){
        $date = date("Y-m-d");
    $this->db->query("INSERT INTO tbl_sms_count (`comp_id`,`sms_number`,`date`) VALUES ('$comp_id','$sms_number','$date')");
      }

      //update smscounter
      public function update_count_sms($comp_id,$total_sms,$sms_id){
      $sqldata="UPDATE `tbl_sms_count` SET `sms_number`= '$total_sms' WHERE `comp_id`= '$comp_id' AND `sms_id`='$sms_id'";
    // print_r($sqldata);
    //    exit();
     $query = $this->db->query($sqldata);
     return true;
      }



    //begin not loan fee function
    public function disburse_lonnottfee($loan_id){
        $this->load->model('queries');
       $blanch_id = $this->session->userdata('blanch_id');
        $empl_id = $this->session->userdata('empl_id');
        $manager_data = $this->queries->get_manager_data($empl_id);
        $comp_id = $manager_data->comp_id;
        $company_data = $this->queries->get_companyData($comp_id);
        $blanch_data = $this->queries->get_blanchData($blanch_id);
        $empl_data = $this->queries->get_employee_data($empl_id);

        //$admin_data = $this->queries->get_admin_role($comp_id);
        $disbursed_data = $this->queries->get_loanDisbarsed($loan_id);
        $loan_data_interst = $this->queries->get_loanInterest($loan_id);
        $int_loan = $loan_data_interst->interest_formular;
        $loan_aproved = $loan_data_interst->loan_aprove;
         $loan_id = $disbursed_data->loan_id;
         $comp_id = $disbursed_data->comp_id;
         $blanch_id = $disbursed_data->blanch_id;
         $customer_id = $disbursed_data->customer_id;
         $balance = $disbursed_data->loan_aprove;
         $group_id = $disbursed_data->group_id;
         $loan_codeID = $disbursed_data->loan_code;
         $session = $disbursed_data->session;
         if ($disbursed_data->day == '7') {
         $day = $disbursed_data->day + 1;
         }else{
         $day = $disbursed_data->day;
         }
         $code = $disbursed_data->code;
         $comp_name = $disbursed_data->comp_name;
         $phones = $disbursed_data->phone_no;
         $deposit = $balance;
         $remain_balance = $balance;
         $end_date = $day * $session;
        
         $fee_category = $this->queries->get_loanfee_categoryData($comp_id);
         $category_fee = $fee_category->fee_category;
         
         $loan_category = $this->queries->get_loanproduct_fee($loan_id);
         $fee_category_type = $loan_category->fee_category_type;
         $fee_value = $loan_category->fee_value;
         
         if ($fee_category_type == 'MONEY') {
          $symbol = "Tsh";
          $with_fee = $fee_value;
          $cash_aprove = $balance - $fee_value;
         }elseif ($fee_category_type == 'PERCENTAGE') {
         $symbol = "%";
         $with_fee = $balance * ($fee_value / 100);
         $cash_aprove = $balance -  $balance * ($fee_value / 100);
         }



         // print_r($cash_aprove);
         //        exit();

         
      if($loan_data_interst->rate == 'FLAT RATE'){  
      
        $day_data = $end_date;
        $months = floor($day_data / 30);

      $interest_loan = $loan_data_interst->interest_formular;
      $interest = $interest_loan;
      $loan_interest = $interest /100 * $deposit * $months;
      $total_loan = $deposit + $loan_interest;

    }elseif ($loan_data_interst->rate == 'SIMPLE') {
     $interest_loan = $loan_data_interst->interest_formular;
      $interest = $interest_loan;
      $loan_interest = $interest /100 * $deposit;
      $total_loan = $deposit + $loan_interest;
    }elseif($loan_data_interst->rate == 'REDUCING'){
      $months = $end_date / 30;
       $interest = $int_loan / 1200;
       $loan = $loan_aproved;
       $amount = $interest * -$loan * pow((1 + $interest), $months) / (1 - pow((1 + $interest), $months));
       $total_loan = $amount * 1 * $months;
       $loan_interest = $total_loan - $loan;
       $res = $amount;  
    }
       
       
         //admin role
      $role = $empl_data->username;
      $fee_description = "Loan Processing Fee";
      $loan_fee = "0";
      if ($category_fee == 'LOAN PRODUCT') {
       //echo "hapa nimakato ya kila loan product"; 
       $pay_id = $this->insert_loan_aprovedDisburse($comp_id,$loan_id,$customer_id,$blanch_id,$balance,$role,$group_id,$total_loan);
       $this->insert_loanfee_money_feetype($loan_fee,$fee_description,$fee_value,$loan_id,$blanch_id,$comp_id,$customer_id,$cash_aprove,$group_id,$symbol,$with_fee);
      }elseif($category_fee == 'GENERAL') {
         //echo "hapa nimakato ya loan fee general";
       $pay_id = $this->insert_loan_aprovedDisburse($comp_id,$loan_id,$customer_id,$blanch_id,$balance,$role,$group_id,$total_loan);
      }
      //exit();
      
      $this->update_loaninterest($pay_id,$total_loan);
      $this->insert_loan_lecord($comp_id,$customer_id,$loan_id,$blanch_id,$total_loan,$loan_interest,$group_id);
      $this->aprove_disbas_statusNotloanfee($loan_id);
           //$this->aprove_disbas_status($loan_id);
      return redirect('oficer/loan_pending');

    }

     public function insert_loanfee_money_feetype($loan_fee,$fee_description,$fee_value,$loan_id,$blanch_id,$comp_id,$customer_id,$cash_aprove,$group_id,$symbol,$with_fee){
    $date = date("Y-m-d");
    $this->db->query("INSERT INTO tbl_pay (`fee_id`,`fee_desc`,`fee_percentage`,`loan_id`,`blanch_id`,`comp_id`,`customer_id`,`balance`,`withdrow`,`p_today`,`emply`,`symbol`,`group_id`,`date_data`) VALUES ('$loan_fee','$fee_description','$fee_value','$loan_id','$blanch_id','$comp_id','$customer_id','$cash_aprove','$with_fee','$date','SYSTEM WITHDRAWAL','$symbol','$group_id','$date')");
   return $this->db->insert_id();
      }




  //loan not loan fee function
    public function aprove_disbas_statusNotloanfee($loan_id){
            //Prepare array of user data
        $this->load->model('queries');
         $blanch_id = $this->session->userdata('blanch_id');
        $empl_id = $this->session->userdata('empl_id');
        $manager_data = $this->queries->get_manager_data($empl_id);
        $comp_id = $manager_data->comp_id;
        $company_data = $this->queries->get_companyData($comp_id);
        $blanch_data = $this->queries->get_blanchData($blanch_id);
        $empl_data = $this->queries->get_employee_data($empl_id);

        $loan_data = $this->queries->get_loanInterest($loan_id);
        $loan_fee_sum = $this->queries->get_sumLoanFee($comp_id);
        $loan_datas = $this->queries->get_loanDisbarsed($loan_id);
        $total_loan_fee = $loan_fee_sum->total_fee;

          //sms count function
          @$smscount = $this->queries->get_smsCountDate($comp_id);
          $sms_number = @$smscount->sms_number;
          $sms_id = @$smscount->sms_id;
           //echo "<pre>";
        // print_r($loan_data);
        //             exit();

        $interest_loan = $loan_data->interest_formular;
        $loan_aproved = $loan_data->loan_aprove;
        $session_loan = $loan_data->session;
        if ($loan_data->day == '7') {
        $day = $loan_data->day + 1;
        }else{
        $day = $loan_data->day;
        }
        $end_date = $day * $session_loan;
       if($loan_data->rate == 'FLAT RATE'){
         // $now = date("Y-m-d");
         // $someDate = DateTime::createFromFormat("Y-m-d",$now);
         // $someDate->add(new DateInterval('P'.$end_date.'D'));
         // $return_data = $someDate->format("Y-m-d");

         // $date1 = $now;
         // $date2 = $return_data;

         // $ts1 = strtotime($date1);
         // $ts2 = strtotime($date2);

         // $year1 = date('Y', $ts1);
         // $year2 = date('Y', $ts2);

         // $month1 = date('m', $ts1);
         // $month2 = date('m', $ts2);

         // $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
        $day_data = $end_date;
        $months = floor($day_data / 30);
           
         $interest = $interest_loan;
         $loan_interest = $interest /100 * $loan_aproved * $months;
         $total_loan = $loan_aproved + $loan_interest; 
         $restoration = ($loan_interest + $loan_aproved) / ($session_loan);
         $res = $restoration;

        }elseif ($loan_data->rate == 'SIMPLE') {
         $interest = $interest_loan;
         $loan_interest = $interest /100 * $loan_aproved;
         $total_loan = $loan_aproved + $loan_interest; 
         $restoration = ($loan_interest + $loan_aproved) / ($session_loan);
         $res = $restoration;   
        }elseif($loan_data->rate == 'REDUCING'){
        $months = $end_date / 30;
        $interest = $interest_loan / 1200;
        $loan = $loan_aproved;
        $amount = $interest * -$loan * pow((1 + $interest), $months) / (1 - pow((1 + $interest), $months));
        $total_loan = $amount * 1 * $months;
        $res = $amount; 
        }

         // print_r($total_loan);
         //   echo "<br>";
         // print_r($res); 
         //      exit();
        $day = date('Y-m-d H:i');
        $day_data = date('Y-m-d H:i');
            $data = array(
            'loan_status'=> 'disbarsed',
            'loan_day' => $day,
            'loan_int' => $total_loan,
            'disburse_day' => $day_data,
            'dis_date' => $day_data,
            'restration' => $res,
            );

      $loan_codeID = $loan_datas->loan_code;
      $code = $loan_datas->code;
      $comp_name = $loan_datas->comp_name;
      $comp_phone = $loan_datas->comp_phone;
      $phones = $loan_datas->phone_no;

           //send sms function
         $sms = $comp_name.' Imeingiza Mkopo Kiasi cha Tsh.'.$loan_aproved.' kwenye Acc Yako ' . $loan_codeID .' Kwa msaada zaidi Piga simu Namba '.$comp_phone;
         $massage = $sms;
         $phone = $phones;
               // print_r($massage);
               //     exit();
            //Pass user data to model
           $this->load->model('queries'); 
            $data = $this->queries->update_status($loan_id,$data);
            
            //Storing insertion status message.
            if($data){
            if (@$smscount->sms_number == TRUE) {
                $new_sms = 1;
                $total_sms = @$sms_number + $new_sms;
                $this->update_count_sms($comp_id,$total_sms,$sms_id);
              }elseif (@$smscount->sms_number == FALSE) {
             $sms_number = 1;
             $this->insert_count_sms($comp_id,$sms_number);
             }
                //$this->sendsms($phone,$massage);
                $this->session->set_flashdata('massage','Loan disbarsed successfully');
            }else{
                $this->session->set_flashdata('error','Data failed!!');
            }

            $group = $this->queries-> get_loan_status_alert_group($loan_id);
           if ($group->group_id == TRUE) {
            return redirect('oficer/loan_group_pending'); 
           }else{
            return redirect('oficer/loan_pending');
            }
         
    }



    public function insert_loannot_fee($loan_id,$comp_id,$blanch_id,$customer_id,$deposit,$balance){
        $this->db->query("INSERT INTO tbl_pay (`loan_id`,`blanch_id`,`comp_id`,`customer_id`,`balance`,`description`) VALUES ('$loan_id','$blanch_id','$comp_id','$customer_id','$balance','CASH DEPOSIT')");
       return $this->db->insert_id();
     }
//end notloanfee function 



      public function disburse_loan(){
        $this->load->model('queries');
        $blanch_id = $this->session->userdata('blanch_id');
        $empl_id = $this->session->userdata('empl_id');
        $manager_data = $this->queries->get_manager_data($empl_id);
        $comp_id = $manager_data->comp_id;
        $company_data = $this->queries->get_companyData($comp_id);
        $blanch_data = $this->queries->get_blanchData($blanch_id);
        $empl_data = $this->queries->get_employee_data($empl_id);



        $disburse = $this->queries->get_DisbarsedLoanBlanch_data($blanch_id);
        $total_loanDis = $this->queries->get_sum_loanDisbursed_blanch($blanch_id);
        $total_interest_loan = $this->queries->get_sum_loanDisburse_interest_blanch($blanch_id);

            // echo "<pre>";
            // print_r($disburse);
            // echo "</pre>";
            //     exit();
        $this->load->view('oficer/disburse_loan',['disburse'=>$disburse,'total_loanDis'=>$total_loanDis,'total_interest_loan'=>$total_interest_loan]);
    }


    public function teller_dashboard(){
        $this->load->model('queries');
        $blanch_id = $this->session->userdata('blanch_id');
        $empl_id = $this->session->userdata('empl_id');
        $manager_data = $this->queries->get_manager_data($empl_id);
        $comp_id = $manager_data->comp_id;
        $company_data = $this->queries->get_companyData($comp_id);
        $blanch_data = $this->queries->get_blanchData($blanch_id);
        $empl_data = $this->queries->get_employee_data($empl_id);

        // $float = $this->queries->get_today_float($comp_id);
        // $depost = $this->queries->get_sumTodayDepost($comp_id);
        // $withdraw = $this->queries->get_sumTodayWithdrawal($comp_id);

        $customer = $this->queries->get_allcutomerblanchData($blanch_id);
          // echo "<pre>";
          // print_r($customer);
          //   exit();
        $this->load->view('oficer/teller_dashboard',['customer'=>$customer,'empl_data'=>$empl_data]);
    }


    public function search_customerData(){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);

    $customery = $this->queries->get_allcutomerblanchData($blanch_id);
    $customer_id = $this->input->post('customer_id');
    $comp_id = $this->input->post('comp_id');
    $customer = $this->queries->search_CustomerLoan($customer_id);
    $acount = $this->queries->get_customer_account_verfied($blanch_id);
    $opening = $this->queries->get_yesterday_data_blanch($blanch_id);
    $depost_today = $this->queries->get_today_deposit_data($blanch_id);
    $withdrawal_today = $this->queries->get_total_expenses_loan_today($blanch_id);
    $closing = $this->queries->get_today_data_close_blanch($blanch_id);

   // print_r($closing);
   //       exit();
  
 $this->load->view('oficer/search_loan_customer',['customer'=>$customer,'customery'=>$customery,'acount'=>$acount,'empl_data'=>$empl_data,'opening'=>$opening,'depost_today'=>$depost_today,'withdrawal_today'=>$withdrawal_today,'closing'=>$closing]);
}



public function create_withdrow_balance($customer_id){
    ini_set("max_execution_time", 3600);
    $this->form_validation->set_rules('customer_id','Customer','required');
    $this->form_validation->set_rules('comp_id','Company','required');
    $this->form_validation->set_rules('blanch_id','blanch','required');
    $this->form_validation->set_rules('loan_id','Loan','required');
    $this->form_validation->set_rules('method','method','required');
    $this->form_validation->set_rules('withdrow','withdrow','required');
    $this->form_validation->set_rules('loan_status','loan status','required');
    $this->form_validation->set_rules('code','Code','required');
    $this->form_validation->set_rules('with_date','with date','required');
    $this->form_validation->set_rules('description','description','required');
    if ($this->form_validation->run() ) {
          $data = $this->input->post();
          $this->load->model('queries');
          $withdrow_newbalance = $data['withdrow'];
          $loan_id = $data['loan_id'];
          $customer_id = $data['customer_id'];
          $blanch_id = $data['blanch_id'];
          $comp_id = $data['comp_id'];
          $description = $data['description'];
          $method = $data['method'];
          $new_code = $data['code'];
          $with_date = $data['with_date'];
          $loan_status = 'withdrawal';
          $new_balance = $withdrow_newbalance;
          $with_method = $method;
          $statusLoan = $loan_status;
          $payment_method = $method;
          $trans_id = $method;

            $empl_id = $this->session->userdata('empl_id');
            $manager_data = $this->queries->get_manager_data($empl_id);
            $comp_id = $manager_data->comp_id;
            $company_data = $this->queries->get_companyData($comp_id);
            $blanch_data = $this->queries->get_blanchData($blanch_id);
            $empl_data = $this->queries->get_employee_data($empl_id);

          // print_r($withdrow_newbalance);
          //        exit();
         
          $day_loan = $this->queries->get_loan_day($loan_id);
          $admin_data = $this->queries->get_admin_role($comp_id);
          $company_data = $this->queries->get_companyData($comp_id);
          $day = $day_loan->day;
          $renew_loan = $day_loan->renew_loan;
          $disburse_day = $day_loan->disburse_day;
          $dis_day = $day_loan->dis_date;
          $session = $day_loan->session;
          $code = $day_loan->code;
          $empl_id = $day_loan->empl_id;
          $loan_aprove = $day_loan->loan_aprove;
          $restoration = $day_loan->restration;
          $loan_codeID = $day_loan->loan_code;
          $group_id = $day_loan->group_id;
          $end_date = $day * $session;

          $instalment = $day * $renew_loan;






         
        // print_r($loan_aprove);
        //          exit();
         //company loan fee setting
         $comp_fee = $this->queries->get_loanfee_categoryData($comp_id);
         $aina_makato = $comp_fee->fee_category;
          //loanfee setting
         $fee_type = $this->queries->get_loanfee_type($comp_id);
         $type = $fee_type->type;

          
         if ($aina_makato == 'LOAN PRODUCT') {
         $category_loan = $this->queries->get_loanproduct_fee($loan_id);
         $fee_category_type = $category_loan->fee_category_type;
         $fee_value = $category_loan->fee_value;
            if ($fee_category_type == 'MONEY') {
            $sum_fee = $this->queries->get_sumfeepercentage($loan_id);
            $fee = $sum_fee->total_fee;
            $sum_total_loanFee = $fee;
            }elseif ($fee_category_type == 'PERCENTAGE') {
                //echo "makato ya percent";
            $sum_fee = $this->queries->get_sumfeepercentage($loan_id);
            $fee = $sum_fee->total_fee;
            $sum_total_loanFee = $loan_aprove * $fee / 100; 
            }
               
          }elseif ($aina_makato == 'GENERAL') {
          if ($type == 'PERCENTAGE VALUE') {
          $sum_fee = $this->queries->get_sumfeepercentage($loan_id);
          $fee = $sum_fee->total_fee;
          $sum_total_loanFee = $loan_aprove * $fee / 100;
          }elseif ($type == 'MONEY VALUE') {
          $sum_fee = $this->queries->get_sumfeepercentage($loan_id);
          $fee = $sum_fee->total_fee;
          $sum_total_loanFee = $fee;
         }

        }
   //       print_r($sum_total_loanFee);
         // exit();
        

          //branch Account
          @$blanch_account = $this->queries->get_amount_remainAmountBlanch($blanch_id,$payment_method);
          $blanch_capital = @$blanch_account->blanch_capital;
          $withMoney = ($blanch_capital) - ($new_balance + $sum_total_loanFee);
           
          //admin role
          $role = $empl_data->username;
             
          $datas_balance = $this->queries->get_remainbalance($customer_id);
          $customer_data = $this->queries->get_customerData($customer_id);
          $phones = $customer_data->phone_no;
          $old_balance = $datas_balance->balance;
         
          $balance = $old_balance;
          $with_balance = $balance - $new_balance; 

          $up_balance = $this->queries->get_upBalance_Data($customer_id);
          $balance = $up_balance->balance;
          $customer_id = $up_balance->customer_id;
          $input_balance = $withdrow_newbalance;

          //$today_float = $this->queries->get_today_cash($blanch_id);
          //$float = $today_float->blanch_capital;
          $remain_balance = $balance;
          $today = date("Y-m-d H:i");

          $sms = 'Tsh.'.$remain_balance.' Imetolewa kwenye Acc Yako ' . $loan_codeID .' Tarehe '.$today;
          $massage = $sms;
          $phone = $phones;

        //sms counter function
          @$smscount = $this->queries->get_smsCountDate($comp_id);
          $sms_number = @$smscount->sms_number;
          $sms_id = @$smscount->sms_id;

          @$check_deducted = $this->queries->get_deducted_blanch($blanch_id);
           $deducted = @$check_deducted->deducted;
           $blanch_deducted = @$check_deducted->blanch_id;
           
           $new_deducted = $deducted + $sum_total_loanFee;


           $data_deducted_fee = $this->queries->get_deduction_amount_frompay($loan_id);
           @$total_fee = $this->queries->get_deduction_amount_fee($loan_id);
           $loan_deducted_fee = @$total_fee->total_fee;

          
           // echo "<pre>";
           //    print_r($loan_deducted_fee);
           //           exit();
              
            //  if($new_code != $code){
            // $this->session->set_flashdata('error','Loan Code is Invalid Please Try Again'); 
            //   }else

             if ($blanch_capital < $withdrow_newbalance) {
                $this->session->set_flashdata('error','Branch Account balance Is Not Enough to withdraw');
                }elseif($input_balance <= $balance){
              //$day_loandata = $this->queries->get_loan_day($loan_id);
              $this->witdrow_balance($loan_id,$comp_id,$blanch_id,$customer_id,$new_balance,$with_balance,$description,$role,$group_id,$method);
              $this->insert_loan_lecordData($comp_id,$customer_id,$loan_id,$blanch_id,$withdrow_newbalance,$group_id,$trans_id,$restoration,$loan_aprove,$empl_id,$with_date);
              $this->withdrawal_blanch_capital($blanch_id,$payment_method,$withMoney);
              $this->insert_deducted_fee($comp_id,$blanch_id,$loan_id,$sum_total_loanFee,$group_id,$trans_id);
               if ($blanch_deducted == TRUE) {
                $this->update_old_deducted_balance($comp_id,$blanch_id,$new_deducted);
                //echo "update";
               }else{
                $this->insert_sum_deducted_fee($comp_id,$blanch_id,$sum_total_loanFee);
                //echo "ingiza";
               }
           // print_r($sum_total_loanFee);
           //            exit();
              $this->update_withtime($loan_id,$with_method,$statusLoan,$input_balance,$with_date);
              $this->update_returntime($loan_id,$instalment,$dis_day,$with_date);
              $this->insert_startLoan_date($comp_id,$loan_id,$blanch_id,$end_date,$customer_id,$with_date);
              $this->update_customer_status($customer_id);

              @$blanch_account = $this->queries->get_amount_remainAmountBlanch($blanch_id,$payment_method);
              $capital_data = @$blanch_account->blanch_capital;
               
              $return_fee = $capital_data + $loan_deducted_fee; 

              $this->update_blanch_capital_account($blanch_id,$payment_method,$return_fee);

               for ($i=0; $i <count($data_deducted_fee) ; $i++) { 
                $loan_fee_amount = $data_deducted_fee[$i]->withdrow;
                $fee = $data_deducted_fee[$i]->fee_id;
                $this->insert_deducted_data($comp_id,$blanch_id,$customer_id,$loan_id,$data_deducted_fee[$i]->fee_id,$data_deducted_fee[$i]->withdrow,$trans_id);
               }
              if($company_data->sms_status == 'YES'){
              
                 //$this->sendsms($phone,$massage);
              }elseif ($company_data->sms_status == 'NO'){
                 //echo "hakuna kitu";
              }
               $this->session->set_flashdata('massage','withdrow Has made Sucessfully');
              }else{
             $this->session->set_flashdata('error','Customer Balance is not Enough to withdraw');
              }
         return redirect('oficer/data_with_depost/'.$customer_id);
         }
      $this->data_with_depost();
     }


     //withdrawal group

     public function create_withdrow_balance_group($customer_id,$group_id){
    ini_set("max_execution_time", 3600);
    $this->form_validation->set_rules('customer_id','Customer','required');
    $this->form_validation->set_rules('comp_id','Company','required');
    $this->form_validation->set_rules('blanch_id','blanch','required');
    $this->form_validation->set_rules('loan_id','Loan','required');
    $this->form_validation->set_rules('method','method','required');
    $this->form_validation->set_rules('withdrow','withdrow','required');
    $this->form_validation->set_rules('loan_status','loan status','required');
    $this->form_validation->set_rules('code','Code','required');
    $this->form_validation->set_rules('with_date','with date','required');
    $this->form_validation->set_rules('description','description','required');
    if ($this->form_validation->run() ) {
          $data = $this->input->post();
          $this->load->model('queries');
          $withdrow_newbalance = $data['withdrow'];
          $loan_id = $data['loan_id'];
          $customer_id = $data['customer_id'];
          $blanch_id = $data['blanch_id'];
          $comp_id = $data['comp_id'];
          $description = $data['description'];
          $method = $data['method'];
          $new_code = $data['code'];
          $with_date = $data['with_date'];
          $loan_status = 'withdrawal';
          $new_balance = $withdrow_newbalance;
          $with_method = $method;
          $statusLoan = $loan_status;
          $payment_method = $method;
          $trans_id = $method;

            $empl_id = $this->session->userdata('empl_id');
            $manager_data = $this->queries->get_manager_data($empl_id);
            $comp_id = $manager_data->comp_id;
            $company_data = $this->queries->get_companyData($comp_id);
            $blanch_data = $this->queries->get_blanchData($blanch_id);
            $empl_data = $this->queries->get_employee_data($empl_id);

          // print_r($withdrow_newbalance);
          //        exit();
         
          $day_loan = $this->queries->get_loan_day($loan_id);
          $admin_data = $this->queries->get_admin_role($comp_id);
          $company_data = $this->queries->get_companyData($comp_id);
          $day = $day_loan->day;
          $renew_loan = $day_loan->renew_loan;
          $disburse_day = $day_loan->disburse_day;
          $dis_day = $day_loan->dis_date;
          $session = $day_loan->session;
          $code = $day_loan->code;
          $empl_id = $day_loan->empl_id;
          $loan_aprove = $day_loan->loan_aprove;
          $restoration = $day_loan->restration;
          $loan_codeID = $day_loan->loan_code;
          $group_id = $day_loan->group_id;
          $end_date = $day * $session;

          $instalment = $day * $renew_loan;






         
        // print_r($loan_aprove);
        //          exit();
         //company loan fee setting
         $comp_fee = $this->queries->get_loanfee_categoryData($comp_id);
         $aina_makato = $comp_fee->fee_category;
          //loanfee setting
         $fee_type = $this->queries->get_loanfee_type($comp_id);
         $type = $fee_type->type;

          
         if ($aina_makato == 'LOAN PRODUCT') {
         $category_loan = $this->queries->get_loanproduct_fee($loan_id);
         $fee_category_type = $category_loan->fee_category_type;
         $fee_value = $category_loan->fee_value;
            if ($fee_category_type == 'MONEY') {
            $sum_fee = $this->queries->get_sumfeepercentage($loan_id);
            $fee = $sum_fee->total_fee;
            $sum_total_loanFee = $fee;
            }elseif ($fee_category_type == 'PERCENTAGE') {
                //echo "makato ya percent";
            $sum_fee = $this->queries->get_sumfeepercentage($loan_id);
            $fee = $sum_fee->total_fee;
            $sum_total_loanFee = $loan_aprove * $fee / 100; 
            }
               
          }elseif ($aina_makato == 'GENERAL') {
          if ($type == 'PERCENTAGE VALUE') {
          $sum_fee = $this->queries->get_sumfeepercentage($loan_id);
          $fee = $sum_fee->total_fee;
          $sum_total_loanFee = $loan_aprove * $fee / 100;
          }elseif ($type == 'MONEY VALUE') {
          $sum_fee = $this->queries->get_sumfeepercentage($loan_id);
          $fee = $sum_fee->total_fee;
          $sum_total_loanFee = $fee;
         }

        }
   //       print_r($sum_total_loanFee);
         // exit();
        

          //branch Account
          @$blanch_account = $this->queries->get_amount_remainAmountBlanch($blanch_id,$payment_method);
          $blanch_capital = @$blanch_account->blanch_capital;
          $withMoney = ($blanch_capital) - ($new_balance + $sum_total_loanFee);
           
          //admin role
          $role = $empl_data->username;
             
          $datas_balance = $this->queries->get_remainbalance($customer_id);
          $customer_data = $this->queries->get_customerData($customer_id);
          $phones = $customer_data->phone_no;
          $old_balance = $datas_balance->balance;
         
          $balance = $old_balance;
          $with_balance = $balance - $new_balance; 

          $up_balance = $this->queries->get_upBalance_Data($customer_id);
          $balance = $up_balance->balance;
          $customer_id = $up_balance->customer_id;
          $input_balance = $withdrow_newbalance;

          //$today_float = $this->queries->get_today_cash($blanch_id);
          //$float = $today_float->blanch_capital;
          $remain_balance = $balance;
          $today = date("Y-m-d H:i");

          $sms = 'Tsh.'.$remain_balance.' Imetolewa kwenye Acc Yako ' . $loan_codeID .' Tarehe '.$today;
          $massage = $sms;
          $phone = $phones;

        //sms counter function
          @$smscount = $this->queries->get_smsCountDate($comp_id);
          $sms_number = @$smscount->sms_number;
          $sms_id = @$smscount->sms_id;

          @$check_deducted = $this->queries->get_deducted_blanch($blanch_id);
           $deducted = @$check_deducted->deducted;
           $blanch_deducted = @$check_deducted->blanch_id;
           
           $new_deducted = $deducted + $sum_total_loanFee;


           $data_deducted_fee = $this->queries->get_deduction_amount_frompay($loan_id);
           @$total_fee = $this->queries->get_deduction_amount_fee($loan_id);
           $loan_deducted_fee = @$total_fee->total_fee;

          
           // echo "<pre>";
           //    print_r($loan_deducted_fee);
           //           exit();
              
            //  if($new_code != $code){
            // $this->session->set_flashdata('error','Loan Code is Invalid Please Try Again'); 
            //   }else

             if ($blanch_capital < $withdrow_newbalance) {
                $this->session->set_flashdata('error','Branch Account balance Is Not Enough to withdraw');
                }elseif($input_balance <= $balance){
              //$day_loandata = $this->queries->get_loan_day($loan_id);
              $this->witdrow_balance($loan_id,$comp_id,$blanch_id,$customer_id,$new_balance,$with_balance,$description,$role,$group_id,$method);
              $this->insert_loan_lecordData($comp_id,$customer_id,$loan_id,$blanch_id,$withdrow_newbalance,$group_id,$trans_id,$restoration,$loan_aprove,$empl_id,$with_date);
              $this->withdrawal_blanch_capital($blanch_id,$payment_method,$withMoney);
              $this->insert_deducted_fee($comp_id,$blanch_id,$loan_id,$sum_total_loanFee,$group_id,$trans_id);
               if ($blanch_deducted == TRUE) {
                $this->update_old_deducted_balance($comp_id,$blanch_id,$new_deducted);
                //echo "update";
               }else{
                $this->insert_sum_deducted_fee($comp_id,$blanch_id,$sum_total_loanFee);
                //echo "ingiza";
               }
           // print_r($sum_total_loanFee);
           //            exit();
              $this->update_withtime($loan_id,$with_method,$statusLoan,$input_balance,$with_date);
              $this->update_returntime($loan_id,$instalment,$dis_day,$with_date);
              $this->insert_startLoan_date($comp_id,$loan_id,$blanch_id,$end_date,$customer_id,$with_date);
              $this->update_customer_status($customer_id);

              @$blanch_account = $this->queries->get_amount_remainAmountBlanch($blanch_id,$payment_method);
              $capital_data = @$blanch_account->blanch_capital;
               
              $return_fee = $capital_data + $loan_deducted_fee; 

              $this->update_blanch_capital_account($blanch_id,$payment_method,$return_fee);

               for ($i=0; $i <count($data_deducted_fee) ; $i++) { 
                $loan_fee_amount = $data_deducted_fee[$i]->withdrow;
                $fee = $data_deducted_fee[$i]->fee_id;
                $this->insert_deducted_data($comp_id,$blanch_id,$customer_id,$loan_id,$data_deducted_fee[$i]->fee_id,$data_deducted_fee[$i]->withdrow,$trans_id);
               }
              if($company_data->sms_status == 'YES'){
              
                 //$this->sendsms($phone,$massage);
              }elseif ($company_data->sms_status == 'NO'){
                 //echo "hakuna kitu";
              }
               $this->session->set_flashdata('massage','withdrow Has made Sucessfully');
              }else{
             $this->session->set_flashdata('error','Customer Balance is not Enough to withdraw');
              }
         return redirect('oficer/view_all_group_loan/'.$group_id);
         }
      $this->view_all_group_loan();
     }


     public function insert_deducted_data($comp_id,$blanch_id,$customer_id,$loan_id,$fee_id,$withdrow,$trans_id){
    $day = date("Y-m-d");
    $this->db->query("INSERT INTO tbl_deduction_data (`comp_id`,`blanch_id`,`customer_id`,`loan_id`,`fee_id`,`deduct_balance`,`date_deduct`,`trans_id`) VALUES ('$comp_id','$blanch_id','$customer_id','$loan_id','$fee_id','$withdrow','$day','$trans_id')");
     }


     public function insert_loan_lecordData($comp_id,$customer_id,$loan_id,$blanch_id,$withdrow_newbalance,$group_id,$trans_id,$restoration,$loan_aprove,$empl_id,$with_date){
    $day = date("Y-m-d H:i:s");
    $this->db->query("INSERT INTO tbl_prev_lecod (`comp_id`,`customer_id`,`loan_id`,`blanch_id`,`withdraw`,`lecod_day`,`group_id`,`restrations`,`loan_aprov`,`with_trans`,`empl_id`,`time_rec`) VALUES ('$comp_id','$customer_id','$loan_id','$blanch_id','$withdrow_newbalance','$with_date','$group_id','$restoration','$loan_aprove','$trans_id','$empl_id','$day')");
  
}



     //update deducted fee
     public function update_old_deducted_balance($comp_id,$blanch_id,$new_deducted){
      $sqldata="UPDATE `tbl_receive_deducted` SET `deducted`= '$new_deducted' WHERE `blanch_id`= '$blanch_id'";
      $query = $this->db->query($sqldata);
      return true;  
     }

     //insert sumdeducted fee
     public function insert_sum_deducted_fee($comp_id,$blanch_id,$sum_total_loanFee){
      $this->db->query("INSERT INTO tbl_receive_deducted (`comp_id`,`blanch_id`,`deducted`) VALUES ('$comp_id','$blanch_id','$sum_total_loanFee')");    
     }
//insert deducted fee
  public function insert_deducted_fee($comp_id,$blanch_id,$loan_id,$sum_total_loanFee,$group_id,$trans_id){
  $day = date("Y-m-d");
    $this->db->query("INSERT INTO tbl_deducted_fee (`comp_id`,`blanch_id`,`loan_id`,`deducted_balance`,`deducted_date`,`group_id`,`trans_id`) VALUES ('$comp_id','$blanch_id','$loan_id','$sum_total_loanFee','$day','$group_id','$trans_id')");   
 }
//withdral blanch Float
public function withdrawal_blanch_capital($blanch_id,$payment_method,$withMoney){
$sqldata="UPDATE `tbl_blanch_account` SET `blanch_capital`= '$withMoney' WHERE `blanch_id`= '$blanch_id' AND `receive_trans_id` = '$payment_method'";
    // print_r($sqldata);
    //  echo "<br>";
    //    exit();
  $query = $this->db->query($sqldata);
   return true;
}


public function update_blanch_capital_account($blanch_id,$payment_method,$return_fee){
 $sqldata="UPDATE `tbl_blanch_account` SET `blanch_capital`= '$return_fee' WHERE `blanch_id`= '$blanch_id' AND `receive_trans_id` = '$payment_method'";
    // print_r($sqldata);
    //  echo "<br>";
    //    exit();
  $query = $this->db->query($sqldata);
   return true;   
}

//update customer status
public function update_customer_status($customer_id){
$sqldata="UPDATE `tbl_customer` SET `customer_status`= 'open' WHERE `customer_id`= '$customer_id'";
    // print_r($sqldata);
    //    exit();
  $query = $this->db->query($sqldata);
   return true;
}

//update customer status
public function update_customer_statusLoan($customer_id){
$sqldata="UPDATE `tbl_customer` SET `customer_status`= 'close' WHERE `customer_id`= '$customer_id'";
    // print_r($sqldata);
    //    exit();
  $query = $this->db->query($sqldata);
   return true;
}


//update withdraw time
 public function update_withtime($loan_id,$with_method,$statusLoan,$input_balance,$with_date){
    $data_day = $with_date;
  $sqldata="UPDATE `tbl_loans` SET `dis_date`= '$data_day',`method`='$with_method',`loan_status`='$statusLoan',`disburse_day`='$data_day',`with_amount`='$input_balance',`region_id`='ok' WHERE `loan_id`= '$loan_id'";
    // print_r($sqldata);
    //    exit();
  $query = $this->db->query($sqldata);
   return true;
}

//update return date
public function update_returntime($loan_id,$instalment,$dis_date,$with_date){
$now = $with_date;
$someDate = DateTime::createFromFormat("Y-m-d",$now);
$someDate->add(new DateInterval('P'.$instalment.'D'));
 //echo $someDate->format("Y-m-d");
       $return_data = $someDate->format("Y-m-d 23:59");
       $rtn = $someDate->format("Y-m-d");
   //       $return = $rtn;
   //print_r($day); 
   //    echo "<br>";
   // print_r($rtn); 
   // echo "<br>";
   //print_r($return_data); 
     //exit();
$sqldata="UPDATE `tbl_loans` SET `dis_date`='$now',`return_date`= '$return_data',`date_show`='$rtn' WHERE `loan_id`= '$loan_id'";
    // print_r($sqldata);
    //    exit();
  $query = $this->db->query($sqldata);
   return true;
}


//insert start loan and end loan  date
// public function insert_startLoan_date($comp_id,$loan_id,$blanch_id){
// // $now = date("Y-m-d");
// // $someDate = DateTime::createFromFormat("Y-m-d",$now);
// // $someDate->add(new DateInterval('P'.$end_date.'D'));
// //  //echo $someDate->format("Y-m-d");
// //        $return_data = $someDate->format("Y-m-d H:i");
// $this->db->query("INSERT INTO tbl_outstand (`comp_id`,`loan_id`,`blanch_id`) VALUES ('$comp_id','$loan_id','$blanch_id')");
// }

public function insert_startLoan_date($comp_id,$loan_id,$blanch_id,$end_date,$customer_id,$with_date){
$this->load->model('queries');
ini_set("max_execution_time", 3600);
$get_day = $this->queries->get_loan_day($loan_id);
$day = $get_day->day;
$now = $with_date;
$someDate = DateTime::createFromFormat("Y-m-d",$now);
$someDate->add(new DateInterval('P'.$end_date.'D'));
$return_data = $someDate->format("Y-m-d 23:59");

$this->db->query("INSERT INTO tbl_outstand (`comp_id`,`loan_id`,`blanch_id`,`loan_stat_date`,`loan_end_date`) VALUES ('$comp_id','$loan_id','$blanch_id','$now','$return_data')");
//     if ($day == 1) {
//      $begin = new DateTime($now);
//      $end = new DateTime($return_data);
//      //$end = $end->modify( '+1 day' );
     
//      $array = array();
//      $interval = DateInterval::createFromDateString('1 day');
//      $period = new DatePeriod($begin, $interval, $end);
      
//      foreach($period as $dt){
//      $array[] = $dt->format("Y-m-d");   
//      } 
//       $loan_id = $loan_id;
//       $customer_id = $customer_id;
//        for($i=0; $i<count($array);$i++) {
//          //$loan_id = 1;
//       $this->db->query("INSERT INTO  tbl_test_date (`date`,`loan_id`,`customer_id`) 
//       VALUES ('".$array[$i]."','$loan_id','$customer_id')"); 
//        }
//    $this->update_shedure_status($loan_id);
//     }elseif($day == 7){
// $startTime = strtotime($now);
// $endTime = strtotime($return_data);
// $weeks = array();
// while ($startTime < $endTime) {  
//     $weeks[] = date('Y-m-d', $startTime); 
//     $startTime += strtotime('+1 week', 0);
// }
//       $loan_id = $loan_id;
//       $customer_id = $customer_id;
//        for($i=0; $i<count($weeks);$i++) {
//          //$loan_id = 1;
//       $this->db->query("INSERT INTO  tbl_test_date (`date`,`loan_id`,`customer_id`) 
//       VALUES ('".$weeks[$i]."','$loan_id','$customer_id')"); 
//      }
//    $this->update_shedure_status($loan_id);
//     }elseif($day == 30){
//     $start = $month = strtotime($now);
//     $end = strtotime($return_data);
//     //$end   =   strtotime("+1 months", $end);
// $months = array();
// while($month < $end){
//      $months[] = date('Y-m-d', $month);
//      $month = strtotime("+1 month", $month);  
//   }
//       $loan_id = $loan_id;
//       $customer_id = $customer_id;
//        for($i=0; $i<count($months);$i++) {
//          //$loan_id = 1;
//       $this->db->query("INSERT INTO  tbl_test_date (`date`,`loan_id`,`customer_id`) 
//       VALUES ('".$months[$i]."','$loan_id','$customer_id')"); 
//      }
//      $this->update_shedure_status($loan_id);
//     }
//      }

//      public function update_shedure_status($loan_id){
//      $today = date("Y-m-d");
//      $sqldata="UPDATE `tbl_test_date` SET `date_status`= 'withdrawal' WHERE `loan_id`= '$loan_id' AND `date` ='$today'";
//     // print_r($sqldata);
//     //    exit();
//      $query = $this->db->query($sqldata);
//      return true;    
     }

    public function witdrow_balance($loan_id,$comp_id,$blanch_id,$customer_id,$new_balance,$with_balance,$description,$role,$group_id,$method){
        $day = date("Y-m-d");
     $this->db->query("INSERT INTO tbl_pay (`loan_id`,`blanch_id`,`comp_id`,`customer_id`,`withdrow`,`balance`,`description`,`pay_status`,`stat`,`date_pay`,`emply`,`group_id`,`date_data`,`p_method`) VALUES ('$loan_id','$blanch_id','$comp_id','$customer_id','$new_balance','$with_balance','$description','2','1','$day','$role','$group_id','$day','$method')");
      }


  public function data_with_depost($customer_id){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);

    $customer = $this->queries->search_CustomerLoan($customer_id);
    $customery = $this->queries->get_allcutomerblanchData($blanch_id);
    $customer_id = $this->input->post('customer_id');
    $comp_id = $this->input->post('comp_id');
    @$blanch_id = $customer->blanch_id;
    $acount = $this->queries->get_customer_account_verfied($blanch_id);
    $opening = $this->queries->get_yesterday_data_blanch($blanch_id);
    $depost_today = $this->queries->get_today_deposit_data($blanch_id);
    $withdrawal_today = $this->queries->get_total_expenses_loan_today($blanch_id);
    $closing = $this->queries->get_today_data_close_blanch($blanch_id);
    $this->load->view('oficer/depost_withdrow',['customer'=>$customer,'customery'=>$customery,'acount'=>$acount,'empl_data'=>$empl_data,'opening'=>$opening,'depost_today'=>$depost_today,'withdrawal_today'=>$withdrawal_today,'closing'=>$closing]);
}




 public function deposit_loan($customer_id){
    $this->form_validation->set_rules('customer_id','Customer','required');
    $this->form_validation->set_rules('comp_id','Company','required');
    $this->form_validation->set_rules('blanch_id','blanch','required');
    $this->form_validation->set_rules('loan_id','Loan','required');
    $this->form_validation->set_rules('depost','depost','required');
    $this->form_validation->set_rules('p_method','Method','required');
    $this->form_validation->set_rules('description','description','required');
    $this->form_validation->set_rules('deposit_date','deposit date','required');
    $this->form_validation->set_rules('day_id','day deposit','required');
    $this->form_validation->set_rules('double','double');
    $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
       if ($this->form_validation->run()) {
          $depost = $this->input->post();
          // print_r($depost);
          //     exit();
          $customer_id = $depost['customer_id'];
          $comp_id = $depost['comp_id'];
          $blanch_id = $depost['blanch_id'];
          $p_method = $depost['p_method'];
          $loan_id = $depost['loan_id'];
          $deposit_date = $depost['deposit_date'];
          $day_id = $depost['day_id'];
          $double = $depost['double'];
          $description = 'LOAN RETURN';
          $depost = $depost['depost'];
          $new_balance = $depost;
          $new_depost = $depost;

          $deposit_date = $deposit_date;
          $payment_method = $p_method;
          $kumaliza = $depost;
          $trans_id = $p_method;
          $p_method = $p_method;

          $today = date("Y-m-d");

           $this->load->model('queries');
           $blanch_id = $this->session->userdata('blanch_id');
           $empl_id = $this->session->userdata('empl_id');
           $manager_data = $this->queries->get_manager_data($empl_id);
           $comp_id = $manager_data->comp_id;
           $company_data = $this->queries->get_companyData($comp_id);
           $blanch_data = $this->queries->get_blanchData($blanch_id);
            $empl_data = $this->queries->get_employee_data($empl_id);
          $company_data = $this->queries->get_companyData($comp_id);
          $loan_restoration = $this->queries->get_restoration_loan($loan_id);
          $empl_id = $loan_restoration->empl_id;
          $date_show = $loan_restoration->date_show;
          $company = $this->queries->get_comp_data($comp_id);


          //sms count function
          @$smscount = $this->queries->get_smsCountDate($comp_id);
          $sms_number = @$smscount->sms_number;
          $sms_id = @$smscount->sms_id;

          $comp_name = $company->comp_name;
          $comp_phone = $company->comp_phone;
          
          $restoration = $loan_restoration->restration;
          $group_id = $loan_restoration->group_id;
          $loan_codeID = $loan_restoration->loan_code;

      
 
          $data_depost = $this->queries->get_customer_Loandata($customer_id);
          $customer_data = $this->queries->get_customerData($customer_id);
          $phones = $customer_data->phone_no;
          $admin_data = $this->queries->get_admin_role($comp_id);
          $remain_balance = $data_depost->balance;
          $old_balance = $remain_balance;
          $sum_balance = $old_balance + $new_depost;

          @$blanch_account = $this->queries->get_amount_remainAmountBlanch($blanch_id,$payment_method);
          $blanch_capital = @$blanch_account->blanch_capital;
          $depost_money = $blanch_capital + $new_depost;
               
          //admin role
          $role = $empl_data->username;
          

          $out_data = $this->queries->getOutstand_loanData($loan_id);
          $total_depost_loan = $this->queries->get_total_depost($loan_id);

               //new code
          $interest_data = $this->queries->get_interest_loan($loan_id);
          $int = $new_depost;
          $day = $interest_data->day;
          $interest_formular = $interest_data->interest_formular;
          $session = $interest_data->session;
          $loan_aprove = $interest_data->loan_aprove;
          $loan_status = $interest_data->loan_status;
          $loan_int = $interest_data->loan_int;
          $ses_day = $session;
          $day_int = $int /  $ses_day;
          $day_princ = $int - $day_int;

          //insert principal balance 
          $trans_id = $payment_method;
          $princ_status = $loan_status;
          $principal_balance = $day_princ;
          $interest_balance = $day_int;
           
          //principal
          $principal_blanch = $this->queries->get_blanch_capitalPrincipal($comp_id,$blanch_id,$trans_id,$princ_status);
          $old_principal_balance = @$principal_blanch->principal_balance;
          $principal_insert = $old_principal_balance + $principal_balance;

           //interest
          $interest_blanch = $this->queries->get_blanch_interest_capital($comp_id,$blanch_id,$trans_id,$princ_status);
          $interest_blanch_balance = @$interest_blanch->capital_interest;
          $interest_insert = $interest_blanch_balance + $day_int;
           

         $total_depost = $this->queries->get_sum_dapost($loan_id);
         $loan_dep = $total_depost->remain_balance_loan;
         $kumaliza_depost = $loan_dep + $kumaliza;

         $loan_int = $loan_restoration->loan_int;
         $remain_loan = $loan_int - $total_depost->remain_balance_loan;

         $baki = $loan_int - ($loan_dep + $kumaliza);
           // print_r($baki);
           //       exit();

         $sun_blanch_capital = $this->queries->get_remain_blanch_capital($blanch_id,$trans_id);
         $total_blanch_amount = $sun_blanch_capital->blanch_capital;
         $deposit_new = $total_blanch_amount + $depost;
      
         if ($kumaliza_depost < $loan_int){
            //print_r($kumaliza_depost);
              // echo "bado sana";
           }elseif($kumaliza_depost > $loan_int){
            //echo "hapana";
           }elseif($kumaliza_depost = $loan_int){
            $this->update_loastatus_done($loan_id);
            $this->insert_loan_kumaliza($comp_id,$blanch_id,$customer_id,$loan_id,$kumaliza,$group_id);
            $this->update_customer_statusclose($customer_id);
            //echo "tunamaliza kazi";
          }


          @$check_deposit = $this->queries->get_today_deposit_record($loan_id,$deposit_date);
          $depost_check = @$check_deposit->depost;
          $dep_id = @$check_deposit->dep_id;
          $again_deposit = $depost_check +  $depost;
          $again_deposit_double = $depost_check + $restoration;

          // print_r($again_deposit_double);
          //         exit();


          @$check_prev = $this->queries->get_prev_record_report($loan_id,$deposit_date);
          $prev_deposit = @$check_prev->depost;
          $dep_id = @$check_prev->pay_id;
          $again_prev = $prev_deposit + $depost;
          $again_prev_double = $prev_deposit + $restoration;

      //outstand deposit

          @$out_deposit = $this->queries->get_outstand_deposit($blanch_id,$trans_id);
          $out_balance = @$out_deposit->out_balance;

          $new_out_balance = $out_balance + $depost;
          // print_r($new_out_balance);
          //          exit();
         $pay_id = $dep_id;

           if ($out_data == TRUE){
            if ($depost > $out_data->remain_amount){
            $this->session->set_flashdata("error",'Your Depost Amount is Greater');
            }else{
           $remain_amount = $out_data->remain_amount;
           $paid_amount = $out_data->paid_amount;
           $customer_id = $out_data->customer_id;
            if($new_balance >= $remain_amount){
           $depost_amount = $remain_amount - $new_balance;
           $paid_out = $paid_amount + $new_balance;
           
           // print_r($depost_amount);
              //       exit();
          //insert depost balance

          if ($check_deposit == TRUE) {
            $this->update_deposit_record($loan_id,$deposit_date,$again_deposit,$day_id);
             }else{
             $dep_id = $this->insert_loan_lecorDeposit($comp_id,$customer_id,$loan_id,$blanch_id,$new_depost,$p_method,$role,$day_int,$day_princ,$loan_status,$group_id,$deposit_date,$empl_id,$day_id);
             }
           
           if (@$out_deposit->out_balance == TRUE || @$out_deposit->out_balance == '0' ) {
           $this->update_blanch_amount_outstand($comp_id,$blanch_id,$new_out_balance,$trans_id);   
           }else{
          $this->insert_blanch_amount_outstand_deposit($comp_id,$blanch_id,$new_out_balance,$trans_id);
           }

           $this->insert_blanch_amount_deposit($blanch_id,$deposit_new,$trans_id);
           $this->update_loan_dep_status($loan_id);
          $new_balance = $new_depost;

          if ($dep_id > 0) {
             $this->session->set_flashdata('massage','Deposit has made Sucessfully');
          }else{
            $this->session->set_flashdata('massage','Failed');
          }
          $this->update_outstand_status($loan_id);
         if ($check_prev == TRUE) {
          $dep_id = $dep_id;
          $empl_id = $empl_id;
          $this->update_deposit_record_prev($loan_id,$deposit_date,$again_prev,$dep_id,$p_method);
          }else{
          $dep_id = $dep_id;
          $empl_id = $empl_id;
         $this->insert_loan_lecordDataDeposit($comp_id,$customer_id,$loan_id,$blanch_id,$new_depost,$dep_id,$group_id,$trans_id,$restoration,$loan_aproved,$deposit_date,$empl_id);
          }
         $this->insert_remainloan($loan_id,$depost_amount,$paid_out,$pay_id);
         $this->update_loastatus($loan_id);
         $this->depost_balance($loan_id,$comp_id,$blanch_id,$customer_id,$new_depost,$sum_balance,$description,$role,$group_id,$p_method,$deposit_date,$dep_id,$baki);
         //$this->depost_Blanch_accountBalance($comp_id,$blanch_id,$payment_method,$depost_money);
            if(@$principal_blanch == TRUE){
         $this->update_principal_capital_balanc($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert);
         }elseif(@$principal_blanch == FALSE){
         $this->insert_blanch_principal($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert);
         }
          //interest
         if (@$interest_blanch == TRUE) {
         $this->update_interest_blanchBalance($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert);    
         }elseif(@$interest_blanch == FALSE){
         $this->insert_interest_blanch_capital($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert);
       }
          $this->insert_customer_report($loan_id,$comp_id,$blanch_id,$customer_id,$group_id,$new_depost,$pay_id,$deposit_date);
         //$this->insert_prepaid_balance($loan_id,$comp_id,$blanch_id,$customer_id,$prepaid);
         $this->update_customer_statusLoan($customer_id);
         $total_depost = $this->queries->get_sum_dapost($loan_id);
         $loan_int = $loan_restoration->loan_int;
         $remain_loan = $loan_int - $total_depost->remain_balance_loan;
            //sms send
          $sms = 'Umeingiza Tsh.' .$new_balance. ' kwenye Acc Yako ' . $loan_codeID . $comp_name.' Mpokeaji '.$role . ' Kiasi kilicho baki Kulipwa ni Tsh.'.$remain_loan.' Kwa malalamiko piga '.$comp_phone;
          $massage = $sms;
          $phone = $phones;

          $loan_ID = $loan_id;
          @$out_check = $this->queries->get_outstand_total($loan_id);
          $amount_remain = @$out_check->remain_amount;
            // print_r($new_balance);
            //       exit();
          if($amount_remain > $new_balance){
          $this->insert_outstand_balance($comp_id,$blanch_id,$customer_id,$loan_id,$new_balance,$group_id,$dep_id,$p_method);
          }elseif($amount_remain = $new_balance) {
          $this->insert_outstand_balance($comp_id,$blanch_id,$customer_id,$loan_id,$new_balance,$group_id,$dep_id,$p_method);
          }

          //$phone = '255'.substr($phones, 1,10);
            // print_r($sms);
            //   echo "<br>";
            // print_r($phone);
            //      exit();
          if ($company_data->sms_status == 'YES'){
              if ($smscount->sms_number == TRUE) {
                $new_sms = 1;
                $total_sms = $sms_number + $new_sms;
                $this->update_count_sms($comp_id,$total_sms,$sms_id);
              }elseif ($smscount->sms_number == FALSE) {
             $sms_number = 1;
             $this->insert_count_sms($comp_id,$sms_number);
             }
             $this->sendsms($phone,$massage);
             //echo "kitu kipo";
          }elseif($company_data->sms_status == 'NO'){
             //echo "Hakuna kitu hapa";
          }


        }else{      
           $depost_amount = $remain_amount - $new_balance;
           $paid_out = $paid_amount + $new_balance;
              
          //insert depost balance
          if ($check_deposit == TRUE) {
            $this->update_deposit_record($loan_id,$deposit_date,$again_deposit,$day_id);
             }else{
             $dep_id = $this->insert_loan_lecorDeposit($comp_id,$customer_id,$loan_id,$blanch_id,$new_depost,$p_method,$role,$day_int,$day_princ,$loan_status,$group_id,$deposit_date,$empl_id,$day_id);
             }
          
          if (@$out_deposit->out_balance == TRUE || @$out_deposit->out_balance == '0' ) {
           $this->update_blanch_amount_outstand($comp_id,$blanch_id,$new_out_balance,$trans_id);   
           }else{
          $this->insert_blanch_amount_outstand_deposit($comp_id,$blanch_id,$new_out_balance,$trans_id);
           }
           $this->insert_blanch_amount_deposit($blanch_id,$deposit_new,$trans_id);
           $this->update_loan_dep_status($loan_id);
          $new_balance = $new_depost;
          if ($dep_id > 0) {
             $this->session->set_flashdata('massage','Deposit has made Sucessfully');
          }else{
            $this->session->set_flashdata('massage','Failed');
          }
         if ($check_prev == TRUE) {
          $dep_id = $dep_id;
          $empl_id = $empl_id;
          $this->update_deposit_record_prev($loan_id,$deposit_date,$again_prev,$dep_id,$p_method);
          }else{
          $dep_id = $dep_id;
          $empl_id = $empl_id;
         $this->insert_loan_lecordDataDeposit($comp_id,$customer_id,$loan_id,$blanch_id,$new_depost,$dep_id,$group_id,$trans_id,$restoration,$loan_aproved,$deposit_date,$empl_id);
          }
         $this->insert_remainloan($loan_id,$depost_amount,$paid_out,$pay_id);
         
         $this->depost_balance($loan_id,$comp_id,$blanch_id,$customer_id,$new_depost,$sum_balance,$description,$role,$group_id,$p_method,$deposit_date,$dep_id,$baki);

         //$this->depost_Blanch_accountBalance($comp_id,$blanch_id,$payment_method,$depost_money);
            if (@$principal_blanch == TRUE) {
         $this->update_principal_capital_balanc($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert);
         }elseif(@$principal_blanch == FALSE){
         $this->insert_blanch_principal($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert);
         }
          //inrterest
         if (@$interest_blanch == TRUE) {
         $this->update_interest_blanchBalance($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert);    
         }elseif(@$interest_blanch == FALSE){
         $this->insert_interest_blanch_capital($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert);
       }
          $this->insert_customer_report($loan_id,$comp_id,$blanch_id,$customer_id,$group_id,$new_depost,$pay_id,$deposit_date);
         //$this->insert_prepaid_balance($loan_id,$comp_id,$blanch_id,$customer_id,$prepaid);
          $total_depost = $this->queries->get_sum_dapost($loan_id);
         $loan_int = $loan_restoration->loan_int;
         $remain_loan = $loan_int - $total_depost->remain_balance_loan;
            //sms send
          $sms = 'Umeingiza Tsh.' .$new_balance. ' kwenye Acc Yako ' . $loan_codeID . $comp_name.' Mpokeaji '.$role . ' Kiasi kilicho baki Kulipwa ni Tsh.'.$remain_loan.' Kwa malalamiko piga '.$comp_phone;
          $massage = $sms;
          $phone = $phones;


           $loan_ID = $loan_id;
          @$out_check = $this->queries->get_outstand_total($loan_id);
          $amount_remain = @$out_check->remain_amount;
              
          if($amount_remain > $new_balance){

         $this->insert_outstand_balance($comp_id,$blanch_id,$customer_id,$loan_id,$new_balance,$group_id,$dep_id,$p_method);
          // print_r($comp_id);
          //         exit();
          }elseif($amount_remain = $new_balance) {
          $this->insert_outstand_balance($comp_id,$blanch_id,$customer_id,$loan_id,$new_balance,$group_id,$dep_id,$p_method);
          }
          //$phone = '255'.substr($phones, 1,10);
            // print_r($sms);
            //   echo "<br>";
            // print_r($phone);
            //      exit();
          if ($company_data->sms_status == 'YES'){
             if ($smscount->sms_number == TRUE) {
                $new_sms = 1;
                $total_sms = $sms_number + $new_sms;
                $this->update_count_sms($comp_id,$total_sms,$sms_id);
              }elseif ($smscount->sms_number == FALSE) {
             $sms_number = 1;
             $this->insert_count_sms($comp_id,$sms_number);
             }
             $this->sendsms($phone,$massage);
             //echo "kitu kipo";
          }elseif($company_data->sms_status == 'NO'){
             //echo "Hakuna kitu hapa";
          }
          }
          }

        //ndani ya mkataba
           }elseif($out_data == FALSE){
     $remain_data = $this->queries->get_loan_deposit_data($loan_id);
     $den_remain = $loan_int - $remain_data->total_deposit;
     @$pend_sum = $this->queries->get_total_pending_loan_data($loan_id);
     $recover = @$pend_sum->total_recover;

     $double_amount = $depost - $recover - $restoration;
     $double_amount_again = $depost - $recover;
     // print_r($double_amount);
     //    exit();
           if ($double == 'YES') {
        if ($kumaliza_depost > $loan_int){
            $this->session->set_flashdata("error",'Your Depost Amount is Greater'); 
            }elseif($depost < $den_remain){
         $this->session->set_flashdata("error",'The Amount Is Insufficient to Close The Loan'); 
            }else{

           echo "kama kawaida";
          //       exit();
          //insert depost balance
            if ($check_deposit == TRUE){
            $this->update_deposit_record_double($loan_id,$deposit_date,$again_deposit_double,$day_id,$double_amount_again);
            $this->insert_double_amount_loan_updated($comp_id,$blanch_id,$loan_id,$trans_id,$double_amount_again,$dep_id);
             }else{
             $dep_id = $this->insert_loan_lecorDeposit_double($comp_id,$customer_id,$loan_id,$blanch_id,$restoration,$p_method,$role,$day_int,$day_princ,$loan_status,$group_id,$deposit_date,$empl_id,$day_id,$double_amount);
             $this->insert_double_amount_loan($comp_id,$blanch_id,$loan_id,$trans_id,$double_amount,$dep_id);
             }
           
          $this->insert_blanch_amount_deposit($blanch_id,$deposit_new,$trans_id);
          $this->update_loan_dep_status($loan_id);
             //exit();
          
          $new_balance = $new_depost;
          if ($dep_id > 0) {
             $this->session->set_flashdata('massage','Deposit has made Sucessfully');
          }else{
            $this->session->set_flashdata('massage','Deposit has made Sucessfully');
          }
          
          if ($check_prev == TRUE) {
          $dep_id = $dep_id;
          $empl_id = $empl_id;
          $this->update_deposit_record_prev_double($loan_id,$deposit_date,$again_prev_double,$dep_id,$p_method,$double_amount_again);
          }else{
          $dep_id = $dep_id;
          $empl_id = $empl_id;
         $this->insert_loan_lecordDataDeposit_double($comp_id,$customer_id,$loan_id,$blanch_id,$dep_id,$group_id,$trans_id,$restoration,$loan_aproved,$deposit_date,$empl_id,$double_amount);
          }
         $this->depost_balance($loan_id,$comp_id,$blanch_id,$customer_id,$new_depost,$sum_balance,$description,$role,$group_id,$p_method,$deposit_date,$dep_id,$baki);

         //$this->depost_Blanch_accountBalance($comp_id,$blanch_id,$payment_method,$depost_money);
         //principal
         if (@$principal_blanch == TRUE) {
         $this->update_principal_capital_balanc($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert);
         }elseif(@$principal_blanch == FALSE){
         $this->insert_blanch_principal($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert);
         }
          //inrterest
         if (@$interest_blanch == TRUE) {
         $this->update_interest_blanchBalance($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert);    
         }elseif(@$interest_blanch == FALSE){
         $this->insert_interest_blanch_capital($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert);
       }
        
         
          //updating recovery loan
         $loan_ID = $loan_id;
         @$data_pend = $this->queries->get_total_pending_loan($loan_ID);
          $total_pend = @$data_pend->total_pend;

          if (@$data_pend->total_pend == TRUE) {
            if($depost > $total_pend){
           $deni_lipa = $depost - $total_pend;
           //$recovery = $deni_lipa - $total_pend; 
           $this->update_loan_pending_remain($loan_id);
           $this->insert_description_report($comp_id,$blanch_id,$customer_id,$loan_id,$total_pend,$deni_lipa,$group_id,$dep_id); 
            }elseif($depost < $total_pend){
           $deni_lipa = $total_pend - $depost;
           $p_method = $p_method;
           $this->update_loan_pending_balance($loan_id,$deni_lipa);
           $this->insert_returnDescriptionData_report($comp_id,$blanch_id,$customer_id,$loan_id,$depost,$group_id,$dep_id,$p_method);
          }elseif ($depost = $total_pend) {
            $p_method = $p_method;
          $this->update_loan_pending_remain($loan_id);
          $this->insert_returnDescriptionData_report($comp_id,$blanch_id,$customer_id,$loan_id,$depost,$group_id,$dep_id,$p_method);
          }
          }elseif ($data_pend->total_pend == FALSE) {
          if($date_show >= $today){
            if ($depost < $restoration) {
                $prepaid = 0;
            }else{
           $prepaid = $depost - $restoration;
           }
           //$this->insert_prepaid_balance($loan_id,$comp_id,$blanch_id,$customer_id,$prepaid,$dep_id,$trans_id);   
            }else{
            
            }
          
          }

         $total_depost = $this->queries->get_sum_dapost($loan_id);
         $loan_int = $loan_restoration->loan_int;
         $remain_loan = $loan_int - $total_depost->remain_balance_loan;
            //sms send
          $sms = 'Umeingiza Tsh.' .$new_balance. ' kwenye Acc Yako ' . $loan_codeID . $comp_name.' Mpokeaji '.$role . ' Kiasi kilicho baki Kulipwa ni Tsh.'.$remain_loan.' Kwa malalamiko piga '.$comp_phone;
          $massage = $sms;
          $phone = $phones;

          if ($company_data->sms_status == 'YES'){
              if (@$smscount->sms_number == TRUE) {
                $new_sms = 1;
                $total_sms = @$sms_number + $new_sms;
                $this->update_count_sms($comp_id,$total_sms,$sms_id);
              }elseif (@$smscount->sms_number == FALSE) {
             $sms_number = 1;
             $this->insert_count_sms($comp_id,$sms_number);
             }
             $this->sendsms($phone,$massage);
             //echo "kitu kipo";
          }elseif($company_data->sms_status == 'NO'){
             //echo "Hakuna kitu hapa";
          }
      }

          //echo "weka double";

         }elseif($double == 'NO'){
         if ($kumaliza_depost > $loan_int){
            $this->session->set_flashdata("error",'Your Depost Amount is Greater'); 
            }else{
          //insert depost balance
            if ($check_deposit == TRUE) {
            $this->update_deposit_record($loan_id,$deposit_date,$again_deposit,$day_id);
             }else{
             $dep_id = $this->insert_loan_lecorDeposit($comp_id,$customer_id,$loan_id,$blanch_id,$new_depost,$p_method,$role,$day_int,$day_princ,$loan_status,$group_id,$deposit_date,$empl_id,$day_id);
             }
           
          $this->insert_blanch_amount_deposit($blanch_id,$deposit_new,$trans_id);
          $this->update_loan_dep_status($loan_id);
             //exit();
          
          $new_balance = $new_depost;
          if ($dep_id > 0) {
             $this->session->set_flashdata('massage','Deposit has made Sucessfully');
          }else{
            $this->session->set_flashdata('massage','Deposit has made Sucessfully');
          }
          
          if ($check_prev == TRUE) {
          $dep_id = $dep_id;
          $empl_id = $empl_id;
          $this->update_deposit_record_prev($loan_id,$deposit_date,$again_prev,$dep_id,$p_method);
          }else{
          $dep_id = $dep_id;
          $empl_id = $empl_id;
         $this->insert_loan_lecordDataDeposit($comp_id,$customer_id,$loan_id,$blanch_id,$new_depost,$dep_id,$group_id,$trans_id,$restoration,$loan_aproved,$deposit_date,$empl_id);
          }
         $this->depost_balance($loan_id,$comp_id,$blanch_id,$customer_id,$new_depost,$sum_balance,$description,$role,$group_id,$p_method,$deposit_date,$dep_id,$baki);

         //$this->depost_Blanch_accountBalance($comp_id,$blanch_id,$payment_method,$depost_money);
         //principal
         if (@$principal_blanch == TRUE) {
         $this->update_principal_capital_balanc($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert);
         }elseif(@$principal_blanch == FALSE){
         $this->insert_blanch_principal($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert);
         }
          //inrterest
         if (@$interest_blanch == TRUE) {
         $this->update_interest_blanchBalance($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert);    
         }elseif(@$interest_blanch == FALSE){
         $this->insert_interest_blanch_capital($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert);
       }
        
         
          //updating recovery loan
         $loan_ID = $loan_id;
         @$data_pend = $this->queries->get_total_pending_loan($loan_ID);
          $total_pend = @$data_pend->total_pend;

          if (@$data_pend->total_pend == TRUE) {
            if($depost > $total_pend){
           $deni_lipa = $depost - $total_pend;
           //$recovery = $deni_lipa - $total_pend; 
           $this->update_loan_pending_remain($loan_id);
           $this->insert_description_report($comp_id,$blanch_id,$customer_id,$loan_id,$total_pend,$deni_lipa,$group_id,$dep_id); 
            }elseif($depost < $total_pend){
           $deni_lipa = $total_pend - $depost;
           $this->update_loan_pending_balance($loan_id,$deni_lipa);
           $this->insert_returnDescriptionData_report($comp_id,$blanch_id,$customer_id,$loan_id,$depost,$group_id,$dep_id,$p_method);
          }elseif ($depost = $total_pend) {
          $this->update_loan_pending_remain($loan_id);
          $this->insert_returnDescriptionData_report($comp_id,$blanch_id,$customer_id,$loan_id,$depost,$group_id,$dep_id,$p_method);
          }
          }elseif ($data_pend->total_pend == FALSE) {
          if($date_show >= $today){
            if ($depost < $restoration) {
                $prepaid = 0;
            }else{
           $prepaid = $depost - $restoration;
           }
           $this->insert_prepaid_balance($loan_id,$comp_id,$blanch_id,$customer_id,$prepaid,$dep_id,$trans_id);   
            }else{
            
            }
          
          }

         $total_depost = $this->queries->get_sum_dapost($loan_id);
         $loan_int = $loan_restoration->loan_int;
         $remain_loan = $loan_int - $total_depost->remain_balance_loan;
            //sms send
          $sms = 'Umeingiza Tsh.' .$new_balance. ' kwenye Acc Yako ' . $loan_codeID . $comp_name.' Mpokeaji '.$role . ' Kiasi kilicho baki Kulipwa ni Tsh.'.$remain_loan.' Kwa malalamiko piga '.$comp_phone;
          $massage = $sms;
          $phone = $phones;

          if ($company_data->sms_status == 'YES'){
              if (@$smscount->sms_number == TRUE) {
                $new_sms = 1;
                $total_sms = @$sms_number + $new_sms;
                $this->update_count_sms($comp_id,$total_sms,$sms_id);
              }elseif (@$smscount->sms_number == FALSE) {
             $sms_number = 1;
             $this->insert_count_sms($comp_id,$sms_number);
             }
             $this->sendsms($phone,$massage);
             //echo "kitu kipo";
          }elseif($company_data->sms_status == 'NO'){
             //echo "Hakuna kitu hapa";
          }
         }
           
         }


         }

          return redirect('oficer/data_with_depost/'.$customer_id);
          }   
                
       $this->data_with_depost();

      }



      //deposit loan Group

    public function deposit_loan_group($customer_id,$group_id){
    $this->form_validation->set_rules('customer_id','Customer','required');
    $this->form_validation->set_rules('comp_id','Company','required');
    $this->form_validation->set_rules('blanch_id','blanch','required');
    $this->form_validation->set_rules('loan_id','Loan','required');
    $this->form_validation->set_rules('depost','depost','required');
    $this->form_validation->set_rules('p_method','Method','required');
    $this->form_validation->set_rules('description','description','required');
    $this->form_validation->set_rules('deposit_date','deposit date','required');
    $this->form_validation->set_rules('day_id','day deposit','required');
    $this->form_validation->set_rules('double','double');
    $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
       if ($this->form_validation->run()) {
          $depost = $this->input->post();
          // print_r($depost);
          //     exit();
          $customer_id = $depost['customer_id'];
          $comp_id = $depost['comp_id'];
          $blanch_id = $depost['blanch_id'];
          $p_method = $depost['p_method'];
          $loan_id = $depost['loan_id'];
          $deposit_date = $depost['deposit_date'];
          $day_id = $depost['day_id'];
          $double = $depost['double'];
          $description = 'LOAN RETURN';
          $depost = $depost['depost'];
          $new_balance = $depost;
          $new_depost = $depost;

          $deposit_date = $deposit_date;
          $payment_method = $p_method;
          $kumaliza = $depost;
          $trans_id = $p_method;
          $p_method = $p_method;

          $today = date("Y-m-d");

           $this->load->model('queries');
           $blanch_id = $this->session->userdata('blanch_id');
           $empl_id = $this->session->userdata('empl_id');
           $manager_data = $this->queries->get_manager_data($empl_id);
           $comp_id = $manager_data->comp_id;
           $company_data = $this->queries->get_companyData($comp_id);
           $blanch_data = $this->queries->get_blanchData($blanch_id);
            $empl_data = $this->queries->get_employee_data($empl_id);
          $company_data = $this->queries->get_companyData($comp_id);
          $loan_restoration = $this->queries->get_restoration_loan($loan_id);
          $empl_id = $loan_restoration->empl_id;
          $date_show = $loan_restoration->date_show;
          $company = $this->queries->get_comp_data($comp_id);


          //sms count function
          @$smscount = $this->queries->get_smsCountDate($comp_id);
          $sms_number = @$smscount->sms_number;
          $sms_id = @$smscount->sms_id;

          $comp_name = $company->comp_name;
          $comp_phone = $company->comp_phone;
          
          $restoration = $loan_restoration->restration;
          $group_id = $loan_restoration->group_id;
          $loan_codeID = $loan_restoration->loan_code;

      
 
          $data_depost = $this->queries->get_customer_Loandata($customer_id);
          $customer_data = $this->queries->get_customerData($customer_id);
          $phones = $customer_data->phone_no;
          $admin_data = $this->queries->get_admin_role($comp_id);
          $remain_balance = $data_depost->balance;
          $old_balance = $remain_balance;
          $sum_balance = $old_balance + $new_depost;

          @$blanch_account = $this->queries->get_amount_remainAmountBlanch($blanch_id,$payment_method);
          $blanch_capital = @$blanch_account->blanch_capital;
          $depost_money = $blanch_capital + $new_depost;
               
          //admin role
          $role = $empl_data->username;
          

          $out_data = $this->queries->getOutstand_loanData($loan_id);
          $total_depost_loan = $this->queries->get_total_depost($loan_id);

               //new code
          $interest_data = $this->queries->get_interest_loan($loan_id);
          $int = $new_depost;
          $day = $interest_data->day;
          $interest_formular = $interest_data->interest_formular;
          $session = $interest_data->session;
          $loan_aprove = $interest_data->loan_aprove;
          $loan_status = $interest_data->loan_status;
          $loan_int = $interest_data->loan_int;
          $ses_day = $session;
          $day_int = $int /  $ses_day;
          $day_princ = $int - $day_int;

          //insert principal balance 
          $trans_id = $payment_method;
          $princ_status = $loan_status;
          $principal_balance = $day_princ;
          $interest_balance = $day_int;
           
          //principal
          $principal_blanch = $this->queries->get_blanch_capitalPrincipal($comp_id,$blanch_id,$trans_id,$princ_status);
          $old_principal_balance = @$principal_blanch->principal_balance;
          $principal_insert = $old_principal_balance + $principal_balance;

           //interest
          $interest_blanch = $this->queries->get_blanch_interest_capital($comp_id,$blanch_id,$trans_id,$princ_status);
          $interest_blanch_balance = @$interest_blanch->capital_interest;
          $interest_insert = $interest_blanch_balance + $day_int;
           

         $total_depost = $this->queries->get_sum_dapost($loan_id);
         $loan_dep = $total_depost->remain_balance_loan;
         $kumaliza_depost = $loan_dep + $kumaliza;

         $loan_int = $loan_restoration->loan_int;
         $remain_loan = $loan_int - $total_depost->remain_balance_loan;

         $baki = $loan_int - ($loan_dep + $kumaliza);
           // print_r($baki);
           //       exit();

         $sun_blanch_capital = $this->queries->get_remain_blanch_capital($blanch_id,$trans_id);
         $total_blanch_amount = $sun_blanch_capital->blanch_capital;
         $deposit_new = $total_blanch_amount + $depost;
      
         if ($kumaliza_depost < $loan_int){
            //print_r($kumaliza_depost);
              // echo "bado sana";
           }elseif($kumaliza_depost > $loan_int){
            //echo "hapana";
           }elseif($kumaliza_depost = $loan_int){
            $this->update_loastatus_done($loan_id);
            $this->insert_loan_kumaliza($comp_id,$blanch_id,$customer_id,$loan_id,$kumaliza,$group_id);
            $this->update_customer_statusclose($customer_id);
            //echo "tunamaliza kazi";
          }


          @$check_deposit = $this->queries->get_today_deposit_record($loan_id,$deposit_date);
          $depost_check = @$check_deposit->depost;
          $dep_id = @$check_deposit->dep_id;
          $again_deposit = $depost_check +  $depost;
          $again_deposit_double = $depost_check + $restoration;

          // print_r($again_deposit_double);
          //         exit();


          @$check_prev = $this->queries->get_prev_record_report($loan_id,$deposit_date);
          $prev_deposit = @$check_prev->depost;
          $dep_id = @$check_prev->pay_id;
          $again_prev = $prev_deposit + $depost;
          $again_prev_double = $prev_deposit + $restoration;

      //outstand deposit

          @$out_deposit = $this->queries->get_outstand_deposit($blanch_id,$trans_id);
          $out_balance = @$out_deposit->out_balance;

          $new_out_balance = $out_balance + $depost;
          // print_r($new_out_balance);
          //          exit();
         $pay_id = $dep_id;

           if ($out_data == TRUE){
            if ($depost > $out_data->remain_amount){
            $this->session->set_flashdata("error",'Your Depost Amount is Greater');
            }else{
           $remain_amount = $out_data->remain_amount;
           $paid_amount = $out_data->paid_amount;
           $customer_id = $out_data->customer_id;
            if($new_balance >= $remain_amount){
           $depost_amount = $remain_amount - $new_balance;
           $paid_out = $paid_amount + $new_balance;
           
           // print_r($depost_amount);
              //       exit();
          //insert depost balance

          if ($check_deposit == TRUE) {
            $this->update_deposit_record($loan_id,$deposit_date,$again_deposit,$day_id);
             }else{
             $dep_id = $this->insert_loan_lecorDeposit($comp_id,$customer_id,$loan_id,$blanch_id,$new_depost,$p_method,$role,$day_int,$day_princ,$loan_status,$group_id,$deposit_date,$empl_id,$day_id);
             }
           
           if (@$out_deposit->out_balance == TRUE || @$out_deposit->out_balance == '0' ) {
           $this->update_blanch_amount_outstand($comp_id,$blanch_id,$new_out_balance,$trans_id);   
           }else{
          $this->insert_blanch_amount_outstand_deposit($comp_id,$blanch_id,$new_out_balance,$trans_id);
           }

           $this->insert_blanch_amount_deposit($blanch_id,$deposit_new,$trans_id);
           $this->update_loan_dep_status($loan_id);
          $new_balance = $new_depost;

          if ($dep_id > 0) {
             $this->session->set_flashdata('massage','Deposit has made Sucessfully');
          }else{
            $this->session->set_flashdata('massage','Failed');
          }
          $this->update_outstand_status($loan_id);
         if ($check_prev == TRUE) {
          $dep_id = $dep_id;
          $empl_id = $empl_id;
          $this->update_deposit_record_prev($loan_id,$deposit_date,$again_prev,$dep_id,$p_method);
          }else{
          $dep_id = $dep_id;
          $empl_id = $empl_id;
         $this->insert_loan_lecordDataDeposit($comp_id,$customer_id,$loan_id,$blanch_id,$new_depost,$dep_id,$group_id,$trans_id,$restoration,$loan_aproved,$deposit_date,$empl_id);
          }
         $this->insert_remainloan($loan_id,$depost_amount,$paid_out,$pay_id);
         $this->update_loastatus($loan_id);
         $this->depost_balance($loan_id,$comp_id,$blanch_id,$customer_id,$new_depost,$sum_balance,$description,$role,$group_id,$p_method,$deposit_date,$dep_id,$baki);
         //$this->depost_Blanch_accountBalance($comp_id,$blanch_id,$payment_method,$depost_money);
            if(@$principal_blanch == TRUE){
         $this->update_principal_capital_balanc($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert);
         }elseif(@$principal_blanch == FALSE){
         $this->insert_blanch_principal($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert);
         }
          //interest
         if (@$interest_blanch == TRUE) {
         $this->update_interest_blanchBalance($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert);    
         }elseif(@$interest_blanch == FALSE){
         $this->insert_interest_blanch_capital($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert);
       }
          $this->insert_customer_report($loan_id,$comp_id,$blanch_id,$customer_id,$group_id,$new_depost,$pay_id,$deposit_date);
         //$this->insert_prepaid_balance($loan_id,$comp_id,$blanch_id,$customer_id,$prepaid);
         $this->update_customer_statusLoan($customer_id);
         $total_depost = $this->queries->get_sum_dapost($loan_id);
         $loan_int = $loan_restoration->loan_int;
         $remain_loan = $loan_int - $total_depost->remain_balance_loan;
            //sms send
          $sms = 'Umeingiza Tsh.' .$new_balance. ' kwenye Acc Yako ' . $loan_codeID . $comp_name.' Mpokeaji '.$role . ' Kiasi kilicho baki Kulipwa ni Tsh.'.$remain_loan.' Kwa malalamiko piga '.$comp_phone;
          $massage = $sms;
          $phone = $phones;

          $loan_ID = $loan_id;
          @$out_check = $this->queries->get_outstand_total($loan_id);
          $amount_remain = @$out_check->remain_amount;
            // print_r($new_balance);
            //       exit();
          if($amount_remain > $new_balance){
          $this->insert_outstand_balance($comp_id,$blanch_id,$customer_id,$loan_id,$new_balance,$group_id,$dep_id,$p_method);
          }elseif($amount_remain = $new_balance) {
          $this->insert_outstand_balance($comp_id,$blanch_id,$customer_id,$loan_id,$new_balance,$group_id,$dep_id,$p_method);
          }

          //$phone = '255'.substr($phones, 1,10);
            // print_r($sms);
            //   echo "<br>";
            // print_r($phone);
            //      exit();
          if ($company_data->sms_status == 'YES'){
              if ($smscount->sms_number == TRUE) {
                $new_sms = 1;
                $total_sms = $sms_number + $new_sms;
                $this->update_count_sms($comp_id,$total_sms,$sms_id);
              }elseif ($smscount->sms_number == FALSE) {
             $sms_number = 1;
             $this->insert_count_sms($comp_id,$sms_number);
             }
             $this->sendsms($phone,$massage);
             //echo "kitu kipo";
          }elseif($company_data->sms_status == 'NO'){
             //echo "Hakuna kitu hapa";
          }


        }else{      
           $depost_amount = $remain_amount - $new_balance;
           $paid_out = $paid_amount + $new_balance;
              
          //insert depost balance
          if ($check_deposit == TRUE) {
            $this->update_deposit_record($loan_id,$deposit_date,$again_deposit,$day_id);
             }else{
             $dep_id = $this->insert_loan_lecorDeposit($comp_id,$customer_id,$loan_id,$blanch_id,$new_depost,$p_method,$role,$day_int,$day_princ,$loan_status,$group_id,$deposit_date,$empl_id,$day_id);
             }
          
          if (@$out_deposit->out_balance == TRUE || @$out_deposit->out_balance == '0' ) {
           $this->update_blanch_amount_outstand($comp_id,$blanch_id,$new_out_balance,$trans_id);   
           }else{
          $this->insert_blanch_amount_outstand_deposit($comp_id,$blanch_id,$new_out_balance,$trans_id);
           }
           $this->insert_blanch_amount_deposit($blanch_id,$deposit_new,$trans_id);
           $this->update_loan_dep_status($loan_id);
          $new_balance = $new_depost;
          if ($dep_id > 0) {
             $this->session->set_flashdata('massage','Deposit has made Sucessfully');
          }else{
            $this->session->set_flashdata('massage','Failed');
          }
         if ($check_prev == TRUE) {
          $dep_id = $dep_id;
          $empl_id = $empl_id;
          $this->update_deposit_record_prev($loan_id,$deposit_date,$again_prev,$dep_id,$p_method);
          }else{
          $dep_id = $dep_id;
          $empl_id = $empl_id;
         $this->insert_loan_lecordDataDeposit($comp_id,$customer_id,$loan_id,$blanch_id,$new_depost,$dep_id,$group_id,$trans_id,$restoration,$loan_aproved,$deposit_date,$empl_id);
          }
         $this->insert_remainloan($loan_id,$depost_amount,$paid_out,$pay_id);
         
         $this->depost_balance($loan_id,$comp_id,$blanch_id,$customer_id,$new_depost,$sum_balance,$description,$role,$group_id,$p_method,$deposit_date,$dep_id,$baki);

         //$this->depost_Blanch_accountBalance($comp_id,$blanch_id,$payment_method,$depost_money);
            if (@$principal_blanch == TRUE) {
         $this->update_principal_capital_balanc($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert);
         }elseif(@$principal_blanch == FALSE){
         $this->insert_blanch_principal($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert);
         }
          //inrterest
         if (@$interest_blanch == TRUE) {
         $this->update_interest_blanchBalance($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert);    
         }elseif(@$interest_blanch == FALSE){
         $this->insert_interest_blanch_capital($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert);
       }
          $this->insert_customer_report($loan_id,$comp_id,$blanch_id,$customer_id,$group_id,$new_depost,$pay_id,$deposit_date);
         //$this->insert_prepaid_balance($loan_id,$comp_id,$blanch_id,$customer_id,$prepaid);
          $total_depost = $this->queries->get_sum_dapost($loan_id);
         $loan_int = $loan_restoration->loan_int;
         $remain_loan = $loan_int - $total_depost->remain_balance_loan;
            //sms send
          $sms = 'Umeingiza Tsh.' .$new_balance. ' kwenye Acc Yako ' . $loan_codeID . $comp_name.' Mpokeaji '.$role . ' Kiasi kilicho baki Kulipwa ni Tsh.'.$remain_loan.' Kwa malalamiko piga '.$comp_phone;
          $massage = $sms;
          $phone = $phones;


           $loan_ID = $loan_id;
          @$out_check = $this->queries->get_outstand_total($loan_id);
          $amount_remain = @$out_check->remain_amount;
              
          if($amount_remain > $new_balance){

         $this->insert_outstand_balance($comp_id,$blanch_id,$customer_id,$loan_id,$new_balance,$group_id,$dep_id,$p_method);
          // print_r($comp_id);
          //         exit();
          }elseif($amount_remain = $new_balance) {
          $this->insert_outstand_balance($comp_id,$blanch_id,$customer_id,$loan_id,$new_balance,$group_id,$dep_id,$p_method);
          }
          //$phone = '255'.substr($phones, 1,10);
            // print_r($sms);
            //   echo "<br>";
            // print_r($phone);
            //      exit();
          if ($company_data->sms_status == 'YES'){
             if ($smscount->sms_number == TRUE) {
                $new_sms = 1;
                $total_sms = $sms_number + $new_sms;
                $this->update_count_sms($comp_id,$total_sms,$sms_id);
              }elseif ($smscount->sms_number == FALSE) {
             $sms_number = 1;
             $this->insert_count_sms($comp_id,$sms_number);
             }
             $this->sendsms($phone,$massage);
             //echo "kitu kipo";
          }elseif($company_data->sms_status == 'NO'){
             //echo "Hakuna kitu hapa";
          }
          }
          }

        //ndani ya mkataba
           }elseif($out_data == FALSE){
     $remain_data = $this->queries->get_loan_deposit_data($loan_id);
     $den_remain = $loan_int - $remain_data->total_deposit;
     @$pend_sum = $this->queries->get_total_pending_loan_data($loan_id);
     $recover = @$pend_sum->total_recover;

     $double_amount = $depost - $recover - $restoration;
     $double_amount_again = $depost - $recover;
     // print_r($double_amount);
     //    exit();
           if ($double == 'YES') {
        if ($kumaliza_depost > $loan_int){
            $this->session->set_flashdata("error",'Your Depost Amount is Greater'); 
            }elseif($depost < $den_remain){
         $this->session->set_flashdata("error",'The Amount Is Insufficient to Close The Loan'); 
            }else{

           echo "kama kawaida";
          //       exit();
          //insert depost balance
            if ($check_deposit == TRUE){
            $this->update_deposit_record_double($loan_id,$deposit_date,$again_deposit_double,$day_id,$double_amount_again);
            $this->insert_double_amount_loan_updated($comp_id,$blanch_id,$loan_id,$trans_id,$double_amount_again,$dep_id);
             }else{
             $dep_id = $this->insert_loan_lecorDeposit_double($comp_id,$customer_id,$loan_id,$blanch_id,$restoration,$p_method,$role,$day_int,$day_princ,$loan_status,$group_id,$deposit_date,$empl_id,$day_id,$double_amount);
             $this->insert_double_amount_loan($comp_id,$blanch_id,$loan_id,$trans_id,$double_amount,$dep_id);
             }
           
          $this->insert_blanch_amount_deposit($blanch_id,$deposit_new,$trans_id);
          $this->update_loan_dep_status($loan_id);
             //exit();
          
          $new_balance = $new_depost;
          if ($dep_id > 0) {
             $this->session->set_flashdata('massage','Deposit has made Sucessfully');
          }else{
            $this->session->set_flashdata('massage','Deposit has made Sucessfully');
          }
          
          if ($check_prev == TRUE) {
          $dep_id = $dep_id;
          $empl_id = $empl_id;
          $this->update_deposit_record_prev_double($loan_id,$deposit_date,$again_prev_double,$dep_id,$p_method,$double_amount_again);
          }else{
          $dep_id = $dep_id;
          $empl_id = $empl_id;
         $this->insert_loan_lecordDataDeposit_double($comp_id,$customer_id,$loan_id,$blanch_id,$dep_id,$group_id,$trans_id,$restoration,$loan_aproved,$deposit_date,$empl_id,$double_amount);
          }
         $this->depost_balance($loan_id,$comp_id,$blanch_id,$customer_id,$new_depost,$sum_balance,$description,$role,$group_id,$p_method,$deposit_date,$dep_id,$baki);

         //$this->depost_Blanch_accountBalance($comp_id,$blanch_id,$payment_method,$depost_money);
         //principal
         if (@$principal_blanch == TRUE) {
         $this->update_principal_capital_balanc($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert);
         }elseif(@$principal_blanch == FALSE){
         $this->insert_blanch_principal($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert);
         }
          //inrterest
         if (@$interest_blanch == TRUE) {
         $this->update_interest_blanchBalance($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert);    
         }elseif(@$interest_blanch == FALSE){
         $this->insert_interest_blanch_capital($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert);
       }
        
         
          //updating recovery loan
         $loan_ID = $loan_id;
         @$data_pend = $this->queries->get_total_pending_loan($loan_ID);
          $total_pend = @$data_pend->total_pend;

          if (@$data_pend->total_pend == TRUE) {
            if($depost > $total_pend){
           $deni_lipa = $depost - $total_pend;
           //$recovery = $deni_lipa - $total_pend; 
           $this->update_loan_pending_remain($loan_id);
           $this->insert_description_report($comp_id,$blanch_id,$customer_id,$loan_id,$total_pend,$deni_lipa,$group_id,$dep_id); 
            }elseif($depost < $total_pend){
           $deni_lipa = $total_pend - $depost;
           $p_method = $p_method;
           $this->update_loan_pending_balance($loan_id,$deni_lipa);
           $this->insert_returnDescriptionData_report($comp_id,$blanch_id,$customer_id,$loan_id,$depost,$group_id,$dep_id,$p_method);
          }elseif ($depost = $total_pend) {
            $p_method = $p_method;
          $this->update_loan_pending_remain($loan_id);
          $this->insert_returnDescriptionData_report($comp_id,$blanch_id,$customer_id,$loan_id,$depost,$group_id,$dep_id,$p_method);
          }
          }elseif ($data_pend->total_pend == FALSE) {
          if($date_show >= $today){
            if ($depost < $restoration) {
                $prepaid = 0;
            }else{
           $prepaid = $depost - $restoration;
           }
           //$this->insert_prepaid_balance($loan_id,$comp_id,$blanch_id,$customer_id,$prepaid,$dep_id,$trans_id);   
            }else{
            
            }
          
          }

         $total_depost = $this->queries->get_sum_dapost($loan_id);
         $loan_int = $loan_restoration->loan_int;
         $remain_loan = $loan_int - $total_depost->remain_balance_loan;
            //sms send
          $sms = 'Umeingiza Tsh.' .$new_balance. ' kwenye Acc Yako ' . $loan_codeID . $comp_name.' Mpokeaji '.$role . ' Kiasi kilicho baki Kulipwa ni Tsh.'.$remain_loan.' Kwa malalamiko piga '.$comp_phone;
          $massage = $sms;
          $phone = $phones;

          if ($company_data->sms_status == 'YES'){
              if (@$smscount->sms_number == TRUE) {
                $new_sms = 1;
                $total_sms = @$sms_number + $new_sms;
                $this->update_count_sms($comp_id,$total_sms,$sms_id);
              }elseif (@$smscount->sms_number == FALSE) {
             $sms_number = 1;
             $this->insert_count_sms($comp_id,$sms_number);
             }
             $this->sendsms($phone,$massage);
             //echo "kitu kipo";
          }elseif($company_data->sms_status == 'NO'){
             //echo "Hakuna kitu hapa";
          }
      }

          //echo "weka double";

         }elseif($double == 'NO'){
         if ($kumaliza_depost > $loan_int){
            $this->session->set_flashdata("error",'Your Depost Amount is Greater'); 
            }else{
          //insert depost balance
            if ($check_deposit == TRUE) {
            $this->update_deposit_record($loan_id,$deposit_date,$again_deposit,$day_id);
             }else{
             $dep_id = $this->insert_loan_lecorDeposit($comp_id,$customer_id,$loan_id,$blanch_id,$new_depost,$p_method,$role,$day_int,$day_princ,$loan_status,$group_id,$deposit_date,$empl_id,$day_id);
             }
           
          $this->insert_blanch_amount_deposit($blanch_id,$deposit_new,$trans_id);
          $this->update_loan_dep_status($loan_id);
             //exit();
          
          $new_balance = $new_depost;
          if ($dep_id > 0) {
             $this->session->set_flashdata('massage','Deposit has made Sucessfully');
          }else{
            $this->session->set_flashdata('massage','Deposit has made Sucessfully');
          }
          
          if ($check_prev == TRUE) {
          $dep_id = $dep_id;
          $empl_id = $empl_id;
          $this->update_deposit_record_prev($loan_id,$deposit_date,$again_prev,$dep_id,$p_method);
          }else{
          $dep_id = $dep_id;
          $empl_id = $empl_id;
         $this->insert_loan_lecordDataDeposit($comp_id,$customer_id,$loan_id,$blanch_id,$new_depost,$dep_id,$group_id,$trans_id,$restoration,$loan_aproved,$deposit_date,$empl_id);
          }
         $this->depost_balance($loan_id,$comp_id,$blanch_id,$customer_id,$new_depost,$sum_balance,$description,$role,$group_id,$p_method,$deposit_date,$dep_id,$baki);

         //$this->depost_Blanch_accountBalance($comp_id,$blanch_id,$payment_method,$depost_money);
         //principal
         if (@$principal_blanch == TRUE) {
         $this->update_principal_capital_balanc($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert);
         }elseif(@$principal_blanch == FALSE){
         $this->insert_blanch_principal($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert);
         }
          //inrterest
         if (@$interest_blanch == TRUE) {
         $this->update_interest_blanchBalance($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert);    
         }elseif(@$interest_blanch == FALSE){
         $this->insert_interest_blanch_capital($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert);
       }
        
         
          //updating recovery loan
         $loan_ID = $loan_id;
         @$data_pend = $this->queries->get_total_pending_loan($loan_ID);
          $total_pend = @$data_pend->total_pend;

          if (@$data_pend->total_pend == TRUE) {
            if($depost > $total_pend){
           $deni_lipa = $depost - $total_pend;
           //$recovery = $deni_lipa - $total_pend; 
           $this->update_loan_pending_remain($loan_id);
           $this->insert_description_report($comp_id,$blanch_id,$customer_id,$loan_id,$total_pend,$deni_lipa,$group_id,$dep_id); 
            }elseif($depost < $total_pend){
           $deni_lipa = $total_pend - $depost;
           $this->update_loan_pending_balance($loan_id,$deni_lipa);
           $this->insert_returnDescriptionData_report($comp_id,$blanch_id,$customer_id,$loan_id,$depost,$group_id,$dep_id,$p_method);
          }elseif ($depost = $total_pend) {
          $this->update_loan_pending_remain($loan_id);
          $this->insert_returnDescriptionData_report($comp_id,$blanch_id,$customer_id,$loan_id,$depost,$group_id,$dep_id,$p_method);
          }
          }elseif ($data_pend->total_pend == FALSE) {
          if($date_show >= $today){
            if ($depost < $restoration) {
                $prepaid = 0;
            }else{
           $prepaid = $depost - $restoration;
           }
           $this->insert_prepaid_balance($loan_id,$comp_id,$blanch_id,$customer_id,$prepaid,$dep_id,$trans_id);   
            }else{
            
            }
          
          }

         $total_depost = $this->queries->get_sum_dapost($loan_id);
         $loan_int = $loan_restoration->loan_int;
         $remain_loan = $loan_int - $total_depost->remain_balance_loan;
            //sms send
          $sms = 'Umeingiza Tsh.' .$new_balance. ' kwenye Acc Yako ' . $loan_codeID . $comp_name.' Mpokeaji '.$role . ' Kiasi kilicho baki Kulipwa ni Tsh.'.$remain_loan.' Kwa malalamiko piga '.$comp_phone;
          $massage = $sms;
          $phone = $phones;

          if ($company_data->sms_status == 'YES'){
              if (@$smscount->sms_number == TRUE) {
                $new_sms = 1;
                $total_sms = @$sms_number + $new_sms;
                $this->update_count_sms($comp_id,$total_sms,$sms_id);
              }elseif (@$smscount->sms_number == FALSE) {
             $sms_number = 1;
             $this->insert_count_sms($comp_id,$sms_number);
             }
             $this->sendsms($phone,$massage);
             //echo "kitu kipo";
          }elseif($company_data->sms_status == 'NO'){
             //echo "Hakuna kitu hapa";
          }
         }
           
         }


         }

          return redirect('oficer/view_all_group_loan/'.$group_id);
          }   
                
       $this->view_all_group_loan();

      }





    public function deposit_loan_saving(){
    $this->form_validation->set_rules('customer_id','Customer','required');
    $this->form_validation->set_rules('comp_id','Company','required');
    $this->form_validation->set_rules('blanch_id','blanch','required');
    $this->form_validation->set_rules('loan_id','Loan','required');
    $this->form_validation->set_rules('depost','depost','required');
    $this->form_validation->set_rules('p_method','Method','required');
    $this->form_validation->set_rules('description','description','required');
    $this->form_validation->set_rules('deposit_date','deposit date','required');
    $this->form_validation->set_rules('day_id','day deposit','required');
    $this->form_validation->set_rules('double','double');
    $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
       if ($this->form_validation->run()) {
          $depost = $this->input->post();
          // echo "<pre>";
          // print_r($depost);
          //     exit();
          $customer_id = $depost['customer_id'];
          $comp_id = $depost['comp_id'];
          $blanch_id = $depost['blanch_id'];
          $p_method = $depost['p_method'];
          $loan_id = $depost['loan_id'];
          $deposit_date = $depost['deposit_date'];
          $day_id = $depost['day_id'];
          $double = $depost['double'];
          $description = 'LOAN RETURN';
          $depost = $depost['depost'];
          $new_balance = $depost;
          $new_depost = $depost;

          $deposit_date = $deposit_date;
          $payment_method = $p_method;
          $kumaliza = $depost;
          $trans_id = $p_method;

          $today = date("Y-m-d");

           $this->load->model('queries');
           $blanch_id = $this->session->userdata('blanch_id');
           $empl_id = $this->session->userdata('empl_id');
           $manager_data = $this->queries->get_manager_data($empl_id);
           $comp_id = $manager_data->comp_id;
           $company_data = $this->queries->get_companyData($comp_id);
           $blanch_data = $this->queries->get_blanchData($blanch_id);
            $empl_data = $this->queries->get_employee_data($empl_id);
          $company_data = $this->queries->get_companyData($comp_id);
          $loan_restoration = $this->queries->get_restoration_loan($loan_id);
          $empl_id = $loan_restoration->empl_id;
          $date_show = $loan_restoration->date_show;
          $company = $this->queries->get_comp_data($comp_id);


          //sms count function
          @$smscount = $this->queries->get_smsCountDate($comp_id);
          $sms_number = @$smscount->sms_number;
          $sms_id = @$smscount->sms_id;

          $comp_name = $company->comp_name;
          $comp_phone = $company->comp_phone;
          
          $restoration = $loan_restoration->restration;
          $group_id = $loan_restoration->group_id;
          $loan_codeID = $loan_restoration->loan_code;

      
 
          $data_depost = $this->queries->get_customer_Loandata($customer_id);
          $customer_data = $this->queries->get_customerData($customer_id);
          $phones = $customer_data->phone_no;
          $admin_data = $this->queries->get_admin_role($comp_id);
          $remain_balance = $data_depost->balance;
          $old_balance = $remain_balance;
          $sum_balance = $old_balance + $new_depost;

          @$blanch_account = $this->queries->get_amount_remainAmountBlanch($blanch_id,$payment_method);
          $blanch_capital = @$blanch_account->blanch_capital;
          $depost_money = $blanch_capital + $new_depost;
               
          //admin role
          $role = $empl_data->username;
          

          $out_data = $this->queries->getOutstand_loanData($loan_id);
          $total_depost_loan = $this->queries->get_total_depost($loan_id);

               //new code
          $interest_data = $this->queries->get_interest_loan($loan_id);
          $int = $new_depost;
          $day = @$interest_data->day;
          $interest_formular = $interest_data->interest_formular;
          $session = $interest_data->session;
          $loan_aprove = $interest_data->loan_aprove;
          $loan_status = $interest_data->loan_status;
          $loan_int = $interest_data->loan_int;
          $ses_day = $session;
          $day_int = $int /  $ses_day;
          $day_princ = $int - $day_int;

          //insert principal balance 
          $trans_id = $payment_method;
          $princ_status = $loan_status;
          $principal_balance = $day_princ;
          $interest_balance = $day_int;
           
          //principal
          $principal_blanch = $this->queries->get_blanch_capitalPrincipal($comp_id,$blanch_id,$trans_id,$princ_status);
          $old_principal_balance = @$principal_blanch->principal_balance;
          $principal_insert = $old_principal_balance + $principal_balance;

           //interest
          $interest_blanch = $this->queries->get_blanch_interest_capital($comp_id,$blanch_id,$trans_id,$princ_status);
          $interest_blanch_balance = @$interest_blanch->capital_interest;
          $interest_insert = $interest_blanch_balance + $day_int;
           

         $total_depost = $this->queries->get_sum_dapost($loan_id);
         $loan_dep = $total_depost->remain_balance_loan;
         $kumaliza_depost = $loan_dep + $kumaliza;

         $loan_int = $loan_restoration->loan_int;
         $remain_loan = $loan_int - $total_depost->remain_balance_loan;

         $baki = $loan_int - ($loan_dep +$kumaliza);

         $sun_blanch_capital = $this->queries->get_remain_blanch_capital($blanch_id,$trans_id);
         $total_blanch_amount = $sun_blanch_capital->blanch_capital;
         $deposit_new = $total_blanch_amount + $depost;
      
         if ($kumaliza_depost < $loan_int){
            //print_r($kumaliza_depost);
              // echo "bado sana";
           }elseif($kumaliza_depost > $loan_int){
            //echo "hapana";
           }elseif($kumaliza_depost = $loan_int){
            $this->update_loastatus_done($loan_id);
            $this->insert_loan_kumaliza($comp_id,$blanch_id,$customer_id,$loan_id,$kumaliza,$group_id);
            $this->update_customer_statusclose($customer_id);
            //echo "tunamaliza kazi";
          }


          @$check_deposit = $this->queries->get_today_deposit_record($loan_id,$deposit_date);
          $depost_check = @$check_deposit->depost;
          $dep_id = @$check_deposit->dep_id;
          $again_deposit = $depost_check +  $depost;
          $again_deposit_double = $depost_check + $restoration;

          // print_r($again_deposit_double);
          //         exit();


          @$check_prev = $this->queries->get_prev_record_report($loan_id,$deposit_date);
          $prev_deposit = @$check_prev->depost;
          $dep_id = @$check_prev->pay_id;
          $again_prev = $prev_deposit + $depost;
          $again_prev_double = $prev_deposit + $restoration;

      //outstand deposit

          @$out_deposit = $this->queries->get_outstand_deposit($blanch_id,$trans_id);
          $out_balance = @$out_deposit->out_balance;

          $new_out_balance = $out_balance + $depost;
          // print_r($new_out_balance);
          //          exit();
         $pay_id = $dep_id;

           if ($out_data == TRUE){
            if ($depost > $out_data->remain_amount){
            $this->session->set_flashdata("error",'Your Depost Amount is Greater');
            }else{
           $remain_amount = $out_data->remain_amount;
           $paid_amount = $out_data->paid_amount;
           $customer_id = $out_data->customer_id;
            if($new_balance >= $remain_amount){
           $depost_amount = $remain_amount - $new_balance;
           $paid_out = $paid_amount + $new_balance;
           
           // print_r($depost_amount);
              //       exit();
          //insert depost balance

          if ($check_deposit == TRUE) {
            $this->update_deposit_record($loan_id,$deposit_date,$again_deposit,$day_id);
             }else{
             $dep_id = $this->insert_loan_lecorDeposit($comp_id,$customer_id,$loan_id,$blanch_id,$new_depost,$p_method,$role,$day_int,$day_princ,$loan_status,$group_id,$deposit_date,$empl_id,$day_id);
             }
           
           if (@$out_deposit->out_balance == TRUE || @$out_deposit->out_balance == '0' ) {
           $this->update_blanch_amount_outstand($comp_id,$blanch_id,$new_out_balance,$trans_id);   
           }else{
          $this->insert_blanch_amount_outstand_deposit($comp_id,$blanch_id,$new_out_balance,$trans_id);
           }

           $this->insert_blanch_amount_deposit($blanch_id,$deposit_new,$trans_id);
           $this->update_loan_dep_status($loan_id);
          $new_balance = $new_depost;

          if ($dep_id > 0) {
             $this->session->set_flashdata('massage','Deposit has made Sucessfully');
          }else{
            $this->session->set_flashdata('massage','Failed');
          }
          $this->update_outstand_status($loan_id);
         if ($check_prev == TRUE) {
          $dep_id = $dep_id;
          $empl_id = $empl_id;
          $this->update_deposit_record_prev($loan_id,$deposit_date,$again_prev,$dep_id,$p_method);
          }else{
          $dep_id = $dep_id;
          $empl_id = $empl_id;
         $this->insert_loan_lecordDataDeposit($comp_id,$customer_id,$loan_id,$blanch_id,$new_depost,$dep_id,$group_id,$trans_id,$restoration,$loan_aproved,$deposit_date,$empl_id);
          }
         $this->insert_remainloan($loan_id,$depost_amount,$paid_out,$pay_id);
         $this->update_loastatus($loan_id);
         $this->depost_balance($loan_id,$comp_id,$blanch_id,$customer_id,$new_depost,$sum_balance,$description,$role,$group_id,$p_method,$deposit_date,$dep_id,$baki);
         //$this->depost_Blanch_accountBalance($comp_id,$blanch_id,$payment_method,$depost_money);
            if(@$principal_blanch == TRUE){
         $this->update_principal_capital_balanc($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert);
         }elseif(@$principal_blanch == FALSE){
         $this->insert_blanch_principal($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert);
         }
          //interest
         if (@$interest_blanch == TRUE) {
         $this->update_interest_blanchBalance($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert);    
         }elseif(@$interest_blanch == FALSE){
         $this->insert_interest_blanch_capital($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert);
       }
          $this->insert_customer_report($loan_id,$comp_id,$blanch_id,$customer_id,$group_id,$new_depost,$pay_id,$deposit_date);
         //$this->insert_prepaid_balance($loan_id,$comp_id,$blanch_id,$customer_id,$prepaid);
         $this->update_customer_statusLoan($customer_id);
         $total_depost = $this->queries->get_sum_dapost($loan_id);
         $loan_int = $loan_restoration->loan_int;
         $remain_loan = $loan_int - $total_depost->remain_balance_loan;
            //sms send
          $sms = 'Umeingiza Tsh.' .$new_balance. ' kwenye Acc Yako ' . $loan_codeID . $comp_name.' Mpokeaji '.$role . ' Kiasi kilicho baki Kulipwa ni Tsh.'.$remain_loan.' Kwa malalamiko piga '.$comp_phone;
          $massage = $sms;
          $phone = $phones;

          $loan_ID = $loan_id;
          @$out_check = $this->queries->get_outstand_total($loan_id);
          $amount_remain = @$out_check->remain_amount;
            // print_r($new_balance);
            //       exit();
          if($amount_remain > $new_balance){
          $this->insert_outstand_balance($comp_id,$blanch_id,$customer_id,$loan_id,$new_balance,$group_id,$dep_id,$p_method);
          }elseif($amount_remain = $new_balance) {
          $this->insert_outstand_balance($comp_id,$blanch_id,$customer_id,$loan_id,$new_balance,$group_id,$dep_id,$p_method);
          }

          //$phone = '255'.substr($phones, 1,10);
            // print_r($sms);
            //   echo "<br>";
            // print_r($phone);
            //      exit();
          if ($company_data->sms_status == 'YES'){
              if ($smscount->sms_number == TRUE) {
                $new_sms = 1;
                $total_sms = $sms_number + $new_sms;
                $this->update_count_sms($comp_id,$total_sms,$sms_id);
              }elseif ($smscount->sms_number == FALSE) {
             $sms_number = 1;
             $this->insert_count_sms($comp_id,$sms_number);
             }
             $this->sendsms($phone,$massage);
             //echo "kitu kipo";
          }elseif($company_data->sms_status == 'NO'){
             //echo "Hakuna kitu hapa";
          }


        }else{      
           $depost_amount = $remain_amount - $new_balance;
           $paid_out = $paid_amount + $new_balance;
              
          //insert depost balance
          if ($check_deposit == TRUE) {
            $this->update_deposit_record($loan_id,$deposit_date,$again_deposit,$day_id);
             }else{
             $dep_id = $this->insert_loan_lecorDeposit($comp_id,$customer_id,$loan_id,$blanch_id,$new_depost,$p_method,$role,$day_int,$day_princ,$loan_status,$group_id,$deposit_date,$empl_id,$day_id);
             }
          
          if (@$out_deposit->out_balance == TRUE || @$out_deposit->out_balance == '0' ) {
           $this->update_blanch_amount_outstand($comp_id,$blanch_id,$new_out_balance,$trans_id);   
           }else{
          $this->insert_blanch_amount_outstand_deposit($comp_id,$blanch_id,$new_out_balance,$trans_id);
           }
           $this->insert_blanch_amount_deposit($blanch_id,$deposit_new,$trans_id);
           $this->update_loan_dep_status($loan_id);
          $new_balance = $new_depost;
          if ($dep_id > 0) {
             $this->session->set_flashdata('massage','Deposit has made Sucessfully');
          }else{
            $this->session->set_flashdata('massage','Failed');
          }
         if ($check_prev == TRUE) {
          $dep_id = $dep_id;
          $empl_id = $empl_id;
          $this->update_deposit_record_prev($loan_id,$deposit_date,$again_prev,$dep_id,$p_method);
          }else{
          $dep_id = $dep_id;
          $empl_id = $empl_id;
         $this->insert_loan_lecordDataDeposit($comp_id,$customer_id,$loan_id,$blanch_id,$new_depost,$dep_id,$group_id,$trans_id,$restoration,$loan_aproved,$deposit_date,$empl_id);
          }
         $this->insert_remainloan($loan_id,$depost_amount,$paid_out,$pay_id);
         
         $this->depost_balance($loan_id,$comp_id,$blanch_id,$customer_id,$new_depost,$sum_balance,$description,$role,$group_id,$p_method,$deposit_date,$dep_id,$baki);

         //$this->depost_Blanch_accountBalance($comp_id,$blanch_id,$payment_method,$depost_money);
            if (@$principal_blanch == TRUE) {
         $this->update_principal_capital_balanc($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert);
         }elseif(@$principal_blanch == FALSE){
         $this->insert_blanch_principal($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert);
         }
          //inrterest
         if (@$interest_blanch == TRUE) {
         $this->update_interest_blanchBalance($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert);    
         }elseif(@$interest_blanch == FALSE){
         $this->insert_interest_blanch_capital($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert);
       }
          $this->insert_customer_report($loan_id,$comp_id,$blanch_id,$customer_id,$group_id,$new_depost,$pay_id,$deposit_date);
         //$this->insert_prepaid_balance($loan_id,$comp_id,$blanch_id,$customer_id,$prepaid);
          $total_depost = $this->queries->get_sum_dapost($loan_id);
         $loan_int = $loan_restoration->loan_int;
         $remain_loan = $loan_int - $total_depost->remain_balance_loan;
            //sms send
          $sms = 'Umeingiza Tsh.' .$new_balance. ' kwenye Acc Yako ' . $loan_codeID . $comp_name.' Mpokeaji '.$role . ' Kiasi kilicho baki Kulipwa ni Tsh.'.$remain_loan.' Kwa malalamiko piga '.$comp_phone;
          $massage = $sms;
          $phone = $phones;


           $loan_ID = $loan_id;
          @$out_check = $this->queries->get_outstand_total($loan_id);
          $amount_remain = @$out_check->remain_amount;
              
          if($amount_remain > $new_balance){

         $this->insert_outstand_balance($comp_id,$blanch_id,$customer_id,$loan_id,$new_balance,$group_id,$dep_id,$p_method);
          // print_r($comp_id);
          //         exit();
          }elseif($amount_remain = $new_balance) {
          $this->insert_outstand_balance($comp_id,$blanch_id,$customer_id,$loan_id,$new_balance,$group_id,$dep_id,$p_method);
          }
          //$phone = '255'.substr($phones, 1,10);
            // print_r($sms);
            //   echo "<br>";
            // print_r($phone);
            //      exit();
          if ($company_data->sms_status == 'YES'){
             if ($smscount->sms_number == TRUE) {
                $new_sms = 1;
                $total_sms = $sms_number + $new_sms;
                $this->update_count_sms($comp_id,$total_sms,$sms_id);
              }elseif ($smscount->sms_number == FALSE) {
             $sms_number = 1;
             $this->insert_count_sms($comp_id,$sms_number);
             }
             $this->sendsms($phone,$massage);
             //echo "kitu kipo";
          }elseif($company_data->sms_status == 'NO'){
             //echo "Hakuna kitu hapa";
          }
          }
          }

        //ndani ya mkataba
           }elseif($out_data == FALSE){
     $remain_data = $this->queries->get_loan_deposit_data($loan_id);
     $den_remain = $loan_int - $remain_data->total_deposit;
     @$pend_sum = $this->queries->get_total_pending_loan_data($loan_id);
     $recover = @$pend_sum->total_recover;

     $double_amount = $depost - $recover - $restoration;
     $double_amount_again = $depost - $recover;
     // print_r($double_amount);
     //    exit();
           if ($double == 'YES') {
        if ($kumaliza_depost > $loan_int){
            $this->session->set_flashdata("error",'Your Depost Amount is Greater'); 
            }elseif($depost < $den_remain){
         $this->session->set_flashdata("error",'The Amount Is Insufficient to Close The Loan'); 
            }else{

           echo "kama kawaida";
          //       exit();
          //insert depost balance
            if ($check_deposit == TRUE){
            $this->update_deposit_record_double($loan_id,$deposit_date,$again_deposit_double,$day_id,$double_amount_again);
            $this->insert_double_amount_loan_updated($comp_id,$blanch_id,$loan_id,$trans_id,$double_amount_again,$dep_id);
             }else{
             $dep_id = $this->insert_loan_lecorDeposit_double($comp_id,$customer_id,$loan_id,$blanch_id,$restoration,$p_method,$role,$day_int,$day_princ,$loan_status,$group_id,$deposit_date,$empl_id,$day_id,$double_amount);
             $this->insert_double_amount_loan($comp_id,$blanch_id,$loan_id,$trans_id,$double_amount,$dep_id);
             }
           
          $this->insert_blanch_amount_deposit($blanch_id,$deposit_new,$trans_id);
          $this->update_loan_dep_status($loan_id);
             //exit();
          
          $new_balance = $new_depost;
          if ($dep_id > 0) {
             $this->session->set_flashdata('massage','Deposit has made Sucessfully');
          }else{
            $this->session->set_flashdata('massage','Deposit has made Sucessfully');
          }
          
          if ($check_prev == TRUE) {
          $dep_id = $dep_id;
          $empl_id = $empl_id;
          $this->update_deposit_record_prev_double($loan_id,$deposit_date,$again_prev_double,$dep_id,$p_method,$double_amount_again);
          }else{
          $dep_id = $dep_id;
          $empl_id = $empl_id;
         $this->insert_loan_lecordDataDeposit_double($comp_id,$customer_id,$loan_id,$blanch_id,$dep_id,$group_id,$trans_id,$restoration,$loan_aproved,$deposit_date,$empl_id,$double_amount);
          }
         $this->depost_balance($loan_id,$comp_id,$blanch_id,$customer_id,$new_depost,$sum_balance,$description,$role,$group_id,$p_method,$deposit_date,$dep_id,$baki);

         //$this->depost_Blanch_accountBalance($comp_id,$blanch_id,$payment_method,$depost_money);
         //principal
         if (@$principal_blanch == TRUE) {
         $this->update_principal_capital_balanc($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert);
         }elseif(@$principal_blanch == FALSE){
         $this->insert_blanch_principal($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert);
         }
          //inrterest
         if (@$interest_blanch == TRUE) {
         $this->update_interest_blanchBalance($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert);    
         }elseif(@$interest_blanch == FALSE){
         $this->insert_interest_blanch_capital($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert);
       }
        
         
          //updating recovery loan
         $loan_ID = $loan_id;
         @$data_pend = $this->queries->get_total_pending_loan($loan_ID);
          $total_pend = @$data_pend->total_pend;

          if (@$data_pend->total_pend == TRUE) {
            if($depost > $total_pend){
           $deni_lipa = $depost - $total_pend;
           //$recovery = $deni_lipa - $total_pend; 
           $this->update_loan_pending_remain($loan_id);
           $this->insert_description_report($comp_id,$blanch_id,$customer_id,$loan_id,$total_pend,$deni_lipa,$group_id,$dep_id); 
            }elseif($depost < $total_pend){
           $deni_lipa = $total_pend - $depost;
           $this->update_loan_pending_balance($loan_id,$deni_lipa);
           $this->insert_returnDescriptionData_report($comp_id,$blanch_id,$customer_id,$loan_id,$depost,$group_id,$dep_id,$p_method);
          }elseif ($depost = $total_pend) {
          $this->update_loan_pending_remain($loan_id);
          $this->insert_returnDescriptionData_report($comp_id,$blanch_id,$customer_id,$loan_id,$depost,$group_id,$dep_id,$p_method);
          }
          }elseif ($data_pend->total_pend == FALSE) {
          if($date_show >= $today){
            if ($depost < $restoration) {
                $prepaid = 0;
            }else{
           $prepaid = $depost - $restoration;
           }
           //$this->insert_prepaid_balance($loan_id,$comp_id,$blanch_id,$customer_id,$prepaid,$dep_id,$trans_id);   
            }else{
            
            }
          
          }

         $total_depost = $this->queries->get_sum_dapost($loan_id);
         $loan_int = $loan_restoration->loan_int;
         $remain_loan = $loan_int - $total_depost->remain_balance_loan;
            //sms send
          $sms = 'Umeingiza Tsh.' .$new_balance. ' kwenye Acc Yako ' . $loan_codeID . $comp_name.' Mpokeaji '.$role . ' Kiasi kilicho baki Kulipwa ni Tsh.'.$remain_loan.' Kwa malalamiko piga '.$comp_phone;
          $massage = $sms;
          $phone = $phones;

          if ($company_data->sms_status == 'YES'){
              if (@$smscount->sms_number == TRUE) {
                $new_sms = 1;
                $total_sms = @$sms_number + $new_sms;
                $this->update_count_sms($comp_id,$total_sms,$sms_id);
              }elseif (@$smscount->sms_number == FALSE) {
             $sms_number = 1;
             $this->insert_count_sms($comp_id,$sms_number);
             }
             $this->sendsms($phone,$massage);
             //echo "kitu kipo";
          }elseif($company_data->sms_status == 'NO'){
             //echo "Hakuna kitu hapa";
          }
      }

          //echo "weka double";

         }elseif($double == 'NO'){
         if ($kumaliza_depost > $loan_int){
            $this->session->set_flashdata("error",'Your Depost Amount is Greater'); 
            }else{
          //insert depost balance
            if ($check_deposit == TRUE) {
            $this->update_deposit_record($loan_id,$deposit_date,$again_deposit,$day_id);
             }else{
             $dep_id = $this->insert_loan_lecorDeposit($comp_id,$customer_id,$loan_id,$blanch_id,$new_depost,$p_method,$role,$day_int,$day_princ,$loan_status,$group_id,$deposit_date,$empl_id,$day_id);
             }
           
          $this->insert_blanch_amount_deposit($blanch_id,$deposit_new,$trans_id);
          $this->update_loan_dep_status($loan_id);
             //exit();
          
          $new_balance = $new_depost;
          if ($dep_id > 0) {
             $this->session->set_flashdata('massage','Deposit has made Sucessfully');
          }else{
            $this->session->set_flashdata('massage','Deposit has made Sucessfully');
          }
          
          if ($check_prev == TRUE) {
          $dep_id = $dep_id;
          $empl_id = $empl_id;
          $this->update_deposit_record_prev($loan_id,$deposit_date,$again_prev,$dep_id,$p_method);
          }else{
          $dep_id = $dep_id;
          $empl_id = $empl_id;
         $this->insert_loan_lecordDataDeposit($comp_id,$customer_id,$loan_id,$blanch_id,$new_depost,$dep_id,$group_id,$trans_id,$restoration,$loan_aproved,$deposit_date,$empl_id);
          }
         $this->depost_balance($loan_id,$comp_id,$blanch_id,$customer_id,$new_depost,$sum_balance,$description,$role,$group_id,$p_method,$deposit_date,$dep_id,$baki);

         //$this->depost_Blanch_accountBalance($comp_id,$blanch_id,$payment_method,$depost_money);
         //principal
         if (@$principal_blanch == TRUE) {
         $this->update_principal_capital_balanc($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert);
         }elseif(@$principal_blanch == FALSE){
         $this->insert_blanch_principal($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert);
         }
          //inrterest
         if (@$interest_blanch == TRUE) {
         $this->update_interest_blanchBalance($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert);    
         }elseif(@$interest_blanch == FALSE){
         $this->insert_interest_blanch_capital($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert);
       }
        
         
          //updating recovery loan
         $loan_ID = $loan_id;
         @$data_pend = $this->queries->get_total_pending_loan($loan_ID);
          $total_pend = @$data_pend->total_pend;

          if (@$data_pend->total_pend == TRUE) {
            if($depost > $total_pend){
           $deni_lipa = $depost - $total_pend;
           //$recovery = $deni_lipa - $total_pend; 
           $this->update_loan_pending_remain($loan_id);
           $this->insert_description_report($comp_id,$blanch_id,$customer_id,$loan_id,$total_pend,$deni_lipa,$group_id,$dep_id); 
            }elseif($depost < $total_pend){
           $deni_lipa = $total_pend - $depost;
           $this->update_loan_pending_balance($loan_id,$deni_lipa);
           $this->insert_returnDescriptionData_report($comp_id,$blanch_id,$customer_id,$loan_id,$depost,$group_id,$dep_id,$p_method);
          }elseif ($depost = $total_pend) {
          $this->update_loan_pending_remain($loan_id);
          $this->insert_returnDescriptionData_report($comp_id,$blanch_id,$customer_id,$loan_id,$depost,$group_id,$dep_id,$p_method);
          }
          }elseif ($data_pend->total_pend == FALSE) {
          if($date_show >= $today){
            if ($depost < $restoration) {
                $prepaid = 0;
            }else{
           $prepaid = $depost - $restoration;
           }
           $this->insert_prepaid_balance($loan_id,$comp_id,$blanch_id,$customer_id,$prepaid,$dep_id,$trans_id);   
            }else{
            
            }
          
          }

         $total_depost = $this->queries->get_sum_dapost($loan_id);
         $loan_int = $loan_restoration->loan_int;
         $remain_loan = $loan_int - $total_depost->remain_balance_loan;
            //sms send
          $sms = 'Umeingiza Tsh.' .$new_balance. ' kwenye Acc Yako ' . $loan_codeID . $comp_name.' Mpokeaji '.$role . ' Kiasi kilicho baki Kulipwa ni Tsh.'.$remain_loan.' Kwa malalamiko piga '.$comp_phone;
          $massage = $sms;
          $phone = $phones;

          if ($company_data->sms_status == 'YES'){
              if (@$smscount->sms_number == TRUE) {
                $new_sms = 1;
                $total_sms = @$sms_number + $new_sms;
                $this->update_count_sms($comp_id,$total_sms,$sms_id);
              }elseif (@$smscount->sms_number == FALSE) {
             $sms_number = 1;
             $this->insert_count_sms($comp_id,$sms_number);
             }
             $this->sendsms($phone,$massage);
             //echo "kitu kipo";
          }elseif($company_data->sms_status == 'NO'){
             //echo "Hakuna kitu hapa";
          }
         }
           
         }


         }

          return redirect('oficer/data_with_depost/'.$customer_id);
          }   
                
       $this->data_with_depost();

      }



      public function insert_double_amount_loan($comp_id,$blanch_id,$loan_id,$trans_id,$double_amount,$dep_id){
      $date = date("Y-m-d");
       $this->db->query("INSERT INTO  tbl_double (`comp_id`,`blanch_id`,`loan_id`,`trans_id`,`double_amount`,`dep_id`,`double_date`) VALUES ('$comp_id','$blanch_id','$loan_id','$trans_id','$double_amount','$dep_id','$date')");  
      }

      public function insert_double_amount_loan_updated($comp_id,$blanch_id,$loan_id,$trans_id,$double_amount_again,$dep_id){
      $date = date("Y-m-d");
       $this->db->query("INSERT INTO  tbl_double (`comp_id`,`blanch_id`,`loan_id`,`trans_id`,`double_amount`,`dep_id`,`double_date`) VALUES ('$comp_id','$blanch_id','$loan_id','$trans_id','$double_amount_again','$dep_id','$date')");  
      }



    public function update_loan_dep_status($loan_id){
     $sqldata="UPDATE `tbl_loans` SET `dep_status`= 'close' WHERE `loan_id`= '$loan_id'";
    // print_r($sqldata);
    //    exit();
     $query = $this->db->query($sqldata);
     return true;    
    }  

    public function update_blanch_amount_outstand($comp_id,$blanch_id,$new_out_balance,$trans_id){
    $sqldata="UPDATE `tbl_receve_outstand` SET `out_balance`= '$new_out_balance' WHERE `blanch_id`= '$blanch_id' AND `trans_id`='$trans_id'";
    // print_r($sqldata);
    //    exit();
     $query = $this->db->query($sqldata);
     return true; 
      }


      public function insert_blanch_amount_outstand_deposit($comp_id,$blanch_id,$new_out_balance,$trans_id){
        $date = date("Y-m-d");
        $this->db->query("INSERT INTO  tbl_receve_outstand (`comp_id`,`blanch_id`,`trans_id`,`out_balance`,`date`) VALUES ('$comp_id','$blanch_id','$trans_id','$new_out_balance','$date')"); 
      }


             //update loan status
    public function update_loastatus($loan_id){
     $sqldata="UPDATE `tbl_loans` SET `loan_status`= 'done' WHERE `loan_id`= '$loan_id'";
    // print_r($sqldata);
    //    exit();
     $query = $this->db->query($sqldata);
     return true;
   }

         public function insert_loan_lecordDataDeposit($comp_id,$customer_id,$loan_id,$blanch_id,$new_depost,$dep_id,$group_id,$trans_id,$restoration,$loan_aproved,$deposit_date,$empl_id){
        //$day = date("Y-m-d");
        $time = date("Y-m-d H:i:s");
        $this->db->query("INSERT INTO tbl_prev_lecod (`comp_id`,`customer_id`,`loan_id`,`blanch_id`,`depost`,`lecod_day`,`pay_id`,`time_rec`,`trans_id`,`restrations`,`loan_aprov`,`empl_id`) VALUES ('$comp_id','$customer_id','$loan_id','$blanch_id','$new_depost','$deposit_date','$dep_id','$time','$trans_id','$restoration','$loan_aproved','$empl_id')");
    }

    //double prevrecord
 public function insert_loan_lecordDataDeposit_double($comp_id,$customer_id,$loan_id,$blanch_id,$dep_id,$group_id,$trans_id,$restoration,$loan_aproved,$deposit_date,$empl_id,$double_amount){
        //$day = date("Y-m-d");
        $time = date("Y-m-d H:i:s");
        $this->db->query("INSERT INTO tbl_prev_lecod (`comp_id`,`customer_id`,`loan_id`,`blanch_id`,`depost`,`lecod_day`,`pay_id`,`time_rec`,`trans_id`,`restrations`,`loan_aprov`,`empl_id`,`double_dep`) VALUES ('$comp_id','$customer_id','$loan_id','$blanch_id','$restoration','$deposit_date','$dep_id','$time','$trans_id','$restoration','$loan_aproved','$empl_id','$double_amount')");
    }


      public function insert_blanch_amount_deposit($blanch_id,$deposit_new,$trans_id){
      $sqldata="UPDATE `tbl_blanch_account` SET `blanch_capital`= '$deposit_new' WHERE `blanch_id`= '$blanch_id' AND `receive_trans_id` ='$trans_id'";
      $query = $this->db->query($sqldata);
      return true;
      }

      public function update_prepaid($loan_id,$total_prepaid){
     $sqldata="UPDATE `tbl_prepaid` SET `prepaid_amount`= '$total_prepaid' WHERE `loan_id`= '$loan_id'";
     $query = $this->db->query($sqldata);
     return true;
      }


    public function update_deposit_record_prev($loan_id,$deposit_date,$again_prev,$dep_id,$p_method){
     $sqldata="UPDATE `tbl_prev_lecod` SET `depost`= '$again_prev',`pay_id`='$dep_id',`trans_id`='$p_method' WHERE `loan_id`= '$loan_id' AND `lecod_day`='$deposit_date'";

     $query = $this->db->query($sqldata);
     return true;
    }

    //double prev
    public function update_deposit_record_prev_double($loan_id,$deposit_date,$again_prev_double,$dep_id,$p_method,$double_amount_again){
     $sqldata="UPDATE `tbl_prev_lecod` SET `pay_id`='$dep_id',`trans_id`='$p_method',`double_dep`='$double_amount_again' WHERE `loan_id`= '$loan_id' AND `lecod_day`='$deposit_date'";

     $query = $this->db->query($sqldata);
     return true;
    }

    



  public function update_deposit_record($loan_id,$deposit_date,$again_deposit,$day_id){
    $sqldata="UPDATE `tbl_depost` SET `depost`= '$again_deposit',`day_id`='$day_id' WHERE `loan_id`= '$loan_id' AND `depost_day`='$deposit_date'";
     $query = $this->db->query($sqldata);
     return true;   
  }

  public function update_deposit_record_double($loan_id,$deposit_date,$again_deposit_double,$day_id,$double_amount_again){
    $sqldata="UPDATE `tbl_depost` SET `day_id`='$day_id',`double_amont`='$double_amount_again' WHERE `loan_id`= '$loan_id' AND `depost_day`='$deposit_date'";
     $query = $this->db->query($sqldata);
     return true;   
  }


   public function insert_outstand_balance($comp_id,$blanch_id,$customer_id,$loan_id,$new_balance,$group_id,$dep_id,$p_method){
    $report_day = date("Y-m-d");
    $this->db->query("INSERT INTO  tbl_pay (`comp_id`,`blanch_id`,`customer_id`,`loan_id`,`withdrow`,`balance`,`description`,`date_data`,`auto_date`,`group_id`,`dep_id`,`p_method`) VALUES ('$comp_id','$blanch_id','$customer_id','$loan_id','$new_balance','0','SYSTEM / DEFAULT LOAN RETURN','$report_day','$report_day','$group_id','$dep_id','$p_method')");
   }

  public function insert_returnDescriptionData_report($comp_id,$blanch_id,$customer_id,$loan_id,$depost,$group_id,$dep_id,$p_method){
     $report_day = date("Y-m-d");
    $this->db->query("INSERT INTO  tbl_pay (`comp_id`,`blanch_id`,`customer_id`,`loan_id`,`withdrow`,`balance`,`description`,`date_data`,`auto_date`,`group_id`,`dep_id`,`p_method`) VALUES ('$comp_id','$blanch_id','$customer_id','$loan_id','$depost','0','SYSTEM / PENDING LOAN RETURN','$report_day','$report_day','$group_id','$dep_id','$p_method')");
   }

     public function update_loan_pending_balance($loan_id,$deni_lipa){
     $sqldata="UPDATE `tbl_pending_total` SET `total_pend`= '$deni_lipa' WHERE `loan_id`= '$loan_id'";
     $query = $this->db->query($sqldata);
     return true;
     }

      public function insert_description_report($comp_id,$blanch_id,$customer_id,$loan_id,$total_pend,$deni_lipa,$group_id,$dep_id){
      $report_day = date("Y-m-d");
    $this->db->query("INSERT INTO  tbl_pay (`comp_id`,`blanch_id`,`customer_id`,`loan_id`,`withdrow`,`balance`,`description`,`date_data`,`auto_date`,`group_id`,`dep_id`) VALUES ('$comp_id','$blanch_id','$customer_id','$loan_id','$total_pend','$deni_lipa','SYSTEM / LOAN PENDING RETURN','$report_day','$report_day','$group_id','$dep_id')");
      }

   //update empty
   public function update_loan_pending_remain($loan_id)
     {
     $sqldata="UPDATE `tbl_pending_total` SET `total_pend`= '0' WHERE `loan_id`= '$loan_id'";
     $query = $this->db->query($sqldata);
     return true;   
     }


                     //update loan status
    public function update_loastatus_done($loan_id){
  $sqldata="UPDATE `tbl_loans` SET `loan_status`= 'done' WHERE `loan_id`= '$loan_id'";
    // print_r($sqldata);
    //    exit();
  $query = $this->db->query($sqldata);
   return true;
}

  public function insert_loan_kumaliza($comp_id,$blanch_id,$customer_id,$loan_id,$kumaliza,$group_id){
            $report_day = date("Y-m-d");
    $this->db->query("INSERT INTO tbl_customer_report (`comp_id`,`blanch_id`,`customer_id`,`loan_id`,`recevable_amount`,`pending_amount`,`rep_date`,`group_id`) VALUES ('$comp_id','$blanch_id','$customer_id','$loan_id','$kumaliza','$kumaliza','$report_day','$group_id')");
    }

             //update customer status
public function update_customer_statusclose($customer_id){
$sqldata="UPDATE `tbl_customer` SET `customer_status`= 'close' WHERE `customer_id`= '$customer_id'";
    // print_r($sqldata);
    //    exit();
  $query = $this->db->query($sqldata);
   return true;
}


  public function update_interest_blanchBalance($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert){
   $sqldata="UPDATE `tbl_blanch_capital_interest` SET `capital_interest`= '$interest_insert' WHERE `blanch_id`= '$blanch_id' AND `trans_id`='$trans_id' AND `int_status`='$princ_status'";
    // print_r($sqldata);
    //    exit();
   $query = $this->db->query($sqldata);
   return true; 
  }    

  public function update_principal_capital_balanc($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert){
  $sqldata="UPDATE `tbl_blanch_capital_principal` SET `principal_balance`= '$principal_insert' WHERE `blanch_id`= '$blanch_id' AND `trans_id`='$trans_id' AND `princ_status`='$princ_status'";
    // print_r($sqldata);
    //    exit();
   $query = $this->db->query($sqldata);
   return true;
  }    

public function insert_interest_blanch_capital($comp_id,$blanch_id,$trans_id,$princ_status,$interest_insert){
$this->db->query("INSERT INTO tbl_blanch_capital_interest (`comp_id`,`blanch_id`,`trans_id`,`int_status`,`capital_interest`) VALUES ('$comp_id','$blanch_id','$trans_id','$princ_status','$interest_insert')"); 
}
      
public function insert_blanch_principal($comp_id,$blanch_id,$trans_id,$princ_status,$principal_insert){
 $this->db->query("INSERT INTO tbl_blanch_capital_principal (`comp_id`,`blanch_id`,`trans_id`,`princ_status`,`principal_balance`) VALUES ('$comp_id','$blanch_id','$trans_id','$princ_status','$principal_insert')");   
}

      //update blanch Balance
   public function depost_Blanch_accountBalance($comp_id,$blanch_id,$payment_method,$depost_money){
      $sqldata="UPDATE `tbl_blanch_account` SET `blanch_capital`= '$depost_money' WHERE `blanch_id`= '$blanch_id' AND `receive_trans_id`='$payment_method'";
    // print_r($sqldata);
    //    exit();
     $query = $this->db->query($sqldata);
     return true;
      }




      //update outstand status
      public function update_outstand_status($loan_id){
     $sqldata="UPDATE `tbl_outstand_loan` SET `out_status`= 'close' WHERE `loan_id`= '$loan_id'";
    // print_r($sqldata);
    //    exit();
     $query = $this->db->query($sqldata);
     return true;
   }

      public function insert_remainloan($loan_id,$depost_amount,$paid_out,$pay_id){
   $sqldata="UPDATE `tbl_outstand_loan` SET `remain_amount`= '$depost_amount',`paid_amount`='$paid_out',`pay_id`='$pay_id' WHERE `loan_id`= '$loan_id'";
  $query = $this->db->query($sqldata);
  return true;
      }

        public function insert_blanch_amount($blanch_id,$new_depost){
  $sqldata="UPDATE `tbl_blanch_account` SET `blanch_capital`= `blanch_capital`+$new_depost WHERE `blanch_id`= '$blanch_id'";
    // print_r($sqldata);
    //    exit();
  $query = $this->db->query($sqldata);
  return true;
}

    public function insert_comp_balance($comp_id,$new_depost){
  $sqldata="UPDATE `tbl_ac_company` SET `comp_balance`= `comp_balance`+$new_depost WHERE `comp_id`= '$comp_id'";
    // print_r($sqldata);
    //    exit();
  $query = $this->db->query($sqldata);
  return true;
}

        //insert prepaid balance
    public function insert_prepaid_balance($loan_id,$comp_id,$blanch_id,$customer_id,$prepaid,$dep_id,$trans_id){
        $date = date("Y-m-d");
    $this->db->query("INSERT INTO tbl_prepaid (`loan_id`,`comp_id`,`blanch_id`,`customer_id`,`prepaid_amount`,`prepaid_date`,`dep_id`,`trans_id`) VALUES ('$loan_id','$comp_id','$blanch_id','$customer_id','$prepaid','$date','$dep_id','$trans_id')");
      }

      public function insert_loan_lecorDeposit($comp_id,$customer_id,$loan_id,$blanch_id,$new_depost,$p_method,$role,$day_int,$day_princ,$loan_status,$group_id,$deposit_date,$empl_id,$day_id){
        $time = date("Y-m-d H:i:s");
        $this->db->query("INSERT INTO  tbl_depost (`comp_id`,`customer_id`,`loan_id`,`blanch_id`,`depost`,`depost_day`,`depost_method`,`empl_username`,`sche_principal`,`sche_interest`,`dep_status`,`group_id`,`deposit_day`,`empl_id`,`day_id`) VALUES ('$comp_id','$customer_id','$loan_id','$blanch_id','$new_depost','$deposit_date','$p_method','$role','$day_princ','$day_int','$loan_status','$group_id','$time','$empl_id','$day_id')");
        return $this->db->insert_id();
    }

    //double receord
      public function insert_loan_lecorDeposit_double($comp_id,$customer_id,$loan_id,$blanch_id,$restoration,$p_method,$role,$day_int,$day_princ,$loan_status,$group_id,$deposit_date,$empl_id,$day_id,$double_amount){
        $time = date("Y-m-d H:i:s");
        $this->db->query("INSERT INTO  tbl_depost (`comp_id`,`customer_id`,`loan_id`,`blanch_id`,`depost`,`depost_day`,`depost_method`,`empl_username`,`sche_principal`,`sche_interest`,`dep_status`,`group_id`,`deposit_day`,`empl_id`,`day_id`,`double_amont`) VALUES ('$comp_id','$customer_id','$loan_id','$blanch_id','$restoration','$deposit_date','$p_method','$role','$day_princ','$day_int','$loan_status','$group_id','$time','$empl_id','$day_id','$double_amount')");
        return $this->db->insert_id();
    }

    public function depost_balance($loan_id,$comp_id,$blanch_id,$customer_id,$new_depost,$sum_balance,$description,$role,$group_id,$p_method,$deposit_date,$dep_id,$baki){
    $day = date("Y-m-d");
  $this->db->query("INSERT INTO tbl_pay (`loan_id`,`blanch_id`,`comp_id`,`customer_id`,`depost`,`balance`,`description`,`pay_status`,`stat`,`date_pay`,`emply`,`group_id`,`date_data`,`p_method`,`dep_id`,`rem_debt`) VALUES ('$loan_id','$blanch_id','$comp_id','$customer_id','$new_depost','$sum_balance','CASH DEPOSIT','1','1','$day','$role','$group_id','$deposit_date','$p_method','$dep_id','$baki')");
    

      }

       public function insert_customer_report($loan_id,$comp_id,$blanch_id,$customer_id,$group_id,$new_depost,$pay_id,$deposit_date){
          //$date = date("Y-m-d");
    $this->db->query("INSERT INTO tbl_customer_report (`loan_id`,`comp_id`,`blanch_id`,`customer_id`,`group_id`,`pending_amount`,`pay_id`,`rep_date`) VALUES ('$loan_id','$comp_id','$blanch_id','$customer_id','$group_id','$new_depost','$pay_id','$deposit_date')");
      }

      public function daily_report(){
       $this->load->model('queries');
      $blanch_id = $this->session->userdata('blanch_id');
      $empl_id = $this->session->userdata('empl_id');
      $manager_data = $this->queries->get_manager_data($empl_id);
      $comp_id = $manager_data->comp_id;
      $company_data = $this->queries->get_companyData($comp_id);
      $blanch_data = $this->queries->get_blanchData($blanch_id);
      $empl_data = $this->queries->get_employee_data($empl_id);
      $empl_id =$empl_data->empl_id; 

      $blanch_account = $this->queries->get_account_balance_blanch_data($blanch_id);

      
          
             for ($i=0; $i <count($blanch_account) ; $i++) { 
                 $cash_amount = $blanch_account[$i]->blanch_capital;
                 $account = $blanch_account[$i]->trans_id;
                 $blanch_id = $blanch_account[$i]->blanch_id;

              @$today = $this->queries->get_today_cashinhand($blanch_id,$account);
              if (@$today->cash_day == TRUE) {

            $this->update_daily_report_blanch($blanch_id,$empl_id,$blanch_account[$i]->blanch_capital,$blanch_account[$i]->trans_id);
        }else{
           $this->insert_blanch_daily_report($comp_id,$blanch_id,$empl_id,$blanch_account[$i]->blanch_capital,$blanch_account[$i]->trans_id); 
          }
        }
        
       $data_account_data = $this->queries->get_data_today_blanch($blanch_id);

       $opening_total = $this->queries->get_yesterday_data_blanch($blanch_id);
       $deduct_income = $this->queries->get_today_income_data_blanch($blanch_id);
       $non_deducted_data = $this->queries->get_nondeducted_income_account_blanch($blanch_id);
       $expenses_blanch = $this->queries->get_expenses_datas_blanch($blanch_id);
       $closing_data = $this->queries->get_today_data_close_blanch($blanch_id);
       $withdrawal_today_expenses = $this->queries->get_total_expenses_loan_today($blanch_id);
       $transaction_float = $this->queries->get_transaction_float($blanch_id);
       $income_deposit = $this->queries->get_income_deposit($blanch_id);
       $from_mainAccount = $this->queries->get_transaction_from_mainAccountTotal($blanch_id);
       $from_blanch_branch = $this->queries->get_transaction_totalfrom_blanch($blanch_id);
       $total_renew = $this->queries->get_total_renew_loan($comp_id);
       // print_r($from_blanch_branch);
       //        exit();

       $this->load->view('oficer/daily_report',['empl_data'=>$empl_data,'data_account_data'=>$data_account_data,'opening_total'=>$opening_total,'deduct_income'=>$deduct_income,'non_deducted_data'=>$non_deducted_data,'expenses_blanch'=>$expenses_blanch,'closing_data'=>$closing_data,'withdrawal_today_expenses'=>$withdrawal_today_expenses,'transaction_float'=>$transaction_float,'income_deposit'=>$income_deposit,'from_mainAccount'=>$from_mainAccount,'from_blanch_branch'=>$from_blanch_branch,'total_renew'=>$total_renew]); 
      }



        public function filter_daily_report(){
        $this->load->model('queries');
        $blanch_id = $this->session->userdata('blanch_id');
        $empl_id = $this->session->userdata('empl_id');
        $manager_data = $this->queries->get_manager_data($empl_id);
        $comp_id = $manager_data->comp_id;
        $company_data = $this->queries->get_companyData($comp_id);
        $blanch_data = $this->queries->get_blanchData($blanch_id);
        $empl_data = $this->queries->get_employee_data($empl_id);

        $blanch_id = $this->input->post('blanch_id');
        $from = $this->input->post('from');
        $to = $this->input->post('to');

        $data_account_data = $this->queries->get_data_today_blanch($blanch_id);

       $opening_total = $this->queries->get_yesterday_data_blanch($blanch_id);
       $deduct_income = $this->queries->get_today_income_data_blanch_prev($blanch_id,$from,$to);
       $non_deducted_data = $this->queries->get_nondeducted_income_account_blanch_prev($blanch_id,$from,$to);
       $expenses_blanch = $this->queries->get_expenses_datas_blanch_prev($blanch_id,$from,$to);
       $closing_data = $this->queries->get_today_data_close_blanch($blanch_id);
       $withdrawal_today_expenses = $this->queries->get_total_expenses_loan_prev($blanch_id,$from,$to);
       $transaction_float = $this->queries->get_transaction_float_prev($blanch_id,$from,$to);
       $income_deposit = $this->queries->get_income_deposit_prev($blanch_id,$from,$to);
       $from_mainAccount = $this->queries->get_transaction_from_mainAccountTotal_prev($blanch_id,$from,$to);
       $from_blanch_branch = $this->queries->get_transaction_totalfrom_blanch_prev($blanch_id,$from,$to);
       $renew_loan = $this->queries->get_total_renew_loan_prev($blanch_id,$from,$to);


        // echo "<pre>";
        // print_r($from_mainAccount);
        //       exit();


        $this->load->view('oficer/filter_daily_report',['empl_data'=>$empl_data,'data_account_data'=>$data_account_data,'from'=>$from,'to'=>$to,'opening_total'=>$opening_total,'closing_data'=>$closing_data,'deduct_income'=>$deduct_income,'non_deducted_data'=>$non_deducted_data,'expenses_blanch'=>$expenses_blanch,'withdrawal_today_expenses'=>$withdrawal_today_expenses,'transaction_float'=>$transaction_float,'income_deposit'=>$income_deposit,'from_mainAccount'=>$from_mainAccount,'from_blanch_branch'=>$from_blanch_branch,'blanch_id'=>$blanch_id,'renew_loan'=>$renew_loan]);
      }





   
    public function print_daily_report_data($blanch_id,$from,$to){
     $this->load->model('queries');
      $blanch_id = $this->session->userdata('blanch_id');
      $empl_id = $this->session->userdata('empl_id');
      $manager_data = $this->queries->get_manager_data($empl_id);
      $comp_id = $manager_data->comp_id;
      $company_data = $this->queries->get_companyData($comp_id);
      $blanch_data = $this->queries->get_blanchData($blanch_id);
      $empl_data = $this->queries->get_employee_data($empl_id);
      $empl_id =$empl_data->empl_id; 

      $blanch_account = $this->queries->get_account_balance_blanch_data($blanch_id);

             for ($i=0; $i <count($blanch_account) ; $i++) { 
                 $cash_amount = $blanch_account[$i]->blanch_capital;
                 $account = $blanch_account[$i]->trans_id;
                 $blanch_id = $blanch_account[$i]->blanch_id;

              @$today = $this->queries->get_today_cashinhand($blanch_id,$account);
              if (@$today->cash_day == TRUE) {

            $this->update_daily_report_blanch($blanch_id,$empl_id,$blanch_account[$i]->blanch_capital,$blanch_account[$i]->trans_id);
        }else{
           $this->insert_blanch_daily_report($comp_id,$blanch_id,$empl_id,$blanch_account[$i]->blanch_capital,$blanch_account[$i]->trans_id); 
          }
        }
        
       $data_account_data = $this->queries->get_data_today_blanch($blanch_id);

       $opening_total = $this->queries->get_yesterday_data_blanch($blanch_id);
       $deduct_income = $this->queries->get_today_income_data_blanch_prev($blanch_id,$from,$to);
       $non_deducted_data = $this->queries->get_nondeducted_income_account_blanch_prev($blanch_id,$from,$to);
       $expenses_blanch = $this->queries->get_expenses_datas_blanch_prev($blanch_id,$from,$to);
       $closing_data = $this->queries->get_today_data_close_blanch($blanch_id);
       $withdrawal_today_expenses = $this->queries->get_total_expenses_loan_prev($blanch_id,$from,$to);
       $transaction_float = $this->queries->get_transaction_float_prev($blanch_id,$from,$to);
       $income_deposit = $this->queries->get_income_deposit_prev($blanch_id,$from,$to);
       $from_mainAccount = $this->queries->get_transaction_from_mainAccountTotal_prev($blanch_id,$from,$to);
       $from_blanch_branch = $this->queries->get_transaction_totalfrom_blanch_prev($blanch_id,$from,$to);
       $renew_loan = $this->queries->get_total_renew_loan_prev($blanch_id,$from,$to);
       $blanch_data = $this->queries->get_blanchData($blanch_id);
       $compdata = $this->queries->get_comp_data($comp_id);
      // print_r($compdata);
      //      exit();
    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8','format' => 'A4-L','orientation' => 'L']);
    $html = $this->load->view('oficer/daily_reportpdf',['empl_data'=>$empl_data,'data_account_data'=>$data_account_data,'from'=>$from,'to'=>$to,'opening_total'=>$opening_total,'closing_data'=>$closing_data,'deduct_income'=>$deduct_income,'non_deducted_data'=>$non_deducted_data,'expenses_blanch'=>$expenses_blanch,'withdrawal_today_expenses'=>$withdrawal_today_expenses,'transaction_float'=>$transaction_float,'income_deposit'=>$income_deposit,'from_mainAccount'=>$from_mainAccount,'from_blanch_branch'=>$from_blanch_branch,'blanch_id'=>$blanch_id,'blanch_data'=>$blanch_data,'compdata'=>$compdata,'renew_loan'=>$renew_loan],true);
    $mpdf->SetFooter('Generated By Brainsoft Technology');
    $mpdf->SetWatermarkText($compdata->comp_name);
    $mpdf->showWatermarkText = true;
    $date = date("Y-m-d");
    $mpdf->WriteHTML($html);
    $output = 'Daily report ' . $date.'.pdf';
    $mpdf->Output("$output", 'I');
       }


      public function insert_blanch_daily_report($comp_id,$blanch_id,$empl_id,$blanch_capital,$trans_id){
      $date = date("Y-m-d");
      $this->db->query("INSERT INTO tbl_cash_inhand (`comp_id`,`blanch_id`,`empl_id`,`trans_id`,`cash_amount`,`cash_day`) VALUES ('$comp_id','$blanch_id','$empl_id','$trans_id','$blanch_capital','$date')");
      }

      public function update_daily_report_blanch($blanch_id,$empl_id,$blanch_capital,$trans_id){
      $day = date("Y-m-d");
      $sqldata="UPDATE `tbl_cash_inhand` SET `cash_amount`= '$blanch_capital' WHERE `blanch_id`= '$blanch_id' AND `cash_day`='$day' AND `trans_id`='$trans_id'";
      $query = $this->db->query($sqldata);
      return true; 
      }





     


   


      public function update_njesystem($blanch_id,$total_out_system){
       $day = date("Y-m-d");
      $sqldata="UPDATE `tbl_outsystem_day` SET `amount`= '$total_out_system' WHERE `blanch_id`= '$blanch_id' AND `date`='$day'";
      $query = $this->db->query($sqldata);
      return true;  
      }

      public function insert_njesystem($comp_id,$blanch_id,$total_out_system){
       $day = date("Y-m-d");
      $this->db->query("INSERT INTO tbl_outsystem_day (`comp_id`,`blanch_id`,`amount`,`date`) VALUES ('$comp_id','$blanch_id','$total_out_system','$day')");  
      }


      public function insert_nonDeducted_dayBalance($comp_id,$blanch_id,$total_non){
      $day = date("Y-m-d");
      $this->db->query("INSERT INTO tbl_non_deduct_day (`comp_id`,`blanch_id`,`non_deduct_balance`,`non_date`) VALUES ('$comp_id','$blanch_id','$total_non','$day')");  
      }

      public function update_nonDeducted_dayBalance($blanch_id,$total_non){
      $day = date("Y-m-d");
      $sqldata="UPDATE `tbl_non_deduct_day` SET `non_deduct_balance`= '$total_non' WHERE `blanch_id`= '$blanch_id' AND `non_date`='$day'";
      $query = $this->db->query($sqldata);
      return true;  
      }


      public function insert_deduction_today_balance($comp_id,$blanch_id,$total_deducted){
       $day = date("Y-m-d");
      $this->db->query("INSERT INTO tbl_deduction_day (`comp_id`,`blanch_id`,`deduct_balance`,`date_deduct`) VALUES ('$comp_id', '$blanch_id','$total_deducted','$day')");  
      }


      public function update_deduction_today_balance($blanch_id,$total_deducted){
      $day = date("Y-m-d");
      $sqldata="UPDATE `tbl_deduction_day` SET `deduct_balance`= '$total_deducted' WHERE `blanch_id`= '$blanch_id' AND `date_deduct`='$day'";
      $query = $this->db->query($sqldata);
      return true; 
      }

      public function insert_outstand_stooBlance($comp_id,$blanch_id,$receve_out){
        $day = date("Y-m-d");
      $this->db->query("INSERT INTO tbl_receive_out_date (`comp_id`,`blanch_id`,`total_balance`,`date_out`) VALUES ('$comp_id', '$blanch_id','$receve_out','$day')"); 
      }



      public function update_outstand_stoo_day($comp_id,$blanch_id,$receve_out){
       $day = date("Y-m-d");
        $sqldata="UPDATE `tbl_receive_out_date` SET `total_balance`= '$receve_out' WHERE `blanch_id`= '$blanch_id' AND `date_out`='$day'";
    // print_r($sqldata);
    //    exit();
        $query = $this->db->query($sqldata);
        return true; 
      }



      public function insert_cashinhand_data($comp_id,$blanch_id,$empl_id,$blanch_capital){
      $day = date("Y-m-d");
      $this->db->query("INSERT INTO tbl_cash_inhand (`comp_id`,`blanch_id`,`empl_id`,`cash_amount`,`cash_day`) VALUES ('$comp_id', '$blanch_id','$empl_id','$blanch_capital','$day')");
      }

      public function update_cash_inhand($blanch_id,$blanch_capital,$empl_id){
        $day = date("Y-m-d");
        $sqldata="UPDATE `tbl_cash_inhand` SET `cash_amount`= '$blanch_capital',`empl_id`='$empl_id' WHERE `blanch_id`= '$blanch_id' AND `cash_day`='$day'";
    // print_r($sqldata);
    //    exit();
        $query = $this->db->query($sqldata);
        return true;
      }


      public function insert_deduction_balance($comp_id,$blanch_id,$empl_id,$total_income){
       $day = date("Y-m-d");
      $this->db->query("INSERT INTO  tbl_deduction (`comp_id`,`blanch_id`,`empl_id`,`amount`,`date`) VALUES ('$comp_id', '$blanch_id','$empl_id','$total_income','$day')");
      }


      public function update_duction_income($blanch_id,$empl_id,$total_income){
        $day = date("Y-m-d");
        $sqldata="UPDATE `tbl_deduction` SET `amount`= '$total_income',`empl_id`='$empl_id' WHERE `blanch_id`= '$blanch_id' AND `date`='$day'";
    // print_r($sqldata);
    //    exit();
        $query = $this->db->query($sqldata);
        return true;
      }


      public function deposit_stoo(){
        $this->load->model('queries');
        $blanch_id = $this->session->userdata('blanch_id');
        $empl_id = $this->session->userdata('empl_id');
        $manager_data = $this->queries->get_manager_data($empl_id);
        $comp_id = $manager_data->comp_id;
        $company_data = $this->queries->get_companyData($comp_id);
        $blanch_data = $this->queries->get_blanchData($blanch_id);
        $empl_data = $this->queries->get_employee_data($empl_id);

        $acount = $this->queries->get_customer_account_verfied($blanch_id);
        $transaction_stoo = $this->queries->get_stoo_transaction($blanch_id);

        $total_stoo = $this->queries->get_total_stoo_trans($blanch_id);
         //   echo "<pre>";
         // print_r($total_stoo);
         //     exit();
       
        $this->load->view('oficer/stoo',['empl_data'=>$empl_data,'acount'=>$acount,'transaction_stoo'=>$transaction_stoo,'total_stoo'=>$total_stoo]);
      }


      public function transfor_amount_stoo(){
        $this->load->model('queries');
        $this->form_validation->set_rules('comp_id','company','required');
        $this->form_validation->set_rules('blanch_id','blanch','required');
        $this->form_validation->set_rules('stoo_amount','stoo','required');
        $this->form_validation->set_rules('from_account','Account','required');
        $this->form_validation->set_rules('empl_id','Employee','required');
        $this->form_validation->set_rules('stoo_date','date','required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
        if ($this->form_validation->run()) {
            $data = $this->input->post();
            
            $comp_id = $data['comp_id'];
            $blanch_id = $data['blanch_id'];
            $stoo_amount = $data['stoo_amount'];
            $account = $data['from_account'];
           
           $blanch_account = $this->queries->get_blanch_capital_account($blanch_id,$account);
           $blanch_balance =  $blanch_account->blanch_capital;
           $chomoa = $blanch_balance - $stoo_amount;
           $new_added = $chomoa;
                // exit();
           if ($stoo_amount > $blanch_balance) {
               $this->session->set_flashdata("error",'You don`t Have Enough Balance');
               return redirect("oficer/deposit_stoo");
           }else{
           $this->queries->insert_stoo_amount($data);
           $this->update_account_blanch_balance($blanch_id,$account,$new_added);
           $this->session->set_flashdata("massage",'Transaction successfully');
           }
            return redirect("oficer/deposit_stoo");
        }
        $this->deposit_stoo();
      }


      public function adjust_transaction($stoo_id){
        $this->load->model('queries');
        $stoo_data = $this->queries->get_stoo_transaction_delete($stoo_id);
        $stoo_amount = $stoo_data->stoo_amount;
        $account = $stoo_data->from_account;
        $blanch_id = $stoo_data->blanch_id;
        
        $blanch_account = $this->queries->get_blanch_capital_account($blanch_id,$account);
        $blanch_balance =  $blanch_account->blanch_capital;

        $new_added = $blanch_balance + $stoo_amount;
        // print_r($blanch_balance);
        //        exit();
        $this->update_account_blanch_balance($blanch_id,$account,$new_added);
        if($this->delete_stoo_transaction($stoo_id));
        $this->session->set_flashdata("massage",'Successfully');
        return redirect("oficer/deposit_stoo");
      }

      public function delete_stoo_transaction($stoo_id){
        return $this->db->delete('tbl_stoo',['stoo_id'=>$stoo_id]);
      }


    public function expnses_requisition_form(){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);

    $expenses = $this->queries->get_expense_data($comp_id);

    $request_exp = $this->queries->get_today_expense_request($blanch_id);

    $expenses_total = $this->queries->get_total_expenses_req($blanch_id);
    $acount = $this->queries->get_customer_account_verfied($blanch_id);

    $this->load->view('oficer/expenses_requisition',['empl_data'=>$empl_data,'expenses'=>$expenses,'request_exp'=>$request_exp,'expenses_total'=>$expenses_total,'acount'=>$acount]);
}


public function filter_expenses_request(){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);

    $from = $this->input->post('from');
    $to = $this->input->post('to');
    $blanch_id = $this->input->post('blanch_id');

    $data_expenses = $this->queries->get_prev_expenses_data($from,$to,$blanch_id);
    $total_expenses = $this->queries->get_sum_expenses($from,$to,$blanch_id);
    //        echo "<pre>";
    // print_r($data_expenses);
    //      exit();

    $this->load->view('oficer/prev_expenses',['empl_data'=>$empl_data,'data_expenses'=>$data_expenses,'from'=>$from,'to'=>$to,'total_expenses'=>$total_expenses]);
}

public function get_remove_expenses($req_id){
    $this->load->model('queries');
    $data_req = $this->queries->get_request_expenses($req_id);
    $type = $data_req->deduct_type;
    $blanch_id = $data_req->blanch_id;
    $req_amount = $data_req->req_amount;

        $deducted_income = $this->queries->get_deducted_income_blanch($blanch_id);
        $deducted = $deducted_income->total_deducted;
    
        $expenses_deducted = $deducted + $req_amount;

        $non_deductedIncome = $this->queries->get_non_deducted_income_blanch($blanch_id);
        $non_income = $non_deductedIncome->total_nonbalance;

        $expenses_non = $non_income + $req_amount;

    
    if ($type == 'deducted') {
      $this->update_expenses_income_deducted($blanch_id,$expenses_deducted);
      $this->delete_request_data($req_id);
      $this->session->set_flashdata("massage",'Expenses Deleted Successfully');
    }elseif ($type == 'non deducted') {
    $this->update_income_nonbalance($blanch_id,$expenses_non);
    $this->delete_request_data($req_id);
    $this->session->set_flashdata("massage",'Expenses Deleted Successfully');
    }
    
    return redirect("oficer/expnses_requisition_form");
    }

   public function delete_request_data($req_id){
  return $this->db->delete('tbl_request_exp',['req_id'=>$req_id]);
  }


public function create_requstion_form(){
    $this->load->model('queries');
    $this->form_validation->set_rules('comp_id','company','required');
    $this->form_validation->set_rules('blanch_id','blanch','required');
    $this->form_validation->set_rules('req_description','description','required');
    $this->form_validation->set_rules('req_amount','Amount','required');
    $this->form_validation->set_rules('empl_id','Employee','required');
    $this->form_validation->set_rules('req_date','req_date','required');
    // $this->form_validation->set_rules('deduct_type','type','required');
    $this->form_validation->set_rules('trans_id','Account','required');
    $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

    if ($this->form_validation->run()) {
        $data = $this->input->post();

        $comp_id = $data['comp_id'];
        $blanch_id = $data['blanch_id'];
        // $deduct_type = $data['deduct_type'];
        $req_amount = $data['req_amount'];
        $account = $data['trans_id'];
        
        $blanch_account = $this->queries->get_blanchAccountremain($blanch_id,$account);
        $old_balance = $blanch_account->blanch_capital;

        $expenses_amount = $old_balance - $req_amount;
        //       echo "<pre>";
        // print_r($expenses_amount);
        //       exit();

      
           if ($old_balance < $req_amount) {
            $this->session->set_flashdata("error",'You don`t Have Enough Balance');
            return redirect('oficer/expnses_requisition_form');
           }else{
            $this->update_expenses_blanch_account($blanch_id,$account,$expenses_amount);
            $this->queries->insert_reques_expenses($data);
            $this->session->set_flashdata("massage",'Expenses Request Successfully');
           }
        return redirect("oficer/expnses_requisition_form");
    }
    $this->expnses_requisition_form();
}


public function update_expenses_blanch_account($blanch_id,$account,$expenses_amount){
  $sqldata="UPDATE `tbl_blanch_account` SET `blanch_capital`= '$expenses_amount' WHERE `blanch_id`= '$blanch_id' AND `receive_trans_id` = '$account'";
      $query = $this->db->query($sqldata);
      return true;  
}

public function update_expenses_income_deducted($blanch_id,$expenses_deducted){
    $sqldata="UPDATE `tbl_receive_deducted` SET `deducted`= '$expenses_deducted' WHERE `blanch_id`= '$blanch_id'";
      $query = $this->db->query($sqldata);
      return true;
}

public function update_income_nonbalance($blanch_id,$expenses_non){
   $sqldata="UPDATE `tbl_receive_non_deducted` SET `non_balance`= '$expenses_non' WHERE `blanch_id`= '$blanch_id'";
      $query = $this->db->query($sqldata);
      return true; 
}

public function get_loan_withdrawal_data(){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);
    $loan_with = $this->queries->get_loan_withdrawal_today_blanch_general($blanch_id);

    $total_loanwith = $this->queries->get_loan_withdrawal_today_blanch($blanch_id);
    $category = $this->queries->get_loancategory($comp_id);
    // print_r($total_loanwith);
    //       exit();
    $this->load->view('oficer/loan_withdrawal',['empl_data'=>$empl_data,'loan_with'=>$loan_with,'total_loanwith'=>$total_loanwith,'category'=>$category]);
}


public function filter_loan_with_category()
  {
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);
    $comp_id = $this->input->post('comp_id');
    $blanch_id = $this->input->post('blanch_id');
    $category_id = $this->input->post('category_id');
    $loan_status = $this->input->post('loan_status');
      
      if ($category_id == 'all') {
    $data_loan = $this->queries->get_previous_all_category($comp_id,$blanch_id,$loan_status);
    $sum_loan = $this->queries->get_previous_categoryAll_sum($comp_id,$blanch_id,$loan_status);  
      }else{
    $data_loan = $this->queries->get_previous_loan_withcategory($comp_id,$blanch_id,$category_id,$loan_status);
    $sum_loan = $this->queries->get_previous_loan_withcategory_sum($comp_id,$blanch_id,$category_id,$loan_status);
    }

    $category_data = $this->queries->get_loanCategoryDatas($category_id);
    $blanch_data = $this->queries->get_blanch_data($blanch_id);
    $category = $this->queries->get_loancategory($comp_id);
    //$blanch = $this->queries->get_blanch($comp_id);

    //     echo "<pre>";
    // print_r($comp_id);
    //         exit();

    $this->load->view('oficer/loan_with_category',['data_loan'=>$data_loan,'category'=>$category,'sum_loan'=>$sum_loan,'category_data'=>$category_data,'blanch_data'=>$blanch_data,'comp_id'=>$comp_id,'blanch_id'=>$blanch_id,'category_id'=>$category_id,'empl_data'=>$empl_data,'loan_status'=>$loan_status]);
  }

   public function print_loanWith_category($comp_id,$blanch_id,$category_id,$loan_status)
  {
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);
    
    $compdata = $this->queries->get_companyData($comp_id);
    if ($category_id == 'all') {
    $data_loan = $this->queries->get_previous_all_category($comp_id,$blanch_id,$loan_status);
    $sum_loan = $this->queries->get_previous_categoryAll_sum($comp_id,$blanch_id,$loan_status);  
      }else{
    $data_loan = $this->queries->get_previous_loan_withcategory($comp_id,$blanch_id,$category_id,$loan_status);
    $sum_loan = $this->queries->get_previous_loan_withcategory_sum($comp_id,$blanch_id,$category_id,$loan_status);
    }

    $category_data = $this->queries->get_loanCategoryDatas($category_id);
    $blanch_data = $this->queries->get_blanch_data($blanch_id);


     $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8','format' => 'A4-L','orientation' => 'L']);
     $html = $this->load->view('oficer/loan_with_category_report',['compdata'=>$compdata,'blanch_data'=>$blanch_data,'data_loan'=>$data_loan,'sum_loan'=>$sum_loan,'category_data'=>$category_data,'loan_status'=>$loan_status],true);
     $mpdf->SetFooter('Generated By Brainsoft Technology');
     $mpdf->WriteHTML($html);
     $mpdf->Output();
    
  }



public function filter_loan_with(){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);

    $blanch_id = $this->input->post('blanch_id');
    $from = $this->input->post('from');
    $to = $this->input->post('to');
    $loan_status = $this->input->post('loan_status');

    $blanch_previous = $this->queries->get_previous_loan_with_blanch($from,$to,$blanch_id);
    $total_loan_with = $this->queries->total_filter_loan_with($from,$to,$blanch_id);
    //         echo "<pre>";
    // print_r($total_loan_with);
    //         exit();

    $this->load->view('oficer/prev_loan_with',['empl_data'=>$empl_data,'blanch_previous'=>$blanch_previous,'from'=>$from,'to'=>$to,'total_loan_with'=>$total_loan_with]);
}


public function oustand_loan(){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);

    
    $default_loan = $this->queries->get_outstand_loan_blanch($blanch_id);
    $total_default = $this->queries->get_total_outStand($blanch_id);
    //  echo "<pre>";
    // print_r($total_default);
    //       exit();
    $this->load->view('oficer/outstand_loan',['default_loan'=>$default_loan,'empl_data'=>$empl_data,'total_default'=>$total_default]);
}

public function cash_transaction(){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);
    
    $cash_transaction = $this->queries->get_cash_transaction_blanch($blanch_id);
    $sum_cashTransaction = $this->queries->get_cash_transaction_sum_blanch($blanch_id);
    //        echo "<pre>";
    // print_r($sum_cashTransaction);
    //            exit();

    $this->load->view('oficer/cash_transaction',['empl_data'=>$empl_data,'cash_transaction'=>$cash_transaction,'sum_cashTransaction'=>$sum_cashTransaction]);
}


public function filter_cashTransaction(){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);

    $blanch_id = $this->input->post('blanch_id');
    $from = $this->input->post('from');
    $to = $this->input->post('to');
    $data_cash = $this->queries->get_blanchTransaction_blanch($from,$to,$blanch_id);
    $total_cash = $this->queries->get_blanchTransaction_comp_blanch($from,$to,$blanch_id);
    // echo "<pre>";
    // print_r($total_cash);
    //        exit();
    $this->load->view('oficer/prev_cash',['empl_data'=>$empl_data,'from'=>$from,'to'=>$to,'data_cash'=>$data_cash,'total_cash'=>$total_cash]);
}


public function loan_rejected(){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);
    $loan_reject = $this->queries->get_loanlejectBlanch($blanch_id);
    // print_r($loan_reject);
    //     exit();
    $this->load->view('oficer/loan_rejected',['empl_data'=>$empl_data,'loan_reject'=>$loan_reject]);
}
  

  public function saving_deposit(){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);
    $acount = $this->queries->get_customer_account_verfied($blanch_id);

    $saving_deposit = $this->queries->get_saving_deposit($blanch_id);
    $total_saving = $this->queries->get_total_saving_deposit($blanch_id);
    // echo "<pre>";
    // print_r($saving_deposit);
    //       exit();

    $this->load->view('oficer/saving_deposit',['empl_data'=>$empl_data,'acount'=>$acount,'saving_deposit'=>$saving_deposit,'total_saving'=>$total_saving]);
  }


  

  public function create_saving_deposit(){
    $this->form_validation->set_rules('comp_id','company','required');
    $this->form_validation->set_rules('blanch_id','blanch','required');
    $this->form_validation->set_rules('provider','provider','required');
    $this->form_validation->set_rules('agent','Agent','required');
    $this->form_validation->set_rules('amount','amount','required');
    $this->form_validation->set_rules('ref_no','Reference','required');
    $this->form_validation->set_rules('time','time','required');
    $this->form_validation->set_rules('date','date','required');
    $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

    if ($this->form_validation->run()) {
        $data = $this->input->post();
        $this->load->model('queries');
        $blanch_id = $data['blanch_id'];
        $account = $data['provider'];
        $amount = $data['amount'];
        //   echo "<pre>";
        // print_r($amount);
        //    exit();

        $blanch_balance = $this->queries->get_blanch_account_balance($blanch_id,$account);
        $blanch_capital = $blanch_balance->blanch_capital;

        $saving = $blanch_capital + $amount;

       $this->update_blanch_capitaldata($blanch_id,$account,$saving);
        

        if ($this->queries->insert_saving_deposit($data)) {
            $this->session->set_flashdata("massage",'Saving Deposit Saved successfully');
        }else{
           $this->session->set_flashdata("error",'Failed'); 
        }

        return redirect("oficer/saving_deposit");
    }
    $this->saving_deposit();
  } 


   public function update_blanch_capitaldata($blanch_id,$account,$saving){
  $sqldata="UPDATE `tbl_blanch_account` SET `blanch_capital`= '$saving' WHERE `blanch_id`= '$blanch_id' AND `receive_trans_id`='$account'";
    // print_r($sqldata);
    //    exit();
   $query = $this->db->query($sqldata);
   return true;
  }




  public function remove_saving_deoposit($id){
    $this->load->model('queries');
    $miamala = $this->queries->get_miamala_data($id);
    $amount = $miamala->amount;
    $account = $miamala->provider;
    $blanch_id = $miamala->blanch_id;

    $blanch_balance = $this->queries->get_blanch_account_balance($blanch_id,$account);
    $blanch_capital = $blanch_balance->blanch_capital;

    $saving = $blanch_capital - $amount;
    // print_r($saving);
    //       exit();
    $this->update_blanch_capitaldata($blanch_id,$account,$saving);

    
    if($this->delete_miamala($id));
    $this->session->set_flashdata("massage",'Deleted successfully');
    return redirect("oficer/saving_deposit");
  } 

  public function delete_miamala($id){
    return $this->db->delete('tbl_miamala',['id'=>$id]);
  }


  public function check_miamala($id){
    $this->load->model('queries');
    $data = $this->queries->get_miamala_depost($id);
    $miamala = $this->queries->get_miamala_data($id);
    $amount = $miamala->amount;
    $account = $miamala->provider;
    $blanch_id = $miamala->blanch_id;
    $date = $miamala->date;
    $today = date("Y-m-d");

    // print_r($date);
    //   exit();
    $blanch_balance = $this->queries->get_blanch_account_balance($blanch_id,$account);
    $blanch_capital = $blanch_balance->blanch_capital;
    $saving = $blanch_capital - $amount;

    $cash_inHand = $this->queries->get_total_cashIn_Hand($blanch_id,$date);
    $cash_day = $cash_inHand->total_cashDay;

    $remove_cash = $cash_day - $amount;
     // print_r($remove_cash);
     //     exit();
    //if ($date == $today) {
     $this->update_blanch_capitaldata($blanch_id,$account,$saving);  
    //}else{
     //$this->update_cash_prev($blanch_id,$remove_cash,$account,$date);
    //}
    
   
    if ($data->status = 'close') {
         // echo "<pre>";
      //   print_r($data);
      //     exit();
        $this->queries->update_miamala($data,$id);
        $this->session->set_flashdata('massage','Checked Successfully');
        }
    return redirect('oficer/deposit_saving/'.$id);
     
    }



    public function deposit_saving($id){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);

    $data_saving = $this->queries->get_miamala_depost($id);
    $customer = $this->queries->get_allcutomerblanchData($blanch_id);
    //     echo "<pre>";
    // print_r($data_saving);
    //       exit();

    $this->load->view('oficer/deposit_saving',['empl_data'=>$empl_data,'data_saving'=>$data_saving,'customer'=>$customer]);
    }

  
    public function uncheck_miamala($id){
    $this->load->model('queries');
    $data = $this->queries->get_miamala_depost($id);
    $miamala = $this->queries->get_miamala_data($id);
    $amount = $miamala->amount;
    $account = $miamala->provider;
    $blanch_id = $miamala->blanch_id;
    $date = $miamala->date;
    $today = date("Y-m-d");

    $blanch_balance = $this->queries->get_blanch_account_balance($blanch_id,$account);
    $blanch_capital = $blanch_balance->blanch_capital;
    $saving = $blanch_capital + $amount;
    // print_r($saving);
    //       exit();
    $cash_inHand = $this->queries->get_total_cashIn_Hand($blanch_id,$date);
    $cash_day = $cash_inHand->total_cashDay;

    $remove_cash = $cash_day + $amount;
     // print_r($remove_cash);
     // echo "<br>";
     // print_r($cash_day);
     //     exit();
    //if ($date == $today) {
     $this->update_blanch_capitaldata($blanch_id,$account,$saving);  
    //}else{
     //$this->update_cash_prev($blanch_id,$remove_cash,$account,$date);
    //}

    if ($data->status = 'open') {
        $this->queries->update_miamala($data,$id);
        $this->session->set_flashdata('massage','Un-Checked Successfully');
        }
    return redirect('oficer/saving_deposit');
     
    }

    public function update_cash_prev($blanch_id,$remove_cash,$account,$date){
    $sqldata="UPDATE `tbl_cash_inhand` SET `cash_amount`= '$remove_cash' WHERE `blanch_id`= '$blanch_id' AND `cash_day`='$date' AND `trans_id`='$account' ";
    // print_r($sqldata);
    //    exit();
   $query = $this->db->query($sqldata);
   return true;    
    }



    public function out_ofsyastem(){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);
    $acount = $this->queries->get_customer_account_verfied($blanch_id);
    $out_system = $this->queries->get_otstand_systemDeposit($blanch_id);
    $sum_out = $this->queries->get_total_deposit_outSystem($blanch_id);
    $today_deposit = $this->queries->get_today_deposit_out($blanch_id);
    // echo "<pre>";
    // print_r($today_deposit);
    //         exit();


    $this->load->view("oficer/out_system",['empl_data'=>$empl_data,'acount'=>$acount,'out_system'=>$out_system,'sum_out'=>$sum_out,'today_deposit'=>$today_deposit]);
    }

    public function create_default_loan_out(){
        $this->form_validation->set_rules('comp_id','company','required');
        $this->form_validation->set_rules('blanch_id','blanch','required');
        $this->form_validation->set_rules('out_amount','Amount','required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

        if ($this->form_validation->run()) {
            $data = $this->input->post();
            // print_r($data);
            //       exit();
            $this->load->model('queries');
            if ($this->queries->insert_out_standloan_out($data)) {
                $this->session->set_flashdata("massage",'Saved successfully');
            }else{
              $this->session->set_flashdata("error",'Failed');  
            }
            return redirect("oficer/out_ofsyastem");
        }
        $this->out_ofsyastem();
    }

    public function modify_out_loan($id){
        $this->form_validation->set_rules('out_amount','Amount','required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

        if ($this->form_validation->run()) {
            $data = $this->input->post();
            // print_r($data);
            //       exit();
            $this->load->model('queries');
            if ($this->queries->update_out_data($id,$data)) {
                $this->session->set_flashdata("massage",'Updated successfully');
            }else{
              $this->session->set_flashdata("error",'Failed');  
            }
            return redirect("oficer/out_ofsyastem");
        }
        $this->out_ofsyastem();   
    }

    public function create_deposit_out(){
        $this->load->model('queries');
        $this->form_validation->set_rules('comp_id','company','required');
        $this->form_validation->set_rules('blanch_id','blanch','required');
        $this->form_validation->set_rules('empl_id','Employee','required');
        $this->form_validation->set_rules('trans_id','Account','required');
        $this->form_validation->set_rules('customer_name','Customer','required');
        $this->form_validation->set_rules('amount','Amount','required');
        $this->form_validation->set_rules('date','date','required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

        if ($this->form_validation->run()) {
            $data = $this->input->post();

            $blanch_id = $data['blanch_id'];
            $empl_id = $data['empl_id'];
            $trans_id = $data['trans_id'];
            $amount = $data['amount'];
            $comp_id = $data['comp_id'];

            @$blanch_out = $this->queries->get_receive_outsystem($blanch_id,$trans_id);
            $amount_receive = @$blanch_out->amount_receive;

            $new_receve = $amount_receive + $amount;

            if (@$blanch_out->amount_receive == TRUE || @$blanch_out->amount_receive == '0') {

                $this->update_outstand_deposit_system($blanch_id,$trans_id,$new_receve);
                //echo "UPDATE";
            }else{

            $this->insert_outstand_deposit_system($comp_id,$blanch_id,$trans_id,$new_receve);
                //echo "insert";
            }

            // echo "<pre>";
            // print_r($new_receve);
            //     exit();
            
            if ($this->queries->insert_deposit_out($data)) {
                $this->session->set_flashdata("massage",'Deposit Successfully');
            }else{
              $this->session->set_flashdata("error",'Failed');  
            }
            return redirect("oficer/out_ofsyastem");
        }
        $this->out_ofsyastem();
    }


    public function insert_outstand_deposit_system($comp_id,$blanch_id,$trans_id,$new_receve){
     $this->db->query("INSERT INTO  tbl_receive_outsystem (`comp_id`,`blanch_id`,`trans_id`,`amount_receive`) VALUES ('$comp_id', '$blanch_id','$trans_id','$new_receve')");  
    }

    public function update_outstand_deposit_system($blanch_id,$trans_id,$new_receve){
    $sqldata="UPDATE `tbl_receive_outsystem` SET `amount_receive`= '$new_receve' WHERE `blanch_id`= '$blanch_id' AND `trans_id`='$trans_id'";
   $query = $this->db->query($sqldata);
   return true;   
    }

    public function delete_outstand_system($id){
        $this->load->model('queries');
        $data_out = $this->queries->get_out_system($id);
        $amount = $data_out->amount;
        $trans_id = $data_out->trans_id;
        $blanch_id = $data_out->blanch_id;

        $out_system_data = $this->queries->get_receive_outsystem($blanch_id,$trans_id);
        $amount_receive = $out_system_data->amount_receive;

        $new_receve = $amount_receive - $amount;

        $this->update_outstand_deposit_system($blanch_id,$trans_id,$new_receve);
        // print_r($amount_receive);
        //         exit();
        if($this->remove_out_system($id));
        $this->session->set_flashdata("massage",'Data Deleted successfully');
        return redirect("oficer/out_ofsyastem");
    }

    public function remove_out_system($id){
        return $this->db->delete('tbl_depost_out',['id'=>$id]);
    }


public function default_balance(){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);

    $total_insystem = $this->queries->get_receive_outstand_data($blanch_id);
    $total_outsystem = $this->queries->get_receive_out_system_data($blanch_id);
    $acount = $this->queries->get_customer_account_verfied($blanch_id);

    $miamala_out = $this->queries->get_total_transaction_default_general($blanch_id);
    $out_transaction = $this->queries->get_total_transaction_default($blanch_id);
    //     echo "<pre>";
    // print_r($out_transaction);
    //     exit();

    $this->load->view('oficer/default_balance',['empl_data'=>$empl_data,'total_insystem'=>$total_insystem,'total_outsystem'=>$total_outsystem,'acount'=>$acount,'miamala_out'=>$miamala_out,'out_transaction'=>$out_transaction]);
}

public function create_transaction_default(){
    $this->load->model('queries');
    $this->form_validation->set_rules('comp_id','company','required');
    $this->form_validation->set_rules('trans_type','type','required');
    $this->form_validation->set_rules('blanch_id','blanch','required');
    $this->form_validation->set_rules('empl_id','Employee','required');
    $this->form_validation->set_rules('from_trans_id','Account','required');
    $this->form_validation->set_rules('to_trans_id','Account','required');
    $this->form_validation->set_rules('amount_trans','Amount','required');
    $this->form_validation->set_rules('trans_fee','Fee','required');
    $this->form_validation->set_rules('date','Date','required');
    $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

    if ($this->form_validation->run()) {
        $data = $this->input->post();

        $comp_id = $data['comp_id'];
        $blanch_id = $data['blanch_id'];
        $empl_id = $data['empl_id'];
        $from_account = $data['from_trans_id'];
        $to_account = $data['to_trans_id'];
        $amount = $data['amount_trans'];
        $fee = $data['trans_fee'];
        $type = $data['trans_type'];

        $account = $to_account;
        //$saving = $amount;
        $remove_def = $amount + $fee;


        //from outsystem
        $outsystem = $this->queries->get_outin_system_acount($blanch_id,$from_account);
        $receve_outsystem = $outsystem->amount_receive;
        $out_system_balance = $receve_outsystem - $remove_def;

        //from insystem
        $insystem = $this->queries->get_insystem_balance($blanch_id,$from_account);
        $receve_insystem = $insystem->out_balance;
        $insystem_balance = $receve_insystem - $remove_def;

        // print_r($insystem_balance);
        //          exit();

        //to blanch_account
       $blanch_balance = $this->queries->get_blanch_account_balance($blanch_id,$account);
       $blanch_capital = $blanch_balance->blanch_capital;
       $new_balance = $blanch_capital + $amount;
       $saving =  $new_balance;


    
        if ($type == 'outsystem') {
            if ($receve_outsystem < $remove_def) {
            $this->session->set_flashdata("error",'You Don`t Have Enough Balance');
            return redirect('oficer/default_balance');
            }else{
        $this->update_out_system_balance($blanch_id,$from_account,$out_system_balance);
        $this->update_blanch_capitaldata($blanch_id,$account,$saving);
        $this->queries->insert_default_transaction($data);
        $this->session->set_flashdata("massage",'Transaction successfully');
        //echo "nje ya madeni system";
        }
        }elseif($type == 'insystem'){
            if ($receve_insystem < $remove_def) {
             $this->session->set_flashdata("error",'You Don`t Have Enough Balance');
            return redirect('oficer/default_balance');   
            }else{
         $this->update_insystem_balance($blanch_id,$from_account,$insystem_balance);
         $this->update_blanch_capitaldata($blanch_id,$account,$saving);
         $this->queries->insert_default_transaction($data);
         $this->session->set_flashdata("massage",'Transaction successfully');
           //echo "ndani ya madeni system";
        }
        }
        return redirect("oficer/default_balance");
    }
    $this->default_balance();
}

public function update_out_system_balance($blanch_id,$from_account,$out_system_balance){
 $sqldata="UPDATE `tbl_receive_outsystem` SET `amount_receive`= '$out_system_balance' WHERE `blanch_id`= '$blanch_id' AND `trans_id`='$from_account'";
   $query = $this->db->query($sqldata);
   return true;   
}

public function update_insystem_balance($blanch_id,$from_account,$insystem_balance){
  $sqldata="UPDATE `tbl_receve_outstand` SET `out_balance`= '$insystem_balance' WHERE `blanch_id`= '$blanch_id' AND `trans_id`='$from_account'";
   $query = $this->db->query($sqldata);
   return true;  
}


public function delete_transaction_mistak($id){
    $this->load->model('queries');
    $mistak_data = $this->queries->get_out_delete_transDefault($id);

        $comp_id = $mistak_data->comp_id;
        $blanch_id = $mistak_data->blanch_id;
        $empl_id = $mistak_data->empl_id;
        $from_account = $mistak_data->from_trans_id;
        $to_account = $mistak_data->to_trans_id;
        $amount = $mistak_data->amount_trans;
        $fee = $mistak_data->trans_fee;
        $type = $mistak_data->trans_type;

        // print_r($amount);
        //          exit();
        $account = $to_account;
        //$saving = $amount;
        $remove_def = $amount + $fee;


        //from outsystem
        $outsystem = $this->queries->get_outin_system_acount($blanch_id,$from_account);
        $receve_outsystem = $outsystem->amount_receive;
        $out_system_balance = $receve_outsystem + $remove_def;

        //from insystem
        $insystem = $this->queries->get_insystem_balance($blanch_id,$from_account);
        $receve_insystem = $insystem->out_balance;
        $insystem_balance = $receve_insystem + $remove_def;

        

        //to blanch_account
       $blanch_balance = $this->queries->get_blanch_account_balance($blanch_id,$account);
       $blanch_capital = $blanch_balance->blanch_capital;
       $new_balance = $blanch_capital - $amount;
       $saving =  $new_balance;


    
        if ($type == 'outsystem') {
        $this->update_out_system_balance($blanch_id,$from_account,$out_system_balance);
        $this->update_blanch_capitaldata($blanch_id,$account,$saving);
        $this->remove_transaction_mistak_default($id);
        $this->session->set_flashdata("massage",'Transaction Deleted successfully');
        //echo "nje ya madeni system";
        
        }elseif($type == 'insystem'){

         $this->update_insystem_balance($blanch_id,$from_account,$insystem_balance);
         $this->update_blanch_capitaldata($blanch_id,$account,$saving);
         $this->remove_transaction_mistak_default($id);
         $this->session->set_flashdata("massage",'Transaction Deleted successfully');
           //echo "ndani ya madeni system";
        }
    // echo "<pre>";
    // print_r($type);
    //       exit();
    return redirect('oficer/default_balance');
}


public function remove_transaction_mistak_default($id){
    return $this->db->delete('tbl_trans_out',['id'=>$id]);
}


public function loan_pending_time(){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);

    $loan_pending_new = $this->queries->get_total_loan_pending($blanch_id);
    $new_total_pending = $this->queries->get_total_pend_loan($blanch_id);

    $loan_pend = $this->queries->get_pending_reportLoanblanch($blanch_id);
    $pend = $this->queries->get_sun_loanPendingBlanch($blanch_id);
    //      echo "<pre>";
    // print_r($pend);
    //       exit();

    $this->load->view('oficer/loan_pending_time',['empl_data'=>$empl_data,'loan_pending_new'=>$loan_pending_new,'new_total_pending'=>$new_total_pending,'loan_pend'=>$loan_pend,'pend'=>$pend]);
}


public function get_today_receivable(){
  $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);

    
    $rejesho = $this->queries->get_total_recevable_blanch($blanch_id);
    $employee = $this->queries->get_today_recevable_employee_blanch($blanch_id);
    $empl_receivable = $this->queries->get_receivable_oficer_blanch($blanch_id);
  //    echo "<pre>";
  // print_r($rejesho);
  //          exit();
  $this->load->view('oficer/today_receivable',['empl_data'=>$empl_data,'rejesho'=>$rejesho,'employee'=>$employee,'empl_receivable'=>$empl_receivable]);  
}



    public function print_today_receivable_data(){
    $this->load->model('queries');
       $blanch_id = $this->session->userdata('blanch_id');
       $empl_id = $this->session->userdata('empl_id');
       $manager_data = $this->queries->get_manager_data($empl_id);
       $comp_id = $manager_data->comp_id;
       $company_data = $this->queries->get_companyData($comp_id);
       $blanch_data = $this->queries->get_blanchData($blanch_id);
       $empl_data = $this->queries->get_employee_data($empl_id);
        //$today_recevable = $this->queries->get_today_recevable_loan($comp_id);
      $rejesho = $this->queries->get_total_recevable_blanch($blanch_id);

        $employee = $this->queries->get_today_recevable_employee_blanch($blanch_id);
        $blanch = $this->queries->get_blanch($comp_id);

        $empl_receivable = $this->queries->get_receivable_oficer_blanch($blanch_id);
        $empl_data = $this->queries->get_employee_data($empl_id);
        $compdata = $this->queries->get_companyData($comp_id);
        

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8','format' => 'A4-L','orientation' => 'L']);
        $html = $this->load->view('oficer/print_today_receivable_empl',['empl_receivable'=>$empl_receivable,'rejesho'=>$rejesho,'compdata'=>$compdata,'rejesho'=>$rejesho],true);
        $mpdf->SetFooter('Generated By Brainsoft Technology');
        $mpdf->WriteHTML($html);
        $mpdf->Output();    
    }


    public function filter_loan_receivable(){
        $this->load->model('queries');
        $blanch_id = $this->session->userdata('blanch_id');
       $empl_id = $this->session->userdata('empl_id');
       $manager_data = $this->queries->get_manager_data($empl_id);
       $comp_id = $manager_data->comp_id;
       $company_data = $this->queries->get_companyData($comp_id);
       $blanch_data = $this->queries->get_blanchData($blanch_id);
       $empl_data = $this->queries->get_employee_data($empl_id);
        $blanch_id = $this->input->post('blanch_id');
        $empl_id = $this->input->post('empl_id');
        $loan_type = $this->input->post('loan_type');




        if ($loan_type == 'group') {
        $today_receivable = $this->queries->get_today_recevable_loanBlanch($blanch_id,$empl_id);
        $group_data = $this->queries->get_group_data_receivable($blanch_id,$empl_id);
        $rejesho = $this->queries->get_total_recevableBlanch($blanch_id,$empl_id);
        }elseif($loan_type == 'individual'){
         $today_receivable = $this->queries->get_today_recevable_individual($blanch_id,$empl_id);
         $group_data = $this->queries->get_group_data_receivable($blanch_id,$empl_id);
         $rejesho = $this->queries->get_total_recevableBlanch_Individual($blanch_id,$empl_id);
        }

        $employee = $this->queries->get_employee_data($empl_id);
        $blanch = $this->queries->get_blanch($comp_id);
        $blanch_data = $this->queries->get_blanch_data($blanch_id);
       
        $empl_receivable = $this->queries->get_receivable_oficer_blanch($blanch_id);

        // print_r($empl_receivable);
        //       exit();

    
        $this->load->view('oficer/filter_loan_receivable',['blanch'=>$blanch,'today_receivable'=>$today_receivable,'rejesho'=>$rejesho,'blanch_data'=>$blanch_data,'loan_type'=>$loan_type,'employee'=>$employee,'group_data'=>$group_data,'empl_id'=>$empl_id,'blanch_id'=>$blanch_id,'loan_type'=>$loan_type,'empl_receivable'=>$empl_receivable,'empl_data'=>$empl_data,'empl_receivable'=>$empl_receivable]);
    }



    public function print_receivable_group($blanch_id,$empl_id,$loan_type){
     $this->load->model('queries');
     $blanch_id = $this->session->userdata('blanch_id');
       $empl_id = $this->session->userdata('empl_id');
       $manager_data = $this->queries->get_manager_data($empl_id);
       $comp_id = $manager_data->comp_id;
       $company_data = $this->queries->get_companyData($comp_id);
       $blanch_data = $this->queries->get_blanchData($blanch_id);
       $empl_data = $this->queries->get_employee_data($empl_id);
     $compdata = $this->queries->get_companyData($comp_id);
        if ($loan_type == 'group') {
        $today_receivable = $this->queries->get_today_recevable_loanBlanch($blanch_id,$empl_id);
        $group_data = $this->queries->get_group_data_receivable($blanch_id,$empl_id);
        $rejesho = $this->queries->get_total_recevableBlanch($blanch_id,$empl_id);
        }elseif($loan_type == 'individual'){
         $today_receivable = $this->queries->get_today_recevable_individual($blanch_id,$empl_id);
         $group_data = $this->queries->get_group_data_receivable($blanch_id,$empl_id);
         $rejesho = $this->queries->get_total_recevableBlanch_Individual($blanch_id,$empl_id);
        }

        $employee = $this->queries->get_employee_data($empl_id);
        $blanch = $this->queries->get_blanch($comp_id);
        $blanch_data = $this->queries->get_blanch_data($blanch_id);
        $empl_receivable = $this->queries->get_receivable_oficer_blanch($blanch_id);

        

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8','format' => 'A4-L','orientation' => 'L']);
        $html = $this->load->view('oficer/receivable_empl_report',['employee'=>$employee,'rejesho'=>$rejesho,'compdata'=>$compdata,'loan_type'=>$loan_type,'today_receivable'=>$today_receivable,'group_data'=>$group_data,'compdata'=>$compdata,'blanch_data'=>$blanch_data],true);
        $mpdf->SetFooter('Generated By Brainsoft Technology');
        $mpdf->WriteHTML($html);
        $mpdf->Output(); 
    }



public function today_received(){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);
    
    $received = $this->queries->get_today_received_loanBlanch($blanch_id);
    $total_receved = $this->queries->get_sum_today_recevedBlanch($blanch_id);
    //    echo "<pre>";
    // print_r($received);
    //    exit();

    $this->load->view('oficer/today_received',['empl_data'=>$empl_data,'received'=>$received,'total_receved'=>$total_receved]);
}

public function loan_collection(){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);

    $loan_collection = $this->queries->get_loan_collectionBlanch($blanch_id);

    $loan_total = $this->queries->get_total_loanBlanch($blanch_id);
    $depost_loan = $this->queries->get_totalPaid_loanBlanch($blanch_id);
    $penart = $this->queries->get_total_penartBlanch($blanch_id);
    $penart_paid = $this->queries->get_paid_penartBlanch($blanch_id);
    //   echo "<pre>";
    // print_r($loan_collection);
    //     exit();

    $this->load->view('oficer/loan_collection',['empl_data'=>$empl_data,'loan_collection'=>$loan_collection,'loan_total'=>$loan_total,'depost_loan'=>$depost_loan,'penart'=>$penart,'penart_paid'=>$penart_paid]);
}



public function loan_repayment(){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);

    $repayment = $this->queries->get_loan_repayment_blanch($blanch_id);
    // echo "<pre>";
    // print_r($repayment);
    //        exit();

    $this->load->view('oficer/loan_repayment',['empl_data'=>$empl_data,'repayment'=>$repayment]);
}


public function customer_account_statement(){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);
    $customer = $this->queries->get_allcutomerblanchData($blanch_id);
    $customery = $this->queries->get_allcutomerblanchData($blanch_id);

    $this->load->view('oficer/customer_account',['empl_data'=>$empl_data,'customer'=>$customer]);
}

    function fetch_data_loanActive()
{
$this->load->model('queries');
if($this->input->post('customer_id'))
{
echo $this->queries->fetch_loan_list($this->input->post('customer_id'));
}
}

public function customer_report(){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);
    $customer_id = $this->input->post('customer_id');
    $loan_id = $this->input->post('loan_id');

    $customer = $this->queries->search_CustomerLoan($customer_id);
    // print_r($customer_id);
    // exit();
    $customery = $this->queries->get_allcutomerblanchData($blanch_id);
    $this->load->view('oficer/customer_account_report',['empl_data'=>$empl_data,'customery'=>$customery,'customer'=>$customer,'loan_id'=>$loan_id,'customer_id'=>$customer_id]);
}

public function print_account_statement($customer_id,$loan_id){
     $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);
     $compdata = $this->queries->get_companyData($comp_id);
     $customer_data = $this->queries->get_loan_schedule_customer($loan_id);
     
    $mpdf = new \Mpdf\Mpdf();
     $html = $this->load->view('oficer/customer_account_statement',['compdata'=>$compdata,'customer_data'=>$customer_data,'loan_id'=>$loan_id,'customer_id'=>$customer_id],true);
     $mpdf->SetFooter('Generated By Brainsoft');
     $mpdf->WriteHTML($html);
     $mpdf->Output(); 

    }


public function filter_customer_statement(){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);

    $from = $this->input->post('from');
    $to = $this->input->post('to');
    $customer_id = $this->input->post('customer_id');

    $data_account = $this->queries->get_account_statement($customer_id,$from,$to);
    $customer = $this->queries->search_CustomerLoan($customer_id);
    $customery = $this->queries->get_allcutomerblanchData($blanch_id);
    
    // print_r($data_account);
    //     exit();

    $this->load->view('oficer/customer_statement',['empl_data'=>$empl_data,'customer'=>$customer,'data_account'=>$data_account,'customery'=>$customery]);
}



public function blanchwise_loan(){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);

    $blanch_wise = $this->queries->get_sumblanch_wise_blanch($blanch_id);
    //          echo "<pre>";
    // print_r($blanch_wise);
    //       exit();

    $this->load->view('oficer/blanch_wise',['empl_data'=>$empl_data,'blanch_wise'=>$blanch_wise]);
}


public function transfor_float_branch(){
    $this->load->model('queries');
     $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);
    $acount = $this->queries->get_customer_account_verfied($blanch_id);
    $blanch = $this->queries->get_blanch($comp_id);

    $transaction = $this->queries->get_transfor_float_blanch($blanch_id);
    $sum_trans = $this->queries->get_total_transaction_total($blanch_id);
    // echo "<pre>";
    // print_r($sum_trans);
    //      exit();
    $this->load->view('oficer/transfor_blanch',['empl_data'=>$empl_data,'acount'=>$acount,'blanch'=>$blanch,'transaction'=>$transaction,'sum_trans'=>$sum_trans]);
}





function fetch_blanch_account()
{
$this->load->model('queries');
if($this->input->post('blanch_id'))
{
echo $this->queries->fetch_blanch_account_data($this->input->post('blanch_id'));
}

}


public function transfor_amount_from_blanch_to_branch(){
    $this->load->model('queries');
    $this->form_validation->set_rules('from_blanch','From Branch','required');
    $this->form_validation->set_rules('from_blanch_account','Branch Account','required');
    $this->form_validation->set_rules('from_amount','From Branch Amount','required');
    $this->form_validation->set_rules('to_branch','To Branch','required');
    $this->form_validation->set_rules('to_branch_account','To Branch Account','required');
    //$this->form_validation->set_rules('to_amount','To Branch Amount','required');
    $this->form_validation->set_rules('charger_fee','charger fee','required');
    $this->form_validation->set_rules('date_trans','date transaction','required');
    $this->form_validation->set_rules('comp_id','company','required');
    $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

    if ($this->form_validation->run()) {
        $data = $this->input->post();

        $from_blanch = $data['from_blanch'];
        $from_blanch_account = $data['from_blanch_account'];
        $from_amount = $data['from_amount'];
        $to_branch = $data['to_branch'];
        $to_branch_account = $data['to_branch_account'];
        $charger_fee = $data['charger_fee'];
        $date_trans = $data['date_trans'];
        $comp_id = $data['comp_id'];

        $blanch_id = $from_blanch;
        $trans_id = $from_blanch_account;
        $to_account = $to_branch_account;

    //from blanch Account
    $blanch_account = $this->queries->get_blanch_account_target($blanch_id,$trans_id);
    $blanch_amount = $blanch_account->blanch_capital;
    $amount_makato = $from_amount + $charger_fee;
    $remove_money = $blanch_amount - $amount_makato;

    //to blanch Account
    $to_blanchAccount = $this->queries->get_blanch_account_target_toblanch($to_branch,$to_account);
    $old_balance = $to_blanchAccount->blanch_capital;

    $new_balance = $old_balance + $from_amount;

    

     if ($amount_makato > $blanch_amount) {

        $this->session->set_flashdata("error",'You Don`t Have Enough Balance');
         return redirect("oficer/transfor_float_branch");
     }else{

        $this->update_from_account_blanch($blanch_id,$trans_id,$remove_money);
        $this->update_add_toBlanch_account($to_branch,$to_account,$new_balance);

        $this->insert_blanch_blanch_transaction($comp_id,$blanch_id,$trans_id,$amount_makato,$to_branch,$to_account,$from_amount,$charger_fee);
        $this->session->set_flashdata("massage",'Transaction successfully');
        //echo "naweza kutoka";
     }

        return redirect("oficer/transfor_float_branch");
    }
    $this->transfor_float_branch();
}


public function update_from_account_blanch($blanch_id,$trans_id,$remove_money){
   $sqldata="UPDATE `tbl_blanch_account` SET `blanch_capital`= '$remove_money' WHERE `blanch_id`= '$blanch_id' AND `receive_trans_id`='$trans_id'";
      $query = $this->db->query($sqldata);
      return true; 
}

public function update_add_toBlanch_account($to_branch,$to_account,$new_balance){
  $sqldata="UPDATE `tbl_blanch_account` SET `blanch_capital`= '$new_balance' WHERE `blanch_id`= '$to_branch' AND `receive_trans_id`='$to_account'";
      $query = $this->db->query($sqldata);
      return true;  
}

public function insert_blanch_blanch_transaction($comp_id,$blanch_id,$trans_id,$amount_makato,$to_branch,$to_account,$from_amount,$charger_fee){
    $day = date("Y-m-d");
  $this->db->query("INSERT INTO tbl_float_branch (`comp_id`,`from_blanch`,`from_blanch_account`,`from_amount`,`to_branch`,`to_branch_account`,`to_amount`,`charger_fee`,`date_trans`) VALUES ('$comp_id','$blanch_id','$trans_id','$amount_makato','$to_branch','$to_account','$from_amount','$charger_fee','$day')");  
}


public function remove_transaction_float($id){
    $this->load->model('queries');
    $transaction = $this->queries->get_transactrion_blanch_blanch($id);
    
        $from_blanch = $transaction->from_blanch;
        $from_blanch_account = $transaction->from_blanch_account;
        $from_amount = $transaction->from_amount;
        $to_branch = $transaction->to_branch;
        $to_branch_account = $transaction->to_branch_account;
        $charger_fee = $transaction->charger_fee;
        $date_trans = $transaction->date_trans;
        $to_amount = $transaction->to_amount;

        $blanch_id = $from_blanch;
        $trans_id = $from_blanch_account;
        $to_account = $to_branch_account;

        //from blanch Account
    $blanch_account = $this->queries->get_blanch_account_target($blanch_id,$trans_id);
    $blanch_amount = $blanch_account->blanch_capital;
    $amount_makato = $from_amount;
    $remove_money = $blanch_amount + $amount_makato;

    //to blanch Account
    $to_blanchAccount = $this->queries->get_blanch_account_target_toblanch($to_branch,$to_account);
    $old_balance = $to_blanchAccount->blanch_capital;

    $new_balance = $old_balance - $to_amount;

    $this->update_from_account_blanch($blanch_id,$trans_id,$remove_money);
    $this->update_add_toBlanch_account($to_branch,$to_account,$new_balance);
    $this->remove_transaction_float_branch($id);

    //      echo "<pre>";
    // print_r($new_balance);
    //       exit();
    $this->session->set_flashdata("massage",'Transaction Deleted successfully');
    return redirect('oficer/transfor_float_branch'); 
}

public function remove_transaction_float_branch($id){
    return $this->db->delete('tbl_float_branch',['id'=>$id]);
}


public function receive_float(){
    $this->load->model('queries');
    $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);
    $transaction = $this->queries->get_receive_float_blanch($blanch_id);
    $total_trans = $this->queries->get_total_receive_total($blanch_id);
    // print_r($total_trans);
    //      exit();
    $this->load->view('oficer/receive_float',['empl_data'=>$empl_data,'transaction'=>$transaction,'total_trans'=>$total_trans]);
}


 public function reject_loan($loan_id){
    $this->load->model('queries');
    $data = $this->queries->get_loan_rejectData($loan_id);
    // print_r($data);
    //     exit();
    if ($data->loan_status = 'reject') {
        // print_r($data);
        //   exit();
        $this->queries->update_status($loan_id,$data);
        $this->session->set_flashdata('massage','Loan Rejected successfully');
    }
    return redirect('oficer/loan_pending');
 }

  public function delete_loan($loan_id){
    $this->load->model('queries');
    if($this->queries->remove_loan($loan_id));
    $this->session->set_flashdata('massage','Loan Deleted successfully');
    return redirect('oficer/loan_pending');
 }

  function fetch_active_loan()
{
$this->load->model('queries');
if($this->input->post('customer_id'))
{
echo $this->queries->fetch_loan_active($this->input->post('customer_id'));
}
}

  function fetch_loan_day()
{
$this->load->model('queries');
if($this->input->post('customer_id'))
{
echo $this->queries->fetch_loan_active_day($this->input->post('customer_id'));
}
}



       public function next_expectation(){
            $this->load->model('queries');
            $blanch_id = $this->session->userdata('blanch_id');
            $empl_id = $this->session->userdata('empl_id');
            $manager_data = $this->queries->get_manager_data($empl_id);
            $comp_id = $manager_data->comp_id;
            $company_data = $this->queries->get_companyData($comp_id);
            $blanch_data = $this->queries->get_blanchData($blanch_id);
            $empl_data = $this->queries->get_employee_data($empl_id);
            // echo "<pre>";
            // print_r($blanch);
            //     exit();
            $this->load->view('oficer/next_expect',['empl_data'=>$empl_data]);
        }


        public function next_expectation_report(){
            $this->load->model('queries');
            $blanch_id = $this->session->userdata('blanch_id');
            $empl_id = $this->session->userdata('empl_id');
            $manager_data = $this->queries->get_manager_data($empl_id);
            $comp_id = $manager_data->comp_id;
            $company_data = $this->queries->get_companyData($comp_id);
            $blanch_data = $this->queries->get_blanchData($blanch_id);
            $empl_data = $this->queries->get_employee_data($empl_id);
            $privillage = $this->queries->get_position_empl($empl_id);
            $branch = $this->queries->get_blanch($comp_id);
            $blanch_id = $this->input->post('blanch_id');
            $from = $this->input->post('from');
            $to = $this->input->post('to');

              if ($blanch_id == 'all') {
             $data_expected = $this->queries->get_expected_receivable_comp($from,$to,$comp_id);
             $sum_expectation = $this->queries->get_expected_receivable_sum_comp($from,$to,$comp_id);   
              }else{
            $data_expected = $this->queries->get_expected_receivable($from,$to,$blanch_id);
            $sum_expectation = $this->queries->get_expected_receivable_sum($from,$to,$blanch_id);
            }
            $branch_data = $this->queries->get_blanch_data($blanch_id);
            // echo "<pre>";
            // print_r($sum_expectation);
            //        exit();

            $this->load->view('oficer/next_expectation',['branch'=>$branch,'data_expected'=>$data_expected,'sum_expectation'=>$sum_expectation,'from'=>$from,'to'=>$to,'branch_data'=>$branch_data,'blanch_id'=>$blanch_id,'empl_data'=>$empl_data,'privillage'=>$privillage]);
        }


        public function print_expected_receivable($from,$to,$blanch_id){
            $this->load->model('queries');
            $blanch_id = $this->session->userdata('blanch_id');
            $empl_id = $this->session->userdata('empl_id');
            $manager_data = $this->queries->get_manager_data($empl_id);
            $comp_id = $manager_data->comp_id;
            $company_data = $this->queries->get_companyData($comp_id);
            $blanch_data = $this->queries->get_blanchData($blanch_id);
            $empl_data = $this->queries->get_employee_data($empl_id);
            $compdata = $this->queries->get_companyData($comp_id);

              if ($blanch_id == 'all') {
             $data_expected = $this->queries->get_expected_receivable_comp($from,$to,$comp_id);
             $sum_expectation = $this->queries->get_expected_receivable_sum_comp($from,$to,$comp_id);   
              }else{
            $data_expected = $this->queries->get_expected_receivable($from,$to,$blanch_id);
            $sum_expectation = $this->queries->get_expected_receivable_sum($from,$to,$blanch_id);
            }
            $branch_data = $this->queries->get_blanch_data($blanch_id);

          $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8','format' => 'A4-L','orientation' => 'L']);
          $html = $this->load->view('oficer/next_expectation_report',['compdata'=>$compdata,'branch'=>$branch,'data_expected'=>$data_expected,'sum_expectation'=>$sum_expectation,'from'=>$from,'to'=>$to,'branch_data'=>$branch_data,'blanch_id'=>$blanch_id],true);
          $mpdf->SetFooter('Generated By Brainsoft Technology');
          $mpdf->WriteHTML($html);
          $mpdf->Output();
        }


          public function renew_loan($loan_id){
            $this->load->model('queries');
            $blanch_id = $this->session->userdata('blanch_id');
            $empl_id = $this->session->userdata('empl_id');
            $manager_data = $this->queries->get_manager_data($empl_id);
            $comp_id = $manager_data->comp_id;
            $company_data = $this->queries->get_companyData($comp_id);
            $blanch_data = $this->queries->get_blanchData($blanch_id);
            $empl_data = $this->queries->get_employee_data($empl_id);

            $loan_data = $this->queries->get_loan_data_loan($loan_id);
            $deposit = $this->queries->get_loan_deposit_total($loan_id);
            $renew_list = $this->queries->get_renew_loan_request($loan_id);
            // echo "<pre>";
            // print_r($renew_list);
            //    exit();
            $this->load->view('oficer/renew_loan',['loan_data'=>$loan_data,'deposit'=>$deposit,'renew_list'=>$renew_list,'empl_data'=>$empl_data]);
        }


            public function create_renew_loan($loan_id){
            $this->form_validation->set_rules('comp_id','Company','required');
            $this->form_validation->set_rules('blanch_id','Blanch','required');
            $this->form_validation->set_rules('loan_id','Loan','required');
            $this->form_validation->set_rules('empl_id','Employee');
            $this->form_validation->set_rules('renew_amount','Loan amount','required');
            $this->form_validation->set_rules('date_renew','Date','required');
            $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

            if ($this->form_validation->run()) {
                $data = $this->input->post();
                //    echo "<pre>";
                // print_r($data);
                //     exit();
                $this->load->model('queries');
                if ($this->queries->insert_loan_renew($data)) {
                    $this->session->set_flashdata("massage",'Loan Request Successfully');
                }else{
                    $this->session->set_flashdata("error",'Failed');
                }
                return redirect('oficer/renew_loan/'.$loan_id);
            }
            $this->renew_loan();
        }

        public function update_renew_loan($renew_id){
            //$this->form_validation->set_rules('comp_id','Company','required');
            //$this->form_validation->set_rules('blanch_id','Blanch','required');
            //$this->form_validation->set_rules('loan_id','Loan','required');
            //$this->form_validation->set_rules('empl_id','Employee','required');
            $this->form_validation->set_rules('renew_amount','Loan amount','required');
            //$this->form_validation->set_rules('date_renew','Date','required');
            $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

            if ($this->form_validation->run()) {
                $data = $this->input->post();
                //    echo "<pre>";
                // print_r($data);
                //     exit();
                $this->load->model('queries');
                $renew = $this->queries->get_renew_data_loan($renew_id);
                $loan_id = $renew->loan_id;
                // print_r($loan_id);
                //     exit();
                if ($this->queries->update_renew_loan($data,$renew_id)) {
                    $this->session->set_flashdata("massage",'Loan Request Updated successfully');
                }else{
                    $this->session->set_flashdata("error",'Failed');
                }
                return redirect('oficer/renew_loan/'.$loan_id);
            }
            $this->renew_loan();    
        }



        public function delete_renew_loan($renew_id){
            $this->load->model('queries');
            $renew = $this->queries->get_renew_data_loan($renew_id);
            $loan_id = $renew->loan_id;
            if($this->queries->remove_renew($renew_id));
            $this->session->set_flashdata("massage",'Data Deleted successfully');
            return redirect('oficer/renew_loan/'.$loan_id);
        }

        public function renew_request(){
            $this->load->model('queries');
           $blanch_id = $this->session->userdata('blanch_id');
            $empl_id = $this->session->userdata('empl_id');
            $manager_data = $this->queries->get_manager_data($empl_id);
            $comp_id = $manager_data->comp_id;
            $company_data = $this->queries->get_companyData($comp_id);
            $blanch_data = $this->queries->get_blanchData($blanch_id);
            $empl_data = $this->queries->get_employee_data($empl_id);

            $all_renew = $this->queries->get_all_renew_loan_blanch($blanch_id);
            
            // echo "<pre>";
            // print_r($all_renew);
            //        exit();

            $this->load->view('oficer/renew_request',['all_renew'=>$all_renew,'empl_id'=>$empl_id]);
        }


        public function delete_renew_loan_data($renew_id){
            $this->load->model('queries');
            if($this->queries->remove_renew($renew_id));
            $this->session->set_flashdata("massage",'Data Deleted successfully');
            return redirect('oficer/renew_request/');
        }



        public function aprove_loan_renew($renew_id){
            $this->load->model('queries');
            $blanch_id = $this->session->userdata('blanch_id');
            $empl_id = $this->session->userdata('empl_id');
            $manager_data = $this->queries->get_manager_data($empl_id);
            $comp_id = $manager_data->comp_id;
            $company_data = $this->queries->get_companyData($comp_id);
            $blanch_data = $this->queries->get_blanchData($blanch_id);
            $empl_data = $this->queries->get_employee_data($empl_id);

            $username = $empl_data->username;
        
            $this->form_validation->set_rules('blanch_id','Branch','required');
            $this->form_validation->set_rules('renew_amount','Amount','required');
            $this->form_validation->set_rules('method_renew','method','required');
            $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
             if ($this->form_validation->run()) {
                $data = $this->input->post();
                $blanch_id = $data['blanch_id'];
                $renew_amount = $data['renew_amount'];
                $method_renew = $data['method_renew'];
                $status_renew = 'close';

                $account = $method_renew;




                $renew = $this->queries->get_renew_data_loan($renew_id);
                $loan_id = $renew->loan_id;
                $renew_amount = $renew->renew_amount;
                //$customer_id = $renew->customer_id;
                $empl_id = $renew->empl_id;
               $loan = $this->queries->get_loan_data_renew($loan_id);

               $loan_aprove = $loan->loan_aprove;
               $loan_int = $loan->loan_int;
               $rate = $loan->rate;
               $day = $loan->day;
               $session = $loan->session;
               $interest_formular = $loan->interest_formular;
               $customer_id = $loan->customer_id;
               $comp_id = $loan->comp_id;

               $new_principal = $renew_amount + $loan_aprove;
               $end_date = $day * $session;

               $day_data = $end_date;
               $month = floor($day_data / 30);
          
                if ($rate == 'SIMPLE') {
                $interest = $interest_formular / 100 * $new_principal;
                $restoration = ($interest + $new_principal) / ($session);
                $res = $restoration;

                }elseif ($rate == 'FLAT RATE') {
                $interest = $interest_formular / 100 * $new_principal * $month; 
                $restoration = ($interest + $new_principal) / ($session);
                $res = $restoration;
                }elseif ($rate == 'REDUCING') {
                 $months = $end_date / 30;
                 $interest = $interest_loan / 1200;
                 $loan = $loan_aproved;
                 $amount = $interest * -$loan * pow((1 + $interest), $months) / (1 - pow((1 + $interest), $months));
                 $total_loan = $amount * 1 * $months;
                 $loan_interest = $total_loan - $loan;
                 $res = $amount;
                }
               
               $new_loanint = $new_principal + $interest;
               $blanch_account = $this->queries->get_blanchAccountremain($blanch_id,$account);
               $blanch_capital = $blanch_account->blanch_capital;

               $remove_balance = $blanch_capital - $renew_amount;

               $pay_report = $this->queries->get_pay_renew_loan($loan_id);
               $balance = $pay_report->balance;
               $new_renew = $balance + $renew_amount;

               $with_renew =    $balance ;

               //         echo "<pre>";
               // print_r($with_renew);
               //         exit();
                
                if ($blanch_capital < $renew_amount) {
                $this->session->set_flashdata('error','You don`t Have Enough Balance');
                }else{
               $this->update_renew_loan_status($renew_id,$status_renew,$method_renew);
               $this->update_loan_renew($blanch_id,$loan_id,$new_principal,$res,$new_loanint);
               $this->update_blanch_account($blanch_id,$account,$remove_balance);
               $dep_id = $this->insert_renew_empty($comp_id,$blanch_id);
               $this->insert_prev_record_renew($comp_id,$blanch_id,$empl_id,$customer_id,$loan_id,$dep_id,$renew_amount,$method_renew);
               $this->insert_pay_record_data($comp_id,$blanch_id,$customer_id,$loan_id,$renew_amount,$new_renew,$dep_id,$username);
               $this->with_renew_amount_loan($comp_id,$blanch_id,$customer_id,$loan_id,$renew_amount,$with_renew,$method_renew,$dep_id,$username);

               $this->session->set_flashdata('massage','Loan Aproved Sucessfully');
              }

              return redirect("oficer/renew_request");
                
             }

             $this->renew_request();
        }

        public function with_renew_amount_loan($comp_id,$blanch_id,$customer_id,$loan_id,$renew_amount,$with_renew,$method_renew,$dep_id,$username){
            $date = date("Y-m-d");
        $this->db->query("INSERT INTO tbl_pay (`comp_id`,`blanch_id`,`customer_id`,`loan_id`,`withdrow`,`balance`,`description`,`date_pay`,`date_data`,`p_method`,`dep_id`,`emply`) VALUES ('$comp_id','$blanch_id','$customer_id','$loan_id','$renew_amount','$with_renew','CASH WITHDRAWAL','$date','$date','$method_renew','$dep_id','$username')"); 
        }


        public function insert_pay_record_data($comp_id,$blanch_id,$customer_id,$loan_id,$renew_amount,$new_renew,$dep_id,$username){
            $date = date("Y-m-d");
        $this->db->query("INSERT INTO tbl_pay (`comp_id`,`blanch_id`,`customer_id`,`loan_id`,`depost`,`balance`,`description`,`date_pay`,`date_data`,`dep_id`,`emply`) VALUES ('$comp_id','$blanch_id','$customer_id','$loan_id','$renew_amount','$new_renew','RENEW LOAN','$date','$date','$dep_id','$username')");    
        }


        public function insert_prev_record_renew($comp_id,$blanch_id,$empl_id,$customer_id,$loan_id,$dep_id,$renew_amount,$method_renew){
            $date = date("Y-m-d");
            $day = date("Y-m-d H:i:s");
        $this->db->query("INSERT INTO tbl_prev_lecod (`comp_id`,`blanch_id`,`empl_id`,`customer_id`,`loan_id`,`pay_id`,`withdraw`,`with_trans`,`lecod_day`,`loan_aprov`,`time_rec`) VALUES ('$comp_id','$blanch_id','$empl_id','$customer_id','$loan_id','$dep_id','$renew_amount','$method_renew','$date','$renew_amount','$day')");   
        }

        public function insert_renew_empty($comp_id,$blanch_id){
         $this->db->query("INSERT INTO tbl_depost (`comp_id`,`blanch_id`) VALUES ('','')");
         return $this->db->insert_id();
    
        }

        public function update_blanch_account($blanch_id,$account,$remove_balance){
        $sqldata="UPDATE `tbl_blanch_account` SET `blanch_capital`= '$remove_balance'   WHERE `receive_trans_id`= '$account' AND `blanch_id`='$blanch_id'";
       // print_r($sqldata);
       // exit();
       $query = $this->db->query($sqldata);
       return true;     
        }


        public function update_loan_renew($blanch_id,$loan_id,$new_principal,$res,$new_loanint){
        $sqldata="UPDATE `tbl_loans` SET `loan_aprove`= '$new_principal' , `restration`='$res',`loan_int`='$new_loanint'  WHERE `loan_id`= '$loan_id'";
       // print_r($sqldata);
       // exit();
       $query = $this->db->query($sqldata);
       return true; 
        }


        public function update_renew_loan_status($renew_id,$status_renew,$method_renew){
        $sqldata="UPDATE `tbl_renew` SET `status_renew`= '$status_renew' , `method_renew`='$method_renew'  WHERE `renew_id`= '$renew_id'";
    // print_r($sqldata);
    //    exit();
     $query = $this->db->query($sqldata);
     return true;
        }


    public function renew_loan_aproved(){
    $this->load->model('queries');
     $blanch_id = $this->session->userdata('blanch_id');
    $empl_id = $this->session->userdata('empl_id');
    $manager_data = $this->queries->get_manager_data($empl_id);
    $comp_id = $manager_data->comp_id;
    $company_data = $this->queries->get_companyData($comp_id);
    $blanch_data = $this->queries->get_blanchData($blanch_id);
    $empl_data = $this->queries->get_employee_data($empl_id);

    $aproved_renew = $this->queries->get_all_renew_loan_aprove_blanch($blanch_id);
    $renew_total = $this->queries->get_total_renew_loan_blanch($blanch_id);
    $blanch = $this->queries->get_blanch($comp_id);
    //        echo "<pre>";
    // print_r($renew_total);
    //         exit();
    $this->load->view('oficer/renew_loan_aproved',['aproved_renew'=>$aproved_renew,'renew_total'=>$renew_total,'blanch'=>$blanch,'empl_data'=>$empl_data]);
}

      public function filter_renew_loan(){
            $this->load->model('queries');
            $blanch_id = $this->session->userdata('blanch_id');
            $empl_id = $this->session->userdata('empl_id');
            $manager_data = $this->queries->get_manager_data($empl_id);
            $comp_id = $manager_data->comp_id;
            $company_data = $this->queries->get_companyData($comp_id);
            $blanch_data = $this->queries->get_blanchData($blanch_id);
            $empl_data = $this->queries->get_employee_data($empl_id);
            $blanch = $this->queries->get_blanch($comp_id);
            $blanch_id = $this->input->post('blanch_id');
            $from = $this->input->post('from');
            $to = $this->input->post('to');
            $blanch_data = $this->queries->get_blanch_data($blanch_id);

            $prev_renew_loan = $this->queries->get_prev_renew_loan($blanch_id,$from,$to);
            $renew_total = $this->queries->get_total_renew_loan_prev($blanch_id,$from,$to);

            $this->load->view('oficer/prev_renew_loan',['blanch'=>$blanch,'prev_renew_loan'=>$prev_renew_loan,'from'=>$from,'to'=>$to,'renew_total'=>$renew_total,'blanch_data'=>$blanch_data,'empl_data'=>$empl_data]);
        }






public function grops(){
$this->load->model('queries');
$blanch_id = $this->session->userdata('blanch_id');
$empl_id = $this->session->userdata('empl_id');
 $manager_data = $this->queries->get_manager_data($empl_id);
$comp_id = $manager_data->comp_id;
$company_data = $this->queries->get_companyData($comp_id);
$blanch_data = $this->queries->get_blanchData($blanch_id);
$empl_data = $this->queries->get_employee_data($empl_id);
$group = $this->queries->get_groups_blanchs($blanch_id);
$employee = $this->queries->get_blanch_employee($blanch_id);
$group = $this->queries->get_groups_blanchs($blanch_id);
// echo "<pre>";
// print_r($group);
//      exit();
$this->load->view('oficer/groups',['group'=>$group,'empl_data'=>$empl_data]);  
}


public function create_Groups(){
$this->form_validation->set_rules('comp_id','company','required');
$this->form_validation->set_rules('blanch_id','Branch','required');
$this->form_validation->set_rules('group_name','group','required');
$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

if ($this->form_validation->run()) {
     $data = $this->input->post();
     // print_r($data);
     //    exit();
     $this->load->model('queries');
     if ($this->queries->insert_group($data)) {
      $this->session->set_flashdata("massage",'Group Registered Successfully');
     }else{
     $this->session->set_flashdata("error",'Failed');   
     }
     return redirect('oficer/grops');
}
$this->grops();
        
 }

 public function modify_group_data($group_id){
        $this->form_validation->set_rules('group_name','Group','required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
        
        if ($this->form_validation->run()) {
              $data = $this->input->post();

              // print_r($data);
              //      exit();
              $this->load->model('queries');
              if ($this->queries->update_group_data($group_id,$data)) {
                  $this->session->set_flashdata("massage",'Group Updated Successfully');
              }else{
               $this->session->set_flashdata("error",'Failed'); 
              }
              return redirect('oficer/grops');
          }
          $this->grops();  
        }


        

public function delete_group($group_id){
        $this->load->model('queries');
        if($this->queries->remove_group($group_id));
        $this->session->set_flashdata('massage','Data Deleted successfully');
        return redirect('oficer/grops');
    }


        public function add_members($customer_id){
            $this->load->model('queries');
            $blanch_id = $this->session->userdata('blanch_id');
           $empl_id = $this->session->userdata('empl_id');
           $manager_data = $this->queries->get_manager_data($empl_id);
           $comp_id = $manager_data->comp_id;
           $company_data = $this->queries->get_companyData($comp_id);
          $blanch_data = $this->queries->get_blanchData($blanch_id);
           $empl_data = $this->queries->get_employee_data($empl_id);
            $group_data = $this->queries->get_group_data($customer_id);
            $member = $this->queries->get_memebers_group($customer_id);
            // echo "<pre>";
            // print_r($group_data);
            //      exit();
            $this->load->view('oficer/group_member',['group_data'=>$group_data,'member'=>$member,'empl_data'=>$empl_data]);
        }


        public function create_mebers($customer_id){
         $this->form_validation->set_rules('comp_id','company','required');   
         $this->form_validation->set_rules('blanch_id','blanch','required');   
         $this->form_validation->set_rules('customer_id','Customer','required');   
         $this->form_validation->set_rules('full_name','Customer','required');   
         $this->form_validation->set_rules('member_no','Number','required');   
         $this->form_validation->set_rules('adress','adress','required');   
         $this->form_validation->set_rules('position','position','required');   
         $this->form_validation->set_rules('gender','gender','required');   
         $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

         if ($this->form_validation->run()) {
                $data = $this->input->post();
                // echo "<pre>";
                // print_r($data);
                //     exit();
                $this->load->model('queries');
                if ($this->queries->insert_group_member($data)) {
                    $this->session->set_flashdata("massage",'Member Saved Successfully');
                }else{
                  $this->session->set_flashdata("error",'Failed');  
                }
                return redirect('oficer/add_members/'.$customer_id);
            } 
            $this->add_members();  
        }

         public function update_mebers($id,$customer_id){
         //$this->form_validation->set_rules('comp_id','company','required');   
         //$this->form_validation->set_rules('blanch_id','blanch','required');   
         //$this->form_validation->set_rules('customer_id','Customer','required');   
         $this->form_validation->set_rules('full_name','Customer','required');   
         $this->form_validation->set_rules('member_no','Number','required');   
         $this->form_validation->set_rules('adress','adress','required');   
         $this->form_validation->set_rules('position','position','required');   
         $this->form_validation->set_rules('gender','gender','required');   
         $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

         if ($this->form_validation->run()) {
                $data = $this->input->post();
                // echo "<pre>";
                // print_r($data);
                //     exit();
                $this->load->model('queries');
                if ($this->queries->update_group_member($data,$id)) {
                    $this->session->set_flashdata("massage",'Member Saved Successfully');
                }else{
                  $this->session->set_flashdata("error",'Failed');  
                }
                return redirect('oficer/add_members/'.$customer_id);
            } 
            $this->add_members();  
        }


        public function remove_member($id,$customer_id){
            $this->load->model('queries');
            if($this->queries->delete_members($id));
            $this->session->set_flashdata("massage",'Member Deleted Successfully');
            return redirect('oficer/add_members/'.$customer_id);
        }


        public function group_members(){
            $this->load->model('queries');
            $blanch_id = $this->session->userdata('blanch_id');
           $empl_id = $this->session->userdata('empl_id');
           $manager_data = $this->queries->get_manager_data($empl_id);
           $comp_id = $manager_data->comp_id;
           $company_data = $this->queries->get_companyData($comp_id);
          $blanch_data = $this->queries->get_blanchData($blanch_id);
           $empl_data = $this->queries->get_employee_data($empl_id);
            $group = $this->queries->get_groups_blanchs($blanch_id);

            $this->load->view('oficer/group_members',['group'=>$group,'empl_data'=>$empl_data]);
        }

        public function view_all_group_loan($group_id){
            $this->load->model('queries');
            $blanch_id = $this->session->userdata('blanch_id');
            $empl_id = $this->session->userdata('empl_id');
            $manager_data = $this->queries->get_manager_data($empl_id);
            $comp_id = $manager_data->comp_id;
            $customer_group = $this->queries->get_customergroupdata($group_id,$comp_id);
            $loan_pending = $this->queries->get_loanGroup($group_id,$comp_id);
            $group_data = $this->queries->get_groupDataone($group_id);
            $total_loan_group = $this->queries->get_total_loanGroup($comp_id,$group_id);
            $total_depost_group = $this->queries->get_total_depostGroup($comp_id,$group_id);
             //  echo "<pre>";
             // print_r($loan_pending);
             //         exit();
            $this->load->view('oficer/group_loan',['group_id'=>$group_id,'customer_group'=>$customer_group,'loan_pending'=>$loan_pending,'group_data'=>$group_data,'total_loan_group'=>$total_loan_group,'total_depost_group'=>$total_depost_group,'comp_id'=>$comp_id]);
        }


        public function  print_loangroup($comp_id,$group_id){
        $this->load->model('queries');
      $blanch_id = $this->session->userdata('blanch_id');
       $empl_id = $this->session->userdata('empl_id');
       $manager_data = $this->queries->get_manager_data($empl_id);
       $comp_id = $manager_data->comp_id;
        $customer_group = $this->queries->get_customergroupdata($group_id,$comp_id);
        $loan_pending = $this->queries->get_loanGroup($group_id,$comp_id);
        $group_data = $this->queries->get_groupDataone($group_id);
        $total_loan_group = $this->queries->get_total_loanGroup($comp_id,$group_id);
        $total_depost_group = $this->queries->get_total_depostGroup($comp_id,$group_id);
        $compdata = $this->queries->get_companyData($comp_id);
        // print_r($loan_pending);
        //      exit();
        
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8','format' => 'A4-L','orientation' => 'L']);
        $html = $this->load->view('oficer/print_loan_group',['compdata'=>$compdata,'group_data'=>$group_data,'loan_pending'=>$loan_pending,'total_loan_group'=>$total_loan_group,'total_depost_group'=>$total_depost_group],true);
        $mpdf->SetFooter('Generated By Brainsoft Technology');
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function update_customerID(){
     $folder_Path = 'assets/upload/';

        // print_r($_POST['image']);
        // die();
        
        if(isset($_POST['image']) ){
           $customer_id = $_POST['id'];
           $image = $_POST['image'];
             // $_POST['id'];
            // print_r($customer_id);
            //     die();
             
             $image_parts = explode(";base64,",$_POST['image']);
             $image_type_aux = explode("image/",$image_parts[0]);

             $image_type = $image_type_aux[1];
             $data = $_POST['image'];// base64_decode($image_parts[1]);


            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
             
             $file = $folder_Path .uniqid() .'.png';
            file_put_contents($file, $data);
    
            $this->update_customer_profile($file,$customer_id);
            echo json_encode("Passport uploaded Successfully");
           
        }
    }

    public function update_customer_profile($file,$customer_id){
    $sqldata="UPDATE `tbl_sub_customer` SET `passport`= '$file' WHERE `customer_id`= '$customer_id'";
   $query = $this->db->query($sqldata);
   return true;
   }











// function sendsms($phone,$massage){
//     //$phone = "255753871034";
//     //$massage = "haloo there pokea salaam";
//     $address = array("from"=>"FOURTY TWO","to"=>$phone,"text"=>$massage);
//     $curl = curl_init();
//     curl_setopt_array($curl, array(
//     CURLOPT_URL => 'https://messaging-service.co.tz/api/sms/v1/text/single',
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_ENCODING => '',
//     CURLOPT_MAXREDIRS => 10,
//     CURLOPT_TIMEOUT => 0,
//     CURLOPT_FOLLOWLOCATION => true,
//     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//     CURLOPT_CUSTOMREQUEST => 'POST',
//     CURLOPT_POSTFIELDS => json_encode($address),
//     CURLOPT_HTTPHEADER => array(
//         'Authorization: Basic Rk9VUlRZVFdPOmZvdXJ0eTEyMw==',
//         'Content-Type: application/json',
//         'Accept: application/json'
//     ),
//     ));

// $response = curl_exec($curl);
// curl_close($curl);
// //echo $response;
// return true;
// }

public function sendsms($phone,$massage){
    //public function sendsms(){
    //$phone = '255628323760';
    //$massage = 'mapenzi yanauwa';
    $api_key = 'hnqX1Idsgj3pzbnLo/OzisIuIO';
    //$api_key = 'qFzd89PXu1e/DuwbwxOE5uUBn6';
    //$curl = curl_init();
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,"https://galadove.mikoposoft.com/api/v1/receive/action/send/sms");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            'apiKey='.$api_key.'&phoneNumber='.$phone.'&messageContent='.$massage);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close ($ch);
//print_r($server_output);
}



        //session destroy
      public function __construct(){
        parent::__construct();
        $lang = ($this->session->userdata('lang')) ?
        $this->session->userdata('lang') : config_item('language');
        $this->lang->load('menu',$lang);
        if (!$this->session->userdata("empl_id"))
            return redirect("welcome/employee_login");
}  
}