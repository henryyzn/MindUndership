f4fApp.addController("CategoriaPratoController", function($this, $element) {
    $this.onInit = function() {
        f4fApp.buildCrud($this, $element, {
            list: ["GET", "../api/v1/categoria-prato"],
            insert: ["POST", "../api/v1/categoria-prato"],
            find: ["GET", "../api/v1/categoria-prato/{id}"],
            delete: ["DELETE", "../api/v1/categoria-prato/{id}"],
            update: ["PUT", "../api/v1/categoria-prato/{id}"],
            toggle: ["PUT", "../api/v1/categoria-prato/{id}/ativar"]
        });
    };

    $this.atualizarSelect = function() {
        $.get("../api/v1/categoria-prato/arvore", function(data) {
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
