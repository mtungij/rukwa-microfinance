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
                            <li class="breadcrumb-item active">Employee Privillage</li>
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
                    <?php if ($das = $this->session->flashdata('error')): ?> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="alert alert-dismisible alert-danger"> <a href="" class="close">&times;</a> 
                                    <?php echo $das;?> </div> 
                            </div> 
                        </div> 
                    <?php endif; ?>
            <div class="row clearfix">

               <?php if ($emply->position_id == '22') {
                ?>
                <div class="col-lg-6">
                    <div class="card">
                         <div class="header">
                            <h2>Admin Privillage </h2>
                            <div class="pull-right">
                                <a href="<?php echo base_url("admin/all_employee"); ?>" class="btn btn-primary btn-sm"><i class="icon-logout">Back</i></a>
                            </div>    
                             </div>
                          <div class="body">
                            <div class="table-responsive">

                                
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-info">
                                        <tr>
                                            <th>Privillage</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        

                                        <tr>
                                            <td>CUSTOMER</td>
                                            <?php $priv = 'customer' ?>
                                            <td><a href="<?php echo base_url("admin/careate_amin_privillage/{$priv}/{$emply->empl_id}/{$emply->comp_id}") ?>" class="btn btn-primary btn-sm"><i class="icon-pencil">Add</i></a>
                                            </td>
                                          
                                        </tr>
                                        <tr>
                                            <td>LOAN</td>
                                            <?php $priv = 'loan' ?>
                                            <td><a href="<?php echo base_url("admin/careate_amin_privillage/{$priv}/{$emply->empl_id}/{$emply->comp_id}") ?>" class="btn btn-primary btn-sm"><i class="icon-pencil">Add</i></a>
                                            </td>
                                          
                                        </tr>
                                        <tr>
                                            <td>EXPENSES </td>
                                            <?php $priv = 'expenses' ?>
                                            <td><a href="<?php echo base_url("admin/careate_amin_privillage/{$priv}/{$emply->empl_id}/{$emply->comp_id}") ?>" class="btn btn-primary btn-sm"><i class="icon-pencil">Add</i></a>
                                            </td>
                                          
                                        </tr>
                                         <tr>
                                            <td>CAPITAL </td>
                                            <?php $priv = 'capital' ?>
                                            <td><a href="<?php echo base_url("admin/careate_amin_privillage/{$priv}/{$emply->empl_id}/{$emply->comp_id}") ?>" class="btn btn-primary btn-sm"><i class="icon-pencil">Add</i></a>
                                            </td>
                                          
                                        </tr>
                                        <tr>
                                            <td>EMPLOYEE</td>
                                            <?php $priv = 'employee' ?>
                                            <td><a href="<?php echo base_url("admin/careate_amin_privillage/{$priv}/{$emply->empl_id}/{$emply->comp_id}") ?>" class="btn btn-primary btn-sm"><i class="icon-pencil">Add</i></a>
                                            </td>
                                          
                                        </tr>
                                         <tr>
                                            <td>REPORTS</td>
                                            <?php $priv = 'report' ?>
                                            <td><a href="<?php echo base_url("admin/careate_amin_privillage/{$priv}/{$emply->empl_id}/{$emply->comp_id}") ?>" class="btn btn-primary btn-sm"><i class="icon-pencil">Add</i></a>
                                            </td>
                                          
                                        </tr>
                                        <tr>
                                            <td>SETTING</td>
                                            <?php $priv = 'setting' ?>
                                            <td><a href="<?php echo base_url("admin/careate_amin_privillage/{$priv}/{$emply->empl_id}/{$emply->comp_id}") ?>" class="btn btn-primary btn-sm"><i class="icon-pencil">Add</i></a>
                                            </td>
                                          
                                        </tr>
                                          <tr>
                                            <td>BRANCH</td>
                                            <?php $priv = 'branch' ?>
                                            <td><a href="<?php echo base_url("admin/careate_amin_privillage/{$priv}/{$emply->empl_id}/{$emply->comp_id}") ?>" class="btn btn-primary btn-sm"><i class="icon-pencil">Add</i></a>
                                            </td>
                                          
                                        </tr>
                                        <tr>
                                            <td>TELLER</td>
                                            <?php $priv = 'teller' ?>
                                            <td><a href="<?php echo base_url("admin/careate_amin_privillage/{$priv}/{$emply->empl_id}/{$emply->comp_id}") ?>" class="btn btn-primary btn-sm"><i class="icon-pencil">Add</i></a>
                                            </td>
                                          
                                        </tr>
                                         <tr>
                                            <td>INCOME</td>
                                            <?php $priv = 'income' ?>
                                            <td><a href="<?php echo base_url("admin/careate_amin_privillage/{$priv}/{$emply->empl_id}/{$emply->comp_id}") ?>" class="btn btn-primary btn-sm"><i class="icon-pencil">Add</i></a>
                                            </td>
                                          
                                        </tr>
                                         <tr>
                                            <td>COMMNICATION</td>
                                            <?php $priv = 'comnication' ?>
                                            <td><a href="<?php echo base_url("admin/careate_amin_privillage/{$priv}/{$emply->empl_id}/{$emply->comp_id}") ?>" class="btn btn-primary btn-sm"><i class="icon-pencil">Add</i></a>
                                            </td>
                                          
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div> 



                <div class="col-lg-6">
                    <div class="card">
                         <div class="header">
                            <h2>Privillage For (<?php echo $emply->empl_name; ?>) </h2>    
                             </div>
                          <div class="body">
                            <div class="table-responsive">

                                
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-info">
                                        <tr>
                                            <th>S/No.</th>
                                            <th>Privillage</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $no = 1; ?>
                                       <?php foreach ($admin_privillage as $admin_privillages): ?>

                                        
                                        <tr>
                                            <td><?php echo $no++; ?>.</td>
                                            <td class="c"><?php echo $admin_privillages->privillage; ?></td>
                                            <td><a href="<?php echo base_url("admin/remove_admin_privillage/{$admin_privillages->id}") ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure?')"><i class="icon-trash"></i></a></td>
                                          
                                        </tr>
    
                                         <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div> 
            <?php }else{ ?>
                 <div class="col-lg-6">
                    <div class="card">
                         <div class="header">
                            <h2>Privillage List </h2>
                            <div class="pull-right">
                                <a href="<?php echo base_url("admin/all_employee"); ?>" class="btn btn-primary btn-sm"><i class="icon-logout">Back</i></a>
                            </div>    
                             </div>
                          <div class="body">
                            <div class="table-responsive">

                                
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                           
                                            <th>Privillage</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                       

                                        
                                         <tr>
                                            <td>CUSTOMER</td>
                                            <?php $priv = 'customer' ?>
                                            <td><a href="<?php echo base_url("admin/careate_employee_privillage/{$priv}/{$emply->empl_id}/{$emply->comp_id}") ?>" class="btn btn-primary btn-sm"><i class="icon-pencil">Add</i></a>
                                            </td>
                                          
                                        </tr>
                                        <tr>
                                            <td>LOAN</td>
                                            <?php $priv = 'loan' ?>
                                            <td><a href="<?php echo base_url("admin/careate_employee_privillage/{$priv}/{$emply->empl_id}/{$emply->comp_id}") ?>" class="btn btn-primary btn-sm"><i class="icon-pencil">Add</i></a>
                                            </td>
                                          
                                        </tr>
                                        <tr>
                                            <td>EXPENSES </td>
                                            <?php $priv = 'expenses' ?>
                                            <td><a href="<?php echo base_url("admin/careate_employee_privillage/{$priv}/{$emply->empl_id}/{$emply->comp_id}") ?>" class="btn btn-primary btn-sm"><i class="icon-pencil">Add</i></a>
                                            </td>
                                          
                                        </tr>
                                         <tr>
                                            <td>FLOAT </td>
                                            <?php $priv = 'float' ?>
                                            <td><a href="<?php echo base_url("admin/careate_employee_privillage/{$priv}/{$emply->empl_id}/{$emply->comp_id}") ?>" class="btn btn-primary btn-sm"><i class="icon-pencil">Add</i></a>
                                            </td>
                                          
                                        </tr>
                                        
                                         <tr>
                                            <td>REPORTS</td>
                                            <?php $priv = 'report' ?>
                                            <td><a href="<?php echo base_url("admin/careate_employee_privillage/{$priv}/{$emply->empl_id}/{$emply->comp_id}") ?>" class="btn btn-primary btn-sm"><i class="icon-pencil">Add</i></a>
                                            </td>
                                          
                                        </tr>
                                        
                                         
                                        <tr>
                                            <td>TELLER</td>
                                            <?php $priv = 'teller' ?>
                                            <td><a href="<?php echo base_url("admin/careate_employee_privillage/{$priv}/{$emply->empl_id}/{$emply->comp_id}") ?>" class="btn btn-primary btn-sm"><i class="icon-pencil">Add</i></a>
                                            </td>
                                          
                                        </tr>
                                         <tr>
                                            <td>INCOME</td>
                                            <?php $priv = 'income' ?>
                                            <td><a href="<?php echo base_url("admin/careate_employee_privillage/{$priv}/{$emply->empl_id}/{$emply->comp_id}") ?>" class="btn btn-primary btn-sm"><i class="icon-pencil">Add</i></a>
                                            </td>
                                          
                                        </tr>

                                        <tr>
                                            <td>GROUPS</td>
                                            <?php $priv = 'group' ?>
                                            <td><a href="<?php echo base_url("admin/careate_employee_privillage/{$priv}/{$emply->empl_id}/{$emply->comp_id}") ?>" class="btn btn-primary btn-sm"><i class="icon-pencil">Add</i></a>
                                            </td>
                                          
                                        </tr>
                                         
    
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div> 



                <div class="col-lg-6">
                    <div class="card">
                         <div class="header">
                            <h2>Privillage For (<?php echo $emply->empl_name; ?>) </h2>    
                             </div>
                          <div class="body">
                            <div class="table-responsive">

                                
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                            <th>S/No.</th>
                                            <th>Privillage</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $no = 1; ?>
                                       <?php foreach ($employee_privillage as $employee_privillages): ?>

                                        
                                        <tr>
                                            <td><?php echo $no++; ?>.</td>
                                            <td class="c"><?php echo $employee_privillages->privillage; ?></td>
                                            <td><a href="<?php echo base_url("admin/remove_empl_privillage/{$employee_privillages->id}") ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure?')"><i class="icon-trash"></i></a></td>
                                          
                                        </tr>
    
                                         <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div> 

                <?php } ?>


             
            </div>
        </div>
    </div>
</div>

<?php include('incs/footer.php'); ?>


