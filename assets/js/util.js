$.fn.serializeArrayDisabled = function() {
    var disabled = this.find(":input:disabled").removeAttr("disabled");
    var serialized = this.serializeArray();
    disabled.attr("disabled", "disabled");
    return serialized;
};

$.fn.serializeObject = function() {
    var formData = formToObject(this.serializeArray());
    this.find("input[type=checkbox]:not(:checked)").map(function(index, input) {
        return input.name;
    }).get().forEach(function(name) {
        formData[name] = "0";
    });

    this.find("[data-money-format]").each(function(index, element) {
        formData[element.name] = element.value.replace(/\./g, "").replace(/,/g, ".");
    });

    this.find("[data-imagem-upload]").find("input").each(function() {
        if (this.files && this.files[0]) {
            var file = this.files[0];
            var name = $(this).attr("name");
            var obj = formData;
            if (name.indexOf(".") != -1) {
                nameObj = name.split(".")[0];
                name = name.split(".")[1];
                if (!formData[nameObj]) {
                    formData[nameObj] = {};
                }

                obj = formData[nameObj];
            }

            obj[name] = {
                fileName: file.name,
                fileSize: file.size,
                fileType: file.type,
                fileData: $(this).parent().is("[data-target]") ?
                                $(this).closest("[data-imagem-upload]").find("img[data-bind='" + $(this).parent().data("target") + "']").attr("src") :
                                $(this).siblings("img").attr("src")
            }
        }
    });

    this.find("[data-sceditor]").each(function() {
        formData[this.name] = $(this).data("sceditor-instance").val();
    });

    return formData;
}

$.fn.setObject = function(object) {
    var object = convertObject(object);
    for (var propriedade in object) {
        this.find("[name='" + propriedade + "']").val(object[propriedade]);
    }

    this.data("f4f-form-object", object);
    this.find("[data-mask]").trigger("input");
    return this;
}

$.fn.getObject = function() {
    var object = this.data("f4f-form-object") || [];
    this.removeData("f4f-form-object");
    return $.extend(true, {}, object, this.serializeObject());
}

$.fn.clearObject = function() {
    this.removeData("f4f-form-object");
    if (this.get(0)) {
        this.get(0).reset();
    }

    return this;
}

function formToObject(dados) {
    var resultado = {};
    dados.forEach(function(item) {
        if (item.name.indexOf(".") != -1) {
            var propriedade = item.name.split(".");
            if (propriedade.length == 2) {
                if (!resultado[propriedade[0]]) {
                    resultado[propriedade[0]] = {};
                }

                resultado[propriedade[0]][propriedade[1]] = item.value;
            }

        } else {
            resultado[item.name] = item.value;
        }
    });

    return resultado;
}

function convertObject(obj, current) {
    var resultado = arguments.length <= 2 || arguments[2] === undefined ? {} : arguments[2];
    for (var propriedade in obj) {
        var valor = obj[propriedade];
        var chave = current ? current + "." + propriedade : propriedade;
        if (valor && typeof valor === "object") {
            convertObject(valor, chave, resultado);
        } else {
            resultado[chave] = valor;
        }
    }

    return resultado;
}

function moneyFormat(value) {
    var re = "\\d(?=(\\d{3})+\\D)", num = value.toFixed(Math.max(0, 2));
    return num.replace(".", ",").replace(new RegExp(re, "g"), "$&.");
}

function checkBoolean(value) {
    return value == "true" || value == true || parseInt(value);
}

function removeHtml(html) {
    return $($.parseHTML(html)).text();
}
