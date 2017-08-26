<div class="modal" style="display: block;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title text-center">Авторизация</div>
            </div>

            <?php $form = \yii\bootstrap\ActiveForm::begin([]) ?>
                <div class="modal-body">

                    <?= $form->field($model, 'login')->label('Логин') ?>

                    <?= $form->field($model, 'password')->label('Пароль') ?>
                </div>

                <div class="modal-footer text-center">
                    <button type="submit" class="btn btn-primary">Войти</button>
                </div>
            <?php $form->end() ?>
        </div>
    </div>

    <?= $this->chunk('alerts') ?>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
        </div>
    </div>
</div>

