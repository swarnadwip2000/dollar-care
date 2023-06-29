@extends('frontend.layouts.master')
@section('meta_title')
@endsection
@section('title')
    Doctor Notifications
@endsection
@push('styles')
@endpush

@section('content')
    <section class="sidebar-sec" id="body-pd">
        <div class="container-fluid">
            <div class="sidebar-wrap d-flex justify-content-between">
                @include('frontend.doctor.partials.sidebar')
            </div>
            <!-- Content -->
            <div class="sidebar-right height-100">
                <div class="content">
                    <div class="my-app-div-wrap">
                        <div class="content-head">
                            <h2>Notification</h2>
                        </div>
                    </div>
                    <div class="notice-div-wrap" id="item-lists">
                        @include('frontend.doctor.partials.message')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script type="text/javascript">
  
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
                getData(page);
            }
        }
    });
      
    $(document).ready(function()
    {
        $(document).on('click', '.pagination a',function(event)
        {
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            event.preventDefault();
      
            var myurl = $(this).attr('href');
            var page=$(this).attr('href').split('page=')[1];
      
            getData(page);
        });
    });
      
    function getData(page){
        $.ajax({
            url: '?page=' + page,
            type: "get",
            datatype: "html",
        })
        .done(function(data){
            $("#item-lists").empty().html(data);
            location.hash = page;
        })
        .fail(function(jqXHR, ajaxOptions, thrownError){
              alert('No response from server');
        });
    }
      
    </script>
@endpush
