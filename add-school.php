<?php
include "include/cnx.php";
$sucess = '0';

if(!empty($_POST['act'])){
    if($_POST['act'] == "add_school" and !empty($_POST['sch_name'])){
        $sch_name = trim($_POST['sch_name']);
        $sch_color = trim($_POST['sch_color']);
        $req = $bdd->prepare('INSERT INTO schools (sch_name, sch_color) VALUES (:sch_name, :sch_color)');
        $req->execute(array('sch_name' => $sch_name, 'sch_color' => $sch_color));
        $sucess = $sch_name;
    }
} ?>

<!DOCTYPE html>
<html lang="fr">
<?php include "include/header.php"; ?>

<body>
    <div class="row">
    
        <?php include "include/menu.php"; ?>
        
        <div class="col-md-8">
        <div class="box">
            <?php 
            if ($sucess != 0){
                echo '<div class="alert alert-success" role="alert">"'.$sucess.'" ajouté avec succès !</div>';
            } ?>
        
            <h2>Ajouter un Etablissement</h2>
            
            <form method="POST" action="#" >
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">
                        <i class="fa fa-pencil"></i>
                    </span>
                    <input type="text" name="sch_name" placeholder="Nom" class="form-control" aria-describedby="basic-addon1" />
                </div><br />
                
                
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">
                        <i class="fa fa-hashtag"></i>
                    </span>
                    <input type="text" name="sch_color" placeholder="fad345" class="form-control" aria-describedby="basic-addon1" />
                </div><br />
                
                <input type="hidden" name="act" value="add_school" />
                <input type="submit" value="Ajouter" class="btn btn-info" />
                <input type="reset" value="Annuler" class="btn btn-danger" />
            </form><br />
            
            <br /><hr />
            
            <h2>Liste</h2>
            <table class="table table-striped" width="100%">
                <thead>
                    <tr>
                        <td><b>Nom</b></td>
                        <td><b>Couleur</b></td>
                    </tr>
                 </thead>
                 <tbody> <?php
                    $req = $bdd->query('SELECT * FROM schools');
                    while ($data = $req->fetch()){
                        echo '<tr>';
                        echo '<td>'.$data['sch_name'].'</td>';
                        echo '<td><span style="color: #'.$data['sch_color'].'">#'.$data['sch_color']."</span></td>";
                        echo '</tr>';
                    } ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
    
    <?php include "include/footer.php"; ?>
    
</body>
</html>