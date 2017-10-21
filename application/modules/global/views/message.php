<!-- pesan Session Error -->
<?php $message_error = $this->session->flashdata('message_error'); ?>
<?php if (! empty($message_error)) : ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $message_error; ?>
    </div>
<?php endif ?>
<!-- pesan end -->

<!-- pesan Session Success -->
<?php $message_success = $this->session->flashdata('message_success'); ?>
<?php if (! empty($message_success)) : ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $message_success; ?>
    </div>
<?php endif ?>
<!-- pesan end -->

<!-- pesan Session Success -->
<?php $message_warning = $this->session->flashdata('message_warning'); ?>
<?php if (! empty($message_warning)) : ?>
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $message_warning; ?>
    </div>
<?php endif ?>
<!-- pesan end -->



<!-- *************************************************************** */ -->
<!-- pesan Error -->
<?php if (!empty($pesan_error)) : ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $pesan_error; ?>
    </div>
<?php endif ?>
<!-- pesan end -->

<!-- pesan Error -->
<?php if (!empty($pesan_success)) : ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $pesan_success; ?>
    </div>
<?php endif ?>
<!-- pesan end -->

<!-- pesan Warning -->
<?php if (!empty($pesan_warning)) : ?>
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $pesan_warning; ?>
    </div>
<?php endif ?>
<!-- pesan end -->

<!-- pesan Warning -->
<?php if (!empty($pesan_info)) : ?>
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $pesan_info; ?>
    </div>
<?php endif ?>
<!-- pesan end -->

