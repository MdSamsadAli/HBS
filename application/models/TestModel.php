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
        // var_dump($unitPrices);
        // print_r($unitPrices);
       
        // Begin the transaction
        $this->db->trans_start();

        try {
            // Insert data into the "billing" table
            $this->db->insert('billing', [
                'patient_id' => $patientId,
                'billing_date' => $billingDate,
                'sub_total' => $subTotal,
                'discount_percentage' => $discountPercent,
                'discount_amount' => $discountAmount,
                'net_total' => $netTotal
            ]);
            
            // Retrieve the last inserted ID from the "billing" table
            $id = $this->db->insert_id();
            
            // Insert data into the "tests" table within the transaction
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
            
            // Commit the transaction if all operations are successful
            $this->db->trans_commit();
            
            // Handle other post-transaction logic
            return 'Transaction completed successfully!';
            
        } catch (Exception $e) {
            // Rollback the transaction if an error occurs
            $this->db->trans_rollback();
            
            // Handle the error appropriately
            // Log or handle the error appropriately
            $errorMessage = $e->getMessage();
            
            // Return error message
            return 'Transaction failed: ' . $errorMessage;
        }
    }
}