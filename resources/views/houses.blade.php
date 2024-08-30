@extends('layouts.home_layout')

@section('contents')

<div class="content-data">
    <div class="card">
        <div class="card-body">
            <div class="header d-flex">
                <h5 class="card-title col-5">Houses</h5>
                <form class="w-100 d-flex" style="justify-content: flex-end;" id="search-house">
                    <div class="input-group" style="max-width: 500px;">
                        <input type="text" class="form-control" placeholder="Search for houses">
                        <button class="btn btn-success">Search</button>
                    </div>
                </form>
            </div>
            <hr>
            <div class="container-xl">
                <div class="row" id="house-container">
                    <!-- <div class="col-md-6 col-lg-4 col-xxl-3">
                        <div class="property-summary" id="house-property">
                            <img src="/images/house-image.jpeg" alt="" class="img-fluid" style="width: 100%; height: 80%;"></img>
                            <div class="py-3">
                                <p class="fs-5"><strong>Property Name</strong></p>
                                <p>Property Owner</p>
                                <p>Property Address</p>
                                <p>960 squaremeters</p>
                                <p>3 Bedrooms</p>
                                <p class="property-id" hidden>1</p>
                            </div>
                        </div>
                    </div> -->

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function displayProperty(data) {

        var houseContainer = document.querySelector('#house-container');
        var text = `
            <div class="col-md-6 col-lg-4 col-xxl-3">
                <div class="property-summary">
                    <img src="${data.image}" alt="" class="img-fluid" style="width: 100%; height: 80%;"></img>
                    <div class="py-3">
                        <p class="fs-5"><strong>${data.title}</strong></p>
                        <p>${data.owner}</p>
                        <p>${data.location}</p>
                        <p>${data.size} sqrs</p>
                        <p>${data.bedrooms} Bedrooms</p>
                        <p class="property-id" hidden>${data.id}</p>
                    </div>
                </div>
            </div>
        `;

        houseContainer.innerHTML += text;
    }

    document.addEventListener('DOMContentLoaded', function() {

        async function fetchAllProperties() {
            try {
                var response = await fetch('/api/house');

                var data = await response.json();

                data.forEach(element => {
                    displayProperty(element);
                });

            } catch (error) {
                console.log('Error has occurred while fetching data'.error.message);
            }
        }

        async function searchHouse() {
            try {
                const searchBar = document.querySelector('#search-house');

                searchBar.addEventListener('submit', async function(event) {
                    event.preventDefault();

                    var searchInput = searchBar.querySelector('input').value;

                    if (searchInput.trim() === '') {
                        location.reload();
                    }

                    var apiUrl = '/api/properties/search/house/' + searchInput;
                    var response = await fetch(apiUrl);
                    var data = await response.json();
                    var houseContainer = document.querySelector('#house-container');
                    houseContainer.innerHTML = '';

                    data.forEach(property => {
                        displayProperty(property);
                    })
                    console.log(data);
                })
            } catch (error) {
                console.log('Error fetching data' + error.message);
            }
        }

        fetchAllProperties();
        searchHouse();

    })
</script>
@endsection