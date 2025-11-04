
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
        <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('titless'); ?> </li>
    </ol>
    <div class="row">
        <div class="col-md-12 text-center">
            <div id="message" style=" position: fixed;right: 25px;">
                <?php
                echo $this->session->userdata('message') != '' ? '<span class="alert alert-success" role="alert">' . $this->session->userdata('message') . '</span>' : '';
                ?>
            </div>
        </div>
    </div>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><span class="glyphicon glyphicon-inbox"></span> &nbsp;<?php echo $this->lang->line('titless'); ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <?php if(empty($submit) && $submit == '') { ?>
            <form class="form-horizontal" id="frm_search" action="<?=site_url('ChargeCollection/index')?>" method="GET">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Select a Date</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control dp_field" name="single_date" id="single_date" readonly="" required="">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Shift</label>
                            <div class="col-sm-8">
                                <div class="radio">
                                    <label><input type="radio" name="shift" value="1" checked>Evening (3pm-9pm) <span class="span_current_date"></span></label>
                                </div> 
                                <div class="radio">
                                    <label><input type="radio" name="shift" value="2">Night (9pm-8am) <span class="span_current_date"></span></label>
                                </div>
                                <div class="radio ">
                                    <label><input type="radio" name="shift" value="3">Morning (8am-3pm) <span class="span_tomorrow_date"></span></label>
                                </div>
                                <div class="radio ">
                                    <label><input type="radio" name="shift" value="4">Overall Shift (3pm-3pm)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Payment Location</label>
                            <div class="col-sm-8">
                                <div class="radio">
                                    <label><input type="radio" name="payment_location" value="0" >All</label>
                                </div> 
                                <div class="radio">
                                    <label><input type="radio" name="payment_location" value="KLIA" checked>KLIA</label>
                                </div> 
                                <div class="radio">
                                    <label><input type="radio" name="payment_location" value="KLIA2">KLIA2</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Payment Method</label>
                            <div class="col-sm-8">
                                <div class="radio">
                                    <label><input type="radio" name="payment_method" value="0" >All</label>
                                </div> 
                                <div class="radio">
                                    <label><input type="radio" name="payment_method" value="1" checked>Cash</label>
                                </div> 
                                <div class="radio">
                                    <label><input type="radio" name="payment_method" value="2">Cheque</label>
                                </div>
                                <div class="radio ">
                                    <label><input type="radio" name="payment_method" value="3">Credit Facilities</label>
                                </div>
                                <div class="radio ">
                                    <label><input type="radio" name="payment_method" value="4">Free of Charge</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">&nbsp;</label>
                            <div class="col-sm-5">
                                <input type="hidden" name="submit" id="" value="yes">
                                <button type="submit" class="btn btn-primary btn-block">Generate</button>
                            </div>
                            <div class="col-sm-3">
                                <a href="<?=site_url('ChargeCollection/index')?>">
                                <button type="button" class="btn btn-default btn-block">Reset</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <?php } ?>

            <?php if(!empty($submit) && $submit == 'yes') { ?>
                <form class="form-horizontal" action="" method="GET">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Select a Date</label>
                                <div class="col-sm-8 ">
                                    <div class="form-control">
                                        <?=$single_date_txt?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Shift</label>
                                <div class="col-sm-8">
                                    <div class="form-control">
                                        <?php //$working_session_txt?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Payment Location</label>
                                <div class="col-sm-8">
                                    <div class="form-control">
                                        <?=$payment_location_txt?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Payment Method</label>
                                <div class="col-sm-8">
                                    <div class="form-control">
                                        <?=$payment_method_txt?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">&nbsp;</label>
                            <div class="col-sm-2">
                                <a href="<?=site_url('ChargeCollection/index')?>">
                                <button type="button" class="btn btn-default btn-block">Reset</button></a>
                            </div>
                            <div class="col-sm-3">
                                <a href="<?=site_url('PdfOutput/charge_collection?single_date='.$single_date_txt.'&shift='.$working_session.'&payment_method='.$payment_method_id.'&payment_location='.$payment_location)?>" target="_blank">
                                <button type="button" class="btn btn-info btn-block">PDF</button></a>
                            </div>

                            <div class="col-sm-3">
                                <?php 
                                $current_excel_url = site_url('../../excel/exceloutput/charge_collection?single_date='.$single_date_txt.'&shift='.$working_session.'&payment_method='.$payment_method_id.'&payment_location='.$payment_location);
                                ?>
                                <a href="<?=$current_excel_url?>" target="_blank">
                                <button type="button" class="btn btn-primary btn-block">EXCEL</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                <div>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%">
                            <tr bgcolor="#C3C3C3">
                                <td>Kod</td>
                                <td>Keterangan</td>
                                <td>UOM</td>
                                <td>Kadar Caj</td>
                                <td>Kuantiti</td>
                                <td>Amaun (RM)</td>
                            </tr>
                            <?php 
                            if(count($charge_type_output) > 0)
                            {
                                foreach($charge_type_output as $ctl)
                                {
                                    $fixed_price = $ctl['price'];
                                    $total_qty = $ctl['total_qty'];
                                    $price_without_sst = $ctl['total_price'];
                                    $sst = 0;
                                    $price_with_sst = $sst+$price_without_sst;
                                ?>
                                    <tr>
                                        <td><?=$ctl['kod']?></td>
                                        <td><?=$ctl['name']?></td>
                                        <td class="text-center"><?=$ctl['unitOfMeasurement_actual']?></td>
                                        <td class="text-center">RM<?=$fixed_price?></td>
                                        <td class="text-center"><?=$total_qty?></td>
                                        <td class="text-right"><?=number_format($price_without_sst,2)?></td>
                                    </tr>
                                <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            <?php } ?>  
        </div>
    </div>
</div>
<script type="text/javascript">
$(function(){
    /*==============================
    =            MAL JS            =
    ==============================*/
    
    $( ".dp_field" ).datepicker({
        dateFormat: 'dd-mm-yy',
        // onSelect: function(selected) {
        //      var date = $(this).datepicker('getDate');
        //      var tempStartDate = new Date(date);
        //      var default_end = new Date(tempStartDate.getFullYear(), tempStartDate.getMonth(), tempStartDate.getDate()+1);

        //      var current_date = tempStartDate.getDate()+'-'+(tempStartDate.getMonth()+1)+'-'+tempStartDate.getFullYear();
        //      var formatted_date = default_end.getDate()+'-'+(default_end.getMonth()+1)+'-'+default_end.getFullYear();
        //      // alert(formatted_date);
        //      $('.span_current_date').html('['+current_date+']');
        //      $('.span_tomorrow_date').html('['+formatted_date+']');
        // }

    });

    /*=====  End of MAL JS  ======*/
    
    $('#frm_search').on('submit',function(e){
        var selected_date = $('#single_date').val();
        if(selected_date == '')
        {
            alert('Please select date');
            return false;
        }
    });
});
</script>
<script>
    function redirect(url) {
      $(location).attr('href', url);
  }
</script>
