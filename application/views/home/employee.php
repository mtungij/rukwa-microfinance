
 <!DOCTYPE html> 
 <html lang="en"> 
 <!-- Mirrored from www.wrraptheme.com/templates/lucid/hospital/light/page-login.html by HTTraQt Website Copier/1.x [Karbofos 2012-2017] J2, 22 Mac 2020 05:59:56 GMT --> <head> 
 	<title>Mikoposoft | Employee Login</title> 
 	<meta charset="utf-8"> 
 	<meta http-equiv="X-UA-Compatible" content="IE=Edge"> 
 	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"> 
 	<meta name="description" content="Lucid Bootstrap 4.1.1 Admin Template"> 
 	<meta name="author" content="WrapTheme, design by: ThemeMakker.com"> 
 	<link rel="icon" href="<?php echo base_url() ?>assets/images/traglogo.png" type="image/x-icon" /> <!-- VENDOR CSS --> 
 	<link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css"> 
 	<link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/font-awesome/css/font-awesome.min.css"> <!-- MAIN CSS --> 
 	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main.css"> <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/color_skins.css"> </head> <body class="theme-cyan" style="">
 	
 	<style>
 		.rows{
 			display: flex;
 			font-size: 16px;
 		}
 	</style> 
 		<style> 
 		body {background-image: url('<?php echo base_url(); ?>assets/img/bodaa.jpg'); background-repeat: no-repeat; background-attachment: fixed; background-size: 100% 100%; } </style> <!-- WRAPPER --> 
 		<div class="container"> <div class=""> <div class="">
 		 <br><br><br><br><br> <div class="">
 		  <div class="row"> 
 		  	<div class="col-md-3"> 
 		  	</div> 
 		  	<div class="col-md-6"> 
 		  		<div class="card"> 
 		  		 
 		  				
 		  			 
 		  			<div class="body"> 
 		  				<div class="text-center"> 
 		  					<img src="<?php echo base_url() ?>assets/img/mikopo.png" style="width: 200px;height: 50px;">
 		  				</div>
 		  				<div class="">	
 		  				<div class="rows">
 		  					<div class="col-md-4">
 		  						<a href="<?php echo base_url("welcome/admin_login"); ?>"><i class="icon-key">Admin</i></a>
 		  					</div>
 		  					<div class="col-md-4">
 		  						<a href="<?php echo base_url("welcome/employee_login"); ?>"><i class="icon-key"><?php echo $this->lang->line('employee_menu'); ?></i></a>
 		  					</div>
                              <!-- <div class="col-md-4">
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo $this->lang->line('langu_menu') ?>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item" href="<?php echo base_url('language/english'); ?>">English</a>
                                    <a class="dropdown-item" href="<?php echo base_url('language/kiswahili'); ?>">Swahili</a>
                                    </div>
                                </div>
                            </div> -->
 		  				</div>
 		  				</div>
 		  				<hr>
                        <?php if ($das = $this->session->flashdata('mass')): ?> 
                            <div class="row"> 
                                <div class="col-md-12"> 
                                    <div class="alert alert-dismisible alert-danger"> 
                                        <a href="" class="close">&times;</a> <?php echo $das;?> 
                                    </div> 
                                </div> 
                            </div> 
                            <?php endif; ?> 
                            <?php if ($das = $this->session->flashdata('massage')): ?> <div class="row"> <div class="col-md-12"> 
                                <div class="alert alert-dismisible alert-success"> <a href="" class="close">&times;</a> <?php echo $das;?> </div> 
                            </div> 
                        </div> <?php endif; ?> 

 		  					 <?php echo form_open("welcome/Employee_signin",['class'=>'form-auth-small']); ?> 
 		  					<div class="form-group"> <span><span><?php echo $this->lang->line('phone_number_menu'); ?></span> 
 		  						<input type="number" name="empl_no" required class="form-control"  placeholder="<?php echo $this->lang->line('create_number_menu'); ?>"> <?php echo form_error("number"); ?> 
 		  					</div> 
 		  					<div class="form-group"> 
 		  						<span><?php echo $this->lang->line("password_menu"); ?></span> 
 		  						<input type="password" name="password" required class="form-control"  placeholder="******"> <?php echo form_error("password"); ?> 
 		  					</div> 
 		  					<button type="submit" class="btn btn-info btn-lg btn-block"><?php echo $this->lang->line("loginbutton_menu") ?></button> 
 		  					<br> <?php echo form_close(); ?> 
 		  					 <div class="bottom">
                                    <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="">Forgot password?</a></span>
                                    <br>
                                    
                             </div>
 		  				</div> 
 		  			</div> 
 		  		</div> 
 		  		<div class="col-md-3"> 
 		  		</div> 
 		  	</div> 
 		  </div> 
 		</div> 
 	</div> 
 </div> 
 <!-- END WRAPPER --> 
</body> <!-- Mirrored from www.wrraptheme.com/templates/lucid/hospital/light/page-login.html by HTTraQt Website Copier/1.x [Karbofos 2012-2017] J2, 22 Mac 2020 05:59:57 GMT --> 
</html> 
<!-- Javascript --> 
<script src="<?php echo base_url() ?>assets/bundles/libscripts.bundle.js"></script> 
<script src="<?php echo base_url() ?>assets/bundles/vendorscripts.bundle.js"></script> 
<script src="<?php echo base_url() ?>assets/bundles/datatablescripts.bundle.js">
	
</script> <script src="<?php echo base_url() ?>assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script> 
<script src="<?php echo base_url() ?>assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script> 
<script src="<?php echo base_url() ?>assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script> 
<script src="<?php echo base_url() ?>assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script> 
<script src="<?php echo base_url() ?>assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script> 
<script src="<?php echo base_url() ?>assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 
<script src="<?php echo base_url() ?>assets/bundles/mainscripts.bundle.js"></script> 
<script src="<?php echo base_url() ?>assets/js/pages/tables/jquery-datatable.js"></script> 
</body> <!-- Mirrored from www.wrraptheme.com/templates/lucid/hospital/light/table-jquery-datatable.html by HTTraQt Website Copier/1.x [Karbofos 2012-2017] J2, 22 Mac 2020 06:15:58 GMT --> 
</html>

