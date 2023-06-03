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
        return $query;
    }

    public function getAllPatients() 
    {
        $query = $this->db->get('patients');
        // var_dump($query);
        return $query->result_array();
    }

    public function singleData($id){
        $this->db->select("*");
        $this->db->from('patients');
        $this->db->where('patientid', $id);
        $query = $this->db->get();
        return $query->row();
    }
}