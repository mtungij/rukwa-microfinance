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
                            <li class="breadcrumb-item active">Commnication</li>
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
                            <h2>SMS Settup Group </h2>
                            <div class="pull-right">
                            <a href="" class="btn btn-sm btn-icon btn-pure btn-primary on-default m-r-5 button-edit"
                            data-toggle="modal" data-target="#addcontact2" data-original-title="Add"><i class="icon-settings"></i>
                        </a>
                          <a href="" class="btn btn-sm btn-icon btn-pure btn-primary on-default m-r-5 button-edit"
                            data-toggle="modal" data-target="#addcontact5" data-original-title="Add"><i class="icon-envelope"></i>
                        </a>   
                            </div>    
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                            <th>S/No.</th>
                                            <th>Massage Description</th>
                                            <th>Group</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $no = 1; ?>
                                <?php foreach ($sms_reminder as $sms_reminders): ?>
                                        <tr>
                                            <td><?php echo $no++; ?>.</td>
                                            <td><?php echo $sms_reminders->description; ?></td>
                                            <td><?php if ($sms_reminders->sms_type == 'all') {
                                         ?>
                                         All Customer
                                        <?php }elseif ($sms_reminders->sms_type == 'open') {
                                         ?>
                                         Active Customer
                                        <?php }elseif ($sms_reminders->sms_type == 'out') {
                                         ?>
                                         Default Customer
                                        <?php }elseif ($sms_reminders->sms_type == 'close') {
                                         ?>
                                         Repayment Customer
                                        <?php }elseif ($sms_reminders->sms_type == 'staff') {
                                         ?>
                                         Staff
                                         <?php } ?></td>
                                            <td>
                                            <a href="" class="btn btn-sm btn-icon btn-pure btn-primary on-default m-r-5 button-edit"
                                            data-toggle="modal" data-target="#addcontact1<?php echo $sms_reminders->id; ?>" data-original-title="Edit"><i class="icon-pencil"></i></a>
                                          
                                            <a href="<?php echo base_url("admin/delete_sms_reminder/{$sms_reminders->id}") ?>" class="btn btn-sm btn-icon btn-pure btn-danger on-default button-remove"
                                            data-toggle="tooltip" data-original-title="Remove" onclick="return confirm('Are You Sure?')"><i class="icon-trash" aria-hidden="true"></i></a>
                                        </td>
                                        </tr>
    <div class="modal fade" id="addcontact1<?php echo $sms_reminders->id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Edit Massage</h6>
            </div>
            <?php echo form_open("admin/update_sms_setup/{$sms_reminders->id}"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12 col-12">
                        <span>Massage Description:(limit 160 Characters)</span>
                        <textarea type="text" class="form-control" rows="4" placeholder="Enter Massage Description" autocomplete="off" name="description" required><?php echo $sms_reminders->description; ?></textarea>
                    </div>
                    <div class="col-md-12 col-12">
                        <span>Select SMS Group</span>
                        <select type="number" class="form-control" name="sms_type" required>
                            <option value="<?php echo $sms_reminders->sms_type; ?>">
                                <?php if ($sms_reminders->sms_type == 'all') {
                                         ?>
                                         All Customer
                                        <?php }elseif ($sms_reminders->sms_type == 'open') {
                                         ?>
                                         Active Customer
                                        <?php }elseif ($sms_reminders->sms_type == 'out') {
                                         ?>
                                         Default Customer
                                        <?php }elseif ($sms_reminders->sms_type == 'close') {
                                         ?>
                                         Repayment Customer
                                        <?php }elseif ($sms_reminders->sms_type == 'staff') {
                                         ?>
                                         Staff
                                         <?php } ?>
                            </option>
                            <option value="all">All Customer</option>
                            <option value="withdrawal">Active Customer</option>
                            <option value="out">Default Customer</option>
                            <option value="done">Repayment Customer</option>
                            <option value="staff">Staff</option>
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
                <h6 class="title" id="defaultModalLabel">Reminder Sms Settup</h6>
            </div>
            <?php echo form_open("admin/create_sms_setup"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12 col-12">
                        <span>Massage Description:(limit 160 Characters)</span>
                        <textarea type="text" class="form-control" rows="4" placeholder="Enter Massage Description" autocomplete="off" name="description" required></textarea>
                    </div>
                    <div class="col-md-12 col-12">
                        <span>Select SMS Group</span>
                        <select type="number" class="form-control" name="sms_type" required>
                            <option value="">---Select Group---</option>
                            <option value="all">All Customer</option>
                            <option value="open">Active Customer</option>
                            <option value="out">Default Customer</option>
                            <option value="close">Repayment Customer</option>
                            <option value="staff">Staff</option>
                        </select>
                    </div>
                   <input type="hidden" name="comp_id" value="<?php echo $_SESSION['comp_id']; ?>"> 
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


<div class="modal fade" id="addcontact5" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Send SMS</h6>
            </div>
            <?php echo form_open("admin/send_sms_reminder"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12 col-12">
                        <span>Select SMS Group</span>
                        <select type="number" class="form-control" name="sms_type" required>
                            <option value="">---Select Group---</option>
                            <option value="all">All Customer</option>
                            <option value="open">Active Customer</option>
                            <option value="out">Default Customer</option>
                            <option value="close">Repayment Customer</option>
                            <option value="staff">Staff</option>
                        </select>
                    </div>
                   <input type="hidden" name="comp_id" value="<?php echo $_SESSION['comp_id']; ?>"> 
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="icon-envelope"></i>Send</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>











