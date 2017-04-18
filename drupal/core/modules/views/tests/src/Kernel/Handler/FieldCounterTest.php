<?php

namespace Drupal\Tests\views\Kernel\Handler;

use Drupal\Tests\views\Kernel\ViewsKernelTestBase;
use Drupal\views\Views;

/**
 * Tests the Drupal\views\Plugin\views\field\Counter handler.
 *
 * @group views
 */
class FieldCounterTest extends ViewsKernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('user');
=======
  public static $modules = ['user'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Views used by this test.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $testViews = array('test_view');

  function testSimple() {
    $view = Views::getView('test_view');
    $view->setDisplay();
    $view->displayHandlers->get('default')->overrideOption('fields', array(
      'counter' => array(
=======
  public static $testViews = ['test_view'];

  public function testSimple() {
    $view = Views::getView('test_view');
    $view->setDisplay();
    $view->displayHandlers->get('default')->overrideOption('fields', [
      'counter' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'counter',
        'table' => 'views',
        'field' => 'counter',
        'relationship' => 'none',
<<<<<<< HEAD
      ),
      'name' => array(
=======
      ],
      'name' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'name',
        'table' => 'views_test_data',
        'field' => 'name',
        'relationship' => 'none',
<<<<<<< HEAD
      ),
    ));
    $view->preview();

    $counter = $view->style_plugin->getField(0, 'counter');
    $this->assertEqual($counter, '1', format_string('Make sure the expected number (@expected) patches with the rendered number (@counter)', array('@expected' => 1, '@counter' => $counter)));
    $counter = $view->style_plugin->getField(1, 'counter');
    $this->assertEqual($counter, '2', format_string('Make sure the expected number (@expected) patches with the rendered number (@counter)', array('@expected' => 2, '@counter' => $counter)));
    $counter = $view->style_plugin->getField(2, 'counter');
    $this->assertEqual($counter, '3', format_string('Make sure the expected number (@expected) patches with the rendered number (@counter)', array('@expected' => 3, '@counter' => $counter)));
=======
      ],
    ]);
    $view->preview();

    $counter = $view->style_plugin->getField(0, 'counter');
    $this->assertEqual($counter, '1', format_string('Make sure the expected number (@expected) patches with the rendered number (@counter)', ['@expected' => 1, '@counter' => $counter]));
    $counter = $view->style_plugin->getField(1, 'counter');
    $this->assertEqual($counter, '2', format_string('Make sure the expected number (@expected) patches with the rendered number (@counter)', ['@expected' => 2, '@counter' => $counter]));
    $counter = $view->style_plugin->getField(2, 'counter');
    $this->assertEqual($counter, '3', format_string('Make sure the expected number (@expected) patches with the rendered number (@counter)', ['@expected' => 3, '@counter' => $counter]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $view->destroy();
    $view->storage->invalidateCaches();

    $view->setDisplay();
    $rand_start = rand(5, 10);
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('fields', array(
      'counter' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('fields', [
      'counter' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'counter',
        'table' => 'views',
        'field' => 'counter',
        'relationship' => 'none',
        'counter_start' => $rand_start
<<<<<<< HEAD
      ),
      'name' => array(
=======
      ],
      'name' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
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
    $view->preview();

    $counter = $view->style_plugin->getField(0, 'counter');
    $expected_number = 0 + $rand_start;
<<<<<<< HEAD
    $this->assertEqual($counter, (string) $expected_number, format_string('Make sure the expected number (@expected) patches with the rendered number (@counter)', array('@expected' => $expected_number, '@counter' => $counter)));
    $counter = $view->style_plugin->getField(1, 'counter');
    $expected_number = 1 + $rand_start;
    $this->assertEqual($counter, (string) $expected_number, format_string('Make sure the expected number (@expected) patches with the rendered number (@counter)', array('@expected' => $expected_number, '@counter' => $counter)));
    $counter = $view->style_plugin->getField(2, 'counter');
    $expected_number = 2 + $rand_start;
    $this->assertEqual($counter, (string) $expected_number, format_string('Make sure the expected number (@expected) patches with the rendered number (@counter)', array('@expected' => $expected_number, '@counter' => $counter)));
=======
    $this->assertEqual($counter, (string) $expected_number, format_string('Make sure the expected number (@expected) patches with the rendered number (@counter)', ['@expected' => $expected_number, '@counter' => $counter]));
    $counter = $view->style_plugin->getField(1, 'counter');
    $expected_number = 1 + $rand_start;
    $this->assertEqual($counter, (string) $expected_number, format_string('Make sure the expected number (@expected) patches with the rendered number (@counter)', ['@expected' => $expected_number, '@counter' => $counter]));
    $counter = $view->style_plugin->getField(2, 'counter');
    $expected_number = 2 + $rand_start;
    $this->assertEqual($counter, (string) $expected_number, format_string('Make sure the expected number (@expected) patches with the rendered number (@counter)', ['@expected' => $expected_number, '@counter' => $counter]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * @todo: Write tests for pager.
   */
<<<<<<< HEAD
  function testPager() {
=======
  public function testPager() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

}
