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
                            <li class="breadcrumb-item active">Group Members</li>
                            <li class="breadcrumb-item active" class="c"><?php echo $group_data->customer_code ?> - <?php echo $group_data->f_name ?></li>
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
            <div class="row clearfix">
               
                <div class="col-lg-12">
                    <div class="card">
                         <div class="header">
                            <h2>Members List </h2>
                            <div class="pull-right">
                            <a href="" class="btn btn-sm btn-icon btn-pure btn-primary on-default m-r-5 button-edit"
                            data-toggle="modal" data-target="#addcontact2" data-original-title="Add"><i class="icon-plus"></i>
                        </a> 
                        <a href="<?php echo base_url("admin/grops"); ?>" class="btn btn-primary btn-sm"><i class="icon-arrow-left"></i></a>  
                            </div>    
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                            <th>S/No.</th>
                                            <th>Member Name</th>
                                            <th>Phone Number</th>
                                            <th>Gender</th>
                                            <th>Position</th>
                                            <th>Adress</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $no = 1; ?>
                                <?php foreach ($member as $members): ?>
                                        <tr>
                                            <td><?php echo $no++; ?>.</td>
                                            <td><?php echo $members->full_name; ?></td>
                                            <td><?php echo $members->member_no; ?></td>
                                            <td><?php echo $members->gender; ?></td>
                                            <td><?php echo $members->position; ?></td>
                                            <td><?php echo $members->adress; ?></td>
                                            
                                            <td>
                                            <a href="" class="btn btn-sm btn-icon btn-pure btn-primary on-default m-r-5 button-edit"
                                            data-toggle="modal" data-target="#addcontact1<?php echo $members->id; ?>" data-original-title="Edit"><i class="icon-pencil"></i></a>
                                            <a href="<?php echo base_url("admin/remove_member/{$members->id}/{$members->customer_id}"); ?>" class="btn btn-sm btn-icon btn-pure btn-danger on-default button-remove"
                                            data-toggle="tooltip" data-original-title="Remove" onclick="return confirm('Are You Sure?')"><i class="icon-trash" aria-hidden="true"></i></a>
                                        </td>
                                        </tr>
    <div class="modal fade" id="addcontact1<?php echo $members->id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Edit Member</h6>
            </div>
            <?php echo form_open("admin/update_mebers/{$members->id}/{$members->customer_id}"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-6 col-6">
                        <span>Member Name</span>
                        <input type="text" class="form-control" value="<?php echo $members->full_name; ?>" placeholder="Enter Member Name" autocomplete="off" name="full_name">
                    </div>
                     <div class="col-md-6 col-6">
                        <span>Phone Number</span>
                        <input type="number" class="form-control" value="<?php echo $members->member_no; ?>" placeholder="Eg,0753...." autocomplete="off" name="member_no">
                    </div>
                    <div class="col-md-6 col-6">
                        <span>Gender</span>
                        <select type="text" class="form-control" name="gender" required>
                            <option value="<?php echo $members->gender; ?>"><?php echo $members->gender; ?></option>
                            <option value="male">MALE</option>
                            <option value="female">FEMALE</option>
                        </select>
                    </div>
                     <div class="col-md-6 col-6">
                        <span>Adress</span>
                        <input type="text" class="form-control" value="<?php echo $members->adress; ?>" placeholder="Enter Adress" autocomplete="off" name="adress">
                    </div>

                    <div class="col-md-12 col-12">
                        <span>Position</span>
                        <select type="text" class="form-control" name="position" required>
                            <option value="<?php echo $members->position; ?>"><?php echo $members->position; ?></option>
                            <option value="Chair Person">Chair Person</option>
                            <option value="Secretary">Secretary</option>
                            <option value="Member">Member</option>
                            
                        </select>
                    </div> 
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
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
</div>

<?php include('incs/footer.php'); ?>


    <div class="modal fade" id="addcontact2" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Add Members</h6>
            </div>
            <?php echo form_open("admin/create_mebers/{$group_data->customer_id}"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-6 col-6">
                        <span>Member Name</span>
                        <input type="text" class="form-control" placeholder="Enter Member Name" autocomplete="off" name="full_name">
                    </div>
                     <div class="col-md-6 col-6">
                        <span>Phone Number</span>
                        <input type="number" class="form-control" placeholder="Eg,0753...." autocomplete="off" name="member_no">
                    </div>
                    <div class="col-md-6 col-6">
                        <span>Gender</span>
                        <select type="text" class="form-control" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="male">MALE</option>
                            <option value="female">FEMALE</option>
                        </select>
                    </div>
                     <div class="col-md-6 col-6">
                        <span>Adress</span>
                        <input type="text" class="form-control" placeholder="Enter Adress" autocomplete="off" name="adress">
                    </div>

                    <div class="col-md-12 col-12">
                        <span>Position</span>
                        <select type="text" class="form-control" name="position" required>
                            <option value="">Select Position</option>
                            <option value="Chair Person">Chair Person</option>
                            <option value="Secretary">Secretary</option>
                            <option value="Member">Member</option>
                            
                        </select>
                    </div>
                    

                   <input type="hidden" name="comp_id" value="<?php echo $_SESSION['comp_id']; ?>"> 
                   <input type="hidden" name="blanch_id" value="<?php echo $group_data->blanch_id; ?>"> 
                   <input type="hidden" name="customer_id" value="<?php echo $group_data->customer_id; ?>"> 
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>


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


<script>
$(document).ready(function(){
$('#blanchs').change(function(){
var blanch_id = $('#blanchs').val();
//alert(blanch_id)
if(blanch_id != ''){

$.ajax({
url:"<?php echo base_url(); ?>admin/fetch_employee_blanch",
method:"POST",
data:{blanch_id:blanch_id},
success:function(data)
{
$('#empls').html(data);
//$('#district').html('<option value="">All</option>');
}
});
}
else
{
$('#empls').html('<option value="">Select Employee</option>');
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



