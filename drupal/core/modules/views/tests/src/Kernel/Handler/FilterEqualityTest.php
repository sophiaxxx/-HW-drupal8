<?php

namespace Drupal\Tests\views\Kernel\Handler;

use Drupal\Tests\views\Kernel\ViewsKernelTestBase;
use Drupal\views\Views;

/**
 * Tests the core Drupal\views\Plugin\views\filter\Equality handler.
 *
 * @group views
 */
class FilterEqualityTest extends ViewsKernelTestBase {

<<<<<<< HEAD
  public static $modules = array('system');
=======
  public static $modules = ['system'];
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

  /**
   * Map column names.
   *
   * @var array
   */
<<<<<<< HEAD
  protected $columnMap = array(
    'views_test_data_name' => 'name',
  );

  function viewsData() {
=======
  protected $columnMap = [
    'views_test_data_name' => 'name',
  ];

  public function viewsData() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $data = parent::viewsData();
    $data['views_test_data']['name']['filter']['id'] = 'equality';
    return $data;
  }

<<<<<<< HEAD
  function testEqual() {
=======
  public function testEqual() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $view = Views::getView('test_view');
    $view->setDisplay();

    // Change the filtering
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('filters', array(
      'name' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'name' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'name',
        'table' => 'views_test_data',
        'field' => 'name',
        'relationship' => 'none',
        'operator' => '=',
        'value' => 'Ringo',
<<<<<<< HEAD
      ),
    ));

    $this->executeView($view);
    $resultset = array(
      array(
        'name' => 'Ringo',
      ),
    );
=======
      ],
    ]);

    $this->executeView($view);
    $resultset = [
      [
        'name' => 'Ringo',
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testEqualGroupedExposed() {
    $filters = $this->getGroupedExposedFilters();
    $view = Views::getView('test_view');
    $view->newDisplay('page', 'Page', 'page_1');

    // Filter: Name, Operator: =, Value: Ringo
    $filters['name']['group_info']['default_group'] = 1;
    $view->setDisplay('page_1');
    $view->displayHandlers->get('page_1')->overrideOption('filters', $filters);
    $view->save();
    $this->container->get('router.builder')->rebuild();

    $this->executeView($view);
<<<<<<< HEAD
    $resultset = array(
      array(
        'name' => 'Ringo',
      ),
    );
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  function testNotEqual() {
=======
    $resultset = [
      [
        'name' => 'Ringo',
      ],
    ];
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testNotEqual() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $view = Views::getView('test_view');
    $view->setDisplay();

    // Change the filtering
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('filters', array(
      'name' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'name' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'name',
        'table' => 'views_test_data',
        'field' => 'name',
        'relationship' => 'none',
        'operator' => '!=',
        'value' => 'Ringo',
<<<<<<< HEAD
      ),
    ));

    $this->executeView($view);
    $resultset = array(
      array(
        'name' => 'John',
      ),
      array(
        'name' => 'George',
      ),
      array(
        'name' => 'Paul',
      ),
      array(
        'name' => 'Meredith',
      ),
    );
=======
      ],
    ]);

    $this->executeView($view);
    $resultset = [
      [
        'name' => 'John',
      ],
      [
        'name' => 'George',
      ],
      [
        'name' => 'Paul',
      ],
      [
        'name' => 'Meredith',
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testEqualGroupedNotExposed() {
    $filters = $this->getGroupedExposedFilters();
    $view = Views::getView('test_view');
    $view->newDisplay('page', 'Page', 'page_1');

    // Filter: Name, Operator: !=, Value: Ringo
    $filters['name']['group_info']['default_group'] = 2;
    $view->setDisplay('page_1');
    $view->displayHandlers->get('page_1')->overrideOption('filters', $filters);
    $view->save();
    $this->container->get('router.builder')->rebuild();

    $this->executeView($view);
<<<<<<< HEAD
    $resultset = array(
      array(
        'name' => 'John',
      ),
      array(
        'name' => 'George',
      ),
      array(
        'name' => 'Paul',
      ),
      array(
        'name' => 'Meredith',
      ),
    );
=======
    $resultset = [
      [
        'name' => 'John',
      ],
      [
        'name' => 'George',
      ],
      [
        'name' => 'Paul',
      ],
      [
        'name' => 'Meredith',
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }


  protected function getGroupedExposedFilters() {
<<<<<<< HEAD
    $filters = array(
      'name' => array(
=======
    $filters = [
      'name' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'name',
        'plugin_id' => 'equality',
        'table' => 'views_test_data',
        'field' => 'name',
        'relationship' => 'none',
        'group' => 1,
        'exposed' => TRUE,
<<<<<<< HEAD
        'expose' => array(
          'operator' => 'name_op',
          'label' => 'name',
          'identifier' => 'name',
        ),
        'is_grouped' => TRUE,
        'group_info' => array(
          'label' => 'name',
          'identifier' => 'name',
          'default_group' => 'All',
          'group_items' => array(
            1 => array(
              'title' => 'Name is equal to Ringo',
              'operator' => '=',
              'value' => 'Ringo',
            ),
            2 => array(
              'title' => 'Name is not equal to Ringo',
              'operator' => '!=',
              'value' => 'Ringo',
            ),
          ),
        ),
      ),
    );
=======
        'expose' => [
          'operator' => 'name_op',
          'label' => 'name',
          'identifier' => 'name',
        ],
        'is_grouped' => TRUE,
        'group_info' => [
          'label' => 'name',
          'identifier' => 'name',
          'default_group' => 'All',
          'group_items' => [
            1 => [
              'title' => 'Name is equal to Ringo',
              'operator' => '=',
              'value' => 'Ringo',
            ],
            2 => [
              'title' => 'Name is not equal to Ringo',
              'operator' => '!=',
              'value' => 'Ringo',
            ],
          ],
        ],
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    return $filters;
  }

}
