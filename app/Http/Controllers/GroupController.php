<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Group::paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGroupRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreGroupRequest $request)
    {
        $group = new Group();
        $group->fill($request->validated());
        $group->save();

        return response()->json($group, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return Group
     */
    public function show(Group $group)
    {
        return $group;
    }

    /**
     * @param UpdateGroupRequest $request
     * @param Group $group
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateGroupRequest $request, Group $group)
    {
        $group->fill($request->validated());
        $group->save();

        return response()->json($group, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return response()->json(null, 204);
    }
}
