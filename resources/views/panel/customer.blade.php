<x-panel.layout.pages :pageinfo="$pageinfo">
    <x-panel.show-message-ontable />

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ __('Customers') }}</h3>
            <button type="button" data-toggle="control-sidebar"
                class="waves-effect waves-light btn btn-success pull-right"><i class="fa fa-plus"></i>
                {{ __('Add new customer') }}</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="customerlist" class="table table-bordered table-striped" style="width:100%">
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
        <x-panel.customer-form :groups="$cgrp" />
    </x-slot:dropdownbox>
    <x-slot:script>
        <script src="{{ url('assets/vendor_components/datatable/datatables.min.js') }}"></script>
        <script src="{{ url('assets/vendor_components/sweetalert/sweetalert.min.js') }}"></script>
        <script src="{{ url('js/panel/validation.js') }}"></script>
        <script src="{{ url('js/pages/form-validation.js') }}"></script>
        <script src="{{ url('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
        <script src="{{ url('assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
        <script>
            $(function() {
                "use strict";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var customerTable = $('#customerlist').DataTable({
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
                                    title: "{{ __('Customers') }}",
                                },
                                {
                                    extend: "excel",
                                    title: "{{ __('Customers') }}"
                                },

                            ],
                            dropup: true
                        }
                    ],
                    "ajax": {
                        "url": "{{ route('customerdata.panel') }}",
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
                                    '" target="blank" class="text-info mr-10" data-original-title="Detail"><span class="badge badge-warning "><i class="fa fa-eye faa-vertical animated"></i> </span></a><a href="javascript:void(0)" class="text-danger ml-5" onclick="cusdel(' +
                                    data.id +
                                    ')" data-original-title="Delete" ><i class="ti-trash"></i></a> <a onclick="cusedit(' +
                                    data.id +
                                    ')" id="cusedit" href="javascript:void(0)" class="text-info mr-5" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';
                            }

                        }
                    ],
                });

                $('div.btn-delall').html(
                    '<button type="button" id="cusdelall" class="waves-effect waves-light btn btn-danger ml-5"><i class="fa fa-close"></i> {{ __('Delete Selected') }}</button>'
                );
                $('#cusdelall').click(function() {
                    if (customerTable.rows({
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
                                var ids = customerTable.rows({
                                    selected: true
                                }).data().map(function(a) {
                                    return a.id;
                                }).join(',');
                                $.post("{{ route('customerdata.deleteall') }}", {
                                    customerids: ids
                                }, function(data) {
                                    customerTable.ajax.reload();
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
                $('.closecustform').click(function() {

                    clearcustform();
                });

                $('.lfm').filemanager('image');
                $('.select2').select2({
                    dropdownParent: $('.control-sidebar')
                });
            });


            function cusedit(id) {
                var url = "{{ route('customerdata.edit', '') }}" + "/" + id;
                $.getJSON(url, function(data) {
                    switch (data.data.type) {
                        case 'real':
                            realset(data.data);
                            break;
                        case 'legal':
                            legalset(data.data);
                            break;
                    }
                    $('.control-sidebar').toggleClass('control-sidebar-open');

                });
            }

            function realset(data) {
                clearcustform();
                $('#custab #personaltab').tab('show');
                $('#pname').val(data.fullname);
                $('#puserid').val(data.id);
                $('#pidentity').val(data.Identity);
                $('#pmobile').val(data.mobile);
                $('#pphone').val(data.phone);
                $('#pemail').val(data.email);
                $('#ppostcode').val(data.postcode);
                $('#paddress').val(data.address);
                $('#personalfile').val(data.file);
                $.each(data.customergroup, function(index, value) {
                    $('#personalgroups option[value="'+index+'"]').attr('selected', 'selected');
                });
                $('.select2').select2({
                    dropdownParent: $('.control-sidebar')
                });

                if (data.file != null && data.file != '')
                    $('#pholder').html('<img src="' + data.file + '" style="height: 5rem;">');
                console.log('real');
            }

            function legalset(data) {
                clearcustform();
                $('#custab #companytab').tab('show');
                $('#cname').val(data.company);
                $('#cuserid').val(data.id);
                $('#cidentity').val(data.Identity);
                $('#ctax').val(data.taxcode);
                $('#cmobile').val(data.mobile);
                $('#cphone').val(data.phone);
                $('#cemail').val(data.email);
                $('#csign').val(data.company_signatory);
                $('#cpostcode').val(data.postcode);
                $('#caddress').val(data.address);
                $('#companyfile').val(data.file);
                $.each(data.customergroup, function(index, value) {
                    $('#companygroups option[value="'+index+'"]').attr('selected', 'selected');
                });
                $('.select2').select2({
                    dropdownParent: $('.control-sidebar')
                });
                if (data.file != null && data.file != '')
                    $('#cholder').html('<img src="' + data.file + '" style="height: 5rem;">');
                console.log('legal');
            }

            function clearcustform() {
                $('#pholder').html('');
                $('#cholder').html('');
                $('.select2 option[selected="selected"]').removeAttr('selected');
                $('#personalform').each(function() {
                    this.reset();
                });
                $('#companyform').each(function() {
                    this.reset();
                });
                $('.select2').select2({
                    dropdownParent: $('.control-sidebar')
                });
            }

            function cusdel(id) {
                swal({
                    title: "آیا مطمئن هستید که می‌خواهید این مشتری را حذف کنید؟",
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
                        var url = "{{ route('customerdata.delete', '') }}" + "/" + id;
                        $.ajax({
                            type: 'DELETE',
                            url: url,
                            success: function(data) {
                                $('#customerlist').DataTable().ajax.reload();
                                swal("حذف",
                                    "مشتری مذکور از لیست حذف شد.", data.type);
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
