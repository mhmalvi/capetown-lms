<?php

namespace App\Http\Controllers\API\Backend\Academic;

use App\Uploads\FileUpload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Academic\Course;
use App\SearchEngine\DataMachine;
use App\CrudMachanism\DataShowing;
use App\CrudMachanism\DataDeletion;
use App\CrudMachanism\DataInsertion;
use App\Http\Controllers\Controller;
use App\Http\Requests\Academic\CourseRequest;
use App\Http\Resources\Academic\CourseResource;

class CourseController extends Controller
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
        $result = new DataMachine($searchable, $request, Course::class, CourseResource::class, $extraData);
        return  $result->dataRendering();
    }

    public function storeUpdate($request, $id, $method)
    {         
        
        $options           = FileUpload::setOptions($id, Course::class, $method, 'thumbnail', 'storage/course');
        $file              = new FileUpload($request, $options);
        $fileName          = $file->imgProcess();     
          
        $data              = $request->except(['thumbnail']);
        $data['slug']      = strtolower(str_replace(' ', '_',$request->title));
        $data['thumbnail'] = $fileName;
        $data['code'] = uniqid(rand(1,9999));
        $data['uuid'] = Str::uuid();
        $operation         = new DataInsertion(Course::class, $method, 'Course', $data, $id);
        $result            = $operation->crudItem();   
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
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
        return DataShowing::dataShow(Course::class, $id, CourseResource::class);
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
        $result =  DataDeletion::dataDelete(Course::class, $id, 'Course');
        return $result;
    }
}
