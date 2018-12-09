f4fApp.addController("LoginController", function($this, $element) {
    $this.onInit = function() {
        $this.formLogin = $element.find("#form-login");
        $this.formLogin.on("submit", $this.submit);
    };

    $this.submit = function(event) {
        event.preventDefault();
        $.ajax({
            url: "../api/v1/funcionarios/login",
            type: "POST",
            data: JSON.stringify(formToObject($this.formLogin.serializeArray())),
            success: function() {
                window.location.href = "home.php";
            },

            error: function() {
                f4fApp.abrirToast("Matrícula ou senha incorretos.");
                $this.formLogin
                    .find("#senha")
                    .val("")
                    .focus();
            }
        });
    };
});
