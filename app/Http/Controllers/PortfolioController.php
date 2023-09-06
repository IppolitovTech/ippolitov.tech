<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;

class PortfolioController extends Controller
{
    private $fields = ['img', 'header', 'text', 'link', 'sort', 'work'];

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {

        $data['portfolio'] = Portfolio::orderBy('sort', 'asc')->paginate(10);
        $fields = $this->fields;
        return view('pages.portfolio.index', compact('fields'), $data);
    }

    public function create()
    {
        $fields = $this->fields;
        return view('pages.portfolio.create', compact('fields'));
    }

    public function edit(Portfolio $portfolio)
    {
        return view('pages.portfolio.edit', compact('portfolio'));
    }

    public function store(Request $request)
    {
        $portfolio = new Portfolio;
        $this->save($portfolio, $request);
        return redirect()->route('portfolio.index')
            ->with('success', 'Portfolio has been created successfully.');
    }

    public function update(Request $request, $id)
    {
        $portfolio = Portfolio::find($id);
        $this->save($portfolio, $request);
        return redirect()->route('portfolio.index')
            ->with('success', 'Portfolio has been updated successfully.');
    }

    public function save($portfolio, $request)
    {
        foreach ($this->fields as $field) {
            $portfolio->$field = $request->$field;
        }
        $portfolio->save();
    }


    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();
        return redirect()->route('portfolio.index')
            ->with('success', 'Portfolio has been deleted successfully');
    }
}
