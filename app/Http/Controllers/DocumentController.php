<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Document;
class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {
            return response()->json([
                'message'=>'Document Fetched',
                'status'=>'Success',
                'data' => Document::select('doc_id', 'document_no', 'document_date', 'irn')->get()

            ]);
        }catch(Exception $e)
        {
            return response()->json([
                'message'=>$e->getMessage(),
                'status'=>'Exception'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $doc = Document::create($request->all());
            return response()->json([
                'message' => 'Document Details Fetched',
                'status' => 'Success',
                'Data' => $doc
            ], 201); // 201 Created
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'Exception'
            ], 500); // 500 Internal Server Error
        }
       
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try
        {
            $document = Document::findOrFail($id);

           
            $document->delete();
    

            return response()->json([
                'message' => 'Document deleted successfully',
                'status' => 'Success',
                'data' => Document::select('doc_id', 'document_no', 'document_date', 'irn')->get()
            ], 200);
        }catch(Exception $e)
        {
            return response()->json([
                'message' => 'An error occurred: ' . $e->getMessage(),
                'status' => 'Error',
            ], 500);
        }
    }
}
