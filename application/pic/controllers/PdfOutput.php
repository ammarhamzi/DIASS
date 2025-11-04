<?php 
class PdfOutput extends CI_Controller{
	function __construct() 
	{ 
		parent::__construct();
	} 

	function index()
	{
		echo 'Not Found.';
	}

	function enforcement_print($id)
	{
		$this->load->model('Enforcement_model');
		$id_enc = $id;
		$id = fixzy_decoder($id);
		$enforcement_main_det = $this->Enforcement_model->enforcement_main_data($id);

		$date_enforcement_created = $enforcement_main_det->enforcements_main_created_at;
		$date_enforcement_created = date('d-m-Y',strtotime($date_enforcement_created));
		$date_enforcement_created_time = date('h:i A', strtotime($enforcement_main_det->enforcements_main_created_at));

        $location_real = $enforcement_main_det->enforcements_main_location;
		$offence_id = $enforcement_main_det->enforcements_main_driverOrVehicle;

		if($enforcement_main_det->enforcements_main_from_category == 1) //driver
		{
			$offence_det = $this->Enforcement_model->driver_detail($offence_id);
			$offence_name = $offence_det->driver_name;
			$offence_company = $offence_det->company_name;
			$offence_department = $offence_det->driver_department;
			$offence_reg_no = $offence_det->driver_ic;
			$total_collected_demerit_point = $this->Enforcement_model->sum_merit_point(1,$offence_id);
			$adp_no = $enforcement_main_det->enforcements_main_adpadv_no;
			$avp_no = '';
		}
		else if($enforcement_main_det->enforcements_main_from_category == 2) //vehicle
		{
			$offence_det = $this->Enforcement_model->vehicle_detail($offence_id);
			$offence_name = $offence_det->vehicle_registration_no;
			$offence_company = $offence_det->company_name;
			$offence_department = $offence_det->vehicle_type;
			$offence_reg_no = $offence_det->vehicle_registration_no;
			$total_collected_demerit_point = $this->Enforcement_model->sum_merit_point(2,$offence_id);
			$adp_no = '';
			$avp_no = $enforcement_main_det->enforcements_main_adpadv_no;
		}

		/*----------  CHILD ENFORCEMENT  ----------*/
		$child_enforcement_list = $this->Enforcement_model->offence_list_history($enforcement_main_det->enforcements_main_id);
		$child_result_arr = array();
		$total_point_demerit = 0;
		foreach($child_enforcement_list as $r_cel)
		{
			$total_point_demerit += $r_cel->enforcements_offendlist_point;
			$child_result_arr[] = $r_cel->off_cat_name.' | '.$r_cel->offendlist_violationNo.'-'.$r_cel->offendlist_regNo;
		}

		/*----------  PDF  ----------*/
		// Suppress deprecation warnings for TCPDF (PHP 8.x compatibility)
		$old_error_reporting = error_reporting();
		error_reporting($old_error_reporting & ~E_DEPRECATED & ~E_STRICT);
		
		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle('NOTIFICATION OF VIOLATION');
		$pdf->SetFont('', '', 9);
		$pdf->SetHeaderMargin(30);
		$pdf->SetTopMargin(5);
        $pdf->setFooterMargin(0);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('DIASS');
		$pdf->SetDisplayMode('real', 'default');

		// remove default header/footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		// add a page
		$pdf->AddPage();
		// <img src="http://diass.karyastaging.com/resources/shared_img/malaysia_airport_logo.png" height="100px">
        $html = '
			<!DOCTYPE html>
			<html>
			<head>
				<title>NOTIFICATION OF VIOLATION</title>
			</head>
			<body>

				<table width="100%" border="0">
					<tr>
						<td>
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr align="center">
									<td colspan="2" >
										<table width="100%" border="0" cellpadding="2" cellspacing="0">
											<tr>
												<td width="20%"  align="center" style="vertical-align:middle">
													<div style="font-size:10pt">&nbsp;</div>
													<img src="resources/shared_img/malaysia_airport_logo.png" height="100px">
												</td>
												<td width="60%" align="center" style="font-size: 1.5em; font-weight: bold;">
													MALAYSIA AIRPORTS (SEPANG) SDN BHD<br />
													AIRSIDE SERVICES DEPARTMENT<br />
													ENFORCEMENT UNIT<br />
													<table align="center">
														<tr>
															<td width="15%">&nbsp;</td>
															<td width="70%">
																<table align="center" border="1" cellpadding="2" cellspacing="0">
																	<tr bgcolor="#D8D8D8">
																		<td>NOTIFICATION OF VIOLATION</td>
																	</tr>
																</table>
															</td>
															<td width="15%">&nbsp;</td>
														</tr>
													</table>
													
													<div style="font-size:10pt">&nbsp;</div>
												</td>
												<td  width="20%" align="right" style="font-size: 0.75em !important; ">
													<div style="font-size:15pt">&nbsp;</div>
													MAHB/KUL/OPS/ASD/SOP/18/01<br />
													Edition 2 Rev 2<br />
													Effective Date: 01/06/2019
												</td>
											</tr>
										</table>

									</td>
								</tr>

							</table>
						</td>
					</tr>
					<tr>
						<td >
							<table width="100%" border="1" cellpadding="5" cellspacing="0">
								<tr>
									<td width="10%">Date</td>
									<td width="15%" colspan="2">' . $date_enforcement_created . '</td>
									<td width="10%">Time</td>
									<td width="15%">' . $date_enforcement_created_time . '</td>
									<td width="15%">Location</td>
									<td width="35%" colspan="2">' . $location_real . '</td>
								</tr>
								<tr>
									<td colspan="3">Company Name</td>
									<td colspan="5">' . $offence_company . '</td>
								</tr>
								<tr>
									<td colspan="3">Department /Unit/ Others</td>
									<td colspan="5">' . $offence_department . '</td>
								</tr>
								<tr bgcolor="#D9D9D9">
									<td colspan="8">1. DETAILS OF OFFENDER</td>
								</tr>
								<tr>
									<td colspan="2">Name</td>
									<td colspan="6">' . $offence_name . '</td>
								</tr>
								<tr>
									<td colspan="2" rowspan="2"><div style="font-size:7pt">&nbsp;</div>I/C No.</td>
									<td colspan="2" rowspan="2">' . $offence_reg_no . '</td>
									<td colspan="2" rowspan="2" align="right"><div style="font-size:7pt">&nbsp;</div>Permit Serial No.</td>
									<td colspan="2" >ADP : ' . $adp_no . '</td>
								</tr>
								<tr>
									<td colspan="2">AVP : ' . $avp_no . '</td>
								</tr>
								<tr bgcolor="#D9D9D9">
									<td colspan="8">2. DETAILS OF OFFENCES</td>
								</tr>
								<tr>
									<td colspan="2">Summon Serial No.</td>
									<td ></td>
									<td colspan="2">Demerit point Charged</td>
									<td>' . $total_point_demerit . '</td>
									<td width="20%">Collected Demerit Point</td>
									<td width="15%">' . $total_collected_demerit_point . '</td>
								</tr>
								<tr>
									<td colspan="3">Offences</td>
									<td colspan="5">
										<ol style="padding-left: 0 !important;"><li>' . implode('</li><li>', $child_result_arr) . '</li></ol>
									</td>
								</tr>
								<tr>
									<td colspan="3">Period of permit suspension</td>
									<td colspan="5">' . $enforcement_main_det->enforcements_main_period_suspension . '</td>
								</tr>
								<tr>
									<td colspan="3">Please collect your permit at</td>
									<td colspan="3">Venue : </td>
									<td colspan="3">Date : </td>
								</tr>
								<tr bgcolor="#D9D9D9">
									<td colspan="8">3. ADDRESS (Employer)</td>
								</tr>
								<tr>
									<td colspan="3" rowspan="2" align="center"><div style="font-size:15pt">&nbsp;</div>Notice Accept BY</td>
									<td colspan="5">Name : </td>
								</tr>
								<tr>
									<td colspan="5" align="center">
										<table width="95%" border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td width="40%"><br /><br /><br /><br />Date : ____________________</td>
												<td width="60%" align="center"><br /><br /><br /><br />____________________<br />(Signature & Stamp)</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr bgcolor="#D9D9D9">
									<td colspan="8">4. FOR AIRSIDE ENFORCEMENT OFFICE USE ONLY</td>
								</tr>
								<tr>
									<td colspan="3" align="center">Received by<br />(Airside Duty Executive))</td>
									<td colspan="5">Name : </td>
								</tr>
								<tr>
									<td colspan="3" align="center"><div style="font-size:15pt">&nbsp;</div>Reported by<br />(Airside Duty Officer)</td>
									<td colspan="5" align="center">
										<table width="95%" border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td width="40%"><br /><br /><br /><br />Date : ____________________</td>
												<td width="60%" align="center"><br /><br /><br /><br />____________________<br />(Signature & Stamp)</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr bgcolor="#D9D9D9">
									<td colspan="8">I. DETAIL OF PERMIT RELEASED</td>
								</tr>
								<tr>
									<td colspan="2">Name</td>
									<td colspan="3">Released By : </td>
									<td colspan="3">Received By : </td>
								</tr>
								<tr>
									<td colspan="2">Date of Release : <br /><br /><br /><br /> _____________</td>
									<td colspan="3" align="center"><br /><br /><br /><br />____________________<br />(Signature & Stamp)</td>
									<td colspan="3" align="center"><br /><br /><br /><br />____________________<br />(Signature & Stamp)</td>
								</tr>
							</table>
						</td>
					</tr>


				</table>

			</body>
			</html>
		';

		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');

		// reset pointer to the last page
		$pdf->lastPage();

		// $pdf->Write(5, 'CodeIgniter TCPDF Integration');
		$pdf->Output('Enforcement_'.$id_enc.'_'.date('d-m-Y').'.pdf', 'I');
		
		// Restore original error reporting
		error_reporting($old_error_reporting);
	}

	function airside_service_print($id)
	{
		$this->load->model('Service_charges_model');
		$id_enc = $id;
		$id = fixzy_decoder($id);
		$row = $this->Service_charges_model->pdf_read($id);

		if(empty($row))
		{
			echo 'Not found.';
			die();
		}

		/*----------  Requestor Date & Time split  ----------*/
		$raw_datetime = $row->servicecharges_requestordatetime;
		$txt_date = $txt_time = '';
		if(!empty($raw_datetime))
		{
		    $txt_date = date('d-m-Y',strtotime($raw_datetime));
		    $txt_time = date('h:i A',strtotime($raw_datetime));
		}

		/*----------  Payment method text  ----------*/
		switch ($row->servicecharges_paymentMethod) {
			case 1:
				$payment_method_txt = 'Cash';
				break;
			case 2:
				$payment_method_txt = 'Cheque';
				break;
			case 3:
				$payment_method_txt = 'Credit Facilities';
				break;
			default:
				$payment_method_txt = 'None';
				break;
		}

		/*----------  PDF  ----------*/
		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle('AIRSIDE SERVICES CHARGES');
		$pdf->SetFont('', '', 11);
		$pdf->SetHeaderMargin(30);
		$pdf->SetTopMargin(20);
		$pdf->setFooterMargin(20);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');

		// remove default header/footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		// add a page
		$pdf->AddPage();
		// <img src="http://diass.karyastaging.com/resources/shared_img/malaysia_airport_logo.png" width="50px">
		$html = '
			<!DOCTYPE html>
			<html>
			<head>
				<title>AIRSIDE SERVICES CHARGES</title>
			</head>
			<body>

				<table width="100%" border="0">
					<tr>
						<td>
							<table width="100%" border="1" cellpadding="5" cellspacing="0">
								<tr align="center">
									<td colspan="2" >
										<table width="100%" border="0" cellpadding="2" cellspacing="0">
											<tr valign="middle">
												<td width="15%"  align="center">&nbsp;</td>
												<td width="70%" align="center">MALAYSIA AIRPORTS (SEPANG) SDN BHD </td>
												<td width="15%">&nbsp;</td>
											</tr>
										</table>
										
									</td>
								</tr>
								<tr align="center" bgcolor="#D8D8D8">
									<td colspan="2">
										AIRSIDE SERVICES DEPARTMENT
									</td>
								</tr>
								<tr align="center" bgcolor="#ADB9CA">
									<td colspan="2">
										AIRSIDE SERVICES CHARGES
									</td>
								</tr>
								<tr bgcolor="#D8D8D8">
									<td colspan="2">
										1. Details of Services
									</td>
								</tr>
								<tr>
									<td width="30%">Types of Charges</td>
									<td width="70%">'.$row->charges_types_name.'</td>
								</tr>
								<tr>
									<td>Requestor</td>
									<td>'.$row->servicecharges_requestor.'</td>
								</tr>
								<tr>
									<td>Date</td>
									<td>'.$txt_date.'</td>
								</tr>
								<tr>
									<td>Time</td>
									<td>'.$txt_time.'</td>
								</tr>
								<tr>
									<td>Flight No</td>
									<td>'.$row->servicecharges_flightNumber.'</td>
								</tr>
								<tr>
									<td>Reason</td>
									<td>'.$row->servicecharges_reason.'</td>
								</tr>
								<tr>
									<td>Notes</td>
									<td>'.$row->servicecharges_note.'<br /></td>
								</tr>
								<tr>
									<td>Payment Method</td>
									<td>'.$payment_method_txt.'</td>
								</tr>
								<tr>
									<td>Total Charges</td>
									<td>RM '.number_format($row->total_charges,2).'</td>
								</tr>
								<tr bgcolor="#D8D8D8">
									<td colspan="2">
										2. Details of Person in Charge
									</td>
								</tr>
								<tr>
									<td>Company Name</td>
									<td>'.$row->servicecharges_requestorcompanyname.'</td>
								</tr>
								<tr>
									<td>Name</td>
									<td>'.$row->servicecharges_requestor.'</td>
								</tr>
								<tr>
									<td>Designation</td>
									<td>'.$row->servicecharges_requestordesignation.'</td>
								</tr>
								<tr>
									<td>Phone No</td>
									<td>'.$row->servicecharges_requestorphone.'</td>
								</tr>
								<tr>
									<td>Email</td>
									<td>'.$row->servicecharges_requestoremail.'</td>
								</tr>
								<tr bgcolor="#D8D8D8">
									<td colspan="2">
										3. Acknowledgement
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<table width="100%" border="0" cellpadding="5" cellspacing="0">
											<tr>
												<td colspan="2">Requestor</td>
												<td colspan="2">Airside Service Department</td>
											</tr>
											<tr>
												<td width="17%">Signature</td>
												<td width="33%">: ______________________</td>
												<td width="17%">Signature</td>
												<td width="33%">: ______________________</td>
											</tr>
											<tr>
												<td>Name</td>
												<td>: '.$row->servicecharges_requestor.'</td>
												<td>Name</td>
												<td>: ______________________</td>
											</tr>
											<tr>
												<td>Designation</td>
												<td>: '.$row->servicecharges_requestordesignation.'</td>
												<td>Designation</td>
												<td>: ______________________</td>
											</tr>
											<tr>
												<td>Company</td>
												<td>: '.$row->servicecharges_requestorcompanyname.'</td>
												<td></td>
												<td></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr bgcolor="#D8D8D8">
									<td colspan="2">
										4. Type of Charges
									</td>
								</tr>
								<tr >
									<td colspan="2">
										<table width="100%" border="0" cellpadding="2" cellspacing="0">
											<tr>
												<td width="30%">Airside Follow Me Service</td>
												<td width="70%">- RM1000 per escort</td>
											</tr>
											<tr>
												<td >Rental - Runway Sweeper</td>
												<td >- RM125 per hour</td>
											</tr>
											<tr>
												<td >Shuttle Bus Services</td>
												<td >- RM400 per trip</td>
											</tr>
											<tr>
												<td >Filming Charge - Airside</td>
												<td >- RM700 per day</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							
						</td>
					</tr>
					

				</table>

			</body>
			</html>
		';
		$html;

		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');

		// reset pointer to the last page
		$pdf->lastPage();

		// $pdf->Write(5, 'CodeIgniter TCPDF Integration');
		$pdf->Output('Airside_service_charge_'.$id_enc.'_'.date('d-m-Y').'.pdf', 'I');
	}

	function charge_collection()
	{
		$this->load->model('Service_charges_model');
		$this->load->model('Charges_types_model');

		$single_date_get = $this->input->get('single_date');
		$working_session = $this->input->get('shift');
        $payment_method_get = $this->input->get('payment_method');

        //shift session txt
		switch ($working_session) {
		    case 1:
		        $working_session_txt = 'Evening (3pm-9pm)';
		        break;
		    case 2:
		        $working_session_txt = 'Night (9pm-8am)';
		        break;
		    case 3:
		        $working_session_txt = 'Morning (8am-3pm)';
		        break;
		    case 4:
		        $working_session_txt = 'Overall Shift (3pm-3pm)';
		        break; 
		    default:
		        $working_session_txt = 'None';
		        break;
		}

        //selected date
        $single_date_txt = '';
        if(!empty($single_date_get))
        {
            $single_date_txt = date('d-m-Y',strtotime($single_date_get));
        }
        
        //payment mathod text
        switch ($payment_method_get) {
            case 1:
                $payment_method_txt = 'Cash';
                break;
            case 2:
                $payment_method_txt = 'Cheque';
                break;
            case 3:
                $payment_method_txt = 'Credit / Debit Card';
                break;
            case 4:
                $payment_method_txt = 'Free of Charges';
                break;
            default:
                $payment_method_txt = 'None';
                break;
        }


        /*----------  charge type list  ----------*/
        $charge_type_list = array();
        $charge_type_output = array();
        if(!empty($single_date_get))
        {
            $charge_type_list = $this->Charges_types_model->charge_type_all();

            foreach ($charge_type_list as $ctl) 
            {
                $kod = $ctl['kod'];
                switch ($kod) {
                    case '5301':
                    case '5302':
                    case '5303':
                    case '5304':
                    case '5305':
                    case '5306':
                    case '5307':
                    case '5308':
                    case '5309':
                    case '5310':
                    case '5311':
                    case '5312':
                    case '5313':
                        //for ADP
                        $payment = $this->Charges_types_model->total_avp_price_per_date($single_date_get,$kod,$payment_method_get,$working_session);
                        if($payment > 0)
                        {
                            $charge_type_output[] = array_merge(
                                        $ctl,
                                        array(
                                            "total_qty"=>'1',
                                            "total_price"=>$payment,
                                        )
                                    );
                        }
                        
                        break;
                    case '5314':
                        //TEP
                        // $charge_type_output[] = array_merge(
                        //             $ctl,
                        //             array(
                        //                 "total_qty"=>'1',
                        //                 "total_price"=>'00',
                        //             )
                        //         );
                        break;
                    case '5315':
                        // not sure
                        // $charge_type_output[] = array_merge(
                        //             $ctl,
                        //             array(
                        //                 "total_qty"=>'1',
                        //                 "total_price"=>'00',
                        //             )
                        //         );
                        break;
                    case '5351':
                        //ADP & EVDP
                        $payment = $this->Charges_types_model->total_payment_by_type_per_date($single_date_get,array(1,2),$payment_method_get,$working_session);
                        if($payment > 0)
                        {
                            $charge_type_output[] = array_merge(
                                        $ctl,
                                        array(
                                            "total_qty"=>'1',
                                            "total_price"=>$payment,
                                        )
                                    );
                        }
                        break;
                    case '5352':
                        //TEP
                        // $charge_type_output[] = array_merge(
                        //             $ctl,
                        //             array(
                        //                 "total_qty"=>'1',
                        //                 "total_price"=>'00',
                        //             )
                        //         );
                        break;
                    case '5354':
                        //fixed facilities (PBB, VDGS, PCA, PWS & 400Hz GPU)
                        $payment = $this->Charges_types_model->total_payment_by_type_per_date($single_date_get,array(5,6,7,8),$payment_method_get,$working_session);
                        if($payment > 0)
                        {
                            $charge_type_output[] = array_merge(
                                        $ctl,
                                        array(
                                            "total_qty"=>'1',
                                            "total_price"=>$payment,
                                        )
                                    );
                        }
                        break;
                    case '5357':
                        //EVP
                        $payment = $this->Charges_types_model->total_payment_by_type_per_date($single_date_get,array(3),$payment_method_get,$working_session);
                        if($payment > 0)
                        {
                            $charge_type_output[] = array_merge(
                                        $ctl,
                                        array(
                                            "total_qty"=>'1',
                                            "total_price"=>$payment,
                                        )
                                    );
                        }
                        break;
                    case '5358':
                        //ADP (pro-rated)
                        $payment = $this->Charges_types_model->total_payment_by_type1_per_date($single_date_get,1,$payment_method_get,$working_session,1);
                        if($payment > 0)
                        {
                            $charge_type_output[] = array_merge(
                                        $ctl,
                                        array(
                                            "total_qty"=>'1',
                                            "total_price"=>$payment,
                                        )
                                    );
                        }
                        break;
                    case '5359':
                        //ALL
                        // $charge_type_output[] = array_merge(
                        //             $ctl,
                        //             array(
                        //                 "total_qty"=>'1',
                        //                 "total_price"=>'00',
                        //             )
                        //         );
                        break;
                    case '5253':
                        //airside service charges
                        $qty = $this->Service_charges_model->category_charges_price_per_date($single_date_get,22,$payment_method_get,$working_session);
                        if($qty > 0)
                        {
                            $charge_type_output[] = array_merge(
                                        $ctl,
                                        array(
                                            "total_qty"=>$qty,
                                            "total_price"=>$qty*700,
                                        )
                                    );
                        }
                        break;
                    case '5367':
                        //airside service charges
                        $qty = $this->Service_charges_model->category_charges_price_per_date($single_date_get,23,$payment_method_get,$working_session);
                        if($qty > 0)
                        {
                            $charge_type_output[] = array_merge(
                                        $ctl,
                                        array(
                                            "total_qty"=>$qty,
                                            "total_price"=>$qty*400,
                                        )
                                    );
                        }
                        break;
                    case '7510':
                        //airside service charges
                        $qty = $this->Service_charges_model->category_charges_price_per_date($single_date_get,24,$payment_method_get,$working_session);
                        if($qty > 0)
                        {
                            $charge_type_output[] = array_merge(
                                        $ctl,
                                        array(
                                            "total_qty"=>$qty,
                                            "total_price"=>$qty*125,
                                        )
                                    );
                        }
                        break;
                    case '5410':
                        //airside service charges
                        $qty = $this->Service_charges_model->category_charges_price_per_date($single_date_get,25,$payment_method_get,$working_session);
                        if($qty > 0)
                        {
                            $charge_type_output[] = array_merge(
                                        $ctl,
                                        array(
                                            "total_qty"=>$qty,
                                            "total_price"=>$qty*1000,
                                        )
                                    );
                        }
                        break;
                    default:
                        break;
                }
            }
        }

        $grand_total = 0;
        if(count($charge_type_output) > 0)
        {
        	foreach($charge_type_output as $cto)
        	{
        		$grand_total += $cto['total_price'];
        	}
        }

		$this->load->library('Pdf');
		$pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle('Charge Collection');
		$pdf->SetFont('', '', 7);
		$pdf->SetHeaderMargin(30);
		$pdf->SetTopMargin(20);
		$pdf->setFooterMargin(20);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');

		// remove default header/footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		// add a page
		$pdf->AddPage();

		$html = '
			<!DOCTYPE html>
			<html>
			<head>
				<title></title>
			</head>
			<body>

				<table width="100%" border="0">
					<tr>
						<td>
							<table width="100%" border="1" cellpadding="5" cellspacing="0">
								<tr align="center">
									<td>
										MALAYSIA AIRPORTS (SEPANG) SDN BHD 
									</td>
								</tr>
								<tr align="center">
									<td>
										BORANG PENYERAHAN WANG<br />
										HASIL KUTIPAN BAHAGIAN OPERASI AIRSIDE
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>
							<table width="100%" border="0" cellpadding="5" cellspacing="0">
								<tr>
									<td width="35%">NO GAJI/NAMA/JAWATAN</td>
									<td width="3%">:</td>
									<td colspan="4" width="62%"> '.$this->session->name.'</td>
								</tr>
								<tr>
									<td>LOKASI BERTUGAS/SYIF (PTG,PAGI,MALAM)</td>
									<td>:</td>
									<td colspan="4" > '.$working_session_txt.'</td>
								</tr>
								<tr>
									<td width="35%">NO SIRI TEMPORARY ENTRY PERMIT</td>
									<td width="3%">:</td>
									<td colspan="4" align="center">HINGGA</td>
									
								</tr>
								<tr>
									<td>NO SIRI RESIT BAYARAN</td>
									<td>:</td>
									<td colspan="4" align="center">HINGGA</td>
								</tr>
								<tr>
									<td>TARIKH TRANSAKSI</td>
									<td>:</td>
									<td>'.date('d-m-Y').'</td>
									<td colspan="3">WANG SEBANYAK : RM '.number_format($grand_total,2).'</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>
							<table width="100%" border="1" cellpadding="5" cellspacing="0">
								<tr bgcolor="#EAF818">
									<td colspan="2" align="center" width="65%">Diserahkan Oleh :</td>
									<td align="center" width="35%">Diterima Oleh  (Bahagian Licensing) :</td>
								</tr>
								<tr>
									<td width="35%"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p></td>
									<td width="30%"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p></td>
									<td width="35%"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p></td>
								</tr>
								<tr>
									<td>
										<p><strong>Tandatangan Penyerah</strong></p>
										<p>Nama : <br />
										Cop Rasmi : </p>
									</td>
									<td>
										<p><strong>Tandatangan Saksi/ Peg. Bertugas</strong></p>
										<p>Nama : <br />
										Cop Rasmi : </p>
									</td>
									<td>
										<p><strong>Tandatangan Penerima</strong></p>
										<p>Nama : <br />
										Cop Rasmi : </p>
									</td>
								</tr>
								<tr>
									<td colspan="2"></td>
									<td>
										<p><strong>Jumlah Wang Penerima : </strong><br />
										<strong>Tarikh Penerimaan : </strong></p>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>
							Nota : Sila Catit Keterangan Bayaran Mengikut Kod Hasil
						</td>
					</tr>
					<tr>
						<td>
							<table border="1" width="100%" cellpadding="3" cellspacing="0">
							    <tr bgcolor="#EAF818" align="center">
							        <td width="5%">Kod</td>
							        <td width="46%">Keterangan</td>
							        <td width="5%">UOM</td>
							        <td width="7%">Kadar % SST</td>
							        <td width="9%">Kadar Caj (Tanpa SST)</td>
							        <td width="5%">Kuantiti</td>
							        <td width="7%">Amaun (RM) Tanpa SST</td>
							        <td width="7%">SST Amaun</td>
							        <td width="9%">Amaun (RM) Dengan SST</td>
							    </tr>';
							    foreach($charge_type_output as $ctl)
							    {
							    	$fixed_price = $ctl['price'];
                                    $total_qty = $ctl['total_qty'];
                                    $price_without_sst = $ctl['total_price'];
                                    $sst = 0;
                                    $price_with_sst = $sst+$price_without_sst;
		$html .= '
									<tr>
									    <td>'.$ctl['kod'].'</td>
									    <td>'.$ctl['name'].'</td>
									    <td class="text-center">'.$ctl['unitOfMeasurement_actual'].'</td>
									    <td class="text-center">6%</td>
									    <td class="text-center">RM'.$fixed_price.'</td>
									    <td class="text-center">'.$total_qty.'</td>
									    <td align="right">'.number_format($price_without_sst,2).'</td>
									    <td align="right">'.number_format($sst,2).'</td>
									    <td align="right">'.number_format($price_with_sst,2).'</td>
									</tr>
		';
							    }
		$html .= '
							</table>
						</td>
					</tr>
				</table>

			</body>
			</html>

		';
		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');

		// reset pointer to the last page
		$pdf->lastPage();

		// $pdf->Write(5, 'CodeIgniter TCPDF Integration');
		$pdf->Output('Charge_collection.pdf', 'I');
	}
}
?>