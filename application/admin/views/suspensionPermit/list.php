
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
        <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo 'Permit Suspend';//$this->lang->line('service_charges'); ?> <?php echo $this->lang->line('list'); ?></li>
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

    <div class="box  box-primary">
        <div class="box-header with-border">
            <i class="fa fa-file-text-o"></i>
            <h3 class="box-title">Permit Suspend</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="mytable" class="table" >

                <thead>
                    <tr>
                        <th class="no-sort">#</th>
                        <th><?php echo 'Company';//$this->lang->line('user_username'); ?></th>
                        <th><?php echo 'Permit Number';//$this->lang->line('user_username'); ?></th>
                        <!-- <th><?php //echo 'Driver / Vehicle';//$this->lang->line('user_name'); ?></th> -->
                        <th><?php echo 'Permit';//$this->lang->line('user_email'); ?></th>
                        <th><?php echo 'Application Date';//$this->lang->line('user_email'); ?></th>
                        <th class="no-sort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo 'Company';//$this->lang->line('user_username'); ?></th>
                        <th><?php echo 'Permit Number';//$this->lang->line('user_username'); ?></th>
                        <!-- <th><?php //echo 'Driver / Vehicle';//$this->lang->line('user_name'); ?></th> -->
                        <th><?php echo 'Permit';//$this->lang->line('user_email'); ?></th>
                        <th><?php echo 'Application Date';//$this->lang->line('user_email'); ?></th>
                        <th>&nbsp;</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>



<script type="text/javascript">
$(function(){
  
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
          "url": "<?=site_url('suspensionpermit/ajaxListSuspend')?>",
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
          "processing": '<div class="alert alert-danger"><i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"></i>Processing...</div>' //add a loading image,simply putting <img src="loader.gif" /> tag.
      },
      buttons:
      [
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
    table.columns().every(function () {
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
    });
});
</script>
<script>
    function redirect(url) {
      $(location).attr('href', url);
  }
</script>
