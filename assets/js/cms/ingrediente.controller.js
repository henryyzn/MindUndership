f4fApp.addController("IngredienteController", function($this, $element) {
    $this.onInit = function() {
        f4fApp.buildCrud($this, $element, {
            list: ["GET", "../api/v1/ingrediente"],
            insert: ["POST", "../api/v1/ingrediente"],
            find: ["GET", "../api/v1/ingrediente/{id}"],
            delete: ["DELETE", "../api/v1/ingrediente/{id}"],
            update: ["PUT", "../api/v1/ingrediente/{id}"],
            toggle: ["PUT", "../api/v1/ingrediente/{id}/ativar"]
        });

        $element.find("#btn-adicionar-ingrediente").on("click", $this.showForm);
    };

    $this.showForm = function(event) {
        if (event) {
            event.preventDefault();
        }

        $element.find("#form-content").removeClass("display-none");
        $element.find("#list-content").addClass("display-none");
    }

    $this.showList = function() {
        $element.find("#form-content").addClass("display-none");
        $element.find("#list-content").removeClass("display-none");
    }

    $this.onInsert = function() {
        f4fApp.abrirToast("Ingrediente inserido com sucesso.");
        $this.showList();
    };

    $this.onUpdate = function() {
        f4fApp.abrirToast("Ingrediente atualizado com sucesso.");
        $this.showList();
    };

    $this.onEditStarted = function() {
        $this.showForm();
    };

    $this.onToggleStatus = function(isDisable) {
        f4fApp.abrirToast("Ingrediente " + (isDisable ? "desativado" : "ativado") + " com sucesso.");
    };

    $this.onDelete = function() {
        f4fApp.abrirToast("Ingrediente excluído com sucesso.");
    };

    $this.validateForm = function(data) {
        if (!data.descricao) {
            f4fApp.abrirToast("A descrição não pode ficar vazia.");
            return false;
        } else if (!data.uploadData && !data.foto) {
            f4fApp.abrirToast("Selecione uma imagem.");
            return false;
        }

        return true;
    };
});
