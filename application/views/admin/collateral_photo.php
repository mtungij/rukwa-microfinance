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
                            <li class="breadcrumb-item active">Loan</li>
                            <li class="breadcrumb-item active">Corrateral Photo</li>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add Collateral Photo</h2>
                        </div>
                        <div class="body">
                            <?php //echo form_open("admin/create_colateral/{$loan_attach->loan_id}") ?>
                            <div class="row">
                             
<div class="col-lg-6">
    <div class="profile-image">
        <span>Upload Passport</span>
    <form  method="POST" enctype="multipart/form-data">
    <input type="file" class="image form-control" name="image">
    <input type="hidden" value="<?php echo $col_id; ?>" name="id" id="id">
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

                              <div class="col-lg-6">
                              <?php if ($col_image->file_name == TRUE) {
                                  ?>
                             <div class="profile-image"> <img src="<?php echo base_url().$col_image->file_name; ?>" class="img-thumbnail" alt="customer image" style="width: 135px;height: 135px;">
                                      </div>
                              <?php }else{ ?>
                                     <div class="profile-image"> <img src="<?php echo base_url().'assets/img/loan_with.png'; ?>" class="img-thumbnail" alt="customer image" style="width: 135px;height: 135px;">
                                      </div>
                                    <?php } ?>
                            </div>

                            <input type="hidden" name="loan_id"  id="loan_id" value="<?php //echo $loan_attach->loan_id; ?>">
                               
                                </div>
                                 <br>
                                <div class="text-center">
                                
                                <a href="<?php echo base_url("admin/collelateral_session/{$loan_id}"); ?>" class="btn btn-primary"><i class="icon-arrow-left"></i></a>
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
             url:"<?php echo base_url(); ?>admin/update_collateral_data",
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