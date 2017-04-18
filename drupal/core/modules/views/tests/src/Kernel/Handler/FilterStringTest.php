<?php

namespace Drupal\Tests\views\Kernel\Handler;

use Drupal\Tests\views\Kernel\ViewsKernelTestBase;
use Drupal\views\Views;

/**
 * Tests the core Drupal\views\Plugin\views\filter\StringFilter handler.
 *
 * @group views
 */
class FilterStringTest extends ViewsKernelTestBase {

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
    $data['views_test_data']['name']['filter']['allow empty'] = TRUE;
    $data['views_test_data']['job']['filter']['allow empty'] = FALSE;
    $data['views_test_data']['description'] = $data['views_test_data']['name'];

    return $data;
  }

  protected function schemaDefinition() {
    $schema = parent::schemaDefinition();
<<<<<<< HEAD
    $schema['views_test_data']['fields']['description'] = array(
=======
    $schema['views_test_data']['fields']['description'] = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'description' => "A person's description",
      'type' => 'text',
      'not null' => FALSE,
      'size' => 'big',
<<<<<<< HEAD
    );
=======
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    return $schema;
  }

  /**
   * An extended test dataset.
   */
  protected function dataSet() {
    $dataset = parent::dataSet();
    $dataset[0]['description'] = 'John Winston Ono Lennon, MBE (9 October 1940 – 8 December 1980) was an English musician and singer-songwriter who rose to worldwide fame as one of the founding members of The Beatles, one of the most commercially successful and critically acclaimed acts in the history of popular music. Along with fellow Beatle Paul McCartney, he formed one of the most successful songwriting partnerships of the 20th century.';
    $dataset[1]['description'] = 'George Harrison,[1] MBE (25 February 1943 – 29 November 2001)[2] was an English rock guitarist, singer-songwriter, actor and film producer who achieved international fame as lead guitarist of The Beatles.';
    $dataset[2]['description'] = 'Richard Starkey, MBE (born 7 July 1940), better known by his stage name Ringo Starr, is an English musician, singer-songwriter, and actor who gained worldwide fame as the drummer for The Beatles.';
    $dataset[3]['description'] = 'Sir James Paul McCartney, MBE (born 18 June 1942) is an English musician, singer-songwriter and composer. Formerly of The Beatles (1960–1970) and Wings (1971–1981), McCartney is the most commercially successful songwriter in the history of popular music, according to Guinness World Records.[1]';
    $dataset[4]['description'] = NULL;

    return $dataset;
  }

  /**
   * Build and return a Page view of the views_test_data table.
   *
   * @return view
   */
  protected function getBasicPageView() {
    $view = Views::getView('test_view');

    // In order to test exposed filters, we have to disable
    // the exposed forms cache.
    \Drupal::service('views.exposed_form_cache')->reset();

    $view->newDisplay('page', 'Page', 'page_1');
    return $view;
  }

<<<<<<< HEAD
  function testFilterStringEqual() {
=======
  public function testFilterStringEqual() {
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
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  function testFilterStringGroupedExposedEqual() {
=======
      ],
    ]);

    $this->executeView($view);
    $resultset = [
      [
        'name' => 'Ringo',
      ],
    ];
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testFilterStringGroupedExposedEqual() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $filters = $this->getGroupedExposedFilters();
    $view = $this->getBasicPageView();

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
=======
    $resultset = [
      [
        'name' => 'Ringo',
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

<<<<<<< HEAD
  function testFilterStringNotEqual() {
=======
  public function testFilterStringNotEqual() {
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
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  function testFilterStringGroupedExposedNotEqual() {
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
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testFilterStringGroupedExposedNotEqual() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $filters = $this->getGroupedExposedFilters();
    $view = $this->getBasicPageView();

    // Filter: Name, Operator: !=, Value: Ringo
    $filters['name']['group_info']['default_group'] = '2';

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

<<<<<<< HEAD
  function testFilterStringContains() {
=======
  public function testFilterStringContains() {
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
        'operator' => 'contains',
        'value' => 'ing',
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


<<<<<<< HEAD
  function testFilterStringGroupedExposedContains() {
=======
  public function testFilterStringGroupedExposedContains() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $filters = $this->getGroupedExposedFilters();
    $view = $this->getBasicPageView();

    // Filter: Name, Operator: contains, Value: ing
    $filters['name']['group_info']['default_group'] = '3';
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
=======
    $resultset = [
      [
        'name' => 'Ringo',
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }


<<<<<<< HEAD
  function testFilterStringWord() {
=======
  public function testFilterStringWord() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $view = Views::getView('test_view');
    $view->setDisplay();

    // Change the filtering
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('filters', array(
      'description' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'description' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'description',
        'table' => 'views_test_data',
        'field' => 'description',
        'relationship' => 'none',
        'operator' => 'word',
        'value' => 'actor',
<<<<<<< HEAD
      ),
    ));

    $this->executeView($view);
    $resultset = array(
      array(
        'name' => 'George',
      ),
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
        'name' => 'George',
      ],
      [
        'name' => 'Ringo',
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
    $view->destroy();

    $view = Views::getView('test_view');
    $view->setDisplay();

    // Change the filtering
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('filters', array(
      'description' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'description' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'description',
        'table' => 'views_test_data',
        'field' => 'description',
        'relationship' => 'none',
        'operator' => 'allwords',
        'value' => 'Richard Starkey',
<<<<<<< HEAD
      ),
    ));

    $this->executeView($view);
    $resultset = array(
      array(
        'name' => 'Ringo',
      ),
    );
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }


  function testFilterStringGroupedExposedWord() {
      $filters = $this->getGroupedExposedFilters();
=======
      ],
    ]);

    $this->executeView($view);
    $resultset = [
      [
        'name' => 'Ringo',
      ],
    ];
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
    $view->destroy();

    $view = Views::getView('test_view');
    $view->setDisplay();

    // Change the filtering to a sting containing only illegal characters.
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'description' => [
        'id' => 'description',
        'table' => 'views_test_data',
        'field' => 'description',
        'relationship' => 'none',
        'operator' => 'allwords',
        'value' => ':-)',
      ],
    ]);

    $this->executeView($view);
    $resultset = [
      [
        'name' => 'Ringo',
      ],
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
    $this->assertIdenticalResultset($view, $resultset);
  }


  public function testFilterStringGroupedExposedWord() {
    $filters = $this->getGroupedExposedFilters();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $view = $this->getBasicPageView();

    // Filter: Name, Operator: contains, Value: ing
    $filters['name']['group_info']['default_group'] = '3';
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
=======
    $resultset = [
      [
        'name' => 'Ringo',
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
    $view->destroy();

    $filters = $this->getGroupedExposedFilters();
    $view = $this->getBasicPageView();

    // Filter: Description, Operator: contains, Value: actor
    $filters['description']['group_info']['default_group'] = '1';
    $view->setDisplay('page_1');
    $view->displayHandlers->get('page_1')->overrideOption('filters', $filters);

    $this->executeView($view);
<<<<<<< HEAD
    $resultset = array(
      array(
        'name' => 'George',
      ),
      array(
        'name' => 'Ringo',
      ),
    );
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  function testFilterStringStarts() {
=======
    $resultset = [
      [
        'name' => 'George',
      ],
      [
        'name' => 'Ringo',
      ],
    ];
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testFilterStringStarts() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $view = Views::getView('test_view');
    $view->setDisplay();

    // Change the filtering
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('filters', array(
      'description' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'description' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'description',
        'table' => 'views_test_data',
        'field' => 'description',
        'relationship' => 'none',
        'operator' => 'starts',
        'value' => 'George',
<<<<<<< HEAD
      ),
    ));

    $this->executeView($view);
    $resultset = array(
      array(
        'name' => 'George',
      ),
    );
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  function testFilterStringGroupedExposedStarts() {
=======
      ],
    ]);

    $this->executeView($view);
    $resultset = [
      [
        'name' => 'George',
      ],
    ];
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testFilterStringGroupedExposedStarts() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $filters = $this->getGroupedExposedFilters();
    $view = $this->getBasicPageView();

    // Filter: Name, Operator: starts, Value: George
    $filters['description']['group_info']['default_group'] = 2;
    $view->setDisplay('page_1');
    $view->displayHandlers->get('page_1')->overrideOption('filters', $filters);
    $view->save();
    $this->container->get('router.builder')->rebuild();

    $this->executeView($view);

<<<<<<< HEAD
    $resultset = array(
      array(
        'name' => 'George',
      ),
    );
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  function testFilterStringNotStarts() {
=======
    $resultset = [
      [
        'name' => 'George',
      ],
    ];
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testFilterStringNotStarts() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $view = Views::getView('test_view');
    $view->setDisplay();

    // Change the filtering
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('filters', array(
      'description' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'description' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'description',
        'table' => 'views_test_data',
        'field' => 'description',
        'relationship' => 'none',
        'operator' => 'not_starts',
        'value' => 'George',
<<<<<<< HEAD
      ),
    ));

    $this->executeView($view);
    $resultset = array(
      array(
        'name' => 'John',
      ),
      array(
        'name' => 'Ringo',
      ),
      array(
        'name' => 'Paul',
      ),
      // There is no Meredith returned because his description is empty
    );
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  function testFilterStringGroupedExposedNotStarts() {
=======
      ],
    ]);

    $this->executeView($view);
    $resultset = [
      [
        'name' => 'John',
      ],
      [
        'name' => 'Ringo',
      ],
      [
        'name' => 'Paul',
      ],
      // There is no Meredith returned because his description is empty
    ];
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testFilterStringGroupedExposedNotStarts() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $filters = $this->getGroupedExposedFilters();
    $view = $this->getBasicPageView();

    // Filter: Name, Operator: not_starts, Value: George
    $filters['description']['group_info']['default_group'] = 3;
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
        'name' => 'Ringo',
      ),
      array(
        'name' => 'Paul',
      ),
      // There is no Meredith returned because his description is empty
    );
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  function testFilterStringEnds() {
=======
    $resultset = [
      [
        'name' => 'John',
      ],
      [
        'name' => 'Ringo',
      ],
      [
        'name' => 'Paul',
      ],
      // There is no Meredith returned because his description is empty
    ];
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testFilterStringEnds() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $view = Views::getView('test_view');
    $view->setDisplay();

    // Change the filtering
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('filters', array(
      'description' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'description' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'description',
        'table' => 'views_test_data',
        'field' => 'description',
        'relationship' => 'none',
        'operator' => 'ends',
        'value' => 'Beatles.',
<<<<<<< HEAD
      ),
    ));

    $this->executeView($view);
    $resultset = array(
      array(
        'name' => 'George',
      ),
      array(
        'name' => 'Ringo',
      ),
    );
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  function testFilterStringGroupedExposedEnds() {
=======
      ],
    ]);

    $this->executeView($view);
    $resultset = [
      [
        'name' => 'George',
      ],
      [
        'name' => 'Ringo',
      ],
    ];
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testFilterStringGroupedExposedEnds() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $filters = $this->getGroupedExposedFilters();
    $view = $this->getBasicPageView();

    // Filter: Description, Operator: ends, Value: Beatles
    $filters['description']['group_info']['default_group'] = 4;
    $view->setDisplay('page_1');
    $view->displayHandlers->get('page_1')->overrideOption('filters', $filters);
    $view->save();
    $this->container->get('router.builder')->rebuild();

    $this->executeView($view);

<<<<<<< HEAD
    $resultset = array(
      array(
        'name' => 'George',
      ),
      array(
        'name' => 'Ringo',
      ),
    );
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  function testFilterStringNotEnds() {
=======
    $resultset = [
      [
        'name' => 'George',
      ],
      [
        'name' => 'Ringo',
      ],
    ];
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testFilterStringNotEnds() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $view = Views::getView('test_view');
    $view->setDisplay();

    // Change the filtering
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('filters', array(
      'description' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'description' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'description',
        'table' => 'views_test_data',
        'field' => 'description',
        'relationship' => 'none',
        'operator' => 'not_ends',
        'value' => 'Beatles.',
<<<<<<< HEAD
      ),
    ));

    $this->executeView($view);
    $resultset = array(
      array(
        'name' => 'John',
      ),
      array(
        'name' => 'Paul',
      ),
      // There is no Meredith returned because his description is empty
    );
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  function testFilterStringGroupedExposedNotEnds() {
=======
      ],
    ]);

    $this->executeView($view);
    $resultset = [
      [
        'name' => 'John',
      ],
      [
        'name' => 'Paul',
      ],
      // There is no Meredith returned because his description is empty
    ];
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testFilterStringGroupedExposedNotEnds() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $filters = $this->getGroupedExposedFilters();
    $view = $this->getBasicPageView();

    // Filter: Description, Operator: not_ends, Value: Beatles
    $filters['description']['group_info']['default_group'] = 5;
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
        'name' => 'Paul',
      ),
      // There is no Meredith returned because his description is empty
    );
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  function testFilterStringNot() {
=======
    $resultset = [
      [
        'name' => 'John',
      ],
      [
        'name' => 'Paul',
      ],
      // There is no Meredith returned because his description is empty
    ];
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testFilterStringNot() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $view = Views::getView('test_view');
    $view->setDisplay();

    // Change the filtering
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('filters', array(
      'description' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'description' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'description',
        'table' => 'views_test_data',
        'field' => 'description',
        'relationship' => 'none',
        'operator' => 'not',
        'value' => 'Beatles.',
<<<<<<< HEAD
      ),
    ));

    $this->executeView($view);
    $resultset = array(
      array(
        'name' => 'John',
      ),
      array(
        'name' => 'Paul',
      ),
      // There is no Meredith returned because his description is empty
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
        'name' => 'Paul',
      ],
      // There is no Meredith returned because his description is empty
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }


<<<<<<< HEAD
  function testFilterStringGroupedExposedNot() {
=======
  public function testFilterStringGroupedExposedNot() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $filters = $this->getGroupedExposedFilters();
    $view = $this->getBasicPageView();

    // Filter: Description, Operator: not (does not contains), Value: Beatles
    $filters['description']['group_info']['default_group'] = 6;
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
        'name' => 'Paul',
      ),
      // There is no Meredith returned because his description is empty
    );
=======
    $resultset = [
      [
        'name' => 'John',
      ],
      [
        'name' => 'Paul',
      ],
      // There is no Meredith returned because his description is empty
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);

  }

<<<<<<< HEAD
  function testFilterStringShorter() {
=======
  public function testFilterStringShorter() {
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
        'operator' => 'shorterthan',
        'value' => 5,
<<<<<<< HEAD
      ),
    ));

    $this->executeView($view);
    $resultset = array(
      array(
        'name' => 'John',
      ),
      array(
        'name' => 'Paul',
      ),
    );
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  function testFilterStringGroupedExposedShorter() {
=======
      ],
    ]);

    $this->executeView($view);
    $resultset = [
      [
        'name' => 'John',
      ],
      [
        'name' => 'Paul',
      ],
    ];
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testFilterStringGroupedExposedShorter() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $filters = $this->getGroupedExposedFilters();
    $view = $this->getBasicPageView();

    // Filter: Name, Operator: shorterthan, Value: 5
    $filters['name']['group_info']['default_group'] = 4;
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
        'name' => 'Paul',
      ),
    );
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  function testFilterStringLonger() {
=======
    $resultset = [
      [
        'name' => 'John',
      ],
      [
        'name' => 'Paul',
      ],
    ];
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testFilterStringLonger() {
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
        'operator' => 'longerthan',
        'value' => 7,
<<<<<<< HEAD
      ),
    ));

    $this->executeView($view);
    $resultset = array(
      array(
        'name' => 'Meredith',
      ),
    );
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  function testFilterStringGroupedExposedLonger() {
=======
      ],
    ]);

    $this->executeView($view);
    $resultset = [
      [
        'name' => 'Meredith',
      ],
    ];
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testFilterStringGroupedExposedLonger() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $filters = $this->getGroupedExposedFilters();
    $view = $this->getBasicPageView();

    // Filter: Name, Operator: longerthan, Value: 4
    $filters['name']['group_info']['default_group'] = 5;
    $view->setDisplay('page_1');
    $view->displayHandlers->get('page_1')->overrideOption('filters', $filters);
    $view->save();
    $this->container->get('router.builder')->rebuild();

    $this->executeView($view);
<<<<<<< HEAD
    $resultset = array(
      array(
        'name' => 'Meredith',
      ),
    );
=======
    $resultset = [
      [
        'name' => 'Meredith',
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }


<<<<<<< HEAD
  function testFilterStringEmpty() {
=======
  public function testFilterStringEmpty() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $view = Views::getView('test_view');
    $view->setDisplay();

    // Change the filtering
<<<<<<< HEAD
    $view->displayHandlers->get('default')->overrideOption('filters', array(
      'description' => array(
=======
    $view->displayHandlers->get('default')->overrideOption('filters', [
      'description' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'description',
        'table' => 'views_test_data',
        'field' => 'description',
        'relationship' => 'none',
        'operator' => 'empty',
<<<<<<< HEAD
      ),
    ));

    $this->executeView($view);
    $resultset = array(
      array(
        'name' => 'Meredith',
      ),
    );
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  function testFilterStringGroupedExposedEmpty() {
=======
      ],
    ]);

    $this->executeView($view);
    $resultset = [
      [
        'name' => 'Meredith',
      ],
    ];
    $this->assertIdenticalResultset($view, $resultset, $this->columnMap);
  }

  public function testFilterStringGroupedExposedEmpty() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $filters = $this->getGroupedExposedFilters();
    $view = $this->getBasicPageView();

    // Filter: Description, Operator: empty, Value:
    $filters['description']['group_info']['default_group'] = 7;
    $view->setDisplay('page_1');
    $view->displayHandlers->get('page_1')->overrideOption('filters', $filters);
    $view->save();
    $this->container->get('router.builder')->rebuild();

    $this->executeView($view);
<<<<<<< HEAD
    $resultset = array(
      array(
        'name' => 'Meredith',
      ),
    );
=======
    $resultset = [
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
        'plugin_id' => 'string',
        'table' => 'views_test_data',
        'field' => 'name',
        'relationship' => 'none',
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
              'title' => 'Is Ringo',
              'operator' => '=',
              'value' => 'Ringo',
            ),
            2 => array(
              'title' => 'Is not Ringo',
              'operator' => '!=',
              'value' => 'Ringo',
            ),
            3 => array(
              'title' => 'Contains ing',
              'operator' => 'contains',
              'value' => 'ing',
            ),
            4 => array(
              'title' => 'Shorter than 5 letters',
              'operator' => 'shorterthan',
              'value' => 5,
            ),
            5 => array(
              'title' => 'Longer than 7 letters',
              'operator' => 'longerthan',
              'value' => 7,
            ),
          ),
        ),
      ),
      'description' => array(
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
              'title' => 'Is Ringo',
              'operator' => '=',
              'value' => 'Ringo',
            ],
            2 => [
              'title' => 'Is not Ringo',
              'operator' => '!=',
              'value' => 'Ringo',
            ],
            3 => [
              'title' => 'Contains ing',
              'operator' => 'contains',
              'value' => 'ing',
            ],
            4 => [
              'title' => 'Shorter than 5 letters',
              'operator' => 'shorterthan',
              'value' => 5,
            ],
            5 => [
              'title' => 'Longer than 7 letters',
              'operator' => 'longerthan',
              'value' => 7,
            ],
          ],
        ],
      ],
      'description' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'description',
        'plugin_id' => 'string',
        'table' => 'views_test_data',
        'field' => 'description',
        'relationship' => 'none',
        'exposed' => TRUE,
<<<<<<< HEAD
        'expose' => array(
          'operator' => 'description_op',
          'label' => 'description',
          'identifier' => 'description',
        ),
        'is_grouped' => TRUE,
        'group_info' => array(
          'label' => 'description',
          'identifier' => 'description',
          'default_group' => 'All',
          'group_items' => array(
            1 => array(
              'title' => 'Contains the word: Actor',
              'operator' => 'word',
              'value' => 'actor',
            ),
            2 => array(
              'title' => 'Starts with George',
              'operator' => 'starts',
              'value' => 'George',
            ),
            3 => array(
              'title' => 'Not Starts with: George',
              'operator' => 'not_starts',
              'value' => 'George',
            ),
            4 => array(
              'title' => 'Ends with: Beatles',
              'operator' => 'ends',
              'value' => 'Beatles.',
            ),
            5 => array(
              'title' => 'Not Ends with: Beatles',
              'operator' => 'not_ends',
              'value' => 'Beatles.',
            ),
            6 => array(
              'title' => 'Does not contain: Beatles',
              'operator' => 'not',
              'value' => 'Beatles.',
            ),
            7 => array(
              'title' => 'Empty description',
              'operator' => 'empty',
              'value' => '',
            ),
          ),
        ),
      ),
    );
=======
        'expose' => [
          'operator' => 'description_op',
          'label' => 'description',
          'identifier' => 'description',
        ],
        'is_grouped' => TRUE,
        'group_info' => [
          'label' => 'description',
          'identifier' => 'description',
          'default_group' => 'All',
          'group_items' => [
            1 => [
              'title' => 'Contains the word: Actor',
              'operator' => 'word',
              'value' => 'actor',
            ],
            2 => [
              'title' => 'Starts with George',
              'operator' => 'starts',
              'value' => 'George',
            ],
            3 => [
              'title' => 'Not Starts with: George',
              'operator' => 'not_starts',
              'value' => 'George',
            ],
            4 => [
              'title' => 'Ends with: Beatles',
              'operator' => 'ends',
              'value' => 'Beatles.',
            ],
            5 => [
              'title' => 'Not Ends with: Beatles',
              'operator' => 'not_ends',
              'value' => 'Beatles.',
            ],
            6 => [
              'title' => 'Does not contain: Beatles',
              'operator' => 'not',
              'value' => 'Beatles.',
            ],
            7 => [
              'title' => 'Empty description',
              'operator' => 'empty',
              'value' => '',
            ],
          ],
        ],
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    return $filters;
  }

}
