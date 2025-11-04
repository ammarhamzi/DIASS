<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Task Management</title>

        <!-- cdn -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

        <style>
            body{
                padding: 15px;
            }

            .container-fluid {
                margin-right: auto;
                margin-left: auto;
                /*max-width: 960px !important;  or 950px */
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">

            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span> <?php echo $this->lang->line('tasks'); ?> <?php echo $this->lang->line('detail'); ?></h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <table class="table table-condensed table-responsive">

                                   <tr>
                                <th class="col-md-3">ID</th>
                                <td class="col-md-9"><?php echo 'T'; ?><?php printf("%07d",
    $task_id);
?></td>
                                       </tr>

                                   <tr>
                                <th class="col-md-3"><?php echo $this->lang->line('task_name'); ?></th>
                                <td class="col-md-9"><?php echo $task_name; ?></td>
                                       </tr>

                                   <tr>
                                <th class="col-md-3"><?php echo $this->lang->line('task_desc'); ?></th>
                                <td class="col-md-9"><?php echo $task_desc; ?></td>
                                       </tr>

                                   <tr>
                                <th class="col-md-3"><?php echo $this->lang->line('task_weight'); ?></th>
                                <td class="col-md-9"><?php echo $task_weight; ?></td>
                                       </tr>

                                   <tr>
                                <th class="col-md-3"><?php echo $this->lang->line('task_priority'); ?></th>
                                <td class="col-md-9"><?php echo $task_priority; ?></td>
                                       </tr>

                                   <tr>
                                <th class="col-md-3">Related Task</th>
                                <td class="col-md-9">
                                    <?php
if (!empty($task_related)) {
    ?>
                                        <?php echo 'T'; ?><?php printf("%07d",
        $task_related)
    ;?>
                                        <?php
}
?>
                                </td>
                                       </tr>

                                   <tr>
                                <th class="col-md-3">To</th>
                                <td class="col-md-9"><?php echo $task_to; ?></td>
                                       </tr>

                                   <tr>
                                <th class="col-md-3">By</th>
                                <td class="col-md-9"><?php echo $task_from; ?></td>
                                       </tr>

                                   <tr>
                                <th class="col-md-3">Request</th>
                                <td class="col-md-9"><?php echo $task_date; ?></td>
                                       </tr>

                                   <tr>
                                <th class="col-md-3">Finish</th>
                                <td class="col-md-9"><?php echo $task_duedate; ?></td>
                                       </tr>

                                   <tr>
                                <th class="col-md-3">Work Minutes</th>
                                <td class="col-md-9"><?php echo $task_hour; ?> Min</td>
                                       </tr>

                                   <tr>
                                <th class="col-md-3"><?php echo $this->lang->line('task_status'); ?></th>
                                <td class="col-md-9"><?php echo $task_status; ?></td>
                                       </tr>

                                   <tr>
                                <th class="col-md-3"><?php echo $this->lang->line('task_progress'); ?></th>
                                <td class="col-md-9"><?php echo $task_progress; ?></td>
                                       </tr>
                                   <tr>
                                <th class="col-md-3">Attachment</th>
                                <td><p><a href="<?php echo base_url(); ?>resources/shared_img/<?php echo ($task_image
    ? $task_image
    : 'system/no-image.jpg');
?>" target="_blank"><img src = "<?php echo base_url(); ?>resources/shared_img/<?php echo ($task_image
    ? $task_image
    : 'system/no-image.jpg');
?>" width="100" height="100" /></a></p></td>
                                       </tr>
                                   <tr>
                                <th class="col-md-3"><?php echo $this->lang->line('task_remark'); ?></th>
                                <td class="col-md-9"><?php echo $task_remark; ?></td>
                                       </tr>

                        </table>
                    </div>
                    <div class="col-md-6">
                        <div id="commentlist" style="height: 250px;overflow-y: scroll;">
                            <?php
$start = 0;
foreach ($chatlist as $taskchat) {

    if ($taskchat->taskchat_memberid == $this->session->userdata('id')) {
        $color                   = 'background-color:#EEEEEE;';
        $taskchat->user_username = "You (" . $taskchat->user_username . ")";
    } else {
        $color = "";
    }
    ?>

                                <div style="<?php echo $color; ?>">
                                    <span style="font-size: xx-small;"><?php echo $taskchat->user_username; ?>, <?php echo $taskchat->taskchat_date; ?></span>
                                    <p><?php echo $taskchat->taskchat_content; ?></p>
                                </div>
                                <hr style="width: 100%; height: 1px; background-color: #000000; margin-top: -10px;">

    <?php
}
?>
                        </div>
                        <div class="container-fluid">

                            <div class="panel panel-info">
                                <div class="panel-body">
                                    <h4><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <?php echo $this->lang->line('task_comments'); ?> </h4>

                                    <form autocomplete="off" action="<?php echo $action; ?>" method="post">

                                                  <input type='hidden' name="taskchat_memberid" id="taskchat_memberid" value="<?php
echo $this->session->userdata('id');

?>" />

                                        <div class="row">
                                            <div class="col-md-12"><textarea class="form-control" name="taskchat_content" id="taskchat_content" placeholder="<?php echo $this->lang->line('taskchat_content'); ?>" rows="5" cols="50"> </textarea>
                                                         </div></div>
                                                  <input type='hidden' name="taskchat_date" id="taskchat_date" value="<?php
echo date('Y-m-d h:i:s');

?>" />

                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="hidden" name="task_id" value="<?php echo $task_id; ?>" />
                                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> <?php echo $this->lang->line('task_sendcomment'); ?></button>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <a href="javascript:parent.$.fancybox.close();" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back'); ?></a>
                    </div>

                </div>
            </div>
        </div>
        <script>
        $(document).ready(function ()
          {
            $('#commentlist').scrollTop($('#commentlist').height());
          }
        );
        </script>
    </body>
</html>
