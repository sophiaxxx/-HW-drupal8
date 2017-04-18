<?php

namespace Drupal\KernelTests\Core\Entity;

<<<<<<< HEAD
use Drupal\entity_test\Entity\EntityTestWithRevisionLog;
=======
use Drupal\entity_test_revlog\Entity\EntityTestWithRevisionLog;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
use Drupal\KernelTests\KernelTestBase;
use Drupal\user\Entity\User;

/**
 * @coversDefaultClass \Drupal\Core\Entity\RevisionableContentEntityBase
 * @group Entity
 */
class RevisionableContentEntityBaseTest extends KernelTestBase {

  /**
   * {@inheritdoc}
   */
<<<<<<< HEAD
  public static $modules = ['entity_test', 'system', 'user'];
=======
  public static $modules = ['entity_test_revlog', 'system', 'user'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->installEntitySchema('entity_test_revlog');
    $this->installEntitySchema('user');
    $this->installSchema('system', 'sequences');
  }

  public function testRevisionableContentEntity() {
    $user = User::create(['name' => 'test name']);
    $user->save();
<<<<<<< HEAD
    /** @var \Drupal\entity_test\Entity\EntityTestWithRevisionLog $entity */
=======
    /** @var \Drupal\entity_test_revlog\Entity\EntityTestWithRevisionLog $entity */
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $entity = EntityTestWithRevisionLog::create([
      'type' => 'entity_test_revlog',
    ]);
    $entity->save();

    $entity->setNewRevision(TRUE);
    $random_timestamp = rand(1e8, 2e8);
    $entity->setRevisionCreationTime($random_timestamp);
    $entity->setRevisionUserId($user->id());
    $entity->setRevisionLogMessage('This is my log message');
    $entity->save();

    $revision_id = $entity->getRevisionId();

    $entity = \Drupal::entityTypeManager()->getStorage('entity_test_revlog')->loadRevision($revision_id);
    $this->assertEquals($random_timestamp, $entity->getRevisionCreationTime());
    $this->assertEquals($user->id(), $entity->getRevisionUserId());
    $this->assertEquals($user->id(), $entity->getRevisionUser()->id());
    $this->assertEquals('This is my log message', $entity->getRevisionLogMessage());
  }

}
