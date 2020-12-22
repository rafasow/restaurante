<div class="page-wrapper">
    <div class="container-fluid">

    <button type="button" data-toggle="modal" data-target="#addcategoria" class="btn btn-primary btn-lg" style="margin-bottom: 20px;">Adicionar Categoria</button>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
               
                
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Ação</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    if(!empty($cat)){
                        foreach($cat as $cada){ ?>
                            <tr>
                                <th scope="row"><?=$cada['id_grupo']?></th>
                                <td><?=$cada['descricao_gru']?></td>
                                <td>
                                <button type="button" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#<?=$cada['id_grupo']?>" title="Listar Subcategorias"><i class="fas fa-list"></i></button>
                                <button type="button" class="btn btn-primary btn-sm" title="Editar Categoria"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-primary btn-sm" id='mais-sub' data-codigo="<?=$cada['id_grupo']?>" data-toggle="modal" data-target="#addsubcategoria" title="Adicionar Subcategoria"><i class="fas fa-plus"></i></button>
                                <button type="button" class="btn btn-primary btn-sm" title="Excluir Categoria"><i class="fas fa-ban"></i></button>
                                </td>
                                
                                <?php } } else { ?>

                                <td>Nenhum dado encontrado</td>
                                <?php  }?>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="addcategoria" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Nova Categoria</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
        <form>
            <div class="mb-3">
                <label  class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descricao-cat">
            </div>
            <button type="submit" id="salvar-categoria" class="btn btn-primary">Salvar</button>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>

  </div>
</div>

<?php if(!empty($cat)){
  //var_dump($sub);
  foreach($cat as $key => $cada){ ?>

    <div id="<?=$cada['id_grupo']?>" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
          <h4><?=$cada['descricao_gru']?></h4>
          </div>
          <div class="modal-body">
          
          <table class="table">
          <thead>
            <tr>
              <th scope="col">Código</th>
              <th scope="col">Descrição</th>
              <th scope="col">Ação</th>
            </tr>
        </thead>
          <tbody>
              <?php foreach($sub as $key2 => $cada_sub) {
                if($cada['id_grupo'] === $cada_sub['id_grupo_sub'] && $cada_sub['ativo_sub'] == 1) { ?>
                  <tr>
                      <th scope="row"><?=$cada_sub['id_sub']?></th>
                      <td><?=$cada_sub['descricao_sub']?></td>
                      <td>
                      <button type="button" class="btn btn-primary btn-sm" id='editar-sub' data-codigo="<?=$cada_sub['id_sub']?>" title="Editar Subcategoria"><i class="fas fa-edit"></i></button>
                      <button type="button" class="btn btn-primary btn-sm" id='excluir-sub' data-codigo="<?=$cada_sub['id_sub']?>"  title="Excluir Subcategoria"><i class="fas fa-ban"></i></button>
                      </td>     
                  </tr> 
                  <?php } }?>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>
<?php } } ?>

<div id="addsubcategoria" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">Nova Subcategoria</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
        <form>
            <div class="mb-3">
                <label  class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descricao-sub" value="">
            </div>
            <input type="hidden" id='cod-sub' value="">
            <input type='hidden' id='codigo-cat' value="">
            <input type='hidden' id='acao' value="">
            <button type="submit" id="salvar-subcategoria"  class="btn btn-primary">Salvar</button>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>

  </div>
</div>
