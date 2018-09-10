<?php

/**
 * AgreementPosition Test Case
 *
 */
class AgreementPositionTest extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.agreement_position',
        'app.budget_agreement',
        'app.client_project_budget',
        //'app.deparment',
        //'app.shedule',
        'app.shedule_agreement_position'
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->AgreementPosition = ClassRegistry::init('AgreementPosition');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AgreementPosition);

        parent::tearDown();
    }

    public function testStart()
    {
        $this->assertEquals(true, true, 'piersze uruchomienie');
    }

}
