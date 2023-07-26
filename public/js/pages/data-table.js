//[Data Table Javascript]

//Project:	WebkitX Admin - Responsive Admin Template
//Primary use:   Used only for the Data Table

$(function () {
    "use strict";


    $('#customerlist').DataTable({
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [

           'pageLength' ,'csv', 'excel', 'pdf', 'print'
        ],
        "ajax": {
            "url": "/panel/customerdata",
            "dataSrc": ""
        },
        columns: [
            { data: 'fullname' },
            { data: 'company' },
            { data: 'Identity' },
            { data: 'mobile' },
            { data: 'email' },
            { data: 'type' },
            { data: 'type' },
        ],
    });


}); // End of use strict
