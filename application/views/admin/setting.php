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
                            
                            <li class="breadcrumb-item active">Setting</li>
                            <li class="breadcrumb-item active">Company Profile</li>
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
<!-- 
                    <div class="card">
                        <div class="row profile_state">
                            <div class="col-lg-6 col-6">
                                <div class="body">
                                    <i class="fa fa-thumbs-up"></i>
                                     <div class="profile-image"> <img src="<?php echo base_url().'assets/img/male.jpeg'; ?>" class="rounded-circle" alt="customer image" style="width: 135px;height: 135px;">
                                      </div>
                                    <small><?php echo $empl_data->empl_name; ?></small>
                                </div>
                            </div>
                            
                           
                            
                        </div>
                    </div> -->

                  

                    <div class="card">
                        <div class="body">
                            <ul class="nav nav-tabs-new">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Basic">Basic </a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Account">Change Password </a></li>
                                  <?php if (@$_SESSION['position_id'] == '22') {
                              ?>
                          <?php }else{ ?>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#General">Logo</a></li>
                                <?php } ?>
                             <!--    <li class="nav-item"><a class="nav-link"href="<?php //echo base_url("oficer/all_customer"); ?>">Back</a></li> -->
                            </ul>
                        </div>
                    </div>

                    <div class="tab-content padding-0">

                        <div class="tab-pane active" id="Basic">
                            <div class="card">
                                <div class="body">
                                    <?php if (@$_SESSION['position_id'] == '22') {
                                 @$empl_id = $this->session->userdata('empl_id');
                                 @$empl_data = $this->queries->get_employee_data($empl_id);
                                     ?>
                            <h6>Basic Information</h6>
                            <?php //echo form_open("oficer/update_customer_info/{$customer_profile->customer_id}"); ?>
                            <div class="row">
                            <div class="col-lg-4 col-6">
                            <span>Full Name:</span>
                            <input type="text" name="f_name" readonly value="<?php echo $empl_data->empl_name; ?>" placeholder="First name" autocomplete="off" class="form-control input-sm" required>
                                </div>
                                <div class="col-lg-4 col-6">
                                    <span>Username:<spanl>
                                    <input type="text" name="m_name" readonly value="<?php echo $empl_data->username; ?>" placeholder="Middle name" autocomplete="off" class="form-control input-sm" required>
                                </div>
                                
                                <div class="col-lg-4 col-6">
                                    <span>Gender:</span>
                                    <input type="text" name="l_name" readonly placeholder="Last name" value="<?php echo $empl_data->empl_sex; ?>" autocomplete="off" class="form-control input-sm" required>
                                </div>

                                <div class="col-lg-6 col-6">
                                    <span>Phone number:</span>
                                <input type="text" name="l_name" readonly placeholder="Last name" value="<?php echo $empl_data->empl_no; ?>" autocomplete="off" class="form-control input-sm" required>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <span>Email:</span>
                                <input type="text" name="l_name" readonly placeholder="Last name" value="<?php echo $empl_data->empl_email; ?>" autocomplete="off" class="form-control input-sm" required>
                                </div>
                                    
                                    </div>
                                    <br>
                                    <div class="text-center">
                                  <!--   <button type="submit" class="btn btn-primary">Update</button> &nbsp; -->
                                    </div>
                                    <?php //echo form_close(); ?>
                                 <?php }else{ ?>
                        <h6>Company Information</h6>
                            <?php echo form_open("admin/update_company_profile/{$compdata->comp_id}"); ?>
                            <div class="row">
                            <div class="col-lg-4 col-6">
                            <span>Company Name:</span>
                            <input type="text" name="comp_name"  value="<?php echo $compdata->comp_name; ?>" placeholder="First name" autocomplete="off" class="form-control input-sm" required>
                                </div>
                                <div class="col-lg-4 col-6">
                                    <span>Company Reg/No:<spanl>
                                    <input type="text" name="comp_number"  value="<?php echo $compdata->comp_number; ?>" placeholder="Middle name" autocomplete="off" class="form-control input-sm" required>
                                </div>
                                
                                <div class="col-lg-4 col-6">
                                    <span>Address:</span>
                                    <input type="text" name="adress"  value="<?php echo $compdata->adress; ?>" autocomplete="off" class="form-control input-sm" required>
                                </div>

                                <div class="col-lg-4 col-6">
                                    <span>Phone Number:</span>
                                <input type="number" name="comp_phone"  value="<?php echo $compdata->comp_phone; ?>" autocomplete="off" class="form-control input-sm" required>
                                </div>

                                <div class="col-lg-4 col-12">
                                    <span>Email:</span>
                                <input type="email" name="comp_email" value="<?php echo $compdata->comp_email; ?>" autocomplete="off" class="form-control input-sm" required>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <span>Region:</span>
                               <select type="number" name="region_id" class="form-control select2" required>
                                   <option value="<?php echo $compdata->region_id ?>"><?php echo $compdata->region_name; ?></option>
                                   <?php foreach ($region as $regions): ?>
                                   <option value="<?php echo $regions->region_id; ?>"><?php echo $regions->region_name; ?></option>
                                   <?php endforeach; ?>
                               </select>
                                </div>
                                    
                                    </div>
                                    <br>
                                    <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Update</button> &nbsp;
                                    </div>
                                    <?php echo form_close(); ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="Account">
                            <div class="card">
                                <div class="body">
                                
                <div class="col-lg-12">
                    <div class="">
                         <div class="header">
                            <h2>Change Password</h2>    
                             </div>
                             <?php if (@$_SESSION['position_id'] == '22') {
                              ?>
                          <?php echo form_open("admin/change_password_oficer"); ?>
                            <div class="row">
                            <div class="col-lg-4 col-12">
                            <span>Old Password:</span>
                            <input type="password" name="oldpass" value="<?php echo set_value('oldpass') ?>" placeholder="******" autocomplete="off" class="form-control input-sm" required>
                            <?php echo form_error("oldpass"); ?>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <span>New Password:<spanl>
                                    <input type="password" name="newpass" value="<?php echo set_value('newpass') ?>" placeholder="******" autocomplete="off" class="form-control input-sm" required>
                                    <?php echo form_error("newpass"); ?>
                                </div>
                                
                                <div class="col-lg-4 col-12">
                                    <span>Confirm Password:</span>
                                    <input type="password" name="passconf" value="<?php echo set_value('passconf') ?>"   placeholder="******" autocomplete="off" class="form-control input-sm" required>
                                    <?php echo form_error("passconf"); ?>
                                </div>
                                  
                                    
                                    
                        </div>
                        <br> 
                        <div class="text-center">
                                    <button type="submit" class="btn btn-primary"><i class="icon-key">Change password</i></button> &nbsp;
                                    </div>
                                    <?php echo form_close(); ?>
                          <?php }else{ ?>
                             <?php echo form_open("admin/change_password"); ?>
                            <div class="row">
                            <div class="col-lg-4 col-12">
                            <span>Old Password:</span>
                            <input type="password" name="oldpass" value="<?php //echo set_value('oldpass') ?>" placeholder="******" autocomplete="off" class="form-control input-sm" required>
                            <?php echo form_error("oldpass"); ?>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <span>New Password:<spanl>
                                    <input type="password" name="newpass" value="<?php //echo set_value('newpass') ?>" placeholder="******" autocomplete="off" class="form-control input-sm" required>
                                    <?php echo form_error("newpass"); ?>
                                </div>
                                
                                <div class="col-lg-4 col-12">
                                    <span>Confirm Password:</span>
                                    <input type="password" name="passconf" value="<?php //echo set_value('passconf') ?>"   placeholder="******" autocomplete="off" class="form-control input-sm" required>
                                    <?php echo form_error("passconf"); ?>
                                </div>   
                        </div>
                        <br> 
                        <div class="text-center">
                                    <button type="submit" class="btn btn-primary"><i class="icon-key">Change password</i></button> &nbsp;
                                    </div>
                                    <?php echo form_close(); ?>
                                    <?php } ?>
                    </div>
                </div> 
                                  
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="General">
                <div class="body">
                <div class="col-lg-12">
                    <div class="card">
                         <div class="header">
                            <h2>Company Logo </h2>    
                             </div>
                          <div class="body">
                            <?php echo form_open_multipart("admin/update_comp_logo/{$compdata->comp_id}") ?>
                            <div class="row">
                            <div class="col-md-6 col-6">
                          <div class="form-group">
                            <span>Logo</span>  
                            <input type="file" name="comp_logo" class="form-control" required>
                          </div>
                          </div>
                            <div class="col-md-6 col-6">
                          <div class="form-group">
                            <?php if ($compdata->comp_logo == TRUE) {
                             ?>
                        <img src="<?php echo base_url().'assets/img/'.$compdata->comp_logo ?>" class="rounded-circle" alt="customer image" style="width: 135px;height: 135px;">
                         <?php }else{ ?>
                           <img src="<?php echo base_url().'assets/img/user.png'; ?>" class="rounded-circle" alt="company Logo" style="width: 135px;height: 135px;">
                           <?php } ?>
                          </div>
                          </div>
                          </div>
                          <div class="text-center">
                          <button type="submit" class="btn btn-primary">Update</button>
                          </div>
                          <?php echo form_close(); ?>
                        </div>

                    </div>
                </div> 
                                    
                                </div>
                           
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
    </div>




</div>

<?php include('incs/footer.php'); ?>

<script>
    function getDate(data){
  let now = new Date();
  let bod = (new Date(data));

  let age = now.getFullYear() - bod.getFullYear();
   let _age = document.querySelector("#age");
   _age.value = age;
 //alert(age)
}
</script>


<script>
$(document).ready(function(){
$('#blanch').change(function(){
var blanch_id = $('#blanch').val();
//alert(blanch_id)
if(blanch_id != ''){

$.ajax({
url:"<?php echo base_url(); ?>oficer/fetch_employee_blanch",
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