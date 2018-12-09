var ingredientesTree = [{
    id: 1,
    titulo: "Frutas",
    imagem: "frutas.jpg",
    ingredientes: [],
    categorias: [{
        id: 4,
        titulo: "Frutas para ganhar massa",
        imagem: "frutas.jpg",
        ingredientes: [{
            id: 2,
            titulo: "Banana",
            preco: "R$ 00,00",
            imagem: "banana.jpg",
            categoria: 4
        }, {
            id: 3,
            titulo: "Maçã",
            preco: "R$ 00,00",
            imagem: "maca.jpg",
            categoria: 4
        }],
        categorias: [],
        parent: 1
    }, {
        id: 5,
        titulo: "Frutas para perder peso",
        imagem: "frutas.jpg",
        ingredientes: [{
            id: 4,
            titulo: "Abacate",
            preco: "R$ 00,00",
            imagem: "abacate.jpg",
            categoria: 5
        }],
        categorias: [],
        parent: 1
    }, {
        id: 6,
        titulo: "Frutas boas para saúde",
        imagem: "frutas.jpg",
        ingredientes: [{
            id: 5,
            titulo: "Morango",
            preco: "R$ 00,00",
            imagem: "morango.jpg",
            categoria: 6
        }],
        categorias: [],
        parent: 1
    }, {
        id: 7,
        titulo: "Frutas para ganhar energia",
        imagem: "frutas.jpg",
        ingredientes: [{
            id: 6,
            titulo: "Mamão",
            preco: "R$ 00,00",
            imagem: "mamao.jpg",
            categoria: 7
        }],
        categorias: [{
            id: 16,
            titulo: "Frutas para correr",
            imagem: "frutas.jpg",
            ingredientes: [{
                id: 7,
                titulo: "Mexerica",
                preco: "R$ 00,00",
                imagem: "mexerica.jpg",
                categoria: 16
            }],
            categorias: [],
            parent: 7
        }],
        parent: 1
    }]
}, {
    id: 2,
    titulo: "Legumes",
    imagem: "legumes.jpg",
    ingredientes: [],
    categorias: [{
        id: 8,
        titulo: "Legumes para ganhar massa",
        imagem: "legumes.jpg",
        ingredientes: [{
            id: 8,
            titulo: "Beterraba",
            preco: "R$ 00,00",
            imagem: "beterraba.jpg",
            categoria: 8
        }, {
            id: 9,
            titulo: "Abóbora",
            preco: "R$ 00,00",
            imagem: "abobora.jpg",
            categoria: 8
        }],
        categorias: [],
        parent: 2
    }, {
        id: 9,
        titulo: "Legumes para perder peso",
        imagem: "legumes.jpg",
        ingredientes: [{
            id: 10,
            titulo: "Cenoura",
            preco: "R$ 00,00",
            imagem: "cenoura.jpg",
            categoria: 8
        }],
        categorias: [],
        parent: 2
    }, {
        id: 10,
        titulo: "Legumes bons para saúde",
        imagem: "legumes.jpg",
        ingredientes: [{
            id: 11,
            titulo: "Mandioca",
            preco: "R$ 00,00",
            imagem: "mandioca.jpg",
            categoria: 10
        }],
        categorias: [],
        parent: 2
    }, {
        id: 11,
        titulo: "Legumes para ganhar energia",
        imagem: "legumes.jpg",
        ingredientes: [{
            id: 12,
            titulo: "Pepino",
            preco: "R$ 00,00",
            imagem: "pepino.jpg",
            categoria: 10
        }],
        categorias: [],
        parent: 2
    }]
}, {
    id: 3,
    titulo: "Verduras",
    imagem: "verduras.jpg",
    ingredientes: [],
    categorias: [{
        id: 12,
        titulo: "Verduras para ganhar massa",
        imagem: "verduras.jpg",
        ingredientes: [{
            id: 13,
            titulo: "Alface",
            preco: "R$ 00,00",
            imagem: "alface.jpg",
            categoria: 12
        }],
        categorias: [],
        parent: 3
    }, {
        id: 13,
        titulo: "Verduras para perder peso",
        imagem: "verduras.jpg",
        ingredientes: [{
            id: 15,
            titulo: "Repolho",
            preco: "R$ 00,00",
            imagem: "repolho.jpg",
            categoria: 13
        }],
        categorias: [],
        parent: 3
    }, {
        id: 14,
        titulo: "Verduras boas para saúde",
        imagem: "verduras.jpg",
        ingredientes: [{
            id: 16,
            titulo: "Salsa",
            preco: "R$ 00,00",
            imagem: "salsa.jpg",
            categoria: 14
        }],
        categorias: [],
        parent: 3
    }, {
        id: 15,
        titulo: "Verduras para ganhar energia",
        imagem: "verduras.jpg",
        ingredientes: [{
            id: 17,
            titulo: "Couve",
            preco: "R$ 00,00",
            imagem: "couve.png",
            categoria: 15
        }],
        categorias: [],
        parent: 3
    }]
}];
var meusIngredientes = [];

function listarCategorias(categorias) {
    if (categorias && categorias.length > 0) {
        $("#ingredientes-categorias").removeClass("sem-categorias");
        $("#lista-categorias").html("").scrollLeft(0);

        categorias.forEach(function (categoria) {
            var div = $("<div>").addClass("categoria").data("categoria", categoria);

            $("<img>").attr("src", "assets/images/categorias/" + categoria.imagem).attr("alt", categoria.titulo).appendTo(div);

            $("<div>").addClass("titulo").append($("<h3>").text(categoria.titulo)).appendTo(div);

            div.appendTo("#lista-categorias");
        });
    } else {
        $("#ingredientes-categorias").addClass("sem-categorias");
    }
}

function listarIngredientes(idCategoria, ingredientes) {
    if (ingredientes && ingredientes.length > 0) {
        $("#ingredientes-categorias").removeClass("sem-ingredientes");
        $("#lista-ingredientes").html("").data("categoria", idCategoria);

        ingredientes.forEach(function (ingrediente) {
            if (meusIngredientes.indexOf(ingrediente) < 0) {
                var div = $("<div>").addClass("ingrediente").data("ingrediente", ingrediente);

                $("<img>").attr("src", "assets/images/ingredientes/" + ingrediente.imagem).attr("alt", ingrediente.titulo).appendTo(div);

                $("<div>").addClass("titulo").append($("<h3>").text(ingrediente.titulo)).append($("<h4>").text(ingrediente.preco)).appendTo(div);

                div.appendTo("#lista-ingredientes");
                habilitarIngrediente(div);
            }
        });
    } else {
        $("#ingredientes-categorias").addClass("sem-ingredientes");
        $("#lista-ingredientes").html("").data("categoria", 0);
    }
}

function habilitarIngrediente(div) {
    div.draggable({
        appendTo: "body",
        cursor: "move",
        helper: "clone",
        revert: "invalid",
        stack: "div",
        scroll: false,
        containment: "window"
    });
}

function abrirCategoria(categoria) {
    if (categoria) {
        $("<a>").attr("href", "#").text(categoria.titulo).data("categoria", categoria).appendTo("#breadcrumb>span");

        listarCategorias(categoria.categorias);
        listarIngredientes(categoria.id, categoria.ingredientes);
    } else {
        $("#ingredientes-categorias").addClass("sem-ingredientes");
        listarCategorias(ingredientesTree);
    }
}

$(document).ready(function () {
    listarCategorias(ingredientesTree);

    $(document).on("click", ".categoria", function () {
        abrirCategoria($(this).data("categoria"));
    });

    $(document).on("click", "#breadcrumb a", function (event) {
        event.preventDefault();
        abrirCategoria($(this).data("categoria"));
        $(this).nextAll().remove();
    });

    $(document).on("dblclick", ".ingrediente", function () {
        var ingrediente = $(this).data("ingrediente");
        if (meusIngredientes.indexOf(ingrediente) != -1) {
            meusIngredientes.splice(meusIngredientes.indexOf(ingrediente), 1);
            if ($("#lista-ingredientes").data("categoria") == ingrediente.categoria) {
                $("#lista-ingredientes").append(this);
            } else {
                $(this).remove();
            }
        } else {
            meusIngredientes.push(ingrediente);
            $("#meus-ingredientes").append(this);
        }
    });

    $("#meus-ingredientes").droppable({
        tolerance: "intersect",
        activeClass: "ui-state-default",
        hoverClass: "ui-state-hover",
        accept: ".ingrediente",
        drop: function drop(event, ui) {
            meusIngredientes.push(ui.draggable.data("ingrediente"));
            $(this).append(ui.draggable);
        }
    });

    $("#ingredientes-categorias").droppable({
        tolerance: "intersect",
        accept: ".ingrediente",
        activeClass: "ui-state-default",
        hoverClass: "ui-state-hover",
        drop: function drop(event, ui) {
            var ingrediente = ui.draggable.data("ingrediente");
            meusIngredientes.splice(meusIngredientes.indexOf(ingrediente), 1);
            if ($("#lista-ingredientes").data("categoria") == ingrediente.categoria) {
                $("#lista-ingredientes").append(ui.draggable);
            } else {
                ui.draggable.remove();
            }
        }
    });

    $("#btn-processar").click(function () {
        $("#montar-prato").addClass("display-none");
        $("#informacoes-adicionais").removeClass("display-none");
    });
});
