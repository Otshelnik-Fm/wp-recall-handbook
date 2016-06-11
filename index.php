<?php

// Добавляем страницу
function wprh_add_subpage(){
    add_submenu_page( 'manage-wprecall','WP-Recall Handbook', 'Handbook', 'manage_options', 'wp-recall-handbook', 'wprh_page_content');
}
add_action('admin_menu', 'wprh_add_subpage',20);


// выводим на ней контент
function wprh_page_content(){
    ?>
    <div class="wprh_menu">
    <a class="nav-tab <?php wprh_active_class('wprh_facts') ?>" href="<?php echo add_query_arg( array( 'page' => 'wp-recall-handbook', 'tab' => 'wprh_facts' ), '' ); ?>"><span class="dashicons dashicons-lightbulb"></span> Знаете ли вы что...</a>
    <a class="nav-tab <?php wprh_active_class('wprh_developer') ?>" href="<?php echo add_query_arg( array( 'page' => 'wp-recall-handbook', 'tab' => 'wprh_developer' ), '' ); ?>"><span class="dashicons dashicons-hammer"></span> Старт для разработки</a>
    <a class="nav-tab <?php wprh_active_class('wprh_video') ?>" href="<?php echo add_query_arg( array( 'page' => 'wp-recall-handbook', 'tab' => 'wprh_video' ), '' ); ?>"><span class="dashicons dashicons-video-alt3"></span> Видео</a>
    </div>
    <?php
    wprh_catch_get();
}


// ловим get и подключаем нужный файл страницы
function wprh_catch_get() {
    if(isset($_GET['tab'])){
        $wprh_get = $_GET['tab'];
        switch ($wprh_get) {
            case 'wprh_facts':
                require_once("tab-1.php");
                break;
            case 'wprh_developer':
                require_once("tab-2.php");
                break;
            case 'wprh_video':
                require_once("tab-3.php");
                break;
        }
    } else {
        require_once("tab-1.php");
    }
}


// подсвечиваем активную вкладку
function wprh_active_class($tab_name = null) {
    if (isset($_GET['tab']))
        $wprh_tab = $_GET['tab'];
    else
        $wprh_tab = 'wprh_facts';
    $wprh_out = '';
    if (isset($tab_name) && $tab_name) {
        if ($tab_name == $wprh_tab){
            $wprh_out = 'nav-tab-active';
        }
    }
    echo $wprh_out;
}

function wprh_style() {
   echo '<style type="text/css">
.wprh_menu {
    display: inline-block;
    margin: 30px 0 10px;
    width: 100%;
}
.wprh_blk {
    font: 14px/23px "Droid Sans",sans-serif;
    margin: 10px 20px;
    max-width: 800px;
}
.wprh_blk li {
    list-style-type: decimal;
}
.wprh_blk.tab_3 span {
    display: block;
    font-size: 20px;
    margin: 10px;
}
</style>';
}
add_action('admin_head', 'wprh_style');
