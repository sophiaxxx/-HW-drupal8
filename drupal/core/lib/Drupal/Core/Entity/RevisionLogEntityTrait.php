<?php

namespace Drupal\Core\Entity;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\user\UserInterface;

/**
 * Provides a trait for accessing revision logging and ownership information.
 *
 * @ingroup entity_api
 */
trait RevisionLogEntityTrait {

  /**
   * Provides revision-related base field definitions for an entity type.
   *
   * @param \Drupal\Core\Entity\EntityTypeInterface $entity_type
   *   The entity type definition.
   *
   * @return \Drupal\Core\Field\FieldDefinitionInterface[]
   *   An array of base field definitions for the entity type, keyed by field
   *   name.
   *
   * @see \Drupal\Core\Entity\FieldableEntityInterface::baseFieldDefinitions()
   */
  public static function revisionLogBaseFieldDefinitions(EntityTypeInterface $entity_type) {
<<<<<<< HEAD
    $fields['revision_created'] = BaseFieldDefinition::create('created')
=======
    $fields[static::getRevisionMetadataKey($entity_type, 'revision_created')] = BaseFieldDefinition::create('created')
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->setLabel(t('Revision create time'))
      ->setDescription(t('The time that the current revision was created.'))
      ->setRevisionable(TRUE);

<<<<<<< HEAD
    $fields['revision_user'] = BaseFieldDefinition::create('entity_reference')
=======
    $fields[static::getRevisionMetadataKey($entity_type, 'revision_user')] = BaseFieldDefinition::create('entity_reference')
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->setLabel(t('Revision user'))
      ->setDescription(t('The user ID of the author of the current revision.'))
      ->setSetting('target_type', 'user')
      ->setRevisionable(TRUE);

<<<<<<< HEAD
    $fields['revision_log_message'] = BaseFieldDefinition::create('string_long')
=======
    $fields[static::getRevisionMetadataKey($entity_type, 'revision_log_message')] = BaseFieldDefinition::create('string_long')
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->setLabel(t('Revision log message'))
      ->setDescription(t('Briefly describe the changes you have made.'))
      ->setRevisionable(TRUE)
      ->setDefaultValue('')
      ->setDisplayOptions('form', [
        'type' => 'string_textarea',
        'weight' => 25,
        'settings' => [
          'rows' => 4,
        ],
      ]);

    return $fields;
  }

  /**
   * Implements \Drupal\Core\Entity\RevisionLogInterface::getRevisionCreationTime().
   */
  public function getRevisionCreationTime() {
<<<<<<< HEAD
    return $this->revision_created->value;
=======
    return $this->{static::getRevisionMetadataKey($this->getEntityType(), 'revision_created')}->value;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Implements \Drupal\Core\Entity\RevisionLogInterface::setRevisionCreationTime().
   */
  public function setRevisionCreationTime($timestamp) {
<<<<<<< HEAD
    $this->revision_created->value = $timestamp;
=======
    $this->{static::getRevisionMetadataKey($this->getEntityType(), 'revision_created')}->value = $timestamp;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    return $this;
  }

  /**
   * Implements \Drupal\Core\Entity\RevisionLogInterface::getRevisionUser().
   */
  public function getRevisionUser() {
<<<<<<< HEAD
    return $this->revision_user->entity;
=======
    return $this->{static::getRevisionMetadataKey($this->getEntityType(), 'revision_user')}->entity;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Implements \Drupal\Core\Entity\RevisionLogInterface::setRevisionUser().
   */
  public function setRevisionUser(UserInterface $account) {
<<<<<<< HEAD
    $this->revision_user->entity = $account;
=======
    $this->{static::getRevisionMetadataKey($this->getEntityType(), 'revision_user')}->entity = $account;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    return $this;
  }

  /**
   * Implements \Drupal\Core\Entity\RevisionLogInterface::getRevisionUserId().
   */
  public function getRevisionUserId() {
<<<<<<< HEAD
    return $this->revision_user->target_id;
=======
    return $this->{static::getRevisionMetadataKey($this->getEntityType(), 'revision_user')}->target_id;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Implements \Drupal\Core\Entity\RevisionLogInterface::setRevisionUserId().
   */
  public function setRevisionUserId($user_id) {
<<<<<<< HEAD
    $this->revision_user->target_id = $user_id;
=======
    $this->{static::getRevisionMetadataKey($this->getEntityType(), 'revision_user')}->target_id = $user_id;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    return $this;
  }

  /**
   * Implements \Drupal\Core\Entity\RevisionLogInterface::getRevisionLogMessage().
   */
  public function getRevisionLogMessage() {
<<<<<<< HEAD
    return $this->revision_log_message->value;
=======
    return $this->{static::getRevisionMetadataKey($this->getEntityType(), 'revision_log_message')}->value;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Implements \Drupal\Core\Entity\RevisionLogInterface::setRevisionLogMessage().
   */
  public function setRevisionLogMessage($revision_log_message) {
<<<<<<< HEAD
    $this->revision_log_message->value = $revision_log_message;
    return $this;
  }

=======
    $this->{static::getRevisionMetadataKey($this->getEntityType(), 'revision_log_message')}->value = $revision_log_message;
    return $this;
  }

  /**
   * Gets the name of a revision metadata field.
   *
   * @param \Drupal\Core\Entity\EntityTypeInterface $entity_type
   *   A content entity type definition.
   * @param string $key
   *   The revision metadata key to get, must be one of 'revision_created',
   *   'revision_user' or 'revision_log_message'.
   *
   * @return string
   *   The name of the field for the specified $key.
   */
  protected static function getRevisionMetadataKey(EntityTypeInterface $entity_type, $key) {
    // We need to prevent ContentEntityType::getRevisionMetadataKey() from
    // providing fallback as that requires fetching the entity type's field
    // definition leading to an infinite recursion.
    /** @var \Drupal\Core\Entity\ContentEntityTypeInterface $entity_type */
    $revision_metadata_keys = $entity_type->getRevisionMetadataKeys(FALSE) + [
      'revision_created' => 'revision_created',
      'revision_user' => 'revision_user',
      'revision_log_message' => 'revision_log_message',
    ];

    return $revision_metadata_keys[$key];
  }

>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
}
