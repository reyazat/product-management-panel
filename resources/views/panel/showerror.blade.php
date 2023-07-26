
<div class="row">
    <div class="col-md-12 col-12">
        @if ($errors->any())
        <div class="box box-solid bg-warning box-outline-warning">
            <div class="box-header">
                <h4 class="box-title"><strong>{{ __('Error') }}</strong></h4>
              </div>
              <div class="box-body"><ul class="text-danger">
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul></div>
        </div>
        @endif
    </div>
</div>
