<x-panel.layout.oauth :pageinfo="$pageinfo">
    <div class="col-12">
        <div class="row justify-content-center no-gutters">
            <div class="col-lg-5 col-md-5 col-12">
                <div class="bg-white rounded30 shadow-lg">
                    <x-panel.show-message />
                    <div class="content-top-agile p-20 pb-0">
                        <h2 class="text-primary">فرم ثبت درخواست API</h2>
                        <p class="mb-0">توسعه دهنده گرامی از اینکه به ما می پیوندید خرسندیم.</p>
                    </div>
                    <div class="p-40">
                        <form action="{{ route('register') }}" method="post" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-transparent"><i
                                                        class="ti-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control pl-15 bg-transparent"
                                                placeholder="{{ __('Name') }}" id="name" name="name"
                                                value="{{ old('name') }}" required
                                                data-validation-required-message="پر کردن فیلد نام اجباریست!"
                                                autocomplete="name" autofocus />
                                        </div>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="{{ __('Surname') }}"
                                                id="surname" name="surname" value="{{ old('surname') }}" required
                                                data-validation-required-message="پر کردن فیلد نام خانوادگی اجباریست!"
                                                autocomplete="surname" />
                                        </div>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-transparent"><i
                                                        class="ti-email"></i></span>
                                            </div>
                                            <input type="email" class="form-control pl-15 bg-transparent"
                                                placeholder="{{ __('E-Mail Address') }}" id="email" name="email"
                                                value="{{ old('email') }}" required
                                                data-validation-required-message="پر کردن فیلد ایمیل اجباریست!"
                                                data-validation-email-message="فرمت فیلد ایمیل نادرست است!"
                                                autocomplete="email" />
                                        </div>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group mb-3">

                                            <input type="number" class="form-control" placeholder="E.g. 09121234567"
                                                id="mobile" name="mobile" value="{{ old('mobile') }}" required
                                                data-validation-required-message="پر کردن فیلد شماره تماس اجباریست!"
                                                data-validation-number-message="فرمت فیلد شماره تماس نادرست است!"
                                                autocomplete="mobile" />
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
                                        autocomplete="password" />
                                </div>
                                <p class="help-block"></p>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control pl-15 bg-transparent"
                                        placeholder="{{ __('Confirm Password') }}" id="password-confirm"
                                        name="password_confirmation" data-validation-match-match="password"
                                        data-validation-match-message="فیلد تکرار رمز عبود با فیلد رمز عبور مطابقت ندارد!" />
                                </div>
                                <p class="help-block"></p>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <input type="checkbox" id="basic_checkbox_1"
                                                name="terms_and_conditions" value="1" {{ !old('terms') ?: 'checked' }} required
                                                data-validation-required-message="گزینه قوانین باید تایید شود">
                                            <label for="basic_checkbox_1"> <a href="#"
                                                    class="text-warning"><b>قوانین
                                                    </b></a> را می پذیرم</label>
                                        </div>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                            </div>
                            @include('panel.showerror')
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-info margin-top-10">{{ __('Register') }}</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                        <div class="text-center">
                            <p class="mt-15 mb-0">{{ __('Already have an account?') }}<a href="{{ route('login') }}"
                                    class="text-warning ml-5">{{ __('Login') }}</a></p>
                        </div>
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
