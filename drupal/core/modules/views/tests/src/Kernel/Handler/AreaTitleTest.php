<?php

namespace Drupal\Tests\views\Kernel\Handler;

use Drupal\Tests\views\Kernel\ViewsKernelTestBase;
use Drupal\views\Views;

/**
 * Tests the title area handler.
 *
 * @group views
 * @see \Drupal\views\Plugin\views\area\Title
 */
class AreaTitleTest extends ViewsKernelTestBase {

  /**
   * Views used by this test.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $testViews = array('test_area_title');
=======
  public static $testViews = ['test_area_title'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Tests the title area handler.
   */
  public function testTitleText() {
    $view = Views::getView('test_area_title');

    $view->setDisplay('default');
    $this->executeView($view);
    $view->render();
    $this->assertFalse($view->getTitle(), 'The title area does not override the title if the view is not empty.');
    $view->destroy();

    $view->setDisplay('default');
    $this->executeView($view);
<<<<<<< HEAD
    $view->result = array();
=======
    $view->result = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $view->render();
    $this->assertEqual($view->getTitle(), 'test_title_empty', 'The title area should override the title if the result is empty.');
    $view->destroy();

    $view->setDisplay('page_1');
    $this->executeView($view);
    $view->render();
    $this->assertEqual($view->getTitle(), 'test_title_header', 'The title area on the header should override the title if the result is not empty.');
    $view->destroy();

    $view->setDisplay('page_1');
    $this->executeView($view);
<<<<<<< HEAD
    $view->result = array();
=======
    $view->result = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $view->render();
    $this->assertEqual($view->getTitle(), 'test_title_empty', 'The title area should override the title if the result is empty.');
    $view->destroy();
  }

}
