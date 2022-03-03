<?php

namespace App\Http\Controllers\API\Backend\Academic;

use App\Uploads\FileUpload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Academic\Course;
use App\SearchEngine\DataMachine;
use App\CrudMachanism\DataShowing;
use App\Models\Academic\Classroom;
use App\CrudMachanism\DataDeletion;
use App\CrudMachanism\DataInsertion;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClassroomResource;
use App\Http\Resources\Academic\CourseResource;
use App\Http\Requests\Academic\ClassroomRequest;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchable = ['title'];
        $extraData = [
            'courses' => CourseResource::collection(Course::all()),
        ];
        $result = new DataMachine($searchable, $request, Classroom::class, ClassroomResource::class, $extraData);
        return  $result->dataRendering();
    }

    public function storeUpdate($request, $id, $method)
    {         
        
        $options           = FileUpload::setOptions($id, Classroom::class, $method, 'cover_photo', 'storage/classroom');
        $file              = new FileUpload($request, $options);
        $fileName          = $file->imgProcess();     
          
        $data              = $request->except(['cover_photo']);
        $data['slug']      = strtolower(str_replace(' ', '_',$request->title));
        $data['cover_photo'] = $fileName;
        $data['code'] = uniqid(rand(1,9999));
        $data['uuid'] = Str::uuid();
        $operation         = new DataInsertion(Classroom::class, $method, 'Classroom', $data, $id);
        $result            = $operation->crudItem();   
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassroomRequest $request)
    {
        $result =  $this->storeUpdate($request,'', 'store');
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
        return DataShowing::dataShow(Classroom::class, $id, ClassroomResource::class);
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
        $result =  DataDeletion::dataDelete(Classroom::class, $id, 'Classroom');
        return $result;
    }
}
