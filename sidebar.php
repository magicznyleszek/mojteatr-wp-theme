<sidebar id="sidebar">

    <div class="tickets">
        <h1>Bilety</h1>
        <ul class="menu">
            <li class="menu-item">
                <a href="https://mojteatr.bilety24.pl/index/index" target="_blank" title="Kup online">KUP ONLINE</a>
            </li>
            <!-- <li class="menu-item">
                <a href="http://mojteatr.pl/rezerwacja-biletow/" title="Zarezerwuj">ZAREZERWUJ</a>
            </li> -->
        </ul>
    </div>

    <div class="search">
        <h2>Wyszukiwarka</h2>
        <?php include (TEMPLATEPATH . '/searchform.php'); ?>
    </div>

    <div class="kontakt">
        <h2>Kontakt</h2>
        <ul class="menu"><li class="menu-item"><a href="http://g.co/maps/vjw2" title="Idź do mapy"><span class="caps">MAPA</span></a></li></ul>
        Gorczyczewskiego 2/1A
        <br />
        60-554 Poznań
        <br />
        +48 604 111 755<br />informacje: Joanna Nawrocka
        <br />
        <a href="mailto:biuro@mojteatr.pl">biuro@mojteatr.pl</a>
        <br /><br />
        Dyrektor artystyczny:
        <br />
        Marek Zgaiński
        <br />
        <a href="mailto:m.zgainski@mojteatr.pl">m.zgainski@mojteatr.pl</a>
        <br />
        +48 668 856 444
    </div>

    <div class="menu-sidebar-container menu-przyjaciele">
        <h2>Przyjaciele</h2>
        <?php wp_nav_menu( array('menu' => 'Przyjaciele', 'container' => 'false' )); ?>
    </div>

    <div class="menu-sidebar-container">
        <h2>Patronat</h2>
        <span>Naszym spektaklom patronują:</span>
        <a href="http://www.wtk.pl/">
            <img src="http://mojteatr.pl/wp-content/uploads/2011/10/wtk_logo.jpg" />
        </a>
        <a href="http://www.epoznan.pl/">
            <img src="http://mojteatr.pl/wp-content/uploads/2011/10/epoznan_logo.jpg" />
        </a>
    </div>

    <div class="menu-sidebar-container menu-sponsorzy">
        <h2>Sponsorzy</h2>
        <?php wp_nav_menu( array('menu' => 'Sponsorzy', 'container' => 'false' )); ?>
    </div>

</sidebar>
