<?php

namespace Netgen\TagsBundle\Core\Persistence\Legacy\Tags\Gateway;

use Doctrine\DBAL\DBALException;
use Netgen\TagsBundle\Core\Persistence\Legacy\Tags\Gateway;
use Netgen\TagsBundle\SPI\Persistence\Tags\CreateStruct;
use Netgen\TagsBundle\SPI\Persistence\Tags\SynonymCreateStruct;
use Netgen\TagsBundle\SPI\Persistence\Tags\UpdateStruct;
use PDOException;
use RuntimeException;

class ExceptionConversion extends Gateway
{
    /**
     * The wrapped gateway.
     *
     * @var \Netgen\TagsBundle\Core\Persistence\Legacy\Tags\Gateway
     */
    protected $innerGateway;

    /**
     * Creates a new exception conversion gateway around $innerGateway.
     *
     * @param \Netgen\TagsBundle\Core\Persistence\Legacy\Tags\Gateway $innerGateway
     */
    public function __construct(Gateway $innerGateway)
    {
        $this->innerGateway = $innerGateway;
    }

    /**
     * Returns an array with basic tag data.
     *
     * @param mixed $tagId
     *
     * @throws \RuntimeException
     *
     * @return array
     */
    public function getBasicTagData($tagId)
    {
        try {
            return $this->innerGateway->getBasicTagData($tagId);
        } catch (DBALException $e) {
            throw new RuntimeException('Database error', 0, $e);
        } catch (PDOException $e) {
            throw new RuntimeException('Database error', 0, $e);
        }
    }

    /**
     * Returns an array with basic tag data by remote ID.
     *
     * @param string $remoteId
     *
     * @return array
     */
    public function getBasicTagDataByRemoteId($remoteId)
    {
        try {
            return $this->innerGateway->getBasicTagDataByRemoteId($remoteId);
        } catch (DBALException $e) {
            throw new RuntimeException('Database error', 0, $e);
        } catch (PDOException $e) {
            throw new RuntimeException('Database error', 0, $e);
        }
    }

    /**
     * Returns an array with full tag data.
     *
     * @param mixed $tagId
     * @param string[] $translations
     * @param bool $useAlwaysAvailable
     *
     * @throws \RuntimeException
     *
     * @return array
     */
    public function getFullTagData($tagId, array $translations = null, $useAlwaysAvailable = true)
    {
        try {
            return $this->innerGateway->getFullTagData($tagId, $translations, $useAlwaysAvailable);
        } catch (DBALException $e) {
            throw new RuntimeException('Database error', 0, $e);
        } catch (PDOException $e) {
            throw new RuntimeException('Database error', 0, $e);
        }
    }

    /**
     * Returns an array with basic tag data for the tag with $remoteId.
     *
     * @param string $remoteId
     * @param string[] $translations
     * @param bool $useAlwaysAvailable
     *
     * @throws \RuntimeException
     *
     * @return array
     */
    public function getFullTagDataByRemoteId($remoteId, array $translations = null, $useAlwaysAvailable = true)
    {
        try {
            return $this->innerGateway->getFullTagDataByRemoteId($remoteId, $translations, $useAlwaysAvailable);
        } catch (DBALException $e) {
            throw new RuntimeException('Database error', 0, $e);
        } catch (PDOException $e) {
            throw new RuntimeException('Database error', 0, $e);
        }
    }

    /**
     * Returns an array with full tag data for the tag with $parentId parent ID and $keyword keyword.
     *
     * @param string $keyword
     * @param string $parentId
     * @param string[] $translations
     * @param bool $useAlwaysAvailable
     *
     * @return array
     */
    public function getFullTagDataByKeywordAndParentId($keyword, $parentId, array $translations = null, $useAlwaysAvailable = true)
    {
        try {
            return $this->innerGateway->getFullTagDataByKeywordAndParentId($keyword, $parentId, $translations, $useAlwaysAvailable);
        } catch (DBALException $e) {
            throw new RuntimeException('Database error', 0, $e);
        } catch (PDOException $e) {
            throw new RuntimeException('Database error', 0, $e);
        }
    }

    /**
     * Returns data for the first level children of the tag identified by given $tagId.
     *
     * @param mixed $tagId
     * @param int $offset The start offset for paging
     * @param int $limit The number of tags returned. If $limit = -1 all children starting at $offset are returned
     * @param string[] $translations
     * @param bool $useAlwaysAvailable
     *
     * @throws \RuntimeException
     *
     * @return array
     */
    public function getChildren($tagId, $offset = 0, $limit = -1, array $translations = null, $useAlwaysAvailable = true)
    {
        try {
            return $this->innerGateway->getChildren($tagId, $offset, $limit, $translations, $useAlwaysAvailable);
        } catch (DBALException $e) {
            throw new RuntimeException('Database error', 0, $e);
        } catch (PDOException $e) {
            throw new RuntimeException('Database error', 0, $e);
        }
    }

    /**
     * Returns how many tags exist below tag identified by $tagId.
     *
     * @param mixed $tagId
     * @param string[] $translations
     * @param bool $useAlwaysAvailable
     *
     * @throws \RuntimeException
     *
     * @return int
     */
    public function getChildrenCount($tagId, array $translations = null, $useAlwaysAvailable = true)
    {
        try {
            return $this->innerGateway->getChildrenCount($tagId, $translations, $useAlwaysAvailable);
        } catch (DBALException $e) {
            throw new RuntimeException('Database error', 0, $e);
        } catch (PDOException $e) {
            throw new RuntimeException('Database error', 0, $e);
        }
    }

    /**
     * Returns data for tags identified by given $keyword.
     *
     * @param string $keyword
     * @param string $translation
     * @param bool $useAlwaysAvailable
     * @param bool $exactMatch
     * @param int $offset The start offset for paging
     * @param int $limit The number of tags returned. If $limit = -1 all tags starting at $offset are returned
     *
     * @throws \RuntimeException
     *
     * @return array
     */
    public function getTagsByKeyword($keyword, $translation, $useAlwaysAvailable = true, $exactMatch = true, $offset = 0, $limit = -1)
    {
        try {
            return $this->innerGateway->getTagsByKeyword($keyword, $translation, $useAlwaysAvailable, $exactMatch, $offset, $limit);
        } catch (DBALException $e) {
            throw new RuntimeException('Database error', 0, $e);
        } catch (PDOException $e) {
            throw new RuntimeException('Database error', 0, $e);
        }
    }

    /**
     * Returns how many tags exist with $keyword.
     *
     * @param string $keyword
     * @param string $translation
     * @param bool $useAlwaysAvailable
     * @param bool $exactMatch
     *
     * @throws \RuntimeException
     *
     * @return int
     */
    public function getTagsByKeywordCount($keyword, $translation, $useAlwaysAvailable = true, $exactMatch = true)
    {
        try {
            return $this->innerGateway->getTagsByKeywordCount($keyword, $translation, $useAlwaysAvailable, $exactMatch);
        } catch (DBALException $e) {
            throw new RuntimeException('Database error', 0, $e);
        } catch (PDOException $e) {
            throw new RuntimeException('Database error', 0, $e);
        }
    }

    /**
     * Returns data for synonyms of the tag identified by given $tagId.
     *
     * @param mixed $tagId
     * @param int $offset The start offset for paging
     * @param int $limit The number of tags returned. If $limit = -1 all synonyms starting at $offset are returned
     * @param string[] $translations
     * @param bool $useAlwaysAvailable
     *
     * @throws \RuntimeException
     *
     * @return array
     */
    public function getSynonyms($tagId, $offset = 0, $limit = -1, array $translations = null, $useAlwaysAvailable = true)
    {
        try {
            return $this->innerGateway->getSynonyms($tagId, $offset, $limit, $translations, $useAlwaysAvailable);
        } catch (DBALException $e) {
            throw new RuntimeException('Database error', 0, $e);
        } catch (PDOException $e) {
            throw new RuntimeException('Database error', 0, $e);
        }
    }

    /**
     * Returns how many synonyms exist for a tag identified by $tagId.
     *
     * @param mixed $tagId
     * @param string[] $translations
     * @param bool $useAlwaysAvailable
     *
     * @throws \RuntimeException
     *
     * @return int
     */
    public function getSynonymCount($tagId, array $translations = null, $useAlwaysAvailable = true)
    {
        try {
            return $this->innerGateway->getSynonymCount($tagId, $translations, $useAlwaysAvailable);
        } catch (DBALException $e) {
            throw new RuntimeException('Database error', 0, $e);
        } catch (PDOException $e) {
            throw new RuntimeException('Database error', 0, $e);
        }
    }

    /**
     * Moves the synonym identified by $synonymId to tag identified by $mainTagData.
     *
     * @param mixed $synonymId
     * @param array $mainTagData
     *
     * @throws \RuntimeException
     */
    public function moveSynonym($synonymId, $mainTagData)
    {
        try {
            return $this->innerGateway->moveSynonym($synonymId, $mainTagData);
        } catch (DBALException $e) {
            throw new RuntimeException('Database error', 0, $e);
        } catch (PDOException $e) {
            throw new RuntimeException('Database error', 0, $e);
        }
    }

    /**
     * Creates a new tag using the given $createStruct below $parentTag.
     *
     * @param \Netgen\TagsBundle\SPI\Persistence\Tags\CreateStruct $createStruct
     * @param array $parentTag
     *
     * @throws \RuntimeException
     *
     * @return int
     */
    public function create(CreateStruct $createStruct, array $parentTag = null)
    {
        try {
            return $this->innerGateway->create($createStruct, $parentTag);
        } catch (DBALException $e) {
            throw new RuntimeException('Database error', 0, $e);
        } catch (PDOException $e) {
            throw new RuntimeException('Database error', 0, $e);
        }
    }

    /**
     * Updates an existing tag.
     *
     * @param \Netgen\TagsBundle\SPI\Persistence\Tags\UpdateStruct $updateStruct
     * @param mixed $tagId
     *
     * @throws \RuntimeException
     */
    public function update(UpdateStruct $updateStruct, $tagId)
    {
        try {
            $this->innerGateway->update($updateStruct, $tagId);
        } catch (DBALException $e) {
            throw new RuntimeException('Database error', 0, $e);
        } catch (PDOException $e) {
            throw new RuntimeException('Database error', 0, $e);
        }
    }

    /**
     * Creates a new synonym using the given $keyword for tag $tag.
     *
     * @param \Netgen\TagsBundle\SPI\Persistence\Tags\SynonymCreateStruct $createStruct
     * @param array $tag
     *
     * @throws \RuntimeException
     *
     * @return \Netgen\TagsBundle\SPI\Persistence\Tags\Tag
     */
    public function createSynonym(SynonymCreateStruct $createStruct, array $tag)
    {
        try {
            return $this->innerGateway->createSynonym($createStruct, $tag);
        } catch (DBALException $e) {
            throw new RuntimeException('Database error', 0, $e);
        } catch (PDOException $e) {
            throw new RuntimeException('Database error', 0, $e);
        }
    }

    /**
     * Converts tag identified by $tagId to a synonym of tag identified by $mainTagData.
     *
     * @param mixed $tagId
     * @param array $mainTagData
     *
     * @throws \RuntimeException
     */
    public function convertToSynonym($tagId, $mainTagData)
    {
        try {
            return $this->innerGateway->convertToSynonym($tagId, $mainTagData);
        } catch (DBALException $e) {
            throw new RuntimeException('Database error', 0, $e);
        } catch (PDOException $e) {
            throw new RuntimeException('Database error', 0, $e);
        }
    }

    /**
     * Transfers all tag attribute links from tag identified by $tagId into the tag identified by $targetTagId.
     *
     * @param mixed $tagId
     * @param mixed $targetTagId
     *
     * @throws \RuntimeException
     */
    public function transferTagAttributeLinks($tagId, $targetTagId)
    {
        try {
            $this->innerGateway->transferTagAttributeLinks($tagId, $targetTagId);
        } catch (DBALException $e) {
            throw new RuntimeException('Database error', 0, $e);
        } catch (PDOException $e) {
            throw new RuntimeException('Database error', 0, $e);
        }
    }

    /**
     * Moves a tag identified by $sourceTagData into new parent identified by $destinationParentTagData.
     *
     * @param array $sourceTagData
     * @param array $destinationParentTagData
     *
     * @throws \RuntimeException
     */
    public function moveSubtree(array $sourceTagData, array $destinationParentTagData = null)
    {
        try {
            $this->innerGateway->moveSubtree($sourceTagData, $destinationParentTagData);
        } catch (DBALException $e) {
            throw new RuntimeException('Database error', 0, $e);
        } catch (PDOException $e) {
            throw new RuntimeException('Database error', 0, $e);
        }
    }

    /**
     * Deletes tag identified by $tagId, including its synonyms and all tags under it.
     *
     * @param mixed $tagId
     *
     * @throws \RuntimeException
     *
     * If $tagId is a synonym, only the synonym is deleted
     */
    public function deleteTag($tagId)
    {
        try {
            $this->innerGateway->deleteTag($tagId);
        } catch (DBALException $e) {
            throw new RuntimeException('Database error', 0, $e);
        } catch (PDOException $e) {
            throw new RuntimeException('Database error', 0, $e);
        }
    }
}
