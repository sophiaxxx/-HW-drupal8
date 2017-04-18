<?php

namespace Drupal\Tests\views\Kernel;

use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\views\Entity\View;
use Drupal\views\Plugin\views\display\Page;
use Drupal\views\Views;

/**
 * Tests the CRUD functionality for a view.
 *
 * @group views
 * @see \Drupal\views\Entity\View
 * @see \Drupal\Core\Config\Entity\ConfigEntityStorage
 */
class ViewStorageTest extends ViewsKernelTestBase {

  /**
   * Properties that should be stored in the configuration.
   *
   * @var array
   */
<<<<<<< HEAD
  protected $configProperties = array(
=======
  protected $configProperties = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    'status',
    'module',
    'id',
    'description',
    'tag',
    'base_table',
    'label',
    'core',
    'display',
<<<<<<< HEAD
  );
=======
  ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * The entity type definition.
   *
   * @var \Drupal\Core\Entity\EntityTypeInterface
   */
  protected $entityType;

  /**
   * The configuration entity storage.
   *
   * @var \Drupal\Core\Config\Entity\ConfigEntityStorage
   */
  protected $controller;

  /**
   * Views used by this test.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $testViews = array('test_view_storage');
=======
  public static $testViews = ['test_view_storage'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Tests CRUD operations.
   */
<<<<<<< HEAD
  function testConfigurationEntityCRUD() {
=======
  public function testConfigurationEntityCRUD() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Get the configuration entity type and controller.
    $this->entityType = \Drupal::entityManager()->getDefinition('view');
    $this->controller = $this->container->get('entity.manager')->getStorage('view');

    // Confirm that an info array has been returned.
    $this->assertTrue($this->entityType instanceof EntityTypeInterface, 'The View info array is loaded.');

    // CRUD tests.
    $this->loadTests();
    $this->createTests();
    $this->displayTests();

    // Helper method tests
    $this->displayMethodTests();
  }

  /**
   * Tests loading configuration entities.
   */
  protected function loadTests() {
<<<<<<< HEAD
    $view = entity_load('view', 'test_view_storage');
=======
    $view = View::load('test_view_storage');
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $data = $this->config('views.view.test_view_storage')->get();

    // Confirm that an actual view object is loaded and that it returns all of
    // expected properties.
    $this->assertTrue($view instanceof View, 'Single View instance loaded.');
    foreach ($this->configProperties as $property) {
<<<<<<< HEAD
      $this->assertTrue($view->get($property) !== NULL, format_string('Property: @property loaded onto View.', array('@property' => $property)));
    }

    // Check the displays have been loaded correctly from config display data.
    $expected_displays = array('default', 'block_1', 'page_1');
=======
      $this->assertTrue($view->get($property) !== NULL, format_string('Property: @property loaded onto View.', ['@property' => $property]));
    }

    // Check the displays have been loaded correctly from config display data.
    $expected_displays = ['default', 'block_1', 'page_1'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual(array_keys($view->get('display')), $expected_displays, 'The correct display names are present.');

    // Check each ViewDisplay object and confirm that it has the correct key and
    // property values.
    foreach ($view->get('display') as $key => $display) {
      $this->assertEqual($key, $display['id'], 'The display has the correct ID assigned.');

      // Get original display data and confirm that the display options array
      // exists.
      $original_options = $data['display'][$key];
      foreach ($original_options as $orig_key => $value) {
<<<<<<< HEAD
        $this->assertIdentical($display[$orig_key], $value, format_string('@key is identical to saved data', array('@key' => $key)));
=======
        $this->assertIdentical($display[$orig_key], $value, format_string('@key is identical to saved data', ['@key' => $key]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      }
    }

    // Make sure that loaded default views get a UUID.
    $view = Views::getView('test_view_storage');
    $this->assertTrue($view->storage->uuid());
  }

  /**
   * Tests creating configuration entities.
   */
  protected function createTests() {
    // Create a new View instance with empty values.
<<<<<<< HEAD
    $created = $this->controller->create(array());
=======
    $created = $this->controller->create([]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->assertTrue($created instanceof View, 'Created object is a View.');
    // Check that the View contains all of the properties.
    foreach ($this->configProperties as $property) {
<<<<<<< HEAD
      $this->assertTrue(property_exists($created, $property), format_string('Property: @property created on View.', array('@property' => $property)));
=======
      $this->assertTrue(property_exists($created, $property), format_string('Property: @property created on View.', ['@property' => $property]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    }

    // Create a new View instance with config values.
    $values = $this->config('views.view.test_view_storage')->get();
    $values['id'] = 'test_view_storage_new';
    unset($values['uuid']);
    $created = $this->controller->create($values);

    $this->assertTrue($created instanceof View, 'Created object is a View.');
    // Check that the View contains all of the properties.
    $properties = $this->configProperties;
    // Remove display from list.
    array_pop($properties);

    // Test all properties except displays.
    foreach ($properties as $property) {
<<<<<<< HEAD
      $this->assertTrue($created->get($property) !== NULL, format_string('Property: @property created on View.', array('@property' => $property)));
      $this->assertIdentical($values[$property], $created->get($property), format_string('Property value: @property matches configuration value.', array('@property' => $property)));
=======
      $this->assertTrue($created->get($property) !== NULL, format_string('Property: @property created on View.', ['@property' => $property]));
      $this->assertIdentical($values[$property], $created->get($property), format_string('Property value: @property matches configuration value.', ['@property' => $property]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    }

    // Check the UUID of the loaded View.
    $created->save();
<<<<<<< HEAD
    $created_loaded = entity_load('view', 'test_view_storage_new');
=======
    $created_loaded = View::load('test_view_storage_new');
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical($created->uuid(), $created_loaded->uuid(), 'The created UUID has been saved correctly.');
  }

  /**
   * Tests adding, saving, and loading displays on configuration entities.
   */
  protected function displayTests() {
    // Check whether a display can be added and saved to a View.
<<<<<<< HEAD
    $view = entity_load('view', 'test_view_storage_new');
=======
    $view = View::load('test_view_storage_new');
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $new_id = $view->addDisplay('page', 'Test', 'test');
    $display = $view->get('display');

    // Ensure the right display_plugin is created/instantiated.
    $this->assertEqual($display[$new_id]['display_plugin'], 'page', 'New page display "test" uses the right display plugin.');

    $executable = $view->getExecutable();
    $executable->initDisplay();
    $this->assertTrue($executable->displayHandlers->get($new_id) instanceof Page, 'New page display "test" uses the right display plugin.');

    // To save this with a new ID, we should use createDuplicate().
    $view = $view->createDuplicate();
    $view->set('id', 'test_view_storage_new_new2');
    $view->save();
    $values = $this->config('views.view.test_view_storage_new_new2')->get();

    $this->assertTrue(isset($values['display']['test']) && is_array($values['display']['test']), 'New display was saved.');
  }

  /**
   * Tests the display related functions like getDisplaysList().
   */
  protected function displayMethodTests() {
<<<<<<< HEAD
    $config['display'] = array(
      'page_1' => array(
        'display_options' => array('path' => 'test'),
=======
    $config['display'] = [
      'page_1' => [
        'display_options' => ['path' => 'test'],
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'display_plugin' => 'page',
        'id' => 'page_2',
        'display_title' => 'Page 1',
        'position' => 1
<<<<<<< HEAD
      ),
      'feed_1' => array(
        'display_options' => array('path' => 'test.xml'),
=======
      ],
      'feed_1' => [
        'display_options' => ['path' => 'test.xml'],
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'display_plugin' => 'feed',
        'id' => 'feed',
        'display_title' => 'Feed',
        'position' => 2
<<<<<<< HEAD
      ),
      'page_2' => array(
        'display_options' => array('path' => 'test/%/extra'),
=======
      ],
      'page_2' => [
        'display_options' => ['path' => 'test/%/extra'],
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'display_plugin' => 'page',
        'id' => 'page_2',
        'display_title' => 'Page 2',
        'position' => 3
<<<<<<< HEAD
      )
    );
    $view = $this->controller->create($config);

    // Tests Drupal\views\Entity\View::addDisplay()
    $view = $this->controller->create(array());
    $random_title = $this->randomMachineName();

    $id = $view->addDisplay('page', $random_title);
    $this->assertEqual($id, 'page_1', format_string('Make sure the first display (%id_new) has the expected ID (%id)', array('%id_new' => $id, '%id' => 'page_1')));
=======
      ]
    ];
    $view = $this->controller->create($config);

    // Tests Drupal\views\Entity\View::addDisplay()
    $view = $this->controller->create([]);
    $random_title = $this->randomMachineName();

    $id = $view->addDisplay('page', $random_title);
    $this->assertEqual($id, 'page_1', format_string('Make sure the first display (%id_new) has the expected ID (%id)', ['%id_new' => $id, '%id' => 'page_1']));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $display = $view->get('display');
    $this->assertEqual($display[$id]['display_title'], $random_title);

    $random_title = $this->randomMachineName();
    $id = $view->addDisplay('page', $random_title);
    $display = $view->get('display');
<<<<<<< HEAD
    $this->assertEqual($id, 'page_2', format_string('Make sure the second display (%id_new) has the expected ID (%id)', array('%id_new' => $id, '%id' => 'page_2')));
=======
    $this->assertEqual($id, 'page_2', format_string('Make sure the second display (%id_new) has the expected ID (%id)', ['%id_new' => $id, '%id' => 'page_2']));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($display[$id]['display_title'], $random_title);

    $id = $view->addDisplay('page');
    $display = $view->get('display');
    $this->assertEqual($display[$id]['display_title'], 'Page 3');

    // Ensure the 'default' display always has position zero, regardless of when
    // it was set relative to other displays. Even if the 'default' display
    // exists, adding it again will overwrite it, which is asserted with the new
    // title.
    $view->addDisplay('default', $random_title);
    $displays = $view->get('display');
    $this->assertEqual($displays['default']['display_title'], $random_title, 'Default display is defined with the new title');
    $this->assertEqual($displays['default']['position'], 0, 'Default displays are always in position zero');

    // Tests Drupal\views\Entity\View::generateDisplayId(). Since
    // generateDisplayId() is protected, we have to use reflection to unit-test
    // it.
<<<<<<< HEAD
    $view = $this->controller->create(array());
=======
    $view = $this->controller->create([]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $ref_generate_display_id = new \ReflectionMethod($view, 'generateDisplayId');
    $ref_generate_display_id->setAccessible(TRUE);
    $this->assertEqual(
      $ref_generate_display_id->invoke($view, 'default'),
      'default',
      'The plugin ID for default is always default.'
    );
    $this->assertEqual(
      $ref_generate_display_id->invoke($view, 'feed'),
      'feed_1',
      'The generated ID for the first instance of a plugin type should have an suffix of _1.'
    );
    $view->addDisplay('feed', 'feed title');
    $this->assertEqual(
      $ref_generate_display_id->invoke($view, 'feed'),
      'feed_2',
      'The generated ID for the first instance of a plugin type should have an suffix of _2.'
    );

    // Tests item related methods().
<<<<<<< HEAD
    $view = $this->controller->create(array('base_table' => 'views_test_data'));
=======
    $view = $this->controller->create(['base_table' => 'views_test_data']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $view->addDisplay('default');
    $view = $view->getExecutable();

    $display_id = 'default';
<<<<<<< HEAD
    $expected_items = array();
=======
    $expected_items = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Tests addHandler with getItem.
    // Therefore add one item without any options and one item with some
    // options.
    $id1 = $view->addHandler($display_id, 'field', 'views_test_data', 'id');
    $item1 = $view->getHandler($display_id, 'field', 'id');
<<<<<<< HEAD
    $expected_items[$id1] = $expected_item = array(
=======
    $expected_items[$id1] = $expected_item = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'id' => 'id',
      'table' => 'views_test_data',
      'field' => 'id',
      'plugin_id' => 'numeric',
<<<<<<< HEAD
    );
    $this->assertEqual($item1, $expected_item);

    $options = array(
      'alter' => array(
        'text' => $this->randomMachineName()
      )
    );
    $id2 = $view->addHandler($display_id, 'field', 'views_test_data', 'name', $options);
    $item2 = $view->getHandler($display_id, 'field', 'name');
    $expected_items[$id2] = $expected_item = array(
=======
    ];
    $this->assertEqual($item1, $expected_item);

    $options = [
      'alter' => [
        'text' => $this->randomMachineName()
      ]
    ];
    $id2 = $view->addHandler($display_id, 'field', 'views_test_data', 'name', $options);
    $item2 = $view->getHandler($display_id, 'field', 'name');
    $expected_items[$id2] = $expected_item = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'id' => 'name',
      'table' => 'views_test_data',
      'field' => 'name',
      'plugin_id' => 'standard',
<<<<<<< HEAD
    ) + $options;
=======
    ] + $options;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($item2, $expected_item);

    // Tests the expected fields from the previous additions.
    $this->assertEqual($view->getHandlers('field', $display_id), $expected_items);

    // Alter an existing item via setItem and check the result via getItem
    // and getItems.
<<<<<<< HEAD
    $item = array(
      'alter' => array(
        'text' => $this->randomMachineName(),
      )
    ) + $item1;
=======
    $item = [
      'alter' => [
        'text' => $this->randomMachineName(),
      ]
    ] + $item1;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $expected_items[$id1] = $item;
    $view->setHandler($display_id, 'field', $id1, $item);
    $this->assertEqual($view->getHandler($display_id, 'field', 'id'), $item);
    $this->assertEqual($view->getHandlers('field', $display_id), $expected_items);

    // Test removeItem method.
    unset($expected_items[$id2]);
    $view->removeHandler($display_id, 'field', $id2);
    $this->assertEqual($view->getHandlers('field', $display_id), $expected_items);
  }

  /**
   * Tests the createDuplicate() View method.
   */
  public function testCreateDuplicate() {
    $view = Views::getView('test_view_storage');
    $copy = $view->storage->createDuplicate();

    $this->assertTrue($copy instanceof View, 'The copied object is a View.');

    // Check that the original view and the copy have different UUIDs.
    $this->assertNotIdentical($view->storage->uuid(), $copy->uuid(), 'The copied view has a new UUID.');

    // Check the 'name' (ID) is using the View objects default value (NULL) as it
    // gets unset.
    $this->assertIdentical($copy->id(), NULL, 'The ID has been reset.');

    // Check the other properties.
    // @todo Create a reusable property on the base test class for these?
<<<<<<< HEAD
    $config_properties = array(
=======
    $config_properties = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'disabled',
      'description',
      'tag',
      'base_table',
      'label',
      'core',
<<<<<<< HEAD
    );

    foreach ($config_properties as $property) {
      $this->assertIdentical($view->storage->get($property), $copy->get($property), format_string('@property property is identical.', array('@property' => $property)));
=======
    ];

    foreach ($config_properties as $property) {
      $this->assertIdentical($view->storage->get($property), $copy->get($property), format_string('@property property is identical.', ['@property' => $property]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    }

    // Check the displays are the same.
    $copy_display = $copy->get('display');
    foreach ($view->storage->get('display') as $id => $display) {
      // assertIdentical will not work here.
<<<<<<< HEAD
      $this->assertEqual($display, $copy_display[$id], format_string('The @display display has been copied correctly.', array('@display' => $id)));
=======
      $this->assertEqual($display, $copy_display[$id], format_string('The @display display has been copied correctly.', ['@display' => $id]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    }
  }

}
