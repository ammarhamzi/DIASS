<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            <?php echo $this->lang->line('exambanklist');?>
            <?php echo $this->lang->line('list');?>
        </li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <!--Ajax Here-->
            <div id="master_detail"></div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Sub Detail</div>
        <div class="panel-body">

            <!--parentchildmenu-->

            <div class="row">
                <div class="col-md-12 text-center">
                    <div id="message" style=" position: fixed;right: 25px;">
                        <?php echo $this->session->userdata('message') <> '' ? '<span class="alert alert-success" role="alert">'.$this->session->userdata('message').'</span>' : ''; ?>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h4><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                <?php echo $this->lang->line('exambanklist_general');?>
                                <?php echo $this->lang->line('list');?>
                            </h4>
                        </div>
                        <div class="panel-body">

                            <table id="mytable" class="table" style="width: 100% !important">

                                <thead>
                                    <tr>
                                        <th class="no-sort">#</th>
                                        <th>
                                            <?php echo $this->lang->line('exambanklist_examquestion_id');?>
                                        </th>

                                        <th class="no-sort">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>
                                            <?php echo $this->lang->line('exambanklist_examquestion_id');?>
                                        </th>

                                        <th>&nbsp;</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
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
<script>
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url("exambank/read/$parentid/raw") ?>',
            success: function(data) {
                //alert(data);
                $('#master_detail').html(data);
                setTimeout(function() {
                    $('.alert').fadeOut(400);
                }, 4000);
                var table = $("#mytable").DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "<?php echo site_url() ?>/exambanklist/get_json/<?php echo $parent_id ?>/general",
                    responsive: true,
                    dom: 'lfrBtip',
                    buttons: [
                        <?php
           if($permission->cp_create == true){
         ?> {
                            text: '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <?php echo $this->lang->line("add_new");?>',
                            action: function(e, dt, node, config) {
                                redirect("<?php echo site_url('exambanklist/create/'.$parentid);?>");
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
                                        columns: [0, 1]
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    title: '<?php echo $this->lang->line("data_export");?>',
                                    message: '<?php echo $this->lang->line("any_message");?>',
                                    download: 'open',
                                    exportOptions: {
                                        columns: [0, 1]
                                    }
                                },
                                {
                                    extend: 'print',
                                    title: '<?php echo $this->lang->line("data_export");?>',
                                    exportOptions: {
                                        columns: [0, 1]
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
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus + ': ' + errorThrown);
            }
        });
    });
</script>