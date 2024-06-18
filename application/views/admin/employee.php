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
                            <li class="breadcrumb-item active">Employee</li>
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
                            <h2>Register Employee</h2>
                        </div>
                        <div class="body">
                            <?php echo form_open("admin/create_employee") ?>
                            <div class="row">
                                <div class="col-lg-3 form-group-sub">
                                    <label class="form-control-label">*Full name:</label>
                                <input type="text" name="empl_name" placeholder="Full name" autocomplete="off" class="form-control" required>
                                </div>
                                <div class="col-lg-3 form-group-sub">
                                    <label class="form-control-label">*Mobile no:</label>
                                    <input type="number" name="empl_no" placeholder="Phone Number" autocomplete="off" class="form-control" required>
                                </div>
                                <div class="col-lg-3 form-group-sub">
                                    <label class="form-control-label">*Email:</label>
                                    <input type="email" name="empl_email" placeholder="Email" autocomplete="off" class="form-control input-sm" required>
                                </div>
                                <input type="hidden" name="comp_id" value="<?php echo $_SESSION['comp_id']; ?>">
                                <input type="hidden" name="ac_status" value="empl">
                                <div class="col-lg-3 form-group-sub">
                                    <label  class="form-control-label">*Branch:</label>
                            <select type="number" name="blanch_id" class="form-control select2" required class="form-control ">
                                <option value="">Select Blanch</option>
                                <?php foreach ($blanch as $blanchs): ?>
                                <option value="<?php echo $blanchs->blanch_id; ?>"><?php echo $blanchs->blanch_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                                </div>

                                <div class="col-lg-3 form-group-sub">
                                    <label  class="form-control-label">*Position:</label>
                                <select type="text" name="position_id" class="form-control select2" required>
                                <option value="">Select Position</option>
                                <?php foreach ($position as $positions): ?>
                                <option value="<?php echo $positions->position_id; ?>"><?php echo $positions->position; ?></option>
                                <?php endforeach; ?>
                            </select>
                                </div>
                                <input type="hidden" name="position_id" value="1">
                                <div class="col-lg-4 form-group-sub">
                                    <label  class="form-control-label">*Username:</label>
                                <input type="text" name="username" placeholder="Username" autocomplete="off" class="form-control" required>
                                </div>

                                <div class="col-lg-4 form-group-sub">
                                    <label  class="form-control-label">*Sex:</label>
                                <select type="text" name="empl_sex" class="form-control" data-required="true">
                                <option value="">Select Sex</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                             </select>
                                </div>
                                <div class="col-lg-4 form-group-sub">
                                    <label  class="form-control-label">*Salary Amount:</label>
                                <input type="number" name="salary" placeholder="Salary Amount" autocomplete="off" class="form-control input-sm" required>
                                </div>

                                <div class="col-lg-3 form-group-sub">
                                    <label  class="form-control-label">*Payee:</label>
                                <select type="text" name="pays" class="form-control" required>
                                <option value="">Select</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                                </div>
                            <div class="col-lg-3 form-group-sub">
                                    <label  class="form-control-label">*Pay NSSF:</label>
                            <select type="text" name="pay_nssf" class="form-control" required>
                                <option value="">Select</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                                </div>
                                    <div class="col-lg-3 form-group-sub">
                                    <label  class="form-control-label">*Account:</label>
                                <select type="text" name="bank_account" class="form-control" required>
                                <option value="">Select</option>
                                <option value="NMB">NMB</option>
                                <option value="CRDB">CRDB</option>
                                <option value="TPB">TPB</option>
                                <option value="NBC">NBC</option>
                                <option value="EQTY">EQTY</option>
                                <option value="CASH">CASH</option>
                            </select>
                                </div>
                                    <div class="col-lg-3 form-group-sub">
                                    <label  class="form-control-label">*Account Number:</label>
                            <input type="text" name="account_no" placeholder="Account Number" autocomplete="off" class="form-control">
                                </div>
                        <input type="hidden" name="password" value="1234">
                                <br>
                                </div>
                            </div>
                                <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="icon-drawer">Save</i></button>
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


