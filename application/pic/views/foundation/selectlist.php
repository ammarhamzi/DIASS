<?php
$columns = "";
foreach ($columnlist as $column) {
    $columns .= "<option value='" . $column->Field . "'>" . $column->Field . "</option>";
}
echo "<select class='form-control' name='" . $selectname . "' id='" . $selectname . "'><!--<option value=''>--SELECT--</option>-->" . $columns . "</select>";