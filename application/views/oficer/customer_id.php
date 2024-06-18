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

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url("admin/index"); ?>"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">Customer</li>
                            <li class="breadcrumb-item active">Customer Photo & Gualantors Photo</li>
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
                            <h2>Customer Photo & Gualantors Photo</h2>
                        </div>
                        <div class="body">
                            <?php //echo form_open("oficer/update_customerID/{$customer->customer_id}") ?>
                            <div class="row">

                              <div class="col-lg-6 col-6">
                                    <div class="profile-image">
        <br><br>
        <span>Upload Passport</span>
    <form  method="POST" enctype="multipart/form-data">
    <input type="file" class="image form-control" name="image">
    <input type="hidden" value="<?php echo $customer->customer_id; ?>" name="id" id="id">
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
                                    <div class="col-lg-6 col-6">
                        <div class="profile-image">
         <?php if ($customer->passport == TRUE) {
          ?>
           <img src="<?php echo base_url().$customer->passport; ?>" class="img-thumbnail" alt="customer image" style="width: 160px;height: 160px;">
          <?php }else{ ?> 
            <img src="<?php echo base_url().'assets/img/male.jpeg'; ?>" class="img-thumbnail" alt="customer image" style="width: 160px;height: 160px;">
            <?php } ?>
                                </div>
                                <br>
                                </div>
                                
                                <input type="hidden" name="customer_id" value="<?php echo $customer->customer_id; ?>">
                            </div>
                                <div class="text-center">
                                
                                <a href="<?php echo base_url("oficer/customer_profile/{$customer->customer_id}") ?>" class="btn btn-primary btn-elevate btn-pill">Finish</a>
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
                url:"<?php echo base_url(); ?>oficer/update_customerID",
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


