<?php

namespace Drupal\KernelTests\Core\Config;

use Drupal\KernelTests\KernelTestBase;

/**
 * Calculating the difference between two sets of configuration.
 *
 * @group config
 */
class ConfigDiffTest extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('config_test', 'system');
=======
  public static $modules = ['config_test', 'system'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Tests calculating the difference between two sets of configuration.
   */
<<<<<<< HEAD
  function testDiff() {
=======
  public function testDiff() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $active = $this->container->get('config.storage');
    $sync = $this->container->get('config.storage.sync');
    $config_name = 'config_test.system';
    $change_key = 'foo';
    $remove_key = '404';
    $add_key = 'biff';
    $add_data = 'bangpow';
    $change_data = 'foobar';

    // Install the default config.
<<<<<<< HEAD
    $this->installConfig(array('config_test'));
=======
    $this->installConfig(['config_test']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $original_data = \Drupal::config($config_name)->get();

    // Change a configuration value in sync.
    $sync_data = $original_data;
    $sync_data[$change_key] = $change_data;
    $sync_data[$add_key] = $add_data;
    $sync->write($config_name, $sync_data);

    // Verify that the diff reflects a change.
    $diff = \Drupal::service('config.manager')->diff($active, $sync, $config_name);
    $edits = $diff->getEdits();
<<<<<<< HEAD
    $this->assertEqual($edits[0]->type, 'change', 'The first item in the diff is a change.');
    $this->assertEqual($edits[0]->orig[0], $change_key . ': ' . $original_data[$change_key], format_string("The active value for key '%change_key' is '%original_data'.", array('%change_key' => $change_key, '%original_data' => $original_data[$change_key])));
    $this->assertEqual($edits[0]->closing[0], $change_key . ': ' . $change_data, format_string("The sync value for key '%change_key' is '%change_data'.", array('%change_key' => $change_key, '%change_data' => $change_data)));
=======
    $this->assertYamlEdit($edits, $change_key, 'change',
      [$change_key . ': ' . $original_data[$change_key]],
      [$change_key . ': ' . $change_data]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Reset data back to original, and remove a key
    $sync_data = $original_data;
    unset($sync_data[$remove_key]);
    $sync->write($config_name, $sync_data);

    // Verify that the diff reflects a removed key.
    $diff = \Drupal::service('config.manager')->diff($active, $sync, $config_name);
    $edits = $diff->getEdits();
<<<<<<< HEAD
    $this->assertEqual($edits[0]->type, 'copy', 'The first item in the diff is a copy.');
    $this->assertEqual($edits[1]->type, 'delete', 'The second item in the diff is a delete.');
    $this->assertEqual($edits[1]->orig[0], $remove_key . ': ' . $original_data[$remove_key], format_string("The active value for key '%remove_key' is '%original_data'.", array('%remove_key' => $remove_key, '%original_data' => $original_data[$remove_key])));
    $this->assertFalse($edits[1]->closing, format_string("The key '%remove_key' does not exist in sync.", array('%remove_key' => $remove_key)));
=======
    $this->assertYamlEdit($edits, $change_key, 'copy');
    $this->assertYamlEdit($edits, $remove_key, 'delete',
      [$remove_key . ': ' . $original_data[$remove_key]],
      FALSE
    );
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Reset data back to original and add a key
    $sync_data = $original_data;
    $sync_data[$add_key] = $add_data;
    $sync->write($config_name, $sync_data);

    // Verify that the diff reflects an added key.
    $diff = \Drupal::service('config.manager')->diff($active, $sync, $config_name);
    $edits = $diff->getEdits();
<<<<<<< HEAD
    $this->assertEqual($edits[0]->type, 'copy', 'The first item in the diff is a copy.');
    $this->assertEqual($edits[1]->type, 'add', 'The second item in the diff is an add.');
    $this->assertFalse($edits[1]->orig, format_string("The key '%add_key' does not exist in active.", array('%add_key' => $add_key)));
    $this->assertEqual($edits[1]->closing[0], $add_key . ': ' . $add_data, format_string("The sync value for key '%add_key' is '%add_data'.", array('%add_key' => $add_key, '%add_data' => $add_data)));

    // Test diffing a renamed config entity.
    $test_entity_id = $this->randomMachineName();
    $test_entity = entity_create('config_test', array(
      'id' => $test_entity_id,
      'label' => $this->randomMachineName(),
    ));
=======
    $this->assertYamlEdit($edits, $change_key, 'copy');
    $this->assertYamlEdit($edits, $add_key, 'add', FALSE, [$add_key . ': ' . $add_data]);

    // Test diffing a renamed config entity.
    $test_entity_id = $this->randomMachineName();
    $test_entity = entity_create('config_test', [
      'id' => $test_entity_id,
      'label' => $this->randomMachineName(),
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $test_entity->save();
    $data = $active->read('config_test.dynamic.' . $test_entity_id);
    $sync->write('config_test.dynamic.' . $test_entity_id, $data);
    $config_name = 'config_test.dynamic.' . $test_entity_id;
    $diff = \Drupal::service('config.manager')->diff($active, $sync, $config_name, $config_name);
    // Prove the fields match.
    $edits = $diff->getEdits();
    $this->assertEqual($edits[0]->type, 'copy', 'The first item in the diff is a copy.');
    $this->assertEqual(count($edits), 1, 'There is one item in the diff');

    // Rename the entity.
    $new_test_entity_id = $this->randomMachineName();
    $test_entity->set('id', $new_test_entity_id);
    $test_entity->save();

    $diff = \Drupal::service('config.manager')->diff($active, $sync, 'config_test.dynamic.' . $new_test_entity_id, $config_name);
    $edits = $diff->getEdits();
<<<<<<< HEAD
    $this->assertEqual($edits[0]->type, 'copy', 'The first item in the diff is a copy.');
    $this->assertEqual($edits[1]->type, 'change', 'The second item in the diff is a change.');
    $this->assertEqual($edits[1]->orig, array('id: ' . $new_test_entity_id));
    $this->assertEqual($edits[1]->closing, array('id: ' . $test_entity_id));
=======
    $this->assertYamlEdit($edits, 'uuid', 'copy');
    $this->assertYamlEdit($edits, 'id', 'change',
      ['id: ' . $new_test_entity_id],
      ['id: ' . $test_entity_id]);
    $this->assertYamlEdit($edits, 'label', 'copy');
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($edits[2]->type, 'copy', 'The third item in the diff is a copy.');
    $this->assertEqual(count($edits), 3, 'There are three items in the diff.');
  }

  /**
   * Tests calculating the difference between two sets of config collections.
   */
<<<<<<< HEAD
  function testCollectionDiff() {
=======
  public function testCollectionDiff() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    /** @var \Drupal\Core\Config\StorageInterface $active */
    $active = $this->container->get('config.storage');
    /** @var \Drupal\Core\Config\StorageInterface $sync */
    $sync = $this->container->get('config.storage.sync');
    $active_test_collection = $active->createCollection('test');
    $sync_test_collection = $sync->createCollection('test');

    $config_name = 'config_test.test';
<<<<<<< HEAD
    $data = array('foo' => 'bar');
=======
    $data = ['foo' => 'bar'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $active->write($config_name, $data);
    $sync->write($config_name, $data);
    $active_test_collection->write($config_name, $data);
<<<<<<< HEAD
    $sync_test_collection->write($config_name, array('foo' => 'baz'));
=======
    $sync_test_collection->write($config_name, ['foo' => 'baz']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Test the fields match in the default collection diff.
    $diff = \Drupal::service('config.manager')->diff($active, $sync, $config_name);
    $edits = $diff->getEdits();
    $this->assertEqual($edits[0]->type, 'copy', 'The first item in the diff is a copy.');
    $this->assertEqual(count($edits), 1, 'There is one item in the diff');

    // Test that the differences are detected when diffing the collection.
    $diff = \Drupal::service('config.manager')->diff($active, $sync, $config_name, NULL, 'test');
    $edits = $diff->getEdits();
<<<<<<< HEAD
    $this->assertEqual($edits[0]->type, 'change', 'The second item in the diff is a copy.');
    $this->assertEqual($edits[0]->orig, array('foo: bar'));
    $this->assertEqual($edits[0]->closing, array('foo: baz'));
    $this->assertEqual($edits[1]->type, 'copy', 'The second item in the diff is a copy.');
=======
    $this->assertYamlEdit($edits, 'foo', 'change', ['foo: bar'], ['foo: baz']);
  }

  /**
   * Helper method to test that an edit is found in a diff'd YAML file.
   *
   * @param array $edits
   *   A list of edits.
   * @param string $field
   *   The field key that is being asserted.
   * @param string $type
   *   The type of edit that is being asserted.
   * @param mixed $orig
   *   (optional) The original value of of the edit. If not supplied, assertion
   *   is skipped.
   * @param mixed $closing
   *   (optional) The closing value of of the edit. If not supplied, assertion
   *   is skipped.
   */
  protected function assertYamlEdit(array $edits, $field, $type, $orig = NULL, $closing = NULL) {
    $match = FALSE;
    foreach ($edits as $edit) {
      // Choose which section to search for the field.
      $haystack = $type == 'add' ? $edit->closing : $edit->orig;
      // Look through each line and try and find the key.
      if (is_array($haystack)) {
        foreach ($haystack as $item) {
          if (strpos($item, $field . ':') === 0) {
            $match = TRUE;
            // Assert that the edit is of the type specified.
            $this->assertEqual($edit->type, $type, "The $field item in the diff is a $type");
            // If an original value was given, assert that it matches.
            if (isset($orig)) {
              $this->assertIdentical($edit->orig, $orig, "The original value for key '$field' is correct.");
            }
            // If a closing value was given, assert that it matches.
            if (isset($closing)) {
              $this->assertIdentical($edit->closing, $closing, "The closing value for key '$field' is correct.");
            }
            // Break out of the search entirely.
            break 2;
          }
        }
      }
    }

    // If we didn't match anything, fail.
    if (!$match) {
      $this->fail("$field edit was not matched");
    }
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

}
