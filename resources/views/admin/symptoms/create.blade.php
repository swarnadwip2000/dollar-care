@extends('admin.layouts.master')
@section('title')
    {{ env('APP_NAME') }} | Create Symptom
@endsection
@push('styles')
@endpush

@section('content')
    <div class="page-wrapper">

        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Create</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('symptoms.index') }}">Symptoms</a></li>
                            <li class="breadcrumb-item active">Create Symptom</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        {{-- <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_group"><i
                            class="fa fa-plus"></i> Add Symptom</a> --}}
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-xl-12 mx-auto">
                                <h6 class="mb-0 text-uppercase">Create Symptom</h6>
                                <hr>
                                <div class="card border-0 border-4">
                                    <div class="card-body">
                                        <form action="{{ route('symptoms.store') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="border p-4 rounded">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label"> Specialization
                                                            <span style="color: red;">*</span></label>
                                                        <select name="specialization_id" id="specialization_id" class="form-control">
                                                            <option value="">Select Specialization</option>
                                                            @foreach ($specializations as $specialization)
                                                                <option value="{{ $specialization['id'] }}">
                                                                    {{ $specialization['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('specialization_id'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('specialization_id') }}</div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label"> Symptom Name <span
                                                                style="color: red;">*</span></label>
                                                        <input type="text" name="symptom_name" id=""
                                                            class="form-control" value="{{ old('symptom_name') }}"
                                                            placeholder="Enter Symptom Title">
                                                        @if ($errors->has('symptom_name'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('symptom_name') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label"> Status
                                                            <span style="color: red;">*</span></label>
                                                        <select name="symptom_status" id="" class="form-control">
                                                            <option value="">Select a Status</option>
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
                                                        @if ($errors->has('symptom_status'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('symptom_status') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label"> Image <span
                                                                style="color: red;">*</span></label>
                                                        <input type="file" name="symptom_image" id=""
                                                            class="form-control" value="{{ old('symptom_image') }}">
                                                        @if ($errors->has('symptom_image'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('symptom_image') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label for="inputEnterYourName" class="col-form-label"> Description
                                                            <span style="color: red;">*</span></label>
                                                        <textarea name="symptom_description" class="form-control" id="symptom_description" cols="30" rows="10">{{ old('symptom_description') }}</textarea>
                                                        @if ($errors->has('symptom_description'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('symptom_description') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="row" style="margin-top: 20px; float: left;">
                                                        <div class="col-sm-9">
                                                            <button type="submit"
                                                                class="btn px-5 submit-btn">Create</button>
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
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('symptom_description');
        CKEDITOR.on('instanceReady', function(evt) {
            var editor = evt.editor;

            editor.on('change', function(e) {
                var contentSpace = editor.ui.space('contents');
                var ckeditorFrameCollection = contentSpace.$.getElementsByTagName('iframe');
                var ckeditorFrame = ckeditorFrameCollection[0];
                var innerDoc = ckeditorFrame.contentDocument;
                var innerDocTextAreaHeight = $(innerDoc.body).height();
                console.log(innerDocTextAreaHeight);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#specialization_id').select2();
        });
    </script>
@endpush
