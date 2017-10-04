<?php 
include "include/cnx.php";
$sucess = '0';

if(isset($_POST['act'])){
    if($_POST['act'] == "add_show" and !empty($_POST['title'])){
        $title = trim($_POST['title']);
        $time = strtotime(trim($_POST['date']));
        $school = $_POST['school'];
        $price = $_POST['price'];
        $req = $bdd->prepare('INSERT INTO shows (date, title, school, price) VALUES (:date, :title, :school, :price)');
        $req->execute(array(
            'sho_date' => $time, 
            'sho_title' => $title, 
            'sho_price' => $price,
            'sho_id_school' => $school
        ));
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
            
            <h2>Ajouter un Support</h2>
            
            <form method="POST" action="#" >
                
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">
                        <i class="fa fa-eur"></i>
                    </span>
                    <input type="number" name="price" value="5" class="form-control" aria-describedby="basic-addon1" />
                </div><br />
                
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">
                        <i class="fa fa-plus-square "></i>
                    </span>
                    <input type="number" name="qte" value="1" class="form-control" aria-describedby="basic-addon1" />
                </div><br />
                
                <div class="form-group">
                    <select name="school" placeholder="Nom de l'école" class="form-control" id="sel1">
                        <option value="0"selected>DVD</option>
                        <option value="1">Blu-ray</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <select name="school" placeholder="Nom de l'école" class="form-control" id="sel1">
                        <option value="" disabled selected>Choisir un spectacle</option><?php 
                        $req = $bdd->query('
                            SELECT * 
                            FROM shows, schools 
                            WHERE shows.sho_school = schools.sch_id 
                            ORDER BY sch_date DESC
                        ');
                        while ($data = $req->fetch()){
                            echo '<option style="color:#'.$data['sch_color'].';" value="'.$data['sch_id'].'" >'.$data['sch_name'].'</option>';
                        } ?>
                    </select>
                </div>
            
                <input type="hidden" name="act" value="add_show" />
                <input type="submit" value="Ajouter" class="btn btn-info" />
                <input type="reset" value="Annuler" class="btn btn-danger" />
            </form>    
        
            <br /><hr />
            
            <table class="table table-striped" width="100%">
                <thead>
                    <tr>
                        <td><b>Spectacle</b></td>
                        <td><b>Titre</b></td>
                        <td><b>Etablissement</b></td>
                        <td><b>Tarif</b></td>
                    </tr>
                </thead>
                <tbody><?php
                    $req = $bdd->query('
                        SELECT * 
                        FROM shows, schools 
                        WHERE shows.sho_id_school = schools.sch_id
                        ORDER BY sho_date DESC
                    ');
                    while ($data = $req->fetch()){
                        echo '<tr style="color: #'.$data['sch_color'].'">';
                        echo '<td>'.date('d.m.Y', $data['sho_date']).'</td>';
                        echo '<td>'.$data['sho_title'].'</td>';
                        echo '<td>'.$data['sch_name'].'</td>';
                        echo '<td>'.$data['sho_price'].'</td>';
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