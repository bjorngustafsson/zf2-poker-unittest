$(document).ready(function () {

    //This implements sorting pagination and in swedish with datatables plugin for jquery
    var testDT = $('table.maintable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/be7019ee387/i18n/Swedish.json"
        },
        //DataTables has the option of being able to save the state
        //of a table (its paging position, ordering state etc)
        stateSave: true,

        "aoColumnDefs": [
            { 'bSortable': false, 'aTargets': [ 6 ] }
        ]
    });

    $('form#player span').append('<br>');
    $('form#player input[type=text]').addClass('form-control');

    $('table.maintable').show();
});