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
                            <li class="breadcrumb-item active">Transifor Float From Company Account  To Blanch Account</li>
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
                     <?php if ($das = $this->session->flashdata('errors')): ?> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="alert alert-dismisible alert-danger"> <a href="" class="close">&times;</a> 
                                    <?php echo $das;?> </div> 
                            </div> 
                        </div> 
                    <?php endif; ?>
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Transifor Float Form</h2>
                        </div>
                        <div class="body">
                            <?php echo form_open("admin/create_float") ?>
                            <div class="row">
                           <div class="col-md-2">
                                    <span>*From Comp Account :</span>
                                    <select type="number" name="from_trans_id" class="form-control">
                                        <option value="">Select Account</option>
                                        <?php foreach ($account as $accounts): ?>
                                        <option value="<?php echo $accounts->trans_id; ?>"><?php echo $accounts->account_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <span>*Amount:</span>
                                    <input type="number" required class="form-control" placeholder="Amount" name="blanch_amount" >
                                </div>
                                
                                <div class="col-md-3">
                                    <span>*To Branch Name:</span>
                                    <select type="number" name="blanch_id" class="form-control select2" required>
                                        <option value="">---Select Branch---</option>
                                        <?php foreach ($blanch as $blanchs): ?>
                                        <option value="<?php echo $blanchs->blanch_id; ?>"><?php echo $blanchs->blanch_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <span>*To Branch Account :</span>
                                    <select type="number" name="to_trans_id" class="form-control" required>
                                        <option value="">Select Account</option>
                                        <?php foreach ($account as $accounts): ?>
                                        <option value="<?php echo $accounts->trans_id; ?>"><?php echo $accounts->account_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <span>*Withdrawal Chargers:</span>
                                    <input type="number" required  class="form-control" placeholder="Amount" name="charger" required >
                                </div>
                                
                                <input type="hidden" name="comp_id" value="<?php echo $_SESSION['comp_id']; ?>">
                                <?php $date = date("Y-m-d"); ?>
                                <input type="hidden" name="trans_day" value="<?php echo $date ?>">
                               
                                </div>
                                 <br>
                                <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="icon-pencil">Transfor</i></button>
                                </div>
                            
                            <?php echo form_close();  ?>
                        </div>
                    </div>
                </div>


                <div class="col-lg-12">
                    <div class="card">
                         <div class="header">
                            <h2>Today Transaction</h2> 
                            <div class="pull-right">
                    <a href="" class="btn btn-primary btn-sm"data-toggle="modal" data-target="#addcontact1<?php //echo $loan_categorys->category_id; ?>"><i class="icon-calendar">Previous</i></a>
                            </div>   
                          </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                        <th>From Company Account</th>
                                        <th>Amount</th>
                                        <th>To Branch</th>
                                        <th>To Branch Account</th>
                                        <th>Withdrawal Chargers</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $no = 1; ?>
                                <?php foreach ($float as $floats): ?>
                                              <tr>
                                    <td><?php echo $floats->from_account; ?></td>
                                    <td><?php echo number_format($floats->blanch_amount); ?></td>
                                    <td><?php echo $floats->blanch_name; ?></td>
                                    <td><?php echo $floats->to_account; ?></td>
                                    <td><?php echo number_format($floats->charger); ?></td>
                                    
                                <td><?php echo $floats->trans_day; ?></td>
                                <td><a href="<?php echo base_url("admin/remove_comp_transaction/{$floats->transfor_id}"); ?>" class="btn btn-primary btn-sm" onclick="return confirm('Are you Sure?')"><i class="icon icon-pencil"></i></a></td>                                                                  
                                             </tr>
                            <?php endforeach; ?>

                                          <tr>
                                <td><?php //echo $floats->from_account; ?><b>TOTAL</b></td>
                                <td><b><?php echo number_format($sum_froat->cashFloat); ?></b></td>
                                <td><?php //echo $floats->blanch_name; ?></td>
                                <td><?php //echo $floats->to_account; ?></td>
                                <td><b><?php echo number_format($sum_chargers->total_chargers); ?></b></td>
                                    
                                <td><?php //echo $floats->trans_day; ?></td>            
                                <td><?php //echo $floats->trans_day; ?></td>                                                                  
                                        </tr>
                             
                         
                                   
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

    <div class="modal fade" id="addcontact1<?php //echo $loan_categorys->category_id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Filter Transaction by</h6>
            </div>
            <?php echo form_open("admin/previous_transfor/"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <span>Select Branch</span>
                       <select type="number" class="form-control" name="blanch_id" required>
                           <option value="">---Select Branch---</option>
                           <?php foreach ($blanch as $blanchs): ?>
                           <option value="<?php echo $blanchs->blanch_id; ?>"><?php echo $blanchs->blanch_name; ?></option>
                           <?php endforeach; ?>
                       </select>
                    </div>
                    <?php $date = date("Y-m-d"); ?>
                     <div class="col-md-6">
                        <span>From</span>
                        <input type="date" class="form-control" autocomplete="off" name="from" value="<?php echo $date; ?>" required>
                    </div>
                     <div class="col-md-6">
                        <span>To</span>
                        <input type="date" class="form-control" autocomplete="off" name="to" value="<?php echo $date; ?>" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Filter</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>






