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
        <li class="breadcrumb-item active">Loan</li>
        <li class="breadcrumb-item active">Collateral Session</li>
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
        <h2>Add Collateral</h2>
    </div>
    <div class="body">
        <?php echo form_open("admin/create_colateral/{$loan_attach->loan_id}") ?>
        <div class="row">
            <div class="col-lg-6">
        <div class="form-group">
          <span>Name:</span>
            <input type="text" class="form-control" id="description" placeholder="Enter Name" name="description" autocomplete="off">
        </div>
        </div>
        <div class="col-lg-6">
        <div class="form-group">
          <span>Condition:</span>
            <input type="text" class="form-control" id="" placeholder="Enter Condition" name="co_condition" autocomplete="off">
        </div>
        </div>

        <div class="col-lg-12">
        <div class="form-group">
          <span>Cullent colateral Value:</span>
            <input type="number" class="form-control" id="" placeholder="Enter value" name="value" autocomplete="off">
        </div>
        </div>


        <input type="hidden" name="loan_id"  id="loan_id" value="<?php echo $loan_attach->loan_id; ?>">
           
            </div>
             <br>
            <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="icon-drawer">Save</i></button>
            <a href="<?php echo base_url("admin/local_government/{$loan_attach->loan_id}"); ?>" class="btn btn-primary">Next</a>
            </div>
        <?php echo form_close();  ?>
    </div>
</div>
</div>


<div class="col-lg-12">
<div class="card">
     <div class="header">
        <h2> Collateral List</h2>    
         </div>
      <div class="body">
        <div class="table-responsive">
            <table class="table table-hover js-basic-example dataTable table-custom">
                <thead class="thead-primary">
                    <tr>
                      <th>S/No.</th>
                        <th>Colateral Name</th>
                        <th>Colateral Condition</th>
                        <th>Colateral Value</th>
                        <th>Colateral Picture</th>
                        <th>Action</th>
                    </tr>
                </thead>
               
                <tbody>
                          <?php $no = 1; ?>
              <?php foreach ($collateral as $collaterals): ?>
                          <tr>
                <td><?php echo $no++; ?>.</td>
                <td><?php echo $collaterals->description; ?></td>
                <td><?php echo $collaterals->co_condition; ?></td>
                <td><?php echo number_format($collaterals->value); ?></td>
                <td>
                    <div class="profile-image"><a href="<?php echo base_url("admin/view_collateral_photo/{$collaterals->col_id}/{$collaterals->loan_id}") ?>"  data-target="#addcontact2<?php echo $collaterals->col_id; ?>"> <img src="<?php echo base_url().$collaterals->file_name; ?>" class="img-thumbnail" alt="Collateral image" style="width: 80px;height: 80px;"></a>
                  </div>
                   
                </td>
            <td>
                  <a href="" class="btn btn-sm btn-icon btn-pure btn-primary on-default m-r-5 button-edit"
                        data-toggle="modal" data-target="#addcontact1<?php echo $collaterals->col_id; ?>" data-original-title="Edit"><i class="icon-pencil"></i>
                    </a>
                   
                        <a href="<?php echo base_url("admin/delete_colateral/{$collaterals->loan_id}/{$collaterals->col_id}") ?>" class="btn btn-sm btn-icon btn-pure btn-danger on-default m-r-5 button-edit" data-original-title="Delete" onclick="return confirm('Are You Sure?')"><i class="icon-trash"></i>
                    </a>
            </td>                                                                                   
</tr>
<div class="modal fade" id="addcontact1<?php echo $collaterals->col_id; ?>" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h6 class="title" id="defaultModalLabel">Edit colateral</h6>
</div>
<?php echo form_open("admin/modify_colateral/{$collaterals->loan_id}/{$collaterals->col_id}"); ?>
<div class="modal-body">
<div class="row clearfix">
          <div class="col-md-6">
                <label for="recipient-name" class="form-control-label">*Name:</label>
         <input type="text" class="form-control" autocomplete="off" name="description" value="<?php echo $collaterals->description; ?>">
            </div>
            <div class="col-md-6">
        <label for="recipient-name" class="form-control-label">*Condition:</label>
     <input type="text" class="form-control" autocomplete="off" name="co_condition" value="<?php echo $collaterals->co_condition; ?>">
            </div>
            <div class="col-md-12">
               <label for="recipient-name" class="form-control-label">*Value:</label>
          <input type="text" class="form-control" autocomplete="off" name="value" value="<?php echo $collaterals->value; ?>">
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


<div class="modal fade" id="addcontact2<?php echo $collaterals->col_id; ?>" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h6 class="title" id="defaultModalLabel">Edit colateral Photo</h6>
</div>
<?php echo form_open_multipart("admin/modify_colateral_picture/{$collaterals->loan_id}/{$collaterals->col_id}"); ?>
<div class="modal-body">
<div class="row clearfix">
          <div class="col-md-6">
                <label for="recipient-name" class="form-control-label">*picture:</label>
         <input type="file" class="form-control" autocomplete="off" name="file_name">
            </div>
            <div class="col-md-6">
             <img src="<?php echo base_url().'assets/img/'.$collaterals->file_name; ?>" class="img-thumbnail" alt="Collateral image" style="width: 120px;height: 120px;">
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


