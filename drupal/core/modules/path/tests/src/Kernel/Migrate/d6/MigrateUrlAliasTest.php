<?php

namespace Drupal\Tests\path\Kernel\Migrate\d6;

use Drupal\migrate\Plugin\MigrateIdMapInterface;
use Drupal\Core\Database\Database;
use Drupal\Tests\migrate_drupal\Kernel\d6\MigrateDrupal6TestBase;

/**
 * URL alias migration.
 *
 * @group migrate_drupal_6
 */
class MigrateUrlAliasTest extends MigrateDrupal6TestBase {

  /**
   * {@inheritdoc}
   */
<<<<<<< HEAD
  public static $modules = array('path');
=======
  public static $modules = ['language', 'content_translation', 'path'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
<<<<<<< HEAD
    $this->executeMigration('d6_url_alias');
=======
    $this->installEntitySchema('node');
    $this->installConfig(['node']);
    $this->installSchema('node', ['node_access']);
    $this->migrateUsers(FALSE);
    $this->migrateFields();

    $this->executeMigrations([
      'language',
      'd6_node_settings',
      'd6_node',
      'd6_node_translation',
      'd6_url_alias',
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Assert a path.
   *
<<<<<<< HEAD
   * @param string pid
=======
   * @param string $pid
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
   *   The path id.
   * @param array $conditions
   *   The path conditions.
   * @param array $path
   *   The path.
   */
  private function assertPath($pid, $conditions, $path) {
    $this->assertTrue($path, "Path alias for " . $conditions['source'] . " successfully loaded.");
    $this->assertIdentical($conditions['alias'], $path['alias']);
    $this->assertIdentical($conditions['langcode'], $path['langcode']);
    $this->assertIdentical($conditions['source'], $path['source']);
  }

  /**
   * Test the url alias migration.
   */
  public function testUrlAlias() {
    $id_map = $this->getMigration('d6_url_alias')->getIdMap();
    // Test that the field exists.
<<<<<<< HEAD
    $conditions = array(
      'source' => '/node/1',
      'alias' => '/alias-one',
      'langcode' => 'af',
    );
    $path = \Drupal::service('path.alias_storage')->load($conditions);
    $this->assertPath('1', $conditions, $path);
    $this->assertIdentical($id_map->lookupDestinationID(array($path['pid'])), array('1'), "Test IdMap");

    $conditions = array(
      'source' => '/node/2',
      'alias' => '/alias-two',
      'langcode' => 'en',
    );
=======
    $conditions = [
      'source' => '/node/1',
      'alias' => '/alias-one',
      'langcode' => 'af',
    ];
    $path = \Drupal::service('path.alias_storage')->load($conditions);
    $this->assertPath('1', $conditions, $path);
    $this->assertIdentical($id_map->lookupDestinationID([$path['pid']]), ['1'], "Test IdMap");

    $conditions = [
      'source' => '/node/2',
      'alias' => '/alias-two',
      'langcode' => 'en',
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $path = \Drupal::service('path.alias_storage')->load($conditions);
    $this->assertPath('2', $conditions, $path);

    // Test that we can re-import using the UrlAlias destination.
    Database::getConnection('default', 'migrate')
      ->update('url_alias')
<<<<<<< HEAD
      ->fields(array('dst' => 'new-url-alias'))
=======
      ->fields(['dst' => 'new-url-alias'])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('src', 'node/2')
      ->execute();

    \Drupal::database()
      ->update($id_map->mapTableName())
<<<<<<< HEAD
      ->fields(array('source_row_status' => MigrateIdMapInterface::STATUS_NEEDS_UPDATE))
=======
      ->fields(['source_row_status' => MigrateIdMapInterface::STATUS_NEEDS_UPDATE])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->execute();
    $migration = $this->getMigration('d6_url_alias');
    $this->executeMigration($migration);

<<<<<<< HEAD
    $path = \Drupal::service('path.alias_storage')->load(array('pid' => $path['pid']));
    $conditions['alias'] = '/new-url-alias';
    $this->assertPath('2', $conditions, $path);

    $conditions = array(
      'source' => '/node/3',
      'alias' => '/alias-three',
      'langcode' => 'und',
    );
=======
    $path = \Drupal::service('path.alias_storage')->load(['pid' => $path['pid']]);
    $conditions['alias'] = '/new-url-alias';
    $this->assertPath('2', $conditions, $path);

    $conditions = [
      'source' => '/node/3',
      'alias' => '/alias-three',
      'langcode' => 'und',
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $path = \Drupal::service('path.alias_storage')->load($conditions);
    $this->assertPath('3', $conditions, $path);
  }

<<<<<<< HEAD
=======
  /**
   * Test the URL alias migration with translated nodes.
   */
  public function testUrlAliasWithTranslatedNodes() {
    $alias_storage = $this->container->get('path.alias_storage');

    // Alias for the 'The Real McCoy' node in English.
    $path = $alias_storage->load(['alias' => '/the-real-mccoy']);
    $this->assertSame('/node/10', $path['source']);
    $this->assertSame('en', $path['langcode']);

    // Alias for the 'The Real McCoy' French translation,
    // which should now point to node/10 instead of node/11.
    $path = $alias_storage->load(['alias' => '/le-vrai-mccoy']);
    $this->assertSame('/node/10', $path['source']);
    $this->assertSame('fr', $path['langcode']);

    // Alias for the 'Abantu zulu' node in Zulu.
    $path = $alias_storage->load(['alias' => '/abantu-zulu']);
    $this->assertSame('/node/12', $path['source']);
    $this->assertSame('zu', $path['langcode']);

    // Alias for the 'Abantu zulu' English translation,
    // which should now point to node/12 instead of node/13.
    $path = $alias_storage->load(['alias' => '/the-zulu-people']);
    $this->assertSame('/node/12', $path['source']);
    $this->assertSame('en', $path['langcode']);
  }

>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
}
