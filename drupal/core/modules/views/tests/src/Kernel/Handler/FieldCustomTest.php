<?php

namespace Drupal\Tests\views\Kernel\Handler;

use Drupal\Component\Utility\Xss;
use Drupal\Tests\views\Kernel\ViewsKernelTestBase;
use Drupal\views\Views;

/**
 * Tests the core Drupal\views\Plugin\views\field\Custom handler.
 *
 * @group views
 */
class FieldCustomTest extends ViewsKernelTestBase {

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
   * {@inheritdoc}
   */
<<<<<<< HEAD
  function viewsData() {
=======
  public function viewsData() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $data = parent::viewsData();
    $data['views_test_data']['name']['field']['id'] = 'custom';
    return $data;
  }

  /**
   * Ensure that custom fields work and doesn't escape unnecessary markup.
   */
  public function testFieldCustom() {
    $view = Views::getView('test_view');
    $view->setDisplay();

    // Alter the text of the field to a random string.
    $random = '<div>' . $this->randomMachineName() . '</div>';
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
        'alter' => array(
          'text' => $random,
        ),
      ),
    ));
=======
        'alter' => [
          'text' => $random,
        ],
      ],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->executeView($view);

    $this->assertEqual($random, $view->style_plugin->getField(0, 'name'));
  }

  /**
   * Ensure that custom fields can use tokens.
   */
  public function testFieldCustomTokens() {
    $view = Views::getView('test_view');
    $view->setDisplay();

    $view->displayHandlers->get('default')->overrideOption('fields', [
      'age' => [
        'id' => 'age',
        'exclude' => TRUE,
        'table' => 'views_test_data',
        'field' => 'age',
      ],
      'name' => [
        'id' => 'name',
        'table' => 'views_test_data',
        'field' => 'name',
        'relationship' => 'none',
        'alter' => [
          'text' => 'Amount of kittens: {{ age }}',
        ],
      ],
    ]);

    /** @var \Drupal\Core\Render\RendererInterface $renderer */
    $renderer = \Drupal::service('renderer');
    $preview = $view->preview();
    $output = $renderer->renderRoot($preview);

    $expected_text = 'Amount of kittens: ' . $view->style_plugin->getField(0, 'age');
    $this->assertTrue(strpos((string) $output, $expected_text), 'The views token has been successfully replaced.');
  }

  /**
   * Ensure that custom field content is XSS filtered.
   */
  public function testCustomFieldXss() {
    $view = Views::getView('test_view');
    $view->setDisplay();

    // Alter the text of the field to include XSS.
    $text = '<script>alert("kittens")</script>';
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
        'alter' => array(
          'text' => $text,
        ),
      ),
    ));
=======
        'alter' => [
          'text' => $text,
        ],
      ],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->executeView($view);
    $this->assertEqual(Xss::filter($text), $view->style_plugin->getField(0, 'name'));
  }

}
