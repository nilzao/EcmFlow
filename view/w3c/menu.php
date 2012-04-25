<a onclick="toggleMainMenu();">Menu</a>
<div id="main_menu">
<ul class="main_menu_ul">
<?php
$menu_array = knl_viewlz_GetMenu::getInstance()->getMenu();
foreach($menu_array as $v):?>
<li>
<a href="<?php echo 'index.php?domain='.$v->get_domain().'&action='.$v->get_action();?>"><?php echo $v->get_titulo();?></a>
</li>
<?php endforeach;?>
</ul>
</div>