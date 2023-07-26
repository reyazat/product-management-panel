<x-panel.layout.oauth :pageinfo="$pageinfo">
    <div class="col-12">
        <div class="row justify-content-center no-gutters">
            <div class="col-lg-5 col-md-5 col-12">
                <div class="bg-white rounded30 shadow-lg">
                <x-panel.show-message />
                    <div class="content-top-agile p-20 pb-0">
                        <h2 class="text-primary">فرم ورود </h2>
                        <p class="mb-0">کاربر گرامی برای استفاده از خدمات ما لطفا وارید حساب کاربری خود شوید.</p>
                    </div>
                    <div class="p-40">

                        <form method="POST" action="{{ route('login') }}" novalidate>
                            @csrf
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="email" class="form-control pl-15 bg-transparent"
                                        placeholder="{{ __('Email Address') }}" id="email" name="email"
                                        value="{{ old('email') }}" required
                                        data-validation-required-message="پر کردن فیلد ایمیل اجباریست!"
                                        data-validation-email-message="فرمت فیلد ایمیل نادرست است!"
                                        autocomplete="current-email" autofocus />
                                </div>
                                <p class="help-block"></p>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control pl-15 bg-transparent"
                                        placeholder="{{ __('Password') }}" id="password" name="password" required
                                        data-validation-required-message="پر کردن فیلد پسورد اجباریست!"
                                        data-validation-uppercase-regex="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                                        data-validation-uppercase-message="باید شامل حداقل یک عدد و یک حرف بزرگ و کوچک و حداقل 8 کاراکتر یا بیشتر باشد."
                                        autocomplete="current-password" />
                                </div>
                                <p class="help-block"></p>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="checkbox">
                                        <input type="checkbox" id="basic_checkbox_1"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="basic_checkbox_1"> {{ __('Remember Me') }}</label>
                                    </div>
                                </div>
                                <!-- /.col -->
                                @if (Route::has('password.request'))
                                <div class="col-6">
                                    <div class="fog-pwd text-right rtl">
                                        <a href="{{ route('password.request') }}" class="hover-warning"> <i
                                                class="ion ion-locked"></i> {{ __('Forgot Your Password?') }} </a><br>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @include('panel.showerror')
                            <!-- /.col -->
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-danger mt-10">{{ __('Login') }}</button>
                                </div>

                                <!-- /.col -->
                            </div>
                        </form>


                        <div class="text-center">
                            <p class="mt-15 mb-0">{{ __("Don't have an account?") }}<a href="{{ route('register') }}"
                                    class="text-warning ml-5">{{ __('Register') }}</a></p>
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
