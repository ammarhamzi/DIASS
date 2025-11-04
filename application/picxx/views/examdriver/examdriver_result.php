<style type="text/css">
    .nav-tabs {
        padding-left: 15px;
        margin-bottom: 0;
        border: none;
    }

    .tab-content {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 15px;
    }
</style>
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
        <li><a href="<?php echo site_url('permitall'); ?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> My Permits</a></li>
        <li><a href="<?php echo base_url('permitall/adp/'.$permit_id); ?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> ADP Permit</a></li>
        <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
           Competency Test
        </li>
    </ol>

    <!--parentchildmenu-->

    <div class="box box-primary exambody">
        <div class="box-header with-border">
            <h3 class="box-title">Competency Test</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body" style="-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;" 
            unselectable="on"
            onselectstart="return false;" 
            onmousedown="return false;">
            <div>
                <div class="row">
                    <div class="col-md-12">
                    <?php 
                    if($examquestions) {
                        echo '<table class="table">';
                        $i = 0;
                        $qb_folder = base_url('../resources/shared_img/question_bank/');
                        // $permit_folder = base_url('permitall/adp/'.fixzy_encoder($booking_id));

                        foreach($examquestions as $q){
                            $i++;

                            if($q->examquestion_image != '') {
                                $image_question = sprintf('<img src="%s%s" class="center-block" height="225">', $qb_folder, $q->examquestion_image);
                            }
                            else {
                                $image_question = "";
                            }

                            $compulsory_header1 = '';
                            $compulsory_header2 = '';
                            // The actual question
                            if($language == 'eng') {
                                $question = $q->examquestion_content_eng;
                                $correct_answer = 'Your answer is correct';
                                $wrong_answer = 'Your answer is wrong';

                                if($q->examquestion_compulsory == 'y') {
                                    $compulsory_header1 = '<br>';
                                    $compulsory_header2 = '<span style="color: red"><strong>(Compulsory question and must be correct)</strong></span><br>';
                                }
                            }
                            else {
                                $question = $q->examquestion_content;
                                $correct_answer = 'Jawapan anda betul';
                                $wrong_answer = 'Jawapan anda salah';

                                if($q->examquestion_compulsory == 'y') {
                                    $compulsory_header1 = '<br>';
                                    $compulsory_header2 = '<span style="color: red"><strong>(Soalan wajib betul)</strong></span><br>';
                                }
                            }
                            echo '<tr><td>'.$compulsory_header1.$i.')</td>';
                            echo '<td>'.$compulsory_header2.$image_question.$question;

                            $i_char = 0;
                            $correct = sprintf('<img src="%s" width="18" height="18" alt=""> <span>%s<span>', base_url('../resources/shared_img/correct.png'), $correct_answer);
                            $wrong = sprintf('<img src="%s" width="18" height="18" alt=""> <span>%s<span>', base_url('../resources/shared_img/wrong.png'), $wrong_answer);

                            foreach($q->answer_options as $answer) {
                                $answer = (object) $answer;
                                $i_char++;
                                
                                if($language == 'eng') {
                                    $option = $answer->answerlist_content_eng;
                                }
                                else {
                                    $option = $answer->answerlist_content;
                                }

                                if($i_char == 1) {
                                    $char_option = 'A';
                                }
                                else if($i_char == 2) {
                                    $char_option = 'B';
                                }
                                else {
                                    $char_option = 'C';
                                }

                                if($answer->answerlist_correct == 'y') {
                                    $span_class = " style='background-color:#00FF00;'";
                                }
                                else {
                                    $span_class = "";
                                }

                                if($answer->answer_selected == 'y') {
                                    $selected_answer = '<span>'.($answer->answerlist_correct == 'y' ? $correct : $wrong).'</span>';
                                }
                                else {
                                    $selected_answer= "";
                                }
                                echo sprintf('<br><span %s>%s)  %s</span> %s',$span_class, $char_option, $option, $selected_answer);
                            }
                            echo '</td></tr>';

                        }                       
                        echo '</table>';                        
                    }  
                    ?>
                    </div>
                </div>                
            </div> 
            <br>
            <a href="<?php echo base_url('permitall/adp/'.$permit_id); ?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back'); ?></a>
        </div>
    </div>
    <script>
        $('.exambody').bind('contextmenu', function(e) {
            return false;
        }); 
    </script>
</div>
