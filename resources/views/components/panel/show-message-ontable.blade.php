@if (Session::has('success'))
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="box box-solid bg-success box-outline-success">
                <div class="box-header">
                    <div class="box-tools pull-right">
                        <a id="box-close" href="#"><i class="fa fa-close text-white" aria-hidden="true"></i></a>
                    </div>
                    <h4 class="box-title"><strong>{{ __('Success') }}</strong></h4>
                </div>
                <div class="box-body">
                    <p>
                        {{ Session::get('success') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endif
@if (Session::has('warning'))
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="box box-solid bg-warning box-outline-warning">
                <div class="box-header">
                    <div class="box-tools pull-right">
                        <a id="box-close" href="#"><i class="fa fa-close text-white" aria-hidden="true"></i></a>
                    </div>
                    <h4 class="box-title"><strong>{{ __('Error') }}</strong></h4>
                </div>
                <div class="box-body">
                    <p class="text-danger">
                        {{ Session::get('warning') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endif
@if ($errors->any())
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="box box-solid bg-warning box-outline-warning">
                <div class="box-header">
                    <div class="box-tools pull-right">
                        <a id="box-close" href="#"><i class="fa fa-close text-white" aria-hidden="true"></i></a>
                    </div>
                    <h4 class="box-title"><strong>{{ __('Error') }}</strong></h4>
                </div>
                <div class="box-body">
                    <ul class="text-danger">
                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
