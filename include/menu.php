<div class="col-md-4 menu">
    <ul class="nav nav-pills nav-stacked">
        <li <?php if($_SERVER['PHP_SELF']=='/cmd/index.php'){echo 'class="active"';}?> >
            <a href="index.php">Home</a>
        </li>
        <li <?php if($_SERVER['PHP_SELF']=='/cmd/add-show.php'){echo 'class="active"';}?> >
            <a href="add-show.php">Ajouter un Spectacle</a>
        </li>
        <li <?php if($_SERVER['PHP_SELF']=='/cmd/add-school.php'){echo 'class="active"';}?> >
            <a href="add-school.php">Ajouter un Etablissement</a>
        </li>
    </ul>
</div>