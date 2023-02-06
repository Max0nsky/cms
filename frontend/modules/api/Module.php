<?php

namespace frontend\modules\api;

use common\models\User;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\web\Response;
use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\api\controllers';

    public function init()
    {
        parent::init();
        Yii::$app->user->enableSession = false;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::class,
            'auth' => function ($username, $password) {
                $user = User::find()->where(['username' => $username])->one();
                if ($user && $user->validatePassword($password)) {
                    return $user;
                }
                return null;
            },
        ];

        $behaviors['access'] = [
			'class' => AccessControl::class,
			'rules' => [
				[
					'allow' => true,
					'roles' => ['@'],
				],
			],
		];

        return $behaviors;
    }

}
