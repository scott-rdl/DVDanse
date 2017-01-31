<?php 
    include('fonctions.php');
    $bdd = bdd();
    if(!empty($_POST['act'])){
        if($_POST['act'] == "add" and !empty($_POST['cc'])){
            $cc = trim($_POST['cc']);
            $jr = trim($_POST['jr']);
            $mo = trim($_POST['mo']);
            $wm = trim($_POST['wm']);
            $req = $bdd->prepare('INSERT INTO cartes(jr, mo, wm, cc) VALUES(:jr, :mo, :wm, :cc)');
            $req->execute(array(
                'jr' => $jr,
                'mo' => $mo,
                'wm' => $wm,
                'cc' => $cc
            ));
        }
        if($_POST['act'] == "po" and !empty($_POST['id'])){
            $id = $_POST['id'];
            if ($_POST['state'] == 0){
                $po = 1;
            } else {$po = 0;}
            $req = $bdd->prepare('UPDATE cartes SET po='.$po.' WHERE id='.$id.'');
            $req->execute();
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ciné</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="bootstrap-3.3.6-dist/css/bootstrap.min.css"/>
    <script src="jquery.js" type="text/javascript"></script>
</head>
<body>

    <div class="box">
    
        <form method="POST" action="">
                
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">
                    <i class="fa fa-credit-card"></i>
                </span>
                <input type="text" name="cc" class="form-control" placeholder="Numéro" aria-describedby="basic-addon1"/>
            </div><br/>
            
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">
                    <i class="fa fa-calendar"></i>
                </span>
                <input type="text" name="jr" class="form-control" placeholder="Jour" aria-describedby="basic-addon1"/>
            </div><br/>
            
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">
                    <i class="fa fa-calendar"></i>
                </span>
                <input type="text" name="mo" class="form-control" placeholder="Mois" aria-describedby="basic-addon1"/>
            </div><br/>
            
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">
                    <i class="fa fa-at"></i>
                </span>
                <input type="text" name="wm" class="form-control" placeholder="domaine.com" aria-describedby="basic-addon1"/>
                <input type="hidden" name="act" value="add"/>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                        <i class="fa fa-chevron-circle-right"></i>
                    </button>
                </span>
            </div><br/>     
        </form><br /><br />
        
        <form action="https://www.cinemasgaumontpathe.com/index.php?do=mon_compte%2Fconnect" method="post" target="_blank">
            <input type="text" name="user_login" />
            <input type="text" name="user_password" />
            <input type="submit" value="Connexion" />
        </form><br />
            
        <?php
        $annee = date('Y');
        $req = $bdd->query('SELECT * FROM cartes ORDER BY mo,jr');
        echo '<table width="100%">';
            while ($data = $req->fetch()){
                if ($data['po'] == 1 and ($data['mo'] < date("n") or ($data['mo'] == date("n") and $data['jr'] < (date("j") + 1)))){
                    $sql = 'UPDATE cartes SET po=0 WHERE id='.$data['id'];
                    $req = $bdd->prepare($sql);
                    $req->execute();
                }
                echo '<tr>';
                    setlocale(LC_TIME, 'french');
                    $date = $data['mo'].'/'.$data['jr'].'/'.$annee;
                    $day = strftime('%a %d', strtotime($date)).' '.$mois[$data['mo']];
                    $email = $data['cc'].'@'.$data['wm'];
                    
                    if($data['po'] == 1){
                        echo '<td style="color: green;">';
                    } else {
                        echo '<td style="color: red;">';
                    }
                    echo $day.'</td>';
                    
                    if($data['wm'] == 'laposte.net'){
                        echo '<td style="color: orange;">';
                    } else if ($data['wm'] == 'yopmail.com'){
                        echo '<td style="color: purple;">';
                    } else {
                        echo '<td style="color: black;">';
                    }
                    echo $email.'</td>'; ?>
                    
                    
                    <td>
                        <form action="https://www.cinemasgaumontpathe.com/index.php?do=mon_compte%2Fconnect" method="post" target="_blank">
                            <input type="hidden" name="user_login" value="<?php echo $email; ?>" />
                            <input type="hidden" name="user_password" value="a2m1l1di" />
                            <input type="submit" value="Connexion" />
                        </form>
                    </td>
                     <td>
                        <form method="post" action="">
                            <input type="hidden" name="act" value="po"/>
                            <input type="hidden" name="id" value="<?php echo $data['id']; ?>"/>
                            <input type="hidden" name="state" value="<?php echo $data['po']; ?>"/>
                            <button type="submit">
                                <i class="fa fa-ticket"></i>
                            </button>
                        </form>
                    </td><?php
                echo '</tr>';
            }
        echo '</table>'; ?><br/><br/>
    
        <form action="https://www.cinemasgaumontpathe.com/index.php?do=mon_compte%2Fconnect" method="post" target="_blank">
            <input type="hidden" name="user_login" value="jenna.join@gmail.com" />
            <input type="hidden" name="user_password" value="a2m1l1di" />
            <input type="submit" value="Compte Test" />
        </form>
    </div>
</body>
</html>