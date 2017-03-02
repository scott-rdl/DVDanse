<?php
include "include/cnx.php";
$sucess = '0';

if(isset($_GET['del']) and !empty($_GET['del'])){
    $del_id = $_GET['del'];
    $req = $bdd->prepare('DELETE FROM sold WHERE sold_id = :del_id');
    $req->execute(array('del_id' => $del_id));
    $sucess = 1;
}

if(!empty($_POST['act'])){
    if($_POST['act'] == "add_sold" and isset($_POST['qte']) and isset($_POST['show'])){
        $sold_qte = $_POST['qte'];
        $sold_id_show = $_POST['show'];
        $sold_date = strtotime(trim($_POST['date']));
        $sold_buyer = trim($_POST['sold_buyer']);
        $req = $bdd->prepare('INSERT INTO sold (sold_buyer, sold_id_show, sold_qte, sold_date) VALUES (:sold_buyer, :sold_id_show, :sold_qte, :sold_date)');
        $req->execute(array(
            'sold_buyer' => $sold_buyer,
            'sold_id_show' => $sold_id_show,
            'sold_qte' => $sold_qte,
            'sold_date' => $sold_date
        ));
        $sucess = 2;
    }
} ?>

<!DOCTYPE html>
<html lang="fr">
<?php include "include/header.php"; ?>

<body>
    <div class="row">
    
        <?php include "include/menu.php"; ?>
        
        <div class="col-md-8">
        <div class="box"><?php 
        
            if ($sucess == 1){
                echo '<div class="alert alert-sucess" role="alert">Supprimé avec succès !</div>';
            } elseif ($sucess == 2) {
                echo '<div class="alert alert-success" role="alert">Ajouté avec succès !</div>';
            } ?>
        
            <h2>Ventes</h2>
            
            <form method="POST" action="#" >
                
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">
                        <i class="fa fa-pencil"></i>
                    </span>
                    <input type="text" name="sold_buyer" placeholder="Acheteur" class="form-control" aria-describedby="basic-addon1" />
                </div><br />
                
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">
                        <i class="fa fa-calendar"></i>
                    </span>
                    <input type="text" name="date" value="<?php echo date("d-m-Y"); ?>" class="form-control" aria-describedby="basic-addon1" />
                </div><br />
                
                <div class="form-group">
                    <select name="show" placeholder="Spectacle" class="form-control" id="sel1">
                        <option value="" disabled selected>Choisir un spectacle</option><?php 
                        $req = $bdd->query('SELECT * FROM shows, schools WHERE sho_id_school = sch_id ORDER BY sho_date DESC');
                        while ($data = $req->fetch()){
                            echo '<option style="color: #'.$data['sch_color'].'" value="'.$data['sho_id'].'" >'.date('d.m.Y', $data['sho_date']).' - '.$data['sho_title'].' ('.$data['sch_name'].')</option>';
                        } ?>
                    </select>
                </div>
                <label id="qte">Quantité &nbsp;</label>
                <input id="qte" class="btn btn-default" type="number" value="1" name="qte" /><br /><br />
                <input type="hidden" name="act" value="add_sold" />
                <input type="submit" value="Ajouter" class="btn btn-info" />
                <input type="reset" value="Annuler" class="btn btn-danger" />
            </form>
            
            <br /><br /><hr />
            
            <table class="table table-striped" width="100%">
                <thead>
                    <tr>
                        <td><b>Date</b></td>
                        <td><b>Titre</b></td>
                        <td width="50px"><b>Qte.</b></td>
                        <td width="50px"><b>Action</b></td>
                    </tr>
                </thead>
                <tbody><?php
                    $req = $bdd->query('
                        SELECT * 
                        FROM shows, schools, sold 
                        WHERE sho_id_school = sch_id
                        AND sold_id_show = sho_id
                        ORDER BY sold_date DESC
                    ');
                    while ($data = $req->fetch()){
                        echo '<tr style="color: #'.$data['sch_color'].'">';
                            echo '<td>'.date('d.m.Y', $data['sold_date']).'</td>';
                            echo '<td>'.$data['sho_title'].'</td>';
                            echo '<td>'.$data['sold_qte'].'</td>';
                            echo '<td><a href="?del='.$data['sold_id'].'"><img src="include/img/bin.png" width="15px"/></a></td>';
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