
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> DIASS :: DIGITAL INTEGRATED AIRSIDE SERVICE SYSTEM</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;lang=en" />
        
        <!-- Bootstrap 3.3.6 -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo base_url('resources/themes/AdminLTE/bootstrap/css/3.3.6/bootstrap.min.css'); ?>"  crossorigin="anonymous">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url('resources/shared_css/font-awesome/css/font-awesome.min.css'); ?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url('resources/shared_css/ionicons/css/ionicons.min.css'); ?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url('resources/themes/AdminLTE/dist/css/AdminLTE.min.css'); ?>">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo base_url('resources/themes/AdminLTE/plugins/iCheck/square/blue.css'); ?>">

		<style type="text/css">
			body{
				padding-top: 15px;
			}

			/* .pager li.btnPos > a{
				background-color: #968e8e;
				color: #fff;
			}  */

			.pager li > a{
				background-color: #968e8e;
				color: #fff;
			} 

			.pager li > a:hover{
				background-color: #272525;
			}

			.pager li > a:active{
				background-color: #5768e4;
			} 

			.pager li > a:focus{
				background-color: #5768e4;
			} 
			
			.pager li.answered > a{
				background-color: #5768e4;
				color: #fff;
			} 

			.pager li.btnPos > a{
				width: 45px;
			} 
			
			div#test{ border:#000 1px solid; padding:10px 40px 40px 40px; }
		</style>
            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
            <script src="<?php echo base_url('../resources/shared_js/html5shiv/dist/html5shiv.min.js'); ?>"></script>
            <script src="<?php echo base_url('../resources/shared_js/respond/dest/respond.min.js'); ?>"></script>
            <![endif]-->

        <!-- jQuery 2.2.3 -->
        <script src="<?php echo base_url('resources/shared_js/jquery/2.2.4/dist/jquery.min.js'); ?>"></script>

        <!-- Bootstrap 3.3.6 -->
        <!-- Latest compiled and minified JavaScript -->
        <script src="<?php echo base_url('resources/themes/AdminLTE/bootstrap/js/3.3.6/bootstrap.min.js'); ?>"  crossorigin="anonymous"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url('resources/themes/AdminLTE/plugins/iCheck/icheck.min.js'); ?>"></script>
        <!-- js.cookie.js 2.2.0 -->
        <!-- <script src="<?php echo base_url('resources/shared_js/js.cookie.js'); ?>"></script> -->
		<script src="<?php echo base_url('resources/shared_js/js-storage/js.storage.min.js'); ?>"></script>
		<script src="<?php echo base_url('resources/shared_js/jquery.countdown.min.js'); ?>"></script>
        <script>
			$(document).ready(function () {
				var storage = Storages.localStorage;
				var submitted = false;
				var booking_id = "<?php Print($booking_id); ?>";
				var examsession_id = "<?php Print($examsession_id); ?>";
				var cookiename = 'examsession' + examsession_id;			
				var examset = <?php Print($examset); ?>;	
				var var_cookies =  <?php Print($var_cookies); ?>;
				if(storage.isSet(cookiename)) {
					storage.set(cookiename+'.status', var_cookies.value.status);
					storage.set(cookiename+'.start_time', var_cookies.value.start_time);
					storage.set(cookiename+'.end_time', var_cookies.value.end_time);
				}
				else {
					storage.set(cookiename, var_cookies.value);
				}				
				var examcookie = storage.get(cookiename);
				var language = examcookie.language;
				var currentPos = examcookie.current_question || 0;
				var answers = examcookie.answers;
				var rawtimerdate = examcookie.end_time.toString().replace(/-/g, '/').replace('+', ' ');
				var timerdate = rawtimerdate.replace(rawtimerdate.substring(rawtimerdate.indexOf(".")), "");
				var timeout = false;
				var image_folder = "<?php echo base_url('resources/shared_img/question_bank/'); ?>";
				
				// Expired, show submit button only, can submit even if answers incomplete
				if(examcookie.status == 'expired') {
					currentPos = examset.length-1;
				}
				else {
					renderQuestion(currentPos);
				}
				
				renderBtnPages();
				renderLanguage(language);
				
				// Set timer
				console.log('examcookie.end_time>>', examcookie.end_time);
				console.log('timerdate>>', timerdate);
				$('#clock').countdown(timerdate)
				.on('update.countdown', function(event) {
					// var format = '%H:%M:%S';
					var format = '%M:%S';
					$(this).html(event.strftime(format));
				})
				.on('finish.countdown', function(event) { 
					timeout = true;
					examcookie.status = 'expired';
					renderQuestion(examset.length-1);
					$('#countdown').text('');
					$('#btnSubmit').parent().addClass('answered');
					if(examcookie.language == 'eng') {
						$(this).html('Exam has ended! Please click submit button.');
					}
					else {
						$(this).html('Ujian telah tamat tempoh! Sila klik pada butang Hantar.');
					}
				});

				$("#btnNext").click(function () {
					if(currentPos != examset.length && examcookie.status != 'expired') {
						nextPos = currentPos+1;
						renderQuestion(nextPos);
						storage.set(cookiename+'.current_question', nextPos);
						storage.set(cookiename+'.answers', answers);
						// examcookie.current_question = nextPos;
						// examcookie.answers = answers;
						// Cookiess.set(cookiename, examcookie);
						
					}
				});
				
				$("#btnPrev").click(function () {
					if(currentPos != 0 && examcookie.status != 'expired') {
						prevPos = currentPos-1;
						renderQuestion(prevPos);
						storage.set(cookiename+'.current_question', prevPos);
						storage.set(cookiename+'.answers', answers);
						// examcookie.current_question = prevPos;
						// examcookie.answers = answers;
						// Cookiess.set(cookiename, examcookie);
					}
				});

				// Submit exam answers
				$("#btnSubmit").click(function () {
					// Make sure only submit once
					if($(this).data('disabled') === false) {
						// Check answer count, warn incomplete
						// If count ok populate answer
						$('#exam_answers').val(JSON.stringify(answers));
						$('#examsession_language').val(language);
						count_answers = Object.keys(answers).length;

						if(count_answers < examset.length && !timeout) {							
							alert('Please answer all questions.')
						}	
						else {
							storage.set(cookiename+'.status', 'completed');
							// examcookie.status = 'completed';							
							// Cookiess.set(cookiename, examcookie);							
							$(this).data('disabled', true);
							$('#formCompleteExam').submit();
						}
					}					
				});

				// $("#btnFail").click(function () {
				// 	// Make sure only submit once
				// 	if($(this).data('disabled') === false) {
				// 			examcookie.status = 'completed';
				// 			Cookies.set(cookiename, examcookie);	
				// 			$('#dummy_result').val('fail');						
				// 			$(this).data('disabled', true);
				// 			$('#formCompleteExam').submit();
				// 	}				
				// });

				// $("#btnPass").click(function () {
				// 	// Make sure only submit once
				// 	if($(this).data('disabled') === false) {
				// 			examcookie.status = 'completed';
				// 			Cookies.set(cookiename, examcookie);	
				// 			$('#dummy_result').val('pass');						
				// 			$(this).data('disabled', true);
				// 			$('#formCompleteExam').submit();
				// 	}					
				// });

				$(".btnPos").click(function (t) {
					selected_pos = $(this).data('pos');
					if(currentPos != selected_pos && examcookie.status != 'expired') {
						renderQuestion(selected_pos);
						storage.set(cookiename+'.current_question', selected_pos);
						storage.set(cookiename+'.answers', answers);
						// examcookie.current_question = selected_pos;
						// examcookie.answers = answers;
						// Cookiess.set(cookiename, examcookie);
					}
				});

				$(".btnLang").click(function (t) {
					if(examcookie.status != 'expired') {
						lang = $(this).data('lang');
						language = lang;
						renderLanguage(lang);

						storage.set(cookiename+'.language', lang);
						// examcookie.language = lang;
						// Cookiess.set(cookiename, examcookie);
						refresh_cookies();					
						renderQuestion(currentPos);			
					}					
				});

				// Prevent right click
				$('.exambody').bind('contextmenu', function(e) {
					return false;
				}); 

				// Update answers
				$(document).on('click', 'input:radio', function(){ 
					if(examcookie.status != 'expired') {
						_clicked = $(this).data();		

						if(answers[_clicked.resultid] != _clicked.answerid) {
							$("li.btnPos[data-pos="+_clicked.pos+"]").addClass('answered');

							answers[_clicked.resultid] = _clicked.answerid;
							storage.set(cookiename+'.answers', answers);
							// examcookie.answers = answers;
							// Cookiess.set(cookiename, examcookie);
							refresh_cookies();	
						}
						else {
							$("li.btnPos[data-pos="+_clicked.pos+"]").removeClass('answered');
							answers[_clicked.resultid] = 0;
							$(this).prop('checked', false);
							storage.set(cookiename+'.answers', answers);
							// examcookie.answers = answers;
							// Cookiess.set(cookiename, examcookie);
							refresh_cookies();
						}					
					}
					else {
						return false;
					}					
				});

				$(window).on('beforeunload', function() {
					console.log('beforeunload');
				});

				function refresh_cookies() {
					// Call this everytime after set cookies
					examcookie = storage.get(cookiename);
				}

				function renderLanguage(lang) {
					text = (lang == 'eng' ? 'English' : 'Bahasa Melayu');
					$('.btnLangSelected').text(text);
					$('.btnLangSelected').data('lang', lang);

					text_prev = (lang == 'eng' ? 'Previous' : 'Kembali');
					text_next = (lang == 'eng' ? 'Next' : 'Seterusnya');
					text_countdown = (lang == 'eng' ? 'Time Remaining :' : 'Masa :');
					text_examtitle = (lang == 'eng' ? 'Proficiency Exam for Airside Driving Permit' : 'Ujian Kemahiran untuk Permit Memandu Airside');
					text_submit = (lang == 'eng' ? 'Submit' : 'Hantar');

					$('#btnPrev').text(text_prev);
					$('#btnNext').text(text_next);
					$('#examTitle').text(text_examtitle);
					$('#countdown').text(text_countdown);
					$('#btnSubmit').text(text_submit);
				}

				function renderButtons(pos) {
					if(pos == 0){
						$("#btnPrev").hide();
						$("#btnNext").show();
						$("#btnSubmit").hide();
					}
					else if(pos == (examset.length-1)){
						$("#btnPrev").show();
						$("#btnNext").hide();
						$("#btnSubmit").show();
					}
					else {
						$("#btnPrev").show();
						$("#btnNext").show();
						$("#btnSubmit").hide();
					}
					// alert("#pos"+ (pos+1));
					// $("#pos"+ (pos+1)).css('color','red');
				}

				function renderBtnPages() {
					for(var i=0; i<examset.length; i++) {
						page = i+1;
						if(answers.hasOwnProperty(examset[i].examresult_id)) {
							answered_class = 'answered';
						}
						else {
							answered_class = '';
						}
						$("#btnPager").append("<li class='previous btnPos "+answered_class+"' data-pos='"+i+"'><a href='#'>"+page+"</a></li>");						
					}					
				}

				function renderQuestion(pos) {
					pos = parseInt(pos);
					// Validate index
					if(pos < 0 || pos > (examset.length-1)) {
						pos = 0;
					}

					currentPos = pos;
					renderButtons(pos);
							
					current_set = examset[pos];
					answer_options = current_set.answer_options;
					
					if(language === 'eng'){
						text_test_status = "Question "+(pos+1)+" of "+examset.length;
						text_question = current_set.examquestion_content_eng;

						if(current_set.examquestion_compulsory === 'y') {
							text_test_status = text_test_status + "<h4 style='background-color:red;padding:5px;color:#FFF'><strong>Compulsory question and must be correct</strong></h4>";
						}
					}
						
					else {
						text_test_status = "Soalan "+(pos+1)+" dari "+examset.length;
						text_question = current_set.examquestion_content;

						if(current_set.examquestion_compulsory === 'y') {
							text_test_status = text_test_status + "<h4 style='background-color:red;padding:5px;color:#FFF'>(Soalan wajib betul)</h4>";
						}
					}

					
					if(current_set.examquestion_image) {
						image_question = "<img src='" +image_folder + current_set.examquestion_image +"' class='center-block' height='225'>";
					}
					else{
						image_question = '';
					}
						
					//$("#test_status").html("Hello World");
					//$('#test_status').text('Hello world'); 
					$("#test_status").html(text_test_status);
					$("#test").html(image_question + "<h4>" + text_question + "</h4>");

					render_options(answer_options, current_set.examresult_id, pos);
				}

				function render_options(answer_options, res_id, pos) {
					var char_option = 'A';
					var id_selected = 0;
					
					if(answers.hasOwnProperty(res_id)) {
						id_selected = answers[res_id];
					}

					for(var i=0; i<answer_options.length; i++) {
						var option = answer_options[i];
						if(language === 'eng') {
							text_option = option.answerlist_content_eng;
						}
						else {
							text_option = option.answerlist_content;
						}
						id_option = option.answerlist_id; 
						checked = (id_selected == id_option ? 'checked' : '');

						if(i > 0) {
							char_option = nextChar(char_option);
						}					

						input = "<input class='radio-inline' type='radio' id='"+id_option+"' data-pos='"+pos+"' data-answerid='"+id_option+"' data-resultid='"+current_set.examresult_id+"' name='"+current_set.examresult_id+"' value='"+id_option+"' "+checked+">";
						label = "<label class='radio-inline' style='padding-left:0;' for='"+id_option+"'><h4><b>"+char_option+")</b> "+text_option+"</h4></label><br>";
						ans_opt = "<table><tr><td style='vertical-align:top;padding-top:7px;'>"+input+"</td><td style='vertical-align:top;padding-left:5px;'>"+label+"</td></tr></table>";
						
						// $("#test").append("<input class='radio-inline' type='radio' id='"+id_option+"' data-pos='"+pos+"' data-answerid='"+id_option+"' data-resultid='"+current_set.examresult_id+"' name='"+current_set.examresult_id+"' value='"+id_option+"' "+checked+">");
						// $("#test").append("<label class='radio-inline' style='padding-left:0;' for='"+id_option+"'><h4><b>"+char_option+")</b> "+text_option+"</h4></label><br>");

						$("#test").append(ans_opt);
					}
				}

				function nextChar(c) {
					return String.fromCharCode(c.charCodeAt(0) + 1);
				}

				function set_language(lang) {
					// Set cookie
					renderQuestion();
				}
            }); 
        </script>
    </head>
    <body>        
        <div class="container">
			<div class="row">  
                <div class="col-sm-3 col-xs-12"><img src="<?php echo base_url('resources/shared_img/logo.jpg'); ?>" width="200" alt=""></div>
                <div class="col-sm-6 col-xs-12">
                    <h2 id="examTitle" class="text-center"><?php echo $this->lang->line('examdriver_title'); ?></h1>
                </div>
                <div class="col-sm-3 col-xs-12 vcenter">
                    <div class="pull-right" style="width:130px;">
                        <div><span style="font-size: 40px; float: left;" class="glyphicon glyphicon-time"></span></div>
                        <div class="text-right">
                            <strong><?php echo sprintf($this->lang->line('examdriver_minutes'), $timelimit); ?></strong>
                        </div>
                        <div class="text-right">
                            <?php echo date('d M Y') ?>
                        </div>
                    </div>
                </div>
            </div>  
			<?php echo $driver; ?>
            <div class="jumbotron exambody" style="-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;" 
				unselectable="on"
				onselectstart="return false;" 
				onmousedown="return false;">
				<div class="row">
					<div class="col-xs-12">
					
						<div class="text-center" style="font-size:15px;">
							<span id="countdown"><?php echo $this->lang->line('examdriver_timeremaining'); ?></span>
							<span class="countdown"></span>							
						<span id="clock"></span>
						</div>
					</div>
				</div>
                <div class="hidden">
                    <form autocomplete="off" id='formCompleteExam' method="post" action="<?php echo site_url('Examdriver/do_exam'); ?>">
                        <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
                        <input type="hidden" name="ic_no" value="<?php echo $ic_no; ?>">
						<input type="hidden" name="examsession_id" value="<?php echo $examsession_id; ?>">
						<input type="hidden" id="examsession_language" name="examsession_language">
						<input type="text" id="exam_answers" name="exam_answers" value="">
						<input type="text" id="dummy_result" name="dummy_result" value="">
                    </form>
                </div>
                <div class="btn-group dropdown pull-right">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" >
						<?php 
						if(strtolower($driver_category) != 'a') {
							echo '<span class="lang-sm lang-lbl-full btnLangSelected" data-lang="eng">English</span> <span class="caret"></span>';
						}
						else {
							echo '<span class="lang-sm lang-lbl-full btnLangSelected" data-lang="my">Bahasa Melayu</span> <span class="caret"></span>';
						}						
						?>                        
                    </button>
                    <ul class="dropdown-menu" role="menu">
						<?php 
						if(strtolower($driver_category) != 'a') { 
							echo '<li><a class="btnLang" data-lang="eng" href="#">English</a></li>';
						}
						?>                        
                        <li><a class="btnLang" data-lang="my" href="#">Bahasa Melayu</a></li>
                    </ul>
                </div> 				
				<div>
					<h2 id="test_status"></h2>
					<div id="test"></div>
				</div> 
				<div class="row">
					<div class="col-xs-2">
						<ul class="pager">
							<li class="previous"><a style="border-radius:0;" id="btnPrev" href="#">Previous</a></li>
						</ul>
					</div>
					<div class="col-xs-8">
						
					</div>
					<div class="col-xs-2">
						<ul class="pager pull-right">
							<li class="next"><a  style="border-radius:0;" id="btnNext" href="#">Next</a></li>
						</ul>
						<ul class="pager pull-right">
							<li class="next"><a style="border-radius:0;" id="btnSubmit" href="#" data-disabled="false">Submit</a></li>
							<!-- <br>
							<button type="button" id="btnPass" class="btn btn-success" data-disabled="false">Pass</button>
							<button type="button" id="btnFail" class="btn btn-danger" data-disabled="false">Fail</button> -->
						</ul>
					</div>
				</div>
				<div class="row">
					<ul id="btnPager" class="pager text-justify"></ul>
				</div>  
            </div>
        </div>        
    </body>
</html>