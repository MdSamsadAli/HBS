<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Billing System</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.7.0.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <style>
        .error {
            color: red;
        }
    </style>
    <link rel="stylesheet" href="assets/css/toastr.min.css">
    <script src="assets/js/toastr.min.js"></script>
</head>
<body>
    <!-- table form -->
    <div class="m-4">
        <div >
            <button type="button" class="btn btn-sm btn-primary" data-bs-target="#myModal" data-bs-toggle="modal">Register Patient</button>
        </div>
        <div class="border" style="border-bottom:none !important;">
            <div class="border-bottom text-center">
                <h2>Patient Information</h2>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Patient ID</th>
                        <th>Patient Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>District</th>
                        <th>Address</th>
                        <th>Registered Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="patientinfo">
                    
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Modal HTML -->
    <div class="m-4">
        <div id="myModal" class="modal fade" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Register Patient</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" id="form">
                            <div class="col-md-5">
                                <label for="validationCustom01" class="form-label">Patient Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Full Name" required>
                            </div>

                            

                            <div class="col-md-5">
                                <label for="validationCustom04" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phonenumber" name="phonenumber" required placeholder="98 XXXXXXXX">
                            </div>
                            
                            <div class="col-md-2">
                                <label for="validationCustom02" class="form-label">Age (in Years)</label>
                                <input type="text" class="form-control" id="age" name="age" placeholder="age" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="validationCustom02" class="form-label">Country</label>
                                <select class="form-select" id="country" name="country" required>
                                    <option value="">---Select Country---</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom03" class="form-label">Province</label>
                                <select class="form-select" id="province" name="province" required>
                                    <option value="">---Select Province---</option>
                                    <option value="others">others</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom03" class="form-label">District</label>
                                <select class="form-select" id="district" name="district" required>
                                    <option value="">---Select District---</option>
                                    <option value="others">others</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom04" class="form-label">Municipality</label>
                                <select class="form-select" id="municipality" name="municipality" required>
                                <option value="">---Select Municipality---</option>
                                <option value="others">others</option>
                                </select>
                                
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom05" class="form-label">Address</label>
                                <input type="text" id="address" class="form-control" name="address" placeholder="Enter Full Address" required>
                            </div>

                            
                            <div class="col-md-3">
                                <fieldset class="form-group">
                                    <div class="row">
                                        <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                                        <div class="col-sm-12">
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="male" value="Male">
                                            <label class="form-check-label" for="gridRadios1">
                                                Male
                                            </label>
                                            </div>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                                            <label class="form-check-label" for="gridRadios2">
                                                Female
                                            </label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-3">
                                <fieldset class="form-group">
                                    <div class="row">
                                        <legend class="col-form-label col-sm-2 pt-0">Language</legend>
                                        <div class="col-sm-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="language" id="english" data-lang="english" value="english" >
                                                <label class="form-check-label" for="language">
                                                    English
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="language" id="nepali" data-lang="nepali" value="nepali">
                                                <label class="form-check-label" for="language">
                                                    Nepali
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="language" id="hindi" data-lang="hindi" value="hindi">
                                                <label class="form-check-label" for="language">
                                                    Hindi
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="storerecord">Register</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- EDIT Modal HTML -->
    <div class="m-4">
        <div id="editModal" class="modal fade" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Patient Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3">
                            <input type="hidden" id="edit_id" name="edit_id" value="">
                            <div class="col-md-5">
                                <label for="validationCustom01" class="form-label">Name</label>
                                <input type="text" class="form-control" id="editname" placeholder="Enter Full Name" required>
                            </div>

                            <div class="col-md-5">
                                <label for="validationCustom04" class="form-label">Phone Number</label>
                                <input type="number" class="form-control" id="editphonenumber" required placeholder="+977 98 XXXXXXXX">
                            </div>
                            
                            <div class="col-md-2">
                                <label for="validationCustom02" class="form-label">Age</label>
                                <input type="number" class="form-control" id="editage" placeholder="age" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="validationCustom02" class="form-label">Country</label>
                                <input type="text" class="form-control" id="editcountry" required>
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom03" class="form-label">Province</label>
                                <input type="text" class="form-control" id="editprovince" required>
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom04" class="form-label">Municipality</label>
                                <input type="text" class="form-control" id="editmunicipality" required>
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom05" class="form-label">Address</label>
                                <input type="text" id="editaddress" class="form-control" name="address" placeholder="Enter Full Address">
                            </div>

                            <div class="col-md-3">
                                <fieldset class="form-group">
                                    <div class="row">
                                        <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                                        <div class="col-sm-12">
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="editgender" id="editmale" value="Male" checked>
                                            <label class="form-check-label" for="gridRadios1">
                                                Male
                                            </label>
                                            </div>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="editgender" id="editfemale" value="Female">
                                            <label class="form-check-label" for="gridRadios2">
                                                Female
                                            </label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-3">
                                <fieldset class="form-group">
                                    <div class="row">
                                        <legend class="col-form-label col-sm-2 pt-0">Language</legend>
                                        <div class="col-sm-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="editlanguage" id="editenglish" data-lang="english" value="english" >
                                                <label class="form-check-label" for="editlanguage">
                                                    English
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="editlanguage" id="editnepali" data-lang="nepali" value="nepali">
                                                <label class="form-check-label" for="language">
                                                    Nepali
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="editlanguage" id="edithindi" data-lang="hindi" value="hindi">
                                                <label class="form-check-label" for="language">
                                                    Hindi
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- BIlling and Register Modal HTML -->
    <div class="m-4">
        <div id="billModal" class="modal fade" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Billing</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" id="form">
                            <div class="col-sm-1">
                                <label for="validationCustom01" class="form-label">Patient Id</label>
                                <input type="text" class="form-control" id="patientId" name="patientId" placeholder="Patient ID" >
                            </div>
                            <div class="col-md-2">
                                <label for="validationCustom01" class="form-label">Billing Date</label>
                                <input type="text" class="form-control" id="datetime" name="datetime" placeholder="Billing Date" >
                            </div>
                        </form>
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Test Items</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tr id="row1">
                                <td>
                                    <input type="text" class="form-control testItems" name="testItems[]" id="testItems" placeholder="Test Items" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control quantity" name="quantity[]" id="quantity" placeholder="Qty" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control unitPrice" name="unitPrice[]" id="unitPrice" placeholder="Unit Price" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control price" name="price[]" id="price" placeholder="Price" required>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-secondary btn-sm me-1 addRowBtn"><i class="fa fa-plus"></i>Add</a>
                                        <a href="#" class="btn btn-danger btn-sm removeRowBtn"><i class="fa fa-plus"></i>Remove</a>
                                    </div>
                                </td>
                            </tr>

                            <thead>
                                <tr>
                                <th scope="col">Test Items</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                        </table>

                        <div class="container mt-5">
                            <div class="row justify-content-end">
                                <div class="col-sm-6">
                                    <form>
                                        <div class="form-group row mb-3">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Sub Total</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="subTotal" name="subTotal" placeholder="Sub Total" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Discount Percent</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="DiscountPercent" name="DiscountPercent" placeholder="Discount Percent">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Discount Amount</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="DiscountAmount" name="DiscountAmount" placeholder="Discount Amount" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Net Total</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="netTotal" name="netTotal" placeholder="Net Total" readonly>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="saveTestItems">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- all assets and funcions  -->
    <script src="assets/js/jquery.js"></script>
</body>
</html>