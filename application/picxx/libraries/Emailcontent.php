<?php
/* author:mohd hafizi */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Emailcontent
{
    protected $session = '';
    protected $email   = '';
    /*protected $configs = ''; */

    public function __construct()
    {
        $CI            = &get_instance();
        $this->session = $CI->session;
        $this->email   = $CI->email;
/*        $this->configs = $CI->config; */
    }

/**
 * Call controller using links or button.
 * for normal use
 *
 * @access  public
 * @param   string  permit type. ADP,EVDP,AVP,EVP,etc..
 * @param   string  pic/admin
 * @param   array   email to list
 * @return  array   [bookingId,drivername, vehicle_registration_no
 */
    public function shoot_email($permit, $to = 'pic', $data = [], $emails = [])
    {

if($permit == 'ADP'){
$permit_fullname = 'Airside Driving Permit';
}elseif($permit == 'EVDP'){
$permit_fullname = 'Electrical Vehicle Driving Permit';
}elseif($permit == 'AVP'){
$permit_fullname = 'Airside Vehicle Permit';
}elseif($permit == 'EVP'){
$permit_fullname = 'Electrical Vehicle Permit';
}elseif($permit == 'CS'){
$permit_fullname = 'Commercial Supplier';
}elseif($permit == 'SH'){
$permit_fullname = 'Stakeholder (Inspection not required)';
}elseif($permit == 'WIP'){
$permit_fullname = 'Work In Progress (Runway, Taxiway, Apron)';
}elseif($permit == 'WIPBRIEFING'){
$permit_fullname = 'Work In Progress (Others Areas)';
}elseif($permit == 'SHINS'){
$permit_fullname = 'Stakeholder (Inspection required)';
}elseif($permit == 'PBB'){
$permit_fullname = 'Passenger Boarding Bridge';
}elseif($permit == 'VDGS'){
$permit_fullname = 'Visual Docking Guidance System';
}elseif($permit == 'PCA'){
$permit_fullname = 'Preconditioned Air Unit';
}elseif($permit == 'GPU'){
$permit_fullname = 'Ground Power Unit';
}

        if ($to == 'pic') {
            $emails  = $this->session->userdata('email');
            $subject = 'DIASS - ' . $permit_fullname . ' Application (Booking ID  ' . $data['bookingId'] . ' )';
            $body    = '
Good day ' . $this->session->userdata('name') . ',
<br><br>
Your request for new ' . $permit_fullname . ' application has been submitted and pending for acceptance.  Here is the booking ID:
<br><br>
<b>' . $data['bookingId'] . '</b>
<br><br>
Regards,<br>
-DIASS Administrator<br>
<a href="diass.malaysiaairports.com.my" target="_blank" title="url">diass.malaysiaairports.com.my</a>
';

        } elseif ($to == 'admin') {

        if($permit == 'ADP' || $permit == 'EVDP'){
        $type_detail = 'Driver Name: ' . $data['driver_name'] . '<br>';
        }elseif($permit == 'AVP' || $permit == 'EVP' || $permit == 'CS' || $permit == 'SH' || $permit == 'WIP' || $permit == 'WIPBRIEFING' || $permit == 'SHINS'){
        $type_detail = 'Vehicle Registration No: ' . $data['vehicle_registration_no'] . '<br>';
        }elseif($permit == 'PBB' || $permit == 'VDGS' || $permit == 'PCA' || $permit == 'GPU'){
        $type_detail = 'Operator Name: ' . $data['driver_name'] . '<br>';
        }
            $subject = 'DIASS - ' . $permit_fullname . ' Application (Booking ID  ' . $data['bookingId'] . ' )';
            $body    = '
Good day Admin,
<br><br>
We received a new permit application request for ' . $permit_fullname . '. Here are the detail:
<br><br>
Booking ID: ' . $data['bookingId'] . '<br>
' .$type_detail. '
Company Name: ' . $this->session->userdata('companyname') . ' <br>
<br><br>
We appreciate your kindness to review the request by logging into DIASS.
<br><br>
Regards, <br>
-DIASS Administrator <br>
<a href="diass.malaysiaairports.com.my/admin/" target="_blank" title="url">diass.malaysiaairports.com.my</a>
    ';
        }

        $this->email->from('mahb-no-reply@malaysiaairports.com.my', 'DIASS Administrator');
        $this->email->to($emails);
        $this->email->subject($subject);
        $this->email->message($body);
        $this->email->send();
    }

    public function shoot_email_custom($permit, $to = 'pic', $emails = [], $data = [])
    {

        echo $permit . $to;
        exit;
        $subject = 'DIASS - ADP Application (Booking ID  ' . $data['bookingId'] . ' )';
        $body    = '
Good day ' . $this->session->userdata('name') . ',
<br><br>
Your request for new ADP application has been submitted and pending for acceptance. Here are the detail:
<br><br>
Booking ID: ' . $data['bookingId'] . '
<br><br>
You will be notified within 3 working days. Thank you.
<br><br>
Regards,<br>
-DIASS Administrator <br>
<a href="diass.malaysiaairports.com.my" target="_blank" title="url">diass.malaysiaairports.com.my</a>
';

        $this->email->from('mahb-no-reply@malaysiaairports.com.my', 'DIASS Administrator');
        $this->email->to($emails);
        $this->email->subject($subject);
        $this->email->message($body);
        $this->email->send();
    }
}
