<!-- \resources\gen_template\master\crud-newpage\views -->
<style type="text/css">
 tfoot {
    display: table-header-group;
}

select {
    width: 150px;
    overflow: hidden;
    text-overflow: ellipsis;
}

select option {
    white-space: nowrap;
    width: 100%; border-bottom: 1px #ccc solid;
    /* This doesn't work. */
}
</style>
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            <?php echo $pagetitle;?>
        </li>
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
<!--    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                <?php echo $this->lang->line('permitall');?>
                <?php echo $this->lang->line('list');?>
            </h4>
        </div>
        <div class="panel-body">-->
                    <div class="box  box-primary">
                        <div class="box-header with-border">
                                    <i class="fa fa-file-text-o"></i>

                                    <h3 class="box-title"><?php echo $pagetitle;?></h3>
                                    <div class="box-tools pull-right">

                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                        <!-- /.box-header -->
                        <div class="box-body">
<form id="locationform" name="locationform" action="" method="POST">
                            <div class="panel panel-default">
    <div class="panel-body">
        <span><input id="all" name="location" type="radio" value="all" <?php echo (empty($this->input->post('location')) || $this->input->post('location')=="all"?"checked":"");?>> ALL </span>
        <span style=" margin-left:25px;"><input id="klia" name="location" type="radio" value="KLIA" <?php echo ($this->input->post('location')=="KLIA"?"checked":"");?>> KLIA </span>
        <span style=" margin-left:25px;"><input id="klia2" name="location" type="radio" value="KLIA2" <?php echo ($this->input->post('location')=="KLIA2"?"checked":"");?>> KLIA2 </span>
        <span style=" margin-left:25px;"><input id="mtw" name="location" type="radio" value="MTW" <?php echo ($this->input->post('location')=="MTW"?"checked":"");?>> MTW </span>
<!--<input type="submit" name="submit" id="submit" value="submit">-->

    </div>
</div>
</form>

            <table id="mytable" class="table table-bordered table-hover" style="width: 100% !important">

                <thead>
                    <tr>
                        <!--<th class="no-sort">#</th> -->
                        <th>Company</th>
                        <th>
                            <?php echo $this->lang->line('permit_bookingid');?>
                        </th>

                        <th>
                            Driver / Operator / Vehicle ID
                        </th>
                        <th>
                            <?php echo $this->lang->line('permit_typeid');?>
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Inspection Date
                        </th>
                        <th>
                            <?php echo $this->lang->line('permit_created_at');?>
                        </th>
                        <th>
                            Expiry Date
                        </th>
                        <th>Permit Type</th>
                        <th>Permit Condition</th>
                        <th>PIC</th>

                        <th>Processed By</th>
                        <th>Current Step </th>
                        <th class="no-sort">&nbsp;</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <!--<th>#</th>-->
                        <th>Company</th>
                        <th>
                            <?php echo $this->lang->line('permit_bookingid');?>
                        </th>

                        <th>
                            Driver / Operator / Vehicle ID
                        </th>
                        <th>
                            <?php echo $this->lang->line('permit_typeid');?>
                        </th>
                        <th>
                            &nbsp;
                        </th>
                        <th>
                            Inspection Date
                        </th>
                        <th>
                            <?php echo $this->lang->line('permit_created_at');?>
                        </th>
                        <th>
                            Expiry Date
                        </th>
                        <th>Permit Type</th>
                        <th>Permit Condition</th>
                        <th>PIC</th>

                        <th>Processed By</th>
                        <th>Current Step </th>
                        <th>&nbsp;</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').fadeOut(400);
        }, 4000);

                        $('#mytable tfoot th').each(function (i) {
                            if (i == 0 || i == 1 || i == 2) {
                                var title = $(this).text();
                                $(this).html('<input type="text" placeholder="Search ' + title.trim() + '" size="8" />');
                            }

                            if (i == 5 || i == 6 || i == 7) {
                                var title = $(this).text();
                                $(this).html('<input type="text" placeholder="Search ' + title.trim() + '" size="8" class="datepicker_local" />');
                            }
                            /*    if (i == 0) {

                             $(this).html( '<input type="text" placeholder="Search IC />' );
                             }
                             if (i == 1) {

                             $(this).html( '<input type="text" placeholder="Search Nama />' );
                             }*/
                        });

        var table = $("#mytable").DataTable({
            "order": [[6,'desc']],
            "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
            "processing": true,
            "serverSide": true,
            "ajax": "<?php echo site_url() ?>/<?php echo $controller;?>/get_json/<?php echo $this->input->post('location');?>",
            responsive: true,
            dom: 'lrBtip',
                            initComplete: function () {
                                this.api().columns().every(function (i) {
                                    if (i == 3 || i == 9) {
                                        var column = this;
                                        var select = $('<select></select>')
                                                .appendTo($(column.footer()).empty())
                                                .on('change', function () {
                                                    var val = $.fn.dataTable.util.escapeRegex(
                                                            $(this).val()
                                                            );

                                                    column
                                                            .search(val ? '^' + val + '$' : '', true, false)
                                                            .draw();
                                                });

                                        /*    column.data().unique().sort().each(function (d, j) {
                                         select.append('<option value="' + d + '">' + d + '</option>')
                                         });*/

                                        if (i == 3) {
                                            select.append('<option value="">All</option>');
/*                                            select.append('<option value="Airside Driving Permit">Airside Driving Permit</option>');
                                            select.append('<option value="Electrical Vehicle Driving Permit">Electrical Vehicle Driving Permit</option>');*/
select.append('<option value="Electrical Vehicle Permit">Electrical Vehicle Permit</option>');
select.append('<option value="Airside Vehicle Permit">Airside Vehicle Permit</option>');
/*select.append('<option value="Passenger Boarding Bridge">Passenger Boarding Bridge</option>');
select.append('<option value="Visual Docking Guidance System">Visual Docking Guidance System</option>');*/
/*select.append('<option value="Preconditioned Air Unit">Preconditioned Air Unit</option>');
select.append('<option value="Ground Power Unit">Ground Power Unit</option>');*/
/*select.append('<option value="Work In Progress (Taxiway & Runway)">Work In Progress (Taxiway & Runway)</option>');
select.append('<option value="Commercial Supplier">Commercial Supplier</option>');
select.append('<option value="Stakeholder">Stakeholder</option>');
select.append('<option value="Work In Progress (Others Areas)">Work In Progress (Others Areas)</option>');
select.append('<option value="Stakeholder (Inspection required)">Stakeholder (Inspection required)</option>');*/
                                        }
                                        if (i == 4) {
                                            select.append('<option value="">All</option>');
                                            select.append('<option value="completed">completed</option>');
                                            select.append('<option value="inprogress">inprogress</option>');
                                            select.append('<option value="pending">pending</option>');
                                            select.append('<option value="pendingpayment">pendingpayment</option>');
                                            select.append('<option value="paid">paid</option>');
                                            select.append('<option value="expired">expired</option>');
                                            select.append('<option value="rejected">rejected</option>');
                                            select.append('<option value="canceled">canceled</option>');
                                            select.append('<option value="suspended">suspended</option>');
                                            select.append('<option value="terminated">terminated</option>');
                                            select.append('<option value="replaced">replaced</option>');
                                            select.append('<option value="failed">failed</option>');
                                        }
                                        if (i == 9) {
                                            select.append('<option value="">All</option>');
                                            select.append('<option value="1">New</option>');
                                            select.append('<option value="2">Renewal</option>');
                                        }
                                    }
                                });
                            },
            buttons: [
/*                <?php
           if($permission->cp_create == true){
         ?> {
                    text: '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <?php echo $this->lang->line("add_new");?>',
                    action: function(e, dt, node, config) {
                        redirect("<?php echo site_url('permitall/create');?>");
                    }
                },
                <?php }?>*/
                <?php
           if($permission->printlist == true){
         ?> {
                    extend: 'collection',
                    text: '<span class="glyphicon glyphicon-export" aria-hidden="true"></span> <?php echo $this->lang->line("export");?>',
                    buttons: [{
                            extend: 'excelHtml5',
                            title: '<?php echo $this->lang->line("data_export");?>',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 6,7,8,9,10,11,12]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            title: '<?php echo $this->lang->line("data_export");?>',
                            message: '<?php echo $this->lang->line("any_message");?>',
                            download: 'open',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'print',
                            title: '<?php echo $this->lang->line("data_export");?>',
                            exportOptions: {
                                columns: ':visible'
                            }
                        }
                    ]
                },
                <?php }?> {
                    extend: 'colvis',
                    columns: ':not(:first-child,:last-child)',
                    postfixButtons: ['colvisRestore']
                }
            ],
            columnDefs: [
                {
                    targets: 'no-sort',
                    orderable: false
                },
                {
                    "targets": [6,7,8,9,10,11,12],
                    "visible": false,
                    "searchable": false
                }]
        });
        // Apply the search
        table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });
    });
</script>
<script>
    function redirect(url) {
        $(location).attr('href', url);
    }
</script>
<script>
$(document).ready(function() {
$("input[name='location']").click(function () {
//alert('xx');
$('#locationform').submit();
});
});
</script>