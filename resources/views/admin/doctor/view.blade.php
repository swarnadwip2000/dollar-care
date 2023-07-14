@extends('admin.layouts.master')
@section('title')
    {{ env('APP_NAME') }} | View Doctors Details
@endsection
@push('styles')
@endpush

@section('content')
    @php
        use App\Helpers\Helper;
    @endphp
    <div class="page-wrapper">

        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">#{{ $doctor->name }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('doctors.index') }}">Doctors</a></li>
                            <li class="breadcrumb-item active">View Doctors Details</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        {{-- <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_group"><i
                    class="fa fa-plus"></i> Add Doctors Details</a> --}}
                    </div>
                </div>
            </div>

            <div class="tab-content">
                <h3 class="card"><span class="">Doctor details of Dr. {{ $doctor['name'] }}.</span></h3>
                <div id="emp_profile" class="pro-overview tab-pane fade show active">
                    <div class="row">
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Doctor Name:-</div>
                                            <div class="text">
                                                {{ $doctor->name }}
                                            </div>
                                        </li>
                                       
                                        <li>
                                            <div class="title">Doctor Email:-</div>
                                            <div class="text">
                                                {{ $doctor->email }}
                                            </div>
                                        </li>
                                        <li>
                                            <div class="title">Doctor Phone Number:-</div>
                                            <div class="text">
                                                {{ $doctor->phone }}
                                            </div>
                                        </li>
                                        <li>
                                            <div class="title">Doctor Specialization:-</div>
                                            <div class="text">
                                               <b> {{ Helper::getDoctorSpecializations($doctor->id) }}</b>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    {{-- <h3 class="card-title"><u>Billing Information</u> </h3> --}}

                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Location:-</div>
                                            <div class="text">
                                                {{ $doctor->location }}
                                            </div>
                                        </li>
                                        <li>
                                            <div class="title">Gender:-</div>
                                            <div class="text">
                                                {{ $doctor->gender }}
                                            </div>
                                        </li>
                                        <li>
                                            <div class="title">Year of Experience:-</div>
                                            <div class="text">
                                                {{ $doctor->year_of_experience }} {{ ($doctor->year_of_experience == 1) ? 'year' : 'years' }}
                                            </div>
                                        </li>
                                        <li>
                                            <div class="title">Created At:-</div>
                                            <div class="text">
                                                {{ date('d M, Y', strtotime($doctor->created_at)) }}
                                            </div>
                                        </li>
                                        <li class="">
                                            <div class="title  ">Doctor Stauts Message:-</div>
                                            <div class="text">
                                                <span class=" bg-inverse-info"> @if($doctor->year_of_experience == true) Account is active @else Account is inactive @endif</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Clinic Details

                                    </h3>
                                    <table id="myTable" class="dd table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Clinic Name</th>
                                                <th>Clinic Phone Number</th>
                                                <th>Clinic Address</th>
                                                <th>Slot Day</th>
                                                <th>Created Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($clinics as $clinic)
                                                <tr>
                                                    <td>{{ $clinic['clinic_name'] }}</td>
                                                    <td>{{ $clinic['clinic_phone'] }}</td>
                                                    <td>{{ $clinic['clinic_address'] }}</td>
                                                    <td>
                                                        <span class="badge bg-success-light">
                                                            {{ Helper::getClinicOpeninDay($clinic['id']) }}</span>
                                                    </td>
                                                    <td>
                                                        {{ date('d M, Y', strtotime($clinic['created_at'])) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    @endsection

@push('scripts')
@endpush
