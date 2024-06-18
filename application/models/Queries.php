<?php
class Queries extends CI_Model {
	public function insert_region($data){
		return $this->db->insert('tbl_region',$data);
	}

	public function get_loan_start_penart($loan_id){
		$data = $this->db->query("SELECT * FROM tbl_loans WHERE loan_id = '$loan_id'");
		 return $data->row();
	}

	public function update_penart($loan_id,$penat_status){
		return $this->db->where('loan_id',$loan_id)->update('tbl_loans',$penat_status);
	}

  public function insert_penalt_reason($data){
  	return $this->db->insert('tbl_penart_leason',$data);
  }
	
	public function get_region(){
		$data = $this->db->query("SELECT * FROM tbl_region");
		  return $data->result();
	}

	public function insert_company_data($data){
		return $this->db->insert('tbl_company',$data);
	}

	public function insert_blanch($data){
		return $this->db->insert('tbl_blanch',$data);
	}

	public function get_blanch($comp_id){
		$blanch = $this->db->query("SELECT * FROM tbl_blanch JOIN tbl_region ON tbl_region.region_id = tbl_blanch.region_id WHERE comp_id = '$comp_id'");
		return $blanch->result();
	}


	public function get_blanchMyBlanch($blanch_id){
		$blanch = $this->db->query("SELECT * FROM tbl_blanch JOIN tbl_region ON tbl_region.region_id = tbl_blanch.region_id WHERE blanch_id = '$blanch_id'");
		return $blanch->result();
	}


public function insert_shareHolder($data){
	return $this->db->insert('tbl_share_holder',$data);
}


public function get_shareHolder($comp_id){
	$share = $this->db->query("SELECT * FROM tbl_share_holder WHERE comp_id = '$comp_id'");
	 return $share->result();
}

public function insert_capital($data){
	return $this->db->insert('tbl_capital',$data);
}


public function get_capital($comp_id){
	$cap = $this->db->query("SELECT * FROM tbl_capital c JOIN tbl_share_holder s ON s.share_id = c.share_id JOIN tbl_account_transaction at ON at.trans_id = c.pay_method  WHERE c.comp_id = '$comp_id' GROUP BY c.share_id ");
	  return $cap->result();
}

public function get_share_account_capital($share_id){
	$data = $this->db->query("SELECT * FROM tbl_capital c JOIN tbl_account_transaction at ON at.trans_id = c.pay_method WHERE c.share_id = '$share_id'");
	return $data->result();
}


public function get_total_capital_share($share_id){
	$data = $this->db->query("SELECT SUM(amount) AS total_amount FROM tbl_capital WHERE share_id  = '$share_id'");
	return $data->result();
}


public function get_total_capital_company($comp_id){
	$data = $this->db->query("SELECT SUM(comp_balance) AS total_compCapital FROM tbl_ac_company WHERE comp_id = '$comp_id'");
	return $data->row();
}

public function get_capital_share_list($capital_id){
	$data = $this->db->query("SELECT * FROM tbl_capital WHERE capital_id = '$capital_id'");
	return $data->row();
}

public function get_total_comp_capital($comp_id,$payment_method){
	$data = $this->db->query("SELECT * FROM tbl_ac_company WHERE comp_id = '$comp_id' AND trans_id = '$payment_method'");
	return $data->row();
}

public function remove_share_capital($capital_id){
	return $this->db->delete('tbl_capital',['capital_id'=>$capital_id]);
}



public function get_total_capital($comp_id){
	 $total = $this->db->query("SELECT SUM(amount) AS totalCapital FROM tbl_capital WHERE comp_id = '$comp_id'");
	  return $total->row();
}

public function insert_position($data){
	return $this->db->insert('tbl_position',$data);
}

public function get_position(){
	$pos = $this->db->query("SELECT * FROM tbl_position");
	 return $pos->result();
}


public function update_position($data,$position_id){
	return $this->db->where('position_id',$position_id)->update('tbl_position',$data);
}

public function remove_position($position_id){
	return $this->db->delete('tbl_position',['position_id'=>$position_id]);
}


public function update_blanch($data,$blanch_id){
	return $this->db->where('blanch_id',$blanch_id)->update('tbl_blanch',$data);
}

public function remove_blanch($blanch_id){
	return $this->db->delete('tbl_blanch',['blanch_id'=>$blanch_id]);
}


public function update_shareHolder($data,$share_id){
	return $this->db->where('share_id',$share_id)->update('tbl_share_holder',$data);
}

public function remove_shareHolder($share_id){
	return $this->db->delete('tbl_share_holder',['share_id'=>$share_id]);
}

public function insert_employee($data){
	return $this->db->insert('tbl_employee',$data);
}

public function get_employee($comp_id){
	$empl = $this->db->query("SELECT * FROM tbl_employee e JOIN tbl_blanch b  ON b.blanch_id = e.blanch_id JOIN tbl_position p ON p.position_id = e.position_id WHERE e.comp_id = '$comp_id' AND e.ac_status = 'empl' ORDER BY e.empl_id DESC LIMIT 2");
	  return $empl->result();
}

public function get_Allemployee($comp_id){
	$empl = $this->db->query("SELECT * FROM tbl_employee e JOIN tbl_blanch b  ON b.blanch_id = e.blanch_id JOIN tbl_position p ON p.position_id = e.position_id WHERE e.comp_id = '$comp_id' AND e.ac_status = 'empl' ORDER BY e.empl_id DESC");
	  return $empl->result();
}

public function get_AllemployeeBlanch($blanch_id){
	$empl = $this->db->query("SELECT * FROM tbl_employee e JOIN tbl_blanch b  ON b.blanch_id = e.blanch_id JOIN tbl_position p ON p.position_id = e.position_id WHERE e.blanch_id = '$blanch_id' AND e.ac_status = 'empl' ORDER BY e.empl_id DESC");
	  return $empl->result();
}

public function get_employee_admin_privillage($empl_id){
  	$data = $this->db->query("SELECT * FROM tbl_admin_privillage WHERE empl_id = '$empl_id'");
  	return $data->result();
  }




public function view_employee($empl_id){
	$empl = $this->db->query("SELECT * FROM tbl_employee e JOIN tbl_blanch b ON b.blanch_id = e.blanch_id WHERE e.empl_id = '$empl_id'");
	  return $empl->row();
}

public function get_myprivillage($empl_id){
	$data = $this->db->query("SELECT * FROM tbl_privellage pr JOIN tbl_position p ON p.position_id = pr.position_id WHERE pr.empl_id = '$empl_id'");
	return $data->result();
}

public function get_blanchEmployee($blanch_id){
	$empl = $this->db->query("SELECT * FROM tbl_employee e JOIN tbl_blanch b  ON b.blanch_id = e.blanch_id JOIN tbl_position p ON p.position_id = e.position_id WHERE e.blanch_id = '$blanch_id' ORDER BY e.empl_id DESC");
	 return $empl->result();
}

public function insert_leave($data){
	return $this->db->insert('tbl_leave',$data);
}

public function get_all_leave($comp_id){
	$leave = $this->db->query("SELECT * FROM tbl_leave l JOIN tbl_employee e ON e.empl_id = l.empl_id JOIN tbl_blanch b ON b.blanch_id = e.blanch_id JOIN tbl_position p ON p.position_id = e.position_id WHERE l.comp_id = '$comp_id'");
	   return $leave->result();
}

public function insert_loanCategory($data){
	return $this->db->insert('tbl_loan_category',$data);
}

public function get_loancategory($comp_id){
	$loan = $this->db->query("SELECT * FROM tbl_loan_category WHERE comp_id = '$comp_id'");
	 return $loan->result();
}

public function get_loancategoryData($category_id){
	$loan = $this->db->query("SELECT * FROM tbl_loan_category WHERE category_id = '$category_id'");
	 return $loan->row();
}

public function insert_customer($data){
	$this->db->insert('tbl_customer',$data);
	 return $this->db->insert_id();
}

public function get_admin_role($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_company WHERE comp_id = '$comp_id'");
	 return $data->row();
}


public function get_customer_data($customer_id){
	$customer = $this->db->query("SELECT c.customer_id,c.blanch_id,c.comp_id,c.empl_id,e.empl_name,c.customer_day,sb.passport FROM tbl_customer c LEFT JOIN tbl_employee e ON e.empl_id = c.empl_id LEFT JOIN tbl_sub_customer sb ON sb.customer_id = c.customer_id  WHERE c.customer_id = $customer_id");
	  return $customer->row();
}

public function get_customerDataLOANform($customer_id){
	$customer = $this->db->query("SELECT * FROM tbl_customer c JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id JOIN tbl_account_type at ON at.account_id = sc.account_id  WHERE c.customer_id = $customer_id");
	  return $customer->row();
}

public function insert_customerData($data){
	return $this->db->insert('tbl_sub_customer',$data);
}

public function get_allcutomer($comp_id){
	$customer = $this->db->query("SELECT c.customer_id,c.f_name,c.m_name,c.l_name,c.date_birth,c.age,c.gender,c.phone_no,b.blanch_id,c.street,c.ward,c.district,c.customer_status,c.customer_code,b.blanch_name FROM tbl_customer c LEFT JOIN tbl_region r ON r.region_id = c.region_id LEFT JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id LEFT JOIN tbl_account_type at ON at.account_id = sc.account_id LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id WHERE c.comp_id = '$comp_id' ORDER BY c.customer_id DESC");
	  return $customer->result(); 
	}

	public function get_cutomerBlanchData($blanch_id){
	$customer = $this->db->query("SELECT * FROM tbl_customer c JOIN tbl_region r ON r.region_id = c.region_id JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id JOIN tbl_account_type at ON at.account_id = sc.account_id JOIN tbl_blanch b ON b.blanch_id = c.blanch_id WHERE c.blanch_id = '$blanch_id' ORDER BY c.customer_id DESC");
	  return $customer->result(); 
	}

	public function get_customer_blanch($blanch_id){
	$customer = $this->db->query("SELECT c.f_name,c.m_name,c.l_name,c.customer_code,c.date_birth,c.age,c.gender,c.phone_no,c.district,c.ward,c.district,c.customer_status,c.reg_date,c.street,c.customer_id FROM tbl_customer c LEFT JOIN tbl_region r ON r.region_id = c.region_id LEFT JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id LEFT JOIN tbl_account_type at ON at.account_id = sc.account_id LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id WHERE c.blanch_id = '$blanch_id' ORDER BY c.customer_id DESC");
	  return $customer->result(); 
	}

	public function get_allcutomerblanchData($blanch_id){
	$customer = $this->db->query("SELECT c.customer_id,c.f_name,c.m_name,c.l_name,c.comp_id,c.customer_code FROM tbl_customer c LEFT JOIN tbl_region r ON r.region_id = c.region_id LEFT JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id LEFT JOIN tbl_account_type at ON at.account_id = sc.account_id LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id WHERE c.blanch_id = '$blanch_id' ORDER BY c.customer_id DESC"); 
	return $customer->result();
	}

	public function get_allcustomerData($comp_id){
	$customer = $this->db->query("SELECT c.customer_id,c.f_name,c.m_name,c.l_name,c.comp_id,c.customer_code FROM tbl_customer c LEFT JOIN tbl_region r ON r.region_id = c.region_id LEFT JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id LEFT JOIN tbl_account_type at ON at.account_id = sc.account_id LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id WHERE c.comp_id = '$comp_id' ORDER BY c.customer_id DESC"); 
	return $customer->result(); 
	}

		public function get_allcustomerDatagroup($comp_id){
	$customer = $this->db->query("SELECT c.customer_id,c.f_name,c.m_name,c.l_name,c.comp_id,c.customer_code FROM tbl_customer c LEFT JOIN tbl_region r ON r.region_id = c.region_id LEFT JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id LEFT JOIN tbl_account_type at ON at.account_id = sc.account_id LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id WHERE c.comp_id = '$comp_id' ORDER BY c.customer_id DESC"); 
	return $customer->result(); 
	}



	public function get_allcutomerBlanch_Data($blanch_id){
	$customer = $this->db->query("SELECT * FROM tbl_customer c JOIN tbl_region r ON r.region_id = c.region_id JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id JOIN tbl_account_type at ON at.account_id = sc.account_id JOIN tbl_blanch b ON b.blanch_id = c.blanch_id WHERE c.blanch_id = '$blanch_id' ORDER BY c.customer_id DESC");
	  return $customer->result(); 
	}

	public function update_capital($data,$capital_id){
		return $this->db->where('capital_id',$capital_id)->update('tbl_capital',$data);
	}

	public function remove_capital($capital_id){
		return $this->db->delete('tbl_capital',['capital_id'=>$capital_id]);
	}

	public function get_capital_balance($capital_id){
		$data = $this->db->query("SELECT * FROM tbl_capital WHERE capital_id = '$capital_id'");
		 return $data->row();
	}


	public function get_customer_profileData($customer_id){
		$customer = $this->db->query("SELECT c.customer_id,c.f_name,c.l_name,c.m_name,c.phone_no,c.phone_no,r.region_id,r.region_name,sb.passport,sb.signature,b.blanch_id,b.blanch_name,c.date_birth,c.age,c.district,c.ward,c.street,e.empl_id,e.empl_name,c.empl_id,c.gender,ac.account_name,sb.account_id,sb.famous_area,sb.martial_status,sb.id_type,sb.natinal_identity,sb.work_status,sb.bussiness_type,sb.place_imployment,sb.month_income,sb.number_dependents FROM tbl_customer c  LEFT JOIN tbl_sub_customer sb  ON sb.customer_id = c.customer_id LEFT JOIN tbl_region r ON r.region_id = c.region_id LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id LEFT JOIN tbl_account_type ac ON ac.account_id = sb.account_id LEFT JOIN tbl_employee e ON e.empl_id = c.empl_id WHERE c.customer_id = '$customer_id'");
		   return $customer->row();
	}

	public function update_customer_info($data,$customer_id){
		return $this->db->where('customer_id',$customer_id)->update('tbl_customer',$data);
	}

	public function edit_customer($customer_id){
		$customer = $this->db->query("SELECT * FROM tbl_customer WHERE customer_id = '$customer_id'");
		 return $customer->row();
	}

	public function update_customer($customer_id,$data){
		return $this->db->where('customer_id',$customer_id)->update('tbl_customer',$data);
	}


	public function insert_account($data){
		return $this->db->insert('tbl_account_type',$data);
	}

	public function get_accountTYpe(){
		$account = $this->db->query("SELECT * FROM tbl_account_type");
		  return $account->result();
	}



	  public function search_CustomerID($customer_id,$comp_id){
        	$data = $this->db->query("SELECT c.customer_id,c.comp_id,c.blanch_id,c.empl_id,c.customer_code,c.f_name,c.m_name,c.l_name,c.gender,c.date_birth,c.phone_no,e.empl_name,b.blanch_name,c.district,c.ward,c.street,c.member_status,sc.passport FROM tbl_customer c LEFT JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id LEFT JOIN tbl_account_type at ON at.account_id = sc.account_id LEFT JOIN tbl_company ca ON ca.comp_id = c.comp_id LEFT JOIN tbl_employee e ON e.empl_id = c.empl_id WHERE c.customer_id = '$customer_id' AND c.comp_id = '$comp_id'");
        	return $data->row();
        }



        public function insert_sponser_info($data){
        	return$this->db->insert('tbl_sponser',$data);
        }



	        // search customer blanch-----
    public function search_CustomerID_Blanch($customer_code,$comp_id,$blanch_id){
      $this->db->select('c.customer_id,c.comp_id,c.blanch_id,c.empl_id,c.customer_code,c.f_name,c.m_name,c.l_name,c.gender,c.date_birth,c.phone_no,c.region_id,c.district,c.ward,c.street,sc.id,sc.natinal_identity,sc.bussiness_type,sc.number_dependents,sc.place_imployment,sc.month_income,sc.customer_id,sc.account_id,sc.famous_area,sc.martial_status,sc.signature,sc.bussiness_type,sc.passport,sc.signature,b.blanch_id,b.comp_id,b.region_id,b.blanch_name,b.blanch_no,at.account_id,at.account_name');
      $this->db->like('c.customer_code',$customer_code);
      $this->db->like('c.comp_id',$comp_id);
      $this->db->like('c.blanch_id',$blanch_id);
      $this->db->JOIN('tbl_sub_customer sc','sc.customer_id = c.customer_id');
      $this->db->JOIN('tbl_blanch b','b.blanch_id = c.blanch_id');
      $this->db->JOIN('tbl_account_type at','at.account_id = sc.account_id');
      $this->db->JOIN('tbl_company ca','ca.comp_id = c.comp_id');
      $data = $this->db->get('tbl_customer c');
         return $data->row();
        }



        public function insert_sponser_data($data){
        	return $this->db->insert('tbl_sponser',$data);
        }


       public function insert_group($data){
       	return $this->db->insert('tbl_group',$data);
       }

       public function get_groupData($comp_id){
       	$group = $this->db->query("SELECT * FROM tbl_group g JOIN tbl_blanch b ON b.blanch_id = g.blanch_id WHERE g.comp_id = '$comp_id'");
       	 return $group->result();
       }



       

        public function get_groupDataBlanchData($blanch_id){
       	$group = $this->db->query("SELECT * FROM tbl_group g JOIN tbl_blanch b ON b.blanch_id = g.blanch_id WHERE g.blanch_id = '$blanch_id'");
       	 return $group->result();
       }

        public function get_groupDataBlanch($blanch_id){
       	$group = $this->db->query("SELECT * FROM tbl_group g JOIN tbl_blanch b ON b.blanch_id = g.blanch_id WHERE g.blanch_id = '$blanch_id'");
       	 return $group->result();
       }


       public function get_parsonalloan_pending($comp_id){
       	$data = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id WHERE l.comp_id = '$comp_id' AND l.group_id = 0");
       	   return $data->result();
       }

        public function get_parsonalloan_pendingBlanch($blanch_id){
       	$data = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id WHERE l.blanch_id = '$blanch_id' AND l.group_id = 0");
       	   return $data->result();
       }


       public function insert_loan($data){
       	 $this->db->insert('tbl_loans',$data);
       	 return $this->db->insert_id();
       }

       public function get_loanAttach($loan_id){
       	$attach = $this->db->query("SELECT * FROM tbl_loans WHERE loan_id = '$loan_id'");
       	 return $attach->row();
       }

 
       public function get_loanPending($comp_id){
       	$loan = $this->db->query("SELECT c.customer_id,c.f_name,c.m_name,c.l_name,l.loan_code,c.phone_no,b.blanch_name,l.how_loan,l.day,l.session,l.loan_status,l.loan_id,l.comp_id,l.renew_loan FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.loan_status = 'open'  AND l.comp_id = '$comp_id' AND l.group_id IS NOT TRUE ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }

         public function get_loan_request_Balnch($blanch_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_loan_category lt ON lt.category_id = l.category_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.loan_status = 'open'  AND l.blanch_id = '$blanch_id' ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }

       //  public function get_loanPendingBlanch($blanch_id){
       // 	$loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_loan_category lt ON lt.category_id = l.category_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.loan_status = 'open'  AND l.blanch_id = '$blanch_id' ORDER BY l.loan_id DESC ");
       // 	   return $loan->result();
       // }



        public function get_loanPendingBlanch($blanch_id){
       	$loan = $this->db->query("SELECT c.customer_id,c.f_name,c.m_name,c.l_name,l.loan_code,c.phone_no,b.blanch_name,l.how_loan,l.day,l.session,l.renew_loan,l.loan_status,l.loan_id,l.comp_id FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.loan_status = 'open'  AND l.blanch_id = '$blanch_id' AND l.group_id = '0' ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }

        public function get_total_loanPendingBlanch($blanch_id){
       	$loan = $this->db->query("SELECT SUM(how_loan) AS total_loan_request FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.loan_status = 'open'  AND l.blanch_id = '$blanch_id' AND l.group_id = '0' ORDER BY l.loan_id DESC ");
       	   return $loan->row();
       }

       


       public function get_loanPendingBlanch_group($group_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.loan_status = 'open'  AND l.group_id = '$group_id' AND l.group_id IS TRUE ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }

        public function get_loan_group_loan($blanch_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_group g ON g.group_id = l.group_id WHERE l.loan_status = 'open'  AND l.blanch_id = '$blanch_id' AND l.group_id IS TRUE GROUP BY l.group_id ");
       	   return $loan->result();
       }

       public function get_total_loan_group($blanch_id){
       	$data = $this->db->query("SELECT SUM(how_loan) AS total_loan_request_group FROM tbl_loans WHERE blanch_id = '$blanch_id' AND group_id IS TRUE AND loan_status = 'open'");
       	 return $data->row();
       }




        public function get_loanGroup($group_id,$comp_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id LEFT JOIN tbl_group g ON g.group_id = l.group_id  WHERE  l.group_id = '$group_id' AND l.comp_id = '$comp_id' ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }

        public function get_loanGroupBlanch($group_id,$blanch_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_loan_category lt ON lt.category_id = l.category_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_sub_customer s ON s.customer_id = l.customer_id JOIN tbl_group g ON g.group_id = l.group_id  WHERE  l.group_id = '$group_id' AND l.blanch_id = '$blanch_id' ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }


       public function get_groupDataone($group_id){
       	$data = $this->db->query("SELECT * FROM tbl_group WHERE group_id = '$group_id'");
       	  return $data->row();
       }




        public function get_loanCustomer($customer_id,$comp_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_loan_category lt ON lt.category_id = l.category_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_sub_customer s ON s.customer_id = l.customer_id JOIN tbl_group g ON g.group_id = l.group_id  JOIN tbl_region r ON r.region_id = c.region_id JOIN tbl_account_type at ON at.account_id = s.account_id  WHERE l.customer_id = '$customer_id' AND l.comp_id = '$comp_id' ORDER BY l.loan_id DESC LIMIT 1");
       	   return $loan->result();
       }

        public function get_loanData($customer_id,$comp_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  LEFT JOIN tbl_region r ON r.region_id = c.region_id LEFT JOIN tbl_account_type at ON at.account_id = s.account_id LEFT JOIN tbl_employee e ON e.empl_id = c.empl_id  WHERE l.customer_id = '$customer_id' AND l.comp_id = '$comp_id' ORDER BY l.loan_id DESC LIMIT 1");
       	   return $loan->row();
       }


       public function get_sponser_data($customer_id,$comp_id){
       	$sponser = $this->db->query("SELECT * FROM tbl_sponser WHERE customer_id = '$customer_id' AND comp_id = '$comp_id'");
       	  return $sponser->result();
       }


       public function get_loanform($customer_id,$comp_id){
       	$data = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_loan_category lc ON lc.category_id = l.category_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_group g ON g.group_id = l.group_id  WHERE l.customer_id = '$customer_id' AND l.comp_id = '$comp_id' ORDER BY l.loan_id DESC ");
       	return $data->row();
       }



       public function get_formloanData($customer_id,$comp_id){
       	$data = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_loan_category lc ON lc.category_id = l.category_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_customer c ON c.customer_id = l.customer_id  WHERE l.customer_id = '$customer_id' AND l.comp_id = '$comp_id' ORDER BY l.loan_id DESC LIMIT 1");
       	return $data->row();
       }


       public function get_customergroupdata($group_id,$comp_id){
       	$data = $this->db->query("SELECT * FROM tbl_loans WHERE group_id = $group_id AND comp_id = '$comp_id'");
       	  return $data->result();
       }


       public function get_customergroupdataBlanch($group_id,$blanch_id){
       	$data = $this->db->query("SELECT * FROM tbl_loans WHERE group_id = $group_id AND blanch_id = '$blanch_id'");
       	  return $data->result();
       }

       


       public function update_status($loan_id,$data){
       	return $this->db->where('loan_id',$loan_id)->update('tbl_loans',$data);
       }


       public function get_loanAproved($comp_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.comp_id = '$comp_id' AND l.loan_status = 'aproved' ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }

       public function get_aproved_loanBlabch($blanch_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_loan_category lt ON lt.category_id = l.category_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.blanch_id = '$blanch_id' AND l.loan_status = 'aproved' ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }

       public function get_loanAprovedBlanch($blanch_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.blanch_id = '$blanch_id' AND l.loan_status = 'aproved' ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }


       public function insert_loanfee($data){
       	return $this->db->insert('tbl_loan_fee',$data);
       }


       public function get_loanfee($comp_id){
       	$data = $this->db->query("SELECT * FROM tbl_loan_fee WHERE comp_id = '$comp_id'");
       	   return $data->result();
       }

       public function get_loanDisbarsed($loan_id){
       	  $data = $this->db->query("SELECT l.loan_id,l.code,l.blanch_id,l.group_id,l.comp_id,l.customer_id,l.loan_aprove,l.loan_code,l.day,l.session,c.comp_name,c.comp_phone,cs.phone_no FROM tbl_loans l JOIN tbl_company c ON c.comp_id = l.comp_id JOIN tbl_customer cs ON cs.customer_id = l.customer_id WHERE l.loan_id = '$loan_id'");
       	     return $data->row();
       }


       public function get_loanfeedata($customer_id){
       	$data = $this->db->query("SELECT * FROM tbl_pay p JOIN tbl_loan_fee lf ON lf.fee_id = p.fee_id JOIN tbl_loans l ON l.loan_id = p.loan_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id WHERE p.customer_id = '$cucustomer_id = '$customer_id' ORDER BY pay_id DESC");
       	   return $data->result();
       }
       //     public function get($customer_id){
       // 	$data = $this->db->query("SELECT * FROM tbl_pay p  JOIN tbl_loans l ON l.loan_id = p.loan_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id WHERE p.custom= '$customer_id' ORDER BY pay_id DESC");
       // 	   return $data->row();
       // }

       public function get_all_dataloan($customer_id){
       	$data = $this->db->query("SELECT * FROM tbl_pay WHERE customer_id = '$customer_id'");
       	    return $data->row();
       }

       public function get_data_notfeeid($customer_id){
       	$data = $this->db->query("SELECT * FROM tbl_pay WHERE fee_id IS NULL  AND customer_id = '$customer_id'");
       	    return $data->row();
       }


         public function get_DisbarsedLoan($comp_id){
        //$date = date("Y-m-d");
       	$loan = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.comp_id = '$comp_id' AND l.loan_status = 'disbarsed' ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }


         public function get_DisbarsedLoanBlanch_data($blanch_id){
        //$date = date("Y-m-d");
       	$loan = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id   WHERE l.blanch_id = '$blanch_id' AND l.loan_status = 'disbarsed' ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }




           public function get_withdrawal_Loan($comp_id){
        //$date = date("Y-m-d");
       	$loan = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id LEFT JOIN tbl_account_transaction at ON at.trans_id = l.method  WHERE l.comp_id = '$comp_id' AND l.loan_status = 'withdrawal' ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }

          public function get_withdrawal_LoanBlanch($blanch_id){
        $date = date("Y-m-d");
       	$loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_loan_category lt ON lt.category_id = l.category_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_sub_customer s ON s.customer_id = l.customer_id JOIN tbl_outstand ot ON ot.loan_id = l.loan_id  WHERE l.blanch_id = '$blanch_id' AND l.loan_status = 'withdrawal' ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }

           public function get_DisbarsedLoanBlanch($blanch_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.blanch_id = '$blanch_id' AND l.loan_status = 'disbarsed'  ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }



	        // search-----
    // public function search_CustomerLoan($customer_id){
    // 	  $this->db->cache_on();
    //     $data = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id LEFT JOIN tbl_company cp ON cp.comp_id = c.comp_id JOIN tbl_blanch b ON b.blanch_id = c.blanch_id  WHERE l.customer_id = '$customer_id'ORDER BY l.loan_id DESC LIMIT 1 ");
    //     return $data->row();
    //     $this->db->cache_off();
    //  }

     public function search_CustomerLoan($customer_id){
    	$data = $this->db->query("SELECT c.customer_id,c.comp_id,c.blanch_id,c.customer_code,c.f_name,c.m_name,c.l_name,c.gender,c.date_birth,c.phone_no,c.district,c.ward,c.street,sc.passport FROM tbl_customer c LEFT JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id WHERE c.customer_id = '$customer_id' LIMIT 1");
    	return $data->row();
     }

      public function get_loan_account_statement($loan_id){
     	$data = $this->db->query("SELECT l.loan_id,l.loan_int,l.restration,l.customer_id,ot.loan_stat_date,ot.loan_end_date,l.loan_status,l.day FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id  WHERE l.loan_id = '$loan_id' LIMIT 1");
     	return $data->row();
     }

     public function get_total_pay_description_acount_statement($loan_id){
     $data = $this->db->query("SELECT * FROM tbl_pay p LEFT JOIN tbl_loans l ON l.loan_id = p.loan_id LEFT JOIN tbl_account_transaction at ON at.trans_id = p.p_method WHERE p.loan_id = '$loan_id' ORDER BY p.pay_id DESC");
     return $data->result(
     );
     }

      public function get_loan_schedule_customer($loan_id){
   	$loan = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id LEFT JOIN tbl_account_transaction at ON at.trans_id = l.method  WHERE l.loan_id = '$loan_id' ");
       return $loan->row();
   }


     public function get_loan_active_customer($customer_id){
     	$data = $this->db->query("SELECT l.loan_id,l.loan_int,l.restration,l.session ,l.customer_id,ot.loan_stat_date,ot.loan_end_date,l.loan_status,l.day,l.comp_id,l.blanch_id FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id  WHERE l.customer_id = '$customer_id' ORDER BY l.loan_id DESC LIMIT 1");
     	return $data->row();
     }

     public function get_loan_active_customer_group($loan_id){
     	$data = $this->db->query("SELECT l.loan_id,l.loan_int,l.restration,l.customer_id,ot.loan_stat_date,ot.loan_end_date,l.loan_status,l.day,l.comp_id,l.blanch_id FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id  WHERE l.loan_id = '$loan_id' LIMIT 1");
     	return $data->row();
     }


     public function get_total_pay_description($loan_id){
     $data = $this->db->query("SELECT * FROM tbl_pay p LEFT JOIN tbl_loans l ON l.loan_id = p.loan_id LEFT JOIN tbl_account_transaction at ON at.trans_id = p.p_method WHERE p.loan_id = '$loan_id' ORDER BY p.pay_id DESC LIMIT 5");
     return $data->result();
     }


     public function get_total_amount_paid_loan($loan_id){
     	$data = $this->db->query("SELECT SUM(depost) AS total_Deposit,SUM(double_amont) AS total_double FROM tbl_depost WHERE loan_id = '$loan_id' LIMIT 1");
     	return $data->row();
     }





                // search-----customer leport
    public function search_CustomerLoan_report($customer_id,$comp_id){
      $this->db->select('c.customer_id,c.comp_id,c.blanch_id,c.empl_id,c.customer_code,c.f_name,c.m_name,c.	l_name,c.gender,c.date_birth,c.phone_no,c.region_id,c.district,c.ward,c.street,c.	customer_status,c.customer_day,sc.id AS ids,sc.customer_id,sc.account_id,sc.famous_area,sc.martial_status,sc.natinal_identity,sc.bussiness_type,sc.number_dependents,sc.place_imployment,sc.month_income,sc.passport,sc.signature,b.blanch_id,b.	comp_id,b.region_id,b.blanch_name,b.blanch_no,b.balanch_date,at.account_id,at.account_name,l.loan_id,l.comp_id,l.blanch_id,l.customer_id,l.category_id,l.empl_id,l.loan_code,l.group_id,l.how_loan,l.day,l.session,l.reason,l.loan_status,l.fee_status,l.loan_aprove,l.region_id,l.loan_day,lc.category_id,lc.loan_name,lc.comp_id,lc.interest_formular,cr.rep_id,cr.comp_id,cr.blanch_id,cr.customer_id,cr.loan_id,cr.recevable_amount,cr.pending_amount,cr.penart_amount,rep_date');
 
      $this->db->like('c.customer_id',$customer_id);
      $this->db->like('c.comp_id',$comp_id);
      $this->db->JOIN('tbl_sub_customer sc','sc.customer_id = c.customer_id');
      $this->db->JOIN('tbl_blanch b','b.blanch_id = c.blanch_id');
      $this->db->JOIN('tbl_account_type at','at.account_id = sc.account_id');
      $this->db->JOIN('tbl_customer_report cr','cr.customer_id = c.customer_id');
      $this->db->JOIN('tbl_loans l','l.customer_id = c.customer_id');
      $this->db->JOIN('tbl_loan_category lc','lc.category_id = l.category_id');
      $data = $this->db->get('tbl_customer c');
         return $data->row();
        }

        public function get_customer_loanReport($customer_id){
        	$data_report = $this->db->query("SELECT * FROM tbl_customer_report cr JOIN tbl_loans l ON l.loan_id = cr.loan_id WHERE cr.customer_id = '$customer_id' ORDER BY cr.rep_id DESC");
        	return $data_report->result();
        }


        public function get_sum_receivableAmountCustomer($customer_id){
        	$data = $this->db->query("SELECT SUM(recevable_amount) AS total_recevable FROM tbl_customer_report WHERE customer_id = '$customer_id'");
        	return $data->row();
        }

        public function get_sumPending_Amount($customer_id){
        	$data = $this->db->query("SELECT SUM(pending_amount) AS TotalPending FROM tbl_customer_report WHERE customer_id = '$customer_id'");
        	return $data->row();
        }

        public function get_penart_amount_total($customer_id){
        	$penart = $this->db->query("SELECT SUM(penart_amount) AS total_penart FROM tbl_customer_report WHERE customer_id = '$customer_id'");
        	 return $penart->row();
        }


     //teller dashboard blanch customer

            public function search_CustomerLoanBlanch($fname,$m_name,$comp_id,$blanch_id){
      $this->db->select('c.customer_id,c.comp_id,c.blanch_id,c.empl_id,c.customer_code,c.f_name,c.m_name,c.	l_name,c.gender,c.date_birth,c.phone_no,c.region_id,c.district,c.ward,c.street,c.	customer_status,c.customer_day,sc.id AS ids,sc.customer_id,sc.account_id,sc.famous_area,sc.martial_status,sc.natinal_identity,sc.bussiness_type,sc.number_dependents,sc.place_imployment,sc.month_income,sc.passport,sc.signature,b.blanch_id,b.	comp_id,b.region_id,b.blanch_name,b.blanch_no,b.balanch_date,at.account_id,at.account_name,p.pay_id,p.comp_id,p.fee_id,p.blanch_id,p.empl_id,p.customer_id,p.loan_id,l.loan_id,l.comp_id,l.blanch_id,l.customer_id,l.category_id,l.empl_id,l.loan_code,l.group_id,l.how_loan,l.day,l.session,l.reason,l.collateral,l.name_oficer,l.oficer_no,l.loan_status,l.fee_status,l.loan_aprove,l.region_id,l.gov_district,l.gov_ward,l.gov_street,l.loan_day,lc.category_id,lc.loan_name,lc.comp_id,lc.interest_formular');
      $this->db->like('c.f_name',$fname);
      $this->db->like('c.m_name',$m_name);
      $this->db->like('c.comp_id',$comp_id);
      $this->db->like('c.comp_id',$blanch_id);
      $this->db->JOIN('tbl_sub_customer sc','sc.customer_id = c.customer_id');
      $this->db->JOIN('tbl_blanch b','b.blanch_id = c.blanch_id');
      $this->db->JOIN('tbl_account_type at','at.account_id = sc.account_id');
      $this->db->JOIN('tbl_pay p','p.customer_id = c.customer_id');
      $this->db->JOIN('tbl_loans l','l.customer_id = c.customer_id');
      $this->db->JOIN('tbl_loan_category lc','lc.category_id = l.category_id');
      $data = $this->db->get('tbl_customer c');
         return $data->row();
        }

public function get_totalLoanDisburese($customer_id){
	$total_loan = $this->db->query("SELECT * FROM tbl_loans WHERE customer_id = '$customer_id' AND loan_status = 'disbarsed' ORDER BY loan_id DESC");
	  return $total_loan->row();
}
public function get_totalLoanALL($customer_id){
	$total_loan = $this->db->query("SELECT * FROM tbl_loans l  WHERE l.customer_id = '$customer_id' ORDER BY l.loan_id DESC");
	  return $total_loan->row();
}

public function get_totalLoanALLDta($customer_id){
	$total_loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE l.customer_id = '$customer_id' ORDER BY l.loan_id DESC");
	  return $total_loan->row();
}

public function get_totalLoanwithdrawal($customer_id){
	$total_loan = $this->db->query("SELECT * FROM tbl_loans WHERE customer_id = '$customer_id' AND loan_status = 'withdrawal' ORDER BY loan_id DESC");
	  return $total_loan->row();
}

public function get_loan_check($customer_id){
	$total_loan = $this->db->query("SELECT * FROM tbl_loans WHERE customer_id = '$customer_id' ORDER BY loan_id DESC");
	  return $total_loan->row();
}

public function get_totalLoanDone($customer_id){
	$total_loan = $this->db->query("SELECT * FROM tbl_loans WHERE customer_id = '$customer_id' AND loan_status = 'done' ORDER BY loan_id DESC");
	  return $total_loan->row();
}



public function get_totalLoanout($customer_id){
	$total_loan = $this->db->query("SELECT * FROM tbl_loans WHERE customer_id = '$customer_id' AND loan_status = 'out' ORDER BY loan_id DESC");
	  return $total_loan->row();
}


        public function get_sum_withdrow($loan_id){
        	$data = $this->db->query("SELECT SUM(withdrow) AS withdrow_data FROM tbl_pay WHERE loan_id = '$loan_id'");
        	   return $data->row();
        }

        public function get_paydata($loan_id){
        	$data = $this->db->query("SELECT * FROM tbl_pay JOIN tbl_loan_fee ON tbl_loan_fee.fee_id = tbl_pay.fee_id WHERE loan_id = '$loan_id'");
        	  return $data->result();
        }


        public function get_paycustomer($customer_id){
        	$customer_pay = $this->db->query("SELECT * FROM tbl_pay p  JOIN tbl_loans l ON l.loan_id = p.loan_id JOIN tbl_loan_fee lf ON lf.fee_id = p.fee_id WHERE p.customer_id = '$customer_id' ORDER BY p.pay_id DESC");
        	  return $customer_pay->result();
        }
         public function get_paycustomerNotfee($customer_id){
        	$customer_pay = $this->db->query("SELECT * FROM tbl_pay p LEFT JOIN tbl_loans l ON l.loan_id = p.loan_id LEFT JOIN tbl_account_transaction at ON at.trans_id = p.p_method WHERE p.customer_id = '$customer_id' ORDER BY p.pay_id DESC LIMIT 5");
        	  return $customer_pay->result();
        }


         public function get_data_searchCustomer($customer_id,$comp_id){
        	$data = $this->db->query("SELECT * FROM tbl_customer c JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id JOIN tbl_blanch b ON b.blanch_id = c.blanch_id JOIN tbl_account_type at ON at.account_id = sc.account_id WHERE c.customer_id = '$customer_id' AND c.comp_id = '$comp_id' ");
        	  return $data->row();
        }

           public function get_data_searchCustomerPay($customer_id){
        	$data = $this->db->query("SELECT * FROM tbl_customer c JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id JOIN tbl_blanch b ON b.blanch_id = c.blanch_id JOIN tbl_account_type at ON at.account_id = sc.account_id JOIN tbl_loans l ON l.customer_id = c.customer_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id  WHERE c.customer_id = '$customer_id'");
        	  return $data->row();
        }

        public function get_remainbalance($customer_id){
        	$data = $this->db->query("SELECT p.balance,p.customer_id FROM tbl_pay p WHERE p.customer_id = '$customer_id' ORDER BY pay_id DESC LIMIT 1");
        	 return $data->row();
        }

        public function get_customer_Loandata($customer_id){
        $data = $this->db->query("SELECT * FROM tbl_pay p JOIN tbl_loans l ON l.loan_id = p.loan_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id  WHERE p.customer_id = '$customer_id' ORDER BY pay_id DESC LIMIT 1");
        	 return $data->row();
        }


         public function get_loan_LoandataAutomatic($loan_id){
        $data = $this->db->query("SELECT * FROM tbl_pay p LEFT JOIN tbl_loans l ON l.loan_id = p.loan_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id LEFT JOIN tbl_penat pe ON pe.comp_id = l.comp_id LEFT JOIN tbl_outstand o ON o.loan_id = l.loan_id  WHERE p.loan_id = '$loan_id' ORDER BY p.pay_id DESC");
        	 return $data->row();
        }


           public function get_customer_LoandataAutomaticALL(){
        $data = $this->db->query("SELECT * FROM tbl_customer");
        	 return $data->result();
        }


        public function get_sumDepost_loan($customer_id){
        	$sum = $this->db->query("SELECT SUM(depost) AS total_deposit FROM tbl_pay WHERE   fee_id  IS NULL AND customer_id = '$customer_id'");
        	 return $sum->row();
        }


        public function get_loan_rejectData($loan_id){
        	$data = $this->db->query("SELECT loan_status FROM tbl_loans WHERE loan_id = '$loan_id'");
        	  return $data->row();
        }

        public function remove_loan($loan_id){
        	return $this->db->delete('tbl_loans',['loan_id'=>$loan_id]);
        }

        public function get_loan_reject($comp_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_loan_category lt ON lt.category_id = l.category_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.loan_status = 'reject'  AND l.comp_id = '$comp_id'  ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }

         public function get_loan_rejectBlanch($blanch_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_loan_category lt ON lt.category_id = l.category_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.loan_status = 'reject'  AND l.blanch_id = '$blanch_id'  ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }


       public function get_sum_loanDisbursed($comp_id){
       	
       	$total_loan_dis = $this->db->query("SELECT SUM(loan_aprove) AS total_loan FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'disbarsed'");
       	  return $total_loan_dis->row();
       }

        public function get_sum_loanDisbursed_blanch($blanch_id){
       	
       	$total_loan_dis = $this->db->query("SELECT SUM(loan_aprove) AS total_loan FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'disbarsed'");
       	  return $total_loan_dis->row();
       }

       public function get_sum_loanwithdrawal_data($comp_id){
       	$date = date("Y-m-d");
       	$total_loan_dis = $this->db->query("SELECT SUM(loan_aprove) AS total_loan FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'withdrawal'");
       	  return $total_loan_dis->row();
       }


       public function get_sum_loanwithdrawal_dataBlanch($blanch_id){
       	$date = date("Y-m-d");
       	$total_loan_dis = $this->db->query("SELECT SUM(loan_aprove) AS total_loan FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'withdrawal'");
       	  return $total_loan_dis->row();
       }

        public function get_sum_loanwithdrawal($comp_id){
       	$date = date("Y-m-d");
       	$total_loan_dis = $this->db->query("SELECT SUM(loan_aprove) AS total_loan FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'withdrawal'  AND loan_day >= '$date'");
       	  return $total_loan_dis->row();
       }

        public function get_sum_loanDisbursedBlanch($blanch_id){
       	
       	$total_loan_dis = $this->db->query("SELECT SUM(loan_aprove) AS total_loan FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'disbarsed'");
       	  return $total_loan_dis->row();
       }

       public function get_sum_loanDisburse_interest($comp_id){
       	
       	$total_loan_dis = $this->db->query("SELECT SUM(loan_int) AS total_loan_int FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'disbarsed'");
       	  return $total_loan_dis->row();
       }

       public function get_sum_loanDisburse_interest_blanch($blanch_id){
       	
       	$total_loan_dis = $this->db->query("SELECT SUM(loan_int) AS total_loan_int FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'disbarsed'");
       	  return $total_loan_dis->row();
       }

        public function get_sum_loanwithdrawal_interest($comp_id){
       	//$date = date("Y-m-d");
       	$total_loan_dis = $this->db->query("SELECT SUM(loan_int) AS total_loan_int FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'withdrawal'");
       	  return $total_loan_dis->row();
       }

         public function get_sum_loanwithdrawal_interestBlanch($blanch_id){
       	$total_loan_dis = $this->db->query("SELECT SUM(with_amount) AS total_loan_int FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'withdrawal'");
       	  return $total_loan_dis->row();
       }


        public function get_sum_loanDisburse_interestBlanch($blanch_id){
       
       	$total_loan_dis = $this->db->query("SELECT SUM(loan_int) AS total_loan_int FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'disbarsed'");
       	  return $total_loan_dis->row();
       }

       public function get_total_active($comp_id){
       	$data = $this->db->query("SELECT SUM(loan_aprove) AS withdrawal_data FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'withdrawal'");
       	return $data->row();
       }


       public function get_loanInterest($loan_id){
       	$data = $this->db->query("SELECT * FROM tbl_loans JOIN tbl_loan_category ON tbl_loan_category.category_id = tbl_loans.category_id WHERE loan_id = '$loan_id'");
       	     return $data->row();
       }


       public function insert_amount($data){
       	return $this->db->insert('tbl_transfor',$data);
       }

       public function get_amount_transfor($comp_id){
       	$day = date("Y-m-d");
       	$data = $this->db->query("SELECT t.trans_id AS transfor_id,t.comp_id,t.blanch_id,t.blanch_amount,t.trans_day,b.blanch_id,b.comp_id,b.region_id,b.blanch_name,b.blanch_no,at.account_name AS to_account,t.from_trans_id,t.to_trans_id,at.trans_id,tr.account_name AS from_account,t.charger  FROM tbl_transfor t JOIN tbl_blanch b ON b.blanch_id = t.blanch_id JOIN tbl_account_transaction at ON at.trans_id = t.to_trans_id JOIN tbl_account_transaction tr ON tr.trans_id = t.from_trans_id WHERE t.comp_id = '$comp_id' ORDER BY t.trans_id DESC");
       	  return $data->result();
       }


       public function update_amount($trans_id,$data){
       	return $this->db->where('trans_id',$trans_id)->update('tbl_transfor',$data);
       }

       public function remove_float($trans_id){
       	return $this->db->delete('tbl_transfor',['trans_id'=>$trans_id]);
       }


       public function get_sumFloat($comp_id){
       	$data = $this->db->query("SELECT SUM(blanch_amount) AS float FROM tbl_transfor WHERE comp_id = '$comp_id'");
       	  return $data->row();
       }

       public function get_today_float($comp_id){
       	$date = date("Y-m-d");
       	$float_today = $this->db->query("SELECT * FROM tbl_transfor WHERE comp_id = '$comp_id'AND trans_day >= '$date'");
       	return $float_today->row();
       }

        public function get_today_floatBlanch($blanch_id){
       	$float_today = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$blanch_id'");
       	return $float_today->row();
       }

       public function get_sumTodayDepost($comp_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(depost) AS total_depost FROM tbl_pay WHERE comp_id = '$comp_id' AND pay_status = '1' AND pay_day >= '$date'");
       	  return $data->row();
       }

        public function get_sumTodayDepostBlanch($blanch_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(depost) AS total_depost FROM tbl_pay WHERE blanch_id = '$blanch_id' AND pay_status = '1' AND pay_day >= '$date'");
       	  return $data->row();
       }

        public function get_sumTodayWithdrawal($comp_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(withdrow) AS total_withdraw FROM tbl_pay WHERE comp_id = '$comp_id' AND pay_status = '2' AND pay_day >= '$date'");
       	  return $data->row();
       }


         public function get_sumTodayWithdrawalBlanch($blanch_id){
       	   $date = date("Y-m-d");
          $data = $this->db->query("SELECT SUM(loan_aprove) AS total_withdraw FROM tbl_loans WHERE blanch_id = '$blanch_id' AND region_id = 'ok' AND disburse_day = '$date'");
         return $data->row();
       }

    


        public function get_sumTodayDepostCustomer($loan_id){
       	$data = $this->db->query("SELECT SUM(depost) AS total_depost_customer FROM tbl_pay WHERE loan_id = '$loan_id' AND pay_status = '1'");
       	  return $data->row();
       }


       public function get_allcutomerBlanch($blanch_id){
	$customer = $this->db->query("SELECT * FROM tbl_customer c JOIN tbl_region r ON r.region_id = c.region_id JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id JOIN tbl_blanch b ON b.blanch_id = c.blanch_id WHERE c.blanch_id = '$blanch_id' ORDER BY c.customer_id DESC ");
	  return $customer->result(); 
	}

	public function view_blanchDetail($blanch_id){
	$blanch = $this->db->query("SELECT * FROM tbl_blanch WHERE blanch_id = '$blanch_id'");
	   return $blanch->row();

	}

	public function get_blanch_account($blanch_id){
		$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$blanch_id'");
		 return $data->row();
	}


	public function get_customer($customer_id){
		$data = $this->db->query("SELECT * FROM tbl_customer WHERE customer_id = '$customer_id'");
		 return $data->row();
	}

	public function remove_customer($customer_id){
		return $this->db->delete('tbl_customer',['customer_id'=>$customer_id]);
	}


	public function get_cash_transaction($comp_id){
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT * FROM tbl_prev_lecod pr LEFT JOIN tbl_customer c ON c.customer_id = pr.customer_id LEFT JOIN tbl_blanch b ON b.blanch_id = pr.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = pr.empl_id WHERE pr.comp_id = '$comp_id' AND date(pr.time_rec) = '$date' ORDER BY prev_id DESC");
		 return $data->result();
	}

	public function get_cash_transaction_sum($comp_id){
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT SUM(pr.loan_aprov) AS total_aprove,SUM(pr.depost) AS total_deposit,SUM(pr.double_dep) AS total_double FROM tbl_prev_lecod pr LEFT JOIN tbl_customer c ON c.customer_id = pr.customer_id LEFT JOIN tbl_blanch b ON b.blanch_id = pr.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = pr.empl_id WHERE pr.comp_id = '$comp_id' AND date(pr.time_rec) = '$date' ORDER BY prev_id DESC");
		 return $data->row();
	}

	public function get_blanchTransaction($from,$to,$blanch_id){
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT * FROM tbl_prev_lecod p JOIN tbl_customer c ON c.customer_id = p.customer_id JOIN tbl_blanch b ON b.blanch_id = p.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = p.empl_id WHERE date(p.time_rec) between '$from' and '$to' AND p.blanch_id = '$blanch_id'");
		return $data->result();
	}

	public function get_blanchTransaction_comp($from,$to,$comp_id){
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT * FROM tbl_prev_lecod p JOIN tbl_customer c ON c.customer_id = p.customer_id JOIN tbl_blanch b ON b.blanch_id = p.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = p.empl_id WHERE date(p.time_rec) between '$from' and '$to' AND p.comp_id = '$comp_id'");
		return $data->result();
	}

	public function get_blanchTransaction_comp_data($from,$to,$comp_id){
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT SUM(p.loan_aprov) AS total_comp_aprov,SUM(p.depost) AS total_depost_com,SUM(p.double_dep) AS total_double FROM tbl_prev_lecod p JOIN tbl_customer c ON c.customer_id = p.customer_id JOIN tbl_blanch b ON b.blanch_id = p.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = p.empl_id WHERE date(p.time_rec) between '$from' and '$to' AND p.comp_id = '$comp_id'");
		return $data->row();
	}

	public function get_blanchTransaction_comp_blanch($from,$to,$blanch_id){
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT SUM(p.loan_aprov) AS total_comp_aprov,SUM(p.depost) AS total_depost_com,SUM(p.double_dep) AS total_double FROM tbl_prev_lecod p JOIN tbl_customer c ON c.customer_id = p.customer_id JOIN tbl_blanch b ON b.blanch_id = p.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = p.empl_id WHERE date(p.time_rec) between '$from' and '$to' AND p.blanch_id = '$blanch_id'");
		return $data->row();
	}

	public function get_blanchTransaction_employee($from,$to,$blanch_id){
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT * FROM tbl_prev_lecod p JOIN tbl_customer c ON c.customer_id = p.customer_id JOIN tbl_blanch b ON b.blanch_id = p.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = p.empl_id WHERE date(p.time_rec) between '$from' and '$to' AND p.blanch_id = '$blanch_id'");
		return $data->result();
	}



	public function get_blanchTransaction_employeetotal($from,$to,$blanch_id){
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT SUM(p.loan_aprov) AS total_with,SUM(p.depost) AS total_depost_empl,SUM(p.double_dep) AS total_double FROM tbl_prev_lecod p JOIN tbl_customer c ON c.customer_id = p.customer_id JOIN tbl_blanch b ON b.blanch_id = p.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = p.empl_id WHERE date(p.time_rec) between '$from' and '$to' AND p.blanch_id = '$blanch_id'");
		return $data->result();
	}



	public function get_sum_blanchCash($blanch_id){
		$date = date("Y-m-d");
		$sum = $this->db->query("SELECT SUM(depost) AS total_depost FROM tbl_prev_lecod WHERE blanch_id = '$blanch_id' AND lecod_day = '$date'");
		 return $sum->row();
	}

		public function get_sum_blanchCashWith($blanch_id){
		$date = date("Y-m-d");
		$sum = $this->db->query("SELECT SUM(withdraw) AS total_with FROM tbl_prev_lecod WHERE blanch_id = '$blanch_id' AND lecod_day = '$date'");
		 return $sum->row();
	}


	public function get_cash_transactionBlanch($blanch_id){
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT * FROM tbl_prev_lecod pr JOIN tbl_customer c ON c.customer_id = pr.customer_id JOIN tbl_blanch b ON b.blanch_id = pr.blanch_id  WHERE pr.blanch_id = '$blanch_id' AND lecod_day >= '$date' ORDER BY prev_id DESC");
		 return $data->result();
	}



	public function get_sumCashtransDepost($comp_id){
		$date = date("Y-m-d");
		$cash = $this->db->query("SELECT SUM(depost) AS cash_depost FROM tbl_prev_lecod WHERE comp_id = '$comp_id' AND lecod_day >= '$date'");
		 return $cash->row();
	}



	public function get_sumCashtransDepostBlanch($blanch_id){
		$date = date("Y-m-d");
		$cash = $this->db->query("SELECT SUM(depost) AS cash_depost FROM tbl_prev_lecod WHERE blanch_id = '$blanch_id' AND lecod_day >= '$date'");
		 return $cash->row();
	}

	public function get_sumCashtransWithdrow($comp_id){
		$date = date("Y-m-d");
		$cash = $this->db->query("SELECT SUM(withdraw) AS cash_withdrowal FROM tbl_prev_lecod WHERE comp_id = '$comp_id' AND lecod_day >= '$date'");
		 return $cash->row();
	}


		public function get_sumCashtransWithdrowBlanch($blanch_id){
		$date = date("Y-m-d");
		$cash = $this->db->query("SELECT SUM(withdraw) AS cash_withdrowal FROM tbl_prev_lecod WHERE blanch_id = '$blanch_id' AND lecod_day >= '$date'");
		 return $cash->row();
	}



	public function get_companyData($comp_id){
		$comp = $this->db->query("SELECT * FROM tbl_company WHERE comp_id = '$comp_id' LIMIT 1");
		   return $comp->row();
	}

		public function get_companyDataProfile($comp_id){
		$comp = $this->db->query("SELECT * FROM tbl_company JOIN tbl_region ON tbl_region.region_id = tbl_company.region_id WHERE comp_id = '$comp_id'");
		   return $comp->row();
	}

	public function get_blanchData($blanch_id){
		$blanch = $this->db->query("SELECT * FROM tbl_blanch WHERE blanch_id = '$blanch_id' LIMIT 1");
		 return $blanch->row();
	}

	public function get_managerBlanch($blanch_id){
		$blanch = $this->db->query("SELECT blanch_name AS blanchNic_name,blanch_id FROM tbl_blanch WHERE blanch_id = '$blanch_id'");
		 return $blanch->row();
	}

	public function get_employee_data($empl_id){
		$empl = $this->db->query("SELECT * FROM tbl_employee e WHERE e.empl_id = '$empl_id'");
	   return $empl->row();
	}

	public function get_sponser($customer_id){
		$sponser = $this->db->query("SELECT * FROM tbl_sponser WHERE customer_id = '$customer_id'");
		  return $sponser->row();
	}

	public function get_sponserCustomer($customer_id){
		$sponser = $this->db->query("SELECT * FROM tbl_sponser s LEFT JOIN tbl_region r ON r.region_id = s.sp_region WHERE customer_id = '$customer_id'");
		  return $sponser->result();
	}


	public function get_sumblanch_wise($comp_id){
		$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loan_with,SUM(l.loan_int) AS total_loan_int,b.blanch_name,l.blanch_id FROM tbl_loans l LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id  WHERE l.comp_id = '$comp_id' GROUP BY l.blanch_id");

		foreach ($data->result() as $r) {
	    $r->total_depost = $this->get_total_deposit_blanch_wise($r->blanch_id);
	    $r->total_double = $this->get_total_deposit_blanch_wise_double($r->blanch_id);
	    
		}
		return $data->result();
	}

	public function get_total_deposit_blanch_wise($blanch_id){
		$deposit = $this->db->query("SELECT SUM(d.depost) AS total_depost,SUM(d.double_amont) AS total_double FROM tbl_depost d WHERE d.blanch_id = '$blanch_id' GROUP BY d.blanch_id");
		if ($deposit->row()) {
			return $deposit->row()->total_depost; 
		}
		return 0; 

	}

	public function get_total_deposit_blanch_wise_double($blanch_id){
		$double = $this->db->query("SELECT SUM(d.double_amont) AS total_double FROM tbl_depost d WHERE d.blanch_id = '$blanch_id' GROUP BY d.blanch_id");
		if ($double->row()) {
			return $double->row()->total_double; 
		}
		return 0; 

	}

	public function get_total_comp_deposit($comp_id){
		$data = $this->db->query("SELECT SUM(depost) AS total_depost,SUM(double_amont) AS total_double FROM tbl_depost WHERE comp_id = '$comp_id'");
		return $data->row();
	}


	public function get_sumblanch_wise_blanch($blanch_id){
		$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loan_with,SUM(l.loan_int) AS total_loan_int,b.blanch_name,l.blanch_id FROM tbl_loans l LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id  WHERE l.blanch_id = '$blanch_id' GROUP BY l.blanch_id");
		foreach ($data->result() as $r) {
			$r->total_depost = $this->get_total_deposit_blanch_wise($r->blanch_id);
			$r->total_double = $this->get_total_deposit_blanch_wise_double($blanch_id);
		}
		return $data->result();
	}

	public function get_sumblanch_wiseBlanch($blanch_id){
		$data = $this->db->query("SELECT SUM(pr.total_loan) AS int_loan,SUM(pr.depost) AS sum_depost,b.blanch_name FROM tbl_prev_lecod pr JOIN tbl_blanch b ON b.blanch_id = pr.blanch_id  WHERE pr.blanch_id = '$blanch_id'   GROUP BY pr.blanch_id");
		   return $data->result();
	}


	public function get_sum_Depost($comp_id){
		$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_with_loan,SUM(l.loan_int) AS total_loan_int  FROM tbl_loans l  WHERE l.comp_id = '$comp_id'");
		   return $data->row();
	}

	public function get_sum_DepostBlanch($blanch_id){
		$data = $this->db->query("SELECT SUM(depost) AS total_depost FROM tbl_prev_lecod WHERE blanch_id = '$blanch_id' ");
		   return $data->row();
	}

	public function get_sumloanInterest($comp_id){
		$loan_int = $this->db->query("SELECT SUM(depost) AS loan_depost FROM tbl_prev_lecod WHERE comp_id = '$comp_id'");
		 return $loan_int->row();
	}

	public function get_sumloanInterestBlanch($blanch_id){
		$loan_int = $this->db->query("SELECT SUM(total_loan) AS loan_interest FROM tbl_prev_lecod WHERE blanch_id = '$blanch_id'");
		 return $loan_int->row();
	}


	 public function search_prev_cashtransaction($from,$to,$comp_id,$blanch_id){
      $previous_cash = $this->db->query("SELECT * FROM  tbl_prev_lecod pr JOIN tbl_customer c ON c.customer_id = pr.customer_id JOIN tbl_blanch b ON b.blanch_id = pr.blanch_id  WHERE pr.lecod_day between  '$from' and '$to'AND pr.comp_id = '$comp_id' AND pr.blanch_id = '$blanch_id'");
      return $previous_cash->result();
     }

     // public function search_prev_cashtransaction($from,$to,$comp_id){
     //  $previous_cash = $this->db->query("SELECT * FROM  tbl_prev_lecod pr JOIN tbl_customer c ON c.customer_id = pr.customer_id  WHERE pr.lecod_day between  '$from' and '$to'AND pr.comp_id = '$comp_id'");
     //  return $previous_cash->result();
     // }

      public function search_prev_cashtransactionBlanch($from,$to,$blanch_id){
      $previous_cash = $this->db->query("SELECT * FROM  tbl_prev_lecod pr JOIN tbl_customer c ON c.customer_id = pr.customer_id  WHERE pr.lecod_day between  '$from' and '$to'AND pr.blanch_id = '$blanch_id'");
      return $previous_cash->result();
     }

     public function search_previous_cashInHand($from,$to,$blanch_id){
      $previous_cashinhand = $this->db->query("SELECT * FROM  tbl_cash_inhand ch  WHERE ch.cash_day between  '$from' and '$to'AND ch.blanch_id = '$blanch_id'");
      return $previous_cashinhand->result();
     }

      public function search_previous_cashInHandCompany($from,$to,$comp_id){
      $previous_cashinhand = $this->db->query("SELECT * FROM  tbl_cash_inhand ch JOIN tbl_employee e ON e.empl_id = ch.empl_id JOIN tbl_blanch b ON b.blanch_id = ch.blanch_id WHERE ch.cash_day between  '$from' and '$to'AND ch.comp_id = '$comp_id'");
      return $previous_cashinhand->result();
     }



      public function search_Sum_previous_cashInHand($from,$to,$blanch_id){
      $previous_cashinhand = $this->db->query("SELECT SUM(cash_amount) AS total_cashInHand FROM  tbl_cash_inhand ch  WHERE ch.cash_day between  '$from' and '$to'AND ch.blanch_id = '$blanch_id'");
      return $previous_cashinhand->row();
     }

     public function search_Sum_previous_cashInHandCompany($from,$to,$comp_id){
      $previous_cashinhand = $this->db->query("SELECT SUM(cash_amount) AS total_cashInHand FROM  tbl_cash_inhand ch  WHERE ch.cash_day between  '$from' and '$to'AND ch.comp_id = '$comp_id'");
      return $previous_cashinhand->row();
     }

     public function get_today_cashCompany($comp_id){
     	$date = date("Y-m-d");
     	$cash_data = $this->db->query("SELECT * FROM tbl_cash_inhand ch JOIN tbl_blanch b ON b.blanch_id = ch.blanch_id JOIN tbl_employee e ON e.empl_id = ch.empl_id WHERE ch.comp_id = '$comp_id' AND ch.cash_day = '$date'");
     	 return $cash_data->result();
     }

     public function get_sumCashCompany($comp_id){
     	$date = date("Y-m-d");
     	$cash = $this->db->query("SELECT SUM(cash_amount) AS total_cashInhand FROM tbl_cash_inhand WHERE comp_id = '$comp_id' AND cash_day = '$date'");
     	  return $cash->row();
     }



     public function get_blanchwise_previous($from,$to,$comp_id){
     	$data = $this->db->query("SELECT SUM(pr.total_loan) AS total_loans,SUM(pr.depost) AS sum_depost,b.blanch_name FROM tbl_prev_lecod pr JOIN tbl_blanch b ON b.blanch_id = pr.blanch_id WHERE pr.lecod_day between '$from' and '$to' AND pr.comp_id = '$comp_id' GROUP BY pr.blanch_id");
     	  return $data->result();
     }

     public function get_blanchwise_previousBlanch($from,$to,$blanch_id){
     	$data = $this->db->query("SELECT SUM(pr.total_loan) AS total_loans,SUM(pr.depost) AS sum_depost,b.blanch_name FROM tbl_prev_lecod pr JOIN tbl_blanch b ON b.blanch_id = pr.blanch_id WHERE pr.lecod_day between '$from' and '$to' AND pr.blanch_id = '$blanch_id' GROUP BY pr.blanch_id");
     	  return $data->result();
     }

     public function get_blanchwise_Totalreceivable($from,$to,$comp_id){
     	$data = $this->db->query("SELECT SUM(pr.total_loan) AS total_receivable FROM tbl_prev_lecod pr WHERE pr.lecod_day between '$from' and '$to' AND pr.comp_id = '$comp_id'");
     	  return $data->row();
     }

     public function get_blanchwise_TotalreceivableBlanch($from,$to,$blanch_id){
     	$data = $this->db->query("SELECT SUM(pr.total_loan) AS total_receivable FROM tbl_prev_lecod pr WHERE pr.lecod_day between '$from' and '$to' AND pr.blanch_id = '$blanch_id'");
     	  return $data->row();
     }

      public function get_blanchwise_Totalreceved($from,$to,$comp_id){
     	$data = $this->db->query("SELECT SUM(pr.depost) AS total_receved FROM tbl_prev_lecod pr WHERE pr.lecod_day between '$from' and '$to' AND pr.comp_id = '$comp_id'");
     	  return $data->row();
     }

       public function get_blanchwise_TotalrecevedBlanch($from,$to,$blanch_id){
     	$data = $this->db->query("SELECT SUM(pr.depost) AS total_receved FROM tbl_prev_lecod pr WHERE pr.lecod_day between '$from' and '$to' AND pr.blanch_id = '$blanch_id'");
     	  return $data->row();
     }


     public function get_sumCashtransDepostPrvious($from,$to,$comp_id,$blanch_id){
		$cash = $this->db->query("SELECT SUM(depost) AS cash_depost FROM tbl_prev_lecod WHERE lecod_day between '$from' and '$to' AND comp_id = '$comp_id' AND blanch_id = '$blanch_id'");
		 return $cash->row();
	}

	    public function get_sumCashtransDepostPrviousBlanch($from,$to,$blanch_id){
		$cash = $this->db->query("SELECT SUM(depost) AS cash_depost FROM tbl_prev_lecod WHERE lecod_day between '$from' and '$to' AND blanch_id = '$blanch_id'");
		 return $cash->row();
	}


	public function get_sumCashtransWithdrowPrevious($from,$to,$comp_id,$blanch_id){
		$date = date("Y-m-d");
		$cash = $this->db->query("SELECT SUM(withdraw) AS cash_withdrowal FROM tbl_prev_lecod WHERE lecod_day between '$from' and '$to' AND comp_id = '$comp_id' AND blanch_id = '$blanch_id'");
		 return $cash->row();
	}

	public function get_loanWithdrawal_date($blanch_id,$from,$to,$loan_status){
		$data = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN  tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id LEFT JOIN tbl_loan_category lc ON lc.category_id = l.category_id WHERE l.disburse_day between '$from' and '$to' AND l.blanch_id = '$blanch_id' AND l.loan_status = '$loan_status'");
		return $data->result();
	}


	public function get_sumCashtransWithdrowPreviousBlanch($from,$to,$blanch_id){
		$date = date("Y-m-d");
		$cash = $this->db->query("SELECT SUM(withdraw) AS cash_withdrowal FROM tbl_prev_lecod WHERE lecod_day between '$from' and '$to' AND blanch_id = '$blanch_id'");
		 return $cash->row();
	}

	public function get_pending_reportLoan($comp_id){
		$pend = date("Y-m-d");
		$data = $this->db->query("SELECT * FROM tbl_loan_pending lp JOIN tbl_customer c ON c.customer_id = lp.customer_id JOIN tbl_blanch b ON b.blanch_id = lp.blanch_id WHERE lp.comp_id = '$comp_id' AND action_date >='$pend'");
		 return $data->result();
	}

	// public function get_pending_reportLoan($comp_id){
	// 	$pend = date("Y-m-d");
	// 	$data = $this->db->query("SELECT COUNT(lp.pend_id) AS pend,b.blanch_name,c.f_name,c.m_name,c.l_name,c.phone_no,lp.total_loan,lp.return_day,lp.return_total,lp.pend_date FROM tbl_loan_pending lp JOIN tbl_customer c ON c.customer_id = lp.customer_id JOIN tbl_blanch b ON b.blanch_id = lp.blanch_id WHERE lp.comp_id = '$comp_id' AND pend_date >='$pend' GROUP BY c.customer_id");
	// 	 return $data->result();
	// }

	// public function count_pending($com){
	// 	$count_data = $this->db->query("SELECT COUNT(pend_id) AS pend FROM tbl_pending WHERE customer_id = '$customer_id'");
	// 	return $count_data->row();
	// }

	public function get_pending_reportLoanblanch($blanch_id){
		$pend = date("Y-m-d");
		$data = $this->db->query("SELECT * FROM tbl_loan_pending lp LEFT JOIN tbl_customer c ON c.customer_id = lp.customer_id LEFT JOIN tbl_blanch b ON b.blanch_id = lp.blanch_id LEFT JOIN tbl_loans l ON l.loan_id = lp.loan_id WHERE lp.blanch_id = '$blanch_id' AND action_date >='$pend'");
		 return $data->result();
	}


	public function get_pending_reportLoancompany($comp_id){
		$pend = date("Y-m-d");
		$data = $this->db->query("SELECT * FROM tbl_loan_pending lp LEFT JOIN tbl_customer c ON c.customer_id = lp.customer_id LEFT JOIN tbl_blanch b ON b.blanch_id = lp.blanch_id LEFT JOIN tbl_loans l ON l.loan_id = lp.loan_id WHERE lp.comp_id = '$comp_id' AND action_date >='$pend'");
		 return $data->result();
	}



	public function get_manager_data($empl_id){
		$data = $this->db->query("SELECT * FROM tbl_employee e JOIN tbl_company c ON c.comp_id = e.comp_id JOIN tbl_blanch b ON b.blanch_id = e.blanch_id WHERE empl_id = '$empl_id' LIMIT 1");
		  return $data->row();
	}


	public function update_loanfee($fee_id,$data){
		return $this->db->where('fee_id',$fee_id)->update('tbl_loan_fee',$data);
	}

public function remove_loan_fee($fee_id){
	return $this->db->delete('tbl_loan_fee',['fee_id'=>$fee_id]);
}


public function update_account($account_id,$data){
	return $this->db->where('account_id',$account_id)->update('tbl_account_type',$data);
}


 public function remove_accountType($account_id){
 	return $this->db->delete('tbl_account_type',['account_id'=>$account_id]);
 }

 public function update_group($group_id,$data){
 	return $this->db->where('group_id',$group_id)->update('tbl_group',$data);
 }

 public function remove_group($group_id){
 	return $this->db->delete('tbl_group',['group_id'=>$group_id]);
 }

 public function update_loanCategory($category_id,$data){
 	return $this->db->where('category_id',$category_id)->update('tbl_loan_category',$data);
 }

 public function remove_loacategory($category_id){
 	return $this->db->delete('tbl_loan_category',['category_id'=>$category_id]);
 }

 public function update_employee($empl_id,$data){
 	return $this->db->where('empl_id',$empl_id)->update('tbl_employee',$data);
 }

 public function remove_employee($empl_id){
 	return $this->db->delete('tbl_employee',['empl_id'=>$empl_id]);
 }


 public function update_sponser($sp_id,$data){
 	return $this->db->where('sp_id',$sp_id)->update('tbl_sponser',$data);
 }

 public function get_search_dataCustomer($customer_id){
 	$data = $this->db->query("SELECT c.customer_id,c.f_name,c.m_name,c.l_name,c.phone_no,e.empl_id,e.empl_name,b.blanch_id,b.blanch_name,c.district,c.ward,c.street,c.comp_id,sc.passport FROM tbl_customer c LEFT JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id LEFT JOIN tbl_account_type at ON at.account_id = sc.account_id  LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = c.empl_id WHERE c.customer_id = '$customer_id'");
 	return $data->row();
 }


  public function get_sum_depostLoan($loan_id){
    	$loan = $this->db->query("SELECT SUM(p.depost) AS depos FROM tbl_prev_lecod p  WHERE p.loan_id = '$loan_id'  GROUP BY p.loan_id ");
    	 return $loan->row();
    }

    //manager position

      public function get_blanch_loanpend($comp_id){
       	$loan_pending = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_company c ON c.comp_id = l.comp_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_customer ca ON ca.customer_id = l.customer_id JOIN tbl_sub_customer sc ON sc.customer_id = l.customer_id WHERE l.comp_id = '$comp_id' AND l.loan_status = 'open' ORDER BY l.loan_id DESC ");
       	 return $loan_pending->result();
       }


       public function get_blanch_loanAproved($comp_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_loan_category lt ON lt.category_id = l.category_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.comp_id = '$comp_id'AND l.loan_status = 'aproved' ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }

       public function get_sum_loan_Aproved($comp_id){
         $total_aproved = $this->db->query("SELECT SUM(loan_aprove) AS loan_aproved FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'aproved'");
          return $total_aproved->row();
       }

       public function get_loan_customer($customer_id){
       	$data = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id LEFT JOIN tbl_account_type at ON at.account_id = sc.account_id LEFT JOIN tbl_loan_category lc ON lc.category_id = l.category_id LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE l.customer_id = '$customer_id'");
       	return $data->result();
       }


       public function get_loanExpectation($comp_id){
       	$exp = $this->db->query("SELECT SUM(loan_int) AS loan_interest FROM tbl_loans l  WHERE l.comp_id = '$comp_id' AND l.loan_status = 'withdrawal'");
       	  return $exp->row();
       }

        public function get_loanExpectationBlanch($blanch_id){
       	$exp = $this->db->query("SELECT SUM(pr.total_loan) AS loan_interestBlanch FROM tbl_prev_lecod pr JOIN tbl_loans l ON l.loan_id = pr.loan_id WHERE pr.blanch_id = '$blanch_id' AND l.loan_status = 'withdrawal'");
       	  return $exp->row();
       }


       public function get_sum_Outloan($comp_id){
       	$out = $this->db->query("SELECT SUM(blanch_amount) AS sum_float FROM  tbl_transfor WHERE comp_id = '$comp_id'");
       	 return $out->row();
       }


       public function get_with_done_principal($comp_id){
       	$principal = $this->db->query("SELECT SUM(loan_aprove) AS principal FROM tbl_loans WHERE comp_id = '$comp_id' AND region_id = 'ok'");
       	  return $principal->row();
       }

       public function get_total_loanDepost($comp_id){
       	$loan_receved = $this->db->query("SELECT SUM(depost) AS sum_depost FROM tbl_prev_lecod WHERE comp_id = '$comp_id'");
       	  return $loan_receved->row();
       }


public function get_loan_day($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_loans WHERE loan_id = '$loan_id' LIMIT 1");
	   return $data->row();
}


public function get_upBalance_Data($customer_id){
	$balance = $this->db->query("SELECT * FROM tbl_pay WHERE customer_id = '$customer_id' ORDER BY pay_id DESC LIMIT 1");
	 return $balance->row();
}

public function get_loan_done($customer_id){
	$loan_done = $this->db->query("SELECT * FROM tbl_loans WHERE customer_id = '$customer_id' ORDER BY loan_id DESC");
	 return $loan_done->row();
}

public function get_repayment_data($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_loan_category lc ON lc.category_id = l.category_id LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id WHERE l.comp_id = '$comp_id' AND l.loan_status = 'done'");
       	return $data->result();
}

public function get_repayment_dataBlanch($blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id WHERE l.blanch_id = '$blanch_id' AND l.loan_status = 'done'");
	  return $data->result();
}


public function get_total_loanDone($comp_id){
	$repay = $this->db->query("SELECT SUM(loan_aprove) AS aprovedLoan FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'done'");
	  return $repay->row();
}

public function get_total_loanDoneBlanch($blanch_id){
	$repay = $this->db->query("SELECT SUM(loan_aprove) AS aprovedLoan FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'done'");
	  return $repay->row();
}


public function get_sum_totalloanInterst($comp_id){
	$total_int = $this->db->query("SELECT SUM(loan_int) AS loan_interestData FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'done'");
	  return $total_int->row();
}

public function get_sum_totalloanInterstBlanch($blanch_id){
	$total_int = $this->db->query("SELECT SUM(loan_int) AS loan_interestData FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'done'");
	  return $total_int->row();
}


 public function get_previous_repayments($from,$to,$comp_id){
     	$prev_rep = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id WHERE l.return_date between '$from' and '$to' AND l.comp_id = '$comp_id' AND l.loan_status = 'done'");
     	  return $prev_rep->result();
     }

      public function get_previous_repaymentsBlanch($from,$to,$blanch_id){
     	$prev_rep = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id WHERE l.date_show between '$from' and '$to' AND l.blanch_id = '$blanch_id' AND l.loan_status = 'done'");
     	  return $prev_rep->result();
     }

     public function get_sumprev_loanAprove($from,$to,$comp_id){
     	$repay = $this->db->query("SELECT SUM(loan_aprove) AS aprovedLoan FROM tbl_loans WHERE return_date between '$from' and '$to' AND comp_id = '$comp_id' AND loan_status = 'done'");
	  return $repay->row();
     }

      public function get_sumprev_loanAproveBlanch($from,$to,$blanch_id){
     	$repay = $this->db->query("SELECT SUM(loan_aprove) AS aprovedLoan FROM tbl_loans WHERE return_date between '$from' and '$to' AND blanch_id = '$blanch_id' AND loan_status = 'done'");
	  return $repay->row();
     }

     public function get_sum_prevtotalLoansint($from,$to,$comp_id){
     $total_int = $this->db->query("SELECT SUM(loan_int) AS loan_interestData FROM tbl_loans WHERE return_date between '$from' and '$to' AND comp_id = '$comp_id' AND loan_status = 'done'");
	    return $total_int->row();
     }

       public function get_sum_prevtotalLoansintBlanch($from,$to,$blanch_id){
     $total_int = $this->db->query("SELECT SUM(loan_int) AS loan_interestData FROM tbl_loans WHERE return_date between '$from' and '$to' AND blanch_id = '$blanch_id' AND loan_status = 'done'");
	    return $total_int->row();
     }


     public function get_payDatastatement($customer_id){
     	$pay_data = $this->db->query("SELECT * FROM tbl_pay WHERE customer_id = '$customer_id'");
     	return $pay_data->result();
     }


      public function get_paycustomerNotfee_Statement($customer_id){
        	$customer_pay = $this->db->query("SELECT * FROM tbl_pay p  JOIN tbl_loans l ON l.loan_id = p.loan_id LEFT JOIN tbl_account_transaction at ON at.trans_id = p.p_method  WHERE p.customer_id = '$customer_id' ORDER BY p.pay_id DESC");
        	  return $customer_pay->result();
        }


        public function get_customer_datareport($customer_id){
        	$data = $this->db->query("SELECT * FROM tbl_customer c JOIN tbl_sub_customer sc ON sc.customer_id =c.customer_id JOIN tbl_blanch b ON b.blanch_id = c.blanch_id JOIN tbl_region r ON r.region_id = c.region_id  WHERE c.customer_id = '$customer_id'");
        	return $data->row();
        }


    //       public function insert($data = array()){ 
    //     $insert = $this->db->insert_batch('tbl_collelateral',$data); 
    //     return $insert?true:false; 
    // } 

        public function insert($data){
        	return $this->db->insert('tbl_collelateral',$data);
        }
    
public function insert_localgov_details($data){
	return $this->db->insert('tbl_attachment',$data);
}

public function get_colateral_data($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_collelateral WHERE loan_id = '$loan_id'");
	  return $data->result();
}


public function update_collateral($data,$col_id){
	return $this->db->where('col_id',$col_id)->update('tbl_collelateral',$data);
}

 public function get_loacagovment_data($loan_id){
 	$local_gov = $this->db->query("SELECT * FROM tbl_attachment LEFT JOIN tbl_region ON tbl_region.region_id = tbl_attachment.region_oficer WHERE loan_id = '$loan_id'");
 	  return $local_gov->row();
 }


 public function remove_collateral($col_id){
 	return $this->db->delete('tbl_collelateral',['col_id'=>$col_id]);
 }


 public function remove_loandisbursed($loan_id){
 	return $this->db->delete('tbl_loans',['loan_id'=>$loan_id]);
 }




  	public  function data_download($params = array()){
        $this->db->select('*');
        $this->db->from('tbl_attachment');
        //$this->db->where('status','no');
        //$this->db->order_by('attach_date','desc');
        if(array_key_exists('attach_id',$params) && !empty($params['attach_id'])){
            $this->db->where('attach_id',$params['attach_id']);
            //get records
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        }else{
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            //get records
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
        //return fetched data
        return $result;
    }

    public function get_Allemployee_salary($comp_id){
	$empl = $this->db->query("SELECT * FROM tbl_employee e JOIN tbl_blanch b  ON b.blanch_id = e.blanch_id JOIN tbl_position p ON p.position_id = e.position_id WHERE e.comp_id = '$comp_id' AND e.empl_status = 'open' ORDER BY e.empl_id DESC ");
	  return $empl->result();
}

public function get_sum_salary($comp_id){
	$data = $this->db->query("SELECT SUM(salary) AS total_pay FROM tbl_employee WHERE comp_id = '$comp_id'");
	  return $data->row();
}

public function insert_allowance($data){
	return $this->db->insert('tbl_new_allownce',$data);
}

public function get_all_allowance($comp_id){
	$allowance = $this->db->query("SELECT * FROM tbl_new_allownce a JOIN tbl_employee e ON e.empl_id = a.empl_id JOIN tbl_blanch b ON b.blanch_id = e.blanch_id  WHERE a.comp_id = '$comp_id' ORDER BY a.alow_id DESC");
	 return $allowance->result();
}

public function insert_deduction($data){
	return $this->db->insert('tbl_deduction',$data);
}

public function get_deduction_empl($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_deduction d JOIN tbl_employee e ON e.empl_id = d.empl_id JOIN tbl_blanch b ON b.blanch_id = e.blanch_id WHERE d.comp_id = '$comp_id'");
	 return $data->result();
}


public function get_sumdeduction($comp_id){
	$sum_deduction = $this->db->query("SELECT SUM(amount) AS total_deduction FROM tbl_deduction WHERE comp_id = '$comp_id'");
	 return $sum_deduction->row();
}

public function insert_expenses($data){
	return $this->db->insert('tbl_expenses',$data);
}

public function get_expenses($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_expenses WHERE comp_id = '$comp_id'");
	 return $data->result();
}


public function update_expenses($data,$ex_id){
	return $this->db->where('ex_id',$ex_id)->update('tbl_expenses',$data);
}

public function remove_expenses($ex_id){
	return $this->db->delete('tbl_expenses',['ex_id'=>$ex_id]);
}


public function get_expences_request($comp_id){
	$date = date("Y-m-d");
	$expences = $this->db->query("SELECT * FROM tbl_request_exp re LEFT JOIN tbl_expenses e ON e.ex_id = re.ex_id LEFT JOIN tbl_blanch b ON b.blanch_id = re.blanch_id LEFT JOIN tbl_account_transaction at ON at.trans_id = re.trans_id WHERE re.comp_id = '$comp_id' AND re.req_date = '$date' ORDER BY re.req_id DESC");
	 return $expences->result();;
}

public function get_expences_requestManager($comp_id){
	$expences = $this->db->query("SELECT * FROM tbl_request_exp re JOIN tbl_expenses e ON e.ex_id = re.ex_id JOIN tbl_blanch b ON b.blanch_id = re.blanch_id WHERE re.comp_id = '$comp_id' AND re.req_status = 'open' ORDER BY re.req_id DESC");
	 return $expences->result();
}

public function get_expences_requestAccepted($comp_id){
	$expences = $this->db->query("SELECT * FROM tbl_request_exp re LEFT JOIN tbl_expenses e ON e.ex_id = re.ex_id LEFT JOIN tbl_blanch b ON b.blanch_id = re.blanch_id LEFT JOIN tbl_account_transaction at ON at.trans_id = re.trans_id WHERE re.comp_id = '$comp_id' AND re.req_status = 'accept' ORDER BY re.req_id DESC");
	 return $expences->result();
}

public function get_expences_requestNotDone($comp_id){
	$expences = $this->db->query("SELECT * FROM tbl_request_exp re LEFT JOIN tbl_expenses e ON e.ex_id = re.ex_id LEFT JOIN tbl_blanch b ON b.blanch_id = re.blanch_id LEFT JOIN tbl_account_transaction at ON at.trans_id = re.trans_id WHERE re.comp_id = '$comp_id' ORDER BY re.req_id DESC");
	 return $expences->result();
}

public function get_expences_requestBlanch($blanch_id){
	$day = date("Y-m-d");
	$expences = $this->db->query("SELECT * FROM tbl_request_exp re JOIN tbl_expenses e ON e.ex_id = re.ex_id JOIN tbl_blanch b ON b.blanch_id = re.blanch_id WHERE re.blanch_id = '$blanch_id' AND re.req_date >= '$day' ORDER BY re.req_id DESC");
	 return $expences->result();
}


public function get_expences_requestBlanchuniq($blanch_id){
	$day = date("Y-m-d");
	$expences = $this->db->query("SELECT * FROM tbl_request_exp re JOIN tbl_expenses e ON e.ex_id = re.ex_id JOIN tbl_blanch b ON b.blanch_id = re.blanch_id WHERE re.blanch_id = '$blanch_id' AND re.req_date >= '$day' AND re.req_status = 'accept' ORDER BY re.req_id DESC");
	 return $expences->result();
}

public function get_recomended_status($req_id){
	$data = $this->db->query("SELECT * FROM tbl_request_exp WHERE req_id = $req_id ");
	 return $data->row();
}

public function update_requet_status($req_id,$data){
	return $this->db->where('req_id',$req_id)->update('tbl_request_exp',$data);
}


public function remove_expences($req_id){
	return $this->db->delete('tbl_request_exp',['req_id'=>$req_id]);
}


public function insert_income($data){
	return $this->db->insert('tbl_income',$data);
}

public function get_income($comp_id){
	$income = $this->db->query("SELECT * FROM tbl_income WHERE comp_id = '$comp_id'");
	 return $income->result();
}


public function update_income($data,$inc_id){
	return $this->db->where('inc_id',$inc_id)->update('tbl_income',$data);
}

public function remove_income($inc_id){
	return $this->db->delete('tbl_income',['inc_id'=>$inc_id]);
}

public function insert_income_detail($data){
	return $this->db->insert('tbl_receve',$data);
}

public function get_blanchAccountremain($blanch_id,$account){
	$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$blanch_id' AND receive_trans_id = '$account'");
	return $data->row();
}


public function get_income_detail($comp_id){
	$date = date("Y-m-d");
	$income = $this->db->query("SELECT * FROM tbl_receve r JOIN tbl_income i ON i.inc_id = r.inc_id JOIN tbl_customer c ON c.customer_id = r.customer_id JOIN tbl_blanch b ON b.blanch_id = c.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = r.empl LEFT JOIN tbl_loans l ON l.loan_id = r.loan_id LEFT JOIN tbl_account_transaction at ON at.trans_id = r.trans_id WHERE r.comp_id = '$comp_id' AND r.receve_day = '$date'");
	 return $income->result();
}

public function get_income_detailBlanchData($blanch_id){
	$date = date("Y-m-d");
	$income = $this->db->query("SELECT * FROM tbl_receve r LEFT JOIN tbl_income i ON i.inc_id = r.inc_id LEFT JOIN tbl_customer c ON c.customer_id = r.customer_id LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id LEFT JOIN tbl_loans l ON l.loan_id = r.loan_id LEFT JOIN tbl_employee e ON e.empl_id = r.empl  WHERE r.blanch_id = '$blanch_id' AND r.receve_day = '$date'");
	 return $income->result();
}


public function get_income_detailBlanch($blanch_id){
	$date = date("Y-m-d");
	$income = $this->db->query("SELECT * FROM tbl_receve r JOIN tbl_income i ON i.inc_id = r.inc_id WHERE r.blanch_id = '$blanch_id' AND r.receve_day = '$date'");
	 return $income->result();
}


public function update_income_detail($data,$receved_id){
	return $this->db->where('receved_id',$receved_id)->update('tbl_receve',$data);
}

public function remove_receved($receved_id){
	return $this->db->delete('tbl_receve',['receved_id'=>$receved_id]);
}

public function get_sum_income($comp_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receved FROM  tbl_receve WHERE comp_id = '$comp_id' AND receve_day = '$date'");
	 return $data->row();
}

public function get_sum_incomeBlanchData($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receved FROM  tbl_receve WHERE blanch_id = '$blanch_id' AND receve_day ='$date'");
	 return $data->row();
}

public function get_sum_incomeBlanch($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receved FROM  tbl_receve WHERE blanch_id = '$blanch_id' AND receve_day >=$date");
	 return $data->row();
}


public function get_sumtotal_interest($comp_id){
	$data = $this->db->query("SELECT SUM(total_int) AS total_interest FROM tbl_prev_lecod  pr JOIN tbl_loans l ON l.loan_id = pr.loan_id WHERE l.loan_status = 'done' AND pr.comp_id = '$comp_id'");
	 return $data->row();
}

public function get_sumtotal_interestBlanch($blanch_id){
	$data = $this->db->query("SELECT SUM(total_int) AS total_interest FROM tbl_prev_lecod  pr JOIN tbl_loans l ON l.loan_id = pr.loan_id WHERE l.loan_status = 'done' AND pr.blanch_id = '$blanch_id'");
	 return $data->row();
}


public function get_sum_Comp_income($comp_id){
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receved FROM  tbl_receve WHERE comp_id = '$comp_id'");
	 return $data->row();
}

public function get_sum_Comp_incomeBlanch($blanch_id){
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receved FROM  tbl_receve WHERE blanch_id = '$blanch_id'");
	 return $data->row();
}


public function get_total_loanFee($comp_id){
	$data_loan = $this->db->query("SELECT SUM(withdrow) AS sum_withdraw FROM  tbl_pay  WHERE comp_id = '$comp_id' AND  fee_id IS NOT NULL");
	 return $data_loan->row();
}

//blanch loanfee open
public function get_total_loanFeeBlanchOpen($blanch_id){
	$date = date("Y-m-d");
   $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
	$data_loan = $this->db->query("SELECT SUM(withdrow) AS sum_withdraw FROM  tbl_pay  WHERE blanch_id = '$blanch_id' AND date_data = '$back' AND  fee_id IS NOT NULL");
	 return $data_loan->row();

	}

	//blanch loanfee open
public function blanch_loan_fee($blanch_id){
	$date = date("Y-m-d");
	$data_loan = $this->db->query("SELECT SUM(withdrow) AS sum_withdraw FROM  tbl_pay  WHERE blanch_id = '$blanch_id' AND  fee_id IS NOT NULL");
	 return $data_loan->row();

	}



public function get_total_loanFeeClose($comp_id){
	$day = date("Y-m-d");
	$data_loan = $this->db->query("SELECT SUM(withdrow) AS sum_withdrawclose FROM  tbl_pay  WHERE comp_id = '$comp_id' AND date_data = '$day' AND  fee_id IS NOT NULL");
	 return $data_loan->row();
}
//blanch close
public function get_total_loanFeeCloseBlanch($blanch_id){
	$day = date("Y-m-d");
	$data_loan = $this->db->query("SELECT SUM(withdrow) AS sum_withdrawclose FROM  tbl_pay  WHERE blanch_id = '$blanch_id' AND date_data = '$day' AND  fee_id IS NOT NULL");
	 return $data_loan->row();
}

//blanch close
public function get_total_loanFeeCloseBlanchData($blanch_id){
	$day = date("Y-m-d");
	$data_loan = $this->db->query("SELECT SUM(withdrow) AS sum_incomeLoanfee FROM  tbl_pay  WHERE blanch_id = '$blanch_id' AND date_data = '$day' AND  fee_id IS NOT NULL");
	 return $data_loan->row();
}

public function get_total_loanFeeBlanch($blanch_id){
	$data_loan = $this->db->query("SELECT SUM(withdrow) AS sum_withdraw FROM  tbl_pay  WHERE blanch_id = '$blanch_id' AND  fee_id IS NOT NULL");
	 return $data_loan->row();
}


public function get_sum_requestExpences($comp_id){
	$exp = $this->db->query("SELECT SUM(req_amount) AS total_request FROM tbl_request_exp WHERE comp_id = '$comp_id' AND req_status = 'accept'");
	  return $exp->row();
}


public function get_sum_requestExpencesBlanch($blanch_id){
	$exp = $this->db->query("SELECT SUM(req_amount) AS total_request FROM tbl_request_exp WHERE blanch_id = '$blanch_id' AND req_status = 'accept'");
	  return $exp->row();
}



public function get_sum_IncomeData($comp_id){
	$income = $this->db->query("SELECT SUM(r.receve_amount) AS total_income,i.inc_name  FROM tbl_receve r JOIN tbl_income i ON i.inc_id = r.inc_id WHERE r.comp_id = '$comp_id' GROUP BY r.inc_id");
	 return $income->result();
}

public function get_sum_IncomeDataBlanch($blanch_id){
	$income = $this->db->query("SELECT SUM(r.receve_amount) AS total_income,i.inc_name  FROM tbl_receve r JOIN tbl_income i ON i.inc_id = r.inc_id WHERE r.blanch_id = '$blanch_id' GROUP BY r.inc_id");
	 return $income->result();
}

public function get_total_loanFeeData($comp_id){
	$loan_fee = $this->db->query("SELECT SUM(withdrow) AS total_loanFee,lf.description,lf.fee_interest FROM tbl_pay p JOIN tbl_loan_fee lf ON lf.fee_id = p.fee_id WHERE p.comp_id = '$comp_id' GROUP BY p.fee_id");
	 return $loan_fee->result();
}
public function get_total_loanFeeDataBlanch($blanch_id){
	$loan_fee = $this->db->query("SELECT SUM(withdrow) AS total_loanFee,lf.description,lf.fee_interest FROM tbl_pay p JOIN tbl_loan_fee lf ON lf.fee_id = p.fee_id WHERE p.blanch_id = '$blanch_id' GROUP BY p.fee_id");
	 return $loan_fee->result();
}

public function get_total_ExpencesData($comp_id){
	$expences = $this->db->query("SELECT SUM(req_amount) AS total_exp,ex.ex_name FROM tbl_request_exp rx JOIN tbl_expenses ex ON ex.ex_id = rx.ex_id WHERE rx.comp_id = '$comp_id' AND rx.req_status = 'accept' GROUP BY rx.ex_id");
	 return $expences->result();
}

public function get_total_ExpencesDataBlanch($blanch_id){
	$expences = $this->db->query("SELECT SUM(req_amount) AS total_exp,ex.ex_name FROM tbl_request_exp rx JOIN tbl_expenses ex ON ex.ex_id = rx.ex_id WHERE rx.blanch_id = '$blanch_id' AND rx.req_status = 'accept' GROUP BY rx.ex_id");
	 return $expences->result();
}



public function update_company_Data($data,$comp_id){
	return $this->db->where('comp_id',$comp_id)->update('tbl_company',$data);
}


//update password

public function update_password_data($comp_id, $userdata)
    {
        $this->db->where('comp_id', $comp_id);
        $this->db->update('tbl_company', $userdata);
    }

    public function update_password_dataEmployee($empl_id, $userdata)
    {
        $this->db->where('empl_id', $empl_id);
        $this->db->update('tbl_employee', $userdata);
    }


       public function get_user_data($comp_id)
    {
        $this->db->where('comp_id', $comp_id);
        $query = $this->db->get('tbl_company');
        return $query->row();
    }

    public function insert_penarty($data){
    	return $this->db->insert('tbl_penat',$data);
    }

    public function get_penarty($comp_id){
    	$data = $this->db->query("SELECT * FROM tbl_penat WHERE comp_id = '$comp_id'");
    	 return $data->row();
    }

    public function update_penarty($data,$penalt_id){
    	return $this->db->where('penalt_id',$penalt_id)->update('tbl_penat',$data);
    }

    public function remove_penart($penalt_id){
    	return $this->db->delete('tbl_penat',['penalt_id'=>$penalt_id]);
    }


    public function get_sun_loanPending($comp_id){
    	$pend = date("Y-m-d");
    	$pending = $this->db->query("SELECT SUM(return_total) AS total_pending FROM tbl_loan_pending WHERE comp_id = '$comp_id' AND action_date >='$pend'");
    	return $pending->row();

    }

    public function get_sun_loanPendingPrev($from,$to,$blanch_id){
    	$pending = $this->db->query("SELECT SUM(return_total) AS total_pending FROM tbl_loan_pending WHERE pend_date between '$from' and '$to' AND blanch_id ='$blanch_id'");
    	return $pending->row();

    }




    public function get_sun_loanPendingBlanch($blanch_id){
    	$pend = date("Y-m-d");
    	$pending = $this->db->query("SELECT SUM(return_total) AS total_pending FROM tbl_loan_pending WHERE blanch_id = '$blanch_id' AND action_date >='$pend'");
    	return $pending->row();

    }
    public function get_sun_loanPendingcompany($comp_id){
    	$pend = date("Y-m-d");
    	$pending = $this->db->query("SELECT SUM(return_total) AS total_pending FROM tbl_loan_pending WHERE comp_id = '$comp_id' AND action_date >='$pend'");
    	return $pending->row();

    }



    public function get_today_recevable_loan($empl_id){
    	$today = date("Y-m-d");
    	//$date = $today_data->format("Y-m-d");
    	$today_recevable = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id  WHERE l.date_show ='$today' AND l.loan_status = 'withdrawal' AND l.empl_id = '$empl_id' AND l.dep_status = 'open'");
    	return $today_recevable->result();
    }

   
    public function get_today_recevable_employee_data($empl_id,$comp_id){
    	$today = date("Y-m-d");
    	//$date = $today_data->format("Y-m-d");
    	$today_recevable = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id  WHERE l.date_show ='$today' AND l.loan_status = 'withdrawal' AND l.empl_id = '$empl_id' AND l.comp_id = '$comp_id'");
    	return $today_recevable->result();
    }

    public function get_today_recevable_employee_data_total($empl_id,$comp_id){
    	$today = date("Y-m-d");
    	//$date = $today_data->format("Y-m-d");
    	$today_recevable = $this->db->query("SELECT SUM(restration) AS total_restration FROM tbl_loans l LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id  WHERE l.date_show ='$today' AND l.loan_status = 'withdrawal' AND l.empl_id = '$empl_id' AND l.comp_id = '$comp_id'");
    	return $today_recevable->row();
    }




    public function get_today_recevable_employee($comp_id){
      $today = date("Y-m-d");
    	//$date = $today_data->format("Y-m-d");
    	$today_recevable = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id  WHERE l.date_show ='$today' AND l.loan_status = 'withdrawal' AND l.comp_id = '$comp_id' GROUP BY l.empl_id");
    	return $today_recevable->result();
    }

     public function get_today_recevable_employee_blanch($blanch_id){
      $today = date("Y-m-d");
    	//$date = $today_data->format("Y-m-d");
    	$today_recevable = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id  WHERE l.date_show ='$today' AND l.loan_status = 'withdrawal' AND l.blanch_id = '$blanch_id' GROUP BY l.empl_id");
    	return $today_recevable->result();
    }

    public function get_today_recevable_loanBlanch($blanch_id,$empl_id){
    	$today = date("Y-m-d");
    	//$date = $today_data->format("Y-m-d");
    	$today_recevable = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id  WHERE  l.loan_status = 'withdrawal' AND l.blanch_id = '$blanch_id' AND l.date_show ='$today' AND l.dep_status = 'open' AND l.empl_id = '$empl_id' AND l.group_id IS TRUE");
    	return $today_recevable->result();
    }

     public function get_today_recevable_loanBlanch_data($blanch_id){
    	$today = date("Y-m-d");
    	//$date = $today_data->format("Y-m-d");
    	$today_recevable = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id  WHERE  l.loan_status = 'withdrawal' AND l.blanch_id = '$blanch_id' AND l.date_show ='$today' AND l.dep_status = 'open' AND l.group_id IS TRUE");
    	return $today_recevable->result();
    }


    public function get_group_loan_receivable($group_id,$empl_id){
    	$today = date("Y-m-d");
    	//$date = $today_data->format("Y-m-d");
    	$today_recevable = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id  WHERE  l.loan_status = 'withdrawal'  AND l.date_show ='$today' AND l.dep_status = 'open' AND l.group_id = '$group_id' AND l.empl_id = '$empl_id'");
    	return $today_recevable->result();
    }


      public function get_group_loan_receivable_sum($group_id,$empl_id){
    	$today = date("Y-m-d");
    	//$date = $today_data->format("Y-m-d");
    	$today_recevable = $this->db->query("SELECT SUM(l.restration) AS total_restration_group FROM tbl_loans l LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id  WHERE  l.loan_status = 'withdrawal'  AND l.date_show ='$today' AND l.dep_status = 'open' AND l.group_id = '$group_id' AND l.empl_id = '$empl_id'");
    	return $today_recevable->result();
    }






    public function get_group_data_receivable($blanch_id,$empl_id){
    	$today = date("Y-m-d");
    	//$date = $today_data->format("Y-m-d");
    	$today_recevable = $this->db->query("SELECT g.group_id,g.group_name,l.empl_id FROM tbl_loans l LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id LEFT JOIN tbl_group g ON g.group_id = l.group_id  WHERE  l.loan_status = 'withdrawal' AND l.blanch_id = '$blanch_id' AND l.date_show ='$today' AND l.dep_status = 'open' AND l.empl_id = '$empl_id' AND l.group_id IS TRUE GROUP BY l.group_id");
    	return $today_recevable->result();
    }

     public function get_today_recevable_individual($blanch_id,$empl_id){
    	$today = date("Y-m-d");
    	//$date = $today_data->format("Y-m-d");
    	$today_recevable = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id  WHERE  l.loan_status = 'withdrawal' AND l.blanch_id = '$blanch_id' AND l.date_show ='$today' AND l.dep_status = 'open' AND l.empl_id = '$empl_id' AND l.group_id IS NOT TRUE");
    	return $today_recevable->result();
    }



    public function get_total_recevable($comp_id){
    	$date = date("Y-m-d");
    	$today_data = $this->db->query("SELECT SUM(restration) AS total_rejesho FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'withdrawal' AND date_show = '$date' AND dep_status = 'open'");
    	return $today_data->row();
    }

     public function get_total_recevable_blanch($blanch_id){
    	$date = date("Y-m-d");
    	$today_data = $this->db->query("SELECT SUM(restration) AS total_rejesho FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'withdrawal' AND date_show = '$date' AND dep_status = 'open'");
    	return $today_data->row();
    }




     public function get_total_recevable_employee($empl_id){
    	$date = date("Y-m-d");
    	$today_data = $this->db->query("SELECT SUM(restration) AS total_rejesho_empl FROM tbl_loans WHERE empl_id = '$empl_id' AND loan_status = 'withdrawal' AND date_show = '$date' AND dep_status = 'open' GROUP BY empl_id");
    	return $today_data->result();
    }


    public function get_total_recevableBl($blanch_id){
    	$date = date("Y-m-d");
    	$today_data = $this->db->query("SELECT SUM(restration) AS total_rejesho FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'withdrawal' AND date_show = '$date'");
    	return $today_data->row();
    }




     public function get_total_recevableBlanch($blanch_id,$empl_id){
    	$date = date("Y-m-d");
    	$today_data = $this->db->query("SELECT SUM(restration) AS total_rejesho FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'withdrawal' AND date_show = '$date' AND dep_status = 'open' AND empl_id = '$empl_id' AND group_id IS TRUE");
    	return $today_data->row();
    }

      public function get_total_recevableBlanch_Individual($blanch_id,$empl_id){
    	$date = date("Y-m-d");
    	$today_data = $this->db->query("SELECT SUM(restration) AS total_rejesho FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'withdrawal' AND date_show = '$date' AND dep_status = 'open' AND empl_id = '$empl_id' AND group_id IS NOT TRUE");
    	return $today_data->row();
    }



    public function get_today_received_loan($comp_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT * FROM tbl_depost p JOIN tbl_loans l ON l.loan_id = p.loan_id JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_account_transaction at ON at.trans_id = p.depost_method LEFT JOIN tbl_employee e ON e.empl_id = p.empl_id WHERE p.comp_id = '$comp_id' AND p.depost_day = '$date'");
    	return $data->result();
    }

     public function get_today_received_loanBlanch($blanch_id){
    $date = date("Y-m-d");
    	$data = $this->db->query("SELECT * FROM tbl_depost p LEFT JOIN tbl_loans l ON l.loan_id = p.loan_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_account_transaction at ON at.trans_id = p.depost_method LEFT JOIN tbl_employee e ON e.empl_id = p.empl_id WHERE p.blanch_id = '$blanch_id' AND p.depost_day = '$date'");
    	return $data->result();
    }

    public function get_sumReceived_amount($comp_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(depost) AS total_depost,SUM(double_amont) AS total_double FROM tbl_depost WHERE comp_id = '$comp_id' AND depost_day = '$date'");
    	 return $data->row();
    }

     public function get_sumReceiveComp($comp_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(withdrow) AS total_withdrawal FROM tbl_pay WHERE comp_id = '$comp_id' AND auto_date = '$date'");
    	 return $data->row();
    }


    public function get_sumReceived_amountbl($blanch_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(withdrow) AS total_withdrawal FROM tbl_pay WHERE blanch_id = '$blanch_id' AND auto_date = '$date'");
    	 return $data->row();
    }

    public function get_sum_today_recevedBlanch($blanch_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(depost) AS total_depost,SUM(double_amont) AS total_double FROM tbl_depost WHERE blanch_id = '$blanch_id' AND depost_day = '$date'");
    	 return $data->row();
    }


  

     public function get_sumReceived_amountBlanchs($blanch_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(withdrow) AS total_withdrawal FROM tbl_pay WHERE blanch_id = '$blanch_id' AND auto_date = '$date'");
    	 return $data->row();
    }

      public function get_sumReceived_amountBlanch($blanch_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(withdrow) AS total_withdrawal FROM tbl_pay WHERE blanch_id = '$blanch_id' AND auto_date = '$date'");
    	 return $data->row();
    }

    //reconselation report

     public function get_total_recevableDaily($comp_id){
    	$date = date("Y-m-d");
    	$today_data = $this->db->query("SELECT SUM(restration) AS total_rejesho FROM tbl_loans  WHERE comp_id = '$comp_id' AND day = '1' AND date_show = '$date'");
    	return $today_data->row();
    }

     public function get_total_recevableDailyBlanch($blanch_id){
    	$date = date("Y-m-d");
    	$today_data = $this->db->query("SELECT SUM(restration) AS total_rejesho FROM tbl_loans  WHERE blanch_id = '$blanch_id' AND day = '1' AND date_show = '$date'");
    	return $today_data->row();
    }

     public function get_total_recevableweekly($comp_id){
    	$date = date("Y-m-d");
    	$today_data = $this->db->query("SELECT SUM(restration) AS total_rejesho_wekly FROM tbl_loans  WHERE comp_id = '$comp_id' AND day = '7' AND date_show = '$date'");
    	return $today_data->row();
    }

      public function get_total_recevableweeklyBlanch($blanch_id){
    	$date = date("Y-m-d");
    	$today_data = $this->db->query("SELECT SUM(restration) AS total_rejesho_wekly FROM tbl_loans  WHERE blanch_id = '$blanch_id' AND day = '7' AND date_show = '$date'");
    	return $today_data->row();
    }


     public function get_total_recevableMonthly($comp_id){
    	$date = date("Y-m-d");
    	$today_data = $this->db->query("SELECT SUM(restration) AS total_rejesho_Monthly FROM tbl_loans  WHERE comp_id = '$comp_id' AND day = '30' AND date_show = '$date'");
    	return $today_data->row();
    }


     public function get_total_recevableMonthlyblanch($blanch_id){
    	$date = date("Y-m-d");
    	$today_data = $this->db->query("SELECT SUM(restration) AS total_rejesho_Monthly FROM tbl_loans  WHERE blanch_id = '$blanch_id' AND day = '30' AND date_show = '$date'");
    	return $today_data->row();
    }

    public function get_sumReceived_amountDaily($comp_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(p.withdrow) AS total_withdrawalDaily,l.day FROM tbl_pay p JOIN tbl_loans l ON l.loan_id = p.loan_id WHERE p.comp_id = '$comp_id' AND p.auto_date = '$date' AND l.day = '1'");
    	 return $data->row();
    }

     public function get_sumReceived_amountDailyblanch($blanch_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(p.withdrow) AS total_withdrawalDaily,l.day FROM tbl_pay p JOIN tbl_loans l ON l.loan_id = p.loan_id WHERE p.blanch_id = '$blanch_id' AND p.auto_date = '$date' AND l.day = '1'");
    	 return $data->row();
    }

     public function get_sumReceived_amountWeekly($comp_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(p.withdrow) AS total_withdrawalWeekly,l.day FROM tbl_pay p JOIN tbl_loans l ON l.loan_id = p.loan_id WHERE p.comp_id = '$comp_id' AND p.auto_date = '$date' AND l.day = '7'");
    	 return $data->row();
    }

       public function get_sumReceived_amountWeeklyBlanch($blanch_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(p.withdrow) AS total_withdrawalWeekly,l.day FROM tbl_pay p JOIN tbl_loans l ON l.loan_id = p.loan_id WHERE p.blanch_id = '$blanch_id' AND p.auto_date = '$date' AND l.day = '7'");
    	 return $data->row();
    }

    public function get_sumReceived_amountmonthly($comp_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(p.withdrow) AS total_withdrawalMonthly,l.day FROM tbl_pay p JOIN tbl_loans l ON l.loan_id = p.loan_id WHERE p.comp_id = '$comp_id' AND p.auto_date = '$date' AND l.day = '30'");
    	 return $data->row();
    }

     public function get_sumReceived_amountmonthlyBlanch($blanch_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(p.withdrow) AS total_withdrawalMonthly,l.day FROM tbl_pay p JOIN tbl_loans l ON l.loan_id = p.loan_id WHERE p.blanch_id = '$blanch_id' AND p.auto_date = '$date' AND l.day = '30'");
    	 return $data->row();
    }


    public function prepaid_pay($comp_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(prepaid_amount) AS prepaid_balance FROM tbl_prepaid WHERE comp_id = '$comp_id'  AND prepaid_date = '$date'");
    	 return $data->row();
    }

     public function prepaid_paybla($blanch_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(prepaid_amount) AS prepaid_balance FROM tbl_prepaid WHERE blanch_id = '$blanch_id' AND prepaid_date = '$date'");
    	 return $data->row();
    }


     public function prepaid_payBlanch($blanch_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(balance) AS prepaid_balance FROM tbl_pay WHERE blanch_id = '$blanch_id' AND date_pay = '$date'");
    	 return $data->row();
    }


    public function get_total_loanFeereconce($comp_id){
    	$today = date("Y-m-d");
	$data_loan = $this->db->query("SELECT SUM(withdrow) AS sum_withdraw FROM  tbl_pay  WHERE comp_id = '$comp_id' AND p_today = '$today' AND  fee_id IS NOT NULL ");
	 return $data_loan->row();
}

   public function get_total_loanFeereconceBlanch($blanch_id){
    	$today = date("Y-m-d");
	$data_loan = $this->db->query("SELECT SUM(withdrow) AS sum_withdraw FROM  tbl_pay  WHERE blanch_id = '$blanch_id' AND p_today = '$today' AND  fee_id IS NOT NULL ");
	 return $data_loan->row();
}

//income

public function get_today_income($comp_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receve_income FROM tbl_receve WHERE comp_id = '$comp_id' AND receve_day = '$today'");
	 return $data->row();
}

public function get_today_incomeBlanch($blanch_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receve_income FROM tbl_receve WHERE blanch_id = '$blanch_id' AND receve_day = '$today'");
	 return $data->row();
}

public function get_today_expences($comp_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(req_amount) AS total_req FROM tbl_request_exp WHERE comp_id = '$comp_id' AND req_date = '$today' AND req_status = 'accept'");
	 return $data->row();
}

public function get_today_expencesBlanch($blanch_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(req_amount) AS total_req FROM tbl_request_exp WHERE blanch_id = '$blanch_id' AND req_date = '$today' AND req_status = 'accept'");
	 return $data->row();
}

public function get_today_withdrawal_loan($comp_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(loan_int) AS total_todayloan FROM tbl_loans WHERE comp_id = '$comp_id' AND disburse_day = '$date' AND loan_status = 'withdrawal'");
	  return $data->row();
}

public function get_today_withdrawal_loanBlanch($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(loan_int) AS total_todayloan FROM tbl_loans WHERE blanch_id = '$blanch_id' AND disburse_day = '$date' AND loan_status = 'withdrawal'");
	  return $data->row();
}


public function get_total_penartToday($comp_id){
	$today = date("Y-m-d");
	$penart = $this->db->query("SELECT SUM(total_penart) AS penart FROM tbl_store_penalt WHERE comp_id = '$comp_id' AND penart_day = '$today'");
	 return $penart->row();
}

public function get_total_penartTodayBlanch($blanch_id){
	$today = date("Y-m-d");
	$penart = $this->db->query("SELECT SUM(total_penart) AS penart FROM tbl_store_penalt WHERE blanch_id = '$blanch_id' AND penart_day = '$today'");
	 return $penart->row();
}

public function remove_priv($priv_id){
	return $this->db->delete('tbl_privellage',['priv_id'=>$priv_id]);
}

public function get_privData($priv_id){
	$data = $this->db->query("SELECT * FROM tbl_privellage WHERE priv_id = '$priv_id'");
	 return $data->row();
}

public function insert_todayCash($data){
	return $this->db->insert(' tbl_cash_inhand',$data);
}

public function get_todayCah($blanch_id){
	  $date = date("Y-m-d");
	$data = $this->db->query("SELECT * FROM  tbl_cash_inhand WHERE blanch_id = '$blanch_id' AND cash_day = '$date'");
	  return $data->result();
}

public function get_sum_cashInHand($blanch_id){
	$date = date("Y-m-d");
	$cash = $this->db->query("SELECT SUM(cash_amount) AS totall_cash FROM tbl_cash_inhand WHERE blanch_id = '$blanch_id'  AND 'cash_day' = '$date'");
	  return $cash->row();
}

public function get_sum_cashInHandcomp($comp_id){
	$cash = $this->db->query("SELECT SUM(cash_amount) AS totall_cash FROM tbl_cash_inhand WHERE comp_id = '$comp_id'");
	  return $cash->row();
}


public function get_position_empl($empl_id){
	$data = $this->db->query("SELECT * FROM  tbl_privellage WHERE empl_id = '$empl_id'");
	return $data->result();
}

public function get_position_manager($empl_id){
	$data = $this->db->query("SELECT * FROM  tbl_privellage WHERE empl_id = '$empl_id'");
	return $data->row();
}


public function get_position_emplmanager($empl_id){
	$data = $this->db->query("SELECT * FROM   tbl_privellage WHERE empl_id = '$empl_id'");
	  return $data->row();
}

public function update_employee_profile($data,$empl_id){
	return $this->db->where('empl_id',$empl_id)->update('tbl_employee',$data);
}

public function get_restoration_loan($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_loans WHERE loan_id = '$loan_id' LIMIT 1");
	 return $data->row();
}

public function get_today_chashData_Blanch($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS today_depost FROM tbl_prev_lecod WHERE blanch_id = '$blanch_id' AND lecod_day = '$date'");
	  return $data->row();
}


//comp 
public function get_today_chashData_Comp($comp_id){
	$data = $this->db->query("SELECT SUM(depost) AS today_depost FROM tbl_prev_lecod WHERE comp_id = '$comp_id'");
	  return $data->row();
}



public function get_today_incomeBlanchData($blanch_id){
	$date = date("Y-m-d");
	$income = $this->db->query("SELECT SUM(receve_amount) AS today_income FROM  tbl_receve WHERE blanch_id = '$blanch_id' AND receve_day = '$date'");
	 return $income->row();
}

//comp
public function get_today_incomeBlanchDataComp($comp_id){
	$income = $this->db->query("SELECT SUM(receve_amount) AS today_income FROM  tbl_receve WHERE comp_id = '$comp_id'");
	 return $income->row();
}



public function get_today_expencesData($blanch_id){
	$date = date("Y-m-d");
	$expences = $this->db->query("SELECT SUM(req_amount) AS total_expnces FROM tbl_request_exp WHERE blanch_id = '$blanch_id' AND req_status = 'accept' AND req_date = '$date'");
	 return $expences->row();
}

//comp
public function get_today_expencesDataComp($comp_id){
	$expences = $this->db->query("SELECT SUM(req_amount) AS total_expnces FROM tbl_request_exp WHERE comp_id = '$comp_id' AND req_status = 'accept'");
	 return $expences->row();
}
//blanch
public function get_today_expencesDataBlanch($blanch_id){
	$expences = $this->db->query("SELECT SUM(req_amount) AS total_expncesBlanch FROM tbl_request_exp WHERE blanch_id = '$blanch_id' AND req_status = 'accept'");
	 return $expences->row();
}


public function get_toay_Cashinhand($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT * FROM tbl_cash_inhand WHERE blanch_id = '$blanch_id' AND cash_day = '$date'");
	return $data->result();
}


public function get_today_cash($blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$blanch_id'");
	 return $data->row();
}

public function get_total_walet($comp_id){
	$principal = $this->db->query("SELECT SUM(amount) AS total_capital FROM tbl_capital WHERE comp_id = '$comp_id'");
	  return $principal->row();
}

public function get_total_principal($comp_id){
	$data = $this->db->query("SELECT SUM(loan_aprove) AS loan_aproved FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status ='withdrawal'");
	  return $data->row();
}

public function get_total_principalBlanch($blanch_id){
	$data = $this->db->query("SELECT SUM(loan_aprove) AS loan_aproveds FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status ='withdrawal'");
	  return $data->row();
}

public function get_totalLoanRepayment($comp_id){
	$repayment = $this->db->query("SELECT SUM(depost) AS loan_depost FROM tbl_pay WHERE comp_id = '$comp_id' AND pay_status = '1'");
	  return $repayment->row();
}

public function get_totalLoanRepaymentBlanch($blanch_id){
	$repayment = $this->db->query("SELECT SUM(depost) AS loan_depost_blanch FROM tbl_pay WHERE blanch_id = '$blanch_id' AND pay_status = '1'");
	  return $repayment->row();
}

public function get_previous_income($from,$to,$comp_id,$blanch_id){
	$income = $this->db->query("SELECT * FROM tbl_receve r LEFT JOIN tbl_income i ON i.inc_id = r.inc_id LEFT JOIN tbl_customer c ON c.customer_id = r.customer_id LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id LEFT JOIN tbl_loans l ON l.loan_id = r.loan_id LEFT JOIN tbl_employee e ON e.empl_id = r.empl WHERE r.receve_day between '$from' and '$to' AND r.comp_id = '$comp_id' AND r.blanch_id = '$blanch_id'");
	 return $income->result();
}

public function get_previous_income_all($from,$to,$comp_id){
	$income = $this->db->query("SELECT * FROM tbl_receve r JOIN tbl_income i ON i.inc_id = r.inc_id JOIN tbl_customer c ON c.customer_id = r.customer_id JOIN tbl_blanch b ON b.blanch_id = c.blanch_id LEFT JOIN tbl_loans l ON l.loan_id = r.loan_id LEFT JOIN tbl_employee e ON e.empl_id = r.empl WHERE r.receve_day between '$from' and '$to' AND r.comp_id = '$comp_id'");
	 return $income->result();
}

public function get_previous_income_blanch($from,$to,$blanch_id){
	$income = $this->db->query("SELECT * FROM tbl_receve r JOIN tbl_income i ON i.inc_id = r.inc_id JOIN tbl_customer c ON c.customer_id = r.customer_id JOIN tbl_blanch b ON b.blanch_id = c.blanch_id LEFT JOIN tbl_loans l ON l.loan_id = r.loan_id LEFT JOIN tbl_employee e ON e.empl_id = r.empl WHERE r.receve_day between '$from' and '$to' AND r.blanch_id = '$blanch_id'");
	 return $income->result();
}

public function get_total_blanch_income($from,$to,$blanch_id){
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receive FROM tbl_receve WHERE receve_day between '$from' and '$to' AND blanch_id = '$blanch_id'");
	return $data->result();
}

public function get_previous_incomeAll($from,$to,$comp_id){
	$income = $this->db->query("SELECT * FROM tbl_receve r JOIN tbl_income i ON i.inc_id = r.inc_id JOIN tbl_customer c ON c.customer_id = r.customer_id JOIN tbl_blanch b ON b.blanch_id = c.blanch_id WHERE r.receve_day between '$from' and '$to' AND r.comp_id = '$comp_id'");
	 return $income->result();
}

public function get_sum_previousIncome($from,$to,$comp_id,$blanch_id){
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receved FROM  tbl_receve WHERE receve_day between '$from' and '$to' AND  comp_id = '$comp_id' AND blanch_id = '$blanch_id'");
	 return $data->row();
}

public function get_sum_previousIncome_blanch($from,$to,$comp_id,$blanch_id){
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receved_blanch FROM  tbl_receve WHERE receve_day between '$from' and '$to' AND  comp_id = '$comp_id' AND blanch_id = '$blanch_id'");
	 return $data->row();
}

public function get_sum_previousIncome_COMP($from,$to,$comp_id){
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receved_blanch FROM  tbl_receve WHERE receve_day between '$from' and '$to' AND  comp_id = '$comp_id'");
	 return $data->row();
}

public function get_sum_previousIncomeAll($from,$to,$comp_id){
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receved FROM  tbl_receve WHERE receve_day between '$from' and '$to' AND  comp_id = '$comp_id'");
	 return $data->row();
}


//group loan

public function get_groupLoanData($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_loans WHERE loan_id = '$loan_id'");
	 return $data->row();
}

public function get_groupLoan_detail($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_group g ON g.group_id = l.group_id WHERE loan_id = '$loan_id'");
	 return $data->row();
}

public function get_groupMember($group_id){
	$member = $this->db->query("SELECT * FROM tbl_group_member WHERE group_id = '$group_id'");
	 return $member->result();
}


public function get_gropLoan($comp_id){
	$loan_group = $this->db->query("SELECT * FROM tbl_group g JOIN tbl_pay p ON p.group_id = g.group_id JOIN tbl_blanch b ON b.blanch_id = g.blanch_id WHERE g.comp_id = '$comp_id' GROUP BY p.group_id");
	  return $loan_group->result();
}


      //search-----
    public function search_groupLoan($group_id,$comp_id){
      $this->db->select('b.blanch_id,b.	comp_id,b.region_id,b.blanch_name,b.blanch_no,b.balanch_date,p.pay_id,p.comp_id,p.fee_id,p.blanch_id,p.emply,p.customer_id,p.loan_id,l.loan_id,l.comp_id,l.blanch_id,l.customer_id,l.category_id,l.empl_id,l.loan_code,l.group_id,l.how_loan,l.day,l.session,l.reason,l.loan_status,l.fee_status,l.loan_aprove,l.region_id,l.loan_day,lc.category_id,lc.loan_name,lc.comp_id,lc.interest_formular,c.comp_id,c.comp_name,g.group_id,g.group_name');
      $this->db->like('g.group_id',$group_id);
      $this->db->like('c.comp_id',$comp_id);
      $this->db->JOIN('tbl_blanch b','b.blanch_id = g.blanch_id');
      $this->db->JOIN('tbl_pay p','p.group_id = g.group_id');
      $this->db->JOIN('tbl_loans l','l.group_id = g.group_id');
      $this->db->JOIN('tbl_company c','c.comp_id = p.comp_id');
      $this->db->JOIN('tbl_loan_category lc','lc.category_id = l.category_id');
      $data = $this->db->get('tbl_group g');
         return $data->row();
        }


        public function get_depost_groupData($group_id){
        	$data = $this->db->query("SELECT * FROM tbl_pay WHERE group_id = '$group_id'");
        	return $data->result();
        }
      

      public function get_groupDataMain($group_id){
      	$data = $this->db->query("SELECT * FROM tbl_group g JOIN tbl_blanch b ON b.blanch_id = g.blanch_id WHERE g.group_id = '$group_id'");
      	 return $data->row();
      }


      public function get_ChairManCustomer($customer_id){
      	$data = $this->db->query("SELECT * FROM tbl_customer WHERE customer_id = '$customer_id'");
      	return $data->row();
      }

       public function get_payGroup($group_id){
        	$customer_pay = $this->db->query("SELECT * FROM tbl_pay p  JOIN tbl_loans l ON l.loan_id = p.loan_id  WHERE p.group_id = '$group_id' ORDER BY p.pay_id DESC LIMIT 5");
        	  return $customer_pay->result();
        }


        public function get_totalgroup($group_id){
	  $total_loan = $this->db->query("SELECT * FROM tbl_loans WHERE group_id = '$group_id' ORDER BY loan_id DESC");
	  return $total_loan->row();
    }

    public function get_totalLoanDisbureseGroup($group_id){
	$total_loan = $this->db->query("SELECT * FROM tbl_loans WHERE group_id = '$group_id' AND loan_status = 'disbarsed'");
	  return $total_loan->row();
}

public function get_totalLoanwithdrawalGroup($group_id){
	$total_loan = $this->db->query("SELECT * FROM tbl_loans WHERE group_id = '$group_id' AND loan_status = 'withdrawal'");
	  return $total_loan->row();
}

public function get_totalLoanDoneGroup($group_id){
	$total_loan = $this->db->query("SELECT * FROM tbl_loans WHERE group_id = '$group_id' AND loan_status = 'done'");
	  return $total_loan->row();
}


       // search-----
    public function search_phone($comp_phone){
      $this->db->select('');
      $this->db->like('c.comp_phone',$comp_phone);
      $data = $this->db->get('tbl_company c');
         return $data->row();
        }
    public function view_com($comp_id){
    	$data = $this->db->query("SELECT * FROM tbl_company WHERE comp_id = '$comp_id'");
    	 return $data->row();
    }

    public function update_comppassword($comp_id,$data){
    	return $this->db->where('comp_id',$comp_id)->update('tbl_company',$data);
    }

    public function get_outstand_loan($loan_id){
     $out = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_outstand o ON o.loan_id = l.loan_id WHERE l.loan_id = '$loan_id'");
      return $out->row();
    }

    public function get_blanchIncome($blanch_id,$receve_day){
    	  $this->db->select('r.receved_id,r.comp_id,r.inc_id,r.blanch_id,r.customer_id,r.empl,r.receve_amount,r.receve_day,c.customer_id,c.f_name,c.m_name,c.l_name,i.inc_id,i.comp_id,i.inc_name,b.blanch_id,b.blanch_name');
      $this->db->like('r.blanch_id',$blanch_id);
      $this->db->like('r.receve_day',$receve_day);
      $this->db->JOIN('tbl_blanch b','b.blanch_id = r.blanch_id');
      $this->db->JOIN('tbl_customer c','c.customer_id = r.customer_id');
      $this->db->JOIN('tbl_income i','i.inc_id = r.inc_id');
      $data = $this->db->get('tbl_receve r');
         return $data->result();
    }

    public function get_blanchDataIncome($blanch_id,$receve_day){
    	$data = $this->db->query("SELECT * FROM tbl_receve r  JOIN tbl_customer c ON c.customer_id = r.customer_id JOIN tbl_blanch b ON b.blanch_id = r.blanch_id JOIN tbl_income i ON i.inc_id = r.inc_id WHERE r.blanch_id = '$blanch_id' AND r.receve_day = '$receve_day'");
    	 return $data->result();
    }

    public function get_blanch_data($blanch_id){
    	$data = $this->db->query("SELECT * FROM tbl_blanch WHERE blanch_id = '$blanch_id'");
    	return $data->row();
    }

   

     public function get_expences_blanch($blanch_id){
     	
     	$data = $this->db->query("SELECT * FROM tbl_request_exp e LEFT JOIN tbl_company c ON c.comp_id = e.comp_id LEFT JOIN tbl_blanch b ON b.blanch_id = e.blanch_id LEFT JOIN tbl_expenses ex ON ex.ex_id = e.ex_id LEFT JOIN tbl_account_transaction at ON at.trans_id = e.trans_id WHERE e.blanch_id = '$blanch_id'");
     	return $data->result();

     }	

    public function get_sum_expences($comp_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(req_amount) AS total_expences FROM tbl_request_exp WHERE comp_id = '$comp_id' AND req_date = '$date'");
    	 return $data->row();
    }

     public function get_sum_expencesnotAccept($comp_id){
    	$data = $this->db->query("SELECT SUM(req_amount) AS total_expences FROM tbl_request_exp WHERE comp_id = '$comp_id' AND req_status = 'open'");
    	 return $data->row();
    }

    public function get_sum_expencesBlanch($blanch_id){
    	$data = $this->db->query("SELECT SUM(req_amount) AS total_expences FROM tbl_request_exp WHERE blanch_id = '$blanch_id' AND req_status = 'accept'");
    	 return $data->row();
    }


  //out data

  public function fetch_eneos($blanch_id)
 {
  $this->db->where('blanch_id', $blanch_id);
  $this->db->order_by('customer_id', 'ASC');
  $query = $this->db->get('tbl_customer');
  $output = '<option value="">Search Customer</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->customer_id.'">'.$row->f_name. ' '.$row->m_name. ' '.$row->l_name. '</option>';
  }
  return $output;
 }

 function fetch_vipmios($customer_id)
 {
  $this->db->where('customer_id', $customer_id);
  $this->db->order_by('loan_code', 'DESC');
  $query = $this->db->query("SELECT * FROM tbl_loans WHERE customer_id = '$customer_id' ORDER BY loan_id DESC LIMIT 1");
  //$output = '<option value="">Select Active Loan</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->loan_id.'">'.$row->loan_code. "-" ."(Tsh.".number_format($row->loan_aprove).")".'</option>';
   
  }
  return $output;
 }

  function fetch_loancustomer($customer_id)
 {
  $this->db->where('customer_id', $customer_id);
  $this->db->order_by('loan_code', 'DESC');
  $query = $this->db->query("SELECT * FROM tbl_loans WHERE customer_id = '$customer_id' ORDER BY loan_id DESC");
  $output = '<option value="">Select Active Loan</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->loan_id.'">'.$row->loan_code. "-" ."(Tsh.".number_format($row->loan_aprove).")".'</option>';
   
  }
  return $output;
 }

 public function get_loanSchedule($loan_id){
 	$data = $this->db->query("SELECT * FROM tbl_test_date t LEFT JOIN tbl_loans l ON l.loan_id = t.loan_id WHERE t.loan_id = '$loan_id'");
 	return $data->result();
 }


 public function get_income_data($inc_id){
 	$data = $this->db->query("SELECT * FROM tbl_income WHERE inc_id = '$inc_id'");
 	 return $data->row();
 }


 public function get_blanchd($comp_id){
 	$data = $this->db->query("SELECT * FROM tbl_blanch WHERE comp_id = '$comp_id'");
 	 return $data->result();
 }

 public function get_prev_expences($from,$to,$blanch_id){
 $previous_cash = $this->db->query("SELECT * FROM  tbl_request_exp re LEFT JOIN tbl_blanch b ON b.blanch_id = re.blanch_id JOIN tbl_expenses e ON e.ex_id = re.ex_id LEFT JOIN tbl_account_transaction at ON at.trans_id = re.trans_id  WHERE re.req_date between  '$from' and '$to'AND re.blanch_id = '$blanch_id'");
      return $previous_cash->result();
 }

 public function get_total_prevExpences($from,$to,$blanch_id){
 	$data = $this->db->query("SELECT SUM(req_amount) AS total_exp FROM tbl_request_exp WHERE req_date between '$from' and '$to' AND blanch_id = '$blanch_id'");
 	return $data->result();
 }



 public function update_customer_profile($customer_id,$data){
 	return $this->db->where('customer_id',$customer_id)->UPDATE('tbl_sub_customer',$data);
 }

 public function get_emplBlock($empl_id){
 	$empl = $this->db->query("SELECT * FROM tbl_employee WHERE empl_id = '$empl_id'");
 	  return $empl->row();
 }

 public function block_empl_data($empl_id,$data){
 	return $this->db->where('empl_id',$empl_id)->update('tbl_employee',$data);
 }

 public function block_empl_allData($comp_id,$all_employee){
 	return $this->db->where('comp_id',$comp_id)->update('tbl_employee',$all_employee);
 }



 	 // public function search_prev_cashtransaction($from,$to,$comp_id){
   //    $previous_cash = $this->db->query("SELECT * FROM  tbl_prev_lecod pr JOIN tbl_customer c ON c.customer_id = pr.customer_id  WHERE pr.lecod_day between  '$from' and '$to'AND pr.comp_id = '$comp_id'");
   //    return $previous_cash->result();
   //   }


 public function get_transforFloat($from,$to,$blanch_id){
 	$data = $this->db->query("SELECT t.trans_id,t.comp_id,t.blanch_id,t.blanch_amount,t.trans_day,b.blanch_id,b.comp_id,b.region_id,b.blanch_name,b.blanch_no,at.account_name AS to_account,t.from_trans_id,t.to_trans_id,at.trans_id,tr.account_name AS from_account,t.charger FROM tbl_transfor t  LEFT JOIN tbl_blanch b ON b.blanch_id = t.blanch_id JOIN tbl_account_transaction at ON at.trans_id = t.to_trans_id JOIN tbl_account_transaction tr ON tr.trans_id = t.from_trans_id WHERE t.trans_day between '$from' and '$to' AND t.blanch_id = '$blanch_id'");
 	  return $data->result();
 }

 public function get_sumFloatData($comp_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(blanch_amount) AS cashFloat FROM tbl_transfor WHERE comp_id = '$comp_id'");
 	return $data->row();
 }

 public function get_toal_Float_date($from,$to,$blanch_id){
 	$float = $this->db->query("SELECT SUM(blanch_amount) AS total_froat,SUM(charger) AS total_charger FROM tbl_transfor WHERE trans_day between '$from' and '$to' AND blanch_id = '$blanch_id'");
 	return $float->row();
 }

 public function get_blanchReced($blanch_id,$comp_id,$depost_day){
 	$date = date("Y-m-d");
 	 $this->db->select('p.dep_id,p.comp_id,p.blanch_id,p.customer_id,p.loan_id,p.pay_id,p.depost,p.depost_day,p.depost_method,p.empl_username,cs.f_name,cs.m_name,cs.l_name,b.blanch_name,l.loan_int,l.day,l.restration,cs.phone_no,p.sche_principal,p.sche_interest,at.account_name,e.empl_name,p.deposit_day,p.double_amont');
      $this->db->like('b.blanch_id',$blanch_id);
      $this->db->like('c.comp_id',$comp_id);
      $this->db->like('p.depost_day',$date);
      $this->db->JOIN('tbl_blanch b','b.blanch_id = p.blanch_id');
      $this->db->JOIN('tbl_company c','c.comp_id = c.comp_id');
      $this->db->JOIN('tbl_customer cs','cs.customer_id = p.customer_id');
      $this->db->JOIN('tbl_loans l','l.loan_id = p.loan_id');
      $this->db->JOIN('tbl_account_transaction at','at.trans_id = p.depost_method');
      $this->db->JOIN('tbl_employee e','e.empl_id = p.empl_id');
      $data = $this->db->get('tbl_depost p');
         return $data->result();
 }

 public function get_blanch_total_receved($blanch_id,$comp_id,$depost_day){
 	$date = date("Y-m-d");
 	$total = $this->db->query("SELECT SUM(depost) AS Total_Depost,SUM(double_amont) AS total_double FROM tbl_depost WHERE blanch_id = '$blanch_id' AND comp_id = '$comp_id' AND depost_day = '$date'");
 	  return $total->row();
 }

 public function get_blanchRecevedData($blanch_id){
 	$blanch = $this->db->query("SELECT * FROM tbl_blanch WHERE blanch_id = '$blanch_id'");
 	 return $blanch->row();
 }


 public function outstand_loan($comp_id){
 	$data = $this->db->query("SELECT COUNT(p.pend_id) AS pending_day,c.f_name,c.m_name,c.l_name,b.blanch_name,c.phone_no,l.loan_int,l.restration,l.day,l.session,ot.remain_amount,o.loan_stat_date,o.loan_end_date FROM tbl_outstand_loan ot LEFT JOIN tbl_loans l ON l.loan_id = ot.loan_id LEFT JOIN tbl_customer c ON c.customer_id = ot.customer_id LEFT JOIN tbl_outstand o ON o.loan_id = ot.loan_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_loan_pending p ON p.loan_id = ot.loan_id WHERE ot.comp_id = '$comp_id' AND ot.out_status = 'open' GROUP BY p.loan_id");
 	 return $data->result();
 }

 public function total_outstand_loan($comp_id){
 	$data = $this->db->query("SELECT SUM(remain_amount) AS total_out FROM tbl_outstand_loan WHERE comp_id = '$comp_id' AND out_status = 'open'");
 	 return $data->row();
 }

 public function total_outstand_Blanch($blanch_id){
 	$data = $this->db->query("SELECT SUM(remain_amount) AS total_out FROM tbl_outstand_loan WHERE blanch_id = '$blanch_id'");
 	 return $data->row();
 }

  public function total_outstand_loanBlanch($blanch_id){
 	$data = $this->db->query("SELECT SUM(remain_amount) AS total_out FROM tbl_outstand_loan WHERE blanch_id = '$blanch_id' AND out_status = 'open'");
 	 return $data->row();
 }

  public function outstand_loanBlanch($blanch_id){
  	$data = $this->db->query("SELECT COUNT(p.pend_id) AS pending_day,c.f_name,c.m_name,c.l_name,b.blanch_name,c.phone_no,l.loan_int,l.restration,l.day,l.session,ot.remain_amount,o.loan_stat_date,o.loan_end_date,ot.out_status FROM tbl_outstand_loan ot JOIN tbl_loans l ON l.loan_id = ot.loan_id JOIN tbl_customer c ON c.customer_id = ot.customer_id JOIN tbl_outstand o ON o.loan_id = ot.loan_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_loan_pending p ON p.loan_id = ot.loan_id WHERE ot.blanch_id = '$blanch_id' AND ot.out_status = 'open' GROUP BY p.loan_id");
 	 return $data->result();
 }

 public function insert_superUser($data){
 	return $this->db->insert('tbl_super_admin',$data);
 }

 public function get_super_admin(){
 	$data = $this->db->query("SELECT * FROM tbl_super_admin");
 	 return $data->result();
 }

 public function get_all_company(){
 	$data = $this->db->query("SELECT * FROM tbl_company JOIN tbl_region ON tbl_region.region_id = tbl_company.region_id ORDER BY comp_id DESC");
 	 return $data->result();
 }


 public function get_all_blanchCom($comp_id){
 	$blanch = $this->db->query("SELECT * FROM tbl_blanch b JOIN tbl_region r ON r.region_id 
 	= b.region_id WHERE b.comp_id = '$comp_id'");
 	 return $blanch->result();
 }

 public function get_all_customer($comp_id){
 	$customer = $this->db->query("SELECT * FROM tbl_customer WHERE comp_id = '$comp_id' ORDER BY customer_id DESC");
 	  return $customer->result();
 }


 public function get_employee_email($comp_id){
 	$empl = $this->db->query("SELECT * FROM tbl_employee e JOIN tbl_blanch b ON b.blanch_id =  e.blanch_id WHERE e.comp_id = '$comp_id'");
 	 return $empl->result();
 }

 public function get_loanIncomeHistory($customer_id){
 	$income = $this->db->query("SELECT * FROM  tbl_receve r JOIN tbl_income i ON i.inc_id = r.inc_id  WHERE r.customer_id = '$customer_id'");
 	 return $income->result();
 }

 public function get_compData($comp_id){
 	$data = $this->db->query("SELECT * FROM tbl_company WHERE comp_id = '$comp_id'");
 	 return $data->row();
 }


 public function get_penddata($from,$to,$blanch_id){
 	$data = $this->db->query("SELECT pt.blanch_id,b.blanch_name FROM tbl_pending_total pt LEFT JOIN tbl_blanch b ON b.blanch_id = pt.blanch_id LEFT JOIN tbl_customer c ON c.customer_id = pt.customer_id WHERE pt.date between '$from' and '$to' AND pt.blanch_id = '$blanch_id' AND pt.total_pend IS NOT FALSE GROUP BY pt.blanch_id");
 	return $data->result();
 }


 public function get_blanch_loan_pend($from,$to,$blanch_id){
 	$data = $this->db->query("SELECT * FROM tbl_pending_total pt LEFT JOIN tbl_blanch b ON b.blanch_id = pt.blanch_id LEFT JOIN tbl_customer c ON c.customer_id = pt.customer_id LEFT JOIN tbl_loans l ON l.loan_id = pt.loan_id WHERE pt.date between '$from' and '$to' AND pt.blanch_id = '$blanch_id' AND pt.total_pend IS NOT FALSE");

 	foreach ($data->result() as $r) {
 	$r->total_penart = $this->get_total_penart_pending($r->loan_id);
	 $r->total_pay_penart = $this->get_pay_penart_loan($r->loan_id);
 	}
 	return $data->result();
 }

 public function get_total_blanch($comp_id){
 	$blanch = $this->db->query("SELECT COUNT('comp_id') AS total_bla FROM tbl_blanch WHERE comp_id = '$comp_id'");
 	return $blanch->row();
 }

 public function get_managertest($empl_id){
 	$data = $this->db->query("SELECT * FROM tbl_employee WHERE empl_id = '$empl_id'");
 	 return $data->row();
 }


 public function get_sumEmployee($comp_id){
 	$empl = $this->db->query("SELECT COUNT(empl_id) AS total_employee FROM tbl_employee WHERE comp_id = '$comp_id'");
 	 return $empl->row();
 }

//total customer
 public function get_total_customer($comp_id){
 	$customer = $this->db->query("SELECT COUNT(customer_id) AS total_cust FROM tbl_customer WHERE comp_id = '$comp_id'");
 	 return $customer->row();
 }

 public function get_total_customerBlanch($blanch_id){
 	$customer = $this->db->query("SELECT COUNT(customer_id) AS total_custBlanch FROM tbl_customer WHERE blanch_id = '$blanch_id'");
 	 return $customer->row();
 }

  public function get_total_customerActive($comp_id){
 	$customer = $this->db->query("SELECT COUNT(customer_id) AS total_Active FROM tbl_customer WHERE comp_id = '$comp_id' AND customer_status = 'open'");
 	 return $customer->row();
 }

  public function get_total_customerActiveBlanch($blanch_id){
 	$customer = $this->db->query("SELECT COUNT(customer_id) AS total_ActiveBla FROM tbl_customer WHERE blanch_id = '$blanch_id' AND customer_status = 'open'");
 	 return $customer->row();
 }

  public function get_total_customerPending($comp_id){
 	$customer = $this->db->query("SELECT COUNT(customer_id) AS total_pending FROM tbl_customer WHERE comp_id = '$comp_id' AND customer_status = 'pending'");
 	 return $customer->row();
 }


  public function get_total_customerPendingBlanch($blanch_id){
 	$customer = $this->db->query("SELECT COUNT(customer_id) AS total_pendingblanch FROM tbl_customer WHERE blanch_id = '$blanch_id' AND customer_status = 'pending'");
 	 return $customer->row();
 }

 public function get_loan_request($comp_id){
 	$loan_request = $this->db->query("SELECT COUNT(loan_id) AS loan_request FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'open'");
 	 return $loan_request->row();
 }

  public function get_loan_requestBlanch($blanch_id){
 	$loan_request = $this->db->query("SELECT COUNT(loan_id) AS loan_requests FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'open'");
 	 return $loan_request->row();
 }

 public function get_loan_Aproved($comp_id){
 	$loan_request = $this->db->query("SELECT COUNT(loan_id) AS loan_aproved FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'aproved'");
 	 return $loan_request->row();
 }

  public function get_loan_AprovedBlanh($blanch_id){
 	$loan_request = $this->db->query("SELECT COUNT(loan_id) AS loan_aprovedBlanch FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'aproved'");
 	 return $loan_request->row();
 }

 public function get_today_loanPending($comp_id){
 	$date = date("Y-m-d");
 	$pendLoan = $this->db->query("SELECT COUNT(pend_id) AS loan_pend FROM tbl_loan_pending WHERE comp_id = '$comp_id'AND action_date >= '$date'");
 	 return $pendLoan->row();
 }

 public function get_today_loanPendingBlanch($blanch_id){
 	$date = date("Y-m-d");
 	$pendLoan = $this->db->query("SELECT COUNT(pend_id) AS loan_pends FROM tbl_loan_pending WHERE blanch_id = '$blanch_id'AND action_date >= '$date'");
 	 return $pendLoan->row();
 }

 public function loan_disbursedBlanch($blanch_id){
 	$disburse = $this->db->query("SELECT COUNT(loan_id) AS loandisburse FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'disbarsed'");
 	return $disburse->row();
 }



 public function get_total_recevableComp($comp_id){
    	$date = date("Y-m-d");
    	$today_data = $this->db->query("SELECT SUM(restration) AS total_reje FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'withdrawal' AND date_show = '$date'");
    	return $today_data->row();
    }

     public function get_total_recevableBlanchdata($blanch_id){
    	$date = date("Y-m-d");
    	$today_data = $this->db->query("SELECT SUM(restration) AS total_receiva FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'withdrawal' AND date_show = '$date'");
    	return $today_data->row();
    }


    public function get_recomended_expencesnumber($comp_id){
    	$data = $this->db->query("SELECT COUNT(req_id) AS expences_request FROM tbl_request_exp WHERE comp_id = '$comp_id' AND req_status = 'open'");
    	 return $data->row();
    }


    public function get_blanch_wallet($blanch_id){
    	$blanch_wallet = $this->db->query("SELECT SUM(blanch_amount) AS blanch_walet FROM tbl_transfor WHERE blanch_id = '$blanch_id'");
    	 return $blanch_wallet->row();
    }

    public function get_total_incomeBlanch($blanch_id){
    	$income = $this->db->query("SELECT SUM(receve_amount) AS total_incomeBlanch FROM tbl_receve WHERE blanch_id = '$blanch_id'");
    	return $income->row();
    }

    public function get_phoneNumber_match(){
    	$phone = $this->db->query("SELECT * FROM tbl_customer");
    	 return $phone->row();
    }

    public function get_sum_loanpend($comp_id){
    	$date = date("Y-m-d");
    	$loan_pend = $this->db->query("SELECT SUM(return_total) AS total_pend FROM tbl_loan_pending WHERE comp_id = '$comp_id' AND action_date >= '$date'");
    	 return $loan_pend->row();
    }

    public function get_sum_loanpendBlanch($blanch_id){
    	$date = date("Y-m-d");
    	$loan_pend = $this->db->query("SELECT SUM(return_total) AS total_pendsy FROM tbl_loan_pending WHERE blanch_id = '$blanch_id' AND action_date >= '$date'");
    	 return $loan_pend->row();
    }


    public function get_outstand_total_blanch($blanch_id){
    	$outSatand = $this->db->query("SELECT SUM(remain_amount) AS total_remainblanch FROM tbl_outstand_loan WHERE blanch_id = '$blanch_id'");
    	return $outSatand->row();
    }

    public function get_customerCosed($blanch_id){
    	$closed = $this->db->query("SELECT COUNT(customer_id) AS total_closed FROM tbl_customer WHERE blanch_id = '$blanch_id' AND customer_status = 'close'");
    	 return $closed->row();
    }


    public function get_today_receivableBlanch($blanch_id){
    	$date = date("Y-m-d");
    	$receivable = $this->db->query("SELECT SUM(depost) AS today_blanchDepost FROM tbl_depost WHERE blanch_id = '$blanch_id' AND depost_day = '$date'");
    	 return $receivable->row();
    }

    public function get_requstExpensesBlanch($blanch_id){
    	$data = $this->db->query("SELECT COUNT(req_id) AS total_request_number FROM tbl_request_exp WHERE blanch_id = '$blanch_id' AND req_status = 'open'");
    	 return $data->row();
    }

   public function get_get_updated_request($req_id){
   	$data = $this->db->query("SELECT * FROM  tbl_request_exp WHERE req_id = '$req_id'");
   	return $data->row();
   }

   public function get_remain_company_balance($trans_id){
   	$data = $this->db->query("SELECT * FROM  tbl_ac_company WHERE trans_id = '$trans_id'");
   	 return $data->row();
   }

   public function get_remainBlanch_balance($trans_id){
   	$data = $this->db->query("SELECT * FROM tbl_transfor WHERE trans_id = '$trans_id'");
   	return $data->row();
   }

   public function get_blanch_account_remain($blanch_id){
   	$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$blanch_id'");
   	 return $data->row();
   }

   public function check_name($f_name,$m_name,$l_name){
		$data = $this->db->where(['f_name'=>$f_name , 'm_name'=>$m_name,'l_name'=>$l_name])
    	        ->get('tbl_customer');
    	  if ($data->num_rows() > 0) {
    	  	return $data->row();
    	  	
    	  }
       }

       public function check_Group_name($f_name){
		$data = $this->db->where(['f_name'=>$f_name])
    	        ->get('tbl_customer');
    	  if ($data->num_rows() > 0) {
    	  	return $data->row();
    	  	
    	  }
       }

    public function check_national_Id($natinal_identity){
		$data = $this->db->where(['natinal_identity'=>$natinal_identity])
    	        ->get('tbl_sub_customer');
    	  if ($data->num_rows() > 0) {
    	  	return $data->row();
    	  	
    	  }
       }

       public function get_blanch_balance($blanch_id){
       	$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$blanch_id'");
       	return $data->row();
       }

       public function get_receive_data($receved_id){
       	$data = $this->db->query("SELECT * FROM tbl_receve WHERE receved_id = '$receved_id'");
       	return $data->row();
       }


       public function get_sumLoanFee($comp_id){
       	$loanfee = $this->db->query("SELECT SUM(fee_interest) AS total_fee FROM tbl_loan_fee WHERE comp_id = '$comp_id'");
       	return $loanfee->row();
       }


       public function get_customerData($customer_id){
       	$customer = $this->db->query("SELECT * FROM tbl_customer WHERE customer_id = '$customer_id' LIMIT 1");
       	 return $customer->row();
       }

       public function get_comp_data($comp_id){
       	$data = $this->db->query("SELECT * FROM tbl_company WHERE comp_id = '$comp_id' LIMIT 1");
       	 return $data->row();
       }


       public function delete_company($comp_id){
       	return $this->db->delete('tbl_company',['comp_id'=>$comp_id]);
       } 


       public function update_smsStatus($comp_id,$data){
       	return $this->db->where('comp_id',$comp_id)->update('tbl_company',$data);
       }


       public function getOutstand_loanData($loan_id){
       	$data = $this->db->query("SELECT * FROM tbl_outstand_loan WHERE loan_id = '$loan_id' LIMIT 1");
       	 return $data->row();
       }



       public function get_payID_outstand_loan($pay_id){
       	$data = $this->db->query("SELECT * FROM tbl_outstand_loan WHERE pay_id = '$pay_id'");
       	 return $data->row();
       }


       public function get_loanCustomerCode($customer_id){
       	$data = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id WHERE l.customer_id = '$customer_id' ORDER BY l.loan_id DESC");
       	 return $data->row();
       }


       public function get_customerLoanStatement($loan_id){
       	$data = $this->db->query("SELECT * FROM tbl_customer_report WHERE loan_id = '$loan_id'");
       	 return $data->row();
       }



       public function get_loan_aprove($comp_id){
       	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loanAprove FROM tbl_loans WHERE comp_id = '$comp_id'");
       	 return $data->row();
       }

       //blanch open

       public function get_loan_aproveBlanch($blanch_id){
       		$date = date("Y-m-d");
         $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
         //print_r($back);
       	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loanAprove FROM tbl_loans WHERE blanch_id = '$blanch_id' AND disburse_day = '$back'");
       	 return $data->row();
       }

        public function get_loan_aproveclose($comp_id){
        	$day = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loanAproveclose FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'withdrawal' AND disburse_day = '$day'");
       	 return $data->row();
       }
       //blanch close
        public function get_loan_aprovecloseBlanch($blanch_id){
        	$day = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loanAproveclose FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'withdrawal' AND disburse_day = '$day'");
       	 return $data->row();
       }



       public function get_total_withAmount($comp_id){
       	$data = $this->db->query("SELECT SUM(with_amount) AS withdrawal_amount FROM tbl_loans WHERE comp_id = '$comp_id'");
       	 return $data->row();
       }

       //blanch open

        public function get_total_withAmountBlanch($blanch_id){
        $date = date("Y-m-d");
        $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
       	$data = $this->db->query("SELECT SUM(with_amount) AS withdrawal_amount FROM tbl_loans WHERE blanch_id = '$blanch_id' AND disburse_day = '$back'");
       	 return $data->row();
       }

        public function get_total_withAmountclose($comp_id){
        	$day = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(with_amount) AS withdrawal_amountclose FROM tbl_loans WHERE comp_id = '$comp_id' AND disburse_day = '$day'");
       	 return $data->row();
       }
       //blanch close
       public function get_total_withAmountcloseBlanch($blanch_id){
        	$day = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(with_amount) AS withdrawal_amountclose FROM tbl_loans WHERE blanch_id = '$blanch_id' AND disburse_day = '$day'");
       	 return $data->row();
       }


       public function get_totalDepost($comp_id){
       	$data = $this->db->query("SELECT SUM(depost) AS Total_depost FROM tbl_depost WHERE comp_id = '$comp_id'");
       	 return $data->row();
       }

       //blanch depost

       public function get_totalDepostBlanch($blanch_id){
       	$date = date("Y-m-d");
        $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
       	$data = $this->db->query("SELECT SUM(depost) AS Total_depost FROM tbl_depost WHERE blanch_id = '$blanch_id' AND depost_day = '$back'");
       	 return $data->row();
       }


        public function get_totalDepostClose($comp_id){
        $day = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(depost) AS Total_depostClose FROM tbl_depost WHERE comp_id = '$comp_id' AND depost_day = '$day'");
       	 return $data->row();
       }

       //blanch close
        public function get_totalDepostCloseBlanch($blanch_id){
        $day = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(depost) AS Total_depostClose FROM tbl_depost WHERE blanch_id = '$blanch_id' AND depost_day = '$day'");
       	 return $data->row();
       }


       public function get_sumReceve($comp_id){
       	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receve_amaount FROM tbl_receve WHERE comp_id = '$comp_id'");
       	 return $data->row();
       }

       //blanch receive open
     public function get_sumReceveBlanch($blanch_id){
     	  $date = date("Y-m-d");
        $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
       	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receve_amaount FROM tbl_receve WHERE blanch_id = '$blanch_id' AND receve_day = '$back'");
       	 return $data->row();
       }

        public function get_sumReceveClose($comp_id){
        	$day = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receve_amaountClose FROM tbl_receve WHERE comp_id = '$comp_id' AND receve_day = '$day'");
       	 return $data->row();
       }

       //blanch close
         public function get_sumReceveCloseBlanch($blanch_id){
        	$day = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receve_amaountClose FROM tbl_receve WHERE blanch_id = '$blanch_id' AND receve_day = '$day'");
       	 return $data->row();
       }


       public function get_expencesData($comp_id){
       	$data = $this->db->query("SELECT SUM(req_amount) AS total_exp FROM tbl_request_exp WHERE comp_id = '$comp_id' AND req_status = 'accept'");
       	 return $data->row();
       }

       //blanch openexpences

        public function get_expencesDataBlanch($blanch_id){
        $date = date("Y-m-d");
        $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
       	$data = $this->db->query("SELECT SUM(req_amount) AS total_exp FROM tbl_request_exp WHERE comp_id = '$blanch_id' AND req_date = '$back' AND req_status = 'accept'");
       	 return $data->row();
       }

       public function get_expencesDataClose($comp_id){
       	$day = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(req_amount) AS total_expClose FROM tbl_request_exp WHERE comp_id = '$comp_id' AND req_status = 'accept' AND req_date = '$day'");
       	 return $data->row();
       }

       public function get_expencesDataCloseBlanch($blanch_id){
       	$day = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(req_amount) AS total_expClose FROM tbl_request_exp WHERE blanch_id = '$blanch_id' AND req_status = 'accept' AND req_date = '$day'");
       	 return $data->row();
       }


       public function get_loanOpen_skip($customer_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_loan_category lc ON lc.category_id = l.category_id LEFT JOIN tbl_group g ON g.group_id = l.group_id WHERE l.customer_id = '$customer_id' AND l.loan_status = 'open' ORDER BY l.loan_id DESC LIMIT 1");
       	return $loan->row();
       }


       public function get_loanOpen_skipReject($customer_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_loan_category lc ON lc.category_id = l.category_id LEFT JOIN tbl_group g ON g.group_id = l.group_id WHERE l.customer_id = '$customer_id' AND l.loan_status = 'reject' ORDER BY l.loan_id DESC LIMIT 1");
       	return $loan->row();
       }


       public function upadete_loan($data,$loan_id){
       	return $this->db->where('loan_id',$loan_id)->update('tbl_loans',$data);
       }



       public function get_localgovernmentDetail($loan_id){
       	$data = $this->db->query("SELECT * FROM tbl_attachment at LEFT JOIN tbl_region r ON r.region_id = at.region_oficer  WHERE at.loan_id = '$loan_id'");
       	 return $data->row();
       }


       public function update_localDetail($data,$attach_id){
       	return $this->db->where('attach_id',$attach_id)->update('tbl_attachment',$data);
       }



       public function get_total_depost($loan_id){
       	$data = $this->db->query("SELECT SUM(depost) AS total_depost FROM tbl_depost WHERE loan_id = '$loan_id' LIMIT 1");
       	 return $data->row();
       }


   public function get_all_customerBlanch($blanch_id){
 	$customer = $this->db->query("SELECT * FROM tbl_customer WHERE blanch_id = '$blanch_id' ORDER BY customer_id DESC");
 	  return $customer->result();
 }


 public function get_customerInfor($customer_id){
 	$data = $this->db->query("SELECT * FROM tbl_customer c JOIN tbl_region r ON r.region_id = c.region_id WHERE c.customer_id = '$customer_id'");
 	  return $data->row();
 }


 public function update_customerData($customer_id,$data){
 	return $this->db->where('customer_id',$customer_id)->update('tbl_customer',$data);
 }

 public function get_lastdata($customer_id){
 	$data = $this->db->query("SELECT * FROM tbl_sub_customer sc JOIN tbl_account_type at ON at.account_id = sc.account_id  WHERE sc.customer_id = '$customer_id'");
 	 return $data->row();
 }


 public function update_lastCustomerData($customer_id,$data){
 	return $this->db->where('customer_id',$customer_id)->update('tbl_sub_customer',$data);
 }


 public function getTotal_reqExpences($comp_id){
 	$data = $this->db->query("SELECT SUM(req_amount) AS total_reqExp FROM tbl_request_exp WHERE comp_id = '$comp_id' AND req_status = 'accept'");
 	return $data->row();
 }


 public function get_loan_collection($comp_id){
 	$loan_data = $this->db->query("SELECT pn.penart_paid,SUM(d.depost) AS total_depost,c.f_name,c.m_name,c.l_name,b.blanch_name,l.loan_id,l.loan_int,l.restration,l.loan_status,ot.loan_end_date,e.username,l.day,ot.loan_stat_date,SUM(d.double_amont) AS total_double,l.loan_aprove FROM tbl_loans l 
	 LEFT JOIN tbl_pay_penart pn ON pn.loan_id = l.loan_id  
	 LEFT JOIN tbl_depost d ON d.loan_id = l.loan_id 
	 JOIN tbl_customer c ON c.customer_id = l.customer_id 
	 JOIN tbl_blanch b ON b.blanch_id = l.blanch_id 
	 LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id 
	 LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id  
	 WHERE  l.comp_id = '$comp_id' GROUP BY l.loan_id");
 	foreach($loan_data->result() as $r){
 		$r->total_penart_amount = $this->get_total_penartData($r->loan_id);
 	}

 	return $loan_data->result();
 }


  public function get_loan_collectionBlanch($blanch_id){
 	$loan_data = $this->db->query("SELECT pn.penart_paid,SUM(d.depost) AS total_depost,SUM(d.double_amont) AS total_double,c.f_name,c.m_name,c.l_name,b.blanch_name,l.loan_id,l.loan_int,l.restration,l.loan_status,ot.loan_end_date,ot.loan_stat_date,e.username,l.day  FROM tbl_loans l 
	 LEFT JOIN tbl_pay_penart pn ON pn.loan_id = l.loan_id  
	 LEFT JOIN tbl_depost d ON d.loan_id = l.loan_id 
	 LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id 
	 LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id 
	 LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id 
	 LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id  
	 WHERE  l.blanch_id = '$blanch_id'  GROUP BY l.loan_id ORDER BY l.loan_id DESC");
 	foreach($loan_data->result() as $r){
 		$r->total_penart_amount = $this->get_total_penartData($r->loan_id);
 	}

 	return $loan_data->result();
 }


  public function get_total_penartData($loan_id){
		$penart = $this->db->query("SELECT SUM(penart_amount) AS total_penart_amount FROM tbl_customer_report cr WHERE loan_id = '$loan_id' GROUP BY loan_id");
		if ($penart->row()) {
			return $penart->row()->total_penart_amount; 
		}
		return 0; 
		  }


 



 public function get_paidPenart($loan_id){
 	$data = $this->db->query("SELECT * FROM tbl_pay_penart WHERE loan_id = '$loan_id'");
 	 return $data->row();
 }


 public function get_total_loan($comp_id){
 	$data = $this->db->query("SELECT SUM(loan_int) AS total_loan,SUM(loan_aprove) AS total_aprove_loan FROM tbl_loans WHERE comp_id = '$comp_id'");
 	 return $data->row();
 }

  public function get_total_loanBlanch($blanch_id){
 	$data = $this->db->query("SELECT SUM(loan_int) AS total_loan FROM tbl_loans WHERE blanch_id = '$blanch_id'");
 	 return $data->row();
 }

 public function get_totalPaid_loan($comp_id){
 	$loan_paid = $this->db->query("SELECT SUM(depost) AS total_loan_depost,SUM(double_amont) AS double_total FROM tbl_depost WHERE comp_id = '$comp_id'");
 	 return $loan_paid->row();
 }

  public function get_totalPaid_loanBlanch($blanch_id){
 	$loan_paid = $this->db->query("SELECT SUM(depost) AS total_loan_depost,SUM(double_amont) AS double_total FROM tbl_depost WHERE blanch_id = '$blanch_id'");
 	 return $loan_paid->row();
 }


 public function get_total_penart($comp_id){
 	$penart = $this->db->query("SELECT SUM(penart_amount) AS penart_amount FROM tbl_customer_report WHERE comp_id = '$comp_id'");
 	return $penart->row();
 }


 public function get_total_penartBlanch($blanch_id){
 	$penart = $this->db->query("SELECT SUM(penart_amount) AS penart_amount FROM tbl_customer_report WHERE blanch_id = '$blanch_id'");
 	return $penart->row();
 }

 public function get_paid_penart($comp_id){
 	$penart_paid = $this->db->query("SELECT SUM(penart_paid) AS total_penart_paid FROM tbl_pay_penart WHERE comp_id = '$comp_id'");
 	return $penart_paid->row();
 }



 public function get_paid_penartBlanch($blanch_id){
 	$penart_paid = $this->db->query("SELECT SUM(penart_paid) AS total_penart_paid FROM tbl_pay_penart WHERE blanch_id = '$blanch_id'");
 	return $penart_paid->row();
 }







 public function filter_loanstatus($blanch_id,$loan_status,$comp_id){
 	$loan_data = $this->db->query("SELECT pn.penart_paid,SUM(d.depost) AS total_depost,c.f_name,c.m_name,c.l_name,b.blanch_name,l.loan_id,l.loan_int,l.restration,l.loan_status,ot.loan_end_date,e.username,l.day,ot.loan_stat_date,SUM(d.double_amont) AS total_double,l.loan_aprove  FROM tbl_loans l 
	 LEFT JOIN tbl_pay_penart pn ON pn.loan_id = l.loan_id  
	 LEFT JOIN tbl_depost d ON d.loan_id = l.loan_id 
	 JOIN tbl_customer c ON c.customer_id = l.customer_id 
	 JOIN tbl_blanch b ON b.blanch_id = l.blanch_id 
	 LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id 
	 LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id  
	 WHERE l.blanch_id = '$blanch_id' AND l.loan_status = '$loan_status' AND l.comp_id = '$comp_id' GROUP BY l.loan_id");
 	foreach($loan_data->result() as $r){
 		$r->total_penart_amount = $this->get_total_penartData($r->loan_id);
 	}

 	return $loan_data->result();
 }


 public function get_total_loanFilter($blanch_id,$loan_status,$comp_id){
 	$data = $this->db->query("SELECT SUM(loan_int) AS total_loan,SUM(loan_aprove) AS total_aprove FROM tbl_loans WHERE  blanch_id = '$blanch_id' AND loan_status = '$loan_status' AND comp_id = '$comp_id'");
 	 return $data->row();
 }


  public function get_totalPaid_loanFilter($blanch_id,$loan_status,$comp_id){
 	$loan_paid = $this->db->query("SELECT SUM(d.depost) AS total_loan_depost,l.loan_status,SUM(d.double_amont) AS total_double FROM tbl_depost d LEFT JOIN tbl_loans l ON l.loan_id = d.loan_id WHERE d.blanch_id = '$blanch_id' AND l.loan_status = '$loan_status' AND d.comp_id = '$comp_id'");
 	 return $loan_paid->row();
 }


 public function get_total_penartFilter($blanch_id,$loan_status,$comp_id){
 	$penart = $this->db->query("SELECT SUM(cr.penart_amount) AS penart_amount FROM tbl_customer_report cr LEFT JOIN tbl_loans l ON l.loan_id = cr.loan_id WHERE  l.blanch_id = '$blanch_id' AND l.loan_status = '$loan_status' AND cr.comp_id = '$comp_id'");
 	return $penart->row();
 }


 public function get_paid_penartFilter($blanch_id,$loan_status,$comp_id){
 	$penart_paid = $this->db->query("SELECT SUM(pn.penart_paid) AS total_penart_paid  FROM tbl_pay_penart pn JOIN tbl_loans l ON l.loan_id = pn.loan_id WHERE pn.blanch_id = '$blanch_id' AND l.loan_status = '$loan_status' AND  pn.comp_id = '$comp_id'");
 	return $penart_paid->row();
 }


 public function get_sum_dapost($loan_id){
 	$data = $this->db->query("SELECT SUM(depost) AS remain_balance_loan FROM tbl_depost WHERE loan_id = '$loan_id' LIMIT 1");
 	  return $data->row();
 }


 public function get_customer_statusData($blanch_id,$comp_id,$customer_status){
 	$data = $this->db->query("SELECT * FROM tbl_customer c LEFT JOIN tbl_region r ON r.region_id = c.region_id LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id WHERE c.comp_id = '$comp_id' AND c.blanch_id = '$blanch_id' AND c.customer_status = '$customer_status' GROUP BY c.blanch_id");
 	return $data->result();
 }

 public function get_customer_statusData_comp($comp_id,$customer_status){
 	$data = $this->db->query("SELECT * FROM tbl_customer c LEFT JOIN tbl_region r ON r.region_id = c.region_id LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id WHERE c.comp_id = '$comp_id' AND c.customer_status = '$customer_status' GROUP BY c.blanch_id");
 	return $data->result();
 }


 public function get_customer_blanch_data($blanch_id,$customer_status){
 	$data = $this->db->query("SELECT * FROM tbl_customer c LEFT JOIN tbl_region r ON r.region_id = c.region_id LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id WHERE c.blanch_id = '$blanch_id' AND c.customer_status = '$customer_status'");
 	return $data->result();
 }


public function get_interestFormular($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_formular_setting WHERE comp_id = '$comp_id'");
	return $data->result();
}

public function remove_formular($id){
	return $this->db->delete('tbl_formular_setting',['id'=>$id]);
}


public function get_reminder_loan($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_company ca ON ca.comp_id = l.comp_id WHERE l.loan_id = '$loan_id'");
	 return $data->row();
}

  
//sms counter
 public function get_smsCountDate($comp_id){
 	$today = date("Y-m-d");
  $sms_count = $this->db->query("SELECT * FROM tbl_sms_count WHERE comp_id = '$comp_id' AND date = '$today'");
  return  $sms_count->row();
 }

 public function get_smshIStorY($comp_id){
 $data = $this->db->query("SELECT * FROM tbl_sms_count WHERE comp_id = '$comp_id'");
  return $data->result();
 }

  public function get_sumSmsHistory($comp_id){
 $data = $this->db->query("SELECT SUM(sms_number) AS total_sms_history FROM tbl_sms_count WHERE comp_id = '$comp_id'");
  return $data->row();
 }

 public function get_data_sms($from,$to,$comp_id){
 	$sms = $this->db->query("SELECT * FROM tbl_sms_count WHERE date between '$from' and '$to' AND comp_id = '$comp_id'");
 	return $sms->result();

}

public function get_sumSms_total($from,$to,$comp_id){
 	$sms = $this->db->query("SELECT SUM(sms_number) AS total_sms FROM tbl_sms_count WHERE date between '$from' and '$to' AND comp_id = '$comp_id'");
 	return $sms->row();

}

public function get_depost_adjust($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_pay WHERE loan_id = '$loan_id' ORDER BY pay_id DESC");
	return $data->row();
}

public function loanWithdrawaldate($blanch_id,$from,$to,$loan_status){
	$data = $this->db->query("SELECT SUM(with_amount) AS total_with FROM tbl_loans WHERE disburse_day between '$from' and '$to' AND blanch_id = '$blanch_id' AND loan_status = '$loan_status'");
	return $data->row();
}


public function get_allEmployee_Block($comp_id){
	$data = $this->db->query("SELECT tbl_employee.empl_status FROM tbl_employee WHERE comp_id = '$comp_id'");
		return $data->row();

}



//Account Transaction

public function insert_account_name($data){
	return $this->db->insert('tbl_account_transaction',$data);
}

public function get_account_transaction($comp_id){
    $data = $this->db->query("SELECT * FROM tbl_account_transaction WHERE comp_id = '$comp_id'");
       return $data->result();
}

public function get_customer_account_verfied($blanch_id){
	$data = $this->db->query("SELECT * FROM  tbl_blanch_account ba JOIN tbl_account_transaction at ON at.trans_id = ba.receive_trans_id  WHERE ba.blanch_id = '$blanch_id'");
	return $data->result();
}

//company account
public function get_customer_account_verfiedCompany($comp_id){
	$data = $this->db->query("SELECT SUM(ba.blanch_capital) AS total_blanch_comp,at.account_name FROM  tbl_blanch_account ba JOIN tbl_account_transaction at ON at.trans_id = ba.receive_trans_id  WHERE ba.comp_id = '$comp_id' GROUP BY ba.receive_trans_id");
	return $data->result();
}


public function delete_account($trans_id){
	return $this->db->delete('tbl_account_transaction',['trans_id'=>$trans_id]);
}


public function get_sumTotalCapital($comp_id){
	$data = $this->db->query("SELECT SUM(amount) AS total_capital FROM tbl_capital WHERE comp_id = '$comp_id'");
	   return $data->row();
}


public function get_total_sumaryAccount($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_ac_company ac JOIN tbl_account_transaction at ON at.trans_id = ac.trans_id WHERE ac.comp_id = '$comp_id'");
	  return $data->result();
}


public function get_account_balance($trans_id){
	$data = $this->db->query("SELECT * FROM tbl_ac_company WHERE trans_id = '$trans_id'");
	 return $data->row();
}

public function get_ledyAmount($to_account,$blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE receive_trans_id = '$to_account' AND blanch_id = '$blanch_id'");
	 return $data->row();
}

public function get_sumTransfor_chargers($comp_id){
	$today = date('Y-m-d');
	$data = $this->db->query("SELECT SUM(charger) AS total_chargers FROM tbl_transfor WHERE comp_id = '$comp_id'");
	 return $data->row();
}




public function get_sumBlanchCpital($blanch_id){
	$capital_blanch = $this->db->query("SELECT SUM(blanch_capital) AS total_capital FROM tbl_blanch_account WHERE blanch_id = '$blanch_id'");
	 return $capital_blanch->row();
}


public function get_sum_companyBalance($comp_id){
	$data = $this->db->query("SELECT SUM(comp_balance) AS total_comp_balance FROM tbl_ac_company WHERE comp_id = '$comp_id'");
	  return $data->row();
}


public function get_amount_remainAmountBlanch($blanch_id,$payment_method){
	$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$blanch_id' AND receive_trans_id = '$payment_method' LIMIT 1");
	return $data->row();
}

public function get_sumfeepercentage($loan_id){
   $data = $this->db->query("SELECT SUM(fee_percentage) AS total_fee  FROM tbl_pay WHERE loan_id = '$loan_id' LIMIT  1");
    return $data->row();
}


public function get_loanDeletedata($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_loans WHERE loan_id = '$loan_id'");
	  return $data->row();
}

public function get_total_loanDeposit($loan_id){
	$data = $this->db->query("SELECT SUM(depost) AS total_loanDepost FROM tbl_depost WHERE loan_id = '$loan_id'");
	 return $data->row();
}

public function get_Desc_depost($loan_id){
	$data = $this->db->query("SELECT * FROM  tbl_depost WHERE loan_id = '$loan_id' ORDER BY dep_id DESC");
	  return $data->row();
}


public function get_sum_total_BlanchCapital($comp_id){
	$data = $this->db->query("SELECT SUM(blanch_capital) AS total_capital_blanch FROM tbl_blanch_account WHERE comp_id = '$comp_id'");
	return $data->row();
}

public function get_blanch_depost_Balance($comp_id){
	$date = date("Y-m-d");
	$depost = $this->db->query("SELECT SUM(depost) AS total_depost FROM tbl_depost WHERE comp_id = '$comp_id' AND depost_day = '$date'");
	return $depost->row();
}

public function get_total_loanWithdrawal($comp_id){
	$date = date("Y-m-d");
  $data = $this->db->query("SELECT SUM(loan_aprove) AS total_loan_withdrawal FROM tbl_loans WHERE comp_id = '$comp_id' AND region_id = 'ok' AND disburse_day = '$date'");
  return $data->row();
}


public function check_nonDeducted_balance($comp_id,$blanch_id){
	$data = $this->db->query("SELECT * FROM  tbl_receive_non_deducted WHERE blanch_id = '$blanch_id'");
	 return $data->row();
}

public function get_deducted_blanch($blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_receive_deducted WHERE blanch_id = '$blanch_id' LIMIT 1");
	 return $data->row();
}


 public function get_interest_loan($loan_id){
 	$data = $this->db->query("SELECT * FROM tbl_prev_lecod pr JOIN tbl_loans l ON l.loan_id = pr.loan_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id WHERE pr.loan_id = '$loan_id' LIMIT 1");
 	return $data->row();
 }


 public function get_depost_record_data($loan_id){
 	$data = $this->db->query("SELECT * FROM tbl_depost WHERE loan_id = '$loan_id' ORDER BY dep_id DESC");
 	 return $data->row();
 }

 public function get_amount_deducted($loan_id){
 	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted FROM tbl_deducted_fee WHERE loan_id = '$loan_id'");
 	 return $data->row();
 }


 public function get_sum_nonDeducted_fee($loan_id){
 	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receive,blanch_id FROM tbl_receve WHERE loan_id = '$loan_id'");
 	return $data->row();
 }

 public function get_non_deducted_balance($blanch_id){
 	$data = $this->db->query("SELECT * FROM tbl_receive_non_deducted WHERE blanch_id = '$blanch_id'");
 	return $data->row();
 }

 public function get_sum_receive_deducted($blanch_id){
 	$data = $this->db->query("SELECT * FROM tbl_receive_deducted WHERE blanch_id = '$blanch_id'");
 	return $data->row();
 }


 public function get_deducted_income($comp_id){
 	$today = date("Y-m-d");
 	$data = $this->db->query("SELECT * FROM tbl_deducted_fee df LEFT JOIN tbl_loans l ON l.loan_id = df.loan_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_blanch b ON b.blanch_id = df.blanch_id WHERE df.comp_id = '$comp_id' AND df.deducted_date = '$today'");
 	return $data->result();
 }


 public function get_total_deducted_income($comp_id){
 	$today = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted FROM tbl_deducted_fee WHERE comp_id = '$comp_id' AND deducted_date = '$today'");
 	return $data->row();
 }


 public function get_deducted_account_balance($comp_id){
 	$data = $this->db->query("SELECT * FROM tbl_receive_deducted rd JOIN tbl_blanch b ON b.blanch_id = rd.blanch_id WHERE rd.comp_id = '$comp_id'");
 	 return $data->result();
 }


 public function fetch_blanch_account_data($blanch_id)
 {
  $this->db->where('blanch_id', $blanch_id);
  $this->db->order_by('ac_id', 'ASC');
  $query = $this->db->query("SELECT * FROM tbl_blanch_account ba JOIN tbl_account_transaction at ON at.trans_id = ba.receive_trans_id WHERE ba.blanch_id = '$blanch_id'");
  $output = '<option value="">Select Account</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->receive_trans_id.'">'.$row->account_name. '</option>';
  }
  return $output;
 }

 public function get_blance_deducted_fee($from_blanch){
 	$data = $this->db->query("SELECT * FROM  tbl_receive_deducted WHERE blanch_id = '$from_blanch'");
 	return $data->row();
 }

 public function get_blanch_accountBalance($to_blanch,$to_blanch_account){
 	$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$to_blanch' AND receive_trans_id = '$to_blanch_account'");
 	return $data->row();
 }

 public function get_balance_nonDeducted($from_blanch){
 	$data = $this->db->query("SELECT * FROM tbl_receive_non_deducted WHERE blanch_id = '$from_blanch'");
 	return $data->row();
 }


public function check_company_account($comp_id,$to_comp_account){
	$data = $this->db->query("SELECT * FROM  tbl_ac_company WHERE comp_id = '$comp_id' AND trans_id = '$to_comp_account'");
	return $data->row();
}

public function get_blanch_blanchdata($comp_id){
	$data = $this->db->query("SELECT tbb.deduct_type,tbb.from_blanch_id,tbb.from_mount,tbb.to_blanch_id,tbb.to_blach_account_id,tbb.trans_fee,tbb.user_trans,tbb.date_transfor,at.account_name,b.blanch_name AS from_blanch ,tb.blanch_name AS to_blanch,tbb.trans_fee,tbb.user_trans,tbb.date_transfor FROM  tbl_transfor_blanch_blanch tbb LEFT JOIN tbl_blanch b ON b.blanch_id = tbb.from_blanch_id JOIN tbl_account_transaction at ON at.trans_id = tbb.to_blach_account_id JOIN tbl_blanch tb ON tb.blanch_id = tbb.to_blanch_id WHERE tbb.comp_id = '$comp_id'");
	return $data->result();
}


public function get_branch_comTransaction($comp_id){
 $data = $this->db->query("SELECT * FROM tbl_transfor_blanch_company bc LEFT JOIN tbl_blanch b ON b.blanch_id = bc.from_blanch LEFT JOIN tbl_account_transaction at ON at.trans_id = bc.to_comp_account WHERE bc.comp_id = '$comp_id'");
 return $data->result();
}

public function get_totalBlanch_comptrans($comp_id){
$total = $this->db->query("SELECT SUM(balance) AS total_blanch_comp FROM  tbl_transfor_blanch_company WHERE comp_id = '$comp_id'");
return $total->row();
}

public function total_chargers_comp($comp_id){
	$data = $this->db->query("SELECT SUM(trans_fee) AS total_fee FROM  tbl_transfor_blanch_company WHERE comp_id = '$comp_id'");
	return $data->row();
}

public function get_totaldeducted_blanch($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_receive_deducted rd JOIN tbl_blanch b ON b.blanch_id = rd.blanch_id WHERE rd.comp_id = '$comp_id'");
	return $data->result();
}

public function getTotal_deducted($comp_id){
	$data = $this->db->query("SELECT SUM(deducted) AS total_deducted FROM tbl_receive_deducted WHERE comp_id = '$comp_id'");
	return $data->row();
}

public function get_nondeducted_blanch($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_receive_non_deducted nd JOIN tbl_blanch b ON b.blanch_id = nd.blanch_id WHERE nd.comp_id = '$comp_id'");
	return $data->result();
}

public function getTotal_deductednon($comp_id){
	$data = $this->db->query("SELECT SUM(non_balance) AS total_nondeducted FROM tbl_receive_non_deducted WHERE comp_id = '$comp_id'");
	return $data->row();
}


public function view_income_balance($blanch_id){
	$data = $this->db->query("SELECT SUM(deducted) AS total_deducted_blanch FROM tbl_receive_deducted WHERE blanch_id = '$blanch_id'");
	return $data->row();
}

public function get_nondeducted_blanchBalance($blanch_id){
	$data = $this->db->query("SELECT SUM(non_balance) AS total_nonBlance FROM tbl_receive_non_deducted WHERE blanch_id = '$blanch_id'");
	return $data->row();
}

public function get_blanch_accountExpenses($blanch_id,$trans_id){
	$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$blanch_id' AND receive_trans_id = '$trans_id'");
	return $data->row();
}

public function get_sum_principal_depost($comp_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(sche_principal) AS total_principal FROM tbl_depost WHERE comp_id = '$comp_id' AND depost_day = '$day'");
	return $data->row();
}

public function get_sum_interest_depost($comp_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(sche_interest) AS total_interest FROM tbl_depost WHERE comp_id = '$comp_id' AND depost_day = '$day'");
	return $data->row();
}

public function get_sum_principal_depostBranch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(sche_principal) AS total_principal FROM tbl_depost WHERE blanch_id = '$blanch_id' AND depost_day = '$day'");
	return $data->row();
}

public function get_sum_interest_depostBlanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(sche_interest) AS total_interest FROM tbl_depost WHERE blanch_id = '$blanch_id' AND depost_day = '$day'");
	return $data->row();
}


public function get_total_interest_total($comp_id){
	$interest = $this->db->query("SELECT SUM(sche_interest) AS total_interest FROM tbl_depost WHERE comp_id = '$comp_id' AND dep_status = 'withdrawal'");
	return $interest->row();
}

public function get_total_interest_totalOut($comp_id){
	$interest = $this->db->query("SELECT SUM(sche_interest) AS total_interestout FROM tbl_depost WHERE comp_id = '$comp_id' AND dep_status = 'out'");
	return $interest->row();
}



public function get_total_principal_repayment($comp_id){
	$data = $this->db->query("SELECT SUM(sche_principal) AS total_principal FROM tbl_depost WHERE comp_id = '$comp_id' AND dep_status = 'withdrawal'");
	return $data->row();
}

public function get_total_principal_repaymentout($comp_id){
	$data = $this->db->query("SELECT SUM(sche_principal) AS total_principalOut FROM tbl_depost WHERE comp_id = '$comp_id' AND dep_status = 'out'");
	return $data->row();
}


public function get_fee_deducted_total($comp_id){
	$data = $this->db->query("SELECT SUM(deducted) AS total_deducted_fee FROM tbl_receive_deducted WHERE comp_id = '$comp_id'");
	return $data->row();
}

public function get_sum_nonDeducted($comp_id){
	$data = $this->db->query("SELECT SUM(non_balance) AS total_nondeducted FROM tbl_receive_non_deducted WHERE comp_id = '$comp_id'");
	return $data->row();
}

public function get_blanch_capitalPrincipal($comp_id,$blanch_id,$trans_id,$princ_status){
	$data = $this->db->query("SELECT * FROM tbl_blanch_capital_principal WHERE blanch_id = '$blanch_id' AND trans_id = '$trans_id' AND princ_status = '$princ_status' LIMIT 1");
	return $data->row();
}

public function get_blanch_interest_capital($comp_id,$blanch_id,$trans_id,$princ_status){
	$data = $this->db->query("SELECT * FROM tbl_blanch_capital_interest WHERE blanch_id = '$blanch_id' AND trans_id = '$trans_id' AND int_status = '$princ_status' LIMIT 1");
	return $data->row();
}


public function get_interest_repayment($comp_id){
	$data = $this->db->query("SELECT SUM(capital_interest) AS total_capital_interest FROM tbl_blanch_capital_interest WHERE comp_id = '$comp_id' AND int_status = 'withdrawal'");
	return $data->row();
}


public function get_principal_blanchAccount($comp_id){
	$data = $this->db->query("SELECT SUM(principal_balance) AS total_principal FROM tbl_blanch_capital_principal WHERE comp_id = '$comp_id' AND princ_status = 'withdrawal'");
	return $data->row();
}


public function get_default_interest_repayment($comp_id){
	$data = $this->db->query("SELECT SUM(capital_interest) AS default_interest FROM tbl_blanch_capital_interest WHERE comp_id = '$comp_id' AND int_status = 'out'");
	return $data->row();
}


public function get_principal_blanchAccountDefault($comp_id){
	$data = $this->db->query("SELECT SUM(principal_balance) AS total_principal_default FROM tbl_blanch_capital_principal WHERE comp_id = '$comp_id' AND princ_status = 'out'");
	return $data->row();
}


public function get_accept_expensesBlanch($comp_id){
	$data = $this->db->query("SELECT SUM(re.req_amount) AS total_exp,b.blanch_name FROM tbl_request_exp re LEFT JOIN tbl_blanch b ON b.blanch_id = re.blanch_id WHERE re.comp_id = '$comp_id' AND req_status = 'accept' GROUP BY re.blanch_id");
	return $data->result();
}

public function get_sum_blanch_total_expenses($comp_id){
	$data = $this->db->query("SELECT SUM(req_amount) AS total_expense_data FROM tbl_request_exp WHERE comp_id = '$comp_id' AND req_status = 'accept'");
	return $data->row();
}

public function get_account_balance_blanch($comp_id){
	$data = $this->db->query("SELECT SUM(blanch_capital) AS total_blanch_balance,account_name FROM tbl_blanch_account ba JOIN tbl_account_transaction at ON at.trans_id = ba.receive_trans_id WHERE ba.comp_id = '$comp_id' GROUP BY ba.receive_trans_id");
		return $data->result();
	
}

public function get_total_blanch_capital($comp_id){
	$data = $this->db->query("SELECT SUM(blanch_capital) AS total_balanch_amount FROM tbl_blanch_account WHERE comp_id = '$comp_id'");
	return $data->row();
}


public function get_depost_loan_withdrawal($comp_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_depost,at.account_name FROM tbl_depost d JOIN tbl_account_transaction at ON at.trans_id = d.depost_method WHERE d.comp_id = '$comp_id' AND d.dep_status = 'withdrawal' AND d.depost_day = '$day' GROUP BY d.depost_method");
	return $data->result();
}

public function get_depost_loan_withdrawal_blanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_depost,at.account_name FROM tbl_depost d JOIN tbl_account_transaction at ON at.trans_id = d.depost_method WHERE d.blanch_id = '$blanch_id' AND d.dep_status = 'withdrawal' AND d.depost_day = '$day' GROUP BY d.depost_method");
	return $data->result();
}



public function get_total_depostloan_withdrawal($comp_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_depostinloan FROM tbl_depost WHERE comp_id = '$comp_id' AND depost_day = '$day' AND dep_status = 'withdrawal'");
	return $data->row();
}

public function get_total_depostloan_withdrawalBlanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_depostinloan FROM tbl_depost WHERE blanch_id = '$blanch_id' AND depost_day = '$day' AND dep_status = 'withdrawal'");
	return $data->row();
}

public function get_loanDepost_out($comp_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_deposOut,account_name FROM tbl_depost d JOIN tbl_account_transaction at ON at.trans_id = d.depost_method WHERE d.comp_id = '$comp_id' AND d.depost_day = '$day' AND d.dep_status = 'out' GROUP BY d.depost_method");
	return $data->result();
}

public function get_loanDepost_out_blanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_deposOut,account_name FROM tbl_depost d JOIN tbl_account_transaction at ON at.trans_id = d.depost_method WHERE d.blanch_id = '$blanch_id' AND d.depost_day = '$day' AND d.dep_status = 'out' GROUP BY d.depost_method");
	return $data->result();
}

public function get_sumloanDepost_out($comp_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_deposOutData FROM tbl_depost d JOIN tbl_account_transaction at ON at.trans_id = d.depost_method WHERE d.comp_id = '$comp_id' AND d.depost_day = '$day' AND d.dep_status = 'out'");
	return $data->row();
}

public function get_sumloanDepost_outBlanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_deposOutData FROM tbl_depost d JOIN tbl_account_transaction at ON at.trans_id = d.depost_method WHERE d.blanch_id = '$blanch_id' AND d.depost_day = '$day' AND d.dep_status = 'out'");
	return $data->row();
}

public function get_loanWithdrawal_today($comp_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_withloan,at.account_name FROM tbl_loans l JOIN tbl_account_transaction at ON at.trans_id = l.method WHERE l.comp_id = '$comp_id' AND l.loan_status = 'withdrawal' AND l.disburse_day = '$day' GROUP BY l.method");
	return $data->result();
}

public function get_loanWithdrawal_today_blanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_withloan,at.account_name FROM tbl_loans l JOIN tbl_account_transaction at ON at.trans_id = l.method WHERE l.blanch_id = '$blanch_id' AND l.loan_status = 'withdrawal' AND l.disburse_day = '$day' GROUP BY l.method");
	return $data->result();
}

public function get_sumloan_withdrawal($comp_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loanWithdrawal FROM tbl_loans WHERE comp_id = '$comp_id' AND disburse_day = '$day' AND loan_status = 'withdrawal'");
	return $data->row();
}

public function get_sumloan_withdrawal_blanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loanWithdrawal FROM tbl_loans WHERE blanch_id = '$blanch_id' AND disburse_day = '$day' AND loan_status = 'withdrawal'");
	return $data->row();
}

public function get_today_expenses($comp_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(re.req_amount) AS total_expenses,at.account_name FROM tbl_request_exp re JOIN tbl_account_transaction at ON at.trans_id = re.trans_id WHERE re.comp_id = '$comp_id' AND re.req_date = '$day' AND re.req_status = 'accept' GROUP BY re.trans_id");
	return $data->result();
}

public function get_today_expenses_blanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(re.req_amount) AS total_expenses,at.account_name FROM tbl_request_exp re JOIN tbl_account_transaction at ON at.trans_id = re.trans_id WHERE re.blanch_id = '$blanch_id' AND re.req_date = '$day' AND re.req_status = 'accept' GROUP BY re.trans_id");
	return $data->result();
}


public function get_today_sumExpenses($comp_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(re.req_amount) AS sum_expenses FROM tbl_request_exp re JOIN tbl_account_transaction at ON at.trans_id = re.trans_id WHERE re.comp_id = '$comp_id' AND re.req_date = '$day'");
	return $data->row();
}

public function get_today_sumExpenses_blanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(re.req_amount) AS sum_expenses FROM tbl_request_exp re JOIN tbl_account_transaction at ON at.trans_id = re.trans_id WHERE re.blanch_id = '$blanch_id' AND re.req_date = '$day'");
	return $data->row();
}

public function get_today_deducted_fee($comp_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted FROM tbl_deducted_fee WHERE comp_id = '$comp_id' AND deducted_date = '$day'");
	return $data->row();
}

public function get_today_deducted_fee_blanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted FROM tbl_deducted_fee WHERE blanch_id = '$blanch_id' AND deducted_date = '$day'");
	return $data->row();
}


public function get_non_deducted_feeToday($comp_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_nondeducted FROM tbl_receve WHERE comp_id = '$comp_id' AND receve_day = '$day'");
	return $data->row();
}

public function get_non_deducted_feeToday_blanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_nondeducted FROM tbl_receve WHERE blanch_id = '$blanch_id' AND receve_day = '$day'");
	return $data->row();
}


public function get_deducted_balance_blanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT * FROM tbl_deducted_fee df JOIN tbl_loans l ON l.loan_id = df.loan_id JOIN  tbl_customer c ON c.customer_id = l.customer_id WHERE df.blanch_id = '$blanch_id' AND df.deducted_date = '$day'");
	return $data->result();
}

public function get_today_deducted_feeblanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted_fee FROM tbl_deducted_fee WHERE blanch_id = '$blanch_id' AND deducted_date = '$day'");
	return $data->row();
}

public function getprincipal_account($blanch_id,$trans_id,$princ_status){
	$data = $this->db->query("SELECT * FROM  tbl_blanch_capital_principal WHERE blanch_id = '$blanch_id' AND trans_id = '$trans_id' AND princ_status = '$princ_status'");
	return $data->row();
}

public function get_blanch_account_target($blanch_id,$trans_id){
	$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$blanch_id' AND receive_trans_id = '$trans_id'");
	return $data->row();
}


public function get_interest_blanch_capital($blanch_id,$trans_id,$princ_status){
	$data = $this->db->query("SELECT * FROM tbl_blanch_capital_interest WHERE blanch_id = '$blanch_id' AND trans_id = '$trans_id' AND int_status = '$princ_status'");
	return $data->row();
}

public function get_today_transaction_principal_int($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT * FROM  tbl_principal_int_transfor it JOIN tbl_account_transaction at ON at.trans_id = it.from_account WHERE it.blanch_id = '$blanch_id' AND it.date_trans = '$day'");
	return $data->result();
}

public function get_total_transfor($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(balance) AS total_tranfor FROM tbl_principal_int_transfor WHERE blanch_id = '$blanch_id' AND date_trans = '$day'");
	return $data->row();
}

public function get_total_branchAccount($blanch_id){
	$data = $this->db->query("SELECT SUM(blanch_capital) AS total_amount FROM tbl_blanch_account WHERE blanch_id = '$blanch_id'");
	return $data->row();
}

public function get_principal_repayment($blanch_id){
	$data = $this->db->query("SELECT SUM(principal_balance) AS total_principal_with FROM  tbl_blanch_capital_principal WHERE blanch_id = '$blanch_id' AND princ_status = 'withdrawal'");
	return $data->row();
}

public function get_principal_repayment_out($blanch_id){
	$data = $this->db->query("SELECT SUM(principal_balance) AS total_principal_out FROM tbl_blanch_capital_principal WHERE blanch_id = '$blanch_id' AND princ_status = 'out'");
	return $data->row();
}

public function get_total_repayment_interest($blanch_id){
	$data = $this->db->query("SELECT SUM(capital_interest) AS total_interest_withdrawal FROM tbl_blanch_capital_interest WHERE blanch_id = '$blanch_id' AND int_status = 'withdrawal'");
	return $data->row();
}

public function get_total_repayment_interestout($blanch_id){
	$data = $this->db->query("SELECT SUM(capital_interest) AS total_interest_out FROM tbl_blanch_capital_interest WHERE blanch_id = '$blanch_id' AND int_status = 'out'");
	return $data->row();
}

public function get_deducted_feeBlanch($blanch_id){
	$data = $this->db->query("SELECT SUM(deducted) AS total_deducted_fee FROM tbl_receive_deducted WHERE blanch_id = '$blanch_id'");
	return $data->row();
}

public function get_nonDeducted_Blanchdata($blanch_id){
	$data = $this->db->query("SELECT SUM(non_balance) AS total_nonBalance FROM tbl_receive_non_deducted WHERE blanch_id = '$blanch_id'");
	return $data->row();
}


public function get_today_income_blanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted_fee FROM tbl_deducted_fee WHERE blanch_id = '$blanch_id' AND deducted_date = '$day'");
	return $data->row();
}

public function get_today_nonDeducted_fee($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_nonDeducted_fee FROM tbl_receve WHERE blanch_id = '$blanch_id' AND receve_day = '$day'");
	return $data->row();
}


public function get_blanch_account_summary($blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_blanch_account ba JOIN tbl_account_transaction at ON at.trans_id = ba.receive_trans_id  WHERE ba.blanch_id = '$blanch_id'");
	return $data->result();
}


public function get_today_summary_transformation($blanch_id){
	$day = date("Y-m-d");
	$loan = $this->db->query("SELECT SUM(l.loan_aprove) AS total_with,at.trans_id,at.account_name,l.method,l.blanch_id FROM tbl_loans l JOIN tbl_account_transaction at ON at.trans_id = l.method WHERE l.blanch_id = '$blanch_id' AND l.loan_status = 'withdrawal' AND l.region_id = 'ok' AND l.disburse_day = '$day' GROUP BY at.trans_id");
	foreach ($loan->result() as $r) {
	  $r->total_principal_repayment = $this->get_today_principal_repaymrnt($r->method,$blanch_id);
	  $r->total_principal_out = $this->get_principal_repayment_out_today($r->method,$blanch_id);
	  $r->total_interest_with = $this->get_interest_with_repayment($r->method,$blanch_id);
	  $r->total_interest_out = $this->get_interest_out_repayment($r->method,$blanch_id);
	  $r->total_expenses = $this->get_today_expensesblanch($r->method,$blanch_id);
	}
	return $loan->result();
}


public function get_today_principal_repaymrnt($method,$blanch_id){
$day = date("Y-m-d");
$principal = $this->db->query("SELECT SUM(d.sche_principal) AS total_principal_repayment FROM tbl_depost d WHERE blanch_id = '$blanch_id' AND d.depost_method = '$method' AND d.depost_day = '$day' AND d.dep_status = 'withdrawal' GROUP BY d.depost_method");
 if ($principal->row()) {
      return $principal->row()->total_principal_repayment; 
    }
    return 0; 

}


public function get_principal_repayment_out_today($method,$blanch_id){
$day = date("Y-m-d");
$principal = $this->db->query("SELECT SUM(d.sche_principal) AS total_principal_out FROM tbl_depost d WHERE blanch_id = '$blanch_id' AND d.depost_method = '$method' AND d.depost_day = '$day' AND d.dep_status = 'out' GROUP BY d.depost_method");
 if ($principal->row()) {
      return $principal->row()->total_principal_out; 
    }
    return 0; 
}




public function get_interest_with_repayment($method,$blanch_id){
	$day = date("Y-m-d");
	$interest = $this->db->query("SELECT SUM(d.sche_interest) AS total_interest_with FROM tbl_depost d WHERE d.blanch_id = '$blanch_id' AND d.depost_method = '$method' AND d.dep_status = 'withdrawal' AND d.depost_day = '$day' GROUP BY d.depost_method");
	if ($interest->row()) {
      return $interest->row()->total_interest_with; 
    }
    return 0; 
}

public function get_interest_out_repayment($method,$blanch_id){
 $day = date("Y-m-d");
 $interest = $this->db->query("SELECT SUM(d.sche_interest) AS total_interest_out FROM tbl_depost d WHERE d.blanch_id = '$blanch_id' AND d.depost_method = '$method' AND d.dep_status = 'out' AND d.depost_day = '$day' GROUP BY d.depost_method");
	if ($interest->row()) {
      return $interest->row()->total_interest_out; 
    }
    return 0; 	
}


public function get_today_expensesblanch($method,$blanch_id){
$day = date("Y-m-d");
$expenses = $this->db->query("SELECT SUM(req_amount) AS total_expenses FROM tbl_request_exp e WHERE e.blanch_id = '$blanch_id' AND e.trans_id = '$method' AND e.req_date = '$day' AND e.req_status = 'accept' GROUP BY e.trans_id");
if ($expenses->row()) {
      return $expenses->row()->total_expenses; 
    }
    return 0; 
}


public function get_total_today_loanWithdrawal($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loan_withdrawal_today FROM tbl_loans l WHERE blanch_id = '$blanch_id' AND l.disburse_day = '$day'");
	return $data->row();
}

public function get_total_principal_repayment_blanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(sche_principal) AS total_principal_rep FROM tbl_depost WHERE blanch_id = '$blanch_id' AND depost_day = '$day'");
	return $data->row();
}

public function get_total_interest_repayment($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(sche_interest) AS total_interest_rep FROM tbl_depost WHERE blanch_id = '$blanch_id' AND depost_day = '$day'");
	return $data->row();
}

public function get_total_expenses_today($blanch_id){
	$day = date("Y-m-d");
	$expense = $this->db->query("SELECT SUM(req_amount) AS total_request_amount FROM tbl_request_exp WHERE blanch_id = '$blanch_id' AND req_date = '$day'");
	return $expense->row();
}

public function get_tot_deducted_feetoday($blanch_id){
	$day = date("Y-m-d");
	$deducted = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted_today FROM tbl_deducted_fee WHERE blanch_id = '$blanch_id' AND deducted_date = '$day'");
	return $deducted->row();
}

public function get_total_non_deducted_fee($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receive_today FROM  tbl_receve WHERE blanch_id = '$blanch_id' AND receve_day = '$day'");
	return $data->row();
}


public function get_loan_status($customer_id){
	$data = $this->db->query("SELECT * FROM tbl_loans WHERE customer_id = '$customer_id' ORDER BY loan_id DESC LIMIT 1");
	return $data->row();
}


public function get_principal_repayment_account($blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_blanch_capital_principal pc JOIN tbl_account_transaction at ON at.trans_id = pc.trans_id WHERE pc.blanch_id = '$blanch_id'");
	return $data->result();
}


public function get_interest_summary($blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_blanch_capital_interest ic JOIN tbl_account_transaction at ON at.trans_id = ic.trans_id WHERE ic.blanch_id = '$blanch_id'");
	return $data->result();
}


public function income_receive_delete($receved_id){
	$data = $this->db->query("SELECT * FROM tbl_receve WHERE receved_id = '$receved_id'");
	return $data->row();
}


public function get_data_paypenart($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_pay_penart WHERE loan_id = '$loan_id'");
	return $data->row();
}

public function get_receive_nonDeducted($blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_receive_non_deducted WHERE blanch_id = '$blanch_id'");
	return $data->row();
}

public function get_total_loan_principal($loan_id){
	$data = $this->db->query("SELECT SUM(sche_principal) AS total_principal FROM tbl_depost WHERE loan_id = '$loan_id'");
	return $data->row();
}

public function get_total_loan_interest($loan_id){
	$data = $this->db->query("SELECT SUM(sche_interest) AS total_interest FROM tbl_depost WHERE loan_id = '$loan_id'");
	return $data->row();
}

public function get_principal_remain($blanch_id,$payment_method,$loan_status){
	$data = $this->db->query("SELECT * FROM tbl_blanch_capital_principal WHERE blanch_id = '$blanch_id' AND trans_id = '$payment_method' AND princ_status = '$loan_status'");
	return $data->row();
}


public function get_interest_remain($blanch_id,$payment_method,$loan_status){
	$data = $this->db->query("SELECT * FROM tbl_blanch_capital_interest WHERE blanch_id = '$blanch_id' AND trans_id = '$payment_method' AND int_status = '$loan_status'");
	return $data->row();
}


public function get_blanch_capital_balance($blanch_id,$payment_method){
	$balance = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$blanch_id' AND receive_trans_id = '$payment_method'");
	return $balance->row();
}


// public function get_total_amount_depost_loan($loan_id){
//  	$data = $this->db->query("SELECT SUM(depost) AS total_depost FROM tbl_depost WHERE loan_id = '$loan_id'");
//  	return $data->row();
//  }

public function get_comapanydetail($comp_id)
{
	$data = $this->db->query("SELECT * FROM tbl_company WHERE comp_id = '$comp_id'");
	return $data->row();
}

public function block_company($comp_id,$comp_data)
{
	return $this->db->where('comp_id',$comp_id)->update('tbl_company',$comp_data);
}


public function get_blanch_capital_data($blanch_id)
{
	$data = $this->db->query("SELECT SUM(blanch_capital) AS total_blanch_capital FROM tbl_blanch_account WHERE blanch_id = '$blanch_id'");
	return $data->row();
}


public function get_blanch_balance_fee($comp_id)
{
	$data = $this->db->query("SELECT * FROM tbl_blanch b LEFT JOIN tbl_receive_deducted rd ON rd.blanch_id = b.blanch_id LEFT JOIN tbl_receive_non_deducted rn ON rn.blanch_id = b.blanch_id WHERE b.comp_id = '$comp_id'");
	return $data->result();
}


public function get_cashflow_accumlation($blanch_id)
{
 $data = $this->db->query("SELECT * FROM tbl_blanch_account ba JOIN tbl_account_transaction at ON at.trans_id = ba.receive_trans_id WHERE ba.blanch_id = '$blanch_id'");
 return $data->result();
}

public function get_total_accumlation($blanch_id)
{
	$data = $this->db->query("SELECT SUM(blanch_capital) AS total_blanch_capital FROM tbl_blanch_account WHERE blanch_id = '$blanch_id'");
	return $data->row();
}


public function update_member_status($data,$customer_id){
	return $this->db->where('customer_id',$customer_id)->update('tbl_customer',$data);
}


public function get_total_loanGroup($comp_id,$group_id){
	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loan, SUM(loan_int) AS total_loanint FROM tbl_loans WHERE comp_id = '$comp_id' AND group_id = '$group_id'");
	return $data->row();
}
public function get_total_depostGroup($comp_id,$group_id){
	$data = $this->db->querY("SELECT SUM(depost) AS total_depost FROM tbl_depost WHERE comp_id = '$comp_id' AND group_id = '$group_id'");
	return $data->row();
}


public function insert_miamala($data){
	return $this->db->insert('tbl_miamala',$data);
}


public function get_miamala($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT * FROM tbl_miamala WHERE blanch_id = '$blanch_id' AND date = '$date'");
	return $data->result();
}

public function delete_miamala($id){
	return $this->db->delete('tbl_miamala',['id'=>$id]);
}


public function update_miamala($data,$id){
	return $this->db->where('id',$id)->update('tbl_miamala',$data);
}

public function get_comp_miamala_dada($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_miamala m LEFT JOIN tbl_blanch b ON b.blanch_id = m.blanch_id LEFT JOIN tbl_account_transaction at ON at.trans_id = m.provider WHERE m.comp_id = '$comp_id'");
	return $data->result();
}

public function get_total_miamala($comp_id){
	$data = $this->db->query("SELECT SUM(amount) AS total_amount_saving FROM tbl_miamala WHERE comp_id = '$comp_id' AND status = 'open'");
	return $data->row();
}

public function get_miamala_depost($id){
	$miamala = $this->db->query("SELECT * FROM tbl_miamala WHERE id = '$id'");
	return $miamala->row();
}


public function get_general_loanGroup($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_employee e ON e.empl_id = l.empl_id WHERE l.comp_id = '$comp_id' AND  NOT l.empl_id = '0' AND NOT l.group_id = '0' GROUP BY l.empl_id");
	return $data->result();
}

public function get_general_loanGroupblanch($blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_employee e ON e.empl_id = l.empl_id WHERE l.blanch_id = '$blanch_id' AND  NOT l.empl_id = '0' AND NOT l.group_id = '0' GROUP BY l.empl_id");
	return $data->result();
}


public function get_empl_group($empl_id){
	$data = $this->db->query("SELECT g.group_name,g.group_id FROM tbl_loans l JOIN tbl_group g ON g.group_id = l.group_id WHERE l.empl_id = '$empl_id' AND NOT l.group_id = '0' AND NOT l.empl_id = '0' GROUP BY l.group_id");
	foreach ($data->result() as $r) {
		$r->total_depost = $this->get_total_deposit_group($r->group_id);
		$r->total_restoration = $this->get_restoration($r->group_id);
		$r->total_loan_aprove = $this->get_total_aproved($r->group_id);
		$r->total_tommorow = $this->tommorow_collection($r->group_id);
		$r->total_penart = $this->totLgroup_penart($r->group_id);
		$r->total_penart_paid = $this->pay_group_penart($r->group_id);
		$r->total_deducted_fee = $this->get_total_income($r->group_id);
		$r->total_loan_disbursed = $this->get_total_disbursement($r->group_id);
	}
	return $data->result();
}


public function get_total_deposit_group($group_id){
		$depost = $this->db->query("SELECT SUM(depost) AS total_depost FROM tbl_depost d JOIN tbl_loans l ON l.loan_id = d.loan_id  WHERE d.group_id = '$group_id' AND NOT l.group_id = '0' AND NOT l.empl_id = '0' AND loan_status = 'withdrawal'  GROUP BY d.group_id ORDER BY l.loan_id DESC ");
		if ($depost->row()) {
			return $depost->row()->total_depost; 
		}
		return 0; 
}

public function get_restoration($group_id){
$restoration = $this->db->query("SELECT SUM(restration) AS total_restoration FROM tbl_loans l  WHERE l.group_id = '$group_id'   AND NOT l.group_id = '0' AND NOT l.empl_id = '0' AND loan_status = 'withdrawal' GROUP BY l.group_id ORDER BY l.loan_id DESC");
		if ($restoration->row()) {
			return $restoration->row()->total_restoration; 
		}
		return 0; 
}

public function get_total_aproved($group_id){
 $loan_aprove = $this->db->query("SELECT SUM(loan_aprove) AS total_loan_aprove FROM tbl_loans l  WHERE l.group_id = '$group_id'   AND NOT l.group_id = '0' AND NOT l.empl_id = '0' AND loan_status = 'aproved' GROUP BY l.group_id ORDER BY l.loan_id DESC");
		if ($loan_aprove->row()) {
			return $loan_aprove->row()->total_loan_aprove; 
		}
		return 0; 
}


public function tommorow_collection($group_id){
	$date = date("Y-m-d");
  $front = date('Y-m-d', strtotime('+1 day', strtotime($date)));
 $tommorow = $this->db->query("SELECT SUM(restration) AS total_tommorow FROM tbl_loans l  WHERE l.group_id = '$group_id' AND NOT l.group_id = '0' AND NOT l.empl_id = '0' AND l.date_show = '$front' AND loan_status = 'withdrawal'  GROUP BY l.group_id ORDER BY l.loan_id DESC ");
 if ($tommorow->row()) {
			return $tommorow->row()->total_tommorow; 
		}
		return 0; 
 }


 public function totLgroup_penart($group_id){
 	$penart = $this->db->query("SELECT SUM(penart_amount) AS total_penart FROM tbl_customer_report cr JOIN tbl_loans l ON l.loan_id = cr.loan_id WHERE cr.group_id = '$group_id' AND loan_status = 'withdrawal' GROUP BY cr.group_id ORDER BY l.loan_id DESC");
 	if ($penart->row()) {
			return $penart->row()->total_penart; 
		}
		return 0; 
 }


 public function pay_group_penart($group_id){
 	$pay_penart = $this->db->query("SELECT SUM(penart_paid) AS total_penart_paid FROM tbl_pay_penart pn JOIN tbl_loans l ON l.loan_id = pn.loan_id  WHERE pn.group_id = '$group_id' AND loan_status = 'withdrawal' GROUP BY pn.group_id ORDER BY l.loan_id DESC");
  	if ($pay_penart->row()){
			return $pay_penart->row()->total_penart_paid; 
		}
		return 0;  
 }


 public function get_total_income($group_id){
 	$income = $this->db->query("SELECT SUM(df.deducted_balance) AS total_deducted_fee FROM tbl_deducted_fee df JOIN tbl_loans l ON l.loan_id = df.loan_id WHERE df.group_id = '$group_id' AND loan_status = 'withdrawal' GROUP BY df.group_id ORDER BY l.loan_id DESC");
 	 	if ($income->row()) {
			return $income->row()->total_deducted_fee; 
		}
		return 0;
 }


 public function get_total_disbursement($group_id){
 	$disburse = $this->db->query("SELECT SUM(loan_aprove) AS total_loan_disbursed FROM tbl_loans WHERE group_id = '$group_id' AND loan_status = 'disbarsed'  GROUP BY group_id ORDER BY loan_id DESC");
   if ($disburse->row()) {
   	return $disburse->row()->total_loan_disbursed;
   }
   return 0;

 }


 public function get_total_aproved_group_empl($empl_id){
 	$data = $this->db->query("SELECT * FROM tbl_loans l WHERE l.empl_id = '$empl_id' AND NOT l.group_id = '0' AND NOT l.empl_id = '0' GROUP BY l.empl_id");
 	 foreach ($data->result() as $r) {
 	 	$r->total_tommor_collection = $this->get_emplgroup_tommorow($r->empl_id);
 	 	$r->total_depost_empl = $this->get_total_depost_empl_depost($r->empl_id);
 	 	$r->total_penart_empl = $this->totLgroup_penart_empl($r->empl_id);
 	 	$r->total_penart_paid_empl = $this->pay_group_penart_empl($r->empl_id);
 	 	$r->total_deducted_fee_empl = $this->get_total_income_empl($r->empl_id);
 	 	$r->total_restoration_empl = $this->get_restoration_empl($r->empl_id);
 	 	$r->total_loan_disbursed_empl = $this->get_total_disbursement_empl($r->empl_id);
 	 	$r->total_loan_aprove_empl = $this->get_total_aproved_empl($r->empl_id);
  }
 	return $data->result();
 }


 public function get_emplgroup_tommorow($empl_id){
 	$date = date("Y-m-d");
  $front = date('Y-m-d', strtotime('+1 day', strtotime($date)));
 $tommorow = $this->db->query("SELECT SUM(l.restration) AS total_tommor_collection FROM tbl_loans l  WHERE l.empl_id = '$empl_id' AND NOT l.group_id = '0' AND NOT l.empl_id = '0' AND l.date_show = '$front' AND loan_status = 'withdrawal' GROUP BY l.empl_id");
 if ($tommorow->row()) {
			return $tommorow->row()->total_tommor_collection; 
		}
		return 0; 
 }


 public function get_total_depost_empl_depost($empl_id){
 	$depost = $this->db->query("SELECT SUM(depost) AS total_depost_empl FROM tbl_depost d JOIN tbl_loans l ON l.loan_id = d.loan_id WHERE d.empl_id = '$empl_id' AND NOT l.group_id = '0' AND NOT l.empl_id = '0' AND l.loan_status = 'withdrawal' GROUP BY d.empl_id");
 	// print_r($depost);
 	// exit();
	 if ($depost->row()) {
			return $depost->row()->total_depost_empl; 
	 }
	 return 0;
 }


 public function totLgroup_penart_empl($empl_id){
 	$penart = $this->db->query("SELECT SUM(penart_amount) AS total_penart_empl FROM tbl_customer_report cr JOIN tbl_loans l ON l.loan_id = cr.loan_id WHERE l.empl_id = '$empl_id' AND loan_status = 'withdrawal' AND NOT l.group_id = '0' AND NOT l.empl_id = '0' GROUP BY l.empl_id ORDER BY l.loan_id DESC");
 	if ($penart->row()) {
			return $penart->row()->total_penart_empl; 
		}
		return 0; 
 }


  public function pay_group_penart_empl($empl_id){
 	$pay_penart = $this->db->query("SELECT SUM(penart_paid) AS total_penart_paid_empl FROM tbl_pay_penart pn JOIN tbl_loans l ON l.loan_id = pn.loan_id  WHERE l.empl_id = '$empl_id' AND loan_status = 'withdrawal' AND NOT l.group_id = '0' AND NOT l.empl_id = '0' GROUP BY l.empl_id");
  	if ($pay_penart->row()){
			return $pay_penart->row()->total_penart_paid_empl; 
		}
		return 0;  
 }


  public function get_total_income_empl($empl_id){
 	$income = $this->db->query("SELECT SUM(df.deducted_balance) AS total_deducted_fee_empl FROM tbl_deducted_fee df JOIN tbl_loans l ON l.loan_id = df.loan_id WHERE l.empl_id = '$empl_id' AND loan_status = 'withdrawal' AND NOT l.group_id = '0' AND NOT l.empl_id = '0' GROUP BY l.empl_id");
 	 	if ($income->row()) {
			return $income->row()->total_deducted_fee_empl; 
		}
		return 0;
 }


 public function get_restoration_empl($empl_id){
$restoration = $this->db->query("SELECT SUM(restration) AS total_restoration_empl FROM tbl_loans l  WHERE l.empl_id = '$empl_id'   AND NOT l.group_id = '0' AND NOT l.empl_id = '0' AND loan_status = 'withdrawal' GROUP BY l.empl_id");
		if ($restoration->row()) {
			return $restoration->row()->total_restoration_empl; 
		}
		return 0; 
}

public function get_total_disbursement_empl($empl_id){
 	$disburse = $this->db->query("SELECT SUM(loan_aprove) AS total_loan_disbursed_empl FROM tbl_loans l WHERE l.empl_id = '$empl_id' AND l.loan_status = 'disbarsed' AND NOT l.group_id = '0' AND NOT l.empl_id = '0'  GROUP BY l.empl_id");
   if ($disburse->row()) {
   	return $disburse->row()->total_loan_disbursed_empl;
   }
   return 0;

 }


 public function get_total_aproved_empl($empl_id){
 $loan_aprove = $this->db->query("SELECT SUM(loan_aprove) AS total_loan_aprove_empl FROM tbl_loans l  WHERE l.empl_id = '$empl_id'   AND NOT l.group_id = '0' AND NOT l.empl_id = '0' AND loan_status = 'aproved' GROUP BY l.empl_id");
		if ($loan_aprove->row()) {
			return $loan_aprove->row()->total_loan_aprove_empl; 
		}
		return 0; 
}





public function insert_loanfee_type($data){
	return $this->db->insert('tbl_fee_type',$data);
}

public function get_loanfee_type($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_fee_type WHERE comp_id = '$comp_id' LIMIT 1");
	return $data->row();
}

public function get_loanfee_typeData($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_fee_type WHERE comp_id = '$comp_id'");
	return $data->result();
}


public function update_loanfee_type($data,$id){
	return $this->db->where('id',$id)->update('tbl_fee_type',$data);
}

public function get_loan_income($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_loans WHERE loan_id = '$loan_id'");
	return $data->row();
}

public function get_group_loan($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_group WHERE comp_id = '$comp_id'");
	return $data->result();
}



public function get_group_loan_blanch($blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_group WHERE blanch_id = '$blanch_id'");
	return $data->result();
}


public function get_loan_group_customer($group_id){
	$data = $this->db->query("SELECT c.f_name,c.m_name,c.l_name,l.loan_aprove,l.loan_int,l.restration,l.loan_id,l.loan_status,l.day FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id WHERE l.group_id = '$group_id'");
	foreach ($data->result() as $r) {
		$r->total_depost = $this->get_total_depost_customer($r->loan_id);
		$r->total_penart = $this->get_penart_group_customer($r->loan_id); 
		$r->total_paid_penart = $this->get_paid_penart_group($r->loan_id);
	}
	return $data->result();
}


public function get_loan_group_customer_status($group_id,$loan_status){
	$data = $this->db->query("SELECT c.f_name,c.m_name,c.l_name,l.loan_aprove,l.loan_int,l.restration,l.loan_id,l.loan_status,l.day FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id WHERE l.group_id = '$group_id' AND l.loan_status = '$loan_status'");
	foreach ($data->result() as $r) {
		$r->total_depost = $this->get_total_depost_customer($r->loan_id);
		$r->total_penart = $this->get_penart_group_customer($r->loan_id); 
		$r->total_paid_penart = $this->get_paid_penart_group($r->loan_id);
	}
	return $data->result();
}


public function get_total_depost_customer($loan_id){
	$depost = $this->db->query("SELECT SUM(d.depost) AS total_depost FROM tbl_depost d WHERE d.loan_id = '$loan_id' GROUP BY d.loan_id");
	if ($depost->row()) {
		return $depost->row()->total_depost;
	}
	return 0;
}


public function get_penart_group_customer($loan_id){
	$penart = $this->db->query("SELECT SUM(cr.penart_amount) AS total_penart FROM tbl_customer_report cr WHERE cr.loan_id = '$loan_id' GROUP BY cr.loan_id");
	if ($penart->row()) {
		return $penart->row()->total_penart;
	}
	return 0;
}


public function get_paid_penart_group($loan_id){
	$paid = $this->db->query("SELECT SUM(pn.penart_paid) AS total_paid_penart FROM tbl_pay_penart pn WHERE pn.loan_id = '$loan_id' GROUP BY pn.loan_id");
	if ($paid->row()) {
		return $paid->row()->total_paid_penart;
	}
	return 0;
}

 public function get_blanch_group($blanch_id,$loan_status){
  	$data = $this->db->query("SELECT * FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = '$loan_status' GROUP BY blanch_id");
  	return $data->row();
  }

  public function get_blanch_group_data($blanch_id){
  	$data = $this->db->query("SELECT * FROM tbl_group WHERE blanch_id = '$blanch_id'");
  	return $data->result();
  }


public function get_total_group_loan($group_id){
	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loangroup,SUM(loan_int) AS total_int,SUM(restration) AS total_restoration,group_id FROM tbl_loans WHERE group_id = '$group_id' GROUP BY group_id");
	foreach ($data->result() as $r) {
		$r->total_depost_groups = $this->get_total_deposit_group_member($r->group_id);
		$r->total_penart_group = $this->get_penart_group_member($r->group_id);
		$r->total_paid = $this->get_paid_penart_member($r->group_id);
	}
	return $data->result();
}

public function get_total_group_loan_status($group_id,$loan_status){
	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loangroup,SUM(loan_int) AS total_int,SUM(restration) AS total_restoration,group_id,loan_status FROM tbl_loans WHERE group_id = '$group_id' AND loan_status = '$loan_status' GROUP BY group_id ");
	foreach ($data->result() as $r) {
		$r->total_depost_groups = $this->get_total_deposit_group_member_status($r->group_id,$loan_status);
		$r->total_penart_group = $this->get_penart_group_member_status($r->group_id,$loan_status);
		$r->total_paid = $this->get_paid_penart_member_status($r->group_id,$loan_status);
	}
	return $data->result();
}



public function get_total_deposit_group_member_status($group_id,$loan_status){
 $deposit = $this->db->query("SELECT SUM(d.depost) AS total_depost_groups FROM tbl_depost d JOIN tbl_loans l ON l.loan_id = d.loan_id  WHERE d.group_id = '$group_id' AND l.loan_status = '$loan_status'  GROUP BY d.group_id");
 if ($deposit->row()) {
  return $deposit->row()->total_depost_groups;
 }
 return 0;
}


public function get_penart_group_member_status($group_id,$loan_status){
	$penart = $this->db->query("SELECT SUM(cr.penart_amount) AS total_penart_group FROM tbl_customer_report cr JOIN tbl_loans l ON l.loan_id = cr.loan_id WHERE cr.group_id = '$group_id' AND l.loan_status = '$loan_status' GROUP BY cr.group_id");
	if ($penart->row()) {
		return $penart->row()->total_penart_group;
	}
	return 0;
}


public function get_paid_penart_member_status($group_id,$loan_status){
	$paid_data = $this->db->query("SELECT SUM(pp.penart_paid) AS total_paid FROM tbl_pay_penart pp JOIN tbl_loans l ON l.loan_id = pp.loan_id WHERE pp.group_id = '$group_id' AND l.loan_status = '$loan_status' GROUP BY pp.group_id");
	 if ($paid_data->row()) {
	 	 return $paid_data->row()->total_paid;
	 }
	 return 0;
}




public function get_total_deposit_group_member($group_id){
 $deposit = $this->db->query("SELECT SUM(depost) AS total_depost_groups FROM tbl_depost WHERE group_id = '$group_id' GROUP BY group_id");
 if ($deposit->row()) {
  return $deposit->row()->total_depost_groups;
 }
 return 0;
}


public function get_penart_group_member($group_id){
	$penart = $this->db->query("SELECT SUM(penart_amount) AS total_penart_group FROM tbl_customer_report WHERE group_id = '$group_id' GROUP BY group_id");
	if ($penart->row()) {
		return $penart->row()->total_penart_group;
	}
	return 0;
}

public function get_paid_penart_member($group_id){
	$paid_data = $this->db->query("SELECT SUM(penart_paid) AS total_paid FROM tbl_pay_penart WHERE group_id = '$group_id' GROUP BY group_id");
	 if ($paid_data->row()) {
	 	 return $paid_data->row()->total_paid;
	 }
	 return 0;
}

public function insert_loanFee_category($data){
	return $this->db->insert('tbl_fee_category',$data);
}


public function get_loanfee_category($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_fee_category WHERE comp_id = '$comp_id'");
	return $data->result();
}

public function get_loanfee_categoryData($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_fee_category WHERE comp_id = '$comp_id' LIMIT 1");
	return $data->row();
}


public function modify_loanFee_category($data,$id){
	return $this->db->where('id',$id)->update('tbl_fee_category',$data);
}


public function get_loanproduct_fee($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_loan_category lc ON lc.category_id = l.category_id WHERE l.loan_id = '$loan_id' LIMIT 1");
	return $data->row();
}

 public function get_Desc_balance($loan_id)
{
	$data = $this->db->query("SELECT * FROM tbl_pay WHERE loan_id = '$loan_id' ORDER BY pay_id DESC");
	return $data->row();
}

public function check_loan_pending($loan_id)
{
	$data = $this->db->query("SELECT * FROM tbl_pending_total WHERE loan_id = '$loan_id'");
	return $data->row();
}


public function get_total_pending_loan($loan_ID){
 $data = $this->db->query("SELECT * FROM tbl_pending_total WHERE loan_id = '$loan_ID'");
 return $data->row();
}

public function get_total_pending_loan_data($loan_id){
 $data = $this->db->query("SELECT SUM(total_pend) AS total_recover FROM tbl_pending_total WHERE loan_id = '$loan_id'");
 return $data->row();
}

public function get_outstand_total($loan_ID){
	$data = $this->db->query("SELECT * FROM  tbl_outstand_loan WHERE loan_id = '$loan_ID' LIMIT 1");
	return $data->row();
}

public function get_loan_option($loan_ID){
	$data = $this->db->query("SELECT * FROM tbl_loans WHERE loan_id = '$loan_ID'");
	return $data->row();
}



public function get_total_loan_pending($blanch_id){
	$data = $this->db->query("SELECT pt.loan_id,pt.total_pend,pt.date,l.loan_int,l.day,c.f_name,c.m_name,c.l_name,c.phone_no,b.blanch_name,b.blanch_id,pt.blanch_id FROM tbl_pending_total pt JOIN tbl_loans l ON l.loan_id = pt.loan_id JOIN tbl_blanch b ON b.blanch_id = pt.blanch_id JOIN tbl_customer c ON c.customer_id = pt.customer_id  WHERE pt.blanch_id = '$blanch_id' AND total_pend IS NOT FALSE ");

	foreach ($data->result() as $r) {
		$r->total_penart_amount = $this->get_total_penartData($r->loan_id);
		$r->total_paid_penart = $this->get_paypenart_data_loan($r->loan_id);
	}
	return $data->result();
}


public function get_paypenart_data_loan($loan_id){
		$penart = $this->db->query("SELECT SUM(pp.penart_paid) AS total_paid_penart FROM tbl_pay_penart pp WHERE loan_id = '$loan_id' GROUP BY loan_id");
		if ($penart->row()) {
			return $penart->row()->total_paid_penart; 
		}
		return 0; 
		  }


public function get_total_pend_loan($blanch_id){
	$data = $this->db->query("SELECT SUM(total_pend) AS total_pending FROM tbl_pending_total WHERE blanch_id = '$blanch_id'");
	return $data->row();
}


public function get_total_loan_pendingComp($comp_id){
	$data = $this->db->query("SELECT b.blanch_name,c.f_name,c.m_name,c.l_name,c.phone_no,l.loan_int,l.session,l.day,pt.total_pend,l.loan_id,pt.date FROM tbl_pending_total pt JOIN tbl_loans l ON l.loan_id = pt.loan_id JOIN tbl_blanch b ON b.blanch_id = pt.blanch_id JOIN tbl_customer c ON c.customer_id = pt.customer_id WHERE pt.comp_id = '$comp_id' AND total_pend IS NOT FALSE ");

	foreach ($data->result() as $r) {
	 $r->total_penart = $this->get_total_penart_pending($r->loan_id);
	 $r->total_pay_penart = $this->get_pay_penart_loan($r->loan_id);
	}
	return $data->result();
}




public function get_total_penart_pending($loan_id){
$penart = $this->db->query("SELECT SUM(penart_amount) AS total_penart FROM tbl_customer_report cr WHERE loan_id = '$loan_id' GROUP BY loan_id");
		if ($penart->row()) {
			return $penart->row()->total_penart; 
		}
		return 0; 
		  }


public function get_pay_penart_loan($loan_id){
	$pay = $this->db->query("SELECT SUM(penart_paid) AS total_pay_penart FROM tbl_pay_penart pp WHERE pp.loan_id = '$loan_id' GROUP BY pp.loan_id");
	if ($pay->row()) {
			return $pay->row()->total_pay_penart; 
		}
		return 0; 
		  }




public function get_total_pend_loan_company($comp_id){
	$data = $this->db->query("SELECT SUM(total_pend) AS total_pending FROM tbl_pending_total WHERE comp_id = '$comp_id'");
	return $data->row();
}

public function get_cashbook($comp_id){
	$data = $this->db->query("SELECT SUM(blanch_capital) AS total_capital FROM tbl_blanch_account WHERE comp_id = '$comp_id'");
	return $data->row();
}


public function get_empl_data_loan($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_employee WHERE comp_id = '$comp_id'");
	return $data->result();
}

public function get_empl_data_loan_blanch($blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_employee WHERE blanch_id = '$blanch_id'");
	return $data->result();
}

public function get_loan_empl_data($empl_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(pr.depost) AS total_received,SUM(withdraw) AS total_withdrawal,c.f_name,c.m_name,c.l_name,l.restration,c.phone_no,l.day,pr.prev_id,pr.trans_id,at.account_name AS depost_account,pr.with_trans,wa.account_name AS with_account FROM tbl_prev_lecod pr JOIN tbl_loans l ON l.loan_id = pr.loan_id JOIN tbl_customer c ON c.customer_id = pr.customer_id LEFT JOIN tbl_account_transaction at ON at.trans_id = pr.trans_id LEFT JOIN tbl_account_transaction wa ON wa.trans_id = pr.with_trans WHERE pr.empl_id = '$empl_id' AND pr.group_id = '0' AND pr.lecod_day = '$today' GROUP BY pr.prev_id ");
	return $data->result();
}

public function get_total_depost_individual($empl_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_depost_individual ,SUM(withdraw) AS total_withdrawal_individual FROM tbl_prev_lecod WHERE empl_id = '$empl_id' AND lecod_day = '$today' AND group_id = '0' GROUP BY empl_id");
	return $data->result();
}

public function get_empl_group_depost($empl_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT * FROM tbl_prev_lecod pr JOIN tbl_group g ON g.group_id = pr.group_id WHERE pr.empl_id = '$empl_id' AND pr.lecod_day = '$today' GROUP BY pr.group_id");
	return $data->result();
}


public function member_group($group_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(pr.depost) AS total_received,SUM(withdraw) AS total_withdrawal,c.f_name,c.m_name,c.l_name,l.restration,c.phone_no,l.day,pr.prev_id,pr.trans_id,at.account_name AS depost_account,pr.with_trans,wa.account_name AS with_account FROM tbl_prev_lecod pr JOIN tbl_loans l ON l.loan_id = pr.loan_id JOIN tbl_customer c ON c.customer_id = pr.customer_id LEFT JOIN tbl_account_transaction at ON at.trans_id = pr.trans_id LEFT JOIN tbl_account_transaction wa ON wa.trans_id = pr.with_trans WHERE pr.group_id = '$group_id'  AND pr.lecod_day = '$today' GROUP BY pr.prev_id ");
	return $data->result();
}


public function get_total_group_depost($group_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_depost_group,SUM(withdraw) AS total_withdrawal_group FROM tbl_prev_lecod WHERE group_id = '$group_id' AND lecod_day = '$today'");
	return $data->result();
}


public function get_total_empl_depost_data($empl_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_depost_oficer,SUM(withdraw) AS total_withdrawal_oficer FROM tbl_prev_lecod WHERE empl_id = '$empl_id' AND lecod_day = '$today'");
	return $data->result();
}


public function get_total_deposit($comp_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_depost_comp FROM tbl_prev_lecod WHERE comp_id = '$comp_id' AND lecod_day = '$date'");
	return $data->row();
}

public function get_total_deposit_blanch($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_depost_comp FROM tbl_prev_lecod WHERE blanch_id = '$blanch_id' AND lecod_day = '$date'");
	return $data->row();
}

public function get_total_withdrawal($comp_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(withdraw) AS total_withdrawal_comp FROM tbl_prev_lecod WHERE comp_id = '$comp_id' AND lecod_day = '$date'");
	return $data->row();
}

public function get_total_withdrawal_blanch($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(withdraw) AS total_withdrawal_comp FROM tbl_prev_lecod WHERE blanch_id = '$blanch_id' AND lecod_day = '$date'");
	return $data->row();
}

public function get_totalaccount_transaction($comp_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(pr.depost) AS total_depost_account,at.account_name, count(depost) AS recept FROM tbl_prev_lecod pr JOIN tbl_account_transaction at ON at.trans_id = pr.trans_id  WHERE pr.comp_id = '$comp_id' AND pr.lecod_day = '$date' AND pr.trans_id IS NOT NULL GROUP BY pr.trans_id");
	return $data->result();
}

public function get_totalaccount_transaction_blanch($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(pr.depost) AS total_depost_account,at.account_name, count(depost) AS recept FROM tbl_prev_lecod pr JOIN tbl_account_transaction at ON at.trans_id = pr.trans_id  WHERE pr.blanch_id = '$blanch_id' AND pr.lecod_day = '$date' AND pr.trans_id IS NOT NULL GROUP BY pr.trans_id");
	return $data->result();
}


public function get_teller_deposit_with($comp_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT * FROM tbl_prev_lecod pr JOIN tbl_blanch b ON b.blanch_id = pr.blanch_id WHERE pr.comp_id = '$comp_id' AND pr.lecod_day = '$today' GROUP BY pr.blanch_id");
	return $data->result();
}

public function get_eploye_deposit($blanch_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_depost_teller,SUM(withdraw) AS total_withdrawal_teller,e.empl_name,pr.lecod_day FROM tbl_prev_lecod pr JOIN tbl_employee e ON e.empl_id = pr.empl_id WHERE pr.blanch_id = '$blanch_id' AND pr.lecod_day = '$today' GROUP BY pr.empl_id");
	return $data->result();
}


  public function get_today_loan_withdrawal($blanch_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loan_with,l.blanch_id  FROM tbl_loans l WHERE l.blanch_id = '$blanch_id' AND l.loan_status = 'withdrawal' AND l.disburse_day = '$date' GROUP BY l.blanch_id");

  	return $data = $data->row();
  }

   public function get_today_loan_withdrawalComp($comp_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loan_withcomp  FROM tbl_loans l WHERE l.comp_id = '$comp_id' AND l.loan_status = 'withdrawal' AND l.disburse_day = '$date'");

  	return $data = $data->row();
  }

  public function get_total_depost_blanch($blanch_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(depost) AS total_depost FROM tbl_depost WHERE blanch_id = '$blanch_id' AND depost_day = '$date'");
  	return $data->row();
  }

  public function get_total_depost_comp($comp_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(depost) AS total_depost_comp FROM tbl_depost WHERE comp_id = '$comp_id' AND depost_day = '$date'");
  	return $data->row();
  }

  public function get_total_deducted_fee_today($blanch_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted_balance FROM tbl_deducted_fee WHERE blanch_id = '$blanch_id'  AND deducted_date = '$date'");
  	return $data->row();
  }

   public function get_total_deducted_fee_todaycomp($comp_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted_balancecomp FROM tbl_deducted_fee WHERE comp_id = '$comp_id'  AND deducted_date = '$date'");
  	return $data->row();
  }

  public function get_total_receive_nonDeducted($blanch_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receive_nondeducted FROM tbl_receve WHERE blanch_id = '$blanch_id' AND receve_day = '$date'");
  	return $data->row();
  }

  public function get_total_receive_nonDeducted_comp($comp_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receive_nondeducted_comp FROM tbl_receve WHERE comp_id = '$comp_id' AND receve_day = '$date'");
  	return $data->row();
  }

  public function get_expenses_total_comp($blanch_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(req_amount) AS total_expenses FROM tbl_request_exp WHERE blanch_id = '$blanch_id' AND date(created) = '$date'");
  	return $data->row();
  }

  public function get_expenses_total_compblanch($comp_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(req_amount) AS total_expenses_comp FROM tbl_request_exp WHERE comp_id = '$comp_id' AND date(created) = '$date'");
  	return $data->row();
  }


  public function get_newcustomer($blanch_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT COUNT(customer_id) AS total_customer FROM tbl_customer WHERE blanch_id = '$blanch_id' AND date(customer_day) = '$date' ");
  	return $data->row();
  }


  public function get_today_receivable_blanch($blanch_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(restration) AS total_restoration FROM tbl_loans WHERE blanch_id = '$blanch_id' AND date_show = '$date' AND loan_status = 'withdrawal'");
  	return $data->row();
  }

   public function get_today_receivable_comp($comp_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(restration) AS total_restoration_comp FROM tbl_loans WHERE comp_id = '$comp_id' AND date_show = '$date' AND loan_status = 'withdrawal'");
  	return $data->row();
  }

  public function insert_loan_topup($data){
  	return $this->db->insert('tbl_topup',$data);
  }


  public function get_group_loan_data($group_id,$comp_id){
  	$data = $this->db->query("SELECT SUM(depost) AS total_depost,SUM(withdrow) AS total_withdrawal,SUM(balance) AS total_balance,date_data  FROM tbl_pay WHERE group_id = '$group_id'  GROUP BY pay_status ORDER BY pay_id DESC");
  	return $data->result();
  }

  public function get_loanEmployee_blanch_loan($blanch_id){
  	$data = $this->db->query("SELECT SUM(l.loan_int) AS total_loan, e.empl_name,e.empl_id  FROM tbl_loans l LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id WHERE l.blanch_id = '$blanch_id' GROUP BY l.empl_id");
  	foreach ($data->result() as $r) {
  	 $r->total_depost_loan = $this->get_deposit_inloancategory($r->empl_id);	
  	}
  	return $data->result();
  }


 
  public function get_deposit_inloancategory($empl_id){
		$deposit = $this->db->query("SELECT SUM(d.depost) AS total_depost_loan FROM tbl_depost d WHERE d.empl_id = '$empl_id' GROUP BY d.empl_id");
		if ($deposit->row()) {
			return $deposit->row()->total_depost_loan; 
		}
		return 0; 
		 }

		 public function get_total_blanch_loan($blanch_id){
		 	$data = $this->db->query("SELECT SUM(loan_int) AS total_blanch_loan,blanch_id FROM tbl_loans WHERE blanch_id = '$blanch_id'");
		 	foreach ($data->result() as $r) {
		 		$r->total_received = $this->get_total_received_blanch($r->blanch_id);
		 	}
		 	return $data->result();
		 }

		 public function get_total_received_blanch($blanch_id){
     $deposit = $this->db->query("SELECT SUM(depost) AS total_received FROM tbl_depost WHERE blanch_id = '$blanch_id'");

     if ($deposit->row()) {
       return $deposit->row()->total_received;
     }
     return 0;
		 }



  public function get_blanch_balance_expenses($blanch_id,$trans_id){
 $data = $this->db->query("SELECT * FROM tbl_blanch_account ba WHERE ba.blanch_id = '$blanch_id' AND ba.receive_trans_id = '$trans_id'");
 return $data->row();
 }


  public function fetch_acount($blanch_id)
 {
  $this->db->where('blanch_id', $blanch_id);
  $this->db->order_by('empl_id', 'ASC');
  $query = $this->db->query("SELECT * FROM tbl_blanch_account ba JOIN tbl_account_transaction at ON at.trans_id = ba.receive_trans_id  WHERE ba.blanch_id = '$blanch_id'");
  $output = '<option value="">Select Account</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->receive_trans_id.'">'.$row->account_name.'  </option>';
  }
  return $output;
 }


  public function get_expenses_reject($req_id){
 	$data = $this->db->query("SELECT * FROM tbl_request_exp WHERE req_id = '$req_id'");
 	return $data->row();
 }


 public function get_blanch_expDetail($from,$to,$blanch_id){
$data = $this->db->query("SELECT * FROM tbl_request_exp re LEFT JOIN tbl_blanch b ON b.blanch_id = re.blanch_id WHERE re.req_date between '$from' and '$to' AND re.blanch_id = '$blanch_id' GROUP BY re.blanch_id");
return $data->result();
}

public function get_blanch_Total_expDetail($from,$to,$blanch_id){
$data = $this->db->query("SELECT SUM(re.req_amount) AS total_request_comapany FROM tbl_request_exp re LEFT JOIN tbl_blanch b ON b.blanch_id = re.blanch_id WHERE re.req_date between '$from' and '$to' AND re.blanch_id = '$blanch_id' GROUP BY re.blanch_id");
return $data->row();
}


public function get_blanch_expDetail_comp($from,$to,$comp_id){
$data = $this->db->query("SELECT * FROM tbl_request_exp re LEFT JOIN tbl_blanch b ON b.blanch_id = re.blanch_id WHERE re.req_date between '$from' and '$to' AND re.comp_id = '$comp_id' GROUP BY re.blanch_id");
return $data->result();
}

public function get_total_expDetail_company($from,$to,$comp_id){
$data = $this->db->query("SELECT SUM(re.req_amount) AS total_request_comapany FROM tbl_request_exp re LEFT JOIN tbl_blanch b ON b.blanch_id = re.blanch_id WHERE re.req_date between '$from' and '$to' AND re.comp_id = '$comp_id'");
return $data->row();
}

public function get_deducted_incomeFilter($from,$to,$blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_deducted_fee df JOIN tbl_loans l ON l.loan_id = df.loan_id JOIN tbl_blanch b ON b.blanch_id = df.blanch_id WHERE df.deducted_date between '$from' and '$to' AND df.blanch_id = '$blanch_id' GROUP BY df.blanch_id");
	return $data->result();
}

public function get_deducted_incomeFilterComp($from,$to,$comp_id){
	$data = $this->db->query("SELECT * FROM tbl_deducted_fee df JOIN tbl_loans l ON l.loan_id = df.loan_id JOIN tbl_blanch b ON b.blanch_id = df.blanch_id WHERE df.deducted_date between '$from' and '$to' AND df.comp_id = '$comp_id' GROUP BY df.blanch_id");
	return $data->result();
}

public function get_total_blanch_data($from,$to,$blanch_id){
	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted_comps FROM tbl_deducted_fee WHERE deducted_date between '$from' and '$to' AND blanch_id = '$blanch_id'");
	return $data->row();
}

public function get_total_blanch_dataAll($from,$to,$comp_id){
	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted_comps FROM tbl_deducted_fee WHERE deducted_date between '$from' and '$to' AND comp_id = '$comp_id'");
	return $data->row();
}

public function get_deducted_incomeFilter_blanch($from,$to,$blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_deducted_fee df JOIN tbl_loans l ON l.loan_id = df.loan_id JOIN tbl_blanch b ON b.blanch_id = df.blanch_id JOIN tbl_customer c ON c.customer_id = l.customer_id WHERE df.deducted_date between '$from' and '$to' AND df.blanch_id = '$blanch_id'");
	return $data->result();
}


public function get_total_blanch_deducted($from,$to,$blanch_id){
	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted FROM tbl_deducted_fee WHERE deducted_date between '$from' and '$to' AND blanch_id = '$blanch_id'");
	return $data->result();
}


public function check_empl_privillage($position_id,$empl_id,$comp_id){
		$data = $this->db->where(['position_id'=>$position_id,'empl_id'=>$empl_id,'comp_id'=>$comp_id])
    	        ->get('tbl_privellage');
    	  if ($data->num_rows() > 0) {
    	  	return $data->row();
    	  	
    	  }
       }

 public function fetch_employee($blanch_id)
 {
  $this->db->where('blanch_id', $blanch_id);
  $this->db->order_by('empl_id', 'ASC');
  $query = $this->db->get('tbl_employee');
  $output = '<option value="">Select Employee</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->empl_id.'">'.$row->empl_name.'  </option>';
  }
  return $output;
 }


 public function get_guarantors_data($customer_id){
 	$data = $this->db->query("SELECT * FROM tbl_sponser sp LEFT JOIN tbl_region r ON r.region_id = sp.sp_region WHERE sp.customer_id = '$customer_id'");
 	return $data->result();
 }

  public function get_borrowe_alert($customer_id){
 	$data = $this->db->query("SELECT COUNT(customer_id) AS total_loan FROM tbl_loans WHERE customer_id = '$customer_id'");
 	return $data->row();
 }

 public function get_total_remain_with($loan_id){
 	$data = $this->db->query("SELECT * FROM tbl_pay WHERE loan_id = '$loan_id' ORDER BY pay_id DESC limit 1");
 	return $data->row();
 }


 public function get_total_loan_pend($loan_id){
 	$data = $this->db->query("SELECT SUM(total_pend) AS total_pending FROM  tbl_pending_total WHERE loan_id = '$loan_id'LIMIT 1");
 	return $data->row();
 }


 public function get_total_penart_loan($loan_id){
 	$data = $this->db->query("SELECT SUM(penart_amount) AS total_penart FROM tbl_customer_report WHERE loan_id = '$loan_id' LIMIT 1");
 	return $data->row();
 }

 public function get_total_paypenart($loan_id){
 	$data = $this->db->query("SELECT SUM(penart_paid) AS total_penart_paid FROM tbl_pay_penart WHERE loan_id = '$loan_id' LIMIT 1");
 	return $data->row();
 }


 public function get_today_deposit_record($loan_id,$deposit_date){
 	$data = $this->db->query("SELECT * FROM tbl_depost WHERE loan_id = '$loan_id' AND depost_day = '$deposit_date' ORDER BY dep_id DESC LIMIT 1");
 	return $data->row();
 }

 public function get_prev_record_report($loan_id,$deposit_date){
 	$data = $this->db->query("SELECT * FROM tbl_prev_lecod WHERE loan_id = '$loan_id' AND lecod_day = '$deposit_date' ORDER BY prev_id DESC LIMIT 1");
 	return $data->row();
 }


 public function get_loan_withdrawal_today($comp_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT * FROM tbl_outstand ot JOIN tbl_loans l ON l.loan_id = ot.loan_id JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id JOIN tbl_account_transaction at ON at.trans_id = l.method WHERE ot.comp_id = '$comp_id' AND l.loan_status = 'withdrawal' AND ot.loan_stat_date = '$date'");
 	return $data->result();
 }


 public function get_today_loan_withdrawal_loan($comp_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(l.loan_aprove)AS total_with_loan,SUM(l.loan_int) AS total_loan_int FROM tbl_outstand ot JOIN tbl_loans l ON l.loan_id = ot.loan_id WHERE ot.comp_id = '$comp_id' AND l.loan_status = 'withdrawal' AND ot.loan_stat_date = '$date'");
 	return $data->row();
 }


 public function get_previous_loan_with($from,$to,$blanch_id){
 	$data = $this->db->query("SELECT * FROM tbl_outstand ot LEFT JOIN tbl_loans l ON l.loan_id = ot.loan_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id LEFT  JOIN tbl_account_transaction at ON at.trans_id = l.method WHERE ot.loan_stat_date between '$from' and '$to' AND l.blanch_id = '$blanch_id'");
 	return $data->result();
 }

 public function get_previous_loan_withcategory($comp_id,$blanch_id,$category_id,$loan_status){
  $data = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_loan_category lc ON lc.category_id = l.category_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id LEFT JOIN tbl_account_transaction at ON at.trans_id = l.method WHERE l.comp_id = '$comp_id' AND l.blanch_id = '$blanch_id' AND l.category_id = '$category_id' AND l.loan_status = '$loan_status'");
  return $data->result();
 }

  public function get_previous_all_category($comp_id,$blanch_id,$loan_status){
  $data = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_loan_category lc ON lc.category_id = l.category_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id LEFT JOIN tbl_account_transaction at ON at.trans_id = l.method WHERE l.comp_id = '$comp_id' AND l.blanch_id = '$blanch_id' AND l.loan_status = '$loan_status'");
  return $data->result();
 }

  public function get_previous_loan_withcategory_sum($comp_id,$blanch_id,$category_id,$loan_status){
  $data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_principal,SUM(l.loan_int) AS total_loan_interest FROM tbl_loans l LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_loan_category lc ON lc.category_id = l.category_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id LEFT JOIN tbl_account_transaction at ON at.trans_id = l.method WHERE l.comp_id = '$comp_id' AND l.blanch_id = '$blanch_id' AND l.category_id = '$category_id' AND l.loan_status = '$loan_status'");
  return $data->row();
 }

  public function get_previous_categoryAll_sum($comp_id,$blanch_id,$loan_status){
  $data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_principal,SUM(l.loan_int) AS total_loan_interest FROM tbl_loans l LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_loan_category lc ON lc.category_id = l.category_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id LEFT JOIN tbl_account_transaction at ON at.trans_id = l.method WHERE l.comp_id = '$comp_id' AND l.blanch_id = '$blanch_id' AND l.loan_status = '$loan_status'");
  return $data->row();
 }



  public function get_previous_loan_with_total($from,$to,$blanch_id){
 	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loan_aprove,SUM(l.loan_int) AS total_loan_int FROM tbl_outstand ot LEFT JOIN tbl_loans l ON l.loan_id = ot.loan_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id LEFT JOIN tbl_account_transaction at ON at.trans_id = l.method WHERE ot.loan_stat_date between '$from' and '$to' AND l.blanch_id = '$blanch_id' GROUP BY l.blanch_id");
 	return $data->row();
 }

 public function get_loanCategoryDatas($category_id)
 {
 	$data = $this->db->query("SELECT * FROM tbl_loan_category WHERE category_id = '$category_id'");
 	return $data->row();
 }

 public function get_remain_blanch_capital($blanch_id,$trans_id){
 	$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$blanch_id' AND receive_trans_id = '$trans_id' LIMIT 1");
 	return $data->row();
 }

 public function get_deposit_data_record($pay_id){
 	$data = $this->db->query("SELECT * FROM tbl_depost WHERE dep_id = $pay_id");
 	return $data->row();
 }


 public function get_description_pay($loan_id){
 	$data = $this->db->query("SELECT * FROM tbl_pay WHERE loan_id = '$loan_id' ORDER BY pay_id DESC");
 	return $data->row();
 }

 public function get_total_pend_data($loan_id){
 	$data = $this->db->query("SELECT * FROM tbl_pending_total WHERE loan_id = '$loan_id'");
 	return $data->row();
 }


 public function get_sum_deposit($loan_id){
 	$data = $this->db->query("SELECT SUM(depost) AS depos FROM tbl_depost WHERE loan_id = '$loan_id'");
 	return $data->row();
 }

 public function get_outstand_loan_customer($loan_id){
 	$data = $this->db->query("SELECT SUM(remain_amount) AS total_out FROM tbl_outstand_loan WHERE loan_id = '$loan_id'");
 	return $data->row();
 }

 public function get_end_deposit_time($loan_id){
 	$data = $this->db->query("SELECT * FROM tbl_depost WHERE loan_id = '$loan_id' ORDER BY dep_id DESC LIMIT 1");
 	return $data->row();
 }

  public function get_end_deposit_time_date($loan_id){
  $today = date("Y-m-d");
 	$data = $this->db->query("SELECT * FROM tbl_depost WHERE loan_id = '$loan_id' AND date(deposit_day) = '$today' ORDER BY dep_id DESC LIMIT 1");
 	return $data->row();
 }


 public function get_outstand_loan_depost($loan_id){
 	$data = $this->db->query("SELECT * FROM tbl_outstand_loan WHERE loan_id = '$loan_id'");
 	return $data->row();
 }


 public function get_deducted_fee_prev($from,$to,$blanch_id){
 	$data = $this->db->query("SELECT * FROM tbl_deducted_fee df LEFT JOIN tbl_loans l ON l.loan_id = df.loan_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id WHERE df.deducted_date between '$from' and '$to' AND df.blanch_id = '$blanch_id'");
 	return $data->result();
 }

 public function get_total_deducted($from,$to,$blanch_id){
 	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducteds FROM tbl_deducted_fee WHERE deducted_date between '$from' and '$to' AND blanch_id = '$blanch_id'");
 	return $data->row();
 }


 public function get_deducted_income_blanch($blanch_id){
 	$data = $this->db->query("SELECT SUM(rc.deducted) AS total_deducted,b.blanch_name FROM tbl_receive_deducted rc  JOIN tbl_blanch b ON b.blanch_id = rc.blanch_id  WHERE rc.blanch_id = '$blanch_id'");
 	return $data->row();
 }


 public function get_non_deducted_income_blanch($blanch_id){
 	$data = $this->db->query("SELECT SUM(nd.non_balance) AS total_nonbalance,b.blanch_name FROM tbl_receive_non_deducted nd JOIN tbl_blanch b ON b.blanch_id = nd.blanch_id WHERE nd.blanch_id = '$blanch_id'");
 	return $data->row();
 }


 public function get_blanch_capital_blanch($blanch_id){
 	$data = $this->db->query("SELECT SUM(blanch_capital) AS total_blanch_capital FROM tbl_blanch_account WHERE blanch_id = '$blanch_id'");
 	return $data->row();
 }

 public function get_total_loan_with($blanch_id){
 	$today = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loanAprove,SUM(l.loan_int) AS total_loanInt FROM tbl_outstand ot LEFT JOIN tbl_loans l ON l.loan_id = ot.loan_id WHERE l.loan_status = 'withdrawal' AND l.blanch_id = '$blanch_id' AND ot.loan_stat_date = '$today'");
 	return $data->row();
 }

 public function get_outstand_loanBranch($blanch_id){
 	$data = $this->db->query("SELECT SUM(remain_amount) AS total_outstand FROM tbl_outstand_loan WHERE blanch_id = '$blanch_id'");
 	return $data->row();
 }

 public function get_Account_balance_blanch_data($blanch_id){
 	$data = $this->db->query("SELECT ba.blanch_id,at.account_name,ba.blanch_capital,at.trans_id FROM tbl_blanch_account ba LEFT JOIN tbl_account_transaction at ON at.trans_id = ba.receive_trans_id WHERE ba.blanch_id = '$blanch_id'");
 	return $data->result();
 }

 //comp balance
  public function get_Account_balance_comp_data($comp_id){
 	$data = $this->db->query("SELECT ba.blanch_id,at.account_name,ba.blanch_capital,at.trans_id FROM tbl_blanch_account ba LEFT JOIN tbl_account_transaction at ON at.trans_id = ba.receive_trans_id WHERE ba.comp_id = '$comp_id'");
 	return $data->result();
 }

 public function get_blanch_employee($blanch_id){
 	$data = $this->db->query("SELECT * FROM tbl_employee WHERE blanch_id = '$blanch_id'");
 	return $data->result();
 }


 public function get_sum_blanch_account($blanch_id){
 	$data = $this->db->query("SELECT SUM(blanch_capital) AS total_capital_blanch FROM tbl_blanch_account WHERE blanch_id = '$blanch_id'");
 	return $data->row();
 }


 public function get_cash_inhand($blanch_id){
 	$today = date("Y-m-d");
 	$data = $this->db->query("SELECT * FROM tbl_cash_inhand WHERE blanch_id = '$blanch_id' AND cash_day = '$today'");
 	return $data->row();
 }

 public function get_total_deduction_data($blanch_id){
 	$today = date("Y-m-d");
 	$data = $this->db->query("SELECT * FROM  tbl_deduction WHERE blanch_id = '$blanch_id' AND date = '$today'");
 	return $data->row();
 }


 public function get_account_transfor($blanch_id){
 	$today = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(blanch_amount) AS total_float FROM tbl_transfor WHERE blanch_id = '$blanch_id' AND trans_day = '$today'");
 	return $data->row();
 }

 //company transaction 

 public function get_account_transfor_company($comp_id){
 	$today = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(blanch_amount) AS total_float FROM tbl_transfor WHERE comp_id = '$comp_id' AND trans_day = '$today'");
 	return $data->row();
 }


 public function get_blanch_capital_account($blanch_id,$account){
 	$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$blanch_id' AND receive_trans_id = '$account'");
 	return $data->row();
 }


 public function get_income_transaction($blanch_id){
 	$today = date("Y-m-d");
 	$data = $this->db->query("SELECT * FROM tbl_transfor_blanch_blanch tb LEFT JOIN tbl_employee e ON e.empl_id = tb.user_trans LEFT JOIN tbl_account_transaction at ON at.trans_id = tb.to_blach_account_id WHERE tb.from_blanch_id = '$blanch_id' AND tb.date_transfor = '$today'");
 	return $data->result();
 }

 public function get_transaction_blanch($id){
 	$data = $this->db->query("SELECT * FROM tbl_transfor_blanch_blanch WHERE id = '$id'");
 	return $data->row();
 }

 public function get_income_transaction_data($blanch_id){
 	$today = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(from_mount) AS total_transaction FROM tbl_transfor_blanch_blanch WHERE from_blanch_id = '$blanch_id' AND date_transfor = '$today'");
 	return $data->row();
 }

 //company_income
  public function get_income_transaction_datacomp($comp_id){
 	$today = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(from_mount) AS total_transaction FROM tbl_transfor_blanch_blanch WHERE comp_id = '$comp_id' AND date_transfor = '$today'");
 	return $data->row();
 }


 public function get_yesterday_balance($blanch_id){
 	$date = date("Y-m-d");
  $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
 	$data = $this->db->query("SELECT * FROM tbl_cash_inhand WHERE blanch_id = '$blanch_id' AND cash_day = '$back'");
 	return $data->row();
 }

 //comp yesterday balance
  public function get_yesterday_balance_comp($comp_id){
 	$date = date("Y-m-d");
  $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
 	$data = $this->db->query("SELECT SUM(cash_amount) AS total_yesterday_Balance FROM tbl_cash_inhand WHERE comp_id = '$comp_id' AND cash_day = '$back'");
 	return $data->row();
 }


 public function get_total_today_deposit($blanch_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(depost) AS total_deposit FROM tbl_depost WHERE blanch_id = '$blanch_id' AND depost_day = '$date' AND dep_status = 'withdrawal'");
 	return $data->row();
 }

 //comp todaydeposit
  public function get_total_today_deposit_comp($comp_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(depost) AS total_deposit FROM tbl_depost WHERE comp_id = '$comp_id' AND depost_day = '$date' AND dep_status = 'withdrawal'");
 	return $data->row();
 }


 public function get_today_cash_balance($blanch_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(cash_amount) AS today_cash FROM tbl_cash_inhand WHERE blanch_id = '$blanch_id' AND cash_day = '$date'");
 	return $data->row();
 }

 //company today balance
  public function get_today_cash_balancecompany($comp_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(cash_amount) AS today_cash FROM tbl_cash_inhand WHERE comp_id = '$comp_id' AND cash_day = '$date'");
 	return $data->row();
 }


 public function get_loan_withdrawal_today_blanch($blanch_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loan_with,SUM(l.loan_int) AS total_loan_int FROM tbl_outstand ot LEFT JOIN tbl_loans l ON l.loan_id = ot.loan_id WHERE ot.blanch_id = '$blanch_id' AND ot.loan_stat_date = '$date'");
 	return  $data->row();
 }

 //company loanwith
 public function get_loan_withdrawal_today_company($comp_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loan_with,SUM(l.loan_int) AS total_loan_int FROM tbl_outstand ot LEFT JOIN tbl_loans l ON l.loan_id = ot.loan_id WHERE ot.comp_id = '$comp_id' AND ot.loan_stat_date = '$date' AND l.loan_status = 'withdrawal'");
 	return  $data->row();
 }

 public function get_today_prepaid_today($blanch_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(prepaid_amount) AS total_prepaid FROM tbl_prepaid WHERE blanch_id = '$blanch_id' AND prepaid_date = '$date'");
 	return $data->row();
 }

 //company prepaid
 public function get_today_prepaid_today_company($comp_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(prepaid_amount) AS total_prepaid FROM tbl_prepaid WHERE comp_id = '$comp_id' AND prepaid_date = '$date'");
 	return $data->row();
 }

 public function insert_stoo_amount($data){
 	return $this->db->insert('tbl_stoo',$data);
 }

 public function get_stoo_transaction($blanch_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT * FROM  tbl_stoo s JOIN tbl_account_transaction at ON at.trans_id = s.from_account JOIN tbl_employee e ON e.empl_id = s.empl_id WHERE s.blanch_id = '$blanch_id' AND s.stoo_date = '$date'");
 	return $data->result();
 }

 public function get_total_stoo_trans($blanch_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(stoo_amount) AS total_stoo FROM tbl_stoo WHERE blanch_id = '$blanch_id' AND stoo_date = '$date'");
 	return $data->row();
 }

 //company stoo
 public function get_total_stoo_trans_company($comp_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(stoo_amount) AS total_stoo FROM tbl_stoo WHERE comp_id = '$comp_id' AND stoo_date = '$date'");
 	return $data->row();
 }

 public function get_stoo_transaction_delete($stoo_id){
 	$data = $this->db->query("SELECT * FROM tbl_stoo WHERE stoo_id = '$stoo_id'");
 	return $data->row();
 }


 public function get_yesterday_income($blanch_id){
 	$date = date("Y-m-d");
  $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
 	$data = $this->db->query("SELECT * FROM tbl_deduction WHERE blanch_id = '$blanch_id' AND date = '$back'");
 	return $data->row();
 }

 //company yester_dayIncome
  public function get_yesterday_income_company($comp_id){
 	$date = date("Y-m-d");
  $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
 	$data = $this->db->query("SELECT SUM(amount) AS total_deduction FROM tbl_deduction WHERE comp_id = '$comp_id' AND date = '$back'");
 	return $data->row();
 }

 public function get_today_income_deducted($blanch_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted_data FROM tbl_deducted_fee WHERE blanch_id = '$blanch_id' AND deducted_date = '$date'");
 	return $data->row();
 }

 public function get_today_non_deducted($blanch_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(receve_amount) AS total_nondata FROM tbl_receve WHERE blanch_id = '$blanch_id' AND receve_day = '$date'");
 	return $data->row();
 }

 //company nondeducted
 public function get_today_non_deducted_company($comp_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(receve_amount) AS total_nondata FROM tbl_receve WHERE comp_id = '$comp_id' AND receve_day = '$date'");
 	return $data->row();
 }

 public function get_expense_data($comp_id){
 	$data = $this->db->query("SELECT * FROM tbl_expenses WHERE comp_id = '$comp_id'");
 	return $data->result();
 }

 public function insert_reques_expenses($data){
 	return $this->db->insert('tbl_request_exp',$data);
 }


 public function get_today_expense_request($blanch_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT * FROM tbl_request_exp rx JOIN tbl_expenses ex ON ex.ex_id = rx.ex_id  LEFT JOIN tbl_employee e ON e.empl_id = rx.empl_id LEFT JOIN tbl_account_transaction at ON at.trans_id = rx.trans_id WHERE rx.blanch_id = '$blanch_id' AND rx.req_date = '$date'");
 	return $data->result();
 }

 public function get_total_expenses_req($blanch_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(req_amount) AS tota_expes FROM tbl_request_exp WHERE blanch_id = '$blanch_id' AND req_date = '$date'");
 	return $data->row();
 }

 //company Expenses
 public function get_total_expenses_reqcompany($comp_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(req_amount) AS tota_expes FROM tbl_request_exp WHERE comp_id = '$comp_id' AND req_date = '$date'");
 	return $data->row();
 }

 public function get_more_expenses_today($blanch_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(rx.req_amount) AS total_expenses,ex.ex_name FROM tbl_request_exp rx LEFT JOIN tbl_expenses ex ON ex.ex_id = rx.ex_id WHERE rx.blanch_id = '$blanch_id' AND req_date = '$date' GROUP BY rx.ex_id ");
 	return $data->result();
 }

 //company expenses
  public function get_more_expenses_todaycompany($comp_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(rx.req_amount) AS total_expenses,ex.ex_name FROM tbl_request_exp rx LEFT JOIN tbl_expenses ex ON ex.ex_id = rx.ex_id WHERE rx.comp_id = '$comp_id' AND req_date = '$date' GROUP BY rx.ex_id ");
 	return $data->result();
 }


 public function get_transaction_from_incToblanch_account($blanch_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(from_mount) AS total_incTrans FROM  tbl_transfor_blanch_blanch WHERE from_blanch_id = '$blanch_id' AND date_transfor = '$date'");
 	return $data->row();
 }

 //company kopea
 public function get_transaction_from_incToblanch_account_company($comp_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(from_mount) AS total_incTrans FROM  tbl_transfor_blanch_blanch WHERE comp_id = '$comp_id' AND date_transfor = '$date'");
 	return $data->row();
 }

 public function get_deduction_lala($blanch_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(amount) AS total_incLala FROM tbl_deduction WHERE blanch_id = '$blanch_id' AND date = '$date'");
 	return $data->row();
 }

 //company lalaincome
 public function get_deduction_lala_comp($comp_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(amount) AS total_incLala FROM tbl_deduction WHERE comp_id = '$comp_id' AND date = '$date'");
 	return $data->row();
 }

public function get_today_receivable($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(restration) AS total_restration FROM tbl_loans WHERE blanch_id = '$blanch_id' AND date_show = '$date'");
	return $data->row();
}

public function get_request_expenses($req_id){
	$data = $this->db->query("SELECT * FROM tbl_request_exp WHERE req_id = '$req_id'");
	return $data->row();
}



public function get_loan_withdrawal_today_blanch_general($blanch_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT * FROM tbl_outstand ot JOIN tbl_loans l ON l.loan_id = ot.loan_id JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id JOIN tbl_account_transaction at ON at.trans_id = l.method WHERE ot.blanch_id = '$blanch_id' AND ot.loan_stat_date = '$date'");
 	return $data->result();
 }


  public function get_previous_loan_with_blanch($from,$to,$blanch_id){
 	$data = $this->db->query("SELECT * FROM tbl_outstand ot LEFT JOIN tbl_loans l ON l.loan_id = ot.loan_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id LEFT JOIN tbl_account_transaction at ON at.trans_id = l.method WHERE ot.loan_stat_date between '$from' and '$to' AND l.blanch_id = '$blanch_id'");
 	return $data->result();
 }


 public function total_filter_loan_with($from,$to,$blanch_id,$loan_status){
 	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loan,SUM(l.loan_int) AS total_interest FROM tbl_outstand ot LEFT JOIN tbl_loans l ON l.loan_id = ot.loan_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id LEFT JOIN tbl_account_transaction at ON at.trans_id = l.method WHERE ot.loan_stat_date between '$from' and '$to' AND l.blanch_id = '$blanch_id'");
 	return $data->row();
 }


 public function get_outstand_loan_blanch($blanch_id){
 	$data = $this->db->query("SELECT * FROM tbl_outstand_loan ol LEFT JOIN tbl_loans l ON l.loan_id = ol.loan_id LEFT JOIN tbl_customer c ON c.customer_id = ol.customer_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id LEFT JOIN tbl_outstand ot ON ot.loan_id = ol.loan_id LEFT JOIN tbl_loan_category lc ON lc.category_id = l.category_id LEFT JOIN tbl_account_transaction at ON at.trans_id = l.method WHERE ol.blanch_id = '$blanch_id' AND ol.out_status = 'open'");
 	return $data->result();
 }

  public function get_outstand_loan_company($comp_id){
 	$data = $this->db->query("SELECT * FROM tbl_outstand_loan ol LEFT JOIN tbl_loans l ON l.loan_id = ol.loan_id LEFT JOIN tbl_customer c ON c.customer_id = ol.customer_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id LEFT JOIN tbl_outstand ot ON ot.loan_id = ol.loan_id LEFT JOIN tbl_loan_category lc ON lc.category_id = l.category_id LEFT JOIN tbl_account_transaction at ON at.trans_id = l.method LEFT JOIN tbl_blanch b ON b.blanch_id = ol.blanch_id WHERE ol.comp_id = '$comp_id' AND ol.out_status = 'open'");
 	return $data->result();
 }


 public function filter_loan_default($blanch_id){
 	$data = $this->db->query("SELECT * FROM tbl_outstand_loan ol LEFT JOIN tbl_loans l ON l.loan_id = ol.loan_id LEFT JOIN tbl_customer c ON c.customer_id = ol.customer_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id LEFT JOIN tbl_outstand ot ON ot.loan_id = ol.loan_id LEFT JOIN tbl_loan_category lc ON lc.category_id = l.category_id LEFT JOIN tbl_account_transaction at ON at.trans_id = l.method LEFT JOIN tbl_blanch b ON b.blanch_id = ol.blanch_id WHERE ol.blanch_id = '$blanch_id' AND ol.out_status = 'open'");
 	return $data->result();
 }

 public function get_total_outStand($blanch_id){
 	$data = $this->db->query("SELECT SUM(ol.remain_amount) AS total_remain FROM tbl_outstand_loan ol WHERE ol.blanch_id = '$blanch_id' AND ol.out_status = 'open'");
 	return $data->row();
 }

  public function get_total_outStand_comp($comp_id){
 	$data = $this->db->query("SELECT SUM(ol.remain_amount) AS total_remain FROM tbl_outstand_loan ol WHERE ol.comp_id = '$comp_id' AND ol.out_status = 'open'");
 	return $data->row();
 }

  public function get_total_outStand_blanch($blanch_id){
 	$data = $this->db->query("SELECT SUM(ol.remain_amount) AS total_remain FROM tbl_outstand_loan ol WHERE ol.blanch_id = '$blanch_id' AND ol.out_status = 'open'");
 	return $data->row();
 }

 public function get_total_outStandcomp($comp_id){
 	$data = $this->db->query("SELECT SUM(ol.remain_amount) AS total_remain FROM tbl_outstand_loan ol WHERE ol.comp_id = '$comp_id' AND ol.out_status = 'open'");
 	return $data->row();
 }

 	public function get_cash_transaction_blanch($blanch_id){
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT * FROM tbl_prev_lecod pr LEFT JOIN tbl_customer c ON c.customer_id = pr.customer_id LEFT JOIN tbl_blanch b ON b.blanch_id = pr.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = pr.empl_id WHERE pr.blanch_id = '$blanch_id' AND date(pr.time_rec) = '$date' ORDER BY prev_id DESC");
		 return $data->result();
	}


	
	public function get_cash_transaction_sum_blanch($blanch_id){
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT SUM(loan_aprov) AS total_aprove,SUM(depost) AS total_deposit,SUM(double_dep) AS total_double FROM tbl_prev_lecod pr LEFT JOIN tbl_customer c ON c.customer_id = pr.customer_id LEFT JOIN tbl_blanch b ON b.blanch_id = pr.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = pr.empl_id WHERE pr.blanch_id = '$blanch_id' AND date(pr.time_rec) = '$date' ORDER BY prev_id DESC");
		 return $data->row();
	}


	public function get_blanchTransaction_blanch($from,$to,$blanch_id){
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT * FROM tbl_prev_lecod p JOIN tbl_customer c ON c.customer_id = p.customer_id JOIN tbl_blanch b ON b.blanch_id = p.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = p.empl_id WHERE date(p.time_rec) between '$from' and '$to' AND p.blanch_id = '$blanch_id'");
		return $data->result();
	}


	 public function get_loanlejectBlanch($blanch_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.loan_status = 'reject'  AND l.blanch_id = '$blanch_id' ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }


       public function insert_saving_deposit($data){
       	return $this->db->insert('tbl_miamala',$data);
       }

       public function get_blanch_account_balance($blanch_id,$account){
       	$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$blanch_id' AND receive_trans_id = '$account'");
       	return $data->row();
       }


       public function get_saving_deposit($blanch_id){
       	$data = $this->db->query("SELECT * FROM tbl_miamala m LEFT JOIN tbl_account_transaction at ON at.trans_id = m.provider WHERE m.blanch_id = '$blanch_id' ORDER BY m.id DESC");
       	return $data->result();
       }


       public function get_outstand_deposit($blanch_id,$trans_id){
       	$data = $this->db->query("SELECT * FROM tbl_receve_outstand WHERE blanch_id = '$blanch_id' AND trans_id = '$trans_id'");
       	return $data->row();
       }

       public function get_total_deposit_out($blanch_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(depost) AS total_out_dep FROM tbl_depost WHERE blanch_id = '$blanch_id' AND dep_status = 'out' AND date(depost_day) = '$date'");
       	return $data->row();
       }

       public function get_total_deposit_out_comp($comp_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(depost) AS total_out_dep FROM tbl_depost WHERE comp_id = '$comp_id' AND dep_status = 'out' AND date(depost_day) = '$date'");
       	return $data->row();
       }

       public function get_total_blanch_outstand_account($blanch_id){
       	$data = $this->db->query("SELECT SUM(out_balance) AS total_outbalance_deposit FROM  tbl_receve_outstand WHERE blanch_id = '$blanch_id'");
       	return $data->row();
       }

       public function get_outsatand_deposit($blanch_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT * FROM tbl_receive_out_date WHERE blanch_id = '$blanch_id' AND date_out = '$date'");
       	return $data->row();
       }


       public function get_prev_outstand_date($blanch_id){
       	$date = date("Y-m-d");
        $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
       	$data = $this->db->query("SELECT * FROM tbl_receive_out_date WHERE blanch_id = '$blanch_id' AND date_out = '$back'");
       	return $data->row();
       }

       public function get_prev_outstand_date_company($comp_id){
       	$date = date("Y-m-d");
        $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
       	$data = $this->db->query("SELECT SUM(total_balance) AS total_outbalance FROM tbl_receive_out_date WHERE comp_id = '$comp_id' AND date_out = '$back'");
       	return $data->row();
       }

       public function get_today_outstand_stoo($blanch_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT * FROM tbl_receive_out_date WHERE blanch_id = '$blanch_id' AND date_out = '$date'");
       	return $data->row();
       }

        public function get_today_outstand_stoo_company($comp_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(total_balance) AS total_out_lala FROM tbl_receive_out_date WHERE comp_id = '$comp_id' AND date_out = '$date'");
       	return $data->row();
       }

       public function get_outstand_loan_data_branch($blanch_id){
       	$data = $this->db->query("SELECT SUM(remain_amount) AS total_out_rem FROM tbl_outstand_loan WHERE blanch_id = '$blanch_id'");
       	return $data->row();
       }

       public function get_outstand_loan_data_company($comp_id){
       	$data = $this->db->query("SELECT SUM(remain_amount) AS total_out_rem FROM tbl_outstand_loan WHERE comp_id = '$comp_id'");
       	return $data->row();
       }

       public function get_outstand_account_balance($blanch_id){
       	$data = $this->db->query("SELECT * FROM tbl_receve_outstand ro LEFT JOIN tbl_account_transaction at ON at.trans_id = ro.trans_id WHERE ro.blanch_id = '$blanch_id' GROUP BY ro.trans_id");
       	return $data->result();
       }

       public function get_outstand_account_balance_company($comp_id){
       	$data = $this->db->query("SELECT SUM(ro.out_balance) AS total_outbalanceIn,at.account_name FROM tbl_receve_outstand ro LEFT JOIN tbl_account_transaction at ON at.trans_id = ro.trans_id WHERE ro.comp_id = '$comp_id' GROUP BY ro.trans_id");
       	return $data->result();
       }

       public function get_deducted_day($blanch_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT * FROM tbl_deduction_day WHERE blanch_id = '$blanch_id' AND date_deduct = '$date'");
       	return $data->row();
       }


       public function get_non_deductedDay($blanch_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT * FROM tbl_non_deduct_day WHERE blanch_id = '$blanch_id' AND non_date = '$date'");
       	return $data->row();
       }


       public function get_prev_deducted_income($blanch_id){
       	$date = date("Y-m-d");
        $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
       	$data = $this->db->query("SELECT * FROM tbl_deduction_day WHERE blanch_id = '$blanch_id' AND date_deduct = '$back'");
       	return $data->row();
       }

       //prevdeduction
        public function get_prev_deducted_income_company($comp_id){
       	$date = date("Y-m-d");
        $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
       	$data = $this->db->query("SELECT SUM(deduct_balance) AS total_balance_deduct FROM tbl_deduction_day WHERE comp_id = '$comp_id' AND date_deduct = '$back'");
       	return $data->row();
       }

         public function get_today_deducted_income($blanch_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deductedtoday FROM tbl_deducted_fee WHERE blanch_id = '$blanch_id' AND deducted_date = '$date'");
       	return $data->row();
       }

       //company todayDeducted
         public function get_today_deducted_income_company($comp_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deductedtoday FROM tbl_deducted_fee WHERE comp_id = '$comp_id' AND deducted_date = '$date'");
       	return $data->row();
       }

       public function get_prev_nonDeducted_income($blanch_id){
       	$date = date("Y-m-d");
        $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
       	$data = $this->db->query("SELECT * FROM tbl_non_deduct_day WHERE blanch_id = '$blanch_id' AND non_date = '$back'");
       	return $data->row();
       }

       //comp prevnon
       public function get_prev_nonDeducted_incomeCompany($comp_id){
       	$date = date("Y-m-d");
        $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
       	$data = $this->db->query("SELECT SUM(non_deduct_balance) AS total_non FROM tbl_non_deduct_day WHERE comp_id = '$comp_id' AND non_date = '$back'");
       	return $data->row();
       }

        public function get_today_nonDeducted_income($blanch_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(receve_amount) AS total_nonDeducted_today FROM tbl_receve WHERE blanch_id = '$blanch_id' AND receve_date = '$date'");
       	return $data->row();
       }

       public function get_total_saving_deposit($blanch_id){
       	$data = $this->db->query("SELECT SUM(amount) AS total_amount_saving FROM tbl_miamala WHERE blanch_id = '$blanch_id' AND status = 'open'");
       	return $data->row();
       }

       //comp saving Deposit
        public function get_total_saving_deposit_comp($comp_id){
       	$data = $this->db->query("SELECT SUM(amount) AS total_amount_saving FROM tbl_miamala WHERE comp_id = '$comp_id' AND status = 'open'");
       	return $data->row();
       }

       public function get_miamala_data($id){
       	$data = $this->db->query("SELECT * FROM tbl_miamala WHERE id = '$id'");
       	return $data->row();
       }

       public function get_total_cashIn_Hand($blanch_id,$date){
       	$data = $this->db->query("SELECT SUM(cash_amount) AS total_cashDay FROM tbl_cash_inhand WHERE blanch_id = '$blanch_id' AND cash_day = '$date'");
       	return $data->row();
       }

       public function insert_out_standloan_out($data){
       	return $this->db->insert('tbl_out_system',$data);
       }

       public function get_default_loan_out($blanch_id){
       	$data = $this->db->query("SELECT * FROM tbl_out_system WHERE blanch_id = '$blanch_id'");
       	return $data->row();
       }

       public function update_out_data($id,$data){
       	return $this->db->where('id',$id)->update('tbl_out_system',$data);
       }

       public function insert_deposit_out($data){
       	return $this->db->insert('tbl_depost_out',$data);
       }

       public function get_receive_outsystem($blanch_id,$trans_id){
        $data = $this->db->query("SELECT * FROM tbl_receive_outsystem WHERE blanch_id = '$blanch_id' AND trans_id = '$trans_id'");
        return $data->row();
       }

       public function get_otstand_systemDeposit($blanch_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT * FROM tbl_depost_out ot LEFT JOIN tbl_account_transaction at ON at.trans_id = ot.trans_id LEFT JOIN tbl_employee e ON e.empl_id = ot.empl_id WHERE ot.blanch_id = '$blanch_id' AND ot.date = '$today'");
       	return $data->result();
       }


        public function get_otstand_systemDeposit_comp($comp_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT * FROM tbl_depost_out ot LEFT JOIN tbl_account_transaction at ON at.trans_id = ot.trans_id LEFT JOIN tbl_employee e ON e.empl_id = ot.empl_id LEFT JOIN tbl_blanch b ON b.blanch_id = ot.blanch_id WHERE ot.comp_id = '$comp_id' AND ot.date = '$today'");

       	return $data->result();
       }


        public function get_otstand_systemDeposit_compsum_deposit($comp_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(ot.amount) AS total_outsystem FROM tbl_depost_out ot LEFT JOIN tbl_account_transaction at ON at.trans_id = ot.trans_id LEFT JOIN tbl_employee e ON e.empl_id = ot.empl_id LEFT JOIN tbl_blanch b ON b.blanch_id = ot.blanch_id WHERE ot.comp_id = '$comp_id' AND ot.date = '$today'");
       	return $data->row();
       }

       public function get_total_deposit_outSystem($blanch_id){
       	$data = $this->db->query("SELECT SUM(amount) AS total_out FROM tbl_depost_out WHERE blanch_id = '$blanch_id'");
       	return $data->row();
       }

        public function get_total_deposit_outSystem_comp($comp_id){
       	$data = $this->db->query("SELECT SUM(amount) AS total_out FROM tbl_depost_out WHERE comp_id = '$comp_id'");
       	return $data->row();
       }


       public function get_today_deposit_out($blanch_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(amount) AS total_out_today FROM tbl_depost_out WHERE blanch_id = '$blanch_id' AND date = '$today'");
       	return $data->row();
       }

       public function get_today_deposit_out_company($comp_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(amount) AS total_out_today FROM tbl_depost_out WHERE comp_id = '$comp_id' AND date = '$today'");
       	return $data->row();
       }

       public function get_out_system($id){
       	$data = $this->db->query("SELECT * FROM tbl_depost_out WHERE id = '$id'");
       	return $data->row();
       }

       public function get_total_receive_out_system($blanch_id){
       	$data = $this->db->query("SELECT SUM(amount_receive) AS total_out_system FROM tbl_receive_outsystem WHERE blanch_id = $blanch_id");
       	return $data->row();
       }

       public function get_total_receive_out_systemCompany($comp_id){
       	$data = $this->db->query("SELECT SUM(amount_receive) AS total_out_system FROM tbl_receive_outsystem WHERE comp_id = $comp_id");
       	return $data->row();
       }

       public function get_out_sysstem_date($blanch_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT * FROM tbl_outsystem_day WHERE blanch_id = '$blanch_id' AND date = '$today'");
       	return $data->row();
       }


       public function get_deposit_out_system_yesterday($blanch_id){
       	$date = date("Y-m-d");
        $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
       	$data = $this->db->query("SELECT * FROM tbl_outsystem_day WHERE blanch_id = '$blanch_id' AND date = '$back'");
       	return $data->row();
       }

       public function get_deposit_out_system_yesterday_company($comp_id){
       	$date = date("Y-m-d");
        $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
       	$data = $this->db->query("SELECT SUM(amount) AS total_outsystem FROM tbl_outsystem_day WHERE comp_id = '$comp_id' AND date = '$back'");
       	return $data->row();
       }

       public function get_total_out_deni($blanch_id){
       	$data = $this->db->query("SELECT * FROM tbl_out_system WHERE blanch_id = '$blanch_id'");
       	return $data->row();
       }

       public function get_total_out_deni_comp($comp_id){
       	$data = $this->db->query("SELECT SUM(out_amount) AS total_amount_njeyamfumo FROM tbl_out_system WHERE comp_id = '$comp_id'");
       	return $data->row();
       }

       public function get_njeya_mfumo_data_account($blanch_id){
       	$data = $this->db->query("SELECT * FROM tbl_receive_outsystem ot LEFT JOIN tbl_account_transaction at ON at.trans_id = ot.trans_id WHERE ot.blanch_id = '$blanch_id' GROUP BY ot.trans_id");
       	return $data->result();
       }

       public function get_njeya_mfumo_data_account_company($comp_id){
       	$data = $this->db->query("SELECT * FROM tbl_receive_outsystem ot LEFT JOIN tbl_account_transaction at ON at.trans_id = ot.trans_id WHERE ot.comp_id = '$comp_id' GROUP BY ot.trans_id");
       	return $data->result();
       }

       public function get_receive_outstand_data($blanch_id){
       	$data = $this->db->query("SELECT SUM(out_balance) AS total_out_blanch,blanch_id FROM tbl_receve_outstand WHERE blanch_id = '$blanch_id'");
       	return $data->row();
       }

       public function get_receive_out_system_data($blanch_id){
       	$data = $this->db->query("SELECT SUM(amount_receive) AS total_out_systemData,blanch_id FROM tbl_receive_outsystem WHERE blanch_id = '$blanch_id'");
       	return $data->row();
       }

       public function insert_default_transaction($data){
       	return $this->db->insert('tbl_trans_out',$data);
       }

       public function get_outin_system_acount($blanch_id,$from_account){
       	$data = $this->db->query("SELECT * FROM tbl_receive_outsystem WHERE blanch_id = '$blanch_id' AND trans_id = '$from_account'");
       	return $data->row();
       }

       public function get_insystem_balance($blanch_id,$from_account){
       	$data = $this->db->query("SELECT * FROM tbl_receve_outstand WHERE blanch_id = '$blanch_id' AND trans_id = '$from_account'");
       	return $data->row();
       }

       public function get_total_transaction_default_insystem($blanch_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(amount_trans) AS total_trans_in,SUM(trans_fee) AS total_fee_in FROM tbl_trans_out WHERE blanch_id = '$blanch_id' AND trans_type = 'insystem' AND date = '$date'");
       	return $data->row();
       }

        public function get_total_transaction_default_insystem_company($comp_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(amount_trans) AS total_trans_in,SUM(trans_fee) AS total_fee_in FROM tbl_trans_out WHERE comp_id = '$comp_id' AND trans_type = 'insystem' AND date = '$date'");
       	return $data->row();
       }

       //company transactiondefault loab
        public function get_total_transaction_default_insystemCompany($comp_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(amount_trans) AS total_trans_in,SUM(trans_fee) AS total_fee_in FROM tbl_trans_out WHERE comp_id = '$comp_id' AND trans_type = 'insystem' AND date = '$date'");
       	return $data->row();
       }


       public function get_total_transaction_default_outsystem($blanch_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(amount_trans) AS total_trans_out,SUM(trans_fee) AS total_fee_out FROM tbl_trans_out WHERE blanch_id = '$blanch_id' AND trans_type = 'outsystem' AND date = '$date'");
       	return $data->row();
       }

        public function get_total_transaction_default_outsystemCompany($comp_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(amount_trans) AS total_trans_out,SUM(trans_fee) AS total_fee_out FROM tbl_trans_out WHERE comp_id = '$comp_id' AND trans_type = 'outsystem' AND date = '$date'");
       	return $data->row();
       }

       //company Default outsystem
       public function get_total_transaction_default_outsystem_company($comp_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(amount_trans) AS total_trans_out,SUM(trans_fee) AS total_fee_out FROM tbl_trans_out WHERE comp_id = '$comp_id' AND trans_type = 'outsystem' AND date = '$date'");
       	return $data->row();
       }


       public function get_total_transaction_default_general($blanch_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT ot.trans_type,at.account_name AS from_account,ta.account_name AS toaccount,ot.amount_trans,ot.trans_fee,ot.date,ot.id,e.empl_name FROM tbl_trans_out ot LEFT JOIN tbl_account_transaction at ON at.trans_id = ot.from_trans_id LEFT JOIN tbl_account_transaction ta ON ta.trans_id = ot.to_trans_id LEFT JOIN tbl_employee e ON e.empl_id = ot.empl_id WHERE ot.blanch_id = '$blanch_id' AND ot.date = '$date'");
       	return $data->result();
       }


       public function get_total_transaction_default($blanch_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(amount_trans) AS total_outtrans FROM tbl_trans_out WHERE blanch_id = '$blanch_id' AND date = '$date'");
       	return $data->row();
       }

       public function get_out_delete_transDefault($id){
       	$data = $this->db->query("SELECT * FROM  tbl_trans_out WHERE id = '$id'");
       	return $data->row();
       }


       public function get_total_today_deposit_loan($blanch_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(restration) AS total_restratio_today FROM tbl_loans WHERE blanch_id = '$blanch_id' AND date_show = '$date' AND dep_status = 'open'");
       	return $data->row();
       }

       //company remaindeposit
       public function get_total_today_deposit_loanCompany($comp_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(restration) AS total_restratio_today FROM tbl_loans WHERE comp_id = '$comp_id' AND date_show = '$date' AND dep_status = 'open'");
       	return $data->row();
       }


       public function get_loan_repayment_blanch($blanch_id){
       	$data = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_loan_category lc ON lc.category_id = l.category_id LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id WHERE l.blanch_id = '$blanch_id' AND l.loan_status = 'done'");
       	return $data->result();
       }


       public function get_total_pay_description_customer($customer_id){
     $data = $this->db->query("SELECT * FROM tbl_pay p LEFT JOIN tbl_loans l ON l.loan_id = p.loan_id LEFT JOIN tbl_account_transaction at ON at.trans_id = p.p_method WHERE p.customer_id = '$customer_id' ORDER BY p.pay_id DESC");
     return $data->result();
     }


     public function get_account_statement($customer_id,$from,$to){
     	$data = $this->db->query("SELECT * FROM tbl_pay p LEFT JOIN tbl_account_transaction at ON at.trans_id = p.p_method LEFT JOIN tbl_loans l ON l.loan_id = p.loan_id WHERE p.date_data between '$from' and '$to' AND p.customer_id = '$customer_id' ORDER BY p.pay_id DESC");
     	return $data->result();
     }


     public function get_customer_active($blanch_id){
     	$data = $this->db->query("SELECT * FROM tbl_customer WHERE blanch_id = '$blanch_id' AND customer_status = 'open'");
     	return $data->result();
     }

     public function get_customer_pending($blanch_id){
     	$data = $this->db->query("SELECT * FROM tbl_customer WHERE blanch_id = '$blanch_id' AND customer_status = 'pending'");
     	return $data->result();
     }
      public function get_customer_out($blanch_id){
     	$data = $this->db->query("SELECT * FROM tbl_customer WHERE blanch_id = '$blanch_id' AND customer_status = 'out'");
     	return $data->result();
     }
      public function get_customer_closed($blanch_id){
     	$data = $this->db->query("SELECT * FROM tbl_customer WHERE blanch_id = '$blanch_id' AND customer_status = 'close'");
     	return $data->result();
     }

     
      public function get_customer_All_blanch($blanch_id){
     	$data = $this->db->query("SELECT * FROM tbl_customer WHERE blanch_id = '$blanch_id'");
     	return $data->result();
     }

     public function get_prev_expenses_data($from,$to,$blanch_id){
     	$data = $this->db->query("SELECT * FROM tbl_request_exp re LEFT JOIN tbl_expenses ex ON ex.ex_id = re.ex_id LEFT JOIN tbl_employee e ON e.empl_id = re.empl_id LEFT JOIN tbl_account_transaction at ON at.trans_id = re.trans_id WHERE re.req_date between '$from' and '$to' AND re.blanch_id = '$blanch_id'");
     	return $data->result();
     }

     public function get_sum_expenses($from,$to,$blanch_id){
     	$data = $this->db->query("SELECT SUM(re.req_amount) AS total_Expenses FROM tbl_request_exp re LEFT JOIN tbl_expenses ex ON ex.ex_id = re.ex_id LEFT JOIN tbl_employee e ON e.empl_id = re.empl_id WHERE re.req_date between '$from' and '$to' AND re.blanch_id = '$blanch_id'");
     	return $data->row();
     }


     public function get_total_outsytem_loan($blanch_id,$comp_id){
     	$data = $this->db->query("SELECT * FROM  tbl_out_system WHERE blanch_id = '$blanch_id' AND comp_id = '$comp_id'");
     	return $data->row(); 
     }


     public function get_outloan_data($comp_id){
     	$data = $this->db->query("SELECT b.blanch_name,ots.id,ots.out_amount,ots.blanch_id FROM tbl_out_system ots LEFT JOIN tbl_blanch b ON b.blanch_id = ots.blanch_id WHERE ots.comp_id = '$comp_id'");

     	foreach ($data->result() as $r) {
     		$r->total_deposit_out = $this->get_deposit_out_systemloan($r->blanch_id);
     	}
     	return $data->result();
     }

     public function get_total_out($comp_id){
     	$data = $this->db->query("SELECT SUM(ots.out_amount) AS total_amount_out FROM tbl_out_system ots LEFT JOIN tbl_blanch b ON b.blanch_id = ots.blanch_id WHERE ots.comp_id = '$comp_id'");
     	return $data->row();
     }


     public function update_loan_outstand($data,$id){
     	return $this->db->where('id',$id)->update('tbl_out_system',$data);
     }


public function get_deposit_out_systemloan($blanch_id){
     $out_dep = $this->db->query("SELECT SUM(od.amount) AS total_deposit_out FROM tbl_depost_out od WHERE od.blanch_id = '$blanch_id' GROUP BY od.blanch_id");
		if ($out_dep->row()) {
			return $out_dep->row()->total_deposit_out; 
		}
		return 0; 
}



public function insert_custome_detail($data){
	return $this->db->insert('tbl_sub_customer',$data);
}


public function get_loan_data($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_loans WHERE loan_id = '$loan_id'");
	return $data->row();
}


public function get_deduction_amount_frompay($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_pay WHERE loan_id = '$loan_id'");
	return $data->result();
}

public function get_deduction_amount_fee($loan_id){
	$data = $this->db->query("SELECT SUM(withdrow) AS total_fee FROM tbl_pay WHERE loan_id = '$loan_id' LIMIT 1");
	return $data->row();
}


public function get_today_cashinhand($blanch_id,$account){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT * FROM tbl_cash_inhand WHERE blanch_id = '$blanch_id' AND cash_day = '$today' AND `trans_id`='$account'");
	return $data->row();
}

public function get_data_today_blanch($blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_blanch_account ch LEFT JOIN tbl_account_transaction at ON at.trans_id = ch.receive_trans_id WHERE ch.blanch_id = '$blanch_id'");
	return $data->result();
}

public function get_data_today_company($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_blanch_account ch LEFT JOIN tbl_account_transaction at ON at.trans_id = ch.receive_trans_id WHERE ch.comp_id = '$comp_id' GROUP BY at.trans_id");
	return $data->result();
}



public function get_yesterday_data($blanch_id,$receive_trans_id){
	$date = date("Y-m-d");
  $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
	$data = $this->db->query("SELECT SUM(cash_amount) AS yester_day_total FROM tbl_cash_inhand WHERE blanch_id = '$blanch_id' AND cash_day = '$back' AND trans_id = '$receive_trans_id'");
	return $data->result();
}



public function get_yesterday_data_comp($comp_id,$receive_trans_id){
	$date = date("Y-m-d");
  $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
	$data = $this->db->query("SELECT SUM(cash_amount) AS yester_day_total FROM tbl_cash_inhand WHERE comp_id = '$comp_id' AND cash_day = '$back' AND trans_id = '$receive_trans_id'");
	return $data->result();
}

public function get_today_data_close($blanch_id,$receive_trans_id){
	$date = date("Y-m-d");
  //$back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
	$data = $this->db->query("SELECT SUM(cash_amount) AS close_day_total FROM tbl_cash_inhand WHERE blanch_id = '$blanch_id' AND cash_day = '$date'AND trans_id = '$receive_trans_id'");
	return $data->result();
}

// public function get_today_data_close($blanch_id,$receive_trans_id){
// 	$date = date("Y-m-d");
//   //$back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
// 	$data = $this->db->query("SELECT SUM(cash_amount) AS close_day_total FROM tbl_cash_inhand WHERE blanch_id = '$blanch_id' AND cash_day = '$date'AND trans_id = '$receive_trans_id'");
// 	return $data->result();
// }

public function get_today_data_close_company($comp_id,$receive_trans_id){
	$date = date("Y-m-d");
  //$back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
	$data = $this->db->query("SELECT SUM(cash_amount) AS close_day_total FROM tbl_cash_inhand WHERE comp_id = '$comp_id' AND cash_day = '$date'AND trans_id = '$receive_trans_id'");
	return $data->result();
}

public function get_today_income_data($blanch_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(dd.deduct_balance) AS total_deduct,lf.description FROM tbl_deduction_data dd JOIN tbl_loan_fee lf ON lf.fee_id = dd.fee_id WHERE dd.blanch_id = '$blanch_id'  AND dd.date_deduct = '$date' AND dd.trans_id = '$receive_trans_id' GROUP BY dd.fee_id");
	return $data->result();
}

public function get_today_income_data_comp($comp_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(dd.deduct_balance) AS total_deduct,lf.description FROM tbl_deduction_data dd JOIN tbl_loan_fee lf ON lf.fee_id = dd.fee_id WHERE dd.comp_id = '$comp_id'  AND dd.date_deduct = '$date' AND dd.trans_id = '$receive_trans_id' GROUP BY dd.fee_id");
	return $data->result();
}

public function get_today_income_data_prev($blanch_id,$receive_trans_id,$from,$to){
	$data = $this->db->query("SELECT SUM(dd.deduct_balance) AS total_deduct,lf.description FROM tbl_deduction_data dd JOIN tbl_loan_fee lf ON lf.fee_id = dd.fee_id WHERE dd.date_deduct between '$from' and '$to' AND  dd.blanch_id = '$blanch_id' AND dd.trans_id = '$receive_trans_id' GROUP BY dd.fee_id");
	return $data->result();
}


public function get_today_income_data_prev_comp($comp_id,$receive_trans_id,$from,$to){
	$data = $this->db->query("SELECT SUM(dd.deduct_balance) AS total_deduct,lf.description FROM tbl_deduction_data dd JOIN tbl_loan_fee lf ON lf.fee_id = dd.fee_id WHERE dd.date_deduct between '$from' and '$to' AND  dd.comp_id = '$comp_id' AND dd.trans_id = '$receive_trans_id' GROUP BY dd.fee_id");
	return $data->result();
}


public function get_nondeducted_income_account($blanch_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(r.receve_amount) AS total_nondeducted,i.inc_name  FROM tbl_receve r LEFT JOIN tbl_income i ON i.inc_id = r.inc_id WHERE r.blanch_id = '$blanch_id' AND r.receve_day = '$date' AND r.trans_id = '$receive_trans_id' GROUP BY r.inc_id");
	return $data->result();
}

public function get_nondeducted_income_account_company($comp_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(r.receve_amount) AS total_nondeducted,i.inc_name  FROM tbl_receve r LEFT JOIN tbl_income i ON i.inc_id = r.inc_id WHERE r.comp_id = '$comp_id' AND r.receve_day = '$date' AND r.trans_id = '$receive_trans_id' GROUP BY r.inc_id");
	return $data->result();
}

public function get_nondeducted_income_account_prev($blanch_id,$receive_trans_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(r.receve_amount) AS total_nondeducted,i.inc_name  FROM tbl_receve r LEFT JOIN tbl_income i ON i.inc_id = r.inc_id WHERE r.receve_day between '$from' and '$to' AND  r.blanch_id = '$blanch_id' AND r.trans_id = '$receive_trans_id' GROUP BY r.inc_id");
	return $data->result();
}

public function get_nondeducted_income_account_prev_company($comp_id,$receive_trans_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(r.receve_amount) AS total_nondeducted,i.inc_name  FROM tbl_receve r LEFT JOIN tbl_income i ON i.inc_id = r.inc_id WHERE r.receve_day between '$from' and '$to' AND  r.comp_id = '$comp_id' AND r.trans_id = '$receive_trans_id' GROUP BY r.inc_id");
	return $data->result();
}


public function get_today_prepaid($blanch_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(prepaid_amount) AS total_prepaid,trans_id FROM tbl_prepaid WHERE blanch_id  = '$blanch_id' AND trans_id = '$receive_trans_id' AND prepaid_date = '$date'");
	return $data->result();
}

public function get_today_prepaid_comp($comp_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(prepaid_amount) AS total_prepaid,trans_id FROM tbl_prepaid WHERE comp_id  = '$comp_id' AND trans_id = '$receive_trans_id' AND prepaid_date = '$date'");
	return $data->result();
}

public function get_today_prepaid_prev($blanch_id,$receive_trans_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(prepaid_amount) AS total_prepaid,trans_id FROM tbl_prepaid WHERE prepaid_date between '$from' and '$to' AND blanch_id  = '$blanch_id' AND trans_id = '$receive_trans_id'");
	return $data->result();
}

public function get_today_prepaid_prev_company($comp_id,$receive_trans_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(prepaid_amount) AS total_prepaid,trans_id FROM tbl_prepaid WHERE prepaid_date between '$from' and '$to' AND comp_id  = '$comp_id' AND trans_id = '$receive_trans_id'");
	return $data->result();
}


public function get_out_deposit_today($blanch_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_deposit_out FROM tbl_depost WHERE blanch_id = '$blanch_id' AND dep_status = 'out' AND date(deposit_day) = '$date' AND depost_method = '$receive_trans_id'");
	return $data->result();
}

public function get_out_deposit_today_company($comp_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_deposit_out FROM tbl_depost WHERE comp_id = '$comp_id' AND dep_status = 'out' AND date(deposit_day) = '$date' AND depost_method = '$receive_trans_id'");
	return $data->result();
}


public function get_out_deposit_today_prev($blanch_id,$receive_trans_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_deposit_out FROM tbl_depost WHERE date(deposit_day) between '$from' and '$to' AND  blanch_id = '$blanch_id' AND dep_status = 'out' AND depost_method = '$receive_trans_id'");
	return $data->result();
}

public function get_out_deposit_today_prev_company($comp_id,$receive_trans_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_deposit_out FROM tbl_depost WHERE date(deposit_day) between '$from' and '$to' AND  comp_id = '$comp_id' AND dep_status = 'out' AND depost_method = '$receive_trans_id'");
	return $data->result();
}


public function get_daily_deposit($blanch_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_dailyDeposit FROM tbl_depost WHERE blanch_id = '$blanch_id' AND depost_method = '$receive_trans_id' AND dep_status = 'withdrawal' AND date(deposit_day) = '$date' AND day_id = '1'");
	return $data->result();
}

public function get_daily_deposit_company($comp_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_dailyDeposit FROM tbl_depost WHERE comp_id = '$comp_id' AND depost_method = '$receive_trans_id' AND dep_status = 'withdrawal' AND date(deposit_day) = '$date' AND day_id = '1'");
	return $data->result();
}

public function get_daily_deposit_prev($blanch_id,$receive_trans_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_dailyDeposit FROM tbl_depost WHERE date(deposit_day) between '$from' and '$to' AND blanch_id = '$blanch_id' AND depost_method = '$receive_trans_id' AND dep_status = 'withdrawal' AND day_id = '1'");
	return $data->result();
}

public function get_daily_deposit_prev_company($comp_id,$receive_trans_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_dailyDeposit FROM tbl_depost WHERE date(deposit_day) between '$from' and '$to' AND comp_id = '$comp_id' AND depost_method = '$receive_trans_id' AND dep_status = 'withdrawal' AND day_id = '1'");
	return $data->result();
}

public function get_weekly_deposit($blanch_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_weekly_deposit FROM tbl_depost WHERE blanch_id = '$blanch_id' AND depost_method = '$receive_trans_id' AND dep_status = 'withdrawal' AND date(deposit_day) = '$date' AND day_id = '7'");
	return $data->result();
}

public function get_weekly_deposit_comp($comp_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_weekly_deposit FROM tbl_depost WHERE comp_id = '$comp_id' AND depost_method = '$receive_trans_id' AND dep_status = 'withdrawal' AND date(deposit_day) = '$date' AND day_id = '7'");
	return $data->result();
}

public function get_weekly_deposit_prev($blanch_id,$receive_trans_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_weekly_deposit FROM tbl_depost WHERE date(deposit_day) between '$from' and '$to' AND blanch_id = '$blanch_id' AND depost_method = '$receive_trans_id' AND dep_status = 'withdrawal' AND day_id = '7'");
	return $data->result();
}

public function get_weekly_deposit_prev_company($comp_id,$receive_trans_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_weekly_deposit FROM tbl_depost WHERE date(deposit_day) between '$from' and '$to' AND comp_id = '$comp_id' AND depost_method = '$receive_trans_id' AND dep_status = 'withdrawal' AND day_id = '7'");
	return $data->result();
}

public function get_monthly_deposit($blanch_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_monthly_deposit FROM tbl_depost WHERE blanch_id = '$blanch_id' AND depost_method = '$receive_trans_id' AND dep_status = 'withdrawal' AND date(deposit_day) = '$date' AND day_id = '30'");
	return $data->result();
}

public function get_monthly_deposit_company($comp_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_monthly_deposit FROM tbl_depost WHERE comp_id = '$comp_id' AND depost_method = '$receive_trans_id' AND dep_status = 'withdrawal' AND date(deposit_day) = '$date' AND day_id = '30'");
	return $data->result();
}

public function get_monthly_deposit_prev($blanch_id,$receive_trans_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_monthly_deposit FROM tbl_depost WHERE date(deposit_day) between '$from' and '$to' AND blanch_id = '$blanch_id' AND depost_method = '$receive_trans_id' AND dep_status = 'withdrawal' AND day_id = '30'");
	return $data->result();
}

public function get_monthly_deposit_prev_company($comp_id,$receive_trans_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_monthly_deposit FROM tbl_depost WHERE date(deposit_day) between '$from' and '$to' AND comp_id = '$comp_id' AND depost_method = '$receive_trans_id' AND dep_status = 'withdrawal' AND day_id = '30'");
	return $data->result();
}

public function get_system_loan_return($blanch_id,$receive_trans_id){
 $date = date("Y-m-d");
 $data = $this->db->query("SELECT SUM(withdrow) AS total_loan_pending FROM tbl_pay WHERE blanch_id = '$blanch_id' AND p_method = '$receive_trans_id' AND description = 'SYSTEM / PENDING LOAN RETURN' AND date_data = '$date'");
 return $data->result();	
}

public function get_system_loan_return_company($comp_id,$receive_trans_id){
 $date = date("Y-m-d");
 $data = $this->db->query("SELECT SUM(withdrow) AS total_loan_pending FROM tbl_pay WHERE comp_id = '$comp_id' AND p_method = '$receive_trans_id' AND description = 'SYSTEM / PENDING LOAN RETURN' AND date_data = '$date'");
 return $data->result();	
}

public function get_system_loan_return_prev($blanch_id,$receive_trans_id,$from,$to){
 $date = date("Y-m-d");
 $data = $this->db->query("SELECT SUM(withdrow) AS total_loan_pending FROM tbl_pay WHERE date_data between '$from' and '$to' AND blanch_id = '$blanch_id' AND p_method = '$receive_trans_id' AND description = 'SYSTEM / PENDING LOAN RETURN'");
 return $data->result();	
}

public function get_system_loan_return_prev_company($comp_id,$receive_trans_id,$from,$to){
 $date = date("Y-m-d");
 $data = $this->db->query("SELECT SUM(withdrow) AS total_loan_pending FROM tbl_pay WHERE date_data between '$from' and '$to' AND comp_id = '$comp_id' AND p_method = '$receive_trans_id' AND description = 'SYSTEM / PENDING LOAN RETURN'");
 return $data->result();	
}



public function get_transaction_from_mainAccount($blanch_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(blanch_amount) AS total_blanch_transfor FROM tbl_transfor WHERE blanch_id = '$blanch_id' AND to_trans_id = '$receive_trans_id' AND trans_day = '$date'");
	return $data->result();
}

public function get_transaction_from_mainAccount_company($comp_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(blanch_amount) AS total_blanch_transfor FROM tbl_transfor WHERE comp_id = '$comp_id' AND to_trans_id = '$receive_trans_id' AND trans_day = '$date'");
	return $data->result();
}

public function get_transaction_from_mainAccount_prev($blanch_id,$receive_trans_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(blanch_amount) AS total_blanch_transfor FROM tbl_transfor WHERE trans_day between '$from' and '$to' AND blanch_id = '$blanch_id' AND to_trans_id = '$receive_trans_id'");
	return $data->result();
}

public function get_transaction_from_mainAccount_prev_company($comp_id,$receive_trans_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(blanch_amount) AS total_blanch_transfor FROM tbl_transfor WHERE trans_day between '$from' and '$to' AND comp_id = '$comp_id' AND to_trans_id = '$receive_trans_id'");
	return $data->result();
}


public function get_blanch_account_target_toblanch($to_branch,$to_account){
	$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$to_branch' AND receive_trans_id = '$to_account'");
	return $data->row();
}


public function get_transaction_from_blanch($blanch_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(to_amount) AS total_transfor FROM tbl_float_branch WHERE to_branch = '$blanch_id' AND to_branch_account = '$receive_trans_id' AND date_trans = '$date'");
	return $data->result();
}

public function get_transaction_from_company($comp_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(to_amount) AS total_transfor FROM tbl_float_branch WHERE comp_id = '$comp_id' AND to_branch_account = '$receive_trans_id' AND date_trans = '$date'");
	return $data->result();
}

public function get_transaction_from_blanch_prev($blanch_id,$receive_trans_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(to_amount) AS total_transfor FROM tbl_float_branch WHERE date_trans between '$from' and '$to' AND to_branch = '$blanch_id' AND to_branch_account = '$receive_trans_id'");
	return $data->result();
}

public function get_transaction_from_blanch_prev_company($comp_id,$receive_trans_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(to_amount) AS total_transfor FROM tbl_float_branch WHERE date_trans between '$from' and '$to' AND comp_id = '$comp_id' AND to_branch_account = '$receive_trans_id'");
	return $data->result();
}


public function get_loan_withdrawal_account($blanch_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loan_with FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE l.blanch_id = '$blanch_id' AND l.method = '$receive_trans_id' AND ot.loan_stat_date = '$date'");
	return $data->result();
}

public function get_loan_withdrawal_account_company($comp_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loan_with FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE l.comp_id = '$comp_id' AND l.method = '$receive_trans_id' AND ot.loan_stat_date = '$date'");
	return $data->result();
}

public function get_loan_renew($comp_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(rn.renew_amount) AS total_renew FROM tbl_renew rn  WHERE rn.comp_id = '$comp_id' AND rn.method_renew = '$receive_trans_id' AND rn.date_renew = '$date' AND rn.status_renew = 'close'");
	return $data->result();
}

public function get_loan_renew_blanch($blanch_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(rn.renew_amount) AS total_renew FROM tbl_renew rn  WHERE rn.blanch_id = '$blanch_id' AND rn.method_renew = '$receive_trans_id' AND rn.date_renew = '$date' AND rn.status_renew = 'close'");
	return $data->result();
}

public function get_loan_withdrawal_account_prev($blanch_id,$receive_trans_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loan_with FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE ot.loan_stat_date between '$from' and '$to' AND l.blanch_id = '$blanch_id' AND l.method = '$receive_trans_id'");
	return $data->result();
}

public function get_loan_renew_prev($blanch_id,$receive_trans_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(rn.renew_amount) AS total_renew FROM tbl_renew rn  WHERE rn.date_renew between '$from' and '$to' AND rn.blanch_id = '$blanch_id' AND rn.method_renew = '$receive_trans_id' AND rn.status_renew = 'close'");
	return $data->result();
}

public function get_loan_renew_prev_comp($comp_id,$receive_trans_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(rn.renew_amount) AS total_renew FROM tbl_renew rn  WHERE rn.date_renew between '$from' and '$to' AND rn.comp_id = '$comp_id' AND rn.method_renew = '$receive_trans_id' AND rn.status_renew = 'close'");
	return $data->result();
}

public function get_loan_withdrawal_account_prev_company($comp_id,$receive_trans_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loan_with FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE ot.loan_stat_date between '$from' and '$to' AND l.comp_id = '$comp_id' AND l.method = '$receive_trans_id'");
	return $data->result();
}


public function get_expenses_datas($blanch_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(re.req_amount) AS total_expenses,ex.ex_name FROM tbl_request_exp re LEFT JOIN tbl_expenses ex ON ex.ex_id = re.ex_id WHERE re.blanch_id = '$blanch_id' AND re.trans_id = '$receive_trans_id' AND re.req_date = '$date' GROUP BY re.ex_id");
	return $data->result();
}

public function get_expenses_datas_company($comp_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(re.req_amount) AS total_expenses,ex.ex_name FROM tbl_request_exp re LEFT JOIN tbl_expenses ex ON ex.ex_id = re.ex_id WHERE re.comp_id = '$comp_id' AND re.trans_id = '$receive_trans_id' AND re.req_date = '$date' GROUP BY re.ex_id");
	return $data->result();
}

public function get_expenses_datas_prev($blanch_id,$receive_trans_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(re.req_amount) AS total_expenses,ex.ex_name FROM tbl_request_exp re LEFT JOIN tbl_expenses ex ON ex.ex_id = re.ex_id WHERE re.req_date between '$from' and '$to' AND re.blanch_id = '$blanch_id' AND re.trans_id = '$receive_trans_id' GROUP BY re.ex_id");
	return $data->result();
}

public function get_expenses_datas_prev_company($comp_id,$receive_trans_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(re.req_amount) AS total_expenses,ex.ex_name FROM tbl_request_exp re LEFT JOIN tbl_expenses ex ON ex.ex_id = re.ex_id WHERE re.req_date between '$from' and '$to' AND re.comp_id = '$comp_id' AND re.trans_id = '$receive_trans_id' GROUP BY re.ex_id");
	return $data->result();
}


public function get_transaction_day_toBlanch($blanch_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(from_amount) AS total_transaction FROM tbl_float_branch WHERE from_blanch = '$blanch_id' AND from_blanch_account = '$receive_trans_id' AND date_trans = '$date'");
	return $data->result();
}

public function get_transaction_day_company($comp_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(from_amount) AS total_transaction FROM tbl_float_branch WHERE comp_id = '$comp_id' AND from_blanch_account = '$receive_trans_id' AND date_trans = '$date'");
	return $data->result();
}


public function get_transaction_day_toBlanch_prev($blanch_id,$receive_trans_id,$from,$to){
	$data = $this->db->query("SELECT SUM(from_amount) AS total_transaction FROM tbl_float_branch WHERE date_trans between '$from' and '$to' AND from_blanch = '$blanch_id' AND from_blanch_account = '$receive_trans_id'");
	return $data->result();
}

public function get_transaction_day_toBlanch_prev_company($comp_id,$receive_trans_id,$from,$to){
	$data = $this->db->query("SELECT SUM(from_amount) AS total_transaction FROM tbl_float_branch WHERE date_trans between '$from' and '$to' AND comp_id = '$comp_id' AND from_blanch_account = '$receive_trans_id'");
	return $data->result();
}

public function get_loan_deposit_data($loan_id){
	$data = $this->db->query("SELECT SUM(depost) AS total_deposit FROM tbl_depost WHERE loan_id = '$loan_id'");
	return $data->row();
}

public function get_double_amount($blanch_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(double_amount) AS total_double FROM tbl_double WHERE blanch_id = '$blanch_id' AND trans_id = '$receive_trans_id' AND double_date = '$date'");
	return $data->result();
}

public function get_double_amount_company($comp_id,$receive_trans_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(double_amount) AS total_double FROM tbl_double WHERE comp_id = '$comp_id' AND trans_id = '$receive_trans_id' AND double_date = '$date'");
	return $data->result();
}

public function get_double_amount_prev($blanch_id,$receive_trans_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(double_amount) AS total_double FROM tbl_double WHERE double_date between '$from' and '$to' AND blanch_id = '$blanch_id' AND trans_id = '$receive_trans_id'");
	return $data->result();
}

public function get_double_amount_prev_company($comp_id,$receive_trans_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(double_amount) AS total_double FROM tbl_double WHERE double_date between '$from' and '$to' AND comp_id = '$comp_id' AND trans_id = '$receive_trans_id'");
	return $data->result();
}


public function get_yesterday_data_blanch($blanch_id){
	$date = date("Y-m-d");
  $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
	$data = $this->db->query("SELECT SUM(cash_amount) AS total_opening_yesterday FROM tbl_cash_inhand WHERE blanch_id = '$blanch_id' AND cash_day = '$back'");
	return $data->row();
}

public function get_yesterday_data_company($comp_id){
	$date = date("Y-m-d");
  $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
	$data = $this->db->query("SELECT SUM(cash_amount) AS total_opening_yesterday FROM tbl_cash_inhand WHERE comp_id = '$comp_id' AND cash_day = '$back' LIMIT 1");
	return $data->row();
}

public function get_today_income_data_blanch($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(dd.deduct_balance) AS total_deduct_blanch,lf.description FROM tbl_deduction_data dd JOIN tbl_loan_fee lf ON lf.fee_id = dd.fee_id WHERE dd.blanch_id = '$blanch_id'  AND dd.date_deduct = '$date'");
	return $data->row();
}

public function get_today_income_data_company($comp_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(dd.deduct_balance) AS total_deduct_blanch,lf.description FROM tbl_deduction_data dd JOIN tbl_loan_fee lf ON lf.fee_id = dd.fee_id WHERE dd.comp_id = '$comp_id'  AND dd.date_deduct = '$date'");
	return $data->row();
}

public function get_today_income_data_blanch_prev($blanch_id,$from,$to){;
	$data = $this->db->query("SELECT SUM(dd.deduct_balance) AS total_deduct_blanch,lf.description FROM tbl_deduction_data dd JOIN tbl_loan_fee lf ON lf.fee_id = dd.fee_id WHERE dd.date_deduct between '$from' and '$to' AND dd.blanch_id = '$blanch_id'");
	return $data->row();
}

public function get_today_income_data_blanch_prev_company($comp_id,$from,$to){;
	$data = $this->db->query("SELECT SUM(dd.deduct_balance) AS total_deduct_blanch,lf.description FROM tbl_deduction_data dd JOIN tbl_loan_fee lf ON lf.fee_id = dd.fee_id WHERE dd.date_deduct between '$from' and '$to' AND dd.comp_id = '$comp_id'");
	return $data->row();
}




public function get_nondeducted_income_account_blanch($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(r.receve_amount) AS total_non,i.inc_name  FROM tbl_receve r LEFT JOIN tbl_income i ON i.inc_id = r.inc_id WHERE r.blanch_id = '$blanch_id' AND r.receve_day = '$date'");
	return $data->row();
}

public function get_nondeducted_income_account_company_data($comp_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(r.receve_amount) AS total_non,i.inc_name  FROM tbl_receve r LEFT JOIN tbl_income i ON i.inc_id = r.inc_id WHERE r.comp_id = '$comp_id' AND r.receve_day = '$date'");
	return $data->row();
}

public function get_nondeducted_income_account_blanch_prev($blanch_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(r.receve_amount) AS total_non,i.inc_name  FROM tbl_receve r LEFT JOIN tbl_income i ON i.inc_id = r.inc_id WHERE r.receve_day between '$from' and '$to' AND r.blanch_id = '$blanch_id'");
	return $data->row();
}

public function get_nondeducted_income_account_blanch_prevCompany($comp_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(r.receve_amount) AS total_non,i.inc_name  FROM tbl_receve r LEFT JOIN tbl_income i ON i.inc_id = r.inc_id WHERE r.receve_day between '$from' and '$to' AND r.comp_id = '$comp_id'");
	return $data->row();
}

public function get_expenses_datas_blanch($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(re.req_amount) AS total_expenses_blanch,ex.ex_name FROM tbl_request_exp re LEFT JOIN tbl_expenses ex ON ex.ex_id = re.ex_id WHERE re.blanch_id = '$blanch_id' AND re.req_date = '$date'");
	return $data->row();
}

public function get_expenses_datas_companys($comp_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(re.req_amount) AS total_expenses_blanch,ex.ex_name FROM tbl_request_exp re LEFT JOIN tbl_expenses ex ON ex.ex_id = re.ex_id WHERE re.comp_id = '$comp_id' AND re.req_date = '$date' GROUP BY re.ex_id");
	return $data->row();
}

public function get_expenses_datas_companys_blanch($comp_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(re.req_amount) AS total_expenses_blanch,ex.ex_name FROM tbl_request_exp re LEFT JOIN tbl_expenses ex ON ex.ex_id = re.ex_id WHERE re.comp_id = '$comp_id' AND re.req_date = '$date'");
	return $data->row();
}


public function get_expenses_datas_blanch_prev($blanch_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(re.req_amount) AS total_expenses_blanch,ex.ex_name FROM tbl_request_exp re LEFT JOIN tbl_expenses ex ON ex.ex_id = re.ex_id WHERE re.req_date between '$from' and '$to' AND  re.blanch_id = '$blanch_id'");
	return $data->row();
}

public function get_expenses_datas_blanch_prev_company($comp_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(re.req_amount) AS total_expenses_blanch,ex.ex_name FROM tbl_request_exp re LEFT JOIN tbl_expenses ex ON ex.ex_id = re.ex_id WHERE re.req_date between '$from' and '$to' AND  re.comp_id = '$comp_id'");
	return $data->row();
}


public function get_today_data_close_blanch($blanch_id){
	$date = date("Y-m-d");
  //$back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
	$data = $this->db->query("SELECT SUM(cash_amount) AS close_day_blanch FROM tbl_cash_inhand WHERE blanch_id = '$blanch_id' AND cash_day = '$date'");
	return $data->row();
}

public function get_today_data_close_companys($comp_id){
	$date = date("Y-m-d");
  //$back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
	$data = $this->db->query("SELECT SUM(cash_amount) AS close_day_blanch FROM tbl_cash_inhand WHERE comp_id = '$comp_id' AND cash_day = '$date' LIMIT 1");
	return $data->row();
}


public function get_today_deposit_data($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_depost,SUM(double_amont) AS total_double FROM tbl_depost WHERE blanch_id = '$blanch_id' AND date(deposit_day) = '$date'");
	return $data->row();
}

public function get_today_deposit_data_company($comp_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_depost,SUM(double_amont) AS total_double FROM tbl_depost WHERE comp_id = '$comp_id' AND date(deposit_day) = '$date' LIMIT 1");
	return $data->row();
}


public function get_total_expenses_loan_today($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loan_with FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE l.blanch_id = '$blanch_id' AND l.loan_status = 'withdrawal' AND ot.loan_stat_date = '$date'");
	return $data->row();
}

public function get_total_expenses_loan_today_company($comp_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loan_with FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE l.comp_id = '$comp_id' AND l.loan_status = 'withdrawal' AND ot.loan_stat_date = '$date'LIMIT 1");
	return $data->row();
}


public function get_total_expenses_loan_prev($blanch_id,$from,$to){
	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loan_with FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE ot.loan_stat_date between '$from' and '$to' AND l.blanch_id = '$blanch_id'");
	return $data->row();
}

public function get_total_expenses_loan_prevCompany($comp_id,$from,$to){
	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loan_with FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE ot.loan_stat_date between '$from' and '$to' AND l.comp_id = '$comp_id'");
	return $data->row();
}

public function get_transfor_float_blanch($blanch_id){
	$data = $this->db->query("SELECT fb.id,fb.from_amount,fb.to_amount,atfrom.account_name AS from_account,atto.account_name AS to_account,bfrom.blanch_name AS from_blanch,bto.blanch_name AS toBlanch,fb.charger_fee,fb.date_trans FROM tbl_float_branch fb LEFT JOIN tbl_account_transaction atfrom ON atfrom.trans_id = fb.from_blanch_account LEFT JOIN tbl_account_transaction atto ON atto.trans_id = fb.to_branch_account LEFT JOIN tbl_blanch bfrom ON bfrom.blanch_id = fb.from_blanch LEFT JOIN tbl_blanch bto ON bto.blanch_id = fb.to_branch WHERE fb.from_blanch = '$blanch_id' ORDER BY fb.id DESC");
	return $data->result();
}

public function get_total_transaction_total($blanch_id){
	$data = $this->db->query("SELECT SUM(from_amount) AS total_amount_trans,SUM(charger_fee) AS total_fee FROM  tbl_float_branch WHERE from_blanch = '$blanch_id'");
	return $data->row();
}

public function get_transactrion_blanch_blanch($id){
	$data = $this->db->query("SELECT * FROM  tbl_float_branch WHERE id = '$id'");
	return $data->row();
}



public function get_receive_float_blanch($blanch_id){
	$data = $this->db->query("SELECT fb.id,fb.from_amount,fb.to_amount,atfrom.account_name AS from_account,atto.account_name AS to_account,bfrom.blanch_name AS from_blanch,bto.blanch_name AS toBlanch,fb.charger_fee,fb.date_trans FROM tbl_float_branch fb LEFT JOIN tbl_account_transaction atfrom ON atfrom.trans_id = fb.from_blanch_account LEFT JOIN tbl_account_transaction atto ON atto.trans_id = fb.to_branch_account LEFT JOIN tbl_blanch bfrom ON bfrom.blanch_id = fb.from_blanch LEFT JOIN tbl_blanch bto ON bto.blanch_id = fb.to_branch WHERE fb.to_branch = '$blanch_id' ORDER BY fb.id DESC");
	return $data->result();
}

public function get_total_receive_total($blanch_id){
	$data = $this->db->query("SELECT SUM(to_amount) AS total_amount_receive FROM  tbl_float_branch WHERE to_branch = '$blanch_id'");
	return $data->row();
}

public function get_transaction_float($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(from_amount) AS total_transaction_float FROM tbl_float_branch WHERE from_blanch = '$blanch_id' AND date_trans = '$date'");
	return $data->row();
}


public function get_transaction_float_company($comp_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(from_amount) AS total_transaction_float FROM tbl_float_branch WHERE comp_id = '$comp_id' AND date_trans = '$date'");
	return $data->row();
}

public function get_transaction_float_prev($blanch_id,$from,$to){
	$data = $this->db->query("SELECT SUM(from_amount) AS total_transaction_float FROM tbl_float_branch WHERE date_trans between '$from' and '$to' AND from_blanch = '$blanch_id'");
	return $data->row();
}

public function get_transaction_float_prev_company($comp_id,$from,$to){
	$data = $this->db->query("SELECT SUM(from_amount) AS total_transaction_float FROM tbl_float_branch WHERE date_trans between '$from' and '$to' AND comp_id = '$comp_id'");
	return $data->row();
}



public function get_income_deposit($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_all_deposit,SUM(double_amont) AS total_double_loan FROM tbl_depost WHERE blanch_id = '$blanch_id' AND date(deposit_day) = '$date'");
	return $data->row();
}

public function get_income_deposit_company($comp_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_all_deposit,SUM(double_amont) AS total_double_loan FROM tbl_depost WHERE comp_id = '$comp_id' AND date(deposit_day) = '$date'");
	return $data->row();
}

public function get_income_deposit_prev($blanch_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_all_deposit,SUM(double_amont) AS total_double_loan FROM tbl_depost WHERE date(deposit_day) between '$from' and '$to' AND  blanch_id = '$blanch_id'");
	return $data->row();
}

public function get_income_deposit_prev_company($comp_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_all_deposit,SUM(double_amont) AS total_double_loan FROM tbl_depost WHERE date(deposit_day) between '$from' and '$to' AND  comp_id = '$comp_id'");
	return $data->row();
}


public function get_transaction_from_mainAccountTotal($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(blanch_amount) AS total_blanch_main FROM tbl_transfor WHERE blanch_id = '$blanch_id' AND trans_day = '$date'");
	return $data->row();
}

public function get_transaction_from_mainAccountTotal_company($comp_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(blanch_amount) AS total_blanch_main FROM tbl_transfor WHERE comp_id = '$comp_id' AND trans_day = '$date'");
	return $data->row();
}

public function get_transaction_from_mainAccountTotal_prev($blanch_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(blanch_amount) AS total_blanch_main FROM tbl_transfor WHERE trans_day between '$from' and '$to' AND blanch_id = '$blanch_id'");
	return $data->row();
}

public function get_transaction_from_mainAccountTotal_prev_company($comp_id,$from,$to){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(blanch_amount) AS total_blanch_main FROM tbl_transfor WHERE trans_day between '$from' and '$to' AND comp_id = '$comp_id'");
	return $data->row();
}


public function get_transaction_totalfrom_blanch($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(to_amount) AS total_transfor_total FROM tbl_float_branch WHERE to_branch = '$blanch_id' AND date_trans = '$date'");
	return $data->row();
}

public function get_transaction_totalfrom_company($comp_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(to_amount) AS total_transfor_total FROM tbl_float_branch WHERE comp_id = '$comp_id' AND date_trans = '$date'");
	return $data->row();
}

public function get_transaction_totalfrom_blanch_prev($blanch_id,$from,$to){
	$data = $this->db->query("SELECT SUM(to_amount) AS total_transfor_total FROM tbl_float_branch WHERE date_trans between '$from' and '$to' AND to_branch = '$blanch_id'");
	return $data->row();
}

public function get_transaction_totalfrom_blanch_prev_company($comp_id,$from,$to){
	$data = $this->db->query("SELECT SUM(to_amount) AS total_transfor_total FROM tbl_float_branch WHERE date_trans between '$from' and '$to' AND comp_id = '$comp_id'");
	return $data->row();
}



public function get_company_transaction($transfor_id)
{
	$data = $this->db->query("SELECT * FROM tbl_transfor WHERE trans_id = '$transfor_id'");
	return $data->row();
}

public function get_comp_balance_account($comp_id,$from_account){
	$data = $this->db->query("SELECT * FROM tbl_ac_company WHERE comp_id = '$comp_id' AND trans_id = '$from_account'");
	return $data->row();
}


public function get_employee_privillage($empl_id){
	$data = $this->db->query("SELECT * FROM tbl_privellage p WHERE empl_id = '$empl_id'");
	return $data->result();
}

function fetch_loan_active($customer_id)
 {
  $this->db->where('customer_id', $customer_id);
  $this->db->order_by('loan_code', 'DESC');
  $query = $this->db->query("SELECT * FROM tbl_loans WHERE customer_id = '$customer_id' ORDER BY loan_id DESC LIMIT 1");
  $query->row();
  $output = '<input value="'.$query->row()->loan_id.'" name="loan_id">';
  // foreach($query->result() as $row)
  // {
  //  //$output .= '<input value="'.$row->loan_id.'">';
   
  // }
  return $output;
 }

 function fetch_loan_active_day($customer_id)
 {
  $this->db->where('customer_id', $customer_id);
  $this->db->order_by('loan_code', 'DESC');
  $query = $this->db->query("SELECT * FROM tbl_loans WHERE customer_id = '$customer_id' ORDER BY loan_id DESC LIMIT 1");
  $query->row();
  $output = '<input value="'.$query->row()->day.'" name="day_id">';
  // foreach($query->result() as $row)
  // {
  //  //$output .= '<input value="'.$row->loan_id.'">';
   
  // }
  return $output;
 }


 public function get_blanch_saving_deposit($blanch_id,$receive_trans_id){
 	$data = $this->db->query("SELECT SUM(amount) AS total_saving FROM tbl_miamala WHERE blanch_id = '$blanch_id' AND provider = '$receive_trans_id' AND status = 'open'");
 	return $data->result();
 }


 public function get_company_saving_deposit($comp_id,$receive_trans_id){
 	$data = $this->db->query("SELECT SUM(amount) AS total_saving FROM tbl_miamala WHERE comp_id = '$comp_id' AND provider = '$receive_trans_id' AND status = 'open'");
 	return $data->result();
 }


public function get_out_deposit_blanch($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_deposit_out FROM tbl_depost WHERE blanch_id = '$blanch_id' AND dep_status = 'out' AND date(deposit_day) = '$date'");
	return $data->row();
}

public function get_in_deposit_blanch($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_deposit_in,SUM(double_amont) AS total_deouble FROM tbl_depost WHERE blanch_id = '$blanch_id' AND date(deposit_day) = '$date'");
	return $data->row();
}


public function get_today_expenses_datablanch($blanch_id){
	$date = date("Y-m-d");
	$exp = $this->db->query("SELECT SUM(req_amount) AS total_request FROM tbl_request_exp WHERE blanch_id = '$blanch_id' AND req_date = '$date'");
	  return $exp->row();
}


public function get_expected_receivable_comp($from,$to,$comp_id){
$data = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id WHERE l.date_show between '$from' and '$to' AND l.comp_id = '$comp_id' AND l.loan_status = 'withdrawal'");
return $data->result();
}

public function get_expected_receivable_sum_comp($from,$to,$comp_id){
$data = $this->db->query("SELECT SUM(l.restration) AS total_expectation FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id WHERE l.date_show between '$from' and '$to' AND l.comp_id = '$comp_id' AND l.loan_status = 'withdrawal'");
return $data->row();
}

public function get_expected_receivable($from,$to,$blanch_id){
$data = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id WHERE  l.date_show between '$from' and '$to' AND l.blanch_id = '$blanch_id' AND l.loan_status = 'withdrawal'");
return $data->result();
}

public function get_expected_receivable_sum($from,$to,$blanch_id){
$data = $this->db->query("SELECT SUM(l.restration) AS total_expectation FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id WHERE l.date_show between '$from' and '$to' AND l.blanch_id = '$blanch_id' AND l.loan_status = 'withdrawal'");
return $data->row();
}

public function get_loan_data_loan($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c  ON c.customer_id = l.customer_id WHERE l.loan_id = '$loan_id'");
	return $data->row();
}


public function get_loan_deposit_total($loan_id){
	$data = $this->db->query("SELECT SUM(depost) AS total_deposit FROM tbl_depost WHERE loan_id = '$loan_id'");
	return $data->row();
}

public function insert_loan_renew($data){
	return $this->db->insert('tbl_renew',$data);
}

public function get_renew_loan_request($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_renew rn LEFT JOIN tbl_loans l ON l.loan_id = rn.loan_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lc ON lc.category_id = l.category_id  WHERE rn.loan_id = '$loan_id'");
	return $data->result();
}

public function update_renew_loan($data,$renew_id){
	return $this->db->where('renew_id',$renew_id)->update('tbl_renew',$data);
}

public function get_renew_data_loan($renew_id){
	$data = $this->db->query("SELECT * FROM tbl_renew WHERE renew_id = '$renew_id'");
	return $data->row();
}

public function remove_renew($renew_id){
	return $this->db->delete('tbl_renew',['renew_id'=>$renew_id]);
}


public function get_all_renew_loan($comp_id){
$data = $this->db->query("SELECT rn.renew_id,rn.comp_id,rn.blanch_id,rn.loan_id,b.blanch_name,c.f_name,c.m_name,c.l_name,l.loan_int,rn.renew_amount,lc.interest_formular,rn.status_renew,rn.date_renew FROM tbl_renew rn LEFT JOIN tbl_loans l ON l.loan_id = rn.loan_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lc ON lc.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = rn.blanch_id  WHERE rn.comp_id = '$comp_id' AND rn.status_renew = 'open'");
foreach ($data->result() as $r) {
	$r->total_deposit = $this->get_total_deposit_renew($r->loan_id);
}
	return $data->result();	
}


public function get_total_deposit_renew($loan_id){
		$deposit = $this->db->query("SELECT SUM(depost) AS total_deposit FROM tbl_depost d WHERE d.loan_id = '$loan_id' GROUP BY loan_id");
		if ($deposit->row()) {
			return $deposit->row()->total_deposit; 
		}
		return 0; 
		  }


 public function get_loan_data_renew($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_loan_category lc ON lc.category_id = l.category_id WHERE l.loan_id = '$loan_id'");
	return $data->row();
}


public function get_pay_renew_loan($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_pay WHERE loan_id = '$loan_id' ORDER BY pay_id  DESC");
	return $data->row();
}

public function get_all_renew_loan_aprove($comp_id){
	$date = date("Y-m-d");
$data = $this->db->query("SELECT rn.renew_id,rn.comp_id,rn.blanch_id,rn.loan_id,b.blanch_name,c.f_name,c.m_name,c.l_name,l.loan_int,rn.renew_amount,lc.interest_formular,rn.status_renew,rn.date_renew FROM tbl_renew rn LEFT JOIN tbl_loans l ON l.loan_id = rn.loan_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lc ON lc.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = rn.blanch_id  WHERE rn.comp_id = '$comp_id' AND rn.status_renew = 'close' AND rn.date_renew = '$date'");
foreach ($data->result() as $r) {
	$r->total_deposit = $this->get_total_deposit_renew($r->loan_id);
}
	return $data->result();	
}


public function get_total_renew_loan($comp_id)
{
	$date = date("Y-m-d");
  $data = $this->db->query("SELECT SUM(renew_amount) AS total_renew FROM tbl_renew WHERE comp_id = '$comp_id' AND status_renew = 'close' AND date_renew = '$date'");
  return $data->row();
}

public function get_prev_renew_loan($blanch_id,$from,$to){
$data = $this->db->query("SELECT rn.renew_id,rn.comp_id,rn.blanch_id,rn.loan_id,b.blanch_name,c.f_name,c.m_name,c.l_name,l.loan_int,rn.renew_amount,lc.interest_formular,rn.status_renew,rn.date_renew FROM tbl_renew rn LEFT JOIN tbl_loans l ON l.loan_id = rn.loan_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lc ON lc.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = rn.blanch_id  WHERE rn.date_renew between '$from' and '$to' AND rn.blanch_id = '$blanch_id' AND rn.status_renew = 'close'");
foreach ($data->result() as $r) {
	$r->total_deposit = $this->get_total_deposit_renew($r->loan_id);
}
	return $data->result();	
}


public function get_total_renew_loan_prev($blanch_id,$from,$to)
{
	$date = date("Y-m-d");
  $data = $this->db->query("SELECT SUM(renew_amount) AS total_renew FROM tbl_renew WHERE date_renew between '$from' and '$to' AND  blanch_id = '$blanch_id' AND status_renew = 'close'");
  return $data->row();
}

public function get_total_renew_loan_prev_comp($comp_id,$from,$to)
{
	$date = date("Y-m-d");
  $data = $this->db->query("SELECT SUM(renew_amount) AS total_renew FROM tbl_renew WHERE date_renew between '$from' and '$to' AND  comp_id = '$comp_id' AND status_renew = 'close'");
  return $data->row();
}

public function get_all_renew_loan_blanch($blanch_id){
$data = $this->db->query("SELECT rn.renew_id,rn.comp_id,rn.blanch_id,rn.loan_id,b.blanch_name,c.f_name,c.m_name,c.l_name,l.loan_int,rn.renew_amount,lc.interest_formular,rn.status_renew,rn.date_renew FROM tbl_renew rn LEFT JOIN tbl_loans l ON l.loan_id = rn.loan_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lc ON lc.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = rn.blanch_id  WHERE rn.blanch_id = '$blanch_id' AND rn.status_renew = 'open'");
foreach ($data->result() as $r) {
	$r->total_deposit = $this->get_total_deposit_renew($r->loan_id);
}
	return $data->result();	
}


public function get_all_renew_loan_aprove_blanch($blanch_id){
	$date = date("Y-m-d");
$data = $this->db->query("SELECT rn.renew_id,rn.comp_id,rn.blanch_id,rn.loan_id,b.blanch_name,c.f_name,c.m_name,c.l_name,l.loan_int,rn.renew_amount,lc.interest_formular,rn.status_renew,rn.date_renew FROM tbl_renew rn LEFT JOIN tbl_loans l ON l.loan_id = rn.loan_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lc ON lc.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = rn.blanch_id  WHERE rn.blanch_id = '$blanch_id' AND rn.status_renew = 'close' AND rn.date_renew = '$date'");
foreach ($data->result() as $r) {
	$r->total_deposit = $this->get_total_deposit_renew($r->loan_id);
}
	return $data->result();	
}


public function get_total_renew_loan_blanch($blanch_id)
{
	$date = date("Y-m-d");
  $data = $this->db->query("SELECT SUM(renew_amount) AS total_renew FROM tbl_renew WHERE blanch_id = '$blanch_id' AND status_renew = 'close' AND date_renew = '$date'");
  return $data->row();
}


 public function get_admin_priv($id){
  	$data = $this->db->query("SELECT * FROM tbl_admin_privillage WHERE id = '$id'");
  	return $data->row();
  }

   public function get_empl_priv($id){
  	$data = $this->db->query("SELECT * FROM tbl_empl_priv WHERE id = '$id'");
  	return $data->row();
  }

   public function delete_admin_privillage($id){
  	return $this->db->delete('tbl_admin_privillage',['id'=>$id]);
  }

  public function delete_empl_privillage($id){
  	return $this->db->delete('tbl_empl_priv',['id'=>$id]);
  }

  public function check_admin_privillage($priv,$empl_id,$comp_id){
		$data = $this->db->where(['privillage'=>$priv , 'empl_id'=>$empl_id , 'comp_id'=>$comp_id])
    	        ->get('tbl_admin_privillage');
    	  if ($data->num_rows() > 0) {
    	  	return $data->row();
    	  	
    	  }
       }

       public function check_employee_privillage($priv,$empl_id,$comp_id){
		$data = $this->db->where(['privillage'=>$priv , 'empl_id'=>$empl_id , 'comp_id'=>$comp_id])
    	        ->get('tbl_empl_priv');
    	  if ($data->num_rows() > 0) {
    	  	return $data->row();
    	  	
    	  }
       }

        

 public function get_admin_privillage($empl_id){
	$data = $this->db->query("SELECT * FROM tbl_admin_privillage WHERE empl_id = '$empl_id'");
	return $data->result();
}


 public function get_empl_privillage($empl_id){
	$data = $this->db->query("SELECT * FROM tbl_empl_priv WHERE empl_id = '$empl_id'");
	return $data->result();
}


public function get_groups($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_group g LEFT JOIN tbl_blanch b ON b.blanch_id = g.blanch_id WHERE g.comp_id = '$comp_id'");
	return $data->result();
}

public function get_groups_blanchs($blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_group g LEFT JOIN tbl_blanch b ON b.blanch_id = g.blanch_id WHERE g.blanch_id = '$blanch_id'");
	return $data->result();
}



public function delete_group($customer_id){
	return $this->db->delete('tbl_customer',['customer_id'=>$customer_id]);
}


public function update_group_data($group_id,$data){
	return $this->db->where('group_id',$group_id)->update('tbl_group',$data);
}

public function get_group_data($customer_id){
	$data = $this->db->query("SELECT * FROM tbl_customer WHERE customer_id = '$customer_id'");
	return $data->row();
}


public function insert_group_member($data){
	return $this->db->insert('tbl_member',$data);
}


public function get_memebers_group($customer_id){
	$data = $this->db->query("SELECT * FROM tbl_member WHERE customer_id = '$customer_id'");
	return $data->result();
}

public function update_group_member($data,$id){
	return $this->db->where('id',$id)->update('tbl_member',$data);
}

public function delete_members($id){
	return $this->db->delete('tbl_member',['id'=>$id]);
}


public function get_desc_pay_data($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_pay WHERE loan_id = '$loan_id'");
	return $data->row();
}

 public function fetch_today_deposit_daily_comp($comp_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(depost) AS total_deposit,SUM(double_amont) AS total_double FROM tbl_depost WHERE comp_id = '$comp_id' AND day_id = '1' AND depost_day = '$today'");
       	return $data->row();
       }


public function fetch_today_deposit_monthly_comp($comp_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(depost) AS total_deposit_monthly,SUM(double_amont) AS total_double_month FROM tbl_depost  WHERE comp_id = '$comp_id' AND day_id = '30'  AND depost_day = '$today'");
       	return $data->row();
       }

    public function fetch_today_deposit_comp($comp_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(depost) AS total_deposit_all,SUM(double_amont) AS total_double_all FROM tbl_depost WHERE comp_id = '$comp_id'  AND depost_day = '$today'");
       	return $data->row();
       }

         public function get_today_withdrawal_daily_comp($comp_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loanWith_day FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE l.comp_id = '$comp_id' AND loan_stat_date = '$today' AND l.day = '1'");
       	return $data->row();
       }

        public function get_today_withdrawal_weekly_comp($comp_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loanWith_weekly FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE l.comp_id = '$comp_id' AND loan_stat_date = '$today' AND l.day = '7'");
       	return $data->row();
       }

       public function get_today_withdrawal_monthly_comp($comp_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loanWith_monthly FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE l.comp_id = '$comp_id' AND loan_stat_date = '$today' AND l.day = '30'");
       	return $data->row();
       }

        public function get_today_withdrawal_all_comp($comp_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loanWith_all FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE l.comp_id = '$comp_id' AND loan_stat_date = '$today'");
       	return $data->row();
       }

       public function get_today_deducted_income_dahboard_comp($comp_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted FROM tbl_deducted_fee WHERE comp_id = '$comp_id' AND deducted_date = '$today'");
       	return $data->row();
       }

 public function get_today_nonDeducted_receive_comp($comp_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(receve_amount) AS total_non FROM tbl_receve WHERE comp_id = '$comp_id' AND receve_day = '$today'");
       	return $data->row();
       }

    public function get_today_expenses_blanch_data_comp($comp_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(req_amount) AS total_expenses FROM  tbl_request_exp WHERE comp_id = '$comp_id' AND req_date = '$today'");
       	return $data->row();
       }

       public function get_total_blanch_account($blanch_id){
       $data = $this->db->query("SELECT SUM(blanch_capital) AS total_blanch_amount FROM tbl_blanch_account WHERE blanch_id = '$blanch_id'");
       return $data->row();
       }


       public function get_blanch_account_name($blanch_id){
       	$data = $this->db->query("SELECT * FROM tbl_blanch_account ba JOIN tbl_account_transaction at ON at.trans_id = ba.receive_trans_id WHERE ba.blanch_id = '$blanch_id'");
       	return $data->result();
       }

       public function get_loan_with_drawal($blanch_id){
       	$data = $this->db->query("SELECT SUM(loan_aprove) AS toptal_loan_disbures, SUM(loan_int) AS total_loan_int FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'withdrawal'");
       	return $data->row();
       }

        public function get_default_loan($blanch_id){
       	$data = $this->db->query("SELECT SUM(remain_amount) AS total_default FROM  tbl_outstand_loan WHERE blanch_id = '$blanch_id'");
       	return $data->row();
       }

        public function fetch_today_deposit_daily($blanch_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(depost) AS total_deposit,SUM(double_amont) AS total_double  FROM tbl_depost WHERE blanch_id = '$blanch_id' AND day_id = '1' AND depost_day = '$today'");
       	return $data->row();
       }

       // public function fetch_today_deposit_daily_comp($comp_id){
       // 	$today = date("Y-m-d");
       // 	$data = $this->db->query("SELECT SUM(depost) AS total_deposit,SUM(double_amont) AS total_double FROM tbl_depost WHERE comp_id = '$comp_id' AND day_id = '1' AND depost_day = '$today'");
       // 	return $data->row();
       // }

        public function fetch_today_deposit_weekly($blanch_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(depost) AS total_deposit_weekly,SUM(double_amont) AS total_double_wekly FROM tbl_depost WHERE blanch_id = '$blanch_id' AND day_id = '7' AND depost_day = '$today'");
       	return $data->row();
       }

        public function fetch_today_deposit_weekly_comp($comp_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(depost) AS total_deposit_weekly,SUM(double_amont) AS total_double_wekly FROM tbl_depost WHERE comp_id = '$comp_id' AND day_id = '7' AND depost_day = '$today'");
       	return $data->row();
       }

        public function fetch_today_deposit_monthly($blanch_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(depost) AS total_deposit_monthly,SUM(double_amont) AS total_double_month FROM tbl_depost WHERE blanch_id = '$blanch_id' AND day_id = '30'  AND depost_day = '$today'");
       	return $data->row();
       }
   
     public function fetch_today_deposit($blanch_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(depost) AS total_deposit_all,SUM(double_amont) AS total_double_all FROM tbl_depost WHERE blanch_id = '$blanch_id'  AND depost_day = '$today'");
       	return $data->row();
       }


       public function get_today_withdrawal_daily($blanch_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loanWith_day FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE l.blanch_id = '$blanch_id' AND loan_stat_date = '$today' AND l.day = '1'");
       	return $data->row();
       }


         public function get_today_withdrawal_weekly($blanch_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loanWith_weekly FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE l.blanch_id = '$blanch_id' AND loan_stat_date = '$today' AND l.day = '7'");
       	return $data->row();
       }

        public function get_today_withdrawal_monthly($blanch_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loanWith_monthly FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE l.blanch_id = '$blanch_id' AND loan_stat_date = '$today' AND l.day = '30'");
       	return $data->row();
       }

        public function get_today_withdrawal_all($blanch_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loanWith_all FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE l.blanch_id = '$blanch_id' AND loan_stat_date = '$today'");
       	return $data->row();
       }

       public function get_today_deducted_income_dahboard($blanch_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted FROM tbl_deducted_fee WHERE blanch_id = '$blanch_id' AND deducted_date = '$today'");
       	return $data->row();
       }

        public function get_today_nonDeducted_receive($blanch_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(receve_amount) AS total_non FROM tbl_receve WHERE blanch_id = '$blanch_id' AND receve_day = '$today'");
       	return $data->row();
       }

       public function get_today_expenses_blanch_data($blanch_id){
       	$today = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(req_amount) AS total_expenses FROM  tbl_request_exp WHERE blanch_id = '$blanch_id' AND req_date = '$today'");
       	return $data->row();
       }

       public function get_expences_request_blanch($blanch_id){
	$date = date("Y-m-d");
	$expences = $this->db->query("SELECT * FROM tbl_request_exp re LEFT JOIN tbl_expenses e ON e.ex_id = re.ex_id LEFT JOIN tbl_blanch b ON b.blanch_id = re.blanch_id LEFT JOIN tbl_account_transaction at ON at.trans_id = re.trans_id WHERE re.blanch_id = '$blanch_id' AND re.req_date = '$date' ORDER BY re.req_id DESC");
	 return $expences->result();;
}


 public function get_sum_expences_blanch($blanch_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(req_amount) AS total_expences FROM tbl_request_exp WHERE blanch_id = '$blanch_id' AND req_date = '$date'");
    	 return $data->row();
    }

       public function get_cash_transaction_blanch_data($blanch_id){
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT * FROM tbl_prev_lecod pr LEFT JOIN tbl_customer c ON c.customer_id = pr.customer_id LEFT JOIN tbl_blanch b ON b.blanch_id = pr.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = pr.empl_id WHERE pr.blanch_id = '$blanch_id' AND date(pr.time_rec) = '$date' ORDER BY prev_id DESC");
		 return $data->result();
	}

	public function get_total_loan_pendingblanch($blanch_id){
	$data = $this->db->query("SELECT b.blanch_name,c.f_name,c.m_name,c.l_name,c.phone_no,l.loan_int,l.session,l.day,pt.total_pend,l.loan_id,pt.date FROM tbl_pending_total pt JOIN tbl_loans l ON l.loan_id = pt.loan_id JOIN tbl_blanch b ON b.blanch_id = pt.blanch_id JOIN tbl_customer c ON c.customer_id = pt.customer_id WHERE pt.blanch_id = '$blanch_id' AND total_pend IS NOT FALSE ");

	foreach ($data->result() as $r) {
	 $r->total_penart = $this->get_total_penart_pending($r->loan_id);
	 $r->total_pay_penart = $this->get_pay_penart_loan($r->loan_id);
	}
	return $data->result();
}

public function get_total_pend_loan_blanch($blanch_id){
	$data = $this->db->query("SELECT SUM(total_pend) AS total_pending FROM tbl_pending_total WHERE blanch_id = '$blanch_id'");
	return $data->row();
}

	public function get_pending_reportLoanblanch_data($blanch_id){
		$pend = date("Y-m-d");
		$data = $this->db->query("SELECT * FROM tbl_loan_pending lp LEFT JOIN tbl_customer c ON c.customer_id = lp.customer_id LEFT JOIN tbl_blanch b ON b.blanch_id = lp.blanch_id LEFT JOIN tbl_loans l ON l.loan_id = lp.loan_id WHERE lp.blanch_id = '$blanch_id' AND action_date >='$pend'");
		 return $data->result();
	}

	  public function get_sun_loanPendingcompany_blanch($blanch_id){
    	$pend = date("Y-m-d");
    	$pending = $this->db->query("SELECT SUM(return_total) AS total_pending FROM tbl_loan_pending WHERE blanch_id = '$blanch_id' AND action_date >='$pend'");
    	return $pending->row();

    }


    public function get_today_recevable_loan_blanch($blanch_id){
    	$today = date("Y-m-d");
    	//$date = $today_data->format("Y-m-d");
    	$today_recevable = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id  WHERE l.date_show ='$today' AND l.loan_status = 'withdrawal' AND l.blanch_id = '$blanch_id' AND l.dep_status = 'open'");
    	return $today_recevable->result();
    }

      public function get_loan_withdrawal_todayBalanch($blanch_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT * FROM tbl_outstand ot JOIN tbl_loans l ON l.loan_id = ot.loan_id JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id JOIN tbl_account_transaction at ON at.trans_id = l.method WHERE ot.blanch_id = '$blanch_id' AND l.loan_status = 'withdrawal' AND ot.loan_stat_date = '$date'");
 	return $data->result();
 }

  public function get_today_loan_withdrawal_loan_blanch($blanch_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(l.loan_aprove)AS total_with_loan,SUM(l.loan_int) AS total_loan_int FROM tbl_outstand ot JOIN tbl_loans l ON l.loan_id = ot.loan_id WHERE ot.blanch_id = '$blanch_id' AND l.loan_status = 'withdrawal' AND ot.loan_stat_date = '$date'");
 	return $data->row();
 }


    function fetch_loan_list($customer_id)
 {
  $this->db->where('customer_id', $customer_id);
  $this->db->order_by('loan_code', 'DESC');
  $query = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE l.customer_id = '$customer_id' ORDER BY l.loan_id DESC");
  //$output = '<option value="">Select Active Loan</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->loan_id.'">'.$row->loan_code. "-" ."(Tsh.".number_format($row->loan_aprove).")"."/"."Date " .$row->loan_stat_date.'</option>';
   
  }
  return $output;
 }



 //reminder sms
 	 public function get_sms_data($comp_id){
 	 	$data = $this->db->query("SELECT * FROM tbl_reminder WHERE comp_id = '$comp_id'");
 	 	return $data->result();
 	 }

 	  public function insert_sms_settup($data){
 	 	return $this->db->insert('tbl_reminder',$data);
 	 }

 	 public function remove_sms($id){
 	return $this->db->delete('tbl_reminder',['id'=>$id]);
 }

  public function update_sms_settup($data,$id){
 	 	return $this->db->where('id',$id)->update('tbl_reminder',$data);
 	 }

 	 public function get_sms_structure($comp_id,$loan_status){
 	$data = $this->db->query("SELECT * FROM tbl_reminder WHERE comp_id = '$comp_id' AND sms_type = '$loan_status'");
 	return $data->row();
 }


 public function get_loan_reminder($customer_id){
 	 	$data = $this->db->query("SELECT c.phone_no,c.f_name,c.m_name,c.l_name FROM tbl_customer c   WHERE c.customer_id = '$customer_id'");
 	 return $data->row();
 	 }

 	 public function get_employee_data_staff($empl_id){
 	$data = $this->db->query("SELECT * FROM tbl_employee WHERE empl_id = '$empl_id'");
 	return $data->row();
 }


 public function get_loan_group_pending($comp_id){
 	$data = $this->db->query("SELECT g.group_id,g.group_name FROM tbl_loans l LEFT JOIN tbl_group g ON g.group_id = l.group_id WHERE l.comp_id = '$comp_id' AND l.loan_status = 'open' AND l.group_id IS TRUE GROUP BY l.group_id");
 	return $data->result();
 }

  public function get_loan_group_pending_blanch($blanch_id){
 	$data = $this->db->query("SELECT g.group_id,g.group_name FROM tbl_loans l LEFT JOIN tbl_group g ON g.group_id = l.group_id WHERE l.blanch_id = '$blanch_id' AND l.loan_status = 'open' AND l.group_id IS TRUE GROUP BY l.group_id");
 	return $data->result();
 }


 public function get_loan_group_pend($group_id){
	 $loan = $this->db->query("SELECT c.customer_id,c.f_name,c.m_name,c.l_name,l.loan_code,c.phone_no,b.blanch_name,l.how_loan,l.day,l.session,l.loan_status,l.loan_id,l.comp_id,l.renew_loan FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id WHERE l.loan_status = 'open' AND l.group_id = '$group_id' AND l.group_id IS TRUE");
	 	return $loan->result();
 }

 public function get_loan_status_alert_group($loan_id){
 	$data = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_group g ON g.group_id = l.group_id WHERE l.loan_id = '$loan_id'");
 	return $data->row();
 }

 public function get_receivable_oficer($comp_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT e.empl_id,e.empl_name FROM tbl_loans l LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id WHERE l.comp_id = '$comp_id' AND l.date_show = '$date' AND l.loan_status = 'withdrawal' GROUP BY l.empl_id");
 	return $data->result();
 }
 public function get_receivable_oficer_blanch($blanch_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT e.empl_id,e.empl_name FROM tbl_loans l LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id WHERE l.blanch_id = '$blanch_id' AND l.date_show = '$date' AND l.loan_status = 'withdrawal' GROUP BY l.empl_id");
 	return $data->result();
 }


 public function get_colateral_image($col_id){
 	$data = $this->db->query("SELECT * FROM tbl_collelateral WHERE col_id = '$col_id'");
 	return $data->row();
 }
















   

 //Admin login
	public function user_data($comp_phone, $password){
		$data = $this->db->where(['comp_phone'=>$comp_phone,'password'=>$password])
    	        ->get('tbl_company');
    	  if ($data->num_rows() > 0) {
    	  	return $data->row();
    	  	
    	  }
       }

  //Super Admin login
	public function super_user_data($email, $password){
		$data = $this->db->where(['email'=>$email,'password'=>$password])
    	        ->get('tbl_super_admin');
    	  if ($data->num_rows() > 0) {
    	  	return $data->row();
    	  	
    	  }
       }


       //Admin login
	public function employee_user_data($empl_no,$password){
		$data = $this->db->where(['empl_no'=>$empl_no , 'password'=>$password])
    	        ->get('tbl_employee');
    	  if ($data->num_rows() > 0) {
    	  	return $data->row();
    	  	
    	  }
       }
	
}