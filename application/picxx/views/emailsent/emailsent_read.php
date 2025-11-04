<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
        <li><a href="<?php echo site_url('emailsent'); ?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> emailsent <?php echo $this->lang->line('list'); ?></a></li>
        <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> emailsent
            <?php echo $this->lang->line('detail'); ?>
        </li>
    </ol>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span> emailsent
                <?php echo $this->lang->line('detail'); ?>
            </h4>
        </div>
        <div class="panel-body">
            <table class="table table-condensed table-responsive">


                <tr>
                    <th class="col-md-3">
                        <?php echo $this->lang->line('email_sent_from'); ?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $email_sent_from; ?>
                    </td>
                    </tr>


                <tr>
                    <th class="col-md-3">
                        <?php echo $this->lang->line('email_sent_to'); ?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $email_sent_to; ?>
                    </td>
                    </tr>


                <tr>
                    <th class="col-md-3">
                        <?php echo $this->lang->line('email_sent_cc'); ?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $email_sent_cc; ?>
                    </td>
                    </tr>


                <tr>
                    <th class="col-md-3">
                        <?php echo $this->lang->line('email_sent_bcc'); ?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $email_sent_bcc; ?>
                    </td>
                    </tr>


                <tr>
                    <th class="col-md-3">
                        <?php echo $this->lang->line('email_sent_subject'); ?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $email_sent_subject; ?>
                    </td>
                    </tr>


                <tr>
                    <th class="col-md-3">
                        <?php echo $this->lang->line('email_sent_message'); ?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $email_sent_message; ?>
                    </td>
                    </tr>

            </table>

            <a href="<?php echo site_url('emailsent'); ?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back'); ?></a>
        </div>
    </div>
</div>