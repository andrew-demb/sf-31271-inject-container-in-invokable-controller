<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class InvokableController extends AbstractController
{
    public function __invoke()
    {
        return $this->json(
            [
                'url' => $this->generateUrl('broken'),
            ]
        );
    }
}
