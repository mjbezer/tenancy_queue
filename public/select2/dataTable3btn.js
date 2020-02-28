jQuery.extend(jQuery.fn.dataTableExt.oSort, {
    "date-br-pre": function(a) {
        if (a == null || a == "") {
            return 0;
        }
        var brDatea = a.split("/");
        return (brDatea[2] + brDatea[1] + brDatea[0]) * 1;
    },

    "date-br-asc": function(a, b) {
        return a < b ? -1 : a > b ? 1 : 0;
    },

    "date-br-desc": function(a, b) {
        return a < b ? 1 : a > b ? -1 : 0;
    }
});

$(document).ready(function() {
    $("#dataTable3btn").DataTable({
        dom: "Bfrtip",
        buttons: [{
                text: '<i class="fa fa-plus" title="novo registro" data-toggle="tooltip""></i>',
                action: function() {
                    window.location.href = window.urlCreate;
                }
            },
            {
                extend: "copy",
                text: '<i class="fa fa-clipboard" title="copiar para área de transferência" data-toggle="tooltip"></i>'
            },
            {
                extend: "excel",
                text: '<i class="fa fa-file-excel-o" title="exportar para Excel" data-toggle="tooltip"></i>'
            },
            {
                extend: "print",
                text: '<i class="fa fa-print" title="imprimir" data-toggle="tooltip"></i>'
            }
        ],
        language: {
            lengthMenu: "Mostrar _MENU_ itens por página",
            zeroRecords: "Desculpe, não encontramos nenhum registro ...",
            info: "Exibindo página _PAGE_ de _PAGES_",
            infoEmpty: "Nenhum registro disponível ...",
            infoFiltered: "(filtrado de _MAX_ registros)",
            search: "Buscar:",
            zeroRecords: "Desculpe, não encontramos nenhum registro...",
            paginate: {
                first: "Primeiro",
                last: "Último",
                next: "Próximo",
                previous: "Anterior"
            },
            buttons: {
                selectAll: "Select all items",
                selectNone: "Select none"
            }
        }
    });
    $("#dataTable3btn_filter input").focus();
});