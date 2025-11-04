<?php
foreach ($data as $driver){
   ?>
    <option value="<?php echo $driver->driver_id;?>">
        <?php echo $driver->driver_name. ' (<i>' . $driver->driver_ic . '</i>)';?>
    </option>
    <?php
}
?>