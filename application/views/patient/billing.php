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
                    <td><?php echo $row['sample_no']; ?></td>
                    <td><?php echo $row['discount_amount']; ?></td>
                    <td><?php echo $row['sub_total']; ?></td>
                    <td><?php echo $row['net_total']; ?></td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop" value="<?php echo $row['id'];?>" id="editBill">Edit</a>
                        <a href="#" class="btn btn-secondary btn-sm">Print</a>
                    </td>
                </tr>
                <?php
                $id++;

                }?>
                
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
            Invoice List
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
         <!-- Preview Modal HTML -->
        <form class="row mb-4">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h5>Patient Name : <span id="name"></span></h5>
                </div>
                <div>
                    <h6>Billing Date : <span id="date"></span></h6>
                </div>
            </div>
            <div class="mb-3">
                <h6>
                    Bill No : <span class="col-sm-8" id="billno"></span>
                </h6>
            </div>
            <hr>

            <div class="mb-3">
                <h6>
                    Test Items : <span class="col-sm-8" id="test_items"></span>
                </h6>
            </div>

            <div class="mb-3">
                <h6>
                    Sub Total : <span class="col-sm-8" id="subTotal"></span>
                </h6>
            </div>
            <div>

            <div class="mb-3">
                <h6>
                    Discount : <span class="col-sm-8" id="discount"></span>
                </h6>
            </div>

            <div class="mb-3">
                <h6>
                    Net Total : <span class="col-sm-8" id="netTotal"></span>
                </h6>
            </div>

            <!-- <table class="border border-bottom table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Test Items</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="invoice_data">
                    <tr>
                        <td><input type="text" id="test_items"></td>
                    </tr>
                </tbody>
            </table> -->

            

            <!-- <div class="form-group row mb-3">
                <label for="inputEmail3" class="col-sm-4 col-form-label">Sub Total</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="subTotal" name="subTotal" placeholder="Sub Total" readonly>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="inputEmail3" class="col-sm-4 col-form-label">Discount</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="discount" >
                </div>
            </div>
            
            <div class="form-group row mb-3">
                <label for="inputEmail3" class="col-sm-4 col-form-label">Net Total</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="netTotal" required>
                </div>
            </div> -->
            
        </form>

      </div>
    </div>
  </div>
</div>