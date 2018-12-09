f4fApp.addController("FaleConoscoController", function($this, $elemento){

    $elemento.on("click", ".fc-deletar", function(){
        var pegaId = $(this).closest(".contact-table-rrow").data("id");

        f4fApp.showModal("Confirmação", "Deseja realmente excluir esta informação?", function(){


            $.ajax({
                type:"DELETE",
                url:"../api/v1/fale_conosco/excluir/"+pegaId,
                success:function(dados){
                    f4fApp.abrirToast("Item excluído com sucesso.");
                    $(".contact-table-rrow[data-id="+pegaId+"]").remove();
                }
            });

        });
    });


     $elemento.on("click", ".fc-visualizar", function(){
        var pegaId = $(this).closest(".contact-table-rrow").data("id");

        console.log(pegaId);
    });


});
