<?php

namespace Drupal\Tests\views\Kernel\Handler;

use Drupal\Tests\views\Kernel\ViewsKernelTestBase;
use Drupal\views\Views;

/**
 * Tests the messages area handler.
 *
 * @group views
 * @see \Drupal\views\Plugin\views\area\Messages
 */
class AreaMessagesTest extends ViewsKernelTestBase {

  /**
   * Views used by this test.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $testViews = array('test_area_messages');
=======
  public static $testViews = ['test_area_messages'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Tests the messages area handler.
   */
  public function testMessageText() {
    drupal_set_message('My drupal set message.');

    $view = Views::getView('test_area_messages');

    $view->setDisplay('default');
    $this->executeView($view);
    $output = $view->render();
    $output = \Drupal::service('renderer')->renderRoot($output);
    $this->setRawContent($output);
    $this->assertText('My drupal set message.');
  }

}
