<?php

namespace Drupal\Tests\views\Kernel\Handler;

use Drupal\Tests\views\Kernel\ViewsKernelTestBase;
use Drupal\views\Views;

/**
 * Tests handler table and field aliases.
 *
 * @group views
 */
class HandlerAliasTest extends ViewsKernelTestBase {

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
  public static $testViews = array('test_filter', 'test_alias');
=======
  public static $testViews = ['test_filter', 'test_alias'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  protected function setUp($import_test_views = TRUE) {
    parent::setUp();

    $this->installEntitySchema('user');
  }

  /**
   * {@inheritdoc}
   */
  protected function viewsData() {
    $data = parent::viewsData();
    // User the existing test_filter plugin.
    $data['views_test_data_alias']['table']['real table'] = 'views_test_data';
    $data['views_test_data_alias']['name_alias']['filter']['id'] = 'test_filter';
    $data['views_test_data_alias']['name_alias']['filter']['real field'] = 'name';

    return $data;
  }

  public function testPluginAliases() {
    $view = Views::getView('test_filter');
    $view->initDisplay();

    // Change the filtering.
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('filters', array(
      'test_filter' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'test_filter' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'test_filter',
        'table' => 'views_test_data_alias',
        'field' => 'name_alias',
        'operator' => '=',
        'value' => 'John',
        'group' => 0,
<<<<<<< HEAD
      ),
    ));
=======
      ],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->executeView($view);

    $filter = $view->filter['test_filter'];

    // Check the definition values are present.
    $this->assertIdentical($filter->definition['real table'], 'views_test_data');
    $this->assertIdentical($filter->definition['real field'], 'name');

    $this->assertIdentical($filter->table, 'views_test_data');
    $this->assertIdentical($filter->realField, 'name');

    // Test an existing user uid field.
    $view = Views::getView('test_alias');
    $view->initDisplay();
    $this->executeView($view);

    $filter = $view->filter['uid_raw'];

    $this->assertIdentical($filter->definition['real field'], 'uid');

    $this->assertIdentical($filter->field, 'uid_raw');
    $this->assertIdentical($filter->table, 'users_field_data');
    $this->assertIdentical($filter->realField, 'uid');
  }

}
