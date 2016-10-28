<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LogoutTest extends TestCase
{
    /**
     * ログアウト機能確認
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

        $response = $this->call('POST', '/logout');
        $this->assertEquals(302, $response->status());

        $this->seePageIs('/')
            ->see('Lindalë')
            ->see('The Project Manager For Everyone')
            ->see('DOCUMENTATION')
            ->see('BLOG')
            ->see('NEWS')
            ->see('ABOUT')
            ->see('GITHUB')
            ->see('LOGIN');
    }
}