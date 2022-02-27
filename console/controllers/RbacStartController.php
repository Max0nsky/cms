<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacStartController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // // Добавление роли "user"
        // $user = $auth->createRole('user');
        // $user->description = 'Пользователь';
        // $auth->add($user);

        // // Добавление роли "user"
        // $manager = $auth->createRole('manager');
        // $manager->description = 'Менеджер';
        // $auth->add($manager);

        // // Добавление роли "admin"
        // $admin = $auth->createRole('admin');
        // $admin->description = 'Администратор';
        // $auth->add($admin);

        // $permit = $auth->createPermission('canAdmin');
        // $permit->description = 'Администрирование';
        // $auth->add($permit);

        // $user = $auth->getRole('user');
        // $manager = $auth->getRole('manager');
        // $admin = $auth->getRole('admin');
        // $permit = $auth->getPermission('canAdmin');  

        // $auth->addChild($admin, $permit);
        // $auth->addChild($manager, $permit);

    }
}
