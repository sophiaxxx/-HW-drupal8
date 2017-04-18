<?php

namespace Drupal\Tests\views\Kernel\Handler;

use Drupal\Component\Utility\SafeMarkup;
use Drupal\Tests\views\Kernel\ViewsKernelTestBase;
use Drupal\views\Views;

/**
 * Tests for core Drupal\views\Plugin\views\sort\Date handler.
 *
 * @group views
 */
class SortDateTest extends ViewsKernelTestBase {

  /**
   * Views used by this test.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $testViews = array('test_view');

  protected function expectedResultSet($granularity, $reverse = TRUE) {
    $expected = array();
    if (!$reverse) {
      switch ($granularity) {
          case 'second':
            $expected = array(
              array('name' => 'John'),
              array('name' => 'Paul'),
              array('name' => 'Meredith'),
              array('name' => 'Ringo'),
              array('name' => 'George'),
            );
            break;
          case 'minute':
            $expected = array(
              array('name' => 'John'),
              array('name' => 'Paul'),
              array('name' => 'Ringo'),
              array('name' => 'Meredith'),
              array('name' => 'George'),
            );
            break;
          case 'hour':
            $expected = array(
              array('name' => 'John'),
              array('name' => 'Ringo'),
              array('name' => 'Paul'),
              array('name' => 'Meredith'),
              array('name' => 'George'),
            );
            break;
          case 'day':
            $expected = array(
              array('name' => 'John'),
              array('name' => 'Ringo'),
              array('name' => 'Paul'),
              array('name' => 'Meredith'),
              array('name' => 'George'),
            );
            break;
          case 'month':
            $expected = array(
              array('name' => 'John'),
              array('name' => 'George'),
              array('name' => 'Ringo'),
              array('name' => 'Paul'),
              array('name' => 'Meredith'),
            );
            break;
          case 'year':
            $expected = array(
              array('name' => 'John'),
              array('name' => 'George'),
              array('name' => 'Ringo'),
              array('name' => 'Paul'),
              array('name' => 'Meredith'),
            );
            break;
        }
=======
  public static $testViews = ['test_view'];

  protected function expectedResultSet($granularity, $reverse = TRUE) {
    $expected = [];
    if (!$reverse) {
      switch ($granularity) {
        case 'second':
          $expected = [
            ['name' => 'John'],
            ['name' => 'Paul'],
            ['name' => 'Meredith'],
            ['name' => 'Ringo'],
            ['name' => 'George'],
          ];
          break;
        case 'minute':
          $expected = [
            ['name' => 'John'],
            ['name' => 'Paul'],
            ['name' => 'Ringo'],
            ['name' => 'Meredith'],
            ['name' => 'George'],
          ];
          break;
        case 'hour':
          $expected = [
            ['name' => 'John'],
            ['name' => 'Ringo'],
            ['name' => 'Paul'],
            ['name' => 'Meredith'],
            ['name' => 'George'],
          ];
          break;
        case 'day':
          $expected = [
            ['name' => 'John'],
            ['name' => 'Ringo'],
            ['name' => 'Paul'],
            ['name' => 'Meredith'],
            ['name' => 'George'],
          ];
          break;
        case 'month':
          $expected = [
            ['name' => 'John'],
            ['name' => 'George'],
            ['name' => 'Ringo'],
            ['name' => 'Paul'],
            ['name' => 'Meredith'],
          ];
          break;
        case 'year':
          $expected = [
            ['name' => 'John'],
            ['name' => 'George'],
            ['name' => 'Ringo'],
            ['name' => 'Paul'],
            ['name' => 'Meredith'],
          ];
          break;
      }
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    }
    else {
      switch ($granularity) {
        case 'second':
<<<<<<< HEAD
          $expected = array(
            array('name' => 'George'),
            array('name' => 'Ringo'),
            array('name' => 'Meredith'),
            array('name' => 'Paul'),
            array('name' => 'John'),
          );
          break;
        case 'minute':
          $expected = array(
            array('name' => 'George'),
            array('name' => 'Ringo'),
            array('name' => 'Meredith'),
            array('name' => 'Paul'),
            array('name' => 'John'),
           );
          break;
        case 'hour':
          $expected = array(
            array('name' => 'George'),
            array('name' => 'Ringo'),
            array('name' => 'Paul'),
            array('name' => 'Meredith'),
            array('name' => 'John'),
          );
          break;
        case 'day':
          $expected = array(
            array('name' => 'George'),
            array('name' => 'John'),
            array('name' => 'Ringo'),
            array('name' => 'Paul'),
            array('name' => 'Meredith'),
          );
          break;
        case 'month':
          $expected = array(
            array('name' => 'John'),
            array('name' => 'George'),
            array('name' => 'Ringo'),
            array('name' => 'Paul'),
            array('name' => 'Meredith'),
          );
          break;
        case 'year':
          $expected = array(
            array('name' => 'John'),
            array('name' => 'George'),
            array('name' => 'Ringo'),
            array('name' => 'Paul'),
            array('name' => 'Meredith'),
          );
=======
          $expected = [
            ['name' => 'George'],
            ['name' => 'Ringo'],
            ['name' => 'Meredith'],
            ['name' => 'Paul'],
            ['name' => 'John'],
          ];
          break;
        case 'minute':
          $expected = [
            ['name' => 'George'],
            ['name' => 'Ringo'],
            ['name' => 'Meredith'],
            ['name' => 'Paul'],
            ['name' => 'John'],
           ];
          break;
        case 'hour':
          $expected = [
            ['name' => 'George'],
            ['name' => 'Ringo'],
            ['name' => 'Paul'],
            ['name' => 'Meredith'],
            ['name' => 'John'],
          ];
          break;
        case 'day':
          $expected = [
            ['name' => 'George'],
            ['name' => 'John'],
            ['name' => 'Ringo'],
            ['name' => 'Paul'],
            ['name' => 'Meredith'],
          ];
          break;
        case 'month':
          $expected = [
            ['name' => 'John'],
            ['name' => 'George'],
            ['name' => 'Ringo'],
            ['name' => 'Paul'],
            ['name' => 'Meredith'],
          ];
          break;
        case 'year':
          $expected = [
            ['name' => 'John'],
            ['name' => 'George'],
            ['name' => 'Ringo'],
            ['name' => 'Paul'],
            ['name' => 'Meredith'],
          ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
          break;
      }
    }

    return $expected;
  }

  /**
   * Tests numeric ordering of the result set.
   */
  public function testDateOrdering() {
<<<<<<< HEAD
    foreach (array('second', 'minute', 'hour', 'day', 'month', 'year') as $granularity) {
      foreach (array(FALSE, TRUE) as $reverse) {
=======
    foreach (['second', 'minute', 'hour', 'day', 'month', 'year'] as $granularity) {
      foreach ([FALSE, TRUE] as $reverse) {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        $view = Views::getView('test_view');
        $view->setDisplay();

        // Change the fields.
<<<<<<< HEAD
        $view->displayHandlers->get('default')->overrideOption('fields', array(
          'name' => array(
=======
        $view->displayHandlers->get('default')->overrideOption('fields', [
          'name' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
            'id' => 'name',
            'table' => 'views_test_data',
            'field' => 'name',
            'relationship' => 'none',
<<<<<<< HEAD
          ),
          'created' => array(
=======
          ],
          'created' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
            'id' => 'created',
            'table' => 'views_test_data',
            'field' => 'created',
            'relationship' => 'none',
<<<<<<< HEAD
          ),
        ));

        // Change the ordering
        $view->displayHandlers->get('default')->overrideOption('sorts', array(
          'created' => array(
=======
          ],
        ]);

        // Change the ordering
        $view->displayHandlers->get('default')->overrideOption('sorts', [
          'created' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
            'id' => 'created',
            'table' => 'views_test_data',
            'field' => 'created',
            'relationship' => 'none',
            'granularity' => $granularity,
            'order' => $reverse ? 'DESC' : 'ASC',
<<<<<<< HEAD
          ),
          'id' => array(
=======
          ],
          'id' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
            'id' => 'id',
            'table' => 'views_test_data',
            'field' => 'id',
            'relationship' => 'none',
            'order' => 'ASC',
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
        $this->assertIdenticalResultset($view, $this->expectedResultSet($granularity, $reverse), array(
          'views_test_data_name' => 'name',
        ), SafeMarkup::format('Result is returned correctly when ordering by granularity @granularity, @reverse.', array('@granularity' => $granularity, '@reverse' => $reverse ? 'reverse' : 'forward')));
=======
        $this->assertIdenticalResultset($view, $this->expectedResultSet($granularity, $reverse), [
          'views_test_data_name' => 'name',
        ], SafeMarkup::format('Result is returned correctly when ordering by granularity @granularity, @reverse.', ['@granularity' => $granularity, '@reverse' => $reverse ? 'reverse' : 'forward']));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        $view->destroy();
        unset($view);
      }
    }
  }

}
