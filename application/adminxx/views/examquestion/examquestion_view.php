<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li><a href="<?php echo site_url('examquestion');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('examquestion');?> <?php echo $this->lang->line('list');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            <?php echo $this->lang->line('examquestion');?>
            <?php echo $this->lang->line('detail');?>
        </li>
    </ol>
    <div class="box  box-primary">
        <div class="box-header with-border">
            <i class="fa fa-file-text-o"></i>
            <h3 class="box-title"><?php echo $button.' '.$this->lang->line('examquestion');?> </h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body" style="-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;" 
            unselectable="on"
            onselectstart="return false;" 
            onmousedown="return false;">

            <div class="box-body" style="-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;" 
            unselectable="on"
            onselectstart="return false;" 
            onmousedown="return false;">

                <?php 
                    $i = 0;
                    $qb_folder = base_url('../resources/shared_img/question_bank/');

                    if($examquestion_image != '') {
                        $image_question = sprintf('<img src="%s%s" class="center-block" height="225"><br>', $qb_folder, $examquestion_image);
                    }
                    else {
                        $image_question = "N/A";
                    }    
                ?>
                
                <div class="row col-md-12">
                    <div class="col-md-2"><?php echo $this->lang->line('examquestion_category'); ?>:</div>
                    <div class="col-md-10"><?php echo $examquestion_category; ?></div>
                </div>
                
                <div class="row col-md-12">
                    <div class="col-md-2"><?php echo $this->lang->line('examquestion_compulsory'); ?>:</div>
                    <div class="col-md-10"><?php echo $examquestion_compulsory; ?></div>
                </div>
                
                <div class="row col-md-12">
                    <div class="col-md-2"><?php echo $this->lang->line('examquestion_image'); ?>:</div>
                    <div class="col-md-10"><?php echo $image_question; ?></div>
                </div>
                
                <div class="row col-md-12">
                    <div class="col-md-2"><br><?php echo $this->lang->line('examquestion_malay'); ?>:</div>
                    <div class="col-md-10">
                        <?php 
                        echo '<br>';
                        echo $examquestion_content;
                        $i_char = 0;
                        foreach($examquestion_answers as $answer) {
                            $answer = (object) $answer;
                            $i_char++;                                
                            if($i_char == 1) {
                                $char_option = 'A';
                            }
                            else if($i_char == 2) {
                                $char_option = 'B';
                            }
                            else {
                                $char_option = 'C';
                            }

                            if($answer->examanswerlist_correctanswer == 'y') {
                                $span_class = " style='background-color:#00FF00;'";
                            }
                            else {
                                $span_class = "";
                            }

                            echo sprintf('<br><span %s>%s)  %s</span> ',$span_class, $char_option, $answer->examanswerlist_content);
                        }
                    ?>
                    </div>
                </div>  
                
                <div class="row col-md-12">
                    <div class="col-md-2"><br><?php echo $this->lang->line('examquestion_english'); ?>:</div>
                    <div class="col-md-10">
                        <?php 
                        echo "<br>";
                        echo $examquestion_content_eng;
                        $i_char = 0;
                        foreach($examquestion_answers as $answer) {
                            $answer = (object) $answer;
                            $i_char++;                                
                            if($i_char == 1) {
                                $char_option = 'A';
                            }
                            else if($i_char == 2) {
                                $char_option = 'B';
                            }
                            else {
                                $char_option = 'C';
                            }

                            if($answer->examanswerlist_correctanswer == 'y') {
                                $span_class = " style='background-color:#00FF00;'";
                            }
                            else {
                                $span_class = "";
                            }

                            echo sprintf('<br><span %s>%s)  %s</span> ',$span_class, $char_option, $answer->examanswerlist_content_eng);
                        }
                    ?>
                    </div>
                </div>    
            </div> 
            <br>
            <!-- <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> <?php echo $button ?></button> -->
            <a href="<?php echo base_url('examquestion/update/'.$examquestion_id); ?>" class="btn btn-primary"> <?php echo $this->lang->line('update'); ?></a>
        </div>
    </div>
</div>