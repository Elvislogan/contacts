<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of ContactModel
 *
 * @author https://roytuts.com
 */
class ContactModel extends CI_Model {

    private $contact = 'contact';

    function add_contact($contact_name, $contact_address, $contact_phone) {
        $data = array('contact_name' => $contact_name, 'contact_address' => $contact_address, 'contact_phone' => $contact_phone);
        $this->db->insert($this->contact, $data);
    }
    
    function view_contacts(){
        $query = $this->db->select('contact_id,contact_name, contact_phone') 
                          ->from('contact')
                          ->get();
        
        if ($query && $query->num_rows()>0){
            //var_dump($query->result_array());
            return $query->result_array();
            
        } else{
            return false;
        }
    }
    function view_contact($contact_id){
       
        $query = $this->db->select('contact_id, contact_name, contact_phone, contact_address') 
                          ->from('contact')
                          ->where ('contact_id', $contact_id)
                          ->limit(1)
                          ->get();
        if ($query && $query->num_rows()==1){
            return $query->result_array()[0];
            
        } else{
            return false;
        }

    }

   

    function update_contact($contact_id, $contact_name, $contact_address, $contact_phone) {
        $data = array('contact_name' => $contact_name, 'contact_address' => $contact_address, 'contact_phone' => $contact_phone);
        $this->db->where('contact_id', $contact_id);
      return  $this->db->update('contact', $data);
    }


 
    function delete_contacts($contact_id){
         return  $this->db->delete('contact', array('contact_id'=>$contact_id));
    }
    
}