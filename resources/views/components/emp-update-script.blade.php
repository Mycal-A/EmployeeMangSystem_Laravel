{{-- Experience --}}
<script>
    var experienceCounter = {{ count($employee->experiences) ?? 0 }};
    function addExperienceSection() {
        var $section = $('<div class="experience-details-section" data-index="' + experienceCounter + '">\
                            <div class="row g-3 mx-auto">\
                                <input type="hidden" name="experiences[' + experienceCounter + '][employee_id]" class="form-control" value="">\
                                <div class="col-md-4">\
                                    <label for="inputAddress" class="form-label">Company Name</label>\
                                    <input type="text" name="experiences[' + experienceCounter + '][company]" class="form-control" value="" placeholder="Enter Company Name" required>\
                                </div>\
                                <div class="col-md-4">\
                                    <label for="inputAddress" class="form-label">Role</label>\
                                    <input type="text" name="experiences[' + experienceCounter + '][role]" class="form-control" value="" placeholder="Enter Role" required>\
                                </div>\
                                <div class="col-md-4">\
                                    <label for="inputAddress" class="form-label">Year Of Experience</label>\
                                    <input type="text" name="experiences[' + experienceCounter + '][year_of_experience]" class="form-control" value="" placeholder="Enter Year Of Experience" required>\
                                </div>\
                            </div>\
                            <button type="button" class="btn btn-danger remove-experience-details">Delete</button>\
                        </div>');

        $("#experience-details-container").append($section);
        experienceCounter++;
    }

    $("#add-experience-details").click(function () {
        addExperienceSection();
    });

    // Remove Experience Details Section
    $(document).on("click", ".remove-experience-details", function (event) {
        var container = $(this).closest(".experience-details-section");
        var recordId = $(this).data("experience-record-id");

        if (!recordId) {
            // If there is no record ID, just remove the form without confirmation
            container.remove();
            updateExperienceSectionIndexes(); // Update the indexes after removal
        } else {
            // Display a confirmation dialog
            var confirmDelete = window.confirm("Are you sure you want to delete this record?");

            if (!confirmDelete) {
                // If the user cancels, prevent the default behavior and stop propagation
                event.preventDefault();
                event.stopPropagation();
                console.log("Deletion canceled");
                return;
            }

            // Get the CSRF token value from the page
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Make a server request to delete the record, including the CSRF token in the headers
            $.ajax({
                url: "/admin/delete/experience/record/" + recordId,
                type: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (data) {
                    // Handle the response if needed
                    console.log(data);
                    container.remove();
                    updateExperienceSectionIndexes(); // Update the indexes after removal
                    // Display a message based on the status
                    if (data.status === 'success') {
                        alert(data.message); // You can replace this with a more user-friendly notification
                    } else {
                        alert(data.message); // You can replace this with a more user-friendly notification
                    }
                },
                error: function (error) {
                    console.error("Error deleting record:", error);
                }
            });
        }
    });

    // Function to update the indexes of existing experience sections
    function updateExperienceSectionIndexes() {
        $(".experience-details-section").each(function (index) {
            $(this).attr("data-index", index);
            $(this).find("input").each(function () {
                var currentName = $(this).attr("name");
                $(this).attr("name", currentName.replace(/\[(\d+)\]/, "[" + index + "]"));
            });
        });
        experienceCounter = $(".experience-details-section").length;
    }
</script>

{{-- Family --}}

<script>
    var familyCounter = {{ count($employee->families) ?? 0 }};
    function addFamilySection() {
        var $section = $('<div class="family-details-section" data-index="' + familyCounter + '">\
                                        <div class="row g-3 mx-auto">\
                                            <input type="hidden" name="families[' + familyCounter + '][employee_id]" class="form-control" value="" placeholder="Enter Family ID">\
                                            <div class="col-md-4">\
                                                <label for="inputAddress" class="form-label">Name</label>\
                                                <input type="text" name="families[' + familyCounter + '][name]" class="form-control" value="" placeholder="Enter Name" required>\
                                            </div>\
                                            <div class="col-md-4">\
                                                <label for="inputAddress" class="form-label">Relationship</label>\
                                                <input type="text" name="families[' + familyCounter + '][relationship]" class="form-control" value="" placeholder="Enter Relationship" required>\
                                            </div>\
                                            <div class="col-md-4">\
                                                <label for="inputAddress" class="form-label">DOB</label>\
                                                <input type="text" name="families[' + familyCounter + '][dob]" class="form-control" value="" placeholder="YYYY-MM-DD" required>\
                                            </div>\
                                        </div>\
                                        <div>\
                                            <button type="button" class="btn btn-danger remove-family-details">Delete</button>\
                                        </div>\
                                    </div>');

        $("#family-details-container").append($section);
        familyCounter++;
    }

    $("#add-family-details").click(function () {
        addFamilySection();
    });

    // Remove Family Details Section
    $(document).on("click", ".remove-family-details", function (event) {
        var container = $(this).closest(".family-details-section");
        var recordId = $(this).data("family-record-id");

        if (!recordId) {
            // If there is no record ID, just remove the form without confirmation
            container.remove();
            updateFamilySectionIndexes(); // Update the indexes after removal
        } else {
            // Display a confirmation dialog
            var confirmDelete = window.confirm("Are you sure you want to delete this record?");

            if (!confirmDelete) {
                // If the user cancels, prevent the default behavior and stop propagation
                event.preventDefault();
                event.stopPropagation();
                console.log("Deletion canceled");
                return;
            }

            // Get the CSRF token value from the page
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Make a server request to delete the record, including the CSRF token in the headers
            $.ajax({
                url: "/admin/delete/family/record/" + recordId,
                type: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (data) {
                    // Handle the response if needed
                    console.log(data);
                    container.remove();
                    updateFamilySectionIndexes(); // Update the indexes after removal
                    // Display a message based on the status
                    if (data.status === 'success') {
                        alert(data
                        .message); // You can replace this with a more user-friendly notification
                        container.remove();
                        updateFamilySectionIndexes(); // Update the indexes after removal
                    } else {
                        alert(data
                        .message); // You can replace this with a more user-friendly notification
                    }
                },
                error: function (error) {
                    console.error("Error deleting record:", error);
                }
            });
        }
    });

    // Function to update the indexes of existing family sections
    function updateFamilySectionIndexes() {
        $(".family-details-section").each(function (index) {
            $(this).attr("data-index", index);
            $(this).find("input").each(function () {
                var currentName = $(this).attr("name");
                $(this).attr("name", currentName.replace(/\[(\d+)\]/, "[" + index + "]"));
            });
        });
        familyCounter = $(".family-details-section").length;
    }

</script>

{{-- Education --}}

<script>
    var educationCounter = {{ count($employee->families) ?? 0 }};

    function addEducationSection() {
        var $section = $('<div class="education-details-section" data-index="' + educationCounter + '">\
                            <div class="row g-3 mx-auto">\
                                <input type="hidden" name="educations[' + educationCounter + '][employee_id]" class="form-control" value="" placeholder="Enter Education ID">\
                                <div class="col-md-3">\
                                    <label for="inputAddress" class="form-label">Course</label>\
                                    <input type="text" name="educations[' + educationCounter + '][course]" class="form-control" value="" placeholder="Enter Education" required>\
                                </div>\
                                <div class="col-md-3">\
                                    <label for="inputAddress" class="form-label">Institution</label>\
                                    <input type="text" name="educations[' + educationCounter + '][institution]" class="form-control" value="" placeholder="Enter Institute Name" required>\
                                </div>\
                                <div class="col-md-3">\
                                    <label for="inputAddress" class="form-label">CGPA</label>\
                                    <input type="text" name="educations[' + educationCounter + '][cgpa]" class="form-control" value="" placeholder="Enter CGPA" required>\
                                </div>\
                                <div class="col-md-3">\
                                    <label for="inputAddress" class="form-label">Graduation Year</label>\
                                    <input type="text" name="educations[' + educationCounter + '][graduation_year]" class="form-control" value="" placeholder="Enter Graduation Year" required>\
                                </div>\
                            </div>\
                            <button type="button" class="btn btn-danger remove-education-details">Delete</button>\
                        </div>');

        $("#education-details-container").append($section);
        educationCounter++;
    }

    $("#add-education-details").click(function () {
        addEducationSection();
    });

    // Remove Education Details Section
    $(document).on("click", ".remove-education-details", function (event) {
        var container = $(this).closest(".education-details-section");
        var recordId = $(this).data("education-record-id");

        if (!recordId) {
            // If there is no record ID, just remove the form without confirmation
            container.remove();
            updateEducationSectionIndexes(); // Update the indexes after removal
        } else {
            // Display a confirmation dialog
            var confirmDelete = window.confirm("Are you sure you want to delete this record?");

            if (!confirmDelete) {
                // If the user cancels, prevent the default behavior and stop propagation
                event.preventDefault();
                event.stopPropagation();
                console.log("Deletion canceled");
                return;
            }

            // Get the CSRF token value from the page
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Make a server request to delete the record, including the CSRF token in the headers
            $.ajax({
                url: "/admin/delete/education/record/" + recordId,
                type: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (data) {
                    // Handle the response if needed
                    console.log(data);
                    container.remove();
                    updateEducationSectionIndexes(); // Update the indexes after removal
                    // Display a message based on the status
                    if (data.status === 'success') {
                        alert(data
                            .message); // You can replace this with a more user-friendly notification
                        container.remove();
                        updateEducationSectionIndexes(); // Update the indexes after removal
                    } else {
                        alert(data
                            .message); // You can replace this with a more user-friendly notification
                    }
                },
                error: function (error) {
                    console.error("Error deleting record:", error);
                }
            });
        }
    });

    // Function to update the indexes of existing education sections
    function updateEducationSectionIndexes() {
        $(".education-details-section").each(function (index) {
            $(this).attr("data-index", index);
            $(this).find("input").each(function () {
                var currentName = $(this).attr("name");
                $(this).attr("name", currentName.replace(/\[(\d+)\]/, "[" + index + "]"));
            });
        });
        educationCounter = $(".education-details-section").length;
    }
</script>
