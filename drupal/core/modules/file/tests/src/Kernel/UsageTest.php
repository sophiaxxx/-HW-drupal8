<?php

namespace Drupal\Tests\file\Kernel;

use Drupal\field\Entity\FieldConfig;
use Drupal\field\Entity\FieldStorageConfig;
use Drupal\language\Entity\ConfigurableLanguage;
use Drupal\language\Entity\ContentLanguageSettings;
use Drupal\node\Entity\Node;
use Drupal\node\Entity\NodeType;

/**
 * Tests file usage functions.
 *
 * @group file
 */
class UsageTest extends FileManagedUnitTestBase {
  /**
   * Tests \Drupal\file\FileUsage\DatabaseFileUsageBackend::listUsage().
   */
<<<<<<< HEAD
  function testGetUsage() {
    $file = $this->createFile();
    db_insert('file_usage')
      ->fields(array(
=======
  public function testGetUsage() {
    $file = $this->createFile();
    db_insert('file_usage')
      ->fields([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'fid' => $file->id(),
        'module' => 'testing',
        'type' => 'foo',
        'id' => 1,
        'count' => 1
<<<<<<< HEAD
      ))
      ->execute();
    db_insert('file_usage')
      ->fields(array(
=======
      ])
      ->execute();
    db_insert('file_usage')
      ->fields([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'fid' => $file->id(),
        'module' => 'testing',
        'type' => 'bar',
        'id' => 2,
        'count' => 2
<<<<<<< HEAD
      ))
=======
      ])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->execute();

    $usage = $this->container->get('file.usage')->listUsage($file);

    $this->assertEqual(count($usage['testing']), 2, 'Returned the correct number of items.');
    $this->assertTrue(isset($usage['testing']['foo'][1]), 'Returned the correct id.');
    $this->assertTrue(isset($usage['testing']['bar'][2]), 'Returned the correct id.');
    $this->assertEqual($usage['testing']['foo'][1], 1, 'Returned the correct count.');
    $this->assertEqual($usage['testing']['bar'][2], 2, 'Returned the correct count.');
  }

  /**
   * Tests \Drupal\file\FileUsage\DatabaseFileUsageBackend::add().
   */
<<<<<<< HEAD
  function testAddUsage() {
=======
  public function testAddUsage() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $file = $this->createFile();
    $file_usage = $this->container->get('file.usage');
    $file_usage->add($file, 'testing', 'foo', 1);
    // Add the file twice to ensure that the count is incremented rather than
    // creating additional records.
    $file_usage->add($file, 'testing', 'bar', 2);
    $file_usage->add($file, 'testing', 'bar', 2);

    $usage = db_select('file_usage', 'f')
      ->fields('f')
      ->condition('f.fid', $file->id())
      ->execute()
      ->fetchAllAssoc('id');
    $this->assertEqual(count($usage), 2, 'Created two records');
    $this->assertEqual($usage[1]->module, 'testing', 'Correct module');
    $this->assertEqual($usage[2]->module, 'testing', 'Correct module');
    $this->assertEqual($usage[1]->type, 'foo', 'Correct type');
    $this->assertEqual($usage[2]->type, 'bar', 'Correct type');
    $this->assertEqual($usage[1]->count, 1, 'Correct count');
    $this->assertEqual($usage[2]->count, 2, 'Correct count');
  }

  /**
   * Tests \Drupal\file\FileUsage\DatabaseFileUsageBackend::delete().
   */
<<<<<<< HEAD
  function testRemoveUsage() {
    $file = $this->createFile();
    $file_usage = $this->container->get('file.usage');
    db_insert('file_usage')
      ->fields(array(
=======
  public function testRemoveUsage() {
    $file = $this->createFile();
    $file_usage = $this->container->get('file.usage');
    db_insert('file_usage')
      ->fields([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'fid' => $file->id(),
        'module' => 'testing',
        'type' => 'bar',
        'id' => 2,
        'count' => 3,
<<<<<<< HEAD
      ))
=======
      ])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->execute();

    // Normal decrement.
    $file_usage->delete($file, 'testing', 'bar', 2);
    $count = db_select('file_usage', 'f')
<<<<<<< HEAD
      ->fields('f', array('count'))
=======
      ->fields('f', ['count'])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('f.fid', $file->id())
      ->execute()
      ->fetchField();
    $this->assertEqual(2, $count, 'The count was decremented correctly.');

    // Multiple decrement and removal.
    $file_usage->delete($file, 'testing', 'bar', 2, 2);
    $count = db_select('file_usage', 'f')
<<<<<<< HEAD
      ->fields('f', array('count'))
=======
      ->fields('f', ['count'])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('f.fid', $file->id())
      ->execute()
      ->fetchField();
    $this->assertIdentical(FALSE, $count, 'The count was removed entirely when empty.');

    // Non-existent decrement.
    $file_usage->delete($file, 'testing', 'bar', 2);
    $count = db_select('file_usage', 'f')
<<<<<<< HEAD
      ->fields('f', array('count'))
=======
      ->fields('f', ['count'])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('f.fid', $file->id())
      ->execute()
      ->fetchField();
    $this->assertIdentical(FALSE, $count, 'Decrementing non-exist record complete.');
  }

  /**
   * Create files for all the possible combinations of age and status.
   *
   * We are using UPDATE statements because using the API would set the
   * timestamp.
   */
<<<<<<< HEAD
  function createTempFiles() {
    // Temporary file that is old.
    $temp_old = file_save_data('');
    db_update('file_managed')
      ->fields(array(
        'status' => 0,
        'changed' => REQUEST_TIME - $this->config('system.file')->get('temporary_maximum_age') - 1,
      ))
=======
  public function createTempFiles() {
    // Temporary file that is old.
    $temp_old = file_save_data('');
    db_update('file_managed')
      ->fields([
        'status' => 0,
        'changed' => REQUEST_TIME - $this->config('system.file')->get('temporary_maximum_age') - 1,
      ])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('fid', $temp_old->id())
      ->execute();
    $this->assertTrue(file_exists($temp_old->getFileUri()), 'Old temp file was created correctly.');

    // Temporary file that is new.
    $temp_new = file_save_data('');
    db_update('file_managed')
<<<<<<< HEAD
      ->fields(array('status' => 0))
=======
      ->fields(['status' => 0])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('fid', $temp_new->id())
      ->execute();
    $this->assertTrue(file_exists($temp_new->getFileUri()), 'New temp file was created correctly.');

    // Permanent file that is old.
    $perm_old = file_save_data('');
    db_update('file_managed')
<<<<<<< HEAD
      ->fields(array('changed' => REQUEST_TIME - $this->config('system.file')->get('temporary_maximum_age') - 1))
=======
      ->fields(['changed' => REQUEST_TIME - $this->config('system.file')->get('temporary_maximum_age') - 1])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('fid', $temp_old->id())
      ->execute();
    $this->assertTrue(file_exists($perm_old->getFileUri()), 'Old permanent file was created correctly.');

    // Permanent file that is new.
    $perm_new = file_save_data('');
    $this->assertTrue(file_exists($perm_new->getFileUri()), 'New permanent file was created correctly.');
<<<<<<< HEAD
    return array($temp_old, $temp_new, $perm_old, $perm_new);
=======
    return [$temp_old, $temp_new, $perm_old, $perm_new];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Ensure that temporary files are removed by default.
   */
<<<<<<< HEAD
  function testTempFileCleanupDefault() {
=======
  public function testTempFileCleanupDefault() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    list($temp_old, $temp_new, $perm_old, $perm_new) = $this->createTempFiles();

    // Run cron and then ensure that only the old, temp file was deleted.
    $this->container->get('cron')->run();
    $this->assertFalse(file_exists($temp_old->getFileUri()), 'Old temp file was correctly removed.');
    $this->assertTrue(file_exists($temp_new->getFileUri()), 'New temp file was correctly ignored.');
    $this->assertTrue(file_exists($perm_old->getFileUri()), 'Old permanent file was correctly ignored.');
    $this->assertTrue(file_exists($perm_new->getFileUri()), 'New permanent file was correctly ignored.');
  }

  /**
   * Ensure that temporary files are kept as configured.
   */
<<<<<<< HEAD
  function testTempFileNoCleanup() {
=======
  public function testTempFileNoCleanup() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    list($temp_old, $temp_new, $perm_old, $perm_new) = $this->createTempFiles();

    // Set the max age to 0, meaning no temporary files will be deleted.
    $this->config('system.file')
      ->set('temporary_maximum_age', 0)
      ->save();

    // Run cron and then ensure that no file was deleted.
    $this->container->get('cron')->run();
    $this->assertTrue(file_exists($temp_old->getFileUri()), 'Old temp file was correctly ignored.');
    $this->assertTrue(file_exists($temp_new->getFileUri()), 'New temp file was correctly ignored.');
    $this->assertTrue(file_exists($perm_old->getFileUri()), 'Old permanent file was correctly ignored.');
    $this->assertTrue(file_exists($perm_new->getFileUri()), 'New permanent file was correctly ignored.');
  }

  /**
   * Ensure that temporary files are kept as configured.
   */
<<<<<<< HEAD
  function testTempFileCustomCleanup() {
=======
  public function testTempFileCustomCleanup() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    list($temp_old, $temp_new, $perm_old, $perm_new) = $this->createTempFiles();

    // Set the max age to older than default.
    $this->config('system.file')
      ->set('temporary_maximum_age', 21600 + 2)
      ->save();

    // Run cron and then ensure that more files were deleted.
    $this->container->get('cron')->run();
    $this->assertTrue(file_exists($temp_old->getFileUri()), 'Old temp file was correctly ignored.');
    $this->assertTrue(file_exists($temp_new->getFileUri()), 'New temp file was correctly ignored.');
    $this->assertTrue(file_exists($perm_old->getFileUri()), 'Old permanent file was correctly ignored.');
    $this->assertTrue(file_exists($perm_new->getFileUri()), 'New permanent file was correctly ignored.');
  }

  /**
   * Tests file usage with translated entities.
   */
  public function testFileUsageWithEntityTranslation() {
    /** @var \Drupal\file\FileUsage\FileUsageInterface $file_usage */
    $file_usage = $this->container->get('file.usage');

    $this->enableModules(['node', 'language']);
    $this->installEntitySchema('node');
    $this->installSchema('node', ['node_access']);

    // Activate English and Romanian languages.
    ConfigurableLanguage::create(['id' => 'en'])->save();
    ConfigurableLanguage::create(['id' => 'ro'])->save();

    NodeType::create(['type' => 'page'])->save();
    ContentLanguageSettings::loadByEntityTypeBundle('node', 'page')
      ->setLanguageAlterable(FALSE)
      ->setDefaultLangcode('en')
      ->save();
    // Create a file field attached to 'page' node-type.
    FieldStorageConfig::create([
      'type' => 'file',
      'entity_type' => 'node',
      'field_name' => 'file',
    ])->save();
    FieldConfig::create([
      'entity_type' => 'node',
      'bundle' => 'page',
      'field_name' => 'file',
      'label' => 'File',
    ])->save();

    // Create a node, attach a file and add a Romanian translation.
    $node = Node::create(['type' => 'page', 'title' => 'Page']);
    $node
      ->set('file', $file = $this->createFile())
      ->addTranslation('ro', $node->getTranslation('en')->toArray())
      ->save();

    // Check that the file is used twice.
    $usage = $file_usage->listUsage($file);
    $this->assertEquals(2, $usage['file']['node'][$node->id()]);

    // Remove the Romanian translation.
    $node->removeTranslation('ro');
    $node->save();

    // Check that one usage has been removed and is used only once now.
    $usage = $file_usage->listUsage($file);
    $this->assertEquals(1, $usage['file']['node'][$node->id()]);
  }

}
