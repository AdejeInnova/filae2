<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IdcardsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IdcardsTable Test Case
 */
class IdcardsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\IdcardsTable
     */
    public $Idcards;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.idcards',
        'app.companies',
        'app.persons'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Idcards') ? [] : ['className' => 'App\Model\Table\IdcardsTable'];
        $this->Idcards = TableRegistry::get('Idcards', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Idcards);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
