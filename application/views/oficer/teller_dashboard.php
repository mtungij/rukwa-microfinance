<?php include('incs/header.php'); ?>
<?php include('incs/nav.php'); ?>
<?php include('incs/side.php'); ?>

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url("oficer/index"); ?>"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">Teller</li>
                             <li class="breadcrumb-item active">Teller Dashboard</li>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Search Customer</h2>
                            
                        </div>
                        <div class="text-center">
                                        <img id="loaderIcon" style="visibility:hidden; display:none;width: 100px; height: 100px;"
                                    src="https://c.tenor.com/I6kN-6X7nhAAAAAj/loading-buffering.gif" alt="Please wait" />
                                </div>
                        <div class="body">
                            <?php echo form_open_multipart("oficer/search_customerData",['id'=>'login_form']); ?>
                            <div class="row">
                              <div class="col-lg-2 col-12">
                                </div>
                                 <div class="col-lg-8 col-12">
                                   
                                 <select type="number" class="form-control select2" name="customer_id" required>
                                    
                                     <option value="">Search Customer</option>
                                     <?php foreach ($customer as $customers): ?>
                                     <option value="<?php echo $customers->customer_id; ?>"><?php echo $customers->f_name; ?> <?php echo $customers->m_name; ?> <?php echo $customers->l_name; ?> / <?php echo $customers->customer_code; ?></option>
                                 <?php endforeach; ?>
                                 </select>
                                </div>
                                 <div class="col-lg-2 col-12">
                                  
                                </div>
                              
                               
                                </div>
                               
                                
                            </div>
                                <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="icon-pencil">Search</i></button>
                               
                                </div>
                            
                            <?php echo form_close();  ?>
                        </div>
                    </div>
                </div>
             
            </div>
        </div>
    </div>
</div>

<?php include('incs/footer.php'); ?>

<script>
    $(document).ready(function(){
        $('#login_form').submit(function() {
            $('#loaderIcon').css('visibility', 'visible');
            $('#loaderIcon').show();
        });
    })
</script>








