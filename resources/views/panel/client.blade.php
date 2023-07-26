<x-panel.layout.pages :pageinfo="$pageinfo">
    <x-panel.show-message-ontable />

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ __('Users') }}</h3>
            <button type="button" data-toggle="modal" data-target="#addUsers"
                class="waves-effect waves-light btn btn-success pull-right"><i class="fa fa-plus"></i>
                {{ __('Add') }}</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="clientlist" class="table table-bordered table-striped display responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Revoked') }} </th>
                            <th>{{ __('Redirect URI') }} </th>
                            <th>{{ __('Client ID') }} </th>
                            <th>{{ __('Client Secret') }} </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Revoked') }} </th>
                            <th>{{ __('Redirect URI') }} </th>
                            <th>{{ __('Client ID') }} </th>
                            <th>{{ __('Client Secret') }} </th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

    <div id="addUsers" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="addUsersLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-horizontal" action="{{ route('client.store') }}" method="Post" novalidate
                id="addUserForm">
                @csrf
                <div class="modal-content">

                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-md-12">{{ __('Name') }}</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control pl-15 bg-transparent"
                                    placeholder="{{ __('Name') }}" id="name" name="name"
                                    value="{{ old('name') }}" required
                                    data-validation-required-message="پر کردن فیلد نام اجباریست!" autocomplete="name"
                                    autofocus />

                            </div>
                            <label class="col-md-12">{{ __('Redirect URL') }}</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="redirect" name="redirect"
                                    value="{{ old('redirect') }}" required placeholder="{{ __('Redirect URL') }}"
                                    data-validation-regex-regex="((http[s]?|ftp[s]?):\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*"
                                    data-validation-regex-message="{{ __('validation.url', ['attribute' => 'Redirect URL']) }}"
                                    data-validation-required-message="پر کردن فیلد Redirect URL اجباریست!"
                                    aria-invalid="true">
                            </div>
                            <p class="help-block"></p>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">{{ __('Add') }}</button>
                        <button type="button" class="btn btn-default float-right"
                            data-dismiss="modal">{{ __('Cancel') }}</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </form>

        </div>
        <!-- /.modal-dialog -->
    </div>

    <div id="editUser" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="editUserLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-horizontal" action="" method="POST" novalidate id="editUserForm">
                @csrf
                <div class="modal-content">

                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-md-12">{{ __('Name') }}</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control pl-15 bg-transparent"
                                    placeholder="{{ __('Name') }}" id="editname" name="name"
                                    value="{{ old('name') }}" required
                                    data-validation-required-message="پر کردن فیلد نام اجباریست!" autocomplete="name"
                                    autofocus />

                            </div>
                            <label class="col-md-12">{{ __('Redirect URL') }}</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="editredirect" name="redirect"
                                    value="{{ old('redirect') }}" required placeholder="{{ __('Redirect URL') }}"
                                    data-validation-regex-regex="((http[s]?|ftp[s]?):\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*"
                                    data-validation-regex-message="{{ __('validation.url', ['attribute' => 'Redirect URL']) }}"
                                    data-validation-required-message="پر کردن فیلد Redirect URL اجباریست!"
                                    aria-invalid="true">
                            </div>
                            <p class="help-block"></p>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">{{ __('Edit') }}</button>
                        <button type="button" class="btn btn-default float-right"
                            data-dismiss="modal">{{ __('Cancel') }}</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </form>

        </div>
        <!-- /.modal-dialog -->
    </div>

    <x-slot:dropdownbox>
        </x-slot>
        <x-slot:script>
            <script src="{{ url('assets/vendor_components/datatable/datatables.min.js') }}"></script>
            <script src="{{ url('assets/vendor_components/sweetalert/sweetalert.min.js') }}"></script>
            <script src="{{ url('js/panel/validation.js') }}"></script>
            <script src="{{ url('js/pages/form-validation.js') }}"></script>
            <script>
                $(function() {
                    "use strict";
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var clientTable = $('#clientlist').DataTable({
                        dom: 'lB<"dt-buttons btn-delall">frtip',
                        bProcessing: true,
                        order: [],
                        lengthMenu: [
                            [10, 25, 50, -1],
                            ['10', '25', '50', 'all']
                        ],
                        buttons: [{
                            extend: 'collection',
                            text: 'Export',
                            className: 'btn-dark ml-10',
                            buttons: [{
                                    extend: "print",
                                    title: "{{ __('Customers') }}",
                                },
                                {
                                    extend: "excel",
                                    title: "{{ __('Customers') }}"
                                },

                            ],
                            dropup: true
                        }],
                        "ajax": {
                            "url": "{{ route('clientdata.panel') }}",
                            "dataSrc": ""
                        },
                        columns: [{
                                "className": 'dt-control pl-30',
                                "orderable": false,
                                "data": null,
                                "width": "2%",
                                "defaultContent": ''
                            }, {
                                orderable: true,
                                data: 'name',
                                "createdCell": function(td, cellData, rowData, row, col) {
                                    if (rowData['revoked']) {
                                        $(td).css('color', '#fd0e0e');
                                    }
                                }
                            },
                            {
                                orderable: true,
                                data: 'revoked',
                                "createdCell": function(td, cellData, rowData, row, col) {
                                    if (rowData['revoked']) {
                                        $(td).css('color', '#fd0e0e');
                                    } else {
                                        $(td).css('color', '#0fb10f');
                                    }
                                }
                            },
                            {
                                orderable: true,
                                data: 'redirect',
                                "createdCell": function(td, cellData, rowData, row, col) {
                                    if (rowData['revoked']) {
                                        $(td).css('color', '#fd0e0e');
                                    }
                                }
                            },
                            {
                                orderable: false,
                                "className": 'none',
                                data: 'id'

                            },
                            {
                                orderable: false,
                                "className": 'none',
                                data: 'secret'

                            },
                            {
                                data: null,
                                className: "dt-center editor-edit",
                                orderable: false,
                                width: '15%',
                                render: function(data, type, row) {

                                    var action =
                                        '<a href="javascript:void(0)" class="text-danger ml-15 mr-15" onclick="clientdel(\'' +
                                        data.id +
                                        '\')" data-original-title="Delete"><i class="ti-trash"></i></a> <a onclick="clientedit(\'' +
                                        data.id +
                                        '\')" id="clientedit" href="javascript:void(0)" class="text-info mr-15 ml-15" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';
                                    if (!data.revoked) {
                                        action +=
                                            '<a href="javascript:void(0)" class="text-danger ml-15 mr-15" onclick="clientrevoke(\'' +
                                            data.id +
                                            '\')" data-original-title="Revoke"><span class="badge badge-danger">Revoke</span></a> ';
                                    } else {
                                        action +=
                                            '<a href="javascript:void(0)" class="text-success ml-15 mr-15" onclick="clientAccess(\'' +
                                            data.id +
                                            '\')" data-original-title="Access"><span class="badge badge-success">Access</span></a> ';
                                    }
                                    return action;
                                }


                            }
                        ],
                    });

                    $('#addUsers').on('shown.bs.modal', function(e) {
                        $('#addUserForm').each(function() {
                            this.reset();
                        });
                    });

                });

                function clientAccess(id) {
                    var url = "{{ route('client.access', '') }}" + "/" + id;
                    $.ajax({
                        type: 'POST',
                        url: url,
                        success: function(data) {
                            $('#clientlist').DataTable().ajax.reload();
                            swal("اهدا دسترسی ها",
                                "دسترسی کاربر مذکور مجاز شد.", data.type);
                        }
                    });
                }

                function clientrevoke(id) {
                    swal({
                        title: "آیا مطمئن هستید که می‌خواهید دسترسی این کاربر را لغو کنید؟",
                        text: "",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "{{ __('Yes, Revoke') }}",
                        cancelButtonText: "{{ __('No, Go Back') }}",
                        closeOnConfirm: false,
                        closeOnCancel: true
                    }, function(isConfirm) {
                        if (isConfirm) {
                            var url = "{{ route('client.revoke', '') }}" + "/" + id;
                            $.ajax({
                                type: 'POST',
                                url: url,
                                success: function(data) {
                                    $('#clientlist').DataTable().ajax.reload();
                                    swal("لغو دسترسی ها",
                                        "دسترسی کاربر مذکور لغو شد.", data.type);
                                }
                            });
                        } else {
                            return false;
                        }
                    });
                }

                function clientdel(id) {
                    swal({
                        title: "آیا مطمئن هستید که می‌خواهید این کاربر را حذف کنید؟",
                        text: "",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "{{ __('Yes, Delete') }}",
                        cancelButtonText: "{{ __('No, Go Back') }}",
                        closeOnConfirm: false,
                        closeOnCancel: true
                    }, function(isConfirm) {
                        if (isConfirm) {
                            var url = "{{ route('client.delete', '') }}" + "/" + id;
                            $.ajax({
                                type: 'DELETE',
                                url: url,
                                success: function(data) {
                                    $('#clientlist').DataTable().ajax.reload();
                                    swal("حذف",
                                        "کاربر مذکور از لیست حذف شد.", data.type);
                                }
                            });
                        } else {
                            return false;
                        }
                    });
                }

                function clientedit(id) {
                    $('#editUserForm').each(function() {
                        this.reset();
                    });
                    var url = "{{ route('client.update', '') }}" + "/" + id;
                    $("#editUserForm").attr('action', url);
                    $.getJSON(url, function(data) {
                        $('#editname').val(data.name);
                        $('#editredirect').val(data.redirect);
                        $('#editUser').modal('show');
                    });
                }
            </script>
            </x-slot>
</x-panel.layout.pages>
