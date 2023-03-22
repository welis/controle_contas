<?php
    include 'coneccao/conection.php';
    include 'modal/formulario.php';
?>

<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand">Desenvolvido por Welis Vinicius</a>
      <button class="btn btn-outline-danger" type="submit"><a href="?logout" style="text-decoration: none; color: white;">Sair</a></button>
  </div>
</nav>

<div class="container" style="margin-top: 50px;">
    <table class="table table-hover table-striped table-bordered">
      <tr class="table-dark">
        <th>Data</th>
        <th>Conta</th>
        <th>Valor</th>
        <th>Banco</th>
        <th>Compensado</th>
        <th>Extrato</th>
        <th>Excluir</th>
      </tr>
        <?php
          $saldo_atual = 0;
          $sql = $pdo->prepare("select contas.id_conta, contas.data_cad, contas.tipo, contas.valor, bancos.nome_banco, conta_categoria.nome_conta, compensado from contas inner join bancos on contas.id_banco = bancos.id_banco inner join conta_categoria on contas.id_conta_categoria = conta_categoria.id_conta_categoria;");
          $sql->execute();
          $contas = $sql->fetchAll();
          foreach($contas as $conta){
            echo '<tr>';
            echo '<td>'.$conta['data_cad'] = date('d/m/Y', strtotime($conta['data_cad']));'</td>';
            echo '<td>'.$conta['nome_conta'].'</td>';
            echo '<td'; if($conta['tipo'] == 0){echo ' style="color: red;"';} echo '>'.$conta['valor'].'</td>';
            echo '<td>'.$conta['nome_banco'].'</td>';
            if($conta['compensado'] == 1){
              $conta['compensado'] = '<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked disabled >';
            }else{
              $conta['compensado'] = '<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" disabled>';
            }
            echo '<td>'.$conta['compensado'].'</td>';
            // extrato
            if($conta['tipo'] == 1){
              $saldo_atual = $saldo_atual + $conta['valor'];
            }else{
              $saldo_atual = $saldo_atual - $conta['valor'];
            }
            echo '<td>'.$saldo_atual.'</td>';
            echo'<td><a  class=" btn btn-danger" href="?excluir='.$conta['id_conta'].'"><i  class="bi bi-trash3"></i></a></td>';
            echo '</tr>';
          }
          if(empty($contas)){
            echo '<tr><td colspan="7" style="text-align: center;">Nenhum registro encontrado</td></tr>';
          }
        ?>
    </table>
    <!-- divider -->
    <div class="row">
      <div class="col-12">
        <hr>
      </div>
    </div>
    <!-- mostrar total de registros -->
    <div class="row">
      <div class="col-6">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Cad-conta">
          +
        </button>
      </div>
      <div class="col-4">
        <div class="row">
          <div class="col-2">
            <div>
              <button type="button" class="btn btn-primary bi bi-eye" id="visao" data-bs-toggle="modal">
                
              </button>
            </div>
          </div>
          <div class="col-10">
            <div class="alert alert-light" role="alert" style="text-align: left; padding-left: 0px;">
              <div class="despesas" id="despesas">
                <?php
                  $sql = $pdo->prepare("select sum(valor) as total from contas where tipo = 0");
                  $sql->execute();
                  $total = $sql->fetch();
                  echo 'Total de despesas: '.$total['total'];
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-2">
        <div class="alert alert-light" role="alert" style="text-align: right;">
          <?php
            $sql = $pdo->prepare("select count(*) as total from contas");
            $sql->execute();
            $total = $sql->fetch();
            echo 'Total de registros: '.$total['total'];
          ?>
        </div>
      </div>
    </div>
</div>

<script>
  //mostrar e escoder a total de despesas
  const visao = document.getElementById('visao');
  const despesas = document.getElementById('despesas');
  visao.addEventListener('click', function(){
    despesas.classList.toggle('visualizar');
    if(visao.classList.contains('bi-eye')){
      visao.classList.remove('bi-eye');
      visao.classList.add('bi-eye-slash');
    }else{
      visao.classList.remove('bi-eye-slash');
      visao.classList.add('bi-eye');
    }
  });

</script>

<style>
  .table{
    margin-top: 50px;
  }
  .visualizar{
    display: none;
  }
</style>

