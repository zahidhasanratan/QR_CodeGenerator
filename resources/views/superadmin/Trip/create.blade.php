@extends('layouts.superadmin')
@section('title')
    <title>Participant Add | NRB World</title>
@endsection
@section('main')



    <div class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Add Participant Name</h4>
                        <!-- <p class="card-category">Complete your profile</p> -->
                    </div>
                    <div class="card-body">

                        <form role="form" method="POST" action="{{ route('trip.store') }}" enctype="multipart/form-data">
                            @csrf
                            <fieldset class="col-lg-12 border p-3 mb-3">
                                <div class="form-row">
                                    <!-- Participant Name -->
                                    <div class="col-md-4 mb-6">
                                        <label for="name">Participant Name</label><span class="required-star">*</span>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Participant Name" required>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-4 mb-6">
                                        <label for="email">Email</label><span class="required-star"></span>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email Address">
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-md-4 mb-6">
                                        <label for="phone">Phone</label><span class="required-star"></span>
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Phone Number">
                                    </div>

                                    <!-- Country -->
                                    <div class="col-md-4 mb-6">
                                        <label for="driver">Country</label>
                                        <select name="driver" id="driver" class="form-control">
                                            <option value="">Select Country</option>
                                            @foreach(\App\Models\Unit::all() as $list)
                                                <option value="{{ $list->name }}">{{ $list->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Gender -->
                                    <div class="col-md-4 mb-6">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>

                                    <!-- Organization -->
                                    <div class="col-md-4 mb-6">
                                        <label for="description">Organization</label>
                                        <input type="text" name="description" id="description" class="form-control" placeholder="Enter Organization Name">
                                    </div>

                                    <!-- Designation -->
                                    <div class="col-md-4 mb-6">
                                        <label for="fare">Designation</label>
                                        <input type="text" name="fare" id="fare" class="form-control" placeholder="Enter Designation">
                                    </div>

                                    <!-- Category -->
                                    <div class="col-md-4 mb-6">
                                        <label for="route">Category</label>
                                        <select name="route" id="route" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach(\App\Models\Route::all() as $list)
                                                <option value="{{ $list->name }}">{{ $list->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>


                            <div class="form-group col-lg-12 text-center">
                                <button type="submit" class="btn btn-primary"><span>Submit</span></button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection