@extends('layouts.admin-layout')

@section('title', 'Real Estate - Admin')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Clients</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="container">
                    <div class="row mb-0" style="align-items: center;">
                        <h5 class="col-md-5">Clients</h5>
                        <form class="col-sm-8 col-md-5 mb-3" id="search-all">
                            <div class="input-group"">
                            <input type=" text" placeholder="Search properties" class="form-control">
                                <button type="submit" class="btn btn-success">Search</button>
                            </div>
                        </form>
                        <div class="col-sm-4 col-md-2 mb-3">
                            <div class="container">
                                <div class="row">
                                    <select class="form-select" name="filter" id="clients-filter">
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
                                    <th scope="col">Name</th>
                                    <th scope="col">Occupation</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Operation</th>
                                </tr>
                            </thead>
                            <tbody id="table-contents">
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

</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var token = sessionStorage.getItem('danchou');

        async function fetchClients() {
            var apiUrl = '/api/users/clients';
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

                populateTable(data)
                console.log(data);
            } catch (error) {
                console.log('Error fetching clients', error.message)
            }
        }

        function populateTable(data) {
            var tableContents = document.querySelector('#table-contents');
            var row = '';

            if (data.length == 0) {
                row = `
                    <tr>
                        <td colspan="100%" style="text-align: center;">No results found</td>
                    </tr>
                `;

                tableContents.innerHTML = row;
            } else {
                var counter = 1;
                data.forEach(client => {

                    var profileImg = data.profileImg;
                    if (data.profileImg == null) {
                        profileImg = '/avatar/user-avatar1.jpeg';
                    }

                    row = `
                        <tr>
                            <th scope="row">${counter}</th>
                            <td>
                            <img src="${profileImg}" alt="Client" style="max-width: 50px; max-height: 50px; border-radius: 50%;"> 
                            ${client.firstName} ${client.middleName} ${client.lastName}</td>
                            <td>${client.occupation}</td>
                            <td>${client.email} sqrs</td>
                            <td>
                                <abbr title="view"><i class="bi bi-eye-fill px-1" data-bs-toggle="modal" data-bs-target="#moreInfo${client.id}"></i></abbr>
                                <abbr title="update"><i class="bi bi-pencil-fill px-1" data-bs-toggle="modal" data-bs-target="#update${client.id}"></i></abbr>
                                <abbr title="delete"><i class="bi bi-trash-fill px-1 delete-btn" data-item-id="${client.id}"></i></abbr>
                            </td>
                        </tr>
                    `;

                    tableContents.innerHTML += row;
                    counter += 1;
                });
            }
        }

        fetchClients();

    })
</script>
@endsection