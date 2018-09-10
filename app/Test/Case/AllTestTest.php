<?php
/**
 * AllTests file
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Test.Case
 * @since         CakePHP(tm) v 2.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-licenseTest.php)
 */
/**
 * AllTests class
 *
 * This test group will run all tests.
 *
 */
class AllTests extends PHPUnit_Framework_TestSuite {

    /**
     * Suite define the tests for this suite
     *
     * @return void
     */
    public static function suite() {
        $suite = new PHPUnit_Framework_TestSuite('All Tests');
        
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'AgreementPositionTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'BriefTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'BriefAnswerTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'BriefDefaultQuestionTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'BriefQuestionTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'BudgetAgreementTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'CalendarTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ChecklistPositionTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ClientTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ClientContactTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ClientContactClientLeadTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ClientDomainTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ClientDomainTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ClientLeadTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ClientNoteTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ClientProjectTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ClientProjectBudgetTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ClientProjectBudgetPositionTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ClientProjectDomainTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ClientProjectLogTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ClientProjectNoteTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ClientProjectSheduleTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ClientProjectSheduleTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ClientProjectUserTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'CodeErrorTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'CountryTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'CronTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'EventTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'EventDefinedTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'EventTypeTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'GrindstoneTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'HrSettingTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'InvoiceTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'InvoicePositionTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'LeadFileTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'LeadLogTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'MessageTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'MessageTypeTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ModuleTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ModulePhotoTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'PaymentTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'PersonalAimTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'PmTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ProfileTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ProjectTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ProjectContactPeopleTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ProjectFileTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ProjectFileCategoryTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ProjectIssueTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ProjectIssueEntryTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'SectionTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'SectionTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'SheduleAgreementPositionTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'SocialBookTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'SuggestionTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'SynchronizeLogTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'TextDocumentTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'UserContractHistoryTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'UserWorkTimeTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'VacationTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'VacationReplaceTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'VacationStatusTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'VacationTypeTest.php');
        $suite->addTestFile(APP . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'WorkTimeTest.php');
        
        $suite->addTestFile(APP . 'Plugin' . DS . 'User' . DS . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'UserTest.php');
        $suite->addTestFile(APP . '..'.DS.'plugins' . DS . 'Poll' . DS . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'PollTest.php');
        //$suite->addTestFile(APP . '..'.DS.'plugins' . DS . 'NewClients' . DS . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'ProjectTest.php');
        $suite->addTestFile(APP . '..'.DS.'plugins' . DS . 'NewClients' . DS . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'VersionTest.php');
        $suite->addTestFile(APP . '..'.DS.'plugins' . DS . 'NewClients' . DS . 'Test' . DS . 'Case' . DS . 'Model' . DS . 'CommentTest.php');
        return $suite;
    }
}
