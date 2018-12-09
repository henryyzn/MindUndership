var Application = function() {
    var controllerBase = {
        onInit: function() {}
    };

    var app = {
        controllers: [],
        addFunction: function(name, fn) {
            app[name] = fn;
        },

        addController: function(name, controller) {
            app.controllers[name] = controller;
        },

        loadController: function() {
            $("[data-controller]").each(function() {
                var element = $(this);
                if (!element.data("controller-instance")) {
                    var controllerName = element.data("controller");
                    var instance = f4fApp.setElementController(element, controllerName);
                    if (instance && instance.onInit) {
                        instance.onInit();
                    }
                }
            });
        },

        setElementController: function(element, controllerName) {
            if (app.controllers[controllerName] && typeof app.controllers[controllerName] === "function") {
                var instance = {};
                var controllerInstance = new app.controllers[controllerName](instance, element);
                instance = $.extend({}, controllerBase, instance);
                element.data("controller-instance", instance);
                return instance;
            }
        },

        buildCrud: function(instance, element, urls) {
            var crudController = app.setElementController(element, "CrudController");
            if (crudController) {
                crudController.onInit(instance, urls);
            }
        }
    };

    return app;
};

var f4fApp = new Application();
f4fApp.addFunction("abrirToast", function (mensagem) {
    $.toast({
        text: mensagem,
        loader: false,
        position: { right: "10px", bottom: "10px" },
        showHideTransition: "fade",
        textAlign: "center"
    });
});

f4fApp.addFunction("showModal", function (title, text, accept) {
    var modal = $("[data-modal]");
    modal.find("[data-modal-accept], [data-modal-close]").off();
    modal.find("[data-modal-title]").text(title);
    modal.find("[data-modal-text]").text(text);
    modal.addClass("show");
    modal.find("[data-modal-close]").on("click", function () {
        modal.removeClass("show");
    });

    modal.find("[data-modal-accept]").on("click", function () {
        modal.removeClass("show");
        if (accept && typeof accept === "function") {
            accept();
        }
    });
});

$(function () {
    f4fApp.loadController();
});
