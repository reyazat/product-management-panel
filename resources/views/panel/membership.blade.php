<x-panel.layout.pages :pageinfo="$pageinfo">
    <x-panel.show-message-ontable />

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ __('Membership') }}</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="membershiplist" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>{{ __('Full name') }}</th>
                            <th>{{ __('Company Name') }}</th>
                            <th>{{ __('Identity Num') }}/{{ __("Company's national ID") }}</th>
                            <th>{{ __('Mobile Num') }}</th>
                            <th>{{ __('Email') }} </th>
                            <th>{{ __('Type') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ __('Full name') }}</th>
                            <th>{{ __('Company Name') }}</th>
                            <th>{{ __('Identity Num') }}/{{ __("Company's national ID") }}</th>
                            <th>{{ __('Mobile Num') }}</th>
                            <th>{{ __('Email') }} </th>
                            <th>{{ __('Type') }}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <x-slot:dropdownbox>
    </x-slot:dropdownbox>
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
                var membershipTable = $('#membershiplist').DataTable({
                    dom: 'l<"dt-buttons btn-delall">frtip',
                    bProcessing: true,
                    order: [],
                    lengthMenu: [
                        [10, 25, 50, -1],
                        ['10', '25', '50', 'all']
                    ],

                    "ajax": {
                        "url": "{{ route('membership.data') }}",
                        "dataSrc": ""
                    },
                    columns: [{
                            data: 'fullname',
                            orderable: true,
                        },
                        {
                            data: 'company',
                            orderable: true,
                        },
                        {
                            data: 'Identity',
                            orderable: true,
                        },
                        {
                            data: 'mobile',
                            orderable: true,
                        },
                        {
                            data: 'email',
                            orderable: true,
                        },
                        {
                            data: null,
                            render: function(data, type, row) {
                                var typedata;
                                switch (data.type) {
                                    case 'real':
                                        typedata = '{{ __('real') }}';
                                        break;
                                    case 'legal':
                                        typedata = '{{ __('legal') }}';
                                        break;
                                }
                                return typedata;
                            }
                        },

                        {
                            data: null,
                            className: "dt-center editor-delete editor-edit",
                            orderable: false,
                            render: function(data, type, row) {
                                var url = "{{ route('membership.show', '') }}" + "/" + data.id;
                                return '<a href="' + url +
                                    '" target="blank" class="text-info mr-5" data-original-title="Detail"><span class="badge badge-warning "><i class="fa fa-eye faa-vertical animated"></i> </span></a> <a onclick="acceptrequest(' +
                                    data.id +
                                    ')" id="acceptrequest" href="javascript:void(0)" class="text-info mr-5" data-original-title="Accept"><span class="badge badge-success"><i class="fa fa-thumbs-up faa-vertical animated"></i> </span></a> <a href="javascript:void(0)" class="text-danger ml-5" onclick="rejectrequest(' +
                                    data.id +
                                    ')" data-original-title="Reject" > <span class="badge badge-danger"><i class="fa fa-thumbs-down faa-vertical animated"></i> </span></a>';
                            }

                        }
                    ],
                });


            });

            function acceptrequest(id) {
                var url = "{{ route('membership.update', '') }}" + "/" + id;
                $.ajax({
                    type: 'PUT',
                    url: url,
                    data: {
                        'status': 1,
                        'ajax': true
                    },
                    success: function(data) {
                        $('#membershiplist').DataTable().ajax.reload();
                        swal("تایید",
                            "درخواست مذکور مورد تایید قرار گرفت.", data.type);
                    }
                });
            }


            function rejectrequest(id) {
                swal({
                    title: "آیا مطمئن هستید که می‌خواهید این درخواست را رد کنید؟",
                    text: "بارد کردن درخواست ، این رکورد از پایگاه داده شما حذف خواهد شد!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "{{ __('Yes, Delete') }}",
                    cancelButtonText: "{{ __('No, Go Back') }}",
                    closeOnConfirm: false,
                    closeOnCancel: true
                }, function(isConfirm) {
                    if (isConfirm) {
                        var url = "{{ route('membership.delete', '') }}" + "/" + id;
                        $.ajax({
                            type: 'DELETE',
                            url: url,
                            data: {
                                'ajax': true
                            },
                            success: function(data) {
                                $('#membershiplist').DataTable().ajax.reload();
                                swal("حذف",
                                    "درخواست مذکور از لیست حذف شد.", data.type);
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
