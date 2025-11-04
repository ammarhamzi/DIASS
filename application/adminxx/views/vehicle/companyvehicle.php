<?php
/*foreach ($data as $vehicle){
   ?>
    <option value="<?php echo $vehicle->vehicle_id;?>">
        <?php echo $vehicle->vehiclegroup_name;?>- manfcrg: <?php echo $vehicle->vehicle_year_manufacture;?> (<?php echo $vehicle->vehicle_registration_no;?>)
    </option>
    <?php
}*/
foreach ($data as $vehicle){
   ?>
    <option value="<?php echo $vehicle->vehicle_id;?>">
        <?php echo $vehicle->vehiclegroup_name;?> - (<?php echo $vehicle->vehicle_registration_no;?>)
    </option>
    <?php
}
?>