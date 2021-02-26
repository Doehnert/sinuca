<?php require('partials/head.php'); ?>

<div class="row">
  <div class="col-sm">

        <table class="table">
          <thead>
            <tr>
              <th scope="col">Nome do time</th>
              <th scope="col">Jogador 1</th>
              <th scope="col">Jogador 2</th>
              <th scope="col">Ação</th>
            </tr>
          </thead>
          <tbody>
          <?php
            foreach($teams as $team){
            ?>
            <tr>
              <th scope="row"><?php echo $team->name; ?></th>
              <td><?php echo $team->p1; ?></td>
              <td><?php echo $team->p2; ?></td>
              <td> <a href=<?php echo "./teams/delete?id_team={$team->id}"; ?>>Excluir</a></td>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
          <form method="post" action="">
            <div class="mb-3">
              <label for="name" class="form-label">Nome do Time</label>
              <input type="text" name="name" class="form-control" id="name" >
            </div>
            <div class="mb-3">
              <label for="p1" class="form-label">Jogador 1</label>
              <input type="text" name="p1" class="form-control" id="p1" >
            </div>
            <div class="mb-3">
              <label for="p2" class="form-label">Jogador 2</label>
              <input type="text" name="p2" class="form-control" id="p2" >
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </form>



  </div>

</div>

<?php require('partials/footer.php'); ?>