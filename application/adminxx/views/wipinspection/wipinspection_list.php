<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('wipinspection');?> <?php echo $this->lang->line('list');?></li>
    </ol>

<!--parentchildmenu-->

    <div class="row">
        <div class="col-md-12 text-center">
            <div id="message" style=" position: fixed;right: 25px;">
                <?php echo $this->session->userdata('message') <> '' ? '<span class="alert alert-success" role="alert">'.$this->session->userdata('message').'</span>' : ''; ?>
            </div>
        </div>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">
                <h4><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('wipinspection');?> <?php echo $this->lang->line('list');?></h4>
        </div>
        <div class="panel-body">
            <table id="mytable" class="table" style="width: 100% !important">   
                <thead>
                    <tr>
                        <th><?php echo $this->lang->line('wipinspection_booking_id');?></th>
                        <th><?php echo $this->lang->line('wipinspection_vehicle_regno');?></th>
                        <th><?php echo $this->lang->line('wipinspection_vehicle_type');?></th>
                        <th><?php echo $this->lang->line('wipinspection_vehicle_year_manufacture');?></th>
                        <th><?php echo $this->lang->line('wipinspection_company_name');?></th>
                        <th><?php echo $this->lang->line('wipinspection_vehicle_type');?></th>
                        <th><?php echo $this->lang->line('wipinspection_vehicle_status');?></th>
                        <th class="no-sort">&nbsp;</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th><?php echo $this->lang->line('wipinspection_booking_id');?></th>
                        <th><?php echo $this->lang->line('wipinspection_vehicle_regno');?></th>
                        <th><?php echo $this->lang->line('wipinspection_vehicle_type');?></th>
                        <th><?php echo $this->lang->line('wipinspection_vehicle_year_manufacture');?></th>
                        <th><?php echo $this->lang->line('wipinspection_company_name');?></th>
                        <th><?php echo $this->lang->line('wipinspection_vehicle_type');?></th>
                        <th><?php echo $this->lang->line('wipinspection_vehicle_status');?></th>
                        <th>&nbsp;</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        setTimeout(function(){ $('.alert').fadeOut(400); }, 4000);
            var table = $("#mytable").DataTable({
                processing: true,
                serverSide: true,
                ajax: "<?php echo site_url() ?>/wipinspection/get_json",
                responsive: true,
                dom: 'lfrBtip',
                buttons: [

                <?php if($permission->printlist == true){ ?>
                    {
                        extend: 'collection',
                        text: '<span class="glyphicon glyphicon-export" aria-hidden="true"></span> <?php echo $this->lang->line("export");?>',
                        buttons: [
                            {
                                extend: 'excelHtml5',
                                title: '<?php echo $this->lang->line("data_export");?>',
                                exportOptions: {
                                    columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23]
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                title: '<?php echo $this->lang->line("data_export");?>',
                                message: '<?php echo $this->lang->line("any_message");?>',
                                download: 'open',
                                exportOptions: {
                                    columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23]
                                }
                            },
                            {
                                extend: 'print',
                                title: '<?php echo $this->lang->line("data_export");?>',
                                exportOptions: {
                                    columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23]
                                }
                            }
                        ]
                    },

                <?php }?>
                    {
                        extend: 'colvis',
                        columns: ':not(:first-child,:last-child)',
                        postfixButtons: [ 'colvisRestore' ]
                    }
                ],
                columnDefs: [ { targets: 'no-sort', orderable: false } ]
            });

            // Apply the search
            table.columns().every( function () {
                var that = this;

                $( 'input', this.header() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );



    });
</script>
<script>
    function redirect(url) {
        $(location).attr('href',url);
    }
</script>