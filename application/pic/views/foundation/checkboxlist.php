<?php
$columns           = "";
$headerval         = "";
$datetype          = "";
$headerhead        = "";
$tablelistdropdown = "";
$uploadoption      = "";
foreach ($tablelist as $table) {
    $tablelistdropdown .= '<option value="' . $table . '">' . $table . '</option>';
}

foreach ($columnlist as $column) {
    if ($column->Key !== "PRI" && $column->Field !== $exclude) {
        if ($column->Null === "NO") {
            $requiredstatus = "<input id='" . $column->Field . "_req' name='" . $checkboxname . "_req[]' type='checkbox' checked='checked' value='" . $column->Field . "'> Compulsory Field";
        } else {
            $requiredstatus = "<input id='" . $column->Field . "_req' name='" . $checkboxname . "_req[]' type='checkbox' value='" . $column->Field . "'> Compulsory Field";
        }

        $individufilter = "<span class='formhide'><br><select id='" . $column->Field . "_indfilter' name='" . $checkboxname . "_indfilter[]'><option value='0'>No</option><option value='1'>Textbox</option><option value='2'>Dropdown</option></select> Individual Filter</span>"; // "<input id='" .$column->Field. "_req' name='" .$checkboxname. "_req[]' type='checkbox' value='" .$column->Field. "'> Compulsory Field";
        $readonlyupdate = "<br><select id='" . $column->Field . "_readonlyupdate' name='" . $checkboxname . "_readonlyupdate[" . $column->Field . "]'><option value='0'>No</option><option value='1'>Yes</option></select> Readonly Update";

        if ($headeroption === "1") {
            $headerval = "<span class='formhide'><br><input id='" . $column->Field . "_head' name='" . $checkboxname . "_head[]' type='checkbox' checked='checked' value='" . $column->Field . "'> Datagrid view</span>";
//$headerhead = "<td><b>HEADER</b></td>";
        }
        $headerval .= "<input type='hidden' name='schematype[" . $column->Field . "]'  id='" . $column->Field . "_type' value='" . $column->Type . "'/>";

        if ($column->Type == "date") {
            $datetype = "
Format: <select class=\"form-control\" name=\"" . $column->Field . "_datetype\" id=\"" . $column->Field . "_datetype\">
<option value=\"0\">International Standard (Y-m-d) e.g. " . date("Y-m-d") . "</option>
<option value=\"1\">localization (d/m/Y) e.g. " . date("d/m/Y") . "</option>
</select>";
        } elseif ($column->Type == "datetime") {
            $datetype = "
Format: <select class=\"form-control\" name=\"" . $column->Field . "_datetype\" id=\"" . $column->Field . "_datetype\">
<option value=\"0\">International Standard (Y-m-d h:i:s) e.g. " . date("Y-m-d h:i:s") . "</option>
<option value=\"1\">localization (d/m/Y h:i:s) e.g. " . date("d/m/Y h:i:s") . "</option>
</select>";
        } elseif ($column->Type == "timestamp") {
            $datetype = "
Format: <select class=\"form-control\" name=\"" . $column->Field . "_datetype\" id=\"" . $column->Field . "_datetype\">
<option value=\"0\">International Standard (Y-m-d h:i:s) e.g. " . date("Y-m-d h:i:s") . "</option>
<option value=\"1\">localization (d/m/Y h:i:s) e.g. " . date("d/m/Y h:i:s") . "</option>
</select>";
        } else {
            $datetype = "";
        }

        if (strpos($column->Type, '(') !== false) {
            $columntype = explode("(", $column->Type);

            if ($columntype[0] === "varchar") {
                $uploadoption           = "<option value='6'>Upload</option>";
                $multidropdown_hardcode = "<option value='7'>Multiple Dropdown-hardcode</option>";
                $multidropdown_database = "<option value='8'>Multiple Dropdown-Database</option>";
                $checkbox_hardcode      = "<option value='9'>Checkbox-hardcode</option>";
                $checkbox_database      = "<option value='10'>Checkbox-Database</option>";
            } else {
                $uploadoption           = "";
                $multidropdown_hardcode = "";
                $multidropdown_database = "";
                $checkbox_hardcode      = "";
                $checkbox_database      = "";
            }
        } else {
            if ($column->Type === "text") {
                $uploadoption           = "<option value='6'>Upload</option>";
                $multidropdown_hardcode = "<option value='7'>Multiple Dropdown-hardcode</option>";
                $multidropdown_database = "<option value='8'>Multiple Dropdown-Database</option>";
                $checkbox_hardcode      = "<option value='9'>Checkbox-hardcode</option>";
                $checkbox_database      = "<option value='10'>Checkbox-Database</option>";
            } else {
                $uploadoption           = "";
                $multidropdown_hardcode = "";
                $multidropdown_database = "";
                $checkbox_hardcode      = "";
                $checkbox_database      = "";
            }
        }

        $columns .= "<tr><td><input id='" . $column->Field . "' name='" . $checkboxname . "[]' type='checkbox' checked='checked' value='" . $column->Field . "'></td><td>" . $column->Field . "</td><td>Type:" . $column->Type . "<br>Null:" . $column->Null . "<br>Key:" . $column->Key . "<br>Default:" . $column->Default . "<br>Extra:" . $column->Extra . "<br>Comment:" . $column->Comment . "</td><td>" . $requiredstatus . $headerval . $individufilter . $readonlyupdate . "<div class='panel panel-default'>
  <div class='panel-body'>
  " . $datetype . "
Input Type:<select name='dropdown[" . $column->Field . "]' id='" . $column->Field . "_dropdown' class='form-control dropdownoption'><option value='0'>Same as Field Type</option><option value='1'>Dropdown-hardcode</option><option value='2'>Dropdown-Database</option>" . $multidropdown_hardcode . $multidropdown_database . "<option value='4'>Radiobutton-hardcode</option><option value='5'>Radiobutton-Database</option>" . $checkbox_hardcode . $checkbox_database . "<option value='3'>Hidden</option>" . $uploadoption . "</select><div id='" . $column->Field . "_dropdown_multihardcode' style='display:none'>
Value/Label:<input type='text' name='" . $checkboxname . "_multihardcodevalue[" . $column->Field . "]' id='" . $column->Field . "_multihardcodevalue' class='form-control' placeholder='example:male,female'/>
</div><div id='" . $column->Field . "_dropdown_multidatabase' style='display:none'>Table:<select class='form-control multidropdown-tablelist' name='" . $checkboxname . "_multidatabasetable[" . $column->Field . "]' id='" . $column->Field . "_multidatabasetable'><option value=''>--SELECT--</option>$tablelistdropdown</select><div id='" . $column->Field . "_multidatabasetable_databasefk-create'></div>
  </div><div id='" . $column->Field . "_dropdown_hardcode' style='display:none'>Value:<input type='text' name='" . $checkboxname . "_hardcodevalue[" . $column->Field . "]' id='" . $column->Field . "_hardcodevalue' class='form-control' placeholder='example:1,2'/>Label:<input type='text' name='" . $checkboxname . "_hardcodelabel[" . $column->Field . "]' id='" . $column->Field . "_hardcodelabel' class='form-control' placeholder='example:Male,Female'/></div><div id='" . $column->Field . "_dropdown_database' style='display:none'>Table:<select class='form-control dropdown-tablelist' name='" . $checkboxname . "_databasetable[" . $column->Field . "]' id='" . $column->Field . "_databasetable'><option value=''>--SELECT--</option>$tablelistdropdown</select><div id='" . $column->Field . "_databasetable_databaseprimary-create'></div><div id='" . $column->Field . "_databasetable_databasefk-create'></div>
  </div><div id='" . $column->Field . "_dropdown_hidden' style='display:none'>PHP code(session)/Variable(&#36;var)/Aphanumerical:<input type='text' name='" . $checkboxname . "_hiddenvalue[" . $column->Field . "]' id='" . $column->Field . "_hiddenvalue' class='form-control' placeholder='example:&#36;this->session->userdata(&#39;name&#39;);'/></div>
<div id='" . $column->Field . "_dropdown_uploadtype' style='display:none'>File Type:
<select name='" . $checkboxname . "_uploadtype[" . $column->Field . "]' id='" . $checkboxname . "_uploadtype[" . $column->Field . "]' class='form-control'>
<option value='image'>Image</option>
<option value='docs'>Document</option>
<option value='imagedocs'>Image & Document</option>
<option value='video'>Video</option>
</select>
</div></div></td></tr>";
    }
}
echo "<table class='table table-bordered'><tr><td>#</td><td>Field</td><td>Other Information</td><td>Optional</td></tr>" . $columns . "</table>";
