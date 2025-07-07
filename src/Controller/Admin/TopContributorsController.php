<?php

namespace PsCommunity\Controller\Admin;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TopContributorsController extends FrameworkBundleAdminController
{
    /**
     * @Route("/pscommunity/top-contributors", name="pscommunity_top_contributors")
     */
    public function index(): Response
    {
        $contributors = [
            ['name' => 'Alice', 'contributions' => 120],
            ['name' => 'Bob', 'contributions' => 95],
            ['name' => 'Charlie', 'contributions' => 87],
        ];

        return $this->render('@Modules/pscommunity/views/templates/admin/top_contributors.html.twig', [
            'contributors' => $contributors,
        ]);
    }
}
