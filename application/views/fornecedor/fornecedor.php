<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">

                    <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-info btn-lg" style="margin-bottom: 30px;" data-toggle="modal" data-target="#cadastro-for">Adicionar Fornecedor</button>
                       <?php if(!empty($fornecedor)){ ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">Código</th>
                                    <th scope="col">Nome Fantasia</th>
                                    <th scope="col">CNPJ</th>
                                    <th scope="col">Cidade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($fornecedor as $cada){ ?>
                                    <tr>
                                        <th scope="row"><?= $cada['codigo_for'] ?></th>
                                        <td><?= $cada['nome_for'] ?></td>
                                        <td><?= $cada['cnpj_for'] ?></td>
                                        <td><?= $cada['cidade_for'] . ' - ' . $cada['estado_for'] ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } else {
                            echo '<h3>Não existe fornecedor cadastrado.</h3>';

                            }?>
                        <!-- Inicio modal cadastro fornecedor -->
                        <div id="cadastro-for" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="card-title m-b-0">Cadastro Fornecedor</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group m-t-20">
                                            <label>Nome Fantasia</label>
                                            <input type="text" class="form-control" id="nome-fantasia" >
                                        </div>
                                        <div class="form-group">
                                            <label>CNPJ </label>
                                            <input type="text" class="form-control cnpj" id="cnpj" >
                                        </div>
                                        <div class="form-group">
                                            <label>Telefone</label>
                                            <input type="tel" class="form-control celular" id="telefone" >
                                        </div>
                                        <div class="form-group">
                                            <label>E-Mail</label>
                                            <input type="email" class="form-control" id="email">
                                        </div>
                                        <div class="form-group">
                                            <label>CEP</label>
                                            <input type="text" class="form-control cep" id="cep">
                                        </div>
                                        <div class="form-group">
                                            <label>Logradouro</label>
                                            <input type="text" class="form-control" id="logradouro">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Numero</label>
                                            <input type="text" class="form-control" id="numero">
                                        </div>
                                        <div class="form-group">
                                            <label>Bairro</label>
                                            <input type="text" class="form-control" id="bairro">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Cidade</label>
                                            <input type="text" class="form-control" id="cidade_op">
                                            <input type="hidden" value="" id="cidade">
                                            <input type="hidden" value="" id="estado">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="salvar" class="btn btn-primary">Salvar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>     
                </div>
            </div>
        </div>
    </div>
</div>