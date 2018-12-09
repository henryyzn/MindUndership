f4fApp.addController("CategoriaIngredienteController", function($this, $element) {
    $this.onInit = function() {
        f4fApp.buildCrud($this, $element, {
            list: ["GET", "../api/v1/categoria-ingrediente"],
            insert: ["POST", "../api/v1/categoria-ingrediente"],
            find: ["GET", "../api/v1/categoria-ingrediente/{id}"],
            delete: ["DELETE", "../api/v1/categoria-ingrediente/{id}"],
            update: ["PUT", "../api/v1/categoria-ingrediente/{id}"],
            toggle: ["PUT", "../api/v1/categoria-ingrediente/{id}/ativar"]
        });
    };

    $this.atualizarSelect = function() {
        $.get("../api/v1/categoria-ingrediente/arvore", function(data) {
            $element
                .find("#parent")
                .children()
                .remove(":not(:first-child)")
                .parent()
                .append($(data.select));
        });
    }

    $this.onInsert = function() {
        f4fApp.abrirToast("Categoria inserida com sucesso.");
        $this.atualizarSelect();
    };

    $this.onUpdate = function() {
        f4fApp.abrirToast("Categoria atualizada com sucesso.");
        $element.find("#titulo-acao").text("Cadastrar uma Categoria");
        $this.atualizarSelect();
    };

    $this.onEditStarted = function() {
        $element.find("#titulo-acao").text("Editar Categoria");
    };

    $this.onToggleStatus = function(isDisable) {
        f4fApp.abrirToast("Categoria " + (isDisable ? "desativada" : "ativada") + " com sucesso.");
    };

    $this.onDelete = function() {
        f4fApp.abrirToast("Categoria excluída com sucesso.");
        $this.atualizarSelect();
    };

    $this.validateForm = function(data) {
        if (!data.uploadData && !data.foto) {
            f4fApp.abrirToast("Selecione uma imagem.");
            return false;
        }

        return true;
    };
});
