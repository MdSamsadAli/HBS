<!-- table form -->
<div class="m-4">
    <div class="border">
        <div class="border-bottom text-center">
            <h2>Patients Billing</h2>
        </div>
        <table class="border border-bottom table table-bordered table-striped" id="user_data">
            <thead>
                <tr>
                    <th>Sno.</th>
                    <th>Date</th>
                    <th>Bill No.</th>
                    <th>Discount</th>
                    <th>Sub Total</th>
                    <th>Net Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $id = 1;
                foreach($data as $row){?>
                <tr>
                    <td><?php echo $id ?></td>
                    <td><?php echo $row['billing_date']; ?></td>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['discount_amount']; ?></td>
                    <td><?php echo $row['sub_total']; ?></td>
                    <td><?php echo $row['net_total']; ?></td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop" value="<?php echo $row['id'];?>" id="editBill">View</a>
                        <!-- <a href="#" class="btn btn-secondary btn-sm">Print</a> -->
                    </td>
                </tr>
                <?php
                $id++;

                }?>
                
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #f8f9fa;">
        <h5 class="modal-title text-uppercase" id="staticBackdropLabel">Invoice</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <!-- Preview Modal HTML -->
        <form class="mb-4" id="form">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <h4>Patient Name: <span id="name"></span></h4>
            </div>
            <div>
              <h5>Billing Date: <span id="date"></span></h5>
            </div>
          </div>

          <div class="mb-3">
            <h6 class="fw-bold">Bill No: <span id="billno"></span></h6>
          </div>

          <div class="mb-3">
            <h6 class="fw-bold">Patient Id: <span class="col-sm-8" id="patient_id"></span></h6>
          </div>

          <hr>

          <div class="table-responsive">
            <table class="table table-bordered">
              <thead style="background-color: #f8f9fa;">
                <tr>
                  <th>Test Items</th>
                  <th>Quantity</th>
                  <th>Unit Price</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody id="invoice_data">
                <!-- Invoice data rows will be dynamically added here -->
              </tbody>
            </table>
          </div>

          <div class="mt-4">
            <div class="d-flex justify-content-end">
              <div class="col-sm-6 p-3 border">
                <div class="mb-3">
                  <h6 class="fw-bold">Sub Total:</h6>
                  <h6 class="text-end" id="subTotal"></h6>
                </div>

                <div class="mb-3">
                  <h6 class="fw-bold">Discount:</h6>
                  <h6 class="text-end" id="discount"></h6>
                </div>

                <div class="mb-3">
                  <h6 class="fw-bold">Net Total:</h6>
                  <h6 class="text-end" id="netTotal"></h6>
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-end mt-4">
              <a href="#" class="btn btn-primary btn-sm" id="printBtn">Print</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>






