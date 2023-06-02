@extends('admin.layouts.master')
@section('title')
    {{ env('APP_NAME') }} | Edit Plan Details
@endsection
@push('styles')
@endpush

@section('content')
    <div class="page-wrapper">

        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Edit Details</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Plans</a></li>
                            <li class="breadcrumb-item active">Edit Plans Details</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        {{-- <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_group"><i
                            class="fa fa-plus"></i> Add Patient</a> --}}
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-xl-12 mx-auto">
                                <h6 class="mb-0 text-uppercase">Edit A Plan</h6>
                                <hr>
                                <div class="card border-0 border-4">
                                    <div class="card-body">
                                        <form action="{{ route('plans.update', $plan->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <div class="border p-4 rounded">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="inputEnterYourName" class="col-form-label">Plan Name
                                                            <span style="color: red;">*</span></label>
                                                        <input type="text" name="plan_name" id=""
                                                            class="form-control" value="{{ $plan['plan_name'] }}"
                                                            placeholder="Enter Plan Name">
                                                        @if ($errors->has('plan_name'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('plan_name') }}</div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label"> Plan Price
                                                            <span style="color: red;">*</span></label>
                                                        <input type="text" name="plan_price" id=""
                                                            class="form-control" value="{{ $plan['plan_price'] }}"
                                                            placeholder="Enter Plan Price">
                                                        @if ($errors->has('plan_price'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('plan_price') }}</div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label"> Plan Type
                                                            <span style="color: red;">*</span></label>
                                                        <input type="text" name="plan_type" id=""
                                                            class="form-control" value="{{ $plan['plan_type'] }}"
                                                            placeholder="Enter Plan Type">
                                                        @if ($errors->has('plan_type'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('plan_type') }}</div>
                                                        @endif
                                                    </div>
                                                    {{-- <div style="display: flex;"> --}}
                                                    <div class="col-md-12">
                                                        <label for="inputEnterYourName" class="col-form-label"> Plan
                                                            Specification <span style="color: red;">*</span></label>
                                                    </div>
                                                    <div class="add-name">
                                                        @foreach ($plan->specification as $key => $vall)
                                                            <div class="row">
                                                                <div class="col-md-8 pb-3">
                                                                    <div style="display: flex">
                                                                        <input type="text" name="plan_specification[]"
                                                                            class="form-control"
                                                                            value="{{ $vall->specification_name }}"
                                                                            placeholder="Enter Plan Specification" id="plan-{{ $vall->id }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    @if ($key == 0)
                                                                        <button type="button"
                                                                            class="btn btn-success add good-button"><i
                                                                                class="fas fa-plus"></i> Add More
                                                                            Plan</button>
                                                                    @endif
                                                                    @if ($key != 0)
                                                                        <button type="button"
                                                                            class="btn btn-danger cross good-button" data-id="{{ $vall->id }}"> <i
                                                                                class="fas fa-close"></i> Remove</button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            {{-- </br> --}}
                                                        @endforeach

                                                    </div>

                                                    {{-- </div> --}}


                                                    <div class="row" style="margin-top: 20px; float: left;">
                                                        <div class="col-sm-9">
                                                            <button type="submit"
                                                                class="btn px-5 submit-btn">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".add").click(function() {

                $(".add-name").append(
                    '<div class="row"><div class="col-md-8 pb-3"><div style="display: flex"><input type="text" name="plan_specification[]" required class="form-control"  placeholder="Enter Plan Specification"></div> </div> <div class="col-md-4 "><button type="button" class="btn btn-danger cross good-button"> <i class="fas fa-close"></i> Remove</button></div>'
                );
            });
        });

        $(document).on('click', '.cross', function() {
            // remove pareent div
            $(this).parent().parent().remove();
        });
    </script>
@endpush
