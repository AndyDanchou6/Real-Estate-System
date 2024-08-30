@extends('layouts.admin-layout')

@section('title', "Real Estate - Admin's Profile")

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- ProfileStart -->
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center" id="user-summary">


                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form id="edit-user">
                                    <div class="row mb-3">
                                        <label for="" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img src="/avatar/admin-avatar.png" alt="Profile">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="profileImageEdit" class="col-md-4 col-lg-3 col-form-label">Change Profile Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="profileImg" type="file" class="form-control" id="profileImageEdit">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="firstNameEdit" class="col-md-4 col-lg-3 col-form-label">Firstname</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="firstName" type="text" class="form-control" id="firstNameEdit">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="middleNameEdit" class="col-md-4 col-lg-3 col-form-label">Middle Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="middleName" type="text" class="form-control" id="middleNameEdit">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="lastNameEdit" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="lastName" type="text" class="form-control" id="lastNameEdit">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="occupationEdit" class="col-md-4 col-lg-3 col-form-label">Occupation</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="occupation" type="text" class="form-control" id="occupationEdit">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="addressEdit" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="address" type="text" class="form-control" id="addressEdit">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="phoneNoEdit" class="col-md-4 col-lg-3 col-form-label">Phone Number</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phoneNo" type="text" class="form-control" id="phoneNoEdit">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="emailEdit" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="emailEdit">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>



                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form id="change-pass">

                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="currentPassword" type="password" class="form-control" id="currentPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="newPassword" type="password" class="form-control" id="newPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="passwordConfirm" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="passwordConfirm" type="password" class="form-control" id="passwordConfirm">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </div>
                                </form><!-- End Change Password Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var token = sessionStorage.getItem('danchou');

        async function userData() {
            var apiUrl = '/api/logins';
            var parameters = {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token,
                },
            }

            try {
                var response = await fetch(apiUrl, parameters);
                var data = await response.json();

                if (data.status == 200) {
                    userSummary(data.data);
                    userOverview(data.data);
                    editUserValue(data.data);

                } else {
                    console.log('Error fetching user data')
                }

                console.log(data);
            } catch (error) {
                console.log('Error fetching user data', error.message)
            }
        }

        function userSummary(data) {
            var userSummary = document.querySelector('#user-summary');

            if (data.length == 0) {
                console.log('User not Found')
            } else {

                var profileImg = data.profileImg
                if (data.profileImg == null) {
                    profileImg = '/avatar/admin-avatar.png'
                }
                var details = `
                        <img src="${profileImg}" alt="Profile" class="rounded-circle">
                        <h2>${data.firstName} ${data.lastName}</h2>
                        <h3>${data.occupation}</h3>
                        <div class="social-links mt-2">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                `;

                userSummary.innerHTML = '';
                userSummary.innerHTML = details;
            }
        }

        function userOverview(data) {
            var profileOverview = document.querySelector('#profile-overview');

            if (data.length == 0) {
                console.log('Error fetching data'.error.message);
            } else {
                var details = `
                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">First Name</div>
                                    <div class="col-lg-9 col-md-8">${data.firstName}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">MiddleName</div>
                                    <div class="col-lg-9 col-md-8">${data.middleName}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">LastName</div>
                                    <div class="col-lg-9 col-md-8">${data.lastName}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Occupation</div>
                                    <div class="col-lg-9 col-md-8">${data.occupation}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Address</div>
                                    <div class="col-lg-9 col-md-8">${data.address}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8">${data.phoneNo}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">${data.email}</div>
                                </div>
                `;

                profileOverview.innerHTML = details;
            }
        }

        function editUserValue(data) {
            var profileImage = document.querySelector('#profileImage');
            var firstNameEdit = document.querySelector('#firstNameEdit');
            var middleNameEdit = document.querySelector('#middleNameEdit');
            var lastNameEdit = document.querySelector('#lastNameEdit');
            var occupationEdit = document.querySelector('#occupationEdit');
            var addressEdit = document.querySelector('#addressEdit');
            var phoneNoEdit = document.querySelector('#phoneNoEdit');
            var emailEdit = document.querySelector('#emailEdit');

            profileImage.setAttribute('src', data.profileImg);

            firstNameEdit.setAttribute('value', data.firstName);
            middleNameEdit.setAttribute('value', data.middleName);
            lastNameEdit.setAttribute('value', data.lastName);
            emailEdit.setAttribute('value', data.email);
            occupationEdit.setAttribute('value', data.occupation);
            addressEdit.setAttribute('value', data.address);
            phoneNoEdit.setAttribute('value', data.phoneNo);
        }

        async function updateUser(formData) {
            var apiUrl = '/api/users/update';
            var parameters = {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token,
                },
                body: formData,
            }

            try {
                var response = await fetch(apiUrl, parameters);
                var data = await response.json();

                if (data.status == 200) {
                    swal({
                        title: "Success",
                        text: "User update successful",
                        icon: "success",
                        button: "Continue",
                    }).then(data => {
                        location.reload();
                    });
                } else {
                    swal({
                        title: "Error!",
                        text: "Updating user failed!",
                        icon: "warning",
                        button: "Continue",
                    }).then(data => {
                        location.reload();
                    });
                }
                console.log(data);
            } catch (error) {
                console.log('Error updating data', error.message);
            }
        }

        async function changePassword(formData) {
            var apiUrl = '/api/users/changePass'
            var parameters = {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token,
                },
                body: formData,
            }

            try {
                var response = await fetch(apiUrl, parameters);
                var data = await response.json();

                if (data.status == 500) {
                    error(data.message);
                } else if (data.status == 200) {
                    swal({
                        title: "Password Change",
                        text: "New password is set",
                        icon: "success",
                        button: "Continue",
                    }).then(data => {
                        location.reload();
                    });
                }
                console.log(data);
            } catch (error) {
                console.log('Error updating data', error.message)
            }
        }

        var changePass = document.querySelector('#change-pass');

        changePass.addEventListener('submit', event => {
            event.preventDefault();

            var newPass = document.querySelector('#newPassword').value;
            var passConfirm = document.querySelector('#passwordConfirm').value;

            if (newPass.length < 8 || passConfirm.length < 8) {
                swal({
                    title: "Too Weak",
                    text: "New password needs at least 8 characters",
                    icon: "error",
                    button: "Continue",
                });
            } else if (newPass !== passConfirm) {
                swal({
                    title: "Not Matched",
                    text: "Password is not confirmed",
                    icon: "error",
                    button: "Continue",
                });
            } else {

                var formData = new FormData(changePass);

                changePassword(formData);
            }
        })

        var editUser = document.querySelector('#edit-user');

        editUser.addEventListener('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(editUser);

            updateUser(formData);
        })

        userData();
    })
</script>

@endsection