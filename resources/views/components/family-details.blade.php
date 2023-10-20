@props(['employee'])

<h3 class="text-center">Family Details</h3>
<div class="container row g-3 mx-auto" id="family-details-container">
    @foreach($employee->families as $index => $family)
    <div class="family-details-section" data-index="{{ $index }}">
        <div class="row g-3 mx-auto">
            <input type="hidden" name="family[{{ $index }}][family_id]" class="form-control"
                value="{{ $family->family_id ?: old('family.' . $index . '.family_id', null) }}"
                placeholder="Enter Family ID">
            <div class="col-md-4">
                <label for="inputAddress" class="form-label">Name</label>
                <input type="text" name="family[{{ $index }}][family_name]" class="form-control"
                    value="{{ $family->family_name ?: old('family.' . $index . '.family_name', null) }}"
                    placeholder="Enter Name" required>
            </div>
            <div class="col-md-4">
                <label for="inputAddress" class="form-label">Relationship</label>
                <input type="text" name="family[{{ $index }}][relationship]" class="form-control"
                    value="{{ $family->relationship ?: old('family.' . $index . '.relationship', null) }}"
                    placeholder="Enter Relationship" required>
            </div>
            <div class="col-md-4">
                <label for="inputAddress" class="form-label">DOB</label>
                <input type="text" name="family[{{ $index }}][dob]" class="form-control"
                    value="{{ $family->dob ?: old('family.' . $index . '.dob', null) }}" placeholder="YYYY-MM-DD"
                    required>
            </div>
        </div>

        <div>
            <button type="button" class="btn btn-danger remove-family-details"
                data-family-record-id="{{ $family->family_id }}">Delete</button>
        </div>
    </div>
    @endforeach
</div>
<div class="md-3 text-center">
    <button type="button" id="add-family-details" class="btn btn-success">Add Family Details</button>
</div>
