@extends('layouts.home_layout')

@section('contents')

@include('includes.banner')

<div class="content-data">
    <div class="card">
        <div class="card-body">
            <div class="header d-flex">
                <h5 class="card-title col-5">Commercial Buildings</h5>
                <form class="w-100 d-flex" style="justify-content: flex-end;" id="search-commercial">
                    <div class="input-group" style="max-width: 500px;">
                        <input type="text" class="form-control" placeholder="Search for commercial buildings">
                        <button class="btn btn-success">Search</button>
                    </div>
                </form>
            </div>
            <hr>
            <div class="container-xl">
                <div class="row">
                    <div class="col-md-6 col-lg-4 col-xxl-3">
                        <div class="property-summary" id="commercial-property">
                            <img src="/images/commercial-image.jpg" alt="" class="img-fluid" style="width: 100%; height: 80%;"></img>
                            <div class="py-3">
                                <p class="fs-5"><strong>Property Name</strong></p>
                                <p>Property Owner</p>
                                <p>Property Address</p>
                                <p>Size</p>
                                <p class="property-id" hidden>1</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xxl-3">
                        <div class="property-summary" id="commercial-property">
                            <img src="/images/commercial-image.jpg" alt="" class="img-fluid" style="width: 100%; height: 80%;"></img>
                            <div class="py-3">
                                <p class="fs-5"><strong>Property Name</strong></p>
                                <p>Property Owner</p>
                                <p>Property Address</p>
                                <p>Size</p>
                                <p class="property-id" hidden>1</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xxl-3">
                        <div class="property-summary" id="commercial-property">
                            <img src="/images/commercial-image.jpg" alt="" class="img-fluid" style="width: 100%; height: 80%;"></img>
                            <div class="py-3">
                                <p class="fs-5"><strong>Property Name</strong></p>
                                <p>Property Owner</p>
                                <p>Property Address</p>
                                <p>Size</p>
                                <p class="property-id" hidden>1</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xxl-3">
                        <div class="property-summary" id="commercial-property">
                            <img src="/images/commercial-image.jpg" alt="" class="img-fluid" style="width: 100%; height: 80%;"></img>
                            <div class="py-3">
                                <p class="fs-5"><strong>Property Name</strong></p>
                                <p>Property Owner</p>
                                <p>Property Address</p>
                                <p>Size</p>
                                <p class="property-id" hidden>1</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xxl-3">
                        <div class="property-summary" id="commercial-property">
                            <img src="/images/commercial-image.jpg" alt="" class="img-fluid" style="width: 100%; height: 80%;"></img>
                            <div class="py-3">
                                <p class="fs-5"><strong>Property Name</strong></p>
                                <p>Property Owner</p>
                                <p>Property Address</p>
                                <p>Size</p>
                                <p class="property-id" hidden>1</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xxl-3">
                        <div class="property-summary" id="commercial-property">
                            <img src="/images/commercial-image.jpg" alt="" class="img-fluid" style="width: 100%; height: 80%;"></img>
                            <div class="py-3">
                                <p class="fs-5"><strong>Property Name</strong></p>
                                <p>Property Owner</p>
                                <p>Property Address</p>
                                <p>Size</p>
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