var urlsBase = {
    list: ["GET", ""],
    insert: ["POST", ""],
    find: ["GET", ""],
    delete: ["DELETE", ""],
    update: ["PUT", ""],
    toggle: ["PUT", ""]
};

f4fApp.addController("CrudController", function($this, $element) {
    $this.onInit = function(parentController, urls) {
        $this.parentController = parentController;
        $this.formInstance = $element.find("[data-crud-form]");
        $this.listInstance = $element.find("[data-crud-list]");
        $this.urls = $.extend({}, urlsBase, urls);
        $.applyDataMask();
        $this.setup();
    };

    $this.setup = function() {
        $element.find("[data-imagem-upload] input").on("change", $this.uploadImage);
        $element.find("[data-imagem-multi] .thumbnails img").on("click", $this.changeSelectedImage);
        $element.find("[data-form-submit]").on("click", $this.submitForm);
        $element.find("[data-form-cancel]").on("click", $this.cancelForm);
        $element.find("[data-list-reload]").on("click", $this.reload);
        $this.formInstance.on("submit", $this.onFormSubmit);
        $this.listInstance.on("click", ".editar", $this.edit);
        $this.listInstance.on("click", ".toggle", $this.toggleStatus);
        $this.listInstance.on("click", ".excluir", $this.delete);
        $this.reload();
    };

    $this.uploadImage = function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            var parent = $(this).closest("[data-imagem-upload]");
            reader.onload = function(event) {
                parent.children("img").attr("src", event.target.result);
                if (parent.is("[data-imagem-multi]")) {
                    parent.find(".thumbnails img.active").attr("src", event.target.result);
                }
            }

            reader.readAsDataURL(this.files[0]);
        }
    };

    $this.changeSelectedImage = function() {
        $(this).addClass("active").siblings().removeClass("active");
        $element.find("[data-imagem-multi]>.image-upload[data-target='" + $(this).data("bind") + "']").addClass("active").siblings().removeClass("active");
        $element.find("[data-imagem-multi]>img").attr("src", $(this).attr("src") || "");
    };

    $this.submitForm = function() {
        $element
            .find("input[type='submit']")
            .trigger("click");
    };

    $this.cancelForm = function() {
        $this.resetForm();
        $this.onFormCancel();
    };

    $this.resetForm = function() {
        $this.formInstance.get(0).reset();
        var sceditor = $this.formInstance
            .find("[data-sceditor]")
            .data("sceditor-instance")
        sceditor && sceditor.setWysiwygEditorValue("");
        $this.formInstance
            .find("[data-imagem-upload] img")
            .removeAttr("src");
        $this.formInstance.removeData("object");
    };

    $this.buildUrl = function(url, object) {
        var regex = /{(.*?)}/g;
        var matches = [];
        while (matches = regex.exec(url)) {
            var param = matches[1];
            if (object[param]) {
                url = url.replace("{" + param + "}", object[param]);
            }
        }

        return url;
    }

    $this.buildUrlFromData = function(url, data) {
        var object = {};
        for (var key in data) {
            if (key.startsWith("param")) {
                object[$.camelCase(key.replace("param", "").toLowerCase())] = data[key];
            }
        }

        return $this.buildUrl(url, object);
    }

    $this.onFormSubmit = function(event) {
        event.preventDefault();
        if ($this.parentController.onFormSubmit) {
            $this.parentController.onFormSubmit(this);
        } else {
            $this._onFormSubmit(this);
        }
    };

    $this.edit = function() {
        if ($this.parentController.edit) {
            $this.parentController.edit(this);
        } else {
            $this._edit(this);
        }
    };

    $this.toggleStatus = function() {
        if ($this.parentController.toggleStatus) {
            $this.parentController.toggleStatus(this);
        } else {
            $this._toggleStatus(this);
        }
    };

    $this.delete = function() {
        if ($this.parentController.delete) {
            $this.parentController.delete(this);
        } else {
            $this._delete(this);
        }
    };

    $this.reload = function(event) {
        if (event) {
            event.preventDefault();
        }

        if ($this.parentController.reload) {
            $this.parentController.reload(this);
        } else {
            $this._reload(this);
        }
    };

    $this.onFormCancel = function() {
        return $this.parentController.onFormCancel && $this.parentController.onFormCancel();
    };

    $this.buildTemplate = function(item) {
        $template = $this.parentController.buildTemplate && $this.parentController.buildTemplate(item);
        if ($template) {
            return $template;
        } else {
            return $element.find("[data-crud-template]").tmpl(item);
        }
    };

    $this.onInsert = function() {
        return $this.parentController.onInsert && $this.parentController.onInsert();
    };

    $this.onUpdate = function() {
        return $this.parentController.onUpdate && $this.parentController.onUpdate();
    };

    $this.onEditStarted = function() {
        return $this.parentController.onEditStarted && $this.parentController.onEditStarted();
    };

    $this.onToggleStatus = function(isDisable) {
        return $this.parentController.onToggleStatus && $this.parentController.onToggleStatus(isDisable);
    };

    $this.onDelete = function() {
        return $this.parentController.onDelete && $this.parentController.onDelete();
    };

    $this.validateForm = function(data) {
        return $this.parentController.validateForm ? $this.parentController.validateForm(data) : true;
    };

    $this._onFormSubmit = function(context) {
        var formData = $this.formInstance.serializeObject();
        var method = $this.urls.insert[0];
        var url = $this.urls.insert[1];
        var isUpdate = false;

        if ($this.formInstance.data("object")) {
            formData = $.extend(true, {}, $this.formInstance.data("object"), formData);
            method = $this.urls.update[0];
            url = $this.buildUrl($this.urls.update[1], formData);
            isUpdate = true;
        }

        if ($this.validateForm(formData)) {
            $.ajax({
                type: method,
                url: url,
                data: JSON.stringify(formData),
                contentType: "application/json",
                success: function(item) {
                    $this.resetForm();
                    var template = $this.buildTemplate(item || formData);
                    if (isUpdate) {
                        $this.listInstance
                            .find(".linha[data-param-id='" + formData.id + "']")
                            .replaceWith(template);
                        $this.onUpdate();
                    } else {
                        $this.listInstance.find(".linha").first().after(template);
                        $this.onInsert();
                    }
                },

                error: function(error) {
                    if (error.responseJSON) {
                        f4fApp.abrirToast(error.responseJSON.result);
                    } else {
                        f4fApp.abrirToast("Não foi possível completar a requisição.");
                    }
                }
            });
        }
    };

    $this._edit = function(context) {
        var url = $this.buildUrlFromData($this.urls.find[1], $(context).parent().parent().data());
        $.ajax({
            type: $this.urls.find[0],
            url: url,
            success: function(item) {
                $this.formInstance.get(0).reset();
                var itemIterator = convertObject(item);
                for (var key in itemIterator) {
                    var element = $this.formInstance.find("[name='" + key + "'], [data-bind='" + key + "']");
                    if (element.is("[data-sceditor]")) {
                        element.data("sceditor-instance").setWysiwygEditorValue(itemIterator[key]);
                    } else if (element.is("[data-imagem-upload]")) {
                        element.find("img").attr("src", "../" + itemIterator[key]);
                    } else if (element.is(":checkbox")) {
                        element.prop("checked", !!itemIterator[key]);
                    } else {
                        element.val(itemIterator[key]);
                    }
                }

                $this.formInstance.data("object", item);
                $this.onEditStarted();
                $this.formInstance.find("[data-mask]").trigger("input");
            },

            error: function(error) {
                if (error.responseJSON) {
                    f4fApp.abrirToast(error.responseJSON.result);
                } else {
                    f4fApp.abrirToast("Não foi possível completar a requisição.");
                }
            }
        });
    };

    $this._toggleStatus = function(context) {
        var button = $(context);
        var url = $this.buildUrlFromData($this.urls.toggle[1], button.parent().parent().data());
        $.ajax({
            type: $this.urls.toggle[0],
            url: url,
            success: function() {
                button.toggleClass("ativar").toggleClass("desativar");
                $this.onToggleStatus(button.hasClass("ativar"));
            },

            error: function(error) {
                if (error.responseJSON) {
                    f4fApp.abrirToast(error.responseJSON.result);
                } else {
                    f4fApp.abrirToast("Não foi possível completar a requisição.");
                }
            }
        });
    };

    $this._delete = function(context) {
        f4fApp.showModal("Exclusão", "Deseja realmente excluir este item?", function() {
            var id = $(context).parent().parent().data("param-id");
            var url = $this.buildUrlFromData($this.urls.delete[1], $(context).parent().parent().data());
            $.ajax({
                type: $this.urls.delete[0],
                url: url,
                success: function() {
                    $this.listInstance
                        .find(".linha[data-param-id='" + id + "']")
                        .remove();
                    $this.onDelete();

                    if ($this.formInstance.data("object") && $this.formInstance.data("object").id == id) {
                        $this.cancelForm();
                    }
                },

                error: function(error) {
                    if (error.responseJSON) {
                        f4fApp.abrirToast(error.responseJSON.result);
                    } else {
                        f4fApp.abrirToast("Não foi possível completar a requisição.");
                    }
                }
            });
        });
    };

    $this._reload = function(context) {
        $.ajax({
            type: $this.urls.list[0],
            url: $this.urls.list[1],
            success: function(items) {
                if (items && items.forEach) {
                    $this.listInstance.children(".linha:not(:first)").remove();
                    items.forEach(function(item) {
                        var template = $this.buildTemplate(item);
                        $this.listInstance.append(template);
                    });
                }
            },

            error: function(error) {
                if (error.responseJSON) {
                    f4fApp.abrirToast(error.responseJSON.result);
                } else {
                    f4fApp.abrirToast("Não foi possível completar a requisição.");
                }
            }
        });
    };
});
