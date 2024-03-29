<?php

namespace Drupal\Tests\views\Kernel;

use Drupal\entity_test\Entity\EntityTestMul;
use Drupal\field\Entity\FieldConfig;
use Drupal\field\Entity\FieldStorageConfig;
use Drupal\language\Entity\ConfigurableLanguage;
use Drupal\views\Views;

/**
 * Tests aggregate functionality of views, for example count.
 *
 * @group views
 */
class QueryGroupByTest extends ViewsKernelTestBase {

  /**
   * Views used by this test.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $testViews = array('test_group_by_in_filters', 'test_aggregate_count', 'test_group_by_count', 'test_group_by_count_multicardinality', 'test_group_by_field_not_within_bundle');
=======
  public static $testViews = ['test_group_by_in_filters', 'test_aggregate_count', 'test_group_by_count', 'test_group_by_count_multicardinality', 'test_group_by_field_not_within_bundle'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('entity_test', 'system', 'field', 'user', 'language');
=======
  public static $modules = ['entity_test', 'system', 'field', 'user', 'language'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * The storage for the test entity type.
   *
   * @var \Drupal\Core\Entity\Sql\SqlContentEntityStorage
   */
  public $storage;

  /**
   * {@inheritdoc}
   */
  protected function setUp($import_test_views = TRUE) {
    parent::setUp();

    $this->installEntitySchema('user');
    $this->installEntitySchema('entity_test');
    $this->installEntitySchema('entity_test_mul');

    $this->storage = $this->container->get('entity.manager')->getStorage('entity_test');

    ConfigurableLanguage::createFromLangcode('it')->save();
  }


  /**
   * Tests aggregate count feature.
   */
  public function testAggregateCount() {
    $this->setupTestEntities();

    $view = Views::getView('test_aggregate_count');
    $this->executeView($view);

    $this->assertEqual(count($view->result), 2, 'Make sure the count of items is right.');

<<<<<<< HEAD
    $types = array();
=======
    $types = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    foreach ($view->result as $item) {
      // num_records is a alias for id.
      $types[$item->entity_test_name] = $item->num_records;
    }

    $this->assertEqual($types['name1'], 4, 'Groupby the name: name1 returned the expected amount of results.');
    $this->assertEqual($types['name2'], 3, 'Groupby the name: name2 returned the expected amount of results.');
  }

  /**
   * Provides a test helper which runs a view with some aggregation function.
   *
   * @param string|null $aggregation_function
   *   Which aggregation function should be used, for example sum or count. If
   *   NULL is passed the aggregation will be tested with no function.
   * @param array $values
   *   The expected views result.
   */
  public function groupByTestHelper($aggregation_function, $values) {
    $this->setupTestEntities();

    $view = Views::getView('test_group_by_count');
    $view->setDisplay();
    // There is no need for a function in order to have aggregation.
    if (empty($aggregation_function)) {
      // The test table has 2 fields ('id' and 'name'). We'll remove 'id'
      // because it's unique and will test aggregation on 'name'.
      unset($view->displayHandlers->get('default')->options['fields']['id']);
    }
    else {
      $view->displayHandlers->get('default')->options['fields']['id']['group_type'] = $aggregation_function;
    }

    $this->executeView($view);

    $this->assertEqual(count($view->result), 2, 'Make sure the count of items is right.');
    // Group by name to identify the right count.
<<<<<<< HEAD
    $results = array();
    foreach ($view->result as $item) {
      $results[$item->entity_test_name] = $item->id;
    }
    $this->assertEqual($results['name1'], $values[0], format_string('Aggregation with @aggregation_function and groupby name: name1 returned the expected amount of results', array('@aggregation_function' => $aggregation_function)));
    $this->assertEqual($results['name2'], $values[1], format_string('Aggregation with @aggregation_function and groupby name: name2 returned the expected amount of results', array('@aggregation_function' => $aggregation_function)));
=======
    $results = [];
    foreach ($view->result as $item) {
      $results[$item->entity_test_name] = $item->id;
    }
    $this->assertEqual($results['name1'], $values[0], format_string('Aggregation with @aggregation_function and groupby name: name1 returned the expected amount of results', ['@aggregation_function' => $aggregation_function]));
    $this->assertEqual($results['name2'], $values[1], format_string('Aggregation with @aggregation_function and groupby name: name2 returned the expected amount of results', ['@aggregation_function' => $aggregation_function]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Helper method that creates some test entities.
   */
  protected function setupTestEntities() {
    // Create 4 entities with name1 and 3 entities with name2.
<<<<<<< HEAD
    $entity_1 = array(
      'name' => 'name1',
    );
=======
    $entity_1 = [
      'name' => 'name1',
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->storage->create($entity_1)->save();
    $this->storage->create($entity_1)->save();
    $this->storage->create($entity_1)->save();
    $this->storage->create($entity_1)->save();

<<<<<<< HEAD
    $entity_2 = array(
      'name' => 'name2',
    );
=======
    $entity_2 = [
      'name' => 'name2',
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->storage->create($entity_2)->save();
    $this->storage->create($entity_2)->save();
    $this->storage->create($entity_2)->save();
  }

  /**
   * Tests the count aggregation function.
   */
  public function testGroupByCount() {
<<<<<<< HEAD
    $this->groupByTestHelper('count', array(4, 3));
=======
    $this->groupByTestHelper('count', [4, 3]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests the sum aggregation function.
   */
  public function testGroupBySum() {
<<<<<<< HEAD
    $this->groupByTestHelper('sum', array(10, 18));
=======
    $this->groupByTestHelper('sum', [10, 18]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests the average aggregation function.
   */
  public function testGroupByAverage() {
<<<<<<< HEAD
    $this->groupByTestHelper('avg', array(2.5, 6));
=======
    $this->groupByTestHelper('avg', [2.5, 6]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests the min aggregation function.
   */
  public function testGroupByMin() {
<<<<<<< HEAD
    $this->groupByTestHelper('min', array(1, 5));
=======
    $this->groupByTestHelper('min', [1, 5]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests the max aggregation function.
   */
  public function testGroupByMax() {
<<<<<<< HEAD
    $this->groupByTestHelper('max', array(4, 7));
=======
    $this->groupByTestHelper('max', [4, 7]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests aggregation with no specific function.
   */
  public function testGroupByNone() {
<<<<<<< HEAD
    $this->groupByTestHelper(NULL, array(1, 5));
=======
    $this->groupByTestHelper(NULL, [1, 5]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests groupby with filters.
   */
  public function testGroupByCountOnlyFilters() {
    // Check if GROUP BY and HAVING are included when a view
    // doesn't display SUM, COUNT, MAX, etc. functions in SELECT statement.

    for ($x = 0; $x < 10; $x++) {
<<<<<<< HEAD
      $this->storage->create(array('name' => 'name1'))->save();
=======
      $this->storage->create(['name' => 'name1'])->save();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    }

    $view = Views::getView('test_group_by_in_filters');
    $this->executeView($view);

    $this->assertTrue(strpos($view->build_info['query'], 'GROUP BY'), 'Make sure that GROUP BY is in the query');
    $this->assertTrue(strpos($view->build_info['query'], 'HAVING'), 'Make sure that HAVING is in the query');
  }

  /**
   * Tests grouping on base field.
   */
  public function testGroupByBaseField() {
    $this->setupTestEntities();

    $view = Views::getView('test_group_by_count');
    $view->setDisplay();
    // This tests that the GROUP BY portion of the query is properly formatted
    // to include the base table to avoid ambiguous field errors.
    $view->displayHandlers->get('default')->options['fields']['name']['group_type'] = 'min';
    unset($view->displayHandlers->get('default')->options['fields']['id']['group_type']);
    $this->executeView($view);
    $this->assertTrue(strpos($view->build_info['query'], 'GROUP BY entity_test.id'), 'GROUP BY field includes the base table name when grouping on the base field.');
  }

  /**
   * Tests grouping a field with cardinality > 1.
   */
  public function testGroupByFieldWithCardinality() {
    $field_storage = FieldStorageConfig::create([
      'type' => 'integer',
      'field_name' => 'field_test',
      'cardinality' => 4,
      'entity_type' => 'entity_test_mul',
    ]);
    $field_storage->save();
    $field = FieldConfig::create([
      'field_name' => 'field_test',
      'entity_type' => 'entity_test_mul',
      'bundle' => 'entity_test_mul',
    ]);
    $field->save();

    $entities = [];
    $entity = EntityTestMul::create([
      'field_test' => [1, 1, 1],
    ]);
    $entity->save();
    $entities[] = $entity;

    $entity = EntityTestMul::create([
      'field_test' => [2, 2, 2],
    ]);
    $entity->save();
    $entities[] = $entity;

    $entity = EntityTestMul::create([
      'field_test' => [2, 2, 2],
    ]);
    $entity->save();
    $entities[] = $entity;

    $view = Views::getView('test_group_by_count_multicardinality');
    $this->executeView($view);
    $this->assertEqual(2, count($view->result));

    $this->assertEqual('3', $view->getStyle()->getField(0, 'id'));
    $this->assertEqual('1', $view->getStyle()->getField(0, 'field_test'));
    $this->assertEqual('6', $view->getStyle()->getField(1, 'id'));
    $this->assertEqual('2', $view->getStyle()->getField(1, 'field_test'));

    $entities[2]->field_test[0]->value = 3;
    $entities[2]->field_test[1]->value = 4;
    $entities[2]->field_test[2]->value = 5;
    $entities[2]->save();

    $view = Views::getView('test_group_by_count_multicardinality');
    $this->executeView($view);
    $this->assertEqual(5, count($view->result));

    $this->assertEqual('3', $view->getStyle()->getField(0, 'id'));
    $this->assertEqual('1', $view->getStyle()->getField(0, 'field_test'));
    $this->assertEqual('3', $view->getStyle()->getField(1, 'id'));
    $this->assertEqual('2', $view->getStyle()->getField(1, 'field_test'));
    $this->assertEqual('1', $view->getStyle()->getField(2, 'id'));
    $this->assertEqual('3', $view->getStyle()->getField(2, 'field_test'));
    $this->assertEqual('1', $view->getStyle()->getField(3, 'id'));
    $this->assertEqual('4', $view->getStyle()->getField(3, 'field_test'));
    $this->assertEqual('1', $view->getStyle()->getField(4, 'id'));
    $this->assertEqual('5', $view->getStyle()->getField(4, 'field_test'));

    // Check that translated values are correctly retrieved and are not grouped
    // into the original entity.
    $translation = $entity->addTranslation('it');
    $translation->field_test = [6, 6, 6];
    $translation->save();

    $view = Views::getView('test_group_by_count_multicardinality');
    $this->executeView($view);

    $this->assertEqual(6, count($view->result));
    $this->assertEqual('3', $view->getStyle()->getField(5, 'id'));
    $this->assertEqual('6', $view->getStyle()->getField(5, 'field_test'));
  }

  /**
   * Tests groupby with a field not existing on some bundle.
   */
  public function testGroupByWithFieldsNotExistingOnBundle() {
    $field_storage = FieldStorageConfig::create([
      'type' => 'integer',
      'field_name' => 'field_test',
      'cardinality' => 4,
      'entity_type' => 'entity_test_mul',
    ]);
    $field_storage->save();
    $field = FieldConfig::create([
      'field_name' => 'field_test',
      'entity_type' => 'entity_test_mul',
      'bundle' => 'entity_test_mul',
    ]);
    $field->save();

    $entities = [];
    $entity = EntityTestMul::create([
      'field_test' => [1],
      'type' => 'entity_test_mul',
    ]);
    $entity->save();
    $entities[] = $entity;

    $entity = EntityTestMul::create([
      'type' => 'entity_test_mul2',
    ]);
    $entity->save();
    $entities[] = $entity;

    $view = Views::getView('test_group_by_field_not_within_bundle');
    $this->executeView($view);

    $this->assertEqual(2, count($view->result));
    // The first result is coming from entity_test_mul2, so no field could be
    // rendered.
    $this->assertEqual('', $view->getStyle()->getField(0, 'field_test'));
    // The second result is coming from entity_test_mul, so its field value
    // could be rendered.
    $this->assertEqual('1', $view->getStyle()->getField(1, 'field_test'));
  }

}
