<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            <?php echo $this->lang->line('applypermit');?> </li>
    </ol>

    <!--parentchildmenu-->

    <?php
      if(!empty($this->session->userdata('message'))){
?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-check"></i> Success!</h4>
                                <?php echo $this->session->userdata('message');?>
                            </div>
<?php
      }
    ?>
    <div class="box  box-primary">
        <div class="box-header with-border">
            <i class="fa fa-file-text-o"></i>

            <h3 class="box-title">Apply Permit Success</h3>
            <div class="box-tools pull-right">

                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>

            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="alert alert-success" role="alert">
                <p>Success! The booking for briefing date is completed. You will be notified once the booking is approved.</p>
                <p>Your booking ID is:<br>
                    <h3><?php echo $bookingId;?></h3>
                </p>
                <p>An email has been sent to you. You can use this number for any inquiries in the future.</p>
            </div>

            <div class="row">
                <div class="col-md-6 text-right">
                    <a href="/Permit/apply/">Submit another application</a><br>
                    <a href="/Permitall/">Go to my permits</a>
                </div>
                <div class="col-md-6 text-right">
                    <a href="/" class="btn btn-primary">Close</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function redirect(url) {
        $(location).attr('href', url);
    }
</script>