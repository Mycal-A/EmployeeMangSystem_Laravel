<!-- resources/views/admin/edit-employee.blade.php -->
<x-layout>
    <a href="/adminHome" class="text-blue-500 underline btn btn-outline-primary">Go Back...</a>
    <div class="container mt-4 row g-3 mx-auto">
        <h1>Edit Employee</h1>

        <form action="/admin/employee/update/{{$employee->id}}" method="post">
            @csrf
            @method('PATCH')

            <x-employee-details :employee="$employee" />
            <x-family-details :employee="$employee" />
            <x-education-details :employee="$employee" />
            <x-experience-details :employee="$employee" />

            <div class="md-3 text-center">
                <button type="submit" class="btn btn-primary">Update Employee</button>
            </div>
        </form>
    </div>

</x-layout>

@include('components.emp-update-script')
