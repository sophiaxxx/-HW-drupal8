<?php

namespace Drupal\Tests\views\Kernel\Handler;

use Drupal\Tests\views\Kernel\ViewsKernelTestBase;
use Drupal\views\Views;

/**
 * Tests the core Drupal\views\Plugin\views\filter\BooleanOperatorString
 * handler.
 *
 * @group views
 * @see \Drupal\views\Plugin\views\filter\BooleanOperatorString
 */
class FilterBooleanOperatorStringTest extends ViewsKernelTestBase {

  /**
   * The modules to enable for this test.
   *
   * @var array
   */
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
    'views_test_data_id' => 'id',
  );
=======
  protected $columnMap = [
    'views_test_data_id' => 'id',
  ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * {@inheritdoc}
   */
  protected function schemaDefinition() {
    $schema = parent::schemaDefinition();

<<<<<<< HEAD
    $schema['views_test_data']['fields']['status'] = array(
=======
    $schema['views_test_data']['fields']['status'] = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'description' => 'The status of this record',
      'type' => 'varchar',
      'length' => 255,
      'not null' => TRUE,
      'default' => '',
<<<<<<< HEAD
    );
=======
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  protected function viewsData() {
    $views_data = parent::viewsData();

    $views_data['views_test_data']['status']['filter']['id'] = 'boolean_string';

    return $views_data;
  }

  /**
   * {@inheritdoc}
   */
  protected function dataSet() {
    $data = parent::dataSet();

    foreach ($data as &$row) {
      if ($row['status']) {
        $row['status'] = 'Enabled';
      }
      else {
        $row['status'] = '';
      }
    }

    return $data;
  }

  /**
   * Tests the BooleanOperatorString filter.
   */
  public function testFilterBooleanOperatorString() {
    $view = Views::getView('test_view');
    $view->setDisplay();

    // Add a the status boolean filter.
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('filters', array(
      'status' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'status' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'status',
        'field' => 'status',
        'table' => 'views_test_data',
        'value' => 0,
<<<<<<< HEAD
      ),
    ));
    $this->executeView($view);

    $expected_result = array(
      array('id' => 2),
      array('id' => 4),
    );
=======
      ],
    ]);
    $this->executeView($view);

    $expected_result = [
      ['id' => 2],
      ['id' => 4],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->assertEqual(2, count($view->result));
    $this->assertIdenticalResultset($view, $expected_result, $this->columnMap);

    $view->destroy();
    $view->setDisplay();

    // Add the status boolean filter.
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('filters', array(
      'status' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'status' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'status',
        'field' => 'status',
        'table' => 'views_test_data',
        'value' => 1,
<<<<<<< HEAD
      ),
    ));
    $this->executeView($view);

    $expected_result = array(
      array('id' => 1),
      array('id' => 3),
      array('id' => 5),
    );
=======
      ],
    ]);
    $this->executeView($view);

    $expected_result = [
      ['id' => 1],
      ['id' => 3],
      ['id' => 5],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->assertEqual(3, count($view->result));
    $this->assertIdenticalResultset($view, $expected_result, $this->columnMap);
  }

  /**
   * Tests the Boolean filter with grouped exposed form enabled.
   */
  public function testFilterGroupedExposed() {
    $filters = $this->getGroupedExposedFilters();
    $view = Views::getView('test_view');

<<<<<<< HEAD
    $view->setExposedInput(array('status' => 1));
=======
    $view->setExposedInput(['status' => 1]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $view->setDisplay();
    $view->displayHandlers->get('default')->overrideOption('filters', $filters);

    $this->executeView($view);

<<<<<<< HEAD
    $expected_result = array(
      array('id' => 1),
      array('id' => 3),
      array('id' => 5),
    );
=======
    $expected_result = [
      ['id' => 1],
      ['id' => 3],
      ['id' => 5],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->assertEqual(3, count($view->result));
    $this->assertIdenticalResultset($view, $expected_result, $this->columnMap);
    $view->destroy();

<<<<<<< HEAD
    $view->setExposedInput(array('status' => 2));
=======
    $view->setExposedInput(['status' => 2]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $view->setDisplay();
    $view->displayHandlers->get('default')->overrideOption('filters', $filters);

    $this->executeView($view);

<<<<<<< HEAD
    $expected_result = array(
      array('id' => 2),
      array('id' => 4),
    );
=======
    $expected_result = [
      ['id' => 2],
      ['id' => 4],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->assertEqual(2, count($view->result));
    $this->assertIdenticalResultset($view, $expected_result, $this->columnMap);
  }

  /**
   * Provides grouped exposed filter configuration.
   *
   * @return array
   *   Returns the filter configuration for exposed filters.
   */
  protected function getGroupedExposedFilters() {
<<<<<<< HEAD
    $filters = array(
      'status' => array(
=======
    $filters = [
      'status' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'status',
        'table' => 'views_test_data',
        'field' => 'status',
        'relationship' => 'none',
        'exposed' => TRUE,
<<<<<<< HEAD
        'expose' => array(
          'operator' => 'status_op',
          'label' => 'status',
          'identifier' => 'status',
        ),
        'is_grouped' => TRUE,
        'group_info' => array(
          'label' => 'status',
          'identifier' => 'status',
          'default_group' => 'All',
          'group_items' => array(
            1 => array(
              'title' => 'Active',
              'operator' => '=',
              'value' => '1',
            ),
            2 => array(
              'title' => 'Blocked',
              'operator' => '=',
              'value' => '0',
            ),
          ),
        ),
      ),
    );
=======
        'expose' => [
          'operator' => 'status_op',
          'label' => 'status',
          'identifier' => 'status',
        ],
        'is_grouped' => TRUE,
        'group_info' => [
          'label' => 'status',
          'identifier' => 'status',
          'default_group' => 'All',
          'group_items' => [
            1 => [
              'title' => 'Active',
              'operator' => '=',
              'value' => '1',
            ],
            2 => [
              'title' => 'Blocked',
              'operator' => '=',
              'value' => '0',
            ],
          ],
        ],
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    return $filters;
  }

}
