<script>
    // Function to add a new section
    function addSection(container, sectionClass, namePrefix) {
        var $section = $(sectionClass + ":first").clone();
        $section.find("input").val("").each(function () {
            var currentName = $(this).attr("name");
            $(this).attr("name", currentName.replace(/\[(\d+)\]/, "[" + container.children(sectionClass)
                .length + "]"));
        });
        container.append($section);
    }

    // Function to update the input names
    function updateSectionNames(container, sectionClass) {
        container.children(sectionClass).each(function (index) {
            $(this).find("input").each(function () {
                var currentName = $(this).attr("name");
                $(this).attr("name", currentName.replace(/\[(\d+)\]/, "[" + index + "]"));
            });
        });
    }

    // Add Education Details Section
    $("#add-education-details").click(function () {
        addSection($("#education-details-container"), ".education-details-section", "educations");
    });

    // Remove Education Details Section
    $(document).on("click", ".remove-education-details", function () {
        var $section = $(this).closest(".education-details-section");
        if ($section.siblings(".education-details-section").length > 0) {
            $section.remove();
            updateSectionNames($("#education-details-container"), ".education-details-section");
        }
    });

    // Add Family Details Section
    $("#add-family-details").click(function () {
        addSection($("#family-details-container"), ".family-details-section", "families");
    });

    // Remove Family Details Section
    $(document).on("click", ".remove-family-details", function () {
        var $section = $(this).closest(".family-details-section");
        if ($section.siblings(".family-details-section").length > 0) {
            $section.remove();
            updateSectionNames($("#family-details-container"), ".family-details-section");
        }
    });

    // Add Experience Details Section
    $("#add-experience-details").click(function () {
        addSection($("#experience-details-container"), ".experience-details-section", "experiences");
    });

    // Remove Experience Details Section
    $(document).on("click", ".remove-experience-details", function () {
        var $section = $(this).closest(".experience-details-section");
        if ($section.siblings(".experience-details-section").length > 0) {
            $section.remove();
            updateSectionNames($("#experience-details-container"), ".experience-details-section");
        }
    });

</script>
