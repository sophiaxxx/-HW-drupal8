<?php

namespace Drupal\Tests\node\Kernel;

use Drupal\user\UserInterface;
use Drupal\Core\Field\Entity\BaseFieldOverride;
use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;
use Drupal\node\Entity\Node;
use Drupal\node\Entity\NodeType;

/**
 * Tests node field overrides.
 *
 * @group node
 */
class NodeFieldOverridesTest extends EntityKernelTestBase {

  /**
   * Current logged in user.
   *
   * @var \Drupal\user\UserInterface
   */
  protected $user;

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('user', 'system', 'field', 'node');
=======
  public static $modules = ['user', 'system', 'field', 'node'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
<<<<<<< HEAD
    $this->installConfig(array('user'));
=======
    $this->installConfig(['user']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->user = $this->createUser();
    \Drupal::service('current_user')->setAccount($this->user);
  }

  /**
   * Tests that field overrides work as expected.
   */
  public function testFieldOverrides() {
    if (!NodeType::load('ponies')) {
      NodeType::create(['name' => 'Ponies', 'type' => 'ponies'])->save();
    }
    $override = BaseFieldOverride::loadByName('node', 'ponies', 'uid');
    if ($override) {
      $override->delete();
    }
    $uid_field = \Drupal::entityManager()->getBaseFieldDefinitions('node')['uid'];
    $config = $uid_field->getConfig('ponies');
    $config->save();
    $this->assertEqual($config->get('default_value_callback'), 'Drupal\node\Entity\Node::getCurrentUserId');
    /** @var \Drupal\node\NodeInterface $node */
    $node = Node::create(['type' => 'ponies']);
    $owner = $node->getOwner();
    $this->assertTrue($owner instanceof UserInterface);
    $this->assertEqual($owner->id(), $this->user->id());
  }

}
