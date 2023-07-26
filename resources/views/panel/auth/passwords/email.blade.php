
<x-panel.layout.oauth :pageinfo="$pageinfo">
    <div class="col-12">
        <div class="row justify-content-center no-gutters">
            <div class="col-lg-5 col-md-5 col-12">
                <div class="bg-white rounded30 shadow-lg">
                    <div class="content-top-agile p-20 pb-0">
                        <h2 class="text-primary">{{ __('Reset Password') }}</h2>
                    </div>
                    <div class="p-40">
                        @if (session('status'))
                            <div class="media align-items-center bg-success mb-20">
                                <div class="media-body">
                                    {{ session('status') }}
                                </div>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}" novalidate  @error('email') class="error" @enderror>
                            @csrf
                            <div class="form-group  @error('email') error @enderror" >
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="email" class="form-control pl-15 bg-transparent"
                                        placeholder="{{ __('Email Address') }}" id="email" name="email"
                                        value="{{ old('email') }}" required
                                        data-validation-required-message="پر کردن فیلد ایمیل اجباریست!"
                                        data-validation-email-message="فرمت فیلد ایمیل نادرست است!"
                                        autocomplete="current-email" />
                                </div>
                                <p class="help-block"></p>
                                @error('email')
                                <ul class="text-danger" role="alert">
                                    <li>{{ $message }}</li>
                                </ul>
                            @enderror
                            </div>

                            <!-- /.col -->
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary mt-10"> {{ __('Send Password Reset Link') }}</button>
                                </div>

                                <!-- /.col -->
                            </div>
                        </form>


                        <div class="text-center">
                            <p class="mt-15 mb-0">بازگشت به صفحه <a href="{{ route('login') }}"
                                    class="text-warning ml-5">ورود </a></p>
                        </div>
                    </div>
                </div>

                {{-- x-panel.auth.social-signin  --}}

            </div>
        </div>
    </div>

    <x-slot:script>
        <script src="{{ url('js/pages/validation.js') }}"></script>
        <script src="{{ url('js/pages/form-validation.js') }}"></script>
        </x-slot>

</x-panel.layout.oauth>
