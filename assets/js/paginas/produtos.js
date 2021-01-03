var base_url  = $('#base_url').val();

$(document).ready(function(){

    $("#select-cat").chosen({width: 150});
    $("#cada-for").chosen({width: 200});
    //$("#sub-cat").chosen({width: 150});
    $(".preco").mask('R$ 999,99');

    $('#select-cat').change(function(){
        var codigo = $('#select-cat').val();
        var ativo = 1;
        if(codigo != ''){
            $.ajax({
                url: base_url + 'configurar/buscar_subcategoria',
                type: 'POST',
                data:{codigo: codigo, ativo: ativo},
                dataType: 'json',
                success: function(data){
                    if(data.retorno){
                       //console.log(data.dados['id_grupo_sub'])
                       var html = '';
                       
                       html = '<lable>Subcategoria</lable>';
                       html += '<select name ="sub" id="sub-cat">';
                       for(var i = 0; i< data.dados.length; i++){
                            
                            html += '<option value="' + data.dados[i]['id_sub'] + '" >' + data.dados[i]['descricao_sub'] + '</option>';
                       }
                       html += '</select>';

                       $('#subcat').html(html);
                       $("#sub-cat").chosen({width: 150});

                       $('#sub-cat').change(function(){

                            var codigosub = $(this).val();
                            var html2 = '';

                            $.ajax({
                                url: base_url + 'configurar/buscar_fornecedor',
                                type: 'POST',
                                dataType: 'json',
                                success: function(data){
                                    if(data.retorno){

                                        html2 = '<form>';
                                        html2 +=   '<div class="mb-3">';
                                        html2 +=   '<label class="form-label">Descrição Produto</label>';
                                        html2 +=   '<input type="text" class="form-control" id="descricao">';    
                                        html2 +=    '<div class="mb-3">';
                                        html2 +=    '<label class="form-label">Marca</label>';
                                        html2 +=    '<input type="text" class="form-control" id="marca">';
                                        html2 +=    '</div>'
                                        html2 +=    '<input type="hidden" id="codigosub" value="' + codigosub + '">';
                                        html2 += '</form>';
                                        
                                        $('#produto').html(html2);
                                        $("#fornecedor").chosen({width: 150});
                                        
                                      
                                    }else{
                                        alert('Não existe fornecedor cadastrado!');
                                    }

                                }
                            });
                        });

                    }else{
                        alert('Erro ao inserir os dados!')
                    }
                }, error: function(){
                    alert('Erro no servidor!');
                }
            });
        }
    });
});

$(document).on('click', '#salvar-produto', function(){
    var nome = $('#descricao').val();
    var marca = $('#marca').val();
    var codigo = $('#codigosub').val();
    
    if(nome != '' || marca != ''){
        $.ajax({
            url: base_url + 'produtos/cadastrar_produto',
            type: 'POST',
            data:{codigo: codigo, nome: nome, marca: marca},
            dataType: 'json',
            success: function(data){
                if(data.resultado){
                    alert('Produto cadastrado com sucesso!!');
                    $('#addproduto').modal('hide');
                    location.reload();
                }else{
                    alert('Problema ao cadastrar produto!')
                }
            }, error: function(e){
                alert('Problema no servidor!');
            } 
        });
    }else{
        alert('Todos os campos são obrigatírios!');

        $('#descricao').focus();
    }
});

$(document).on('click', '#compra', function(){
   
    var html = '';
    html = '<input type="hidden" id="codigo-produto" value="' + $(this).data('codigo') + '" >';

    $('#compra-modal').modal('show');

    $('#codigo').html(html);


});

$(document).on('click', '#salvar-compra', function(){

    var codigo = $('#codigo-produto').val();
    var dtcompra = $('#data-compra').val();
    var dtfabri = $('#data-fabri').val();
    var dtvali = $('#data-vali').val();
    var quant = $('#quant').val();
    var vlcompra = $('#valor-compra').val();
    var fornecedor = $('#cada-for').val();
    var lote = $('#lote').val();
    var codigo_pro = $('#codigo-pro').val();
    var valor = $('#valor-compra').val();

    valor = valor.replace(/[^0-9,]*/g, '').replace(',', '.');
    
    $.ajax({
        url: base_url + 'produtos/cadastrar_compra',
        type: 'POST',
        data:{ 
            codigo: codigo,
            dtcompra: dtcompra,
            dtfabri: dtfabri,
            dtvali: dtvali,
            quant: quant,
            vlcompra: vlcompra,
            fornecedor: fornecedor,
            lote: lote,
            codigo_pro: codigo_pro,
            valor: valor
        },
        dataType: 'json',
        success: function(data){

            if(data.retorno){

                alert('Compra cadastrada com sucesso!');
                $('#compra-modal').modal('hide');
                location.reload();

            }else{

                alert('Problema ao cadastrar compra!');
            }

        }, error: function(){

            alert('Problema no servidor!');

        }
    })
})


