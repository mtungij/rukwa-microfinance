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
                            <li class="breadcrumb-item active">Branch</li>
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
                            <h2>Register Branch</h2>
                        </div>
                        <div class="body">
                            <?php echo form_open("admin/create_blanch") ?>
                            <div class="row">
                               <div class="col-md-4">
                                    <span>* Branch name:</span>
                                    <input type="text" placeholder="Branch name" class="form-control" name="blanch_name" required autocomplete="off">
                                </div>
                                <div class="col-md-4">
                                    <span>* Branch region:</span>
                                    <select type="number" class="form-control select2" name="region_id" required>
                                        <option value="">Select Region</option>
                                        <?php foreach ($region as $regions): ?>
                                        <option value="<?php echo $regions->region_id; ?>"><?php echo $regions->region_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <input type="hidden" name="comp_id" value="<?php echo $_SESSION['comp_id']; ?>">
                                <div class="col-md-4">
                                    <span>* Branch Phone Number:</span>
                                    <input type="number" required class="form-control" placeholder="Blanch phone number" name="blanch_no" placeholder="" value="">
                                </div>
                               
                                </div>
                                 <br>
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
                            <h2>Branch List </h2>    
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                            <th>S/No.</th>
                                            <th>Branch Name</th>
                                            <th>Branch Phone Number</th>
                                            <th>Branch region</th>
                                            <th>Customer Status</th>
                                            <th>status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                              <?php $no = 1; ?>
                                    <?php foreach ($blanch as $blanchs): ?>
                                        <?php
                                         $active_customer = $this->queries->get_customer_active($blanchs->blanch_id);
                                         $pending_customer = $this->queries->get_customer_pending($blanchs->blanch_id);
                                         $out_customer = $this->queries->get_customer_out($blanchs->blanch_id);
                                         $close_customer = $this->queries->get_customer_closed($blanchs->blanch_id);
                                         $all_customer = $this->queries->get_customer_All_blanch($blanchs->blanch_id);
                                          ?>
                                        <?php //print_r($active_customer); ?>
                                              <tr>
                                    <td><?php echo $no++; ?>.</td>
                                    <td><?php echo $blanchs->blanch_name; ?></td>
                                    <td><?php echo $blanchs->blanch_no; ?></td>
                                    <td><?php echo $blanchs->region_name; ?></td>
                                     <td>Active:<a href="javascript:;" class="badge badge-success"><?php echo count($active_customer); ?></a> Pending: <a href="javascript:;" class="badge badge-warning"><?php echo count($pending_customer); ?></a> Default: <a href="javascript:;" class="badge badge-danger"><?php echo count($out_customer); ?></a> Done:<a href="javascript:;" class="badge badge-info"><?php echo count($close_customer); ?></a> All::<a href="javascript:;" class="badge badge-secondary"><?php echo count($all_customer); ?></a> </td>
                                    <td><a href="#" class="badge badge-success ">Active</a></td>
                                <td>
                                      <a href="" class="btn btn-sm btn-icon btn-pure btn-primary on-default m-r-5 button-edit"
                                            data-toggle="modal" data-target="#addcontact1<?php echo $blanchs->blanch_id; ?>" data-original-title="Edit"><i class="icon-pencil"></i>
                                        </a>
                                       <!--  <a href="<?php //echo base_url("admin/view_blanch_customer/{$blanchs->blanch_id}") ?>" class="btn btn-sm btn-icon btn-pure btn-primary on-default m-r-5 button-edit" data-original-title="Edit"><i class="icon-eye"></i>
                                        </a> -->
                                            <a href="<?php echo base_url("admin/delete_blanch/{$blanchs->blanch_id}") ?>" class="btn btn-sm btn-icon btn-pure btn-danger on-default m-r-5 button-edit" data-original-title="Delete" onclick="return confirm('Are You Sure?')"><i class="icon-trash"></i>
                                        </a>
                                </td>                                                                                   
</tr>
    <div class="modal fade" id="addcontact1<?php echo $blanchs->blanch_id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Edit Branch</h6>
            </div>
            <?php echo form_open("admin/modify_blanch/{$blanchs->blanch_id}"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-4">
                                    <span>* Branch name:</span>
                                    <input type="text" placeholder="Branch name" value="<?php echo $blanchs->blanch_name; ?>" class="form-control" name="blanch_name" required autocomplete="off">
                                </div>
                                <div class="col-md-4">
                                    <span>* Branch region:</span>
                                    <select type="number" class="form-control" name="region_id" required>
                                        <option value="<?php echo $blanchs->region_id; ?>"><?php echo $blanchs->region_name; ?></option>
                                        <?php foreach ($region as $regions): ?>
                                        <option value="<?php echo $regions->region_id; ?>"><?php echo $regions->region_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <span>* Branch Phone Number:</span>
                                    <input type="number" required class="form-control" value="<?php echo $blanchs->blanch_no; ?>" placeholder="Blanch phone number" name="blanch_no" placeholder="" value="">
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


