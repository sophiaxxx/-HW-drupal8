<?php

namespace Drupal\Tests\views\Kernel\Handler;

use Drupal\Tests\views\Kernel\ViewsKernelTestBase;
use Drupal\views\Views;

/**
 * Tests the core Drupal\views\Plugin\views\filter\InOperator handler.
 *
 * @group views
 */
class FilterInOperatorTest extends ViewsKernelTestBase {

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
    'views_test_data_age' => 'age',
  );

  function viewsData() {
=======
  protected $columnMap = [
    'views_test_data_name' => 'name',
    'views_test_data_age' => 'age',
  ];

  public function viewsData() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $data = parent::viewsData();
    $data['views_test_data']['age']['filter']['id'] = 'in_operator';
    return $data;
  }

  public function testFilterInOperatorSimple() {
    $view = Views::getView('test_view');
    $view->setDisplay();

    // Add a in_operator ordering.
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('filters', array(
      'age' => array(
        'id' => 'age',
        'field' => 'age',
        'table' => 'views_test_data',
        'value' => array(26, 30),
        'operator' => 'in',
      ),
    ));

    $this->executeView($view);

    $expected_result = array(
      array(
        'name' => 'Paul',
        'age' => 26,
      ),
      array(
        'name' => 'Meredith',
        'age' => 30,
      ),
    );
=======
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'age' => [
        'id' => 'age',
        'field' => 'age',
        'table' => 'views_test_data',
        'value' => [26, 30],
        'operator' => 'in',
      ],
    ]);

    $this->executeView($view);

    $expected_result = [
      [
        'name' => 'Paul',
        'age' => 26,
      ],
      [
        'name' => 'Meredith',
        'age' => 30,
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->assertEqual(2, count($view->result));
    $this->assertIdenticalResultset($view, $expected_result, $this->columnMap);

    $view->destroy();
    $view->setDisplay();

    // Add a in_operator ordering.
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('filters', array(
      'age' => array(
        'id' => 'age',
        'field' => 'age',
        'table' => 'views_test_data',
        'value' => array(26, 30),
        'operator' => 'not in',
      ),
    ));

    $this->executeView($view);

    $expected_result = array(
      array(
        'name' => 'John',
        'age' => 25,
      ),
      array(
        'name' => 'George',
        'age' => 27,
      ),
      array(
        'name' => 'Ringo',
        'age' => 28,
      ),
    );
=======
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'age' => [
        'id' => 'age',
        'field' => 'age',
        'table' => 'views_test_data',
        'value' => [26, 30],
        'operator' => 'not in',
      ],
    ]);

    $this->executeView($view);

    $expected_result = [
      [
        'name' => 'John',
        'age' => 25,
      ],
      [
        'name' => 'George',
        'age' => 27,
      ],
      [
        'name' => 'Ringo',
        'age' => 28,
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->assertEqual(3, count($view->result));
    $this->assertIdenticalResultset($view, $expected_result, $this->columnMap);
  }

  public function testFilterInOperatorGroupedExposedSimple() {
    $filters = $this->getGroupedExposedFilters();
    $view = Views::getView('test_view');

    // Filter: Age, Operator: in, Value: 26, 30
    $filters['age']['group_info']['default_group'] = 1;
    $view->setDisplay();
    $view->displayHandlers->get('default')->overrideOption('filters', $filters);

    $this->executeView($view);

<<<<<<< HEAD
    $expected_result = array(
      array(
        'name' => 'Paul',
        'age' => 26,
      ),
      array(
        'name' => 'Meredith',
        'age' => 30,
      ),
    );
=======
    $expected_result = [
      [
        'name' => 'Paul',
        'age' => 26,
      ],
      [
        'name' => 'Meredith',
        'age' => 30,
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->assertEqual(2, count($view->result));
    $this->assertIdenticalResultset($view, $expected_result, $this->columnMap);
  }

  public function testFilterNotInOperatorGroupedExposedSimple() {
    $filters = $this->getGroupedExposedFilters();
    $view = Views::getView('test_view');

    // Filter: Age, Operator: in, Value: 26, 30
    $filters['age']['group_info']['default_group'] = 2;
    $view->setDisplay();
    $view->displayHandlers->get('default')->overrideOption('filters', $filters);

    $this->executeView($view);

<<<<<<< HEAD
    $expected_result = array(
      array(
        'name' => 'John',
        'age' => 25,
      ),
      array(
        'name' => 'George',
        'age' => 27,
      ),
      array(
        'name' => 'Ringo',
        'age' => 28,
      ),
    );
=======
    $expected_result = [
      [
        'name' => 'John',
        'age' => 25,
      ],
      [
        'name' => 'George',
        'age' => 27,
      ],
      [
        'name' => 'Ringo',
        'age' => 28,
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->assertEqual(3, count($view->result));
    $this->assertIdenticalResultset($view, $expected_result, $this->columnMap);
  }

  protected function getGroupedExposedFilters() {
<<<<<<< HEAD
    $filters = array(
      'age' => array(
=======
    $filters = [
      'age' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'age',
        'table' => 'views_test_data',
        'field' => 'age',
        'relationship' => 'none',
        'exposed' => TRUE,
<<<<<<< HEAD
        'expose' => array(
          'operator' => 'age_op',
          'label' => 'age',
          'identifier' => 'age',
        ),
        'is_grouped' => TRUE,
        'group_info' => array(
          'label' => 'age',
          'identifier' => 'age',
          'default_group' => 'All',
          'group_items' => array(
            1 => array(
              'title' => 'Age is one of 26, 30',
              'operator' => 'in',
              'value' => array(26, 30),
            ),
            2 => array(
              'title' => 'Age is not one of 26, 30',
              'operator' => 'not in',
              'value' => array(26, 30),
            ),
          ),
        ),
      ),
    );
=======
        'expose' => [
          'operator' => 'age_op',
          'label' => 'age',
          'identifier' => 'age',
        ],
        'is_grouped' => TRUE,
        'group_info' => [
          'label' => 'age',
          'identifier' => 'age',
          'default_group' => 'All',
          'group_items' => [
            1 => [
              'title' => 'Age is one of 26, 30',
              'operator' => 'in',
              'value' => [26, 30],
            ],
            2 => [
              'title' => 'Age is not one of 26, 30',
              'operator' => 'not in',
              'value' => [26, 30],
            ],
          ],
        ],
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    return $filters;
  }

}
