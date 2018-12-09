f4fApp.addController("PratoController", function($this, $element) {
    $this.onInit = function() {
        f4fApp.buildCrud($this, $element, {});
        $element.find("#btn-adicionar-prato").on("click", $this.showForm);
    }

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
});
