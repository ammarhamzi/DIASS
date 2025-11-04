<section class="content-header">
    <h1>
        Error
        <small>Error information</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center">

                <?php echo $this->session->userdata('message') <> '' ? '<h1>'.$this->session->userdata('message').'<h1>' : ''; ?>

        </div>
    </div>
<a href="/" class="btn btn-primary">Go to dashboard</a>
</div>
