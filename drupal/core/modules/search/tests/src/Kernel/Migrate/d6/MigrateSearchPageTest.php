<?php

namespace Drupal\Tests\search\Kernel\Migrate\d6;

use Drupal\Core\Database\Database;
use Drupal\Tests\migrate_drupal\Kernel\d6\MigrateDrupal6TestBase;
use Drupal\search\Entity\SearchPage;

/**
 * Upgrade search rank settings to search.page.*.yml.
 *
 * @group migrate_drupal_6
 */
class MigrateSearchPageTest extends MigrateDrupal6TestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = ['search'];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->executeMigration('search_page');
  }

  /**
   * Tests Drupal 6 search settings to Drupal 8 search page entity migration.
   */
  public function testSearchPage() {
    $id = 'node_search';
    /** @var \Drupal\search\Entity\SearchPage $search_page */
    $search_page = SearchPage::load($id);
    $this->assertIdentical($id, $search_page->id());
    $configuration = $search_page->getPlugin()->getConfiguration();
<<<<<<< HEAD
    $this->assertIdentical($configuration['rankings'], array(
=======
    $this->assertIdentical($configuration['rankings'], [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'comments' => 5,
      'promote' => 0,
      'recent' => 0,
      'relevance' => 2,
      'sticky' => 8,
      'views' => 1,
<<<<<<< HEAD
    ));
=======
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical('node', $search_page->getPath());

    // Test that we can re-import using the EntitySearchPage destination.
    Database::getConnection('default', 'migrate')
      ->update('variable')
<<<<<<< HEAD
      ->fields(array('value' => serialize(4)))
=======
      ->fields(['value' => serialize(4)])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('name', 'node_rank_comments')
      ->execute();

    /** @var \Drupal\migrate\Plugin\MigrationInterface $migration */
    $migration = $this->getMigration('search_page');
    // Indicate we're rerunning a migration that's already run.
    $migration->getIdMap()->prepareUpdate();
    $this->executeMigration($migration);

    $configuration = SearchPage::load($id)->getPlugin()->getConfiguration();
    $this->assertIdentical(4, $configuration['rankings']['comments']);
  }

}
