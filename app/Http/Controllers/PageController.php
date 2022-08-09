<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Page::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePageRequest $request
     * @return Response
     */
    public function store(StorePageRequest $request)
    {
        $page = Page::create($request->validated());
        return $page;
    }

    /**
     * Display the specified resource.
     *
     * @param Page $page
     * @return Response
     */
    public function show(Page $page)
    {
        $page = $page->getOriginal();
        $page['content_ru'] = html_entity_decode($page['content_ru']);
        $page['content_ro'] = html_entity_decode($page['content_ro']);
        return $page;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePageRequest $request
     * @param Page $page
     * @return Response
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        $page->update($request->validated());
        $page = $page->getOriginal();
        $page['content_ru'] = html_entity_decode($page['content_ru']);
        $page['content_ro'] = html_entity_decode($page['content_ro']);
        return $page;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Page $page
     * @return Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return response()->json(['message' => 'Page deleted']);
    }

    /**
     * Display the specified resource.
     *
     * @param Page $page
     * @return JsonResponse
     */
    public function pageByLocaleAndSlug($locale, $slug)
    {

        $page = Page::where('slug_'.$locale, $slug)->exists();
        if (!$page) {
            return response()->json(['message' => 'Page not found'], 404);
        }
        $page = Page::where('slug_'.$locale, $slug)->first();

        return $this->getPageByLocaleAndId($locale, $page['id']);
    }

    /**
     * @param string $locale
     * @param int $id
     * @return JsonResponse
     */
    public function getPageByLocaleAndId(string $locale, int $id): JsonResponse
    {

        $page = Page::find($id)->getOriginal();
        $response = [
            'title' => $page['title_'.$locale],
            'content' => html_entity_decode($page['content_'.$locale]),
            'meta_title' => $page['meta_title_'.$locale],
            'meta_description' => $page['meta_description_'.$locale],
        ];

        return response()->json($response, 200);
    }
}
