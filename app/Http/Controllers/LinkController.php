<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLinkRequest;
use App\Http\Services\LinkService;
use App\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $links = Link::latest();

        return view('create', compact('links'));
    }


    /**
     * @param CreateLinkRequest $request
     * @param LinkService $linkService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateLinkRequest $request, LinkService $linkService)
    {
        $shortLink = $linkService->handle($request->validated());

        if($shortLink){
            return redirect()->route('links.show', $shortLink);
        }

        return redirect()->route('links.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Link $link
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        return view('show', compact('link'));
    }



    public function redirect(Link $link)
    {
        if ($link->is_expired) {
            return redirect('/')->withMessage('Link expired');
        }

        return redirect($link->full);
    }
}
