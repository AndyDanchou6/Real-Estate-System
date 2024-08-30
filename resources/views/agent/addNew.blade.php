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
                <li class="breadcrumb-item active">Add New</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="container">
                    <h5 class="col-md-5">Add New</h5>
                </div>
            </div>
            <div class="card-body">

                <div class="container-xl">
                    <div class="row">
                        <div class="row">
                            <form class="row new-property" enctype="multipart/form-data">
                                <div class="form-group col-md-6">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="owner">Owner</label>
                                    <input type="text" class="form-control" id="owner" name="owner" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="type">Type</label>
                                    <select name="type" class="form-select" id="type" required>
                                        <option value="" selected>Required</option>
                                        <option value="house">House</option>
                                        <option value="land">Land</option>
                                        <option value="commercial">Commercial</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="adType">Selling Type</label>
                                    <select name="adType" class="form-select" id="adType" required>
                                        <option value="" selected>Required</option>
                                        <option value="forSale">For Sale</option>
                                        <option value="forRent">For Rent</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="size">Size (sq ft)</label>
                                    <input type="number" class="form-control" id="size" name="size" required>
                                </div>

                                <div class="form-group col-md-6 bedrooms">
                                    <label for="bedrooms">Bedrooms</label>
                                    <input type="number" class="form-control" id="bedrooms" name="bedrooms">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>

                                <div class="form-group col-md-6 price">
                                    <label for="price">Price</label>
                                    <input type="number" step="0.01" class="form-control" id="price" name="price">
                                </div>

                                <div class="form-group col-md-6 monthly">
                                    <label for="monthly">Monthly</label>
                                    <input type="number" step="0.01" class="form-control" id="monthly" name="monthly">
                                </div>

                                <div class="form-group col-md-6 term">
                                    <label for="term">Term</label>
                                    <input type="number" class="form-control" id="term" name="term">
                                </div>

                                <div class="form-group col-md-6 rent">
                                    <label for="rent">Rent</label>
                                    <input type="number" step="0.01" class="form-control" id="rent" name="rent">
                                </div>

                                <div class="container">
                                    <div class="row justify-content-center">
                                        <button type="submit" class="btn btn-primary col-6 mt-3">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var token = sessionStorage.getItem('danchou');

        async function store() {
            var newProperty = document.querySelector('.new-property');

            newProperty.addEventListener('submit', async function(event) {
                event.preventDefault();

                const formData = new FormData(newProperty);
                var apiUrl = '/api/properties/store';
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
                    var data = await response.json();

                    console.log(data);
                } catch (error) {
                    console.log('Network response is bad' . error.message);
                }
            })
        }

        var type = document.querySelector('#type');
        var bedrooms = document.querySelector('.bedrooms');

        type.addEventListener('change', function() {
            if (type.value != 'house') {

                bedrooms.classList.add('d-none');
            } else {

                bedrooms.classList.remove('d-none');
            }
        })

        var adType = document.querySelector('#adType');
        var rent = document.querySelector('.rent');
        var term = document.querySelector('.term');
        var monthly = document.querySelector('.monthly');
        var price = document.querySelector('.price');

        adType.addEventListener('change', function() {

            if (adType.value == 'forSale') {
                term.classList.remove('d-none');
                monthly.classList.remove('d-none');
                price.classList.remove('d-none');

                rent.classList.add('d-none');
            } else if (adType.value == 'forRent') {
                rent.classList.remove('d-none');

                term.classList.add('d-none');
                monthly.classList.add('d-none');
                price.classList.add('d-none');
            }
        })

        store();
    })
</script>
@endsection