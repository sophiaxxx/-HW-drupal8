<?php

namespace Drupal\Tests\views\Kernel\Handler;

use Drupal\Tests\views\Kernel\ViewsKernelTestBase;
use Drupal\views\Views;

/**
 * Tests for core Drupal\views\Plugin\views\sort\SortPluginBase handler.
 *
 * @group views
 */
class SortTest extends ViewsKernelTestBase {

  /**
   * Views used by this test.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $testViews = array('test_view');
=======
  public static $testViews = ['test_view'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Tests numeric ordering of the result set.
   */
  public function testNumericOrdering() {
    $view = Views::getView('test_view');
    $view->setDisplay();

    // Change the ordering
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('sorts', array(
      'age' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('sorts', [
      'age' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'order' => 'ASC',
        'id' => 'age',
        'table' => 'views_test_data',
        'field' => 'age',
        'relationship' => 'none',
<<<<<<< HEAD
      ),
    ));
=======
      ],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Execute the view.
    $this->executeView($view);

    // Verify the result.
    $this->assertEqual(count($this->dataSet()), count($view->result), 'The number of returned rows match.');
<<<<<<< HEAD
    $this->assertIdenticalResultset($view, $this->orderResultSet($this->dataSet(), 'age'), array(
      'views_test_data_name' => 'name',
      'views_test_data_age' => 'age',
    ));
=======
    $this->assertIdenticalResultset($view, $this->orderResultSet($this->dataSet(), 'age'), [
      'views_test_data_name' => 'name',
      'views_test_data_age' => 'age',
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $view->destroy();
    $view->setDisplay();

    // Reverse the ordering
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('sorts', array(
      'age' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('sorts', [
      'age' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'order' => 'DESC',
        'id' => 'age',
        'table' => 'views_test_data',
        'field' => 'age',
        'relationship' => 'none',
<<<<<<< HEAD
      ),
    ));
=======
      ],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Execute the view.
    $this->executeView($view);

    // Verify the result.
    $this->assertEqual(count($this->dataSet()), count($view->result), 'The number of returned rows match.');
<<<<<<< HEAD
    $this->assertIdenticalResultset($view, $this->orderResultSet($this->dataSet(), 'age', TRUE), array(
      'views_test_data_name' => 'name',
      'views_test_data_age' => 'age',
    ));
=======
    $this->assertIdenticalResultset($view, $this->orderResultSet($this->dataSet(), 'age', TRUE), [
      'views_test_data_name' => 'name',
      'views_test_data_age' => 'age',
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests string ordering of the result set.
   */
  public function testStringOrdering() {
    $view = Views::getView('test_view');
    $view->setDisplay();

    // Change the ordering
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('sorts', array(
      'name' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('sorts', [
      'name' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'order' => 'ASC',
        'id' => 'name',
        'table' => 'views_test_data',
        'field' => 'name',
        'relationship' => 'none',
<<<<<<< HEAD
      ),
    ));
=======
      ],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Execute the view.
    $this->executeView($view);

    // Verify the result.
    $this->assertEqual(count($this->dataSet()), count($view->result), 'The number of returned rows match.');
<<<<<<< HEAD
    $this->assertIdenticalResultset($view, $this->orderResultSet($this->dataSet(), 'name'), array(
      'views_test_data_name' => 'name',
      'views_test_data_age' => 'age',
    ));
=======
    $this->assertIdenticalResultset($view, $this->orderResultSet($this->dataSet(), 'name'), [
      'views_test_data_name' => 'name',
      'views_test_data_age' => 'age',
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $view->destroy();
    $view->setDisplay();

    // Reverse the ordering
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('sorts', array(
      'name' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('sorts', [
      'name' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'order' => 'DESC',
        'id' => 'name',
        'table' => 'views_test_data',
        'field' => 'name',
        'relationship' => 'none',
<<<<<<< HEAD
      ),
    ));
=======
      ],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Execute the view.
    $this->executeView($view);

    // Verify the result.
    $this->assertEqual(count($this->dataSet()), count($view->result), 'The number of returned rows match.');
<<<<<<< HEAD
    $this->assertIdenticalResultset($view, $this->orderResultSet($this->dataSet(), 'name', TRUE), array(
      'views_test_data_name' => 'name',
      'views_test_data_age' => 'age',
    ));
=======
    $this->assertIdenticalResultset($view, $this->orderResultSet($this->dataSet(), 'name', TRUE), [
      'views_test_data_name' => 'name',
      'views_test_data_age' => 'age',
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

}
