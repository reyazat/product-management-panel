<x-panel.layout.pages :pageinfo="$pageinfo">
    <x-panel.show-message-ontable />
    <link rel="stylesheet" href="{{ url('css/panel/persian-datepicker.min.css') }}">

    <div class="row">
        <div class="col-12">
            <form class="form" id="" method="POST" novalidate
                action="{{ route('products.update', $product->id) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="editid" value="{{ $product->id }}" />
                <div class="box box-solid  box-info box-outline-info">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-4">
                                <button type="submit"
                                    class="btn btn-rounded btn-success pull-left">{{ __('Update') }}</button>
                            </div>
                            <div class="col-4 text-center">
                                <h4 class="box-title">{{ $product->name }}</h4>
                                <h6 class="box-subtitle">{{ __('Price') }} : {{ number_format($product->price,2) }} تومان</h6>
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
                                                    value="{{ $product->name }}" required
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
                                                    value="{{ $product->slug }}" />
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
                                                    rows="5" cols="100" class="form-control">{!! $product->short_description !!}</textarea>
                                                <p class="help-block"></p>

                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-15">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mx-50">
                                                <label class="col-form-label">{{ __('Description') }}</label>
                                                <textarea id="description" name="description" rows="5" cols="100" class="form-control">{!! $product->description !!}</textarea>
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
                                                    value="{{ $product->meta_title }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mx-50">
                                                <label class="col-md-12">{{ __('Meta Description') }}</label>
                                                <textarea rows="2" class="form-control" placeholder="{{ __('Meta Description') }}" name="meta_description">{{ $product->meta_description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mx-50">
                                                <label class="col-md-12">{{ __('Product Tags') }}</label>
                                                <input type="text" class="form-control pl-15 bg-transparent"
                                                    placeholder="{{ __('Product Tags') }}" name="tags"
                                                    value="{{ $product->tags }}" />
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
                                                    value="{{ $product->sku }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mx-50">
                                                <label class="col-form-label">{{ __('Price') }} - تومان</label>
                                                <input type="text" class="form-control"
                                                    placeholder="{{ __('Price') }}" name="price"
                                                    value="{{ number_format($product->price,2) }}" required
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
                                                    value="{{ number_format($product->supplier_price,2) }}" />
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
                                                            @if ($product->tax_class_id == $key) selected="selected" @endif>
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
                                                    value="{{ $product->quantity }}" required
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
                                                    value="{{ $product->minimum }}" />
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
                                                    value="{{ $product->date_available }}" />
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
                                                    value="{{ number_format($product->length,2) }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">{{ __('Width') }} -
                                                    {{ __('Cm') }}</label>
                                                <input type="text" class="form-control"
                                                    placeholder="{{ __('Width') }}" name="width"
                                                    value="{{ number_format($product->width,2) }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">{{ __('Height') }} -
                                                    {{ __('Cm') }}</label>
                                                <input type="text" class="form-control"
                                                    placeholder="{{ __('Height') }}" name="height"
                                                    value="{{ number_format($product->height,2) }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">{{ __('Weight') }} -
                                                    {{ __('Kg') }}</label>
                                                <input type="text" class="form-control"
                                                    placeholder="{{ __('Weight') }}" name="weight"
                                                    value="{{ number_format($product->weight ,2) }}" />
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
                                                        @if ($product->status == 1) selected="selected" @endif>
                                                        {{ __('Active') }}</option>
                                                    <option value="0"
                                                        @if ($product->status == 0) selected="selected" @endif>
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
                                                    value="{{ $product->sorted }}" />
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
                                                        <option value="{{ $key }}"
                                                            @if ($product->manufacturer_id == $key) selected="selected" @endif>
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
                                                            <option value="{{ $category['id'] }}"
                                                                @if (in_array(
                                                                        $category['id'],
                                                                        $product->categories()->pluck('id')->toArray())) selected="selected" @endif>
                                                                {{ $category['parent']['name'] }} --->>
                                                                {{ $category['name'] }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $category['id'] }}"
                                                                @if (in_array(
                                                                        $category['id'],
                                                                        $product->categories()->pluck('id')->toArray())) selected="selected" @endif>
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
                                                    @foreach ($product->relatedProducts->pluck('name', 'id') as $key => $rproduct)
                                                        <option value="{{ $key }}" selected="selected">
                                                            {{ $rproduct }}</option>
                                                    @endforeach
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
                                            @foreach ($product->options as $op => $popt)
                                                <li class="nav-item "> <a
                                                        class="nav-link @if ($loop->first) active @endif"
                                                        data-toggle="tab" href="#{{ $popt->slug . $op }}"
                                                        role="tab">
                                                        <i class="fa fa-minus-square text-danger"
                                                            onclick="closetabs(this,'#{{ $popt->slug . $op }}')"
                                                            aria-hidden="true"></i>&nbsp;
                                                        {{ $popt->name }} </a> </li>
                                            @endforeach
                                        </ul>
                                        <!-- Tab panes -->
                                        <script>
                                            var optitm = 0;
                                            var optvalitm = 0;
                                        </script>
                                        <div class="tab-content" id="optioncontent">
                                            @foreach ($product->options as $op => $popt)
                                                <script>
                                                    optitm = {{ $op }};
                                                </script>
                                                <div class="tab-pane @if ($loop->first) active @endif"
                                                    id="{{ $popt->slug . $op }}" role="tabpanel">
                                                    <div class="p-15">
                                                        <div class="row">
                                                            <input type="hidden" value="{{ $popt->id }}" name="options[o{{ $op }}][option_id]" />

                                                            <div class="col-md-12">
                                                                <div class="form-group mx-50">
                                                                    <label
                                                                        class="col-form-label">{{ __('Required') }}</label>
                                                                    <select class="form-control"
                                                                        data-placeholder="{{ __('Required') }}"
                                                                        style="width: 100%; text-align: right"
                                                                        name="options[o{{ $op }}][required]">
                                                                        <option
                                                                            @if ($popt->pivot->required == 0) selected="selected" @endif
                                                                            value="0">{{ __('No') }}
                                                                        </option>
                                                                        <option
                                                                            @if ($popt->pivot->required == 1) selected="selected" @endif
                                                                            value="1">{{ __('Yes') }}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive">

                                                            <table class="table b-1 border-primary "
                                                                data-id="{{ $popt->id }}">
                                                                <thead class="bg-primary ">
                                                                    <tr>
                                                                        <th>{{ __('Value') }}</th>
                                                                        <th>{{ __('Quantity') }}</th>
                                                                        <th>{{ __('Price') }}</th>
                                                                        <th>{{ __('Point') }}</th>
                                                                        <th><button type="button"
                                                                                class=" addoptionvalue waves-effect waves-circle btn btn-circle btn-warning btn-sm"><i
                                                                                    class="fa fa-plus"></i></button>
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tbodyoptions">
                                                                    @foreach ($product->optionValues()->wherePivot('option_id', '=', $popt->id)->get() as $vl => $val)
                                                                        <script>
                                                                            optvalitm = {{ $vl }};
                                                                        </script>
                                                                        <tr>
                                                                            <input type="hidden" value="{{ $popt->id }}" name="optionvalues[v{{ $vl }}][option_id]" />

                                                                            <td> <select
                                                                                    name="optionvalues[v{{ $vl }}][option_value_id]"
                                                                                    class="form-control">
                                                                                    <option class="text-light">
                                                                                        {{ __('Choose') }}
                                                                                    </option>
                                                                                    @foreach ($popt->optionValues as $value)
                                                                                        <option
                                                                                            value="{{ $value->id }}"
                                                                                            @if ($value->id == $val->id) selected="selected" @endif>
                                                                                            {{ $value->value }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select></td>
                                                                            <td><input type="number"
                                                                                    class="form-control"
                                                                                    placeholder="{{ __('Quantity') }}"
                                                                                    name="optionvalues[v{{ $vl }}][quantity]"
                                                                                    value="{{ $val->pivot->quantity }}" />

                                                                            </td>
                                                                            <td>
                                                                                <select
                                                                                    name="optionvalues[v{{ $vl }}][price_prefix]"
                                                                                    class="form-control"
                                                                                    placeholder="{{ __('Prefix') }}">
                                                                                    <option value="+"
                                                                                        @if ($val->pivot->price_prefix == '+') selected="selected" @endif>
                                                                                        +</option>
                                                                                    <option value="-"
                                                                                        @if ($val->pivot->price_prefix == '-') selected="selected" @endif>
                                                                                        -</option>
                                                                                </select>
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    placeholder="{{ __('Price') }}"
                                                                                    name="optionvalues[v{{ $vl }}][price]"
                                                                                    value="{{ number_format($val->pivot->price,2) }}" />

                                                                            </td>
                                                                            <td>
                                                                                <select
                                                                                    name="optionvalues[v{{ $vl }}][point_prefix]"
                                                                                    class="form-control"
                                                                                    placeholder="{{ __('Prefix') }}">
                                                                                    <option value="+"
                                                                                        @if ($val->pivot->point_prefix == '+') selected="selected" @endif>
                                                                                        +</option>
                                                                                    <option value="-"
                                                                                        @if ($val->pivot->point_prefix == '-') selected="selected" @endif>
                                                                                        -</option>
                                                                                </select>
                                                                                <input type="number"
                                                                                    class="form-control"
                                                                                    placeholder="{{ __('Point') }}"
                                                                                    name="optionvalues[v{{ $vl }}][point]"
                                                                                    value="{{ $val->pivot->point }}" />

                                                                            </td>
                                                                            <td><a href="javascript:void(0)"
                                                                                    onclick="closeparent($(this))"
                                                                                    class=" btn btn-circle btn-danger "><i
                                                                                        class="ion ion-close text-white"
                                                                                        data-toggle="control-sidebar"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
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
                                                <input id="photo" name="image" value="{{ $product->image }}"
                                                    class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <p id="holderphoto">
                                                @if (!empty($product->image))
                                                    <img src="{{ $product->image }}" style="height: 5rem;" />
                                                @endif
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
                                            @if ($product->productImages->isNotEmpty())
                                                @foreach ($product->productImages as $key => $value)
                                                    <div class="row">
                                                        <div class="col-1 text-center">
                                                            <a href="javascript:void(0)"
                                                                onclick="closeparent($(this))"
                                                                class=" btn btn-circle btn-danger mt-20"><i
                                                                    class="ion ion-close text-white"
                                                                    data-toggle="control-sidebar"></i></a>
                                                        </div>
                                                        <div class="col-5">
                                                            <div class="form-group mx-50">
                                                                <p class="input-group-btn">
                                                                    <label class="col-form-label">
                                                                        {{ __('Photo') }}
                                                                    </label><a
                                                                        data-input="editphoto{{ $value->product_id }}"
                                                                        data-preview="editholder{{ $value->product_id }}"class="btn btn-primary lfm">
                                                                        <i class="fa fa-picture-o"></i>
                                                                        {{ __('Choose File') }}</a>
                                                                </p><input id="editphoto{{ $value->product_id }}"
                                                                    name="images[][file_name]" class="form-control"
                                                                    value="{{ $value->file_name }}" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <p id="editholder{{ $value->product_id }}">
                                                                @if (!empty($value->file_name))
                                                                    <img src="{{ $value->file_name }}"
                                                                        style="height: 5rem;" />
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
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
                                                @foreach ($product->customerGroups as $itm => $val)
                                                    <script>
                                                        spitm = {{ $itm }};
                                                    </script>

                                                    <tr>
                                                        <td> <select
                                                                name="specialprice[{{ $itm }}][target_market_id]"
                                                                class="form-control"
                                                                placeholder="{{ __('Customer groups') }}">
                                                                <option class="text-light" value="0">{{ __('Choose') }}
                                                                </option>
                                                                @foreach ($cgroups as $key => $value)
                                                                    <option value="{{ $key }}"
                                                                        @if ($key == $val->pivot->target_market_id) selected="selected" @endif>
                                                                        {{ $value }}</option>
                                                                @endforeach
                                                            </select></td>
                                                        <td><input type="number" class="form-control"
                                                                placeholder="{{ __('Quantity') }}"
                                                                name="specialprice[{{ $itm }}][quantity]"
                                                                value="{{ $val->pivot->quantity }}" />

                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                placeholder="{{ __('Price') }}"
                                                                name="specialprice[{{ $itm }}][price]"
                                                                value="{{ number_format($val->pivot->price,2) }}" />

                                                        </td>
                                                        <td><a href="javascript:void(0)"
                                                                onclick="closeparent($(this))"
                                                                class=" btn btn-circle btn-danger "><i
                                                                    class="ion ion-close text-white"
                                                                    data-toggle="control-sidebar"></i></a></td>
                                                    </tr>
                                                @endforeach

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
                                    class="btn btn-rounded btn-success pull-left">{{ __('Update') }}</button>
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
                            '][target_market_id]" class="form-control" placeholder="{{ __('Customer groups') }}"><option class="text-light" value="0">{{ __('Choose') }}</option>@foreach ($cgroups as $key => $value)<option value="{{ $key }}">{{ $value }}</option>@endforeach</select></td><td><input type="number" class="form-control"  placeholder="{{ __('Quantity') }}" name="specialprice[' +
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

                    $(".persiandt").pDatepicker({minDate: new persianDate().unix(),initialValue: false,format: 'YYYY-MM-DD',});

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
