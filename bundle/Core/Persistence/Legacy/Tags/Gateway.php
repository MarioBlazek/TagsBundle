<?php

namespace Netgen\TagsBundle\Core\Persistence\Legacy\Tags;

use Netgen\TagsBundle\SPI\Persistence\Tags\CreateStruct;
use Netgen\TagsBundle\SPI\Persistence\Tags\SynonymCreateStruct;
use Netgen\TagsBundle\SPI\Persistence\Tags\UpdateStruct;

abstract class Gateway
{
    /**
     * Returns an array with basic tag data.
     *
     * @param int $tagId
     *
     * @return array
     */
    abstract public function getBasicTagData($tagId);

    /**
     * Returns an array with basic tag data by remote ID.
     *
     * @param string $remoteId
     *
     * @return array
     */
    abstract public function getBasicTagDataByRemoteId($remoteId);

    /**
     * Returns an array with full tag data.
     *
     * @param int $tagId
     * @param string[] $translations
     * @param bool $useAlwaysAvailable
     *
     * @return array
     */
    abstract public function getFullTagData($tagId, array $translations = null, $useAlwaysAvailable = true);

    /**
     * Returns an array with basic tag data for the tag with $remoteId.
     *
     * @param string $remoteId
     * @param string[] $translations
     * @param bool $useAlwaysAvailable
     *
     * @return array
     */
    abstract public function getFullTagDataByRemoteId($remoteId, array $translations = null, $useAlwaysAvailable = true);

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
    abstract public function getFullTagDataByKeywordAndParentId($keyword, $parentId, array $translations = null, $useAlwaysAvailable = true);

    /**
     * Returns data for the first level children of the tag identified by given $tagId.
     *
     * @param int $tagId
     * @param int $offset The start offset for paging
     * @param int $limit The number of tags returned. If $limit = -1 all children starting at $offset are returned
     * @param string[] $translations
     * @param bool $useAlwaysAvailable
     *
     * @return array
     */
    abstract public function getChildren($tagId, $offset = 0, $limit = -1, array $translations = null, $useAlwaysAvailable = true);

    /**
     * Returns how many tags exist below tag identified by $tagId.
     *
     * @param int $tagId
     * @param string[] $translations
     * @param bool $useAlwaysAvailable
     *
     * @return int
     */
    abstract public function getChildrenCount($tagId, array $translations = null, $useAlwaysAvailable = true);

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
     * @return array
     */
    abstract public function getTagsByKeyword($keyword, $translation, $useAlwaysAvailable = true, $exactMatch = true, $offset = 0, $limit = -1);

    /**
     * Returns how many tags exist with $keyword.
     *
     * @param string $keyword
     * @param string $translation
     * @param bool $useAlwaysAvailable
     * @param bool $exactMatch
     *
     * @return int
     */
    abstract public function getTagsByKeywordCount($keyword, $translation, $useAlwaysAvailable = true, $exactMatch = true);

    /**
     * Returns data for synonyms of the tag identified by given $tagId.
     *
     * @param int $tagId
     * @param int $offset The start offset for paging
     * @param int $limit The number of tags returned. If $limit = -1 all synonyms starting at $offset are returned
     * @param string[] $translations
     * @param bool $useAlwaysAvailable
     *
     * @return array
     */
    abstract public function getSynonyms($tagId, $offset = 0, $limit = -1, array $translations = null, $useAlwaysAvailable = true);

    /**
     * Returns how many synonyms exist for a tag identified by $tagId.
     *
     * @param int $tagId
     * @param string[] $translations
     * @param bool $useAlwaysAvailable
     *
     * @return int
     */
    abstract public function getSynonymCount($tagId, array $translations = null, $useAlwaysAvailable = true);

    /**
     * Moves the synonym identified by $synonymId to tag identified by $mainTagData.
     *
     * @param int $synonymId
     * @param array $mainTagData
     */
    abstract public function moveSynonym($synonymId, $mainTagData);

    /**
     * Creates a new tag using the given $createStruct below $parentTag.
     *
     * @param \Netgen\TagsBundle\SPI\Persistence\Tags\CreateStruct $createStruct
     * @param array $parentTag
     *
     * @return int
     */
    abstract public function create(CreateStruct $createStruct, array $parentTag = null);

    /**
     * Updates an existing tag.
     *
     * @param \Netgen\TagsBundle\SPI\Persistence\Tags\UpdateStruct $updateStruct
     * @param int $tagId
     */
    abstract public function update(UpdateStruct $updateStruct, $tagId);

    /**
     * Creates a new synonym using the given $keyword for tag $tag.
     *
     * @param \Netgen\TagsBundle\SPI\Persistence\Tags\SynonymCreateStruct $createStruct
     * @param array $tag
     *
     * @return \Netgen\TagsBundle\SPI\Persistence\Tags\Tag
     */
    abstract public function createSynonym(SynonymCreateStruct $createStruct, array $tag);

    /**
     * Converts tag identified by $tagId to a synonym of tag identified by $mainTagData.
     *
     * @param int $tagId
     * @param array $mainTagData
     */
    abstract public function convertToSynonym($tagId, $mainTagData);

    /**
     * Transfers all tag attribute links from tag identified by $tagId into the tag identified by $targetTagId.
     *
     * @param int $tagId
     * @param int $targetTagId
     */
    abstract public function transferTagAttributeLinks($tagId, $targetTagId);

    /**
     * Moves a tag identified by $sourceTagData into new parent identified by $destinationParentTagData.
     *
     * @param array $sourceTagData
     * @param array $destinationParentTagData
     */
    abstract public function moveSubtree(array $sourceTagData, array $destinationParentTagData = null);

    /**
     * Deletes tag identified by $tagId, including its synonyms and all tags under it.
     *
     * If $tagId is a synonym, only the synonym is deleted
     *
     * @param int $tagId
     */
    abstract public function deleteTag($tagId);
}
