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
                            <li class="breadcrumb-item active">Loan Category</li>
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
                            <h2>Loan Category/Product Form</h2>
                        </div>
                        <div class="body">
                            <?php echo form_open("admin/create_loanCategory") ?>
                            <div class="row">
                               <div class="col-md-4">
                                <div class="form-group">
                                    <label>Loan Product name</label>
                                    <input type="text" name="loan_name" autocomplete="off" class="form-control" placeholder="Enter Loan Product Name" required>
                                </div>
                                </div>
                                <div class="col-md-2">
                                <div class="form-group">
                                    <label>From</label>
                                    <input type="number" name="loan_price" autocomplete="off" class="form-control" placeholder="Eg.100000" required>
                                </div>
                                </div>
                                 <div class="col-md-2">
                                <div class="form-group">
                                    <label>To</label>
                                    <input type="number" name="loan_perday" autocomplete="off" class="form-control" placeholder="Eg.1000000" required>
                                </div>
                                </div>
                                <input type="hidden" name="comp_id" value="<?php echo $_SESSION['comp_id']; ?>">
                                  <div class="col-md-4">
                                <div class="form-group">
                                    <label>Laon Interest(%)</label>
                                    <input type="text" name="interest_formular" autocomplete="off" class="form-control" placeholder="Enter Loan Enterest(%)" required>
                                </div>
                                </div>
                                <br>
                                </div>
                                <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="icon-drawer">Save</i></button>
                                </div>
                            
                            <?php echo form_close();  ?>
                        </div>
                    </div>
                </div>


                <div class="col-lg-12">
                    <div class="card">
                         <div class="header">
                            <h2>Loan Category/Product List </h2>    
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                            <th>S/No.</th>
                                            <th>Loan Category/Product</th>
                                            <th>Loan Level</th>
                                            <th>Loan Interest</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($loan_category as $loan_categorys): ?>
                                        <tr>
                                            <td><?php echo $no++; ?>.</td>
                                            <td><?php echo $loan_categorys->loan_name; ?></td>
                                            <td><?php echo number_format($loan_categorys->loan_price); ?> - <?php echo  number_format($loan_categorys->loan_perday);  ?></td>
                                            <td><?php echo $loan_categorys->interest_formular; ?>%</td>
                                            <td>
                                            <a href="" class="btn btn-sm btn-icon btn-pure btn-primary on-default m-r-5 button-edit"
                                            data-toggle="modal" data-target="#addcontact1<?php echo $loan_categorys->category_id; ?>" data-original-title="Edit"><i class="icon-pencil"></i></a>
                                            <a href="<?php echo base_url("admin/delete_loancategory/{$loan_categorys->category_id}") ?>" class="btn btn-sm btn-icon btn-pure btn-danger on-default button-remove"
                                            data-toggle="tooltip" data-original-title="Remove" onclick="return confirm('Are You Sure?')"><i class="icon-trash" aria-hidden="true"></i></a>
                                        </td>
                                        </tr>
    <div class="modal fade" id="addcontact1<?php echo $loan_categorys->category_id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Edit Loan Product</h6>
            </div>
            <?php echo form_open("admin/update_loanCategory/{$loan_categorys->category_id}"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-4">
                        <span>Loan Category Name</span>
                        <input type="text" class="form-control" autocomplete="off" name="loan_name" value="<?php echo $loan_categorys->loan_name; ?>">
                    </div>
                     <div class="col-md-2">
                        <span>From</span>
                        <input type="number" class="form-control" autocomplete="off" name="loan_price" value="<?php echo $loan_categorys->loan_price; ?>">
                    </div>
                     <div class="col-md-2">
                        <span>To</span>
                        <input type="number" class="form-control" autocomplete="off" name="loan_perday" value="<?php echo $loan_categorys->loan_perday; ?>">
                    </div>
                     <div class="col-md-4">
                        <span>Loan Interest(%)</span>
                        <input type="text" class="form-control" autocomplete="off" name="interest_formular" value="<?php echo $loan_categorys->interest_formular; ?>">
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


