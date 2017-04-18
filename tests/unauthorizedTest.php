<?php


class unauthorizedTest extends TestCase
{
    /**
     * Check if unauthorized users are redirected to the login page, when requesting the home page.
     *
     * @return void
     */
    public function testHome()
    {
        $this->visit('/home')
            ->see('Password');
    }
}
