<?php

namespace Drupal\Tests\search\Kernel\Migrate\d7;

use Drupal\Core\Database\Database;
use Drupal\Tests\migrate_drupal\Kernel\d7\MigrateDrupal7TestBase;
use Drupal\search\Entity\SearchPage;

/**
 * Upgrade search rank settings to search.page.*.yml.
 *
 * @group migrate_drupal_7
 */
class MigrateSearchPageTest extends MigrateDrupal7TestBase {

  /**
   * The modules to be enabled during the test.
   *
   * {@inheritdoc}
   */
<<<<<<< HEAD
  public static $modules = array('node', 'search');
=======
  public static $modules = ['node', 'search'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->executeMigration('search_page');
  }

  /**
   * Tests Drupal 7 search ranking to Drupal 8 search page entity migration.
   */
  public function testSearchPage() {
    $id = 'node_search';
    /** @var \Drupal\search\Entity\SearchPage $search_page */
    $search_page = SearchPage::load($id);
    $this->assertIdentical($id, $search_page->id());
    $configuration = $search_page->getPlugin()->getConfiguration();
<<<<<<< HEAD
    $expected_rankings = array(
=======
    $expected_rankings = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'comments' => 0,
      'promote' => 0,
      'relevance' => 2,
      'sticky' => 0,
      'views' => 0,
<<<<<<< HEAD
    );
=======
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical($expected_rankings, $configuration['rankings']);
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
