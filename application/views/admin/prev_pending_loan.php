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
                            <li class="breadcrumb-item active">Report</li>
                            <li class="breadcrumb-item active">Loan Pending</li>
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
                            <h2>Loan Pending </h2> 
                            <div class="pull-right">
                               <a href="" data-toggle="modal" data-target="#addcontact2" class="btn btn-primary"><i class="icon-calendar">Filter</i></a>   
                            </div>   
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover j-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <th>Branch Name</th>
                                        <th>Customer Name</th>
                                        <th>Phone Number</th>
                                        <th>Loan Amount</th>
                                        <th>Duration Type</th>
                                        <th>Pending Amount</th>
                                        <th>Penart</th>
                                        <th>Date</th>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $no = 1; ?>
                                <?php foreach ($loan_pend as $loan_pends): ?>
                                              <tr>
                                    
                                    <td><?php echo $loan_pends->blanch_name; ?></td>
                                    <td><?php //echo $new_pendings->f_name; ?> <?php //echo $new_pendings->m_name; ?> <?php //echo $new_pendings->l_name; ?></td>
                                    <td><?php //echo $new_pendings->phone_no; ?></td>
                                    <td><?php //echo number_format($new_pendings->loan_int); ?></td>
                                    <td>
                                      <?php //if($new_pendings->day == '1'){ ?>
                                            <?php //echo "Daily"; ?>
                                        <?php //echo $loan_pends->return_day; ?>
                                        <?php //}elseif ($new_pendings->day == '7'){
                                            //echo "Weekly";
                                         ?>
                                         <?php //}elseif ($new_pendings->day == '30' || $new_pendings->day == '31' || $new_pendings->day == '28' || $new_pendings->day == '29') {
                                            //echo "Monthly";
                                          ?>
                                          <?php //} ?>
                                            
                                        </td>
                                    <td><?php //echo number_format($new_pendings->total_pend); ?></td>
                                    <td>
                                        <?php //if ($new_pendings->total_penart < $new_pendings->total_pay_penart) {
                                        ?>
                                        
                                    <?php  //}else{ ?>
                                        <?php //echo number_format($new_pendings->total_penart - $new_pendings->total_pay_penart); ?>
                                        <?php //} ?>
                                            
                                        </td>
                                    <td><?php //echo $new_pendings->date; ?></td>
                                                       </tr>

                         <?php $blanch_customer = $this->queries->get_blanch_loan_pend($from,$to,$loan_pends->blanch_id) ?>
                         <?php //print_r($blanch_customer); ?>
                         <?php foreach ($blanch_customer as $blanch_customers): ?>
                                               <tr>
                                    <td><?php //echo $loan_pends->blanch_name; ?></td>
                                    <td><?php echo $blanch_customers->f_name; ?> <?php echo $blanch_customers->m_name; ?> <?php echo $blanch_customers->l_name; ?></td>
                                    <td><?php echo $blanch_customers->phone_no; ?></td>
                                    <td><?php echo number_format($blanch_customers->loan_int); ?></td>
                                    <td>
                                      <?php if($blanch_customers->day == '1'){ ?>
                                            <?php echo "Daily"; ?>
                                        <?php //echo $loan_pends->return_day; ?>
                                        <?php }elseif ($blanch_customers->day == '7'){
                                            echo "Weekly";
                                         ?>
                                         <?php }elseif ($blanch_customers->day == '30' || $blanch_customers->day == '31' || $blanch_customers->day == '28' || $blanch_customers->day == '29') {
                                            echo "Monthly";
                                          ?>
                                          <?php } ?>
                                            
                                        </td>
                                    <td><?php echo number_format($blanch_customers->total_pend); ?></td>
                                    <td>
                                        <?php if ($blanch_customers->total_penart < $blanch_customers->total_pay_penart) {
                                        ?>
                                        0
                                    <?php  }else{ ?>
                                        <?php echo number_format($blanch_customers->total_penart - $blanch_customers->total_pay_penart); ?>
                                        <?php } ?>
                                            
                                        </td>
                                    <td><?php echo $blanch_customers->date; ?></td>
                                    </tr>
                                     <?php endforeach; ?>

                                    <?php endforeach; ?>
                                    <tr>
                                        <td>TOTAL:</td>
                                        <td><b><?php //echo number_format($total_allblanch->total_with_loan); ?></b></td>
                                        <td><b><?php //echo number_format($total_allblanch->total_loan_int); ?></b></td>
                                        <td><b><?php //echo number_format($total_allblanch->total_depost); ?></b></td>
                                        <td><b><?php //echo number_format($total_allblanch->total_loan_int - $total_allblanch->total_depost); ?></b></td>
                                        <td><b><?php //echo number_format($total_pending_new->total_pending); ?></b></td>
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


 <div class="modal fade" id="addcontact2<?php //echo $employees->empl_id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Filter Loan Pending</h6>
            </div>
            <?php echo form_open("admin/prev_pendingLoan"); ?>
            <div class="modal-body">
                <div class="row clearfix">

                                <div class="col-md-12 col-12">
                                    <span>*Select Branch:</span>
                                     <select type="number" class="form-control" name="blanch_id" required>
                                         <option value="">Select Branch</option>
                                         <?php foreach ($blanch as $blanchs): ?>
                                         <option value="<?php echo $blanchs->blanch_id; ?>"><?php echo $blanchs->blanch_name; ?></option>
                                         <?php endforeach; ?>
                                         <option value="all">All</option>
                                     </select>
                                </div>
                                <div class="col-md-6 col-6 ">
                                    <?php $date = date("Y-m-d"); ?>
                                    <span>*From:</span>
                                    <input type="date" name="from" autocomplete="off" value="<?php echo $date; ?>" class="form-control" required>
                                </div>
                                <div class="col-md-6 col-6 ">
                                    <span>*To:</span>
                                    <input type="date" name="to" autocomplete="off" value="<?php echo $date; ?>" class="form-control" required>
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


