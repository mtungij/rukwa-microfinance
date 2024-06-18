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
                            <li class="breadcrumb-item active">Recomended Expenses</li>
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
                            <h2>Today Expenses</h2>
                            <div class="pull-right">                            
                                <a href="" class="btn btn-primary btn-sm"data-toggle="modal" data-target="#addcontact1<?php //echo $loan_categorys->category_id; ?>"><i class="icon-calendar">Previous</i></a>
                            </div>
    
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                               <th>Branch</th>
                                                <th>Expenses</th>
                                                <th>Amount</th>
                                                <th>From Account Type</th>
                                                <th>Descrption </th>
                                                <!-- <th>Comment</th> -->
                                                <th>Date</th>
                                                <!-- <th>status</th> -->
                                                <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                              <?php $no = 1; ?>
                                    <?php foreach ($data as $datas): ?>
                                              <tr>
                                    <td><?php echo $datas->blanch_name; ?></td>
                                    <td><?php echo $datas->ex_name; ?></td>
                                    <td><?php echo number_format($datas->req_amount); ?></td>
                                    <td><?php echo $datas->account_name; ?></td>
                                    <td><?php echo $datas->req_description; ?></td>
                                    <!--  <td><?php //echo $datas->req_comment; ?></td> -->
                                     <td><?php echo $datas->req_date; ?></td>
                                <td>
                                    <a href="<?php echo base_url("admin/get_remove_expenses/{$datas->req_id}") ?>" class="btn btn-sm btn-icon btn-pure btn-danger on-default m-r-5 button-edit" data-original-title="Delete" onclick="return confirm('Are You Sure?')"><i class="icon-trash"></i>
                                        </a>
                                </td>                                                                                   
                             </tr>

                                         <?php endforeach; ?>
                                         <tr>
                                             <td>TOTAL</td>
                                             <td></td>
                                             <td><?php echo number_format($tota_exp->total_expences); ?></td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
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
                <h6 class="title" id="defaultModalLabel">Filter Previous Expenses</h6>
            </div>
            <?php echo form_open("admin/previous_expences/"); ?>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <span>Select Branch</span>
                       <select type="number" class="form-control" name="blanch_id" required>
                           <option value="">---Select Branch---</option>
                           <?php foreach ($blanch as $blanchs): ?>
                           <option value="<?php echo $blanchs->blanch_id; ?>"><?php echo $blanchs->blanch_name; ?></option>
                           <?php endforeach; ?>
                           <option value="all">All</option>
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




