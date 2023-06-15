@extends('frontend.layouts.master')
@section('meta_title')
@endsection
@section('title')
    Services
@endsection
@push('styles')
@endpush

@section('content')
@php
    use App\Models\User;
@endphp
<section class="inr-bnr">
    <div class="inr-bnr-img">
        <img src="{{ asset('frontend_assets/images/doc-list-bg.jpg') }}" alt="" />
        <div class="inr-bnr-text">
            <h1>Doctors</h1>
        </div>
    </div>
</section>

@if($doctors->count() > 0)
<section class="search-doc">
    <div class="container">
        <div class="search-doc-wrap">
            <div class="row justify-content-between align-items-center">
                <div class="col-xl-4">
                    <div class="search-text">
                        <h3>Search Doctor</h3>
                    </div>
                    <div class="search-box-wrap d-flex">
                        <div class="search-box">
                            <form action="">
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Search location here...">
                            </form>
                        </div>
                        <div class="mn-btn search-btn">
                            <a href="#"><span>Search</span></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7">
                    <div class="search-filter-box d-flex">
                        <div class="search-filter-box-1">
                            <form action="">
                                <label for="exampleFormControlInput1" class="form-label">Location</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Search location...">
                            </form>
                        </div>
                        <div class="search-filter-box-1">
                            <form action="">
                                <label for="exampleFormControlInput1" class="form-label">Filter</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Clinical Consultation</option>
                                    <option value="1">Clinical Consultation 1</option>
                                    <option value="2">Clinical Consultation 2</option>
                                    <option value="3">Clinical Consultation 3</option>
                                </select>
                            </form>
                        </div>
                        <div class="search-filter-box-1">
                            <form action="">
                                <label for="exampleFormControlInput1" class="form-label">Sort by</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Alphabetic</option>
                                    <option value="1">Alphabetic 1</option>
                                    <option value="2">Alphabetic 2</option>
                                    <option value="3">Alphabetic 3</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="doc-list">
    <div class="container">
        <div class="doc-list-wrap">
            <div class="doc-list-head">
                <div class="head-1 h-b">
                    @if($type == 'specialization')
                    <h2>{{ $data['name'] }}</h2>
                    @else
                    <h2>{{ $data['symptom_name'] }}</h2>
                    @endif
                </div>
                <div class="doc-avl d-flex">
                    <div class="doc-avl-img">
                        <img src="{{ asset('frontend_assets/images/doc-v.png') }}" alt="">
                    </div>
                    <div class="doc-avl-text">
                        @if($data['doctor_count'] > 0)
                        <h4>{{ $data['doctor_count'] }} Doctors available</h4>
                        @else
                        <h4>No Doctors available</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($doctors as $doctor)
            <div class="col-xl-3 col-md-6 col-12">
                <div class="doc-spl-wrap-box">
                    <div class="doc-spl">
                        <div class="doc-spl-img-box">
                            @if($doctor->profile_picture)
                            <img src="{{ Storage::url($doctor->profile_picture) }}" alt="">
                            @else
                            <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                            @endif
                        </div>
                        <div class="find-doc-slide-text">
                            <h3>Dr. {{ $doctor->name }}</h3>
                            <h4>{{ User::getDoctorSpecializations($doctor['id']) }}</h4>
                            <h5>Beadon Street</h5>
                            <div class="pec-div">
                                <span class="pec"><i class="fa-solid fa-thumbs-up"></i>99%</span>
                                <span class="exp"><span class="dot-1"></span> {{ $doctor->year_of_experience }} Years Exp</span>
                            </div>
                        </div>
                        <div class="bk-btn">
                            <a href="{{ route('booking-and-consultancy', encrypt($doctor->id)) }}"><span>book an appointment</span></a>
                        </div>
                    </div>
                    
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@else
<section class="career">
    <div class="container">
      <div class="wrapper">
        <div class="content">
          <h1>No Doctor Found</h1>
        </div>
      </div>
    </div>
  </section>
@endif
@endsection

@push('scripts')
@endpush
