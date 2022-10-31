<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;

class PortfolioController extends Controller
{
    public function index()
    {

        $data['portfolio'] = Portfolio::orderBy('id', 'desc')->paginate(10);
        return view('pages.portfolio.index', $data);
    }

    public function create()
    {
        return view('pages.portfolio.create');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('pages.portfolio.edit', compact('portfolio'));
    }

    public function store(Request $request)
    {
        $portfolio = new Portfolio;
        $portfolio->img = $request->img;
        $portfolio->header = $request->header;
        $portfolio->text = $request->text;
        $portfolio->save();
        return redirect()->route('portfolio.index')
            ->with('success', 'Portfolio has been created successfully.');
    }

    public function update(Request $request, $id)
    {
        $portfolio = Portfolio::find($id);
        $portfolio->img = $request->img;
        $portfolio->header = $request->header;
        $portfolio->text = $request->text;
        $portfolio->save();
        return redirect()->route('portfolio.index')
            ->with('success', 'Portfolio has been updated successfully.');
    }

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();
        return redirect()->route('portfolio.index')
            ->with('success', 'Portfolio has been deleted successfully');
    }
}
