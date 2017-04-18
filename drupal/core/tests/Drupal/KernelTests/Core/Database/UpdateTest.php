<?php

namespace Drupal\KernelTests\Core\Database;

/**
 * Tests the update query builder.
 *
 * @group Database
 */
class UpdateTest extends DatabaseTestBase {

  /**
   * Confirms that we can update a single record successfully.
   */
<<<<<<< HEAD
  function testSimpleUpdate() {
    $num_updated = db_update('test')
      ->fields(array('name' => 'Tiffany'))
=======
  public function testSimpleUpdate() {
    $num_updated = db_update('test')
      ->fields(['name' => 'Tiffany'])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('id', 1)
      ->execute();
    $this->assertIdentical($num_updated, 1, 'Updated 1 record.');

<<<<<<< HEAD
    $saved_name = db_query('SELECT name FROM {test} WHERE id = :id', array(':id' => 1))->fetchField();
=======
    $saved_name = db_query('SELECT name FROM {test} WHERE id = :id', [':id' => 1])->fetchField();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical($saved_name, 'Tiffany', 'Updated name successfully.');
  }

  /**
   * Confirms updating to NULL.
   */
<<<<<<< HEAD
  function testSimpleNullUpdate() {
    $this->ensureSampleDataNull();
    $num_updated = db_update('test_null')
      ->fields(array('age' => NULL))
=======
  public function testSimpleNullUpdate() {
    $this->ensureSampleDataNull();
    $num_updated = db_update('test_null')
      ->fields(['age' => NULL])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('name', 'Kermit')
      ->execute();
    $this->assertIdentical($num_updated, 1, 'Updated 1 record.');

<<<<<<< HEAD
    $saved_age = db_query('SELECT age FROM {test_null} WHERE name = :name', array(':name' => 'Kermit'))->fetchField();
=======
    $saved_age = db_query('SELECT age FROM {test_null} WHERE name = :name', [':name' => 'Kermit'])->fetchField();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertNull($saved_age, 'Updated name successfully.');
  }

  /**
   * Confirms that we can update multiple records successfully.
   */
<<<<<<< HEAD
  function testMultiUpdate() {
    $num_updated = db_update('test')
      ->fields(array('job' => 'Musician'))
=======
  public function testMultiUpdate() {
    $num_updated = db_update('test')
      ->fields(['job' => 'Musician'])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('job', 'Singer')
      ->execute();
    $this->assertIdentical($num_updated, 2, 'Updated 2 records.');

<<<<<<< HEAD
    $num_matches = db_query('SELECT COUNT(*) FROM {test} WHERE job = :job', array(':job' => 'Musician'))->fetchField();
=======
    $num_matches = db_query('SELECT COUNT(*) FROM {test} WHERE job = :job', [':job' => 'Musician'])->fetchField();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical($num_matches, '2', 'Updated fields successfully.');
  }

  /**
   * Confirms that we can update multiple records with a non-equality condition.
   */
<<<<<<< HEAD
  function testMultiGTUpdate() {
    $num_updated = db_update('test')
      ->fields(array('job' => 'Musician'))
=======
  public function testMultiGTUpdate() {
    $num_updated = db_update('test')
      ->fields(['job' => 'Musician'])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('age', 26, '>')
      ->execute();
    $this->assertIdentical($num_updated, 2, 'Updated 2 records.');

<<<<<<< HEAD
    $num_matches = db_query('SELECT COUNT(*) FROM {test} WHERE job = :job', array(':job' => 'Musician'))->fetchField();
=======
    $num_matches = db_query('SELECT COUNT(*) FROM {test} WHERE job = :job', [':job' => 'Musician'])->fetchField();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical($num_matches, '2', 'Updated fields successfully.');
  }

  /**
   * Confirms that we can update multiple records with a where call.
   */
<<<<<<< HEAD
  function testWhereUpdate() {
    $num_updated = db_update('test')
      ->fields(array('job' => 'Musician'))
      ->where('age > :age', array(':age' => 26))
      ->execute();
    $this->assertIdentical($num_updated, 2, 'Updated 2 records.');

    $num_matches = db_query('SELECT COUNT(*) FROM {test} WHERE job = :job', array(':job' => 'Musician'))->fetchField();
=======
  public function testWhereUpdate() {
    $num_updated = db_update('test')
      ->fields(['job' => 'Musician'])
      ->where('age > :age', [':age' => 26])
      ->execute();
    $this->assertIdentical($num_updated, 2, 'Updated 2 records.');

    $num_matches = db_query('SELECT COUNT(*) FROM {test} WHERE job = :job', [':job' => 'Musician'])->fetchField();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical($num_matches, '2', 'Updated fields successfully.');
  }

  /**
   * Confirms that we can stack condition and where calls.
   */
<<<<<<< HEAD
  function testWhereAndConditionUpdate() {
    $update = db_update('test')
      ->fields(array('job' => 'Musician'))
      ->where('age > :age', array(':age' => 26))
=======
  public function testWhereAndConditionUpdate() {
    $update = db_update('test')
      ->fields(['job' => 'Musician'])
      ->where('age > :age', [':age' => 26])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('name', 'Ringo');
    $num_updated = $update->execute();
    $this->assertIdentical($num_updated, 1, 'Updated 1 record.');

<<<<<<< HEAD
    $num_matches = db_query('SELECT COUNT(*) FROM {test} WHERE job = :job', array(':job' => 'Musician'))->fetchField();
=======
    $num_matches = db_query('SELECT COUNT(*) FROM {test} WHERE job = :job', [':job' => 'Musician'])->fetchField();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical($num_matches, '1', 'Updated fields successfully.');
  }

  /**
   * Tests updating with expressions.
   */
<<<<<<< HEAD
  function testExpressionUpdate() {
=======
  public function testExpressionUpdate() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Ensure that expressions are handled properly. This should set every
    // record's age to a square of itself.
    $num_rows = db_update('test')
      ->expression('age', 'age * age')
      ->execute();
    $this->assertIdentical($num_rows, 4, 'Updated 4 records.');

<<<<<<< HEAD
    $saved_name = db_query('SELECT name FROM {test} WHERE age = :age', array(':age' => pow(26, 2)))->fetchField();
=======
    $saved_name = db_query('SELECT name FROM {test} WHERE age = :age', [':age' => pow(26, 2)])->fetchField();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical($saved_name, 'Paul', 'Successfully updated values using an algebraic expression.');
  }

  /**
   * Tests return value on update.
   */
<<<<<<< HEAD
  function testUpdateAffectedRows() {
=======
  public function testUpdateAffectedRows() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // At 5am in the morning, all band members but those with a priority 1 task
    // are sleeping. So we set their tasks to 'sleep'. 5 records match the
    // condition and therefore are affected by the query, even though two of
    // them actually don't have to be changed because their value was already
    // 'sleep'. Still, execute() should return 5 affected rows, not only 3,
    // because that's cross-db expected behavior.
    $num_rows = db_update('test_task')
      ->condition('priority', 1, '<>')
<<<<<<< HEAD
      ->fields(array('task' => 'sleep'))
=======
      ->fields(['task' => 'sleep'])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->execute();
    $this->assertIdentical($num_rows, 5, 'Correctly returned 5 affected rows.');
  }

  /**
   * Confirm that we can update the primary key of a record successfully.
   */
<<<<<<< HEAD
  function testPrimaryKeyUpdate() {
    $num_updated = db_update('test')
      ->fields(array('id' => 42, 'name' => 'John'))
=======
  public function testPrimaryKeyUpdate() {
    $num_updated = db_update('test')
      ->fields(['id' => 42, 'name' => 'John'])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('id', 1)
      ->execute();
    $this->assertIdentical($num_updated, 1, 'Updated 1 record.');

<<<<<<< HEAD
    $saved_name = db_query('SELECT name FROM {test} WHERE id = :id', array(':id' => 42))->fetchField();
=======
    $saved_name = db_query('SELECT name FROM {test} WHERE id = :id', [':id' => 42])->fetchField();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical($saved_name, 'John', 'Updated primary key successfully.');
  }

  /**
   * Confirm that we can update values in a column with special name.
   */
<<<<<<< HEAD
  function testSpecialColumnUpdate() {
    $num_updated = db_update('test_special_columns')
      ->fields(array('offset' => 'New offset value'))
=======
  public function testSpecialColumnUpdate() {
    $num_updated = db_update('test_special_columns')
      ->fields(['offset' => 'New offset value'])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('id', 1)
      ->execute();
    $this->assertIdentical($num_updated, 1, 'Updated 1 special column record.');

<<<<<<< HEAD
    $saved_value = db_query('SELECT "offset" FROM {test_special_columns} WHERE id = :id', array(':id' => 1))->fetchField();
=======
    $saved_value = db_query('SELECT "offset" FROM {test_special_columns} WHERE id = :id', [':id' => 1])->fetchField();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical($saved_value, 'New offset value', 'Updated special column name value successfully.');
  }

}
