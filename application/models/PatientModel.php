<?php
class patientModel extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }
    public function storeAllPatients()
    {
        $name = $this->input->post('name');
        $phonenumber = $this->input->post('phonenumber');
        $age = $this->input->post('age');
        $country = $this->input->post('country');
        $province = $this->input->post('province');
        $district = $this->input->post('district');
        $municipality = $this->input->post('municipality');
        $address = $this->input->post('address');
        $gender = $this->input->post('gender');
        $language = $this->input->post('language');
        $languageArray = json_encode($language);

        if(empty($name)){
            $this->session->set_flashdata('error','Please fill all the required fields');
        }
        $data = array(
            'name'=>$name,
            'mobilenumber'=>$phonenumber,
            'age'=>$age,
            'country'=>$country,
            'province'=>$province,
            'district'=>$district,
            'municipality'=>$municipality,
            'address'=>$address,
            'gender'=>$gender,
            'language'=>$languageArray,
            'datetime'=> date('Y-m-d H:i:s'),
        );
        $query = $this->db->insert('patients', $data);
        if ($query) {
            // The insert query was successful
            $this->session->set_flashdata('success', 'Data inserted successfully.');
            return;
        } else {
            // The insert query failed
            $this->session->set_flashdata('error', 'Failed to insert data.');
            return;
        }
        // return $query;
    }

    public function getAllPatients() 
    {
        $query = $this->db->order_by('patientid', 'desc')->get('patients');
        // var_dump($query);
        if($query)
        {
            return $query->result_array();
        }
        else {
            $this->session->set_flashdata('error', 'Failed to insert data.');
            return;
        }
    }

    public function singleData($id){
        $this->db->select("*");
        $this->db->from('patients');
        $this->db->where('patientid', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getBillingData()
    {
        $query = $this->db->order_by('id', 'desc')->get('billing');
        return $query->result_array();
    }
    public function billingData($id){
        $this->db->select("billing.*, patients.name, tests.test_items, tests.quantity, tests.unit_price, tests.price");
        $this->db->from('billing');
        $this->db->join('patients', 'billing.patient_id = patients.patientid');
        $this->db->join('tests', 'billing.id = tests.sample_id');
        $this->db->where('billing.id', $id);
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }
}