<?php 
include "include/cnx.php";
$sucess = '0';

if(isset($_POST['id'])){
    $qte = $_POST['qte'];
    $id = $_POST['id'];
    $req = $bdd->prepare('UPDATE shows SET sho_stock = :qte  WHERE sho_id = :id');
    $req->execute(array('qte' => $qte, 'id' => $id));
    $sucess = 1;
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
                echo '<div class="alert alert-success" role="alert">Modification des stocks effectuée !</div>';
            } ?>
            
            <h2>Stocks</h2>
            <form method="POST" action="#" > 
                <table class="table table-striped" width="100%">
                    <thead>
                        <tr>
                            <td><b>Date</b></td>
                            <td><b>Titre</b></td>
                            <td><b>Etablissement</b></td>
                            <td><b>Stocks</b></td>
                            <td><b>Action</b></td>
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
                            echo '<td>'.$data['sch_name'].'</td>';?>
                            <form method="POST" action="#" >
                                <td>
                                    <input style="max-width: 50px;" type="number" name="qte" value="<?php echo $data['sho_stock']; ?>">
                                </td>
                                <td>
                                    <input type="hidden" name="id" value="<?php echo $data['sho_id']; ?>" />
                                    <button type="submit" >
                                        <i class='fa fa-refresh' aria-hidden='true' ></i>
                                    </button>
                                </td>
                            </form>
                            <?php
                            echo '</tr>';
                        } ?>
                    </tbody>
                </table>
            </form>
        </div>
        </div>
    </div>
    
    <?php include "include/footer.php"; ?>
    
</body>
</html>