@extends('frontend.layouts.master')
@section('meta_title')
@endsection
@section('title')
    Add Clinic Address
@endsection
@push('styles')
@endpush

@section('content')
    @php
        use Illuminate\Support\Str;
    @endphp
    <section class="sidebar-sec" id="body-pd">
        <div class="container-fluid">
            <div class="sidebar-wrap d-flex justify-content-between">
                @include('frontend.doctor.partials.sidebar')

                <!-- Content -->
                <div class="sidebar-right height-100">
                    <div class="content">
                        <div class="my-app-div-wrap">
                            <div class="content-head-wrap d-flex justify-content-between align-items-center">
                                <div class="content-head mb-4">
                                    <h2>Manage Clinic Address</h2>
                                    <h3><a href="{{ route('doctor.dashboard') }}">Dashboard</a> / Manage Clinic Address</h3>
                                </div>
                                <div class="add-address">
                                    <a href="{{ route('doctor.manage-clinic.index') }}"><span>BACK</span></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="clinical-consultation-wrap">
                                        <div class="add-address-wrap">
                                            <div class="add-address-form-box">
                                                <form action="">
                                                    <div class="row g-3">
                                                        <div class="form-group col-lg-6 col-md-12">
                                                            <input type="text" class="form-control" id="clinic_name"
                                                                name="clinic_name" value="" placeholder="Clinic Name"
                                                                required="">
                                                            @if ($errors->has('clinic_name'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('clinic_name') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group col-lg-6 col-md-12">
                                                            <input type="text" class="form-control" id="clinic_phone"
                                                                name="clinic_phone" value=""
                                                                placeholder="Phone Number" required="">
                                                            @if ($errors->has('clinic_phone'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('clinic_phone') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group col-lg-12 col-md-12">
                                                            <input type="text" class="form-control" id="clinic_address"
                                                                name="clinic_address" value=""
                                                                placeholder="Clinic Address" required="">
                                                            @if ($errors->has('clinic_address'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('clinic_address') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="time-pick">
                                                            <div class="row align-items-center">
                                                                <div class="col-xl-2">
                                                                    <div class="form-check form-check-1">
                                                                        <label class="form-check-label"
                                                                            for="flexCheckDefault">
                                                                            Select day
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-8">
                                                                    @foreach ($days as $day)
                                                                        <div class="time-pick">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" name="day_id[]"
                                                                                    value="{{ $day->id }}"
                                                                                    id="day{{ $day->id }}">
                                                                                <label class="form-check-label"
                                                                                    for="day{{ $day->id }}">
                                                                                    {{ substr(Str::upper($day->day), 0, 3) }}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <!-- <div class="time-pick">
                                                                                <input type="radio" id="tm1" name="animal" value="">
                                                                                <label for="tm1">9.00 am</label>
                                                                             </div> -->
                                                            <div class="slct-date-time">
                                                                <h4>SELECT DATE AND TIME</h4>
                                                            </div>
                                                            <div id="append-add-more"> 
                                                                <div class="sl-slot-div">
                                                                    <div class="row">
                                                                        <div class="form-group col-lg-5 col-md-12">
                                                                            <input class="form-control" id="slot_date"
                                                                                name="slot_date[]" value=""
                                                                                placeholder="Select Date" required=""
                                                                                class="textbox-n" type="text"
                                                                                onfocus="(this.type='date')" id="date" />
                                                                        </div>
                                                                        <div class="form-group col-lg-6 col-md-12">
                                                                            <div class="row">
                                                                                <div class="col-xl-5 col-lg-5 col-12">
                                                                                    <div class="input-group">
                                                                                        <label for="">Time Slot</label>
                                                                                        <select class="form-select"
                                                                                            aria-label="Default select example"
                                                                                            name="slot_start_time[]">
                                                                                            <option value="1" selected>1
                                                                                            </option>
                                                                                            <option value="1">2</option>
                                                                                            <option value="2">3</option>
                                                                                            <option value="3">4</option>
                                                                                            <option value="5">5</option>
                                                                                            <option value="6">6</option>
                                                                                            <option value="7">7</option>
                                                                                            <option value="8">8</option>
                                                                                            <option value="9">9</option>
                                                                                            <option value="10">10</option>
                                                                                            <option value="11">11</option>
                                                                                            <option value="12">12</option>
                                                                                        </select>
                                                                                        <select class="form-select"
                                                                                            aria-label="Default select example">
                                                                                            <option selected>AM</option>
                                                                                            <option value="1">PM
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-xl-5 col-lg-5 col-12">
                                                                                    <div class="input-group">
                                                                                        <label for="">to</label>
                                                                                        <select class="form-select"
                                                                                            aria-label="Default select example"
                                                                                            name="slot_end_time[]">
                                                                                            <option value="1" selected>1
                                                                                            </option>
                                                                                            <option value="1">2</option>
                                                                                            <option value="2">3</option>
                                                                                            <option value="3">4</option>
                                                                                            <option value="5">5</option>
                                                                                            <option value="6">6</option>
                                                                                            <option value="7">7</option>
                                                                                            <option value="8">8</option>
                                                                                            <option value="9">9</option>
                                                                                            <option value="10">10</option>
                                                                                            <option value="11">11</option>
                                                                                            <option value="12">12</option>
                                                                                        </select>
                                                                                        <select class="form-select"
                                                                                            aria-label="Default select example">
                                                                                            <option selected>AM</option>
                                                                                            <option value="1">PM
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            {{-- append--}}
                                                        </div>
                                                        <div class="add-more-div">
                                                            <div class="row">
                                                                <div class="col-xl-4 col-lg-4 col-12 text-left">
                                                                    <div class="add-more-btn">
                                                                        <a href="javascript:void(0)"
                                                                            class="add-more"><span> <i
                                                                                    class="fas fa-plus"></i> ADD
                                                                                MORE</span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xl-4 col-lg-4 col-12">
                                                                <div class="main-btn-p pt-4">
                                                                    <input type="submit" value="SAVE" class="sub-btn">
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
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.add-more').on('click', function() {
                $('#append-add-more').append('<div class="sl-slot-div"><div class="row"><div class="form-group col-lg-5 col-md-12"><input class="form-control" id="slot_date" name="slot_date[]"value="" placeholder="Select Date"required="" class="textbox-n" type="date" id="date" /></div><div class="form-group col-lg-6 col-md-12"><div class="row"><div class="col-xl-5 col-lg-5 col-12"><div class="input-group"><label for="">Time Slot</label><select class="form-select"aria-label="Default select example" name="slot_start_time[]"><option value="1" selected>1</option><option value="1">2</option><option value="2">3</option><option value="3">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select><select class="form-select"aria-label="Default select example"><option selected>AM</option><option value="1">PM</option></select></div></div><div class="col-xl-5 col-lg-5 col-12"><div class="input-group"><label for="">to</label><select class="form-select"aria-label="Default select example" name="slot_end_time[]"><option value="1" selected>1</option><option value="1">2</option><option value="2">3</option><option value="3">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select><select class="form-select"aria-label="Default select example"><option selected>AM</option><option value="1">PM</option></select></div></div><div class="col-xl-2 col-lg-2 col-12"><div class="delet-btn"><a href="javascript:void(0);" class="remove-slot"><span><i class="fa-solid fa-trash"></i></span></a></div></div></div></div></div></div>');
                
            });

            $(document).on('click', '.remove-slot', function() {
                $(this).closest('.sl-slot-div').remove();
            });
        });
    </script>
@endpush
