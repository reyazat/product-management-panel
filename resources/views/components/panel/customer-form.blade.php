<aside class="control-sidebar">

    <div class="rpanel-title closecustform"><span class="pull-right btn btn-circle btn-danger"
            data-toggle="control-sidebar"><i class="fa fa-close text-white"></i></span> </div> <!-- Create the tabs -->
    <ul class="nav nav-tabs control-sidebar-tabs" id="custab">

        <li class="nav-item"><a href="#control-sidebar-settings-tab" id="companytab" data-toggle="tab"
                class="font-size-18 active"><i class="fa fa-building"></i>{{ __('legal') }}</a></li>
        <li class="nav-item"><a href="#control-sidebar-home-tab" id="personaltab" data-toggle="tab"
                class="font-size-18 "><i class="fa fa-user-plus"></i>{{ __('real') }}</a></li>
    </ul>
    <div class="tab-content mb-30">

        <div class="tab-pane active" id="control-sidebar-settings-tab">

            <form class="form" id="companyform" method="POST" novalidate action="{{ route('customer.store') }}">
                @csrf
                <input type="hidden" name="companyuserid" value="" id="cuserid">
                <input type="hidden" name="type" value="legal">

                <div class="box-body">
                    <h4 class="box-title text-info"><i class="ti-user mr-15"></i>{{ __('Company Info') }}</h4>
                    <hr class="my-15">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="{{ __('Company Name') }}"
                                    name="companyname" value="{{ old('companyname') }}" required
                                    data-validation-required-message="پر کردن فیلد نام شرکت اجباریست!" id="cname">
                                <p class="help-block"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control"
                                    placeholder="{{ __("Company's national ID") }}" name="companyidentity"
                                    value="{{ old('companyidentity') }}" required
                                    data-validation-required-message="پر کردن فیلد شناسه ملی اجباریست!" id="cidentity">
                                <p class="help-block"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="کد مالیاتی شرکت"
                                    name="companytax" value="{{ old('companytax') }}" id="ctax">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="{{ __('Mobile Num') }}"
                                    name="companymobile" value="{{ old('companymobile') }}" required
                                    data-validation-required-message="پر کردن فیلد شماره موبایل اجباریست!"
                                    data-validation-number-message="فرمت فیلد شماره موبایل نادرست است!"
                                    pattern="[0-9]{11}"
                                    data-validation-pattern-message="فرمت فیلد شماره موبایل نادرست است!" id="cmobile">
                                <span>E.g. 09121234567</span>
                                <p class="help-block"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="{{ __('Phone Num') }}"
                                    name="companyphone" value="{{ old('companyphone') }}"
                                    data-validation-number-message="فرمت فیلد شماره ثابت نادرست است!" id="cphone">
                                <p class="help-block"></p>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="{{ __('Email Address') }}"
                                    name="companyemail" value="{{ old('companyemail') }}" required
                                    data-validation-required-message="پر کردن فیلد ایمیل اجباریست!"
                                    data-validation-email-message="فرمت فیلد ایمیل نادرست است!" id="cemail">
                                <p class="help-block"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">نام صاحبان امضا شرکت</label>
                                <textarea rows="2" class="form-control" placeholder="نام صاحبان امضا شرکت" name="companysign" id="csign">{{ old('companysign') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="{{ __('Zip / Postal Code') }}"
                            name="companypostcode" value="{{ old('companypostcode') }}" pattern="[0-9]{10}"
                            data-validation-pattern-message="فرمت فیلد کد پستی نادرست است!" id="cpostcode">
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Address') }}</label>
                        <textarea rows="2" class="form-control" placeholder="{{ __('Address') }}" id="caddress"
                            name="companyaddress">{{ old('companyaddress') }}</textarea>
                    </div>
                    <div class="form-group">
						<label>{{ __('Customer groups') }}</label>
						<select name="companygroups[]" id="companygroups" class="form-control select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
						  @foreach ($groups as $key => $group)
                          <option value="{{ $key }}">{{ $group }}</option>
                          @endforeach
						</select>
					  </div>
                    <div class="form-group">
                        <label>روزنامه رسمی</label>
                        <p class="input-group-btn">
                            <a data-input="companyfile" data-preview="cholder" class="lfm btn btn-primary">
                                <i class="fa fa-picture-o"></i> {{ __('Choose File') }}
                            </a>
                        </p>
                        <input id="companyfile" name="companyfile" value="{{ old('companyfile') }}"
                            class="form-control" type="text">
                    </div>
                    <p id="cholder" style="margin-top:15px;max-height:100px;"></p>



                </div>
                <div class="box-footer mb-20">
                    <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1 closecustform"
                        data-toggle="control-sidebar">
                        <i class="ti-trash"></i> {{ __('Cancel') }}
                    </button>
                    <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                        <i class="ti-save-alt"></i> {{ __('Save') }}
                    </button>
                </div>
            </form>



        </div>
        <div class="tab-pane" id="control-sidebar-home-tab">

            <form class="form" id="personalform" method="POST" novalidate
                action="{{ route('customer.store') }}">
                @csrf

                <input type="hidden" name="type" value="real">
                <input type="hidden" name="personaluserid" value="" id="puserid">
                <div class="box-body">
                    <h4 class="box-title text-info"><i class="ti-user mr-15"></i>{{ __('Personal Info') }}</h4>
                    <hr class="my-15">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="{{ __('Full name') }}"
                                    name="personalfullname" value="{{ old('personalfullname') }}" required
                                    data-validation-required-message="پر کردن فیلد نام و نام خانوادگی اجباریست!"
                                    id="pname">
                                <p class="help-block"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="{{ __('Identity Num') }}"
                                    name="personalidentity" value="{{ old('personalidentity') }}" required
                                    data-validation-required-message="پر کردن فیلد کد ملی اجباریست!"
                                    pattern="[0-9]{10}" data-validation-pattern-message="فرمت فیلد کد ملی نادرست است!"
                                    id="pidentity">
                                <p class="help-block"></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="{{ __('Mobile Num') }}"
                                    name="personalmobile" value="{{ old('personalmobile') }}" required
                                    data-validation-required-message="پر کردن فیلد شماره موبایل اجباریست!"
                                    data-validation-number-message="فرمت فیلد شماره موبایل نادرست است!"
                                    pattern="[0-9]{11}"
                                    data-validation-pattern-message="فرمت فیلد شماره موبایل نادرست است!"
                                    id="pmobile">
                                <span>E.g. 09121234567</span>
                                <p class="help-block"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="{{ __('Phone Num') }}"
                                    name="personalphone" value="{{ old('personalphone') }}"
                                    data-validation-number-message="فرمت فیلد شماره ثابت نادرست است!" id="pphone">
                                <p class="help-block"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="{{ __('Email Address') }}"
                                    name="personalemail" value="{{ old('personalemail') }}" required
                                    data-validation-required-message="پر کردن فیلد ایمیل اجباریست!"
                                    data-validation-email-message="فرمت فیلد ایمیل نادرست است!" id="pemail">
                                <p class="help-block"></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="{{ __('Zip / Postal Code') }}"
                            name="personalpostcode" value="{{ old('personalpostcode') }}" pattern="[0-9]{10}"
                            data-validation-pattern-message="فرمت فیلد کد پستی نادرست است!" id="ppostcode">
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Address') }}</label>
                        <textarea rows="2" class="form-control" placeholder="{{ __('Address') }}" id="paddress"
                            name="personaladdress">{{ old('personaladdress') }}</textarea>
                    </div>
                    <div class="form-group">
						<label>{{ __('Customer groups') }}</label>
						<select name="personalgroups[]" id="personalgroups" class="form-control select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
						  @foreach ($groups as $key => $group)
                          <option value="{{ $key }}">{{ $group }}</option>
                          @endforeach
						</select>
					  </div>

                    <div class="form-group">
                        <label>{{ __('Business license') }}</label>
                        <p class="input-group-btn">
                            <a data-input="personalfile" data-preview="pholder" class="btn btn-primary lfm">
                                <i class="fa fa-picture-o"></i> {{ __('Choose File') }}
                            </a>
                        </p>
                        <input id="personalfile" name="personalfile" value="{{ old('personalfile') }}"
                            class="form-control" type="text">
                    </div>
                    <p id="pholder" style="margin-top:15px;max-height:100px;"></p>


                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1 closecustform"
                        data-toggle="control-sidebar">
                        <i class="ti-trash"></i> {{ __('Cancel') }}
                    </button>
                    <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                        <i class="ti-save-alt"></i> {{ __('Save') }}
                    </button>
                </div>
            </form>



        </div>
    </div>
</aside>

<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
