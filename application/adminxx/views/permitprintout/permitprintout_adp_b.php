
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
<body>
<table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #000;">
    <tr><td><img src="<?php echo base_url('../resources/shared_img/print_permit/logo.png');?>" width="120" style="padding:8px;"></td><td align="right" style="font-size: 12px; font-weight: 800; padding-right: 5px;"><?php echo $permit_issuance_serialno;?></td></tr>
    <tr><td colspan="2" align="center" style="font-size: 12px; font-weight: 800; padding-top: 2px; padding-bottom: 2px;">AIRSIDE DRIVING PERMIT</td></tr>
    <tr><td colspan="2" align="center" style="font-size: 12px; font-weight: 800; padding-top: 2px; padding-bottom: 8px;">KL INTERNATIONAL AIRPORTS</td></tr>
    <tr><td align="center" width="70%"><img src="<?php echo base_url('../uploads/files/'. ($driver_photo->uploadfiles_filename?$driver_photo->uploadfiles_filename:'no-image-single.png'));?>" style="border:1px solid #000;" width="150"></td>
        <td >
            <table width="100%" >
                <tr><td style="font-size:175px; font-weight: bold; color:#003399;" align="center" ><?php echo trim($adppermit_verifybymahb_drivingarea);?></td></tr>
                <tr><td>
                    <table width="100%" cellspacing="0">
                        <tr><td style="border:1px solid #000;font-size: 14px; font-weight: 800;" align="center"><?php echo strtoupper($driver_drivingclass);?></td><td style="border-top:1px solid #000;border-right:1px solid #000;border-bottom:1px solid #000;font-size: 14px; font-weight: 800;" align="center"><?php echo $adppermit_verifybymahb_vehicleclass;?></td></tr>
                    </table>
                </td>
                <td width="10"><img src="<?php echo base_url('../resources/shared_img/print_permit/spacer.jpg');?>" width="10"></td>
            </tr>

            </table>
        </td></tr>
    <tr><td colspan="2" align="center" style="font-size: 18px; font-weight: 800; padding-top: 12px; padding-bottom: 2px;"><?php echo strtoupper($driver_displayname);?></td></tr>
    <tr><td colspan="2" align="center" style="font-size: 18px; font-weight: 800; padding-top: 2px; padding-bottom: 2px;"><?php echo strtoupper($driver_ic);?></td></tr>
    <tr><td colspan="2" align="center" style="font-size: 18px; font-weight: 800; padding-top: 2px; padding-bottom: 2px;"><?php echo strtoupper($permit_companyid);?></td></tr>
    <tr><td colspan="2" align="center" style="font-size: 18px; font-weight: 800; padding-top: 2px; padding-bottom: 2px;"><?php echo datelocal($permit_issuance_expirydate);?></td></tr>
    <tr><td colspan="2" align="center" style="padding-top: 12px; "><img src="<?php echo base_url('../resources/shared_img/print_permit/signature.jpg');?>"></td></tr>
    <tr><td colspan="2" ><br ><img src="<?php echo base_url('../resources/shared_img/print_permit/footer_blue_new.jpg');?>"></td></tr>
</table>
<script>
window.print();
</script>
    </body>
</html>
