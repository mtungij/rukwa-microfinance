<?php include('incs/header.php'); ?>
<?php include('incs/nav.php'); ?>
<?php include('incs/side.php'); ?>

<style type="text/css">
    img{
        display: block;
        max-width: 100%;
    }
    .preview{
    overflow: hidden;
    width: 160px;
    height: 160px;
    margin: 10px;
    border: 1 px solid red;
    }
</style>

<div id="main-content" class="profilepage_2 blog-page">
<div class="container-fluid">
<div class="block-header">
<div class="row">
<div class="col-lg-6 col-md-8 col-sm-12">
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo base_url("admin/index"); ?>"><i class="icon-home"></i></a></li>

<li class="breadcrumb-item active">Customer</li>
<li class="breadcrumb-item active">Customer Profile</li>
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
    <div class="col-lg-4 col-4">
    
    </div>
<div class="col-lg-8 col-8">
    <div class="body">
       <!--  <i class="fa fa-thumbs-up"></i> -->
         <div class="profile-image"> 
            <?php if ($customer_profile->passport == TRUE) {
          ?>
           <img src="<?php echo base_url().$customer_profile->passport; ?>" class="img-thumbnail" alt="customer image" style="width: 130px;height: 130px;">
          <?php }else{ ?> 
            <img src="<?php echo base_url().'assets/img/male.jpeg'; ?>" class="img-thumbnail" alt="customer image" style="width: 130px;height: 130px;">
            <?php } ?>          </div>
        <!-- <small><?php echo $customer_profile->f_name; ?> <?php echo $customer_profile->m_name; ?> <?php echo $customer_profile->l_name; ?></small> -->
    </div>
</div>
<div class="col-lg-2 col-2">
    
</div>


</div>
</div>



<div class="card">
<div class="body">
<ul class="nav nav-tabs-new">
    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Basic">Basic</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#aditinal">Aditional Details</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Account">Guarantors </a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#General">All Loans</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#passport">Passport</a></li>
    <li class="nav-item"><a class="nav-link"href="<?php echo base_url("admin/all_customer"); ?>">Back</a></li>
</ul>
</div>
</div>

<div class="tab-content padding-0">

<div class="tab-pane active" id="Basic">
<div class="card">
    <div class="body">
        <h6>Basic Information</h6>
<?php echo form_open("admin/update_customer_info/{$customer_profile->customer_id}"); ?>
<div class="row">
<div class="col-lg-4 col-6">
<span>First Name:</span>
<input type="text" name="f_name" value="<?php echo $customer_profile->f_name; ?>" placeholder="First name" autocomplete="off" class="form-control input-sm" required>
    </div>
    <div class="col-lg-4 col-6">
        <span>Middle name:<spanl>
        <input type="text" name="m_name" value="<?php echo $customer_profile->m_name; ?>" placeholder="Middle name" autocomplete="off" class="form-control input-sm" required>
    </div>
    
    <div class="col-lg-4 col-6">
        <span>Last name:</span>
        <input type="text" name="l_name" placeholder="Last name" value="<?php echo $customer_profile->l_name; ?>" autocomplete="off" class="form-control input-sm" required>
    </div>

    <div class="col-lg-4 col-6">
        <span>Branch:</span>
    <select type="number" name="blanch_id" class="form-control select2 input-sm" id="blanch" required class="form-control input-sm">
    <option value="<?php echo $customer_profile->blanch_id ?>"><?php echo $customer_profile->blanch_name; ?></option>
    <?php foreach ($blanch as $blanchs): ?>
    <option value="<?php echo $blanchs->blanch_id; ?>"><?php echo $blanchs->blanch_name; ?></option>
    <?php endforeach;?>
</select>
    </div>

    <div class="col-lg-4 col-6">
        <span>Employee:</span>
    <select type="number" name="empl_id" class="form-control select2 input-sm" id="empl" required class="form-control input-sm">
    <option value="<?php echo $customer_profile->empl_id; ?>"><?php echo $customer_profile->empl_name; ?></option>
    
</select>
    </div>

    <div class="col-lg-4 col-6">
        <span>Gender:</span>
    <select type="text" name="gender" class="form-control select2 input-sm" required class="form-control input-sm">
    <option value="<?php echo $customer_profile->gender; ?>"><?php echo $customer_profile->gender; ?></option>
    <option value="male">Male</option>
    <option value="female">Female</option>
</select>
    </div>
    <div class="col-lg-4 col-6">
        <span>Date of Birth:</span>
<input type="date" name="date_birth" value="<?php echo $customer_profile->date_birth; ?>" onchange="getDate(this.value)" placeholder="Date of Birth" autocomplete="off" class="form-control input-sm" required>
    </div>
    <div class="col-lg-4 col-6">
        <span>Year:</span>
<input type="" id="age" name="age" value="<?php echo $customer_profile->age; ?>" readonly class="form-control input-sm" value="" required>
    </div>
        <div class="col-lg-4 col-6">
        <span>Phone Number:</span>
<input type="number" name="phone_no" value="<?php echo $customer_profile->phone_no; ?>" placeholder="Eg,7538, 6283" autocomplete="off" class="form-control input-sm" required >
    </div>
        <div class="col-lg-3 form-group-sub">
        <span>Region:</span>
<select type="number" name="region_id" class="form-control select2 input-sm" required>
    <option value="<?php echo $customer_profile->region_id; ?>"><?php echo $customer_profile->region_name; ?></option>
    <?php foreach ($region as $regions): ?>
    <option value="<?php echo $regions->region_id; ?>"><?php echo $regions->region_name; ?></option>
    <?php endforeach;?>
</select>
    </div>

        <div class="col-lg-3 col-6">
        <span>District:</span>
<input type="text" name="district" value="<?php echo $customer_profile->district; ?>" placeholder="district" autocomplete="off" class="form-control input-sm" required>
    </div>
        <div class="col-lg-3 col-6">
        <span>Ward:</span>
<input type="text" name="ward" value="<?php echo $customer_profile->ward; ?>" placeholder="Ward" autocomplete="off" class="form-control input-sm" required>
    </div>
            <div class="col-lg-3 col-6">
        <span>Street:</span>
<input type="text" name="street" value="<?php echo $customer_profile->street; ?>" placeholder="street" autocomplete="off" class="form-control input-sm" required>
    </div>
        
        </div>
        <br>
        <div class="text-center">
        <button type="submit" class="btn btn-primary">Update</button> &nbsp;
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
</div>



<div class="tab-pane" id="aditinal">
<div class="card">
    <div class="body">
        <h6>Aditinal Details</h6>
<?php //echo form_open("oficer/update_customer_info/{$customer_profile->customer_id}"); ?>
<div class="row">

<div class="col-lg-4 col-6">
<span>Nick name:</span>
<input type="text" name="famous_area" value="<?php echo $customer_profile->famous_area; ?>" autocomplete="off" class="form-control input-sm" placeholder="Eg.Mama James, Baba Samwel" required>
</div>
<div class="col-lg-4 col-6">
        <span>Martial Status:</span>
<select type="text" name="martial_status" class="form-control kt-selectpicker" required required data-live-search="true">
    <option value="<?php echo $customer_profile->martial_status; ?>"><?php echo $customer_profile->martial_status; ?></option>
    <option value="Married">Married</option>
    <option value="Single">Single</option>
    <option value="Widow">Widow</option>
    <option value="Separated">Separated</option>
    <option value="Devorced">Devorced</option>
    
</select>
    </div>
        <div class="col-lg-4 col-12">
        <span>Account Type:</span>
<select type="number" name="account_id" class="form-control input-sm" required>
    <option value="<?php echo $customer_profile->account_id; ?>"><?php echo $customer_profile->account_name; ?></option>
    <?php foreach ($account as $accounts): ?>
    <option value="<?php echo $accounts->account_id; ?>"><?php echo $accounts->account_name; ?></option>
    <?php endforeach; ?>
    
</select>
    </div>
    
    <div class="col-lg-2 col-6">
        <span>ID Type:</span>
       <select type="text" name="id_type" class="form-control" required>
           <option value="<?php echo $customer_profile->id_type; ?>"><?php echo $customer_profile->id_type; ?></option>
           <option value="voter ID">voter ID</option>
           <option value="National  ID (NIDA)">National  ID (NIDA)</option>
           <option value="Driver's license">Driver's license</option>
       </select>
    </div>
    <div class="col-lg-2 col-6">
        <br>
        <span></span>
        <input type="text" name="natinal_identity" value="<?php echo $customer_profile->natinal_identity; ?>" placeholder="Enter Id Cresidentials" autocomplete="off" class="form-control input-sm" required >
    </div>
<div class="col-lg-4 col-6">
        <span>Working status:</span>

<select type="text" name="work_status" class="form-control kt-selectpicker" required data-live-search="true" required>
    <option value="<?php echo $customer_profile->work_status; ?>"><?php echo $customer_profile->work_status; ?></option>
    <option value="Employee">Employee</option>
    <option value="Government Employee">Government Employee</option>
    <option value="Private Sector Employee">Private Sector Employee</option>
    <option value="Bussines Owner">Bussines Owner</option>
    <option>Student</option>
    <option value="Overseas Worker">Overseas Worker</option>
    <option value="Pensioner">Pensioner</option>
    <option value="Unemployed">Unemployed</option>
    <option value="Self Employed">Self Employed</option>
</select>
    </div>

    <div class="col-lg-4 col-6">
        <span>Bussiness Type:</span>
<input type="text" name="bussiness_type" value="<?php echo $customer_profile->bussiness_type; ?>" placeholder="Bussiness Type" autocomplete="off" class="form-control input-sm" required>
    </div>


    <div class="col-lg-4 col-12">
        <span>Place Employment/Business:</span>
<input type="text" name="place_imployment" value="<?php echo $customer_profile->place_imployment; ?>" placeholder="Place Imployment" autocomplete="off" class="form-control input-sm" required>
    </div>
        <div class="col-lg-4 col-12">
        <span>Number of Dependents:</span>
<input type="number" name="number_dependents" value="<?php echo $customer_profile->number_dependents; ?>" placeholder="Number of Dependents" autocomplete="off" class="form-control input-sm" required>
    </div>

    <div class="col-lg-4 ">
        <span>Monthly Income:</span>
<input type="number"  name="month_income" value="<?php echo $customer_profile->month_income; ?>" autocomplete="off" placeholder="Monthly Income" class="form-control input-sm" required>
    </div>
        
        </div>
        <br>
        <div class="text-center">
        <!-- <button type="submit" class="btn btn-primary">Update</button> &nbsp; -->
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
</div>

<div class="tab-pane" id="Account">
<div class="card">
    <div class="body">
    
<div class="col-lg-12">
<div class="">
<div class="header">
<h2>Gualantors List </h2>    
 </div>
<div class="body">
<div class="table-responsive">
    <table class="table table-hover js-basic-example dataTable table-custom">
        <thead class="thead-primary">
            <tr>
                <th>S/No.</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Phone Number</th>
                <th>Relationship</th>
                <th>Region</th>
                <th>District</th>
                <th>Ward</th>
                <th>Street</th>
            </tr>
        </thead>
       
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($sponser as $sponsers): ?>
            <tr>
                <td><?php echo $no++; ?>.</td>
                <td><?php echo $sponsers->sp_name; ?></td>
                <td><?php echo $sponsers->sp_mname; ?></td>
                <td><?php echo $sponsers->sp_lname; ?></td>
                <td><?php echo $sponsers->sp_phone_no; ?></td>
                 <td><?php echo $sponsers->sp_relation; ?></td>
                 <td><?php echo $sponsers->region_name; ?></td>
                 <td><?php echo $sponsers->sp_district; ?></td>
                 <td><?php echo $sponsers->sp_ward; ?></td>
                 <td><?php echo $sponsers->sp_district; ?></td>
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

<div class="tab-pane" id="General">
<div class="body">
<div class="col-lg-12">
<div class="card">
<div class="header">
<h2>All Loans </h2>    
 </div>
<div class="body">
<div class="table-responsive">
    <table class="table table-hover js-basic-example dataTable table-custom">
        <thead class="thead-primary">
            <tr>
            <th>S/no.</th>
            <th>Loan Ac</th>
            <th>Loan Product</th>
            <th>Loan Interest</th>
            <th>Loan Withdrawal</th>
            <th>Principal + interest</th>
            <th>Duration Type</th>
            <th>Number of Repayment</th>
            <th>Restoration</th>
            <th>Status</th>
            <th>Withdrawal Date</th>
            <th>End Date</th>
           <!--  <th>Action</th> -->
            </tr>
        </thead>
       
        <tbody>
           <?php $no = 1 ?>        
    <?php foreach($loan_customer as $loan_aproveds): ?>
            <tr>
        <td><?php echo $no++; ?>.</td>
        <td><?php echo $loan_aproveds->loan_code; ?></td>
        
        <td><?php echo $loan_aproveds->loan_name ?></td>
        <td><?php echo $loan_aproveds->interest_formular; ?>%</td>
        <td><?php echo number_format($loan_aproveds->loan_aprove); ?></td>
        <td><?php echo number_format($loan_aproveds->loan_int); ?></td>
        
        <td>
   <?php if ($loan_aproveds->day == 1) {
                     echo "Daily";
                 ?>
                <?php }elseif($loan_aproveds->day == 7){
                      echo "Weekly";
                 ?>
                
            <?php }elseif($loan_aproveds->day == 30 || $loan_aproveds->day == 31 || $loan_aproveds->day == 29 || $loan_aproveds->day == 28){
                    echo "Monthly"; 
                ?>
                <?php } ?>
        </td>

            
    <td><?php echo $loan_aproveds->session; ?> </td> 
    <td><?php echo number_format($loan_aproveds->restration); ?> </td>
    <td>
        <?php if ($loan_aproveds->loan_status == 'open') {
             ?>
            <a href="javascript:;" class="badge badge-warning">Pending</a>
            <?php }elseif($loan_aproveds->loan_status == 'aproved'){ ?>
              <a href="javascript:;" class="badge badge-info">Aproved</a>
                <?php }elseif($loan_aproveds->loan_status == 'withdrawal'){ ?>
                 <a href="javascript:;" class="badge badge-primary">Active</a>
                    <?php }elseif($loan_aproveds->loan_status == 'done'){ ?>
                    <a href="javascript:;" class="badge badge-success">Done</a>
                        <?php }elseif ($loan_aproveds->loan_status == 'out') { ?>
                <a href="javascript:;" class="badge badge-danger">Default</a>
                            
                        <?php }elseif($loan_aproveds->loan_status == 'disbarsed'){ ?> 
                    <a href="javascript:;" class="badge badge-secondary">Disbursed</a>
                    <?php } ?>
    </td> 
    <td><?php echo $loan_aproveds->loan_stat_date; ?> </td>
    <td><?php echo substr($loan_aproveds->loan_end_date, 0,10); ?></td> 
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


        <div class="tab-pane" id="passport">
                <div class="body">
                <div class="col-lg-12">
                    <div class="card">
                         <div class="header">
                            <h2>Update Passport</h2>    
                             </div>
                          <div class="body">
                            <div class="row">
                            <div class="col-lg-4 col-6">
                             <div class="profile-image">
        <br><br>
        <span>Upload Passport</span>
    <form  method="POST" enctype="multipart/form-data">
    <input type="file" class="image form-control" name="image">
    <input type="hidden" value="<?php echo $customer_profile->customer_id; ?>" name="id" id="id">
    </form> 
                                    
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="img-container">
            <div class="row">
                <div class="col-md-6 col-6">
                    <img id="image">
                </div>
            
            <div class="col-md-6 col-6">
                <div class="preview"></div>
                </div>
                </div>
            
        </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> -->
        <button type="button" class="btn btn-primary" id="crop">Crop</button>
      </div>
    </div>
  </div>
</div>

                                      </div>
                                </div>
                                <div class="col-lg-4 col-6">
                                      <!-- <span>Photo:</span> -->
                                     <?php if ($customer_profile->passport == TRUE) {
                                  ?>
                             <div class="profile-image"> <img src="<?php echo base_url().$customer_profile->passport; ?>" class="img-thumbnail" alt="customer image" style="width: 135px;height: 135px;">
                                      </div>
                              <?php }else{ ?>
                                     <div class="profile-image"> <img src="<?php echo base_url().'assets/img/male.jpeg'; ?>" class="img-thumbnail" alt="customer image" style="width: 135px;height: 135px;">
                                      </div>
                                    <?php } ?>
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
    var  bs_modal = $('#modal');
    var  image = document.getElementById('image');
    var id = document.getElementById('id').value;
    var  cropper,reader,file;

    $("body").on("change",".image",function(e){
      var files = e.target.files;
      var done = function (url){
        image.src = url;
        bs_modal.modal('show');
      };

      if (files && files.length > 0) {
         file = files[0];
         if (URL) {
            done(URL.createObjectURL(file));
         }else if(FileReader){
          reader = new FileReader();
          reader.onload = function (e){
            done(reader.result);
          };
          reader.readAsDataURL(file);
         }
      }

    
    });

    bs_modal.on('shown.bs.modal',function(){
        cropper = new Cropper(image,{
            aspectRatio: 1,
            viewMode : 3,
            preview: '.preview'
            });


        }).on('hidden.bs.modal',function(){
            cropper.destroy();
            cropper = null;
        });

        $("#crop").click(function(){
            canvas = cropper.getCroppedCanvas({
                width: 160,
                height : 160,

            });
            

        canvas.toBlob(function(blob){
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
        reader.onload = function(){
            var base64data = reader.result;
              //alert(id);
            $.ajax({
                type:"POST",
                //dataType:"json",
                url:"<?php echo base_url(); ?>admin/update_customerID",
                data:{image:base64data,id:id},
                success: function(data){
                    //image.val('')
                 bs_modal.modal('hide');
                 alert(data);
                 location.reload();
                }
            });

            };

        });
    });
        
        
        
    
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