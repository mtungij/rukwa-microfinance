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
                            <li class="breadcrumb-item active">Groups & Members</li>
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
                            <h2>Grops List </h2>
                             
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                            <th>S/No.</th>
                                            <th>Group Name</th>
                                            <th>Branch</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $no = 1; ?>
                                <?php foreach ($group as $groups): ?>
                                        <tr>
                                            <td><?php echo $no++; ?>.</td>
                                            <td><?php echo $groups->group_name; ?></td>
                                            <td><?php echo $groups->blanch_name; ?></td>
                                            <td>
                                            <a href="<?php echo base_url("admin/view_all_group_loan/{$groups->group_id}") ?>" title="Members" class="btn btn-sm btn-icon btn-pure btn-primary on-default m-r-5 button-edit"
                                           data-target="#addcontact1" data-original-title="Edit"><i class="icon-users"></i></a>
                                              
                                            <!-- <a href="<?php //echo base_url("admin/remove_grop/{$groups->customer_id}"); ?>" class="btn btn-sm btn-icon btn-pure btn-danger on-default button-remove"
                                            data-toggle="tooltip" data-original-title="Remove" onclick="return confirm('Are You Sure?')"><i class="icon-trash" aria-hidden="true"></i></a> -->

                                        </td>
                                        </tr>
  
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

      
  
    





