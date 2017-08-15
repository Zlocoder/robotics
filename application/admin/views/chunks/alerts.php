<?php if ($this->params['messages'] || $this->params['errors']) { ?>
    <div class="row">
        <div class="col-lg-12">
            <?php if ($this->params['messages']) { ?>
                <?php foreach ($this->params['messages'] as $message) { ?>
                    <div class="alert alert-success"><?= $message ?></div>
                <?php } ?>
            <?php } ?>

            <?php if ($this->params['errors']) { ?>
                <?php foreach ($this->params['errors'] as $message) { ?>
                    <div class="alert alert-danger"><?= $message ?></div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
<?php } ?>