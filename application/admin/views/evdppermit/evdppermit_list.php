<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            <?php echo $this->lang->line('evdppermit');?>
            <?php echo $this->lang->line('list');?>
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
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                <?php echo $this->lang->line('evdppermit');?>
                <?php echo $this->lang->line('list');?>
            </h4>
        </div>
        <div class="panel-body">

            <table id="mytable" class="table" style="width: 100% !important">

                <thead>
                    <tr>
                        <th class="no-sort">#</th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_permit_id');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_driver_id');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_recent_permitno');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_recent_expirydate');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_driveracknowledgement');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_driveracknowledgement_date');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_certbyemployer');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_certbyemployer_date');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_certbytrainer');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_certbytrainer_date');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_course_date');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_terminalbriefingscheduled');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_terminalbriefingapproval');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_attendterminalbriefing');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_completed_docs');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_approvedby_airside');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_created_at');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_updated_at');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_deleted_at');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_lastchanged_by');?>
                        </th>

                        <th class="no-sort">&nbsp;</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_permit_id');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_driver_id');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_recent_permitno');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_recent_expirydate');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_driveracknowledgement');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_driveracknowledgement_date');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_certbyemployer');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_certbyemployer_date');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_certbytrainer');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_certbytrainer_date');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_course_date');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_terminalbriefingscheduled');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_terminalbriefingapproval');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_attendterminalbriefing');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_completed_docs');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_approvedby_airside');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_created_at');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_updated_at');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_deleted_at');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('evdppermit_lastchanged_by');?>
                        </th>

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
        var table = $("#mytable").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "<?php echo site_url() ?>/evdppermit/get_json",
            responsive: true,
            dom: 'lfrBtip',
            buttons: [
                <?php
           if($permission->cp_create == true){
         ?> {
                    text: '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <?php echo $this->lang->line("add_new");?>',
                    action: function(e, dt, node, config) {
                        redirect("<?php echo site_url('evdppermit/create');?>");
                    }
                },
                <?php }?>
                <?php
           if($permission->printlist == true){
         ?> {
                    extend: 'collection',
                    text: '<span class="glyphicon glyphicon-export" aria-hidden="true"></span> <?php echo $this->lang->line("export");?>',
                    buttons: [{
                            extend: 'excelHtml5',
                            title: '<?php echo $this->lang->line("data_export");?>',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            title: '<?php echo $this->lang->line("data_export");?>',
                            message: '<?php echo $this->lang->line("any_message");?>',
                            download: 'open',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20]
                            }
                        },
                        {
                            extend: 'print',
                            title: '<?php echo $this->lang->line("data_export");?>',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20]
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
            columnDefs: [{
                targets: 'no-sort',
                orderable: false
            }]
        });
        // Apply the search
        table.columns().every(function() {
            var that = this;
            $('input', this.header()).on('keyup change', function() {
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