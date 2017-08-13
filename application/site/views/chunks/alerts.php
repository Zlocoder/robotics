<?php if ($this->params['errors']) { ?>
    <?php foreach ($this->params['errors'] as $message) { ?>
        <p><?= $message ?></p>
    <?php } ?>
<?php } ?>

<?php if ($this->params['messages']) { ?>
    <?php foreach ($this->params['messages'] as $message) { ?>
        <p><?= $message ?></p>
    <?php } ?>
<?php } ?>
