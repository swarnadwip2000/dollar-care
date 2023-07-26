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
                    <div class="search-box-wrap d-flex mt-2">
                        <div class="search-box">
                            <form action="{{ route('search-doctor') }}">
                                <input type="search" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Search doctor here..." name="search">
                                    <input type="hidden" name="type" value="{{ $type }}">
                                    @if($type == 'symptoms')
                                        <input type="hidden" name="slug" value="{{ $data->symptom_slug }}">
                                    @elseif($type == 'specialization')
                                        <input type="hidden" name="slug" value="{{ $data->slug }}">
                                    @endif

                                    <div class="mn-btn search-btn">
                                        <button type="submit">Search</button>
                                    </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
                <div class="col-xl-7">
                    <div class="search-filter-box d-flex">
                        <div class="search-filter-box-1">
                            <!-- <form action="">
                                <label for="exampleFormControlInput1" class="form-label">Location</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Search location...">
                            </form> -->
                        </div>
                        <div class="search-filter-box-1">
                            <form action="">
                                <label for="exampleFormControlInput1" class="form-label">Filter</label>
                                <select class="form-select" aria-label="Default select example" name="clinicSearch" id="clinicSearch">
                                    <option value="1" selected>Clinical Consultation</option>
                                    <option value="2">Clinical & Video consultation</option>
                                </select>
                                <input type="hidden" name="type" id="type" value="{{ $type }}">
                                @if($type == 'symptoms')
                                    <input type="hidden" name="slug" id="slug" value="{{ $data->symptom_slug }}">
                                @elseif($type == 'specialization')
                                    <input type="hidden" name="slug" id="slug" value="{{ $data->slug }}">
                                @endif
                            </form>
                        </div>
                        <div class="search-filter-box-1">
                            <form action="">
                                <label for="exampleFormControlInput1" class="form-label">Sort by</label>
                                <select class="form-select" aria-label="Default select example" name="alphabeticsearch" id="alphabeticsearch">
                                    <option selected>Sort by alphabet</option>
                                    <option value="1">A-Z</option>
                                    <option value="2">Z-A</option>
                                </select>
                                <input type="hidden" name="type" id="type" value="{{ $type }}">
                                @if($type == 'symptoms')
                                    <input type="hidden" name="slug" id="slug" value="{{ $data->symptom_slug }}">
                                @elseif($type == 'specialization')
                                    <input type="hidden" name="slug" id="slug" value="{{ $data->slug }}">
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="doc-list" id="searchResultsContainer">
    @if(!$status)
        @include('frontend.ajax-doctor-list')
    @else
    <div class="container" >
        <div class="doc-list-wrap">
            <div class="doc-list-head">
                <div class="head-1 h-b">
                    @if($type == 'specialization')
                    <h2>{{ $data['name'] }}</h2>
                    @else
                    <h2>{{ $data['symptom_name'] }}</h2>
                    @endif
                </div>
                <div class="doc-avl d-flex mt-2">
                    <div class="doc-avl-img">
                        <img src="{{ asset('frontend_assets/images/doc-v.png') }}" alt="">
                    </div>
                    <div class="doc-avl-text">
                        @if($doctors->count() > 0)
                        <h4>{{ $doctors->count() }} Doctors available</h4>
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
                            <h5></h5>
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
@endif
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
<script>
  $(document).ready(function() {


    // Function to fetch search results based on the selected alphabet
    function fetchResults(alphabet, type, slug) {
        var url = '{{route("doctor-filter")}}'
      $.ajax({
        url: url,
        method: 'GET',
        data: { alphabet: alphabet, type: type, slug: slug },
        success: function(data) {
            console.log(data);
            $('#searchResultsContainer').html(data.view);
        },
        error: function() {
          console.log('Error fetching results.');
        }
      });
    }

    // Function to fetch search results based on the selected alphabet
    function fetchClinics(alphabet, type, slug) {
        var url = '{{route("doctor-filter")}}'
      $.ajax({
        url: url,
        method: 'GET',
        data: { alphabet: alphabet, type: type, slug: slug },
        success: function(data) {
            console.log(data);
            $('#searchResultsContainer').html(data.view);
        },
        error: function() {
          console.log('Error fetching results.');
        }
      });
    }

    // Trigger the fetchResults function when the select box value changes
    $('#alphabeticsearch').on('change', function() {
      var selectedAlphabet = $(this).val();
      var type = $("#type").val();
      var slug = $("#slug").val();
      fetchResults(selectedAlphabet, type, slug);
    });

    $('#clinicSearch').on('change', function() {
      var selectedClinic = $(this).val();
      var type = $("#type").val();
      var slug = $("#slug").val();
      fetchClinics(selectedClinic, type, slug);
    });
  });
</script>

@endpush
