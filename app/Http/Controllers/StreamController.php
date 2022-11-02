<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Repositories\IStreamInterface;
use App\Models\Stream;

class StreamController extends Controller
{
    protected $stream;
    public function __construct(IStreamInterface $stream)
    {
        $this->stream = $stream;
    }

    public function index()
    {

        $Streams = $this->stream->getAllData();
        $Types = Type::all();

        return view('index', compact('Streams'));
    }

    public function getAll(Request $request)
    {

        $columns = array(
            0 => 'id',
            1 => 'title',
            2 => 'description',
            3 => 'tokens_price',
            4 => 'type',
            5 => 'date_expiration'
        );

        $totalData = Stream::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');

        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $streams = Stream::with('type')
            ->offset($start)
               ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $streams =  Stream::with('type')
                ->whereHas('type', function($query) use ($search) {
                    $query->where('name', $search);
                 }) 
                ->orWhere('id', 'LIKE', "%{$search}%")
                ->orWhere('title', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%")
                ->orWhere('tokens_price', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
                $totalFiltered =  $streams->count();
               
        }
       

        $data = array();
        if (!empty($streams)) {
            foreach ($streams as $stream) {

                $nestedData['id'] = $stream->id;
                $nestedData['title'] = $stream->title;
                $nestedData['description'] = $stream->description;
                $nestedData['tokens_price'] = $stream->tokens_price;
                $nestedData['type'] = $stream->type->name;
                $nestedData['date_expiration'] = $stream->date_expiration;

                $nestedData['action'] =  '<a href="javascript:void(0)" class="edit_stream btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete_stream btn btn-danger btn-sm"  onclick="return confirm(`Are you sure you want to delete this stream`)">Delete</a>';

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    public function create()
    {

        $types = Type::all();

        return view('stream/create', [
            'Types' => $types,
        ]);
    }

    public function store(Request $request)
    {

        $this->stream->store($request);

        return back()->with('success', 'Stream is created successfully.');
    }

    public function edit($id)
    {

        $Stream = $this->stream->view($id);
        $types = Type::all();

        return view('stream/edit', [
            'stream' =>   $Stream,
            'types' => $types,
        ]);
    }

    public function update($id, Request $request)
    {

        $this->stream->update($id, $request);

        return back()->with('success', 'Stream is updated successfully.');
    }

    public function destroy($id)
    {

        $this->stream->delete($id);

        return response()->json(['success' => 'Stream Deleted successfully']);
    }
}
