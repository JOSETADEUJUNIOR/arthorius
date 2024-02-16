$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    var url = $('table').attr('url');

    $.extend($.fn.dataTable.defaults, {
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.3/i18n/pt-BR.json'
        },
        initComplete: function (settings, json) {
            $('[tooltip="tooltip"]').tooltip( );
        }
    });

    $('#tabelaCategorias').DataTable({
        paging: false,
        columnDefs: [
            {
                targets: [-1, -2],
                orderable: false
            }
        ],
        order: [[1, 'asc']]
    });

    $('#tabelaPosts').DataTable({
        order: [[0, 'desc']],
        processing: true,
        serverSide: true,
        ajax: {
            url: url + 'admin/posts/datatable',
            type: 'POST',
            error: function (xhr, resp, text) {
                console.log(xhr, resp, text);
            }
        },

        columns: [
            null,
            {
                data: null,
                render: function (data, type, row) {
                    if (row[1]) {
                        return '<a data-fancybox data-caption="Capa" class="overflow zoom" href="' + url + 'uploads/imagens/' + row[1] + '"><img src=" ' + url + 'uploads/imagens/thumbs/' + row[1] + ' " /></a>';
                    } else {
                        return '<i class="fa-regular fa-images fs-1 text-secondary"></i>';
                    }
                }
            },
            null, null, null, null,null,
            {
                data: null,
                render: function (data, type, row) {
                    console.log("status" + row[7]);
                    if (row[7] == 1) {
                        return '<i class="fa-solid fa-circle text-success" tooltip="tooltip" title="Ativo"></i>';
                    } else {
                        return '<i class="fa-solid fa-circle text-danger" tooltip="tooltip" title="Inativo"></i>';
                    }
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                    console.log(row);
                    var html = '';
                
                    html += '<a href="#info' + row[0] + ' " data-bs-toggle="offcanvas" tooltip="tooltip" title="log"><i class="fa-solid fa-arrow-trend-up"></i></a> ';
                
                    html += '<a href=" ' + url + 'admin/posts/editar/' + row[0] + ' " tooltip="tooltip" title="Editar"><i class="fa-solid fa-pen m-1"></i></a> ';
                
                    html += '<a href=" ' + url + 'admin/posts/deletar/' + row[0] + ' "><i class="fa-solid fa-trash m-1" tooltip="tooltip" title="Deletar"></i></a>';
                
                    html += '<div class="offcanvas offcanvas-start" tabindex="-1" id="info' + row[0] + '">'
                    html += '<div class="offcanvas-header">'
                    html += '<h5 class="offcanvas-title" id="offcanvasExampleLabel"></h5>'
                    html += '<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>'
                    html += '</div>'
                    html += '<div class="offcanvas-body">'
                    html += '<ul class="list-group list-group-flush">'
                    html += '<h3>Registro de Log</h3>'
                    html += '<li class="list-group-item">'
                    html += 'Cadastrado à: ' + row[8]
                    html += '</li>'
                    html += '<li class="list-group-item">'
                    html += 'Atualizado em: ' + row[3]
                    html += '</li>'
                    html += '<li class="list-group-item">'
                    html += 'Última visita em: ' + row[4]
                    html += '</li>'
                    html += '<li class="list-group-item">'
                    html += 'Cadastrado por: <b>' + row[5] + '</b>'
                    html += '</li>'
                    html += '</ul>'
                    html += '</div>'
                    html += '</div>'
                
                    return html;
                }
                
            }
        ],
        columnDefs: [
            {
                className: 'dt-body-left',
                targets: [2]
            },
            {
                className: 'dt-center',
                targets: [0, 1, 3, 4, 5, 6]
            },
            {
                orderable: false,
                targets: [1, -1]
            }

        ]
    });
// Adicionar evento de clique para abrir o offcanvas
    //TABELA USUÁRIOS
    $('#tabelaUsuarios').DataTable({
        order: [[0, 'desc']],
        processing: true,
        serverSide: true,
        ajax: {
            url: url + 'admin/usuarios/datatable',
            type: 'POST',
            error: function (xhr, resp, text) {
                console.log(xhr, resp, text);
            }
        },

        columns: [
            null, null, null,
            {
                data: null,
                render: function (data, type, row) {
                    if (row[3] === 3) {
                        return '<span class="text-danger">Administrador</span>';
                    } else {
                        return '<span class="text-secondary">Usuário</span>';
                    }
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                    if (row[4] === 1) {
                        return '<i class="fa-solid fa-circle text-success" tooltip="tooltip" title="Ativo"></i>';
                    } else {
                        return '<i class="fa-solid fa-circle text-danger" tooltip="tooltip" title="Inativo"></i>';
                    }
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                    var html = '';

                    html += ' <a href=" ' + url + 'admin/usuarios/editar/' + row[0] + ' " tooltip="tooltip" title="Editar"><i class="fa-solid fa-pen m-1"></i></a> ';

                    html += '<a href=" ' + url + 'admin/usuarios/deletar/' + row[0] + ' "><i class="fa-solid fa-trash m-1" tooltip="tooltip" title="Deletar"></i></a>';

                    return html;
                }
            }
        ],
        columnDefs: [
            {
                className: 'dt-body-left',
                targets: [1, 2]
            },
            {
                className: 'dt-center',
                targets: [3, 4, 5]
            },
            {
                orderable: false,
                targets: [-1]
            }

        ]
    });

});