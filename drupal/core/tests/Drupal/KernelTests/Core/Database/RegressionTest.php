<?php

namespace Drupal\KernelTests\Core\Database;

/**
 * Regression tests cases for the database layer.
 *
 * @group Database
 */
class RegressionTest extends DatabaseTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('node', 'user');
=======
  public static $modules = ['node', 'user'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Ensures that non-ASCII UTF-8 data is stored in the database properly.
   */
<<<<<<< HEAD
  function testRegression_310447() {
    // That's a 255 character UTF-8 string.
    $job = str_repeat("é", 255);
    db_insert('test')
      ->fields(array(
        'name' => $this->randomMachineName(),
        'age' => 20,
        'job' => $job,
      ))->execute();

    $from_database = db_query('SELECT job FROM {test} WHERE job = :job', array(':job' => $job))->fetchField();
=======
  public function testRegression_310447() {
    // That's a 255 character UTF-8 string.
    $job = str_repeat("é", 255);
    db_insert('test')
      ->fields([
        'name' => $this->randomMachineName(),
        'age' => 20,
        'job' => $job,
      ])->execute();

    $from_database = db_query('SELECT job FROM {test} WHERE job = :job', [':job' => $job])->fetchField();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical($job, $from_database, 'The database handles UTF-8 characters cleanly.');
  }

  /**
   * Tests the db_table_exists() function.
   */
<<<<<<< HEAD
  function testDBTableExists() {
=======
  public function testDBTableExists() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical(TRUE, db_table_exists('test'), 'Returns true for existent table.');
    $this->assertIdentical(FALSE, db_table_exists('nosuchtable'), 'Returns false for nonexistent table.');
  }

  /**
   * Tests the db_field_exists() function.
   */
<<<<<<< HEAD
  function testDBFieldExists() {
=======
  public function testDBFieldExists() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical(TRUE, db_field_exists('test', 'name'), 'Returns true for existent column.');
    $this->assertIdentical(FALSE, db_field_exists('test', 'nosuchcolumn'), 'Returns false for nonexistent column.');
  }

  /**
   * Tests the db_index_exists() function.
   */
<<<<<<< HEAD
  function testDBIndexExists() {
=======
  public function testDBIndexExists() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical(TRUE, db_index_exists('test', 'ages'), 'Returns true for existent index.');
    $this->assertIdentical(FALSE, db_index_exists('test', 'nosuchindex'), 'Returns false for nonexistent index.');
  }

}
