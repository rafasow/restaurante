
var base_url  = $('#base_url').val();

$(document).ready(function() {
   
    
});
    
//Quando o campo cep perde o foco.
$("#cep").blur(function() {
    console.log('entrou no blur')
    //Nova variável "cep" somente com dígitos.
    var cep = $(this).val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            $("#rua").val("...");
            $("#bairro").val("...");
            $("#cidade").val("...");

            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $("#logradouro").val(dados.logradouro);
                    $("#bairro").val(dados.bairro);
                    $("#cidade_op").val(dados.localidade + ' - ' + dados.uf);
                    $('#estado').val(dados.uf);
                    $('#cidade').val(dados.localidade);
                    $('#numero').focus();
                } //end if.
                else {
                    //CEP pesquisado não foi encontrado.
                    limpa_formulário_cep();
                    alert("CEP não encontrado.");
                }
            });
        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
});

$(document).on('click', '#salvar', function(){

    var nome = $('#nome-fantasia').val();
    var cnpj = $('#cnpj').val();
    var cep = $('#cep').val();
    var rua = $('#logradouro').val();
    var telefone = $('#telefone').val();
    var email = $('#email').val();
    var cidade = $('#cidade').val();
    var estado = $('#estado').val();
    var numero = $('#numero').val();
    var bairro = $('#bairro').val();
    $.ajax({
        url: base_url + 'configurar/salvar_fornecedor',
        type: 'POST',
        data:{
            nome: nome,
            cnpj: cnpj,
            cep: cep,
            rua: rua,
            telefone: telefone,
            email: email,
            cidade: cidade,
            estado: estado,
            numero: numero,
            bairro: bairro
        },
        dataType: 'json',
        success: function(data){
            if(data.retorno){
                location.reload();

            }else{
                alert('Arrei Vasio :(')
            }

        },
        error: function(e){
            console.log(e.message);
            alert('Deu um erro do caralho')
        }
    })

});


function limpa_formulário_cep() {
    // Limpa valores do formulário de cep.
    $("#rua").val("");
    $("#bairro").val("");
    $("#cidade").val("");
    $("#uf").val("");
   
}
