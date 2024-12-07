<?php

namespace App\Dto;

use App\Entity\Bug;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqueEntity(
    fields: ['label'],
    entityClass: Bug::class,
    identifierFieldNames: ['id'],
)]
class ChangeBugLabelDto
{
    public ?Uuid $id = null;

    #[Assert\NotBlank]
    public ?string $label = null;
}
