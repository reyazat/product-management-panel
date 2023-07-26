<x-panel.layout.pages :pageinfo="$pageinfo">
    <x-panel.show-message-ontable />

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ __('Options') }}</h3>
            <a class="waves-effect waves-light btn btn-success pull-right" href="{{ route('options.create') }}"><i class="fa fa-plus"></i>
                {{ __('Add') }}</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="resourcelist" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>{{ __('Option') }}</th>
                            <th>{{ __('Type') }}</th>
                            <th>{{ __('Sorted') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ __('Option') }}</th>
                            <th>{{ __('Type') }}</th>
                            <th>{{ __('Sorted') }}</th>
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
                                        title: "{{ __('Options') }}",
                                    },
                                    {
                                        extend: "excel",
                                        title: "{{ __('Options') }}"
                                    },

                                ],
                                dropup: true
                            }
                        ],
                        "ajax": {
                            "url": "{{ route('options.json') }}",
                        },
                        columns: [{
                                data: 'name',
                                orderable: true,
                            },
                            {
                                data: 'type',
                                orderable: true,
                            },
                            {
                                data: 'sorted',
                                orderable: true,
                            },
                            {
                                data: null,
                                className: "dt-center editor-delete editor-edit",
                                orderable: false,
                                render: function(data, type, row) {
                                    var url = "{{ route('options.edit', '') }}" + "/" + data.id;
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
                                    $.post("{{ route('options.deleteall') }}", {
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
                            var url = "{{ route('options.delete', '') }}" + "/" + id;
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
