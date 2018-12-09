f4fApp.addController("HomeController", function($this, $element) {
    $this.onInit = function() {
        $this.onHashChange();
        $(window).on("hashchange", $this.onHashChange);
    };

    $this.onHashChange = function() {
        $this.loadView(location.hash.replace(/[#\/]/g, "") || "dashboard");
    }

    $element.find(".btn-logout").click(function(event) {
        event.preventDefault();
        $.ajax({
            url: "../api/v1/funcionarios/logout",
            type: "POST",
            success: function() {
                window.location.href = "login.php";
            },
            error: function() {
                f4fApp.abrirToast("Não foi possível efetuar o logout.");
            }
        });
    });

    $element.find("#sidebar-collapse").click(function(event) {
        event.preventDefault();
        $element.find("#sidebar").toggleClass("collapse");
    });

    $element.on("click", "[data-page-load]", function(event) {
        event.preventDefault();
        $this.loadView($(this).data("page-load"));
    });

    $element.on("mouseenter", "#sidebar.collapse nav a", function() {
        var offset = $(this).offset();
        var texto = $(this)
            .find(".label")
            .contents()
            .get(0).nodeValue;

        $element.find("#tooltip")
            .text(texto)
            .css({top: offset.top + 5, left: offset.left + 50})
            .show();
    });

    $element.on("mouseleave", "#sidebar.collapse nav a", function() {
        $element.find("#tooltip").hide();
    });

    $this.loadView = function(pagina) {
        var routerLink = $element.find("[data-page-load='" + pagina + "']");
        var controller = routerLink.data("pageController");
        var menuLink = routerLink.data("menuLink");
        var menuLinkElement = $element.find("[data-page-load='" + menuLink + "']");
        var title = routerLink.data("title");
        $.get(pagina + ".php", function(conteudo) {
            $element.find("#page-content").html(conteudo);
            $element.find("#sidebar nav a").removeClass("active");

            if (!title) {
                title = $element.find("#page-content").find("[data-page-title]").data("pageTitle");
            }

            if (!menuLink) {
                menuLink = $element.find("#page-content").find("[data-menu-link]").data("menuLink");
                menuLinkElement = $element.find("[data-page-load='" + menuLink + "']");
            }

            if (!controller) {
                controller = $element.find("#page-content").find("[data-page-controller]").data("pageController");
            }

            var htmlElement = (menuLink ? menuLinkElement : routerLink)
                .addClass("active")
                .find(".label")
                .contents()
                .get(0);

            var texto = title ? title : htmlElement ? htmlElement.nodeValue : "";

            $element.find("#titulo-pagina").text(texto);
            window.location.hash = "#/" + pagina;

            var controllerInstance = f4fApp.setElementController($element, controller);
            if (controllerInstance && controllerInstance.onInit) {
                controllerInstance.onInit();
            }

            $this.initView($element.find("#page-content"));
        });
    };

    $this.initView = function(element) {
        element.find("[data-sceditor]").each(function() {
            if (!$(this).data("sceditor-instance")) {
                var instance = $(this).sceditor({
                    format: "xhtml",
                    style: "../assets/public/css/sceditor.default.min.css",
                    emoticons: {},
                    toolbarExclude: "emoticon,youtube,print,maximize,source,table,quote,code",
                    dateFormat: "day/month/year",
                    resizeEnabled: false
                }).sceditor("instance");

                $(this).data("sceditor-instance", instance);
            }
        });

        $.applyDataMask();
    }
});
