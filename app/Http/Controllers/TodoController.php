<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

use App\TodoModel as TodoModel;

class TodoController extends Controller
{
    public function __construct()
    {
        ini_set('max_execution_time', 2000);
        $this->middleware('auth'); //admin
        // $this->middleware('guest');

        ini_set('post_max_size', '64M');
        ini_set('upload_max_filesize', '64M');

        date_default_timezone_set('Asia/Manila');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $menu = view('partial.menu');

        return view('pages.todo', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $menu = view('partial.menu');
        $label = "Add";
        $todo_id = "";
        $task = "";
        $remarks = "";
        $sDate = "";
        $eDate = "";

        return view('pages.create', compact('menu','label','todo_id','remarks','task','sDate','eDate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        TodoModel::create([
            'todo' => $request->task,
            'remarks' => $request->remarks == NULL ? "" : $request->remarks,
            'sDate' => $request->sDate == "" ? NULL : $request->sDate,
            'eDate' => $request->eDate == "" ? NULL : $request->eDate,
            'created_by' => Auth::user()->id
            ]);

        return redirect('/todo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $menu = view('partial.menu');
        $query = $this->fetchTodoViaId($id);
        $label = "Update";
        $todo_id = $id;
        $task = $query->todo;
        $remarks = $query->remarks;
        $sDate = $query->sDate;
        $eDate = $query->eDate;

        return view('pages.create', compact('menu','label','todo_id','task','remarks','sDate','eDate'));
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
        //
        $query = $this->fetchTodoViaId($id);
        $query->todo = $request->task;
        $query->remarks = $request->remarks == NULL ? ""  : $request->remarks;
        $query->sDate = $request->sDate;
        $query->eDate = $request->eDate;
        $query->save();

        return redirect('/todo/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $todo = $this->fetchTodoViaId($id);
        $todo->delete();
    }

    public function fetchTodoViaId($id){
        return TodoModel::where('id', $id)->first();
    }

    public function fetchTodo(){
       $task_id = Input::get('task_id');

       if($task_id == 0):
            $query = $this->fetchPending();
       elseif($task_id == 1):
            $query = $this->fetchCompleted();
        elseif($task_id == 2):
            $query = $this->fetchDeleted();
        endif;

        $data = [];

        foreach($query as $result):
            $url = URL('/');
            $action = "";
            if($result->deleted_at == NULL && $result->completed_at == NULL):

            $action ="<button data-id='$result->id' style='border: 1px solid #b8c7ce; margin-left: .5em;' style='float: right;' class='button small icon-completed'>
                                <i class='fa fa-check'></i> Completed
                            </button>";

            $action .="<a style='border: 1px solid #b8c7ce; margin-left: .5em;' href='$url/todo/$result->id/edit' style='float: right;' class='button primary small'>
                                <i class='fa fa-pencil-square-o'></i> Edit
                            </a>";
            $action .="<button data-id='$result->id' style='border: 1px solid #b8c7ce; margin-left: .5em;' style='float: right;' class='button small icon-delete'>
                                <i class='fa fa-trash'></i> Delete
                            </button>";

            endif;

            $data[] = array(
                $result->todo,
                $result->remarks,
                $result->sDate == NULL ? '' : $result->sDate,
                $result->eDate == NULL ? '' : $result->eDate,
                $result->completed_at == NULL ? '' : $result->completed_at,
                $result->deleted_at == NULL ? '' : $result->deleted_at,
                $action
            );

        endforeach;

        $res = array('data'=>$data);
        return json_encode($res);
    }

    public function fetchPending(){
        return TodoModel::withTrashed()->where('created_by', Auth::user()->id)
            ->get();
    }

    public function taskComplted($id){
        $todo = $this->fetchTodoViaId($id);
        $todo->completed_at = date("Y-m-d h:i:s");
        $todo->save();
        return $todo;
    }
}
