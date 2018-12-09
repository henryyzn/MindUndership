$(document).ready(function(){

    $("#form-contato").submit(

        function(evento){
            evento.preventDefault();

            $.ajax({
                type:"POST",
                url:"api/v1/fale_conosco/inserir",
                data: $('#form-contato').serialize(),
                success:function(dados){
                    $.toast({
                        text: "Sua menssagem foi enviada com sucesso!!",
                        loader: false,
                        position: { right: "10px", top: "134px" },
                        showHideTransition: "fade",
                        textAlign: "center"
                    });
                    $('#form-contato')[0].reset();

                },
                error:function(dados){
                    alert("Erro ao inserir no banco");
                }
            });

        }

    )
})
