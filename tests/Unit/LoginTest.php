<?php

namespace Tests\Unit;

use Tests\Support\UnitTester;

class LoginTest extends \Codeception\Test\Unit {

    /**
     * 
     * @var UnitTester
     */
    protected UnitTester $tester;
    private \User $user;

    protected function _before() {
        $this->user = new \User();
    }

    public function testFullName() {
        $this->user->setFirstName('Jan');
        $this->user->setLastName('Novak');
        $this->assertEquals('Jan Novak', $this->user->getFullName());
    }

}
