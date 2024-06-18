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
                            <li class="breadcrumb-item active">Income Balance</li>
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
                            <h2>Deducted Income Balance</h2>    
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                            <th>Branch Name</th>
                                            <th>Balance Amount</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                              <?php $no = 1; ?>
                                    <?php foreach ($blanch_summary as $blanch_summarys): ?>
                                              <tr>
                                    <td><?php echo $blanch_summarys->blanch_name; ?></td>
                                    <td><?php echo number_format($blanch_summarys->deducted); ?></td>
                                                                                                                     
                                    </tr>
                                         <?php endforeach; ?>
                                    </tbody>
                                    <tr>
                                        <td>TOTAL</td>
                                        <td><?php echo number_format($total_deducted_balance->total_deducted)?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div> 


                  <div class="col-lg-12">
                    <div class="card">
                         <div class="header">
                            <h2>Non Deducted Balance Summary</h2>    
                             </div>
                          <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-primary">
                                        <tr>
                                            <th>Branch Name</th>
                                            <th>Balance Amount</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                    <?php foreach ($blanch_summary_nonDeduected as $blanch_summary_nonDeduecteds): ?>
                                              <tr>
                                    <td>
                                        <?php echo $blanch_summary_nonDeduecteds->blanch_name; ?>
                                        </td>
                                    <td><?php echo number_format($blanch_summary_nonDeduecteds->non_balance); ?></td>
                                    
                                    
                                    </tr>

                                 <?php endforeach; ?>
                                
                                    </tbody>
                                     <tr>
                                     <td>TOTAL:</td>
                                     <td><?php echo number_format($total_non->total_nondeducted)?></td>
                                 </tr>
                                 <tr>
                                     <td><b style="color: green;">TOTAL DEDUCTION</b></td>
                                     <td style="color: green;"><b><?php echo number_format($total_non->total_nondeducted + $total_deducted_balance->total_deducted)?></b></td>
                                 </tr>
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


