<?php

namespace App\Http\Controllers\API\Backend\Academic;

use App\CrudMachanism\DataDeletion;
use App\CrudMachanism\DataInsertion;
use App\CrudMachanism\DataShowing;
use App\Http\Controllers\Controller;
use App\Http\Requests\Academic\SubjectRequest;
use App\Http\Resources\Academic\SubjectResource;
use App\Models\Academic\Subject;
use App\SearchEngine\DataMachine;
use App\Uploads\FileUpload;
use Illuminate\Http\Request;

class CourseUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchable = ['title'];
        $extraData = [];
        $result = new DataMachine($searchable, $request, Subject::class, SubjectResource::class, $extraData);
        return  $result->dataRendering();
    }

    public function getRawList()
    {
        try {
            return SubjectResource::collection(Subject::all());
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Something went wrong while fetching courses"
            ], 500);
        }
    }

    public function storeUpdate($request, $id, $method)
    {
        $options           = FileUpload::setOptions($id, Subject::class, $method, 'thumbnail', 'storage/course_units');
        $file              = new FileUpload($request, $options);
        $fileName          = $file->imgProcess();

        // $data              = $request->except(['thumbnail']);
        $data              = $request->all();
        $data['thumbnail'] = $fileName;

        $operation         = new DataInsertion(Subject::class, $method, 'Subject', $data, $id);
        $result            = $operation->crudItem();
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
        $result =  $this->storeUpdate($request, '', 'store');
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DataShowing::dataShow(Subject::class, $id, SubjectResource::class);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result =  $this->storeUpdate($request, $id, 'update');
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result =  DataDeletion::dataDelete(Subject::class, $id, 'Subject');
        return $result;
    }
}
