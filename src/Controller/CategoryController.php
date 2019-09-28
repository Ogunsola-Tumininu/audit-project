<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


class CategoryController extends ApiController
{
    /**
     * @Route("/categories", methods="GET")
     */
    public function index(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->transformAll();

        return $this->respond($categories);
    }


    /**
     * @Route("/categories/{id}", methods="GET")
     */
    public function show($id, CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->find($id);

        if (!$categories) {
            return $this->respondNotFound();
        }

        $categories = $categoryRepository->transform($categories);
        // $categories = $categoryRepository->transformAll();

        return $this->respond($categories);
    }

    /**
     * @Route("/categories/audit/{id}", methods="GET")
     */
    public function shows($id, CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findBy(["audit_id" => (int) $id]);

        if (!$categories) {
            return $this->respondNotFound();
        }

        $categories = $categoryRepository->transformArray($categories);

        return $this->respond($categories);
    }

    /**
     * @Route("/categories", methods="POST")
     */
    public function create(Request $request, CategoryRepository $categoryRepository, EntityManagerInterface $em)
    {
        $request = $this->transformJsonBody($request);

        if (!$request) {
            return $this->respondValidationError('Please provide a valid request!');
        }

        // validate the name
        if (!$request->get('name')) {
            return $this->respondValidationError('Please provide a name!');
        }

        // validate the cat_id
        if (!$request->get('cat_id')) {
            return $this->respondValidationError('Please provide a cat_id!');
        }

        // validate the no of category
        if (!$request->get('audit_id')) {
            return $this->respondValidationError('Please provide a audit!');
        }



        // persist the new category
        $category = new Category;
        $category->setName($request->get('name'));
        $category->setCatId($request->get('cat_id'));
        $category->setAuditId($request->get('audit_id'));
        $em->persist($category);
        $em->flush();

        return $this->respondCreated($categoryRepository->transform($category));
    }

    /**
     * @Route("/categories/{id}", methods="POST")
     */
    public function edit(Request $request, $id, EntityManagerInterface $em, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->find($id);

        $request = $this->transformJsonBody($request);

        if (!$request) {
            return $this->respondValidationError('Please provide a valid request!');
        }

        // validate the name
        if (!$request->get('name')) {
            return $this->respondValidationError('Please provide a name!');
        }

        // validate the cat_id
        if (!$request->get('cat_id')) {
            return $this->respondValidationError('Please provide a cat_id!');
        }

        // validate the no of category
        if (!$request->get('audit_id')) {
            return $this->respondValidationError('Please provide a audit!');
        }
        if (!$category) {
            return $this->respondNotFound();
        }
        $category->setName($request->get('name'));
        $category->setCatId($request->get('cat_id'));
        $category->setAuditId($request->get('audit_id'));
        $em->persist($category);
        $em->flush();

        return $this->respondCreated($categoryRepository->transform($category));
    }

}
