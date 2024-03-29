<?php

namespace Drupal\taxonomy\Tests\Views;

use Drupal\taxonomy\Entity\Term;
use Drupal\taxonomy\Entity\Vocabulary;
use Drupal\views\Entity\View;
use Drupal\views\Tests\ViewTestData;

/**
 * Test the taxonomy term index filter.
 *
 * @see \Drupal\taxonomy\Plugin\views\filter\TaxonomyIndexTid
 *
 * @group taxonomy
 */
class TaxonomyIndexTidFilterTest extends TaxonomyTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = ['taxonomy', 'taxonomy_test_views', 'views', 'node'];

  /**
   * {@inheritdoc}
   */
  public static $testViews = ['test_filter_taxonomy_index_tid__non_existing_dependency'];

  /**
   * @var \Drupal\taxonomy\TermInterface[]
   */
  protected $terms = [];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp(FALSE);

    // Setup vocabulary and terms so the initial import is valid.
    Vocabulary::create([
      'vid' => 'tags',
      'name' => 'Tags',
    ])->save();

    // This will get a term ID of 3.
    $term = Term::create([
      'vid' => 'tags',
      'name' => 'muh',
    ]);
    $term->save();
    // This will get a term ID of 4.
    $this->terms[$term->id()] = $term;
    $term = Term::create([
      'vid' => 'tags',
      'name' => 'muh',
    ]);
    $term->save();
    $this->terms[$term->id()] = $term;

<<<<<<< HEAD
    ViewTestData::createTestViews(get_class($this), array('taxonomy_test_views'));
=======
    ViewTestData::createTestViews(get_class($this), ['taxonomy_test_views']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests dependencies are not added for terms that do not exist.
   */
  public function testConfigDependency() {
    /** @var \Drupal\views\Entity\View $view */
    $view = View::load('test_filter_taxonomy_index_tid__non_existing_dependency');

    // Dependencies are sorted.
    $content_dependencies = [
      $this->terms[3]->getConfigDependencyName(),
      $this->terms[4]->getConfigDependencyName(),
    ];
    sort($content_dependencies);

    $this->assertEqual([
      'config' => [
        'taxonomy.vocabulary.tags',
      ],
      'content' => $content_dependencies,
      'module' => [
        'node',
        'taxonomy',
        'user',
      ],
    ], $view->calculateDependencies()->getDependencies());

    $this->terms[3]->delete();

    $this->assertEqual([
      'config' => [
        'taxonomy.vocabulary.tags',
      ],
      'content' => [
        $this->terms[4]->getConfigDependencyName(),
      ],
      'module' => [
        'node',
        'taxonomy',
        'user',
      ],
    ], $view->calculateDependencies()->getDependencies());
  }

  /**
   * Tests post update function fixes dependencies.
   *
   * @see views_post_update_taxonomy_index_tid()
   */
  public function testPostUpdateFunction() {
    /** @var \Drupal\views\Entity\View $view */
    $view = View::load('test_filter_taxonomy_index_tid__non_existing_dependency');

    // Dependencies are sorted.
    $content_dependencies = [
      $this->terms[3]->getConfigDependencyName(),
      $this->terms[4]->getConfigDependencyName(),
    ];
    sort($content_dependencies);

    $this->assertEqual([
      'config' => [
        'taxonomy.vocabulary.tags',
      ],
      'content' => $content_dependencies,
      'module' => [
        'node',
        'taxonomy',
        'user',
      ],
    ], $view->calculateDependencies()->getDependencies());

    $this->terms[3]->delete();

    \Drupal::moduleHandler()->loadInclude('views', 'post_update.php');
    views_post_update_taxonomy_index_tid();

    $view = View::load('test_filter_taxonomy_index_tid__non_existing_dependency');
    $this->assertEqual([
      'config' => [
        'taxonomy.vocabulary.tags',
      ],
      'content' => [
        $this->terms[4]->getConfigDependencyName(),
      ],
      'module' => [
        'node',
        'taxonomy',
        'user',
      ],
    ], $view->getDependencies());
  }

}
