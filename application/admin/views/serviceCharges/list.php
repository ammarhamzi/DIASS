
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
        <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('service_charges'); ?> <?php echo $this->lang->line('list'); ?></li>
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
            <h3 class="box-title"><span class="glyphicon glyphicon-inbox"></span> &nbsp;Service Charges List</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="mytable" class="table" >

                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo 'Charge Types';//$this->lang->line('user_username'); ?></th>
                        <th><?php echo 'Flight / Aircraft No';//$this->lang->line('user_username'); ?></th>
                        <th><?php echo 'Requestor';//$this->lang->line('user_name'); ?></th>
                        <th><?php echo 'Date / Time';//$this->lang->line('user_email'); ?></th>
                        <th><?php echo 'Status';//$this->lang->line('user_email'); ?></th>
                        <th class="no-sort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    /*
                    $start = 0;
                    if ($serviceCharges_data) {

                        foreach ($serviceCharges_data as $r) {
                            $raw_datetime = $r->servicecharges_requestordatetime;
                            $txt_datetime = 'None';
                            if(!empty($raw_datetime))
                            {
                              $txt_datetime = date('d-m-Y',strtotime($raw_datetime));
                              $txt_time = date('h:i A',strtotime($raw_datetime));
                            }

                            switch ($r->servicecharges_status) {
                              case '0':
                                $status_txt = 'Open';
                                $label_color = 'label bg-orange-active';
                                $btn_upload_display = '';
                                break;
                              case '1':
                                $status_txt = 'Close';
                                $label_color = 'label label-danger';
                                $btn_upload_display = 'display:none;';
                                break;
                              default:
                                $status_txt = 'None';
                                $label_color = '';
                                $btn_upload_display = '';
                                break;
                            }
                            ?>
                            <tr>
                                <td><?php echo ++$start; ?></td>
                                <td><a href="<?=site_url('ServiceCharges/show/'.fixzy_encoder($r->servicecharges_id))?>"><?php echo $r->charges_types_name; ?></a></td>
                                <td><?php echo $r->servicecharges_flightNumber; ?></td>
                                <td><?php echo $r->servicecharges_requestor; ?></td>
                                <td><?php echo $txt_datetime.' /<br />'.$txt_time; ?></td>
                                <td><span class="<?=$label_color?>"><?php echo $status_txt; ?></span></td>
                                <td style="text-align:center; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">
                                        <?php
                                        $id = fixzy_encoder($r->servicecharges_id);
                                        // if ($permission->cp_read == true) {
                                        //     echo anchor(site_url('ServiceCharges/read/' . $id),
                                        //         '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>');
                                        // }
                                        echo '<button type="button" class="btn bg-maroon btn_upload" enc="'.$id.'" style="'.$btn_upload_display.'" data-toggle="tooltip" title="Upload Document"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span></button>';

                                        echo anchor(site_url('PdfOutput/airside_service_print/' . $id),
                                                '<button type="button" class="btn btn-info" data-toggle="tooltip" title="Print"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>','target="_blank"');
                                        if ($permission->cp_update == true) {

                                            echo anchor(site_url('ServiceCharges/update/' . $id),
                                                '<button type="button" class="btn btn-default" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>');
                                        }
                                        if ($permission->cp_delete == true) {

                                            echo anchor(site_url('ServiceCharges/delete/' . $id),
                                                '<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Remove"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>',
                                                'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
                                        }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    */
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo 'Charge Types';//$this->lang->line('user_username'); ?></th>
                        <th><?php echo 'Flight / Aircraft No';//$this->lang->line('user_username'); ?></th>
                        <th><?php echo 'Requestor';//$this->lang->line('user_name'); ?></th>
                        <th><?php echo 'Date / Time';//$this->lang->line('user_email'); ?></th>
                        <th><?php echo 'Status';//$this->lang->line('user_email'); ?></th>
                        <th>&nbsp;</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<form method="POST" action="" id="frm_upload_document">
<div class="modal fade" id="modal_upload_document">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Upload Document</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Document : </label>
          <input type="file" class="form-control" name="uploadfile[]" id="uploadfile" required="">
          <p class="help-block">Please upload the signed document.</p>
        </div>

        <input type="hidden" name="modal_ud_ids" id="modal_ud_ids" value="">
        <input type="hidden" name="filetype" id="filetype" value="files_sc">
        <input type="hidden" name="submit" value="submit">

        <span class="p_error_msg"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn_submit_ud">Submit</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</form>

<script type="text/javascript">
$(function(){
  $('#modal_upload_document').on('hide.bs.modal',function(){
    $('#modal_ud_ids').val('');
  });

  $('#mytable').on('click','.btn_upload',function(){
    var enc = $(this).attr('enc');
    $('#modal_ud_ids').val(enc);
    $('#modal_upload_document').modal('show');
  });

  $("#frm_upload_document").submit(function(evt){  
      evt.preventDefault();
      var enc = $('#modal_ud_ids').val();
      $('.btn_submit_ud').prop('disabled',true);
      $(".p_error_msg").html('<p class="well well-sm"><img src = "<?php echo base_url(); ?>../resources/shared_img/preloader.GIF" class = "loader" /> Uploading..</p>');
      var formData = new FormData($(this)[0]);
      $.ajax({
         url: '<?=site_url('Upload/do_upload')?>',
         type: 'POST',
         data: formData,
         cache: false,
         contentType: false,
         enctype: 'multipart/form-data',
         processData: false,
         dataType: 'json',
         success: function (response) {
           // console.log('res',response[0].file_name);
           $(".p_error_msg").html('<p class="well well-sm"><img src = "<?php echo base_url(); ?>../resources/shared_img/preloader.GIF" class = "loader" /> Finishing..</p>');
           var urlString = "<?php echo site_url("ServiceCharges/change_status/") ?>"+enc;
           $.ajax({
               type    : "POST",
               url     : urlString,
               data    : {file_name: response[0].file_name},
               cache   : false,
               dataType: 'json',
               success : function(data)
               {
                   console.log(data);
                   if(data.res == 1)
                   {
                      $(".p_error_msg").html('<div class="alert alert-success"><h4><i class="icon fa fa-check"></i> Upload File Success!</h4>Reloading, please wait..</div><img src = "<?php echo base_url(); ?>../resources/shared_img/preloader.GIF" class = "loader" />');
                      setInterval(function(){
                          location.href="<?=site_url('ServiceCharges')?>";
                      }, 1000);
                   }
               },
               complete : function()
               {
                   
               }
           });  
         }
      });
      return false;
  });
});

    $(document).ready(function ()
    {
        setTimeout(function() {$('.alert').fadeOut(400);}, 4000);

        var table = $("#mytable").DataTable({
          responsive: true,
          dom: 'lfrBtip',
          "processing": true, 
          "serverSide": true, 
          "ajax": {
              "url": "<?=site_url('ServiceCharges/ajaxList')?>",
              "type": "POST"
              // data: function (d) {
              //     d.filter_type = $('#filter_type').val();
              //     d.filter_name = $('#filter_name').val();
              //     d.filter_email = $('#filter_email').val();
              //     d.filter_status = $('#filter_status').val();
              // },
          },
          "pageLength": 50,
          "language": {
              "emptyTable": "No data available in the table",
              "processing": '<div class="alert-danger"><i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"></i>Processing...</div>' //add a loading image,simply putting <img src="loader.gif" /> tag.
          },
          createdRow: function( row, data, dataIndex ) {
            $( row ).find('td:eq(0),td:eq(5),td:eq(6)').addClass('text-center');
          },
          buttons:
          [
        <?php
        if ($permission->cp_create == true) {
        ?>
            {
                text: '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <?php echo $this->lang->line("add_new"); ?>',
                action: function (e, dt, node, config) {
                        redirect("<?php echo site_url('ServiceCharges/create'); ?>");
                      }
            },
        <?php 
        }
        ?>
            {
              extend: 'colvis',
              columns: ':not(:first-child,:last-child)',
              postfixButtons:['colvisRestore']
            }
          ],
          columnDefs:
          [
            {targets: 'no-sort', orderable: false}
          ]
        });

        
    // Apply the search
    table.columns().every(function ()
    {
        var that = this;
        $('input', this.header()).on('keyup change', function ()
        {
            if (that.search() !== this.value) {
              that
              .search(this.value)
              .draw();
          }
      }
      );
    }
    );
}
);
</script>
<script>
    function redirect(url) {
      $(location).attr('href', url);
  }
</script>
