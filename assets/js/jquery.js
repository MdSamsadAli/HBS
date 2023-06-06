// form validation
$(document).ready(function () {
	// $("#form").validate();

	// Listen to the input event on the phone number field
	$("#phonenumber").on("input", function () {
		var phoneNumber = $(this).val();

		// Remove any non-numeric characters
		phoneNumber = phoneNumber.replace(/\D/g, "");

		// Limit the input to 10 digits
		phoneNumber = phoneNumber.slice(0, 10);

		// Update the value of the phone number field
		$(this).val(phoneNumber);
	});

	// Listen to the input event on the age field
	$("#age").on("input", function () {
		var age = $(this).val();

		// Remove any non-numeric characters
		age = age.replace(/\D/g, "");
		age = age.slice(0, 2);

		// Update the value of the age field
		$(this).val(age);
	});

	// Listen to the input event on the name field
	$("#name").on("input", function () {
		var name = $(this).val();

		// Remove any numeric characters
		name = name.replace(/[^A-Za-z]/g, " ");

		// Update the value of the name field
		$(this).val(name);
	});

	// Listen to the input event on the phone number field
	$("#quantity").on("input", function () {
		var quantity = $(this).val();

		// Remove any non-numeric characters
		quantity = quantity.replace(/\D/g, "");

		// Limit the input to 10 digits
		// quantity = quantity.slice(0, 10);

		// Update the value of the phone number field
		$(this).val(quantity);
	});

	// Listen to the input event on the phone number field
	$("#unitPrice").on("input", function () {
		var unitPrice = $(this).val();

		// Remove any non-numeric characters except dot (.)
		// unitPrice = unitPrice.replace(/[^\d.]/g, "");

		// // Remove extra dots
		// unitPrice = unitPrice.replace(/\.(?=.*\.)/g, "");

		// Limit the input to 10 digits
		// quantity = quantity.slice(0, 10);

		// Update the value of the phone number field
		$(this).val(unitPrice);
	});
});

// store all patients into database
$(document).on("click", "#storerecord", function (e) {
	e.preventDefault();

	var name = $("#name").val();
	var phonenumber = $("#phonenumber").val();
	var age = $("#age").val();
	var country = $("#country").val();
	var province = $("#province").val();
	var district = $("#district").val();
	var municipality = $("#municipality").val();
	var address = $("#address").val();
	var gender = $("input[type='radio']:checked").val();

	var languages = [];
	$("input[name='language']:checked").each(function () {
		languages.push($(this).val());
	});
	// alert(languages);

	// Validate name field
	if (name.trim() === "") {
		toastr.error("Please enter a name");
		return;
	}

	// Check if name contains any numeric characters
	if (/\d/.test(name)) {
		toastr.error("Name cannot contain any numbers");
		return;
	}

	if (phonenumber.trim() === "") {
		toastr.error("Please enter a phonenumber");
		return;
	}
	// // Check if phone number has exactly 10 digits
	// if (phonenumber.length !== 10 || isNaN(phonenumber)) {
	// 	toastr.error("Phone number must contain exactly 10 digits only numbers");
	// 	return;
	// }

	if (age.trim() === "") {
		toastr.error("Please enter a age");
		return;
	}
	// Validate age field
	var age = parseInt($("#age").val(), 10);
	if (isNaN(age) || age < 0 || age > 100) {
		toastr.error("Please enter a valid age (up to 90 years)");
		return;
	}

	if (country === "") {
		toastr.error("Please Select a country");
		return;
	}

	if (province === "") {
		toastr.error("Please Select a province");
		return;
	}

	if (district === "") {
		toastr.error("Please Select a district");
		return;
	}

	if (municipality === "") {
		toastr.error("Please Select a municipality");
		return;
	}

	if (address.trim() === "") {
		toastr.error("Please enter a address");
		return;
	}

	// Validate gender field
	if (!gender) {
		toastr.error("Please select a gender");
		return;
	}

	// Validate language field
	if (languages.length === 0) {
		toastr.error("Please select at least one language");
		return;
	}

	$.ajax({
		url: "patient/storePatients",
		type: "POST",
		dataType: "json",
		data: {
			name: name,
			phonenumber: phonenumber,
			age: age,
			country: country,
			province: province,
			district: district,
			municipality: municipality,
			address: address,
			gender: gender,
			language: languages,
		},
		success: function (response) {
			console.log(response);
			getPatients();
			$("#myModal").modal("hide");
		},
	});
});
// Reset the form when the modal is hidden
$("#myModal").on("hidden.bs.modal", function () {
	$("#edit_id").val("");
	$("#form")[0].reset();
});
// Reset the form when the modal is hidden
$("#editModal").on("hidden.bs.modal", function () {
	$("#edit_id").val("");
	$("#form")[0].reset();
});
// Initialize DataTable
var dataTable;
// get all patients from the database
function getPatients() {
	$.ajax({
		url: "patient/getAll",
		type: "POST",
		dataType: "json",
		success: function (response) {
			console.log(response);

			var tbody;
			var Sno = 1;
			for (key in response) {
				tbody += "<tr>";
				tbody += "<td>" + Sno++;
				+"</td>";
				tbody += "<td>" + response[key]["patientid"] + "</td>";
				tbody += "<td>" + response[key]["name"] + "</td>";
				tbody += "<td>" + response[key]["age"] + "</td>";
				tbody += "<td>" + response[key]["gender"] + "</td>";
				tbody += "<td>" + response[key]["district"] + "</td>";
				tbody += "<td>" + response[key]["address"] + "</td>";
				tbody += "<td>" + response[key]["datetime"] + "</td>";
				tbody += `<td>
							<div class="d-flex">
								<a class="btn btn-secondary btn-sm me-1" id="edit" href="javascript:void(0);" value="${response[key]["patientid"]}"><i class="bx bx-edit-alt me-1"></i>Preview</a>
								<a href="javascript:void(0);" class="btn btn-info btn-sm" id="billing" value="${response[key]["patientid"]}"><i class="bx bx-trash me-1"></i>Reg&Billing</a>
							</div>
						</td>`;
				tbody += "</tr>";
			}

			// Destroy the existing DataTable instance
			if (dataTable) {
				dataTable.destroy();
			}

			// // Update the table body and reinitialize DataTable
			$("#patientinfo").html(tbody);
			dataTable = $("#user_data").DataTable({
				paging: true,
				pageLength: 10,
			});
		},
	});
}
getPatients();

// view the patients
$(document).on("click", "#edit", function (e) {
	e.preventDefault();
	var id = $(this).attr("value");
	// alert(id);

	$.ajax({
		url: "patient/editPatients",
		dataType: "json",
		type: "POST",
		data: { id: id },
		success: function (data) {
			console.log(data);

			$("#edit_id").val(data.patientid).prop("readonly", true);
			$("#editname").val(data.name).prop("readonly", true);
			$("#editphonenumber").val(data.mobilenumber).prop("readonly", true);
			$("#editage").val(data.age).prop("readonly", true).prop("readonly", true);
			$("#editcountry").val(data.country).prop("disabled", true);
			$("#editprovince").val(data.province).prop("disabled", true);
			$("#editcountry").val(data.country).prop("disabled", true);
			$("#editmunicipality").val(data.municipality).prop("disabled", true);
			$("#editaddress").val(data.address).prop("readonly", true);
			$("input[name='editgender']").prop("disabled", true);
			if (data.gender == "Male") {
				$("#editmale").prop("checked", true);
			} else if (data.gender == "Female") {
				$("#editfemale").prop("checked", true);
			}

			var selectedLanguages = JSON.parse(data.language);
			// alert(selectedLanguages);

			$("input[name='editlanguage']")
				.prop("checked", false)
				.prop("disabled", true);

			for (var i = 0; i < selectedLanguages.length; i++) {
				$("input[data-lang='" + selectedLanguages[i] + "']").prop(
					"checked",
					true
				);
			}
			$("#myModal").modal("hide");
			$("#editModal").modal("show");

			$(document).off("click", "#edit");
		},
	});
});

$.getJSON("assets/json/country.json", function (response) {
	response.forEach(function (element) {
		$("#country").append(
			`<option value="${element.name}">${element.name}</option>`
		);
	});
});

$("#country").change(function () {
	var selectedCountry = $(this).val();

	// Clear previous options
	$("#province")
		.empty()
		.append('<option value="">---Select Province---</option>');

	// If selected country is Nepal, fetch province data
	if (selectedCountry === "Nepal") {
		// Fetch province data
		$.getJSON("assets/json/provincedistrict.json", function (response) {
			console.log("province" + response);
			response.forEach(function (elem) {
				$("#province").append(
					`<option value="${elem.province}">${elem.province}</option>`
				);
			});
		});
	} else {
		// If selected country is not Nepal, display "Others" option for province
		$("#province").append('<option value="others">Others</option>');
	}
});

$("#province").change(function () {
	var selectedProvince = $(this).val();

	// Clear previous options
	$("#district")
		.empty()
		.append(
			'<option value="">---Select District---</option>',
			'<option value="others">Others</option>'
		);

	// Fetch district data based on the selected province
	$.getJSON("assets/json/provincedistrict.json", function (response) {
		// console.log("province" + response);
		var district = response.find(function (elem) {
			return elem.province === selectedProvince;
		});

		// Populate the district dropdown
		if (district) {
			district.districts.forEach(function (data) {
				$("#district").append(`<option value=" ${data} ">${data}</option>`);
			});
		}
	});
});

$("#district").change(function () {
	var selectedDistrict = $(this).val();

	// Clear previous options
	$("#municipality")
		.empty()
		.append(
			'<option value="">---Select Municipality---</option>',
			'<option value="others">Others</option>'
		);

	// Fetch municipality data based on the selected district
	$.getJSON("assets/json/municipality.json", function (response) {
		console.log(response);
		console.log("selectedDistrict::", selectedDistrict);

		var district = response.find(function (elem) {
			console.log(elem.district);
			return elem.district.trim() === selectedDistrict.trim();
		});

		console.log("Found District:", district);

		// Populate the municipality dropdown
		if (district) {
			district.municipalities.forEach(function (municipality) {
				$("#municipality").append(
					`<option value="${municipality}">${municipality}</option>`
				);
			});
		}
	});
});

$(document).on("click", "#billing", function (e) {
	e.preventDefault();
	var id = $(this).attr("value");
	// alert(id);

	$.ajax({
		url: "patient/getPatientId",
		data: { id: id },
		dataType: "json",
		type: "POST",
		success: function (data) {
			// console.log(data);
			$("#patientId").val(data.id).prop("readonly", true);
			$("#datetime").val(data.date).prop("readonly", true);
		},
	});

	$("#billModal").modal("show");
});

// add button clone and remove button and all the mathematical calculation
$(document).ready(function () {
	var rowCounter = 1; // Counter variable for generating unique IDs
	// toggleRemoveButton();

	$(document).on("click", ".addRowBtn", function () {
		var lastRow = $("table tbody tr:last");
		var newRow = lastRow.clone();

		// Generate a unique ID for the new row
		var newRowId = "row" + rowCounter;
		newRow.attr("id", newRowId);

		// Increment the row counter
		rowCounter++;

		newRow.find("input").val(""); // Clear input values in the new row
		lastRow.after(newRow); // Append the new row after the last row

		// Hide the "Add" button in the previous row
		lastRow.find(".addRowBtn").hide();

		// Show the "Remove" button in the previous row
		lastRow.find(".removeRowBtn").show();
	});

	// Remove button click event
	$(document).on("click", ".removeRowBtn", function () {
		var rowCount = $("table tbody tr").length;
		var removeButtonRow = $(this).closest("tr");

		if (rowCount > 1 && !removeButtonRow.hasClass("add-row")) {
			removeButtonRow.remove(); // Remove the current row
			calculateTotal();
		}

		// Show the "Add" button in the last remaining row
		$("table tbody tr:last .addRowBtn").show();
	});

	// Keyup event for calculating price
	$(document).on("keyup", "input.quantity, #unitPrice", function () {
		var row = $(this).closest("tr");
		var quantity = parseFloat(row.find(".quantity").val());
		var unitPrice = parseFloat(row.find(".unitPrice").val());
		if (!isNaN(quantity) && !isNaN(unitPrice)) {
			var price = quantity * unitPrice;
			row.find(".price").val(price.toFixed(2));
		}
		calculateTotal();
	});

	// Event handler for keyup event on discount percent input
	$("#DiscountPercent").on("keyup", function () {
		calculateTotal();
	});
});

function calculateTotal() {
	var subTotal = 0;

	$("input.price").each(function () {
		var price = parseFloat($(this).val());
		if (!isNaN(price)) {
			subTotal += price;
		}
	});

	var discountPercent = parseFloat($("#DiscountPercent").val());
	var discountAmount = subTotal * (discountPercent / 100);
	var netTotal = subTotal - discountAmount;

	$("#subTotal").val(subTotal.toFixed(2));
	$("#DiscountAmount").val(discountAmount.toFixed(2));
	$("#netTotal").val(netTotal.toFixed(2));
}

// add the billing information and test items
$(document).on("click", "#saveTestItems", function (e) {
	e.preventDefault();
	// alert();

	var id = $("#patientId").val();
	var billing_date = $("#datetime").val();
	var testItems = $("input[name='testItems[]']")
		.map(function () {
			return $(this).val();
		})
		.get();
	// .join("");
	if (
		testItems.length === 0 ||
		testItems.filter((item) => item.trim() !== "").length === 0
	) {
		toastr.error("Please enter a Test Items");
		return;
	}

	var quantity = $("input[name='quantity[]']")
		.map(function () {
			return $(this).val();
		})
		.get();
	// .join("");

	if (quantity == "") {
		toastr.error("Please enter a Quantity");
		return;
	}
	var unitPrice = $("input[name='unitPrice[]']")
		.map(function () {
			return $(this).val();
		})
		.get();
	// .join("");
	if (unitPrice === "") {
		toastr.error("Please enter a Unit price");
		return;
	}
	var price = $("input[name='price[]']")
		.map(function () {
			return $(this).val();
		})
		.get();
	// .join("");
	if (price === "") {
		toastr.error("Please enter a price");
		return;
	}
	var discountPercentage = $("#DiscountPercent").val();
	if (!discountPercentage) {
		toastr.error("Please enter a Discount percentage between 0 and 100");
		return;
	}
	var discountAmount = $("#DiscountAmount").val();
	var subTotal = $("#subTotal").val();
	var netTotal = $("#netTotal").val();

	alert(id);
	alert(billing_date);
	alert(testItems);
	alert(quantity);
	alert(unitPrice);
	alert(price);
	alert(discountPercentage);
	alert(discountAmount);
	alert(subTotal);
	alert(netTotal);
	// console.log(quantity);

	$.ajax({
		url: "test/storeAll",
		dataType: "json",
		type: "POST",
		data: {
			patient_id: id,
			billingDate: billing_date,
			testItems: testItems,
			quantity: quantity,
			unitPrice: unitPrice,
			price: price,
			discountPercentage: discountPercentage,
			discountAmount: discountAmount,
			subTotal: subTotal,
			netTotal: netTotal,
		},
		success: function (response) {
			console.log(response);
			$("#billModal").modal("hide");
		},
	});
});

// Reset the form when the modal is hidden
$("#billModal").on("hidden.bs.modal", function () {
	$("#testItems").val(""); // Clear the test items field
	$("#quantity").val(""); // Clear the quantity field
	$("#unitPrice").val(""); // Clear the unit price field
	$("#price").val(""); // Clear the price field
	$("#DiscountPercent").val(""); // Clear the price field
});

// Billing Information
$(document).on("click", "#editBill", function (e) {
	e.preventDefault();
	var id = $(this).attr("value");
	// alert(id);

	$.ajax({
		url: "test/editBill",
		type: "POST",
		dataType: "json",
		data: { id: id },
		success: function (data) {
			console.log(data);
			$("#patient_id").text(data[0].patient_id);
			$("#name").text(data[0].name);
			$("#date").text(data[0].billing_date);
			$("#billno").text(data[0].id);

			var tableBody = $("#invoice_data");
			tableBody.empty();
			$.each(data, function (index, item) {
				var row = $("<tr>");
				row.append($("<td>").text(item.test_items));
				row.append($("<td>").text(item.quantity));
				row.append($("<td>").text(item.unit_price));
				row.append($("<td>").text(item.price));
				tableBody.append(row);
			});

			// Update other HTML elements with relevant data
			$("#subTotal").text(data[0].sub_total);
			$("#discount").text(data[0].discount_amount);
			$("#netTotal").text(data[0].net_total);

			// $(document).off("click", "#editBill");
		},
	});
});
$("#staticBackdrop").on("hidden.bs.modal", function () {
	$("#form")[0].reset();
});
// $(document).ready(function () {});


