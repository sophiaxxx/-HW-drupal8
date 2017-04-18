<?php

namespace Drupal\Tests\views\Kernel\Handler;

use Drupal\Core\Url;
use Drupal\Tests\views\Kernel\ViewsKernelTestBase;
use Drupal\views\Views;

/**
 * Tests the core Drupal\views\Plugin\views\field\Url handler.
 *
 * @group views
 */
class FieldUrlTest extends ViewsKernelTestBase {

<<<<<<< HEAD
  public static $modules = array('system');
=======
  public static $modules = ['system'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Views used by this test.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $testViews = array('test_view');

  function viewsData() {
=======
  public static $testViews = ['test_view'];

  public function viewsData() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $data = parent::viewsData();
    $data['views_test_data']['name']['field']['id'] = 'url';
    return $data;
  }

  public function testFieldUrl() {
    $view = Views::getView('test_view');
    $view->setDisplay();

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
        'display_as_link' => FALSE,
<<<<<<< HEAD
      ),
    ));
=======
      ],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->executeView($view);

    $this->assertEqual('John', $view->field['name']->advancedRender($view->result[0]));

    // Make the url a link.
    $view->destroy();
    $view->setDisplay();

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
    ));
=======
      ],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->executeView($view);

    $this->assertEqual(\Drupal::l('John', Url::fromUri('base:John'))->getGeneratedLink(), $view->field['name']->advancedRender($view->result[0]));
  }

}
