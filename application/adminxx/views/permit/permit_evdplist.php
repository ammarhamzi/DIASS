<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            <?php echo $this->lang->line('permit_evdp_comleted');?>
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
                <?php echo $this->lang->line('permit_evdp_comleted');?>
                <?php echo $this->lang->line('list');?>
            </h4>
        </div>
        <div class="panel-body">

            <table id="mytable" class="table" style="width: 100% !important">

                <thead>
                    <tr>
                        <th class="no-sort">#</th>
<!--                        <th>
                            <?php echo $this->lang->line('permit_groupid');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('permit_typeid');?>
                        </th>-->
                        <th>
                            <?php echo $this->lang->line('permit_bookingid');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('permit_issuance_serialno');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('permit_issuance_startdate');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('permit_issuance_expirydate');?>
                        </th>
<!--                        <th>
                            <?php echo $this->lang->line('permit_status');?>
                        </th>-->

                        <th class="no-sort">&nbsp;</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
<!--                        <th>
                            <?php echo $this->lang->line('permit_groupid');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('permit_typeid');?>
                        </th>-->
                        <th>
                            <?php echo $this->lang->line('permit_bookingid');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('permit_issuance_serialno');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('permit_issuance_startdate');?>
                        </th>
                        <th>
                            <?php echo $this->lang->line('permit_issuance_expirydate');?>
                        </th>
<!--                        <th>
                            <?php echo $this->lang->line('permit_status');?>
                        </th>-->

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
        /*    $('#mytable thead th').each( function (i) {
                    if(i==1 || i==6) {
                        var title = $(this).text();
                        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
                        }
                } );*/
        var table = $("#mytable").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "<?php echo site_url() ?>/permit/get_json_evdp",
            responsive: true,
            dom: 'lfrBtip',
            buttons: [
                <?php
           if($permission->cp_create == true){
         ?> {
                    text: '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <?php echo $this->lang->line("add_new");?>',
                    action: function(e, dt, node, config) {
                        redirect("<?php echo site_url('permit/create');?>");
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
                                columns: [0, 1, 2, 3, 4, 5, 6]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            title: '<?php echo $this->lang->line("data_export");?>',
                            message: '<?php echo $this->lang->line("any_message");?>',
                            download: 'open',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6]
                            }
                        },
                        {
                            extend: 'print',
                            title: '<?php echo $this->lang->line("data_export");?>',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6]
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
            }],
            initComplete: function() {
                this.api().columns().every(function(i) {
/*                    if (i == 1 || i == 7) {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.header()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });
                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>')
                        });
                    }*/
                });
            }
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