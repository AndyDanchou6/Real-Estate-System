@extends('layouts.home_layout')

@section('contents')

@include('includes.banner')

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
                <div class="row">
                    <div class="col-md-6 col-lg-4 col-xxl-3">
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
                    </div>
                    <div class="col-md-6 col-lg-4 col-xxl-3">
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
                    </div>
                    <div class="col-md-6 col-lg-4 col-xxl-3">
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
                    </div>
                    <div class="col-md-6 col-lg-4 col-xxl-3">
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
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection