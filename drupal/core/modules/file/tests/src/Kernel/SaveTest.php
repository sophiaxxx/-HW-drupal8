<?php

namespace Drupal\Tests\file\Kernel;

use Drupal\file\Entity\File;

/**
 * File saving tests.
 *
 * @group file
 */
class SaveTest extends FileManagedUnitTestBase {
<<<<<<< HEAD
  function testFileSave() {
    // Create a new file entity.
    $file = File::create(array(
=======
  public function testFileSave() {
    // Create a new file entity.
    $file = File::create([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'uid' => 1,
      'filename' => 'druplicon.txt',
      'uri' => 'public://druplicon.txt',
      'filemime' => 'text/plain',
      'status' => FILE_STATUS_PERMANENT,
<<<<<<< HEAD
    ));
=======
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    file_put_contents($file->getFileUri(), 'hello world');

    // Save it, inserting a new record.
    $file->save();

    // Check that the correct hooks were called.
<<<<<<< HEAD
    $this->assertFileHooksCalled(array('insert'));
=======
    $this->assertFileHooksCalled(['insert']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->assertTrue($file->id() > 0, 'A new file ID is set when saving a new file to the database.', 'File');
    $loaded_file = File::load($file->id());
    $this->assertNotNull($loaded_file, 'Record exists in the database.');
    $this->assertEqual($loaded_file->isPermanent(), $file->isPermanent(), 'Status was saved correctly.');
    $this->assertEqual($file->getSize(), filesize($file->getFileUri()), 'File size was set correctly.', 'File');
    $this->assertTrue($file->getChangedTime() > 1, 'File size was set correctly.', 'File');
    $this->assertEqual($loaded_file->langcode->value, 'en', 'Langcode was defaulted correctly.');

    // Resave the file, updating the existing record.
    file_test_reset();
    $file->status->value = 7;
    $file->save();

    // Check that the correct hooks were called.
<<<<<<< HEAD
    $this->assertFileHooksCalled(array('load', 'update'));
=======
    $this->assertFileHooksCalled(['load', 'update']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->assertEqual($file->id(), $file->id(), 'The file ID of an existing file is not changed when updating the database.', 'File');
    $this->assertTrue($file->getChangedTime() >= $file->getChangedTime(), "Timestamp didn't go backwards.", 'File');
    $loaded_file = File::load($file->id());
    $this->assertNotNull($loaded_file, 'Record still exists in the database.', 'File');
    $this->assertEqual($loaded_file->isPermanent(), $file->isPermanent(), 'Status was saved correctly.');
    $this->assertEqual($loaded_file->langcode->value, 'en', 'Langcode was saved correctly.');

    // Try to insert a second file with the same name apart from case insensitivity
    // to ensure the 'uri' index allows for filenames with different cases.
<<<<<<< HEAD
    $uppercase_values = array(
=======
    $uppercase_values = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'uid' => 1,
      'filename' => 'DRUPLICON.txt',
      'uri' => 'public://DRUPLICON.txt',
      'filemime' => 'text/plain',
      'status' => FILE_STATUS_PERMANENT,
<<<<<<< HEAD
    );
=======
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $uppercase_file = File::create($uppercase_values);
    file_put_contents($uppercase_file->getFileUri(), 'hello world');
    $violations = $uppercase_file->validate();
    $this->assertEqual(count($violations), 0, 'No violations when adding an URI with an existing filename in upper case.');
    $uppercase_file->save();

    // Ensure the database URI uniqueness constraint is triggered.
    $uppercase_file_duplicate = File::create($uppercase_values);
    file_put_contents($uppercase_file_duplicate->getFileUri(), 'hello world');
    $violations = $uppercase_file_duplicate->validate();
    $this->assertEqual(count($violations), 1);
    $this->assertEqual($violations[0]->getMessage(), t('The file %value already exists. Enter a unique file URI.', [
      '%value' => $uppercase_file_duplicate->getFileUri(),
    ]));
    // Ensure that file URI entity queries are case sensitive.
    $fids = \Drupal::entityQuery('file')
      ->condition('uri', $uppercase_file->getFileUri())
      ->execute();

    $this->assertEqual(1, count($fids));
<<<<<<< HEAD
    $this->assertEqual(array($uppercase_file->id() => $uppercase_file->id()), $fids);
=======
    $this->assertEqual([$uppercase_file->id() => $uppercase_file->id()], $fids);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  }

}
