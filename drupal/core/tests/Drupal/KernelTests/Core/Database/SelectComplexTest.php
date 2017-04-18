<?php

namespace Drupal\KernelTests\Core\Database;

use Drupal\Core\Database\Database;
<<<<<<< HEAD
=======
use Drupal\Core\Database\Query\Condition;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
use Drupal\Core\Database\RowCountException;
use Drupal\user\Entity\User;

/**
 * Tests the Select query builder with more complex queries.
 *
 * @group Database
 */
class SelectComplexTest extends DatabaseTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('system', 'user', 'node_access_test', 'field');
=======
  public static $modules = ['system', 'user', 'node_access_test', 'field'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Tests simple JOIN statements.
   */
<<<<<<< HEAD
  function testDefaultJoin() {
=======
  public function testDefaultJoin() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $query = db_select('test_task', 't');
    $people_alias = $query->join('test', 'p', 't.pid = p.id');
    $name_field = $query->addField($people_alias, 'name', 'name');
    $query->addField('t', 'task', 'task');
    $priority_field = $query->addField('t', 'priority', 'priority');

    $query->orderBy($priority_field);
    $result = $query->execute();

    $num_records = 0;
    $last_priority = 0;
    foreach ($result as $record) {
      $num_records++;
      $this->assertTrue($record->$priority_field >= $last_priority, 'Results returned in correct order.');
      $this->assertNotEqual($record->$name_field, 'Ringo', 'Taskless person not selected.');
      $last_priority = $record->$priority_field;
    }

    $this->assertEqual($num_records, 7, 'Returned the correct number of rows.');
  }

  /**
   * Tests LEFT OUTER joins.
   */
<<<<<<< HEAD
  function testLeftOuterJoin() {
=======
  public function testLeftOuterJoin() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $query = db_select('test', 'p');
    $people_alias = $query->leftJoin('test_task', 't', 't.pid = p.id');
    $name_field = $query->addField('p', 'name', 'name');
    $query->addField($people_alias, 'task', 'task');
    $query->addField($people_alias, 'priority', 'priority');

    $query->orderBy($name_field);
    $result = $query->execute();

    $num_records = 0;
    $last_name = 0;

    foreach ($result as $record) {
      $num_records++;
      $this->assertTrue(strcmp($record->$name_field, $last_name) >= 0, 'Results returned in correct order.');
    }

    $this->assertEqual($num_records, 8, 'Returned the correct number of rows.');
  }

  /**
   * Tests GROUP BY clauses.
   */
<<<<<<< HEAD
  function testGroupBy() {
=======
  public function testGroupBy() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $query = db_select('test_task', 't');
    $count_field = $query->addExpression('COUNT(task)', 'num');
    $task_field = $query->addField('t', 'task');
    $query->orderBy($count_field);
    $query->groupBy($task_field);
    $result = $query->execute();

    $num_records = 0;
    $last_count = 0;
<<<<<<< HEAD
    $records = array();
=======
    $records = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    foreach ($result as $record) {
      $num_records++;
      $this->assertTrue($record->$count_field >= $last_count, 'Results returned in correct order.');
      $last_count = $record->$count_field;
      $records[$record->$task_field] = $record->$count_field;
    }

<<<<<<< HEAD
    $correct_results = array(
=======
    $correct_results = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'eat' => 1,
      'sleep' => 2,
      'code' => 1,
      'found new band' => 1,
      'perform at superbowl' => 1,
<<<<<<< HEAD
    );

    foreach ($correct_results as $task => $count) {
      $this->assertEqual($records[$task], $count, format_string("Correct number of '@task' records found.", array('@task' => $task)));
=======
    ];

    foreach ($correct_results as $task => $count) {
      $this->assertEqual($records[$task], $count, format_string("Correct number of '@task' records found.", ['@task' => $task]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    }

    $this->assertEqual($num_records, 6, 'Returned the correct number of total rows.');
  }

  /**
   * Tests GROUP BY and HAVING clauses together.
   */
<<<<<<< HEAD
  function testGroupByAndHaving() {
=======
  public function testGroupByAndHaving() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $query = db_select('test_task', 't');
    $count_field = $query->addExpression('COUNT(task)', 'num');
    $task_field = $query->addField('t', 'task');
    $query->orderBy($count_field);
    $query->groupBy($task_field);
    $query->having('COUNT(task) >= 2');
    $result = $query->execute();

    $num_records = 0;
    $last_count = 0;
<<<<<<< HEAD
    $records = array();
=======
    $records = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    foreach ($result as $record) {
      $num_records++;
      $this->assertTrue($record->$count_field >= 2, 'Record has the minimum count.');
      $this->assertTrue($record->$count_field >= $last_count, 'Results returned in correct order.');
      $last_count = $record->$count_field;
      $records[$record->$task_field] = $record->$count_field;
    }

<<<<<<< HEAD
    $correct_results = array(
      'sleep' => 2,
    );

    foreach ($correct_results as $task => $count) {
      $this->assertEqual($records[$task], $count, format_string("Correct number of '@task' records found.", array('@task' => $task)));
=======
    $correct_results = [
      'sleep' => 2,
    ];

    foreach ($correct_results as $task => $count) {
      $this->assertEqual($records[$task], $count, format_string("Correct number of '@task' records found.", ['@task' => $task]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    }

    $this->assertEqual($num_records, 1, 'Returned the correct number of total rows.');
  }

  /**
   * Tests range queries.
   *
   * The SQL clause varies with the database.
   */
<<<<<<< HEAD
  function testRange() {
=======
  public function testRange() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $query = db_select('test');
    $query->addField('test', 'name');
    $query->addField('test', 'age', 'age');
    $query->range(0, 2);
    $query_result = $query->countQuery()->execute()->fetchField();

    $this->assertEqual($query_result, 2, 'Returned the correct number of rows.');
  }

  /**
   * Test whether the range property of a select clause can be undone.
   */
<<<<<<< HEAD
  function testRangeUndo() {
=======
  public function testRangeUndo() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $query = db_select('test');
    $name_field = $query->addField('test', 'name');
    $age_field = $query->addField('test', 'age', 'age');
    $query->range(0, 2);
    $query->range(NULL, NULL);
    $query_result = $query->countQuery()->execute()->fetchField();

    $this->assertEqual($query_result, 4, 'Returned the correct number of rows.');
  }

  /**
   * Tests distinct queries.
   */
<<<<<<< HEAD
  function testDistinct() {
=======
  public function testDistinct() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $query = db_select('test_task');
    $query->addField('test_task', 'task');
    $query->distinct();
    $query_result = $query->countQuery()->execute()->fetchField();

    $this->assertEqual($query_result, 6, 'Returned the correct number of rows.');
  }

  /**
   * Tests that we can generate a count query from a built query.
   */
<<<<<<< HEAD
  function testCountQuery() {
=======
  public function testCountQuery() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $query = db_select('test');
    $name_field = $query->addField('test', 'name');
    $age_field = $query->addField('test', 'age', 'age');
    $query->orderBy('name');

    $count = $query->countQuery()->execute()->fetchField();

    $this->assertEqual($count, 4, 'Counted the correct number of records.');

    // Now make sure we didn't break the original query!  We should still have
    // all of the fields we asked for.
    $record = $query->execute()->fetch();
    $this->assertEqual($record->$name_field, 'George', 'Correct data retrieved.');
    $this->assertEqual($record->$age_field, 27, 'Correct data retrieved.');
  }

  /**
   * Tests having queries.
   */
<<<<<<< HEAD
  function testHavingCountQuery() {
=======
  public function testHavingCountQuery() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $query = db_select('test')
      ->extend('Drupal\Core\Database\Query\PagerSelectExtender')
      ->groupBy('age')
      ->having('age + 1 > 0');
    $query->addField('test', 'age');
    $query->addExpression('age + 1');
    $count = count($query->execute()->fetchCol());
    $this->assertEqual($count, 4, 'Counted the correct number of records.');
  }

  /**
   * Tests that countQuery removes 'all_fields' statements and ordering clauses.
   */
<<<<<<< HEAD
  function testCountQueryRemovals() {
=======
  public function testCountQueryRemovals() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $query = db_select('test');
    $query->fields('test');
    $query->orderBy('name');
    $count = $query->countQuery();

    // Check that the 'all_fields' statement is handled properly.
    $tables = $query->getTables();
    $this->assertEqual($tables['test']['all_fields'], 1, 'Query correctly sets \'all_fields\' statement.');
    $tables = $count->getTables();
    $this->assertFalse(isset($tables['test']['all_fields']), 'Count query correctly unsets \'all_fields\' statement.');

    // Check that the ordering clause is handled properly.
    $orderby = $query->getOrderBy();
    // The orderby string is different for PostgreSQL.
    // @see Drupal\Core\Database\Driver\pgsql\Select::orderBy()
    $db_type = Database::getConnection()->databaseType();
    $this->assertEqual($orderby['name'], ($db_type == 'pgsql' ? 'ASC NULLS FIRST' : 'ASC'), 'Query correctly sets ordering clause.');
    $orderby = $count->getOrderBy();
    $this->assertFalse(isset($orderby['name']), 'Count query correctly unsets ordering clause.');

    // Make sure that the count query works.
    $count = $count->execute()->fetchField();

    $this->assertEqual($count, 4, 'Counted the correct number of records.');
  }


  /**
   * Tests that countQuery properly removes fields and expressions.
   */
<<<<<<< HEAD
  function testCountQueryFieldRemovals() {
=======
  public function testCountQueryFieldRemovals() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // countQuery should remove all fields and expressions, so this can be
    // tested by adding a non-existent field and expression: if it ends
    // up in the query, an error will be thrown. If not, it will return the
    // number of records, which in this case happens to be 4 (there are four
    // records in the {test} table).
    $query = db_select('test');
<<<<<<< HEAD
    $query->fields('test', array('fail'));
=======
    $query->fields('test', ['fail']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual(4, $query->countQuery()->execute()->fetchField(), 'Count Query removed fields');

    $query = db_select('test');
    $query->addExpression('fail');
    $this->assertEqual(4, $query->countQuery()->execute()->fetchField(), 'Count Query removed expressions');
  }

  /**
   * Tests that we can generate a count query from a query with distinct.
   */
<<<<<<< HEAD
  function testCountQueryDistinct() {
=======
  public function testCountQueryDistinct() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $query = db_select('test_task');
    $query->addField('test_task', 'task');
    $query->distinct();

    $count = $query->countQuery()->execute()->fetchField();

    $this->assertEqual($count, 6, 'Counted the correct number of records.');
  }

  /**
   * Tests that we can generate a count query from a query with GROUP BY.
   */
<<<<<<< HEAD
  function testCountQueryGroupBy() {
=======
  public function testCountQueryGroupBy() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $query = db_select('test_task');
    $query->addField('test_task', 'pid');
    $query->groupBy('pid');

    $count = $query->countQuery()->execute()->fetchField();

    $this->assertEqual($count, 3, 'Counted the correct number of records.');

    // Use a column alias as, without one, the query can succeed for the wrong
    // reason.
    $query = db_select('test_task');
    $query->addField('test_task', 'pid', 'pid_alias');
    $query->addExpression('COUNT(test_task.task)', 'count');
    $query->groupBy('pid_alias');
    $query->orderBy('pid_alias', 'asc');

    $count = $query->countQuery()->execute()->fetchField();

    $this->assertEqual($count, 3, 'Counted the correct number of records.');
  }

  /**
   * Confirms that we can properly nest conditional clauses.
   */
<<<<<<< HEAD
  function testNestedConditions() {
=======
  public function testNestedConditions() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // This query should translate to:
    // "SELECT job FROM {test} WHERE name = 'Paul' AND (age = 26 OR age = 27)"
    // That should find only one record. Yes it's a non-optimal way of writing
    // that query but that's not the point!
    $query = db_select('test');
    $query->addField('test', 'job');
    $query->condition('name', 'Paul');
<<<<<<< HEAD
    $query->condition(db_or()->condition('age', 26)->condition('age', 27));
=======
    $query->condition((new Condition('OR'))->condition('age', 26)->condition('age', 27));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $job = $query->execute()->fetchField();
    $this->assertEqual($job, 'Songwriter', 'Correct data retrieved.');
  }

  /**
   * Confirms we can join on a single table twice with a dynamic alias.
   */
<<<<<<< HEAD
  function testJoinTwice() {
=======
  public function testJoinTwice() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $query = db_select('test')->fields('test');
    $alias = $query->join('test', 'test', 'test.job = %alias.job');
    $query->addField($alias, 'name', 'othername');
    $query->addField($alias, 'job', 'otherjob');
    $query->where("$alias.name <> test.name");
    $crowded_job = $query->execute()->fetch();
    $this->assertEqual($crowded_job->job, $crowded_job->otherjob, 'Correctly joined same table twice.');
    $this->assertNotEqual($crowded_job->name, $crowded_job->othername, 'Correctly joined same table twice.');
  }

  /**
   * Tests that we can join on a query.
   */
<<<<<<< HEAD
  function testJoinSubquery() {
=======
  public function testJoinSubquery() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->installSchema('system', 'sequences');

    $account = User::create([
      'name' => $this->randomMachineName(),
      'mail' => $this->randomMachineName() . '@example.com',
    ]);

<<<<<<< HEAD
    $query = db_select('test_task', 'tt', array('target' => 'replica'));
=======
    $query = db_select('test_task', 'tt', ['target' => 'replica']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $query->addExpression('tt.pid + 1', 'abc');
    $query->condition('priority', 1, '>');
    $query->condition('priority', 100, '<');

    $subquery = db_select('test', 'tp');
    $subquery->join('test_one_blob', 'tpb', 'tp.id = tpb.id');
    $subquery->join('node', 'n', 'tp.id = n.nid');
    $subquery->addTag('node_access');
    $subquery->addMetaData('account', $account);
    $subquery->addField('tp', 'id');
    $subquery->condition('age', 5, '>');
    $subquery->condition('age', 500, '<');

    $query->leftJoin($subquery, 'sq', 'tt.pid = sq.id');
    $query->join('test_one_blob', 'tb3', 'tt.pid = tb3.id');

    // Construct the query string.
    // This is the same sequence that SelectQuery::execute() goes through.
    $query->preExecute();
    $query->getArguments();
    $str = (string) $query;

    // Verify that the string only has one copy of condition placeholder 0.
    $pos = strpos($str, 'db_condition_placeholder_0', 0);
    $pos2 = strpos($str, 'db_condition_placeholder_0', $pos + 1);
    $this->assertFalse($pos2, 'Condition placeholder is not repeated.');
  }

  /**
   * Tests that rowCount() throws exception on SELECT query.
   */
<<<<<<< HEAD
  function testSelectWithRowCount() {
=======
  public function testSelectWithRowCount() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $query = db_select('test');
    $query->addField('test', 'name');
    $result = $query->execute();
    try {
      $result->rowCount();
      $exception = FALSE;
    }
    catch (RowCountException $e) {
      $exception = TRUE;
    }
    $this->assertTrue($exception, 'Exception was thrown');
  }

  /**
   * Test that join conditions can use Condition objects.
   */
  public function testJoinConditionObject() {
    // Same test as testDefaultJoin, but with a Condition object.
    $query = db_select('test_task', 't');
<<<<<<< HEAD
    $join_cond = db_and()->where('t.pid = p.id');
=======
    $join_cond = (new Condition('AND'))->where('t.pid = p.id');
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $people_alias = $query->join('test', 'p', $join_cond);
    $name_field = $query->addField($people_alias, 'name', 'name');
    $query->addField('t', 'task', 'task');
    $priority_field = $query->addField('t', 'priority', 'priority');

    $query->orderBy($priority_field);
    $result = $query->execute();

    $num_records = 0;
    $last_priority = 0;
    foreach ($result as $record) {
      $num_records++;
      $this->assertTrue($record->$priority_field >= $last_priority, 'Results returned in correct order.');
      $this->assertNotEqual($record->$name_field, 'Ringo', 'Taskless person not selected.');
      $last_priority = $record->$priority_field;
    }

    $this->assertEqual($num_records, 7, 'Returned the correct number of rows.');

    // Test a condition object that creates placeholders.
    $t1_name = 'John';
    $t2_name = 'George';
<<<<<<< HEAD
    $join_cond = db_and()
=======
    $join_cond = (new Condition('AND'))
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('t1.name', $t1_name)
      ->condition('t2.name', $t2_name);
    $query = db_select('test', 't1');
    $query->innerJoin('test', 't2', $join_cond);
    $query->addField('t1', 'name', 't1_name');
    $query->addField('t2', 'name', 't2_name');

    $num_records = $query->countQuery()->execute()->fetchField();
    $this->assertEqual($num_records, 1, 'Query expected to return 1 row. Actual: ' . $num_records);
    if ($num_records == 1) {
      $record = $query->execute()->fetchObject();
      $this->assertEqual($record->t1_name, $t1_name, 'Query expected to retrieve name ' . $t1_name . ' from table t1. Actual: ' . $record->t1_name);
      $this->assertEqual($record->t2_name, $t2_name, 'Query expected to retrieve name ' . $t2_name . ' from table t2. Actual: ' . $record->t2_name);
    }
  }

}