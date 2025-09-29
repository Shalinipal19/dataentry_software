<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Product;
use App\Models\Category;

class ProductController extends BaseController
{
    public function index()
    {
        $productModel = new Product();
        $data['getData'] = $productModel->getProductsWithCategory();
        return view('admin/pages/product/index', $data);
    }

    public function addData()
    {
        $categoryModel = new Category();
        $productModel  = new Product();

        $data['getCategories'] = $categoryModel->findAll();

        if ($this->request->getMethod() === 'POST') {
            $postData = $this->request->getPost();

            // ✅ Validation rules
            $rules = [
                'product_name' => 'required',
                'price'        => 'required|decimal',
                'category_id'  => 'required|integer',
                'image'        => 'uploaded[image]|is_image[image]',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->with('error', 'Product field is required');
            }

            // ✅ Check category
            $category = $categoryModel->find($postData['category_id']);
            if (!$category) {
                return redirect()->back()->withInput()->with('error', 'Invalid Category Selected!');
            }

            // ✅ Discount calculation
            $price        = (float) $postData['price'];
            $any_discount = $postData['any_discount'] ?? 0;

            if ($any_discount == 1) {
                $discount_type = (int) $postData['discount_type'];
                $discount      = (float) $postData['discount'];

                if ($discount_type == 1) {
                    $disAmount = $price * ($discount / 100);
                } elseif ($discount_type == 2) {
                    $disAmount = $discount;
                } else {
                    $disAmount = 0;
                }

                $offer_price = round($price - $disAmount, 2);
            } else {
                $discount_type = 0;
                $discount      = 0;
                $offer_price   = $price;
            }

            // ✅ Prepare insert data
            $dataArray = [
                'product_name'  => $postData['product_name'],
                'category_id'   => $postData['category_id'],
                'category'      => $category['category_name'], // agar category table me "category" naam ka column hai
                'price'         => $price,
                'discount_type' => $discount_type,
                'discount'      => $discount,
                'offer_price'   => $offer_price,
                'size'          => $postData['size'] ?? null,
                'weight'        => $postData['weight'] ?? null,
                'description'   => $postData['description'] ?? null,
                'status'        => 1,
            ];

            // ✅ Image upload
            $image = $this->request->getFile('image');
            if ($image && $image->isValid() && !$image->hasMoved()) {
                $newName = $image->getRandomName();
                $image->move('./public/assets/uploads/product', $newName);
                $dataArray['image'] = $newName;
            }

            // ✅ Save product
            $productModel->save($dataArray);

            return redirect()->to('admin/product')->with('success', 'Product added successfully!');
        }

        return view('admin/pages/product/add-data', $data);
    }

    public function editData($id)
    {
        $categoryModel = new Category();
        $productModel  = new Product();

        $data['getCategories'] = $categoryModel->findAll();
        $data['getData'] = $productModel->find($id);

        if (!$data['getData']) {
            return redirect()->to('admin/product')->with('error', 'Product not found!');
        }

        $data['product'] = $data['getData'];

        if ($this->request->getMethod() === 'POST') {
            $postData = $this->request->getPost();

            // ✅ Validation rules
            $rules = [
                'product_name' => 'required',
                'price'        => 'required|decimal',
                'image'        => 'uploaded[image]|is_image[image]|max_size[image,2048]', // optional: max size 2MB
            ];


            // ✅ Check category
            $category = $categoryModel->find($postData['category_id']);
            if (!$category) {
                return redirect()->back()->withInput()->with('error', 'Invalid Category Selected!');
            }

            // ✅ Discount calculation
            $price        = (float) $postData['price'];
            $any_discount = $postData['any_discount'] ?? 0;

            if ($any_discount == 1) {
                $discount_type = (int) $postData['discount_type'];
                $discount      = (float) $postData['discount'];

                if ($discount_type == 1) {
                    $disAmount = $price * ($discount / 100);
                } elseif ($discount_type == 2) {
                    $disAmount = $discount;
                } else {
                    $disAmount = 0;
                }

                $offer_price = round($price - $disAmount, 2);
            } else {
                $discount_type = 0;
                $discount      = 0;
                $offer_price   = $price;
            }

            // ✅ Prepare update data
            $dataArray = [
                'product_name'  => $postData['product_name'],
                'category_id'   => $postData['category_id'],
                'category'      => $category['category_name'],
                'price'         => $price,
                'discount_type' => $discount_type,
                'discount'      => $discount,
                'offer_price'   => $offer_price,
                'size'          => $postData['size'] ?? null,
                'weight'        => $postData['weight'] ?? null,
                'description'   => $postData['description'] ?? null,
                'status'        => $postData['status'] ?? 1,
            ];

            // ✅ Image upload (optional)
            $image = $this->request->getFile('image');
            if ($image && $image->isValid() && !$image->hasMoved()) {
                // Delete old image if exists
                if (!empty($product['image']) && file_exists('./public/assets/uploads/product/' . $product['image'])) {
                    unlink('./public/assets/uploads/product/' . $product['image']);
                }

                $newName = $image->getRandomName();
                $image->move('./public/assets/uploads/product', $newName);
                $dataArray['image'] = $newName;
            }

            // ✅ Update product
            $productModel->update($id, $dataArray);

            return redirect()->to('admin/product')->with('success', 'Product updated successfully!');
        }

        return view('admin/pages/product/edit-data', $data);
    }


}
