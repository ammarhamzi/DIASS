                <div style=" float: right; margin-top:0px;"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
 </div>

<div style="display:none; float: right; background-color:  #AED3E5; border-radius: 5px; margin:5px; padding-right:25px;padding-top:5px;" id="gencon"><ul>
    <li><a href="<?php echo site_url('fixzyrad/index');?>">Modify Columns</a></li>
    <li><a href="<?php echo site_url('fixzyrad/index');?>">Modify Filter</a></li>
    <li><a href="<?php echo site_url('fixzyrad/index');?>">Add Form</a></li>
</ul></div>
        <script>
        $(document).ready(function() {
        $(".glyphicon-cog").click(function () {
        $("#gencon").toggle();
        });
        });
        </script>