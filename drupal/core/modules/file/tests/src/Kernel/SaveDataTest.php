<?php

namespace Drupal\Tests\file\Kernel;

use Drupal\file\Entity\File;

/**
 * Tests the file_save_data() function.
 *
 * @group file
 */
class SaveDataTest extends FileManagedUnitTestBase {
  /**
   * Test the file_save_data() function when no filename is provided.
   */
<<<<<<< HEAD
  function testWithoutFilename() {
=======
  public function testWithoutFilename() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $contents = $this->randomMachineName(8);

    $result = file_save_data($contents);
    $this->assertTrue($result, 'Unnamed file saved correctly.');

    $this->assertEqual(file_default_scheme(), file_uri_scheme($result->getFileUri()), "File was placed in Drupal's files directory.");
    $this->assertEqual($result->getFilename(), drupal_basename($result->getFileUri()), "Filename was set to the file's basename.");
    $this->assertEqual($contents, file_get_contents($result->getFileUri()), 'Contents of the file are correct.');
    $this->assertEqual($result->getMimeType(), 'application/octet-stream', 'A MIME type was set.');
    $this->assertTrue($result->isPermanent(), "The file's status was set to permanent.");

    // Check that the correct hooks were called.
<<<<<<< HEAD
    $this->assertFileHooksCalled(array('insert'));
=======
    $this->assertFileHooksCalled(['insert']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Verify that what was returned is what's in the database.
    $this->assertFileUnchanged($result, File::load($result->id()));
  }

  /**
   * Test the file_save_data() function when a filename is provided.
   */
<<<<<<< HEAD
  function testWithFilename() {
=======
  public function testWithFilename() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $contents = $this->randomMachineName(8);

    // Using filename with non-latin characters.
    $filename = 'Текстовый файл.txt';

    $result = file_save_data($contents, 'public://' . $filename);
    $this->assertTrue($result, 'Unnamed file saved correctly.');

    $this->assertEqual('public', file_uri_scheme($result->getFileUri()), "File was placed in Drupal's files directory.");
    $this->assertEqual($filename, drupal_basename($result->getFileUri()), 'File was named correctly.');
    $this->assertEqual($contents, file_get_contents($result->getFileUri()), 'Contents of the file are correct.');
    $this->assertEqual($result->getMimeType(), 'text/plain', 'A MIME type was set.');
    $this->assertTrue($result->isPermanent(), "The file's status was set to permanent.");

    // Check that the correct hooks were called.
<<<<<<< HEAD
    $this->assertFileHooksCalled(array('insert'));
=======
    $this->assertFileHooksCalled(['insert']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Verify that what was returned is what's in the database.
    $this->assertFileUnchanged($result, File::load($result->id()));
  }

  /**
   * Test file_save_data() when renaming around an existing file.
   */
<<<<<<< HEAD
  function testExistingRename() {
=======
  public function testExistingRename() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Setup a file to overwrite.
    $existing = $this->createFile();
    $contents = $this->randomMachineName(8);

    $result = file_save_data($contents, $existing->getFileUri(), FILE_EXISTS_RENAME);
    $this->assertTrue($result, 'File saved successfully.');

    $this->assertEqual('public', file_uri_scheme($result->getFileUri()), "File was placed in Drupal's files directory.");
    $this->assertEqual($result->getFilename(), $existing->getFilename(), 'Filename was set to the basename of the source, rather than that of the renamed file.');
    $this->assertEqual($contents, file_get_contents($result->getFileUri()), 'Contents of the file are correct.');
    $this->assertEqual($result->getMimeType(), 'application/octet-stream', 'A MIME type was set.');
    $this->assertTrue($result->isPermanent(), "The file's status was set to permanent.");

    // Check that the correct hooks were called.
<<<<<<< HEAD
    $this->assertFileHooksCalled(array('insert'));
=======
    $this->assertFileHooksCalled(['insert']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Ensure that the existing file wasn't overwritten.
    $this->assertDifferentFile($existing, $result);
    $this->assertFileUnchanged($existing, File::load($existing->id()));

    // Verify that was returned is what's in the database.
    $this->assertFileUnchanged($result, File::load($result->id()));
  }

  /**
   * Test file_save_data() when replacing an existing file.
   */
<<<<<<< HEAD
  function testExistingReplace() {
=======
  public function testExistingReplace() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Setup a file to overwrite.
    $existing = $this->createFile();
    $contents = $this->randomMachineName(8);

    $result = file_save_data($contents, $existing->getFileUri(), FILE_EXISTS_REPLACE);
    $this->assertTrue($result, 'File saved successfully.');

    $this->assertEqual('public', file_uri_scheme($result->getFileUri()), "File was placed in Drupal's files directory.");
    $this->assertEqual($result->getFilename(), $existing->getFilename(), 'Filename was set to the basename of the existing file, rather than preserving the original name.');
    $this->assertEqual($contents, file_get_contents($result->getFileUri()), 'Contents of the file are correct.');
    $this->assertEqual($result->getMimeType(), 'application/octet-stream', 'A MIME type was set.');
    $this->assertTrue($result->isPermanent(), "The file's status was set to permanent.");

    // Check that the correct hooks were called.
<<<<<<< HEAD
    $this->assertFileHooksCalled(array('load', 'update'));
=======
    $this->assertFileHooksCalled(['load', 'update']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Verify that the existing file was re-used.
    $this->assertSameFile($existing, $result);

    // Verify that what was returned is what's in the database.
    $this->assertFileUnchanged($result, File::load($result->id()));
  }

  /**
   * Test that file_save_data() fails overwriting an existing file.
   */
<<<<<<< HEAD
  function testExistingError() {
=======
  public function testExistingError() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $contents = $this->randomMachineName(8);
    $existing = $this->createFile(NULL, $contents);

    // Check the overwrite error.
    $result = file_save_data('asdf', $existing->getFileUri(), FILE_EXISTS_ERROR);
    $this->assertFalse($result, 'Overwriting a file fails when FILE_EXISTS_ERROR is specified.');
    $this->assertEqual($contents, file_get_contents($existing->getFileUri()), 'Contents of existing file were unchanged.');

    // Check that no hooks were called while failing.
<<<<<<< HEAD
    $this->assertFileHooksCalled(array());
=======
    $this->assertFileHooksCalled([]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Ensure that the existing file wasn't overwritten.
    $this->assertFileUnchanged($existing, File::load($existing->id()));
  }

}
