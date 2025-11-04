<div class="btn-group" role="group" aria-label="..." style="padding-bottom:25px;padding-left:25px;">
    <?php
//printr($parentchildmenu);
//bugme($currentcontroller);
foreach ($parentchildmenu as $value) {
    if (strtolower($value->tabslave_controller) == $currentcontroller && strtolower($value->tabslave_method) == $currentmethod) {
        $btnstyle = "btn-primary";
    } else {
        $btnstyle = "btn-default";
    }
    if($value->tabslave_parent_id!=0){
    ?>

        <a class="btn <?php echo $btnstyle; ?> " href="<?php echo site_url($value->tabslave_controller . '/' . $value->tabslave_method . '/' . $parentid); ?>"><?php echo $this->lang->line($value->tabslave_langcode); ?></a>
        <?php
        }
}
?>

</div>