<?php

/**
 * SheduleAgreementPosition Test Case
 *
 */
class SheduleAgreementPositionTest extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.shedule_agreement_position',
        //'app.project_shedule_agreement'
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->SheduleAgreementPosition = ClassRegistry::init('SheduleAgreementPosition');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SheduleAgreementPosition);

        parent::tearDown();
    }

    public function testStart()
    {
        $this->assertEquals(true, true, 'piersze uruchomienie');
    }

}
