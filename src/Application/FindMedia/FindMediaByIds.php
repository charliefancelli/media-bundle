<?php
declare(strict_types=1);

namespace Ranky\MediaBundle\Application\FindMedia;


use Ranky\MediaBundle\Application\DataTransformer\MediaToResponseTransformer;
use Ranky\MediaBundle\Application\DataTransformer\Response\MediaResponse;
use Ranky\MediaBundle\Domain\Contract\MediaRepositoryInterface;
use Ranky\MediaBundle\Domain\ValueObject\MediaId;

class FindMediaByIds
{

    public function __construct(
        private readonly MediaRepositoryInterface $mediaRepository,
        private readonly MediaToResponseTransformer $responseTransformer,
    ) {
    }

    /**
     * @param array<string> $ids
     * @return array<MediaResponse>
     */
    public function __invoke(?array $ids): array
    {
        if (empty($ids)) {
            return [];
        }

        $mediaIds = \array_map(static fn(string $id) => MediaId::fromString($id), $ids);
        $results        = $this->mediaRepository->findByIds(
            ...$mediaIds
        );

        return $this->responseTransformer->mediaCollectionToArrayResponse($results);
    }


}
