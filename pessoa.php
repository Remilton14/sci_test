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
                                                $sql_cafe = "SELECT * FROM `sala_evento` WHERE 1";
                                                $sql_cafe_query = mysqli_query($conn,$sql_cafe);

                                                while($sql_cafe_assoc = mysqli_fetch_assoc($sql_cafe_query)){
                                                    echo "<option value='".$sql_cafe_assoc['id_sala']."'>".$sql_cafe_assoc['nome_sala']." - ".$sql_cafe_assoc['lotacao_sala']." vagas</option>";
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

                                                    echo "<option value='".$sql_cafe_assoc['id_espaco_cafe']."'>".$sql_cafe_assoc['nome_espaco_cafe']."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-4 mb-3">
                                        <label for="periodo_cafe_2" class="form-label">Período café 2</label>
                                        <select class="form-select" aria-label="Default select example" name="periodo_cafe_2" id="periodo_cafe_2" disabled>
                                            <option value="" selected>Selecione uma opção</option>
                                            <?php
                                                $sql_cafe = "SELECT * FROM `espaco_cafe` WHERE 1";
                                                $sql_cafe_query = mysqli_query($conn,$sql_cafe);

                                                while($sql_cafe_assoc = mysqli_fetch_assoc($sql_cafe_query)){
                                                    echo "<option value='".$sql_cafe_assoc['id_espaco_cafe']."'>".$sql_cafe_assoc['nome_espaco_cafe']."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    <input type="button" class="btn btn-primary" name="btn_cadastrar_pessoa" id="btn_cadastrar_pessoa" value="Cadastrar">
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
                            <th scope="col">Sobre Nome</th>
                            <th scope="col">Sala de Evento</th>
                            <th scope="col">1º Café</th>
                            <th scope="col">2º Café</th>
                            <th scope="col">Data Cadastro</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql_pessoas = "SELECT p.*,s.`nome_sala`,(SELECT e.`nome_espaco_cafe` FROM `espaco_cafe` AS e WHERE e.`id_espaco_cafe` = p.`cafe_id_um`) AS `cafe_um`, (SELECT f.`nome_espaco_cafe` FROM `espaco_cafe` AS f WHERE f.`id_espaco_cafe` = p.`cafe_id_dois`) AS `cafe_dois` FROM `pessoas` AS p INNER JOIN `sala_evento` AS s ON (p.`sala_id` = s.`id_sala`) WHERE 1 ORDER BY p.`id_pessoa` ASC";
                            $sql_pessoas_query = mysqli_query($conn,$sql_pessoas);

                            while($sql_pessoas_assoc = mysqli_fetch_assoc($sql_pessoas_query)){

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
                                                                <form action="" method="post">
                                                                    <div class="row">
                                                                        <div class="col-12 col-lg mb-3">
                                                                            <label for="nome" class="form-label">Nome</label>
                                                                            <input type="text" class="form-control" name="nome" id="nome" value="<?= $sql_pessoas_assoc['nome_pessoa'] ?>">
                                                                        </div>
                                                                        <div class="col-12 col-lg mb-3">
                                                                            <label for="sobre_nome" class="form-label">Sobre Nome</label>
                                                                            <input type="text" class="form-control" name="sobre_nome" id="sobre_nome" value="<?= $sql_pessoas_assoc['sobre_nome_pessoa'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12 col-lg-4 mb-3">
                                                                            <label for="salao_eventos" class="form-label">Salão de eventos</label>
                                                                            <select class="form-select" aria-label="Default select example" name="salao_eventos" id="salao_eventos">
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
                                                                            <label for="periodo_cafe_1" class="form-label">Período café 1</label>
                                                                            <select class="form-select" aria-label="Default select example" name="periodo_cafe_1" id="periodo_cafe_1" >
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
                                                                            <label for="periodo_cafe_2" class="form-label">Período café 2</label>
                                                                            <select class="form-select" aria-label="Default select example" name="periodo_cafe_2" id="periodo_cafe_2">
                                                                                <?php
                                                                                    $sql_cafe_dois = "SELECT * FROM `espaco_cafe` WHERE 1";
                                                                                    $sql_cafe_dois_query = mysqli_query($conn,$sql_cafe_dois);

                                                                                    while($sql_cafe_dois_assoc = mysqli_fetch_assoc($sql_cafe_dois_query)){
                                                                                            echo "<option value=''>Espaço".$sql_cafe_dois_assoc['id_espaco_cafe'] . "cafe".$sql_pessoas_assoc['cafe_id_dois']."</option>";
                                                                                        if($sql_cafe_dois_assoc['id_espaco_cafe'] === $sql_pessoas_assoc['cafe_id_dois'])
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
                                                                        <button type="button" class="btn btn-primary">Cadastrar</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Fim edição -->

                                                <!-- Delete -->
                                                <a href="class/Class.delete.pessoa.php?id_pessoa=<?= $sql_pessoas_assoc['id_pessoa'] ?>" class="d-flex justify-content-center align-items-center bg-primary text-light rounded-circle me-2" style="width:31px;height:31px;text-decoration: none;"><i class='bx bx-message-alt-x'></i></a>
                                                
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

    </main>
    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
    <script type="text/javascript" src="assets/js/pessoas.js"></script>
</body>
</html>
<?php
    }
?>