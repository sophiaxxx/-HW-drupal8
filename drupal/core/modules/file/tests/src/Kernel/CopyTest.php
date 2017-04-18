<?php

namespace Drupal\Tests\file\Kernel;

use Drupal\file\Entity\File;

/**
 * Tests the file copy function.
 *
 * @group file
 */
class CopyTest extends FileManagedUnitTestBase {
  /**
   * Test file copying in the normal, base case.
   */
<<<<<<< HEAD
  function testNormal() {
=======
  public function testNormal() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $contents = $this->randomMachineName(10);
    $source = $this->createFile(NULL, $contents);
    $desired_uri = 'public://' . $this->randomMachineName();

    // Clone the object so we don't have to worry about the function changing
    // our reference copy.
    $result = file_copy(clone $source, $desired_uri, FILE_EXISTS_ERROR);

    // Check the return status and that the contents changed.
    $this->assertTrue($result, 'File copied successfully.');
    $this->assertEqual($contents, file_get_contents($result->getFileUri()), 'Contents of file were copied correctly.');

    // Check that the correct hooks were called.
<<<<<<< HEAD
    $this->assertFileHooksCalled(array('copy', 'insert'));
=======
    $this->assertFileHooksCalled(['copy', 'insert']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->assertDifferentFile($source, $result);
    $this->assertEqual($result->getFileUri(), $desired_uri, 'The copied file entity has the desired filepath.');
    $this->assertTrue(file_exists($source->getFileUri()), 'The original file still exists.');
    $this->assertTrue(file_exists($result->getFileUri()), 'The copied file exists.');

    // Reload the file from the database and check that the changes were
    // actually saved.
    $this->assertFileUnchanged($result, File::load($result->id()));
  }

  /**
   * Test renaming when copying over a file that already exists.
   */
<<<<<<< HEAD
  function testExistingRename() {
=======
  public function testExistingRename() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Setup a file to overwrite.
    $contents = $this->randomMachineName(10);
    $source = $this->createFile(NULL, $contents);
    $target = $this->createFile();
    $this->assertDifferentFile($source, $target);

    // Clone the object so we don't have to worry about the function changing
    // our reference copy.
    $result = file_copy(clone $source, $target->getFileUri(), FILE_EXISTS_RENAME);

    // Check the return status and that the contents changed.
    $this->assertTrue($result, 'File copied successfully.');
    $this->assertEqual($contents, file_get_contents($result->getFileUri()), 'Contents of file were copied correctly.');
    $this->assertNotEqual($result->getFileUri(), $source->getFileUri(), 'Returned file path has changed from the original.');

    // Check that the correct hooks were called.
<<<<<<< HEAD
    $this->assertFileHooksCalled(array('copy', 'insert'));
=======
    $this->assertFileHooksCalled(['copy', 'insert']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Load all the affected files to check the changes that actually made it
    // to the database.
    $loaded_source = File::load($source->id());
    $loaded_target = File::load($target->id());
    $loaded_result = File::load($result->id());

    // Verify that the source file wasn't changed.
    $this->assertFileUnchanged($source, $loaded_source);

    // Verify that what was returned is what's in the database.
    $this->assertFileUnchanged($result, $loaded_result);

    // Make sure we end up with three distinct files afterwards.
    $this->assertDifferentFile($loaded_source, $loaded_target);
    $this->assertDifferentFile($loaded_target, $loaded_result);
    $this->assertDifferentFile($loaded_source, $loaded_result);
  }

  /**
   * Test replacement when copying over a file that already exists.
   */
<<<<<<< HEAD
  function testExistingReplace() {
=======
  public function testExistingReplace() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Setup a file to overwrite.
    $contents = $this->randomMachineName(10);
    $source = $this->createFile(NULL, $contents);
    $target = $this->createFile();
    $this->assertDifferentFile($source, $target);

    // Clone the object so we don't have to worry about the function changing
    // our reference copy.
    $result = file_copy(clone $source, $target->getFileUri(), FILE_EXISTS_REPLACE);

    // Check the return status and that the contents changed.
    $this->assertTrue($result, 'File copied successfully.');
    $this->assertEqual($contents, file_get_contents($result->getFileUri()), 'Contents of file were overwritten.');
    $this->assertDifferentFile($source, $result);

    // Check that the correct hooks were called.
<<<<<<< HEAD
    $this->assertFileHooksCalled(array('load', 'copy', 'update'));
=======
    $this->assertFileHooksCalled(['load', 'copy', 'update']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Load all the affected files to check the changes that actually made it
    // to the database.
    $loaded_source = File::load($source->id());
    $loaded_target = File::load($target->id());
    $loaded_result = File::load($result->id());

    // Verify that the source file wasn't changed.
    $this->assertFileUnchanged($source, $loaded_source);

    // Verify that what was returned is what's in the database.
    $this->assertFileUnchanged($result, $loaded_result);

    // Target file was reused for the result.
    $this->assertFileUnchanged($loaded_target, $loaded_result);
  }

  /**
   * Test that copying over an existing file fails when FILE_EXISTS_ERROR is
   * specified.
   */
<<<<<<< HEAD
  function testExistingError() {
=======
  public function testExistingError() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $contents = $this->randomMachineName(10);
    $source = $this->createFile();
    $target = $this->createFile(NULL, $contents);
    $this->assertDifferentFile($source, $target);

    // Clone the object so we don't have to worry about the function changing
    // our reference copy.
    $result = file_copy(clone $source, $target->getFileUri(), FILE_EXISTS_ERROR);

    // Check the return status and that the contents were not changed.
    $this->assertFalse($result, 'File copy failed.');
    $this->assertEqual($contents, file_get_contents($target->getFileUri()), 'Contents of file were not altered.');

    // Check that the correct hooks were called.
<<<<<<< HEAD
    $this->assertFileHooksCalled(array());
=======
    $this->assertFileHooksCalled([]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->assertFileUnchanged($source, File::load($source->id()));
    $this->assertFileUnchanged($target, File::load($target->id()));
  }

}
