<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Emailsent extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('emailsent_model');
        $this->lang->load('emailsent_lang', 'english');
    }

    public function index()
    {
        //$this->output->enable_profiler(TRUE);
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $emailsent = $this->emailsent_model->get_all();
        /* $this->logQueries($this->config->item('dblog')); */
        $data          = ['emailsent_data' => $emailsent];
        $this->content = 'emailsent/emailsent_list';
        $this->layout($data, $setting);
    }

    public function read($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'read',
        ];
        $row = $this->emailsent_model->get_read(fixzy_decoder($id));
        /* $this->logQueries($this->config->item('dblog')); */
        if ($row) {
            $data = [
                'email_sent_from' => $row->email_sent_from,
                'email_sent_to' => $row->email_sent_to,
                'email_sent_cc' => $row->email_sent_cc,
                'email_sent_bcc' => $row->email_sent_bcc,
                'email_sent_subject' => $row->email_sent_subject,
                'email_sent_message' => $row->email_sent_message,
            ];
            $this->content = 'emailsent/emailsent_read';
            $this->layout($data, $setting);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('emailsent'));
        }
    }

    public function create()
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'form',
        ];
        $data = [
            'button' => 'Create',
            'action' => site_url('emailsent/create_action'),
            'email_sent_from' => set_value('email_sent_from'),
            'email_sent_to' => set_value('email_sent_to'),
            'email_sent_cc' => set_value('email_sent_cc'),
            'email_sent_bcc' => set_value('email_sent_bcc'),
            'email_sent_subject' => set_value('email_sent_subject'),
            'email_sent_message' => set_value('email_sent_message'),
        ];
        $this->content = 'emailsent/emailsent_form';
        $this->layout($data, $setting);
    }

    public function create_action()
    {

        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $data = [
                'email_sent_from' => $this->input->post('email_sent_from', true),
                'email_sent_to' => $this->input->post('email_sent_to', true),
                'email_sent_cc' => $this->input->post('email_sent_cc', true),
                'email_sent_bcc' => $this->input->post('email_sent_bcc', true),
                'email_sent_subject' => $this->input->post('email_sent_subject',
                    true),
                'email_sent_message' => $this->input->post('email_sent_message',
                    true),
                'email_sent_created_at' => date('Y-m-d H:i:s'),
                'email_sent_lastchanged_by' => $this->session->userdata('id'),
            ];
            $this->emailsent_model->insert($data);
            /* $this->logQueries($this->config->item('dblog')); */

            $this->email->from($this->input->post('email_sent_from', true),
                'Test Admin');
            $this->email->to($this->input->post('email_sent_to', true));
            if (!empty($this->input->post('email_sent_cc', true))) {
                $this->email->cc($this->input->post('email_sent_cc', true));
            }
            if (!empty($this->input->post('email_sent_bcc', true))) {
                $this->email->bcc($this->input->post('email_sent_bcc', true));
            }

            $this->email->subject($this->input->post('email_sent_subject', true));
            $this->email->message($this->input->post('email_sent_message', true));
            $this->email->send();

            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('emailsent'));
        }
    }

    public function update($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'form',
        ];
        $row = $this->emailsent_model->get_by_id(fixzy_decoder($id));
        /* $this->logQueries($this->config->item('dblog')); */
        if ($row) {
            $data = [
                'button' => $this->lang->line('edit'),
                'action' => site_url('emailsent/update_action'),
                'id' => $id,
                'email_sent_from' => set_value('email_sent_from',
                    $row->email_sent_from),
                'email_sent_to' => set_value('email_sent_to',
                    $row->email_sent_to),
                'email_sent_cc' => set_value('email_sent_cc',
                    $row->email_sent_cc),
                'email_sent_bcc' => set_value('email_sent_bcc',
                    $row->email_sent_bcc),
                'email_sent_subject' => set_value('email_sent_subject',
                    $row->email_sent_subject),
                'email_sent_message' => set_value('email_sent_message',
                    $row->email_sent_message),
            ];
            $this->content = 'emailsent/emailsent_form';
            $this->layout($data, $setting);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('emailsent'));
        }
    }

    public function update_action()
    {

        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('email_sent_id', true));
        } else {
            $data = [
                'email_sent_from' => $this->input->post('email_sent_from', true),
                'email_sent_to' => $this->input->post('email_sent_to', true),
                'email_sent_cc' => $this->input->post('email_sent_cc', true),
                'email_sent_bcc' => $this->input->post('email_sent_bcc', true),
                'email_sent_subject' => $this->input->post('email_sent_subject',
                    true),
                'email_sent_message' => $this->input->post('email_sent_message',
                    true),
                'email_sent_updated_at' => date('Y-m-d H:i:s'),
                'email_sent_lastchanged_by' => $this->session->userdata('id'),
            ];
            $this->emailsent_model->update(fixzy_decoder($this->input->post('email_sent_id')),
                $data);
            /* $this->logQueries($this->config->item('dblog')); */

            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('emailsent'));
        }
    }

    public function delete($id)
    {
        $row = $this->emailsent_model->get_by_id(fixzy_decoder($id));
        /* $this->logQueries($this->config->item('dblog')); */
        if ($row) {
            $this->emailsent_model->delete(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('emailsent'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('emailsent'));
        }
    }

    public function delete_update($id)
    {
        $row = $this->emailsent_model->get_by_id(fixzy_decoder($id));
        /* $this->logQueries($this->config->item('dblog')); */
        if ($row) {
            $data = [
                'email_sent_id' => '1'
            ];
            $this->emailsent_model->update(fixzy_decoder($id), $data);
            /* $this->logQueries($this->config->item('dblog')); */
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('emailsent'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('emailsent'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('email_sent_from', ' ',
            'trim|required');
        $this->form_validation->set_rules('email_sent_to', ' ', 'trim|required');
        $this->form_validation->set_rules('email_sent_cc', ' ', 'trim');
        $this->form_validation->set_rules('email_sent_bcc', ' ', 'trim');
        $this->form_validation->set_rules('email_sent_subject', ' ', 'trim');
        $this->form_validation->set_rules('email_sent_message', ' ', 'trim');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {
        $i       = $this->input->get('start');
        $columns = [
            'email_sent_id',
            'email_sent_from',
            'email_sent_to',
            'email_sent_cc',
            'email_sent_bcc',
            'email_sent_subject',
            'email_sent_message',
        ];
        $results = $this->emailsent_model->listajax(
            $columns, $this->input->get('start'), $this->input->get('length'),
            $this->input->get('search')['value'],
            $columns[$this->input->get('order')[0]['column']],
            $this->input->get('order')[0]['dir']
        );
        $data = [];
        foreach ($results as $r) {
            $i++;
            array_push($data,
                [
                    $i,
                    $r['email_sent_from'],
                    $r['email_sent_to'],
                    $r['email_sent_cc'],
                    $r['email_sent_bcc'],
                    $r['email_sent_subject'],
                    $r['email_sent_message'],
                    anchor(site_url('emailsent/read/' . fixzy_encoder($r['email_sent_id'])),
                        $this->lang->line('detail')) .
                    ' ' .
                    anchor(site_url('emailsent/update/' . fixzy_encoder($r['email_sent_id'])),
                        $this->lang->line('edit')) .
                    ' ' .
                    anchor(site_url('emailsent/delete/' . fixzy_encoder($r['email_sent_id'])),
                        $this->lang->line('delete'),
                        'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"')
                ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->emailsent_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->emailsent_model->recordsFiltered($columns,
                    $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }
}
;
/* End of file Emailsent.php */
/* Location: ./application/controllers/Emailsent.php */
