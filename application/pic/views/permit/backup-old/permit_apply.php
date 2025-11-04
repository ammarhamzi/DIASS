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
    <div class="panel panel-info">
        <div class="panel-heading">
            <!--            <h4><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                <?php echo $this->lang->line('applypermit');?>
            </h4>-->
            <div class="row">
                <div class="col-md-3"><span class="step_active">Step 1</span><br>Select your permit</div>
                <div class="col-md-3">Step 2</div>
                <div class="col-md-3">Step 3</div>
                <div class="col-md-3">Step 4</div>
            </div>
        </div>
        <div class="panel-body">

            <div class="row">
                <div class="col-md-12">
                    <form autocomplete="off" id="step_one" name="step_one" action="/Permit/steptwo" method="post">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <input id="permittype" name="permittype" type="radio" value="adp">
                                            </div>
                                            <div class="col-md-10">
                                                <p>Airside Driving Permit<br><span style="font-size: x-small">Must passed exam with score 90 or above</span></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <input id="permittype" name="permittype" type="radio" value="evdp">
                                            </div>
                                            <div class="col-md-10">
                                                <p>Electrical Vehicle Driving Permit<br><span style="font-size: x-small">Must attend briefing with terminal</span></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <input id="permittype" name="permittype" type="radio" value="avp">
                                            </div>
                                            <div class="col-md-10">
                                                <p>Airside Vehicle Permit</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <input id="permittype" name="permittype" type="radio" value="evp">
                                            </div>
                                            <div class="col-md-10">
                                                <p>Electrical Vehicle Permit<br><span style="font-size: x-small">Must attend briefing with airside</span></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <input id="permittype" name="permittype" type="radio" value="pbb" disabled>
                                            </div>
                                            <div class="col-md-10">
                                                <p>Passenger Boarding Bridge (PBB)</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <input id="permittype" name="permittype" type="radio" value="vdgs" disabled>
                                            </div>
                                            <div class="col-md-10">
                                                <p>Visual Docking Guidance System (VDGS)</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <input id="permittype" name="permittype" type="radio" value="pca" disabled>
                                            </div>
                                            <div class="col-md-10">
                                                <p>Preconditioned Air Unit (PCA)</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <input id="permittype" name="permittype" type="radio" value="gpu" disabled>
                                            </div>
                                            <div class="col-md-10">
                                                <p>Ground Power Unit</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <input id="permittype" name="permittype" type="radio" value="wip" disabled>
                                            </div>
                                            <div class="col-md-10">
                                                <p>Temporary Entry Permit (TEP) - Work In Progress</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <input id="permittype" name="permittype" type="radio" value="cs" disabled>
                                            </div>
                                            <div class="col-md-10">
                                                <p>Temporary Entry Permit (TEP) - Commercial Aupplier</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <input id="permittype" name="permittype" type="radio" value="sh" disabled>
                                            </div>
                                            <div class="col-md-10">
                                                <p>Temporary Entry Permit (TEP) - Stokeholder</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <input id="to_step_two" name="to_step_two" type="submit" class="btn btn-primary" value="Next">
                                <input id="condition" type="hidden" name="condition" value="<?php echo $condition;?>">
<input id="recent_permitid" type="hidden" name="recent_permitid" value="<?php echo $recent_permitid;?>">
                            </div>
                        </div>
                    </form>
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