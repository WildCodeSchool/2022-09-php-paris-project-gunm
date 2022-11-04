<?php

namespace App\Controller;

class UserController extends AbstractController
{
    public function login():string
    {
        return $this->twig->render('User/login.html.twig');
    } 
}