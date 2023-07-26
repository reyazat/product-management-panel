<x-panel.layout.pages :pageinfo="$pageinfo">
    <x-panel.show-message-ontable />

    <div class="box box-solid  box-info box-outline-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ __(':resource Details', ['resource' => 'مشتری']) }}</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="table-responsive">
                        <h3 class="box-title mt-40">{{ __('Type') }} : {{ __($user->type) }}</h3>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>{{ __('Full name') }}</td>
                                    <td> {{ $user->fullname }} </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Mobile Num') }}</td>
                                        <td> {{ $user->mobile }} </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Identity Num') }}</td>
                                    @if ($user->type == 'real')
                                        <td> {{ $user->Identity }} </td>
                                    @else
                                        <td> </td>
                                    @endif
                                </tr>

                                <tr>
                                    <td>{{ __('ZIP / Postal Code') }} {{ __('Person') }}</td>
                                    @if ($user->type == 'real')
                                        <td> {{ $user->postcode }} </td>
                                    @else
                                        <td> </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>{{ __('Address') }} {{ __('Person') }}</td>
                                    @if ($user->type == 'real')
                                        <td> {{ $user->address }} </td>
                                    @else
                                        <td> </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>{{ __('Business license') }}</td>
                                    @if ($user->type == 'real')
                                    <td> @empty($user->file)
                                        @else
                                            <a href="{{ $user->file }}" target="new"
                                                class="btn btn-rounded btn-sm btn-info m-5 p-10">{{ __('Download') }}</a>
                                        @endempty
                                    </td>
                                @else
                                    <td> </td>
                                @endif
                                </tr>

                                <tr>
                                    <td>{{ __('Customer groups') }}</td>
                                    <td>
                                        <ul>
                                            @foreach($user->customergroup as $key => $value)
                                                <li>{{ $value }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="table-responsive">
                        <h3 class="box-title mt-40">{{ __('Status') }} :
                            @switch($user->status)
                                @case(1)
                                    {{ __('Active') }}
                                @break

                                @case(0)
                                    {{ __('Inactive') }}
                                @break
                            @endswitch
                        </h3>
                        @switch($user->status)
                            @case(1)

                            <form action="{{ route('membership.update', $user->id) }}" method="POST" class="pull-right">
                                @csrf
                                @method('PUT')
                                <input name="status" value="0" type="hidden">
                                <button type="submit"
                                    class="btn btn-rounded btn-sm btn-danger m-5 pull-right">{{ __('Inactivate') }}</button>
                            </form>
                            @break

                            @case(0)
                            <form action="{{ route('membership.update', $user->id) }}" method="POST" class="pull-right">
                                @csrf
                                @method('PUT')
                                <input name="status" value="1" type="hidden">
                                <button type="submit"
                                    class="btn btn-rounded btn-sm btn-success m-5 pull-right">{{ __('Activate') }}</button>
                            </form>
                            @break
                        @endswitch
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>{{ __('Company Name') }}</td>
                                    <td> {{ $user->company }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Email Address') }}</td>
                                    <td> {{ $user->email }} </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Phone Num') }}</td>
                                    <td> {{ $user->phone }} </td>
                                </tr>
                                <tr>
                                    <td>{{ __("Company's national ID") }}</td>
                                    @if ($user->type == 'legal')
                                        <td> {{ $user->Identity }} </td>
                                    @else
                                        <td> </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>صاحبان امضا</td>
                                    <td> {{ $user->company_signatory }}</td>
                                </tr>
                                <tr>
                                    <td>کد مالیاتی</td>
                                    @if ($user->type == 'legal')
                                        <td> {{ $user->taxcode }} </td>
                                    @else
                                        <td> </td>
                                    @endif
                                </tr>

                                <tr>
                                    <td>{{ __('ZIP / Postal Code') }} {{ __('Company') }}</td>
                                    @if ($user->type == 'legal')
                                        <td> {{ $user->postcode }} </td>
                                    @else
                                        <td> </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>{{ __('Address') }} {{ __('Company') }}</td>
                                    @if ($user->type == 'legal')
                                        <td> {{ $user->address }} </td>
                                    @else
                                        <td> </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>روزنامه رسمی</td>
                                    @if ($user->type == 'legal')
                                    <td> @empty($user->file)
                                        @else
                                            <a href="{{ $user->file }}" target="new"
                                                class="btn btn-rounded btn-sm btn-info m-5 p-10">{{ __('Download') }}</a>
                                        @endempty
                                    </td>
                                @else
                                    <td> </td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.box-body -->
</div>
<x-slot:dropdownbox>
    </x-slot>
    <x-slot:script>
        </x-slot>
</x-panel.layout.pages>
