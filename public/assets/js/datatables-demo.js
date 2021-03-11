// Call the dataTables jQuery plugin
$(document).ready(function () {
  $("#dataTable").DataTable(
    {
      "language": {
          "lengthMenu": "Mostrando _MENU_ registros por p&aacute;gina",
          "zeroRecords": "No hay registros - disculpe",
          "info": "Mostrando p&aacute;gina _PAGE_ de _PAGES_",
          "infoEmpty": "No hay registros",
          "infoFiltered": "(filtrado de _MAX_ registros totales)",
          "search": "Buscar:",
          "paginate": {
          "first":      "Primero",
          "last":       "&Uacute;ltimo",
          "next":       "Siguiente",
          "previous":   "Anterior"
      },
      },
      "pagingType": "full_numbers"
  } );
});