<x-panel.layout.pages :pageinfo="$pageinfo">
    <x-panel.show-message-ontable />

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ __('Products') }}</h3>
            <a class="waves-effect waves-light btn btn-success pull-right" href="{{ route('products.create') }}"><i class="fa fa-plus"></i>
                {{ __('Add') }}</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="resourcelist" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Quantity') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Quantity') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

    <x-slot:dropdownbox>
        </x-slot>
        <x-slot:script>
            <script src="{{ url('assets/vendor_components/datatable/datatables.min.js') }}"></script>
            <script src="{{ url('assets/vendor_components/sweetalert/sweetalert.min.js') }}"></script>
            <script src="{{ url('js/panel/validation.js') }}"></script>
            <script src="{{ url('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>

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
                        responsive: true,
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
                                        title: "{{ __('Products') }}",
                                    },
                                    {
                                        extend: "excel",
                                        title: "{{ __('Products') }}"
                                    },

                                ],
                                dropup: true
                            }
                        ],
                        "ajax": {
                            "url": "{{ route('products.json') }}",
                        },
                        columns: [{
                                data: 'name',
                                orderable: true,
                            },
                            {
                                orderable: true,
                                data: null,
                                render: function(data, type, row) {
                                    var joined = $.map(data.categories, function(e) {
                                        return e.name;
                                    }).join(' , ');
                                    return '<span style="white-space:normal">' + joined + "</span>";
                                }
                            },
                            {
                                data: 'price',
                                orderable: true,
                                render: $.fn.dataTable.render.number( ',', '.', 2, ' تومان ' )
                            },
                            {
                                data: 'quantity',
                                orderable: true,
                            },
                            {
                                data: null,
                                render: function(data, type, row) {
                                    var status;
                                    switch (data.status) {
                                        case 1:
                                            status =
                                                '{{ __('Active') }}  <a href="javascript:void(0)" class="text-danger ml-10" onclick="rejectrequest(' +
                                                data.id +
                                                ')" data-original-title="Reject" > <span class="badge badge-danger"><i class="fa fa-thumbs-down faa-vertical animated"></i> </span></a>';
                                            break;
                                        case 0:
                                            status = '{{ __('Inactive') }}  <a onclick="acceptrequest(' +
                                                data.id +
                                                ')" id="acceptrequest" href="javascript:void(0)" class="text-info ml-10" data-original-title="Accept"><span class="badge badge-success"><i class="fa fa-thumbs-up faa-vertical animated"></i> </span></a>';
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
                                    var url = "{{ route('products.edit', '') }}" + "/" + data.id;
                                    var action =
                                        '<a href="javascript:void(0)" class="text-danger ml-5" onclick="resourcedel(' +
                                        data.id +
                                        ')" data-original-title="Delete" ><i class="ti-trash"></i></a> <a href="'+url+'"  class="text-info mr-5" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';

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
                                    $.post("{{ route('products.deleteall') }}", {
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


                });

                function acceptrequest(id) {
                    var url = "{{ route('products.statusupdate', '') }}" + "/" + id;
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
                    var url = "{{ route('products.statusupdate', '') }}" + "/" + id;
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
                            var url = "{{ route('products.delete', '') }}" + "/" + id;
                            $.ajax({
                                type: 'DELETE',
                                url: url,
                                success: function(data) {
                                    if (data.type == 'success') {
                                        $('#resourcelist').DataTable().ajax.reload();
                                        swal("حذف",
                                            "آیتم مذکور از لیست حذف شد.", data.type);
                                    }
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
