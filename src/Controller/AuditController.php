<?php
namespace App\Controller;

use App\Entity\Audit;
use App\Repository\AuditRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class AuditController extends ApiController
{
    /**
    * @Route("/audits", methods="GET")
    */
    public function index(AuditRepository $auditRepository)
    {
        $audits = $auditRepository->transformAll();

        return $this->respond($audits);
    }


    /**
    * @Route("/audits/{id}", methods="GET")
    */
    public function show($id, AuditRepository $auditRepository)
    {
        $audits = $auditRepository->find($id);

        if(!$audits){
            return $this->respondNotFound();
        }

        $audits = $auditRepository->transform($audits);

        return $this->respond($audits);
    }

     /**
    * @Route("/audits", methods="POST")
    */
    public function create(Request $request, AuditRepository $auditRepository, EntityManagerInterface $em)
    {
        $request = $this->transformJsonBody($request);

        if (! $request) {
            return $this->respondValidationError('Please provide a valid request!');
        }

        // validate the title
        if (! $request->get('title')) {
            return $this->respondValidationError('Please provide a title!');
        }

        // validate the description
        if (! $request->get('description')) {
            return $this->respondValidationError('Please provide a description!');
        }

        // validate the no of category
        if (! $request->get('no_of_category')) {
            return $this->respondValidationError('Please provide a category!');
        }

        // validate the section
        if (! $request->get('no_of_section')) {
            return $this->respondValidationError('Please provide a section!');
        }

        // persist the new audit
        $audit = new Audit;
        $audit->setTitle($request->get('title'));
        $audit->setDescription($request->get('description'));
        $audit->setNoOfCategory($request->get('no_of_category'));
        $audit->setNoOfSection($request->get('no_of_section'));
        $em->persist($audit);
        $em->flush();

        return $this->respondCreated($auditRepository->transform($audit));
    }

    /**
    * @Route("/audits/{id}", methods="POST")
    */
    public function edit(Request $request, $id, EntityManagerInterface $em, AuditRepository $auditRepository)
    {
        $audit = $auditRepository->find($id);

        $request = $this->transformJsonBody($request);

        if (! $request) {
            return $this->respondValidationError('Please provide a valid request!');
        }

        // validate the title
        if (! $request->get('title')) {
            return $this->respondValidationError('Please provide a title!');
        }

        // validate the description
        if (! $request->get('description')) {
            return $this->respondValidationError('Please provide a description!');
        }

        // validate the no of category
        if (! $request->get('no_of_category')) {
            return $this->respondValidationError('Please provide a category!');
        }

        // validate the section
        if (! $request->get('no_of_section')) {
            return $this->respondValidationError('Please provide a section!');
        }

        if (! $audit) {
            return $this->respondNotFound();
        }
        $audit->setTitle($request->get('title'));
        $audit->setDescription($request->get('description'));
        $audit->setNoOfCategory($request->get('no_of_category'));
        $audit->setNoOfSection($request->get('no_of_section'));
        
        $em->persist($audit);
        $em->flush();

        return $this->respondCreated($auditRepository->transform($audit));
    }
}
