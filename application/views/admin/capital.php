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
                            <li class="breadcrumb-item active">Capital</li>
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
                            <h2>Add Capital</h2>
                        </div>
                        <div class="body">
                            <?php echo form_open("admin/create_capital") ?>
                            <div class="row">
                            <div class="col-lg-4">
                            <span>* Share Holder Name:</span>
                                <select type="text" name="share_id" class="form-control input-sm" required>
                                <option value="">Select Share Holder</option>
                                <?php foreach ($share as $shares): ?>
                                <option value="<?php echo $shares->share_id; ?>"><?php echo $shares->share_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                                </div>

                                <div class="col-lg-4">
                                    <span>*Amount:</span>
                                    <input type="number" name="amount" placeholder="Amount" autocomplete="off" class="form-control input-sm" required>
                                </div>
                                
                                <input type="hidden" name="comp_id" value="<?php echo $_SESSION['comp_id']; ?>">
                                <div class="col-lg-4">
                                    <span>*Pay Method:</span>
                            <select type="text" name="pay_method" class="form-control input-sm" required>
                                <option value="">Select</option>
                                <?php foreach ($account as $accounts): ?>
                                <option value="<?php echo $accounts->trans_id; ?>"><?php echo $accounts->account_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                                </div>

                                <div class="col-lg-6">
                                    <span>*Receipt no:</span>
                            <input type="number" name="recept" placeholder="Receipt" autocomplete="off" class="form-control input-sm" >
                                </div>
                                <div class="col-lg-6">
                                    <span>*Cheque Number:</span>
                                <input type="number" name="chaque_no" placeholder="Cheque number" autocomplete="off" class="form-control input-sm" >
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
                            <h2>Capital </h2>    
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover j-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                        <th>S/No</th>
                                        <th>Share Holder</th>
                                        <th>Amount</th>
                                        <th>Pay method</th>
                                        <th>Receipt no</th>
                                        <th>Chaque no</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $no = 1; ?>
                                       <?php foreach($capital  as $capitals): ?>
                                    <tr>
                                    <td><?php echo $no++; ?>.</td>
                                    <td><?php echo @$capitals->share_name; ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>    
                                    <td></td>                                                
                                    </tr>
                               <?php $share_capital = $this->queries->get_share_account_capital($capitals->share_id); ?>
                                  <?php foreach ($share_capital as $share_capitals): ?>
                                      
                                     <tr>
                                    <td><?php //echo $no++; ?></td>
                                    <td><?php //echo $capitals->share_name; ?></td>
                                    <td><?php echo number_format($share_capitals->amount); ?></td>
                                    <td><?php echo $share_capitals->account_name; ?></td>
                                    <td>
                                        <?php if ($share_capitals->recept == TRUE) {
                                         ?>
                                        <?php echo $share_capitals->recept; ?>
                                    <?php }else{ ?>
                                        -
                                        <?php } ?>
                                            
                                        </td>
                                    <td>
                                        <?php if ($share_capitals->chaque_no == TRUE) {
                                         ?>
                                        <?php echo $capitals->chaque_no; ?>
                                        <?php }else{ ?>
                                        -
                                        <?php } ?>
                                            
                                        </td>
                                        <td><?php echo $share_capitals->capital_day; ?></td>
                                
                                  <td>
                                    <a href="<?php echo base_url("admin/remove_capital_share/{$share_capitals->capital_id}") ?>" class="btn btn-sm btn-icon btn-pure btn-danger on-default button-remove"
                                            data-toggle="tooltip" data-original-title="Remove" onclick="return confirm('Are You Sure?')"><i class="icon-trash" aria-hidden="true"></i></a> 
                                    </td>    
                             </tr>
                             <?php endforeach; ?>
                             <?php $total_share = $this->queries->get_total_capital_share($capitals->share_id); ?>
                               <tr>
                                    <?php foreach ($total_share as $total_shares): ?>
                                    <td><b>SHARE HOLDER CAPITAL</b></td>
                                    <td><?php //echo $capitals->share_name; ?></td>
                                    <td><b><?php echo number_format($total_shares->total_amount); ?></b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>    
                                    <td></td>                                                
                                    </tr>
                            <?php endforeach; ?>
                         <?php endforeach; ?>
                          <?php @$comp_capital = $this->queries->get_total_capital_company($capitals->comp_id) ?>
                                    <tr>
                                    <?php //foreach ($total_share as $total_shares): ?>
                                    <td><b>TOTAL COMPANY CAPITAL</b></td>
                                    <td><?php //echo $capitals->share_name; ?></td>
                                    <td><b><?php echo number_format($comp_capital->total_compCapital); ?></b></td>
                                    <td></td>
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


