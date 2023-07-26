<x-panel.layout.oauth :pageinfo="$pageinfo">
    <div class="col-12">
        <div class="row justify-content-center no-gutters">
            <div class="col-lg-5 col-md-5 col-12">
                <div class="bg-white rounded30 shadow-lg">
                    <div class="content-top-agile p-20 pb-0">
                        <h2 class="text-primary">{{ __('Reset Password') }}</h2>
                    </div>
                    <div class="p-40">
                        <form action="{{ route('password.update') }}" method="post" novalidate>
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-transparent"><i
                                                        class="ti-email"></i></span>
                                            </div>
                                            <input type="email" class="form-control pl-15 bg-transparent"
                                                placeholder="{{ __('Email Address') }}" id="email" name="email"
                                                value="{{ $getmail }}" required @if(!empty($getmail))
                                                readonly
                                                @endif
                                                data-validation-required-message="پر کردن فیلد ایمیل اجباریست!"
                                                data-validation-email-message="فرمت فیلد ایمیل نادرست است!"
                                                autocomplete="email" />
                                        </div>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control pl-15 bg-transparent"
                                        placeholder="{{ __('Password') }}" id="password" name="password" required
                                        data-validation-required-message="پر کردن فیلد پسورد اجباریست!"
                                        data-validation-uppercase-regex="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                                        data-validation-uppercase-message="باید شامل حداقل یک عدد و یک حرف بزرگ و کوچک و حداقل 8 کاراکتر یا بیشتر باشد."
                                        autocomplete="new-password" />
                                </div>
                                <p class="help-block"></p>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control pl-15 bg-transparent"
                                        placeholder=" {{ __('Confirm Password') }} " id="password-confirm"
                                        name="password_confirmation" data-validation-match-match="password"
                                        data-validation-match-message="فیلد تکرار رمز عبود با فیلد رمز عبور مطابقت ندارد!" />
                                </div>
                                <p class="help-block"></p>
                            </div>

                            @include('panel.showerror')
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-info margin-top-10"> {{ __('Reset Password') }} </button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                    </div>
                </div>

                {{-- x-panel.auth.social-signin  --}}

            </div>
        </div>
    </div>

    <x-slot:script>
        <script src="{{ url('js/panel/validation.js') }}"></script>
        <script src="{{ url('js/pages/form-validation.js') }}"></script>

        </x-slot>

</x-panel.layout.oauth>
