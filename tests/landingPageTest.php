<?php


class landingPageTest extends TestCase
{
    /**
     * Check if the landing page is loaded and displayed correctly.
     *
     * @return void
     */
    public function testLoadLandingPage()
    {
        $this->visit('/')
            ->see('<div class="title">Risk and Control</div>');
    }
}
