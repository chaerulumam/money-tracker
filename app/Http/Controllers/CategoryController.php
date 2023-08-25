<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function index()
    {
        $categories = $this->categoryRepository->getAllData();

        // parsing variabel categories to blade
        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|unique:categories' // unique value
        ]);

        $data = [
            'title' => $request->input('title')
        ];

        $this->categoryRepository->create($data);

        return redirect()->route('categories');
    }

    public function edit($id)
    {
        // initialize data category by id
        $category = $this->categoryRepository->findDataById($id);

        // parsing id to category view
        return view('categories.edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, $id)
    {
        // initialize data value
        $data = ['title' => $request->input('title')];

        try {
            // check the data first
            $this->categoryRepository->updateDataById($id, $data);

            // if succes redirect to category dashboatd
            return redirect()->route('categories')->with('success', 'Successfully update category data');
        } catch (\Throwable $th) {
            // if fail back to category edit page or route
            return back()->with('error', 'Failed to update category');
        }
    }
}
