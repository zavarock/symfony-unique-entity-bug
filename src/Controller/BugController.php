<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\ChangeBugLabelDto;
use App\Entity\Bug;
use App\Repository\BugRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[Route('/bugs')]
class BugController extends AbstractController
{
    #[Route('/')]
    public function index(BugRepository $repository): Response
    {
        $bugs = $repository->findAll();

        return $this
            ->json(array_map(fn(Bug $bug) => [
                'id' => $bug->getId(),
                'label' => $bug->getLabel(),
                'changeLabelUrl' => $this->generateUrl('change_bug_label', [
                    'id' => $bug->getId(),
                    'label' => $bug->getLabel(),
                ], UrlGeneratorInterface::ABSOLUTE_URL)
            ], $bugs))
            ->setEncodingOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    #[Route('/change-label', name: 'change_bug_label')]
    public function changeLabel(#[MapQueryString] ChangeBugLabelDto $dto): Response
    {
        return $this->json($dto);
    }
}
