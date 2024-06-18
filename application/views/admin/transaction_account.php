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
                            <li class="breadcrumb-item active">Account Transaction</li>
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
                            <h2>Account Transaction Form</h2>
                        </div>
                        <div class="body">
                            <?php echo form_open("admin/create_account_transaction") ?>
                            <div class="row">
                               <div class="col-md-12">
                                <div class="form-group">
                                    <label>Account name</label>
                                    <input type="text" name="account_name" autocomplete="off" class="form-control" placeholder="Enter Eg,CASH,M-PESA,NMB" required>
                                </div>
                                </div>
                             
                               
                                <input type="hidden" name="comp_id" value="<?php echo $_SESSION['comp_id']; ?>">
                                  <div class="col-md-4">
                                
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
                            <h2>Account List </h2>    
                             </div>
                          <div class="body">
                            <div class="table-responsive">

                                
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                            <th>S/No.</th>
                                            <th>Account Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $no = 1; ?>
                                       <?php foreach ($account as $accounts): ?>
                                        <tr>
                                            <td><?php echo $no++; ?>.</td>
                                            <td><?php echo $accounts->account_name; ?></td>
                                            <td>
                                            <a href="" class="btn btn-sm btn-icon btn-pure btn-primary on-default m-r-5 button-edit"
                                            data-toggle="modal" data-target="#addcontact1<?php echo $accounts->trans_id; ?>" data-original-title="Edit"><i class="icon-pencil"></i></a>
                                        </td>
                                        </tr>
    <div class="modal fade" id="addcontact1<?php echo $accounts->trans_id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Edit Account Name</h6>
            </div>
            <?php //echo form_open("admin/update_loanCategory/{$loan_categorys->category_id}"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <span>Account Name</span>
                        <input type="text" class="form-control" autocomplete="off" name="loan_name" value="<?php echo $accounts->account_name; ?>">
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


