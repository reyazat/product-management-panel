<x-panel.layout.pages :pageinfo="$pageinfo">
    <x-panel.show-message-ontable />

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ __('Customer groups') }}</h3>
            <button type="button" data-toggle="modal" data-target="#addGroup"
                class="waves-effect waves-light btn btn-success pull-right"><i class="fa fa-plus"></i>
                {{ __('Add') }}</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="cgrouplist" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Slug') }}</th>
                            <th>{{ __('Descriptions') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Slug') }}</th>
                            <th>{{ __('Descriptions') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

    <div id="addGroup" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="addGroupLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-horizontal" method="Post" novalidate id="addGroupForm">
                @csrf
                <input type="hidden" name="editid" value="" id="editid" />
                <input type="hidden" name="status" value="" id="editstatus" />
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
                                <p class="help-block"></p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">{{ __('Slug') }}</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control pl-15 bg-transparent"
                                    placeholder="{{ __('Slug') }}" id="slug" name="slug"
                                    value="{{ old('Slug') }}"  />
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">{{ __('Descriptions') }}</label>
                            <div class="col-md-12">
                                <textarea rows="2" class="form-control" placeholder="{{ __('Descriptions') }}" id="descriptions"
                                    name="description">{{ old('description') }}</textarea>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-md-12">{{ __('تایید مشتریان جدید') }}</label>
                            <div class="col-md-12">
                                <input type="checkbox" id="md_checkbox_3" class="chk-col-success"
                                    name="approve_customer" value="1">
                                <label for="md_checkbox_3">مشتریان قبل از ورود باید توسط یک مدیر تایید شوند.</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p id="validerror" class="text-danger ml-20"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submitform" class="btn btn-success">{{ __('Add') }}</button>
                        <button type="button" class="btn btn-default float-right"
                            data-dismiss="modal">{{ __('Cancel') }}</button>
                    </div>
                </div>
            </form>

            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <x-slot:dropdownbox>
        </x-slot>
        <x-slot:script>
            <script src="{{ url('assets/vendor_components/datatable/datatables.min.js') }}"></script>
            <script src="{{ url('assets/vendor_components/sweetalert/sweetalert.min.js') }}"></script>
            <script src="{{ url('js/panel/validation.js') }}"></script>
            <script>
                $(function() {
                    "use strict";
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var cgroupTable = $('#cgrouplist').DataTable({
                        dom: 'lB<"dt-buttons btn-delall">frtip',
                        bProcessing: true,
                        order: [],
                        select: {
                            style: 'multi',
                            selector: 'td:not(:last-child)'
                        },
                        lengthMenu: [
                            [10, 25, 50, -1],
                            ['10', '25', '50', 'all']
                        ],
                        buttons: [{
                                extend: 'collection',
                                text: 'Select',
                                className: 'btn-dark ml-10',
                                buttons: [
                                    'selectAll', 'selectNone'
                                ],
                                dropup: true
                            },
                            {
                                extend: 'collection',
                                text: 'Export',
                                buttons: [{
                                        extend: "print",
                                        title: "{{ __('Customer groups') }}",
                                    },
                                    {
                                        extend: "excel",
                                        title: "{{ __('Customer groups') }}"
                                    },

                                ],
                                dropup: true
                            }
                        ],
                        "ajax": {
                            "url": "{{ route('customergroups.json') }}",
                        },
                        columns: [{
                                data: 'name',
                                orderable: true,
                            },
                            {
                                data: 'slug',
                                orderable: true,
                            },
                            {
                                data: 'description',
                                orderable: true,
                            },
                            {
                                data: null,
                                render: function(data, type, row) {
                                    var status;
                                    switch (data.status) {
                                        case 1:
                                            status = '{{ __('Active') }}';
                                            break;
                                        case 0:
                                            status = '{{ __('Inactive') }}';
                                            break;
                                    }
                                    return status;
                                }
                            },

                            {
                                data: null,
                                className: "dt-center editor-delete editor-edit",
                                orderable: false,
                                render: function(data, type, row) {
                                    var action =
                                        '<a href="javascript:void(0)" class="text-danger ml-5" onclick="cusgrpdel(' +
                                        data.id +
                                        ')" data-original-title="Delete" ><i class="ti-trash"></i></a> <a onclick="cusgrpedit(' +
                                        data.id +
                                        ')" id="cusgrpedit" href="javascript:void(0)" class="text-info mr-5" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';
                                    if (data.status) {
                                        action +=
                                            '<a href="javascript:void(0)" class="text-danger ml-5" onclick="rejectrequest(' +
                                            data.id +
                                            ')" data-original-title="Reject" > <span class="badge badge-danger"><i class="fa fa-thumbs-down faa-vertical animated"></i> </span></a>';
                                    } else {
                                        action += '<a onclick="acceptrequest(' +
                                            data.id +
                                            ')" id="acceptrequest" href="javascript:void(0)" class="text-info ml-5" data-original-title="Accept"><span class="badge badge-success"><i class="fa fa-thumbs-up faa-vertical animated"></i> </span></a> ';
                                    }
                                    return action;
                                }

                            }
                        ],
                    });

                    $('div.btn-delall').html(
                        '<button type="button" id="cusgrpdelall" class="waves-effect waves-light btn btn-danger ml-5"><i class="fa fa-close"></i> {{ __('Delete Selected') }}</button>'
                    );
                    $('#cusgrpdelall').click(function() {
                        if (cgroupTable.rows({
                                selected: true
                            }).count() > 0) {

                            swal({
                                title: "{{ __('Are you sure you want to delete the selected resources?') }}",
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
                                    var ids = cgroupTable.rows({
                                        selected: true
                                    }).data().map(function(a) {
                                        return a.id;
                                    }).join(',');
                                    $.post("{{ route('customergroups.deleteall') }}", {
                                        grpids: ids
                                    }, function(data) {
                                        cgroupTable.ajax.reload();
                                        swal("{{ __('Delete Selected') }}",
                                            "{{ __('The selected resources were deleted.') }}",
                                            data.type);
                                    }, "json");
                                } else {
                                    return false;
                                }
                            });
                        } else {
                            swal("{{ __('Error') }}", "{{ __('Please select one or more rows first!') }}",
                                "error");
                        }
                    });

                    $('#addGroup').on('hide.bs.modal', function(e) {
                        $('#validerror').html('');
                        iCheck($('#md_checkbox_3'), 'uncheck');
                        $('#editid').val('');
                        $('#editstatus').val('');
                        $('#addGroupForm').each(function() {
                            this.reset();
                        });
                    });

                    $("input,select,textarea").jqBootstrapValidation({
                        submitSuccess: function($form, event) {
                            var formdata = $form.serializeArray();
                            formdata.push({
                                name: "ajax",
                                value: 1
                            });
                            var editid = $('#editid').val();
                            console.log(typeof(editid));
                            if (typeof(editid) != "undefined" && editid !== null && editid !== '') {
                                var url = "{{ route('customergroups.update', '') }}" + "/" + editid;
                                $.ajax({
                                    type: 'PUT',
                                    url: url,
                                    data: formdata,
                                    cache: false,
                                    statusCode: {
                                        422: function(data) {
                                            var errorstag = '<ul>'
                                            $.each(data.responseJSON.errors, function(key, value) {
                                                errorstag += '<li>' + value[0] + '</li>'
                                            });
                                            errorstag += '</ul>'
                                            $('#validerror').html(errorstag);
                                        }
                                    },
                                    success: function(data) {
                                        if (data.type == 'success') {
                                            $('#cgrouplist').DataTable().ajax.reload();
                                            $('#addGroup').modal('hide');

                                            swal("{{ __('Add') }}",
                                                "{{ __('The action ran successfully!') }}",
                                                'success');
                                        }

                                    }
                                });

                            } else {
                                var url = "{{ route('customergroups.store') }}";
                                $.ajax({
                                    type: 'POST',
                                    url: url,
                                    data: formdata,
                                    cache: false,
                                    statusCode: {
                                        422: function(data) {
                                            var errorstag = '<ul>'
                                            $.each(data.responseJSON.errors, function(key, value) {
                                                errorstag += '<li>' + value[0] + '</li>'
                                            });
                                            errorstag += '</ul>'
                                            $('#validerror').html(errorstag);
                                        }
                                    },
                                    success: function(data) {
                                        if (data.type == 'success') {
                                            $('#cgrouplist').DataTable().ajax.reload();
                                            $('#addGroup').modal('hide');

                                            swal("{{ __('Add') }}",
                                                "{{ __('The action ran successfully!') }}",
                                                'success');
                                        }

                                    }
                                });

                            }

                            event.preventDefault();
                            return false;
                        }

                    });
                });

                function acceptrequest(id) {
                    var url = "{{ route('customergroups.statusupdate', '') }}" + "/" + id;
                    $.ajax({
                        type: 'PUT',
                        url: url,
                        data: {
                            'status': 1,
                            'ajax': 1
                        },
                        success: function(data) {
                            $('#cgrouplist').DataTable().ajax.reload();
                            swal("{{ __('Active') }}", "{{ __('The action ran successfully!') }}", 'success');
                        }
                    });
                }

                function rejectrequest(id) {
                    var url = "{{ route('customergroups.statusupdate', '') }}" + "/" + id;
                    $.ajax({
                        type: 'PUT',
                        url: url,
                        data: {
                            'status': 0,
                            'ajax': 1
                        },
                        success: function(data) {
                            $('#cgrouplist').DataTable().ajax.reload();
                            swal("{{ __('Inactive') }}", "{{ __('The action ran successfully!') }}", 'error');
                        }
                    });
                }

                function cusgrpedit(id) {
                    iCheck($('#md_checkbox_3'), 'uncheck');
                    $('#validerror').html('');
                    $('#addGroupForm').each(function() {
                        this.reset();
                    });
                    var url = "{{ route('customergroups.edit', '') }}" + "/" + id;
                    $.getJSON(url, function(data) {
                        $('#name').val(data.data.name);
                        $('#editid').val(data.data.id);
                        $('#editstatus').val(data.data.status);
                        $('#slug').val(data.data['slug']);
                        $('#descriptions').val(data.data['description']);
                        if (data.data['approve_customer']) iCheck($('#md_checkbox_3'), 'check');
                        $('#addGroup').modal('show');
                    });
                }

                function iCheck(input, variable) {

                    if (variable == 'check') {
                        input.attr("checked", "checked");
                    } else {
                        input.removeAttr("checked");
                    }
                }



                function cusgrpdel(id) {
                    swal({
                        title: "آیا مطمئن هستید که می‌خواهید این گروه را حذف کنید؟",
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
                            var url = "{{ route('customergroups.delete', '') }}" + "/" + id;
                            $.ajax({
                                type: 'DELETE',
                                url: url,
                                success: function(data) {
                                    $('#cgrouplist').DataTable().ajax.reload();
                                    swal("حذف",
                                        "گروه مذکور از لیست حذف شد.", data.type);
                                }
                            });
                        } else {
                            return false;
                        }
                    });
                }
            </script>
            </x-slot>
</x-panel.layout.pages>
