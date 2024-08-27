@extends('layouts.home_layout')

@section('contents')

<div class="content-data">
    <div class="card">
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 d-flex justify-content-center p-3">
                        <img src="/images/house-image.jpeg" alt="" class="img-fluid" id="property-detail-img">
                    </div>
                    <div class="col-md-4 p-3">
                        <div class="container">
                            <div class="column">
                                <h4><strong>House</strong></h4>
                                <p><strong>Property Name:</strong> Danchou Homes</p>
                                <p><strong>Owner:</strong> Danchou</p>
                                <p><strong>Size:</strong> 100 sqrs</p>
                                <p><strong>Bedrooms:</strong> 4</p>
                                <p><strong>Address:</strong> Brgy. Poblacion Hilongos Leyte</p>
                                <p><strong>Price:</strong> Php 1.4 M</p>
                                <p><strong>Term:</strong> 5 Years</p>
                                <p><strong>Rent:</strong> Php 50K per Month</p>
                                <p><strong>Agent:</strong> Danchou</p>
                                <button class="btn btn-success">Book A Meeting</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection