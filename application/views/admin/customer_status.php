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
                            <li class="breadcrumb-item active">All Customer</li>
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
                            <h2>All Customer </h2>
                            <div class="pull-right">
                               <a href="" class="btn btn-primary" data-toggle="modal" data-target="#addcontact2"><i class="icon-pencil">Filter</i></a> 
                            </div>    
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover j-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                            <th>Branch</th>
                                            <th>Customer ID</th>
                                            <th>customer name</th>
                                            <th>Date of Birth</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Phone number</th>
                                            <th>District</th>
                                            <th>Ward</th>
                                            <th>Street</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach($customer_statusData  as $customers): ?>
                                        <tr>
                                            <td><b><?php echo $customers->blanch_name; ?></b></td>
                                            <td><?php //echo $customers->f_name; ?> <?php //echo $customers->m_name; ?> <?php //echo $customers->l_name; ?></td>
                                            <td><?php //echo $customers->date_birth; ?></td>
                                            <td><?php //if ($customers->age == TRUE) {
                                             ?>
                                             <?php //echo $customers->age; ?>
                                            <?php //}else{ ?>
                                                
                                              <?php //} ?>
                                            </td>
                                            <td><?php //echo $customers->gender; ?></td>
                                            <td><?php //echo $customers->phone_no; ?></td>
                                            <td><?php //echo $customers->blanch_name; ?></td>
                                            <td><?php //echo $customers->district; ?></td>
                                            <td><?php //echo $customers->ward; ?></td>
                                            <td><?php //echo $customers->street; ?></td>
                                            <td>
                                            
                                            </td>
                                            <td>
                                            
                                        </td>
                                        </tr>
                                <?php $blanch_customer = $this->queries->get_customer_blanch_data($customers->blanch_id,$customers->customer_status); ?>

                                <?php //print_r($blanch_customer); ?>
                                      <?php foreach ($blanch_customer as $blanch_customers): ?>
                                        <tr>
                                            <td><?php //echo $customers->blanch_name; ?></td>
                                            <td><?php echo $blanch_customers->customer_code; ?></td>
                                            <td><?php echo $blanch_customers->f_name; ?> <?php echo $blanch_customers->m_name; ?> <?php echo $blanch_customers->l_name; ?></td>
                                            <td><?php echo $blanch_customers->date_birth; ?></td>

                                            <td>
                                            <?php if ($blanch_customers->age == TRUE) {
                                             ?>
                                             <?php echo $blanch_customers->age; ?>
                                            <?php }else{ ?>
                                                -
                                              <?php } ?>
                                            </td>
                                            <td><?php echo $blanch_customers->gender; ?></td>
                                            <td><?php echo $blanch_customers->phone_no; ?></td>
                                            <td><?php echo $blanch_customers->district; ?></td>
                                            <td><?php echo $blanch_customers->ward; ?></td>
                                            <td><?php echo $blanch_customers->street; ?></td>
                                            
                                            <td>
                                                <?php if ($blanch_customers->customer_status == 'open') {
                                             ?>
                                             <a href="#" class="badge badge-success">Active</a>
                                            <?php }elseif ($blanch_customers->customer_status == 'close') {
                                             ?>
                                             <a href="#" class="badge badge-primary">Done</a>
                                             <?php }elseif($blanch_customers->customer_status == 'pending'){
                                              ?>
                                              <a href="#" class="badge badge-warning">Pending</a>
                                              <?php }elseif ($blanch_customers->customer_status == 'out') {
                                               ?>
                                               <a href="#" class="badge badge-danger">Default</a>
                                               <?php } ?>
                                            </td>
                                            <td>
                                            <a href="<?php echo base_url("admin/customer_profile/{$blanch_customers->customer_id}"); ?>" class="btn btn-sm btn-icon btn-pure btn-primary on-default m-r-5 button-edit"data-original-title="Edit"><i class="icon-eye"></i></a>
                                            <a href="<?php echo base_url("admin/delete_customerData/{$blanch_customers->customer_id}") ?>" class="btn btn-sm btn-icon btn-pure btn-danger on-default button-remove"
                                            data-toggle="tooltip" data-original-title="Remove" onclick="return confirm('Are You Sure?')"><i class="icon-trash" aria-hidden="true"></i></a>
                                        </td>
                                        </tr>
                                         <?php endforeach; ?>

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
                <h6 class="title" id="defaultModalLabel">Filter Customer</h6>
            </div>
            <?php echo form_open("admin/filter_customer_status"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-6 col-6">
                    <span>Select Branch</span>
                     <select type="number" class="form-control" name="blanch_id" required>
                         <option value="">--Select Branch--</option>
                     <?php foreach ($blanch as $blanchs): ?>
                         <option value="<?php echo $blanchs->blanch_id; ?>"><?php echo $blanchs->blanch_name; ?></option>
                    <?php endforeach; ?>
                    <option value="all">ALL</option>
                     </select>     
                    </div>
                    <div class="col-md-6 col-6">
                    <span>Select Status</span>
                     <select type="number" class="form-control" name="customer_status" required>
                         <option value="">--Select status--</option>
                         <option value="open">ACTIVE</option>
                         <option value="pending">PENDING</option>
                         <option value="out">DEFAULT</option>
                         <option value="close">DONE</option>
                         <!-- <option value="all">ALL</option> -->
                     </select>     
                    </div>
                    <input type="hidden" name="comp_id" value="<?php echo $_SESSION['comp_id']; ?>">
            </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Filter</button>
              <!--  <a href="" class="btn btn-primary">Resend Code</a> -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>





