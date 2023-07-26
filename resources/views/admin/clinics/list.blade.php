@extends('admin.layouts.master')
@section('title')
    All Clinic Details - {{ env('APP_NAME') }} admin
@endsection
@push('styles')
    <style>
        .dataTables_filter {
            margin-bottom: 10px !important;
        }
    </style>
@endpush

@section('content')
    @php
        use App\Models\User;
    @endphp
    <section id="loading">
        <div id="loading-content"></div>
    </section>
    <div class="page-wrapper">

        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Clinics Information</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('clinics.index') }}">Clinics</a></li>
                            <li class="breadcrumb-item active">List</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-0">Clinics Details</h4>
                            </div>

                        </div>
                    </div>

                    <hr />
                    <div class="table-responsive">
                        <table id="myTable" class="dd table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Doctor Name</th>
                                    <th>Doctor Email</th>
                                    <th> Clinic Name</th>
                                    <th>Clinic Address</th>
                                    <th>Clinic Phone Number</th>
                                    <th>Slot Days</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            var table = $('#myTable').DataTable({
                "columnDefs": [{
                        "orderable": false,
                        "targets": [0, 1, 5]
                    },
                    {
                        "orderable": true,
                        "targets": [2 , 3, 4]
                    }
                ], 
                processing: true,
                serverSide: true,
                ajax: "{{ route('clinics.list-ajax') }}",
                columns: [{
                        data: 'doctor_name',
                        name: 'doctor_name',
                        orderable: false,
                    },
                    {
                        data: 'doctor_email',
                        name: 'doctor_email',
                        orderable: false,
                    },
                    {
                        data: 'clinic_name',
                        name: 'clinic_name'
                    },
                    {
                        data: 'clinic_address',
                        name: 'clinic_address',
                    },
                    {
                        data: 'clinic_phone',
                        name: 'clinic_phone'
                    },
                    {
                        data: 'slot_day',
                        name: 'slot_day',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

        });
    </script>
    
@endpush
