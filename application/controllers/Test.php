<?php
class Test extends CI_Controller
{
    public function storeAll()
    {
        $response = $this->test->storeTestData();
        echo json_encode($response);
    }
}

?>