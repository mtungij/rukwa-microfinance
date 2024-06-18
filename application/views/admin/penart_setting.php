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
                            <li class="breadcrumb-item active">Penart Setting</li>
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
                            <h2>Penart Setting</h2>
                        </div>
                        <div class="body">
                            <?php if(@$penart == TRUE){ ?>
                            <?php echo form_open("admin/modify_penart/{$penart->penalt_id}") ?>
                            <div class="row">
                               <div class="col-md-6">
                                <div class="form-group">
                                    <label>Calculation Type</label>
                                   <select type="text" name="action_penart" class="form-control">
                                        <option value="<?php echo $penart->action_penart; ?>"><?php echo $penart->action_penart; ?></option>
                                        <option value="PERCENTAGE VALUE">Percentage Value</option>
                                        <option value="MONEY VALUE">Money Value</option>
                                    </select>
                                </div>
                                </div>
                               
                              
                                  <div class="col-md-6">
                                <div class="form-group">
                                    <label>Penalt Amount</label>
                                    <input type="text" required value="<?php echo $penart->penart; ?>" class="form-control" placeholder="penart Amount % $" name="penart" autocomplete="off" >
                                </div>
                                </div>
                                <br>
                                </div>
                                <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="icon-drawer">Update</i></button>
                                </div>
                            <?php echo form_close();  ?>
                            <?php }elseif(@$penart == FALSE) {
                             ?>
                               <?php echo form_open("admin/create_penarty") ?>
                            <div class="row">
                               <div class="col-md-6">
                                <div class="form-group">
                                    <label>Calculation Type</label>
                                   <select type="text" name="action_penart" class="form-control">
                                        <option value="">---Select Calculation Type---</option>
                                        <option value="PERCENTAGE VALUE">Percentage Value</option>
                                        <option value="MONEY VALUE">Money Value</option>
                                    </select>
                                </div>
                                </div>
                               
                              <input type="hidden" name="comp_id" value="<?php echo $_SESSION['comp_id']; ?>">
                                
                                  <div class="col-md-6">
                                <div class="form-group">
                                    <label>Penalt Amount</label>
                                    <input type="text" required  class="form-control" placeholder="penart Amount % $" name="penart" autocomplete="off" >
                                </div>
                                </div>
                                <br>
                                </div>
                                <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="icon-drawer">Save</i></button>
                                </div>
                            <?php echo form_close();  ?>
                             <?php }  ?>
                        </div>
                    </div>
                </div>


                <div class="col-lg-12">
                    <div class="card">
                         <div class="header">
                            <h2>Penart Setting</h2>    
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                            <th>Calculation Type</th>
                                            <th>Penalt Amount</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php //foreach ($loan_category as $loan_categorys): ?>
                                        <tr>
                                            <td><?php echo @$penart->action_penart; ?></td>
                                            <td><?php if (@$penart->action_penart == 'MONEY VALUE') {
                                         ?>
                                        <?php echo number_format(@$penart->penart); ?>
                                        <?php }elseif(@$penart->action_penart == 'PERCENTAGE VALUE') {
                                         ?>
                                         <?php echo @$penart->penart; ?>%
                                         <?php } ?></td>
                                           
                                            <td>
                                                <?php if ($penart == TRUE) {
                                                   ?>
                                           
                                            <a href="<?php echo base_url("admin/delete_penart/{$penart->penalt_id}") ?>" class="btn btn-sm btn-icon btn-pure btn-danger on-default button-remove"
                                            data-toggle="tooltip" data-original-title="Remove" onclick="return confirm('Are You Sure?')"><i class="icon-trash" aria-hidden="true"></i></a>
                                            <?php }elseif($penart == FALSE){
                                                ?>
                 
                                                <?php } ?>
                                        </td>
                                        </tr>
                                         <?php //endforeach; ?>
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


