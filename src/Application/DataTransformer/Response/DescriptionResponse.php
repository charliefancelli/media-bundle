<?php

declare(strict_types=1);

namespace Ranky\MediaBundle\Application\DataTransformer\Response;


use Ranky\MediaBundle\Domain\ValueObject\Description;
use Ranky\SharedBundle\Application\Dto\ResponseDtoInterface;


final class DescriptionResponse implements ResponseDtoInterface
{

    public function __construct(
        private readonly string $alt,
        private readonly string $title,
        private readonly ?string $legend,
        private readonly ?string $copyright,
    )
    {
    }

    public static function fromDescription(Description $description): self
    {
        return new self(
            $description->alt(),
            $description->title(),
            $description->legend(),
            $description->copyright(),
        );
    }

    public function alt(): string
    {
        return $this->alt;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function legend(): ?string
    {
        return $this->legend;
    }

    public function copyright(): ?string
    {
        return $this->copyright;
    }

    /**
     * @return array{alt: string, title: string, legend: ?string, copyright: ?string}
     */
    public function toArray(): array
    {
        return [
            'alt' => $this->alt(),
            'title' => $this->title(),
            'legend' => $this->legend(),
            'copyright' => $this->copyright(),
        ];
    }

    /**
     * @return array{alt: string, title: string, legend: ?string, copyright: ?string}
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }


}
