<head>
    <link href="<?php echo base_url('../resources/shared_js/summernote/dist/summernote.css'); ?>" rel="stylesheet">
    <script src="<?php echo base_url('../resources/shared_js/summernote/dist/summernote.min.js'); ?>"></script>
</head>

<?php 
    if($examquestion_category != '') {
        $category = explode("|", $examquestion_category);
        foreach ($category as $value) {
            if($value == 'examquestion_cat_a') {
                $examquestion_cat_a = 'y';
            }
            else if($value == 'examquestion_cat_b1') {
                $examquestion_cat_b1 = 'y';
            }
            else if($value == 'examquestion_cat_b2') {
                $examquestion_cat_b2 = 'y';
            }
            else if($value == 'examquestion_cat_c') {
                $examquestion_cat_c = 'y';
            }
        } 
    }
    
    if(strip_tags(trim($examquestion_content)) == '') {
        $examquestion_content = '';
    }

    if(strip_tags(trim($examquestion_content_eng)) == '') {
        $examquestion_content_eng = '';
    }
?>

<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li><a href="<?php echo site_url('examquestion');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('examquestion');?> <?php echo $this->lang->line('list');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            <?php echo $this->lang->line('form');?>
            <?php echo $button ?>
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
        <div class="box-body">
            <div class="row col-md-12">
                <h5 class="pull-right">
                    <?php echo $this->lang->line('legend');?> <span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span>
                    <?php echo $this->lang->line('required_field');?>
                </h5>
            </div>
            <div class="form-row">
                <div class="col-md-9">
                    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                    
                    <div class="row form-group">
                        <label class="col-md-3 text-right">
                            <?php echo $this->lang->line('examquestion_category');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup>
                        </label>
                        <div class="col-md-9">
                            <label class="checkbox-inline" for="examquestion_cat_a">
                            <input type="checkbox" class="examcategory" name="examquestion_cat_a" id="examquestion_cat_a" value="y" <?php if($examquestion_cat_a == 'y') { echo 'checked';} ?>>A</label>
                            
                            <label class="checkbox-inline" for="examquestion_cat_b1">
                            <input type="checkbox" class="examcategory" name="examquestion_cat_b1" id="examquestion_cat_b1" value="y" <?php if($examquestion_cat_b1 == 'y') { echo 'checked';} ?>>B1</label>
                            
                            <label class="checkbox-inline" for="examquestion_cat_b2">
                            <input type="checkbox" class="examcategory" name="examquestion_cat_b2" id="examquestion_cat_b2" value="y" <?php if($examquestion_cat_b2 == 'y') { echo 'checked';} ?>>B2</label>
                            
                            <label class="checkbox-inline" for="examquestion_cat_c">
                            <input type="checkbox" class="examcategory" name="examquestion_cat_c" id="examquestion_cat_c" value="y" <?php if($examquestion_cat_c == 'y') { echo 'checked';} ?>>C</label>
                            
                            <?php echo form_error('examquestion_category') ?>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-right">
                            <?php echo $this->lang->line('examquestion_compulsory');?>
                        </label>
                        <div class="col-md-9">
                            <label class="checkbox-inline" for="examquestion_cat_a_compulsory">
                            <input type="checkbox" class="examcategorycompulsory" name="examquestion_cat_a_compulsory" id="examquestion_cat_a_compulsory" value="y" <?php if($examquestion_cat_a_compulsory == 'y') { echo 'checked';} ?>>A</label>
                            
                            <label class="checkbox-inline" for="examquestion_cat_b1_compulsory">
                            <input type="checkbox" class="examcategorycompulsory" name="examquestion_cat_b1_compulsory" id="examquestion_cat_b1_compulsory" value="y" <?php if($examquestion_cat_b1_compulsory == 'y') { echo 'checked';} ?>>B1</label>
                            
                            <label class="checkbox-inline" for="examquestion_cat_b2_compulsory">
                            <input type="checkbox" class="examcategorycompulsory" name="examquestion_cat_b2_compulsory" id="examquestion_cat_b2_compulsory" value="y" <?php if($examquestion_cat_b2_compulsory == 'y') { echo 'checked';} ?>>B2</label>
                            
                            <label class="checkbox-inline" for="examquestion_cat_c_compulsory">
                            <input type="checkbox" class="examcategorycompulsory" name="examquestion_cat_c_compulsory" id="examquestion_cat_c_compulsory" value="y" <?php if($examquestion_cat_c_compulsory == 'y') { echo 'checked';} ?>>C</label>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-right">
                            <?php echo $this->lang->line('examquestion_image');?>
                        </label>
                        <div class="col-md-9">
                        <div class="row col-md-12">
                            <input type="file" class ="form-control" id="uploadimage" name="examquestion_image">
                            <?php 
                                $qb_folder = base_url('../resources/shared_img/question_bank/');
                                if($examquestion_image != '') {
                                    echo sprintf('<img src="%s%s" height="225" style="padding-top:5px;"><br>', $qb_folder, $examquestion_image);
                                }
                            ?>                            
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-right">
                            <?php echo $this->lang->line('examquestion_content_bm');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup>
                        </label>
                        <div class="col-md-9">
                            <?php 
                                if(form_error('examquestion_content')) 
                                    echo sprintf('<div style="padding-bottom:5px;">%s</div>', form_error('examquestion_content'));   
                            ?>
                            <div class="row col-md-12">
                                <textarea class="form-control summernote" name="examquestion_content" id="examquestion_content" placeholder="<?php echo $this->lang->line('examquestion_content');?>" rows="5" cols="50"><?php echo $examquestion_content; ?></textarea>                                
                            </div>                             
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-right">
                            <?php echo $this->lang->line('examquestion_content_eng');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> 
                        </label>
                        <div class="col-md-9">
                            <?php 
                                if(form_error('examquestion_content_eng')) 
                                    echo sprintf('<div style="padding-bottom:5px;">%s</div>', form_error('examquestion_content_eng'));   
                            ?>
                            <div class="row col-md-12">
                                <textarea class="form-control summernote" name="examquestion_content_eng" id="examquestion_content_eng" placeholder="<?php echo $this->lang->line('examquestion_content_eng');?>" rows="5" cols="50"><?php echo $examquestion_content_eng; ?></textarea>                     
                            </div>         
                        </div>
                    </div>

                    <!-- Answer 1 -->
                    <div class="row form-group">
                        <label class="col-md-3 text-right">
                            <?php echo $this->lang->line('examquestion_answer'). ' 1';?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> 
                        </label>
                        <div class="col-md-9">
                            <div class="">
                                <label class="checkbox-inline" for="examanswerlist_correctanswer_1">
                                <input type="checkbox" class="correctanswer" name="examanswerlist_correctanswer_1" id="examanswerlist_correctanswer_1" value="y" <?php if($examanswerlist_correctanswer_1 == 'y') { echo 'checked';} ?>> <?php echo $this->lang->line('examquestion_correct_answer');?> </label> 
                            </div>
                            <div class="row">
                                <label class="col-md-12"><?php echo $this->lang->line('examquestion_malay'); ?> <?php echo form_error('examanswerlist_content_1') ?></label>
                            </div>
                            <div class="row col-md-12">
                                <textarea class="form-control summernote" name="examanswerlist_content_1" id="examanswerlist_content_1" placeholder="<?php echo $this->lang->line('examquestion_content');?>" rows="5" cols="50"><?php echo $examanswerlist_content_1; ?></textarea>
                            </div>
                            <div class="row">
                                <label class="col-md-12"><?php echo $this->lang->line('examquestion_english'); ?> <?php echo form_error('examanswerlist_content_eng_1') ?></label>
                            </div>                     
                            <div class="row col-md-12">
                                <textarea class="form-control summernote" name="examanswerlist_content_eng_1" id="examanswerlist_content_eng_1" placeholder="<?php echo $this->lang->line('examquestion_content');?>" rows="5" cols="50"><?php echo $examanswerlist_content_eng_1; ?></textarea>
                            </div>       
                        </div>
                    </div>
                    <!-- Answer 2 -->
                    <div class="row form-group">
                        <label class="col-md-3 text-right">
                            <?php echo $this->lang->line('examquestion_answer'). ' 2';?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup>
                        </label>
                        <div class="col-md-9">
                            <div class="">
                                <label class="checkbox-inline" for="examanswerlist_correctanswer_2">
                                <input type="checkbox" class="correctanswer" name="examanswerlist_correctanswer_2" id="examanswerlist_correctanswer_2" value="y" <?php if($examanswerlist_correctanswer_2 == 'y') { echo 'checked';} ?>> <?php echo $this->lang->line('examquestion_correct_answer');?> <?php echo form_error('examquestion_correctanswer') ?></label>
                            </div>
                            <div class="row">
                                <label class="col-md-12"><?php echo $this->lang->line('examquestion_malay'); ?> <?php echo form_error('examanswerlist_content_2') ?></label> 
                            </div>
                            <div class="row col-md-12">
                                <textarea class="form-control summernote" name="examanswerlist_content_2" id="examanswerlist_content_2" placeholder="<?php echo $this->lang->line('examquestion_content');?>" rows="5" cols="50"><?php echo $examanswerlist_content_2; ?></textarea>
                            </div>
                            <div class="row">
                                <label class="col-md-12"><?php echo $this->lang->line('examquestion_english'); ?> <?php echo form_error('examanswerlist_content_eng_2') ?></label> 
                            </div>                     
                            <div class="row col-md-12">
                                <textarea class="form-control summernote" name="examanswerlist_content_eng_2" id="examanswerlist_content_eng_2" placeholder="<?php echo $this->lang->line('examquestion_content');?>" rows="5" cols="50"><?php echo $examanswerlist_content_eng_2; ?></textarea>
                            </div>       
                        </div>
                    </div>
                    <!-- Answer 3 -->
                    <div class="row form-group">
                        <label class="col-md-3 text-right">
                            <?php echo $this->lang->line('examquestion_answer'). ' 3';?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup>
                        </label>
                        <div class="col-md-9">
                            <div class="">
                                <label class="checkbox-inline" for="examanswerlist_correctanswer_3">
                                <input type="checkbox" class="correctanswer" name="examanswerlist_correctanswer_3" id="examanswerlist_correctanswer_3"  value="y" <?php if($examanswerlist_correctanswer_3 == 'y') { echo 'checked';} ?>> <?php echo $this->lang->line('examquestion_correct_answer');?> <?php echo form_error('examquestion_correctanswer') ?></label>
                            </div>
                            <div class="row">
                                <label class="col-md-12"><?php echo $this->lang->line('examquestion_malay'); ?> <?php echo form_error('examanswerlist_content_3') ?></label>
                            </div>
                            <div class="row col-md-12">
                                <textarea class="form-control summernote" name="examanswerlist_content_3" id="examanswerlist_content_3" placeholder="<?php echo $this->lang->line('examquestion_content');?>" rows="5" cols="50"><?php echo $examanswerlist_content_3; ?></textarea>
                            </div>
                            <div class="row">
                                <label class="col-md-12"><?php echo $this->lang->line('examquestion_english'); ?> <?php echo form_error('examanswerlist_content_eng_3') ?></label>
                            </div>                     
                            <div class="row col-md-12">
                                <textarea class="form-control summernote" name="examanswerlist_content_eng_3" id="examanswerlist_content_eng_3" placeholder="<?php echo $this->lang->line('examquestion_content');?>" rows="5" cols="50"><?php echo $examanswerlist_content_eng_3; ?></textarea>
                            </div>       
                        </div>
                    </div>
                    

                    <div class="row form-group">
                        <div class="col-md-offset-3 col-md-9">
                            <input type="hidden" name="examquestion_id" value="<?php echo (isset($id)?$id:" "); ?>" />
                            <input type="hidden" name="examanswerlist_id_1" value="<?php echo (isset($examanswerlist_id_1)?$examanswerlist_id_1:" "); ?>" />
                            <input type="hidden" name="examanswerlist_id_2" value="<?php echo (isset($examanswerlist_id_2)?$examanswerlist_id_2:" "); ?>" />
                            <input type="hidden" name="examanswerlist_id_3" value="<?php echo (isset($examanswerlist_id_3)?$examanswerlist_id_3:" "); ?>" />
                            <input type="hidden" name="examquestion_mark" value="1" />
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> <?php echo $button ?></button>
                            <a href="<?php echo site_url('examquestion') ?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>
                        </div>
                        <div style="display: none;">
                            <input type="text" name="examquestion_category" id="examquestion_category" value="<?php echo $examquestion_category; ?>">
                            <input type="text" name="examquestion_correctanswer" id="examquestion_correctanswer" value="<?php echo $examquestion_correctanswer; ?>">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($id)) {
?>
    <script>
        $(document).ready(function() {
            var arr = [];
            $.each(arr, function(i, val) {
                $("#" + val).prop("disabled", true);
                $("#" + val).after("<input type='hidden' name='" + val + "' id='" + val + "' value='" + $("#" + val).val() + "'>");
            });
        });
    </script>
    <?php
}
?>
    <script>
        $(document).ready(function() {
            // My JS
            check_correctanswer();
            $('.summernote').summernote(
                {
                    disableDragAndDrop: true,
                    toolbar: [], 
                    placeholder: "<?php echo $this->lang->line('examquestion_summernote_info');?>",
                    height: 100,
                    callbacks: {
                        onPaste: function (e) {
                            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                            e.preventDefault();
                            document.execCommand('insertText', false, bufferText.replace(/\n/g, ''));
                        }
                    }
                }
            );

            $('.examcategory').change(function(e) {
                if(!this.checked) {
                    var category_compulsory = '#' + e.currentTarget.id + '_compulsory'
                    $(category_compulsory).prop("checked", this.checked);
                }  

                check_category();
            });

            $('.examcategorycompulsory').change(function(e) {
                if(this.checked) {
                    var category = ('#' + e.currentTarget.id).replace('_compulsory','');
                    $(category).prop("checked", this.checked);
                }
                check_category();
            });

            $('.correctanswer').change(function(e) {
                if(this.checked) {
                    $('.correctanswer').each(function(idx, chk) {                    
                        if(chk.id != e.currentTarget.id) {
                            $('#'+chk.id).prop("checked", false);
                        }
                    });
                }  
                check_correctanswer();
            });

            function check_category() {
                var category = '';
                
                $('.examcategory').each(function(idx, chk) {     
                    
                    if($('#'+chk.id).prop("checked")) {
                        category += chk.id + '|';
                    }  
                    
                });
                $('#examquestion_category').val(category);
            }

            function check_correctanswer() {
                var correct = ''
                $('.correctanswer').each(function(idx, chk) {     
                    
                    if($('#'+chk.id).prop("checked")) {
                        correct += chk.id + '|';
                    }  
                    
                });
                $('#examquestion_correctanswer').val(correct);
            }

            // OLder js
            $(".btn-remote-file").click(function() {
                $('input[type=file]').trigger('click');
            });
            $(document).on('change', '.btn-file :file', function() {
                var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [numFiles, label]);
            });
            $(document).ready(function() {
                $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
                    var input = $(this).parents('.input-group').find(':text'),
                        log = numFiles > 1 ? numFiles + ' files selected' : label;
                    if (input.length) {
                        input.val(log);
                        $(this).parents('.input-group').find(":submit").click();
                    } else {
                        //if( log ) alert(log);
                    }
                });
            });            
        });
    </script>
    <script>
        function clear_form_elements(id) {
            jQuery("#testingDiv" + id).find(':input').each(function() {
                switch (this.type) {
                    case 'password':
                    case 'text':
                    case 'textarea':
                    case 'file':
                    case 'select-one':
                    case 'select-multiple':
                        jQuery(this).val('');
                        break;
                    case 'checkbox':
                    case 'radio':
                        this.checked = false;
                }
            });
        }
        $(function() {
            $(".clonedInput:first").before('<div id="add-buttons"><input class="btn btn-success" type="button" id="btnAdd" value="<?php echo $this->lang->line('
                add_more_child ');?>"></div><hr style="width: 100%">');
            if ($('.clonedInput').length > 1) {
                $('.clonedInput').each(function() {
                    var pos = $(this).attr('id');
                    pos = pos.replace('testingDiv', '');
                    $(this).append('<input type="button" id="btnDel" name="button" class="action-button btn btn-danger" value="<?php echo $this->lang->line('
                        x ');?>" position="' + pos + '"/>');
                    $(this).append('<input type="button" id="btnClear" name="button" class="action-button btn btn-default" value="<?php echo $this->lang->line('
                        clear ');?>" position="' + pos + '"/><hr style="width: 100%">');
                });
            } else {
                $(".clonedInput:first").append('<input type="button" id="btnDel" name="button" class="action-button btn btn-danger" value="<?php echo $this->lang->line('
                    x ');?>" position="1" disabled="disabled"/>');
                $(".clonedInput:first").append('<input type="button" id="btnClear" name="button" class="action-button btn btn-default" value="<?php echo $this->lang->line('
                    clear ');?>" position="1"/><hr style="width: 100%">');
            }
            //$('#btnAdd').click(function () {
            $('body').on('click', '#btnAdd', function() {
                var num = $('.clonedInput').length, // how many "duplicatable" input fields we currently have
                    newNum = new Number(num + 1), // the numeric ID of the new input field being added
                    randomID = Math.floor((Math.random() * 1000) + 1),
                    cleanelem = $(".clonedInput:last").find('select.select2').select2("destroy"),
                    newElem = $(".clonedInput:last").clone(true, true).attr('id', 'testingDiv' + randomID).fadeIn('slow'); // create the new element via clone(), and manipulate it's ID using newNum value
                newElem.find('.action-button').attr('position', randomID).prop("disabled", false);
                newElem.find('.datepicker').removeClass('hasDatepicker').attr('id', '').datepicker();
                newElem.find('.datetimepicker').removeClass('hasDatepicker').attr('id', '').datetimepicker();
                // insert the new element after the last "duplicatable" input field
                $(".clonedInput:last").after(newElem);
                $("select.select2").select2();
                clear_form_elements(randomID);
                // manipulate the name/id values of the input inside the new element
                // enable the "remove" button
                $('#btnDel').attr('disabled', false);
                // right now you can only add 5 sections. change '5' below to the max number of times the form can be duplicated
                if (newNum == 5) $('#btnAdd').attr('disabled', true).prop('value', "<?php echo $this->lang->line('reach_limit');?>");
            });
            $('body').on('click', '#btnDel', function() {
                //$('#btnDel').click(function () {
                var position = $(this).attr("position");
                var num = $('.clonedInput').length;
                $('#testingDiv' + position).slideUp('slow', function() {
                    $(this).remove();
                    // if only one element remains, disable the "remove" button
                    if (num - 1 === 1) {
                        $('#btnDel:last').attr('disabled', true);
                    }
                    // enable the "add" button
                    $('#btnAdd').attr('disabled', false).prop('value', "<?php echo $this->lang->line('add_to_form');?>");
                });
            });
            $('body').on('click', '#btnClear', function() {
                var position = $(this).attr("position");
                clear_form_elements(position);
            });

            
        });
    </script>