<?php

namespace Drupal\Tests\views\Kernel\Handler;

use Drupal\Tests\views\Kernel\ViewsKernelTestBase;
use Drupal\views\Views;

/**
 * Tests the view area handler.
 *
 * @group views
 * @see \Drupal\views\Plugin\views\area\View
 */
class AreaViewTest extends ViewsKernelTestBase {

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
  public static $testViews = array('test_simple_argument', 'test_area_view');
=======
  public static $testViews = ['test_simple_argument', 'test_area_view'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Tests the view area handler.
   */
  public function testViewArea() {
    /** @var \Drupal\Core\Render\RendererInterface $renderer */
    $renderer = $this->container->get('renderer');
    $view = Views::getView('test_area_view');

    // Tests \Drupal\views\Plugin\views\area\View::calculateDependencies().
    $this->assertIdentical(['config' => ['views.view.test_simple_argument']], $view->getDependencies());

    $this->executeView($view);
    $output = $view->render();
    $output = $renderer->renderRoot($output);
    $this->assertTrue(strpos($output, 'js-view-dom-id-' . $view->dom_id) !== FALSE, 'The test view is correctly embedded.');
    $view->destroy();

<<<<<<< HEAD
    $view->setArguments(array(27));
=======
    $view->setArguments([27]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->executeView($view);
    $output = $view->render();
    $output = $renderer->renderRoot($output);
    $this->assertTrue(strpos($output, 'John') === FALSE, 'The test view is correctly embedded with inherited arguments.');
    $this->assertTrue(strpos($output, 'George') !== FALSE, 'The test view is correctly embedded with inherited arguments.');
    $view->destroy();
  }

}
