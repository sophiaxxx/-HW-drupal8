<?php

namespace Drupal\Tests\views\Kernel\Handler;

use Drupal\Tests\views\Kernel\ViewsKernelTestBase;
use Drupal\views\Views;

/**
 * Tests the core views_handler_area_text handler.
 *
 * @group views
 * @see \Drupal\views\Plugin\views\area\Text
 */
class AreaTextTest extends ViewsKernelTestBase {

<<<<<<< HEAD
  public static $modules = array('system', 'user', 'filter');
=======
  public static $modules = ['system', 'user', 'filter'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

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

  protected function setUp($import_test_views = TRUE) {
    parent::setUp();

<<<<<<< HEAD
    $this->installConfig(array('system', 'filter'));
=======
    $this->installConfig(['system', 'filter']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->installEntitySchema('user');
  }

  public function testAreaText() {
    /** @var \Drupal\Core\Render\RendererInterface $renderer */
    $renderer = $this->container->get('renderer');
    $view = Views::getView('test_view');
    $view->setDisplay();

    // add a text header
    $string = $this->randomMachineName();
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('header', array(
      'area' => array(
        'id' => 'area',
        'table' => 'views',
        'field' => 'area',
        'content' => array(
          'value' => $string,
        ),
      ),
    ));
=======
    $view->displayHandlers->get('default')->overrideOption('header', [
      'area' => [
        'id' => 'area',
        'table' => 'views',
        'field' => 'area',
        'content' => [
          'value' => $string,
        ],
      ],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Execute the view.
    $this->executeView($view);

    $view->display_handler->handlers['header']['area']->options['content']['format'] = $this->randomString();
    $build = $view->display_handler->handlers['header']['area']->render();
    $this->assertEqual('', $renderer->renderRoot($build), 'Nonexistent format should return empty markup.');

    $view->display_handler->handlers['header']['area']->options['content']['format'] = filter_default_format();
    $build = $view->display_handler->handlers['header']['area']->render();
    $this->assertEqual(check_markup($string), $renderer->renderRoot($build), 'Existent format should return something');

    // Empty results, and it shouldn't be displayed .
<<<<<<< HEAD
    $this->assertEqual(array(), $view->display_handler->handlers['header']['area']->render(TRUE), 'No result should lead to no header');
=======
    $this->assertEqual([], $view->display_handler->handlers['header']['area']->render(TRUE), 'No result should lead to no header');
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Empty results, and it should be displayed.
    $view->display_handler->handlers['header']['area']->options['empty'] = TRUE;
    $build = $view->display_handler->handlers['header']['area']->render(TRUE);
    $this->assertEqual(check_markup($string), $renderer->renderRoot($build), 'No result, but empty enabled lead to a full header');
  }

}
