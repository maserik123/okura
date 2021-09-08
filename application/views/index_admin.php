<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $title; ?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo base_url('assets_admin/') ?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets_admin/') ?>css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets_admin/') ?>css/fullcalendar.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets_admin/') ?>css/uniform.css" />
    <!-- <link rel="stylesheet" href="<?php echo base_url('assets_admin/') ?>css/select2.css" /> -->
    <link rel="stylesheet" href="<?php echo base_url('assets_admin/') ?>css/matrix-style.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets_admin/') ?>css/matrix-media.css" />
    <link href="<?php echo base_url('assets_admin/') ?>font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url('assets_admin/') ?>css/jquery.gritter.css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <script src="<?php echo base_url() ?>assets_admin/js/jquery.min.js"></script>
    <!-- <link rel="shortcut icon" href="malas_ngoding.jpg"> -->
</head>

<body>
    <!--Header-part-->
    <div id="header">
        <h1><a href="dashboard.html"><i class="icon-desktop"></i> Taman Bunga Impian Okura</a></h1>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
    <script type="text/javascript">
        function logout() {
            swal({
                    title: "Do you want to logout ?",
                    type: "warning",
                    // imageUrl: "<?php echo base_url() ?>assets/images/user.png",
                    text: "Click yes if you have been finished all the transactions in this system ",
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    confirmButtonText: "Yes",
                    closeOnConfirm: false
                },
                function() {
                    $.ajax({
                        url: "<?php echo site_url('auth/logout'); ?>",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                        success: function(data) {
                            $url = '<?php echo base_url('/auth/') ?>';
                            setTimeout(() => {
                                $(location).attr('href', $url)
                            }, 1400);
                            return swal({
                                html: true,
                                timer: 1300,
                                showConfirmButton: false,
                                title: data['msg'],
                                type: data['status']
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error to Log out, check the connection or configuration !');
                        }
                    });
                });
        }
    </script>
    <!--close-Header-part-->
    <!--top-Header-menu-->
    <div id="user-nav" class="navbar navbar-inverse">
        <ul class="nav">
            <li class="dropdown" id="profile-messages"><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i> <span class="text"><?php echo $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'); ?></span><b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="#"><i class="icon-check"></i> Change Password</a></li>
                    <li class="divider"></li>
                    <li><a onclick="logout()"><i class="icon-key"></i> Log Out</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!--close-top-Header-menu-->
    <!--start-top-serch-->
    <!-- <div id="search">
        <button type="submit" class="btn-danger" title="Logout"><i class="icon-off icon-white"></i> Logout</button>
    </div> -->
    <!--close-top-serch-->
    <?php include 'elements_admin/sidebar.php'; ?>
    <!--main-container-part-->
    <div id="content">

        <!--Action boxes-->
        <?php include 'pages_admin/' . $pageName . '.php'; ?>
    </div>
    <!--end-main-container-part-->

    <!--Footer-part-->
    <div class="row-fluid">
        <div id="footer" style="color: white;font-size: 9px;" class="span12"> <?php echo date('Y') ?> &copy; designed by www.fimajayasejahtera.com </div>
    </div>

    <!--end-Footer-part-->
    <script src="<?php echo base_url() ?>assets_admin/js/jquery.ui.custom.js"></script>
    <script src="<?php echo base_url() ?>assets_admin/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets_admin/js/jquery.uniform.js"></script>
    <script src="<?php echo base_url() ?>assets_admin/js/excanvas.min.js"></script>
    <!-- <script src="<?php echo base_url() ?>assets_admin/js/jquery.flot.min.js"></script> -->
    <!-- <script src="<?php echo base_url() ?>assets_admin/js/jquery.flot.resize.min.js"></script> -->
    <script src="<?php echo base_url() ?>assets_admin/js/jquery.peity.min.js"></script>
    <script src="<?php echo base_url() ?>assets_admin/js/fullcalendar.min.js"></script>
    <script src="<?php echo base_url() ?>assets_admin/js/matrix.js"></script>
    <!-- <script src="<?php echo base_url() ?>assets_admin/js/matrix.dashboard.js"></script> -->
    <!-- <script src="<?php echo base_url() ?>assets_admin/js/jquery.gritter.min.js"></script> -->
    <!-- <script src="<?php echo base_url() ?>assets_admin/js/matrix.interface.js"></script> -->
    <script src="<?php echo base_url() ?>assets_admin/js/matrix.chat.js"></script>
    <script src="<?php echo base_url() ?>assets_admin/js/jquery.validate.js"></script>
    <script src="<?php echo base_url() ?>assets_admin/js/matrix.form_validation.js"></script>
    <script src="<?php echo base_url() ?>assets_admin/js/jquery.wizard.js"></script>
    <!-- <script src="<?php echo base_url() ?>assets_admin/js/select2.min.js"></script> -->
    <script src="<?php echo base_url() ?>assets_admin/js/matrix.popover.js"></script>
    <script src="<?php echo base_url() ?>assets_admin/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>assets_admin/js/matrix.tables.js"></script>
    <script type="text/javascript">
        // This function is called from the pop-up menus to transfer to
        // a different page. Ignore if the value returned is a null string:
        function goPage(newURL) {

            // if url is empty, skip the menu dividers and reset the menu selection to default
            if (newURL != "") {

                // if url is "-", it is this page -- reset the menu:
                if (newURL == "-") {
                    resetMenu();
                }
                // else, send page to designated URL            
                else {
                    document.location.href = newURL;
                }
            }
        }
        // resets the menu selection upon entry to this page:
        function resetMenu() {
            document.gomenu.selector.selectedIndex = 2;
        }
    </script>
</body>

</html>