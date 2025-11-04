
<html>

<head>
<style>
body{margin:0px; font-family: Arial, Helvetica, sans-serif}

 /* style sheet for "letter" printing */
 @media print {
    @page {
    	size: 2.13in 3.32in ;
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
    <tr><td><img src="<?php echo base_url('../resources/shared_img/print_permit/logo.png');?>" width="50" style="padding:4px;padding-bottom:1px;"></td><td align="right" style="font-size: 10px; font-weight: 800; padding-right: 8px;">ADP<font color="red"><?php echo str_replace("ADP","",$permit_issuance_serialno);?></font></td></tr>
    <tr><td colspan="2" align="center" style="font-size: 10px; font-weight: 800; padding-top: 2px; padding-bottom: 1px;">AIRSIDE DRIVING PERMIT</td></tr>
    <tr><td colspan="2" align="center" style="font-size: 8px; font-weight: 400; padding-top: 1px; padding-bottom: 2px;">KL INTERNATIONAL AIRPORT</td></tr>
    <tr><td align="center" width="40%" valign="bottom">
	<img src="<?php echo base_url('../uploads/files/'. ($driver_photo->uploadfiles_filename?$driver_photo->uploadfiles_filename:'no-image-single.png'));?>" style="border:1px solid #000;"  width="70" height="110"></td>
        <td valign="bottom">
            <table width="100%"  cellpadding="0" cellspacing="0"  >
                <tr><td width="5"><img src="<?php echo base_url('../resources/shared_img/print_permit/spacer.jpg');?>" width="5"></td>
				<td  align="center"  valign="bottom" style="padding:0"><font style="font-size:68px; font-weight: normal; color:#012061;font-family:'Arial Black'">B1 </font>
                    <table width="100%" cellspacing="0">
                        <tr><td style="border-left:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;font-size: 14px; font-weight: 800;" align="center" width="30%"><?php echo strtoupper($driver_drivingclass);?></td>
                            <td style="border-top:1px solid #000;border-right:1px solid #000;border-bottom:1px solid #000;font-size: 14px; font-weight: 800;" align="center"><?php echo $adppermit_verifybymahb_vehicleclass;?></td></tr>
                    </table></td><td width="10"><img src="<?php echo base_url('../resources/shared_img/print_permit/spacer.jpg');?>" width="5"></td></tr>


            </table>
        </td></tr>
    <tr><td colspan="2" align="center" style="font-size: 12px; font-weight: 800; padding-top: 12px; padding-bottom: 1px;"><?php echo strtoupper($driver_displayname);?></td></tr>
    <tr><td colspan="2" align="center" style="font-size: 10px; font-weight: 800; padding-top: 1px; padding-bottom: 1px;"><?php echo strtoupper($driver_ic);?></td></tr>
    <tr><td colspan="2" align="center" style="font-size: 10px; font-weight: 800; padding-top: 1px; padding-bottom: 1px;"><?php echo strtoupper($permit_company_permit);?></td></tr>
    <tr><td colspan="2" align="center" style="font-size: 9px; font-weight: 800; padding-top: 1px; padding-bottom: 1px;"><?php echo datelocal_wordmonth($permit_issuance_expirydate);?></td></tr>
    <tr><td colspan="2" align="center" ><img src="<?php echo base_url('../resources/shared_img/print_permit/latest_signature_11102022_v2.png');?>"  width="80"></td></tr>
    <tr><td colspan="2" ><img src="<?php echo base_url('../resources/shared_img/print_permit/footer_b1_new.jpg');?>" width="100%"></td></tr>
</table>
    </body>
</html>