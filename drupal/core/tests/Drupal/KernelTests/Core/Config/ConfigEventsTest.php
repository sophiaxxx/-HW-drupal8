<?php

namespace Drupal\KernelTests\Core\Config;

use Drupal\Core\Config\Config;
use Drupal\Core\Config\ConfigEvents;
use Drupal\KernelTests\KernelTestBase;

/**
 * Tests events fired on configuration objects.
 *
 * @group config
 */
class ConfigEventsTest extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('config_events_test');
=======
  public static $modules = ['config_events_test'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Tests configuration events.
   */
<<<<<<< HEAD
  function testConfigEvents() {
=======
  public function testConfigEvents() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $name = 'config_events_test.test';

    $config = new Config($name, \Drupal::service('config.storage'), \Drupal::service('event_dispatcher'), \Drupal::service('config.typed'));
    $config->set('key', 'initial');
<<<<<<< HEAD
    $this->assertIdentical(\Drupal::state()->get('config_events_test.event', array()), array(), 'No events fired by creating a new configuration object');
    $config->save();

    $event = \Drupal::state()->get('config_events_test.event', array());
    $this->assertIdentical($event['event_name'], ConfigEvents::SAVE);
    $this->assertIdentical($event['current_config_data'], array('key' => 'initial'));
    $this->assertIdentical($event['raw_config_data'], array('key' => 'initial'));
    $this->assertIdentical($event['original_config_data'], array());

    $config->set('key', 'updated')->save();
    $event = \Drupal::state()->get('config_events_test.event', array());
    $this->assertIdentical($event['event_name'], ConfigEvents::SAVE);
    $this->assertIdentical($event['current_config_data'], array('key' => 'updated'));
    $this->assertIdentical($event['raw_config_data'], array('key' => 'updated'));
    $this->assertIdentical($event['original_config_data'], array('key' => 'initial'));

    $config->delete();
    $event = \Drupal::state()->get('config_events_test.event', array());
    $this->assertIdentical($event['event_name'], ConfigEvents::DELETE);
    $this->assertIdentical($event['current_config_data'], array());
    $this->assertIdentical($event['raw_config_data'], array());
    $this->assertIdentical($event['original_config_data'], array('key' => 'updated'));
=======
    $this->assertIdentical(\Drupal::state()->get('config_events_test.event', []), [], 'No events fired by creating a new configuration object');
    $config->save();

    $event = \Drupal::state()->get('config_events_test.event', []);
    $this->assertIdentical($event['event_name'], ConfigEvents::SAVE);
    $this->assertIdentical($event['current_config_data'], ['key' => 'initial']);
    $this->assertIdentical($event['raw_config_data'], ['key' => 'initial']);
    $this->assertIdentical($event['original_config_data'], []);

    $config->set('key', 'updated')->save();
    $event = \Drupal::state()->get('config_events_test.event', []);
    $this->assertIdentical($event['event_name'], ConfigEvents::SAVE);
    $this->assertIdentical($event['current_config_data'], ['key' => 'updated']);
    $this->assertIdentical($event['raw_config_data'], ['key' => 'updated']);
    $this->assertIdentical($event['original_config_data'], ['key' => 'initial']);

    $config->delete();
    $event = \Drupal::state()->get('config_events_test.event', []);
    $this->assertIdentical($event['event_name'], ConfigEvents::DELETE);
    $this->assertIdentical($event['current_config_data'], []);
    $this->assertIdentical($event['raw_config_data'], []);
    $this->assertIdentical($event['original_config_data'], ['key' => 'updated']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests configuration rename event that is fired from the ConfigFactory.
   */
<<<<<<< HEAD
  function testConfigRenameEvent() {
    $name = 'config_events_test.test';
    $new_name = 'config_events_test.test_rename';
    $GLOBALS['config'][$name] = array('key' => 'overridden');
    $GLOBALS['config'][$new_name] = array('key' => 'new overridden');

    $config = $this->config($name);
    $config->set('key', 'initial')->save();
    $event = \Drupal::state()->get('config_events_test.event', array());
    $this->assertIdentical($event['event_name'], ConfigEvents::SAVE);
    $this->assertIdentical($event['current_config_data'], array('key' => 'initial'));
=======
  public function testConfigRenameEvent() {
    $name = 'config_events_test.test';
    $new_name = 'config_events_test.test_rename';
    $GLOBALS['config'][$name] = ['key' => 'overridden'];
    $GLOBALS['config'][$new_name] = ['key' => 'new overridden'];

    $config = $this->config($name);
    $config->set('key', 'initial')->save();
    $event = \Drupal::state()->get('config_events_test.event', []);
    $this->assertIdentical($event['event_name'], ConfigEvents::SAVE);
    $this->assertIdentical($event['current_config_data'], ['key' => 'initial']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Override applies when getting runtime config.
    $this->assertEqual($GLOBALS['config'][$name], \Drupal::config($name)->get());

    \Drupal::configFactory()->rename($name, $new_name);
<<<<<<< HEAD
    $event = \Drupal::state()->get('config_events_test.event', array());
    $this->assertIdentical($event['event_name'], ConfigEvents::RENAME);
    $this->assertIdentical($event['current_config_data'], array('key' => 'new overridden'));
    $this->assertIdentical($event['raw_config_data'], array('key' => 'initial'));
    $this->assertIdentical($event['original_config_data'], array('key' => 'new overridden'));
=======
    $event = \Drupal::state()->get('config_events_test.event', []);
    $this->assertIdentical($event['event_name'], ConfigEvents::RENAME);
    $this->assertIdentical($event['current_config_data'], ['key' => 'new overridden']);
    $this->assertIdentical($event['raw_config_data'], ['key' => 'initial']);
    $this->assertIdentical($event['original_config_data'], ['key' => 'new overridden']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

}
