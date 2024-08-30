@extends('layouts.home_layout')

@section('contents')

<div class="content-data">
    <div class="card">
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 d-flex justify-content-center p-3">
                        <img src="" alt="" class="img-fluid" id="property-detail-img">
                    </div>
                    <div class="col-md-4 p-3">
                        <div class="container">
                            <div class="column" id="property-details">
                                <!-- <h4><strong>House</strong></h4>
                                <p><strong>Property Name:</strong> Danchou Homes</p>
                                <p><strong>Owner:</strong> Danchou</p>
                                <p><strong>Size:</strong> 100 sqrs</p>
                                <p><strong>Bedrooms:</strong> 4</p>
                                <p><strong>Address:</strong> Brgy. Poblacion Hilongos Leyte</p>
                                <p><strong>Price:</strong> Php 1.4 M</p>
                                <p><strong>Term:</strong> 5 Years</p>
                                <p><strong>Rent:</strong> Php 50K per Month</p>
                                <p><strong>Agent:</strong> Danchou</p>
                                <button class="btn btn-success">Book A Meeting</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function fetchPropertyDetail() {
        try {

            var id = sessionStorage.getItem('propertyId');
            var api = '/api/properties/' + id;
            var response = await fetch(api);
            var data = await response.json();

            displayResponse(data);
        } catch (error) {
            console.log('Error fetching data' + error.message);
        }
    }

    function displayResponse(details) {
        var image = document.querySelector('#property-detail-img')
        var propertyDetails = document.querySelector('#property-details');

        if (details.image) {
            image.setAttribute('src', details.image)
        }

        if (details.type == 'house') {

            if (details.adType == 'forRent') {

                var text = `
                    <h4><strong>House </strong><em>For Rent</em></h4>
                    <p><strong>Property Name:</strong> ${details.title}</p>
                    <p><strong>Owner:</strong> ${details.owner}</p>
                    <p><strong>Size:</strong> ${details.size} sqrs</p>
                    <p><strong>Bedrooms:</strong>${details.bedrooms}</p>
                    <p><strong>Address:</strong> ${details.location}</p>
                    <p><strong>Rent:</strong> Php ${details.rent} per Month</p>
                    <p><strong>Agent:</strong> ${details.agent.firstName} ${details.agent.middleName} ${details.agent.lastName}</p>
                    <button class="btn btn-success">Book A Meeting</button>
                `;
            } else {

                var text = `
                    <h4><strong>House </strong><em>For Sale</em></h4>
                    <p><strong>Property Name:</strong> ${details.title}</p>
                    <p><strong>Owner:</strong> ${details.owner}</p>
                    <p><strong>Size:</strong> ${details.size} sqrs</p>
                    <p><strong>Bedrooms:</strong>${details.bedrooms}</p>
                    <p><strong>Address:</strong> ${details.location}</p>
                    <p><strong>Price:</strong> Php ${details.price}</p>
                    <p><strong>Term:</strong> ${details.term} Years</p>
                    <p><strong>Rent:</strong> Php ${details.monthly} per Month</p>
                    <p><strong>Agent:</strong> ${details.agent.firstName} ${details.agent.middleName} ${details.agent.lastName}</p>
                    <button class="btn btn-success">Book A Meeting</button>
                `;
            }

        } else if (details.type == 'land') {

            if (details.adType == 'forRent') {
                var text = `
                    <h4><strong>Land </strong><em>For Rent</em></h4>
                    <p><strong>Property Name:</strong> ${details.title}</p>
                    <p><strong>Owner:</strong> ${details.owner}</p>
                    <p><strong>Size:</strong> ${details.size} sqrs</p>
                    <p><strong>Address:</strong> ${details.location}</p>
                    <p><strong>Rent:</strong> Php ${details.rent} per Month</p>
                    <p><strong>Agent:</strong> ${details.agent.firstName} ${details.agent.middleName} ${details.agent.lastName}</p>
                    <button class="btn btn-success">Book A Meeting</button>
                `;
            } else {
                var text = `
                    <h4><strong>Land </strong><em>For Sale</em></h4>
                    <p><strong>Property Name:</strong> ${details.title}</p>
                    <p><strong>Owner:</strong> ${details.owner}</p>
                    <p><strong>Size:</strong> ${details.size} sqrs</p>
                    <p><strong>Address:</strong> ${details.location}</p>
                    <p><strong>Price:</strong> Php ${details.price}</p>
                    <p><strong>Term:</strong> ${details.term} Years</p>
                    <p><strong>Rent:</strong> Php ${details.monthly} per Month</p>
                    <p><strong>Agent:</strong> ${details.agent.firstName} ${details.agent.middleName} ${details.agent.lastName}</p>
                    <button class="btn btn-success">Book A Meeting</button>
                `;
            }
        } else if (details.type == 'commercial') {

            if (details.adType == 'forRent') {
                var text = `
                    <h4><strong>Commercial </strong><em>For Rent</em></h4>
                    <p><strong>Property Name:</strong> ${details.title}</p>
                    <p><strong>Owner:</strong> ${details.owner}</p>
                    <p><strong>Size:</strong> ${details.size} sqrs</p>
                    <p><strong>Address:</strong> ${details.location}</p>
                    <p><strong>Rent:</strong> Php ${details.rent} per Month</p>
                    <p><strong>Agent:</strong> ${details.agent.firstName} ${details.agent.middleName} ${details.agent.lastName}</p>
                    <button class="btn btn-success">Book A Meeting</button>
                `;
            } else {
                var text = `
                    <h4><strong>Commercial </strong><em>For Sale</em></h4>
                    <p><strong>Property Name:</strong> ${details.title}</p>
                    <p><strong>Owner:</strong> ${details.owner}</p>
                    <p><strong>Size:</strong> ${details.size} sqrs</p>
                    <p><strong>Address:</strong> ${details.location}</p>
                    <p><strong>Price:</strong> Php ${details.price}</p>
                    <p><strong>Term:</strong> ${details.term} Years</p>
                    <p><strong>Rent:</strong> Php ${details.monthly} per Month</p>
                    <p><strong>Agent:</strong> ${details.agent.firstName} ${details.agent.middleName} ${details.agent.lastName}</p>
                    <button class="btn btn-success">Book A Meeting</button>
                `;
            }
        } else {

            var text = `
                <h4><strong>${details.type}</strong></h4>
                <p><strong>Property Name:</strong> ${details.title}</p>
                <p><strong>Owner:</strong> ${details.owner}</p>
                <p><strong>Size:</strong> ${details.size} sqrs</p>
                <p><strong>Address:</strong> ${details.location}</p>
                <p><strong>Agent:</strong> ${details.agent.firstName} ${details.agent.middleName} ${details.agent.lastName}</p>
                <button class="btn btn-success">Book A Meeting</button>
            `;
        }

        propertyDetails.innerHTML = '';

        propertyDetails.innerHTML = text;
    }

    async function promptLogin() {
        const result = await swal({
            title: 'Not Logged In?',
            text: 'Do you want to log in first?',
            icon: 'warning',
            buttons: {
                cancel: 'Cancel',
                confirm: 'Login'
            },
            dangerMode: true,
        });

        if (result) {
            location.href = '/login';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        var token = sessionStorage.getItem('danchou');

        function bookAMeeting() {
            var property = document.querySelector('#property-details');
            var bookBtn = property.querySelector('button');

            bookBtn.addEventListener('click', async function() {

                var loggedIn = sessionStorage.getItem('danchou');

                if (loggedIn) {

                    if (sessionStorage.getItem('nice') != '3W') {
                        error('You are not eligible to book an appointment')
                    } else {
                        var propertyId = sessionStorage.getItem('propertyId');
                        var apiUrl = '/api/appointment/store';
                        var parameters = {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'Authorization': 'Bearer ' + token,
                            },
                            body: JSON.stringify({
                                property_id: propertyId,
                            }),
                        }

                        try {
                            var response = await fetch(apiUrl, parameters);
                            var data = await response.json();

                            if (data.status == 201) {
                                success(data.message);
                            } else if (data.status == 200) {
                                error(data.message);
                            } else {
                                error(data.message);
                            }
                        } catch (error) {
                            console.log('Network response is bad'.error.message)
                        }
                    }
                } else {

                    promptLogin();
                }
            })
        }

        fetchPropertyDetail();
        setTimeout(() => {
            bookAMeeting();
        }, 1000);

    })
</script>

@endsection