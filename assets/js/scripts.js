$(document).ready(function () {
    $("#menu-img").click(function(event) {
        event.preventDefault();
        $(".hide-left").slideToggle("fast");
    });
    $("#avatar-img").click(function(event) {
        event.preventDefault();
        $(".hide-right").slideToggle("fast");
    });
    $("#form-cadastro-usuario").submit(function (event) {
        event.preventDefault();
        var userData = formToObject($(this).serializeArrayDisabled());
        this.reset();
        $("#modal-cadastro").addClass("display-flex");

        var counter = 5;
        var interval = setInterval(function () {
            $("#modal-cadastro .counter").text(--counter);
            if (counter == 0) {
                clearInterval(interval);
                location.href = "index.php";
            }
        }, 1000);
    });

    if ($.fn.datepicker) {
        $("#dtnasc").datepicker({
            maxDate: "+0D",
            showAnim: "slideDown",
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0",
            dateFormat: "dd/mm/yy",
            dayNames: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"],
            dayNamesMin: ["D", "S", "T", "Q", "Q", "S", "S", "D"],
            dayNamesShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb", "Dom"],
            monthNames: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
            monthNamesShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
            nextText: "Proximo",
            prevText: "Anterior"
        });

        $("#dtnasc").on("focusin", function () {
            $(this).prop("readonly", true);
        });

        $("#dtnasc").on("focusout", function () {
            $(this).prop("readonly", false);
        });
    }

    if ($.applyDataMask) {
        $.applyDataMask();
    }

    if ($.fn.responsiveSlides) {
        $("#slider").responsiveSlides({
            nav: true,
            prevText: "&lt;",
            nextText: "&gt;",
            speed: 1000,
            timeout: 4500
        });
    }

    $("[data-f4f-number-group]").each(function () {
        var input = $(this).find("input");
        $(this).on("click", "[data-f4f-number-decrement], [data-f4f-number-increment]", function () {
            var number = parseInt(input.val());
            if ($(this).is("[data-f4f-number-increment]")) {
                number += 1;
            } else {
                number -= 1;
            }

            number = Math.max(1, Math.min(1000, number));
            input.val(number);
        });
    });

    $("[data-f4f-selection]").each(function () {
        var $this = $(this);
        $this.on("change", "[data-f4f-select-all]", function () {
            var checked = $(this).is(":checked");
            $this.find("[data-f4f-select-one]").prop("checked", checked);
            verifyAnyChecked();
        });

        $this.on("change", "[data-f4f-select-one]", function () {
            var allChecked = $("[data-f4f-select-one]").not(":checked").length == 0;
            $this.find("[data-f4f-select-all]").prop("checked", allChecked);
            verifyAnyChecked();
        });

        function verifyAnyChecked() {
            var anyChecked = $("[data-f4f-select-one]:checked").length > 0;
            if (anyChecked) {
                $("[data-f4f-any-selected]").addClass("btn-generic").removeClass("btn-generic-disabled");
            } else {
                $("[data-f4f-any-selected]").addClass("btn-generic-disabled").removeClass("btn-generic");
            }
        }
    });

    $("[data-f4f-chk-reserve]").on("change", function () {
        var row = $(this).closest(".shopping-cart-row");
        if ($(this).is(":checked")) {
            var div = $("[data-f4f-reserve]").children("div").clone().removeClass("display-none");
            row.after(div);
        } else {
            if (row.next().is(".form-generic")) {
                row.next().remove();
            }
        }
    });

    $("[data-f4f-scroll-to]").on("click", function () {
        var element = $(this).data("f4f-scroll-to");
        $([document.documentElement, document.body]).animate({
            scrollTop: $(element).offset().top - 100
        }, 500);
    });

    $("[data-f4f-cart-change-step]").on("click", function () {
        var step = $(this).data("f4f-cart-change-step");
        $(".main").find("[data-f4f-cart-step=\"" + step + "\"]").removeClass("display-none").siblings().addClass("display-none");
    });

    $("[data-f4f-slide-show]").on("click", function () {
        var element = $(this).data("f4f-slide-show");
        $(element).slideDown(200);
    });

    $("[data-f4f-slide-hide]").on("click", function () {
        var element = $(this).data("f4f-slide-hide");
        $(element).slideUp(200);
    });

    $("#finalizar-carrinho").on("click", function () {
        $("#modal-carrinho").addClass("display-flex");
    });

    $("[data-f4f-trigger-search]").on("click", function () {
        $("#form-search").find(":submit").click();
    });

    $("[data-f4f-close-modal]").on("click", function () {
        $(this).closest(".generic-modal").removeClass("display-flex");
    });

    $("[data-f4f-show-modal]").on("click", function () {
        var element = $(this).data("f4f-show-modal");
        $(element).addClass("display-flex");
    });

    $("[data-f4f-image-gallery]").each(function () {
        var mainImage = $(this).find("[data-f4f-main-image]");
        $("[data-f4f-image-list]>div").click(function () {
            var image = $(this).find("img").attr("src");
            $(".zoomContainer").remove();
            mainImage.removeData("elevateZoom").attr("src", image).data("zoom-image", image).elevateZoom({ borderSize: 0 });
        });
    });

    if ($.fn.elevateZoom) {
        $("[data-f4f-main-image]").elevateZoom({ borderSize: 0 });
    }
});

$(window).on("load", function () {
    var recaptcha = $("#g-recaptcha-response");
    if (recaptcha) {
        recaptcha.prop("required", true).prop("disabled", true);
    }
});
