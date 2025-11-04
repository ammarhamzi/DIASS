<?php
/* author:mohd hafizi */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
#[\AllowDynamicProperties]
class Emailcontent
{
    protected $session = '';
    protected $email   = '';

    public function __construct()
    {
        $CI            = &get_instance();
        $this->session = $CI->session;
        $this->email   = $CI->email;
        $this->input   = $CI->input;
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
    public function shoot_email_approval($permit, $to = 'pic', $data = [], $emails = [])
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
            if($data['status']=='success'){
            $subject = 'DIASS – Your ' .$permit_fullname. ' has been approved (Booking ID ' . $data['bookingId'] . ')';
            $body    = '
Good day,
<br><br>
Your request for ' .$permit_fullname. ' (' . $data['bookingId'] . ') has been approved.
<br><br>
You make your payment in 3 working days. Thank you.
<br><br>
Regards,<br>
-DIASS Administrator <br>
<a href="diass.malaysiaairports.com.my" target="_blank" title="url">diass.malaysiaairports.com.my</a>

                ';
            }elseif($data['status']=='failed'){
                    $subject = 'DIASS – Your ' .$permit_fullname. ' request is rejected (Booking ID ' . $data['bookingId'] . ')';
                    $body    = '
Good day,
<br><br>
Your request for ' .$permit_fullname. ' (' . $data['bookingId'] . ') has been rejected.
 <br><br>
Reason for rejected: ' . $this->input->post('remark', true) . '
<br><br>
Please try again. Thank you.
<br><br>
Regards, <br>
-DIASS Administrator<br>
<a href="diass.malaysiaairports.com.my" target="_blank" title="url">diass.malaysiaairports.com.my</a>
                ';
            }


        }

        $this->email->from('mahb-no-reply@malaysiaairports.com.my', 'DIASS Administrator');
        $this->email->to($emails);
        $this->email->subject($subject);
        $this->email->message($body);
        $this->email->send();
    }

    public function shoot_email_docscheck($permit, $to = 'pic', $data = [], $emails = [])
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
            if($data['status']=='success'){

            if($permit == 'ADP'){
             $guideemail = ' Briefing / Exam on';
            }elseif($permit == 'EVDP'){
             $guideemail = ' Terminal briefing on';
            }elseif($permit == 'AVP' || $permit == 'EVP' || $permit == 'WIP' || $permit == 'SHINS'){
             $guideemail = ' vehicle inspection on';
            }else{
             $guideemail = ' Briefing on';
            }
            $subject = 'DIASS – Your ' .$permit_fullname. ' has been accepted (Booking ID ' . $data['bookingId'] . ')';
            $body    = '
Good day,
<br><br>
Your request for ' .$permit_fullname. ' (' . $data['bookingId'] . ') has been accepted.

Please attend for ' .$permit_fullname. ' ' .$guideemail. ':
<br><br>
Date: ' .$data['bookingdate']. '<br>
Booking ID: ' .$data['bookingId']. '
<br><br>
Regards,<br>
-DIASS Administrator <br>
<a href="diass.malaysiaairports.com.my" target="_blank" title="url">diass.malaysiaairports.com.my</a>

                ';
            }elseif($data['status']=='failed'){
                    $subject = 'DIASS – Your ' .$permit_fullname. ' has been declined  (Booking ID ' . $data['bookingId'] . ')';
                    $body    = '
Good day,
<br><br>
Your request for ' .$permit_fullname. ' (' . $data['bookingId'] . ') has been declined.
 <br><br>
Reason for declined: ' . $this->input->post('remark', true) . '
<br><br>
Please try again. Thank you.
<br><br>
Regards, <br>
-DIASS Administrator <br>
<a href="diass.malaysiaairports.com.my" target="_blank" title="url">diass.malaysiaairports.com.my</a>
                ';
            }


        }

        $this->email->from('mahb-no-reply@malaysiaairports.com.my', 'DIASS Administrator');
        $this->email->to($emails);
        $this->email->subject($subject);
        $this->email->message($body);
        $this->email->send();
    }

}
