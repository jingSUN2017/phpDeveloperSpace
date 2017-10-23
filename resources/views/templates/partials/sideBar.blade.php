<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
    <div class="sidebar-module sidebar-module-inset">
        <h4>About</h4>
        <p><?php require_once ("../public/about.php")?></p>
    </div>
    <div class="sidebar-module sidebar-module-inset">
        <h4>Elsewhere</h4>
        <ol class="list-unstyled">
            <li><a href="https://laravel.com/">Laravel</a></li>
            <li><a href="http://php.net/manual/en/">PHP Manual</a></li>
            <li><a href="https://www.w3schools.com/php/default.asp">w3schools.com</a></li>
        </ol>
    </div>
    <div class="sidebar-module sidebar-module-inset">
        <h4>Categories</h4>
        <ol class="list-unstyled">
            <li><a href="{{route('home')}}"><?php echo "All Topics"?></a></li>
            <li><a href="#"><?php echo "PHP News"?></a></li>
            <li><a href="#"><?php echo "Blogers's thought"?></a></li>
        </ol>
    </div>
</div>