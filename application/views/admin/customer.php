<?php include('incs/header.php'); ?>
<?php include('incs/nav.php'); ?>
<?php include('incs/side.php'); ?>

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url("admin/index"); ?>"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">Customer</li>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Register Customer</h2>
                        </div>
                        <div class="body">
                            <?php echo form_open("admin/create_customer") ?>
                            <div class="row">

                                <div class="col-lg-4 col-6">
                                    <span>First Name:</span>
                            <input type="text" name="f_name" placeholder="First name" autocomplete="off" class="form-control input-sm" required>
                                </div>
                                <div class="col-lg-4 col-6">
                                    <span>Middle name:</span>
                                    <input type="text" name="m_name" placeholder="Middle name" autocomplete="off" class="form-control input-sm" required>
                                </div>
                                <input type="hidden" name="comp_id" value="<?php echo $_SESSION['comp_id']; ?>">
                                <div class="col-lg-4 col-6">
                                    <span>Last name:</span>
                                    <input type="text" name="l_name" placeholder="Last name" autocomplete="off" class="form-control input-sm" required>
                                </div>

                                <div class="col-lg-3 col-6">
                                    <span>Gender:</span>
                                    <select type="number" name="gender" class="form-control select2 input-sm" id="gender" required class="form-control input-sm">
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>

                                <div class="col-lg-3 col-6">
                                    <span>Branch:</span>
                                <select type="number" name="blanch_id" class="form-control select2 input-sm" id="blanch" required class="form-control input-sm">
                                <option value="">Select Blanch</option>
                                <?php foreach ($blanch as $blanchs): ?>
                                <option value="<?php echo $blanchs->blanch_id; ?>"><?php echo $blanchs->blanch_name; ?></option>
                                <?php endforeach;?>
                            </select>
                                </div>

                                <div class="col-lg-3 col-6">
                                    <span>Employee:</span>
                                <select type="number" name="empl_id" class="form-control select2 input-sm" id="empl" required class="form-control input-sm">
                                <option value="">Select Employee</option>
                                
                            </select>
                                </div>
                        
                                    <div class="col-lg-4 col-6">
                                    <span>Phone Number:</span>
                                    <input type="number" name="phone_no" placeholder="Eg,7538, 6283" autocomplete="off" class="form-control input-sm" required >
                                </div>
                             <!--        <div class="col-lg-4 form-group-sub">
                                    <label class="form-control-label">*Region:</label>
                            <select type="number" name="region_id" class="form-control select2 input-sm" required>
                                <option value="">Select Region</option>
                                <?php //foreach ($region as $regions): ?>
                                <option value="<?php //echo $regions->region_id; ?>"><?php //echo $regions->region_name; ?></option>
                                <?php //endforeach;?>
                            </select>
                                </div> -->
                                <input type="hidden" name="region_id" value="1">
                                    <!-- <div class="col-lg-4 col-6">
                                    <span>District:</span>
                            <input type="text" name="district" placeholder="district" autocomplete="off" class="form-control input-sm" >
                                </div> -->
                                <br>
                                </div>
                            </div>
                                <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="icon-pencil">Submit</i></button>
                                </div>
                            
                            <?php echo form_close();  ?>
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


