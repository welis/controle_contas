
<!--Modal cadastrar -->
<div class="modal fade" id="Cad-conta" tabindex="-1" aria-labelledby="cadCatDespLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cadCatDespLabel">Cadastrar banco</h5>
            </div>
                <div class="modal-body">
                <!-- Form -->
                <form method = "post">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Data:⠀</span>
                        <input type="date" class="form-control" name="dataConta" value="<?php echo date('Y-m-d'); ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Conta:</span>
                        <select class="form-select" name="nomeConta">
                            <option selected hidden>Selecione a conta</option>
                            <?php
                                $sql = $pdo->prepare("select * from conta_categoria order by nome_conta");
                                $sql->execute();
                                $contas = $sql->fetchAll();
                                foreach($contas as $conta){
                                    echo '<option value="'.$conta['id_conta_categoria'].'">'.$conta['nome_conta'].'</option>';
                                }
                            ?>
                        </select>
                        <!-- Cadastrar conta -->
                        <a  class=" btn btn-primary" href="?excluir='.$linha['id_despesa'].'" data-bs-placement="top" title="Cadastrar categoria" data-bs-toggle="modal" data-bs-target="#Cad-categoria-conta">
                            <i  class="bi bi-plus-circle"></i>
                        </a>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Tipo:⠀</span>
                        <select class="form-select" name="tipoConta">
                            <option selected hidden>Selecione o tipo</option>
                            <option value="0">Despesa</option>
                            <option value="1">Receita</option>
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">R$: ⠀⠀</span>
                        <input type="text" class="form-control" name="valorConta" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Banco:</span>
                        <select class="form-select" name="bancoConta">
                            <option selected hidden>Selecione o banco</option>
                            <?php
                                $sql = $pdo->prepare("select * from bancos order by nome_banco");
                                $sql->execute();
                                $bancos = $sql->fetchAll();
                                foreach($bancos as $banco){
                                    echo '<option value="'.$banco['id_banco'].'">'.$banco['nome_banco'].'</option>';
                                }
                            ?>
                        </select>
                        <!-- Cadastrar banco -->
                        <a  class=" btn btn-primary" href="?excluir='.$linha['id_despesa'].'" data-bs-placement="top" title="Cadastrar categoria" data-bs-toggle="modal" data-bs-target="#Cad-categoria-banco">
                            <i  class="bi bi-plus-circle"></i>
                        </a>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Compensado</span>
                        <!-- check box -->
                        <div class="form-check" style="margin-left: 5px;">
                            <input class="form-check-input" type="checkbox" name="compensado" value="1" id="flexCheckDefault">
                        </div>
                    </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fim Modal -->

<!--Modal cadastrar conta -->
<div class="modal fade" id="Cad-categoria-conta" tabindex="-1" aria-labelledby="cadCatDespLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cadCatDespLabel">Cadastrar conta</h5>
            </div>
                <div class="modal-body">
                <!-- Form -->
                <form method = "post">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Nome conta:</span>
                        <input type="text" class="form-control" name="modalNomeConta" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                    </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fim Modal -->

<!--Modal cadastrar banco -->
<div class="modal fade" id="Cad-categoria-banco" tabindex="-1" aria-labelledby="cadCatDespLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cadCatDespLabel">Cadastrar banco</h5>
            </div>
                <div class="modal-body">
                <!-- Form -->
                <form method = "post">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Nome banco:</span>
                        <input type="text" class="form-control" name="modalNomeBanco" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                    </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fim Modal -->

<?php
    //insert conta
    if(isset($_POST['modalNomeConta'])){
        $nomeConta = $_POST['modalNomeConta'];
        $sql = $pdo->prepare("insert into conta_categoria (nome_conta) values (:nomeConta)");
        $sql->bindValue(":nomeConta", $nomeConta);
        $sql->execute();
        echo '<script>window.location.href = "index.php";</script>';
    }

    //insert banco
    if(isset($_POST['modalNomeBanco'])){
        $nomeBanco = $_POST['modalNomeBanco'];
        $sql = $pdo->prepare("insert into bancos (nome_banco) values (:nomeBanco)");
        $sql->bindValue(":nomeBanco", $nomeBanco);
        $sql->execute();
        echo '<script>window.location.href = "index.php";</script>';
    }

    //insert contas
    if(isset($_POST['dataConta'])){
        $dataConta = $_POST['dataConta'];
        $nomeConta = $_POST['nomeConta'];
        $tipoConta = $_POST['tipoConta'];
        $valorConta = $_POST['valorConta'];
        $bancoConta = $_POST['bancoConta'];
        $compensado = $_POST['compensado'];
        if($compensado == ""){
            $compensado = 0;
        }else{
            $compensado = 1;
        }
        $sql = $pdo->prepare("insert into contas (data_cad, id_conta_categoria, tipo, valor, id_banco, compensado) values (:dataConta, :nomeConta, :tipoConta, :valorConta, :bancoConta, :compensado)");
        $sql->bindValue(":dataConta", $dataConta);
        $sql->bindValue(":nomeConta", $nomeConta);
        $sql->bindValue(":tipoConta", $tipoConta);
        $sql->bindValue(":valorConta", $valorConta);
        $sql->bindValue(":bancoConta", $bancoConta);
        $sql->bindValue(":compensado", $compensado);
        $sql->execute();
        echo '<script>window.location.href = "index.php";</script>';
    }

    //excluir conta
    if(isset($_GET['excluir'])){
        $id = $_GET['excluir'];
        $sql = $pdo->prepare("delete from contas where id_conta = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        echo '<script>window.location.href = "index.php";</script>';
    }

?>