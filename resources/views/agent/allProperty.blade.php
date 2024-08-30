@extends('layouts.agent-layout')

@section('title', 'Real Estate - Agent')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item"><a href="">Properties</a></li>
                <li class="breadcrumb-item active">All</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="container">
                    <div class="row mb-0" style="align-items: center;">
                        <h5 class="col-md-5">Properties</h5>
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
                                        <option value="land">Land</option>
                                        <option value="commercial">Commercial</option>
                                        <option value="house">House</option>
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
                                    <th scope="col">Name</th>
                                    <th scope="col">Owner</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Operation</th>
                                </tr>
                            </thead>
                            <tbody id="property-all">
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
    @include('agent.modal.moreInfo')
    @include('agent.modal.delete')
    @include('agent.modal.update')
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var token = sessionStorage.getItem('danchou');
        async function fetchAll() {
            try {
                var apiUrl = '/api/properties/all/all';
                var parameters = {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + token
                    }
                }
                var response = await fetch(apiUrl, parameters);
                var data = await response.json();

                populateTable(data);
                paginator(data.length);
                moreInfoModalMaker(data);
                updateModalMaker(data);
            } catch (error) {
                console.log('Error fetching data'.error.message);
            }
        }

        function populateTable(data) {

            var tableBody = document.querySelector('#property-all');
            var row = '';

            if (data.length == 0) {
                row = `
                    <tr>
                        <td colspan="100%" style="text-align: center;">No results found</td>
                    </tr>
                `;

                tableBody.innerHTML = row;
            } else {

                var counter = 1;
                data.forEach(property => {

                    row = `
                        <tr>
                            <th scope="row">${counter}</th>
                            <td>${property.title}</td>
                            <td>${property.owner}</td>
                            <td>${property.size} sqrs</td>
                            <td>${property.location}</td>
                            <td>
                                <abbr title="view"><i class="bi bi-eye-fill px-1" data-bs-toggle="modal" data-bs-target="#moreInfo${property.id}"></i></abbr>
                                <abbr title="update"><i class="bi bi-pencil-fill px-1" data-bs-toggle="modal" data-bs-target="#update${property.id}"></i></abbr>
                                <abbr title="delete"><i class="bi bi-trash-fill px-1 delete-btn" data-item-id="${property.id}"></i></abbr>
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

        function moreInfoModalMaker(data) {
            if (data.length > 0) {
                var modalContainer = document.querySelector('.info-modals');
                if (!modalContainer) return;

                let modalsHTML = '';

                data.forEach(info => {

                    var readableAdType = '';
                    if (info.adType == 'forSale') {
                        readableAdType = 'For Sale';
                    } else if (info.adType == 'forRent') {
                        readableAdType = 'For Rent';
                    } else {
                        readableAdType = 'Unknown';
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
                                <img src="${info.image}" alt="" class="img-fluid">
                            </div>
                            <div class="container m-3">
                                <div class="row">
                                    <div class="col-6">
                                        <p>${info.size} sqrs</p>
                                    </div>
                                    ${info.bedrooms ? `
                                        <div class="col-6">
                                            <p>${info.bedrooms} Bedrooms</p>
                                        </div>
                                    ` : ''}
                                </div>
                                <p><strong>Property Name:</strong> ${info.title}</p>
                                <p><strong>Owner:</strong> ${info.owner}</p>
                                <p><strong>Address:</strong> ${info.location}</p>
                                <p>${readableAdType}</p>
                                ${info.term ? `<p><strong>Term:</strong> ${info.term}</p>` : ''}
                                ${info.rent ? `<p><strong>Rent:</strong> Php ${info.rent}</p>` : ''}
                                ${info.monthly ? `<p><strong>Monthly:</strong> Php ${info.monthly}</p>` : ''}
                                ${info.price ? `<p><strong>Price:</strong> Php ${info.price}</p>` : ''}
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

                // Set the innerHTML once
                modalContainer.innerHTML = modalsHTML;
            }
        }

        function updateModalMaker(data) {
            if (data.length > 0) {
                var updateModal = document.querySelector('.update-modals');
                if (!updateModal) return;

                let updateModalData = '';

                data.forEach(update => {

                    var readableAdType = '';
                    if (update.adType == 'forSale') {
                        readableAdType = 'For Sale';
                    } else if (update.adType == 'forRent') {
                        readableAdType = 'For Rent';
                    } else {
                        readableAdType = 'Unknown';
                    }

                    updateModalData += `
                        <div class="modal fade" id="update${update.id}" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="update-property" enctype="multipart/form-data">
                        <input type="text" name="id" value="${update.id}" hidden>
                        <div class="my-3">
                            <label for="">Property Name</label>
                            <input type="text" class="form-control" id="" name="title" value="${update.title}">
                        </div>
                        <div class="my-3">
                            <label for="">Owner</label>
                            <input type="text" class="form-control" id="" name="owner" value="${update.owner}">
                        </div>
                        <div class="my-3">
                            <label for="">Address</label>
                            <input type="text" class="form-control" id="" name="location" value="${update.location}">
                        </div>
                        <div class="my-3">
                            <label for="">Size</label>
                            <input type="number" class="form-control" id="" name="size" value="${update.size}">
                        </div>
                        ${update.bedrooms ?
                        `<div class="my-3">
                            <label for="">Bedrooms</label>
                            <input type="number" class="form-control" id="" name="bedrooms" value="${update.bedrooms}">
                        </div>` : ''}
                        ${update.monthly ?
                        `<div class="my-3">
                            <label for="">Monthly</label>
                            <input type="number" class="form-control" id="" name="monthly" value="${update.monthly}">
                        </div>` : ''}
                        ${update.rent ? 
                        `<div class="my-3">
                            <label for="">Rent</label>
                            <input type="number" class="form-control" id="" name="rent" value="${update.rent}">
                        </div>` : ''}
                        ${update.price ? 
                        `<div class="my-3">
                            <label for="">Rent</label>
                            <input type="number" class="form-control" id="" name="price" value="${update.price}">
                        </div>` : ''}
                        ${update.term ? 
                        `<div class="my-3">
                            <label for="">Term</label>
                            <input type="number" class="form-control" id="" name="term" value="${update.term}">
                        </div>` : ''}
                        <div class="my-3">
                            <label for="">Selling Type</label>
                            <select name="adType" id="" class="form-select" required>
                                <option selected disabled>Required</option>
                                <option value="forSale">For Sale</option>
                                <option value="forRent">For Rent</option>
                            </select>
                        </div>
                        <input type="file" class="form-control my-3">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
                    `;
                })

                updateModal.innerHTML = updateModalData;
            }
        }

        async function deleteProperty(id) {
            var apiUrl = '/api/properties/delete/' + id;
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

        setTimeout(() => {
            var updatePropertyForms = document.querySelectorAll('.update-property');

            updatePropertyForms.forEach(form => {
                form.addEventListener('submit', async function(event) {
                    event.preventDefault();

                    const formData = new FormData(form);

                    var id = formData.get('id');
                    var apiUrl = '/api/properties/update/' + id;
                    var parameters = {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + token
                        },
                        body: formData,
                    }

                    try {
                        var response = await fetch(apiUrl, parameters);
                        var data = await response.json()
                        if (data.status == 200) {
                            success('Update was successful');

                            setTimeout(() => {
                                location.reload();
                            }, 3000);
                        } else {
                            error('Something went wrong');
                        }
                    } catch (error) {
                        console.log('Error fetching data'.error.message)
                    }
                });
            });
        }, 1000);


        var filter = document.querySelector('#property-filter');

        filter.addEventListener('change', async function() {

            var apiUrl = '/api/properties/all/' + filter.value;
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
                var tableBody = document.querySelector('#property-all');
                var modalContainer = document.querySelector('.info-modals');
                var updateModal = document.querySelector('.update-modals');

                tableBody.innerHTML = '';
                modalContainer.innerHTML = '';
                updateModal.innerHTML = '';

                populateTable(data);
                moreInfoModalMaker(data);
                updateModalMaker(data);
                deleteEvent();

            } catch (error) {
                console.log('Error fetching data' + error.message)
            }
        })

        var searchAll = document.querySelector('#search-all');

        searchAll.addEventListener('submit', async function(event) {

            event.preventDefault();

            var searchInput = searchAll.querySelector('input').value;
            var apiUrl = '/api/properties/all/search/' + searchInput;
            var parameters = {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token,
                },
            }

            try {
                var response = await fetch(apiUrl, parameters)
                var data = await response.json();

                var tableBody = document.querySelector('#property-all');
                var modalContainer = document.querySelector('.info-modals');
                var updateModal = document.querySelector('.update-modals');

                tableBody.innerHTML = '';
                modalContainer.innerHTML = '';
                updateModal.innerHTML = '';

                populateTable(data);
                moreInfoModalMaker(data);
                updateModalMaker(data);
                deleteEvent();

            } catch (error) {
                console.log('Error fetching data'.error.message)
            }
        })


        setTimeout(() => {
            deleteEvent();
        }, 1000);

        fetchAll();
    })
</script>

@endsection