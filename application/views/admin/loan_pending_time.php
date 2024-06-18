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
                                 <a href="" data-toggle="modal" data-target="#addcontact1" class="btn btn-primary"><i class="icon-eye">Today Loan Pending</i></a>      
                            </div>   
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                       <th>S/No.</th>
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
                                <?php foreach ($new_pending as $new_pendings): ?>
                                              <tr>
                                    <td><?php echo $no++; ?>.</td>
                                    
                                    <td><?php echo $new_pendings->blanch_name; ?></td>
                                    <td><?php echo $new_pendings->f_name; ?> <?php echo $new_pendings->m_name; ?> <?php echo $new_pendings->l_name; ?></td>
                                    <td><?php echo $new_pendings->phone_no; ?></td>
                                    <td><?php echo number_format($new_pendings->loan_int); ?></td>
                                    <td>
                                      <?php if($new_pendings->day == '1'){ ?>
                                            <?php echo "Daily"; ?>
                                        <?php //echo $loan_pends->return_day; ?>
                                        <?php }elseif ($new_pendings->day == '7'){
                                            echo "Weekly";
                                         ?>
                                         <?php }elseif ($new_pendings->day == '30' || $new_pendings->day == '31' || $new_pendings->day == '28' || $new_pendings->day == '29') {
                                            echo "Monthly";
                                          ?>
                                          <?php } ?>
                                            
                                        </td>
                                    <td><?php echo number_format($new_pendings->total_pend); ?></td>
                                    <td>
                                        <?php if ($new_pendings->total_penart < $new_pendings->total_pay_penart) {
                                        ?>
                                        0
                                    <?php  }else{ ?>
                                        <?php echo number_format($new_pendings->total_penart - $new_pendings->total_pay_penart); ?>
                                        <?php } ?>
                                            
                                        </td>
                                    <td><?php echo $new_pendings->date; ?></td>
                                    </tr>

                                    <?php endforeach; ?>
                                    <tr>
                                        <td><b>TOTAL:</b></td>
                                        <td></td>
                                        <td><b><?php //echo number_format($total_allblanch->total_with_loan); ?></b></td>
                                        <td><b><?php //echo number_format($total_allblanch->total_loan_int); ?></b></td>
                                        <td><b><?php //echo number_format($total_allblanch->total_depost); ?></b></td>
                                        <td><b><?php //echo number_format($total_allblanch->total_loan_int - $total_allblanch->total_depost); ?></b></td>
                                        <td><b><?php echo number_format($total_pending_new->total_pending); ?></b></td>
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


<div class="modal fade" id="addcontact1" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Today Loan Pending</h6>
            </div>
     
            <div class="modal-body">
              <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                        <th>S/no.</th>
                                        <th>Branch</th>
                                        <th>Customer</th>
                                        <th>Number</th>
                                        <th>Loan Amount</th>
                                        <th>Duration Type</th>
                                        <th>Pending Amount</th>
                                        <th>Date</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                       <?php $no = 1 ?>        
                                <?php foreach($old_newpend as $loan_pends): ?>
                                        <tr>
                                    <td><?php echo $no++; ?>.</td>
                                    <td><?php echo $loan_pends->blanch_name; ?></td>
                                    <td><?php echo $loan_pends->f_name; ?> <?php echo substr($loan_pends->m_name, 0,1); ?> <?php echo $loan_pends->l_name; ?></td>
                                   <!--  <td><?php //echo $loan_aproveds->blanch_name; ?></td> -->
                                    <td><?php echo $loan_pends->phone_no; ?></td>
                                    <td><?php echo number_format($loan_pends->loan_int) ?></td>
                                    <td>
                                        <?php if ($loan_pends->day == 1) {
                                                 echo "Daily";
                                             ?>
                                            <?php }elseif($loan_pends->day == 7){
                                                  echo "Weekly";
                                             ?>
                                            
                                        <?php }elseif($loan_pends->day == 30 || $loan_pends->day == 31 || $loan_pends->day == 29 || $loan_pends->day == 28){
                                                echo "Monthly"; 
                                            ?>
                                            <?php } ?>
                                    </td>
                                    <td><?php echo number_format($loan_pends->return_total); ?></td>
                                   
                                  
                                    <td>
                                 <?php echo $loan_pends->pend_date; ?>
                                    </td>
                    
                                 </tr>

                            <?php endforeach; ?>
                                    </tbody>
                                     <tr>
                                    <td><b>TOTAL:</b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><?php //echo number_format($pend->total_pending); ?></td>
                                    <td><b><?php echo number_format($pend->total_pending); ?></b></td>
                                   
                                </tr>
                                </table>
                            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
           
        </div>
    </div>
</div>






