
<html>

<head>
	<title>Temporary Entry Permit</title>
<style>
body{font-family: Arial, Helvetica, sans-serif; }

table{font-size: 15px;}
table .resit-table {
  border-collapse: collapse;
  margin:  10px;
}

table .resit-table th {
  border: 1px solid black;
}


table .resit-table td  {
  border: 1px solid black;
  text-align: center;
  
  padding: 5px;
}

table .resit-table td small {

  font-size: 9px;
  font-style: italic;
}
@media print {
  footer {page-break-after: always;}
}
</style>
</head>
<body>

<table width="100%" cellpadding="0" cellspacing="0" style="">
	
	<tr><td style="padding-bottom: 10px;"><img src="<?php echo base_url('../resources/shared_img/receipt/logo.png');?>" width="120"></td>
		<td>
		<strong>KL INTERNATIONAL AIRPORT</strong><br />
		</td></tr>
	<tr><td colspan="2">
		<table width="100%">
			<tr><td ><h1 style="margin-right:15px;">Temporary Entry Permit</h1></td><td><h1>NO SIRI:  <strong>TEP<?php echo str_replace("TEP","",$permit_issuance_serialno); ?></strong></h1></td></tr>
		</table>
	</td></tr>
	
	<tr><td valign="top" colspan="2">
		<table width="100%">
			<tr><td width="50%" style="border: 1px solid black; padding:10px;">

			<h3>Maklumat Permit </h3>
			<p>No. Kenderaan: <br><strong><?php echo $vehicle_registration_no; ?><</strong></p>
			<p>Nama Syarikat: <br><strong><?php echo $permit_company_permit; ?></strong></p>
			<p>Tarikh Sah Laku <br><strong><?php echo datelocal_wordmonth($permit_issuance_startdate); ?></strong> Hingga <strong><?php echo datelocal_wordmonth($permit_issuance_expirydate); ?></strong></p>

			<p>Kawasan: <br><strong>XXXXXX</strong></p>
			<p>Pintu Masuk / Keluar: <br><strong><?php echo $wippermit_entrypost;?></strong></p>
			<p>Nombor Resit: <br><strong>HR/RS <?php echo $permit_payment_invoiceno;?></strong></p>


		</td>
							

		<td valign="top" style="padding:10px;">
								<table>
									<tr><td><h3>Maklumat Escort </h3>
			<?php
            if($wippermit_needescort=='y'){
?>
<p><i>Escorted by Airside</i></p>
<?php
            }else{
?>
			<p>Nama Steerman <strong><?php echo $wippermit_steerman_name;?></strong></p>
            <p>IC Steerman <strong><?php echo $wippermit_steerman_icno;?></strong></p>
            <p>Tarikh Tamat ADP <strong><?php echo $wippermit_steerman_adpexpirydate;?></strong></p>
<?php
            }
			?>

					</table></td></tr>

		</table>
		</td>
	</tr>
	
</table>
<footer></footer>
<table width="100%" cellpadding="0" cellspacing="0" style="margin: 15px;">
	

	<tr><td colspan="2">
		<table width="100%">
			<tr><td ><h1 style="margin-right:15px;">PERATURAN-PERATURAN MENGGUNAKAN PERMIT MASUK SEMENTARA DI DALAM KAWASAN LAPANGAN TERBANG (AIRSIDE)</h1></td></tr>
		</table>
	</td></tr>
	
	<tr><td valign="top" colspan="2">
		<OL>
			<li>PAMER DAN LETAKKAN PERMIT INI DI HADAPAN CERMIN KENDERAAN ANDA.</li>
			<LI>PERMIT INI HANYA SAH DIGUNAKAN PADA TARIKH YANG DICATATKAN SAHAJA.</LI>
			<LI>KENDERAAN YANG MEMPUNYAI PERMIT INI HANYA BOLEH MEMASUKI/MELALUI KAWASAN/LALUAN YANG DIBENARKAN SAHAJA DAN TIDAK DIBENARKAN MEMBAWA SEBARANG SENJATA ATAU BAHAN LETUPAN.</LI>
			<LI>SENTIASA MEMANDU KENDERAAN MENGIKUT LALUAN KIRI.</LI>
			<LI>MEMANDU KENDERAAN DENGAN HAD LAJU TIDAK MELEBIHI 25KM SEJAM.</LI>
			<LI>TIDAK BOLEH MEROKOK DAN MEMBUANG SAMPAH DI DALAM KAWASAN LAPANGAN TERBANG (AIRSIDE).</LI>
			<LI>ADALAH MENJADI TANGGUNAJAWAB SAYA SEPENUHNYA SEKIRANYA BERLAKU KEROSAKAN HARTA BENDA DI KAWASAN AIRSIDE YANG BERPUNCA DARIPADA KECUAIAN SAYA.</LI>

		</OL>
		<P>SAYA MEMAHAMI DAN BERSETUJU DENGAN PERATURAN-PERATURAN DI ATAS SERTA AKAN MEMATUHI SEGALA ARAHAN YANG DIBERIKAN OLEH PEGAWAI OPERASI AIRSIDE ATAU WAKILNYA.</P>
		</td>
	</tr>
	
</table>
	</body>
</html>