@props(['employee'])

<h3 class="text-center">Family Details</h3>
<div class="container row g-3 mx-auto" id="family-details-container">
    @foreach($employee->families as $index => $family)
    <div class="family-details-section" data-index="{{ $index }}">
        <div class="row g-3 mx-auto">
            <input type="hidden" name="families[{{ $index }}][employee_id]" class="form-control"
                value="{{ $family->employee_id ?: old('families.' . $index . '.employee_id', null) }}"
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
                    value="{{ $family->dob ?: old('families.' . $index . '.dob', null) }}" placeholder="YYYY-MM-DD"
                    required>
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
