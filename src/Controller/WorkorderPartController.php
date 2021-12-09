<?php

namespace App\Controller;

use App\Entity\Workorder;
use App\Entity\WorkorderPart;
use App\Repository\PartRepository;
use App\Repository\WorkorderRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\WorkorderPartRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/workorder/part")
 */
class WorkorderPartController extends AbstractController
{
    private $workorderPartRepository;
    private $partRepositiory;
    private $manager;

    public function __construct(
        WorkorderPartRepository $workorderPartRepositiory,
        PartRepository $partRepository,
        EntityManagerInterface $manager
    ) {
        $this->workorderPartRepository = $workorderPartRepositiory;
        $this->partRepository = $partRepository;
        $this->manager = $manager;
    }

    /**
     * Retirer des pièces détachées d'un BT en édition et réintégration dans le stock
     * 
     * @Route("/remove/{id}/{workorderPartId}", name="remove_part")
     */
    public function remove(Workorder $workorder, int $workorderPartId): Response
    {
        $workorderParts = $workorder->getWorkorderParts();

        foreach ($workorderParts as $workorderPart) {
            $workorderPartQte = $workorderPart->getQuantity();
            $part = $workorderPart->getPart();
            $stock=$part->getStock();
            $qteStock = $stock->getQteStock();

            if ($workorderPart->getId() == $workorderPartId) {
                if ($workorderPartQte > 1) {
                    --$workorderPartQte;
                    $workorderPart->setQuantity($workorderPartQte);
                } else {
                    $workorderParts->removeElement($workorderPart);
                }
                ++$qteStock;
                $stock->setQteStock($qteStock);
            }
            
            $this->manager->flush();
        }

        return $this->redirectToRoute('work_order_show', [
            'id' => $workorder->getId()
        ], Response::HTTP_SEE_OTHER);
    }
}
