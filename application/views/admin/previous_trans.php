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
                            <li class="breadcrumb-item active">Previous Transaction</li>
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
                <div class="col-lg-12">
                    <div class="card">
                         <div class="header">
                            <h2>Previous Transaction From:<?php echo $from; ?> To:<?php echo $to; ?></h2> 
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
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $no = 1; ?>
                                <?php foreach ($cash as $floats): ?>
                                              <tr>
                                    <td><?php echo $floats->from_account; ?></td>
                                    <td><?php echo number_format($floats->blanch_amount); ?></td>
                                    <td><?php echo $floats->blanch_name; ?></td>
                                    <td><?php echo $floats->to_account; ?></td>
                                    <td><?php echo number_format($floats->charger); ?></td>
                                    
                                <td><?php echo $floats->trans_day; ?></td>                                                                  
                                             </tr>
                            <?php endforeach; ?>

                                          <tr>
                                <td><?php //echo $floats->from_account; ?><b>TOTAL</b></td>
                                <td><b><?php echo number_format($sum_float->total_froat); ?></b></td>
                                <td><?php //echo $floats->blanch_name; ?></td>
                                <td><?php //echo $floats->to_account; ?></td>
                                <td><b><?php echo number_format($sum_float->total_charger); ?></b></td>
                                    
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
                        <input type="date" class="form-control" autocomplete="off" name="from" value="<?php echo  $date; ?>" required>
                    </div>
                     <div class="col-md-6">
                        <span>To</span>
                        <input type="date" class="form-control" autocomplete="off" name="to" value="<?php echo  $date; ?>" required>
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






