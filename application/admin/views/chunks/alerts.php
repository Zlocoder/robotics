<?php if ($this->params['errors']) { ?>
    <div class="row">
        <div class="col-md-12">
            <?php foreach ($this->params['errors'] as $message) { ?>
                <div class="alert alert-danger">
                    <p><?= $message ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>

<?php if ($this->params['messages']) { ?>
    <div class="row">
        <div class="col-md-12">
            <?php foreach ($this->params['messages'] as $message) { ?>
                <div class="alert alert-success">
                    <p><?= $message ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>
