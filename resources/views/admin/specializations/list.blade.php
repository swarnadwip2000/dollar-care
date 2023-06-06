@extends('admin.layouts.master')
@section('title')
    All Specialization Details - {{env('APP_NAME')}} admin
@endsection
@push('styles')
<style>
    .dataTables_filter{
        margin-bottom: 10px !important;
    }
</style>
@endpush

@section('content')
    <section id="loading">
        <div id="loading-content"></div>
    </section>
    <div class="page-wrapper">

        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Specializations Information</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('specializations.index') }}">Specializations</a></li>
                            <li class="breadcrumb-item active">List</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="{{ route('specializations.create') }}" class="btn add-btn" ><i
                                class="fa fa-plus"></i> Add a Specialization</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-0">Specializations Details</h4>
                            </div>

                        </div>
                    </div>

                    <hr />
                    <div class="table-responsive">
                        <table id="myTable" class="dd table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Specializations Name </th>
                                    <th> Slug </th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($specializations as $key => $specialization)
                                    <tr>
                                        <td>
                                            {{ $specialization['name'] }}
                                        </td>
                                        <td>
                                            {{ $specialization['slug'] }}
                                        </td>
                                        <td>
                                            @if ($specialization['image'])
                                            <img src="{{ Storage::url($specialization->image) }}" alt="Specialization Image"
                                            width="70px" height="70px" style="border-radius: 50%">
                                            @endif
                                        </td>
                                        <td>
                                            <div class="button-switch">
                                                <input type="checkbox" id="switch-orange" class="switch toggle-class"
                                                    data-id="{{ $specialization['id'] }}"
                                                    {{ $specialization['status'] ? 'checked' : '' }} />
                                                <label for="switch-orange" class="lbl-off"></label>
                                                <label for="switch-orange" class="lbl-on"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a title="Edit Specialization" data-route=""
                                                href="{{ route('specializations.edit', $specialization->id) }}"><i class="fas fa-edit"></i></a> &nbsp;&nbsp;

                                            <a title="Delete Specialization" data-route="{{ route('specializations.delete', $specialization->id) }}"
                                                href="javascipt:void(0);" id="delete"><i class="fas fa-trash"></i></a>
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
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            //Default data table
            $('#myTable').DataTable({
                "aaSorting": [],
                "columnDefs": [{
                        "orderable": false,
                        "targets": [2,3,4]
                    },
                    {
                        "orderable": true,
                        "targets": [0, 1]
                    }
                ]
            });

        });
    </script>
    <script>
        $(document).on('click', '#delete', function(e) {
            swal({
                    title: "Are you sure?",
                    text: "To delete this specialization.",
                    type: "warning",
                    confirmButtonText: "Yes",
                    showCancelButton: true
                })
                .then((result) => {
                    if (result.value) {
                        window.location = $(this).data('route');
                    } else if (result.dismiss === 'cancel') {
                        swal(
                            'Cancelled',
                            'Your stay here :)',
                            'error'
                        )
                    }
                })
        });
    </script>
    <script>
        $('.toggle-class').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
    
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{route("specializations.change-status")}}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function(resp) {
                    console.log(resp.success)
                }
            });
        });
    </script>
@endpush
