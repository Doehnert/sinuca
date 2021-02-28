<?php require('partials/head.php'); ?>


<?php if (isset($_SESSION["error_msg"])) {
?>
  <div class="alert alert-danger" role="alert">
    <?php echo ($_SESSION["error_msg"]); ?>
  </div>
<?php
}
?>


<h4>Ver outros campeonatos</h4>

<form method="get" action="">
  <select onchange="this.form.submit()" class="form-select" name="champ_id" aria-label="Default select example">
    <?php
    foreach ($champs as $ch) {
    ?>

      <option value=<?php echo $ch->getId(); ?> <?php
                                                if ($ch->getId() == $champ->getId()) {
                                                  echo " selected";
                                                }
                                                ?>><?php echo $ch->getName(); ?>

      </option>
    <?php
    }
    ?>
  </select>
</form>

<h1>Campeonato de Sinuca</h1>

<form method="post" action="./update">

  <input type="hidden" name="champ_id" value="<?php echo ($champ->getId()); ?>" />

  <div class="mb-3">
    <label for="name" class="form-label">Nome do Campeonato</label>
    <input type="text" name="name" class="form-control" id="name" value="<?php echo ($champ->getName()); ?>">
  </div>
  <div class="mb-3">
    <label for="premium" class="form-label">Prêmio</label>
    <input type="text" name="premium" class="form-control" id="premium" value=<?php echo $champ->getPremium(); ?>>
  </div>
  <div class="mb-3">
    <label for="premium" class="form-label">Pontos para ganhar</label>
    <input type="text" name="ptw" class="form-control" id="ptw" value=<?php echo $champ->getPtw(); ?>>
  </div>

  <div class="mb-3">
    <label for="description" class="form-label">Descrição das regras</label>

    <textarea name="description" for="description" class="form-control" id="description" for="description"><?php echo $champ->getDescription(); ?></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Salvar</button>
</form>

<form method="post" action="">
  <button type="submit" class="btn btn-success">Novo Campeonato</button>
</form>

<a class='btn btn-danger' href=<?php echo "./delete?id_champ={$champ->getId()}"; ?>>Excluir Campeonato Atual</a>



<h2>Definir Times Participantes</h2>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Time</th>
      <th scope="col">Ação</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($champTeams as $team) {
    ?>
      <tr>
        <td scope="row"><?php echo $team->name; ?></td>
        <td> <a href=<?php echo "./participate/delete?id_team={$team->id}"; ?>>Excluir</a></td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>


<?php if ($_SESSION["error"]) {
?>
  <div class="alert alert-warning" role="alert">
    <?php echo $_SESSION["error"]; ?>
  </div>
<?php
}
?>

<form method="post" action="./participate">
  <input type="hidden" name="champ_id" value="<?php echo ($champ->id); ?>" />
  <select class="form-select" name="id_team" aria-label="Default select example">
    <?php
    foreach ($teams as $team) {
    ?>
      <option value=<?php echo $team->getId(); ?>><?php echo $team->getName(); ?></option>
    <?php
    }
    ?>
  </select>
  <button type="submit" class="btn btn-primary">Inserir</button>
</form>


<?php require('partials/footer.php'); ?>