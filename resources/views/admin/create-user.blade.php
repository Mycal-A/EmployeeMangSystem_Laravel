<x-layout>

    <a href="/adminHome" class="text-blue-500 underline btn btn-outline-primary">Go Back...</a>

    <form action="/createUser" method="POST">
        @csrf
        <h1 class="text-center">Employee Details</h1>
        <div class="container row g-3 mx-auto">
            <div class="col-md-6">
                <x-form.label name="name" />
                <x-form.input name="name" placeholder="Enter Name" />
                <x-form.errors name="name" />
            </div>
            <div class="col-md-6">
                <x-form.label name="email" />
                <x-form.input name="email" type="email" placeholder="Enter Email" />
                <x-form.errors name="email" />
            </div>
            <div class="col-md-6">
                <x-form.label name="password" />
                <x-form.input name="password" type="password" placeholder="Enter Password" />
                <x-form.errors name="password" />
            </div>
            <div class="col-md-6">
                <x-form.label name="location" />
                <x-form.input name="location" placeholder="Enter Location" />
                <x-form.errors name="location" />
            </div>
            <div class="col-md-6">
                <x-form.label name="role" />
                <x-form.input name="role" placeholder="Enter Role" />
                <x-form.errors name="role" />
            </div>
            <div class="col-md-3">
                <x-form.label name="salary" />
                <x-form.input name="salary" placeholder="Enter Salary" type="number" />
                <x-form.errors name="salary" />
            </div>
            <div class="col-md-3">
                <x-form.label name="access" />
                <select name="access" id="access" class="form-control">
                    <option value="0">False</option>
                    <option value="1">True</option>
                </select>

                <x-form.errors name="access" />
            </div>
        </div>
        <hr>

        <h3 class="text-center">Family Details</h3>
        <div class="container mx-auto text-center" id="family-details-container">
            <div class="family-details-section" data-index="0">
                <div class="row g-3 mx-auto">
                    <div class="col-md-4">
                        <x-form.label name="family_name" />
                        <x-form.input name="family[0][family_name]" placeholder="Enter Name" />
                        <x-form.errors name="family[0][family_name]" />
                    </div>
                    <div class="col-md-4">
                        <x-form.label name="relationship" />
                        <x-form.input name="family[0][relationship]" placeholder="Enter Relationship" />
                        <x-form.errors name="family[0][relationship]" />
                    </div>
                    <div class="col-md-4">
                        <x-form.label name="dob" />
                        <x-form.input name="family[0][dob]" placeholder="YYYY-MM-DD" />
                        <x-form.errors name="family[0][dob]" />
                    </div>
                    <div>
                        <button type="button" class="btn btn-sm btn-danger remove-family-details">Remove</button>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" id="add-family-details" class="btn btn-sm btn-success text-center">Add Member</button>
        <hr>

        <h3 class="text-center">Education Details</h3>
        <div class="container mx-auto text-center" id="education-details-container">
            <div class="education-details-section" data-index="0">
                <div class="row g-3 mx-auto">
                    <div class="col-md-3">
                        <x-form.label name="course" />
                        <x-form.input name="education[0][course]" placeholder="Enter Education" />
                        <x-form.errors name="education[0][course]" />
                    </div>
                    <div class="col-md-3">
                        <x-form.label name="institution" />
                        <x-form.input name="education[0][institution]" placeholder="Enter Institute Name" required />
                        <x-form.errors name="education[0][institution]" />
                    </div>
                    <div class="col-md-3">
                        <x-form.label name="cgpa" />
                        <x-form.input name="education[0][cgpa]" placeholder="Enter CGPA" required />
                        <x-form.errors name="education[0][cgpa]" />
                    </div>
                    <div class="col-md-3">
                        <x-form.label name="Graducation Year" />
                        <x-form.input name="education[0][graduation_year]" placeholder="Enter Graduation Year"
                            required />
                        <x-form.errors name="education[0][graduation_year]" />
                    </div>
                    <div>
                        <button type="button" class="btn btn-sm btn-danger remove-education-details">Remove</button>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" id="add-education-details" class="btn btn-sm btn-success">Add
            Education</button>
        <hr>

        <h3 class="text-center">Experience Details</h3>
        <div class="container mx-auto text-center" id="experience-details-container">
            <div class="experience-details-section" data-index="0">
                <div class="row g-3 mx-auto">
                    <div class="col-md-4">
                        <x-form.label name="company" />
                        <x-form.input name="company[0][company]" placeholder="Enter Company Name" required />
                        <x-form.errors name="company[0][company]" />
                    </div>
                    <div class="col-md-4">
                        <x-form.label name="role" />
                        <x-form.input name="company[0][role]" placeholder="Enter Role" required />
                        <x-form.errors name="company[0][role]" />
                    </div>
                    <div class="col-md-4">
                        <x-form.label name="Year Of Experience" />
                        <x-form.input name="company[0][year_of_experience]" placeholder="Enter Year Of Experience"
                            required />
                        <x-form.errors name="company[0][year_of_experience]" />
                    </div>
                    <div>
                        <button type="button" class="btn btn-sm btn-danger remove-experience-details">Remove</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-Center">
            <button type="button" id="add-experience-details" class="btn btn-sm btn-success">Add
                Experience</button>
        </div>


        <div class="md-3 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

</x-layout>

@include('components.user-create-script')
