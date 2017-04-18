<?php

namespace Drupal\Tests\views\Kernel\Handler;

use Drupal\Tests\views\Kernel\ViewsKernelTestBase;
use Drupal\views\Views;

/**
 * Tests the core date argument handlers.
 *
 * @group views
 * @see \Drupal\views\Plugin\views\argument\Date
 */
class ArgumentDateTest extends ViewsKernelTestBase {

  /**
   * Views used by this test.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $testViews = array('test_argument_date');
=======
  public static $testViews = ['test_argument_date'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Stores the column map for this testCase.
   *
   * @var array
   */
<<<<<<< HEAD
  protected $columnMap = array(
    'id' => 'id',
  );
=======
  protected $columnMap = [
    'id' => 'id',
  ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * {@inheritdoc}
   */
  public function viewsData() {
    $data = parent::viewsData();

<<<<<<< HEAD
    $date_plugins = array(
=======
    $date_plugins = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'date_fulldate',
      'date_day',
      'date_month',
      'date_week',
      'date_year',
      'date_year_month',
<<<<<<< HEAD
    );
=======
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    foreach ($date_plugins as $plugin_id) {
      $data['views_test_data'][$plugin_id] = $data['views_test_data']['created'];
      $data['views_test_data'][$plugin_id]['real field'] = 'created';
      $data['views_test_data'][$plugin_id]['argument']['id'] = $plugin_id;
    }
    return $data;
  }

  /**
   * Tests the CreatedFullDate handler.
   *
   * @see \Drupal\node\Plugin\views\argument\CreatedFullDate
   */
  public function testCreatedFullDateHandler() {
    $view = Views::getView('test_argument_date');
    $view->setDisplay('default');
<<<<<<< HEAD
    $this->executeView($view, array('20000102'));
    $expected = array();
    $expected[] = array('id' => 2);
=======
    $this->executeView($view, ['20000102']);
    $expected = [];
    $expected[] = ['id' => 2];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $expected, $this->columnMap);
    $view->destroy();

    $view->setDisplay('default');
<<<<<<< HEAD
    $this->executeView($view, array('20000101'));
    $expected = array();
    $expected[] = array('id' => 1);
    $expected[] = array('id' => 3);
    $expected[] = array('id' => 4);
    $expected[] = array('id' => 5);
=======
    $this->executeView($view, ['20000101']);
    $expected = [];
    $expected[] = ['id' => 1];
    $expected[] = ['id' => 3];
    $expected[] = ['id' => 4];
    $expected[] = ['id' => 5];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $expected, $this->columnMap);
    $view->destroy();

    $view->setDisplay('default');
<<<<<<< HEAD
    $this->executeView($view, array('20001023'));
    $expected = array();
=======
    $this->executeView($view, ['20001023']);
    $expected = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $expected, $this->columnMap);
    $view->destroy();
  }

  /**
   * Tests the Day handler.
   *
   * @see \Drupal\node\Plugin\views\argument\CreatedDay
   */
  public function testDayHandler() {
    $view = Views::getView('test_argument_date');
    $view->setDisplay('embed_1');
<<<<<<< HEAD
    $this->executeView($view, array('02'));
    $expected = array();
    $expected[] = array('id' => 2);
=======
    $this->executeView($view, ['02']);
    $expected = [];
    $expected[] = ['id' => 2];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $expected, $this->columnMap);
    $view->destroy();

    $view->setDisplay('embed_1');
<<<<<<< HEAD
    $this->executeView($view, array('01'));
    $expected = array();
    $expected[] = array('id' => 1);
    $expected[] = array('id' => 3);
    $expected[] = array('id' => 4);
    $expected[] = array('id' => 5);
=======
    $this->executeView($view, ['01']);
    $expected = [];
    $expected[] = ['id' => 1];
    $expected[] = ['id' => 3];
    $expected[] = ['id' => 4];
    $expected[] = ['id' => 5];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $expected, $this->columnMap);
    $view->destroy();

    $view->setDisplay('embed_1');
<<<<<<< HEAD
    $this->executeView($view, array('23'));
    $expected = array();
=======
    $this->executeView($view, ['23']);
    $expected = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $expected, $this->columnMap);
  }

  /**
   * Tests the Month handler.
   *
   * @see \Drupal\node\Plugin\views\argument\CreatedMonth
   */
  public function testMonthHandler() {
    $view = Views::getView('test_argument_date');
    $view->setDisplay('embed_2');
<<<<<<< HEAD
    $this->executeView($view, array('01'));
    $expected = array();
    $expected[] = array('id' => 1);
    $expected[] = array('id' => 2);
    $expected[] = array('id' => 3);
    $expected[] = array('id' => 4);
    $expected[] = array('id' => 5);
=======
    $this->executeView($view, ['01']);
    $expected = [];
    $expected[] = ['id' => 1];
    $expected[] = ['id' => 2];
    $expected[] = ['id' => 3];
    $expected[] = ['id' => 4];
    $expected[] = ['id' => 5];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $expected, $this->columnMap);
    $view->destroy();

    $view->setDisplay('embed_2');
<<<<<<< HEAD
    $this->executeView($view, array('12'));
    $expected = array();
=======
    $this->executeView($view, ['12']);
    $expected = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $expected, $this->columnMap);
  }

  /**
   * Tests the Week handler.
   *
   * @see \Drupal\node\Plugin\views\argument\CreatedWeek
   */
  public function testWeekHandler() {
    $this->container->get('database')->update('views_test_data')
<<<<<<< HEAD
      ->fields(array('created' => gmmktime(0, 0, 0, 9, 26, 2008)))
=======
      ->fields(['created' => gmmktime(0, 0, 0, 9, 26, 2008)])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('id', 1)
      ->execute();

    $this->container->get('database')->update('views_test_data')
<<<<<<< HEAD
      ->fields(array('created' => gmmktime(0, 0, 0, 2, 29, 2004)))
=======
      ->fields(['created' => gmmktime(0, 0, 0, 2, 29, 2004)])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('id', 2)
      ->execute();

    $this->container->get('database')->update('views_test_data')
<<<<<<< HEAD
      ->fields(array('created' => gmmktime(0, 0, 0, 1, 1, 2000)))
=======
      ->fields(['created' => gmmktime(0, 0, 0, 1, 1, 2000)])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('id', 3)
      ->execute();

    $this->container->get('database')->update('views_test_data')
<<<<<<< HEAD
      ->fields(array('created' => gmmktime(0, 0, 0, 1, 10, 2000)))
=======
      ->fields(['created' => gmmktime(0, 0, 0, 1, 10, 2000)])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('id', 4)
      ->execute();

    $this->container->get('database')->update('views_test_data')
<<<<<<< HEAD
      ->fields(array('created' => gmmktime(0, 0, 0, 2, 1, 2000)))
=======
      ->fields(['created' => gmmktime(0, 0, 0, 2, 1, 2000)])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('id', 5)
      ->execute();

    $view = Views::getView('test_argument_date');
    $view->setDisplay('embed_3');
    // Check the week calculation for a leap year.
    // @see http://wikipedia.org/wiki/ISO_week_date#Calculation
<<<<<<< HEAD
    $this->executeView($view, array('39'));
    $expected = array();
    $expected[] = array('id' => 1);
=======
    $this->executeView($view, ['39']);
    $expected = [];
    $expected[] = ['id' => 1];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $expected, $this->columnMap);
    $view->destroy();

    $view->setDisplay('embed_3');
    // Check the week calculation for the 29th of February in a leap year.
    // @see http://wikipedia.org/wiki/ISO_week_date#Calculation
<<<<<<< HEAD
    $this->executeView($view, array('09'));
    $expected = array();
    $expected[] = array('id' => 2);
=======
    $this->executeView($view, ['09']);
    $expected = [];
    $expected[] = ['id' => 2];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $expected, $this->columnMap);
    $view->destroy();

    $view->setDisplay('embed_3');
    // The first jan 2000 was still in the last week of the previous year.
<<<<<<< HEAD
    $this->executeView($view, array('52'));
    $expected = array();
    $expected[] = array('id' => 3);
=======
    $this->executeView($view, ['52']);
    $expected = [];
    $expected[] = ['id' => 3];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $expected, $this->columnMap);
    $view->destroy();

    $view->setDisplay('embed_3');
<<<<<<< HEAD
    $this->executeView($view, array('02'));
    $expected = array();
    $expected[] = array('id' => 4);
=======
    $this->executeView($view, ['02']);
    $expected = [];
    $expected[] = ['id' => 4];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $expected, $this->columnMap);
    $view->destroy();

    $view->setDisplay('embed_3');
<<<<<<< HEAD
    $this->executeView($view, array('05'));
    $expected = array();
    $expected[] = array('id' => 5);
=======
    $this->executeView($view, ['05']);
    $expected = [];
    $expected[] = ['id' => 5];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $expected, $this->columnMap);
    $view->destroy();

    $view->setDisplay('embed_3');
<<<<<<< HEAD
    $this->executeView($view, array('23'));
    $expected = array();
=======
    $this->executeView($view, ['23']);
    $expected = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $expected, $this->columnMap);
  }

  /**
   * Tests the Year handler.
   *
   * @see \Drupal\node\Plugin\views\argument\CreatedYear
   */
  public function testYearHandler() {
    $this->container->get('database')->update('views_test_data')
<<<<<<< HEAD
      ->fields(array('created' => gmmktime(0, 0, 0, 1, 1, 2001)))
=======
      ->fields(['created' => gmmktime(0, 0, 0, 1, 1, 2001)])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('id', 3)
      ->execute();

    $this->container->get('database')->update('views_test_data')
<<<<<<< HEAD
      ->fields(array('created' => gmmktime(0, 0, 0, 1, 1, 2002)))
=======
      ->fields(['created' => gmmktime(0, 0, 0, 1, 1, 2002)])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('id', 4)
      ->execute();

    $this->container->get('database')->update('views_test_data')
<<<<<<< HEAD
      ->fields(array('created' => gmmktime(0, 0, 0, 1, 1, 2002)))
=======
      ->fields(['created' => gmmktime(0, 0, 0, 1, 1, 2002)])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('id', 5)
      ->execute();

    $view = Views::getView('test_argument_date');
    $view->setDisplay('embed_4');
<<<<<<< HEAD
    $this->executeView($view, array('2000'));
    $expected = array();
    $expected[] = array('id' => 1);
    $expected[] = array('id' => 2);
=======
    $this->executeView($view, ['2000']);
    $expected = [];
    $expected[] = ['id' => 1];
    $expected[] = ['id' => 2];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $expected, $this->columnMap);
    $view->destroy();

    $view->setDisplay('embed_4');
<<<<<<< HEAD
    $this->executeView($view, array('2001'));
    $expected = array();
    $expected[] = array('id' => 3);
=======
    $this->executeView($view, ['2001']);
    $expected = [];
    $expected[] = ['id' => 3];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $expected, $this->columnMap);
    $view->destroy();

    $view->setDisplay('embed_4');
<<<<<<< HEAD
    $this->executeView($view, array('2002'));
    $expected = array();
    $expected[] = array('id' => 4);
    $expected[] = array('id' => 5);
=======
    $this->executeView($view, ['2002']);
    $expected = [];
    $expected[] = ['id' => 4];
    $expected[] = ['id' => 5];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $expected, $this->columnMap);
    $view->destroy();

    $view->setDisplay('embed_4');
<<<<<<< HEAD
    $this->executeView($view, array('23'));
    $expected = array();
=======
    $this->executeView($view, ['23']);
    $expected = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $expected, $this->columnMap);
  }

  /**
   * Tests the YearMonth handler.
   *
   * @see \Drupal\node\Plugin\views\argument\CreatedYearMonth
   */
  public function testYearMonthHandler() {
    $this->container->get('database')->update('views_test_data')
<<<<<<< HEAD
      ->fields(array('created' => gmmktime(0, 0, 0, 1, 1, 2001)))
=======
      ->fields(['created' => gmmktime(0, 0, 0, 1, 1, 2001)])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('id', 3)
      ->execute();

    $this->container->get('database')->update('views_test_data')
<<<<<<< HEAD
      ->fields(array('created' => gmmktime(0, 0, 0, 4, 1, 2001)))
=======
      ->fields(['created' => gmmktime(0, 0, 0, 4, 1, 2001)])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('id', 4)
      ->execute();

    $this->container->get('database')->update('views_test_data')
<<<<<<< HEAD
      ->fields(array('created' => gmmktime(0, 0, 0, 4, 1, 2001)))
=======
      ->fields(['created' => gmmktime(0, 0, 0, 4, 1, 2001)])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('id', 5)
      ->execute();

    $view = Views::getView('test_argument_date');
    $view->setDisplay('embed_5');
<<<<<<< HEAD
    $this->executeView($view, array('200001'));
    $expected = array();
    $expected[] = array('id' => 1);
    $expected[] = array('id' => 2);
=======
    $this->executeView($view, ['200001']);
    $expected = [];
    $expected[] = ['id' => 1];
    $expected[] = ['id' => 2];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $expected, $this->columnMap);
    $view->destroy();

    $view->setDisplay('embed_5');
<<<<<<< HEAD
    $this->executeView($view, array('200101'));
    $expected = array();
    $expected[] = array('id' => 3);
=======
    $this->executeView($view, ['200101']);
    $expected = [];
    $expected[] = ['id' => 3];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $expected, $this->columnMap);
    $view->destroy();

    $view->setDisplay('embed_5');
<<<<<<< HEAD
    $this->executeView($view, array('200104'));
    $expected = array();
    $expected[] = array('id' => 4);
    $expected[] = array('id' => 5);
=======
    $this->executeView($view, ['200104']);
    $expected = [];
    $expected[] = ['id' => 4];
    $expected[] = ['id' => 5];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $expected, $this->columnMap);
    $view->destroy();

    $view->setDisplay('embed_5');
<<<<<<< HEAD
    $this->executeView($view, array('201301'));
    $expected = array();
=======
    $this->executeView($view, ['201301']);
    $expected = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdenticalResultset($view, $expected, $this->columnMap);
  }

}
