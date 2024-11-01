<?php
declare(strict_types=1);

namespace Ranky\MediaBundle\Domain\ValueObject;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Embeddable]
final class Description
{

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private readonly string $alt;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private readonly string $title;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private readonly ?string $legend;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private readonly ?string $copyright;

    public function __construct(string $alt, ?string $title = null, ?string $legend = null, ?string $copyright = null)
    {
        $this->alt = $alt;
        $this->title = $title ?? $alt;
        $this->legend = $legend;
        $this->copyright = $copyright;
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
}
