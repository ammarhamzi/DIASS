<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permitcollect extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('permitcollect_model');
        $this->load->model('adppermit_model');
        $this->load->model('evdppermit_model');
        $this->load->model('driver_model');
        $this->load->model('permittimelinedom_model');
        $this->load->model('uploadfiles_model');
        $this->load->model('exambank_model');
        $this->load->model('examtaker_model');
        $this->load->model('examresult_model');
        $this->load->model('avppermit_model');
        $this->load->model('vehicle_model');
        $this->load->model('avpchecklist_model');
        $this->load->model('evppermit_model');
        $this->load->model('evpchecklist_model');
        $this->lang->load('permitcollect_lang', $this->session->userdata('language'));
        $this->lang->load('adppermit_lang', $this->session->userdata('language'));
        $this->lang->load('evdppermit_lang', $this->session->userdata('language'));
        $this->lang->load('driver_lang', $this->session->userdata('language'));
        $this->lang->load('permittimeline_lang', $this->session->userdata('language'));
        $this->lang->load('uploadfiles_lang', $this->session->userdata('language'));
        $this->lang->load('vehicle_lang', $this->session->userdata('language'));
        $this->lang->load('avpchecklist_lang', $this->session->userdata('language'));

        $this->load->model('pbbpermit_model');
        $this->lang->load('pbbpermit_lang', $this->session->userdata('language'));
        $this->load->model('shpermit_model');
        $this->lang->load('shpermit_lang', $this->session->userdata('language'));
        $this->load->model('vdgspermit_model');
        $this->lang->load('vdgspermit_lang', $this->session->userdata('language'));
        $this->load->model('cspermit_model');
        $this->lang->load('cspermit_lang', $this->session->userdata('language'));
        $this->load->model('gpupermit_model');
        $this->lang->load('gpupermit_lang', $this->session->userdata('language'));
        $this->load->model('pcapermit_model');
        $this->lang->load('pcapermit_lang', $this->session->userdata('language'));
        $this->load->model('wippermit_model');
        $this->load->model('wipchecklist_model');
        $this->lang->load('wipchecklist_lang', $this->session->userdata('language'));
        $this->load->model('shinspermit_model');
        $this->load->model('shinschecklist_model');
        $this->lang->load('shinschecklist_lang', $this->session->userdata('language'));
        $this->load->model('wipbriefingpermit_model');
        $this->lang->load('wipbriefingpermit_lang', $this->session->userdata('language'));
    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];

            $data = [
                'permission' => $this->permission,
                'controller' => 'Permitcollect',
                'pagetitle' => 'Uncollected Permits',
            ];

            $this->content = 'permitall/permitall_list_complete';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function adp($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->adp_detail($id);
        $this->infopage = 'permitall/permitall_adp';
        $this->content  = 'permitcollect/permitcollect_adp_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function evdp($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->evdp_detail($id);
        $this->infopage = 'permitall/permitall_evdp';
        $this->content  = 'permitcollect/permitcollect_evdp_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function avp($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->avp_detail($id);
        $this->infopage = 'permitall/permitall_avp';
        $this->content  = 'permitcollect/permitcollect_avp_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function evp($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->evp_detail($id);
        $this->infopage = 'permitall/permitall_evp';
        $this->content  = 'permitcollect/permitcollect_evp_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function adp_submit()
    {

        $permitid    = fixzy_decoder($this->input->post('permit_id', true));
        $nowdatetime = date('Y-m-d H:i:s');
        $userid      = $this->session->userdata('id');
        $driver_id   = $this->input->post('driver_id', true);

        $data_permit = [
            'permit_status' => 'completed',
            'permit_officialstatus' => 'completed',
            'permit_remark' => $this->input->post('remark', true),
            'permit_updated_at' => $nowdatetime,
            'permit_lastchanged_by' => $userid,
        ];

        $data_timeline = [
            'permit_timeline_permitid' => $permitid,
            'permit_timeline_userid' => $userid,
            'permit_timeline_name' => PERMIT_PRINTOUT_ADP,
            'permit_timeline_desc' => PERMIT_PRINTOUT_ADP_DESC,
            'permit_timeline_status' => 'completed',
            'permit_timeline_officialstatus' => 'completed',
            'permit_timeline_created_at' => $nowdatetime,
            'permit_timeline_lastchanged_by' => $userid,
        ];

        $data_driver = [
            'driver_activity_statusid' => '6',
            'driver_updated_at' => $nowdatetime,
            'driver_lastchanged_by' => $this->session->userdata('id'),
        ];

        $this->db->trans_start();
        $this->permitcollect_model->update($permitid, $data_permit);
        $this->permittimelinedom_model->insert($data_timeline);
        $this->driver_model->update($driver_id, $data_driver);

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            // generate an error... or use the log_message() function to log your error
            echo 'error';
        } else {
            //$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitprintout/adp/' . $this->input->post('permit_id', true)));
        }

    }

    public function evdp_submit()
    {

        $permitid    = fixzy_decoder($this->input->post('permit_id', true));
        $nowdatetime = date('Y-m-d H:i:s');
        $userid      = $this->session->userdata('id');
        $driver_id   = $this->input->post('driver_id', true);

        $data_permit = [
            'permit_status' => 'completed',
            'permit_officialstatus' => 'completed',
            'permit_remark' => $this->input->post('remark', true),
            'permit_updated_at' => $nowdatetime,
            'permit_lastchanged_by' => $userid,
        ];

        $data_timeline = [
            'permit_timeline_permitid' => $permitid,
            'permit_timeline_userid' => $userid,
            'permit_timeline_name' => PERMIT_PRINTOUT_EVDP,
            'permit_timeline_desc' => PERMIT_PRINTOUT_EVDP_DESC,
            'permit_timeline_status' => 'completed',
            'permit_timeline_officialstatus' => 'completed',
            'permit_timeline_created_at' => $nowdatetime,
            'permit_timeline_lastchanged_by' => $userid,
        ];

        $data_driver = [
            'driver_activity_statusid' => '6',
            'driver_updated_at' => $nowdatetime,
            'driver_lastchanged_by' => $this->session->userdata('id'),
        ];

        $this->db->trans_start();
        $this->permitcollect_model->update($permitid, $data_permit);
        $this->permittimelinedom_model->insert($data_timeline);
        $this->driver_model->update($driver_id, $data_driver);

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            // generate an error... or use the log_message() function to log your error
            echo 'error';
        } else {
            //$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitprintout/evdp/' . $this->input->post('permit_id', true)));
        }

    }

    public function avp_submit()
    {

        $permitid    = fixzy_decoder($this->input->post('permit_id', true));
        $nowdatetime = date('Y-m-d H:i:s');
        $userid      = $this->session->userdata('id');
        $vehicle_id  = $this->input->post('vehicle_id', true);

        $data_permit = [
            'permit_status' => 'completed',
            'permit_officialstatus' => 'completed',
            'permit_remark' => $this->input->post('remark', true),
            'permit_updated_at' => $nowdatetime,
            'permit_lastchanged_by' => $userid,
        ];

        $data_timeline = [
            'permit_timeline_permitid' => $permitid,
            'permit_timeline_userid' => $userid,
            'permit_timeline_name' => PERMIT_PRINTOUT_AVP,
            'permit_timeline_desc' => PERMIT_PRINTOUT_AVP_DESC,
            'permit_timeline_status' => 'completed',
            'permit_timeline_officialstatus' => 'completed',
            'permit_timeline_created_at' => $nowdatetime,
            'permit_timeline_lastchanged_by' => $userid,
        ];

        $data_vehicle = [
            'vehicle_activity_statusid' => '6',
            'vehicle_updated_at' => $nowdatetime,
            'vehicle_lastchanged_by' => $this->session->userdata('id'),
        ];

        $this->db->trans_start();
        $this->permitcollect_model->update($permitid, $data_permit);
        $this->permittimelinedom_model->insert($data_timeline);
        $this->vehicle_model->update($vehicle_id, $data_vehicle);

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            // generate an error... or use the log_message() function to log your error
            echo 'error';
        } else {
            //$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitprintout/avp/' . $this->input->post('permit_id', true)));
        }

    }

    public function evp_submit()
    {

        $permitid    = fixzy_decoder($this->input->post('permit_id', true));
        $nowdatetime = date('Y-m-d H:i:s');
        $userid      = $this->session->userdata('id');
        $vehicle_id  = $this->input->post('vehicle_id', true);

        $data_permit = [
            'permit_status' => 'completed',
            'permit_officialstatus' => 'completed',
            'permit_remark' => $this->input->post('remark', true),
            'permit_updated_at' => $nowdatetime,
            'permit_lastchanged_by' => $userid,
        ];

        $data_timeline = [
            'permit_timeline_permitid' => $permitid,
            'permit_timeline_userid' => $userid,
            'permit_timeline_name' => PERMIT_PRINTOUT_EVP,
            'permit_timeline_desc' => PERMIT_PRINTOUT_EVP_DESC,
            'permit_timeline_status' => 'completed',
            'permit_timeline_officialstatus' => 'completed',
            'permit_timeline_created_at' => $nowdatetime,
            'permit_timeline_lastchanged_by' => $userid,
        ];

        $data_vehicle = [
            'vehicle_activity_statusid' => '6',
            'vehicle_updated_at' => $nowdatetime,
            'vehicle_lastchanged_by' => $this->session->userdata('id'),
        ];

        $this->db->trans_start();
        $this->permitcollect_model->update($permitid, $data_permit);
        $this->permittimelinedom_model->insert($data_timeline);
        $this->vehicle_model->update($vehicle_id, $data_vehicle);

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            // generate an error... or use the log_message() function to log your error
            echo 'error';
        } else {
            //$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitprintout/evp/' . $this->input->post('permit_id', true)));
        }

    }

    public function get_json($location='all')
    {

        $i       = $this->input->get('start');
        $columns = [
            'permit_id',
            'permit_groupid',
            'permit_typeid',
            'permit_condition',
            'permit_bookingid',
            'permit_picid',
            'permit_companyid',
            'permit_issuance_serialno',
            'permit_issuance_date',
            'permit_issuance_startdate',
            'permit_issuance_expirydate',
            'permit_issuance_processedby',
            'permit_payment_invoiceno',
            'permit_payment_trainingfee',
            'permit_payment_new',
            'permit_payment_renew_oneyear',
            'permit_payment_renew_prorated',
            'permit_payment_sst',
            'permit_payment_total',
            'permit_payment_processedby',
            'permit_status',
            'permit_officialstatus',
            'permit_remark',
            'permit_recent_permitid',
            'permit_created_at',

        ];

                $columnfilter = [
                    'company' => $this->input->get('columns')[0]['search']['value'],
                    'bookingid' => $this->input->get('columns')[1]['search']['value'],
                    'serialno' => $this->input->get('columns')[2]['search']['value'],
                    'identity' => $this->input->get('columns')[3]['search']['value'],
                    'permittype' => $this->input->get('columns')[4]['search']['value'],
                    'status' => $this->input->get('columns')[5]['search']['value'],
                    'appdate' => $this->input->get('columns')[6]['search']['value'],
                    'exdate' => $this->input->get('columns')[7]['search']['value'],
                    'condition' => $this->input->get('columns')[9]['search']['value'],
                ];

        $results = $this->permitcollect_model->listajax(
        $location,
            $columns,
            $columnfilter,
            $this->input->get('start'),
            $this->input->get('length'),
            $this->input->get('search')['value'],
            $columns[$this->input->get('order')[0]['column']],
            $this->input->get('order')[0]['dir']
        );
        $data = [];
        foreach ($results as $r) {
            $i++;
            $rud = "";

            if ($this->permission->cp_read == true) {

                if ($r['permit_officialstatus_name_permit_officialstatus'] == "completed") {
                    $rud .= anchor(site_url('permitcollect/termination/' . fixzy_encoder($r['permit_id'])), 'Terminate', 'class="btn btn-primary btn-xs"') . ' ' . anchor(site_url('permitcollect/replacement/' . fixzy_encoder($r['permit_id'])), 'Replace', 'class="btn btn-primary btn-xs"') . ' ' . anchor(site_url('permitcollect/' . strtolower($r['permit_type_name_permit_typeid']) . '/' . fixzy_encoder($r['permit_id'])), 'Renew', 'class="btn btn-primary btn-xs"') .
                        ' ';
                } else {
                    if ($r['permit_officialstatus_name_permit_officialstatus'] != "canceled" && $r['permit_officialstatus_name_permit_officialstatus'] != "paid" && $r['permit_status'] != "permitterminationpending" && $r['permit_status'] != "permitreplacementpending") {
                        $rud .= anchor(site_url('permitcollect/cancellation/' . fixzy_encoder($r['permit_id'])), 'Cancel', 'class="btn btn-primary btn-xs"') .
                            ' ';
                    }

                }

                $rud .= anchor(site_url('permitcollect/' . strtolower($r['permit_type_name_permit_typeid']) . '/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                ' ' . anchor_popup(site_url('permitprintout/' . strtolower($r['permit_type_name_permit_typeid']) . '/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($r['permit_type_name_permit_typeid'] == "ADP") {
                $driver_id = $this->adppermit_model->get_read_by_permitid($r['permit_id'])->adppermit_driver_id;
                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
            } elseif ($r['permit_type_name_permit_typeid'] == "EVDP") {
                $driver_id = $this->evdppermit_model->get_read_by_permitid($r['permit_id'])->evdppermit_driver_id;
                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
            } elseif ($r['permit_type_name_permit_typeid'] == "AVP") {
                /*$val = 'NA';*/
                $vehicle_id = $this->avppermit_model->get_read_by_permitid($r['permit_id'])->avppermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            } elseif ($r['permit_type_name_permit_typeid'] == "EVP") {
                /*$val = 'NA';*/
                $vehicle_id = $this->evppermit_model->get_read_by_permitid($r['permit_id'])->evppermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            } elseif ($r['permit_type_name_permit_typeid'] == "PBB") {
                $driver_id = $this->pbbpermit_model->get_read_by_permitid($r['permit_id'])->pbbpermit_driver_id;
                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
            } elseif ($r['permit_type_name_permit_typeid'] == "SH") {
                $vehicle_id = $this->shpermit_model->get_read_by_permitid($r['permit_id'])->shpermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            } elseif ($r['permit_type_name_permit_typeid'] == "VDGS") {
                $driver_id = $this->vdgspermit_model->get_read_by_permitid($r['permit_id'])->vdgspermit_driver_id;
                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
            } elseif ($r['permit_type_name_permit_typeid'] == "CS") {
                $vehicle_id = $this->cspermit_model->get_read_by_permitid($r['permit_id'])->cspermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            } elseif ($r['permit_type_name_permit_typeid'] == "GPU") {
                $driver_id = $this->gpupermit_model->get_read_by_permitid($r['permit_id'])->gpupermit_driver_id;
                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
            } elseif ($r['permit_type_name_permit_typeid'] == "PCA") {
                $driver_id = $this->pcapermit_model->get_read_by_permitid($r['permit_id'])->pcapermit_driver_id;
                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
            } elseif ($r['permit_type_name_permit_typeid'] == "WIP") {
                /*$val = 'NA';*/
                $vehicle_id = $this->wippermit_model->get_read_by_permitid($r['permit_id'])->wippermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            } elseif ($r['permit_type_name_permit_typeid'] == "SHINS") {
                /*$val = 'NA';*/
                $vehicle_id = $this->shinspermit_model->get_read_by_permitid($r['permit_id'])->shinspermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            } elseif ($r['permit_type_name_permit_typeid'] == "WIPBRIEFING") {
                $vehicle_id = $this->wipbriefingpermit_model->get_read_by_permitid($r['permit_id'])->wipbriefingpermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            }

            $appdate = explode(" ", $r['permit_created_at']);

            if ($r['permit_officialstatus_name_permit_officialstatus'] == 'completed') {
                $officialstatus = '<span class="label label-success">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'inprogress') {
                $officialstatus = '<span class="label label-primary">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'pending') {
                $officialstatus = '<span class="label label-warning">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'failed') {
                $officialstatus = '<span class="label label-danger">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'pendingpayment') {
                $officialstatus = '<span class="label label-warning">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'rejected') {
                $officialstatus = '<span class="label label-danger">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'suspended') {
                $officialstatus = '<span class="label label-danger">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'canceled') {
                $officialstatus = '<span class="label label-danger">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'terminated') {
                $officialstatus = '<span class="label label-danger">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'expired') {
                $officialstatus = '<span class="label label-danger">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'paid') {
                $officialstatus = '<span class="label label-primary">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            }

            array_push($data, [
/*                $i, */
                $r['company_name_permit_companyid'],
                $r['permit_bookingid'],
                $r['permit_issuance_serialno'],
                $val,
                $r['permit_type_desc'],
                $officialstatus,
                datelocal($appdate[0]),
                datelocal($r['permit_issuance_expirydate']),
                // Hidden column start [6]
                $r['permit_group_name_permit_groupid'], // Permit Type 7
                $r['permit_condition_name_permit_condition'], // Permit Condition 8
                $r['pic_fullname_permit_picid'], // PIC 9
                $r['user_name_permit_issuance_processedby'], // Processed By 10
                $r['permit_status_desc_permit_status'], // Current Step   11
                // Hidden column end
                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->permitcollect_model->recordsTotal($location)->recordstotal,
                "recordsFiltered" => $this->permitcollect_model->recordsFiltered($location,$columns, $columnfilter,$this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

    public function pbb($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->pbb_detail($id);
        $this->infopage = 'permitall/permitall_pbb';
        $this->content  = 'permitcollect/permitcollect_pbb_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function pbb_submit()
    {

        $permitid    = fixzy_decoder($this->input->post('permit_id', true));
        $nowdatetime = date('Y-m-d H:i:s');
        $userid      = $this->session->userdata('id');
        $driver_id   = $this->input->post('driver_id', true);

        $data_permit = [
            'permit_status' => 'completed',
            'permit_officialstatus' => 'completed',
            'permit_remark' => $this->input->post('remark', true),
            'permit_updated_at' => $nowdatetime,
            'permit_lastchanged_by' => $userid,
        ];

        $data_timeline = [
            'permit_timeline_permitid' => $permitid,
            'permit_timeline_userid' => $userid,
            'permit_timeline_name' => PERMIT_PRINTOUT_PBB,
            'permit_timeline_desc' => PERMIT_PRINTOUT_PBB_DESC,
            'permit_timeline_status' => 'completed',
            'permit_timeline_officialstatus' => 'completed',
            'permit_timeline_created_at' => $nowdatetime,
            'permit_timeline_lastchanged_by' => $userid,
        ];

        $data_driver = [
            'driver_activity_statusid' => '6',
            'driver_updated_at' => $nowdatetime,
            'driver_lastchanged_by' => $this->session->userdata('id'),
        ];

        $this->db->trans_start();
        $this->permitcollect_model->update($permitid, $data_permit);
        $this->permittimelinedom_model->insert($data_timeline);
        $this->driver_model->update($driver_id, $data_driver);

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            // generate an error... or use the log_message() function to log your error
            echo 'error';
        } else {
            //$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitprintout/pbb/' . $this->input->post('permit_id', true)));
        }

    }

    public function pca($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->pca_detail($id);
        $this->infopage = 'permitall/permitall_pca';
        $this->content  = 'permitcollect/permitcollect_pca_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function pca_submit()
    {

        $permitid    = fixzy_decoder($this->input->post('permit_id', true));
        $nowdatetime = date('Y-m-d H:i:s');
        $userid      = $this->session->userdata('id');
        $driver_id   = $this->input->post('driver_id', true);

        $data_permit = [
            'permit_status' => 'completed',
            'permit_officialstatus' => 'completed',
            'permit_remark' => $this->input->post('remark', true),
            'permit_updated_at' => $nowdatetime,
            'permit_lastchanged_by' => $userid,
        ];

        $data_timeline = [
            'permit_timeline_permitid' => $permitid,
            'permit_timeline_userid' => $userid,
            'permit_timeline_name' => PERMIT_PRINTOUT_PCA,
            'permit_timeline_desc' => PERMIT_PRINTOUT_PCA_DESC,
            'permit_timeline_status' => 'completed',
            'permit_timeline_officialstatus' => 'completed',
            'permit_timeline_created_at' => $nowdatetime,
            'permit_timeline_lastchanged_by' => $userid,
        ];

        $data_driver = [
            'driver_activity_statusid' => '6',
            'driver_updated_at' => $nowdatetime,
            'driver_lastchanged_by' => $this->session->userdata('id'),
        ];

        $this->db->trans_start();
        $this->permitcollect_model->update($permitid, $data_permit);
        $this->permittimelinedom_model->insert($data_timeline);
        $this->driver_model->update($driver_id, $data_driver);

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            // generate an error... or use the log_message() function to log your error
            echo 'error';
        } else {
            //$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitprintout/pca/' . $this->input->post('permit_id', true)));
        }

    }

    public function gpu($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->gpu_detail($id);
        $this->infopage = 'permitall/permitall_gpu';
        $this->content  = 'permitcollect/permitcollect_gpu_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function gpu_submit()
    {

        $permitid    = fixzy_decoder($this->input->post('permit_id', true));
        $nowdatetime = date('Y-m-d H:i:s');
        $userid      = $this->session->userdata('id');
        $driver_id   = $this->input->post('driver_id', true);

        $data_permit = [
            'permit_status' => 'completed',
            'permit_officialstatus' => 'completed',
            'permit_remark' => $this->input->post('remark', true),
            'permit_updated_at' => $nowdatetime,
            'permit_lastchanged_by' => $userid,
        ];

        $data_timeline = [
            'permit_timeline_permitid' => $permitid,
            'permit_timeline_userid' => $userid,
            'permit_timeline_name' => PERMIT_PRINTOUT_GPU,
            'permit_timeline_desc' => PERMIT_PRINTOUT_GPU_DESC,
            'permit_timeline_status' => 'completed',
            'permit_timeline_officialstatus' => 'completed',
            'permit_timeline_created_at' => $nowdatetime,
            'permit_timeline_lastchanged_by' => $userid,
        ];

        $data_driver = [
            'driver_activity_statusid' => '6',
            'driver_updated_at' => $nowdatetime,
            'driver_lastchanged_by' => $this->session->userdata('id'),
        ];

        $this->db->trans_start();
        $this->permitcollect_model->update($permitid, $data_permit);
        $this->permittimelinedom_model->insert($data_timeline);
        $this->driver_model->update($driver_id, $data_driver);

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            // generate an error... or use the log_message() function to log your error
            echo 'error';
        } else {
            //$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitprintout/gpu/' . $this->input->post('permit_id', true)));
        }

    }

    public function cs($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->cs_detail($id);
        $this->infopage = 'permitall/permitall_cs';
        $this->content  = 'permitcollect/permitcollect_cs_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function cs_submit()
    {

        $permitid    = fixzy_decoder($this->input->post('permit_id', true));
        $nowdatetime = date('Y-m-d H:i:s');
        $userid      = $this->session->userdata('id');
        $vehicle_id  = $this->input->post('vehicle_id', true);

        $data_permit = [
            'permit_status' => 'completed',
            'permit_officialstatus' => 'completed',
            'permit_remark' => $this->input->post('remark', true),
            'permit_updated_at' => $nowdatetime,
            'permit_lastchanged_by' => $userid,
        ];

        $data_timeline = [
            'permit_timeline_permitid' => $permitid,
            'permit_timeline_userid' => $userid,
            'permit_timeline_name' => PERMIT_PRINTOUT_CS,
            'permit_timeline_desc' => PERMIT_PRINTOUT_CS_DESC,
            'permit_timeline_status' => 'completed',
            'permit_timeline_officialstatus' => 'completed',
            'permit_timeline_created_at' => $nowdatetime,
            'permit_timeline_lastchanged_by' => $userid,
        ];

        $data_vehicle = [
            'vehicle_activity_statusid' => '6',
            'vehicle_updated_at' => $nowdatetime,
            'vehicle_lastchanged_by' => $this->session->userdata('id'),
        ];

        $this->db->trans_start();
        $this->permitcollect_model->update($permitid, $data_permit);
        $this->permittimelinedom_model->insert($data_timeline);
        $this->vehicle_model->update($vehicle_id, $data_vehicle);

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            // generate an error... or use the log_message() function to log your error
            echo 'error';
        } else {
            //$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitprintout/cs/' . $this->input->post('permit_id', true)));
        }

    }

    public function vdgs($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->vdgs_detail($id);
        $this->infopage = 'permitall/permitall_vdgs';
        $this->content  = 'permitcollect/permitcollect_vdgs_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function vdgs_submit()
    {

        $permitid    = fixzy_decoder($this->input->post('permit_id', true));
        $nowdatetime = date('Y-m-d H:i:s');
        $userid      = $this->session->userdata('id');
        $driver_id   = $this->input->post('driver_id', true);

        $data_permit = [
            'permit_status' => 'completed',
            'permit_officialstatus' => 'completed',
            'permit_remark' => $this->input->post('remark', true),
            'permit_updated_at' => $nowdatetime,
            'permit_lastchanged_by' => $userid,
        ];

        $data_timeline = [
            'permit_timeline_permitid' => $permitid,
            'permit_timeline_userid' => $userid,
            'permit_timeline_name' => PERMIT_PRINTOUT_VDGS,
            'permit_timeline_desc' => PERMIT_PRINTOUT_VDGS_DESC,
            'permit_timeline_status' => 'completed',
            'permit_timeline_officialstatus' => 'completed',
            'permit_timeline_created_at' => $nowdatetime,
            'permit_timeline_lastchanged_by' => $userid,
        ];

        $data_driver = [
            'driver_activity_statusid' => '6',
            'driver_updated_at' => $nowdatetime,
            'driver_lastchanged_by' => $this->session->userdata('id'),
        ];

        $this->db->trans_start();
        $this->permitcollect_model->update($permitid, $data_permit);
        $this->permittimelinedom_model->insert($data_timeline);
        $this->driver_model->update($driver_id, $data_driver);

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            // generate an error... or use the log_message() function to log your error
            echo 'error';
        } else {
            // $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitprintout/vdgs/' . $this->input->post('permit_id', true)));
        }

    }

    public function sh($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->sh_detail($id);
        $this->infopage = 'permitall/permitall_sh';
        $this->content  = 'permitcollect/permitcollect_sh_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function sh_submit()
    {

        $permitid    = fixzy_decoder($this->input->post('permit_id', true));
        $nowdatetime = date('Y-m-d H:i:s');
        $userid      = $this->session->userdata('id');
        $vehicle_id  = $this->input->post('vehicle_id', true);

        $data_permit = [
            'permit_status' => 'completed',
            'permit_officialstatus' => 'completed',
            'permit_remark' => $this->input->post('remark', true),
            'permit_updated_at' => $nowdatetime,
            'permit_lastchanged_by' => $userid,
        ];

        $data_timeline = [
            'permit_timeline_permitid' => $permitid,
            'permit_timeline_userid' => $userid,
            'permit_timeline_name' => PERMIT_PRINTOUT_SH,
            'permit_timeline_desc' => PERMIT_PRINTOUT_SH_DESC,
            'permit_timeline_status' => 'completed',
            'permit_timeline_officialstatus' => 'completed',
            'permit_timeline_created_at' => $nowdatetime,
            'permit_timeline_lastchanged_by' => $userid,
        ];

        $data_vehicle = [
            'vehicle_activity_statusid' => '6',
            'vehicle_updated_at' => $nowdatetime,
            'vehicle_lastchanged_by' => $this->session->userdata('id'),
        ];

        $this->db->trans_start();
        $this->permitcollect_model->update($permitid, $data_permit);
        $this->permittimelinedom_model->insert($data_timeline);
        $this->vehicle_model->update($vehicle_id, $data_vehicle);

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            // generate an error... or use the log_message() function to log your error
            echo 'error';
        } else {
            //$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitprintout/sh/' . $this->input->post('permit_id', true)));
        }

    }

    public function wip($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->wip_detail($id);
        $this->infopage = 'permitall/permitall_wip';
        $this->content  = 'permitcollect/permitcollect_wip_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function wip_submit()
    {

        $permitid    = fixzy_decoder($this->input->post('permit_id', true));
        $nowdatetime = date('Y-m-d H:i:s');
        $userid      = $this->session->userdata('id');
        $vehicle_id  = $this->input->post('vehicle_id', true);

        $data_permit = [
            'permit_status' => 'completed',
            'permit_officialstatus' => 'completed',
            'permit_remark' => $this->input->post('remark', true),
            'permit_updated_at' => $nowdatetime,
            'permit_lastchanged_by' => $userid,
        ];

        $data_timeline = [
            'permit_timeline_permitid' => $permitid,
            'permit_timeline_userid' => $userid,
            'permit_timeline_name' => PERMIT_PRINTOUT_WIP,
            'permit_timeline_desc' => PERMIT_PRINTOUT_WIP_DESC,
            'permit_timeline_status' => 'completed',
            'permit_timeline_officialstatus' => 'completed',
            'permit_timeline_created_at' => $nowdatetime,
            'permit_timeline_lastchanged_by' => $userid,
        ];

        $data_vehicle = [
            'vehicle_activity_statusid' => '6',
            'vehicle_updated_at' => $nowdatetime,
            'vehicle_lastchanged_by' => $this->session->userdata('id'),
        ];

        $this->db->trans_start();
        $this->permitcollect_model->update($permitid, $data_permit);
        $this->permittimelinedom_model->insert($data_timeline);
        $this->vehicle_model->update($vehicle_id, $data_vehicle);

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            // generate an error... or use the log_message() function to log your error
            echo 'error';
        } else {
            //$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitprintout/wip/' . $this->input->post('permit_id', true)));
        }

    }

    public function shins($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->shins_detail($id);
        $this->infopage = 'permitall/permitall_shins';
        $this->content  = 'permitcollect/permitcollect_shins_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function shins_submit()
    {

        $permitid    = fixzy_decoder($this->input->post('permit_id', true));
        $nowdatetime = date('Y-m-d H:i:s');
        $userid      = $this->session->userdata('id');
        $vehicle_id  = $this->input->post('vehicle_id', true);

        $data_permit = [
            'permit_status' => 'completed',
            'permit_officialstatus' => 'completed',
            'permit_remark' => $this->input->post('remark', true),
            'permit_updated_at' => $nowdatetime,
            'permit_lastchanged_by' => $userid,
        ];

        $data_timeline = [
            'permit_timeline_permitid' => $permitid,
            'permit_timeline_userid' => $userid,
            'permit_timeline_name' => PERMIT_PRINTOUT_SHINS,
            'permit_timeline_desc' => PERMIT_PRINTOUT_SHINS_DESC,
            'permit_timeline_status' => 'completed',
            'permit_timeline_officialstatus' => 'completed',
            'permit_timeline_created_at' => $nowdatetime,
            'permit_timeline_lastchanged_by' => $userid,
        ];

        $data_vehicle = [
            'vehicle_activity_statusid' => '6',
            'vehicle_updated_at' => $nowdatetime,
            'vehicle_lastchanged_by' => $this->session->userdata('id'),
        ];

        $this->db->trans_start();
        $this->permitcollect_model->update($permitid, $data_permit);
        $this->permittimelinedom_model->insert($data_timeline);
        $this->vehicle_model->update($vehicle_id, $data_vehicle);

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            // generate an error... or use the log_message() function to log your error
            echo 'error';
        } else {
            //$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitprintout/shins/' . $this->input->post('permit_id', true)));
        }

    }

    public function wipbriefing($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->wipbriefing_detail($id);
        $this->infopage = 'permitall/permitall_wipbriefing';
        $this->content  = 'permitcollect/permitcollect_wipbriefing_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function wipbriefing_submit()
    {

        $permitid    = fixzy_decoder($this->input->post('permit_id', true));
        $nowdatetime = date('Y-m-d H:i:s');
        $userid      = $this->session->userdata('id');
        $vehicle_id  = $this->input->post('vehicle_id', true);

        $data_permit = [
            'permit_status' => 'completed',
            'permit_officialstatus' => 'completed',
            'permit_remark' => $this->input->post('remark', true),
            'permit_updated_at' => $nowdatetime,
            'permit_lastchanged_by' => $userid,
        ];

        $data_timeline = [
            'permit_timeline_permitid' => $permitid,
            'permit_timeline_userid' => $userid,
            'permit_timeline_name' => PERMIT_PRINTOUT_WIPBRIEFING,
            'permit_timeline_desc' => PERMIT_PRINTOUT_WIPBRIEFING_DESC,
            'permit_timeline_status' => 'completed',
            'permit_timeline_officialstatus' => 'completed',
            'permit_timeline_created_at' => $nowdatetime,
            'permit_timeline_lastchanged_by' => $userid,
        ];

        $data_vehicle = [
            'vehicle_activity_statusid' => '6',
            'vehicle_updated_at' => $nowdatetime,
            'vehicle_lastchanged_by' => $this->session->userdata('id'),
        ];

        $this->db->trans_start();
        $this->permitcollect_model->update($permitid, $data_permit);
        $this->permittimelinedom_model->insert($data_timeline);
        $this->vehicle_model->update($vehicle_id, $data_vehicle);

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            // generate an error... or use the log_message() function to log your error
            echo 'error';
        } else {
            //$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitprintout/wipbriefing/' . $this->input->post('permit_id', true)));
        }

    }

}
;
/* End of file Permitcollect.php */
/* Location: ./application/controllers/Permitcollect.php */
