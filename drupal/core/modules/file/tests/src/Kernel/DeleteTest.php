<?php

namespace Drupal\Tests\file\Kernel;

use Drupal\file\Entity\File;

/**
 * Tests the file delete function.
 *
 * @group file
 */
class DeleteTest extends FileManagedUnitTestBase {
  /**
   * Tries deleting a normal file (as opposed to a directory, symlink, etc).
   */
<<<<<<< HEAD
  function testUnused() {
=======
  public function testUnused() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $file = $this->createFile();

    // Check that deletion removes the file and database record.
    $this->assertTrue(is_file($file->getFileUri()), 'File exists.');
    $file->delete();
<<<<<<< HEAD
    $this->assertFileHooksCalled(array('delete'));
=======
    $this->assertFileHooksCalled(['delete']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertFalse(file_exists($file->getFileUri()), 'Test file has actually been deleted.');
    $this->assertFalse(File::load($file->id()), 'File was removed from the database.');
  }

  /**
   * Tries deleting a file that is in use.
   */
<<<<<<< HEAD
  function testInUse() {
=======
  public function testInUse() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $file = $this->createFile();
    $file_usage = $this->container->get('file.usage');
    $file_usage->add($file, 'testing', 'test', 1);
    $file_usage->add($file, 'testing', 'test', 1);

    $file_usage->delete($file, 'testing', 'test', 1);
    $usage = $file_usage->listUsage($file);
<<<<<<< HEAD
    $this->assertEqual($usage['testing']['test'], array(1 => 1), 'Test file is still in use.');
=======
    $this->assertEqual($usage['testing']['test'], [1 => 1], 'Test file is still in use.');
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertTrue(file_exists($file->getFileUri()), 'File still exists on the disk.');
    $this->assertTrue(File::load($file->id()), 'File still exists in the database.');

    // Clear out the call to hook_file_load().
    file_test_reset();

    $file_usage->delete($file, 'testing', 'test', 1);
    $usage = $file_usage->listUsage($file);
<<<<<<< HEAD
    $this->assertFileHooksCalled(array('load', 'update'));
=======
    $this->assertFileHooksCalled(['load', 'update']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertTrue(empty($usage), 'File usage data was removed.');
    $this->assertTrue(file_exists($file->getFileUri()), 'File still exists on the disk.');
    $file = File::load($file->id());
    $this->assertTrue($file, 'File still exists in the database.');
    $this->assertTrue($file->isTemporary(), 'File is temporary.');
    file_test_reset();

    // Call file_cron() to clean up the file. Make sure the changed timestamp
    // of the file is older than the system.file.temporary_maximum_age
    // configuration value.
    db_update('file_managed')
<<<<<<< HEAD
      ->fields(array(
        'changed' => REQUEST_TIME - ($this->config('system.file')->get('temporary_maximum_age') + 1),
      ))
=======
      ->fields([
        'changed' => REQUEST_TIME - ($this->config('system.file')->get('temporary_maximum_age') + 1),
      ])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('fid', $file->id())
      ->execute();
    \Drupal::service('cron')->run();

    // file_cron() loads
<<<<<<< HEAD
    $this->assertFileHooksCalled(array('delete'));
=======
    $this->assertFileHooksCalled(['delete']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertFalse(file_exists($file->getFileUri()), 'File has been deleted after its last usage was removed.');
    $this->assertFalse(File::load($file->id()), 'File was removed from the database.');
  }

}
