<!DOCTYPE html>
<html lang="en">

<head>
    <title>Matrix Admin</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo base_url('assets_admin/') ?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets_admin/') ?>css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets_admin/') ?>css/matrix-login.css" />
    <link href="<?php echo base_url('assets_admin') ?>font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

</head>

<body>
    <div id="loginbox">
        <?php echo form_open("auth/", array('method' => 'POST', 'class' => 'form-vertical')); ?>
        <div class="control-group normal_text">
            <h3>Sistem Informasi Taman Bunga Impian Okura</h3>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" name="username" id="username" placeholder="Username" />
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" name="password" id="password" placeholder="Password" />
                </div>
            </div>
        </div>
        <label class="text-left">
            <?php
            $message = $this->session->flashdata('result_login');
            if ($message) { ?>
                <div style="color: red;"><?php echo $message; ?></div>
            <?php } ?>
        </label>
        <div class="form-actions">
            <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span>
            <span class="pull-right"><button type="submit" class="btn btn-success" /> Login</a></span>
        </div>
        <?php echo form_close() ?>
    </div>

    <script src="<?php echo base_url('assets_admin/') ?>js/jquery.min.js"></script>
    <script src="<?php echo base_url('assets_admin/') ?>js/matrix.login.js"></script>
</body>

</html>