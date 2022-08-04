<?php
    session_start();
    if(isset($_SESSION['usuario']) && isset($_SESSION['senha'])){

        include_once 'class/Class.Conection.php';
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<?php include 'includes/header.php'; ?>
<style>
    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 20px !important;
        padding:5px 12px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 100% !important;
        padding: 5px 15px !important;
    }
    #tabela_pessoas_filter{
        margin-right:10% !important;
    }
    .form-control:focus ,.form-select:focus {
        box-shadow: none !important;
    }
</style>
<body>
    <main class="main" id="main">
        <div class="container-menu shadow-sm">
            <div class="container">

                <div class="menu pt-1 pb-1" id="menu">
                    <?php include 'includes/menu.php'; ?>
                </div>
            </div>
        </div>


        <div class="container mt-3">
            <!-- Botão novo cadastro -->
            <div class="text-end">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Novo Cadastro</button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Novo cadastro</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="class/Class.cadastro.pessoa.php" method="post" id="form_cadastro_pessoas">
                                <div class="row">
                                    <div class="col-12 col-lg mb-3">
                                        <label for="nome" class="form-label">Nome</label>
                                        <input type="text" class="form-control" name="nome" id="nome" aria-describedby="emailHelp">
                                    </div>
                                    <div class="col-12 col-lg mb-3">
                                        <label for="sobre_nome" class="form-label">Sobre Nome</label>
                                        <input type="text" class="form-control" name="sobre_nome" id="sobre_nome" aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-4 mb-3">
                                        <label for="salao_eventos" class="form-label">Salão de eventos</label>
                                        <select class="form-select" aria-label="Default select example" name="salao_eventos" id="salao_eventos">
                                            <option value="" selected>Selecione uma opção</option>
                                            <?php
                                                $sql_salao = "SELECT * FROM `sala_evento` WHERE 1";
                                                $sql_salao_query = mysqli_query($conn,$sql_salao);

                                                while($sql_salao_assoc = mysqli_fetch_assoc($sql_salao_query)){
                                                    if(($sql_salao_assoc['lotacao_sala']-$sql_salao_assoc['qnt_inscritos']) != 0)
                                                        echo "<option value='".$sql_salao_assoc['id_sala']."'>".$sql_salao_assoc['nome_sala']." - ".($sql_salao_assoc['lotacao_sala']-$sql_salao_assoc['qnt_inscritos'])." vagas</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-4 mb-3">
                                        <label for="periodo_cafe_1" class="form-label">Período café 1</label>
                                        <select class="form-select" aria-label="Default select example" name="periodo_cafe_1" id="periodo_cafe_1" >
                                            <option value="" selected>Selecione uma opção</option>
                                            <?php
                                                $sql_cafe = "SELECT * FROM `espaco_cafe` WHERE 1";
                                                $sql_cafe_query = mysqli_query($conn,$sql_cafe);

                                                while($sql_cafe_assoc = mysqli_fetch_assoc($sql_cafe_query)){

                                                    if(($sql_cafe_assoc['lotacao_max_cafe'] - $sql_cafe_assoc['qtn_inscritos']) != 0)
                                                        echo "<option value='".$sql_cafe_assoc['id_espaco_cafe']."'>".$sql_cafe_assoc['nome_espaco_cafe']." - ".($sql_cafe_assoc['lotacao_max_cafe'] - $sql_cafe_assoc['qtn_inscritos'])." vagas</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-4 mb-3">
                                        <label for="periodo_cafe_2" class="form-label">Período café 2</label>
                                        <select class="form-select" aria-label="Default select example" name="periodo_cafe_2" id="periodo_cafe_2" disabled>
                                            <option value="" selected>Selecione uma opção</option>
                                            <?php
                                                $sql_cafe2 = "SELECT * FROM `espaco_cafe` WHERE 1";
                                                $sql_cafe2_query = mysqli_query($conn,$sql_cafe2);

                                                while($sql_cafe2_assoc = mysqli_fetch_assoc($sql_cafe2_query)){
                                                    if(($sql_cafe2_assoc['lotacao_max_cafe'] - $sql_cafe2_assoc['qtn_inscritos']) != 0)
                                                        echo "<option value='".$sql_cafe2_assoc['id_espaco_cafe']."'>".$sql_cafe2_assoc['nome_espaco_cafe']." - ".($sql_cafe2_assoc['lotacao_max_cafe'] - $sql_cafe2_assoc['qtn_inscritos'])." vagas</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
                                    <input type="button" class="btn btn-primary btn-sm" name="btn_cadastrar_pessoa" id="btn_cadastrar_pessoa" value="Cadastrar">
                                </div>
                            </form>
                            <div class="error_msg_notification position-absolute text-danger" id="error_msg_notification" style="bottom: 10px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fim novo cadastro -->
            <div class="tabela">
                <table class="table table-striped" id="tabela_pessoas">
                    <thead>
                        <tr>
                            <th scope="col">Cód</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Sobrenome</th>
                            <th scope="col">Sala de Evento</th>
                            <th scope="col">1º Café</th>
                            <th scope="col">2º Café</th>
                            <th scope="col">Data Cadastro</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $arr_pessoas = array();
                            $sql_pessoas = "SELECT p.*,s.`nome_sala`,(SELECT e.`nome_espaco_cafe` FROM `espaco_cafe` AS e WHERE e.`id_espaco_cafe` = p.`cafe_id_um`) AS `cafe_um`, (SELECT f.`nome_espaco_cafe` FROM `espaco_cafe` AS f WHERE f.`id_espaco_cafe` = p.`cafe_id_dois`) AS `cafe_dois` FROM `pessoas` AS p INNER JOIN `sala_evento` AS s ON (p.`sala_id` = s.`id_sala`) WHERE 1 ORDER BY p.`id_pessoa` ASC";
                            $sql_pessoas_query = mysqli_query($conn,$sql_pessoas);

                            while($sql_pessoas_assoc = mysqli_fetch_assoc($sql_pessoas_query)){
                                array_push($arr_pessoas,$sql_pessoas_assoc['id_pessoa']);
                                ?>
                                    <tr style="font-size:0.8769rem;">
                                        <th scope="row"><?= $sql_pessoas_assoc['id_pessoa'] ?></th>
                                        <td><?= $sql_pessoas_assoc['nome_pessoa'] ?></td>
                                        <td><?= $sql_pessoas_assoc['sobre_nome_pessoa'] ?></td>
                                        <td><?= $sql_pessoas_assoc['nome_sala'] ?></td>
                                        <td><?= $sql_pessoas_assoc['cafe_um'] ?></td>
                                        <td><?= $sql_pessoas_assoc['cafe_dois'] ?></td>
                                        <td><?= date('d/m/Y',strtotime($sql_pessoas_assoc['datecreate'])) ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <!-- Visualização -->
                                                <a type="button" class="d-flex justify-content-center align-items-center bg-primary text-light rounded-circle me-2" style="width:31px;height:31px;text-decoration: none;" data-bs-toggle="modal" data-bs-target="#visualizacao<?= $sql_pessoas_assoc['id_pessoa'] ?>"><i class='bx bx-zoom-in'></i></a>
                                                <!-- Modal -->
                                                <div class="modal fade" id="visualizacao<?= $sql_pessoas_assoc['id_pessoa'] ?>" tabindex="-1" aria-labelledby="visualizacao<?= $sql_pessoas_assoc['id_pessoa'] ?>Label" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="visualizacao<?= $sql_pessoas_assoc['id_pessoa'] ?>Label">Visialização <?= $sql_pessoas_assoc['id_pessoa'] ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="" method="post">
                                                                    <div class="row">
                                                                        <div class="col-12 col-lg mb-3">
                                                                            <label for="nome" class="form-label">Nome</label><br/>
                                                                            <label class="w-100 border rounded p-1"><?= $sql_pessoas_assoc['nome_pessoa'] ?></label>
                                                                        </div>
                                                                        <div class="col-12 col-lg mb-3">
                                                                            <label for="sobre_nome" class="form-label">Sobre Nome</label><br/>
                                                                            <label class="w-100 border rounded p-1"><?= $sql_pessoas_assoc['sobre_nome_pessoa'] ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12 col-lg-4 mb-3">
                                                                            <label for="salao_eventos" class="form-label">Salão de eventos</label><br/>
                                                                            <label class="w-100 border rounded p-1"><?= $sql_pessoas_assoc['nome_sala'] ?></label>
                                                                        </div>
                                                                        <div class="col-12 col-lg-4 mb-3">
                                                                            <label for="periodo_cafe_1" class="form-label">Período café 1</label><br/>
                                                                            <label class="w-100 border rounded p-1"><?= $sql_pessoas_assoc['cafe_um'] ?></label>
                                                                        </div>
                                                                        <div class="col-12 col-lg-4 mb-3">
                                                                            <label for="periodo_cafe_2" class="form-label">Período café 2</label><br/>
                                                                            <label class="w-100 border rounded p-1"><?= $sql_pessoas_assoc['cafe_um'] ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer border-0">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Fim Visualização -->

                                                <!-- Edição -->
                                                <a type="button" class="d-flex justify-content-center align-items-center bg-primary text-light rounded-circle me-2" style="width:31px;height:31px;text-decoration: none;" data-bs-toggle="modal" data-bs-target="#edicao<?= $sql_pessoas_assoc['id_pessoa'] ?>"><i class='bx bxs-edit'></i></a>
                                                <!-- Modal -->
                                                <div class="modal fade" id="edicao<?= $sql_pessoas_assoc['id_pessoa'] ?>" tabindex="-1" aria-labelledby="edicao<?= $sql_pessoas_assoc['id_pessoa'] ?>Label" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="edicao<?= $sql_pessoas_assoc['id_pessoa'] ?>Label">Edição <?= $sql_pessoas_assoc['id_pessoa'] ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="class/Class.edicao.pessoa.php" method="post" id="form_edicao<?= $sql_pessoas_assoc['id_pessoa'] ?>">
                                                                    <input type="hidden" name="id_pessoa" value="<?= $sql_pessoas_assoc['id_pessoa'] ?>">
                                                                    <div class="row">
                                                                        <div class="col-12 col-lg mb-3">
                                                                            <label for="nome<?= $sql_pessoas_assoc['id_pessoa'] ?>" class="form-label">Nome</label>
                                                                            <input type="text" class="form-control" name="nome" id="nome<?= $sql_pessoas_assoc['id_pessoa'] ?>" value="<?= $sql_pessoas_assoc['nome_pessoa'] ?>">
                                                                        </div>
                                                                        <div class="col-12 col-lg mb-3">
                                                                            <label for="sobre_nome<?= $sql_pessoas_assoc['id_pessoa'] ?>" class="form-label">Sobre Nome</label>
                                                                            <input type="text" class="form-control" name="sobre_nome" id="sobre_nome<?= $sql_pessoas_assoc['id_pessoa'] ?>" value="<?= $sql_pessoas_assoc['sobre_nome_pessoa'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12 col-lg-4 mb-3">
                                                                            <label for="salao_eventos<?= $sql_pessoas_assoc['id_pessoa'] ?>" class="form-label">Salão de eventos</label>
                                                                            <select class="form-select" aria-label="Default select example" name="salao_eventos" id="salao_eventos<?= $sql_pessoas_assoc['id_pessoa'] ?>">
                                                                                <?php
                                                                                    $sql_cafe = "SELECT * FROM `sala_evento` WHERE 1";
                                                                                    $sql_cafe_query = mysqli_query($conn,$sql_cafe);

                                                                                    while($sql_cafe_assoc = mysqli_fetch_assoc($sql_cafe_query)){
                                                                                        if($sql_cafe_assoc['id_sala'] === $sql_pessoas_assoc['sala_id'])
                                                                                            echo "<option value='".$sql_cafe_assoc['id_sala']."' selected>".$sql_cafe_assoc['nome_sala']." - ".$sql_cafe_assoc['lotacao_sala']." vagas</option>";
                                                                                        else
                                                                                            echo "<option value='".$sql_cafe_assoc['id_sala']."'>".$sql_cafe_assoc['nome_sala']." - ".$sql_cafe_assoc['lotacao_sala']." vagas</option>";
                                                                                    }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-12 col-lg-4 mb-3">
                                                                            <label for="periodo_cafe_1<?= $sql_pessoas_assoc['id_pessoa'] ?>" class="form-label">Período café 1</label>
                                                                            <select class="form-select" aria-label="Default select example" name="periodo_cafe_1" id="periodo_cafe_1<?= $sql_pessoas_assoc['id_pessoa'] ?>" >
                                                                                <?php
                                                                                    $sql_cafe = "SELECT * FROM `espaco_cafe` WHERE 1";
                                                                                    $sql_cafe_query = mysqli_query($conn,$sql_cafe);

                                                                                    while($sql_cafe_assoc = mysqli_fetch_assoc($sql_cafe_query)){

                                                                                        if($sql_cafe_assoc['id_espaco_cafe'] === $sql_pessoas_assoc['cafe_id_um'])
                                                                                            echo "<option value='".$sql_cafe_assoc['id_espaco_cafe']."' selected>".$sql_cafe_assoc['nome_espaco_cafe']."</option>";
                                                                                        else
                                                                                            echo "<option value='".$sql_cafe_assoc['id_espaco_cafe']."'>".$sql_cafe_assoc['nome_espaco_cafe']."</option>"; 
                                                                                    }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-12 col-lg-4 mb-3">
                                                                            <label for="periodo_cafe_2<?= $sql_pessoas_assoc['id_pessoa'] ?>" class="form-label">Período café 2</label>
                                                                            <select class="form-select" aria-label="Default select example" name="periodo_cafe_2" id="periodo_cafe_2<?= $sql_pessoas_assoc['id_pessoa'] ?>">
                                                                                <?php
                                                                                    $sql_cafe_dois = "SELECT * FROM `espaco_cafe` WHERE 1";
                                                                                    $sql_cafe_dois_query = mysqli_query($conn,$sql_cafe_dois);

                                                                                    while($sql_cafe_dois_assoc = mysqli_fetch_assoc($sql_cafe_dois_query)){

                                                                                        if($sql_cafe_dois_assoc['id_espaco_cafe'] === $sql_pessoas_assoc['cafe_id_um'])
                                                                                            echo "<option value='".$sql_cafe_dois_assoc['id_espaco_cafe']."' selected>".$sql_cafe_dois_assoc['nome_espaco_cafe']."</option>";
                                                                                        else
                                                                                            echo "<option value='".$sql_cafe_dois_assoc['id_espaco_cafe']."'>".$sql_cafe_dois_assoc['nome_espaco_cafe']."</option>"; 
                                                                                    }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer border-0">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <input type="button" class="btn btn-primary" id="btn_editar<?= $sql_pessoas_assoc['id_pessoa'] ?>" value="Cadastrar">
                                                                    </div>
                                                                </form>
                                                                <div class="error_msg_notification_edicao position-absolute text-danger" id="error_msg_notification_edicao" style="bottom: 10px;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Fim edição -->

                                                <!-- Delete -->
                                                <a href="class/Class.delete.pessoa.php?id_pessoa=<?= $sql_pessoas_assoc['id_pessoa'] ?>&salao_eventos=<?= $sql_pessoas_assoc['sala_id'] ?>" class="d-flex justify-content-center align-items-center bg-primary text-light rounded-circle me-2" style="width:31px;height:31px;text-decoration: none;"><i class='bx bx-message-alt-x'></i></a>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                            }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
        <?php
            if(isset($_SESSION['msg_success'])){
                echo $_SESSION['msg_success'];
                //unset($_SESSION['msg_success']);
            }elseif(isset($_SESSION['msg_error'])){
                echo $_SESSION['msg_error'];
                //unset($_SESSION['msg_error']);
            }
        ?>
    </main>
    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
    <script type="text/javascript" src="assets/js/pessoas.js"></script>
    <script>
        $(document).ready(function(){
            const msg_success = <?php echo (isset($_SESSION['msg_success'])) ? 1 : 0 ?>;
            const msg_error = <?php echo (isset($_SESSION['msg_error'])) ? 1 : 0 ?>;
            if(msg_success === 1 || msg_error === 1){
                setTimeout(() => {
                    $('#msg').remove();
                }, 3200);
            }
            //edição
            var arr_pessoas = ["<?php echo implode('","',$arr_pessoas); ?>"];

            $.each(arr_pessoas,function(index,value){
                $('#nome' + value).blur(function(){
                    if($(this).val() != ''){
                        $(this).removeClass('border border-danger');
                    }
                });
                $('#sobre_nome' + value).blur(function(){
                    if($(this).val() != ''){
                        $(this).removeClass('border border-danger');
                    }
                });
                $('#salao_eventos' + value).blur(function(){
                    if($(this).val() != ''){
                        $(this).removeClass('border border-danger');
                    }
                });
                $('#periodo_cafe_1' + value).blur(function(){
                    if($(this).val() != ''){
                        $(this).removeClass('border border-danger');
                    }
                });
                $('#periodo_cafe_2' + value).blur(function(){
                    if($(this).val() != ''){
                        $(this).removeClass('border border-danger');
                    }
                });

                $('#periodo_cafe_1' + value).change(function(){
                    var cafe_1 = $(this).val();
                    if(cafe_1 != ''){
                        $('#periodo_cafe_2').removeAttr("disabled");
                    }
                });

                $('#periodo_cafe_2' + value).change(function(){
                    var cafe_1 = $('#periodo_cafe_1' + value).val();
                    var cafe_2 = $('#periodo_cafe_2' + value).val();
                    if(cafe_2 != '' && cafe_2 == cafe_1){
                        $('#error_msg_notification_edicao').empty();
                        $('#error_msg_notification_edicao').append('<span>Os tempos dos cafés precisam ser diferentes</span>');
                        setTimeout(() => {
                            $('#error_msg_notification_edicao').empty();
                        }, 3200);
                    }
                });

                $('#btn_editar' + value).click(function(){
                    var nome           = $('#nome' + value).val();
                    var sobre_nome     = $('#sobre_nome' + value).val();
                    var salao_eventos  = $('#salao_eventos' + value).val();
                    var periodo_cafe_1 = $('#periodo_cafe_1' + value).val();
                    var periodo_cafe_2 = $('#periodo_cafe_2' + value).val();

                    if(nome == ''){
                        $('#nome' + value).addClass('border border-danger');
                        $('#nome' + value).focus();
                        
                        $('#error_msg_notification_edicao').append('<span">O campo nome precisa ser preenchido corretamente</span>');
                        setTimeout(() => {
                            $('#error_msg_notification_edicao').empty();
                        }, 3200);
                        
                    }else if(sobre_nome == ''){
                        $('#sobre_nome' + value).addClass('border border-danger');
                        $('#sobre_nome' + value).focus();

                        $('#error_msg_notification_edicao').append('<span">O campo sobre nome precisa ser preenchido corretamente</span>');
                        setTimeout(() => {
                            $('#error_msg_notification_edicao').empty();
                        }, 3200);

                    }else if(salao_eventos  == ''){
                        $('#salao_eventos' + value).addClass('border border-danger');

                        $('#error_msg_notification_edicao').append('<span">O campo Salão de eventos precisa ser preenchido corretamente</span>');
                        setTimeout(() => {
                            $('#error_msg_notification_edicao').empty();
                        }, 3200);

                        $('#salao_eventos' + value).focus();
                    }else if(periodo_cafe_1 == ''){
                        $('#periodo_cafe_1' + value).addClass('border border-danger');
                        $('#periodo_cafe_1' + value).focus();

                        $('#error_msg_notification_edicao').append('<span">O campo Período café um precisa ser preenchido corretamente</span>');
                        setTimeout(() => {
                            $('#error_msg_notification_edicao').empty();
                        }, 3200);

                    }else if(periodo_cafe_2 == ''){
                        $('#periodo_cafe_2' + value).addClass('border border-danger');
                        $('#periodo_cafe_2' + value).focus();

                        $('#error_msg_notification_edicao').append('<span">O campo Período café um precisa ser preenchido corretamente</span>');
                        setTimeout(() => {
                            $('#error_msg_notification_edicao').empty();
                        }, 3200);

                    }else if(periodo_cafe_1 == periodo_cafe_2){
                        $('#periodo_cafe_1' + value).addClass('border border-danger');
                        $('#periodo_cafe_2' + value).addClass('border border-danger');
                        $('#periodo_cafe_2' + value).focus();

                        $('#error_msg_notification_edicao').append('<span>Os tempos dos cafés precisam ser diferentes</span>');
                        setTimeout(() => {
                            $('#error_msg_notification_edicao').empty();
                        }, 3200);
                    }else{
                        $('#form_edicao' + value).submit();
                    }
                });

            });

            //Fim edição
        });
    </script>
</body>
</html>
<?php
        
        if(isset($_SESSION['msg_success'])){
            //echo $_SESSION['msg_success'];
            unset($_SESSION['msg_success']);
        }elseif(isset($_SESSION['msg_error'])){
            //echo $_SESSION['msg_error'];
            unset($_SESSION['msg_error']);
        }

    }else{
        header('Location: ./');
    }
?>