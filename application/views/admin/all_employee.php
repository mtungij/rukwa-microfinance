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
                            <li class="breadcrumb-item active">All Employee</li>
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
                            <h2>Employee List </h2> 
                            <div class="pull-right">
                               <a href="<?php echo base_url("admin/unblock_allEmployee"); ?>" class="btn btn-success btn-sm">Un-block All</a> 
                               <a href="<?php echo base_url("admin/block_allEmployee"); ?>" class="btn btn-danger btn-sm">Block All</a> 
                            </div>   
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                        <th>S/No.</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Phone number</th>
                                        <th>Branch</th>
                                        <th>Salary Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $no = 1; ?>
                                                    <?php foreach($all_employee  as $employees): ?>
                                              <tr>
                                    <td><?php echo $no++; ?>.</td>
                                    <td><?php echo $employees->empl_name ?></td>
                                    <td><?php echo $employees->username ?></td>
                                    <td><?php echo $employees->empl_no; ?></td>
                                    <td><?php echo $employees->blanch_name; ?></td>
                                        <td><?php echo number_format($employees->salary); ?></td>
                                        <td>
                                            <?php if ($employees->empl_status == 'open') {
                                         ?>
                                         <a href="javascript:;" class="badge badge-success">Active</a>
                                        <?php }elseif ($employees->empl_status == 'close') {
                                         ?>
                                         <a href="javascript:;" class="badge badge-danger">Blocked</a>
                                         <?php } ?>
                                        </td>
                                            <td>
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item" href=""data-toggle="modal" data-target="#addcontact1<?php echo $employees->empl_id; ?>"><i class="icon-eye">view</i></a>
                    <?php if ($employees->empl_status == 'open') {
                     ?>
            <a class="dropdown-item" href="<?php echo base_url("admin/block_employee/{$employees->empl_id}") ?>"><i class="icon-key">Block</i></a>

                     <?php }elseif($employees->empl_status == 'close'){ ?>

           <a class="dropdown-item" href="<?php echo base_url("admin/Unblock_employee/{$employees->empl_id}") ?>"><i class="icon-key">UnBlock</i></a>
                    <?php }  ?>
                   
                    <a class="dropdown-item" href="<?php echo base_url("admin/privillage/{$employees->empl_id}"); ?>"><i class="icon-key">User privillage</i></a>
                     <a class="dropdown-item" href="<?php echo base_url("admin/delete_employee/{$employees->empl_id}") ?>" onclick="return confirm('Are you sure?')"><i class="icon-trash">Delete</i></a>
                    </div>
                </div>
                </div>


                                        </td>
                                        </tr>
    <div class="modal fade" id="addcontact1<?php echo $employees->empl_id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">View Employee (<?php echo $employees->empl_name; ?>)</h6>
            </div>
            <?php echo form_open("admin/modify_employee/{$employees->empl_id}"); ?>
            <div class="modal-body">
                <div class="row clearfix">

                                <div class="col-lg-4 form-group-sub">
                                    <label class="form-control-label">*Full name:</label>
                                    <input type="text" name="empl_name" placeholder="" autocomplete="off" value="<?php echo $employees->empl_name; ?>" class="form-control input-sm" required>
                                </div>
                                <div class="col-lg-4 form-group-sub">
                                    <label class="form-control-label">*Mobile No:</label>
                                    <input type="number" name="empl_no" placeholder="Amount" autocomplete="off" value="<?php echo $employees->empl_no; ?>" class="form-control input-sm" required>
                                </div>

                                <div class="col-lg-4 form-group-sub">
                                    <label class="form-control-label">*Email:</label>
                                    <input type="email" name="empl_email" placeholder="Email" autocomplete="off" value="<?php echo $employees->empl_email; ?>" class="form-control input-sm" required>
                                </div>
                                
                                <div class="col-lg-4 form-group-sub">
                                    <label  class="form-control-label">*Branch:</label>
                            <select type="number" name="blanch_id" class="form-control input-sm" required>
                                <option value="<?php echo $employees->blanch_id; ?>"><?php echo $employees->blanch_name; ?></option>
                                <?php foreach ($blanch as $blanchs): ?>
                                <option value="<?php echo $blanchs->blanch_id ?>"><?php echo $blanchs->blanch_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                                </div>
                                 <div class="col-lg-4 form-group-sub">
                                    <label  class="form-control-label">*Position:</label>
                            <select type="number" name="position_id" class="form-control input-sm" required>
                                <option value="<?php echo $employees->position_id; ?>"><?php echo $employees->position; ?></option>
                                <?php foreach ($position as $positions): ?>
                                <option value="<?php echo $positions->position_id ?>"><?php echo $positions->position; ?></option>
                                <?php endforeach; ?>
                            </select>
                                </div>
                                <!-- <input type="hidden" name="position_id" value="1"> -->

                                <div class="col-lg-4 form-group-sub">
                                    <label  class="form-control-label">*Username:</label>
                                <input type="text" name="username" placeholder="Cheque number" autocomplete="off" value="<?php echo $employees->username; ?>" class="form-control input-sm" >
                                </div>

                                <div class="col-lg-4 form-group-sub">
                                    <label  class="form-control-label">*Sex:</label>
                                <select type="text" name="empl_sex" class="form-control">
                                    <option value="<?php echo $employees->empl_sex; ?>"><?php echo $employees->empl_sex; ?></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>   
                                </div>

                                <div class="col-lg-4 form-group-sub">
                                    <label  class="form-control-label">*Salary Amount:</label>
                                <input type="number" name="salary" placeholder="Cheque number" autocomplete="off" value="<?php echo $employees->salary; ?>" class="form-control input-sm" >
                                </div>
                                <div class="col-lg-4 form-group-sub">
                                    <label  class="form-control-label">*Payee:</label>
                                <select type="text" name="pays" class="form-control">
                                    <option value="<?php echo $employees->pays; ?>"><?php echo $employees->pays; ?></option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                </div>
                                <div class="col-lg-4 form-group-sub">
                                    <label  class="form-control-label">*Pay NSSF:</label>
                                <select type="text" name="pay_nssf" class="form-control">
                                    <option value="<?php echo $employees->pay_nssf; ?>"><?php echo $employees->pay_nssf; ?></option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                </div>

                                <div class="col-lg-4 form-group-sub">
                                    <label  class="form-control-label">*Bank Account:</label>
                                <select type="text" name="bank_account" class="form-control input-sm" required>
                                <option value="<?php echo $employees->bank_account; ?>"><?php echo $employees->bank_account; ?></option>
                                <option value="NMB">NMB</option>
                                <option value="CRDB">CRDB</option>
                                <option value="TPB">TPB</option>
                                <option value="NBC">NBC</option>
                                <option value="EQTY">EQTY</option>
                            </select>
                                </div>

                                <div class="col-lg-4 form-group-sub">
                            <label  class="form-control-label">*Account Number:</label>
                            <input type="text" name="account_no" value="<?php echo $employees->account_no;  ?>" placeholder="Account Number" autocomplete="off" class="form-control input-sm" required>
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


