<?php 
$sucess = '0';

if(!empty($_POST['act'])){
    if($_POST['act'] == "add_school" and !empty($_POST['name'])){
        $name = trim($_POST['name']);
        $bg_color = trim($_POST['color']);
        $req = $bdd->prepare('INSERT INTO schools (name, color) VALUES (:name, :color,)');
        $req->execute(array('name' => $name, 'color' => $bg_color));
        $sucess = $name;
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
                    <input type="text" name="name" placeholder="Nom" class="form-control" aria-describedby="basic-addon1" />
                </div><br />
                
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">
                        <i class="fa fa-hashtag"></i>
                    </span>
                    <input type="text" name="color" placeholder="fad345" class="form-control" aria-describedby="basic-addon1" />
                </div><br />
                <input type="hidden" name="act" value="add_school" />
                <input type="submit" value="Ajouter" class="btn btn-info" />
                <input type="reset" value="Annuler" class="btn btn-danger" />
            </form><br />
        </div>
        </div>
    </div>
    
    <?php include "include/footer.php"; ?>
    
</body>
</html>