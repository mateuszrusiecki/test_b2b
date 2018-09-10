<?php

/**
 * BudgetAgreement Test Case
 *
 */
class BudgetAgreementTest extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.budget_agreement',
        'app.client_project_budget',
        //'app.deparment',
        'app.agreement_position'
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->BudgetAgreement = ClassRegistry::init('BudgetAgreement');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BudgetAgreement);

        parent::tearDown();
    }

    public function testStart()
    {
        $this->assertEquals(true, true, 'piersze uruchomienie');
    }

}
