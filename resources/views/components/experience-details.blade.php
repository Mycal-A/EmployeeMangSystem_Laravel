<h3 class="text-center">Experience Details</h3>
<div class="container row g-3 mx-auto" id="experience-details-container">
    @foreach($employee->experiences ?? [] as $index => $experienceDetail)
    <div class="experience-details-section" data-index="{{ $index }}">
        <div class="row g-3 mx-auto">
            <input type="hidden" name="experiences[{{ $index }}][employee_id]" class="form-control"
                value="{{ $experienceDetail['employee_id'] ?: old('experiences.' . $index . '.employee_id', null) }}"
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
                <input type="text" name="experiences[{{ $index }}][year_of_experience]" class="form-control"
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
    <button type="button" id="add-experience-details" class="btn btn-success">Add Experience Details</button>
</div>
