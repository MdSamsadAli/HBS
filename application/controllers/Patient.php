<?php
class Patient extends CI_Controller
{
    public function index()
    {
        $this->load->view('patient/index');
    }
    public function storePatients()
    {

        // validation
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'phonenumber',
                'label' => 'Phone Number',
                'rules' => 'required'
            ),
            array(
                'field' => 'age',
                'label' => 'Age',
                'rules' => 'required'
            ),
            array(
                'field' => 'country',
                'label' => 'Country',
                'rules' => 'required'
            ),
            array(
                'field' => 'province',
                'label' => 'Province',
                'rules' => 'required'
            ),
            array(
                'field' => 'municipality',
                'label' => 'Municipality',
                'rules' => 'required'
            ),
            array(
                'field' => 'address',
                'label' => 'Address',
                'rules' => 'required'
            ),
            array(
                'field' => 'gender',
                'label' => 'Gender',
                'rules' => 'required'
            ),
            // array(
            //     'field' => 'language',
            //     'label' => 'Language',
            //     'rules' => 'required|in_list[english,nepali,hindi]'
            // ),
        );
        
        $this->form_validation->set_rules($config);

        if($this->form_validation->run() == FALSE){
            // Form validation failed
            echo "something not working";
        }else{
            $response = $this->patient->storeAllPatients();
            echo json_encode($response);
        }

    }
    public function getAll()
    {
        $response = $this->patient->getAllPatients();
        echo json_encode($response);
    }

    public function editPatients()
    {
        $id = $this->input->post('id');
        // var_dump($id);
        $data = $this->patient->singleData($id);
        echo json_encode($data);
    }
}



?>