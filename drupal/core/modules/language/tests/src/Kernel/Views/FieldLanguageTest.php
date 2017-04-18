<?php

namespace Drupal\Tests\language\Kernel\Views;

use Drupal\views\Views;

/**
 * Tests the field language handler.
 *
 * @group language
 * @see \Drupal\language\Plugin\views\field\Language
 */
class FieldLanguageTest extends LanguageTestBase {

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
   * Tests the language field.
   */
  public function testField() {
    $view = Views::getView('test_view');
    $view->setDisplay();
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('fields', array(
      'langcode' => array(
        'id' => 'langcode',
        'table' => 'views_test_data',
        'field' => 'langcode',
      ),
    ));
=======
    $view->displayHandlers->get('default')->overrideOption('fields', [
      'langcode' => [
        'id' => 'langcode',
        'table' => 'views_test_data',
        'field' => 'langcode',
      ],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->executeView($view);

    $this->assertEqual($view->field['langcode']->advancedRender($view->result[0]), 'English');
    $this->assertEqual($view->field['langcode']->advancedRender($view->result[1]), 'Lolspeak');
  }

}
