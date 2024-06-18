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
                            <li class="breadcrumb-item active">Interest Formular</li>
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
                            <h2>Interest Formular</h2>    
                             </div>
                          <div class="body">
                            <?php echo form_open("admin/create_interest_formular"); ?>
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                            <th><input type="checkbox" checked></th>
                                            <th>Formular Name</th> 
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <tr>
                                            <td><input type="checkbox" value="SIMPLE" name="formular_name[]"></td>
                                            <td>SIMPLE FORMULAR</td>
                                        </tr>
                                        
                                        <tr>
                                            <td><input type="checkbox" value="FLAT RATE" name="formular_name[]"></td>
                                            <td>FLAT RATE FORMULAR</td>
                                            <input type="hidden" name="comp_id" value="<?php echo $_SESSION['comp_id']; ?>">
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="REDUCING" name="formular_name[]"></td>
                                            <td>REDUCING FORMULAR</td>
                                        </tr>
                                          <tr>
                                            <td><input type="checkbox" checked></td>
                                            <td style="text-align: right;"><button type="submit" class="btn btn-primary  btn-sm">Save</button></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <?php echo form_close(); ?>
                        </div>

                    </div>
                </div>


                 <div class="col-lg-12">
                    <div class="card">
                         <div class="header">
                            <h2>Interest Formular Selected</h2>    
                             </div>
                          <div class="body">
                            
                            <div class="table-responsive">
                                <table class="table table-hover j-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                            <th><input type="checkbox" checked name=""></th>
                                            <th>Formular Name</th> 
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php foreach ($data as $datas): ?>
                                        <tr>
                                            <td><input type="checkbox" checked></td>
                                            <td><?php if ($datas->formular_name == 'SIMPLE') {
                                     ?>
                                SIMPLE FORMULAR
                               <?php }elseif($datas->formular_name == 'FLAT RATE'){ ?>
                                 FLAT RATE FORMULAR
                                    <?php }elseif ($datas->formular_name == 'REDUCING'){
                                     ?>
                                REDUCING FORMULAR   
                                <?php } ?>
                                    
                                        </td>

                                            <td><a href="<?php echo base_url("admin/delete_formular/{$datas->id}") ?>" class="btn btn-sm btn-icon btn-pure btn-danger on-default button-remove"
                                            data-toggle="tooltip" data-original-title="Remove" onclick="return confirm('Are You Sure?')"><i class="icon-trash" aria-hidden="true"></i></a></td>
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


