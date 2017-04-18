<?php

namespace Drupal\KernelTests\Core\Database;

/**
 * Tests handling case sensitive collation.
 *
 * @group Database
 */
class CaseSensitivityTest extends DatabaseTestBase {
  /**
   * Tests BINARY collation in MySQL.
   */
<<<<<<< HEAD
  function testCaseSensitiveInsert() {
    $num_records_before = db_query('SELECT COUNT(*) FROM {test}')->fetchField();

    db_insert('test')
      ->fields(array(
        'name' => 'john', // <- A record already exists with name 'John'.
        'age' => 2,
        'job' => 'Baby',
      ))
=======
  public function testCaseSensitiveInsert() {
    $num_records_before = db_query('SELECT COUNT(*) FROM {test}')->fetchField();

    db_insert('test')
      ->fields([
        'name' => 'john', // <- A record already exists with name 'John'.
        'age' => 2,
        'job' => 'Baby',
      ])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->execute();

    $num_records_after = db_query('SELECT COUNT(*) FROM {test}')->fetchField();
    $this->assertIdentical($num_records_before + 1, (int) $num_records_after, 'Record inserts correctly.');
<<<<<<< HEAD
    $saved_age = db_query('SELECT age FROM {test} WHERE name = :name', array(':name' => 'john'))->fetchField();
=======
    $saved_age = db_query('SELECT age FROM {test} WHERE name = :name', [':name' => 'john'])->fetchField();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical($saved_age, '2', 'Can retrieve after inserting.');
  }

}
