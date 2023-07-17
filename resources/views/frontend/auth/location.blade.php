@extends('frontend.auth.master')
@section('meta_title')
@endsection
@section('title')
    Otp Verification
@endsection

@push('styles')

@endpush

@section('content')

<!-- Modal -->
<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Please set your location!!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close" data-bs-target="#mySidenav" data-bs-toggle="modal" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> 

@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $('.modal').modal('show');
        //toggle modal when click on close button
        $('.close').click(function(){
            $('.modal').modal('hide');
            window.location.href = "{{ url('/') }}";
        });
    });
</script>


@endpush