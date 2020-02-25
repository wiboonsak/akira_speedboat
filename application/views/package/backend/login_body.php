<?php
$rndNum = rand(1, 3);

$img[1] = base_url('images/background/bg-103.png');
$img[2] = base_url('images/background/bg-101.png');
$img[3] = base_url('images/background/bg-100.png');

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Control Backend</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico') ?>">

        <!-- App css -->
        <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/icons.css" rel="stylesheet') ?>" type="text/css" />
        <link href="<?php echo base_url('assets/css/style.css" rel="stylesheet') ?>" type="text/css" />

        <script src="<?php echo base_url('assets/js/modernizr.min.js') ?>"></script>

    </head>

    <body>

        <!-- Begin page -->
        <div class="accountbg" style="background: url('<?php echo $img[$rndNum] ?>');background-size: cover;"></div>

        <div class="wrapper-page account-page-full" >

            <div class="card">
                <div class="card-block" >

                    <div class="account-box">

                        <div class="card-box p-5" >
                            <h2 class="text-uppercase text-center pb-4">
                                <a href="" class="text-success">
                                    <span><img src="<?php echo base_url('images/logo-header.png') ?>" alt="" ></span>
                                </a>
                            </h2>
                            <?php if ($Error == '1') { ?>
                                <h4 align="center" class="text-danger"><i class=" mdi mdi-alert-octagon"></i> ไม่สามารถเข้าสู่ระบบได้</h4>
                            <?php } ?>
                            <form class="" method="post" action="<?php echo base_url('login/gologin') ?>">

                                <div class="form-group m-b-20 row">
                                    <div class="col-12">
                                        <label for="emailaddress">Username</label>
                                        <input class="form-control" type="text" id="Username" name="Username" required="" placeholder="Enter your Username">
                                    </div>
                                </div>

                                <div class="form-group row m-b-20">
                                    <div class="col-12">

                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" required="" id="password" name="password" placeholder="Enter your password">
                                    </div>
                                </div>



                                <div class="form-group row text-center m-t-10">
                                    <div class="col-12">
                                        <button class="btn btn-block btn-custom waves-effect waves-light" type="submit">Login</button>
                                    </div>
                                </div>

                            </form>

                            <div class="row m-t-50"></div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="m-t-40 text-center">
                <p class="account-copyright">2018 © Developed by <a href="http://www.me-fi.com" target="_blank">ME-Fi dot com</a></p>
            </div>

        </div>


        <!-- jQuery  -->
        <script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/popper.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/waves.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.slimscroll.js') ?>"></script>

        <!-- App js -->
        <script src="<?php echo base_url('assets/js/jquery.core.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.app.js') ?>"></script>

    </body>
</html>