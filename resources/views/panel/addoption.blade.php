<x-panel.layout.pages :pageinfo="$pageinfo">
    <x-panel.show-message-ontable />
    <div class="row">
        <div class="col-12">
            <form class="form"  method="POST" novalidate
                action="{{ route('options.store') }}">
                @csrf
                <div class="box box-solid  box-info box-outline-info">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-4">
                                <button type="submit"
                                    class="btn btn-rounded btn-success pull-left">{{ __('Update') }}</button>
                            </div>
                            <div class="col-4 text-center">
                            </div>
                            <div class="col-4">
                                <a href="{{ route('options.panel') }}"
                                    class="btn btn-rounded btn-danger pull-right">{{ __('Go back') }}</a>
                            </div>

                        </div>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mx-50">
                                    <label class="col-form-label">{{ __('Name') }}</label>
                                    <input type="text" class="form-control" placeholder="{{ __('Name') }}"
                                        name="name" value="{{ old('name') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mx-50">
                                    <label class="col-form-label">{{ __('Type') }}</label>
                                    <select name="type" class="form-control" placeholder="{{ __('Type') }}">
                                        <option value="select">{{ __('Select Box') }}</option>
                                        <option value="checkbox">{{ __('Check Box') }}</option>
                                        <option value="radio">{{ __('Radio Button') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mx-50">
                                    <label class="col-form-label">{{ __('Sorted') }}</label>
                                    <input type="text" class="form-control" placeholder="{{ __('Sorted') }}"
                                        name="sorted" value="{{ old('sorted') }}" />
                                </div>
                            </div>
                        </div>
                        <hr class="my-15">
                        <div class="table-responsive">
                            <table class="table b-1 border-primary ">
                                <thead class="bg-primary ">
                                    <tr>
                                        <th>{{ __('Value') }}</th>
                                        <th>{{ __('Sorted') }}</th>
                                        <th><button type="button" id="addRowtable"
                                                class="waves-effect waves-circle btn btn-circle btn-warning btn-sm"><i
                                                    class="fa fa-plus"></i></button></th>
                                    </tr>
                                </thead>
                                <script>var item = 2;</script>
                                <tbody id="tbodycontent">
                                    <tr> <td> <input type="text" class="form-control" placeholder="{{ __('Value') }}" name="optionvalues[1][value]" /></td> <td> <input type="number" class="form-control" placeholder="{{ __('Sorted') }}" name="optionvalues[1][sorted]" /></td> <td><a href="javascript:void(0)" onclick="closeparent($(this))" class=" btn btn-circle btn-danger "> <i class="ion ion-close text-white" data-toggle="control-sidebar"></i></a></td> </tr>
                                </tbody>
                            </table>
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
                                <a href="{{ route('options.panel') }}"
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
            <script>
                $(function() {
                    "use strict";
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $("#addRowtable").click(function() {
                        item++;

                        $('#tbodycontent').append(
                            '<tr> <td> <input type="text" class="form-control" placeholder="{{ __('Value') }}" name="optionvalues['+item+'][value]" /></td> <td> <input type="number" class="form-control" placeholder="{{ __('Sorted') }}" name="optionvalues['+item+'][sorted]" /></td> <td><a href="javascript:void(0)" onclick="closeparent($(this))" class=" btn btn-circle btn-danger "> <i class="ion ion-close text-white" data-toggle="control-sidebar"></i></a></td> </tr>'
                        );
                    });
                });

                function closeparent($q) {
                    $q.parent().parent().remove();
                }
            </script>
            </x-slot>
</x-panel.layout.pages>
