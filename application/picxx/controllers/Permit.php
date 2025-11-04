<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permit extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('permit_model');
        $this->load->model('driver_model');
        $this->load->model('vehicle_model');
        $this->load->model('refcountry_model');
        $this->load->model('uploadfiles_model');
        $this->load->model('adppermit_model');
        $this->load->model('exammanagement_model');
        $this->load->model('examonlymanagement_model');
        $this->load->model('adpbriefingmanagement_model');
        $this->load->model('examadpmanagement_model');
        $this->load->model('examtaker_model');
        $this->load->model('evdppermit_model');
        $this->load->model('evdpbriefingmanagement_model');
        $this->load->model('permittimeline_model');
        $this->load->model('mtwchecklist_model');
        $this->load->model('inspectionmanagement_model');
        $this->load->model('avpevpinspectionmanagement_model');
        $this->load->model('avppermit_model');
        $this->load->model('evppermit_model');
        $this->lang->load('permit_lang', $this->session->userdata('language'));
        $this->load->model('pbbpermit_model');
        $this->load->model('pbbbriefingmanagement_model');
        $this->load->model('shpermit_model');
        $this->load->model('shbriefingmanagement_model');
        $this->load->model('vdgspermit_model');
        $this->load->model('vdgsbriefingmanagement_model');
        $this->load->model('cspermit_model');
        $this->load->model('csbriefingmanagement_model');
        $this->load->model('gpupermit_model');

        $this->load->model('pcapermit_model');

        $this->load->model('wippermit_model');
        $this->load->model('user_model');
        $this->load->model('shinspermit_model');
        $this->load->model('wipbriefingpermit_model');
        $this->load->model('tepbriefingmanagement_model');
        $this->load->model('ffpbbbriefingmanagement_model');
        $this->load->model('ffvdgsbriefingmanagement_model');
        $this->load->model('tepinspectionmanagement_model');
        $this->load->model('tepstakeholdermanagement_model');

        $this->load->model('ffgpubriefingmanagement_model');
        $this->load->model('ffpcabriefingmanagement_model');
    }

    public function index()
    {

        $this->apply();

    }

/*    public function testemail(){
$this->emailcontent->shoot_email('ADP','pic',['bookingId'=>'abc123']);
}*/

    public function test()
    {
        print_r($this->admin_list('Admin Licensing', 'email'));
    }

/*    public function apply($condition = 'new')
{

if ($this->permission->showlist == true) {

$setting = [
'method' => 'newpage',
'patern' => 'list',
];

$data = [
'permission' => $this->permission,
];

$this->content     = 'permit/permit_apply';
$data['condition'] = $condition;
##--slave_combine_to_list--##
$this->layout($data, $setting);

} else {
redirect('/');
}

}*/

    public function apply()
    {

        $this->uploadfiles_model->delete_unusedfiles();

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];

            $data = [
                'permission' => $this->permission,
            ];

            $this->content = 'permit/permit_apply';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function error()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];

            $data = [
                'error_data' => '',
                'permission' => $this->permission,
            ];

            $this->content = 'foundation/error';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function steptwo()
    {

        if ($this->permission->cp_create == true) {

            $setting = [
                'method' => 'modalpage',
                'patern' => 'list',
            ];

            $permittype      = $this->input->post('permittype', true);
            $condition       = $this->input->post('condition', true);
            $recent_permitid = $this->input->post('recent_permitid', true);
            $data            = [
                'permission' => $this->permission,
            ];

            if ($permittype == "adp") {
                $this->content = 'permit/adp_verifydriver';
            } elseif ($permittype == "evdp") {
                $this->content = 'permit/evdp_verifydriver';
            } elseif ($permittype == "avp") {
                $this->content = 'permit/avp_verifyvehicle';
            } elseif ($permittype == "evp") {
                $this->content = 'permit/evp_verifyvehicle';
            } elseif ($permittype == "pbb") {
                $this->content = 'permit/pbb_verifydriver';
            } elseif ($permittype == "sh") {
                //$this->content = 'permit/sh_verifydriver';
                $this->content = 'permit/sh_verifyvehicle';
            } elseif ($permittype == "vdgs") {
                $this->content = 'permit/vdgs_verifydriver';
            } elseif ($permittype == "cs") {
                //$this->content = 'permit/cs_verifydriver';
                $this->content = 'permit/cs_verifyvehicle';
            } elseif ($permittype == "gpu") {
                $this->content = 'permit/gpu_verifydriver';
            } elseif ($permittype == "pca") {
                $this->content = 'permit/pca_verifydriver';
            } elseif ($permittype == "wip") {
                $this->content = 'permit/wip_verifyvehicle';
            } elseif ($permittype == "shins") {
                $this->content = 'permit/shins_verifyvehicle';
            } elseif ($permittype == "wipbriefing") {
                /*$this->content = 'permit/wipbriefing_verifydriver';*/
                $this->content = 'permit/wipbriefing_verifyvehicle';
            } else {
                $this->session->set_flashdata('message', 'Please select permit to continue');
                redirect('/permit/apply');
            }

            //
            $data['condition']       = $condition;
            $data['recent_permitid'] = $recent_permitid;
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            $this->session->set_flashdata('message', 'not allowed to create');
            redirect('/permit/apply');
        }
    }

    public function stepthree()
    {

        if ($this->permission->cp_create == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];

            if ($this->input->post('verify_status', true) == '1' || $this->input->post('verify_status', true) == '8' || $this->input->post('verify_status', true) == '9' || $this->input->post('verify_status', true) == '4' || $this->input->post('verify_status', true) == '10' || $this->input->post('verify_status', true) == '7') {
                $verify_status = '1';
            }
            $permittype = $this->input->post('permittype', true);

            $condition       = $this->input->post('condition', true);
            $recent_permitid = $this->input->post('recent_permitid', true);
            $driver          = $this->driver_model->get_by_id($this->input->post('driver_id', true));
            $vehicle         = $this->vehicle_model->get_read($this->input->post('vehicle_id', true));
            $adp_trainercert = $this->input->post('adp_trainercert', true);
            $driverclass     = $this->input->post('driverclass', true);
            if ($this->input->post('vehicleclass', true)) {
                $vehicleclass = implode(",", $this->input->post('vehicleclass', true));
            } else {
                $vehicleclass = '';
            }
            $avpcategory = $this->input->post('avpcategory', true);

            $trainername  = $this->input->post('trainername', true);
            $trainingdate = $this->input->post('trainingdate', true);

            if ($driver) {
                $data = [
                    'permit_data' => '',
                    'permission' => $this->permission,
                    'driver_id' => $driver->driver_id,
                    'driver_name' => $driver->driver_name,
                    'driver_ic' => $driver->driver_ic,
                    'adp_trainercert' => $adp_trainercert,
                    'countrylist' => $this->refcountry_model->get_all(),
                    'driverclass' => $driverclass,
                    'vehicleclass' => $vehicleclass,
                    'trainername' => $trainername,
                    'trainingdate' => dateserver($trainingdate),
                ];
            }

            if ($vehicle) {
                $data = [
                    'permit_data' => '',
                    'permission' => $this->permission,
                    'vehicle_id' => $vehicle->vehicle_id,
                    'vehicle_registration_no' => $vehicle->vehicle_registration_no,
                    'vehicle_issurance_policy_no' => $vehicle->vehicle_insurance_policy_no,
                    'vehicle_issurance_expiry_date' => $vehicle->vehicle_insurance_expiry_date,
                    'vehicle_parkingarea_id' => $vehicle->vehicle_parkingarea_id,
                    'vehicle_engine_capacity' => $vehicle->vehicle_enginecapacity_name,
                    'vehicle_vehiclegroup_name' => $vehicle->vehicle_vehiclegroup_name,
                    'vehicle_chasis_no' => $vehicle->vehicle_chasis_no,
                    'vehicle_engine_no' => $vehicle->vehicle_engine_no,
                    'vehicle_enginetype_name' => $vehicle->enginetype_name_vehicle_enginetype_id,
                    'vehicle_year_manufacture' => $vehicle->vehicle_year_manufacture,
                    'mtwchecklist_data' => $this->mtwchecklist_model->get_all($permittype),
                    'avpcategory' => $avpcategory,
                ];
            }

            if ($verify_status == "1") {
                if ($permittype == "adp") {
                    if (empty($adp_trainercert)) {
                        $this->content = 'permit/adp_examdate';
                    } else {
                        $this->content = 'permit/adp_examonlydate';
                    }

                } elseif ($permittype == "evdp") {
                    $this->content = 'permit/evdp_terminalbriefing';
                } elseif ($permittype == "avp") {
                    $this->content = 'permit/avp_inspectiondate';
                } elseif ($permittype == "evp") {
                    $this->content = 'permit/evp_inspectiondate';
                } elseif ($permittype == "pbb") {
                    $this->content = 'permit/pbb_pbbbriefing';
                } elseif ($permittype == "sh") {
                    $this->content = 'permit/sh_shbriefing';
                } elseif ($permittype == "vdgs") {
                    $this->content = 'permit/vdgs_vdgsbriefing';
                } elseif ($permittype == "cs") {
                    $this->content = 'permit/cs_csbriefing';
                } elseif ($permittype == "gpu") {
                    $this->content = 'permit/gpu_gpubriefing';
                } elseif ($permittype == "pca") {
                    $this->content = 'permit/pca_pcabriefing';
                } elseif ($permittype == "wip") {
                    $this->content = 'permit/wip_inspectiondate';
                } elseif ($permittype == "shins") {
                    $this->content = 'permit/shins_inspectiondate';
                } elseif ($permittype == "wipbriefing") {
                    $this->content = 'permit/wipbriefing_wipbriefing';
                } else {
                    $this->session->set_flashdata('message', 'Please select permit to continue');
                    redirect('/');
                }

                //
                $data['condition']       = $condition;
                $data['recent_permitid'] = $recent_permitid;
                ##--slave_combine_to_list--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Illegal action.');

                redirect('/');
            }

        } else {
            redirect('/');

        }
    }

    public function stepthree_renew($recentpermitid, $permittype, $id)
    {

        if ($this->permission->cp_create == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $recentpermit = $this->permit_model->get_by_id(fixzy_decoder($recentpermitid));
            //$permittype    = $this->input->post('permittype', true);
            //$verify_status = $this->input->post('verify_status', true);
            $condition = 'renew';
            if ($permittype == 'adp' || $permittype == 'evdp' || $permittype == 'pbb' || $permittype == 'vdgs' || $permittype == 'gpu' || $permittype == 'pca') {
                $driver        = $this->driver_model->get_by_id($id);
                $verify_status = $driver->driver_activity_statusid;
            } elseif ($permittype == 'avp' || $permittype == 'evp' || $permittype == 'wip' || $permittype == 'cs' || $permittype == 'sh' || $permittype == 'shins' || $permittype == 'wipbriefing') {
                $vehicle       = $this->vehicle_model->get_by_id($id);
                $verify_status = $vehicle->vehicle_activity_statusid;
            }

            if (isset($driver)) {
                $data = [
                    'permit_data' => '',
                    'permission' => $this->permission,
                    'driver_id' => $driver->driver_id,
                    'driver_name' => $driver->driver_name,
                    'driver_ic' => $driver->driver_ic,
                    'adp_trainercert' => $this->input->post('adp_trainercert', true),
                    'countrylist' => $this->refcountry_model->get_all(),
                    'driverclass' => $driver->driverclass,
                ];
            }

            if (isset($vehicle)) {
                $data = [
                    'permit_data' => '',
                    'permission' => $this->permission,
                    'vehicle_id' => $vehicle->vehicle_id,
                    'vehicle_registration_no' => $vehicle->vehicle_registration_no,
                    'vehicle_issurance_policy_no' => $vehicle->vehicle_insurance_policy_no,
                    'vehicle_issurance_expiry_date' => $vehicle->vehicle_insurance_expiry_date,
                    'vehicle_parkingarea_id' => $vehicle->vehicle_parkingarea_id,
                    'vehicle_engine_capacity' => $vehicle->vehicle_engine_capacity,
                    'mtwchecklist_data' => $this->mtwchecklist_model->get_all($permittype),
                ];
            }

            if ($verify_status == "1") {
                if ($permittype == "adp") {
                    $this->content = 'permit/adp_verifydriver_renew';
                } elseif ($permittype == "evdp") {
                    $this->content = 'permit/evdp_terminalbriefing';
                } elseif ($permittype == "avp") {
                    $this->content = 'permit/avp_inspectiondate';
                } elseif ($permittype == "evp") {
                    $this->content = 'permit/evp_inspectiondate';
                } elseif ($permittype == "pbb") {
                    $this->content = 'permit/pbb_pbbbriefing';
                } elseif ($permittype == "sh") {
                    $this->content = 'permit/sh_shbriefing';
                } elseif ($permittype == "vdgs") {
                    $this->content = 'permit/vdgs_vdgsbriefing';
                } elseif ($permittype == "cs") {
                    $this->content = 'permit/cs_csbriefing';
                } elseif ($permittype == "gpu") {
                    $this->content = 'permit/gpu_gpubriefing';
                } elseif ($permittype == "pca") {
                    $this->content = 'permit/pca_pcabriefing';
                } elseif ($permittype == "wip") {
                    $this->content = 'permit/wip_inspectiondate';
                } elseif ($permittype == "shins") {
                    $this->content = 'permit/shins_inspectiondate';
                } elseif ($permittype == "wipbriefing") {
                    $this->content = 'permit/wipbriefing_wipbriefing';
                } else {
                    $this->session->set_flashdata('message', 'Please select permit to continue');
                    redirect('/');
                }

                //
                $data['condition']       = $condition;
                $data['recent_permitid'] = $recentpermit->permit_id;
                $data['serialno']        = $recentpermit->permit_issuance_serialno;
                $data['expirydate']      = $recentpermit->permit_issuance_expirydate;
                ##--slave_combine_to_list--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Illegal action.');
                redirect('/');
            }

        } else {
            redirect('/');
        }
    }

    public function stepfour()
    {

        if ($this->permission->cp_create == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $permittype      = $this->input->post('permittype', true);
            $verify_status   = $this->input->post('verify_status', true);
            $condition       = $this->input->post('condition', true);
            $recent_permitid = $this->input->post('recent_permitid', true);

/*    echo  $permittype;
exit;*/
            if ($verify_status == "1") {
                if ($permittype == "adp") {

                    $this->_exambriefingrules();

                    if ($this->form_validation->run() == false) {
                        $this->stepthree();
                    } else {
                        $driver          = $this->driver_model->get_by_id($this->input->post('driver_id', true));
                        $driver_id       = $this->input->post('driver_id', true);
                        $driver_name     = $this->input->post('driver_name', true);
                        $driver_ic       = $this->input->post('driver_ic', true);
                        $examtaker_date  = $this->input->post('examtaker_date', true);
                        $adp_requireddoc = $this->input->post('adp_requireddoc', true);
                        $adp_trainercert = $this->input->post('adp_trainercert', true);
                        $driver_photo    = $this->input->post('driver_photo', true);

                        $country      = $driver->driver_nationality_country_id;
                        $licenseno    = $driver->driver_drivinglicenseno;
                        $drivingclass = $driver->driver_drivingclass;
                        $expirydate   = $driver->driver_licenseexpirydate;
                        $trainername  = $this->input->post('trainername', true);
                        $trainingdate = $this->input->post('trainingdate', true);
                        $driverclass  = $this->input->post('driverclass', true);
                        $vehicleclass = $this->input->post('vehicleclass', true);
                        $exam_session = $this->input->post('exam_session', true);
                        $exam_title   = explode("-", $this->input->post('exam_title', true));
                        $location     = $exam_title[0];

                        if ($examtaker_date) {
                            $data = [
                                'permit_data' => '',
                                'permission' => $this->permission,
                                'verify_status' => $verify_status,
                                'driver_id' => $driver_id,
                                'driver_name' => $driver_name,
                                'driver_ic' => $driver_ic,
                                'examtaker_date' => $examtaker_date,
                                'adp_requireddoc' => $adp_requireddoc,
                                'adp_requireddoc_filename' => $this->uploadfiles_model->get_adp_requireddoc($driver_id),
                                'adp_trainercert' => $adp_trainercert,
                                'adp_trainercert_filename' => $this->uploadfiles_model->get_adp_trainercert($driver_id),
                                'driver_photo' => $driver_photo,
                                'driver_photo_filename' => $this->uploadfiles_model->get_by_id($driver_photo)->uploadfiles_filename,
                                'country' => $country,
                                'countryname' => $this->refcountry_model->get_by_id($country)->ref_country_printable_name,
                                'licenseno' => $licenseno,
                                'drivingclass' => $drivingclass,
                                'expirydate' => dateserver($expirydate),
                                'trainername' => $trainername,
                                'trainingdate' => $trainingdate,
                                'driverclass' => $driverclass,
                                'vehicleclass' => $vehicleclass,
                                'exam_session' => $exam_session,
                                'location' => $location,
                            ];
                        }

                        $this->content = 'permit/adp_review';
                    }

                } elseif ($permittype == "evdp") {

                    $this->_terminalbriefingrules();

                    if ($this->form_validation->run() == false) {
                        $this->stepthree();
                    } else {
                        $permittype               = $this->input->post('permittype', true);
                        $verify_status            = $this->input->post('verify_status', true);
                        $driver_id                = $this->input->post('driver_id', true);
                        $driver_name              = $this->input->post('driver_name', true);
                        $driver_ic                = $this->input->post('driver_ic', true);
                        $terminalbriefing_date    = $this->input->post('terminalbriefing_date', true);
                        $terminalbriefing_session = $this->input->post('terminalbriefing_session', true);
                        $evdp_requireddoc         = $this->input->post('evdp_requireddoc', true);
                        $driver_photo             = $this->input->post('driver_photo', true);
                        $terminalbriefing_title   = explode("-", $this->input->post('terminalbriefing_title', true));
                        $location                 = $terminalbriefing_title[0];

                        if ($terminalbriefing_date) {
                            $data = [
                                'permit_data' => '',
                                'permission' => $this->permission,
                                'verify_status' => $verify_status,
                                'driver_id' => $driver_id,
                                'driver_name' => $driver_name,
                                'driver_ic' => $driver_ic,
                                'terminalbriefing_date' => $terminalbriefing_date,
                                'terminalbriefing_session' => $terminalbriefing_session,
                                'evdp_requireddoc' => $evdp_requireddoc,
                                'evdp_requireddoc_filename' => $this->uploadfiles_model->get_evdp_requireddoc($driver_id),

                                'driver_photo' => $driver_photo,
                                'driver_photo_filename' => $this->uploadfiles_model->get_by_id($driver_photo)->uploadfiles_filename,
                                'location' => $location,
                            ];
                        }
                        $this->content = 'permit/evdp_review';
                    }

                } elseif ($permittype == "avp") {

                    $permittype              = $this->input->post('permittype', true);
                    $verify_status           = $this->input->post('verify_status', true);
                    $vehicle_id              = $this->input->post('vehicle_id', true);
                    $vehicle_registration_no = $this->input->post('vehicle_registration_no', true);
                    $vehicle_parkingarea_id  = $this->input->post('vehicle_parkingarea_id', true);
                    /*$vehicle_engine_capacity = $this->input->post('vehicle_engine_capacity', true);*/
                    $inspection_date         = $this->input->post('inspection_date', true);
                    $avp_requireddoc         = $this->input->post('avp_requireddoc', true);
                    $avp_mtwchecked_selected = $this->input->post('mtwchecklist_selected', true);

                    $avp_insurancedoc          = $this->input->post('avp_insurancedoc', true);
                    $vehicle_engine_capacity   = $this->input->post('vehicle_engine_capacity', true);
                    $vehicle_vehiclegroup_name = $this->input->post('vehicle_vehiclegroup_name', true);
                    $vehicle_chasis_no         = $this->input->post('vehicle_chasis_no', true);
                    $vehicle_engine_no         = $this->input->post('vehicle_engine_no', true);
                    $vehicle_enginetype_name   = $this->input->post('vehicle_enginetype_name', true);
                    $vehicle_year_manufacture  = $this->input->post('vehicle_year_manufacture', true);

                    $smokecondition         = $this->input->post('smokecondition', true);
                    $fireext_serialno       = $this->input->post('fireext_serialno', true);
                    $fireext_expirydate     = $this->input->post('fireext_expirydate', true);
                    $tyre_manufacturingdate = $this->input->post('tyre_manufacturingdate', true);
                    $inspection_title       = explode("-", $this->input->post('inspection_title', true));
                    //$location = $inspection_title[0];
                    $location    = $this->input->post('location', true);
                    $avpcategory = $this->input->post('avpcategory', true);

                    if ($inspection_date) {
                        $data = [
                            'permit_data' => '',
                            'permission' => $this->permission,
                            'verify_status' => $verify_status,
                            'vehicle_id' => $vehicle_id,
                            'vehicle_registration_no' => $vehicle_registration_no,
                            'vehicle_parkingarea_id' => $vehicle_parkingarea_id,
                            'vehicle_engine_capacity' => $vehicle_engine_capacity,
                            'inspection_date' => $inspection_date,
                            'avp_requireddoc' => $avp_requireddoc,
                            'avp_requireddoc_filename' => $this->uploadfiles_model->get_avp_requireddoc($vehicle_id),
                            'mtwchecklist_data' => $this->mtwchecklist_model->get_all($permittype),
                            'avp_mtwchecked_selected' => $avp_mtwchecked_selected,
                            'avp_insurancedoc' => $avp_insurancedoc,
                            'avp_insurancedoc_filename' => $this->uploadfiles_model->get_avp_insurancedoc($vehicle_id),
                            'vehicle_vehiclegroup_name' => $vehicle_vehiclegroup_name,
                            'vehicle_chasis_no' => $vehicle_chasis_no,
                            'vehicle_engine_no' => $vehicle_engine_no,
                            'vehicle_enginetype_name' => $vehicle_enginetype_name,
                            'vehicle_year_manufacture' => $vehicle_year_manufacture,
                            'policyno' => $this->input->post('policyno', true),
                            'policyexpirydate' => dateserver($this->input->post('policyexpirydate', true)),
                            'avppermit_smokecondition' => $smokecondition,
                            'avppermit_fireext_serialno' => $fireext_serialno,
                            'avppermit_fireext_expirydate' => dateserver($fireext_expirydate),
                            'avppermit_tyre_manufacturingdate' => $tyre_manufacturingdate,
                            'location' => $location,
                            'avpcategory' => $avpcategory,
                        ];
                    }
                    $this->content = 'permit/avp_review';
                } elseif ($permittype == "evp") {

                    $permittype              = $this->input->post('permittype', true);
                    $verify_status           = $this->input->post('verify_status', true);
                    $vehicle_id              = $this->input->post('vehicle_id', true);
                    $vehicle_registration_no = $this->input->post('vehicle_registration_no', true);
                    $vehicle_parkingarea_id  = $this->input->post('vehicle_parkingarea_id', true);

                    $inspection_date         = $this->input->post('inspection_date', true);
                    $evp_requireddoc         = $this->input->post('evp_requireddoc', true);
                    $evp_mtwchecked_selected = $this->input->post('mtwchecklist_selected', true);

                    $evp_insurancedoc          = $this->input->post('evp_insurancedoc', true);
                    $vehicle_engine_capacity   = $this->input->post('vehicle_engine_capacity', true);
                    $vehicle_vehiclegroup_name = $this->input->post('vehicle_vehiclegroup_name', true);
                    $vehicle_chasis_no         = $this->input->post('vehicle_chasis_no', true);
                    $vehicle_engine_no         = $this->input->post('vehicle_engine_no', true);
                    $vehicle_enginetype_name   = $this->input->post('vehicle_enginetype_name', true);
                    $vehicle_year_manufacture  = $this->input->post('vehicle_year_manufacture', true);
                    $inspection_title          = explode("-", $this->input->post('inspection_title', true));
                    //$location = $inspection_title[0];
                    $location = $this->input->post('location', true);

                    if ($inspection_date) {
                        $data = [
                            'permit_data' => '',
                            'permission' => $this->permission,
                            'verify_status' => $verify_status,
                            'vehicle_id' => $vehicle_id,
                            'vehicle_registration_no' => $vehicle_registration_no,
                            'vehicle_parkingarea_id' => $vehicle_parkingarea_id,
                            'vehicle_engine_capacity' => $vehicle_engine_capacity,
                            'inspection_date' => $inspection_date,
                            'evp_requireddoc' => $evp_requireddoc,
                            'evp_requireddoc_filename' => $this->uploadfiles_model->get_evp_requireddoc($vehicle_id),
                            'mtwchecklist_data' => $this->mtwchecklist_model->get_all($permittype),
                            'evp_mtwchecked_selected' => $evp_mtwchecked_selected,
                            'evp_insurancedoc' => $evp_insurancedoc,
                            'evp_insurancedoc_filename' => $this->uploadfiles_model->get_evp_insurancedoc($vehicle_id),
                            'vehicle_vehiclegroup_name' => $vehicle_vehiclegroup_name,
                            'vehicle_chasis_no' => $vehicle_chasis_no,
                            'vehicle_engine_no' => $vehicle_engine_no,
                            'vehicle_enginetype_name' => $vehicle_enginetype_name,
                            'vehicle_year_manufacture' => $vehicle_year_manufacture,
                            'policyno' => $this->input->post('policyno', true),
                            'policyexpirydate' => dateserver($this->input->post('policyexpirydate', true)),
                            'location' => $location,
                        ];
                    }
                    $this->content = 'permit/evp_review';
                } elseif ($permittype == "pbb") {

                    $this->_pbbbriefingrules();

                    if ($this->form_validation->run() == false) {
                        $this->stepthree();
                    } else {
                        $permittype          = $this->input->post('permittype', true);
                        $verify_status       = $this->input->post('verify_status', true);
                        $driver_id           = $this->input->post('driver_id', true);
                        $driver_name         = $this->input->post('driver_name', true);
                        $driver_ic           = $this->input->post('driver_ic', true);
                        $pbbbriefing_date    = $this->input->post('pbbbriefing_date', true);
                        $pbbbriefing_session = $this->input->post('pbbbriefing_session', true);
                        $pbb_requireddoc     = $this->input->post('pbb_requireddoc', true);
                        $driver_photo        = $this->input->post('driver_photo', true);
                        $pbbbriefing_title   = explode("-", $this->input->post('pbbbriefing_title', true));
                        $location            = $pbbbriefing_title[0];

                        if ($pbbbriefing_date) {
                            $data = [
                                'permit_data' => '',
                                'permission' => $this->permission,
                                'verify_status' => $verify_status,
                                'driver_id' => $driver_id,
                                'driver_name' => $driver_name,
                                'driver_ic' => $driver_ic,
                                'pbbbriefing_date' => $pbbbriefing_date,
                                'pbbbriefing_session' => $pbbbriefing_session,
                                'pbb_requireddoc' => $pbb_requireddoc,
                                'pbb_requireddoc_filename' => $this->uploadfiles_model->get_pbb_requireddoc($driver_id),

                                'driver_photo' => $driver_photo,
                                'driver_photo_filename' => $this->uploadfiles_model->get_by_id($driver_photo)->uploadfiles_filename,
                                'location' => $location,
                            ];
                        }
                        $this->content = 'permit/pbb_review';
                    }

                } elseif ($permittype == "sh") {

                    $permittype              = $this->input->post('permittype', true);
                    $verify_status           = $this->input->post('verify_status', true);
                    $vehicle_id              = $this->input->post('vehicle_id', true);
                    $vehicle_registration_no = $this->input->post('vehicle_registration_no', true);
                    $vehicle_parkingarea_id  = $this->input->post('vehicle_parkingarea_id', true);
                    //$shbriefing_date         = $this->input->post('shbriefing_date', true);
                    $shbriefing_date     = $this->input->post('startdate', true);
                    $shbriefing_location = $this->input->post('shbriefing_location', true);
                    $sh_requireddoc      = $this->input->post('sh_requireddoc', true);

                    $sh_insurancedoc           = $this->input->post('sh_insurancedoc', true);
                    $vehicle_engine_capacity   = $this->input->post('vehicle_engine_capacity', true);
                    $vehicle_vehiclegroup_name = $this->input->post('vehicle_vehiclegroup_name', true);
                    $vehicle_chasis_no         = $this->input->post('vehicle_chasis_no', true);
                    $vehicle_engine_no         = $this->input->post('vehicle_engine_no', true);
                    $vehicle_enginetype_name   = $this->input->post('vehicle_enginetype_name', true);
                    $vehicle_year_manufacture  = $this->input->post('vehicle_year_manufacture', true);
                    $startdate                 = $this->input->post('startdate', true);
                    $enddate                   = $this->input->post('enddate', true);

                    $entrypurpose = $this->input->post('entrypurpose', true);
                    $entrypost    = $this->input->post('entrypost', true);
                    $exitpost     = $this->input->post('exitpost', true);
/*                    $steerman_name = $this->input->post('steerman_name', true);
$steerman_icno = $this->input->post('steerman_icno', true);
$steerman_adpno = $this->input->post('steerman_adpno', true);
$escortservice = $this->input->post('escortservice', true);*/

                    if ($shbriefing_date) {
                        $data = [
                            'permit_data' => '',
                            'permission' => $this->permission,
                            'verify_status' => $verify_status,
                            'vehicle_id' => $vehicle_id,
                            'vehicle_registration_no' => $vehicle_registration_no,
                            'vehicle_parkingarea_id' => $vehicle_parkingarea_id,
                            'vehicle_engine_capacity' => $vehicle_engine_capacity,
                            'shbriefing_date' => dateserver($shbriefing_date),
                            'sh_requireddoc' => $sh_requireddoc,
                            'sh_requireddoc_filename' => $this->uploadfiles_model->get_sh_requireddoc($vehicle_id),
                            'sh_insurancedoc' => $sh_insurancedoc,
                            'sh_insurancedoc_filename' => $this->uploadfiles_model->get_sh_insurancedoc($vehicle_id),
                            'vehicle_vehiclegroup_name' => $vehicle_vehiclegroup_name,
                            'vehicle_chasis_no' => $vehicle_chasis_no,
                            'vehicle_engine_no' => $vehicle_engine_no,
                            'vehicle_enginetype_name' => $vehicle_enginetype_name,
                            'vehicle_year_manufacture' => $vehicle_year_manufacture,
                            'policyno' => $this->input->post('policyno', true),
                            'policyexpirydate' => dateserver($this->input->post('policyexpirydate', true)),
                            'startdate' => dateserver($startdate),
                            'enddate' => dateserver($enddate),
                            'entrypurpose' => $entrypurpose,
                            'entrypost' => $entrypost,
                            'exitpost' => $exitpost,
/*                            'steerman_name' => $steerman_name,
'steerman_icno' => $steerman_icno,
'steerman_adpno' => dateserver($steerman_adpno),
'escortservice' => $escortservice,*/
                        ];
                    }
                    $this->content = 'permit/sh_review';

                } elseif ($permittype == "vdgs") {

                    $this->_vdgsbriefingrules();

                    if ($this->form_validation->run() == false) {
                        $this->stepthree();
                    } else {
                        $permittype           = $this->input->post('permittype', true);
                        $verify_status        = $this->input->post('verify_status', true);
                        $driver_id            = $this->input->post('driver_id', true);
                        $driver_name          = $this->input->post('driver_name', true);
                        $driver_ic            = $this->input->post('driver_ic', true);
                        $vdgsbriefing_date    = $this->input->post('vdgsbriefing_date', true);
                        $vdgsbriefing_session = $this->input->post('vdgsbriefing_session', true);
                        $vdgs_requireddoc     = $this->input->post('vdgs_requireddoc', true);
                        $driver_photo         = $this->input->post('driver_photo', true);
                        $vdgsbriefing_title   = explode("-", $this->input->post('vdgsbriefing_title', true));
                        $location             = $vdgsbriefing_title[0];

                        if ($vdgsbriefing_date) {
                            $data = [
                                'permit_data' => '',
                                'permission' => $this->permission,
                                'verify_status' => $verify_status,
                                'driver_id' => $driver_id,
                                'driver_name' => $driver_name,
                                'driver_ic' => $driver_ic,
                                'vdgsbriefing_date' => $vdgsbriefing_date,
                                'vdgsbriefing_session' => $vdgsbriefing_session,
                                'vdgs_requireddoc' => $vdgs_requireddoc,
                                'vdgs_requireddoc_filename' => $this->uploadfiles_model->get_vdgs_requireddoc($driver_id),

                                'driver_photo' => $driver_photo,
                                'driver_photo_filename' => $this->uploadfiles_model->get_by_id($driver_photo)->uploadfiles_filename,
                                'location' => $location,
                            ];
                        }
                        $this->content = 'permit/vdgs_review';
                    }

                } elseif ($permittype == "cs") {

                    $permittype              = $this->input->post('permittype', true);
                    $verify_status           = $this->input->post('verify_status', true);
                    $vehicle_id              = $this->input->post('vehicle_id', true);
                    $vehicle_registration_no = $this->input->post('vehicle_registration_no', true);
                    $vehicle_parkingarea_id  = $this->input->post('vehicle_parkingarea_id', true);
                    //$csbriefing_date         = $this->input->post('csbriefing_date', true);
                    $csbriefing_date     = $this->input->post('startdate', true);
                    $csbriefing_location = $this->input->post('csbriefing_location', true);
                    $cs_requireddoc      = $this->input->post('cs_requireddoc', true);

                    $cs_insurancedoc           = $this->input->post('cs_insurancedoc', true);
                    $vehicle_engine_capacity   = $this->input->post('vehicle_engine_capacity', true);
                    $vehicle_vehiclegroup_name = $this->input->post('vehicle_vehiclegroup_name', true);
                    $vehicle_chasis_no         = $this->input->post('vehicle_chasis_no', true);
                    $vehicle_engine_no         = $this->input->post('vehicle_engine_no', true);
                    $vehicle_enginetype_name   = $this->input->post('vehicle_enginetype_name', true);
                    $vehicle_year_manufacture  = $this->input->post('vehicle_year_manufacture', true);
                    $startdate                 = $this->input->post('startdate', true);
                    $enddate                   = $this->input->post('enddate', true);

                    $entrypurpose   = $this->input->post('entrypurpose', true);
                    $entrypost      = $this->input->post('entrypost', true);
                    $exitpost       = $this->input->post('exitpost', true);
                    $steerman_name  = $this->input->post('steerman_name', true);
                    $steerman_icno  = $this->input->post('steerman_icno', true);
                    $steerman_adpno = $this->input->post('steerman_adpno', true);
                    $escortservice  = $this->input->post('escortservice', true);

                    if ($csbriefing_date) {
                        $data = [
                            'permit_data' => '',
                            'permission' => $this->permission,
                            'verify_status' => $verify_status,
                            'vehicle_id' => $vehicle_id,
                            'vehicle_registration_no' => $vehicle_registration_no,
                            'vehicle_parkingarea_id' => $vehicle_parkingarea_id,
                            'vehicle_engine_capacity' => $vehicle_engine_capacity,
                            'csbriefing_date' => dateserver($csbriefing_date),
                            'cs_requireddoc' => $cs_requireddoc,
                            'cs_requireddoc_filename' => $this->uploadfiles_model->get_cs_requireddoc($vehicle_id),
                            'cs_insurancedoc' => $cs_insurancedoc,
                            'cs_insurancedoc_filename' => $this->uploadfiles_model->get_cs_insurancedoc($vehicle_id),
                            'vehicle_vehiclegroup_name' => $vehicle_vehiclegroup_name,
                            'vehicle_chasis_no' => $vehicle_chasis_no,
                            'vehicle_engine_no' => $vehicle_engine_no,
                            'vehicle_enginetype_name' => $vehicle_enginetype_name,
                            'vehicle_year_manufacture' => $vehicle_year_manufacture,
                            'policyno' => $this->input->post('policyno', true),
                            'policyexpirydate' => dateserver($this->input->post('policyexpirydate', true)),
                            'startdate' => dateserver($startdate),
                            'enddate' => dateserver($enddate),
                            'entrypurpose' => $entrypurpose,
                            'entrypost' => $entrypost,
                            'exitpost' => $exitpost,
                            'steerman_name' => $steerman_name,
                            'steerman_icno' => $steerman_icno,
                            'steerman_adpno' => dateserver($steerman_adpno),
                            'escortservice' => $escortservice,
                        ];
                    }
                    $this->content = 'permit/cs_review';

                } elseif ($permittype == "gpu") {

                    $this->_gpubriefingrules();

                    if ($this->form_validation->run() == false) {
                        $this->stepthree();
                    } else {
                        $permittype          = $this->input->post('permittype', true);
                        $verify_status       = $this->input->post('verify_status', true);
                        $driver_id           = $this->input->post('driver_id', true);
                        $driver_name         = $this->input->post('driver_name', true);
                        $driver_ic           = $this->input->post('driver_ic', true);
                        $gpubriefing_date    = $this->input->post('gpubriefing_date', true);
                        $gpubriefing_session = $this->input->post('gpubriefing_session', true);
                        $gpu_requireddoc     = $this->input->post('gpu_requireddoc', true);
                        $driver_photo        = $this->input->post('driver_photo', true);
                        $gpubriefing_title   = explode("-", $this->input->post('gpubriefing_title', true));
                        $location            = $gpubriefing_title[0];

                        if ($gpubriefing_date) {
                            $data = [
                                'permit_data' => '',
                                'permission' => $this->permission,
                                'verify_status' => $verify_status,
                                'driver_id' => $driver_id,
                                'driver_name' => $driver_name,
                                'driver_ic' => $driver_ic,
                                'gpubriefing_date' => $gpubriefing_date,
                                'gpubriefing_session' => $gpubriefing_session,
                                'gpu_requireddoc' => $gpu_requireddoc,
                                'gpu_requireddoc_filename' => $this->uploadfiles_model->get_gpu_requireddoc($driver_id),

                                'driver_photo' => $driver_photo,
                                'driver_photo_filename' => $this->uploadfiles_model->get_by_id($driver_photo)->uploadfiles_filename,
                                'location' => $location,
                            ];
                        }
                        $this->content = 'permit/gpu_review';
                    }

                } elseif ($permittype == "pca") {

                    $this->_pcabriefingrules();

                    if ($this->form_validation->run() == false) {
                        $this->stepthree();
                    } else {
                        $permittype          = $this->input->post('permittype', true);
                        $verify_status       = $this->input->post('verify_status', true);
                        $driver_id           = $this->input->post('driver_id', true);
                        $driver_name         = $this->input->post('driver_name', true);
                        $driver_ic           = $this->input->post('driver_ic', true);
                        $pcabriefing_date    = $this->input->post('pcabriefing_date', true);
                        $pcabriefing_session = $this->input->post('pcabriefing_session', true);
                        $pca_requireddoc     = $this->input->post('pca_requireddoc', true);
                        $driver_photo        = $this->input->post('driver_photo', true);
                        $pcabriefing_title   = explode("-", $this->input->post('pcabriefing_title', true));
                        $location            = $pcabriefing_title[0];

                        if ($pcabriefing_date) {
                            $data = [
                                'permit_data' => '',
                                'permission' => $this->permission,
                                'verify_status' => $verify_status,
                                'driver_id' => $driver_id,
                                'driver_name' => $driver_name,
                                'driver_ic' => $driver_ic,
                                'pcabriefing_date' => $pcabriefing_date,
                                'pcabriefing_session' => $pcabriefing_session,
                                'pca_requireddoc' => $pca_requireddoc,
                                'pca_requireddoc_filename' => $this->uploadfiles_model->get_pca_requireddoc($driver_id),

                                'driver_photo' => $driver_photo,
                                'driver_photo_filename' => $this->uploadfiles_model->get_by_id($driver_photo)->uploadfiles_filename,
                                'location' => $location,
                            ];
                        }
                        $this->content = 'permit/pca_review';
                    }

                } elseif ($permittype == "wip") {

                    $permittype              = $this->input->post('permittype', true);
                    $verify_status           = $this->input->post('verify_status', true);
                    $vehicle_id              = $this->input->post('vehicle_id', true);
                    $vehicle_registration_no = $this->input->post('vehicle_registration_no', true);
                    $vehicle_parkingarea_id  = $this->input->post('vehicle_parkingarea_id', true);
                    /*$vehicle_engine_capacity = $this->input->post('vehicle_engine_capacity', true);*/
                    $inspection_date         = $this->input->post('inspection_date', true);
                    $wip_requireddoc         = $this->input->post('wip_requireddoc', true);
                    $wip_mtwchecked_selected = $this->input->post('mtwchecklist_selected', true);

                    $wip_insurancedoc          = $this->input->post('wip_insurancedoc', true);
                    $vehicle_engine_capacity   = $this->input->post('vehicle_engine_capacity', true);
                    $vehicle_vehiclegroup_name = $this->input->post('vehicle_vehiclegroup_name', true);
                    $vehicle_chasis_no         = $this->input->post('vehicle_chasis_no', true);
                    $vehicle_engine_no         = $this->input->post('vehicle_engine_no', true);
                    $vehicle_enginetype_name   = $this->input->post('vehicle_enginetype_name', true);
                    $vehicle_year_manufacture  = $this->input->post('vehicle_year_manufacture', true);

                    $smokecondition         = $this->input->post('smokecondition', true);
                    $fireext_serialno       = $this->input->post('fireext_serialno', true);
                    $fireext_expirydate     = $this->input->post('fireext_expirydate', true);
                    $tyre_manufacturingdate = $this->input->post('tyre_manufacturingdate', true);
                    $inspection_title       = explode("-", $this->input->post('inspection_title', true));
//$location = $inspection_title[0];
                    $location  = $this->input->post('location', true);
                    $startdate = $this->input->post('startdate', true);
                    $enddate   = $this->input->post('enddate', true);

                    $entrypurpose   = $this->input->post('entrypurpose', true);
                    $entrypost      = $this->input->post('entrypost', true);
                    $exitpost       = $this->input->post('exitpost', true);
                    $steerman_name  = $this->input->post('steerman_name', true);
                    $steerman_icno  = $this->input->post('steerman_icno', true);
                    $steerman_adpno = $this->input->post('steerman_adpno', true);
                    $escortservice  = $this->input->post('escortservice', true);

                    if ($inspection_date) {
                        $data = [
                            'permit_data' => '',
                            'permission' => $this->permission,
                            'verify_status' => $verify_status,
                            'vehicle_id' => $vehicle_id,
                            'vehicle_registration_no' => $vehicle_registration_no,
                            'vehicle_parkingarea_id' => $vehicle_parkingarea_id,
                            'vehicle_engine_capacity' => $vehicle_engine_capacity,
                            'inspection_date' => dateserver($inspection_date),
                            'wip_requireddoc' => $wip_requireddoc,
                            'wip_requireddoc_filename' => $this->uploadfiles_model->get_wip_requireddoc($vehicle_id),
                            'mtwchecklist_data' => $this->mtwchecklist_model->get_all($permittype),
                            'wip_mtwchecked_selected' => $wip_mtwchecked_selected,
                            'wip_insurancedoc' => $wip_insurancedoc,
                            'wip_insurancedoc_filename' => $this->uploadfiles_model->get_wip_insurancedoc($vehicle_id),
                            'vehicle_vehiclegroup_name' => $vehicle_vehiclegroup_name,
                            'vehicle_chasis_no' => $vehicle_chasis_no,
                            'vehicle_engine_no' => $vehicle_engine_no,
                            'vehicle_enginetype_name' => $vehicle_enginetype_name,
                            'vehicle_year_manufacture' => $vehicle_year_manufacture,
                            'policyno' => $this->input->post('policyno', true),
                            'policyexpirydate' => dateserver($this->input->post('policyexpirydate', true)),
                            'wippermit_smokecondition' => $smokecondition,
                            'wippermit_fireext_serialno' => $fireext_serialno,
                            'wippermit_fireext_expirydate' => dateserver($fireext_expirydate),
                            'wippermit_tyre_manufacturingdate' => $tyre_manufacturingdate,
                            'location' => $location,
                            'startdate' => dateserver($startdate),
                            'enddate' => dateserver($enddate),
                            'entrypurpose' => $entrypurpose,
                            'entrypost' => $entrypost,
                            'exitpost' => $exitpost,
                            'steerman_name' => $steerman_name,
                            'steerman_icno' => $steerman_icno,
                            'steerman_adpno' => dateserver($steerman_adpno),
                            'escortservice' => $escortservice,
                        ];
                    }

                    $this->content = 'permit/wip_review';
                } elseif ($permittype == "shins") {

                    $permittype              = $this->input->post('permittype', true);
                    $verify_status           = $this->input->post('verify_status', true);
                    $vehicle_id              = $this->input->post('vehicle_id', true);
                    $vehicle_registration_no = $this->input->post('vehicle_registration_no', true);
                    $vehicle_parkingarea_id  = $this->input->post('vehicle_parkingarea_id', true);
                    /*$vehicle_engine_capacity = $this->input->post('vehicle_engine_capacity', true);*/
                    $inspection_date           = $this->input->post('inspection_date', true);
                    $shins_requireddoc         = $this->input->post('shins_requireddoc', true);
                    $shins_mtwchecked_selected = $this->input->post('mtwchecklist_selected', true);

                    $shins_insurancedoc        = $this->input->post('shins_insurancedoc', true);
                    $vehicle_engine_capacity   = $this->input->post('vehicle_engine_capacity', true);
                    $vehicle_vehiclegroup_name = $this->input->post('vehicle_vehiclegroup_name', true);
                    $vehicle_chasis_no         = $this->input->post('vehicle_chasis_no', true);
                    $vehicle_engine_no         = $this->input->post('vehicle_engine_no', true);
                    $vehicle_enginetype_name   = $this->input->post('vehicle_enginetype_name', true);
                    $vehicle_year_manufacture  = $this->input->post('vehicle_year_manufacture', true);

                    $smokecondition         = $this->input->post('smokecondition', true);
                    $fireext_serialno       = $this->input->post('fireext_serialno', true);
                    $fireext_expirydate     = $this->input->post('fireext_expirydate', true);
                    $tyre_manufacturingdate = $this->input->post('tyre_manufacturingdate', true);
                    $inspection_title       = explode("-", $this->input->post('inspection_title', true));
                    $location               = $inspection_title[0];
                    $startdate              = $this->input->post('startdate', true);
                    $enddate                = $this->input->post('enddate', true);

                    if ($inspection_date) {
                        $data = [
                            'permit_data' => '',
                            'permission' => $this->permission,
                            'verify_status' => $verify_status,
                            'vehicle_id' => $vehicle_id,
                            'vehicle_registration_no' => $vehicle_registration_no,
                            'vehicle_parkingarea_id' => $vehicle_parkingarea_id,
                            'vehicle_engine_capacity' => $vehicle_engine_capacity,
                            'inspection_date' => $inspection_date,
                            'shins_requireddoc' => $shins_requireddoc,
                            'shins_requireddoc_filename' => $this->uploadfiles_model->get_shins_requireddoc($vehicle_id),
                            'mtwchecklist_data' => $this->mtwchecklist_model->get_all($permittype),
                            'shins_mtwchecked_selected' => $shins_mtwchecked_selected,
                            'shins_insurancedoc' => $shins_insurancedoc,
                            'shins_insurancedoc_filename' => $this->uploadfiles_model->get_shins_insurancedoc($vehicle_id),
                            'vehicle_vehiclegroup_name' => $vehicle_vehiclegroup_name,
                            'vehicle_chasis_no' => $vehicle_chasis_no,
                            'vehicle_engine_no' => $vehicle_engine_no,
                            'vehicle_enginetype_name' => $vehicle_enginetype_name,
                            'vehicle_year_manufacture' => $vehicle_year_manufacture,
                            'policyno' => $this->input->post('policyno', true),
                            'policyexpirydate' => dateserver($this->input->post('policyexpirydate', true)),
                            'shinspermit_smokecondition' => $smokecondition,
                            'shinspermit_fireext_serialno' => $fireext_serialno,
                            'shinspermit_fireext_expirydate' => dateserver($fireext_expirydate),
                            'shinspermit_tyre_manufacturingdate' => $tyre_manufacturingdate,
                            'location' => $location,
                            'startdate' => $startdate,
                            'enddate' => $enddate,
                        ];
                    }
                    $this->content = 'permit/shins_review';
                } elseif ($permittype == "wipbriefing") {
                    // print_r($this->input->post());exit;
                    $permittype              = $this->input->post('permittype', true);
                    $verify_status           = $this->input->post('verify_status', true);
                    $vehicle_id              = $this->input->post('vehicle_id', true);
                    $vehicle_registration_no = $this->input->post('vehicle_registration_no', true);
                    $vehicle_parkingarea_id  = $this->input->post('vehicle_parkingarea_id', true);
                    //$wipbriefing_date         = $this->input->post('wipbriefing_date', true);
                    $wipbriefing_date        = $this->input->post('startdate', true);
                    $wipbriefing_location    = $this->input->post('wipbriefing_location', true);
                    $wipbriefing_requireddoc = $this->input->post('wipbriefing_requireddoc', true);

                    $wipbriefing_insurancedoc  = $this->input->post('wipbriefing_insurancedoc', true);
                    $vehicle_engine_capacity   = $this->input->post('vehicle_engine_capacity', true);
                    $vehicle_vehiclegroup_name = $this->input->post('vehicle_vehiclegroup_name', true);
                    $vehicle_chasis_no         = $this->input->post('vehicle_chasis_no', true);
                    $vehicle_engine_no         = $this->input->post('vehicle_engine_no', true);
                    $vehicle_enginetype_name   = $this->input->post('vehicle_enginetype_name', true);
                    $vehicle_year_manufacture  = $this->input->post('vehicle_year_manufacture', true);
                    $wipbriefing_title         = explode("-", $this->input->post('wipbriefing_title', true));
                    $location                  = $wipbriefing_title[0];
                    $startdate                 = $this->input->post('startdate', true);
                    $enddate                   = $this->input->post('enddate', true);

                    $entrypurpose   = $this->input->post('entrypurpose', true);
                    $entrypost      = $this->input->post('entrypost', true);
                    $exitpost       = $this->input->post('exitpost', true);
                    $steerman_name  = $this->input->post('steerman_name', true);
                    $steerman_icno  = $this->input->post('steerman_icno', true);
                    $steerman_adpno = $this->input->post('steerman_adpno', true);
                    $escortservice  = $this->input->post('escortservice', true);

                    if ($wipbriefing_date) {
                        $data = [
                            'permit_data' => '',
                            'permission' => $this->permission,
                            'verify_status' => $verify_status,
                            'vehicle_id' => $vehicle_id,
                            'vehicle_registration_no' => $vehicle_registration_no,
                            'vehicle_parkingarea_id' => $vehicle_parkingarea_id,
                            'vehicle_engine_capacity' => $vehicle_engine_capacity,
                            'wipbriefing_date' => dateserver($wipbriefing_date),
                            'wipbriefing_requireddoc' => $wipbriefing_requireddoc,
                            'wipbriefing_requireddoc_filename' => $this->uploadfiles_model->get_wipbriefing_requireddoc($vehicle_id),
                            'wipbriefing_insurancedoc' => $wipbriefing_insurancedoc,
                            'wipbriefing_insurancedoc_filename' => $this->uploadfiles_model->get_wipbriefing_insurancedoc($vehicle_id),
                            'vehicle_vehiclegroup_name' => $vehicle_vehiclegroup_name,
                            'vehicle_chasis_no' => $vehicle_chasis_no,
                            'vehicle_engine_no' => $vehicle_engine_no,
                            'vehicle_enginetype_name' => $vehicle_enginetype_name,
                            'vehicle_year_manufacture' => $vehicle_year_manufacture,
                            'policyno' => $this->input->post('policyno', true),
                            'policyexpirydate' => dateserver($this->input->post('policyexpirydate', true)),
                            'location' => $location,
                            'startdate' => dateserver($startdate),
                            'enddate' => dateserver($enddate),
                            'entrypurpose' => $entrypurpose,
                            'entrypost' => $entrypost,
                            'exitpost' => $exitpost,
                            'steerman_name' => $steerman_name,
                            'steerman_icno' => $steerman_icno,
                            'steerman_adpno' => dateserver($steerman_adpno),
                            'escortservice' => $escortservice,
                        ];
                    }
                    $this->content = 'permit/wipbriefing_review';

                } else {
                    $this->session->set_flashdata('message', 'Please select permit to continue');
                    redirect('/');
                }

                //
                $data['condition']       = $condition;
                $data['recent_permitid'] = $recent_permitid;
/*                if ($condition == 'renew') {
$data['serialno']        = $this->input->post('serialno', true);
$data['expirydate']      = $this->input->post('expirydate', true);
$data['recent_permitid'] = $this->input->post('recent_permitid', true);
}*/
                ##--slave_combine_to_list--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Illegal action.');
                redirect('/');
            }

        } else {
            redirect('/');
        }
    }

    public function submit()
    {

        if ($this->permission->cp_create == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];

            $permittype      = $this->input->post('permittype', true);
            $verify_status   = $this->input->post('verify_status', true);
            $condition       = $this->input->post('condition', true);
            $recent_permitid = $this->input->post('recent_permitid', true);
            $apply_remark    = $this->input->post('apply_remark', true);

/*
$recent_permitid = "";*/
            if ($condition == 'new') {
                $condition_id       = 1;
                $condition_schedule = 'New';
            } elseif ($condition == 'renew') {
                $condition_id       = 2;
                $condition_schedule = 'Renewal';
                //$recent_permitid = $recent_permitid;
            }
/*        print_r($this->input->post());
exit;*/
            $nowdatetime = date('Y-m-d H:i:s');
            if ($verify_status == "1") {
                if ($permittype == "adp") {
                    $driver_id       = $this->input->post('driver_id', true);
                    $driver_name     = $this->input->post('driver_name', true);
                    $driver_ic       = $this->input->post('driver_ic', true);
                    $examtaker_date  = $this->input->post('examtaker_date', true);
                    $adp_requireddoc = $this->input->post('adp_requireddoc', true);
                    $adp_trainercert = $this->input->post('adp_trainercert', true);
                    $driver_photo    = $this->input->post('driver_photo', true);
                    $driverclass     = $this->input->post('driverclass', true);
                    $vehicleclass    = $this->input->post('vehicleclass', true);
                    $exam_session    = $this->input->post('exam_session', true);
                    $location        = $this->input->post('location', true);
                    $courseinformation_notexist        = $this->input->post('courseinformation_notexist', true);

                    if (!empty($adp_trainercert)) {
                        $all_doc = explode(",", $adp_requireddoc . ',' . $adp_trainercert);
                    } else {
                        $all_doc = explode(",", $adp_requireddoc);
                    }

/*                    $country      = $this->input->post('country', true);
$licenseno    = $this->input->post('licenseno', true);
$drivingclass = $this->input->post('drivingclass', true);
$expirydate   = $this->input->post('expirydate', true);*/
                    $trainername  = $this->input->post('trainername', true);
                    $trainingdate = $this->input->post('trainingdate', true);

                    $bookingId = sprintf('%08d', rand(1000, 10000000));
                    $this->db->trans_start();
                    if ($examtaker_date) {
                        $data = [
                            'permit_data' => '',
                            'permission' => $this->permission,
                            'verify_status' => $verify_status,
                            'driver_id' => $driver_id,
                            'driver_name' => $driver_name,
                            'driver_ic' => $driver_ic,
                            'examtaker_date' => $examtaker_date,
                            'adp_requireddoc' => $adp_requireddoc,
                            'adp_requireddoc_filename' => $this->uploadfiles_model->get_adp_requireddoc($driver_id),
                            'adp_trainercert' => $adp_trainercert,
                            'adp_trainercert_filename' => $this->uploadfiles_model->get_adp_trainercert($driver_id),
                            'driver_photo' => $driver_photo,
                            'driver_photo_filename' => $this->uploadfiles_model->get_by_id($driver_photo)->uploadfiles_filename,
/*                            'country' => $country,
'countryname' => $this->refcountry_model->get_by_id($country)->ref_country_printable_name,
'licenseno' => $licenseno,
'drivingclass' => $drivingclass,
'expirydate' => $expirydate,*/
                            'trainername' => $trainername,
                            'trainingdate' => $trainingdate,
                            'bookingId' => $bookingId,
                        ];

                        $data_permit = [
                            'permit_groupid' => '1',
                            'permit_typeid' => '1',
                            'permit_condition' => $condition_id,
                            'permit_bookingid' => $bookingId,
                            'permit_picid' => $this->session->userdata('id'),
                            'permit_companyid' => $this->session->userdata('companyid'),
                            'permit_status' => 'docscheckingpending',
                            'permit_officialstatus' => 'pending',
                            /*'permit_timeline' => $nowdatetime . ' - PIC Submit ADP request<br>',*/
                            'permit_recent_permitid' => $recent_permitid,
                            'permit_enhance_locked' => 'y',
                            'permit_location' => $location,
                            'permit_created_at' => $nowdatetime,
                            'permit_lastchanged_by' => $this->session->userdata('id'),
                            'permit_apply_remark' => $apply_remark,
                            'permit_op_date' => $examtaker_date,
                            'permit_subject_identity' => $driver_ic,
                            'permit_subject_name' => $driver_name,
                        ];

                        $this->permit_model->insert($data_permit);
                        $primary_id = $this->db->insert_id();

                        $attendbriefing = $attendslip = (!empty($trainername) ? "y" : "");

                        if (empty($adp_trainercert)) {
                            $data_adp = [
                                'adppermit_permit_id' => $primary_id,
                                'adppermit_driver_id' => $driver_id,
                                'adppermit_driveracknowledgement' => 'v',
                                'adppermit_verifybyemployer' => 'y',
                                'adppermit_certbytrainer' => '',
                                'adppermit_certbytrainer_date' => null,
                                'adppermit_course_date' => $examtaker_date, //todo
                                'adppermit_competencytest_date' => $examtaker_date,
                                'adppermit_course_location' => $location,
                                'adppermit_attendbriefing' => $attendbriefing,
                                'adppermit_attendanceslip' => $attendslip,
                                'adppermit_verifybymahb_drivingarea' => $driverclass,
                                'adppermit_verifybymahb_vehicleclass' => $vehicleclass,
                                'adppermit_created_at' => $nowdatetime,
                                'adppermit_lastchanged_by' => $this->session->userdata('id'),
                            ];
                        } else {
                            /* exam only */
                            $data_adp = [
                                'adppermit_permit_id' => $primary_id,
                                'adppermit_driver_id' => $driver_id,
                                'adppermit_driveracknowledgement' => 'z',
                                'adppermit_verifybyemployer' => 'y',
                                'adppermit_certbytrainer' => $trainername,
                                'adppermit_certbytrainer_date' => $trainingdate,
                                'adppermit_course_date' => $trainingdate, //todo
                                'adppermit_competencytest_date' => $examtaker_date,
                                'adppermit_competencytest_session' => $exam_session,
                                'adppermit_course_location' => $location,
                                'adppermit_attendbriefing' => $attendbriefing,
                                'adppermit_attendanceslip' => $attendslip,
                                'adppermit_verifybymahb_drivingarea' => $driverclass,
                                'adppermit_verifybymahb_vehicleclass' => $vehicleclass,
                                'adppermit_created_at' => $nowdatetime,
                                'adppermit_lastchanged_by' => $this->session->userdata('id'),
                            ];
                        }

                        $this->adppermit_model->insert($data_adp);

                        $data_driver = [
/*                            'driver_drivinglicenseno' => $licenseno,
'driver_drivingclass' => $drivingclass,
'driver_licenseexpirydate' => $expirydate,*/
                            'driver_permit_typeid' => '1',
                            'driver_application_date' => date('Y-m-d'),
                            'driver_activity_statusid' => '5',
                            'driver_updated_at' => $nowdatetime,
                            'driver_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->driver_model->update($driver_id, $data_driver);

                        if (empty($adp_trainercert)) {
                            $adpbriefingmanagement = $this->adpbriefingmanagement_model->get_by_date($examtaker_date, $location, $condition_schedule, $driverclass);
                            $data_examtaker        = [
                                'examtaker_permit_id' => $primary_id,
                                'examtaker_driverid' => $driver_id,
                                'examtaker_exammanagement_id' => $adpbriefingmanagement->adpbriefingmanagement_id,
                                'examtaker_date' => $examtaker_date,
                                'examtaker_examno' => $bookingId,
                                'examtaker_created_at' => $nowdatetime,
                                'examtaker_lastchanged_by' => $this->session->userdata('id'),
                            ];

                            $this->examtaker_model->insert($data_examtaker);

                            $slottaken                  = (int) $adpbriefingmanagement->adpbriefingmanagement_slottaken + 1;
                            $data_adpbriefingmanagement = [
                                'adpbriefingmanagement_slottaken' => $slottaken,
                            ];

                            $this->adpbriefingmanagement_model->update($adpbriefingmanagement->adpbriefingmanagement_id, $data_adpbriefingmanagement);

                        } else {
                            /* exam only */
                            $examadpmanagement = $this->examadpmanagement_model->get_by_date($examtaker_date, $location, $exam_session);
                            $data_examtaker    = [
                                'examtaker_permit_id' => $primary_id,
                                'examtaker_driverid' => $driver_id,
                                'examtaker_examonlymanagement_id' => $examadpmanagement->exammanagement_id,
                                'examtaker_date' => $examtaker_date,
                                'examtaker_examno' => $bookingId,
                                'examtaker_created_at' => $nowdatetime,
                                'examtaker_lastchanged_by' => $this->session->userdata('id'),
                            ];

                            $this->examtaker_model->insert($data_examtaker);

                            $slottaken              = (int) $examadpmanagement->exammanagement_slottaken + 1;
                            $data_examadpmanagement = [
                                'exammanagement_slottaken' => $slottaken,
                            ];

                            $this->examadpmanagement_model->update($examadpmanagement->exammanagement_id, $data_examadpmanagement);

                        }

                        foreach ($all_doc as $doc) {
                            $this->uploadfiles_model->update($doc, ['uploadfiles_permit_id' => $primary_id]);

                        }

                        $data_timeline = [
                            'permit_timeline_permitid' => $primary_id,
                            'permit_timeline_userid' => $this->session->userdata('id'),
                            'permit_timeline_name' => PIC_SUBMIT_ADP,
                            'permit_timeline_desc' => AIRSIDE_ADMIN_CHECK_DOCS_ADP,
                            'permit_timeline_status' => 'docscheckingpending',
                            'permit_timeline_officialstatus' => 'pending',
                            'permit_timeline_created_at' => $nowdatetime,
                            'permit_timeline_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->permittimeline_model->insert($data_timeline);

                    }
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {

                        $data_pic = [
                            'bookingId' => $bookingId,
                        ];

                        $this->emailcontent->shoot_email('ADP', 'pic', $data_pic);

                        $data_admin = [
                            'bookingId' => $bookingId,
                            'driver_name' => $driver_name,
                        ];

                        $email = $this->admin_list('Admin Licensing', 'email');

                        $this->emailcontent->shoot_email('ADP', 'admin', $data_admin, $email);

                        $this->content = 'permit/adp_success';
                    }

                } elseif ($permittype == "evdp") {

                    $permittype               = $this->input->post('permittype', true);
                    $verify_status            = $this->input->post('verify_status', true);
                    $driver_id                = $this->input->post('driver_id', true);
                    $driver_name              = $this->input->post('driver_name', true);
                    $driver_ic                = $this->input->post('driver_ic', true);
                    $terminalbriefing_date    = $this->input->post('terminalbriefing_date', true);
                    $terminalbriefing_session = $this->input->post('terminalbriefing_session', true);
                    $evdp_requireddoc         = $this->input->post('evdp_requireddoc', true);
                    $driver_photo             = $this->input->post('driver_photo', true);
                    $all_doc                  = explode(",", $evdp_requireddoc);
                    $location                 = $this->input->post('location', true);

                    $bookingId = sprintf('%08d', rand(1000, 10000000));
                    $this->db->trans_start();

                    if ($terminalbriefing_date) {
                        $data = [
                            'permit_data' => '',
                            'permission' => $this->permission,
                            'verify_status' => $verify_status,
                            'driver_id' => $driver_id,
                            'driver_name' => $driver_name,
                            'driver_ic' => $driver_ic,
                            'terminalbriefing_date' => $terminalbriefing_date,
                            'terminalbriefing_session' => $terminalbriefing_session,
                            'evdp_requireddoc' => $evdp_requireddoc,
                            'evdp_requireddoc_filename' => $this->uploadfiles_model->get_evdp_requireddoc($driver_id),
                            'driver_photo' => $driver_photo,
                            'driver_photo_filename' => $this->uploadfiles_model->get_by_id($driver_photo)->uploadfiles_filename,
                            'bookingId' => $bookingId,
                        ];

                        $data_permit = [
                            'permit_groupid' => '1',
                            'permit_typeid' => '2',
                            'permit_condition' => $condition_id,
                            'permit_bookingid' => $bookingId,
                            'permit_picid' => $this->session->userdata('id'),
                            'permit_companyid' => $this->session->userdata('companyid'),
                            'permit_status' => 'docscheckingpending',
                            'permit_officialstatus' => 'pending',
                            /*'permit_timeline' => $nowdatetime . ' - PIC Submit EVDP request<br>',*/
                            'permit_recent_permitid' => $recent_permitid,
                            'permit_enhance_locked' => 'y',
                            'permit_location' => $location,
                            'permit_created_at' => $nowdatetime,
                            'permit_lastchanged_by' => $this->session->userdata('id'),
                            'permit_apply_remark' => $apply_remark,
                            'permit_op_date' => $terminalbriefing_date,
                            'permit_subject_identity' => $driver_ic,
                            'permit_subject_name' => $driver_name,
                        ];

                        $this->permit_model->insert($data_permit);
                        $primary_id = $this->db->insert_id();

                        $data_evdp = [
                            'evdppermit_permit_id' => $primary_id,
                            'evdppermit_driver_id' => $driver_id,
                            'evdppermit_driveracknowledgement' => 'y',
                            'evdppermit_driveracknowledgement_date' => $nowdatetime,
                            'evdppermit_certbyemployer' => 'y',
                            'evdppermit_certbyemployer_date' => $nowdatetime,
                            'evdppermit_course_date' => $terminalbriefing_date, //todo
                            'evdppermit_course_session' => $terminalbriefing_session,
                            'evdppermit_course_location' => $location,
                            'evdppermit_terminalbriefingscheduled' => 'y',
                            'evdppermit_terminalbriefingapproval' => 'y',
                            'evdppermit_created_at' => $nowdatetime,
                            'evdppermit_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->evdppermit_model->insert($data_evdp);

                        $data_driver = [
                            'driver_permit_typeid' => '2',
                            'driver_application_date' => date('Y-m-d'),
                            'driver_activity_statusid' => '5',
                            'driver_updated_at' => $nowdatetime,
                            'driver_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->driver_model->update($driver_id, $data_driver);

                        $evdpbriefingmanagement = $this->evdpbriefingmanagement_model->get_by_date($terminalbriefing_date, $location, $terminalbriefing_session);

                        $slottaken                   = (int) $evdpbriefingmanagement->evdpbriefingmanagement_slottaken + 1;
                        $data_evdpbriefingmanagement = [
                            'evdpbriefingmanagement_slottaken' => $slottaken,
                        ];

                        $this->evdpbriefingmanagement_model->update($evdpbriefingmanagement->evdpbriefingmanagement_id, $data_evdpbriefingmanagement);

                        foreach ($all_doc as $doc) {
                            $this->uploadfiles_model->update($doc, ['uploadfiles_permit_id' => $primary_id]);

                        }

                        $data_timeline = [
                            'permit_timeline_permitid' => $primary_id,
                            'permit_timeline_userid' => $this->session->userdata('id'),
                            'permit_timeline_name' => PIC_SUBMIT_EVDP,
                            'permit_timeline_desc' => TERMINAL_ADMIN_CHECK_DOCS_EVDP,
                            'permit_timeline_status' => 'docscheckingpending',
                            'permit_timeline_officialstatus' => 'pending',
                            'permit_timeline_created_at' => $nowdatetime,
                            'permit_timeline_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->permittimeline_model->insert($data_timeline);

                    }
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {

                        $data_pic = [
                            'bookingId' => $bookingId,
                        ];

                        $this->emailcontent->shoot_email('EVDP', 'pic', $data_pic);

                        $data_admin = [
                            'bookingId' => $bookingId,
                            'driver_name' => $driver_name,
                        ];

                        $email = $this->admin_list('Admin Licensing', 'email');

                        $this->emailcontent->shoot_email('EVDP', 'admin', $data_admin, $email);

                        $this->content = 'permit/evdp_success';
                    }

                } elseif ($permittype == "avp") {

                    $permittype              = $this->input->post('permittype', true);
                    $verify_status           = $this->input->post('verify_status', true);
                    $vehicle_id              = $this->input->post('vehicle_id', true);
                    $vehicle_registration_no = $this->input->post('vehicle_registration_no', true);
                    $vehicle_vehiclegroup    = $this->input->post('vehicle_vehiclegroup', true);
                    $vehicle_parkingarea_id  = $this->input->post('vehicle_parkingarea_id', true);
                    $vehicle_engine_capacity = $this->input->post('vehicle_engine_capacity', true);
                    $inspection_date         = $this->input->post('inspection_date', true);
                    $avp_requireddoc         = $this->input->post('avp_requireddoc', true);
                    $avp_insurancedoc        = $this->input->post('avp_insurancedoc', true);
                    /*$all_doc                 = explode(",", $avp_requireddoc);*/
                    $policyno         = $this->input->post('policyno', true);
                    $policyexpirydate = $this->input->post('policyexpirydate', true);

                    $smokecondition         = $this->input->post('smokecondition', true);
                    $fireext_serialno       = $this->input->post('fireext_serialno', true);
                    $fireext_expirydate     = $this->input->post('fireext_expirydate', true);
                    $tyre_manufacturingdate = $this->input->post('tyre_manufacturingdate', true);
                    $location               = $this->input->post('location', true);
                    $avpcategory            = $this->input->post('avpcategory', true);

                    if (!empty($avp_insurancedoc)) {
                        $all_doc = explode(",", $avp_requireddoc . ',' . $avp_insurancedoc);
                    } else {
                        $all_doc = explode(",", $avp_requireddoc);
                    }

                    $avp_mtwchecked_selected = $this->input->post('avp_mtwchecked_selected', true);

                    $bookingId = sprintf('%08d', rand(1000, 10000000));
                    $this->db->trans_start();

                    if ($inspection_date) {
                        $data = [
                            'permit_data' => '',
                            'permission' => $this->permission,
                            'verify_status' => $verify_status,
                            'vehicle_id' => $vehicle_id,
                            'vehicle_registration_no' => $vehicle_registration_no,
                            'vehicle_parkingarea_id' => $vehicle_parkingarea_id,
                            'vehicle_engine_capacity' => $vehicle_engine_capacity,
                            'inspection_date' => $inspection_date,
                            'avp_requireddoc' => $avp_requireddoc,
                            'avp_requireddoc_filename' => $this->uploadfiles_model->get_avp_requireddoc($vehicle_id),
                            'avp_mtwchecked_selected' => $avp_mtwchecked_selected,
                            'bookingId' => $bookingId,
                        ];

                        $data_permit = [
                            'permit_groupid' => '2',
                            'permit_typeid' => '4',
                            'permit_condition' => $condition_id,
                            'permit_bookingid' => $bookingId,
                            'permit_picid' => $this->session->userdata('id'),
                            'permit_companyid' => $this->session->userdata('companyid'),
                            'permit_status' => 'mtwreviewpending',
                            'permit_officialstatus' => 'pending',
                            /*'permit_timeline' => $nowdatetime . ' - PIC Submit AVP request<br>',*/
                            'permit_recent_permitid' => $recent_permitid,
                            'permit_enhance_locked' => 'y',
                            'permit_location' => $location,
                            'permit_created_at' => $nowdatetime,
                            'permit_lastchanged_by' => $this->session->userdata('id'),
                            'permit_apply_remark' => $apply_remark,
                            'permit_op_date' => $inspection_date,
                            'permit_subject_identity' => $vehicle_registration_no,
                            'permit_subject_name' => $vehicle_vehiclegroup,
                        ];

                        $this->permit_model->insert($data_permit);
                        $primary_id = $this->db->insert_id();

                        $data_avp = [
                            'avppermit_permit_id' => $primary_id,
                            'avppermit_vehicle_id' => $vehicle_id,
                            'avppermit_required_briefing' => 'n',
                            'avppermit_ownchecked_by' => 'y',
                            'avppermit_ownchecked_date' => $nowdatetime,
                            'avppermit_ownverified_by' => 'y',
                            'avppermit_ownverified_date' => $nowdatetime,
                            'avppermit_inspection_date' => $inspection_date, //todo
                            'avppermit_inspection_location' => $location,
                            'avppermit_inspectionscheduled' => 'y',
                            'avppermit_policyno' => $policyno,
                            'avppermit_policyexpirydate' => $policyexpirydate,
                            'avppermit_smokecondition' => $smokecondition,
                            'avppermit_fireext_serialno' => $fireext_serialno,
                            'avppermit_fireext_expirydate' => $fireext_expirydate,
                            'avppermit_tyre_manufacturingdate' => $tyre_manufacturingdate,
                            'avppermit_avpcategory' => $avpcategory,
                            'avppermit_created_at' => $nowdatetime,
                            'avppermit_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->avppermit_model->insert($data_avp);

                        $data_vehicle = [
                            'vehicle_permit_typeid' => '4',
                            'vehicle_insurance_policy_no' => $policyno,
                            'vehicle_insurance_expiry_date' => $policyexpirydate,
                            'vehicle_application_date' => date('Y-m-d'),
                            'vehicle_activity_statusid' => '5',
                            'vehicle_updated_at' => $nowdatetime,
                            'vehicle_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->vehicle_model->update($vehicle_id, $data_vehicle);

                        $avpevpinspectionmanagement = $this->avpevpinspectionmanagement_model->get_by_date($inspection_date);

                        $slottaken                       = (int) $avpevpinspectionmanagement->avpevpinspectionmanagement_slottaken + 1;
                        $data_avpevpinspectionmanagement = [
                            'avpevpinspectionmanagement_slottaken' => $slottaken,
                        ];

                        $this->avpevpinspectionmanagement_model->update($avpevpinspectionmanagement->avpevpinspectionmanagement_id, $data_avpevpinspectionmanagement);

                        foreach ($all_doc as $doc) {
                            $this->uploadfiles_model->update($doc, ['uploadfiles_permit_id' => $primary_id]);

                        }

/*      checklist                   */
                        $this->mtwchecklist_model->copy_checklist($primary_id, $permittype, $avp_mtwchecked_selected);

                        $data_timeline = [
                            'permit_timeline_permitid' => $primary_id,
                            'permit_timeline_userid' => $this->session->userdata('id'),
                            'permit_timeline_name' => PIC_SUBMIT_AVP,
                            'permit_timeline_desc' => MTW_ADMIN_CHECK_DOCS_AVP,
                            'permit_timeline_status' => 'mtwreviewpending',
                            'permit_timeline_officialstatus' => 'pending',
                            'permit_timeline_created_at' => $nowdatetime,
                            'permit_timeline_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->permittimeline_model->insert($data_timeline);

                    }
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {

                        $data_pic = [
                            'bookingId' => $bookingId,
                        ];

                        $this->emailcontent->shoot_email('AVP', 'pic', $data_pic);

                        $data_admin = [
                            'bookingId' => $bookingId,
                            'vehicle_registration_no' => $vehicle_registration_no,
                        ];

/*                        $email = $this->admin_list('Inspector MTW', 'email');

                        $this->emailcontent->shoot_email('AVP', 'admin', $data_admin, $email);*/

                        $this->content = 'permit/avp_success';
                    }

                } elseif ($permittype == "evp") {

                    $permittype              = $this->input->post('permittype', true);
                    $verify_status           = $this->input->post('verify_status', true);
                    $vehicle_id              = $this->input->post('vehicle_id', true);
                    $vehicle_registration_no = $this->input->post('vehicle_registration_no', true);
                    $vehicle_vehiclegroup    = $this->input->post('vehicle_vehiclegroup', true);
                    $vehicle_parkingarea_id  = $this->input->post('vehicle_parkingarea_id', true);
                    $vehicle_engine_capacity = $this->input->post('vehicle_engine_capacity', true);
                    $inspection_date         = $this->input->post('inspection_date', true);
                    $evp_requireddoc         = $this->input->post('evp_requireddoc', true);
                    $evp_insurancedoc        = $this->input->post('evp_insurancedoc', true);
                    /*$all_doc                 = explode(",", $evp_requireddoc);*/

                    $policyno         = $this->input->post('policyno', true);
                    $policyexpirydate = $this->input->post('policyexpirydate', true);
                    $location         = $this->input->post('location', true);

                    if (!empty($evp_insurancedoc)) {
                        $all_doc = explode(",", $evp_requireddoc . ',' . $evp_insurancedoc);
                    } else {
                        $all_doc = explode(",", $evp_requireddoc);
                    }

                    $evp_mtwchecked_selected = $this->input->post('evp_mtwchecked_selected', true);

                    $bookingId = sprintf('%08d', rand(1000, 10000000));
                    $this->db->trans_start();

                    if ($inspection_date) {
                        $data = [
                            'permit_data' => '',
                            'permission' => $this->permission,
                            'verify_status' => $verify_status,
                            'vehicle_id' => $vehicle_id,
                            'vehicle_registration_no' => $vehicle_registration_no,
                            'vehicle_parkingarea_id' => $vehicle_parkingarea_id,
                            'vehicle_engine_capacity' => $vehicle_engine_capacity,
                            'inspection_date' => $inspection_date,
                            'evp_requireddoc' => $evp_requireddoc,
                            'evp_requireddoc_filename' => $this->uploadfiles_model->get_evp_requireddoc($vehicle_id),
                            'evp_mtwchecked_selected' => $evp_mtwchecked_selected,
                            'bookingId' => $bookingId,
                        ];

                        $data_permit = [
                            'permit_groupid' => '2',
                            'permit_typeid' => '3',
                            'permit_condition' => $condition_id,
                            'permit_bookingid' => $bookingId,
                            'permit_picid' => $this->session->userdata('id'),
                            'permit_companyid' => $this->session->userdata('companyid'),
                            'permit_status' => 'mtwreviewpending',
                            'permit_officialstatus' => 'pending',
                            /*'permit_timeline' => $nowdatetime . ' - PIC Submit EVP request<br>',*/
                            'permit_recent_permitid' => $recent_permitid,
                            'permit_enhance_locked' => 'y',
                            'permit_location' => $location,
                            'permit_created_at' => $nowdatetime,
                            'permit_lastchanged_by' => $this->session->userdata('id'),
                            'permit_apply_remark' => $apply_remark,
                            'permit_op_date' => $inspection_date,
                            'permit_subject_identity' => $vehicle_registration_no,
                            'permit_subject_name' => $vehicle_vehiclegroup,
                        ];

                        $this->permit_model->insert($data_permit);
                        $primary_id = $this->db->insert_id();

                        $data_evp = [
                            'evppermit_permit_id' => $primary_id,
                            'evppermit_vehicle_id' => $vehicle_id,
                            'evppermit_required_briefing' => 'y',
                            'evppermit_ownerauthorization' => 'y',
                            'evppermit_ownerauthorization_date' => $nowdatetime,
                            'evppermit_inspection_date' => $inspection_date, //todo
                            'evppermit_inspection_location' => $location,
                            'evppermit_policyno' => $policyno,
                            'evppermit_policyexpirydate' => $policyexpirydate,
                            'evppermit_created_at' => $nowdatetime,
                            'evppermit_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->evppermit_model->insert($data_evp);

                        $data_vehicle = [
                            'vehicle_permit_typeid' => '3',
                            'vehicle_insurance_policy_no' => $policyno,
                            'vehicle_insurance_expiry_date' => $policyexpirydate,
                            'vehicle_application_date' => date('Y-m-d'),
                            'vehicle_activity_statusid' => '5',
                            'vehicle_updated_at' => $nowdatetime,
                            'vehicle_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->vehicle_model->update($vehicle_id, $data_vehicle);

                        $avpevpinspectionmanagement = $this->avpevpinspectionmanagement_model->get_by_date($inspection_date);

                        $slottaken                       = (int) $avpevpinspectionmanagement->avpevpinspectionmanagement_slottaken + 1;
                        $data_avpevpinspectionmanagement = [
                            'avpevpinspectionmanagement_slottaken' => $slottaken,
                        ];

                        $this->avpevpinspectionmanagement_model->update($avpevpinspectionmanagement->avpevpinspectionmanagement_id, $data_avpevpinspectionmanagement);

                        foreach ($all_doc as $doc) {
                            $this->uploadfiles_model->update($doc, ['uploadfiles_permit_id' => $primary_id]);

                        }

/*      checklist                   */
                        $this->mtwchecklist_model->copy_checklist($primary_id, $permittype, $evp_mtwchecked_selected);

                        $data_timeline = [
                            'permit_timeline_permitid' => $primary_id,
                            'permit_timeline_userid' => $this->session->userdata('id'),
                            'permit_timeline_name' => PIC_SUBMIT_EVP,
                            'permit_timeline_desc' => MTW_ADMIN_CHECK_DOCS_EVP,
                            'permit_timeline_status' => 'mtwreviewpending',
                            'permit_timeline_officialstatus' => 'pending',
                            'permit_timeline_created_at' => $nowdatetime,
                            'permit_timeline_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->permittimeline_model->insert($data_timeline);

                    }
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {

                        $data_pic = [
                            'bookingId' => $bookingId,
                        ];

                        $this->emailcontent->shoot_email('EVP', 'pic', $data_pic);

                        $data_admin = [
                            'bookingId' => $bookingId,
                            'vehicle_registration_no' => $vehicle_registration_no,
                        ];

/*                        $email = $this->admin_list('Inspector MTW', 'email');

                        $this->emailcontent->shoot_email('EVP', 'admin', $data_admin, $email);*/

                        $this->content = 'permit/evp_success';
                    }

                } elseif ($permittype == "pbb") {

                    $permittype          = $this->input->post('permittype', true);
                    $verify_status       = $this->input->post('verify_status', true);
                    $driver_id           = $this->input->post('driver_id', true);
                    $driver_name         = $this->input->post('driver_name', true);
                    $driver_ic           = $this->input->post('driver_ic', true);
                    $pbbbriefing_date    = $this->input->post('pbbbriefing_date', true);
                    $pbbbriefing_session = $this->input->post('pbbbriefing_session', true);
                    $pbb_requireddoc     = $this->input->post('pbb_requireddoc', true);
                    $driver_photo        = $this->input->post('driver_photo', true);
                    $all_doc             = explode(",", $pbb_requireddoc);
                    $location            = $this->input->post('location', true);

                    $bookingId = sprintf('%08d', rand(1000, 10000000));
                    $this->db->trans_start();

                    if ($pbbbriefing_date) {
                        $data = [
                            'permit_data' => '',
                            'permission' => $this->permission,
                            'verify_status' => $verify_status,
                            'driver_id' => $driver_id,
                            'driver_name' => $driver_name,
                            'driver_ic' => $driver_ic,
                            'pbbbriefing_date' => $pbbbriefing_date,
                            'pbbbriefing_session' => $pbbbriefing_session,
                            'pbb_requireddoc' => $pbb_requireddoc,
                            'pbb_requireddoc_filename' => $this->uploadfiles_model->get_pbb_requireddoc($driver_id),
                            'driver_photo' => $driver_photo,
                            'driver_photo_filename' => $this->uploadfiles_model->get_by_id($driver_photo)->uploadfiles_filename,
                            'bookingId' => $bookingId,
                        ];

                        $data_permit = [
                            'permit_groupid' => '3',
                            'permit_typeid' => '5',
                            'permit_condition' => $condition_id,
                            'permit_bookingid' => $bookingId,
                            'permit_picid' => $this->session->userdata('id'),
                            'permit_companyid' => $this->session->userdata('companyid'),
                            'permit_status' => 'docscheckingpending',
                            'permit_officialstatus' => 'pending',
                            /*'permit_timeline' => $nowdatetime . ' - PIC Submit PBB request<br>',*/
                            'permit_recent_permitid' => $recent_permitid,
                            'permit_enhance_locked' => 'y',
                            'permit_location' => $location,
                            'permit_created_at' => $nowdatetime,
                            'permit_lastchanged_by' => $this->session->userdata('id'),
                            'permit_apply_remark' => $apply_remark,
                            'permit_op_date' => $pbbbriefing_date,
                            'permit_subject_identity' => $driver_ic,
                            'permit_subject_name' => $driver_name,
                        ];

                        $this->permit_model->insert($data_permit);
                        $primary_id = $this->db->insert_id();

                        $data_pbb = [
                            'pbbpermit_permit_id' => $primary_id,
                            'pbbpermit_driver_id' => $driver_id,
                            'pbbpermit_driveracknowledgement' => 'y',
                            'pbbpermit_driveracknowledgement_date' => $nowdatetime,
                            'pbbpermit_certbyemployer' => 'y',
                            'pbbpermit_certbyemployer_date' => $nowdatetime,
                            'pbbpermit_course_date' => $pbbbriefing_date, //todo
                            'pbbpermit_course_session' => $pbbbriefing_session,
                            'pbbpermit_course_location' => $location,
                            'pbbpermit_pbbbriefingscheduled' => 'y',
                            'pbbpermit_pbbbriefingapproval' => 'y',
                            'pbbpermit_created_at' => $nowdatetime,
                            'pbbpermit_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->pbbpermit_model->insert($data_pbb);

                        $data_driver = [
                            'driver_permit_typeid' => '5', //pbb
                            'driver_application_date' => date('Y-m-d'),
                            'driver_activity_statusid' => '5',
                            'driver_updated_at' => $nowdatetime,
                            'driver_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->driver_model->update($driver_id, $data_driver);

                        $ffpbbbriefingmanagement = $this->ffpbbbriefingmanagement_model->get_by_date($pbbbriefing_date);

                        $slottaken                    = (int) $ffpbbbriefingmanagement->ffpbb_briefingmanagement_slottaken + 1;
                        $data_ffpbbbriefingmanagement = [
                            'ffpbb_briefingmanagement_slottaken' => $slottaken,
                        ];

                        $this->ffpbbbriefingmanagement_model->update($ffpbbbriefingmanagement->ffpbb_briefingmanagement_id, $data_ffpbbbriefingmanagement);

                        foreach ($all_doc as $doc) {
                            $this->uploadfiles_model->update($doc, ['uploadfiles_permit_id' => $primary_id]);

                        }

                        $data_timeline = [
                            'permit_timeline_permitid' => $primary_id,
                            'permit_timeline_userid' => $this->session->userdata('id'),
                            'permit_timeline_name' => PIC_SUBMIT_PBB,
                            'permit_timeline_desc' => PBB_ADMIN_CHECK_DOCS_PBB,
                            'permit_timeline_status' => 'docscheckingpending',
                            'permit_timeline_officialstatus' => 'pending',
                            'permit_timeline_created_at' => $nowdatetime,
                            'permit_timeline_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->permittimeline_model->insert($data_timeline);

                    }
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {

                        $data_pic = [
                            'bookingId' => $bookingId,
                        ];

                        $this->emailcontent->shoot_email('PBB', 'pic', $data_pic);

                        $data_admin = [
                            'bookingId' => $bookingId,
                            'driver_name' => $driver_name,
                        ];

                        $email = $this->admin_list('Admin Licensing', 'email');

                        $this->emailcontent->shoot_email('PBB', 'admin', $data_admin, $email);

                        $this->content = 'permit/pbb_success';
                    }

                } elseif ($permittype == "cs") {

                    $permittype                 = $this->input->post('permittype', true);
                    $verify_status              = $this->input->post('verify_status', true);
                    $vehicle_id                 = $this->input->post('vehicle_id', true);
                    $vehicle_registration_no    = $this->input->post('vehicle_registration_no', true);
                    $vehicle_vehiclegroup       = $this->input->post('vehicle_vehiclegroup', true);
                    $vehicle_parkingarea_id     = $this->input->post('vehicle_parkingarea_id', true);
                    $vehicle_engine_capacity    = $this->input->post('vehicle_engine_capacity', true);
                    $csbriefing_date            = $this->input->post('csbriefing_date', true);
                    $csbriefing_location        = $this->input->post('csbriefing_location', true);
                    $cs_requireddoc             = $this->input->post('cs_requireddoc', true);
                    $cs_insurancedoc            = $this->input->post('cs_insurancedoc', true);
                    $policyno                   = $this->input->post('policyno', true);
                    $policyexpirydate           = $this->input->post('policyexpirydate', true);
                    $permit_issuance_startdate  = $this->input->post('permit_issuance_startdate', true);
                    $permit_issuance_expirydate = $this->input->post('permit_issuance_expirydate', true);
                    $location                   = $this->input->post('location', true);

                    $entrypurpose   = $this->input->post('entrypurpose', true);
                    $entrypost      = $this->input->post('entrypost', true);
                    $exitpost       = $this->input->post('exitpost', true);
                    $steerman_name  = $this->input->post('steerman_name', true);
                    $steerman_icno  = $this->input->post('steerman_icno', true);
                    $steerman_adpno = $this->input->post('steerman_adpno', true);
                    $escortservice  = $this->input->post('escortservice', true);

                    if (!empty($cs_insurancedoc)) {
                        $all_doc = explode(",", $cs_requireddoc . ',' . $cs_insurancedoc);
                    } else {
                        $all_doc = explode(",", $cs_requireddoc);
                    }

                    $bookingId = sprintf('%08d', rand(1000, 10000000));
                    $this->db->trans_start();

                    if ($csbriefing_date) {
                        $data = [
                            'permit_data' => '',
                            'permission' => $this->permission,
                            'verify_status' => $verify_status,
                            'vehicle_id' => $vehicle_id,
                            'vehicle_registration_no' => $vehicle_registration_no,
                            'vehicle_parkingarea_id' => $vehicle_parkingarea_id,
                            'vehicle_engine_capacity' => $vehicle_engine_capacity,
                            'csbriefing_date' => $csbriefing_date,
                            'csbriefing_location' => $csbriefing_location,
                            'cs_requireddoc' => $cs_requireddoc,
                            'cs_requireddoc_filename' => $this->uploadfiles_model->get_cs_requireddoc($vehicle_id),
                            'bookingId' => $bookingId,
                        ];

                        $data_permit = [
                            'permit_groupid' => '4',
                            'permit_typeid' => '10',
                            'permit_condition' => $condition_id,
                            'permit_bookingid' => $bookingId,
                            'permit_picid' => $this->session->userdata('id'),
                            'permit_companyid' => $this->session->userdata('companyid'),
                            'permit_status' => 'mtwreviewpending', // original 'docscheckingpending'
                            'permit_officialstatus' => 'pending',
                            /*'permit_timeline' => $nowdatetime . ' - PIC Submit CS request<br>',*/
                            'permit_recent_permitid' => $recent_permitid,
                            'permit_enhance_locked' => 'y',
                            'permit_location' => $location,
                            'permit_created_at' => $nowdatetime,
                            'permit_lastchanged_by' => $this->session->userdata('id'),
                            'permit_apply_remark' => $apply_remark,
                            'permit_op_date' => $csbriefing_date,
                            'permit_subject_identity' => $vehicle_registration_no,
                            'permit_subject_name' => $vehicle_vehiclegroup,
                            'permit_issuance_startdate' => dateserver($permit_issuance_startdate),
                            'permit_issuance_expirydate' => dateserver($permit_issuance_expirydate),
                        ];

                        $this->permit_model->insert($data_permit);
                        $primary_id = $this->db->insert_id();

                        $data_cs = [
                            'cspermit_permit_id' => $primary_id,
                            'cspermit_vehicle_id' => $vehicle_id,
                            'cspermit_required_briefing' => 'y',
                            'cspermit_ownerauthorization' => 'y',
                            'cspermit_ownerauthorization_date' => $nowdatetime,
                            'cspermit_course_date' => dateserver($csbriefing_date), //todo
                            'cspermit_policyno' => $policyno,
                            'cspermit_policyexpirydate' => dateserver($policyexpirydate),
                            'cspermit_created_at' => $nowdatetime,
                            'cspermit_lastchanged_by' => $this->session->userdata('id'),
                            'cspermit_entrypurpose' => $entrypurpose,
                            'cspermit_entrypost' => $entrypost,
                            'cspermit_exitpost' => $exitpost,
                            'cspermit_steerman_name' => $steerman_name,
                            'cspermit_steerman_icno' => $steerman_icno,
                            'cspermit_steerman_adpno' => dateserver($steerman_adpno),
                            'cspermit_needescort' => $escortservice,
                            'cspermit_location' => $csbriefing_location,
                        ];

                        $this->cspermit_model->insert($data_cs);

                        $data_vehicle = [
                            'vehicle_permit_typeid' => '10',
                            'vehicle_insurance_policy_no' => $policyno,
                            'vehicle_insurance_expiry_date' => dateserver($policyexpirydate),
                            'vehicle_application_date' => date('Y-m-d'),
                            'vehicle_activity_statusid' => '5',
                            'vehicle_updated_at' => $nowdatetime,
                            'vehicle_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->vehicle_model->update($vehicle_id, $data_vehicle);

/*                        $tepinspectionmanagement = $this->tepinspectionmanagement_model->get_by_date($csbriefing_date);

$slottaken                 = (int) $tepinspectionmanagement->tepinspectionmanagement_slottaken + 1;
$data_tepinspectionmanagement = [
'tepinspectionmanagement_slottaken' => $slottaken,
];

$this->tepinspectionmanagement_model->update($tepinspectionmanagement->tepinspectionmanagement_id, $data_tepinspectionmanagement);*/

                        foreach ($all_doc as $doc) {
                            $this->uploadfiles_model->update($doc, ['uploadfiles_permit_id' => $primary_id]);

                        }

                        $data_timeline = [
                            'permit_timeline_permitid' => $primary_id,
                            'permit_timeline_userid' => $this->session->userdata('id'),
                            'permit_timeline_name' => PIC_SUBMIT_CS,
                            'permit_timeline_desc' => CS_ADMIN_CHECK_DOCS_CS,
                            'permit_timeline_status' => 'mtwreviewpending',
                            'permit_timeline_officialstatus' => 'pending',
                            'permit_timeline_created_at' => $nowdatetime,
                            'permit_timeline_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->permittimeline_model->insert($data_timeline);

                    }
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {

                        $data_pic = [
                            'bookingId' => $bookingId,
                        ];

                        $this->emailcontent->shoot_email('CS', 'pic', $data_pic);

                        $data_admin = [
                            'bookingId' => $bookingId,
                            'vehicle_registration_no' => $vehicle_registration_no,
                        ];

                        $email = $this->admin_list('Admin Licensing', 'email');

                        $this->emailcontent->shoot_email('CS', 'admin', $data_admin, $email);

                        $this->content = 'permit/cs_success';
                    }

                } elseif ($permittype == "sh") {

                    $permittype                 = $this->input->post('permittype', true);
                    $verify_status              = $this->input->post('verify_status', true);
                    $vehicle_id                 = $this->input->post('vehicle_id', true);
                    $vehicle_registration_no    = $this->input->post('vehicle_registration_no', true);
                    $vehicle_vehiclegroup       = $this->input->post('vehicle_vehiclegroup', true);
                    $vehicle_parkingarea_id     = $this->input->post('vehicle_parkingarea_id', true);
                    $vehicle_engine_capacity    = $this->input->post('vehicle_engine_capacity', true);
                    $shbriefing_date            = $this->input->post('shbriefing_date', true);
                    $shbriefing_location        = $this->input->post('shbriefing_location', true);
                    $sh_requireddoc             = $this->input->post('sh_requireddoc', true);
                    $sh_insurancedoc            = $this->input->post('sh_insurancedoc', true);
                    $policyno                   = $this->input->post('policyno', true);
                    $policyexpirydate           = $this->input->post('policyexpirydate', true);
                    $permit_issuance_startdate  = $this->input->post('permit_issuance_startdate', true);
                    $permit_issuance_expirydate = $this->input->post('permit_issuance_expirydate', true);
                    $location                   = $this->input->post('location', true);

                    $entrypurpose = $this->input->post('entrypurpose', true);
                    $entrypost    = $this->input->post('entrypost', true);
                    $exitpost     = $this->input->post('exitpost', true);
/*                    $steerman_name = $this->input->post('steerman_name', true);
$steerman_icno = $this->input->post('steerman_icno', true);
$steerman_adpno = $this->input->post('steerman_adpno', true);
$escortservice = $this->input->post('escortservice', true);*/

                    if (!empty($sh_insurancedoc)) {
                        $all_doc = explode(",", $sh_requireddoc . ',' . $sh_insurancedoc);
                    } else {
                        $all_doc = explode(",", $sh_requireddoc);
                    }

                    $bookingId = sprintf('%08d', rand(1000, 10000000));
                    $this->db->trans_start();

                    if ($shbriefing_date) {
                        $data = [
                            'permit_data' => '',
                            'permission' => $this->permission,
                            'verify_status' => $verify_status,
                            'vehicle_id' => $vehicle_id,
                            'vehicle_registration_no' => $vehicle_registration_no,
                            'vehicle_parkingarea_id' => $vehicle_parkingarea_id,
                            'vehicle_engine_capacity' => $vehicle_engine_capacity,
                            'shbriefing_date' => $shbriefing_date,
                            'shbriefing_location' => $shbriefing_location,
                            'sh_requireddoc' => $sh_requireddoc,
                            'sh_requireddoc_filename' => $this->uploadfiles_model->get_sh_requireddoc($vehicle_id),
                            'bookingId' => $bookingId,
                        ];

                        $data_permit = [
                            'permit_groupid' => '4',
                            'permit_typeid' => '11',
                            'permit_condition' => $condition_id,
                            'permit_bookingid' => $bookingId,
                            'permit_picid' => $this->session->userdata('id'),
                            'permit_companyid' => $this->session->userdata('companyid'),
                            'permit_status' => 'mtwreviewpending', // original 'docscheckingpending'
                            'permit_officialstatus' => 'pending',
                            /*'permit_timeline' => $nowdatetime . ' - PIC Submit SH request<br>',*/
                            'permit_recent_permitid' => $recent_permitid,
                            'permit_enhance_locked' => 'y',
                            'permit_location' => $location,
                            'permit_created_at' => $nowdatetime,
                            'permit_lastchanged_by' => $this->session->userdata('id'),
                            'permit_apply_remark' => $apply_remark,
                            'permit_op_date' => $shbriefing_date,
                            'permit_subject_identity' => $vehicle_registration_no,
                            'permit_subject_name' => $vehicle_vehiclegroup,
                            'permit_issuance_startdate' => dateserver($permit_issuance_startdate),
                            'permit_issuance_expirydate' => dateserver($permit_issuance_expirydate),
                        ];

                        $this->permit_model->insert($data_permit);
                        $primary_id = $this->db->insert_id();

                        $data_sh = [
                            'shpermit_permit_id' => $primary_id,
                            'shpermit_vehicle_id' => $vehicle_id,
                            'shpermit_required_briefing' => 'y',
                            'shpermit_ownerauthorization' => 'y',
                            'shpermit_ownerauthorization_date' => $nowdatetime,
                            'shpermit_course_date' => dateserver($shbriefing_date), //todo
                            'shpermit_policyno' => $policyno,
                            'shpermit_policyexpirydate' => dateserver($policyexpirydate),
                            'shpermit_created_at' => $nowdatetime,
                            'shpermit_lastchanged_by' => $this->session->userdata('id'),
                            'shpermit_entrypurpose' => $entrypurpose,
                            'shpermit_entrypost' => $entrypost,
                            'shpermit_exitpost' => $exitpost,
                            'shpermit_location' => $shbriefing_location,
/*                            'shpermit_steerman_name' => $steerman_name,
'shpermit_steerman_icno' => $steerman_icno,
'shpermit_steerman_adpno' => dateserver($steerman_adpno),
'shpermit_needescort' => $escortservice,*/
                        ];

                        $this->shpermit_model->insert($data_sh);

                        $data_vehicle = [
                            'vehicle_permit_typeid' => '11',
                            'vehicle_insurance_policy_no' => $policyno,
                            'vehicle_insurance_expiry_date' => dateserver($policyexpirydate),
                            'vehicle_application_date' => date('Y-m-d'),
                            'vehicle_activity_statusid' => '5',
                            'vehicle_updated_at' => $nowdatetime,
                            'vehicle_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->vehicle_model->update($vehicle_id, $data_vehicle);
/*                        $shbriefingmanagement = $this->shbriefingmanagement_model->get_by_date($shbriefing_date);

$slottaken                 = (int) $shbriefingmanagement->shbriefingmanagement_slottaken + 1;
$data_shbriefingmanagement = [
'shbriefingmanagement_slottaken' => $slottaken,
];

$this->shbriefingmanagement_model->update($shbriefingmanagement->shbriefingmanagement_id, $data_shbriefingmanagement);*/

                        foreach ($all_doc as $doc) {
                            $this->uploadfiles_model->update($doc, ['uploadfiles_permit_id' => $primary_id]);

                        }

                        $data_timeline = [
                            'permit_timeline_permitid' => $primary_id,
                            'permit_timeline_userid' => $this->session->userdata('id'),
                            'permit_timeline_name' => PIC_SUBMIT_SH,
                            'permit_timeline_desc' => SH_ADMIN_CHECK_DOCS_SH,
                            'permit_timeline_status' => 'mtwreviewpending',
                            'permit_timeline_officialstatus' => 'pending',
                            'permit_timeline_created_at' => $nowdatetime,
                            'permit_timeline_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->permittimeline_model->insert($data_timeline);

                    }
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {

                        $data_pic = [
                            'bookingId' => $bookingId,
                        ];

                        $this->emailcontent->shoot_email('SH', 'pic', $data_pic);

                        $data_admin = [
                            'bookingId' => $bookingId,
                            'vehicle_registration_no' => $vehicle_registration_no,
                        ];

                        $email = $this->admin_list('Admin Licensing', 'email');

                        $this->emailcontent->shoot_email('SH', 'admin', $data_admin, $email);

                        $this->content = 'permit/sh_success';
                    }

                } elseif ($permittype == "vdgs") {

                    $permittype           = $this->input->post('permittype', true);
                    $verify_status        = $this->input->post('verify_status', true);
                    $driver_id            = $this->input->post('driver_id', true);
                    $driver_name          = $this->input->post('driver_name', true);
                    $driver_ic            = $this->input->post('driver_ic', true);
                    $vdgsbriefing_date    = $this->input->post('vdgsbriefing_date', true);
                    $vdgsbriefing_session = $this->input->post('vdgsbriefing_session', true);
                    $vdgs_requireddoc     = $this->input->post('vdgs_requireddoc', true);
                    $driver_photo         = $this->input->post('driver_photo', true);
                    $all_doc              = explode(",", $vdgs_requireddoc);
                    $location             = $this->input->post('location', true);

                    $bookingId = sprintf('%08d', rand(1000, 10000000));
                    $this->db->trans_start();

                    if ($vdgsbriefing_date) {
                        $data = [
                            'permit_data' => '',
                            'permission' => $this->permission,
                            'verify_status' => $verify_status,
                            'driver_id' => $driver_id,
                            'driver_name' => $driver_name,
                            'driver_ic' => $driver_ic,
                            'vdgsbriefing_date' => $vdgsbriefing_date,
                            'vdgs_requireddoc' => $vdgs_requireddoc,
                            'vdgs_requireddoc_filename' => $this->uploadfiles_model->get_vdgs_requireddoc($driver_id),
                            'driver_photo' => $driver_photo,
                            'driver_photo_filename' => $this->uploadfiles_model->get_by_id($driver_photo)->uploadfiles_filename,
                            'bookingId' => $bookingId,
                        ];

                        $data_permit = [
                            'permit_groupid' => '3',
                            'permit_typeid' => '6',
                            'permit_condition' => $condition_id,
                            'permit_bookingid' => $bookingId,
                            'permit_picid' => $this->session->userdata('id'),
                            'permit_companyid' => $this->session->userdata('companyid'),
                            'permit_status' => 'docscheckingpending',
                            'permit_officialstatus' => 'pending',
                            /*'permit_timeline' => $nowdatetime . ' - PIC Submit VDGS request<br>',*/
                            'permit_recent_permitid' => $recent_permitid,
                            'permit_enhance_locked' => 'y',
                            'permit_location' => $location,
                            'permit_created_at' => $nowdatetime,
                            'permit_lastchanged_by' => $this->session->userdata('id'),
                            'permit_apply_remark' => $apply_remark,
                            'permit_op_date' => $vdgsbriefing_date,
                            'permit_subject_identity' => $driver_ic,
                            'permit_subject_name' => $driver_name,
                        ];

                        $this->permit_model->insert($data_permit);
                        $primary_id = $this->db->insert_id();

                        $data_vdgs = [
                            'vdgspermit_permit_id' => $primary_id,
                            'vdgspermit_driver_id' => $driver_id,
                            'vdgspermit_driveracknowledgement' => 'y',
                            'vdgspermit_driveracknowledgement_date' => $nowdatetime,
                            'vdgspermit_certbyemployer' => 'y',
                            'vdgspermit_certbyemployer_date' => $nowdatetime,
                            'vdgspermit_course_date' => $vdgsbriefing_date, //todo
                            'vdgspermit_course_session' => $vdgsbriefing_session,
                            'vdgspermit_course_location' => $location,
                            'vdgspermit_vgdsbriefingscheduled' => 'y',
                            'vdgspermit_vgdsbriefingapproval' => 'y',
                            'vdgspermit_created_at' => $nowdatetime,
                            'vdgspermit_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->vdgspermit_model->insert($data_vdgs);

                        $data_driver = [
                            'driver_permit_typeid' => '6', //vdgs
                            'driver_application_date' => date('Y-m-d'),
                            'driver_activity_statusid' => '5',
                            'driver_updated_at' => $nowdatetime,
                            'driver_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->driver_model->update($driver_id, $data_driver);

                        $ffvdgsbriefingmanagement = $this->ffvdgsbriefingmanagement_model->get_by_date($vdgsbriefing_date);

                        $slottaken                     = (int) $ffvdgsbriefingmanagement->ffvdgs_briefingmanagement_slottaken + 1;
                        $data_ffvdgsbriefingmanagement = [
                            'ffvdgs_briefingmanagement_slottaken' => $slottaken,
                        ];

                        $this->ffvdgsbriefingmanagement_model->update($ffvdgsbriefingmanagement->ffvdgs_briefingmanagement_id, $data_ffvdgsbriefingmanagement);

                        foreach ($all_doc as $doc) {
                            $this->uploadfiles_model->update($doc, ['uploadfiles_permit_id' => $primary_id]);

                        }

                        $data_timeline = [
                            'permit_timeline_permitid' => $primary_id,
                            'permit_timeline_userid' => $this->session->userdata('id'),
                            'permit_timeline_name' => PIC_SUBMIT_VDGS,
                            'permit_timeline_desc' => VDGS_ADMIN_CHECK_DOCS_VDGS,
                            'permit_timeline_status' => 'docscheckingpending',
                            'permit_timeline_officialstatus' => 'pending',
                            'permit_timeline_created_at' => $nowdatetime,
                            'permit_timeline_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->permittimeline_model->insert($data_timeline);

                    }
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {

                        $data_pic = [
                            'bookingId' => $bookingId,
                        ];

                        $this->emailcontent->shoot_email('VDGS', 'pic', $data_pic);

                        $data_admin = [
                            'bookingId' => $bookingId,
                            'driver_name' => $driver_name,
                        ];

                        $email = $this->admin_list('Admin Licensing', 'email');

                        $this->emailcontent->shoot_email('VDGS', 'admin', $data_admin, $email);

                        $this->content = 'permit/vdgs_success';
                    }

                } elseif ($permittype == "gpu") {

                    $permittype          = $this->input->post('permittype', true);
                    $verify_status       = $this->input->post('verify_status', true);
                    $driver_id           = $this->input->post('driver_id', true);
                    $driver_name         = $this->input->post('driver_name', true);
                    $driver_ic           = $this->input->post('driver_ic', true);
                    $gpubriefing_date    = $this->input->post('gpubriefing_date', true);
                    $gpubriefing_session = $this->input->post('gpubriefing_session', true);
                    $gpu_requireddoc     = $this->input->post('gpu_requireddoc', true);
                    $driver_photo        = $this->input->post('driver_photo', true);
                    $all_doc             = explode(",", $gpu_requireddoc);
                    $location            = $this->input->post('location', true);

                    $bookingId = sprintf('%08d', rand(1000, 10000000));
                    $this->db->trans_start();

                    if ($gpubriefing_date) {
                        $data = [
                            'permit_data' => '',
                            'permission' => $this->permission,
                            'verify_status' => $verify_status,
                            'driver_id' => $driver_id,
                            'driver_name' => $driver_name,
                            'driver_ic' => $driver_ic,
                            'gpubriefing_date' => $gpubriefing_date,
                            'gpu_requireddoc' => $gpu_requireddoc,
                            'gpu_requireddoc_filename' => $this->uploadfiles_model->get_gpu_requireddoc($driver_id),
                            'driver_photo' => $driver_photo,
                            'driver_photo_filename' => $this->uploadfiles_model->get_by_id($driver_photo)->uploadfiles_filename,
                            'bookingId' => $bookingId,
                        ];

                        $data_permit = [
                            'permit_groupid' => '3',
                            'permit_typeid' => '8',
                            'permit_condition' => $condition_id,
                            'permit_bookingid' => $bookingId,
                            'permit_picid' => $this->session->userdata('id'),
                            'permit_companyid' => $this->session->userdata('companyid'),
                            'permit_status' => 'docscheckingpending',
                            'permit_officialstatus' => 'pending',
                            /*'permit_timeline' => $nowdatetime . ' - PIC Submit GPU request<br>',*/
                            'permit_recent_permitid' => $recent_permitid,
                            'permit_enhance_locked' => 'y',
                            'permit_location' => $location,
                            'permit_created_at' => $nowdatetime,
                            'permit_lastchanged_by' => $this->session->userdata('id'),
                            'permit_apply_remark' => $apply_remark,
                            'permit_op_date' => $gpubriefing_date,
                            'permit_subject_identity' => $driver_ic,
                            'permit_subject_name' => $driver_name,
                        ];

                        $this->permit_model->insert($data_permit);
                        $primary_id = $this->db->insert_id();

                        $data_gpu = [
                            'gpupermit_permit_id' => $primary_id,
                            'gpupermit_driver_id' => $driver_id,
                            'gpupermit_driveracknowledgement' => 'y',
                            'gpupermit_driveracknowledgement_date' => $nowdatetime,
                            'gpupermit_certbyemployer' => 'y',
                            'gpupermit_certbyemployer_date' => $nowdatetime,
                            'gpupermit_course_date' => $gpubriefing_date, //todo
                            'gpupermit_course_session' => $gpubriefing_session,
                            'gpupermit_course_location' => $location,
                            'gpupermit_gpubriefingscheduled' => 'y',
                            'gpupermit_gpubriefingapproval' => 'y',
                            'gpupermit_created_at' => $nowdatetime,
                            'gpupermit_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->gpupermit_model->insert($data_gpu);

                        $data_driver = [
                            'driver_permit_typeid' => '8', //gpu
                            'driver_application_date' => date('Y-m-d'),
                            'driver_activity_statusid' => '5',
                            'driver_updated_at' => $nowdatetime,
                            'driver_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->driver_model->update($driver_id, $data_driver);

                        $ffgpubriefingmanagement = $this->ffgpubriefingmanagement_model->get_by_date($gpubriefing_date);

                        $slottaken                  = (int) $ffgpubriefingmanagement->ffgpu_briefingmanagement_slottaken + 1;
                        $data_gpubriefingmanagement = [
                            'ffgpu_briefingmanagement_slottaken' => $slottaken,
                        ];

                        $this->ffgpubriefingmanagement_model->update($ffgpubriefingmanagement->ffgpu_briefingmanagement_id, $data_gpubriefingmanagement);

                        foreach ($all_doc as $doc) {
                            $this->uploadfiles_model->update($doc, ['uploadfiles_permit_id' => $primary_id]);

                        }

                        $data_timeline = [
                            'permit_timeline_permitid' => $primary_id,
                            'permit_timeline_userid' => $this->session->userdata('id'),
                            'permit_timeline_name' => PIC_SUBMIT_GPU,
                            'permit_timeline_desc' => GPU_ADMIN_CHECK_DOCS_GPU,
                            'permit_timeline_status' => 'docscheckingpending',
                            'permit_timeline_officialstatus' => 'pending',
                            'permit_timeline_created_at' => $nowdatetime,
                            'permit_timeline_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->permittimeline_model->insert($data_timeline);

                    }
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {

                        $data_pic = [
                            'bookingId' => $bookingId,
                        ];

                        $this->emailcontent->shoot_email('GPU', 'pic', $data_pic);

                        $data_admin = [
                            'bookingId' => $bookingId,
                            'driver_name' => $driver_name,
                        ];

                        $email = $this->admin_list('Admin Licensing', 'email');

                        $this->emailcontent->shoot_email('GPU', 'admin', $data_admin, $email);

                        $this->content = 'permit/gpu_success';
                    }

                } elseif ($permittype == "pca") {

                    $permittype          = $this->input->post('permittype', true);
                    $verify_status       = $this->input->post('verify_status', true);
                    $driver_id           = $this->input->post('driver_id', true);
                    $driver_name         = $this->input->post('driver_name', true);
                    $driver_ic           = $this->input->post('driver_ic', true);
                    $pcabriefing_date    = $this->input->post('pcabriefing_date', true);
                    $pcabriefing_session = $this->input->post('pcabriefing_session', true);
                    $pca_requireddoc     = $this->input->post('pca_requireddoc', true);
                    $driver_photo        = $this->input->post('driver_photo', true);
                    $all_doc             = explode(",", $pca_requireddoc);
                    $location            = $this->input->post('location', true);

                    $bookingId = sprintf('%08d', rand(1000, 10000000));
                    $this->db->trans_start();

                    if ($pcabriefing_date) {
                        $data = [
                            'permit_data' => '',
                            'permission' => $this->permission,
                            'verify_status' => $verify_status,
                            'driver_id' => $driver_id,
                            'driver_name' => $driver_name,
                            'driver_ic' => $driver_ic,
                            'pcabriefing_date' => $pcabriefing_date,
                            'pca_requireddoc' => $pca_requireddoc,
                            'pca_requireddoc_filename' => $this->uploadfiles_model->get_pca_requireddoc($driver_id),
                            'driver_photo' => $driver_photo,
                            'driver_photo_filename' => $this->uploadfiles_model->get_by_id($driver_photo)->uploadfiles_filename,
                            'bookingId' => $bookingId,
                        ];

                        $data_permit = [
                            'permit_groupid' => '3',
                            'permit_typeid' => '7',
                            'permit_condition' => $condition_id,
                            'permit_bookingid' => $bookingId,
                            'permit_picid' => $this->session->userdata('id'),
                            'permit_companyid' => $this->session->userdata('companyid'),
                            'permit_status' => 'docscheckingpending',
                            'permit_officialstatus' => 'pending',
                            /*'permit_timeline' => $nowdatetime . ' - PIC Submit PCA request<br>',*/
                            'permit_recent_permitid' => $recent_permitid,
                            'permit_enhance_locked' => 'y',
                            'permit_location' => $location,
                            'permit_created_at' => $nowdatetime,
                            'permit_lastchanged_by' => $this->session->userdata('id'),
                            'permit_apply_remark' => $apply_remark,
                            'permit_op_date' => $pcabriefing_date,
                            'permit_subject_identity' => $driver_ic,
                            'permit_subject_name' => $driver_name,
                        ];

                        $this->permit_model->insert($data_permit);
                        $primary_id = $this->db->insert_id();

                        $data_pca = [
                            'pcapermit_permit_id' => $primary_id,
                            'pcapermit_driver_id' => $driver_id,
                            'pcapermit_driveracknowledgement' => 'y',
                            'pcapermit_driveracknowledgement_date' => $nowdatetime,
                            'pcapermit_certbyemployer' => 'y',
                            'pcapermit_certbyemployer_date' => $nowdatetime,
                            'pcapermit_course_date' => $pcabriefing_date, //todo
                            'pcapermit_course_session' => $pcabriefing_session,
                            'pcapermit_course_location' => $location,
                            'pcapermit_pcabriefingscheduled' => 'y',
                            'pcapermit_pcabriefingapproval' => 'y',
                            'pcapermit_created_at' => $nowdatetime,
                            'pcapermit_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->pcapermit_model->insert($data_pca);

                        $data_driver = [
                            'driver_permit_typeid' => '7', //pca
                            'driver_application_date' => date('Y-m-d'),
                            'driver_activity_statusid' => '5',
                            'driver_updated_at' => $nowdatetime,
                            'driver_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->driver_model->update($driver_id, $data_driver);

                        $ffpcabriefingmanagement = $this->ffpcabriefingmanagement_model->get_by_date($pcabriefing_date);

                        $slottaken                  = (int) $ffpcabriefingmanagement->ffpca_briefingmanagement_slottaken + 1;
                        $data_pcabriefingmanagement = [
                            'ffpca_briefingmanagement_slottaken' => $slottaken,
                        ];

                        $this->ffpcabriefingmanagement_model->update($ffpcabriefingmanagement->ffpca_briefingmanagement_id, $data_pcabriefingmanagement);

                        foreach ($all_doc as $doc) {
                            $this->uploadfiles_model->update($doc, ['uploadfiles_permit_id' => $primary_id]);

                        }

                        $data_timeline = [
                            'permit_timeline_permitid' => $primary_id,
                            'permit_timeline_userid' => $this->session->userdata('id'),
                            'permit_timeline_name' => PIC_SUBMIT_PCA,
                            'permit_timeline_desc' => PCA_ADMIN_CHECK_DOCS_PCA,
                            'permit_timeline_status' => 'docscheckingpending',
                            'permit_timeline_officialstatus' => 'pending',
                            'permit_timeline_created_at' => $nowdatetime,
                            'permit_timeline_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->permittimeline_model->insert($data_timeline);

                    }
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {

                        $data_pic = [
                            'bookingId' => $bookingId,
                        ];

                        $this->emailcontent->shoot_email('PCA', 'pic', $data_pic);

                        $data_admin = [
                            'bookingId' => $bookingId,
                            'driver_name' => $driver_name,
                        ];

                        $email = $this->admin_list('Admin Licensing', 'email');

                        $this->emailcontent->shoot_email('PCA', 'admin', $data_admin, $email);

                        $this->content = 'permit/pca_success';
                    }

                } elseif ($permittype == "wip") {

                    $permittype              = $this->input->post('permittype', true);
                    $verify_status           = $this->input->post('verify_status', true);
                    $vehicle_id              = $this->input->post('vehicle_id', true);
                    $vehicle_registration_no = $this->input->post('vehicle_registration_no', true);
                    $vehicle_vehiclegroup    = $this->input->post('vehicle_vehiclegroup', true);
                    $vehicle_parkingarea_id  = $this->input->post('vehicle_parkingarea_id', true);
                    $vehicle_engine_capacity = $this->input->post('vehicle_engine_capacity', true);
                    $inspection_date         = $this->input->post('inspection_date', true);
                    $wip_requireddoc         = $this->input->post('wip_requireddoc', true);
                    $wip_insurancedoc        = $this->input->post('wip_insurancedoc', true);
                    /*$all_doc                 = explode(",", $wip_requireddoc);*/
                    $policyno         = $this->input->post('policyno', true);
                    $policyexpirydate = $this->input->post('policyexpirydate', true);

                    $smokecondition             = $this->input->post('smokecondition', true);
                    $fireext_serialno           = $this->input->post('fireext_serialno', true);
                    $fireext_expirydate         = $this->input->post('fireext_expirydate', true);
                    $tyre_manufacturingdate     = $this->input->post('tyre_manufacturingdate', true);
                    $location                   = $this->input->post('location', true);
                    $permit_issuance_startdate  = $this->input->post('permit_issuance_startdate', true);
                    $permit_issuance_expirydate = $this->input->post('permit_issuance_expirydate', true);

                    $entrypurpose   = $this->input->post('entrypurpose', true);
                    $entrypost      = $this->input->post('entrypost', true);
                    $exitpost       = $this->input->post('exitpost', true);
                    $steerman_name  = $this->input->post('steerman_name', true);
                    $steerman_icno  = $this->input->post('steerman_icno', true);
                    $steerman_adpno = $this->input->post('steerman_adpno', true);
                    $escortservice  = $this->input->post('escortservice', true);

                    if (!empty($wip_insurancedoc)) {
                        $all_doc = explode(",", $wip_requireddoc . ',' . $wip_insurancedoc);
                    } else {
                        $all_doc = explode(",", $wip_requireddoc);
                    }

                    $wip_mtwchecked_selected = $this->input->post('wip_mtwchecked_selected', true);

                    $bookingId = sprintf('%08d', rand(1000, 10000000));
                    $this->db->trans_start();

                    if ($inspection_date) {
                        $data = [
                            'permit_data' => '',
                            'permission' => $this->permission,
                            'verify_status' => $verify_status,
                            'vehicle_id' => $vehicle_id,
                            'vehicle_registration_no' => $vehicle_registration_no,
                            'vehicle_parkingarea_id' => $vehicle_parkingarea_id,
                            'vehicle_engine_capacity' => $vehicle_engine_capacity,
                            'inspection_date' => $inspection_date,
                            'wip_requireddoc' => $wip_requireddoc,
                            'wip_requireddoc_filename' => $this->uploadfiles_model->get_wip_requireddoc($vehicle_id),
                            'wip_mtwchecked_selected' => $wip_mtwchecked_selected,
                            'bookingId' => $bookingId,
                        ];

                        $data_permit = [
                            'permit_groupid' => '4',
                            'permit_typeid' => '9',
                            'permit_condition' => $condition_id,
                            'permit_bookingid' => $bookingId,
                            'permit_picid' => $this->session->userdata('id'),
                            'permit_companyid' => $this->session->userdata('companyid'),
                            'permit_status' => 'mtwreviewpending',
                            'permit_officialstatus' => 'pending',
                            /*'permit_timeline' => $nowdatetime . ' - PIC Submit WIP request<br>',*/
                            'permit_recent_permitid' => $recent_permitid,
                            'permit_enhance_locked' => 'y',
                            'permit_location' => $location,
                            'permit_created_at' => $nowdatetime,
                            'permit_lastchanged_by' => $this->session->userdata('id'),
                            'permit_apply_remark' => $apply_remark,
                            'permit_op_date' => $inspection_date,
                            'permit_subject_identity' => $vehicle_registration_no,
                            'permit_subject_name' => $vehicle_vehiclegroup,
                            'permit_issuance_startdate' => dateserver($permit_issuance_startdate),
                            'permit_issuance_expirydate' => dateserver($permit_issuance_expirydate),
                        ];

                        $this->permit_model->insert($data_permit);
                        $primary_id = $this->db->insert_id();

                        $data_wip = [
                            'wippermit_permit_id' => $primary_id,
                            'wippermit_vehicle_id' => $vehicle_id,
                            'wippermit_required_briefing' => 'n',
                            'wippermit_ownchecked_by' => 'y',
                            'wippermit_ownchecked_date' => $nowdatetime,
                            'wippermit_ownverified_by' => 'y',
                            'wippermit_ownverified_date' => $nowdatetime,
                            'wippermit_inspection_date' => dateserver($inspection_date), //todo
                            'wippermit_inspection_location' => $location,
                            'wippermit_inspectionscheduled' => 'y',
                            'wippermit_policyno' => $policyno,
                            'wippermit_policyexpirydate' => dateserver($policyexpirydate),
                            'wippermit_smokecondition' => $smokecondition,
                            'wippermit_fireext_serialno' => $fireext_serialno,
                            'wippermit_fireext_expirydate' => dateserver($fireext_expirydate),
                            'wippermit_tyre_manufacturingdate' => $tyre_manufacturingdate,
                            'wippermit_created_at' => $nowdatetime,
                            'wippermit_lastchanged_by' => $this->session->userdata('id'),
                            'wippermit_entrypurpose' => $entrypurpose,
                            'wippermit_entrypost' => $entrypost,
                            'wippermit_exitpost' => $exitpost,
                            'wippermit_steerman_name' => $steerman_name,
                            'wippermit_steerman_icno' => $steerman_icno,
                            'wippermit_steerman_adpno' => dateserver($steerman_adpno),
                            'wippermit_needescort' => $escortservice,
                        ];

                        $this->wippermit_model->insert($data_wip);

                        $data_vehicle = [
                            'vehicle_permit_typeid' => '9',
                            'vehicle_insurance_policy_no' => $policyno,
                            'vehicle_insurance_expiry_date' => dateserver($policyexpirydate),
                            'vehicle_application_date' => date('Y-m-d'),
                            'vehicle_activity_statusid' => '5',
                            'vehicle_updated_at' => $nowdatetime,
                            'vehicle_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->vehicle_model->update($vehicle_id, $data_vehicle);

                        $tepinspectionmanagement = $this->tepinspectionmanagement_model->get_by_date($inspection_date);

                        $slottaken                    = (int) $tepinspectionmanagement->tepinspectionmanagement_slottaken + 1;
                        $data_tepinspectionmanagement = [
                            'tepinspectionmanagement_slottaken' => $slottaken,
                        ];

                        $this->tepinspectionmanagement_model->update($tepinspectionmanagement->tepinspectionmanagement_id, $data_tepinspectionmanagement);

                        foreach ($all_doc as $doc) {
                            $this->uploadfiles_model->update($doc, ['uploadfiles_permit_id' => $primary_id]);

                        }

/*      checklist                   */
                        $this->mtwchecklist_model->copy_checklist($primary_id, $permittype, $wip_mtwchecked_selected);

                        $data_timeline = [
                            'permit_timeline_permitid' => $primary_id,
                            'permit_timeline_userid' => $this->session->userdata('id'),
                            'permit_timeline_name' => PIC_SUBMIT_WIP,
                            'permit_timeline_desc' => MTW_ADMIN_CHECK_DOCS_WIP,
                            'permit_timeline_status' => 'mtwreviewpending',
                            'permit_timeline_officialstatus' => 'pending',
                            'permit_timeline_created_at' => $nowdatetime,
                            'permit_timeline_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->permittimeline_model->insert($data_timeline);

                    }
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {

                        $data_pic = [
                            'bookingId' => $bookingId,
                        ];

                        $this->emailcontent->shoot_email('WIP', 'pic', $data_pic);

                        $data_admin = [
                            'bookingId' => $bookingId,
                            'vehicle_registration_no' => $vehicle_registration_no,
                        ];

                        $email = $this->admin_list('Admin Licensing', 'email');

                        $this->emailcontent->shoot_email('WIP', 'admin', $data_admin, $email);

                        $this->content = 'permit/wip_success';
                    }

                } elseif ($permittype == "shins") {

                    $permittype              = $this->input->post('permittype', true);
                    $verify_status           = $this->input->post('verify_status', true);
                    $vehicle_id              = $this->input->post('vehicle_id', true);
                    $vehicle_registration_no = $this->input->post('vehicle_registration_no', true);
                    $vehicle_vehiclegroup    = $this->input->post('vehicle_vehiclegroup', true);
                    $vehicle_parkingarea_id  = $this->input->post('vehicle_parkingarea_id', true);
                    $vehicle_engine_capacity = $this->input->post('vehicle_engine_capacity', true);
                    $inspection_date         = $this->input->post('inspection_date', true);
                    $shins_requireddoc       = $this->input->post('shins_requireddoc', true);
                    $shins_insurancedoc      = $this->input->post('shins_insurancedoc', true);
                    /*$all_doc                 = explode(",", $shins_requireddoc);*/
                    $policyno         = $this->input->post('policyno', true);
                    $policyexpirydate = $this->input->post('policyexpirydate', true);

                    $smokecondition             = $this->input->post('smokecondition', true);
                    $fireext_serialno           = $this->input->post('fireext_serialno', true);
                    $fireext_expirydate         = $this->input->post('fireext_expirydate', true);
                    $tyre_manufacturingdate     = $this->input->post('tyre_manufacturingdate', true);
                    $location                   = $this->input->post('location', true);
                    $permit_issuance_startdate  = $this->input->post('permit_issuance_startdate', true);
                    $permit_issuance_expirydate = $this->input->post('permit_issuance_expirydate', true);

                    if (!empty($shins_insurancedoc)) {
                        $all_doc = explode(",", $shins_requireddoc . ',' . $shins_insurancedoc);
                    } else {
                        $all_doc = explode(",", $shins_requireddoc);
                    }

                    $shins_mtwchecked_selected = $this->input->post('shins_mtwchecked_selected', true);

                    $bookingId = sprintf('%08d', rand(1000, 10000000));
                    $this->db->trans_start();

                    if ($inspection_date) {
                        $data = [
                            'permit_data' => '',
                            'permission' => $this->permission,
                            'verify_status' => $verify_status,
                            'vehicle_id' => $vehicle_id,
                            'vehicle_registration_no' => $vehicle_registration_no,
                            'vehicle_parkingarea_id' => $vehicle_parkingarea_id,
                            'vehicle_engine_capacity' => $vehicle_engine_capacity,
                            'inspection_date' => $inspection_date,
                            'shins_requireddoc' => $shins_requireddoc,
                            'shins_requireddoc_filename' => $this->uploadfiles_model->get_shins_requireddoc($vehicle_id),
                            'shins_mtwchecked_selected' => $shins_mtwchecked_selected,
                            'bookingId' => $bookingId,
                        ];

                        $data_permit = [
                            'permit_groupid' => '4',
                            'permit_typeid' => '13',
                            'permit_condition' => $condition_id,
                            'permit_bookingid' => $bookingId,
                            'permit_picid' => $this->session->userdata('id'),
                            'permit_companyid' => $this->session->userdata('companyid'),
                            'permit_status' => 'mtwreviewpending',
                            'permit_officialstatus' => 'pending',
                            /*'permit_timeline' => $nowdatetime . ' - PIC Submit SHINS request<br>',*/
                            'permit_recent_permitid' => $recent_permitid,
                            'permit_enhance_locked' => 'y',
                            'permit_location' => $location,
                            'permit_created_at' => $nowdatetime,
                            'permit_lastchanged_by' => $this->session->userdata('id'),
                            'permit_apply_remark' => $apply_remark,
                            'permit_op_date' => $inspection_date,
                            'permit_subject_identity' => $vehicle_registration_no,
                            'permit_subject_name' => $vehicle_vehiclegroup,
                            'permit_issuance_startdate' => $permit_issuance_startdate,
                            'permit_issuance_expirydate' => $permit_issuance_expirydate,
                        ];

                        $this->permit_model->insert($data_permit);
                        $primary_id = $this->db->insert_id();

                        $data_shins = [
                            'shinspermit_permit_id' => $primary_id,
                            'shinspermit_vehicle_id' => $vehicle_id,
                            'shinspermit_required_briefing' => 'n',
                            'shinspermit_ownchecked_by' => 'y',
                            'shinspermit_ownchecked_date' => $nowdatetime,
                            'shinspermit_ownverified_by' => 'y',
                            'shinspermit_ownverified_date' => $nowdatetime,
                            'shinspermit_inspection_date' => $inspection_date, //todo
                            'shinspermit_inspection_location' => $location,
                            'shinspermit_inspectionscheduled' => 'y',
                            'shinspermit_policyno' => $policyno,
                            'shinspermit_policyexpirydate' => $policyexpirydate,
                            'shinspermit_smokecondition' => $smokecondition,
                            'shinspermit_fireext_serialno' => $fireext_serialno,
                            'shinspermit_fireext_expirydate' => $fireext_expirydate,
                            'shinspermit_tyre_manufacturingdate' => $tyre_manufacturingdate,
                            'shinspermit_created_at' => $nowdatetime,
                            'shinspermit_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->shinspermit_model->insert($data_shins);

                        $data_vehicle = [
                            'vehicle_permit_typeid' => '13',
                            'vehicle_insurance_policy_no' => $policyno,
                            'vehicle_insurance_expiry_date' => $policyexpirydate,
                            'vehicle_application_date' => date('Y-m-d'),
                            'vehicle_activity_statusid' => '5',
                            'vehicle_updated_at' => $nowdatetime,
                            'vehicle_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->vehicle_model->update($vehicle_id, $data_vehicle);

                        $tepstakeholdermanagement = $this->tepstakeholdermanagement_model->get_by_date($inspection_date);

                        $slottaken                     = (int) $tepstakeholdermanagement->tepstakeholdermanagement_slottaken + 1;
                        $data_tepstakeholdermanagement = [
                            'tepstakeholdermanagement_slottaken' => $slottaken,
                        ];

                        $this->tepstakeholdermanagement_model->update($tepstakeholdermanagement->tepstakeholdermanagement_id, $data_tepstakeholdermanagement);

                        foreach ($all_doc as $doc) {
                            $this->uploadfiles_model->update($doc, ['uploadfiles_permit_id' => $primary_id]);

                        }

/*      checklist                   */
                        $this->mtwchecklist_model->copy_checklist($primary_id, $permittype, $shins_mtwchecked_selected);

                        $data_timeline = [
                            'permit_timeline_permitid' => $primary_id,
                            'permit_timeline_userid' => $this->session->userdata('id'),
                            'permit_timeline_name' => PIC_SUBMIT_SHINS,
                            'permit_timeline_desc' => MTW_ADMIN_CHECK_DOCS_SHINS,
                            'permit_timeline_status' => 'mtwreviewpending',
                            'permit_timeline_officialstatus' => 'pending',
                            'permit_timeline_created_at' => $nowdatetime,
                            'permit_timeline_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->permittimeline_model->insert($data_timeline);

                    }
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {

                        $data_pic = [
                            'bookingId' => $bookingId,
                        ];

                        $this->emailcontent->shoot_email('SHINS', 'pic', $data_pic);

                        $data_admin = [
                            'bookingId' => $bookingId,
                            'vehicle_registration_no' => $vehicle_registration_no,
                        ];

                        $email = $this->admin_list('Admin Licensing', 'email');

                        $this->emailcontent->shoot_email('SHINS', 'admin', $data_admin, $email);

                        $this->content = 'permit/shins_success';
                    }

                } elseif ($permittype == "wipbriefing") {

                    $permittype                 = $this->input->post('permittype', true);
                    $verify_status              = $this->input->post('verify_status', true);
                    $vehicle_id                 = $this->input->post('vehicle_id', true);
                    $vehicle_registration_no    = $this->input->post('vehicle_registration_no', true);
                    $vehicle_vehiclegroup       = $this->input->post('vehicle_vehiclegroup', true);
                    $vehicle_parkingarea_id     = $this->input->post('vehicle_parkingarea_id', true);
                    $vehicle_engine_capacity    = $this->input->post('vehicle_engine_capacity', true);
                    $wipbriefing_date           = $this->input->post('wipbriefing_date', true);
                    $wipbriefing_location       = $this->input->post('wipbriefing_location', true);
                    $wipbriefing_requireddoc    = $this->input->post('wipbriefing_requireddoc', true);
                    $wipbriefing_insurancedoc   = $this->input->post('wipbriefing_insurancedoc', true);
                    $policyno                   = $this->input->post('policyno', true);
                    $policyexpirydate           = $this->input->post('policyexpirydate', true);
                    $location                   = $this->input->post('location', true);
                    $permit_issuance_startdate  = $this->input->post('permit_issuance_startdate', true);
                    $permit_issuance_expirydate = $this->input->post('permit_issuance_expirydate', true);

                    $entrypurpose   = $this->input->post('entrypurpose', true);
                    $entrypost      = $this->input->post('entrypost', true);
                    $exitpost       = $this->input->post('exitpost', true);
                    $steerman_name  = $this->input->post('steerman_name', true);
                    $steerman_icno  = $this->input->post('steerman_icno', true);
                    $steerman_adpno = $this->input->post('steerman_adpno', true);
                    $escortservice  = $this->input->post('escortservice', true);

                    if (!empty($wipbriefing_insurancedoc)) {
                        $all_doc = explode(",", $wipbriefing_requireddoc . ',' . $wipbriefing_insurancedoc);
                    } else {
                        $all_doc = explode(",", $wipbriefing_requireddoc);
                    }

                    $bookingId = sprintf('%08d', rand(1000, 10000000));
                    $this->db->trans_start();

                    if ($wipbriefing_date) {
                        $data = [
                            'permit_data' => '',
                            'permission' => $this->permission,
                            'verify_status' => $verify_status,
                            'vehicle_id' => $vehicle_id,
                            'vehicle_registration_no' => $vehicle_registration_no,
                            'vehicle_parkingarea_id' => $vehicle_parkingarea_id,
                            'vehicle_engine_capacity' => $vehicle_engine_capacity,
                            'wipbriefing_date' => $wipbriefing_date,
                            'wipbriefing_location' => $wipbriefing_location,
                            'wipbriefing_requireddoc' => $wipbriefing_requireddoc,
                            'wipbriefing_requireddoc_filename' => $this->uploadfiles_model->get_wipbriefing_requireddoc($vehicle_id),
                            'bookingId' => $bookingId,
                        ];

                        $data_permit = [
                            'permit_groupid' => '4',
                            'permit_typeid' => '12',
                            'permit_condition' => $condition_id,
                            'permit_bookingid' => $bookingId,
                            'permit_picid' => $this->session->userdata('id'),
                            'permit_companyid' => $this->session->userdata('companyid'),
                            'permit_status' => 'mtwreviewpending', // original 'docscheckingpending'
                            'permit_officialstatus' => 'pending',
                            /*'permit_timeline' => $nowdatetime . ' - PIC Submit SH request<br>',*/
                            'permit_recent_permitid' => $recent_permitid,
                            'permit_enhance_locked' => 'y',
                            'permit_location' => $location,
                            'permit_created_at' => $nowdatetime,
                            'permit_lastchanged_by' => $this->session->userdata('id'),
                            'permit_apply_remark' => $apply_remark,
                            'permit_op_date' => $wipbriefing_date,
                            'permit_subject_identity' => $vehicle_registration_no,
                            'permit_subject_name' => $vehicle_vehiclegroup,
                            'permit_issuance_startdate' => dateserver($permit_issuance_startdate),
                            'permit_issuance_expirydate' => dateserver($permit_issuance_expirydate),
                        ];

                        $this->permit_model->insert($data_permit);
                        $primary_id = $this->db->insert_id();

                        $data_wipbriefing = [
                            'wipbriefingpermit_permit_id' => $primary_id,
                            'wipbriefingpermit_vehicle_id' => $vehicle_id,
                            'wipbriefingpermit_required_briefing' => 'y',
                            'wipbriefingpermit_ownerauthorization' => 'y',
                            'wipbriefingpermit_ownerauthorization_date' => $nowdatetime,
                            'wipbriefingpermit_course_date' => dateserver($wipbriefing_date), //todo
                            'wipbriefingpermit_course_location' => $location,
                            'wipbriefingpermit_policyno' => $policyno,
                            'wipbriefingpermit_policyexpirydate' => dateserver($policyexpirydate),
                            'wipbriefingpermit_created_at' => $nowdatetime,
                            'wipbriefingpermit_lastchanged_by' => $this->session->userdata('id'),
                            'wipbriefingpermit_entrypurpose' => $entrypurpose,
                            'wipbriefingpermit_entrypost' => $entrypost,
                            'wipbriefingpermit_exitpost' => $exitpost,
                            'wipbriefingpermit_steerman_name' => $steerman_name,
                            'wipbriefingpermit_steerman_icno' => $steerman_icno,
                            'wipbriefingpermit_steerman_adpno' => dateserver($steerman_adpno),
                            'wipbriefingpermit_needescort' => $escortservice,
                            'wipbriefingpermit_location' => $wipbriefing_location,
                        ];

                        $this->wipbriefingpermit_model->insert($data_wipbriefing);

                        $data_vehicle = [
                            'vehicle_permit_typeid' => '12',
                            'vehicle_insurance_policy_no' => $policyno,
                            'vehicle_insurance_expiry_date' => dateserver($policyexpirydate),
                            'vehicle_application_date' => date('Y-m-d'),
                            'vehicle_activity_statusid' => '5',
                            'vehicle_updated_at' => $nowdatetime,
                            'vehicle_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->vehicle_model->update($vehicle_id, $data_vehicle);

                        $tepbriefingmanagement = $this->tepbriefingmanagement_model->get_by_date($wipbriefing_date);

                        $slottaken                  = (int) $tepbriefingmanagement->tepbriefingmanagement_slottaken + 1;
                        $data_tepbriefingmanagement = [
                            'tepbriefingmanagement_slottaken' => $slottaken,
                        ];

                        $this->tepbriefingmanagement_model->update($tepbriefingmanagement->tepbriefingmanagement_id, $data_tepbriefingmanagement);

                        foreach ($all_doc as $doc) {
                            $this->uploadfiles_model->update($doc, ['uploadfiles_permit_id' => $primary_id]);

                        }

                        $data_timeline = [
                            'permit_timeline_permitid' => $primary_id,
                            'permit_timeline_userid' => $this->session->userdata('id'),
                            'permit_timeline_name' => PIC_SUBMIT_SH,
                            'permit_timeline_desc' => SH_ADMIN_CHECK_DOCS_SH,
                            'permit_timeline_status' => 'mtwreviewpending',
                            'permit_timeline_officialstatus' => 'pending',
                            'permit_timeline_created_at' => $nowdatetime,
                            'permit_timeline_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->permittimeline_model->insert($data_timeline);

                    }
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {

                        $data_pic = [
                            'bookingId' => $bookingId,
                        ];

                        $this->emailcontent->shoot_email('WIPBRIEFING', 'pic', $data_pic);

                        $data_admin = [
                            'bookingId' => $bookingId,
                            'vehicle_registration_no' => $vehicle_registration_no,
                        ];

                        $email = $this->admin_list('Admin Licensing', 'email');

                        $this->emailcontent->shoot_email('WIPBRIEFING', 'admin', $data_admin, $email);

                        $this->content = 'permit/wipbriefing_success';
                    }

                } else {
                    $this->session->set_flashdata('message', 'Please select permit to continue');
                    redirect('/');
                }

/*                $this->email->from('CARE@malaysiaairports.com.my', 'DIASS Administrator');
$this->email->to($this->session->userdata('email'));
$this->email->subject($subject_topic);
$this->email->message($body_topic);
$this->email->send();*/

                $this->layout($data, $setting);

            }

        } else {
            redirect('/');
        }
    }

    public function _exambriefingrules()
    {
        $this->form_validation->set_rules('examtaker_date', ' ', 'trim|required');
/*        $this->form_validation->set_rules('country', ' ', 'trim|required|integer');
$this->form_validation->set_rules('licenseno', ' ', 'trim|required');
$this->form_validation->set_rules('drivingclass', ' ', 'trim|required');
$this->form_validation->set_rules('expirydate', ' ', 'trim|required');*/
        $this->form_validation->set_rules('driver_photo', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('adp_requireddoc', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</div>');

    }

    public function _terminalbriefingrules()
    {
        $this->form_validation->set_rules('terminalbriefing_date', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_photo', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('evdp_requireddoc', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</div>');

    }

    public function _pbbbriefingrules()
    {
        $this->form_validation->set_rules('pbbbriefing_date', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_photo', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('pbb_requireddoc', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</div>');

    }

    public function _shbriefingrules()
    {
        $this->form_validation->set_rules('shbriefing_date', ' ', 'trim|required');
        $this->form_validation->set_rules('sh_requireddoc', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</div>');

    }

    public function _vdgsbriefingrules()
    {
        $this->form_validation->set_rules('vdgsbriefing_date', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_photo', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('vdgs_requireddoc', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</div>');

    }

    public function _csbriefingrules()
    {
        $this->form_validation->set_rules('csbriefing_date', ' ', 'trim|required');
        $this->form_validation->set_rules('cs_requireddoc', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</div>');

    }

    public function _gpubriefingrules()
    {
        $this->form_validation->set_rules('gpubriefing_date', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_photo', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('gpu_requireddoc', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</div>');

    }

    public function _pcabriefingrules()
    {
        $this->form_validation->set_rules('pcabriefing_date', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_photo', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('pca_requireddoc', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</div>');

    }

    public function _wipbriefingrules()
    {
        $this->form_validation->set_rules('wipbriefing_date', ' ', 'trim|required');
        $this->form_validation->set_rules('wipbriefing_requireddoc', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</div>');

    }

    public function _submitrules()
    {
        $this->form_validation->set_rules('clarify', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</div>');

    }

    public function admin_list($groupname, $getdata)
    {
        $adminlist = $this->user_model->get_admin($groupname);

        if ($getdata == 'email') {
            foreach ($adminlist as $admin) {
                $data[] = $admin->user_email;
            }

            return $data;
        }
    }

    public function verify($type, $permittype, $subjectid)
    {
        if ($type == 'driver') {
            $data = $this->permit_model->get_verifydriver($permittype, $subjectid);
        } elseif ($type == 'vehicle') {
            $data = $this->permit_model->get_verifyvehicle($permittype, $subjectid);
        }

        echo $data;
        //print_r($data) ;
    }
}
;
/* End of file Permit.php */
/* Location: ./application/controllers/Permit.php */
