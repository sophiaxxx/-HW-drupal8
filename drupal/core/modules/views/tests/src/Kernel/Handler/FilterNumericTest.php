<?php

namespace Drupal\Tests\views\Kernel\Handler;

use Drupal\Tests\views\Kernel\ViewsKernelTestBase;
use Drupal\views\Views;

/**
 * Tests the numeric filter handler.
 *
 * @group views
 */
class FilterNumericTest extends ViewsKernelTestBase {

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
    $data['views_test_data']['age']['filter']['allow empty'] = TRUE;
    $data['views_test_data']['id']['filter']['allow empty'] = FALSE;

    return $data;
  }

  public function testFilterNumericSimple() {
    $view = Views::getView('test_view');
    $view->setDisplay();

    // Change the filtering
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('filters', array(
      'age' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'age' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'age',
        'table' => 'views_test_data',
        'field' => 'age',
        'relationship' => 'none',
        'operator' => '=',
<<<<<<< HEAD
        'value' => array('value' => 28),
      ),
    ));

    $this->executeView($view);
    $resultset = array(
      array(
        'name' => 'Ringo',
        'age' => 28,
      ),
    );
=======
        'value' => ['value' => 28],
      ],
    ]);

    $this->executeView($view);
    $resultset = [
      [
        'name' => 'Ringo',
        'age' => 28,
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testFilterNumericExposedGroupedSimple() {
    $filters = $this->getGroupedExposedFilters();
    $view = Views::getView('test_view');
    $view->newDisplay('page', 'Page', 'page_1');

    // Filter: Age, Operator: =, Value: 28
    $filters['age']['group_info']['default_group'] = 1;
    $view->setDisplay('page_1');
    $view->displayHandlers->get('page_1')->overrideOption('filters', $filters);
    $view->save();
    $this->container->get('router.builder')->rebuild();

    $this->executeView($view);
<<<<<<< HEAD
    $resultset = array(
      array(
        'name' => 'Ringo',
        'age' => 28,
      ),
    );
=======
    $resultset = [
      [
        'name' => 'Ringo',
        'age' => 28,
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testFilterNumericBetween() {
    $view = Views::getView('test_view');
    $view->setDisplay();

    // Change the filtering
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('filters', array(
      'age' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'age' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'age',
        'table' => 'views_test_data',
        'field' => 'age',
        'relationship' => 'none',
        'operator' => 'between',
<<<<<<< HEAD
        'value' => array(
          'min' => 26,
          'max' => 29,
        ),
      ),
    ));

    $this->executeView($view);
    $resultset = array(
      array(
        'name' => 'George',
        'age' => 27,
      ),
      array(
        'name' => 'Ringo',
        'age' => 28,
      ),
      array(
        'name' => 'Paul',
        'age' => 26,
      ),
    );
=======
        'value' => [
          'min' => 26,
          'max' => 29,
        ],
      ],
    ]);

    $this->executeView($view);
    $resultset = [
      [
        'name' => 'George',
        'age' => 27,
      ],
      [
        'name' => 'Ringo',
        'age' => 28,
      ],
      [
        'name' => 'Paul',
        'age' => 26,
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);

    // test not between
    $view->destroy();
    $view->setDisplay();

<<<<<<< HEAD
      // Change the filtering
    $view->displayHandlers->get('default')->overrideOption('filters', array(
      'age' => array(
=======
    // Change the filtering
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'age' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'age',
        'table' => 'views_test_data',
        'field' => 'age',
        'relationship' => 'none',
        'operator' => 'not between',
<<<<<<< HEAD
        'value' => array(
          'min' => 26,
          'max' => 29,
        ),
      ),
    ));

    $this->executeView($view);
    $resultset = array(
      array(
        'name' => 'John',
        'age' => 25,
      ),
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
        'value' => [
          'min' => 26,
          'max' => 29,
        ],
      ],
    ]);

    $this->executeView($view);
    $resultset = [
      [
        'name' => 'John',
        'age' => 25,
      ],
      [
        'name' => 'Meredith',
        'age' => 30,
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testFilterNumericExposedGroupedBetween() {
    $filters = $this->getGroupedExposedFilters();
    $view = Views::getView('test_view');
    $view->newDisplay('page', 'Page', 'page_1');

    // Filter: Age, Operator: between, Value: 26 and 29
    $filters['age']['group_info']['default_group'] = 2;
    $view->setDisplay('page_1');
    $view->displayHandlers->get('page_1')->overrideOption('filters', $filters);
    $view->save();
    $this->container->get('router.builder')->rebuild();

    $this->executeView($view);
<<<<<<< HEAD
    $resultset = array(
      array(
        'name' => 'George',
        'age' => 27,
      ),
      array(
        'name' => 'Ringo',
        'age' => 28,
      ),
      array(
        'name' => 'Paul',
        'age' => 26,
      ),
    );
=======
    $resultset = [
      [
        'name' => 'George',
        'age' => 27,
      ],
      [
        'name' => 'Ringo',
        'age' => 28,
      ],
      [
        'name' => 'Paul',
        'age' => 26,
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testFilterNumericExposedGroupedNotBetween() {
    $filters = $this->getGroupedExposedFilters();
    $view = Views::getView('test_view');
    $view->newDisplay('page', 'Page', 'page_1');

    // Filter: Age, Operator: between, Value: 26 and 29
    $filters['age']['group_info']['default_group'] = 3;
    $view->setDisplay('page_1');
    $view->displayHandlers->get('page_1')->overrideOption('filters', $filters);
    $view->save();
    $this->container->get('router.builder')->rebuild();

    $this->executeView($view);
<<<<<<< HEAD
    $resultset = array(
      array(
        'name' => 'John',
        'age' => 25,
      ),
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
    $resultset = [
      [
        'name' => 'John',
        'age' => 25,
      ],
      [
        'name' => 'Meredith',
        'age' => 30,
      ],
    ];
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  /**
   * Tests the numeric filter handler with the 'regular_expression' operator.
   */
  public function testFilterNumericRegularExpression() {
    $view = Views::getView('test_view');
    $view->setDisplay();

    // Filtering by regular expression pattern.
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'age' => [
        'id' => 'age',
        'table' => 'views_test_data',
        'field' => 'age',
        'relationship' => 'none',
        'operator' => 'regular_expression',
        'value' => [
          'value' => '2[8]',
        ],
      ],
    ]);

    $this->executeView($view);
    $resultset = [
      [
        'name' => 'Ringo',
        'age' => 28,
      ],
    ];
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  /**
   * Tests the numeric filter handler with the 'regular_expression' operator
   * to grouped exposed filters.
   */
  public function testFilterNumericExposedGroupedRegularExpression() {
    $filters = $this->getGroupedExposedFilters();
    $view = Views::getView('test_view');
    $view->newDisplay('page', 'Page', 'page_1');

    // Filter: Age, Operator: regular_expression, Value: 2[7-8]
    $filters['age']['group_info']['default_group'] = 6;
    $view->setDisplay('page_1');
    $view->displayHandlers->get('page_1')->overrideOption('filters', $filters);
    $view->save();

    $this->executeView($view);
    $resultset = [
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
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testFilterNumericEmpty() {
    $view = Views::getView('test_view');
    $view->setDisplay();

    // Change the filtering
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('filters', array(
      'age' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'age' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'age',
        'table' => 'views_test_data',
        'field' => 'age',
        'relationship' => 'none',
        'operator' => 'empty',
<<<<<<< HEAD
      ),
    ));

    $this->executeView($view);
    $resultset = array(
    );
=======
      ],
    ]);

    $this->executeView($view);
    $resultset = [
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);

    $view->destroy();
    $view->setDisplay();

    // Change the filtering
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('filters', array(
      'age' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'age' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'age',
        'table' => 'views_test_data',
        'field' => 'age',
        'relationship' => 'none',
        'operator' => 'not empty',
<<<<<<< HEAD
      ),
    ));

    $this->executeView($view);
    $resultset = array(
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
      ],
    ]);

    $this->executeView($view);
    $resultset = [
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
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testFilterNumericExposedGroupedEmpty() {
    $filters = $this->getGroupedExposedFilters();
    $view = Views::getView('test_view');
    $view->newDisplay('page', 'Page', 'page_1');

    // Filter: Age, Operator: empty, Value:
    $filters['age']['group_info']['default_group'] = 4;
    $view->setDisplay('page_1');
    $view->displayHandlers->get('page_1')->overrideOption('filters', $filters);
    $view->save();
    $this->container->get('router.builder')->rebuild();

    $this->executeView($view);
<<<<<<< HEAD
    $resultset = array(
    );
=======
    $resultset = [
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testFilterNumericExposedGroupedNotEmpty() {
    $filters = $this->getGroupedExposedFilters();
    $view = Views::getView('test_view');
    $view->newDisplay('page', 'Page', 'page_1');

    // Filter: Age, Operator: empty, Value:
    $filters['age']['group_info']['default_group'] = 5;
    $view->setDisplay('page_1');
    $view->displayHandlers->get('page_1')->overrideOption('filters', $filters);
    $view->save();
    $this->container->get('router.builder')->rebuild();

    $this->executeView($view);
<<<<<<< HEAD
    $resultset = array(
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
    $resultset = [
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
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testAllowEmpty() {
    $view = Views::getView('test_view');
    $view->setDisplay();

<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('filters', array(
      'id' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'id' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'id',
        'table' => 'views_test_data',
        'field' => 'id',
        'relationship' => 'none',
<<<<<<< HEAD
      ),
      'age' => array(
=======
      ],
      'age' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'age',
        'table' => 'views_test_data',
        'field' => 'age',
        'relationship' => 'none',
<<<<<<< HEAD
      ),
    ));
=======
      ],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $view->initHandlers();

    $id_operators = $view->filter['id']->operators();
    $age_operators = $view->filter['age']->operators();

    $this->assertFalse(isset($id_operators['empty']));
    $this->assertFalse(isset($id_operators['not empty']));
    $this->assertTrue(isset($age_operators['empty']));
    $this->assertTrue(isset($age_operators['not empty']));
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
        'plugin_id' => 'numeric',
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
              'title' => 'Age is 28',
              'operator' => '=',
              'value' => array('value' => 28),
            ),
            2 => array(
              'title' => 'Age is between 26 and 29',
              'operator' => 'between',
              'value' => array(
                'min' => 26,
                'max' => 29,
              ),
            ),
            3 => array(
              'title' => 'Age is not between 26 and 29',
              'operator' => 'not between',
              'value' => array(
                'min' => 26,
                'max' => 29,
              ),
            ),
            4 => array(
              'title' => 'Age is empty',
              'operator' => 'empty',
            ),
            5 => array(
              'title' => 'Age is not empty',
              'operator' => 'not empty',
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
              'title' => 'Age is 28',
              'operator' => '=',
              'value' => ['value' => 28],
            ],
            2 => [
              'title' => 'Age is between 26 and 29',
              'operator' => 'between',
              'value' => [
                'min' => 26,
                'max' => 29,
              ],
            ],
            3 => [
              'title' => 'Age is not between 26 and 29',
              'operator' => 'not between',
              'value' => [
                'min' => 26,
                'max' => 29,
              ],
            ],
            4 => [
              'title' => 'Age is empty',
              'operator' => 'empty',
            ],
            5 => [
              'title' => 'Age is not empty',
              'operator' => 'not empty',
            ],
            6 => [
              'title' => 'Age is regexp 2[7-8]',
              'operator' => 'regular_expression',
              'value' => [
                'value' => '2[7-8]',
              ],
            ],
          ],
        ],
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    return $filters;
  }

}
