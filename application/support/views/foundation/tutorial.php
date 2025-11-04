<style type="text/css">
.title {
    text-align: center;
    border-bottom:  dotted 1px black;
}

.title0 {
    color: #990000;
    border-top: 2px dashed black;
    padding: 15px;
}

.title1 {
    font-weight: bold;
    color: #000066;
    margin: 15px;
}

img {
    border: red 1px double;
}

</style>
<div class="container-fluid">
    <h2 class="title">Tutorial - Fixzy Generator</h2>
<h3 class="title0" id="logictype">Logic Type:</h3>
<div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Master CRUD</a></li>
        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Slave CRUD (Embed to Master Detail)</a></li>
        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Slave CRUD (Tab with Master Detail)</a></li>
        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Master-Slave CRUD (Single Page)</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
<p class="title1">GridView Page</p>
<img src="<?php echo base_url(); ?>resources/shared_img/tutorial/Master CRUD/gridview.png" style="width: 90%" alt="">
<p class="title1">Update Page</p>
<img src="<?php echo base_url(); ?>resources/shared_img/tutorial/Master CRUD/edit.png" style="width: 90%" alt="">
<p class="title1">Detail Page</p>
<img src="<?php echo base_url(); ?>resources/shared_img/tutorial/Master CRUD/detail.png" style="width: 90%" alt="">
        </div>
        <div role="tabpanel" class="tab-pane" id="profile">
<p class="title1">GridView Page</p>
<img src="<?php echo base_url(); ?>resources/shared_img/tutorial/Slave CRUD (Embed to Master Detail)/gridview.png" style="width: 90%" alt="">
<p class="title1">Update Page</p>
<img src="<?php echo base_url(); ?>resources/shared_img/tutorial/Slave CRUD (Embed to Master Detail)/edit.png" style="width: 90%" alt="">
<p class="title1">Detail Page</p>
<img src="<?php echo base_url(); ?>resources/shared_img/tutorial/Slave CRUD (Embed to Master Detail)/detail.png" style="width: 90%" alt="">
        </div>
        <div role="tabpanel" class="tab-pane" id="messages">
<p class="title1">GridView Page</p>
<img src="<?php echo base_url(); ?>resources/shared_img/tutorial/Slave CRUD (Tab with Master Detail)/gridview.png" style="width: 90%" alt="">
<p class="title1">Update Page</p>
<img src="<?php echo base_url(); ?>resources/shared_img/tutorial/Slave CRUD (Tab with Master Detail)/edit.png" style="width: 90%" alt="">
<p class="title1">Detail Page</p>
<img src="<?php echo base_url(); ?>resources/shared_img/tutorial/Slave CRUD (Tab with Master Detail)/detail.png" style="width: 90%" alt="">
        </div>
        <div role="tabpanel" class="tab-pane" id="settings">
<p class="title1">GridView Page</p>
<img src="<?php echo base_url(); ?>resources/shared_img/tutorial/Slave-Master CRUD (Single Page)/gridview.png" style="width: 90%" alt="">
<p class="title1">Update Page</p>
<img src="<?php echo base_url(); ?>resources/shared_img/tutorial/Slave-Master CRUD (Single Page)/edit.png" style="width: 90%" alt="">
<p class="title1">Detail Page</p>
<img src="<?php echo base_url(); ?>resources/shared_img/tutorial/Slave-Master CRUD (Single Page)/detail.png" style="width: 90%" alt="">
        </div>
    </div>

</div>

<h3 class="title0" id="pagetype">Add/Update Type:</h3>
<div>
<p class="title1">Single Page With Form On Top - Suitable for small form</p>
<ul>
    <li>Gridview & create/update page in single page. Example:</li>
</ul>

<img src="<?php echo base_url(); ?>resources/shared_img/tutorial/singletop/gridview.png" style="width: 90%" alt="">

<p class="title1">Multiple Page - Modal Form</p>
<ul>
    <li>create/update/detail pages will popup at gridview page. Example:</li>
</ul>

<img src="<?php echo base_url(); ?>resources/shared_img/tutorial/modal/gridview.png" style="width: 90%" alt="">
</div>
</div>
<script src="<?php echo base_url('../resources/themes/AdminLTE/bootstrap/js/bootstrap.min.js'); ?>"  crossorigin="anonymous"></script>
