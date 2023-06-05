<?php
class Test extends CI_Controller
{
    public function storeAll()
    {
        $response = $this->test->storeTestData();
        echo json_encode($response);
    }

    public function billingView()
    {
        $this->load->view('layout/header');
        $this->load->view('layout/nav');

        $data = $this->patient->getBillingData();
        $this->load->view('patient/billing', compact('data'));
        $this->load->view('layout/footer');
    }

    public function editBill()
    {
        $id = $this->input->post('id');
        // var_dump($id);
        $data = $this->patient->billingData($id);
        // var_dump($data);
        echo json_encode($data);
    }
}

?>