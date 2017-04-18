<?php

namespace Drupal\Tests\language\Kernel\Views;

use Drupal\views\Views;

/**
 * Tests the filter language handler.
 *
 * @group language
 * @see \Drupal\language\Plugin\views\filter\Language
 */
class FilterLanguageTest extends LanguageTestBase {

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
   * Tests the language filter.
   */
  public function testFilter() {
    $view = Views::getView('test_view');
<<<<<<< HEAD
    foreach (array('en' => 'John', 'xx-lolspeak' => 'George') as $langcode => $name) {
      $view->setDisplay();
      $view->displayHandlers->get('default')->overrideOption('filters', array(
        'langcode' => array(
          'id' => 'langcode',
          'table' => 'views_test_data',
          'field' => 'langcode',
          'value' => array($langcode),
        ),
      ));
      $this->executeView($view);

      $expected = array(array(
        'name' => $name,
      ));
      $this->assertIdenticalResultset($view, $expected, array('views_test_data_name' => 'name'));
=======
    foreach (['en' => 'John', 'xx-lolspeak' => 'George'] as $langcode => $name) {
      $view->setDisplay();
      $view->displayHandlers->get('default')->overrideOption('filters', [
        'langcode' => [
          'id' => 'langcode',
          'table' => 'views_test_data',
          'field' => 'langcode',
          'value' => [$langcode],
        ],
      ]);
      $this->executeView($view);

      $expected = [[
        'name' => $name,
      ]];
      $this->assertIdenticalResultset($view, $expected, ['views_test_data_name' => 'name']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

      $expected = [
        '***LANGUAGE_site_default***',
        '***LANGUAGE_language_interface***',
        '***LANGUAGE_language_content***',
        'en',
        'xx-lolspeak',
        'und',
        'zxx'
      ];
      $this->assertIdentical(array_keys($view->filter['langcode']->getValueOptions()), $expected);

      $view->destroy();
    }
  }

}
