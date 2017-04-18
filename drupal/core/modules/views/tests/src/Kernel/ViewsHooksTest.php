<?php

namespace Drupal\Tests\views\Kernel;

use Drupal\Core\Render\RenderContext;
use Drupal\views\Views;

/**
 * Tests that views hooks are registered when defined in $module.views.inc.
 *
 * @group views
 * @see views_hook_info().
 * @see field_hook_info().
 */
class ViewsHooksTest extends ViewsKernelTestBase {

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
   * An array of available views hooks to test.
   *
   * @var array
   */
<<<<<<< HEAD
  protected static $hooks = array (
=======
  protected static $hooks = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    'views_data' => 'all',
    'views_data_alter' => 'alter',
    'views_query_substitutions' => 'view',
    'views_form_substitutions' => 'view',
    'views_analyze' => 'view',
    'views_pre_view' => 'view',
    'views_pre_build' => 'view',
    'views_post_build' => 'view',
    'views_pre_execute' => 'view',
    'views_post_execute' => 'view',
    'views_pre_render' => 'view',
    'views_post_render' => 'view',
    'views_query_alter'  => 'view',
    'views_invalidate_cache' => 'all',
<<<<<<< HEAD
  );
=======
  ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * The module handler to use for invoking hooks.
   *
   * @var \Drupal\Core\Extension\ModuleHandlerInterface
   */
  protected $moduleHandler;

  protected function setUp($import_test_views = TRUE) {
    parent::setUp();

    $this->moduleHandler = $this->container->get('module_handler');
  }

  /**
   * Tests the hooks.
   */
  public function testHooks() {
    $view = Views::getView('test_view');
    $view->setDisplay();

    // Test each hook is found in the implementations array and is invoked.
    foreach (static::$hooks as $hook => $type) {
<<<<<<< HEAD
      $this->assertTrue($this->moduleHandler->implementsHook('views_test_data', $hook), format_string('The hook @hook was registered.', array('@hook' => $hook)));

      if ($hook == 'views_post_render') {
        $this->moduleHandler->invoke('views_test_data', $hook, array($view, &$view->display_handler->output, $view->display_handler->getPlugin('cache')));
=======
      $this->assertTrue($this->moduleHandler->implementsHook('views_test_data', $hook), format_string('The hook @hook was registered.', ['@hook' => $hook]));

      if ($hook == 'views_post_render') {
        $this->moduleHandler->invoke('views_test_data', $hook, [$view, &$view->display_handler->output, $view->display_handler->getPlugin('cache')]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        continue;
      }

      switch ($type) {
        case 'view':
<<<<<<< HEAD
          $this->moduleHandler->invoke('views_test_data', $hook, array($view));
          break;

        case 'alter':
          $data = array();
          $this->moduleHandler->invoke('views_test_data', $hook, array($data));
=======
          $this->moduleHandler->invoke('views_test_data', $hook, [$view]);
          break;

        case 'alter':
          $data = [];
          $this->moduleHandler->invoke('views_test_data', $hook, [$data]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
          break;

        default:
          $this->moduleHandler->invoke('views_test_data', $hook);
      }

<<<<<<< HEAD
      $this->assertTrue($this->container->get('state')->get('views_hook_test_' . $hook), format_string('The %hook hook was invoked.', array('%hook' => $hook)));
=======
      $this->assertTrue($this->container->get('state')->get('views_hook_test_' . $hook), format_string('The %hook hook was invoked.', ['%hook' => $hook]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      // Reset the module implementations cache, so we ensure that the
      // .views.inc file is loaded actively.
      $this->moduleHandler->resetImplementations();
    }
  }

  /**
   * Tests how hook_views_form_substitutions() makes substitutions.
   *
   * @see views_test_data_views_form_substitutions()
   * @see views_pre_render_views_form_views_form()
   */
  public function testViewsPreRenderViewsFormViewsForm() {
    $element = [
      'output' => [
        '#plain_text' => '<!--will-be-escaped--><!--will-be-not-escaped-->',
      ],
      '#substitutions' => ['#value' => []],
    ];
    $element = \Drupal::service('renderer')->executeInRenderContext(new RenderContext(), function() use ($element) {
      return views_pre_render_views_form_views_form($element);
    });
    $this->setRawContent((string) $element['output']['#markup']);
    $this->assertEscaped('<em>escaped</em>');
    $this->assertRaw('<em>unescaped</em>');
  }

}
