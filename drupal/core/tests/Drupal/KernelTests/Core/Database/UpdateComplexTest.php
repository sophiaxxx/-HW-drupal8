<?php

namespace Drupal\KernelTests\Core\Database;

<<<<<<< HEAD
=======
use Drupal\Core\Database\Query\Condition;

>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
/**
 * Tests the Update query builder, complex queries.
 *
 * @group Database
 */
class UpdateComplexTest extends DatabaseTestBase {

  /**
   * Tests updates with OR conditionals.
   */
<<<<<<< HEAD
  function testOrConditionUpdate() {
    $update = db_update('test')
      ->fields(array('job' => 'Musician'))
      ->condition(db_or()
=======
  public function testOrConditionUpdate() {
    $update = db_update('test')
      ->fields(['job' => 'Musician'])
      ->condition((new Condition('OR'))
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        ->condition('name', 'John')
        ->condition('name', 'Paul')
      );
    $num_updated = $update->execute();
    $this->assertIdentical($num_updated, 2, 'Updated 2 records.');

<<<<<<< HEAD
    $num_matches = db_query('SELECT COUNT(*) FROM {test} WHERE job = :job', array(':job' => 'Musician'))->fetchField();
=======
    $num_matches = db_query('SELECT COUNT(*) FROM {test} WHERE job = :job', [':job' => 'Musician'])->fetchField();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical($num_matches, '2', 'Updated fields successfully.');
  }

  /**
   * Tests WHERE IN clauses.
   */
<<<<<<< HEAD
  function testInConditionUpdate() {
    $num_updated = db_update('test')
      ->fields(array('job' => 'Musician'))
      ->condition('name', array('John', 'Paul'), 'IN')
      ->execute();
    $this->assertIdentical($num_updated, 2, 'Updated 2 records.');

    $num_matches = db_query('SELECT COUNT(*) FROM {test} WHERE job = :job', array(':job' => 'Musician'))->fetchField();
=======
  public function testInConditionUpdate() {
    $num_updated = db_update('test')
      ->fields(['job' => 'Musician'])
      ->condition('name', ['John', 'Paul'], 'IN')
      ->execute();
    $this->assertIdentical($num_updated, 2, 'Updated 2 records.');

    $num_matches = db_query('SELECT COUNT(*) FROM {test} WHERE job = :job', [':job' => 'Musician'])->fetchField();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical($num_matches, '2', 'Updated fields successfully.');
  }

  /**
   * Tests WHERE NOT IN clauses.
   */
<<<<<<< HEAD
  function testNotInConditionUpdate() {
    // The o is lowercase in the 'NoT IN' operator, to make sure the operators
    // work in mixed case.
    $num_updated = db_update('test')
      ->fields(array('job' => 'Musician'))
      ->condition('name', array('John', 'Paul', 'George'), 'NoT IN')
      ->execute();
    $this->assertIdentical($num_updated, 1, 'Updated 1 record.');

    $num_matches = db_query('SELECT COUNT(*) FROM {test} WHERE job = :job', array(':job' => 'Musician'))->fetchField();
=======
  public function testNotInConditionUpdate() {
    // The o is lowercase in the 'NoT IN' operator, to make sure the operators
    // work in mixed case.
    $num_updated = db_update('test')
      ->fields(['job' => 'Musician'])
      ->condition('name', ['John', 'Paul', 'George'], 'NoT IN')
      ->execute();
    $this->assertIdentical($num_updated, 1, 'Updated 1 record.');

    $num_matches = db_query('SELECT COUNT(*) FROM {test} WHERE job = :job', [':job' => 'Musician'])->fetchField();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical($num_matches, '1', 'Updated fields successfully.');
  }

  /**
   * Tests BETWEEN conditional clauses.
   */
<<<<<<< HEAD
  function testBetweenConditionUpdate() {
    $num_updated = db_update('test')
      ->fields(array('job' => 'Musician'))
      ->condition('age', array(25, 26), 'BETWEEN')
      ->execute();
    $this->assertIdentical($num_updated, 2, 'Updated 2 records.');

    $num_matches = db_query('SELECT COUNT(*) FROM {test} WHERE job = :job', array(':job' => 'Musician'))->fetchField();
=======
  public function testBetweenConditionUpdate() {
    $num_updated = db_update('test')
      ->fields(['job' => 'Musician'])
      ->condition('age', [25, 26], 'BETWEEN')
      ->execute();
    $this->assertIdentical($num_updated, 2, 'Updated 2 records.');

    $num_matches = db_query('SELECT COUNT(*) FROM {test} WHERE job = :job', [':job' => 'Musician'])->fetchField();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical($num_matches, '2', 'Updated fields successfully.');
  }

  /**
   * Tests LIKE conditionals.
   */
<<<<<<< HEAD
  function testLikeConditionUpdate() {
    $num_updated = db_update('test')
      ->fields(array('job' => 'Musician'))
=======
  public function testLikeConditionUpdate() {
    $num_updated = db_update('test')
      ->fields(['job' => 'Musician'])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('name', '%ge%', 'LIKE')
      ->execute();
    $this->assertIdentical($num_updated, 1, 'Updated 1 record.');

<<<<<<< HEAD
    $num_matches = db_query('SELECT COUNT(*) FROM {test} WHERE job = :job', array(':job' => 'Musician'))->fetchField();
=======
    $num_matches = db_query('SELECT COUNT(*) FROM {test} WHERE job = :job', [':job' => 'Musician'])->fetchField();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical($num_matches, '1', 'Updated fields successfully.');
  }

  /**
   * Tests UPDATE with expression values.
   */
<<<<<<< HEAD
  function testUpdateExpression() {
    $before_age = db_query('SELECT age FROM {test} WHERE name = :name', array(':name' => 'Ringo'))->fetchField();
    $GLOBALS['larry_test'] = 1;
    $num_updated = db_update('test')
      ->condition('name', 'Ringo')
      ->fields(array('job' => 'Musician'))
      ->expression('age', 'age + :age', array(':age' => 4))
      ->execute();
    $this->assertIdentical($num_updated, 1, 'Updated 1 record.');

    $num_matches = db_query('SELECT COUNT(*) FROM {test} WHERE job = :job', array(':job' => 'Musician'))->fetchField();
    $this->assertIdentical($num_matches, '1', 'Updated fields successfully.');

    $person = db_query('SELECT * FROM {test} WHERE name = :name', array(':name' => 'Ringo'))->fetch();
    $this->assertEqual($person->name, 'Ringo', 'Name set correctly.');
    $this->assertEqual($person->age, $before_age + 4, 'Age set correctly.');
    $this->assertEqual($person->job, 'Musician', 'Job set correctly.');
    $GLOBALS['larry_test'] = 0;
=======
  public function testUpdateExpression() {
    $before_age = db_query('SELECT age FROM {test} WHERE name = :name', [':name' => 'Ringo'])->fetchField();
    $num_updated = db_update('test')
      ->condition('name', 'Ringo')
      ->fields(['job' => 'Musician'])
      ->expression('age', 'age + :age', [':age' => 4])
      ->execute();
    $this->assertIdentical($num_updated, 1, 'Updated 1 record.');

    $num_matches = db_query('SELECT COUNT(*) FROM {test} WHERE job = :job', [':job' => 'Musician'])->fetchField();
    $this->assertIdentical($num_matches, '1', 'Updated fields successfully.');

    $person = db_query('SELECT * FROM {test} WHERE name = :name', [':name' => 'Ringo'])->fetch();
    $this->assertEqual($person->name, 'Ringo', 'Name set correctly.');
    $this->assertEqual($person->age, $before_age + 4, 'Age set correctly.');
    $this->assertEqual($person->job, 'Musician', 'Job set correctly.');
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests UPDATE with only expression values.
   */
<<<<<<< HEAD
  function testUpdateOnlyExpression() {
    $before_age = db_query('SELECT age FROM {test} WHERE name = :name', array(':name' => 'Ringo'))->fetchField();
    $num_updated = db_update('test')
      ->condition('name', 'Ringo')
      ->expression('age', 'age + :age', array(':age' => 4))
      ->execute();
    $this->assertIdentical($num_updated, 1, 'Updated 1 record.');

    $after_age = db_query('SELECT age FROM {test} WHERE name = :name', array(':name' => 'Ringo'))->fetchField();
=======
  public function testUpdateOnlyExpression() {
    $before_age = db_query('SELECT age FROM {test} WHERE name = :name', [':name' => 'Ringo'])->fetchField();
    $num_updated = db_update('test')
      ->condition('name', 'Ringo')
      ->expression('age', 'age + :age', [':age' => 4])
      ->execute();
    $this->assertIdentical($num_updated, 1, 'Updated 1 record.');

    $after_age = db_query('SELECT age FROM {test} WHERE name = :name', [':name' => 'Ringo'])->fetchField();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($before_age + 4, $after_age, 'Age updated correctly');
  }

  /**
   * Test UPDATE with a subselect value.
   */
<<<<<<< HEAD
  function testSubSelectUpdate() {
    $subselect = db_select('test_task', 't');
    $subselect->addExpression('MAX(priority) + :increment', 'max_priority', array(':increment' => 30));
=======
  public function testSubSelectUpdate() {
    $subselect = db_select('test_task', 't');
    $subselect->addExpression('MAX(priority) + :increment', 'max_priority', [':increment' => 30]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Clone this to make sure we are running a different query when
    // asserting.
    $select = clone $subselect;
    $query = db_update('test')
      ->expression('age', $subselect)
      ->condition('name', 'Ringo');
    // Save the number of rows that updated for assertion later.
    $num_updated = $query->execute();
<<<<<<< HEAD
    $after_age = db_query('SELECT age FROM {test} WHERE name = :name', array(':name' => 'Ringo'))->fetchField();
=======
    $after_age = db_query('SELECT age FROM {test} WHERE name = :name', [':name' => 'Ringo'])->fetchField();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $expected_age = $select->execute()->fetchField();
    $this->assertEqual($after_age, $expected_age);
    $this->assertEqual(1, $num_updated, t('Expected 1 row to be updated in subselect update query.'));
  }

}
