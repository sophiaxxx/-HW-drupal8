<?php

namespace Drupal\KernelTests\Core\Entity;

use Drupal\field\Entity\FieldConfig;
use Drupal\field\Entity\FieldStorageConfig;

/**
 * Tests the Entity Query Aggregation API.
 *
 * @group Entity
 * @see \Drupal\entity_test\Entity\EntityTest
 */
class EntityQueryAggregateTest extends EntityKernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array();
=======
  public static $modules = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * The entity_test storage to create the test entities.
   *
   * @var \Drupal\entity_test\EntityTestStorage
   */
  protected $entityStorage;

  /**
   * The actual query result, to compare later.
   *
   * @var array
   */
  protected $queryResult;

  /**
   * The query factory to create entity queries.
   *
   * @var \Drupal\Core\Entity\Query\QueryFactory
   */
  public $factory;

  protected function setUp() {
    parent::setUp();

    $this->entityStorage = $this->entityManager->getStorage('entity_test');
    $this->factory = $this->container->get('entity.query');

    // Add some fieldapi fields to be used in the test.
    for ($i = 1; $i <= 2; $i++) {
      $field_name = 'field_test_' . $i;
<<<<<<< HEAD
      FieldStorageConfig::create(array(
=======
      FieldStorageConfig::create([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'field_name' => $field_name,
        'entity_type' => 'entity_test',
        'type' => 'integer',
        'cardinality' => 2,
<<<<<<< HEAD
      ))->save();
=======
      ])->save();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      FieldConfig::create([
        'field_name' => $field_name,
        'entity_type' => 'entity_test',
        'bundle' => 'entity_test',
      ])->save();
    }

<<<<<<< HEAD
    $entity = $this->entityStorage->create(array(
=======
    $entity = $this->entityStorage->create([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'id' => 1,
      'user_id' => 1,
      'field_test_1' => 1,
      'field_test_2' => 2,
<<<<<<< HEAD
    ));
    $entity->enforceIsNew();
    $entity->save();

    $entity = $this->entityStorage->create(array(
=======
    ]);
    $entity->enforceIsNew();
    $entity->save();

    $entity = $this->entityStorage->create([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'id' => 2,
      'user_id' => 2,
      'field_test_1' => 1,
      'field_test_2' => 7,
<<<<<<< HEAD
    ));
    $entity->enforceIsNew();
    $entity->save();
    $entity = $this->entityStorage->create(array(
=======
    ]);
    $entity->enforceIsNew();
    $entity->save();
    $entity = $this->entityStorage->create([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'id' => 3,
      'user_id' => 2,
      'field_test_1' => 2,
      'field_test_2' => 1,
<<<<<<< HEAD
    ));
    $entity->enforceIsNew();
    $entity->save();
    $entity = $this->entityStorage->create(array(
=======
    ]);
    $entity->enforceIsNew();
    $entity->save();
    $entity = $this->entityStorage->create([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'id' => 4,
      'user_id' => 2,
      'field_test_1' => 2,
      'field_test_2' => 8,
<<<<<<< HEAD
    ));
    $entity->enforceIsNew();
    $entity->save();
    $entity = $this->entityStorage->create(array(
=======
    ]);
    $entity->enforceIsNew();
    $entity->save();
    $entity = $this->entityStorage->create([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'id' => 5,
      'user_id' => 3,
      'field_test_1' => 2,
      'field_test_2' => 2,
<<<<<<< HEAD
    ));
    $entity->enforceIsNew();
    $entity->save();
    $entity = $this->entityStorage->create(array(
=======
    ]);
    $entity->enforceIsNew();
    $entity->save();
    $entity = $this->entityStorage->create([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'id' => 6,
      'user_id' => 3,
      'field_test_1' => 3,
      'field_test_2' => 8,
<<<<<<< HEAD
    ));
=======
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $entity->enforceIsNew();
    $entity->save();

  }

  /**
   * Test aggregation support.
   */
  public function testAggregation() {
    // Apply a simple groupby.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->groupBy('user_id')
      ->execute();

<<<<<<< HEAD
    $this->assertResults(array(
      array('user_id' => 1),
      array('user_id' => 2),
      array('user_id' => 3),
    ));

    $function_expected = array();
    $function_expected['count'] = array(array('id_count' => 6));
    $function_expected['min'] = array(array('id_min' => 1));
    $function_expected['max'] = array(array('id_max' => 6));
    $function_expected['sum'] = array(array('id_sum' => 21));
    $function_expected['avg'] = array(array('id_avg' => (21.0 / 6.0)));
=======
    $this->assertResults([
      ['user_id' => 1],
      ['user_id' => 2],
      ['user_id' => 3],
    ]);

    $function_expected = [];
    $function_expected['count'] = [['id_count' => 6]];
    $function_expected['min'] = [['id_min' => 1]];
    $function_expected['max'] = [['id_max' => 6]];
    $function_expected['sum'] = [['id_sum' => 21]];
    $function_expected['avg'] = [['id_avg' => (21.0 / 6.0)]];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Apply a simple aggregation for different aggregation functions.
    foreach ($function_expected as $aggregation_function => $expected) {
      $this->queryResult = $this->factory->getAggregate('entity_test')
        ->aggregate('id', $aggregation_function)
        ->execute();
      $this->assertEqual($this->queryResult, $expected);
    }

    // Apply aggregation and groupby on the same query.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->aggregate('id', 'COUNT')
      ->groupBy('user_id')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array(
      array('user_id' => 1, 'id_count' => 1),
      array('user_id' => 2, 'id_count' => 3),
      array('user_id' => 3, 'id_count' => 2),
    ));
=======
    $this->assertResults([
      ['user_id' => 1, 'id_count' => 1],
      ['user_id' => 2, 'id_count' => 3],
      ['user_id' => 3, 'id_count' => 2],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Apply aggregation and a condition which matches.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->aggregate('id', 'COUNT')
      ->groupBy('id')
      ->conditionAggregate('id', 'COUNT', 8)
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array());
=======
    $this->assertResults([]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Don't call aggregate to test the implicit aggregate call.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->groupBy('id')
      ->conditionAggregate('id', 'COUNT', 8)
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array());
=======
    $this->assertResults([]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Apply aggregation and a condition which matches.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->aggregate('id', 'count')
      ->groupBy('id')
      ->conditionAggregate('id', 'COUNT', 6)
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array(array('id_count' => 6)));
=======
    $this->assertResults([['id_count' => 6]]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Apply aggregation, a groupby and a condition which matches partially via
    // the operator '='.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->aggregate('id', 'count')
      ->conditionAggregate('id', 'count', 2)
      ->groupBy('user_id')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array(array('id_count' => 2, 'user_id' => 3)));
=======
    $this->assertResults([['id_count' => 2, 'user_id' => 3]]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Apply aggregation, a groupby and a condition which matches partially via
    // the operator '>'.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->aggregate('id', 'count')
      ->conditionAggregate('id', 'COUNT', 1, '>')
      ->groupBy('user_id')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array(
      array('id_count' => 2, 'user_id' => 3),
      array('id_count' => 3, 'user_id' => 2),
    ));
=======
    $this->assertResults([
      ['id_count' => 2, 'user_id' => 3],
      ['id_count' => 3, 'user_id' => 2],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Apply aggregation and a sort. This might not be useful, but have a proper
    // test coverage.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->aggregate('id', 'COUNT')
      ->sortAggregate('id', 'COUNT')
      ->execute();
<<<<<<< HEAD
    $this->assertSortedResults(array(array('id_count' => 6)));
=======
    $this->assertSortedResults([['id_count' => 6]]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Don't call aggregate to test the implicit aggregate call.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->sortAggregate('id', 'COUNT')
      ->execute();
<<<<<<< HEAD
    $this->assertSortedResults(array(array('id_count' => 6)));
=======
    $this->assertSortedResults([['id_count' => 6]]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Apply aggregation, groupby and a sort descending.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->aggregate('id', 'COUNT')
      ->groupBy('user_id')
      ->sortAggregate('id', 'COUNT', 'DESC')
      ->execute();
<<<<<<< HEAD
    $this->assertSortedResults(array(
      array('user_id' => 2, 'id_count' => 3),
      array('user_id' => 3, 'id_count' => 2),
      array('user_id' => 1, 'id_count' => 1),
    ));
=======
    $this->assertSortedResults([
      ['user_id' => 2, 'id_count' => 3],
      ['user_id' => 3, 'id_count' => 2],
      ['user_id' => 1, 'id_count' => 1],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Apply aggregation, groupby and a sort ascending.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->aggregate('id', 'COUNT')
      ->groupBy('user_id')
      ->sortAggregate('id', 'COUNT', 'ASC')
      ->execute();
<<<<<<< HEAD
    $this->assertSortedResults(array(
      array('user_id' => 1, 'id_count' => 1),
      array('user_id' => 3, 'id_count' => 2),
      array('user_id' => 2, 'id_count' => 3),
    ));
=======
    $this->assertSortedResults([
      ['user_id' => 1, 'id_count' => 1],
      ['user_id' => 3, 'id_count' => 2],
      ['user_id' => 2, 'id_count' => 3],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Apply aggregation, groupby, an aggregation condition and a sort with the
    // operator '='.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->aggregate('id', 'COUNT')
      ->groupBy('user_id')
      ->sortAggregate('id', 'COUNT')
      ->conditionAggregate('id', 'COUNT', 2)
      ->execute();
<<<<<<< HEAD
    $this->assertSortedResults(array(array('id_count' => 2, 'user_id' => 3)));
=======
    $this->assertSortedResults([['id_count' => 2, 'user_id' => 3]]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Apply aggregation, groupby, an aggregation condition and a sort with the
    // operator '<' and order ASC.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->aggregate('id', 'COUNT')
      ->groupBy('user_id')
      ->sortAggregate('id', 'COUNT', 'ASC')
      ->conditionAggregate('id', 'COUNT', 3, '<')
      ->execute();
<<<<<<< HEAD
    $this->assertSortedResults(array(
      array('id_count' => 1, 'user_id' => 1),
      array('id_count' => 2, 'user_id' => 3),
    ));
=======
    $this->assertSortedResults([
      ['id_count' => 1, 'user_id' => 1],
      ['id_count' => 2, 'user_id' => 3],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Apply aggregation, groupby, an aggregation condition and a sort with the
    // operator '<' and order DESC.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->aggregate('id', 'COUNT')
      ->groupBy('user_id')
      ->sortAggregate('id', 'COUNT', 'DESC')
      ->conditionAggregate('id', 'COUNT', 3, '<')
      ->execute();
<<<<<<< HEAD
    $this->assertSortedResults(array(
      array('id_count' => 2, 'user_id' => 3),
      array('id_count' => 1, 'user_id' => 1),
    ));
=======
    $this->assertSortedResults([
      ['id_count' => 2, 'user_id' => 3],
      ['id_count' => 1, 'user_id' => 1],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Test aggregation/groupby support for fieldapi fields.

    // Just group by a fieldapi field.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->groupBy('field_test_1')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array(
      array('field_test_1' => 1),
      array('field_test_1' => 2),
      array('field_test_1' => 3),
    ));
=======
    $this->assertResults([
      ['field_test_1' => 1],
      ['field_test_1' => 2],
      ['field_test_1' => 3],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Group by a fieldapi field and aggregate a normal property.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->aggregate('user_id', 'COUNT')
      ->groupBy('field_test_1')
      ->execute();

<<<<<<< HEAD
    $this->assertResults(array(
      array('field_test_1' => 1, 'user_id_count' => 2),
      array('field_test_1' => 2, 'user_id_count' => 3),
      array('field_test_1' => 3, 'user_id_count' => 1),
    ));
=======
    $this->assertResults([
      ['field_test_1' => 1, 'user_id_count' => 2],
      ['field_test_1' => 2, 'user_id_count' => 3],
      ['field_test_1' => 3, 'user_id_count' => 1],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Group by a normal property and aggregate a fieldapi field.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->aggregate('field_test_1', 'COUNT')
      ->groupBy('user_id')
      ->execute();

<<<<<<< HEAD
    $this->assertResults(array(
      array('user_id' => 1, 'field_test_1_count' => 1),
      array('user_id' => 2, 'field_test_1_count' => 3),
      array('user_id' => 3, 'field_test_1_count' => 2),
    ));
=======
    $this->assertResults([
      ['user_id' => 1, 'field_test_1_count' => 1],
      ['user_id' => 2, 'field_test_1_count' => 3],
      ['user_id' => 3, 'field_test_1_count' => 2],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->aggregate('field_test_1', 'SUM')
      ->groupBy('user_id')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array(
      array('user_id' => 1, 'field_test_1_sum' => 1),
      array('user_id' => 2, 'field_test_1_sum' => 5),
      array('user_id' => 3, 'field_test_1_sum' => 5),
    ));
=======
    $this->assertResults([
      ['user_id' => 1, 'field_test_1_sum' => 1],
      ['user_id' => 2, 'field_test_1_sum' => 5],
      ['user_id' => 3, 'field_test_1_sum' => 5],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Aggregate by two different fieldapi fields.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->aggregate('field_test_1', 'SUM')
      ->aggregate('field_test_2', 'SUM')
      ->groupBy('user_id')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array(
      array('user_id' => 1, 'field_test_1_sum' => 1, 'field_test_2_sum' => 2),
      array('user_id' => 2, 'field_test_1_sum' => 5, 'field_test_2_sum' => 16),
      array('user_id' => 3, 'field_test_1_sum' => 5, 'field_test_2_sum' => 10),
    ));
=======
    $this->assertResults([
      ['user_id' => 1, 'field_test_1_sum' => 1, 'field_test_2_sum' => 2],
      ['user_id' => 2, 'field_test_1_sum' => 5, 'field_test_2_sum' => 16],
      ['user_id' => 3, 'field_test_1_sum' => 5, 'field_test_2_sum' => 10],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // This time aggregate the same field twice.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->aggregate('field_test_1', 'SUM')
      ->aggregate('field_test_1', 'COUNT')
      ->groupBy('user_id')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array(
      array('user_id' => 1, 'field_test_1_sum' => 1, 'field_test_1_count' => 1),
      array('user_id' => 2, 'field_test_1_sum' => 5, 'field_test_1_count' => 3),
      array('user_id' => 3, 'field_test_1_sum' => 5, 'field_test_1_count' => 2),
    ));
=======
    $this->assertResults([
      ['user_id' => 1, 'field_test_1_sum' => 1, 'field_test_1_count' => 1],
      ['user_id' => 2, 'field_test_1_sum' => 5, 'field_test_1_count' => 3],
      ['user_id' => 3, 'field_test_1_sum' => 5, 'field_test_1_count' => 2],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Group by and aggregate by a fieldapi field.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->groupBy('field_test_1')
      ->aggregate('field_test_2', 'COUNT')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array(
      array('field_test_1' => 1, 'field_test_2_count' => 2),
      array('field_test_1' => 2, 'field_test_2_count' => 3),
      array('field_test_1' => 3, 'field_test_2_count' => 1),
    ));
=======
    $this->assertResults([
      ['field_test_1' => 1, 'field_test_2_count' => 2],
      ['field_test_1' => 2, 'field_test_2_count' => 3],
      ['field_test_1' => 3, 'field_test_2_count' => 1],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Group by and aggregate by a fieldapi field and use multiple aggregate
    // functions.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->groupBy('field_test_1')
      ->aggregate('field_test_2', 'COUNT')
      ->aggregate('field_test_2', 'SUM')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array(
      array('field_test_1' => 1, 'field_test_2_count' => 2, 'field_test_2_sum' => 9),
      array('field_test_1' => 2, 'field_test_2_count' => 3, 'field_test_2_sum' => 11),
      array('field_test_1' => 3, 'field_test_2_count' => 1, 'field_test_2_sum' => 8),
    ));
=======
    $this->assertResults([
      ['field_test_1' => 1, 'field_test_2_count' => 2, 'field_test_2_sum' => 9],
      ['field_test_1' => 2, 'field_test_2_count' => 3, 'field_test_2_sum' => 11],
      ['field_test_1' => 3, 'field_test_2_count' => 1, 'field_test_2_sum' => 8],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Apply an aggregate condition for a fieldapi field and group by a simple
    // property.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->conditionAggregate('field_test_1', 'COUNT', 3)
      ->groupBy('user_id')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array(
      array('user_id' => 2, 'field_test_1_count' => 3),
      array('user_id' => 3, 'field_test_1_count' => 2),
    ));
=======
    $this->assertResults([
      ['user_id' => 2, 'field_test_1_count' => 3],
      ['user_id' => 3, 'field_test_1_count' => 2],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->aggregate('field_test_1', 'SUM')
      ->conditionAggregate('field_test_1', 'COUNT', 2, '>')
      ->groupBy('user_id')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array(
      array('user_id' => 2, 'field_test_1_sum' => 5, 'field_test_1_count' => 3),
      array('user_id' => 3, 'field_test_1_sum' => 5, 'field_test_1_count' => 2),
    ));
=======
    $this->assertResults([
      ['user_id' => 2, 'field_test_1_sum' => 5, 'field_test_1_count' => 3],
      ['user_id' => 3, 'field_test_1_sum' => 5, 'field_test_1_count' => 2],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Apply an aggregate condition for a simple property and a group by a
    // fieldapi field.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->conditionAggregate('user_id', 'COUNT', 2)
      ->groupBy('field_test_1')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array(
      array('field_test_1' => 1, 'user_id_count' => 2),
    ));
=======
    $this->assertResults([
      ['field_test_1' => 1, 'user_id_count' => 2],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->conditionAggregate('user_id', 'COUNT', 2, '>')
      ->groupBy('field_test_1')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array(
      array('field_test_1' => 1, 'user_id_count' => 2),
      array('field_test_1' => 2, 'user_id_count' => 3),
    ));
=======
    $this->assertResults([
      ['field_test_1' => 1, 'user_id_count' => 2],
      ['field_test_1' => 2, 'user_id_count' => 3],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Apply an aggregate condition and a group by fieldapi fields.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->groupBy('field_test_1')
      ->conditionAggregate('field_test_2', 'COUNT', 2)
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array(
      array('field_test_1' => 1, 'field_test_2_count' => 2),
    ));
=======
    $this->assertResults([
      ['field_test_1' => 1, 'field_test_2_count' => 2],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->groupBy('field_test_1')
      ->conditionAggregate('field_test_2', 'COUNT', 2, '>')
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array(
      array('field_test_1' => 1, 'field_test_2_count' => 2),
      array('field_test_1' => 2, 'field_test_2_count' => 3),
    ));
=======
    $this->assertResults([
      ['field_test_1' => 1, 'field_test_2_count' => 2],
      ['field_test_1' => 2, 'field_test_2_count' => 3],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Apply an aggregate condition and a group by fieldapi fields with multiple
    // conditions via AND.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->groupBy('field_test_1')
      ->conditionAggregate('field_test_2', 'COUNT', 2)
      ->conditionAggregate('field_test_2', 'SUM', 8)
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array());
=======
    $this->assertResults([]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Apply an aggregate condition and a group by fieldapi fields with multiple
    // conditions via OR.
    $this->queryResult = $this->factory->getAggregate('entity_test', 'OR')
      ->groupBy('field_test_1')
      ->conditionAggregate('field_test_2', 'COUNT', 2)
      ->conditionAggregate('field_test_2', 'SUM', 8)
      ->execute();
<<<<<<< HEAD
    $this->assertResults(array(
      array('field_test_1' => 1, 'field_test_2_count' => 2, 'field_test_2_sum' => 9),
      array('field_test_1' => 3, 'field_test_2_count' => 1, 'field_test_2_sum' => 8),
    ));
=======
    $this->assertResults([
      ['field_test_1' => 1, 'field_test_2_count' => 2, 'field_test_2_sum' => 9],
      ['field_test_1' => 3, 'field_test_2_count' => 1, 'field_test_2_sum' => 8],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Group by a normal property and aggregate a fieldapi field and sort by the
    // groupby field.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->aggregate('field_test_1', 'COUNT')
      ->groupBy('user_id')
      ->sort('user_id', 'DESC')
      ->execute();
<<<<<<< HEAD
    $this->assertSortedResults(array(
      array('user_id' => 3, 'field_test_1_count' => 2),
      array('user_id' => 2, 'field_test_1_count' => 3),
      array('user_id' => 1, 'field_test_1_count' => 1),
    ));
=======
    $this->assertSortedResults([
      ['user_id' => 3, 'field_test_1_count' => 2],
      ['user_id' => 2, 'field_test_1_count' => 3],
      ['user_id' => 1, 'field_test_1_count' => 1],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->aggregate('field_test_1', 'COUNT')
      ->groupBy('user_id')
      ->sort('user_id', 'ASC')
      ->execute();
<<<<<<< HEAD
    $this->assertSortedResults(array(
      array('user_id' => 1, 'field_test_1_count' => 1),
      array('user_id' => 2, 'field_test_1_count' => 3),
      array('user_id' => 3, 'field_test_1_count' => 2),
    ));
=======
    $this->assertSortedResults([
      ['user_id' => 1, 'field_test_1_count' => 1],
      ['user_id' => 2, 'field_test_1_count' => 3],
      ['user_id' => 3, 'field_test_1_count' => 2],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->conditionAggregate('field_test_1', 'COUNT', 2, '>')
      ->groupBy('user_id')
      ->sort('user_id', 'ASC')
      ->execute();
<<<<<<< HEAD
    $this->assertSortedResults(array(
      array('user_id' => 2, 'field_test_1_count' => 3),
      array('user_id' => 3, 'field_test_1_count' => 2),
    ));
=======
    $this->assertSortedResults([
      ['user_id' => 2, 'field_test_1_count' => 3],
      ['user_id' => 3, 'field_test_1_count' => 2],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Group by a normal property, aggregate a fieldapi field, and sort by the
    // aggregated field.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->sortAggregate('field_test_1', 'COUNT', 'DESC')
      ->groupBy('user_id')
      ->execute();
<<<<<<< HEAD
    $this->assertSortedResults(array(
      array('user_id' => 2, 'field_test_1_count' => 3),
      array('user_id' => 3, 'field_test_1_count' => 2),
      array('user_id' => 1, 'field_test_1_count' => 1),
    ));
=======
    $this->assertSortedResults([
      ['user_id' => 2, 'field_test_1_count' => 3],
      ['user_id' => 3, 'field_test_1_count' => 2],
      ['user_id' => 1, 'field_test_1_count' => 1],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->sortAggregate('field_test_1', 'COUNT', 'ASC')
      ->groupBy('user_id')
      ->execute();
<<<<<<< HEAD
    $this->assertSortedResults(array(
      array('user_id' => 1, 'field_test_1_count' => 1),
      array('user_id' => 3, 'field_test_1_count' => 2),
      array('user_id' => 2, 'field_test_1_count' => 3),
    ));
=======
    $this->assertSortedResults([
      ['user_id' => 1, 'field_test_1_count' => 1],
      ['user_id' => 3, 'field_test_1_count' => 2],
      ['user_id' => 2, 'field_test_1_count' => 3],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Group by and aggregate by fieldapi field, and sort by the groupby field.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->groupBy('field_test_1')
      ->aggregate('field_test_2', 'COUNT')
      ->sort('field_test_1', 'ASC')
      ->execute();
<<<<<<< HEAD
    $this->assertSortedResults(array(
      array('field_test_1' => 1, 'field_test_2_count' => 2),
      array('field_test_1' => 2, 'field_test_2_count' => 3),
      array('field_test_1' => 3, 'field_test_2_count' => 1),
    ));
=======
    $this->assertSortedResults([
      ['field_test_1' => 1, 'field_test_2_count' => 2],
      ['field_test_1' => 2, 'field_test_2_count' => 3],
      ['field_test_1' => 3, 'field_test_2_count' => 1],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->groupBy('field_test_1')
      ->aggregate('field_test_2', 'COUNT')
      ->sort('field_test_1', 'DESC')
      ->execute();
<<<<<<< HEAD
    $this->assertSortedResults(array(
      array('field_test_1' => 3, 'field_test_2_count' => 1),
      array('field_test_1' => 2, 'field_test_2_count' => 3),
      array('field_test_1' => 1, 'field_test_2_count' => 2),
    ));
=======
    $this->assertSortedResults([
      ['field_test_1' => 3, 'field_test_2_count' => 1],
      ['field_test_1' => 2, 'field_test_2_count' => 3],
      ['field_test_1' => 1, 'field_test_2_count' => 2],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Groupby and aggregate by fieldapi field, and sort by the aggregated
    // field.
    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->groupBy('field_test_1')
      ->sortAggregate('field_test_2', 'COUNT', 'DESC')
      ->execute();
<<<<<<< HEAD
    $this->assertSortedResults(array(
      array('field_test_1' => 2, 'field_test_2_count' => 3),
      array('field_test_1' => 1, 'field_test_2_count' => 2),
      array('field_test_1' => 3, 'field_test_2_count' => 1),
    ));
=======
    $this->assertSortedResults([
      ['field_test_1' => 2, 'field_test_2_count' => 3],
      ['field_test_1' => 1, 'field_test_2_count' => 2],
      ['field_test_1' => 3, 'field_test_2_count' => 1],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->queryResult = $this->factory->getAggregate('entity_test')
      ->groupBy('field_test_1')
      ->sortAggregate('field_test_2', 'COUNT', 'ASC')
      ->execute();
<<<<<<< HEAD
    $this->assertSortedResults(array(
      array('field_test_1' => 3, 'field_test_2_count' => 1),
      array('field_test_1' => 1, 'field_test_2_count' => 2),
      array('field_test_1' => 2, 'field_test_2_count' => 3),
    ));
=======
    $this->assertSortedResults([
      ['field_test_1' => 3, 'field_test_2_count' => 1],
      ['field_test_1' => 1, 'field_test_2_count' => 2],
      ['field_test_1' => 2, 'field_test_2_count' => 3],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  }

  /**
   * Asserts the results as expected regardless of order between and in rows.
   *
   * @param array $expected
   *   An array of the expected results.
   */
  protected function assertResults($expected, $sorted = FALSE) {
    $found = TRUE;
    $expected_keys = array_keys($expected);
    foreach ($this->queryResult as $key => $row) {
<<<<<<< HEAD
      $keys = $sorted ? array($key) : $expected_keys;
=======
      $keys = $sorted ? [$key] : $expected_keys;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      foreach ($keys as $key) {
        $expected_row = $expected[$key];
        if (!array_diff_assoc($row, $expected_row) && !array_diff_assoc($expected_row, $row)) {
          continue 2;
        }
      }
      $found = FALSE;
      break;
    }
<<<<<<< HEAD
    return $this->assertTrue($found, strtr('!expected expected, !found found', array('!expected' => print_r($expected, TRUE), '!found' => print_r($this->queryResult, TRUE))));
=======
    return $this->assertTrue($found, strtr('!expected expected, !found found', ['!expected' => print_r($expected, TRUE), '!found' => print_r($this->queryResult, TRUE)]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Asserts the results as expected regardless of order in rows.
   *
   * @param array $expected
   *   An array of the expected results.
   */
  protected function assertSortedResults($expected) {
    return $this->assertResults($expected, TRUE);
  }

}
