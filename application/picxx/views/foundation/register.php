<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 2 | Log in</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url('resources/themes/AdminLTE/dist/css/AdminLTE.min.css'); ?>">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo base_url('resources/themes/AdminLTE/plugins/iCheck/square/blue.css'); ?>">
        <style type="text/css">
            <!--
            .verify {
                color:red;
            }

            select:required:invalid {
                color: gray;
            }
            option[value=""][disabled] {
                display: none;
            }
            option {
                color: black;
            }

            #user_username {
                text-transform: lowercase;
            }
            -->
        </style>

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
            <script src="<?php echo base_url('../resources/shared_js/html5shiv/dist/html5shiv.min.js'); ?>"></script>
            <script src="<?php echo base_url('../resources/shared_js/respond/dest/respond.min.js'); ?>"></script>
            <![endif]-->
        <!--<script src='https://www.google.com/recaptcha/api.js'></script>-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.css" integrity="sha256-MFTTStFZmJT7CqZBPyRVaJtI2P9ovNBbwmr0/KErfEc=" crossorigin="anonymous" />
    </head>
    <body class="hold-transition register-page">
        <div class="register-box">
            <div class="register-logo">
                <a href="<?php echo site_url('authentication/register'); ?>">FixzyRAD</a>
            </div>

            <div class="register-box-body">
                <p class="login-box-msg">Register a new membership</p>
                <?php
if (validation_errors()) {
    ?>
                    <div class="alert alert-danger" role="alert"><?php echo validation_errors(); ?></div>
                    <?php
}
?>
                <form autocomplete="off" action="<?php echo site_url('authentication/register_action'); ?>" method="post">

                    <div class="form-group has-feedback">
                        <select class="form-control" name="user_groupid" id="user_groupid" required>
                            <option value="" disabled selected>Role Group</option>
                            <?php
foreach ($rolelist as $value) {
    ?>
                                <option value="<?php echo $value->usergroup_id; ?>" <?php
echo set_select('user_groupid',
        $value->usergroup_id,
        ($value->usergroup_id == 1 ? true : false));
    ?>><?php echo $value->usergroup_name; ?></option>
                                        <?php
}
?>
                        </select>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="username" class="form-control isAlphaNumericOnly" placeholder="Username"  name="user_username" id="user_username" value="<?php echo $user_username; ?>" required>
                        <span class="glyphicon glyphicon-eye-open
                              form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password"  name="user_password" id="user_password" value="<?php echo $user_password; ?>" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Retype password" name="user_rpassword" id="user_rpassword" value="<?php echo $user_rpassword; ?>" required>
                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Full name"  name="user_name" id="user_name" value="<?php echo $user_name; ?>" required>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span><span class="verify"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="Email"  name="user_email" id="user_email" value="<?php echo $user_email; ?>" required>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="phone" class="form-control" placeholder="Phone Number"  name="user_phone" id="user_phone" value="<?php echo $user_phone; ?>" required>
                        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <div class="g-recaptcha" data-sitekey="6Le_ww0UAAAAAFj73AF5N9Fv5Dx8dOlv5Vs4j48X"></div>
                        <!--<span class="glyphicon glyphicon-lock form-control-feedback"></span>-->
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="agree" id="agree"> I agree to the <a href="#" target="_blank">terms</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" id="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
                        Facebook</a>
                    <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
                        Google+</a>
                </div>

                <a href="<?php echo site_url('authentication'); ?>" class="text-center">I already have a membership</a>
            </div>
            <!-- /.form-box -->
        </div>
        <!-- /.register-box -->

        <!-- jQuery 2.2.3 -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="/resources/js/jquery-2.1.4.min.js">\x3C/script><script src="js/libs/jquery-1.5.1.min.js">\x3C/script>')</script>
        <!-- Bootstrap 3.3.6 -->
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url('resources/themes/AdminLTE/plugins/iCheck/icheck.min.js'); ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js" integrity="sha256-zs4Ql/EnwyWVY+mTbGS2WIMLdfYGtQOhkeUtOawKZVY=" crossorigin="anonymous"></script>
        <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
        <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.alphanum/1.0.21/jquery.alphanum.min.js"></script>
        <script src="<?php echo base_url('resources/shared_js/custom.js?v=0.1'); ?>"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
        <script>
            $(document).ready(function() {
            $("#agree").change(function () {

            if ($('#agree').is(':checked')){

            $("#submit").button("enable");
                    $("#submit").prop("disabled", false);
            }
            });
            });
            }
            );
        </script>
    </body>
</html>

