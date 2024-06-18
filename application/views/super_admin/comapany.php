<!DOCTYPE html>
<html lang="en">
<head>
    <title>company Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
    <style>
        form {
            padding: 40px 40px 20px !important;
            background: #ebeff2;
        }
        .mt32 {
            margin-top: 32px;
        }
        label {
            margin-top: 0.3em;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="mt32">Bootstrap 4 Horizontal Form</h2>

    <form class="mt32" action="<?php echo base_url("super_admin/register_company") ?>" method="POST">
    <div class="form-group row">
        <label for="comp_name" class="control-label col-sm-2">Company Name</label>
        <div class="col-sm-10">
            <input type="text" name="comp_name" class="form-control" id="comp_name" placeholder="Company Name" required>
        </div>
    </div>
    <input type="hidden" name="region_id" value="2">
    <input type="hidden" name="sms_status" value="YES">
    <div class="form-group row">
        <label for="comp_phone" class="control-label col-sm-2">Admin Phone Number</label>
        <div class="col-sm-10">
            <input type="tel" class="form-control" id="comp_phone" name="comp_phone" placeholder="Admin Phone Number" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="comp_phone" class="control-label col-sm-2">Registration Number</label>
        <div class="col-sm-10">
            <input type="tel" class="form-control" id="comp_phone" name="comp_number" placeholder="Admin Registration Number" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="comp_email" class="control-label col-sm-2">Company Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="comp_email" name="comp_email" placeholder="Company Email" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="address" class="control-label col-sm-2">Address</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="address" name="adress" placeholder="Address" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="control-label col-sm-2">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-sm-2 col-sm-10 pull-right">
            <button type="submit" class="btn btn-primary">Sign up</button>
        </div>
    </div>
</form>
</div>
</body>
</html>
