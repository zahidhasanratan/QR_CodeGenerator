@extends('layouts.superadmin')
@section('title')
    <title>Participant Edit | NRB World</title>
@endsection
@section('main')



    <div class="content">
        <div class="container-fluid">
            <div class="row">


                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Edit Participant</h4>
                    </div>

                    <div class="card-body">
                        <form role="form" method="POST" action="{{ route('trip.update', $unit->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <fieldset class="col-lg-12 border p-3 mb-3">
                                <div class="form-row">
                                    <!-- Participant Name -->
                                    <div class="col-md-4 mb-6">
                                        <label for="name">Participant Name</label><span class="required-star">*</span>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Participant Name" required value="{{ $unit->name }}">
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-4 mb-6">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ $unit->email }}">
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-md-4 mb-6">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone Number" value="{{ $unit->phone }}">
                                    </div>

                                    <!-- Country -->
                                    <div class="col-md-4 mb-6">
                                        <label for="driver">Country</label>
                                        <select name="driver" id="driver" class="form-control" required>
                                            <option value="">Select Country</option>
                                            @foreach(\App\Models\Unit::all() as $list)
                                                <option value="{{ $list->name }}" {{ $list->name == $unit->driver ? 'selected' : '' }}>
                                                    {{ $list->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Gender -->
                                    <div class="col-md-4 mb-6">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option value="Male" {{ $unit->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ $unit->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                            <option value="Other" {{ $unit->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>

                                    <!-- Organization -->
                                    <div class="col-md-4 mb-6">
                                        <label for="description">Organization</label>
                                        <input name="description" id="description" class="form-control" placeholder="Organization Name" required value="{{ $unit->description }}">
                                    </div>

                                    <!-- Designation -->
                                    <div class="col-md-4 mb-6">
                                        <label for="fare">Designation</label>
                                        <input type="text" name="fare" id="fare" class="form-control" placeholder="Designation" value="{{ $unit->fare }}" required>
                                    </div>

                                    <!-- Category -->
                                    <div class="col-md-4 mb-6">
                                        <label for="route">Category</label>
                                        <select name="route" id="route" class="form-control" required>
                                            <option value="">Select Category</option>
                                            @foreach(\App\Models\Route::all() as $list)
                                                <option value="{{ $list->name }}" {{ $unit->route == $list->name ? 'selected' : '' }}>
                                                    {{ $list->name }}
                                                </option>
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