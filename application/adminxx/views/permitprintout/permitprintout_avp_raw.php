
<html>

<head>
<style>
body{margin:0px; font-family: Arial, Helvetica, sans-serif}

 /* style sheet for "letter" printing */
 @media print {
    @page {
    	size: 5.5cm 8.5cm ;
        margin: 0;
    }


 }

</style>
</head>
<script>
//$(document).ready(function() {
window.print();
//});
</script>
<body>
    <table width="100%" cellpadding="0" cellspacing="0" style="">
    <tr><td align="center" style="font-size: 10px; font-weight: 400; padding-top: 12px; padding-bottom: 2px;">REGISTRATION NO.</font></td></tr>
    <tr><td align="center" style="font-size: 22px; font-weight: 800; padding-top: 2px; padding-bottom: 2px;"><?php echo $vehicle_registration_no; ?></td></tr>
    <tr><td align="center" style="font-size: 10px; font-weight: 400; ">EXPIRY DATE</font></td></tr>
    <tr><td align="center" style="font-size: 18px; font-weight: 800; padding-top: 2px; padding-bottom: 2px;"><?php echo datelocal_wordmonth($permit_issuance_expirydate); ?></td></tr>
    <tr><td align="center" style="font-size: 10px; font-weight: 400; ">COMPANY NAME</font></td></tr>
    <tr><td align="center" style="font-size: 18px; font-weight: 800; padding-top: 2px; padding-bottom: 2px;"><?php echo $permit_company_permit; ?></td></tr>
    <tr><td align="center" style="font-size: 10px; font-weight: 400; ">AVP NO.</font></td></tr>
    <tr><td align="center" style="font-size: 18px; font-weight: 800; padding-top: 2px; padding-bottom: 2px;">AVP<font color="red"><?php echo str_replace("AVP","",$permit_issuance_serialno); ?></font></td></tr>
</table>
</body>
</html>