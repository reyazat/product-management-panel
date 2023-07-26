<x-panel.layout.pages :pageinfo="$pageinfo">
    <x-panel.show-message-ontable />

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ __('Value added tax') }}</h3>
            <button type="button" data-toggle="modal" data-target="#addAction"
                class="waves-effect waves-light btn btn-success pull-right"><i class="fa fa-plus"></i>
                {{ __('Add') }}</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="resourcelist" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Rate') }}</th>
                            <th>{{ __('Type') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Rate') }}</th>
                            <th>{{ __('Type') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

    <div id="addAction" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="addActionLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-horizontal" method="Post" novalidate id="addActionForm">
                @csrf
                <input type="hidden" name="editid" id="editid" />
                <input type="hidden" name="status" id="editstatus" />
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
                            <label class="col-md-12">{{ __('Rate') }}</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control pl-15 bg-transparent"
                                    placeholder="{{ __('Rate') }}" id="rate" name="rate"
                                    value="{{ old('rate') }}" required
                                    data-validation-required-message="پر کردن فیلد Rate اجباریست!" />
                                <p class="help-block"></p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">{{ __('Type') }}</label>
                            <div class="col-md-12">
                                <select name="type" id="type" class="form-control"
                                    placeholder="{{ __('Type') }}">
                                    <option value="P">{{ __("Percentage") }}</option>
                                    <option value="F">{{ __("Fixed Amount") }}</option>
                                </select>
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
                    var resourceTable = $('#resourcelist').DataTable({
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
                                        title: "{{ __('Value added tax') }}",
                                    },
                                    {
                                        extend: "excel",
                                        title: "{{ __('Value added tax') }}"
                                    },

                                ],
                                dropup: true
                            }
                        ],
                        "ajax": {
                            "url": "{{ route('taxclasses.json') }}",
                        },
                        columns: [{
                                data: 'name',
                                orderable: true,
                            },
                            {
                                data: 'rate',
                                orderable: true,
                            },
                            {
                                data: null,
                                render: function(data, type, row) {
                                    var typerow;
                                    switch (data.type) {
                                        case 'P':
                                            typerow = '{{ __("Percentage") }}';
                                            break;
                                        case 'F':
                                            typerow = '{{ __("Fixed Amount") }}';
                                            break;
                                    }
                                    return typerow;
                                }
                            },
                            {
                                data: null,
                                render: function(data, type, row) {
                                    var status;
                                    switch (data.status) {
                                        case 1:
                                            status = '{{ __("Active") }}';
                                            break;
                                        case 0:
                                            status = '{{ __("Inactive") }}';
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
                                        '<a href="javascript:void(0)" class="text-danger ml-5" onclick="resourcedel(' +
                                        data.id +
                                        ')" data-original-title="Delete" ><i class="ti-trash"></i></a> <a onclick="resourceedit(' +
                                        data.id +
                                        ')" id="resourceedit" href="javascript:void(0)" class="text-info mr-5" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';
                                    if (data.status) {
                                        action +=
                                            '<a href="javascript:void(0)" class="text-danger ml-10" onclick="rejectrequest(' +
                                            data.id +
                                            ')" data-original-title="Reject" > <span class="badge badge-danger"><i class="fa fa-thumbs-down faa-vertical animated"></i> </span></a>';
                                    } else {
                                        action += '<a onclick="acceptrequest(' +
                                            data.id +
                                            ')" id="acceptrequest" href="javascript:void(0)" class="text-info ml-10" data-original-title="Accept"><span class="badge badge-success"><i class="fa fa-thumbs-up faa-vertical animated"></i> </span></a> ';
                                    }
                                    return action;
                                }

                            }
                        ],
                    });


                    $('div.btn-delall').html(
                        '<button type="button" id="resourcedelall" class="waves-effect waves-light btn btn-danger ml-5"><i class="fa fa-close"></i> {{ __('Delete Selected') }}</button>'
                    );
                    $('#resourcedelall').click(function() {
                        if (resourceTable.rows({
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
                                    var ids = resourceTable.rows({
                                        selected: true
                                    }).data().map(function(a) {
                                        return a.id;
                                    }).join(',');
                                    $.post("{{ route('taxclasses.deleteall') }}", {
                                        grpids: ids
                                    }, function(data) {
                                        resourceTable.ajax.reload();
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

                    $('#addAction').on('hide.bs.modal', function(e) {
                        resetForm();
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
                                var url = "{{ route('taxclasses.update', '') }}" + "/" + editid;
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
                                            $('#resourcelist').DataTable().ajax.reload();
                                            $('#addAction').modal('hide');

                                            swal("{{ __('Add') }}",
                                                "{{ __('The action ran successfully!') }}",
                                                'success');
                                        }

                                    }
                                });

                            } else {
                                var url = "{{ route('taxclasses.store') }}";
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
                                            $('#resourcelist').DataTable().ajax.reload();
                                            $('#addAction').modal('hide');

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
                    var url = "{{ route('taxclasses.statusupdate', '') }}" + "/" + id;
                    $.ajax({
                        type: 'PUT',
                        url: url,
                        data: {
                            'status': 1,
                            'ajax': 1
                        },
                        success: function(data) {
                            $('#resourcelist').DataTable().ajax.reload();
                            swal("{{ __('Active') }}", "{{ __('The action ran successfully!') }}", 'success');
                        }
                    });
                }

                function rejectrequest(id) {
                    var url = "{{ route('taxclasses.statusupdate', '') }}" + "/" + id;
                    $.ajax({
                        type: 'PUT',
                        url: url,
                        data: {
                            'status': 0,
                            'ajax': 1
                        },
                        success: function(data) {
                            $('#resourcelist').DataTable().ajax.reload();
                            swal("{{ __('Inactive') }}", "{{ __('The action ran successfully!') }}", 'error');
                        }
                    });
                }

                function resourceedit(id) {
                    resetForm();
                    var url = "{{ route('taxclasses.edit', '') }}" + "/" + id;
                    $.getJSON(url, function(data) {
                        $('#name').val(data.data.name);
                        $('#editid').val(data.data.id);
                        $('#editstatus').val(data.data.status);
                        $('#rate').val(data.data['rate']);
                        $("#type option[value='" + data.data.type + "']").attr('selected', 'selected');
                        $('#addAction').modal('show');
                    });
                }

                function resetForm() {
                    $('#validerror').html('');
                    $('#editid').val('');
                    $('#editstatus').val('');
                    $('select option[selected="selected"]').removeAttr('selected');
                    $('#addActionForm').each(function() {
                        this.reset();
                    });
                }

                function resourcedel(id) {
                    swal({
                        title: "آیا مطمئن هستید که می‌خواهید این آیتم را حذف کنید؟",
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
                            var url = "{{ route('taxclasses.delete', '') }}" + "/" + id;
                            $.ajax({
                                type: 'DELETE',
                                url: url,
                                success: function(data) {
                                    $('#resourcelist').DataTable().ajax.reload();
                                    swal("حذف",
                                        "آیتم مذکور از لیست حذف شد.", data.type);
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
