<?php

declare(strict_types=1);

namespace Mileena\CrmSkeleton\Controller;

use Mileena\CrmSkeleton\Model\Users\User;
use Mileena\CrmSkeleton\Model\Users\UserService;
use Mileena\CrmSkeleton\View\View;
use Mileena\Web\AllowPublicAccess;
use Mileena\Web\Auth;
use Mileena\Web\Params;
use Mileena\Web\Response;

class ManagerController
{
    #[AllowPublicAccess]
    public function login(): void
    {
        $p = Params::getParams();
        $v = View::getView();


        // если пароли подходят
        if ($p->has('login') && $p->has('password')) {
            $authUser = UserService::authenticate(
                $p->getStrval('login'),
                $p->getStrval('password')
            );


            if (Auth::login($authUser)) {
                // перенаправляемся на главную
                Response::redirect('/');
                return;
            } else {
                $v->assign("error", "Неправильный логин или пароль");
            }
        }


        $v->display('/manager/login.phtml');
    }

    public function logout(): void
    {
        Auth::logout();
        Response::redirect('/manager/login');
    }

    public function index(): void
    {
        View::getView()
            ->assign("list", UserService::getList())
            ->display("/manager/index.phtml");
    }

    public function add(): void
    {
        View::getView()->display("/manager/form.phtml");
    }

    public function edit(): void
    {
        $userId = Params::getParams()->getIntval('id');

        View::getView()->assign("user", UserService::getById($userId))
            ->display("/manager/form.phtml");
    }

    public function save(): void
    {
        $p = Params::getParams();
        $user = UserService::getById($p->getIntval('id'));

        if (!$user) {
            $user = new User();
            $user->username = $p->getString('username');
            $user->createdAt = new \DateTime('now');
        }


        $user->fio = $p->getStrval('fio');
        $user->status = $p->getIntval('status');

        if ($p->has('password') && $p->getStrval('password') == $p->getStrval('password_confirm')) {
            $user->password = UserService::getHashPassword($p->getStrval('password'));
        }


        UserService::save($user, $p->getIntval('id'));


        Response::redirect('/manager');
    }

    public function delete(): void
    {
        UserService::delete(Params::getParams()->getIntval('id'));
        Response::redirect('/manager');
    }
}
