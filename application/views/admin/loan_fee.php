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
                            <li class="breadcrumb-item active">Loan Fee Setup</li>
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
                <div class="col-md-6">
                    <div class="card">
                        <div class="header">
                            <h2>Add Loan Fee Category</h2>
                        </div>
                        <div class="body">
                            <?php echo form_open("admin/create_loanfee_category") ?>
                            <div class="row">
                               <div class="col-md-12">
                                <div class="form-group">
                                    <label>Loan Fee Category</label>
                                    <select type="text" class="form-control" name="fee_category" required>
                                        <option value="">---Select Loan fee Category---</option>
                                        <option value="LOAN PRODUCT">Loan Fee By Loan Product</option>
                                        <option value="GENERAL">Loan Fee By General</option>
                                    </select>
                                </div>
                                </div>
                                
                                <input type="hidden" name="comp_id" value="<?php echo $_SESSION['comp_id']; ?>">
                                <br>
                                </div>
                                <?php if ($fee_category == TRUE) {
                                 ?>
                                <?php }elseif($fee_category == FALSE){ ?>
                                <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="icon-drawer">Save</i></button>
                                </div>
                                <?php } ?>
                            
                            <?php echo form_close();  ?>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="card">
                         <div class="header">
                            <h2>Loan Fee Category </h2>    
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover j-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                            
                                            <th>Loan Fee Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $no = 1; ?>
                                       <?php foreach ($fee_category as $fee_categorys): ?>
                                        <tr>
                                           
                                            
                                            <td>
                                        <?php if ($fee_categorys->fee_category == 'LOAN PRODUCT') {
                                         ?>
                                         LOAN FEE BY LOAN PRODUCT
                                        <?php }elseif ($fee_categorys->fee_category == 'GENERAL') {
                                         ?>
                                         LOAN FEE BY GENERAL
                                         <?php } ?>
                                                
                                            </td>
                                           
                                            <td>
                                            <a href="" class="btn btn-sm btn-icon btn-pure btn-primary on-default m-r-5 button-edit"
                                            data-toggle="modal" data-target="#addcontact1<?php echo $fee_categorys->id; ?>" data-original-title="Edit"><i class="icon-pencil"></i></a>
                                        </td>
                                        </tr>
    <div class="modal fade" id="addcontact1<?php echo $fee_categorys->id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Edit Loan Fee Category</h6>
            </div>
            <?php echo form_open("admin/modify_loanfee_category/{$fee_categorys->id}"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12">
                     <label>Loan Fee Category</label>
                    <select type="text" class="form-control" name="fee_category" required>
                        <option value="">---Select Loan fee Category---</option>
                        <option value="LOAN PRODUCT">Loan Fee By Loan Product</option>
                        <option value="GENERAL">Loan Fee By General</option>
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

<?php if (@$fee_category_data->fee_category == 'LOAN PRODUCT') {
 ?>
                <div class="col-lg-12">
                    <div class="card">
                         <div class="header">
                            <h2>Loan Fee Category </h2>    
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                            
                                     <th>S/No.</th>
                                    <th>Loan Category name</th>
                                    <th>Loan level</th>
                                    <!-- <th>Loan Return</th> -->
                                    <th>Loan Interest</th>
                                    <th>Loan Fee Type</th>
                                    <th>Loan Fee</th>
                                    <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                                                                
                                            
                                              <?php $no = 1; ?>
                                    <?php foreach ($loan_category as $loan_categorys): ?>
                                              <tr>
                                    <td><?php echo $no++; ?>.</td>
                                    <td><?php echo $loan_categorys->loan_name; ?></td>
                                    <td><?php echo number_format($loan_categorys->loan_price); ?> - <?php echo  number_format($loan_categorys->loan_perday);  ?> </td>
                                    
                                    <td><?php echo $loan_categorys->interest_formular; ?>%</td>
                                    <td>
                                        <?php if ($loan_categorys->fee_category_type =='MONEY') {
                                         ?>
                                         MONEY VALUE
                                        <?php }elseif ($loan_categorys->fee_category_type =='PERCENTAGE') {
                                         ?>
                                         PERCENTAGE VALUE
                                         <?php } ?>
                                        <?php //echo $loan_categorys->fee_category_type; ?>
                                            
                                        </td>
                                    <td>
                                         
                                      <?php if ($loan_categorys->fee_category_type =='MONEY') {
                                         ?>
                                         <?php echo number_format($loan_categorys->fee_value); ?> / Tsh
                                        <?php }elseif ($loan_categorys->fee_category_type =='PERCENTAGE') {
                                         ?>
                                        <?php echo $loan_categorys->fee_value; ?>%
                                         <?php } ?>
                                        
                                    </td>
                                           
                                            <td>
                                            <a href="" class="btn btn-sm btn-icon btn-pure btn-primary on-default m-r-5 button-edit"
                                            data-toggle="modal" data-target="#addcontact2<?php echo $loan_categorys->category_id; ?>" data-original-title="Edit"><i class="icon-pencil"></i></a>
                                        </td>
                                        </tr>
    <div class="modal fade" id="addcontact2<?php echo $loan_categorys->category_id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Edit Loan Fee Category</h6>
            </div>
            <?php echo form_open("admin/update_loanCategory_loanfee/{$loan_categorys->category_id}"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                            <div class="col-lg-3">
                        <label for="recipient-name" class="form-control-label">*Loan Category Name:</label>
                        <input type="text" class="form-control" autocomplete="off" name="loan_name" value="<?php echo $loan_categorys->loan_name; ?>">
                        </div>
                        <div class="col-lg-3">
                         <label for="recipient-name" class="form-control-label">*From:</label>
                        <input type="number" class="form-control" autocomplete="off" name="loan_price" value="<?php echo $loan_categorys->loan_price; ?>">
                         </div>
                         <div class="col-lg-3">
                        <label for="recipient-name" class="form-control-label">*To:</label>
                        <input type="text" class="form-control" autocomplete="off" name="loan_perday" value="<?php echo $loan_categorys->loan_perday; ?>">
                       </div>
                         <div class="col-lg-3">
                        <label for="recipient-name" class="form-control-label">*Loan Interest(%):</label>
                        <input type="number" class="form-control" autocomplete="off" name="interest_formular" value="<?php echo $loan_categorys->interest_formular; ?>">
                    </div>
                    <div class="col-lg-6">
                        <label for="recipient-name" class="form-control-label">*Loan Fee Type:</label>
                        <select type="text" name="fee_category_type" class="form-control">
                            <option value="<?php echo $loan_categorys->fee_category_type; ?>">
                                <?php if ($loan_categorys->fee_category_type == TRUE) {
                                 ?>
                                <?php echo $loan_categorys->fee_category_type; ?>
                            <?php }elseif ($loan_categorys->fee_category_type == FALSE) {
                             ?>
                             ---Select Loan Fee Type---
                             <?php } ?>
                                    
                                </option>
                            <option value="MONEY">MONEY VALUE</option>
                            <option value="PERCENTAGE">PERCENTAGE VALUE</option>
                        </select>
                       </div>

                         <div class="col-lg-6">
                        <label for="recipient-name" class="form-control-label">*Loan Fee:</label>
                        <input type="number" class="form-control" autocomplete="off" name="fee_value" value="<?php echo $loan_categorys->fee_value; ?>">
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

 <?php }elseif (@$fee_category_data->fee_category == 'GENERAL') {
 ?>
                   <div class="col-md-6">
                    <div class="card">
                        <div class="header">
                            <h2>Add Loan Fee Type</h2>
                        </div>
                        <div class="body">
                            <?php echo form_open("admin/create_loanfee_type") ?>
                            <div class="row">
                               <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Loan Fee Type*:</label>
                                    <select type="text" name="type" class="form-control" required>
                                        <option value="">---Select Loan fee Type---</option>
                                        <option value="MONEY VALUE">MONEY VALUE</option>
                                        <option value="PERCENTAGE VALUE">PERCENTAGE VALUE</option>
                                    </select>
                                </div>
                                </div>
                                
                                <input type="hidden" name="comp_id" value="<?php echo $_SESSION['comp_id']; ?>">
                                <br>
                                </div>
                                <?php if ($fee_type == TRUE) {
                                 ?>
                                <?php }elseif($fee_type == FALSE){ ?>
                                <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="icon-drawer">Save</i></button>
                                </div>
                                <?php } ?>
                            
                            <?php echo form_close();  ?>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="card">
                         <div class="header">
                            <h2>Loan Fee Type </h2>    
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover j-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                            
                                            <th>Loan Fee Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $no = 1; ?>
                                       <?php foreach ($fee_data as $fee_types): ?>
                                              <tr>
                                    <td><?php echo $fee_types->type; ?></td>
                                           
                                            <td>
                                            <a href="" class="btn btn-sm btn-icon btn-pure btn-primary on-default m-r-5 button-edit"
                                            data-toggle="modal" data-target="#addcontact1<?php echo $fee_types->id; ?>" data-original-title="Edit"><i class="icon-pencil"></i></a>
                                        </td>
                                        </tr>
    <div class="modal fade" id="addcontact1<?php echo $fee_types->id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Edit Loan Fee Type</h6>
            </div>
            <?php echo form_open("admin/modify_loanfee_type/{$fee_types->id}"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12">
                      <label>Loan Fee Type:</label>
                       <select type="text" name="type" class="form-control" required>
                        <option value="<?php echo $fee_types->type; ?>"><?php echo $fee_types->type; ?></option>
                        <option value="MONEY VALUE">MONEY VALUE</option>
                        <option value="PERCENTAGE VALUE">PERCENTAGE VALUE</option>
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


                  <div class="col-md-6">
                    <div class="card">
                        <div class="header">
                            <h2>Add Loan Fee </h2>
                        </div>
                        <div class="body">
                            <?php echo form_open("admin/create_loan_fee") ?>
                            <div class="row">
                               <div class="col-lg-6 form-group-sub">
                                    <label class="form-control-label">*Description:</label>
                                    <input type="text" placeholder="Description" class="form-control" name="description" required autocomplete="off">
                                </div>
                                
                                <input type="hidden" name="comp_id" value="<?php echo $_SESSION['comp_id']; ?>">
                                <div class="col-lg-6 form-group-sub">
                                    <?php if (@$fee_type->type == 'MONEY VALUE') {
                                     ?>
                                     <label  class="form-control-label">*Loan Fee in (Tsh):</label>
                                    <input type="text" required class="form-control" placeholder="Loan Fee in (Tsh)" name="fee_interest" autocomplete="off" >
                                    <?php }elseif (@$fee_type->type == 'PERCENTAGE VALUE') {
                                     ?>
                                    <label  class="form-control-label">*Loan Fee in (%):</label>
                                    <input type="text" required class="form-control" placeholder="Loan Fee in (%)" name="fee_interest" autocomplete="off" >
                                    <?php }else{ ?>
                                    <label  class="form-control-label">*Loan Fee:</label>
                                    <input type="text" required class="form-control" required readonly placeholder="Loan Fee" name="" autocomplete="off" >
                                    <?php } ?>
                                </div>
                                <br>
                                </div>
                                <br>
                                <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="icon-drawer">Save</i></button>
                                </div>
                            
                            <?php echo form_close();  ?>
                        </div>
                    </div>
                </div>



                <div class="col-lg-6">
                    <div class="card">
                         <div class="header">
                            <h2>Loan Fee </h2>    
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover j-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                            
                                           <th>Description</th>
                                                <th>Loan Fee In 
                                        <?php if (@$fee_type->type == 'MONEY VALUE') {
                                         ?>
                                         Tsh
                                        <?php }elseif (@$fee_type->type == 'PERCENTAGE VALUE') {
                                         ?>
                                           %
                                        <?php }else{ ?>

                                            <?php } ?></th>
                                        <th>Action</th> 
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                       <?php foreach ($loan_fee as $loan_fees): ?>
                                              <tr>
                                    <td><?php echo $loan_fees->description; ?></td>
                                    <td>
                                          
                                        <?php if (@$fee_type->type == 'MONEY VALUE') {
                                         ?>
                                        <?php echo number_format($loan_fees->fee_interest); ?> / Tsh
                                        <?php }elseif (@$fee_type->type == 'PERCENTAGE VALUE') {
                                         ?>
                                        <?php echo $loan_fees->fee_interest; ?> %
                                        <?php }else{ ?>

                                            <?php } ?>
                                    </td>
                                           
                                            <td>
                                            <a href="" class="btn btn-sm btn-icon btn-pure btn-primary on-default m-r-5 button-edit"
                                            data-toggle="modal" data-target="#addcontact3<?php echo $loan_fees->fee_id; ?>" data-original-title="Edit"><i class="icon-pencil"></i></a>
                                            <a href="<?php echo base_url("admin/delete_loan_fee/{$loan_fees->fee_id}") ?>" class="btn btn-sm btn-icon btn-pure btn-danger on-default button-remove"
                                            data-toggle="tooltip" data-original-title="Remove" onclick="return confirm('Are You Sure?')"><i class="icon-trash" aria-hidden="true"></i></a>
                                        </td>
                                        </tr>
    <div class="modal fade" id="addcontact3<?php echo $loan_fees->fee_id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Edit Loan Fee</h6>
            </div>
            <?php echo form_open("admin/modify_loan_fee/{$loan_fees->fee_id}"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12">
                       <label for="recipient-name" class="form-control-label">Description:</label>
                        <input type="text" class="form-control" autocomplete="off" name="description" value="<?php echo $loan_fees->description; ?>">
                        
                         <label for="recipient-name" class="form-control-label">Loan Fee in
                          <?php if (@$fee_type->type == 'MONEY VALUE') {
                                         ?>
                                         Tsh
                                        <?php }elseif (@$fee_type->type == 'PERCENTAGE VALUE') {
                                         ?>
                                           %
                                        <?php }else{ ?>

                                            <?php } ?>:</label>
                        <input type="text" class="form-control" autocomplete="off" name="fee_interest" value="<?php echo $loan_fees->fee_interest; ?>">
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



 <?php }else{ ?>


    <?php } ?>


             
            </div>
        </div>
    </div>
</div>

<?php include('incs/footer.php'); ?>


