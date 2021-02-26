<?php require ('partials/head.php'); ?>

<h4>Ver outros campeonatos</h4>
<form method="get" action="">
  <select onchange="this.form.submit()" class="form-select" name="champ_id" aria-label="Default select example">
    <?php
      foreach ($champs as $ch) {
    ?>
      
    <option value=<?php echo $ch->id; ?> <?php
      if($ch->id == $champ->id){
          echo " selected";
      }
    ?>><?php echo $ch->name; ?>
    
    </option>
    <?php
      }
    ?>
  </select>  
</form>

<h2>Pontuação do campeonato <?php echo $champ->name; ?></h2>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Time</th>
        <th scope="col">Pontuação</th>
      </tr>
    </thead>
    <tbody>
    <?php
    foreach ($champTeams as $team) {
        ?>
      <tr>
        <td><?php
        
        if ($team->points >= $champ->ptw){
        ?>
        <div class="alert alert-success" role="alert">
          Time Vencedor: <?php echo $team->name; $flag_win = 1; ?>
        </div>
        <?php
        } else {
          echo $team->name;
        }
        ?></td>
        <td><?php echo $team->points; ?></td>
      </tr>
    <?php
    }
    ?>
    </tbody>
  </table>

  <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" <?php if ($flag_win==1){ echo 'disabled';} ?>>
  Informar nova pontuação
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form method="post" action="">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Partida de Sinuca</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
          <div class="mb-3">
              <label for="team" class="form-label">Time</label>
              
              <select class="form-select" name="team" aria-label="Default select example">
              <?php
                foreach ($champTeams as $team) {
              ?>
                
              <option value=<?php echo $team->id; ?>><?php echo $team->name; ?></option>
              <?php
                }
              ?>
            </select>
          </div>
          <div class="mb-3">
              <label for="points" class="form-label">Pontuação a ser acrescentada</label>
              <input type="number" name="points" class="form-control" id="points" >
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>
<?php require ('partials/footer.php'); ?>
