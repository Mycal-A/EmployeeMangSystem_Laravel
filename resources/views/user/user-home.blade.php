<x-layout>

    <div class="container mt-4 row g-3 mx-auto">
        <h1>Edit Employee</h1>

        <form action="/employee/update/{{$employee->id}}" method="post" id="editForm">
            @csrf
            @method('PATCH')

            <div class="row g-3 mx-auto">
                <div class="col-md-3">
                    <x-form.label name="employee id" />
                    <input type="text" name="id" id="id" class="form-control" value="{{ $employee->id }}" required
                        readonly>
                    <x-form.errors name="id" />
                </div>

                <div class="col-md-3">
                    <x-form.label name="name" />
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{old('name',$employee->name) }}" required>

                    <x-form.errors name="name" />
                </div>

                <div class="col-md-3">
                    <x-form.label name="email" />
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{ old('email',$employee->email) }}" required>

                    <x-form.errors name="email" />
                </div>

                <div class="col-md-3">
                    <x-form.label name="password" />
                    <input type="password" name="password" id="password" class="form-control"
                        placeholder="Enter only to update new password">
                    <x-form.errors name="password " />
                </div>

                <div class=" col-md-3">
                    <x-form.label name="location" />
                    <input type="text" name="location" id="location" class="form-control"
                        value="{{ old('location',$employee->location) }}" required>

                    <x-form.errors name="location" />
                </div>

                <div class="col-md-3">
                    <x-form.label name="salary" />
                    <input type="number" name="salary" id="salary" class="form-control"
                        value="{{ old('salary',$employee->salary) }}" required readonly>

                    <x-form.errors name="salary" />
                </div>

                <div class="col-md-3">
                    <x-form.label name="role" />
                    <input type="text" name="role" id="role" class="form-control"
                        value="{{ old('role',$employee->role) }}" required readonly>

                    <x-form.errors name="role" />
                </div>

                <hr class="mt-4 mb-4">

                <h3 class="text-center">Family Details</h3>
                <div class="container row g-3 mx-auto" id="family-details-container">
                    @foreach($employee->families as $index => $family)
                    <div class="family-details-section" data-index="{{ $index }}">
                        <div class="row g-3 mx-auto">
                            <input type="hidden" name="families[{{ $index }}][id]" class="form-control"
                                value="{{ $family->id ?: old('families.' . $index . '.id', null) }}"
                                placeholder="Enter Family ID">
                            <div class="col-md-4">
                                <label for="inputAddress" class="form-label">Name</label>
                                <input type="text" name="families[{{ $index }}][name]" class="form-control"
                                    value="{{ $family->name ?: old('families.' . $index . '.name', null) }}"
                                    placeholder="Enter Name" required>
                            </div>
                            <div class="col-md-4">
                                <label for="inputAddress" class="form-label">Relationship</label>
                                <input type="text" name="families[{{ $index }}][relationship]" class="form-control"
                                    value="{{ $family->relationship ?: old('families.' . $index . '.relationship', null) }}"
                                    placeholder="Enter Relationship" required>
                            </div>
                            <div class="col-md-4">
                                <label for="inputAddress" class="form-label">DOB</label>
                                <input type="text" name="families[{{ $index }}][dob]" class="form-control"
                                    value="{{ $family->dob ?: old('families.' . $index . '.dob', null) }}"
                                    placeholder="YYYY-MM-DD" required>
                            </div>
                        </div>

                        <div>
                            <button type="button" class="btn btn-danger remove-family-details"
                                data-family-record-id="{{ $family->id }}">Delete</button>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="md-3 text-center">
                    <button type="button" id="add-family-details" class="btn btn-success">Add Family Details</button>
                </div>

                <hr>
                <!-- Education Details Section -->
                <h3 class="text-center">Education</h3>
                <div class="container row g-3 mx-auto" id="education-details-container">
                    @foreach($employee->educations as $index => $educationDetail)
                    <div class="education-details-section" data-index="{{ $index }}">
                        <div class="row g-3 mx-auto">
                            <input type="hidden" name="educations[{{ $index }}][id]" class="form-control"
                                value="{{ $educationDetail['id'] ?: old('educations.' . $index . '.id', null) }}"
                                placeholder="Enter Education ID">
                            <div class="col-md-3">
                                <label for="inputAddress" class="form-label">Course</label>
                                <input type="text" name="educations[{{ $index }}][course]" class="form-control"
                                    value="{{ $educationDetail['course'] ?: old('educations.' . $index . '.course', null) }}"
                                    placeholder="Enter Education" required>
                            </div>
                            <div class="col-md-3">
                                <label for="inputAddress" class="form-label">Institution</label>
                                <input type="text" name="educations[{{ $index }}][institution]" class="form-control"
                                    value="{{ $educationDetail['institution'] ?: old('educations.' . $index . '.institution', null) }}"
                                    placeholder="Enter Institute Name" required>
                            </div>
                            <div class="col-md-3">
                                <label for="inputAddress" class="form-label">CGPA</label>
                                <input type="text" name="educations[{{ $index }}][cgpa]" class="form-control"
                                    value="{{ $educationDetail['cgpa'] ?: old('educations.' . $index . '.cgpa', null) }}"
                                    placeholder="Enter CGPA" required>
                            </div>
                            <div class="col-md-3">
                                <label for="inputAddress" class="form-label">Graduation Year</label>
                                <input type="text" name="educations[{{ $index }}][graduation_year]" class="form-control"
                                    value="{{ $educationDetail['graduation_year'] ?: old('educations.' . $index . '.graduation_year', null) }}"
                                    placeholder="Enter Graduation Year" required>
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger remove-education-details"
                            data-education-record-id="{{ $educationDetail->id }}">Delete</button>
                    </div>
                    @endforeach
                </div>
                <div class="md-3 text-center">
                    <button type="button" id="add-education-details" class="btn btn-success">Add Education</button>
                </div>
                <hr>

                <h3 class="text-center">Experience Details</h3>
                <div class="container row g-3 mx-auto" id="experience-details-container">
                    @foreach($employee->experiences ?? [] as $index => $experienceDetail)
                    <div class="experience-details-section" data-index="{{ $index }}">
                        <div class="row g-3 mx-auto">
                            <input type="hidden" name="experiences[{{ $index }}][id]" class="form-control"
                                value="{{ $experienceDetail['id'] ?: old('experiences.' . $index . '.id', null) }}"
                                placeholder="Enter Experience ID">
                            <div class="col-md-4">
                                <label for="inputAddress" class="form-label">Company Name</label>
                                <input type="text" name="experiences[{{ $index }}][company]" class="form-control"
                                    value="{{ $experienceDetail['company'] ?: old('experiences.' . $index . '.company', null) }}"
                                    placeholder="Enter Company Name" required>
                            </div>
                            <div class="col-md-4">
                                <label for="inputAddress" class="form-label">Role</label>
                                <input type="text" name="experiences[{{ $index }}][role]" class="form-control"
                                    value="{{ $experienceDetail['role'] ?: old('experiences.' . $index . '.role', null) }}"
                                    placeholder="Enter Role" required>
                            </div>
                            <div class="col-md-4">
                                <label for="inputAddress" class="form-label">Year Of Experience</label>
                                <input type="text" name="experiences[{{ $index }}][year_of_experience]"
                                    class="form-control"
                                    value="{{ $experienceDetail['year_of_experience'] ?: old('experiences.' . $index . '.year_of_experience', null) }}"
                                    placeholder="Enter Year Of Experience" required>
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger remove-experience-details"
                            data-experience-record-id="{{ $experienceDetail->id }}">Delete</button>
                    </div>
                    @endforeach
                </div>
                <div class="md-3 text-center">
                    <button type="button" id="add-experience-details" class="btn btn-success">Add Experience
                        Details</button>
                </div>

                <div class="md-3 text-center">
                    <button type="button" class="btn btn-primary" id="edit-button">Edit</button>
                    <button type="submit" class="btn btn-primary" style="display: none;" id="save-button">Save</button>
                    <input type="hidden" id="editing-state" value="0">
                </div>
        </form>
    </div>

</x-layout>

@include('components.emp-update-script')


<script>
    // Function to enable editing mode
    function enableEditing() {
        $("input").prop("disabled", false);
        $("#edit-button").hide();
        $("#save-button").show();
        $("#editing-state").val("1");
    }

    // Function to disable editing mode
    function disableEditing() {
        $("input").prop("disabled", true);
        $("#edit-button").show();
        $("#save-button").hide();
        $("#editing-state").val("0");
    }

    // Toggle Edit/Save mode when the "Edit" button is clicked
    $("#edit-button").click(function () {
        enableEditing();
    });

    // Initially disable form fields and show the "Edit" button
    disableEditing();

</script>
