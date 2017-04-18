<?php

namespace Drupal\KernelTests\Core\Database;

/**
 * Tests the Select query builder.
 *
 * @group Database
 */
class SelectSubqueryTest extends DatabaseTestBase {

  /**
   * Tests that we can use a subquery in a FROM clause.
   */
<<<<<<< HEAD
  function testFromSubquerySelect() {
=======
  public function testFromSubquerySelect() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Create a subquery, which is just a normal query object.
    $subquery = db_select('test_task', 'tt');
    $subquery->addField('tt', 'pid', 'pid');
    $subquery->addField('tt', 'task', 'task');
    $subquery->condition('priority', 1);

    for ($i = 0; $i < 2; $i++) {
      // Create another query that joins against the virtual table resulting
      // from the subquery.
      $select = db_select($subquery, 'tt2');
      $select->join('test', 't', 't.id=tt2.pid');
      $select->addField('t', 'name');
      if ($i) {
        // Use a different number of conditions here to confuse the subquery
        // placeholder counter, testing https://www.drupal.org/node/1112854.
        $select->condition('name', 'John');
      }
      $select->condition('task', 'code');

      // The resulting query should be equivalent to:
      // SELECT t.name
      // FROM (SELECT tt.pid AS pid, tt.task AS task FROM test_task tt WHERE priority=1) tt
      //   INNER JOIN test t ON t.id=tt.pid
      // WHERE tt.task = 'code'
      $people = $select->execute()->fetchCol();

<<<<<<< HEAD
      $this->assertEqual(count($people), 1, 'Returned the correct number of rows.');
=======
      $this->assertCount(1, $people, 'Returned the correct number of rows.');
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    }
  }

  /**
   * Tests that we can use a subquery in a FROM clause with a LIMIT.
   */
<<<<<<< HEAD
  function testFromSubquerySelectWithLimit() {
=======
  public function testFromSubquerySelectWithLimit() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Create a subquery, which is just a normal query object.
    $subquery = db_select('test_task', 'tt');
    $subquery->addField('tt', 'pid', 'pid');
    $subquery->addField('tt', 'task', 'task');
    $subquery->orderBy('priority', 'DESC');
    $subquery->range(0, 1);

    // Create another query that joins against the virtual table resulting
    // from the subquery.
    $select = db_select($subquery, 'tt2');
    $select->join('test', 't', 't.id=tt2.pid');
    $select->addField('t', 'name');

    // The resulting query should be equivalent to:
    // SELECT t.name
    // FROM (SELECT tt.pid AS pid, tt.task AS task FROM test_task tt ORDER BY priority DESC LIMIT 1 OFFSET 0) tt
    //   INNER JOIN test t ON t.id=tt.pid
    $people = $select->execute()->fetchCol();

<<<<<<< HEAD
    $this->assertEqual(count($people), 1, 'Returned the correct number of rows.');
  }

  /**
   * Tests that we can use a subquery in a WHERE clause.
   */
  function testConditionSubquerySelect() {
=======
    $this->assertCount(1, $people, 'Returned the correct number of rows.');
  }

  /**
   * Tests that we can use a subquery with an IN operator in a WHERE clause.
   */
  public function testConditionSubquerySelect() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Create a subquery, which is just a normal query object.
    $subquery = db_select('test_task', 'tt');
    $subquery->addField('tt', 'pid', 'pid');
    $subquery->condition('tt.priority', 1);

    // Create another query that joins against the virtual table resulting
    // from the subquery.
    $select = db_select('test_task', 'tt2');
    $select->addField('tt2', 'task');
    $select->condition('tt2.pid', $subquery, 'IN');

    // The resulting query should be equivalent to:
    // SELECT tt2.name
    // FROM test tt2
    // WHERE tt2.pid IN (SELECT tt.pid AS pid FROM test_task tt WHERE tt.priority=1)
    $people = $select->execute()->fetchCol();
<<<<<<< HEAD
    $this->assertEqual(count($people), 5, 'Returned the correct number of rows.');
=======
    $this->assertCount(5, $people, 'Returned the correct number of rows.');
  }

  /**
   * Test that we can use a subquery with a relational operator in a WHERE clause.
   */
  public function testConditionSubquerySelect2() {
    // Create a subquery, which is just a normal query object.
    $subquery = db_select('test', 't2');
    $subquery->addExpression('AVG(t2.age)');

    // Create another query that adds a clause using the subquery.
    $select = db_select('test', 't');
    $select->addField('t', 'name');
    $select->condition('t.age', $subquery, '<');

    // The resulting query should be equivalent to:
    // SELECT t.name
    // FROM test t
    // WHERE t.age < (SELECT AVG(t2.age) FROM test t2)
    $people = $select->execute()->fetchCol();
    $this->assertEquals(['John', 'Paul'], $people, 'Returned Paul and John.', 0.0, 10, TRUE);
  }

  /**
   * Test that we can use 2 subqueries with a relational operator in a WHERE clause.
   */
  public function testConditionSubquerySelect3() {
    // Create subquery 1, which is just a normal query object.
    $subquery1 = db_select('test_task', 'tt');
    $subquery1->addExpression('AVG(tt.priority)');
    $subquery1->where('tt.pid = t.id');

    // Create subquery 2, which is just a normal query object.
    $subquery2 = db_select('test_task', 'tt2');
    $subquery2->addExpression('AVG(tt2.priority)');

    // Create another query that adds a clause using the subqueries.
    $select = db_select('test', 't');
    $select->addField('t', 'name');
    $select->condition($subquery1, $subquery2, '>');

    // The resulting query should be equivalent to:
    // SELECT t.name
    // FROM test t
    // WHERE (SELECT AVG(tt.priority) FROM test_task tt WHERE tt.pid = t.id) > (SELECT AVG(tt2.priority) FROM test_task tt2)
    $people = $select->execute()->fetchCol();
    $this->assertEquals(['John'], $people, 'Returned John.', 0.0, 10, TRUE);
  }

  /**
   * Test that we can use multiple subqueries.
   *
   * This test uses a subquery at the left hand side and multiple subqueries at
   * the right hand side. The test query may not be that logical but that's due
   * to the limited amount of data and tables. 'Valid' use cases do exist :)
   */
  public function testConditionSubquerySelect4() {
    // Create subquery 1, which is just a normal query object.
    $subquery1 = db_select('test_task', 'tt');
    $subquery1->addExpression('AVG(tt.priority)');
    $subquery1->where('tt.pid = t.id');

    // Create subquery 2, which is just a normal query object.
    $subquery2 = db_select('test_task', 'tt2');
    $subquery2->addExpression('MIN(tt2.priority)');
    $subquery2->where('tt2.pid <> t.id');

    // Create subquery 3, which is just a normal query object.
    $subquery3 = db_select('test_task', 'tt3');
    $subquery3->addExpression('AVG(tt3.priority)');
    $subquery3->where('tt3.pid <> t.id');

    // Create another query that adds a clause using the subqueries.
    $select = db_select('test', 't');
    $select->addField('t', 'name');
    $select->condition($subquery1, [$subquery2, $subquery3], 'BETWEEN');

    // The resulting query should be equivalent to:
    // SELECT t.name AS name
    // FROM {test} t
    // WHERE (SELECT AVG(tt.priority) AS expression FROM {test_task} tt WHERE (tt.pid = t.id))
    //   BETWEEN (SELECT MIN(tt2.priority) AS expression FROM {test_task} tt2 WHERE (tt2.pid <> t.id))
    //       AND (SELECT AVG(tt3.priority) AS expression FROM {test_task} tt3 WHERE (tt3.pid <> t.id));
    $people = $select->execute()->fetchCol();
    $this->assertEquals(['George', 'Paul'], $people, 'Returned George and Paul.', 0.0, 10, TRUE);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests that we can use a subquery in a JOIN clause.
   */
<<<<<<< HEAD
  function testJoinSubquerySelect() {
=======
  public function testJoinSubquerySelect() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Create a subquery, which is just a normal query object.
    $subquery = db_select('test_task', 'tt');
    $subquery->addField('tt', 'pid', 'pid');
    $subquery->condition('priority', 1);

    // Create another query that joins against the virtual table resulting
    // from the subquery.
    $select = db_select('test', 't');
    $select->join($subquery, 'tt', 't.id=tt.pid');
    $select->addField('t', 'name');

    // The resulting query should be equivalent to:
    // SELECT t.name
    // FROM test t
    //   INNER JOIN (SELECT tt.pid AS pid FROM test_task tt WHERE priority=1) tt ON t.id=tt.pid
    $people = $select->execute()->fetchCol();

<<<<<<< HEAD
    $this->assertEqual(count($people), 2, 'Returned the correct number of rows.');
=======
    $this->assertCount(2, $people, 'Returned the correct number of rows.');
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests EXISTS subquery conditionals on SELECT statements.
   *
   * We essentially select all rows from the {test} table that have matching
   * rows in the {test_people} table based on the shared name column.
   */
<<<<<<< HEAD
  function testExistsSubquerySelect() {
    // Put George into {test_people}.
    db_insert('test_people')
      ->fields(array(
        'name' => 'George',
        'age' => 27,
        'job' => 'Singer',
      ))
      ->execute();
    // Base query to {test}.
    $query = db_select('test', 't')
      ->fields('t', array('name'));
    // Subquery to {test_people}.
    $subquery = db_select('test_people', 'tp')
      ->fields('tp', array('name'))
=======
  public function testExistsSubquerySelect() {
    // Put George into {test_people}.
    db_insert('test_people')
      ->fields([
        'name' => 'George',
        'age' => 27,
        'job' => 'Singer',
      ])
      ->execute();
    // Base query to {test}.
    $query = db_select('test', 't')
      ->fields('t', ['name']);
    // Subquery to {test_people}.
    $subquery = db_select('test_people', 'tp')
      ->fields('tp', ['name'])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->where('tp.name = t.name');
    $query->exists($subquery);
    $result = $query->execute();

    // Ensure that we got the right record.
    $record = $result->fetch();
<<<<<<< HEAD
    $this->assertEqual($record->name, 'George', 'Fetched name is correct using EXISTS query.');
=======
    $this->assertEquals('George', $record->name, 'Fetched name is correct using EXISTS query.');
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests NOT EXISTS subquery conditionals on SELECT statements.
   *
   * We essentially select all rows from the {test} table that don't have
   * matching rows in the {test_people} table based on the shared name column.
   */
<<<<<<< HEAD
  function testNotExistsSubquerySelect() {
    // Put George into {test_people}.
    db_insert('test_people')
      ->fields(array(
        'name' => 'George',
        'age' => 27,
        'job' => 'Singer',
      ))
=======
  public function testNotExistsSubquerySelect() {
    // Put George into {test_people}.
    db_insert('test_people')
      ->fields([
        'name' => 'George',
        'age' => 27,
        'job' => 'Singer',
      ])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->execute();

    // Base query to {test}.
    $query = db_select('test', 't')
<<<<<<< HEAD
      ->fields('t', array('name'));
    // Subquery to {test_people}.
    $subquery = db_select('test_people', 'tp')
      ->fields('tp', array('name'))
=======
      ->fields('t', ['name']);
    // Subquery to {test_people}.
    $subquery = db_select('test_people', 'tp')
      ->fields('tp', ['name'])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->where('tp.name = t.name');
    $query->notExists($subquery);

    // Ensure that we got the right number of records.
    $people = $query->execute()->fetchCol();
<<<<<<< HEAD
    $this->assertEqual(count($people), 3, 'NOT EXISTS query returned the correct results.');
=======
    $this->assertCount(3, $people, 'NOT EXISTS query returned the correct results.');
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

}
