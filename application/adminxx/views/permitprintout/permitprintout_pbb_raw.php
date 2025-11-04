
<html>

<head>
<style>
body{margin:0px; font-family: Arial, Helvetica, sans-serif}

 /* style sheet for "letter" printing */
 @media print {
    @page {
    	size: 2.13in 3.33in ;
        margin: 0;
    }


 }

</style>
</head>
<script>
window.print();
</script>
<body>
<table width="100%" cellpadding="0" cellspacing="0">
    <tr><td><img src="<?php echo base_url('../resources/shared_img/print_permit/logo.png');?>" width="50" style="padding:4px;padding-bottom:1px;"></td><td align="right" style="font-size: 10px; font-weight: 800; padding-right: 8px;">FF<font color="red"><?php echo str_replace("FF","",$permit_issuance_serialno);?></font></td></tr>
    <tr><td colspan="2" align="center" style="font-size: 10px; font-weight: 800; padding-top: 2px; padding-bottom: 1px;">FIXED FACILITIES PERMIT</td></tr>
    <tr><td colspan="2" align="center" style="font-size: 8px; font-weight: 400; padding-top: 1px; padding-bottom: 9px;">KL INTERNATIONAL AIRPORT</td></tr>
    <tr><td align="center" width="40%" valign="bottom"><img src="<?php echo base_url('../uploads/files/'. ($driver_photo->uploadfiles_filename?$driver_photo->uploadfiles_filename:'no-image-single.png'));?>" style="border:1px solid #000;"   width="70" height="110"></td>
        <td valign="top">
            <table width="100%"  cellpadding="0" cellspacing="0"  >
                <tr><td width="5"><img src="<?php echo base_url('../resources/shared_img/print_permit/spacer.jpg');?>" width="5"></td>
				<td  align="center"  valign="bottom">
                    <table><tr><td style="border:1px solid #000; padding: 10px; font-size: 24px;">PBB</td></tr></table><!--<br />
                    <table><tr><td style="border:1px solid #000; padding: 10px; font-size: 24px;">VDGS</td></tr></table>-->

                </td><td width="5"><img src="<?php echo base_url('../resources/shared_img/print_permit/spacer.jpg');?>" width="5"></td></tr>


            </table>
        </td></tr>
    <tr><td colspan="2" align="center" style="font-size: 12px; font-weight: 800; padding-top: 12px; padding-bottom: 1px;"><?php echo strtoupper($driver_displayname);?></td></tr>
    <tr><td colspan="2" align="center" style="font-size: 10px; font-weight: 800; padding-top: 1px; padding-bottom: 1px;"><?php echo strtoupper($driver_ic);?></td></tr>
    <tr><td colspan="2" align="center" style="font-size: 10px; font-weight: 800; padding-top: 1px; padding-bottom: 1px;"><?php echo strtoupper($permit_company_permit);?></td></tr>
    <tr><td colspan="2" align="center" style="font-size: 9px; font-weight: 800; padding-top: 1px; padding-bottom: 2px;"><?php echo datelocal_wordmonth($permit_issuance_expirydate);?></td></tr>
    <tr><td colspan="2" align="center" style="padding-bottom:1px;" ><img src="<?php echo base_url('../resources/shared_img/print_permit/signature.jpg');?>"  width="80"></td></tr>
    <tr><td colspan="2" ><img src="<?php echo base_url('../resources/shared_img/print_permit/footer_ffop_new.jpg');?>" width="100%"></td></tr>
</table>
    </body>
</html>