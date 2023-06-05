<?php
class TestModel extends CI_Model
{
    public function storeTestData()
    {
        $patientId = $this->input->post('patient_id');
        $billingDate = $this->input->post('billingDate');
        $testItems = $this->input->post('testItems');
        $quantities = $this->input->post('quantity');
        $unitPrices = $this->input->post('unitPrice');
        $prices = $this->input->post('price');
        $discountPercent = $this->input->post('discountPercentage');
        $discountAmount = $this->input->post('discountAmount');
        $subTotal = $this->input->post('subTotal');
        $netTotal = $this->input->post('netTotal');
       
        // Insert data into the "billing" table
        $this->db->insert('billing', [
            'patient_id' => $patientId,
            'billing_date' => $billingDate,
            'sub_total' => $subTotal,
            'discount_percentage' => $discountPercent,
            'discount_amount' => $discountAmount,
            'net_total' => $netTotal
        ]);
        // Retrieve the last inserted ID from the "test" table
        $id = $this->db->insert_id();
        // Insert data into the "test" table
        // Assuming you have loaded the database library
        for ($i = 0; $i < count($testItems); $i++) {
            $this->db->insert('tests', [
                'sample_id' => $id,
                'patient_id' => $patientId,
                'test_items' => $testItems[$i],
                'quantity' => $quantities[$i],
                'unit_price' => $unitPrices[$i],
                'price' => $prices[$i]
            ]);
        }

    }
}