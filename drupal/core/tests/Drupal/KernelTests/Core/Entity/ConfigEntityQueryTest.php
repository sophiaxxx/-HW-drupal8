<?php

namespace Drupal\KernelTests\Core\Entity;

use Drupal\Core\Config\Entity\Query\QueryFactory;
use Drupal\config_test\Entity\ConfigQueryTest;
use Drupal\KernelTests\KernelTestBase;

/**
 * Tests Config Entity Query functionality.
 *
 * @group Entity
 * @see \Drupal\Core\Config\Entity\Query
 */
class ConfigEntityQueryTest extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('config_test');
=======
  public static $modules = ['config_test'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Stores the search results for alter comparison.
   *
   * @var array
   */
  protected $queryResults;

  /**
   * The query factory used to construct all queries in the test.
   *
   * @var \Drupal\Core\Entity\Query\QueryFactory
   */
  protected $factory;

  /**
   * Stores all config entities created for the test.
   *
   * @var array
   */
  protected $entities;

  protected function setUp() {
    parent::setUp();

<<<<<<< HEAD
    $this->entities = array();
=======
    $this->entities = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->factory = $this->container->get('entity.query');

    // These two are here to make sure that matchArray needs to go over several
    // non-matches on every levels.
    $array['level1']['level2a'] = 9;
    $array['level1a']['level2'] = 9;
    // The tests match array.level1.level2.
    $array['level1']['level2'] = 1;
<<<<<<< HEAD
    $entity = ConfigQueryTest::create(array(
=======
    $entity = ConfigQueryTest::create([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'label' => $this->randomMachineName(),
      'id' => '1',
      'number' => 31,
      'array' => $array,
<<<<<<< HEAD
    ));
=======
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->entities[] = $entity;
    $entity->enforceIsNew();
    $entity->save();

    $array['level1']['level2'] = 2;
<<<<<<< HEAD
    $entity = ConfigQueryTest::create(array(
=======
    $entity = ConfigQueryTest::create([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'label' => $this->randomMachineName(),
      'id' => '2',
      'number' => 41,
      'array' => $array,
<<<<<<< HEAD
    ));
=======
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->entities[] = $entity;
    $entity->enforceIsNew();
    $entity->save();

    $array['level1']['level2'] = 1;
<<<<<<< HEAD
    $entity = ConfigQueryTest::create(array(
=======
    $entity = ConfigQueryTest::create([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'label' => 'test_prefix_' . $this->randomMachineName(),
      'id' => '3',
      'number' => 59,
      'array' => $array,
<<<<<<< HEAD
    ));
=======
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->entities[] = $entity;
    $entity->enforceIsNew();
    $entity->save();

    $array['level1']['level2'] = 2;
<<<<<<< HEAD
    $entity = ConfigQueryTest::create(array(
=======
    $entity = ConfigQueryTest::create([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'label' => $this->randomMachineName() . '_test_suffix',
      'id' => '4',
      'number' => 26,
      'array' => $array,
<<<<<<< HEAD
    ));
=======
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->entities[] = $entity;
    $entity->enforceIsNew();
    $entity->save();

    $array['level1']['level2'] = 3;
<<<<<<< HEAD
    $entity = ConfigQueryTest::create(array(
=======
    $entity = ConfigQueryTest::create([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'label' => $this->randomMachineName() . '_TEST_contains_' . $this->randomMachineName(),
      'id' => '5',
      'number' => 53,
      'array' => $array,
<<<<<<< HEAD
    ));
=======
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->entities[] = $entity;
    $entity->enforceIsNew();
    $entity->save();
  }

  /**
   * Tests basic functionality.
   */
  public function testConfigEntityQuery() {
    // Run a test without any condition.
    $this->queryResults = $this->factory->get('config_query_test')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('1', '2', '3', '4', '5'));
    // No conditions, OR.
    $this->queryResults = $this->factory->get('config_query_test', 'OR')
      ->execute();
    $this->assertResults(array('1', '2', '3', '4', '5'));
=======
    $this->assertResults(['1', '2', '3', '4', '5']);
    // No conditions, OR.
    $this->queryResults = $this->factory->get('config_query_test', 'OR')
      ->execute();
    $this->assertResults(['1', '2', '3', '4', '5']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Filter by ID with equality.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', '3')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('3'));
=======
    $this->assertResults(['3']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Filter by label with a known prefix.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('label', 'test_prefix', 'STARTS_WITH')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('3'));
=======
    $this->assertResults(['3']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Filter by label with a known suffix.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('label', 'test_suffix', 'ENDS_WITH')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('4'));
=======
    $this->assertResults(['4']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Filter by label with a known containing word.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('label', 'test_contains', 'CONTAINS')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('5'));

    // Filter by ID with the IN operator.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', array('2', '3'), 'IN')
      ->execute();
    $this->assertResults(array('2', '3'));

    // Filter by ID with the implicit IN operator.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', array('2', '3'))
      ->execute();
    $this->assertResults(array('2', '3'));
=======
    $this->assertResults(['5']);

    // Filter by ID with the IN operator.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', ['2', '3'], 'IN')
      ->execute();
    $this->assertResults(['2', '3']);

    // Filter by ID with the implicit IN operator.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', ['2', '3'])
      ->execute();
    $this->assertResults(['2', '3']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Filter by ID with the > operator.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', '3', '>')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('4', '5'));
=======
    $this->assertResults(['4', '5']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Filter by ID with the >= operator.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', '3', '>=')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('3', '4', '5'));
=======
    $this->assertResults(['3', '4', '5']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Filter by ID with the <> operator.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', '3', '<>')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('1', '2', '4', '5'));
=======
    $this->assertResults(['1', '2', '4', '5']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Filter by ID with the < operator.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', '3', '<')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('1', '2'));
=======
    $this->assertResults(['1', '2']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Filter by ID with the <= operator.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', '3', '<=')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('1', '2', '3'));
=======
    $this->assertResults(['1', '2', '3']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Filter by two conditions on the same field.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('label', 'test_pref', 'STARTS_WITH')
      ->condition('label', 'test_prefix', 'STARTS_WITH')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('3'));
=======
    $this->assertResults(['3']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Filter by two conditions on different fields. The first query matches for
    // a different ID, so the result is empty.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('label', 'test_prefix', 'STARTS_WITH')
      ->condition('id', '5')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array());
=======
    $this->assertResults([]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Filter by two different conditions on different fields. This time the
    // first condition matches on one item, but the second one does as well.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('label', 'test_prefix', 'STARTS_WITH')
      ->condition('id', '3')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('3'));
=======
    $this->assertResults(['3']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Filter by two different conditions, of which the first one matches for
    // every entry, the second one as well, but just the third one filters so
    // that just two are left.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', '1', '>=')
      ->condition('number', 10, '>=')
      ->condition('number', 50, '>=')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('3', '5'));
=======
    $this->assertResults(['3', '5']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Filter with an OR condition group.
    $this->queryResults = $this->factory->get('config_query_test', 'OR')
      ->condition('id', 1)
      ->condition('id', '2')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('1', '2'));

    // Simplify it with IN.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', array('1', '2'))
      ->execute();
    $this->assertResults(array('1', '2'));
    // Try explicit IN.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', array('1', '2'), 'IN')
      ->execute();
    $this->assertResults(array('1', '2'));
    // Try not IN.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', array('1', '2'), 'NOT IN')
      ->execute();
    $this->assertResults(array('3', '4', '5'));
=======
    $this->assertResults(['1', '2']);

    // Simplify it with IN.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', ['1', '2'])
      ->execute();
    $this->assertResults(['1', '2']);
    // Try explicit IN.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', ['1', '2'], 'IN')
      ->execute();
    $this->assertResults(['1', '2']);
    // Try not IN.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', ['1', '2'], 'NOT IN')
      ->execute();
    $this->assertResults(['3', '4', '5']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Filter with an OR condition group on different fields.
    $this->queryResults = $this->factory->get('config_query_test', 'OR')
      ->condition('id', 1)
      ->condition('number', 41)
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('1', '2'));
=======
    $this->assertResults(['1', '2']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Filter with an OR condition group on different fields but matching on the
    // same entity.
    $this->queryResults = $this->factory->get('config_query_test', 'OR')
      ->condition('id', 1)
      ->condition('number', 31)
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('1'));
=======
    $this->assertResults(['1']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // NO simple conditions, YES complex conditions, 'AND'.
    $query = $this->factory->get('config_query_test', 'AND');
    $and_condition_1 = $query->orConditionGroup()
      ->condition('id', '2')
      ->condition('label', $this->entities[0]->label);
    $and_condition_2 = $query->orConditionGroup()
      ->condition('id', 1)
      ->condition('label', $this->entities[3]->label);
    $this->queryResults = $query
      ->condition($and_condition_1)
      ->condition($and_condition_2)
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('1'));
=======
    $this->assertResults(['1']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // NO simple conditions, YES complex conditions, 'OR'.
    $query = $this->factory->get('config_query_test', 'OR');
    $and_condition_1 = $query->andConditionGroup()
      ->condition('id', 1)
      ->condition('label', $this->entities[0]->label);
    $and_condition_2 = $query->andConditionGroup()
      ->condition('id', '2')
      ->condition('label', $this->entities[1]->label);
    $this->queryResults = $query
      ->condition($and_condition_1)
      ->condition($and_condition_2)
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('1', '2'));
=======
    $this->assertResults(['1', '2']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // YES simple conditions, YES complex conditions, 'AND'.
    $query = $this->factory->get('config_query_test', 'AND');
    $and_condition_1 = $query->orConditionGroup()
      ->condition('id', '2')
      ->condition('label', $this->entities[0]->label);
    $and_condition_2 = $query->orConditionGroup()
      ->condition('id', 1)
      ->condition('label', $this->entities[3]->label);
    $this->queryResults = $query
      ->condition('number', 31)
      ->condition($and_condition_1)
      ->condition($and_condition_2)
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('1'));
=======
    $this->assertResults(['1']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // YES simple conditions, YES complex conditions, 'OR'.
    $query = $this->factory->get('config_query_test', 'OR');
    $and_condition_1 = $query->orConditionGroup()
      ->condition('id', '2')
      ->condition('label', $this->entities[0]->label);
    $and_condition_2 = $query->orConditionGroup()
      ->condition('id', 1)
      ->condition('label', $this->entities[3]->label);
    $this->queryResults = $query
      ->condition('number', 53)
      ->condition($and_condition_1)
      ->condition($and_condition_2)
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('1', '2', '4', '5'));
=======
    $this->assertResults(['1', '2', '4', '5']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Test the exists and notExists conditions.
    $this->queryResults = $this->factory->get('config_query_test')
      ->exists('id')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('1', '2', '3', '4', '5'));
=======
    $this->assertResults(['1', '2', '3', '4', '5']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->queryResults = $this->factory->get('config_query_test')
      ->exists('non-existent')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array());
=======
    $this->assertResults([]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->queryResults = $this->factory->get('config_query_test')
      ->notExists('id')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array());
=======
    $this->assertResults([]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->queryResults = $this->factory->get('config_query_test')
      ->notExists('non-existent')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('1', '2', '3', '4', '5'));
=======
    $this->assertResults(['1', '2', '3', '4', '5']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests ID conditions.
   */
  public function testStringIdConditions() {
    // We need an entity with a non-numeric ID.
<<<<<<< HEAD
    $entity = ConfigQueryTest::create(array(
      'label' => $this->randomMachineName(),
      'id' => 'foo.bar',
    ));
=======
    $entity = ConfigQueryTest::create([
      'label' => $this->randomMachineName(),
      'id' => 'foo.bar',
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->entities[] = $entity;
    $entity->enforceIsNew();
    $entity->save();

    // Test 'STARTS_WITH' condition.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', 'foo.bar', 'STARTS_WITH')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('foo.bar'));
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', 'f', 'STARTS_WITH')
      ->execute();
    $this->assertResults(array('foo.bar'));
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', 'miss', 'STARTS_WITH')
      ->execute();
    $this->assertResults(array());
=======
    $this->assertResults(['foo.bar']);
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', 'f', 'STARTS_WITH')
      ->execute();
    $this->assertResults(['foo.bar']);
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', 'miss', 'STARTS_WITH')
      ->execute();
    $this->assertResults([]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Test 'CONTAINS' condition.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', 'foo.bar', 'CONTAINS')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('foo.bar'));
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', 'oo.ba', 'CONTAINS')
      ->execute();
    $this->assertResults(array('foo.bar'));
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', 'miss', 'CONTAINS')
      ->execute();
    $this->assertResults(array());
=======
    $this->assertResults(['foo.bar']);
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', 'oo.ba', 'CONTAINS')
      ->execute();
    $this->assertResults(['foo.bar']);
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', 'miss', 'CONTAINS')
      ->execute();
    $this->assertResults([]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Test 'ENDS_WITH' condition.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', 'foo.bar', 'ENDS_WITH')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('foo.bar'));
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', 'r', 'ENDS_WITH')
      ->execute();
    $this->assertResults(array('foo.bar'));
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', 'miss', 'ENDS_WITH')
      ->execute();
    $this->assertResults(array());
=======
    $this->assertResults(['foo.bar']);
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', 'r', 'ENDS_WITH')
      ->execute();
    $this->assertResults(['foo.bar']);
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', 'miss', 'ENDS_WITH')
      ->execute();
    $this->assertResults([]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests count query.
   */
  public function testCount() {
    // Test count on no conditions.
    $count = $this->factory->get('config_query_test')
      ->count()
      ->execute();
    $this->assertIdentical($count, count($this->entities));

    // Test count on a complex query.
    $query = $this->factory->get('config_query_test', 'OR');
    $and_condition_1 = $query->andConditionGroup()
      ->condition('id', 1)
      ->condition('label', $this->entities[0]->label);
    $and_condition_2 = $query->andConditionGroup()
      ->condition('id', '2')
      ->condition('label', $this->entities[1]->label);
    $count = $query
      ->condition($and_condition_1)
      ->condition($and_condition_2)
      ->count()
      ->execute();
    $this->assertIdentical($count, 2);
  }

  /**
   * Tests sorting and range on config entity queries.
   */
  public function testSortRange() {
    // Sort by simple ascending/descending.
    $this->queryResults = $this->factory->get('config_query_test')
      ->sort('number', 'DESC')
      ->execute();
<<<<<<< HEAD
    $this->assertIdentical(array_values($this->queryResults), array('3', '5', '2', '1', '4'));
=======
    $this->assertIdentical(array_values($this->queryResults), ['3', '5', '2', '1', '4']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->queryResults = $this->factory->get('config_query_test')
      ->sort('number', 'ASC')
      ->execute();
<<<<<<< HEAD
    $this->assertIdentical(array_values($this->queryResults), array('4', '1', '2', '5', '3'));
=======
    $this->assertIdentical(array_values($this->queryResults), ['4', '1', '2', '5', '3']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Apply some filters and sort.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', '3', '>')
      ->sort('number', 'DESC')
      ->execute();
<<<<<<< HEAD
    $this->assertIdentical(array_values($this->queryResults), array('5', '4'));
=======
    $this->assertIdentical(array_values($this->queryResults), ['5', '4']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('id', '3', '>')
      ->sort('number', 'ASC')
      ->execute();
<<<<<<< HEAD
    $this->assertIdentical(array_values($this->queryResults), array('4', '5'));
=======
    $this->assertIdentical(array_values($this->queryResults), ['4', '5']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Apply a pager and sort.
    $this->queryResults = $this->factory->get('config_query_test')
      ->sort('number', 'DESC')
      ->range('2', '2')
      ->execute();
<<<<<<< HEAD
    $this->assertIdentical(array_values($this->queryResults), array('2', '1'));
=======
    $this->assertIdentical(array_values($this->queryResults), ['2', '1']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->queryResults = $this->factory->get('config_query_test')
      ->sort('number', 'ASC')
      ->range('2', '2')
      ->execute();
<<<<<<< HEAD
    $this->assertIdentical(array_values($this->queryResults), array('2', '5'));
=======
    $this->assertIdentical(array_values($this->queryResults), ['2', '5']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Add a range to a query without a start parameter.
    $this->queryResults = $this->factory->get('config_query_test')
      ->range(0, '3')
      ->sort('id', 'ASC')
      ->execute();
<<<<<<< HEAD
    $this->assertIdentical(array_values($this->queryResults), array('1', '2', '3'));
=======
    $this->assertIdentical(array_values($this->queryResults), ['1', '2', '3']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Apply a pager with limit 4.
    $this->queryResults = $this->factory->get('config_query_test')
      ->pager('4', 0)
      ->sort('id', 'ASC')
      ->execute();
<<<<<<< HEAD
    $this->assertIdentical(array_values($this->queryResults), array('1', '2', '3', '4'));
=======
    $this->assertIdentical(array_values($this->queryResults), ['1', '2', '3', '4']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests sorting with tableSort on config entity queries.
   */
  public function testTableSort() {
<<<<<<< HEAD
    $header = array(
      array('data' => t('ID'), 'specifier' => 'id'),
      array('data' => t('Number'), 'specifier' => 'number'),
    );
=======
    $header = [
      ['data' => t('ID'), 'specifier' => 'id'],
      ['data' => t('Number'), 'specifier' => 'number'],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Sort key: id
    // Sorting with 'DESC' upper case
    $this->queryResults = $this->factory->get('config_query_test')
      ->tableSort($header)
      ->sort('id', 'DESC')
      ->execute();
<<<<<<< HEAD
    $this->assertIdentical(array_values($this->queryResults), array('5', '4', '3', '2', '1'));
=======
    $this->assertIdentical(array_values($this->queryResults), ['5', '4', '3', '2', '1']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Sorting with 'ASC' upper case
    $this->queryResults = $this->factory->get('config_query_test')
      ->tableSort($header)
      ->sort('id', 'ASC')
      ->execute();
<<<<<<< HEAD
    $this->assertIdentical(array_values($this->queryResults), array('1', '2', '3', '4', '5'));
=======
    $this->assertIdentical(array_values($this->queryResults), ['1', '2', '3', '4', '5']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Sorting with 'desc' lower case
    $this->queryResults = $this->factory->get('config_query_test')
      ->tableSort($header)
      ->sort('id', 'desc')
      ->execute();
<<<<<<< HEAD
    $this->assertIdentical(array_values($this->queryResults), array('5', '4', '3', '2', '1'));
=======
    $this->assertIdentical(array_values($this->queryResults), ['5', '4', '3', '2', '1']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Sorting with 'asc' lower case
    $this->queryResults = $this->factory->get('config_query_test')
      ->tableSort($header)
      ->sort('id', 'asc')
      ->execute();
<<<<<<< HEAD
    $this->assertIdentical(array_values($this->queryResults), array('1', '2', '3', '4', '5'));
=======
    $this->assertIdentical(array_values($this->queryResults), ['1', '2', '3', '4', '5']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Sort key: number
    // Sorting with 'DeSc' mixed upper and lower case
    $this->queryResults = $this->factory->get('config_query_test')
      ->tableSort($header)
      ->sort('number', 'DeSc')
      ->execute();
<<<<<<< HEAD
    $this->assertIdentical(array_values($this->queryResults), array('3', '5', '2', '1', '4'));
=======
    $this->assertIdentical(array_values($this->queryResults), ['3', '5', '2', '1', '4']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Sorting with 'AsC' mixed upper and lower case
    $this->queryResults = $this->factory->get('config_query_test')
      ->tableSort($header)
      ->sort('number', 'AsC')
      ->execute();
<<<<<<< HEAD
    $this->assertIdentical(array_values($this->queryResults), array('4', '1', '2', '5', '3'));
=======
    $this->assertIdentical(array_values($this->queryResults), ['4', '1', '2', '5', '3']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Sorting with 'dEsC' mixed upper and lower case
    $this->queryResults = $this->factory->get('config_query_test')
      ->tableSort($header)
      ->sort('number', 'dEsC')
      ->execute();
<<<<<<< HEAD
    $this->assertIdentical(array_values($this->queryResults), array('3', '5', '2', '1', '4'));
=======
    $this->assertIdentical(array_values($this->queryResults), ['3', '5', '2', '1', '4']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Sorting with 'aSc' mixed upper and lower case
    $this->queryResults = $this->factory->get('config_query_test')
      ->tableSort($header)
      ->sort('number', 'aSc')
      ->execute();
<<<<<<< HEAD
    $this->assertIdentical(array_values($this->queryResults), array('4', '1', '2', '5', '3'));
=======
    $this->assertIdentical(array_values($this->queryResults), ['4', '1', '2', '5', '3']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests dotted path matching.
   */
  public function testDotted() {
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('array.level1.*', 1)
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('1', '3'));
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('*.level1.level2', 2)
      ->execute();
    $this->assertResults(array('2', '4'));
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('array.level1.*', 3)
      ->execute();
    $this->assertResults(array('5'));
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('array.level1.level2', 3)
      ->execute();
    $this->assertResults(array('5'));
=======
    $this->assertResults(['1', '3']);
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('*.level1.level2', 2)
      ->execute();
    $this->assertResults(['2', '4']);
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('array.level1.*', 3)
      ->execute();
    $this->assertResults(['5']);
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('array.level1.level2', 3)
      ->execute();
    $this->assertResults(['5']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Make sure that values on the wildcard level do not match if there are
    // sub-keys defined. This must not find anything even if entity 2 has a
    // top-level key number with value 41.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('*.level1.level2', 41)
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array());
=======
    $this->assertResults([]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests case sensitivity.
   */
  public function testCaseSensitivity() {
    // Filter by label with a known containing case-sensitive word.
    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('label', 'TEST', 'CONTAINS')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('3', '4', '5'));
=======
    $this->assertResults(['3', '4', '5']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->queryResults = $this->factory->get('config_query_test')
      ->condition('label', 'test', 'CONTAINS')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array('3', '4', '5'));
=======
    $this->assertResults(['3', '4', '5']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests lookup keys are added to the key value store.
   */
  public function testLookupKeys() {
    \Drupal::service('state')->set('config_test.lookup_keys', TRUE);
    \Drupal::entityManager()->clearCachedDefinitions();
    $key_value = $this->container->get('keyvalue')->get(QueryFactory::CONFIG_LOOKUP_PREFIX . 'config_test');

    $test_entities = [];
<<<<<<< HEAD
    $entity = entity_create('config_test', array(
      'label' => $this->randomMachineName(),
      'id' => '1',
      'style' => 'test',
    ));
=======
    $entity = entity_create('config_test', [
      'label' => $this->randomMachineName(),
      'id' => '1',
      'style' => 'test',
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $test_entities[$entity->getConfigDependencyName()] = $entity;
    $entity->enforceIsNew();
    $entity->save();


    $expected[] = $entity->getConfigDependencyName();
    $this->assertEqual($expected, $key_value->get('style:test'));

<<<<<<< HEAD
    $entity = entity_create('config_test', array(
      'label' => $this->randomMachineName(),
      'id' => '2',
      'style' => 'test',
    ));
=======
    $entity = entity_create('config_test', [
      'label' => $this->randomMachineName(),
      'id' => '2',
      'style' => 'test',
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $test_entities[$entity->getConfigDependencyName()] = $entity;
    $entity->enforceIsNew();
    $entity->save();
    $expected[] = $entity->getConfigDependencyName();
    $this->assertEqual($expected, $key_value->get('style:test'));

<<<<<<< HEAD
    $entity = entity_create('config_test', array(
      'label' => $this->randomMachineName(),
      'id' => '3',
      'style' => 'blah',
    ));
=======
    $entity = entity_create('config_test', [
      'label' => $this->randomMachineName(),
      'id' => '3',
      'style' => 'blah',
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $entity->enforceIsNew();
    $entity->save();
    // Do not add this entity to the list of expected result as it has a
    // different value.
    $this->assertEqual($expected, $key_value->get('style:test'));
    $this->assertEqual([$entity->getConfigDependencyName()], $key_value->get('style:blah'));

    // Ensure that a delete clears a key.
    $entity->delete();
    $this->assertEqual(NULL, $key_value->get('style:blah'));

    // Ensure that delete only clears one key.
    $entity_id = array_pop($expected);
    $test_entities[$entity_id]->delete();
    $this->assertEqual($expected, $key_value->get('style:test'));
    $entity_id = array_pop($expected);
    $test_entities[$entity_id]->delete();
    $this->assertEqual(NULL, $key_value->get('style:test'));
  }

  /**
   * Asserts the results as expected regardless of order.
   *
   * @param array $expected
   *   Array of expected entity IDs.
   */
  protected function assertResults($expected) {
    $this->assertIdentical(count($this->queryResults), count($expected));
    foreach ($expected as $value) {
      // This also tests whether $this->queryResults[$value] is even set at all.
      $this->assertIdentical($this->queryResults[$value], $value);
    }
  }

}
