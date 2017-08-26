<?php

namespace admin\classes;

use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use yii\imagine\Image;
use yii\web\UploadedFile;

class UploadContentImage extends \yii\base\Action {
    public $uploadPath = '@webroot/temp';
    public $uploadUrl = '@web/temp';

    public $sizes = [];

    public $uploadedCallback = null;

    public $imageValidator = [
        'maxSize' => '2048'
    ];

    public function init() {
        $this->controller->enableCsrfValidation = false;
    }

    public function run() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (\Yii::$app->request->isPost) {
            $model = \yii\base\DynamicModel::validateData(
                ['image' => UploadedFile::getInstanceByName('file')],
                [['image', 'image','maxSize' => 2147483648]]
            );
            if (!$model->hasErrors()) {
                $file = \Yii::$app->security->generateRandomString();
                $path = \Yii::getAlias("{$this->uploadPath}/{$file}");
                $model->image->saveAs($path);

                $image = Image::getImagine()->open($path);
                $image->save("{$path}.jpg");

                foreach ($this->sizes as $size) {
                    $image->thumbnail(new Box($size[0], $size[1]), ImageInterface::THUMBNAIL_OUTBOUND)->save("{$path}_{$size[0]}_{$size[1]}.jpg");
                }

                unlink($path);

                if ($this->uploadedCallback) {
                    if (is_string($this->uploadedCallback)) {
                        call_user_func([$this->controller, $this->uploadedCallback], $file);
                    } else {
                        call_user_func($this->uploadedCallback, $file);
                    }
                }

                return ['location' => \Yii::getAlias("{$this->uploadUrl}/{$file}.jpg")];
            } else {
                return ['error' => 'upload error'];
            }
        }

        return null;
    }
}