<?php

namespace App\Http\Controllers;

use App\Author;
//use Laravel\Lumen\Http\Request;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

    /**
     * ShowAllAuthors - /GET
     *
     * @return array|mixed json collection
     */
    public function showAllAuthors()
    {
        return response()->json(Author::all());
    }

    /**
     * ShowOneAuthor - /GET
     *
     * @param [type] $id
     *
     * @return string|array|object
     */
    public function showOneAuthor($id)
    {
        return response()->json(Author::find($id));
    }

    /**
     * Create - /POST
     *
     * @param Request $request
     *
     * @return void
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:authors',
            //'location' => 'required|alpha'
        ]);

        $author = Author::create($request->all());

        return response()->json($author, 201);
    }


    /**
     * Update - /PUT
     *
     * @param [type] $id
     * @param Request $request
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        $author = Author::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    /**
     * Delete -/DELETE
     *
     * @param [type] $id
     *
     * @return void
     */
    public function delete($id)
    {
        Author::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
