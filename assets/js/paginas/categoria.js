var base_url = $("#base_url").val();
$(document).ready(function(){

});

//adicionmar uma nova categoria
$(document).on('click', '#salvar-categoria', function(){
    var acao = $('#acao-cat').val();
    console.log(acao)
    if(acao == '' || acao == null){
        var descri = $('#descricao-cat').val();
        if(descri != ''){
            $.ajax({
                url: base_url + 'configurar/salvar_categoria',
                type: 'POST',
                data:{ descri: descri},
                dataType: 'json',
                success: function(data){
                    if(data.retorno){
                        alert('Dados salvo com sucesso!');
                        location.reload();
        
                    }else{
                        
                    }
                }
            })
        }else{
            alert("Não pode salvar valor vazio!")
        }
    }else{
        var descri = $('#descricao-cat').val();
        var codigo = $('#id-cat').val();
        
        if(descri != ''){
            $.ajax({
                url: base_url + 'configurar/salvar_categoria',
                type: 'POST',
                data:{ descri: descri, codigo: codigo, acao: acao},
                dataType: 'json',
                success: function(data){
                    if(data.retorno){
                        alert('Dados atualizados com sucesso!');
                        location.reload();
        
                    }else{
                        
                    }
                }
            })
        }
    }
   

});

$(document).on('click', '#mais-sub', function(){
    $('#codigo-cat').val($(this).data('codigo'));
    $('#descricao-sub').val('');
    $('#acao').val('');

});

$(document).on('click', '#salvar-subcategoria', function(){

    var descri = $('#descricao-sub').val();
    var codigo = $('#codigo-cat').val();
    var acao = $('#acao').val();
    if(descri != '' && (acao == '' || acao == null)){
        $.ajax({
            url: base_url + 'configurar/salvar_subcategoria',
            type: 'POST',
            data:{ descri: descri, codigo: codigo},
            dataType: 'json',
            success: function(data){
                if(data.retorno){
                    alert('Dados salvo com sucesso!');
                    location.reload();
    
                }else{
                    alert('Erro ao inserir os dados!')
                }
            }, error: function(){
                alert('Erro no servidor!');
            }
        });
    }else if(descri != '' && acao != ''){
        var cod_sub = $('#cod-sub').val();
        $.ajax({
            url: base_url + 'configurar/salvar_subcategoria',
            type: 'POST',
            data:{ descri: descri, codigo: codigo, acao: acao, cod_sub: cod_sub},
            dataType: 'json',
            success: function(data){
                if(data.retorno){
                    alert('Dados salvo com sucesso!');
                    location.reload();
    
                }else{
                    alert('Erro ao inserir os dados!')
                }
            }, error: function(){
                alert('Erro no servidor!');
            }
        });
    }
     else{
        alert("Não pode salvar valor vazio!")
    }

});

$(document).on('click', '#editar-sub', function(){
    var codigo = $(this).data('codigo');
    if(codigo != ''){
        $.ajax({
            url: base_url + 'configurar/buscar_subcategoria',
            type: 'POST',
            data:{codigo: codigo},
            dataType: 'json',
            success: function(data){
                if(data.retorno){
                   //console.log(data.dados['id_grupo_sub'])
                    $('#descricao-sub').val(data.dados[0]['descricao_sub']);
                    $('#codigo-cat').val(data.dados[0]['id_grupo_sub']);
                    $('#cod-sub').val(data.dados[0]['id_sub']);
                    $('#acao').val('1');
                    $('#addsubcategoria').modal('show');
                    
                }else{
                    alert('Erro ao inserir os dados!')
                }
            }, error: function(){
                alert('Erro no servidor!');
            }
        });
    }
});

$(document).on('click', '#excluir-cat', function(){

    if(confirm('Ao excluir a categoria, você excluira todas a subcategorias. Deseja excluir a categoria?')){

        var codigo = $(this).data('codigo');
           
        $.ajax({
            url: base_url + 'configurar/excluir_categoria',
            type: 'POST',
            data:{codigo: codigo},
            dataType: 'json',
            success: function(data){
                if(data.retorno){                  
                    alert('Categoria excluida com sucesso!!');
                    location.reload();
  
                }else{
                    alert('Erro ao inserir os dados!')
                }
            }, error: function(){
                alert('Erro no servidor!');
            }
        });
    }
});

$(document).on('click', '#editar-cat', function(){

   var codigo = $(this).data('codigo');
   //console.log(codigo)
    if(codigo != ''){
        $.ajax({
            url: base_url + 'configurar/buscar_categoria',
            type: 'POST',
            data:{codigo: codigo},
            dataType: 'json',
            success: function(data){
                if(data.retorno){
                   //console.log(data.dados['id_grupo_sub'])
                    $('#descricao-cat').val(data.dados[0]['descricao_gru']);
                    $('#id-cat').val(data.dados[0]['id_grupo']);
                    $('#acao-cat').val('1');
                    $('#addcategoria').modal('show');
                    
                }else{
                    alert('Erro ao inserir os dados!')
                }
            }, error: function(){
                alert('Erro no servidor!');
            }
        });
    }
});

$(document).on('click', '#excluir-sub', function(){

    var codigo = $(this).data('codigo');
    
    if(codigo != ''){
        console.log('entrou no if')
        if(window.confirm('Deseja realmente exluir a subcategoria? Essa ação é irreversível!')){
            $.ajax({
                url: base_url + 'configurar/excluir_subcategoria',
                type: 'POST',
                data:{codigo: codigo},
                dataType: 'json',
                success: function(data){
                    if(data.retorno){
                        alert('Subcategoria ecluído com sucesso!!');
                        location.reload();
                        
                    }else{
                        alert('Erro ao inserir os dados!')
                    }
                }, error: function(){
                    alert('Erro no servidor!');
                }
            });
        }
    }

});