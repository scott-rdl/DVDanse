<div class="col-md-4 menu">
    <ul class="nav nav-pills nav-stacked">
        <li <?php if($_SERVER['PHP_SELF']=='/cmd/index.php'){echo 'class="active"';} ?> >
            <a href="index.php">Home</a>
        </li>
        <li <?php if($_SERVER['PHP_SELF']=='/cmd/sold.php'){echo 'class="active"';} ?> >
            <a href="sold.php">Ventes</a>
        </li>
        <li <?php if($_SERVER['PHP_SELF']=='/cmd/add-show.php'){echo 'class="active"';} ?> >
            <a href="add-show.php">Ajouter un Spectacle</a>
        </li>
        <li <?php if($_SERVER['PHP_SELF']=='/cmd/add-support.php'){echo 'class="active"';} ?> >
            <a href="add-support.php">Ajouter un Support</a>
        </li>
        <li <?php if($_SERVER['PHP_SELF']=='/cmd/add-school.php'){echo 'class="active"';} ?> >
            <a href="add-school.php">Ajouter un Etablissement</a>
        </li>
        <li <?php if($_SERVER['PHP_SELF']=='/cmd/stocks.php'){echo 'class="active"';} ?> >
            <a href="stocks.php">Gestion des stocks</a>
        </li>
    </ul>
</div>