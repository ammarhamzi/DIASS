
<html>

<head>
<style>
body{font-family: Arial, Helvetica, sans-serif; }

table{font-size: 11px;}
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

</style>
<script>
window.print();
</script>
</head>
<body>
<?php
/*print_r($driverdetail);
print_r($chargestypesdetail);
print_r($permitdetail);*/
?>
<table width="900" cellpadding="0" cellspacing="0" style="">
	<tr><td colspan="2"><h4 style="text-align: right; font-size:16px; margin-right:15px;">RESIT / Receipt</h4></td></tr>
	<tr><td style="padding-bottom: 10px;"><img src="<?php echo base_url('../resources/shared_img/receipt/logo.png');?>" width="120"></td>
		<td>
		<strong>MALAYSIA AIRPORTS (SEPANG) SDN BHD (320480-D) (SST No: xxxxxxx)</strong><br />
		Malaysia Airports Corporate Office, Persiaran Korporat KLIA, 64000 KLIA, Sepang, Selangor, Malaysia<br />
			Tel No: 03-8777 8888 Fax No: 03-8926 5510</td></tr>

	<tr><td valign="top" colspan="2">
		<table width="100%">
			<tr><td width="50%" style="border: 1px solid black; padding:10px;">

			<h3>DITERIMA DARIPADA / RECEIVED FROM </h3>
			<p>NAMA SYARIKAT/ Company Name: <br><strong><?php echo $companydetail->company_name;?></strong></p>
			<p>ADDRESS / Address: <br><strong><?php echo $companydetail->company_address;?></strong></p>
			<p>EMEL / Email: <strong><?php echo $companydetail->company_contact_email;?></strong></p>
			<p>NO TEL / Phone No: <strong><?php echo $companydetail->company_contact_phone;?></strong></p></td>
							<td valign="top" style="padding:10px;">
								<table>
									<tr><td><p>NO RESIT / Receipt No: HR/RS <strong><?php echo $permitdetail->permit_payment_invoiceno;?></strong></p>
			<p>TARIKH / Date: <strong><?php echo datelocal($permitdetail->permit_payment_statusPaidDate);?></strong></p>
			<p>KOD KAWASAN / Business Area: <strong>XXXXXX</strong></p>
			<p>NO. AKAUN / Account No: <strong>XXXXXX</strong></p>
					</table></td></tr>

		</table>
		</td>
	</tr>
	<tr><td colspan="2">&nbsp;</td></tr>
	<tr><td colspan="2"><h3>UNTUK / FOR</h3></td></tr>
	<tr><td colspan="2" valign="top">
		<table class="resit-table" width="95%">
			<tr><td width="5%">Bil<br ><small>Code</small></td>
				<td width="10%">Kod Hasil<br ><small>Revenue Code</small></td>
				<td width="50%">Butiran<br ><small>Details (Invoice no. / Others)</small></td>
				<td width="5%">Kuantiti<br ><small>Quantity</small></td>
				<td width="15%">Harga Unit<br ><small>Price Unit</small></td>
				<td width="15%">Jumlah (RM)<br ><small>Amount(RM)</small></td>
			</tr>
			<tr><td>1</td>
			<td><?php echo $chargestypesdetail->kod;?></td>
			<td><?php echo $chargestypesdetail->name.' ('.$permitdetail->permit_issuance_serialno.')';?></td>
			<td>1</td>
			<td><?php echo $chargestypesdetail->price_actual;?></td>
			<td><?php echo $chargestypesdetail->price_actual;?></td>
		</tr>
        <?php
        if(!empty($chargesescortdetail)){
?>
		<tr>
			<td>2</td>
			<td><?php echo $chargesescortdetail->kod;?></td>
			<td><?php echo $chargesescortdetail->name;?></td>
			<td>1</td>
			<td><?php echo $chargesescortdetail->price_actual;?></td>
			<td><?php echo $chargesescortdetail->price_actual;?></td>
		</tr>
<?php
        }else{
?>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
<?php
        }
        ?>

		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="4" rowspan="4" style="text-align: left; font-size: 10px;" valign="top">*Tertakluk kepada mekanisme penggenapan Bank Negara Malaysia dan Cukai Barang dan Perkhidmatan.<br />

*Untuk pembayaran yang berjumlah RM501 ke atas, sila ke bahagian Kewangan bagi pengeluaran Invoise Cukai Lengkap ("Full Tax Invoice")</td>
			<td  style="font-variant: uppercase; text-align: right; font-weight: 800;">SUBTOTAL</td>

			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: right; ">Tambah / <small>Add</small>: SST 6%</td>

			<td>&nbsp;</td>
		</tr>
		<tr>
			<td  style="text-align: right; ">Penggenapan / <br ><small>Rounding Adj</small></td>

			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="font-variant: uppercase; text-align: right; font-weight: 800;">Jumlah / Total RM</td>

			<td><?php echo standardmoney($permitdetail->permit_payment_total);?></td>
		</tr>
		</table>
		<table width="100%">
			<tr><td width="80%">PEGAWAI YANG DIBENARKAN / AUTHORISED OFFICER for MALAYSIA AIRPORTS (SEPANG) SDN BHD (320480-D)<br />
			<p>Nama Pegawai: <strong>*<?php echo $permitdetail->user_name_permit_issuance_processedby;?></strong><br>Diterima pada: <strong>*<?php echo datelocal($permitdetail->permit_updated_at);?></strong></p> </td><td width="20%">TUNAI/CEK NO: <strong>XXXXXXX</strong><Br />
				CASH / CEHQUE NO: <strong>XXXXXXX</strong></td></tr>
			<tr></tr>
		</table>
		
	</td></tr>
</table>
	</body>
</html>