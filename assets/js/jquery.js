$(document).ready(function () {
	$("#form").validate();

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
		name = name.replace(/[^A-Za-z]/g, "");

		// Update the value of the name field
		$(this).val(name);
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
	var name = $("#name").val();
	if (name.trim() === "") {
		toastr.error("Please enter a name");
		return;
	}

	// Check if name contains any numeric characters
	if (/\d/.test(name)) {
		toastr.error("Name cannot contain any numbers");
		return;
	}

	var phonenumber = $("#phonenumber").val();
	if (phonenumber.trim() === "") {
		toastr.error("Please enter a phonenumber");
		return;
	}
	// // Check if phone number has exactly 10 digits
	// if (phonenumber.length !== 10 || isNaN(phonenumber)) {
	// 	toastr.error("Phone number must contain exactly 10 digits only numbers");
	// 	return;
	// }

	var age = $("#age").val();
	if (age.trim() === "") {
		toastr.error("Please enter a age");
		return;
	}
	// Validate age field
	var age = parseInt($("#age").val(), 10);
	if (isNaN(age) || age < 0 || age > 90) {
		toastr.error("Please enter a valid age (up to 90 years)");
		return;
	}

	var country = $("#country").val();
	if (country === "") {
		toastr.error("Please Select a country");
		return;
	}

	var province = $("#province").val();
	if (province === "") {
		toastr.error("Please Select a province");
		return;
	}

	var district = $("#district").val();
	if (district === "") {
		toastr.error("Please Select a district");
		return;
	}

	var municipality = $("#municipality").val();
	if (municipality === "") {
		toastr.error("Please Select a municipality");
		return;
	}

	var address = $("#address").val();
	if (address.trim() === "") {
		toastr.error("Please enter a address");
		return;
	}

	// Validate gender field
	var gender = $("input[name='gender']:checked").val();
	if (!gender) {
		toastr.error("Please select a gender");
		return;
	}

	// Validate language field
	var languages = [];
	$("input[name='language']:checked").each(function () {
		languages.push($(this).val());
	});
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

			// if (response.error) {
			// 	if (response.name_error != "") {
			// 		$("#name_error").html(response.name_error);
			// 	}
			// 	if (response.number_error != "") {
			// 		$("#number_error").html(response.number_error);
			// 	}
			// }
		},
	});
});

// Reset the form when the modal is hidden
$("#editModal").on("hidden.bs.modal", function () {
	$("#edit_id").val("");
	$("#form")[0].reset();
});

// get all patients from the database
function getPatients() {
	$.ajax({
		url: "patient/getAll",
		type: "POST",
		dataType: "json",
		success: function (response) {
			console.log(response);

			var tbody;
			for (key in response) {
				tbody += "<tr>";
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
			$("#patientinfo").html(tbody);
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

			// Add off-click event
			// $(document).on("click", function (e) {
			// 	if (
			// 		!$(e.target).closest("#editModal").length &&
			// 		!$(e.target).is("#editModal")
			// 	) {
			// 		// Clicked outside the modal form
			// 		// Perform any desired action here
			// 		console.log("Clicked outside the modal form");
			// 	}
			// });
		},
	});
});

$.getJSON("assets/json/country.json", function (response) {
	response.forEach(function (elem) {
		$("#country").append(`<option value="${elem.name}">${elem.name}</option>`);
	});
});

$.getJSON("assets/json/provincedistrict.json", function (response) {
	response.forEach(function (elem) {
		$("#province").append(
			`<option value="${elem.province}">${elem.province}</option>`
		);
	});
});

$("#province").change(function () {
	var selectedProvince = $(this).val();

	// Clear previous options
	$("#district")
		.empty()
		.append('<option value="">---Select District---</option>');

	// Fetch district data based on the selected province
	$.getJSON("assets/json/provincedistrict.json", function (response) {
		console.log("province" + response);
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
		.append('<option value="">---Select Municipality---</option>');

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

	$("#billModal").modal("show");
});

$(document).ready(function () {
	var rowCounter = 1; // Counter variable for generating unique IDs

	// Add button click event
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
	});

	// Remove button click event
	$(document).on("click", ".removeRowBtn", function () {
		var rowCount = $("table tbody tr").length;
		if (rowCount > 1) {
			$(this).closest("tr").remove(); // Remove the current row
		}
	});

	// Keyup event for calculating price
	$(document).on("keyup", "input.quantity, input.unitPrice", function () {
		var row = $(this).closest("tr");
		var quantity = parseFloat(row.find(".quantity").val());
		var unitPrice = parseFloat(row.find(".unitPrice").val());
		if (!isNaN(quantity) && !isNaN(unitPrice)) {
			var price = quantity * unitPrice;
			row.find(".price").val(price.toFixed(2));
		}
	});

	// Keyup event for calculating subtotal
	$(document).on(
		"keyup",
		"input.quantity, input.unitPrice, input.discountPercentage",
		function () {
			var row = $(this).closest("tr");
			var quantity = parseFloat(row.find(".quantity").val());
			var unitPrice = parseFloat(row.find(".unitPrice").val());
			var discountPercentage = parseFloat(
				row.find(".discountPercentage").val()
			);
			if (!isNaN(quantity) && !isNaN(unitPrice) && !isNaN(discountPercentage)) {
				var price = quantity * unitPrice;
				var discountAmount = price * (discountPercentage / 100);
				var subtotal = price - discountAmount;

				row.find(".price").val(price.toFixed(2));
				row.find(".discountAmount").val(discountAmount.toFixed(2));
				row.find(".subTotal").val(subtotal.toFixed(2));
			}
		}
	);
});
