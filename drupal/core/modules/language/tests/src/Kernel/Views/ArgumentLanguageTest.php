<?php

namespace Drupal\Tests\language\Kernel\Views;

use Drupal\views\Views;

/**
 * Tests the argument language handler.
 *
 * @group language
 * @see \Drupal\language\Plugin\views\argument\Language.php
 */
class ArgumentLanguageTest extends LanguageTestBase {

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
   * Tests the language argument.
   */
  public function testArgument() {
    $view = Views::getView('test_view');
<<<<<<< HEAD
    foreach (array('en' => 'John', 'xx-lolspeak' => 'George') as $langcode => $name) {
      $view->setDisplay();
      $view->displayHandlers->get('default')->overrideOption('arguments', array(
        'langcode' => array(
          'id' => 'langcode',
          'table' => 'views_test_data',
          'field' => 'langcode',
        ),
      ));
      $this->executeView($view, array($langcode));

      $expected = array(array(
        'name' => $name,
      ));
      $this->assertIdenticalResultset($view, $expected, array('views_test_data_name' => 'name'));
=======
    foreach (['en' => 'John', 'xx-lolspeak' => 'George'] as $langcode => $name) {
      $view->setDisplay();
      $view->displayHandlers->get('default')->overrideOption('arguments', [
        'langcode' => [
          'id' => 'langcode',
          'table' => 'views_test_data',
          'field' => 'langcode',
        ],
      ]);
      $this->executeView($view, [$langcode]);

      $expected = [[
        'name' => $name,
      ]];
      $this->assertIdenticalResultset($view, $expected, ['views_test_data_name' => 'name']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      $view->destroy();
    }
  }

}
