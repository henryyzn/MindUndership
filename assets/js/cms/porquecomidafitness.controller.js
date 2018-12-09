f4fApp.addController("PorQueComidaFitnessController", function($this, $element) {
    $this.onInit = function() {
        f4fApp.buildCrud($this, $element, {
            list: ["GET", "../api/v1/porque_comida_fitness"],
            insert: ["POST", "../api/v1/porque_comida_fitness"],
            find: ["GET", "../api/v1/porque_comida_fitness/{id}"],
            delete: ["DELETE", "../api/v1/porque_comida_fitness/{id}"],
            update: ["PUT", "../api/v1/porque_comida_fitness/{id}"],
            toggle: ["PUT", "../api/v1/porque_comida_fitness/{id}/ativar"]
        });

        $element.find("#btn-adicionar-publicacao").on("click", $this.showForm);
    };

    $this.showForm = function(event) {
        event.preventDefault();
        $element.find("#porque-form").removeClass("display-none");
        $element.find("#porque-lista").addClass("display-none");
    };

    $this.onFormCancel = function() {
        $element.find("#porque-lista").removeClass("display-none");
        $element.find("#porque-form").addClass("display-none");
    };

    $this.onInsert = function() {
        f4fApp.abrirToast("Item inserido com sucesso.");
        $element.find("#porque-lista").removeClass("display-none");
        $element.find("#porque-form").addClass("display-none");
    };

    $this.onUpdate = function() {
        f4fApp.abrirToast("Item atualizado com sucesso.");
        $element.find("#porque-lista").removeClass("display-none");
        $element.find("#porque-form").addClass("display-none");
    };

    $this.onEditStarted = function() {
        $element.find("#porque-form").removeClass("display-none");
        $element.find("#porque-lista").addClass("display-none");
    };

    $this.onToggleStatus = function(isDisable) {
        f4fApp.abrirToast("Item " + (isDisable ? "desativado" : "ativado") + " com sucesso.");
    };

    $this.onDelete = function() {
        f4fApp.abrirToast("Item excluído com sucesso.");
    };

    $this.validateForm = function(data) {
        if (!data.texto) {
            f4fApp.abrirToast("O texto não pode ficar vazio.");
            return false;
        }

        return true;
    };
});
