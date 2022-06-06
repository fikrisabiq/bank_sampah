$(document).ready( function () {
  var table = $('#dataTable').DataTable({
    dom:  "<'row'<'col-sm-12'l>>" +
          "<'row'<'col-sm-8'B><'col-sm-4'f>>"+
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: [
              {extend: 'copy',
               exportOptions: {
               columns: ':visible',
                 rows: ':visible'
              }
             },
              {extend: 'print',
               exportOptions: {
               columns: ':visible',
                 rows: ':visible'
              }
             },
              {extend: 'csv',
               exportOptions: {
               columns: ':visible',
                 rows: ':visible'
              }
             },
              {extend: 'pdf',
               pageSize: 'LEGAL',
               orientation: 'landscape',
               exportOptions: {
                 columns: ':visible',
                 
              }
             }
            ],

  });
} );
