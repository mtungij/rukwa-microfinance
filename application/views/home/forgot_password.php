
 <!DOCTYPE html> 
 <html lang="en"> 
 <!-- Mirrored from www.wrraptheme.com/templates/lucid/hospital/light/page-login.html by HTTraQt Website Copier/1.x [Karbofos 2012-2017] J2, 22 Mac 2020 05:59:56 GMT --> <head> 
 	<title>Mikoposoft | Homepage</title> 
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
 		body {background-image: url('<?php echo base_url(); ?>assets/img/mikoposoft.PNG'); background-repeat: no-repeat; background-attachment: fixed; background-size: 100% 100%; } </style> <!-- WRAPPER --> 
 		<div class="container"> <div class=""> <div class="">
 		 <br><br><br><br><br> <div class="">
 		  <div class="row"> 
 		  	<div class="col-md-3"> 
 		  	</div> 
 		  	<div class="col-md-6"> 
 		  		<div class="card"> 
 		  		 
 		  				<?php if ($das = $this->session->flashdata('ms')): ?> 
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
 		  			 
 		  			<div class="body"> 
 		  				<div class="text-center"> 
 		  					<img src="<?php echo base_url() ?>assets/img/mikopo.png" style="width: 200px;height: 50px;">
 		  				</div>
 		  				<!-- <div class="">	
 		  				<div class="rows">
 		  					<div class="col-md-6">
 		  						<a href="<?php //echo base_url("welcome/admin_login"); ?>"><i class="icon-key">Admin</i></a>
 		  					</div>
 		  					<div class="col-md-6">
 		  						<a href="<?php //echo base_url("welcome/employee_login"); ?>"><i class="icon-key">Employee</i></a>
 		  					</div>
 		  				</div>
 		  				</div> -->
 		  				

 		  					 <?php echo form_open("home/signin",['class'=>'form-auth-small']); ?> 
 		  					<div class="form-group"> <span>Phone Number</span> 
 		  						<input type="number" name="" required class="form-control"  placeholder="Enter Phone Number"> <?php echo form_error("number"); ?> 
 		  					</div>  
 		  					<button type="submit" class="btn btn-info btn-lg btn-block">Confirm</button> 
 		  					<br> <?php echo form_close(); ?> 
 		  					 <div class="text-center">
                                    <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="<?php echo base_url("welcome/index") ?>">Home</a></span>
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

