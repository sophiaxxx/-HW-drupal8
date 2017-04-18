<?php

namespace Drupal\KernelTests\Core\Database;

use Drupal\Core\Database\Query\Merge;
use Drupal\Core\Database\Query\InvalidMergeQueryException;

/**
 * Tests the MERGE query builder.
 *
 * @group Database
 */
class MergeTest extends DatabaseTestBase {

  /**
   * Confirms that we can merge-insert a record successfully.
   */
<<<<<<< HEAD
  function testMergeInsert() {
=======
  public function testMergeInsert() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $num_records_before = db_query('SELECT COUNT(*) FROM {test_people}')->fetchField();

    $result = db_merge('test_people')
      ->key('job', 'Presenter')
<<<<<<< HEAD
      ->fields(array(
        'age' => 31,
        'name' => 'Tiffany',
      ))
=======
      ->fields([
        'age' => 31,
        'name' => 'Tiffany',
      ])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->execute();

    $this->assertEqual($result, Merge::STATUS_INSERT, 'Insert status returned.');

    $num_records_after = db_query('SELECT COUNT(*) FROM {test_people}')->fetchField();
    $this->assertEqual($num_records_before + 1, $num_records_after, 'Merge inserted properly.');

<<<<<<< HEAD
    $person = db_query('SELECT * FROM {test_people} WHERE job = :job', array(':job' => 'Presenter'))->fetch();
=======
    $person = db_query('SELECT * FROM {test_people} WHERE job = :job', [':job' => 'Presenter'])->fetch();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($person->name, 'Tiffany', 'Name set correctly.');
    $this->assertEqual($person->age, 31, 'Age set correctly.');
    $this->assertEqual($person->job, 'Presenter', 'Job set correctly.');
  }

  /**
   * Confirms that we can merge-update a record successfully.
   */
<<<<<<< HEAD
  function testMergeUpdate() {
=======
  public function testMergeUpdate() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $num_records_before = db_query('SELECT COUNT(*) FROM {test_people}')->fetchField();

    $result = db_merge('test_people')
      ->key('job', 'Speaker')
<<<<<<< HEAD
      ->fields(array(
        'age' => 31,
        'name' => 'Tiffany',
      ))
=======
      ->fields([
        'age' => 31,
        'name' => 'Tiffany',
      ])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->execute();

    $this->assertEqual($result, Merge::STATUS_UPDATE, 'Update status returned.');

    $num_records_after = db_query('SELECT COUNT(*) FROM {test_people}')->fetchField();
    $this->assertEqual($num_records_before, $num_records_after, 'Merge updated properly.');

<<<<<<< HEAD
    $person = db_query('SELECT * FROM {test_people} WHERE job = :job', array(':job' => 'Speaker'))->fetch();
=======
    $person = db_query('SELECT * FROM {test_people} WHERE job = :job', [':job' => 'Speaker'])->fetch();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($person->name, 'Tiffany', 'Name set correctly.');
    $this->assertEqual($person->age, 31, 'Age set correctly.');
    $this->assertEqual($person->job, 'Speaker', 'Job set correctly.');
  }

  /**
   * Confirms that we can merge-update a record successfully.
   *
   * This test varies from the previous test because it manually defines which
   * fields are inserted, and which fields are updated.
   */
<<<<<<< HEAD
  function testMergeUpdateExcept() {
=======
  public function testMergeUpdateExcept() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $num_records_before = db_query('SELECT COUNT(*) FROM {test_people}')->fetchField();

    db_merge('test_people')
      ->key('job', 'Speaker')
<<<<<<< HEAD
      ->insertFields(array('age' => 31))
      ->updateFields(array('name' => 'Tiffany'))
=======
      ->insertFields(['age' => 31])
      ->updateFields(['name' => 'Tiffany'])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->execute();

    $num_records_after = db_query('SELECT COUNT(*) FROM {test_people}')->fetchField();
    $this->assertEqual($num_records_before, $num_records_after, 'Merge updated properly.');

<<<<<<< HEAD
    $person = db_query('SELECT * FROM {test_people} WHERE job = :job', array(':job' => 'Speaker'))->fetch();
=======
    $person = db_query('SELECT * FROM {test_people} WHERE job = :job', [':job' => 'Speaker'])->fetch();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($person->name, 'Tiffany', 'Name set correctly.');
    $this->assertEqual($person->age, 30, 'Age skipped correctly.');
    $this->assertEqual($person->job, 'Speaker', 'Job set correctly.');
  }

  /**
   * Confirms that we can merge-update a record, with alternate replacement.
   */
<<<<<<< HEAD
  function testMergeUpdateExplicit() {
=======
  public function testMergeUpdateExplicit() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $num_records_before = db_query('SELECT COUNT(*) FROM {test_people}')->fetchField();

    db_merge('test_people')
      ->key('job', 'Speaker')
<<<<<<< HEAD
      ->insertFields(array(
        'age' => 31,
        'name' => 'Tiffany',
      ))
      ->updateFields(array(
        'name' => 'Joe',
      ))
=======
      ->insertFields([
        'age' => 31,
        'name' => 'Tiffany',
      ])
      ->updateFields([
        'name' => 'Joe',
      ])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->execute();

    $num_records_after = db_query('SELECT COUNT(*) FROM {test_people}')->fetchField();
    $this->assertEqual($num_records_before, $num_records_after, 'Merge updated properly.');

<<<<<<< HEAD
    $person = db_query('SELECT * FROM {test_people} WHERE job = :job', array(':job' => 'Speaker'))->fetch();
=======
    $person = db_query('SELECT * FROM {test_people} WHERE job = :job', [':job' => 'Speaker'])->fetch();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($person->name, 'Joe', 'Name set correctly.');
    $this->assertEqual($person->age, 30, 'Age skipped correctly.');
    $this->assertEqual($person->job, 'Speaker', 'Job set correctly.');
  }

  /**
   * Confirms that we can merge-update a record successfully, with expressions.
   */
<<<<<<< HEAD
  function testMergeUpdateExpression() {
    $num_records_before = db_query('SELECT COUNT(*) FROM {test_people}')->fetchField();

    $age_before = db_query('SELECT age FROM {test_people} WHERE job = :job', array(':job' => 'Speaker'))->fetchField();
=======
  public function testMergeUpdateExpression() {
    $num_records_before = db_query('SELECT COUNT(*) FROM {test_people}')->fetchField();

    $age_before = db_query('SELECT age FROM {test_people} WHERE job = :job', [':job' => 'Speaker'])->fetchField();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // This is a very contrived example, as I have no idea why you'd want to
    // change age this way, but that's beside the point.
    // Note that we are also double-setting age here, once as a literal and
    // once as an expression. This test will only pass if the expression wins,
    // which is what is supposed to happen.
    db_merge('test_people')
      ->key('job', 'Speaker')
<<<<<<< HEAD
      ->fields(array('name' => 'Tiffany'))
      ->insertFields(array('age' => 31))
      ->expression('age', 'age + :age', array(':age' => 4))
=======
      ->fields(['name' => 'Tiffany'])
      ->insertFields(['age' => 31])
      ->expression('age', 'age + :age', [':age' => 4])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->execute();

    $num_records_after = db_query('SELECT COUNT(*) FROM {test_people}')->fetchField();
    $this->assertEqual($num_records_before, $num_records_after, 'Merge updated properly.');

<<<<<<< HEAD
    $person = db_query('SELECT * FROM {test_people} WHERE job = :job', array(':job' => 'Speaker'))->fetch();
=======
    $person = db_query('SELECT * FROM {test_people} WHERE job = :job', [':job' => 'Speaker'])->fetch();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($person->name, 'Tiffany', 'Name set correctly.');
    $this->assertEqual($person->age, $age_before + 4, 'Age updated correctly.');
    $this->assertEqual($person->job, 'Speaker', 'Job set correctly.');
  }

  /**
   * Tests that we can merge-insert without any update fields.
   */
<<<<<<< HEAD
  function testMergeInsertWithoutUpdate() {
=======
  public function testMergeInsertWithoutUpdate() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $num_records_before = db_query('SELECT COUNT(*) FROM {test_people}')->fetchField();

    db_merge('test_people')
      ->key('job', 'Presenter')
      ->execute();

    $num_records_after = db_query('SELECT COUNT(*) FROM {test_people}')->fetchField();
    $this->assertEqual($num_records_before + 1, $num_records_after, 'Merge inserted properly.');

<<<<<<< HEAD
    $person = db_query('SELECT * FROM {test_people} WHERE job = :job', array(':job' => 'Presenter'))->fetch();
=======
    $person = db_query('SELECT * FROM {test_people} WHERE job = :job', [':job' => 'Presenter'])->fetch();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($person->name, '', 'Name set correctly.');
    $this->assertEqual($person->age, 0, 'Age set correctly.');
    $this->assertEqual($person->job, 'Presenter', 'Job set correctly.');
  }

  /**
   * Confirms that we can merge-update without any update fields.
   */
<<<<<<< HEAD
  function testMergeUpdateWithoutUpdate() {
=======
  public function testMergeUpdateWithoutUpdate() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $num_records_before = db_query('SELECT COUNT(*) FROM {test_people}')->fetchField();

    db_merge('test_people')
      ->key('job', 'Speaker')
      ->execute();

    $num_records_after = db_query('SELECT COUNT(*) FROM {test_people}')->fetchField();
    $this->assertEqual($num_records_before, $num_records_after, 'Merge skipped properly.');

<<<<<<< HEAD
    $person = db_query('SELECT * FROM {test_people} WHERE job = :job', array(':job' => 'Speaker'))->fetch();
=======
    $person = db_query('SELECT * FROM {test_people} WHERE job = :job', [':job' => 'Speaker'])->fetch();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($person->name, 'Meredith', 'Name skipped correctly.');
    $this->assertEqual($person->age, 30, 'Age skipped correctly.');
    $this->assertEqual($person->job, 'Speaker', 'Job skipped correctly.');

    db_merge('test_people')
      ->key('job', 'Speaker')
<<<<<<< HEAD
      ->insertFields(array('age' => 31))
=======
      ->insertFields(['age' => 31])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->execute();

    $num_records_after = db_query('SELECT COUNT(*) FROM {test_people}')->fetchField();
    $this->assertEqual($num_records_before, $num_records_after, 'Merge skipped properly.');

<<<<<<< HEAD
    $person = db_query('SELECT * FROM {test_people} WHERE job = :job', array(':job' => 'Speaker'))->fetch();
=======
    $person = db_query('SELECT * FROM {test_people} WHERE job = :job', [':job' => 'Speaker'])->fetch();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($person->name, 'Meredith', 'Name skipped correctly.');
    $this->assertEqual($person->age, 30, 'Age skipped correctly.');
    $this->assertEqual($person->job, 'Speaker', 'Job skipped correctly.');
  }

  /**
   * Tests that an invalid merge query throws an exception.
   */
<<<<<<< HEAD
  function testInvalidMerge() {
=======
  public function testInvalidMerge() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    try {
      // This query will fail because there is no key field specified.
      // Normally it would throw an exception but we are suppressing it with
      // the throw_exception option.
      $options['throw_exception'] = FALSE;
      db_merge('test_people', $options)
<<<<<<< HEAD
        ->fields(array(
          'age' => 31,
          'name' => 'Tiffany',
        ))
=======
        ->fields([
          'age' => 31,
          'name' => 'Tiffany',
        ])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        ->execute();
      $this->pass('$options[\'throw_exception\'] is FALSE, no InvalidMergeQueryException thrown.');
    }
    catch (InvalidMergeQueryException $e) {
      $this->fail('$options[\'throw_exception\'] is FALSE, but InvalidMergeQueryException thrown for invalid query.');
      return;
    }

    try {
      // This query will fail because there is no key field specified.
      db_merge('test_people')
<<<<<<< HEAD
        ->fields(array(
          'age' => 31,
          'name' => 'Tiffany',
        ))
=======
        ->fields([
          'age' => 31,
          'name' => 'Tiffany',
        ])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        ->execute();
    }
    catch (InvalidMergeQueryException $e) {
      $this->pass('InvalidMergeQueryException thrown for invalid query.');
      return;
    }
    $this->fail('No InvalidMergeQueryException thrown');
  }

}
