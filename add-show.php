<?php 
include "include/cnx.php";
$sucess = '0';

if(!empty($_POST['act'])){
    if($_POST['act'] == "add_show" and !empty($_POST['title'])){
        $title = trim($_POST['title']);
        $time = strtotime(trim($_POST['date']));
        $school = $_POST['school'];
        $req = $bdd->prepare('INSERT INTO shows (date, title, school) VALUES (:date, :title, :school)');
        $req->execute(array('date' => $time, 'title' => $title, 'school' => $school));
        $sucess = $title;
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
          
            <h2>Ajouter un Spectacle</h2>
            
            <form method="POST" action="#" >
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">
                        <i class="fa fa-pencil"></i>
                    </span>
                    <input type="text" name="title" placeholder="Titre" class="form-control" aria-describedby="basic-addon1" />
                </div><br />
                
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">
                        <i class="fa fa-calendar"></i>
                    </span>
                    <input type="text" name="date" placeholder="<?php echo date("d-m-Y"); ?>" class="form-control" aria-describedby="basic-addon1" />
                </div><br />
                
                <div class="form-group">
                    <select name="school" placeholder="Nom de l'école" class="form-control" id="sel1">
                        
                        <option value="" disabled selected>Choisir un établissement</option>
                        <option value="EMMDT de Petit-Quevilly" >EMMDT de Petit-Quevilly</option> 
                        <option value="Conservatoire de Rouen">Conservatoire de Rouen</option>
                        <option value="Hangar 23">Hangar 23</option>
                        <option value="ECFM Canteleu">ECFM Canteleu</option>
                        <option value="ACSBD de Mesnil-Esnard">ACSBD de Mesnil-Esnard</option>
                        <option value="Conservatoire de Val-de-Reuil">Conservatoire de Val-de-Reuil</option>
                        
                    </select>
                </div>
            
                <input type="hidden" name="act" value="add_show" />
                <input type="submit" value="Ajouter" class="btn btn-info" />
                <input type="reset" value="Annuler" class="btn btn-danger" />
            </form><br />      
        
            <br /><hr />
            <h2>Liste</h2>
            <table class="table table-striped" width="100%">
                <thead>
                    <tr>
                        <td><b>Date</b></td>
                        <td><b>Titre</b></td>
                        <td><b>Etablissement</b></td>
                    </tr>
                </thead>
                <tbody> <?php
                    $req = $bdd->query('
                        SELECT * 
                        FROM shows, schools 
                        WHERE shows.id_school = schools.sch_id
                        ORDER BY date DESC
                    ');
                    while ($data = $req->fetch()){
                        echo '<tr style="color: #'.$data['sch_color'].'">';
                        echo '<td>'.date('d.m.Y', $data['date']).'</td>';
                        echo '<td>'.$data['title'].'</td>';
                        echo '<td>'.$data['sch_name'].'</td>';
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