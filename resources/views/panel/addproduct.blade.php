<x-panel.layout.pages :pageinfo="$pageinfo">
    <x-panel.show-message-ontable />
    <link rel="stylesheet" href="{{ url('css/panel/persian-datepicker.min.css') }}">

    <div class="row">
        <div class="col-12">
            <form class="form" id="" method="POST" novalidate     action="{{ route('products.store') }}">
                @csrf
                <div class="box box-solid  box-info box-outline-info">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-4">
                                <button type="submit"
                                    class="btn btn-rounded btn-success pull-left">{{ __('Add') }}</button>
                            </div>
                            <div class="col-4 text-center">
                            </div>
                            <div class="col-4">
                                <a href="{{ route('products.panel') }}"
                                    class="btn btn-rounded btn-danger pull-right">{{ __('Go back') }}</a>
                            </div>

                        </div>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs justify-content-center" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#general"
                                    role="tab"><span><i class="fa fa-fw fa-cog"></i></span> <span
                                        class="hidden-xs-down ml-15">{{ __('General') }}</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#datashit"
                                    role="tab"><span><i class="fa fa-fw fa-file-text"></i></span> <span
                                        class="hidden-xs-down ml-15">{{ __('Data') }}</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#links"
                                    role="tab"><span><i class="fa fa-fw fa-link"></i></span> <span
                                        class="hidden-xs-down ml-15">{{ __('Links') }}</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#options"
                                    role="tab"><span><i class="fa fa-gears"></i></span> <span
                                        class="hidden-xs-down ml-15">{{ __('Options') }}</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#images"
                                    role="tab"><span><i class="fa fa-photo"></i></span> <span
                                        class="hidden-xs-down ml-15">{{ __('Photos') }}</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#specialprice"
                                    role="tab"><span><i class="fa fa-fw fa-dollar"></i></span> <span
                                        class="hidden-xs-down ml-15">{{ __('Special Price') }}</span></a> </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content tabcontent-border">
                            <div class="tab-pane active" id="general" role="tabpanel">
                                <div class="p-20">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mx-50">
                                                <label class="col-form-label">{{ __('Product Name') }}</label>
                                                <input type="text" class="form-control"
                                                    placeholder="{{ __('Product Name') }}" name="name"
                                                    value="{{ old('name') }}" required
                                                    data-validation-required-message="پر کردن فیلد نام محصول اجباریست!" />
                                                <p class="help-block"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mx-50">
                                                <label class="col-form-label">{{ __('Slug') }}</label>
                                                <input type="text" class="form-control"
                                                    placeholder="{{ __('Slug') }}" name="slug"
                                                    value="{{ old('slug') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-15">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mx-50">
                                                <label class="col-form-label">{{ __('Short Description') }}</label>
                                                <textarea id="short_description" maxlength="500"
                                                    data-validation-maxlength-message="تعدادکاراکتر مجاز برایاین فیلد 500 کاراکتر است!" name="short_description"
                                                    rows="5" cols="100" class="form-control">{!! old('short_description') !!}</textarea>
                                                <p class="help-block"></p>

                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-15">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mx-50">
                                                <label class="col-form-label">{{ __('Description') }}</label>
                                                <textarea id="description" name="description" rows="5" cols="100" class="form-control">{!! old('description') !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-15">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mx-50">
                                                <label class="col-md-12">{{ __('Meta Title') }}</label>
                                                <input type="text" class="form-control pl-15 bg-transparent"
                                                    placeholder="{{ __('Meta Title') }}" name="meta_title"
                                                    value="{{ old('meta_title') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mx-50">
                                                <label class="col-md-12">{{ __('Meta Description') }}</label>
                                                <textarea rows="2" class="form-control" placeholder="{{ __('Meta Description') }}" name="meta_description">{{ old('meta_description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mx-50">
                                                <label class="col-md-12">{{ __('Product Tags') }}</label>
                                                <input type="text" class="form-control pl-15 bg-transparent"
                                                    placeholder="{{ __('Product Tags') }}" name="tags"
                                                    value="{{ old('tags') }}" />
                                                <span class="form-text text-muted text-light">با کاما (کامای انگیلیسی
                                                    ,) از یکدیگر
                                                    جدا نمایید</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane" id="datashit" role="tabpanel">
                                <div class="p-20">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mx-50">
                                                <label class="col-form-label">SKU - واحد نگهداری انبار</label>
                                                <input type="text" class="form-control"
                                                    placeholder="SKU - واحد نگهداری انبار" name="sku"
                                                    value="{{ old('sku') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mx-50">
                                                <label class="col-form-label">{{ __('Price') }} - تومان</label>
                                                <input type="text" class="form-control"
                                                    placeholder="{{ __('Price') }}" name="price"
                                                    value="{{ number_format(old('price'),2) }}" required
                                                    data-validation-required-message="پر کردن فیلد قیمت اجباریست!" />
                                                <p class="help-block"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mx-50">
                                                <label class="col-form-label">{{ __('Supplier Price') }} -
                                                    تومان</label>
                                                <input type="text" class="form-control"
                                                    placeholder="{{ __('Supplier Price') }}" name="supplier_price"
                                                    value="{{ number_format(old('supplier_price'),2) }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mx-50">
                                                <label class="col-form-label">{{ __('Value added tax') }}</label>
                                                <select name="tax_class_id" class="form-control"
                                                    placeholder="{{ __('Choose') }}">
                                                    <option class="text-light" value="0">{{ __('Choose') }}</option>
                                                    @foreach ($taxclasses->pluck('name', 'id') as $key => $value)
                                                        <option value="{{ $key }}"
                                                            @if (old('tax_class_id') == $key) selected="selected" @endif>
                                                            {{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mx-50">
                                                <label class="col-form-label">{{ __('Quantity') }}</label>
                                                <input type="text" class="form-control"
                                                    placeholder="{{ __('Quantity') }}" name="quantity"
                                                    value="{{ old('quantity') }}" required
                                                    data-validation-required-message="پر کردن فیلد تعداد اجباریست!" />
                                                <p class="help-block"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mx-50">
                                                <label class="col-form-label">{{ __('Minimum Quantity') }}</label>
                                                <input type="text" class="form-control"
                                                    placeholder="{{ __('Minimum Quantity') }}" name="minimum"
                                                    value="{{ old('minimum') }}" />
                                                <span class="form-text text-muted text-light">اجبار برای خرید حداقل
                                                    مقدار کالا</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mx-50">
                                                <label class="col-form-label">{{ __('Date Available') }}</label>
                                                <input type="text" class="form-control persiandt"
                                                    placeholder="{{ __('Date Available') }}" name="date_available"
                                                    value="{{ old('date_available') }}" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mx-40">
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">{{ __('Length') }} -
                                                    {{ __('Cm') }}</label>
                                                <input type="text" class="form-control"
                                                    placeholder="{{ __('Length') }}" name="length"
                                                    value="{{ number_format(old('length'),2) }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">{{ __('Width') }} -
                                                    {{ __('Cm') }}</label>
                                                <input type="text" class="form-control"
                                                    placeholder="{{ __('Width') }}" name="width"
                                                    value="{{ number_format(old('width'),2) }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">{{ __('Height') }} -
                                                    {{ __('Cm') }}</label>
                                                <input type="text" class="form-control"
                                                    placeholder="{{ __('Height') }}" name="height"
                                                    value="{{ number_format(old('height'),2) }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">{{ __('Weight') }} -
                                                    {{ __('Kg') }}</label>
                                                <input type="text" class="form-control"
                                                    placeholder="{{ __('Weight') }}" name="weight"
                                                    value="{{ number_format(old('weight') ,2) }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mx-50">
                                                <label class="col-form-label">{{ __('Status') }}</label>
                                                <select name="status" class="form-control"
                                                    placeholder="{{ __('Status') }}">
                                                    <option value="1"
                                                        @if (old('status') == 1) selected="selected" @endif>
                                                        {{ __('Active') }}</option>
                                                    <option value="0"
                                                        @if (old('status') == 0) selected="selected" @endif>
                                                        {{ __('Inactive') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mx-50">
                                                <label class="col-form-label">{{ __('Sort') }}</label>
                                                <input type="number" class="form-control"
                                                    placeholder="{{ __('Sort') }}" name="sorted"
                                                    value="{{ old('sorted') }}" />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane" id="links" role="tabpanel">
                                <div class="p-20">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mx-50">
                                                <label class="col-form-label">{{ __('Manufacturers') }}</label>
                                                <select name="manufacturer_id" class="form-control"
                                                    placeholder="{{ __('Manufacturers') }}">
                                                    <option class="text-light" value="0">{{ __('Choose') }}</option>
                                                    @foreach ($manufacturers->pluck('name', 'id') as $key => $value)
                                                        <option value="{{ $key }}">
                                                            {{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mx-50">
                                                <label class="col-form-label">{{ __('Categories') }}</label>
                                                <select name="categories[]" class="form-control select2"
                                                    multiple="multiple" data-placeholder="{{ __('Categories') }}"
                                                    style="width: 100%; text-align: right">
                                                    @foreach ($categories as $category)
                                                        @if (isset($category['parent']) && !empty($category['parent']['name']))
                                                            <option value="{{ $category['id'] }}">
                                                                {{ $category['parent']['name'] }} --->>
                                                                {{ $category['name'] }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $category['id'] }}">
                                                                {{ $category['name'] }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mx-50">
                                                <label class="col-form-label">{{ __('Related Products') }}</label>
                                                <select name="related_products[]" class="form-control select2-related"
                                                    multiple="multiple"
                                                    data-placeholder="{{ __('Related Products') }}"
                                                    style="width: 100%;">

                                                </select>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>
                            <div class="tab-pane" id="options" role="tabpanel">
                                <div class="p-20">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mx-50">
                                                <label class="col-form-label">{{ __('Options') }}</label>
                                                <select id="selectOption" class="form-control select2"
                                                    data-placeholder="{{ __('Options') }}"
                                                    style="width: 100%; text-align: right">
                                                    <option value="">{{ __('Choose') }}</option>
                                                    @foreach ($options as $opt)
                                                        <option value="{{ $opt['id'] }}"
                                                            data-slug="{{ $opt['slug'] }}"
                                                            data-name="{{ $opt['name'] }}">
                                                            {{ $opt['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="vtabs">
                                        <ul class="nav nav-tabs tabs-vertical" role="tablist" id="optiontab">

                                        </ul>
                                        <!-- Tab panes -->
                                        <script>
                                            var optitm = 0;
                                            var optvalitm = 0;
                                        </script>
                                        <div class="tab-content" id="optioncontent">

                                        </div>
                                    </div>



                                </div>
                            </div>
                            <div class="tab-pane" id="images" role="tabpanel">
                                <div class="p-20">
                                    <div class="row ribbon-box p-20 b-solid bg-lighter">
                                        <div class="ribbon ribbon-dark" style="position: absolute;top: -10px;"><span>
                                                {{ __('Main Photo') }} </span></div>
                                        <div class="col-5">
                                            <div class="form-group mx-50">
                                                <p class="input-group-btn">
                                                    <label class="col-form-label"> {{ __('Photo') }} </label>
                                                    <a data-input="photo" data-preview="holderphoto"
                                                        class="btn btn-primary lfm">
                                                        <i class="fa fa-picture-o"></i> {{ __('Choose File') }}
                                                    </a>
                                                </p>
                                                <input id="photo" name="image"   class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <p id="holderphoto">

                                            </p>
                                        </div>
                                    </div>
                                    <hr class="my-15">
                                    <div class="row ribbon-box p-20 b-solid bg-info-light">
                                        <button type="button" id="additionalimages"
                                            class="waves-effect waves-circle btn btn-circle btn-warning mb-5"
                                            style="position: absolute;left: 20px;top:-10px"><i
                                                class="fa fa-plus"></i></button>
                                        <div class="ribbon ribbon-info" style="position: absolute;top: -10px;"><span>
                                                {{ __('Additional Photos') }} </span></div>
                                        <div class="additionalimages col-12">

                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane" id="specialprice" role="tabpanel">
                                <div class="p-20">
                                    <div class="table-responsive">

                                        <table class="table b-1 border-primary ">
                                            <thead class="bg-primary ">
                                                <tr>
                                                    <th>{{ __('Customer groups') }}</th>
                                                    <th>{{ __('Quantity') }}</th>
                                                    <th>{{ __('Price') }}</th>
                                                    <th><button type="button" id="addRowtable"
                                                            class="waves-effect waves-circle btn btn-circle btn-warning btn-sm"><i
                                                                class="fa fa-plus"></i></button></th>
                                                </tr>
                                            </thead>
                                            <script>
                                                var spitm = 0;
                                            </script>
                                            <tbody id="tbodyspecialprice">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer with-border">
                        <div class="row">
                            <div class="col-6">
                                <button type="submit"
                                    class="btn btn-rounded btn-success pull-left">{{ __('Add') }}</button>
                            </div>

                            <div class="col-6">
                                <a href="{{ route('products.panel') }}"
                                    class="btn btn-rounded btn-danger pull-right">{{ __('Go back') }}</a>
                            </div>

                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <x-slot:dropdownbox>
        </x-slot>
        <x-slot:script>
            <script src="{{ url('js/panel/persian-date.min.js') }}"></script>
            <script src="{{ url('js/panel/persian-datepicker.min.js') }}"></script>
            <script src="{{ url('js/panel/validation.js') }}"></script>
            <script src="{{ url('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
            <script src="{{ url('assets/vendor_components/select2/dist/js/select2.min.js') }}"></script>
            <script src="{{ url('assets/vendor_components/ckeditor/ckeditor.js') }}"></script>
            <script src="{{ url('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
            <script src="{{ url('js/pages/form-validation.js') }}"></script>

            <script>
                var item = 1;
                var options1 = {
                    filebrowserImageBrowseUrl: "{{ url('filemanager?type=Images') }}",
                    filebrowserImageUploadUrl: "{{ url('filemanager/upload?type=Images&_token=') }}",
                    filebrowserBrowseUrl: "{{ url('filemanager?type=Files') }}",
                    filebrowserUploadUrl: "{{ url('filemanager/upload?type=Files&_token=') }}",
                    toolbarGroups: [{
                            name: 'document',
                            groups: ['mode']
                        },
                        {
                            name: 'basicstyles',
                            groups: ['basicstyles']
                        },
                        {
                            name: 'paragraph',
                            groups: ['list', 'indent', 'blocks', 'align', 'bidi']
                        },
                        {
                            name: 'links'
                        },
                        {
                            name: 'insert',
                        },
                        {
                            name: 'colors'
                        }
                    ]
                };
                var options2 = {
                    filebrowserImageBrowseUrl: "{{ url('filemanager?type=Images') }}",
                    filebrowserImageUploadUrl: "{{ url('filemanager/upload?type=Images&_token=') }}",
                    filebrowserBrowseUrl: "{{ url('filemanager?type=Files') }}",
                    filebrowserUploadUrl: "{{ url('filemanager/upload?type=Files&_token=') }}",
                };
                $(function() {
                    "use strict";
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $('[class*="lfm"]').each(function() {
                        $(this).filemanager('image');
                    });
                    CKEDITOR.replace('short_description', options1);
                    CKEDITOR.replace('description', options2);
                    $('.select2').select2();
                    $('.select2-related').select2({
                        multiple: true,
                        minimumInputLength: 2,
                        ajax: {
                            url: "{{ route('products.editjson') }}",
                            dataType: 'json',
                            type: 'POST',
                            delay: 250,
                            data: function(params) {
                                return {
                                    q: params.term, // search term
                                    page: params.page || 1
                                };
                            },
                            cache: false
                        },
                    });
                    $("#additionalimages").click(function() {
                        $('div.additionalimages').append(
                            '<div class="row"><div class="col-1 text-center"><a href="javascript:void(0)" onclick="closeparent($(this))" class=" btn btn-circle btn-danger mt-20"><i class="ion ion-close text-white" data-toggle="control-sidebar"></i></a></div><div class="col-5"><div class="form-group mx-50"><p class="input-group-btn"><label class="col-form-label"> {{ __('Photo') }} </label><a data-input="photo' +
                            item + '" data-preview="holder' + item +
                            '"class="btn btn-primary lfm"><i class="fa fa-picture-o"></i> {{ __('Choose File') }}</a></p><input id="photo' +
                            item +
                            '" name="images[][file_name]"  class="form-control" type="text"></div></div><div class="col-4"><p id="holder' +
                            item + '"></p></div></div>');
                        item++;
                        $('.lfm').filemanager('image');

                    });
                    $("#addRowtable").click(function() {
                        spitm++;
                        $('#tbodyspecialprice').append(
                            '<tr><td><select name="specialprice[' + spitm +
                            '][target_market_id]" class="form-control" placeholder="{{ __('Customer groups') }}"><option value="0" class="text-light">{{ __('Choose') }}</option>@foreach ($cgroups as $key => $value)<option value="{{ $key }}">{{ $value }}</option>@endforeach</select></td><td><input type="number" class="form-control"  placeholder="{{ __('Quantity') }}" name="specialprice[' +
                            spitm +
                            '][quantity]" /></td><td><input type="text" class="form-control" placeholder="{{ __('Price') }}" name="specialprice[' +
                            spitm +
                            '][price]" /></td><td><a href="javascript:void(0)" onclick="closeparent($(this))" class=" btn btn-circle btn-danger"><i class="ion ion-close text-white" data-toggle="control-sidebar"></i></a></td></tr>'
                        );
                    });

                    $('body').on('click', '.addoptionvalue', function() {
                        var table = $(this).parents("table:first");
                        var optionsob = {!! $options !!};
                        optvalitm++;
                        var inserthtml = '<tr> <input type="hidden" value="'+table.attr('data-id')+'" name="optionvalues[v'+optvalitm+'][option_id]"/><td> <select name="optionvalues[v' + optvalitm +
                            '][option_value_id]" class="form-control" > <option class="text-light"> {{ __('Choose') }} </option>';

                        $.each(optionsob, function(key, val) {
                            if (table.attr('data-id') == val.id) {
                                $.each(val.option_values, function(ky, vl) {
                                    inserthtml += '<option value="' + vl.id + '" > ' + vl.value +
                                        ' </option>';
                                });
                            }
                        });

                        inserthtml +=
                            '</select></td><td><input type="number" class="form-control" placeholder="{{ __('Quantity') }}" name="optionvalues[v' + optvalitm +
                            '][quantity]" /></td><td><select name="optionvalues[v' +
                            optvalitm +
                            '][price_prefix]" class="form-control" placeholder="{{ __('Prefix') }}"> <option value="+" > + </option> <option value="-"> - </option> </select><input type="text" class="form-control" placeholder="{{ __('Price') }}" name="optionvalues[v' + optvalitm +
                            '][price]" /></td><td><select name="optionvalues[v' +
                            optvalitm +
                            '][point_prefix]" class="form-control" placeholder="{{ __('Prefix') }}"> <option value="+" > + </option> <option value="-" > - </option> </select><input type="number" class="form-control" placeholder="{{ __('Point') }}" name="optionvalues[v' + optvalitm +
                            '][point]" /></td><td><a href="javascript:void(0)" onclick="closeparent($(this))" class=" btn btn-circle btn-danger "><i class="ion ion-close text-white"  data-toggle="control-sidebar"></i></a></td></tr>'

                        table.find('tbody').append(inserthtml);
                    });

                    $('#selectOption').on('select2:select', function() {
                        var kyoption = this.value;
                        var optionsob = {!! $options !!};
                        optitm++;
                        optvalitm++;
                        $('#optiontab').append(
                            '<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#' + $(this)
                            .find(':selected').data('slug') + optitm +
                            '" role="tab"><i class="fa fa-minus-square text-danger" onclick="closetabs(this,\'#' +
                            $(this)
                            .find(':selected').data('slug') + optitm + '\')" aria-hidden="true"></i>&nbsp;  ' +
                            $(this).find(':selected').data(
                                'name') + ' </a> </li>');

                        var inserthtml = '<div class="tab-pane" id="' + $(this).find(':selected').data('slug') +
                            optitm +
                            '" role="tabpanel"><div class="p-15"><div class="row"><div class="col-md-12"><input type="hidden" value="'+kyoption+'" name="options[o'+optitm+'][option_id]"/><div class="form-group mx-50"><label class="col-form-label">{{ __('Required') }}</label> <select class="form-control" data-placeholder="{{ __('Required') }}" style="width: 100%; text-align: right" name="options[o' +
                            optitm +
                            '][required]"> <option value="0">{{ __('No') }} </option> <option value="1">{{ __('Yes') }} </option> </select> </div> </div> </div> <div class="table-responsive"> <table class="table b-1 border-primary " data-id="' +
                            kyoption +
                            '"> <thead class="bg-primary "> <tr><th>{{ __('Value') }}</th><th>{{ __('Quantity') }}</th><th>{{ __('Price') }}</th><th>{{ __('Point') }}</th><th><button type="button" class="addoptionvalue waves-effect waves-circle btn btn-circle btn-warning btn-sm"><i class="fa fa-plus"></i></button> </th> </tr> </thead> <tbody id="tbodyoptions"> <tr> <input type="hidden" value="'+kyoption+'" name="optionvalues[v'+optvalitm+'][option_id]"/><td> <select name="optionvalues[v' + optvalitm +
                            '][option_value_id]" class="form-control" > <option class="text-light"> {{ __('Choose') }} </option>';

                        $.each(optionsob, function(key, val) {
                            if (kyoption == val.id) {
                                $.each(val.option_values, function(ky, vl) {
                                    inserthtml += '<option value="' + vl.id + '" > ' + vl.value +
                                        ' </option>';
                                });
                            }
                        });

                        inserthtml +=
                            '</select></td><td><input type="number" class="form-control" placeholder="{{ __('Quantity') }}" name="optionvalues[v' + optvalitm +
                            '][quantity]" /></td><td><select name="optionvalues[v' +
                            optvalitm +
                            '][price_prefix]" class="form-control" placeholder="{{ __('Prefix') }}"> <option value="+" > + </option> <option value="-"> - </option> </select><input type="text" class="form-control" placeholder="{{ __('Price') }}" name="optionvalues[v' + optvalitm +
                            '][price]" /></td><td><select name="optionvalues[v' +
                            optvalitm +
                            '][point_prefix]" class="form-control" placeholder="{{ __('Prefix') }}"> <option value="+" > + </option> <option value="-" > - </option> </select><input type="number" class="form-control" placeholder="{{ __('Point') }}" name="optionvalues[v' + optvalitm +
                            '][point]" /></td><td><a href="javascript:void(0)" onclick="closeparent($(this))" class=" btn btn-circle btn-danger "><i class="ion ion-close text-white"  data-toggle="control-sidebar"></i></a></td></tr></tbody></table></div></div></div>'

                        $("#optioncontent").append(inserthtml);

                        $('#optiontab li:last-child a').tab('show');

                        $('#selectOption').val(null).trigger('change');

                    });

                    $(".persiandt").pDatepicker({viewMode: 'year',minDate: new persianDate().unix(),format: 'YYYY-MM-DD',});
                });

                function closeparent($q) {
                    $q.parent().parent().remove();
                }

                function closetabs(q, id) {
                    $(q).closest('li').remove();
                    $(id).remove();
                    $('#optiontab li:last-child a').tab('show');
                }
            </script>
            </x-slot>
</x-panel.layout.pages>
