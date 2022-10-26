<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Repositories\IStreamInterface;

class StreamController extends Controller
{
    protected $stream;
    public function __construct(IStreamInterface $stream)
    {
        $this->stream=$stream;
    }

    public function index(){

        $Streams = $this->stream-> getAllData();
        $Types = Type::all();
   
      return view('index',compact('Streams'));
    }
    public function getAll(){

        $Streams = $this->stream-> getAllData();
        $res = ['data'=>$Streams ];

        echo json_encode( $res);
    }

    public function create(){

        $types = Type::all();

        return view('stream/create', [
            'Types' => $types,
        ]);

    }

    public function store(Request $request){

      $this->stream->store($request);

      return back()->with('success','Stream is created successfully.');
    }

    public function edit($id){

        $Stream = $this->stream->view($id);
        $types = Type::all();

          return view('stream/edit', [
             'stream' =>   $Stream,
             'types' => $types,
         ]);  
    }

    public function update($id,Request $request){

        $this->stream->update( $id,$request);
        
        return back()->with('success','Stream is updated successfully.');
       
    }

    public function destroy($id){

        $this->stream->delete($id);

        return response()->json(['success'=>'Stream Deleted successfully']);
    }
}
