<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LogoutTest extends TestCase
{
    /**
     * ログアウト確認
     */
    public function testLogoutAction()
    {
        $this->visit('/login')
            ->click('English')
            ->click('English')
            ->type('admin@lindale.tk', 'email')
            ->type('123456', 'password')
            ->press('Login')
            ->seePageIs('/home')
            ->see('Logout');
    }
}
