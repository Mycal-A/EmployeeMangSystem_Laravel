<!-- Education Details Section -->
<h3 class="text-center">Education</h3>
<div class="container row g-3 mx-auto" id="education-details-container">
    @foreach($employee->educations as $index => $educationDetail)
    <div class="education-details-section" data-index="{{ $index }}">
        <div class="row g-3 mx-auto">
            <input type="hidden" name="educations[{{ $index }}][employee_id]" class="form-control"
                value="{{ $educationDetail['employee_id'] ?: old('education.' . $index . '.employee_id', null) }}"
                placeholder="Enter Education ID">
            <div class="col-md-3">
                <label for="inputAddress" class="form-label">Course</label>
                <input type="text" name="educations[{{ $index }}][course]" class="form-control"
                    value="{{ $educationDetail['course'] ?: old('education.' . $index . '.course', null) }}"
                    placeholder="Enter Education" required>
            </div>
            <div class="col-md-3">
                <label for="inputAddress" class="form-label">Institution</label>
                <input type="text" name="educations[{{ $index }}][institution]" class="form-control"
                    value="{{ $educationDetail['institution'] ?: old('education.' . $index . '.institution', null) }}"
                    placeholder="Enter Institute Name" required>
            </div>
            <div class="col-md-3">
                <label for="inputAddress" class="form-label">CGPA</label>
                <input type="text" name="educations[{{ $index }}][cgpa]" class="form-control"
                    value="{{ $educationDetail['cgpa'] ?: old('education.' . $index . '.cgpa', null) }}"
                    placeholder="Enter CGPA" required>
            </div>
            <div class="col-md-3">
                <label for="inputAddress" class="form-label">Graduation Year</label>
                <input type="text" name="educations[{{ $index }}][graduation_year]" class="form-control"
                    value="{{ $educationDetail['graduation_year'] ?: old('education.' . $index . '.graduation_year', null) }}"
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
