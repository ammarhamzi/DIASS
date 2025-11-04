
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
        <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('title'); ?> <?php //echo $this->lang->line('list'); ?></li>
    </ol>
    <div class="row">
        <div class="col-md-12 text-center">
            <div id="message" style=" position: fixed;right: 25px;z-index: 9;">
                <?php
                echo $this->session->userdata('message') != '' ? '<span class="alert alert-success" role="alert">' . $this->session->userdata('message') . '</span>' : '';
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 pull-right">
     <a href="/resources/tutorial/user-manual-enforcement.pdf" target="_blank" class="pull-right"><img src="/resources/shared_img/pdf_icons.png" width="32" height="32" alt="">User Manual</a>
        </div>
    </div>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><span class="glyphicon glyphicon-inbox"></span> &nbsp;<?php echo 'Add Offence';//$this->lang->line('title'); ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            
            <form method="POST" action="" id="frm_search_keyword">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="form-group">
                        <label>Search By : </label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="search_by" id="search_by1" value="1" checked> IC / Passport No
                            </label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label>
                                <input type="radio" name="search_by" id="search_by2" value="2" > Reg Number
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="search_keyword" id="search_keyword" class="form-control">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-flat">Search <i class="glyphicon glyphicon-search"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            </form>

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="div_result"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="nav-tabs-custom">
        <ul class="nav nav-pills nav-justified">
            <li class="active"><a href="#tab_driver" data-toggle="pill">Driver List</a></li>
            <li><a href="#tab_vehicle" data-toggle="pill">Vehicle Vehicle</a></li>
        
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_driver">
                <div class="box box-default">
                    <div class="box-header with-border">
                      
                    </div>
                    
                    <div class="box-body">
                        <table id="mytable" class="table" style="width: 100% !important">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo 'IC / Passport Number';//$this->lang->line('user_username'); ?></th>
                                    <th><?php echo 'Name';//$this->lang->line('user_username'); ?></th>
                                    <th><?php echo 'Contact Number';//$this->lang->line('user_name'); ?></th>
                                    <th><?php echo 'Merit Points';//$this->lang->line('user_email'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $start = 0;
                                if ($driver_list) {

                                    foreach ($driver_list as $r) {

                                      ?>
                                      <tr>
                                        <td><?php echo ++$start; ?></td>
                                        <td><a href="<?=site_url('Enforcement/create_driver/?i=' . $r->driver_id)?>"><?php echo $r->driver_ic; ?></a></td>
                                        <td><?php echo $r->driver_name; ?></td>
                                        <td><?php echo $r->driver_hpno; ?></td>
                                        <td><?php echo $r->merit_point; ?></td>
                                    </tr>
                                    <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo 'IC / Passport Number';//$this->lang->line('user_username'); ?></th>
                                    <th><?php echo 'Name';//$this->lang->line('user_username'); ?></th>
                                    <th><?php echo 'Contact Number';//$this->lang->line('user_name'); ?></th>
                                    <th><?php echo 'Merit Points';//$this->lang->line('user_email'); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                
            </div>
            
            <div class="tab-pane" id="tab_vehicle">
                <div class="box box-default">
                    <div class="box-header with-border">
                      
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="mytable_vehicle" class="table" style="width: 100% !important">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo 'Reg Number';//$this->lang->line('user_username'); ?></th>
                                    <th><?php echo 'Type';//$this->lang->line('user_username'); ?></th>
                                    <th><?php echo 'Year Manufacture';//$this->lang->line('user_name'); ?></th>
                                    <th><?php echo 'Merit Points';//$this->lang->line('user_email'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $start = 0;
                                if ($vehicle_list) {

                                    foreach ($vehicle_list as $r) {

                                      ?>
                                      <tr>
                                        <td><?php echo ++$start; ?></td>
                                        <td><a href="<?=site_url('Enforcement/create_vehicle/?i=' . $r->vehicle_id)?>"><?php echo $r->vehicle_registration_no; ?></a></td>
                                        <td><?php echo $r->vehicle_type; ?></td>
                                        <td><?php echo $r->vehicle_year_manufacture; ?></td>
                                        <td><?php echo $r->merit_point; ?></td>
                                    </tr>
                                    <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo 'Reg Number';//$this->lang->line('user_username'); ?></th>
                                    <th><?php echo 'Type';//$this->lang->line('user_username'); ?></th>
                                    <th><?php echo 'Year Manufacture';//$this->lang->line('user_name'); ?></th>
                                    <th><?php echo 'Merit Points';//$this->lang->line('user_email'); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php /* ?>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo 'Offence';//$this->lang->line('title'); ?> <?php echo $this->lang->line('list'); ?></h4>
        </div>
        <div class="panel-body">
            
        </div>
    </div>
    <?php */ ?>
</div>
<script type="text/javascript">
    $(function(){
        $('#frm_search_keyword').on('submit',function(e){
            e.preventDefault();
            $('.div_result').addClass('text-center').html('<p><img src = "<?php echo base_url(); ?>../resources/shared_img/preloader.GIF" class = "loader" /></p>');

            var search_by = $("input[name='search_by']:checked").val(),
                search_keyword = $('#search_keyword').val();
            if(search_keyword == "")
            {
                alert('Search something!');
                $('#search_keyword').focus();
                $('.div_result').removeClass('text-center').html('');
                return false;
            }
            var dataString = 'search_by='+search_by+'&search_keyword='+search_keyword;
            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url("Enforcement/find_keyword") ?>",
                data    : dataString,
                cache   : false,
                dataType: 'json',
                success : function(data)
                {
                    console.log(data);
                    if(data.res == 0 || data.res == 2)
                    {
                        $('.div_result').removeClass('text-center').html('');
                        $('.div_result').html(data.output);
                    }
                    else if(data.res == 1)
                    {
                        location.href = data.output;
                    }
                },
                complete : function()
                {
                    
                }
            });  
        });

        $('a[data-toggle="pill"]').on("shown.bs.tab", function (e) {
            var id = $(e.target).attr("href");
            localStorage.setItem('selectedTab', id)
        });

        var selectedTab = localStorage.getItem('selectedTab');
        if (selectedTab != null) {
            $('a[data-toggle="pill"][href="' + selectedTab + '"]').tab('show');
        }
    });
    $(document).ready(function ()
    {
        setTimeout(function() {$('.alert').fadeOut(400);}, 4000);
        var table = $("#mytable").DataTable(
        {
            responsive: true,
            dom: 'lfrBtip',
            buttons:[
                <?php if ($permission->printlist == true) { ?>
                {
                    extend: 'collection',
                    text: '<span class="glyphicon glyphicon-export" aria-hidden="true"></span> <?php echo $this->lang->line("export"); ?>',
                    buttons:[
                        {
                              extend: 'excelHtml5',
                              title: '<?php echo $this->lang->line("data_export"); ?>',
                              exportOptions: {
                                columns:[0, 1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            title: '<?php echo $this->lang->line("data_export"); ?>',
                            message: '<?php echo $this->lang->line("any_message"); ?>',
                            download: 'open',
                            exportOptions: {
                                columns:[0, 1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'print',
                            title: '<?php echo $this->lang->line("data_export"); ?>',
                            exportOptions: {
                                columns:[0, 1, 2, 3, 4]
                            }
                        }
                    ]
                },
                <?php }?>
                {
                  extend: 'colvis',
                  columns: ':not(:first-child,:last-child)',
                  postfixButtons:['colvisRestore']
                }
            ],
            columnDefs:[
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

    $(document).ready(function ()
    {
        // setTimeout(function() {$('.alert').fadeOut(400);}, 4000);
        var table = $("#mytable_vehicle").DataTable(
        {
          responsive: true,
          dom: 'lfrBtip',
          buttons:[
          <?php
          if ($permission->printlist == true) {
            ?>
            {
              extend: 'collection',
              text: '<span class="glyphicon glyphicon-export" aria-hidden="true"></span> <?php echo $this->lang->line("export"); ?>',
              buttons:[

              {
                  extend: 'excelHtml5',
                  title: '<?php echo $this->lang->line("data_export"); ?>',
                  exportOptions: {
                    columns:[0, 1, 2, 3, 4]
                }
            },
            {
              extend: 'pdfHtml5',
              title: '<?php echo $this->lang->line("data_export"); ?>',
              message: '<?php echo $this->lang->line("any_message"); ?>',
              download: 'open',
              exportOptions: {
                columns:[0, 1, 2, 3, 4]
                }
            },
            {
              extend: 'print',
              title: '<?php echo $this->lang->line("data_export"); ?>',
              exportOptions: {
                columns:[0, 1, 2, 3, 4]
            }
        }

        ]
    },

<?php }?>
{
  extend: 'colvis',
  columns: ':not(:first-child,:last-child)',
  postfixButtons:['colvisRestore']
}
],
columnDefs:[
{targets: 'no-sort', orderable: false}
]

}
);
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
