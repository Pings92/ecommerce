<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\SubCategory;
use App\Form\DisplayProductType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\SubCategoryRepository;
use Doctrine\ORM\Mapping\Id;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page')]
    public function index(PaginatorInterface $paginator,
                          Request $request,
                          ProductRepository $productRepository,
                          CategoryRepository $categoryRepository,
                          SubCategoryRepository $subCategoryRepository
                          ): Response
    {
        // $p = $productRepository->findByIdUp(18);
        // dd($p);
        // $search = $productRepository->searchEngine('gamme');
        // dd($search);
        // $products = $productRepository->findAll();
        $data= $productRepository->findby([], ['id'=>"DESC"]);
        $products = $paginator->paginate(
            $data,
            $request->query->getInt('page',1),
            6
        );
        return $this->render('home_page/index.html.twig', [
            // 'controller_name' => 'HomePageController',
            'products'=> $products,
            'categories'=>$categoryRepository->findAll(),
            'subCategories'=>$subCategoryRepository->findAll()

        ]);
    }

    #[Route('product/{id}/show', name: 'app_home_product_show', methods: ['GET'])]
    public function showProduct(Product $product, ProductRepository $productRepository, CategoryRepository $categoryRepository, SubCategoryRepository $subCategoryRepository): Response
    {return $this->render('home_page/show.html.twig', [
        'product'=>$product,
        'lastProductAdded'=> $productRepository->findBy([], ['id'=>'DESC'], 3),
        'categories'=>$categoryRepository->findAll(),
        // 'subCategories'=>$subCategoryRepository->findBy()
    ]);
    }

    #[Route('/product/subcategory/{id}/filter', name: 'app_product_filter', methods: ['GET'])]
    public function filter($id, SubCategoryRepository $subCategoryRepository, subCategory $subCategory): Response
    {
        $product = $subCategoryRepository->find($id)->getProducts();
        $subCategory = $subCategoryRepository->find($id);
        return $this->render('home_page/filter.html.twig', [
        'products'=>$product,    
        'subCategory'=> $subCategory
        ]);
    }    
    
    // #[Route('/display', name: 'app_product_on_home_page')]
    // public function showProductHomepage($id, ProductRepository $productRepository): Response
    // {
    //     $products = $productRepository->findAll();
    //     // $form = $this->createForm(DisplayProductType::class, $product);

    //     return $this->render('product/index.html.twig', [
    //         // 'products' => $productRepository->findAll(),
    //     ]);
    // }
    }

