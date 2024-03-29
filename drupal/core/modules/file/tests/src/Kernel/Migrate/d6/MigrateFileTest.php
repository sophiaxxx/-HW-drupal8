<?php

namespace Drupal\Tests\file\Kernel\Migrate\d6;

use Drupal\Component\Utility\Random;
use Drupal\file\Entity\File;
use Drupal\file\FileInterface;
use Drupal\KernelTests\KernelTestBase;
use Drupal\Core\Database\Database;
use Drupal\Tests\migrate\Kernel\MigrateDumpAlterInterface;
use Drupal\Tests\migrate_drupal\Kernel\d6\MigrateDrupal6TestBase;

/**
 * file migration.
 *
 * @group migrate_drupal_6
 */
class MigrateFileTest extends MigrateDrupal6TestBase implements MigrateDumpAlterInterface {

  use FileMigrationTestTrait;

  /**
   * The filename of a file used to test temporary file migration.
   *
   * @var string
   */
  protected static $tempFilename;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->setUpMigratedFiles();
  }

  /**
   * Asserts a file entity.
   *
   * @param int $fid
   *   The file ID.
   * @param string $name
   *   The expected file name.
   * @param int $size
   *   The expected file size.
   * @param string $uri
   *   The expected file URI.
   * @param string $type
   *   The expected MIME type.
   * @param int $uid
   *   The expected file owner ID.
   */
  protected function assertEntity($fid, $name, $size, $uri, $type, $uid) {
    /** @var \Drupal\file\FileInterface $file */
    $file = File::load($fid);
    $this->assertTrue($file instanceof FileInterface);
    $this->assertIdentical($name, $file->getFilename());
    $this->assertIdentical($size, $file->getSize());
    $this->assertIdentical($uri, $file->getFileUri());
    $this->assertIdentical($type, $file->getMimeType());
    $this->assertIdentical($uid, $file->getOwnerId());
  }

  /**
   * Tests the Drupal 6 files to Drupal 8 migration.
   */
  public function testFiles() {
    $this->assertEntity(1, 'Image1.png', '39325', 'public://image-1.png', 'image/png', '1');
    $this->assertEntity(2, 'Image2.jpg', '1831', 'public://image-2.jpg', 'image/jpeg', '1');
    $this->assertEntity(3, 'Image-test.gif', '183', 'public://image-test.gif', 'image/jpeg', '1');
<<<<<<< HEAD
    $this->assertEntity(5, 'html-1.txt', '24', 'public://html-1.txt', 'text/plain', '1');

    // Test that we can re-import and also test with file_directory_path set.
    $migration_plugin_manager = $this->container->get('plugin.manager.migration');
    \Drupal::database()
      ->truncate($migration_plugin_manager->createInstance('d6_file')->getIdMap()->mapTableName())
=======
    $this->assertEntity(4, 'html-1.txt', '24', 'public://html-1.txt', 'text/plain', '1');

    $map_table = $this->getMigration('d6_file')->getIdMap()->mapTableName();
    $map = \Drupal::database()
      ->select($map_table, 'm')
      ->fields('m', ['sourceid1', 'destid1'])
      ->execute()
      ->fetchAllKeyed();
    $map_expected = [
      // The 4 files from the fixture.
      1 => '1',
      2 => '2',
      3 => '3',
      5 => '4',
      // The file updated in migrateDumpAlter().
      6 => NULL,
      // The file created in migrateDumpAlter().
      7 => '4',
    ];
    $this->assertEquals($map_expected, $map);

    // Test that we can re-import and also test with file_directory_path set.
    \Drupal::database()
      ->truncate($map_table)
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->execute();

    // Update the file_directory_path.
    Database::getConnection('default', 'migrate')
      ->update('variable')
<<<<<<< HEAD
      ->fields(array('value' => serialize('files/test')))
=======
      ->fields(['value' => serialize('files/test')])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('name', 'file_directory_path')
      ->execute();
    Database::getConnection('default', 'migrate')
      ->update('variable')
<<<<<<< HEAD
      ->fields(array('value' => serialize(file_directory_temp())))
      ->condition('name', 'file_directory_temp')
      ->execute();

    $migration = $migration_plugin_manager->createInstance('d6_file');
    $this->executeMigration($migration);

    $file = File::load(2);
    $this->assertIdentical('public://core/modules/simpletest/files/image-2.jpg', $file->getFileUri());

    // Ensure that a temporary file has been migrated.
    $file = File::load(6);
    $this->assertIdentical('temporary://' . static::getUniqueFilename(), $file->getFileUri());

    // File 7, created in static::migrateDumpAlter(), shares a path with
    // file 5, which means it should be skipped entirely.
    $this->assertNull(File::load(7));
=======
      ->fields(['value' => serialize(file_directory_temp())])
      ->condition('name', 'file_directory_temp')
      ->execute();

    $this->executeMigration('d6_file');

    // File 2, when migrated for the second time, is treated as a different file
    // (due to having a different uri this time) and is given fid 6.
    $file = File::load(6);
    $this->assertIdentical('public://core/modules/simpletest/files/image-2.jpg', $file->getFileUri());

    $map_table = $this->getMigration('d6_file')->getIdMap()->mapTableName();
    $map = \Drupal::database()
      ->select($map_table, 'm')
      ->fields('m', ['sourceid1', 'destid1'])
      ->execute()
      ->fetchAllKeyed();
    $map_expected = [
      // The 4 files from the fixture.
      1 => '5',
      2 => '6',
      3 => '7',
      5 => '8',
      // The file updated in migrateDumpAlter().
      6 => NULL,
      // The files created in migrateDumpAlter().
      7 => '8',
      8 => '8',
    ];
    $this->assertEquals($map_expected, $map);

    // File 6, created in static::migrateDumpAlter(), shares a path with
    // file 4, which means it should be skipped entirely. If it was migrated
    // then it would have an fid of 9.
    $this->assertNull(File::load(9));

    $this->assertEquals(8, count(File::loadMultiple()));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * @return string
   *   A filename based upon the test.
   */
  public static function getUniqueFilename() {
    return static::$tempFilename;
  }

  /**
   * {@inheritdoc}
   */
  public static function migrateDumpAlter(KernelTestBase $test) {
    // Creates a random filename and updates the source database.
    $random = new Random();
    $temp_directory = file_directory_temp();
    file_prepare_directory($temp_directory, FILE_CREATE_DIRECTORY);
    static::$tempFilename = $test->getDatabasePrefix() . $random->name() . '.jpg';
    $file_path = $temp_directory . '/' . static::$tempFilename;
    file_put_contents($file_path, '');

    $db = Database::getConnection('default', 'migrate');

    $db->update('files')
      ->condition('fid', 6)
<<<<<<< HEAD
      ->fields(array(
        'filename' => static::$tempFilename,
        'filepath' => $file_path,
      ))
=======
      ->fields([
        'filename' => static::$tempFilename,
        'filepath' => $file_path,
      ])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->execute();

    $file = (array) $db->select('files')
      ->fields('files')
      ->condition('fid', 5)
      ->execute()
      ->fetchObject();
    unset($file['fid']);
    $db->insert('files')->fields($file)->execute();

    return static::$tempFilename;
  }

}
