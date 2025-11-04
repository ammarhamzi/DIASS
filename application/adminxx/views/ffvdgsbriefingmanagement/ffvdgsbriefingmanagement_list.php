<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
<ol class="breadcrumb">
  <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
  <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('ffvdgsbriefingmanagement');?> <?php echo $this->lang->line('list');?></li>
</ol>

<!--parentchildmenu-->

<!--      <div class="row">
         <div class="col-md-12 text-center">
            <div id="message" style=" position: fixed;right: 25px;">
               <?php echo $this->session->userdata('message') <> '' ? '<span class="alert alert-success" role="alert">'.$this->session->userdata('message').'</span>' : ''; ?>
            </div>
         </div>
      </div>-->
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
                    <div class="box  box-primary">
                        <div class="box-header with-border">
                                    <i class="fa fa-file-text-o"></i>

                                    <h3 class="box-title"><?php echo $this->lang->line('ffvdgsbriefingmanagement');?></h3>
                                    <div class="box-tools pull-right">

                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                        <!-- /.box-header -->
                        <div class="box-body">



            <table id="mytable" class="table" style="width: 100% !important">

               <thead>
                  <tr>
                     <th class="no-sort">#</th>
                     <th><?php echo $this->lang->line('ffvdgs_briefingmanagement_date');?></th>
<th><?php echo $this->lang->line('ffvdgs_briefingmanagement_category');?></th>
<th><?php echo $this->lang->line('ffvdgs_briefingmanagement_location');?></th>
<th><?php echo $this->lang->line('ffvdgs_briefingmanagement_slot');?></th>
<th>Remark</th>
                     <th class="no-sort">&nbsp;</th>
                  </tr>
               </thead>
               <tfoot>
                  <tr>
                     <th>#</th>
                     <th><?php echo $this->lang->line('ffvdgs_briefingmanagement_date');?></th>
<th><?php echo $this->lang->line('ffvdgs_briefingmanagement_category');?></th>
<th><?php echo $this->lang->line('ffvdgs_briefingmanagement_location');?></th>
<th><?php echo $this->lang->line('ffvdgs_briefingmanagement_slot');?></th>
<th>Remark</th>
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


             var table =   $("#mytable").DataTable(
             {
                 "lengthMenu": [ [10, 25, 50, 100, 100000], [10, 25, 50, 100, "All"] ],
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo site_url() ?>/ffvdgsbriefingmanagement/get_json",
               responsive: true,
         dom: 'lfrBtip',
         buttons: [
          <?php
           if($permission->cp_create == true){
         ?>

         {                 text: '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <?php echo $this->lang->line("add_new");?>',
             action: function ( e, dt, node, config ) {
                 redirect("<?php echo site_url('ffvdgsbriefingmanagement/create');?>");
             } },
         <?php }?>
          <?php
           if($permission->printlist == true){
         ?>
                     {
             extend: 'collection',
             text: '<span class="glyphicon glyphicon-export" aria-hidden="true"></span> <?php echo $this->lang->line("export");?>',
         buttons: [

         {
             extend: 'excelHtml5',
             title: '<?php echo $this->lang->line("data_export");?>',
             exportOptions: {
                 columns: [0,1,2,3,4]
             }
         },
         {
             extend: 'pdfHtml5',
             title: '<?php echo $this->lang->line("data_export");?>',
             message: '<?php echo $this->lang->line("any_message");?>',
             download: 'open',
             exportOptions: {
                 columns: [0,1,2,3,4]
             }
         },
         {
             extend: 'print',
             title: '<?php echo $this->lang->line("data_export");?>',
             exportOptions: {
                 columns: [0,1,2,3,4]
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
         columnDefs: [
  { targets: 'no-sort', orderable: false }
]

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
         function redirect(url){
         $(location).attr('href',url);
         }
      </script>