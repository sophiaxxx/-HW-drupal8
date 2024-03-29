<?php

namespace Drupal\migrate\Plugin;

use Drupal\Component\Graph\Graph;
use Drupal\Component\Plugin\PluginBase;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Plugin\Discovery\ContainerDerivativeDiscoveryDecorator;
<<<<<<< HEAD
=======
use Drupal\migrate\Plugin\Discovery\ProviderFilterDecorator;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
use Drupal\Core\Plugin\Discovery\YamlDirectoryDiscovery;
use Drupal\Core\Plugin\Factory\ContainerFactory;
use Drupal\migrate\MigrateBuildDependencyInterface;

/**
 * Plugin manager for migration plugins.
 */
class MigrationPluginManager extends DefaultPluginManager implements MigrationPluginManagerInterface, MigrateBuildDependencyInterface {

  /**
   * Provides default values for migrations.
   *
   * @var array
   */
<<<<<<< HEAD
  protected $defaults = array(
    'class' => '\Drupal\migrate\Plugin\Migration',
  );
=======
  protected $defaults = [
    'class' => '\Drupal\migrate\Plugin\Migration',
  ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * The interface the plugins should implement.
   *
   * @var string
   */
  protected $pluginInterface = 'Drupal\migrate\Plugin\MigrationInterface';

  /**
   * The module handler.
   *
   * @var \Drupal\Core\Extension\ModuleHandlerInterface
   */
  protected $moduleHandler;

  /**
   * Construct a migration plugin manager.
   *
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   The cache backend for the definitions.
   * @param \Drupal\Core\Language\LanguageManagerInterface $language_manager
   *   The language manager.
   */
  public function __construct(ModuleHandlerInterface $module_handler, CacheBackendInterface $cache_backend, LanguageManagerInterface $language_manager) {
    $this->factory = new ContainerFactory($this, $this->pluginInterface);
    $this->alterInfo('migration_plugins');
<<<<<<< HEAD
    $this->setCacheBackend($cache_backend, 'migration_plugins', array('migration_plugins'));
=======
    $this->setCacheBackend($cache_backend, 'migration_plugins', ['migration_plugins']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->moduleHandler = $module_handler;
  }

  /**
   * {@inheritdoc}
   */
  protected function getDiscovery() {
    if (!isset($this->discovery)) {
      $directories = array_map(function($directory) {
        return [$directory . '/migration_templates', $directory . '/migrations'];
      }, $this->moduleHandler->getModuleDirectories());

      $yaml_discovery = new YamlDirectoryDiscovery($directories, 'migrate');
<<<<<<< HEAD
      $this->discovery = new ContainerDerivativeDiscoveryDecorator($yaml_discovery);
=======
      // This gets rid of migrations which try to use a non-existent source
      // plugin. The common case for this is if the source plugin has, or
      // specifies, a non-existent provider.
      $only_with_source_discovery  = new NoSourcePluginDecorator($yaml_discovery);
      // This gets rid of migrations with explicit providers set if one of the
      // providers do not exist before we try to use a potentially non-existing
      // deriver. This is a rare case.
      $filtered_discovery = new ProviderFilterDecorator($only_with_source_discovery, [$this->moduleHandler, 'moduleExists']);
      $this->discovery = new ContainerDerivativeDiscoveryDecorator($filtered_discovery);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    }
    return $this->discovery;
  }

  /**
   * {@inheritdoc}
   */
<<<<<<< HEAD
  public function createInstance($plugin_id, array $configuration = array()) {
    $instances = $this->createInstances([$plugin_id], $configuration);
=======
  public function createInstance($plugin_id, array $configuration = []) {
    $instances = $this->createInstances([$plugin_id], [$plugin_id => $configuration]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    return reset($instances);
  }

  /**
   * {@inheritdoc}
   */
<<<<<<< HEAD
  public function createInstances($migration_id, array $configuration = array()) {
=======
  public function createInstances($migration_id, array $configuration = []) {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    if (empty($migration_id)) {
      $migration_id = array_keys($this->getDefinitions());
    }

    $factory = $this->getFactory();
    $migration_ids = (array) $migration_id;
    $plugin_ids = $this->expandPluginIds($migration_ids);

    $instances = [];
    foreach ($plugin_ids as $plugin_id) {
      $instances[$plugin_id] = $factory->createInstance($plugin_id, isset($configuration[$plugin_id]) ? $configuration[$plugin_id] : []);
    }

    foreach ($instances as $migration) {
      $migration->set('migration_dependencies', array_map([$this, 'expandPluginIds'], $migration->getMigrationDependencies()));
    }

    // Sort the migrations based on their dependencies.
    return $this->buildDependencyMigration($instances, []);
  }

  /**
   * Create migrations given a tag.
   *
   * @param string $tag
   *   A migration tag we want to filter by.
   *
   * @return array|\Drupal\migrate\Plugin\MigrationInterface[]
   *   An array of migration objects with the given tag.
   */
  public function createInstancesByTag($tag) {
    $migrations = array_filter($this->getDefinitions(), function($migration) use ($tag) {
      return !empty($migration['migration_tags']) && in_array($tag, $migration['migration_tags']);
    });
    return $this->createInstances(array_keys($migrations));
  }

  /**
   * Expand derivative migration dependencies.
   *
   * We need to expand any derivative migrations. Derivative migrations are
   * calculated by migration derivers such as D6NodeDeriver. This allows
   * migrations to depend on the base id and then have a dependency on all
   * derivative migrations. For example, d6_comment depends on d6_node but after
   * we've expanded the dependencies it will depend on d6_node:page,
   * d6_node:story and so on, for other derivative migrations.
   *
   * @return array
   *   An array of expanded plugin ids.
   */
  protected function expandPluginIds(array $migration_ids) {
    $plugin_ids = [];
    foreach ($migration_ids as $id) {
      $plugin_ids += preg_grep('/^' . preg_quote($id, '/') . PluginBase::DERIVATIVE_SEPARATOR . '/', array_keys($this->getDefinitions()));
      if ($this->hasDefinition($id)) {
        $plugin_ids[] = $id;
      }
    }
    return $plugin_ids;
  }


  /**
   * {@inheritdoc}
   */
  public function buildDependencyMigration(array $migrations, array $dynamic_ids) {
    // Migration dependencies can be optional or required. If an optional
    // dependency does not run, the current migration is still OK to go. Both
    // optional and required dependencies (if run at all) must run before the
    // current migration.
    $dependency_graph = [];
    $required_dependency_graph = [];
    $have_optional = FALSE;
    foreach ($migrations as $migration) {
      /** @var \Drupal\migrate\Plugin\MigrationInterface $migration */
      $id = $migration->id();
      $requirements[$id] = [];
      $dependency_graph[$id]['edges'] = [];
      $migration_dependencies = $migration->getMigrationDependencies();

      if (isset($migration_dependencies['required'])) {
        foreach ($migration_dependencies['required'] as $dependency) {
          if (!isset($dynamic_ids[$dependency])) {
            $this->addDependency($required_dependency_graph, $id, $dependency, $dynamic_ids);
          }
          $this->addDependency($dependency_graph, $id, $dependency, $dynamic_ids);
        }
      }
      if (!empty($migration_dependencies['optional'])) {
        foreach ($migration_dependencies['optional'] as $dependency) {
          $this->addDependency($dependency_graph, $id, $dependency, $dynamic_ids);
        }
        $have_optional = TRUE;
      }
    }
    $dependency_graph = (new Graph($dependency_graph))->searchAndSort();
    if ($have_optional) {
      $required_dependency_graph = (new Graph($required_dependency_graph))->searchAndSort();
    }
    else {
      $required_dependency_graph = $dependency_graph;
    }
    $weights = [];
    foreach ($migrations as $migration_id => $migration) {
      // Populate a weights array to use with array_multisort() later.
      $weights[] = $dependency_graph[$migration_id]['weight'];
      if (!empty($required_dependency_graph[$migration_id]['paths'])) {
        $migration->set('requirements', $required_dependency_graph[$migration_id]['paths']);
      }
    }
    array_multisort($weights, SORT_DESC, SORT_NUMERIC, $migrations);

    return $migrations;
  }

  /**
   * Add one or more dependencies to a graph.
   *
   * @param array $graph
   *   The graph so far, passed by reference.
   * @param int $id
   *   The migration ID.
   * @param string $dependency
   *   The dependency string.
   * @param array $dynamic_ids
   *   The dynamic ID mapping.
   */
  protected function addDependency(array &$graph, $id, $dependency, $dynamic_ids) {
<<<<<<< HEAD
    $dependencies = isset($dynamic_ids[$dependency]) ? $dynamic_ids[$dependency] : array($dependency);
    if (!isset($graph[$id]['edges'])) {
      $graph[$id]['edges'] = array();
=======
    $dependencies = isset($dynamic_ids[$dependency]) ? $dynamic_ids[$dependency] : [$dependency];
    if (!isset($graph[$id]['edges'])) {
      $graph[$id]['edges'] = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    }
    $graph[$id]['edges'] += array_combine($dependencies, $dependencies);
  }

  /**
   * {@inheritdoc}
   */
  public function createStubMigration(array $definition) {
    $id = isset($definition['id']) ? $definition['id'] : uniqid();
    return Migration::create(\Drupal::getContainer(), [], $id, $definition);
  }

<<<<<<< HEAD
=======
  /**
   * Finds plugin definitions.
   *
   * @return array
   *   List of definitions to store in cache.
   *
   * @todo This is a temporary solution to the fact that migration source
   *   plugins have more than one provider. This functionality will be moved to
   *   core in https://www.drupal.org/node/2786355.
   */
  protected function findDefinitions() {
    $definitions = $this->getDiscovery()->getDefinitions();
    foreach ($definitions as $plugin_id => &$definition) {
      $this->processDefinition($definition, $plugin_id);
    }
    $this->alterDefinitions($definitions);
    return ProviderFilterDecorator::filterDefinitions($definitions, function ($provider) {
      return $this->providerExists($provider);
    });
  }

>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
}
