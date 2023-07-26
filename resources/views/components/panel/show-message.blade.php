@if(Session::has('warning'))
  <div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> {{ __('Error') }}!</h4>
    {{ Session::get('warning')}}
  </div>
  @endif
  @if(Session::has('success'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> {{ __('Success') }}!</h4>
    {{ Session::get('success')}}
  </div>
  @endif
