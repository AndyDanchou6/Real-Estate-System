@extends('layouts.client-layout')

@section('title', 'Real Estate - Client')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Appointments</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="container">
                    <div class="row mb-0" style="align-items: center;">
                        <h5 class="col-md-5">Appointments</h5>
                        <form class="col-sm-8 col-md-5 mb-3" id="search-all">
                            <div class="input-group"">
                            <input type=" text" placeholder="Search properties" class="form-control">
                                <button type="submit" class="btn btn-success">Search</button>
                            </div>
                        </form>
                        <div class="col-sm-4 col-md-2 mb-3">
                            <div class="container">
                                <div class="row">
                                    <select class="form-select" name="filter" id="property-filter">
                                        <option value="all">All</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="container-xl">
                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Property</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Schedule</th>
                                    <th scope="col">Agent</th>
                                    <th scope="col">Operation</th>
                                </tr>
                            </thead>
                            <tbody id="appointments">
                                <!-- Javascript -->
                            </tbody>
                        </table>
                        <nav aria-label="...">
                            <ul class="pagination justify-content-end">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                <div class="d-flex" id="pagination-number">
                                    <!-- Pagination Number -->
                                </div>

                                <!-- <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li> -->

                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="info-modals">

    </div>

</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var token = sessionStorage.getItem('danchou');

        async function fetchAppointments() {

            var apiUrl = '/api/appointment/client';
            var parameters = {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token
                }
            }

            try {
                var response = await fetch(apiUrl, parameters);
                var data = await response.json();

                populateTable(data.data);
                paginator(data.data.length);
                moreInfoModalMaker(data.data);
            } catch (error) {
                console.log('Network response is bad'.error.message)
            }
        }

        function populateTable(data) {
            var tableBody = document.querySelector('#appointments');

            if (data.length == 0) {
                row = `
                    <tr>
                        <td colspan="100%" style="text-align: center;">No results found</td>
                    </tr>
                `;

                tableBody.innerHTML = row;
            } else {
                var counter = 1;
                data.forEach(appointment => {

                    var status = '';

                    if (appointment.confirmation_status == 1) {
                        status = 'Confirmed';
                    } else if (appointment.confirmation_status != 1 && appointment.cancellation_reason) {
                        status = 'Cancelled'
                    } else {
                        status = 'Pending';
                    }

                    var row = `
                    <tr>
                        <th scope="row">${counter}</th>
                        <td>${appointment.property.title}</td>
                        <td>${status}</td>
                        <td>${appointment.schedule ? appointment.schedule: 'No schedule yet'}</td>
                        <td>${appointment.agent.firstName} ${appointment.agent.middleName} ${appointment.agent.lastName}</td>
                        <td>
                            <abbr title="view"><i class="bi bi-eye-fill px-1" data-bs-toggle="modal" data-bs-target="#moreInfo${appointment.id}"></i></abbr>
                            <abbr title="delete"><i class="bi bi-trash-fill px-1 delete-btn" data-item-id="${appointment.id}"></i></abbr>
                        </td>
                    </tr>
                `;

                    tableBody.innerHTML += row;
                    counter += 1;
                });
            }
        }

        function paginator(length) {
            var dataPerPage = 50;
            var pagination = '';
            var paginationContainer = document.querySelector('#pagination-number');

            if (length <= dataPerPage) {
                pagination = `
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                `;

                paginationContainer.innerHTML = pagination;
            } else {
                var numberOfPages = length / dataPerPage;
                var remainder = length % dataPerPage;

                if (remainder != 0) {
                    numberOfPages += 1;
                }

                var counter = 1;
                do {
                    if (counter == 1) {
                        pagination = `
                            <li class="page-item active"><a class="page-link" href="#">${counter}</a></li>
                        `;
                    } else {
                        pagination = `
                            <li class="page-item"><a class="page-link" href="#">${counter}</a></li>
                        `;
                    }

                    paginationContainer.innerHTML += pagination;
                    numberOfPages -= 1;
                    counter += 1;
                } while (numberOfPages != 0);
            }
        }

        async function deleteProperty(id) {
            var apiUrl = '/api/appointment/delete/' + id;
            var parameters = {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token
                },
            }

            try {
                var response = await fetch(apiUrl, parameters);
                var data = await response.json();

                if (data.status == 200) {
                    success(data.message);
                } else {
                    error(data.message);
                }
            } catch (error) {
                console.log('Error fetching data'.error.message)
            }
        }

        function deleteEvent() {
            var deleteBtn = document.querySelectorAll('.delete-btn');

            deleteBtn.forEach(function(button) {
                button.addEventListener('click', function() {
                    swal({
                            title: "Are you sure?",
                            text: "Once deleted, you will not be able to recover this data!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {

                                deleteProperty(button.getAttribute('data-item-id'));
                            }
                        });
                })
            })
        }

        function moreInfoModalMaker(data) {
            if (data.length > 0) {
                var modalContainer = document.querySelector('.info-modals');
                if (!modalContainer) return;

                let modalsHTML = '';

                data.forEach(info => {

                    var readableAdType = '';
                    var status = '';
                    var location = '';
                    var schedule = '';

                    if (info.property.adType == 'forSale') {
                        readableAdType = 'For Sale';
                    } else if (info.property.adType == 'forRent') {
                        readableAdType = 'For Rent';
                    } else {
                        readableAdType = 'Unknown';
                    }

                    if (info.confirmation_status == 1) {
                        status = 'Confirmed';
                    } else if (info.confirmation_status == 0 && info.cancellation_reason) {
                        status = 'Cancelled';
                    } else {
                        status = 'Pending';
                    }

                    if (!info.location) {
                        location = 'Not scheduled yet';
                    } else {
                        location = info.location;
                    }

                    if (!info.schedule) {
                        schedule = 'Not scheduled yet';
                    } else {
                        schedule = info.schedule;
                    }

                    modalsHTML += `
        <div class="modal fade" id="moreInfo${info.id}" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">More Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container m-3">
                            <img src="${info.property.image}" alt="" class="img-fluid">
                        </div>
                        <div class="container m-3">
                            <div class="row">
                                <div class="col-6">
                                    <p>${info.property.size} sqrs.</p>
                                </div>
                                <div class="col-6">
                                    ${info.property.bedrooms ? `<p>${info.property.bedrooms} Bedrooms</p>` : ''}
                                </div>
                                <div class="col-lg-6">
                                    <p><strong>Property Name: </strong>${info.property.title}</p>
                                </div>
                                <div class="col-lg-6">
                                    <p><strong>Owner: </strong>${info.property.owner}</p>
                                </div>
                                <div class="col-lg-6">
                                    <p><strong>Address: </strong>${info.property.location}</p>
                                </div>
                                <div class="col-lg-6">
                                    <p>${readableAdType}</p>
                                </div>
                                ${info.property.term ?
                                `<div class="col-lg-6">
                                    <p><strong>Term: </strong>${info.property.term}</p>
                                </div>` : ''}
                                ${info.property.rent ?
                                `<div class="col-lg-6">
                                    <p><strong>Rent: </strong>${info.property.rent}</p>
                                </div>` : ''}
                                ${info.property.monthly ?
                                `<div class="col-lg-6">
                                    <p><strong>Monthly: </strong>${info.property.monthly}</p>
                                </div>` : ''}
                                ${info.property.price ?
                                `<div class="col-lg-6">
                                    <p><strong>Price: </strong>${info.property.price}</p>
                                </div>` : ''}
                                <div class="col-lg-6">
                                    <p><strong>Agent: </strong>${info.agent.firstName} ${info.agent.middleName} ${info.agent.lastName}</p>
                                </div>
                                <div class="col-lg-6">
                                    <p><strong>Contact: </strong>${info.agent.phoneNo}</p>
                                </div>
                                <div class="col-lg-6">
                                    <p><strong>Email: </strong>${info.agent.email}</p>
                                </div>
                                <hr>
                                <div class="col-lg-6">
                                    <h4>Appointment</h4>
                                </div>
                                <div class="col-lg-6">
                                    <p><strong>Status: </strong>${status}</p>
                                </div>
                                <div class="col-lg-6">
                                    <p><strong>Schedule: </strong>${schedule}</p>
                                </div>
                                <div class="col-lg-6">
                                    <p><strong>Location: </strong>${location}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
                    `;
                });

                modalContainer.innerHTML = modalsHTML;
            }
        }

        fetchAppointments();

        setTimeout(() => {
            deleteEvent();
        }, 1000);
    })
</script>
@endsection