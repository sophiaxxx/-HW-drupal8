<?php

namespace Drupal\Tests\views\Kernel\Handler;

use Drupal\Tests\views\Kernel\ViewsKernelTestBase;
use Drupal\views\Views;

/**
 * Tests the combine filter handler.
 *
 * @group views
 */
class FilterCombineTest extends ViewsKernelTestBase {

  /**
<<<<<<< HEAD
=======
   * {@inheritdoc}
   */
  public static $modules = ['entity_test'];

  /**
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
   * Views used by this test.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $testViews = array('test_view');
=======
  public static $testViews = ['test_view', 'entity_test_fields'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Map column names.
   *
   * @var array
   */
<<<<<<< HEAD
  protected $columnMap = array(
    'views_test_data_name' => 'name',
    'views_test_data_job' => 'job',
  );
=======
  protected $columnMap = [
    'views_test_data_name' => 'name',
    'views_test_data_job' => 'job',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp($import_test_views = TRUE) {
    parent::setUp($import_test_views);

    $this->installEntitySchema('entity_test');
  }
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  public function testFilterCombineContains() {
    $view = Views::getView('test_view');
    $view->setDisplay();

    $fields = $view->displayHandlers->get('default')->getOption('fields');
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('fields', $fields + array(
      'job' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('fields', $fields + [
      'job' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'job',
        'table' => 'views_test_data',
        'field' => 'job',
        'relationship' => 'none',
<<<<<<< HEAD
      ),
    ));

    // Change the filtering.
    $view->displayHandlers->get('default')->overrideOption('filters', array(
      'age' => array(
=======
      ],
    ]);

    // Change the filtering.
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'age' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'combine',
        'table' => 'views',
        'field' => 'combine',
        'relationship' => 'none',
        'operator' => 'contains',
<<<<<<< HEAD
        'fields' => array(
          'name',
          'job',
        ),
        'value' => 'ing',
      ),
    ));

    $this->executeView($view);
    $resultset = array(
      array(
        'name' => 'John',
        'job' => 'Singer',
      ),
      array(
        'name' => 'George',
        'job' => 'Singer',
      ),
      array(
        'name' => 'Ringo',
        'job' => 'Drummer',
      ),
      array(
        'name' => 'Ginger',
        'job' => NULL,
      ),
    );
=======
        'fields' => [
          'name',
          'job',
        ],
        'value' => 'ing',
      ],
    ]);

    $this->executeView($view);
    $resultset = [
      [
        'name' => 'John',
        'job' => 'Singer',
      ],
      [
        'name' => 'George',
        'job' => 'Singer',
      ],
      [
        'name' => 'Ringo',
        'job' => 'Drummer',
      ],
      [
        'name' => 'Ginger',
        'job' => NULL,
      ],
    ];
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  /**
   * Tests the Combine field filter with the 'word' operator.
   */
  public function testFilterCombineWord() {
    $view = Views::getView('test_view');
    $view->setDisplay();

    $fields = $view->displayHandlers->get('default')->getOption('fields');
    $view->displayHandlers->get('default')->overrideOption('fields', $fields + [
        'job' => [
          'id' => 'job',
          'table' => 'views_test_data',
          'field' => 'job',
          'relationship' => 'none',
        ],
      ]);

    // Change the filtering.
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'age' => [
        'id' => 'combine',
        'table' => 'views',
        'field' => 'combine',
        'relationship' => 'none',
        'operator' => 'word',
        'fields' => [
          'name',
          'job',
        ],
        'value' => 'singer ringo',
      ],
    ]);

    $this->executeView($view);
    $resultset = [
      [
        'name' => 'John',
        'job' => 'Singer',
      ],
      [
        'name' => 'George',
        'job' => 'Singer',
      ],
      [
        'name' => 'Ringo',
        'job' => 'Drummer',
      ],
    ];
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  /**
   * Tests the Combine field filter with the 'allwords' operator.
   */
  public function testFilterCombineAllWords() {
    $view = Views::getView('test_view');
    $view->setDisplay();

    $fields = $view->displayHandlers->get('default')->getOption('fields');
    $view->displayHandlers->get('default')->overrideOption('fields', $fields + [
        'job' => [
          'id' => 'job',
          'table' => 'views_test_data',
          'field' => 'job',
          'relationship' => 'none',
        ],
      ]);

    // Set the filtering to allwords and simulate searching for a phrase.
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'age' => [
        'id' => 'combine',
        'table' => 'views',
        'field' => 'combine',
        'relationship' => 'none',
        'operator' => 'allwords',
        'fields' => [
          'name',
          'job',
          'age',
        ],
        'value' => '25 "john   singer"',
      ],
    ]);

    $this->executeView($view);
    $resultset = [
      [
        'name' => 'John',
        'job' => 'Singer',
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  /**
   * Tests if the filter can handle removed fields.
   *
   * Tests the combined filter handler when a field overwrite is done
   * and fields set in the combine filter are removed from the display
   * but not from the combined filter settings.
   */
  public function testFilterCombineContainsFieldsOverwritten() {
    $view = Views::getView('test_view');
    $view->setDisplay();

    $fields = $view->displayHandlers->get('default')->getOption('fields');
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('fields', $fields + array(
      'job' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('fields', $fields + [
      'job' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'job',
        'table' => 'views_test_data',
        'field' => 'job',
        'relationship' => 'none',
<<<<<<< HEAD
      ),
    ));

    // Change the filtering.
    $view->displayHandlers->get('default')->overrideOption('filters', array(
      'age' => array(
=======
      ],
    ]);

    // Change the filtering.
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'age' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'combine',
        'table' => 'views',
        'field' => 'combine',
        'relationship' => 'none',
        'operator' => 'contains',
<<<<<<< HEAD
        'fields' => array(
=======
        'fields' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
          'name',
          'job',
          // Add a dummy field to the combined fields to simulate
          // a removed or deleted field.
          'dummy',
<<<<<<< HEAD
        ),
        'value' => 'ing',
      ),
    ));
=======
        ],
        'value' => 'ing',
      ],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->executeView($view);
    // Make sure this view will not get displayed.
    $this->assertTrue($view->build_info['fail'], "View build has been marked as failed.");
    // Make sure this view does not pass validation with the right error.
    $errors = $view->validate();
<<<<<<< HEAD
    $this->assertEqual(reset($errors['default']), t('Field %field set in %filter is not set in this display.', array('%field' => 'dummy', '%filter' => 'Global: Combine fields filter')));
=======
    $this->assertEquals(t('Field %field set in %filter is not set in display %display.', ['%field' => 'dummy', '%filter' => 'Global: Combine fields filter', '%display' => 'Master']), reset($errors['default']));
  }

  /**
   * Tests that the combine field filter is not valid on displays that don't use
   * fields.
   */
  public function testNonFieldsRow() {
    $view = Views::getView('entity_test_fields');
    $view->setDisplay();

    // Set the rows to a plugin type that doesn't support fields.
    $view->displayHandlers->get('default')->overrideOption('row', [
      'type' => 'entity:entity_test',
      'options' => [
        'view_mode' => 'teaser',
      ],
    ]);
    // Change the filtering.
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'name' => [
        'id' => 'combine',
        'table' => 'views',
        'field' => 'combine',
        'relationship' => 'none',
        'operator' => 'contains',
        'fields' => [
          'name',
        ],
        'value' => 'ing',
      ],
    ]);
    $this->executeView($view);
    $errors = $view->validate();
    // Check that the right error is shown.
    $this->assertEquals(t('%display: %filter can only be used on displays that use fields. Set the style or row format for that display to one using fields to use the combine field filter.', ['%filter' => 'Global: Combine fields filter', '%display' => 'Master']), reset($errors['default']));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Additional data to test the NULL issue.
   */
  protected function dataSet() {
    $data_set = parent::dataSet();
<<<<<<< HEAD
    $data_set[] = array(
=======
    $data_set[] = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'name' => 'Ginger',
      'age' => 25,
      'job' => NULL,
      'created' => gmmktime(0, 0, 0, 1, 2, 2000),
      'status' => 1,
<<<<<<< HEAD
    );
=======
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    return $data_set;
  }

  /**
   * Allow {views_test_data}.job to be NULL.
   */
  protected function schemaDefinition() {
    $schema = parent::schemaDefinition();
    unset($schema['views_test_data']['fields']['job']['not null']);
    return $schema;
  }

}
