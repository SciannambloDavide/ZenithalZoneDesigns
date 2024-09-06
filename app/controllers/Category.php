<?php

namespace app\controllers;

#[\app\filters\isAdmin]
class Category extends \app\core\Controller
{

    function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST["title"];
            $category = new \app\models\Category();
            $category->title = $title;
            $category->insert();
            header("location:/Admin/categoryManagement");
        } else {
            $this->view("category/create");
        }
    }

    //TODO DELETE FUNCTION, ONLY DELETE IF PRODUCT CONTAINS MORE THAN 1 Category
    //UPDATE CATEGORY NAME

    function update()
    {
        $category = new \app\models\Category();
        $cat_id = $_GET["id"];
        $category = $category->getByCatId($cat_id);

        $product_cat = new \app\models\Product_category();
        $product_cat = $product_cat->getAllByCatId($cat_id);
        $products = [];
        foreach ($product_cat as $index => $product_category) {
            $product = new \app\models\Product();
            $product = $product->getProductByID($product_category->product_id);
            $products[] = $product;
        }

        $data = ['category' => $category, 'products' => $products];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST["title"];
            $category->title = $title;
            $category->update();
            header("location:/Admin/categoryManagement");
        } else {
            $this->view("category/update", $data);
        }
    }

    function delete()
    {
        $category = new \app\models\Category();
        $cat_id = $_GET["id"];
        $category = $category->getByCatId($cat_id);

        //Return All products_ids where it has only one category
        $product_cat = \app\models\Product_category::getCountIsOne();
        $valid = true;
        $nonProduct = [];
        foreach ($product_cat as $index => $product_category) {
            //if the one category matches the category the user is trying to delete
            //prevent and ask to add category to other products first
            if ($product_category->category_id == $cat_id) {
                $valid = false;
                $product = new \app\models\Product();
                $product = $product->getProductByID($product_category->product_id);
                $nonProduct[] = $product;
            }
        }

        if ($valid) {
            //If valid means no cat product has matching cat_id
            $category->delete();
            header("location:/Admin/categoryManagement");
        } else {
            $message = "<p>The Following Product(s) Only Contain The Category You're Trying to Delete<br>
            Please Add a Different Category to The Product(s) Before Deleting The Current Category:</p>";
            if ($_SESSION['lang'] == 'fr') {
                $message = "<p>Les produits suivant contient uniquement la catégorie que vous essayez de supprimer<br>.
                Veuillez ajouter une catégorie différente au(x) produit(s) avant de supprimer la catégorie actuelle:</p>";
            }
            foreach ($nonProduct as $index => $product) {
                $message .= "<b> $product->title<br></b>";
            }

            $category = new \app\models\Category();
            $category = $category->getAll();
            $data = ['category' => $category, 'message' => $message];
            $this->view("Admin/categoryManagement", $data);
        }
    }


    function deleteMultiple()
    {
        $category = new \app\models\Category();
        if (isset($_GET['product_ids'])) {
            $cat_id = $_GET["id"];
            $category = $category->getByCatId($cat_id);
            $productIds = explode(",", $_GET['product_ids']);
            //Return All products_ids where it has only one category
            $product_cat = \app\models\Product_category::getCountIsOne();

            //Hold product ids that can't be delete
            $nonDelete = [];

            //If the product_id with one category matches with selected product Ids don't remove
            foreach ($product_cat as $index => $product_category) {
                if (in_array($product_category->product_id, $productIds)) {
                    $nonDelete[] = $product_category->product_id;
                }
            }

            $productIds = array_diff($productIds, $nonDelete);
            //Remove product from cat if they have more than one
            if (count($productIds) != 0) {
                foreach ($productIds as $index => $product_id) {
                    $prodCat = new \app\models\Product_category();
                    $prodCat->deleteProductAndCategory($product_id, $cat_id);
                }
            }

            //If matchingIds exist
            if (count($nonDelete) != 0) {
                $message = "<p>The Following Product(s) Cannot Be Remove From The <b>$category->title</b><br>
                 Please Add a Different Category to The Product(s) Before Deleting Them:</p>";
                if ($_SESSION['lang'] == 'fr') {
                    $message = "<p>Le(s) produit(s) suivant(s) ne peut/peuvent pas être retiré(s) de la <b>$category->title</b><br>
                    Veuillez ajouter une catégorie différente au(x) produit(s) avant de les supprimer :</p>";
                }
                foreach ($nonDelete as $index => $product_id) {
                    $product = new \app\models\Product();
                    $product = $product->getProductByID($product_id);
                    $message .= "<b> $product->title<br></b>";
                }

                $product_cat = new \app\models\Product_category();
                $product_cat = $product_cat->getAllByCatId($cat_id);
                $products = [];
                foreach ($product_cat as $index => $product_category) {
                    $product = new \app\models\Product();
                    $product = $product->getProductByID($product_category->product_id);
                    $products[] = $product;
                }

                $data = ['category' => $category, 'products' => $products, 'message' => $message];
                $this->view("category/update", $data);
            } else {
                $cat_id = $_GET["id"];
                header("location:/Category/edit?id=$cat_id");
            }
        } else {
            $cat_id = $_GET["id"];
            $category = $category->getByCatId($cat_id);
            $data = ['category' => $category];
            $this->view("category/update", $data);
        }
    }

    function addMultiple()
    {
        $category = new \app\models\Category();
        if (isset($_GET['product_ids'])) {
            $cat_id = $_GET["id"];
            $category = $category->getByCatId($cat_id);
            $productIds = explode(",", $_GET['product_ids']);
            //All these ids don't belong to cat, add them
            foreach ($productIds as $index => $product_id) {
                $product_cat = new \app\models\Product_category();
                $product_cat->category_id = $cat_id;
                $product_cat->product_id = $product_id;
                if ($product_cat->getCountByProIdCatId() == 0) {
                    $product_cat->insert();
                }
                //check if this combinat of cat_id and prod_id existed

            }

            $message = "<p>The Selected Product(s) Have Been Added to The <b>$category->title</b></p>";
            if ($_SESSION['lang'] == 'fr') {
                $message = "<p>Le(s) produit(s) sélectionné(s) a (ont) été ajouté(s) à la <b>$category->title</b></p>";
            }
            $product_cat = \app\models\Product_category::getAllButCatId($cat_id);
            $products = [];
            $product_cat_e = new \app\models\Product_category();
            $product_cat_e = $product_cat_e->getAllByCatId($cat_id);

            $product_valid_ids = [];

            //Remove prod that has this category
            foreach ($product_cat as $index => $product_category) {
                $flag = false;
                foreach ($product_cat_e as $Index => $product_category_e) {
                    if ($product_category->product_id == $product_category_e->product_id) {
                        $flag = true;
                    }
                }
                if ($flag == false) {
                    $product_valid_ids[] =  $product_category;
                }
            }

            //Remove Duplicate Values
            $finalProdCat = $product_valid_ids;
            foreach ($product_valid_ids as $index => $product_cat) {
                $count = 0;
                foreach ($finalProdCat as $key => $product_category) {
                    if ($product_category->product_id == $product_cat->product_id) {
                        $count++;
                    }

                    if ($count > 1) {
                        unset($finalProdCat[$key]);
                    }
                }
            }

            $products = [];
            foreach ($finalProdCat as $index => $product_category) {
                $product = new \app\models\Product();
                $product = $product->getProductByID($product_category->product_id);
                $products[] = $product;
            }

            $data = ['category' => $category, 'products' => $products, 'message' => $message];
            $this->view("category/addMultiple", $data);
        } else {
            $cat_id = $_GET["id"];
            $category = $category->getByCatId($cat_id);
            $product_cat = \app\models\Product_category::getAllButCatId($cat_id);
            $product_cat_e = new \app\models\Product_category();
            $product_cat_e = $product_cat_e->getAllByCatId($cat_id);

            $product_valid_ids = [];

            //Remove prod that has this category
            foreach ($product_cat as $index => $product_category) {
                $flag = false;
                foreach ($product_cat_e as $Index => $product_category_e) {
                    if ($product_category->product_id == $product_category_e->product_id) {
                        $flag = true;
                    }
                }
                if ($flag == false) {
                    $product_valid_ids[] =  $product_category;
                }
            }

            //Remove Duplicate Values
            $finalProdCat = $product_valid_ids;
            foreach ($product_valid_ids as $index => $product_cat) {
                $count = 0;
                foreach ($finalProdCat as $key => $product_category) {
                    if ($product_category->product_id == $product_cat->product_id) {
                        $count++;
                    }

                    if ($count > 1) {
                        $count--;
                        unset($finalProdCat[$key]);
                    }
                }
            }

            $products = [];
            foreach ($finalProdCat as $index => $product_category) {
                $product = new \app\models\Product();
                $product = $product->getProductByID($product_category->product_id);
                $products[] = $product;
            }


            $data = ['category' => $category, 'products' => $products];
            $this->view("category/addMultiple", $data);
        }
    }
}
