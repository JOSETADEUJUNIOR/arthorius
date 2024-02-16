
    $(document).ready(function () {
        // Adiciona um manipulador de evento para o clique no item principal
        $('.sidebarMenu li').click(function () {
            // Oculta todos os subitens
            $('.submenu').not($(this).find('.submenu')).hide();

            // Alternar a visibilidade do submenu do item clicado
            $(this).find('.submenu').toggle();
        });

        // Adiciona um manipulador de evento para o hover no item principal
        $('.sidebarMenu li').hover(function () {
            // Exibe o submenu ao passar o mouse
            $(this).find('.submenu').show();
        }, function () {
            // Oculta o submenu ao retirar o mouse
            $(this).find('.submenu').hide();
        });
    });

    function LimparCamposEndereco() {
        // Limpa valores do formulário de cep.
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#estado").val("");
        
    }
    
    
    function TravarCamposEndereco(readonly){
       
           /*  $("#cidade").attr("readonly",readonly );
            $("#estado").attr("readonly",readonly ); */
           
    }
    
    
     //Quando o campo cep perde o foco.
    function BuscarCep(){
       
        //Nova variável "cep" somente com dígitos.
        var cep = $(".cep").val().replace(/\D/g, '');
    
        //Verifica se campo cep possui valor informado.
        if (cep != "") {
    
            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;
    
            //Valida o formato do CEP.
            if(validacep.test(cep)) {
    
                //Preenche os campos com "..." enquanto consulta webservice.
                $(".rua").val("...");
                $(".bairro").val("...");
                $(".cidade").val("...");
                $(".estado").val("...");
               
                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $(".rua").val(dados.logradouro);
                        $(".bairro").val(dados.bairro);
                        $(".cidade").val(dados.localidade);
                        $(".estado").val(dados.uf);
                        TravarCamposEndereco(true);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        LimparCamposEndereco();
                        TravarCamposEndereco(false);
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                LimparCamposEndereco();
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    }