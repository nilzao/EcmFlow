<pre>
<?php
$menu_array = knl_viewlz_GetMenu::getInstance()->getMenu();
foreach($menu_array as $v):?>
<a href="<?php echo 'index.php?domain='.$v->get_domain().'&action='.$v->get_action();?>"><?php echo $v->get_titulo();?></a>
<?php endforeach;?>
</pre>