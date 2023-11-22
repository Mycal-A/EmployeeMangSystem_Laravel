<x-layout>
    <style>
        .button-container {
            display: flex;
            justify-content: flex-end;
        }

        .button-container button {
            margin-left: 10px;
            /* Adjust the margin as needed */
        }

    </style>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="button-container">
                    <form id="bulkUploadForm" action="/admin/bulkUpload" method="POST" enctype="multipart/form-data">
                        @csrf
                        <button type="button" class="btn btn-outline-success" onclick="chooseFile()">Bulk Upload</button>
                        <input type="file" name="file" id="fileInput" accept=".xlsx, .csv, .txt" style="display: none" required>
                    </form>
                    
                    <script>
                        function chooseFile() {
                            document.getElementById('fileInput').click();
                        }
                    
                        // Add an event listener for the file input change event
                        document.getElementById('fileInput').addEventListener('change', function () {
                            // Submit the form when a file is selected
                            document.getElementById('bulkUploadForm').submit();
                        });
                    </script>

                    <form action="/admin/download/employeeDetails">
                        @csrf
                        <button type="submit" class="btn btn-success">Download</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="ml-3">
        <a href="/createUser" type="button" class="btn btn-success"
            style="--bs-btn-padding-y: 0.5rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: 0.875rem;">
            Add User
        </a>
    </div>

    <div class="mt-6 mt-md-4">

        <table class="table table-striped table-hover ">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Location</th>
                    <th>Salary</th>
                    <th>Role</th>
                    <th>Edit</th>
                    <th>Access</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->employee_id }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->location }}</td>
                    <td>{{ $employee->salary }}</td>
                    <td>{{ $employee->role }}</td>
                    <td><a href="/admin/edit/employee/{{$employee->id}}" class="btn btn-info">View</a></td>
                    <td>
                        <form action="/toggleAccess/{{$employee->id}}" method="POST"
                            onsubmit="return confirm('Are you sure you want to toggle access for this employee?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn {{ $employee->access ? 'btn-success' : 'btn-secondary' }}">
                                {{ $employee->access ? 'Enabled' : 'Disabled' }}
                            </button>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="/admin/emp/delete/{{ $employee->id }}"
                            onsubmit="return confirm('Are you sure you want to delete this employee?')">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</x-layout>
