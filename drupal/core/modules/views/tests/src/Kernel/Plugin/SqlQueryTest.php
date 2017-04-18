<?php

namespace Drupal\Tests\views\Kernel\Plugin;

use Drupal\Tests\views\Kernel\ViewsKernelTestBase;
use Drupal\views\Views;

/**
 * Tests the sql query plugin.
 *
 * @group views
 * @see \Drupal\views\Plugin\views\query\Sql
 */
class SqlQueryTest extends ViewsKernelTestBase {

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
  protected function viewsData() {
    $data = parent::viewsData();
    $data['views_test_data']['table']['base']['access query tag'] = 'test_tag';
<<<<<<< HEAD
    $data['views_test_data']['table']['base']['query metadata'] = array('key1' => 'test_metadata', 'key2' => 'test_metadata2');
=======
    $data['views_test_data']['table']['base']['query metadata'] = ['key1' => 'test_metadata', 'key2' => 'test_metadata2'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    return $data;
  }

  /**
   * Tests adding some metadata/tags to the views query.
   */
  public function testExecuteMetadata() {
    $view = Views::getView('test_view');
    $view->setDisplay();

    $view->initQuery();
    $view->execute();
    /** @var \Drupal\Core\Database\Query\Select $query */
    $main_query = $view->build_info['query'];
    /** @var \Drupal\Core\Database\Query\Select $count_query */
    $count_query = $view->build_info['count_query'];

<<<<<<< HEAD
    foreach (array($main_query, $count_query) as $query) {
=======
    foreach ([$main_query, $count_query] as $query) {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      // Check query access tags.
      $this->assertTrue($query->hasTag('test_tag'));

      // Check metadata.
      $this->assertIdentical($query->getMetaData('key1'), 'test_metadata');
      $this->assertIdentical($query->getMetaData('key2'), 'test_metadata2');
    }

    $query_options = $view->display_handler->getOption('query');
    $query_options['options']['disable_sql_rewrite'] = TRUE;
    $view->display_handler->setOption('query', $query_options);
    $view->save();
    $view->destroy();

    $view = Views::getView('test_view');
    $view->setDisplay();
    $view->initQuery();
    $view->execute();
    /** @var \Drupal\Core\Database\Query\Select $query */
    $main_query = $view->build_info['query'];
    /** @var \Drupal\Core\Database\Query\Select $count_query */
    $count_query = $view->build_info['count_query'];

<<<<<<< HEAD
    foreach (array($main_query, $count_query) as $query) {
=======
    foreach ([$main_query, $count_query] as $query) {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      // Check query access tags.
      $this->assertFalse($query->hasTag('test_tag'));

      // Check metadata.
      $this->assertIdentical($query->getMetaData('key1'), NULL);
      $this->assertIdentical($query->getMetaData('key2'), NULL);
    }
  }

}