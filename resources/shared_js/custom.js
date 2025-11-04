

     //$(window).load(function() {
$(window).on('load', function() {

        setTimeout(show, 300);
        });

        function show(){
        $('#loading').hide();
        }
		
function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

function addWorkDays(startDate, days) {
    if(isNaN(days)) {
        console.log("Value provided for \"days\" was not a number");
        return
    }
    if(!(startDate instanceof Date)) {
        console.log("Value provided for \"startDate\" was not a Date object");
        return
    }
    // Get the day of the week as a number (0 = Sunday, 1 = Monday, .... 6 = Saturday)
    var dow = startDate.getDay();
    var daysToAdd = parseInt(days);
    // If the current day is Sunday add one day
    if (dow == 0)
        daysToAdd++;
    // If the start date plus the additional days falls on or after the closest Saturday calculate weekends
    if (dow + daysToAdd >= 6) {
        //Subtract days in current working week from work days
        var remainingWorkDays = daysToAdd - (5 - dow);
        //Add current working week's weekend
        daysToAdd += 2;
        if (remainingWorkDays > 5) {
            //Add two days for each working week by calculating how many weeks are included
            daysToAdd += 2 * Math.floor(remainingWorkDays / 5);
            //Exclude final weekend if remainingWorkDays resolves to an exact number of weeks
            if (remainingWorkDays % 5 == 0)
                daysToAdd -= 2;
        }
    }
    startDate.setDate(startDate.getDate() + daysToAdd);
    return startDate;
}

$(document).ready(function()
  {

if (typeof jQuery.ui !== 'undefined'){
$.datepicker.setDefaults({
     dateFormat: 'dd-mm-yy'
});
}


if($('.yearpicker').length)
{
$('.yearpicker').yearselect({
    start: 1979,
    end: new Date().getFullYear(),
    order: 'desc'
});
} 

if($('.richtexteditor').length){
$('textarea,.textarea').htmlarea();
}
      if($('.select2').length){
          /* do something */
         $(".select2").select2();
       }

      if($('.isAlphaNumericOnly').length){
          /* do something */
    $('.isAlphaNumericOnly').alphanum(
    {
      allowSpace         : false,
      allowNewline       : false,
      allowCaseless      : false,
      allowOtherCharSets : false,
    }
    );
       }


if($('.isNumericOnly').length)
{
    $('.isNumericOnly').numeric(); //number with , - .
}

if($('.isInteger').length)
{
    $('.isInteger').numeric(
    {
      allowMinus          : false,
      allowThouSep        : false,
      allowDecSep         : false,
    }
    ); //number only
}

if($('.isCurrency').length)
{
    $('.isCurrency').numeric( //number, - and . only
    {
    allowThouSep : false,
    }
    );
}

if($('.isDecimal').length)
{
    $('.isDecimal').numeric( //number and . only
    {
    allowMinus          : false,
    allowThouSep        : false,
    }
    );
}

    if($('.isAlphaOnly').length)
    {
    $('.isAlphaOnly').alpha();
    }

    if($('.isLowerAlphaOnly').length)
    {
    $('.isLowerAlphaOnly').alphanum("lower");
    }

    if($('.isUpperAlphaOnly').length)
    {
    $('.isUpperAlphaOnly').alphanum("upper");
    }

    /* datetimepicke & timepicker */
/*    $(".datetimepicker").each(function ()
      {
        var currentId = $(this).attr('id');*/
if($('.datetimepicker').length)
{
        $('.datetimepicker').datetimepicker(
          {
          ampm: true,
          dateFormat: "yy-mm-dd",
          timeFormat: 'HH:mm:ss',
          }
        );
}
/*      }
    );*/
    $(".datetimepicker_local").each(function ()
      {
        var currentId = $(this).attr('id');
        $('.datetimepicker_local#'+currentId).datetimepicker(
          {
          ampm: true,
          dateFormat: "dd-mm-yy",
          timeFormat: 'HH:mm:ss',
          }
        );
      }
    );
    $(".timepicker_ui").each(function ()
      {
        var currentId = $(this).attr('id');
        $('.timepicker_ui#'+currentId).timepicker(
          {
          ampm: true
          }
        );
      }
    );
    $(".timepicker_te").each(function ()
      {
        var currentId = $(this).attr('id');
        $('.timepicker_te#'+currentId).timeEntry();
      }
    );
    $(".timepicker_dd").each(function ()
      {
        var currentId = $(this).attr('id');
        $('.timepicker_dd#'+currentId).timepicker();
      }
    );

    $(function()
      {
/*        $(".datepicker").each(function ()
          {
            var currentId = $(this).attr('id');*/

if($('.datepicker').length)
{
            $('.datepicker').datepicker(
              {
              dateFormat: "yy-mm-dd",
                /*   showOn: "button",*/
              changeMonth: true,
              changeYear: true,
                //yearRange: "-100:+3",
              yearRange: "2018:+3",
                /*   buttonImage: "js/jqueryUI/img/calendar.gif",
        buttonImageOnly: true*/
              }
            ).keyup(function(e) {
                if(e.keyCode == 8 || e.keyCode == 46) {
                  $.datepicker._clearDate(this);
                }
              }
            );
}

if($('.datepicker_dob').length)
{
            $('.datepicker_dob').datepicker(
              {
              dateFormat: "dd-mm-yy",
                /*   showOn: "button",*/
              changeMonth: true,
              changeYear: true,
                //yearRange: "-100:+3",
              yearRange: "1950:2099",
                /*   buttonImage: "js/jqueryUI/img/calendar.gif",
        buttonImageOnly: true*/
              }
            ).keyup(function(e) {
                if(e.keyCode == 8 || e.keyCode == 46) {
                  $.datepicker._clearDate(this);
                }
              }
            );
}
/*          }
        );*/
      }
    );
    $(function()
      {
/*        $(".datepicker_local").each(function ()
          {
            var currentId = $(this).attr('id');*/

if($('.datepicker_local').length)
{
            $('.datepicker_local').datepicker(
              {
              dateFormat: "dd-mm-yy",
                /*   showOn: "button",*/
              changeMonth: true,
              changeYear: true,
                //yearRange: "-100:+3",
              yearRange: "2018:+11",
                /*   buttonImage: "js/jqueryUI/img/calendar.gif",
        buttonImageOnly: true*/
              }
            ).keyup(function(e) {
                if(e.keyCode == 8 || e.keyCode == 46) {
                  $.datepicker._clearDate(this);
                }
              }
            );
}

if($('.datepicker_local_currentyear').length)
{
            $('.datepicker_local_currentyear').datepicker(
              {
              dateFormat: "dd-mm-yy",
                /*   showOn: "button",*/
              changeMonth: true,
              changeYear: true,
                //yearRange: "-100:+3",
              yearRange: "2018:+0",
                /*   buttonImage: "js/jqueryUI/img/calendar.gif",
        buttonImageOnly: true*/
              }
            ).keyup(function(e) {
                if(e.keyCode == 8 || e.keyCode == 46) {
                  $.datepicker._clearDate(this);
                }
              }
            );
}

if($('.datepicker_local_insurancedate').length)
{
var dateToday = new Date();
            $('.datepicker_local_insurancedate').datepicker(
              {
              dateFormat: "dd-mm-yy",
                /*   showOn: "button",*/
              changeMonth: true,
              changeYear: true,
                //yearRange: "-100:+3",
                minDate: dateToday,
              yearRange: "2018:+3",
                /*   buttonImage: "js/jqueryUI/img/calendar.gif",
        buttonImageOnly: true*/
              }
            ).keyup(function(e) {
                if(e.keyCode == 8 || e.keyCode == 46) {
                  $.datepicker._clearDate(this);
                }
              }
            );
}
/*          }
        );*/
      }
    );


  $( function() {

  if($('.from').length)
{

var today = new Date();
//startdate = addWorkDays(today, 3);
startdate = addWorkDays(today, 1);
console.log(startdate);
    var dateFormat = "dd-mm-yy";
      from = $( ".from" )
        .datepicker({
        minDate: startdate,
          /*defaultDate: "+1w",*/
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( ".to" ).datepicker({
      minDate: startdate,
              maxDate: "+7D",
        /*defaultDate: "+1w",*/
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
}


    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }

      return date;
    }
  } );

  $( function() {

  if($('.fromwip').length)
{

var today = new Date();
//startdate = addWorkDays(today, 3);
startdate = addWorkDays(today, 1);
console.log(startdate);
    var dateFormat = "dd-mm-yy";
      fromwip = $( ".fromwip" )
        .datepicker({
        minDate: startdate,
          /*defaultDate: "+1w",*/
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          towip.datepicker( "option", "minDate", getDate( this ) );
        }),
      towip = $( ".towip" ).datepicker({
      minDate: startdate,
              maxDate: "+30D",
        /*defaultDate: "+1w",*/
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        fromwip.datepicker( "option", "maxDate", getDate( this ) );
      });
}


    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }

      return date;
    }
  } );
  }
);