<div class="page-wrapper">
    <div class="container-fluid">

    <button type="button" data-toggle="modal" data-target="#addproduto" class="btn btn-primary btn-lg" style="margin-bottom: 20px;">Adicionar Produto</button>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
               
            <?php if(!empty($produtos)){?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">codigo</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Sub-Categoria</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php 
                            foreach($produtos as $cada) { ?>
                            <th scope="row"><?= $cada['id_produto'] ?></th>
                                <td><?= $cada['descricao_pro'] ?></td>
                                <td><?= $cada['descricao_sub'] ?></td>
                                <td><?= $cada['descricao_gru'] ?></td>
                                <td><button type="button" title="Entrada Produto" class="btn btn-primary" data-codigo="<?= $cada['id_produto'] ?>" id="compra"><i class="fas fa-truck"></i></button></td>
                               
                            </tr>
                        <?php } ?>
                    </tbody>
                    </table>
               <?php }else{
                   echo '<h3>Não existe produto cadastrato</h3>';
               } ?>
                </div>
            </div>
        </div>
    </div>
</div>

  <!-- Modal -->
<div class="modal fade" id="addproduto" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Cadastro de Produto</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="card-body">
                <div class="form-group m-t-20">
                <?php if(!empty($cat)){ ?>
                    <label>Categorias</label>
                    <select name="categoria" id='select-cat'>
                   <?php foreach($cat as $cada){ ?>
                        <option value="<?=$cada['id_grupo']?>"><?=$cada['descricao_gru']?></option>
                  <?php } } ?>
                    </select>
<!-- O formulario do produto é feito no javascrip produto.js e inserido nas divs abaixo -->
                    <div id="subcat"></div>
                    <div id="produto"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" id="salvar-produto" class="btn btn-primary">Salvar</button>
        </div>
      </div>   
    </div>
  </div>
</div>


<div class="modal fade" id="compra-modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Compra de Produto</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Data da Compra</label>
                <input type="date" class="form-control" style="width: 200px;" id="data-compra" >
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Data Fabricação</label>
                <input type="date" class="form-control" style="width: 200px;" id="data-fabri" >
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Data Validade</label>
                <input type="date" class="form-control" style="width: 200px;" id="data-vali" >
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Quantidade</label>
                <input type="tel" class="form-control" style="width: 100px;" id="quant" >
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Valor de Compra (Item)</label>
                <input type="tel" class="form-control preco" style="width: 250px;" id="valor-compra" >
            </div>
            <?php if(!empty($fornecedor)){ ?>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Fornecedor</label><br>
                <select name="fornecedor" id='cada-for'>
                   <?php foreach($fornecedor as $cada){ ?>
                        <option value="<?=$cada['codigo_for']?>"><?=$cada['nome_for']?></option>
                  <?php }  ?>
                    </select>
            </div>
            <?php } ?>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Lote</label>
                <input type="text" class="form-control" style="width: 100px;" id="lote" >
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Codigo</label>
                <input type="text" class="form-control" style="width: 100px;" id="codigo-pro" >
            </div>
            <div id="codigo"></div>
        </div>   
        <div class="modal-footer">
            <button type="button" id="salvar-compra" class="btn btn-primary">Salvar</button>
        </div>
      </div>   
    </div>
  </div>
</div>

