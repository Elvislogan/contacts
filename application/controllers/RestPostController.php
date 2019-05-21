<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');
require(APPPATH . '/libraries/format.php');

class RestPostController extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ContactModel', 'cm');
    }

    public function add_contact_post()
    {
        $contact_name = $this->post('contact_name');
        $contact_address = $this->post('contact_address');
        $contact_phone = $this->post('contact_phone');
        
        $result = $this->cm->add_contact($contact_name, $contact_address, $contact_phone);

        if ($result === false) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }

    public function view_contact_get()
    {
        $contact_id = $this->get('contact_id');
        if (!$contact_id) {
            $this->response(array('status' => 'incomplete parameters'), 401);
        }
        $result = $this->cm->view_contact($contact_id);
        if ($result) {
            $this->response($result, 200);
        } else {
            $this->response(array('status' => 'there are no contacts in your database'), 401);
        }
    }

    public function view_contacts_get()
    {
        $result = $this->cm->view_contacts();
        if ($result) {
            $this->response($result, 200);
        } else {
            $this->response(array('status' => 'there are no contacts in your database'), 401);
        }
    }

    public function delete_contacts_delete()
    {
        $contact_id = $this->query('contact_id');
        if (!$contact_id) {
            $this->response(array('status' => 'incomplete parameters'), 401);
        }
        $result = $this->cm->delete_contacts($contact_id);
        if ($result) {
            $this->response($result, 200);
        } else {
            $this->response(array('status' => 'Contact deleted unsuccessful'), 401);
        }
    }

    public function update_contact_put()
    {
        $contact_id = $this->put('contact_id');
        $contact_name = $this->put('contact_name');
        $contact_address = $this->put('contact_address');
        $contact_phone = $this->put('contact_phone');
        if (!$contact_id && !$contact_name && !$contact_address && !$contact_phone) {
            $this->response(array('status' => 'incomplete parameters'), 401);
        }
        
        $result = $this->cm->update_contact($contact_id, $contact_name, $contact_address, $contact_phone);

        if ($result === false) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }
} 
