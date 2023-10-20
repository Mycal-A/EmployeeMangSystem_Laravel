@props(['employee'])


<div class="row g-3 mx-auto">
    <div class="col-md-3">
        <x-form.label name="employee id" />
        <input type="text" name="id" id="id" class="form-control" value="{{ $employee->id }}" required readonly>

        <x-form.errors name="id" />
    </div>

    <div class="col-md-3">
        <x-form.label name="name" />
        <input type="text" name="name" id="name" class="form-control" value="{{old('name',$employee->name) }}" required>

        <x-form.errors name="name" />
    </div>

    <div class="col-md-3">
        <x-form.label name="email" />
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email',$employee->email) }}"
            required>

        <x-form.errors name="email" />
    </div>

    <div class="col-md-3">
        <x-form.label name="password" />
        <input type="password" name="password" id="password" class="form-control"
            placeholder=" Enter only to update new password">
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
            value="{{ old('salary',$employee->salary) }}" required>

        <x-form.errors name="salary" />
    </div>

    <div class="col-md-3">
        <x-form.label name="role" />
        <input type="text" name="role" id="role" class="form-control" value="{{ old('role',$employee->role) }}"
            required>

        <x-form.errors name="role" />
    </div>

    <hr class="mt-4 mb-4">
