<?php
namespace App\Repositories;

use App\Models\Stream;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Repositories\IStreamInterface;

class StreamRepository implements IStreamInterface{

    public function getAllData(){

        return Stream::with('type')->get();
    }

    public function view($id){

        return Stream::find($id);
    }

    public function store($data){

         $validateData =  $data->validate([
            'title'=>'required|string|max:255',
            'description' =>'string|max:255',
            'tokens_price' => 'integer|required|gt:0',
            'type_id' => 'required|in:1,2,3,4,5,6',
            'date_expiration' => 'required'
        ]);

        if ( $validateData  ) {

            return Stream::create([
                'title' => $validateData['title'],
                'description' => $validateData['description'],
                'tokens_price' => $validateData['tokens_price'],
                'type_id' => $validateData['type_id'],
                'date_expiration' => $validateData['date_expiration'],
                'date_creation' =>  Carbon::now()->toDateTimeString(),
                'date_update' => null
            ]);
        } else {
            return back()->withErrors($validateData)->withInput();
        }
    }

    public function update($id,$data){

        $validateData =  $data->validate([
            'title'=>'required|string|max:255',
            'description' =>'string|max:255',
            'tokens_price' => 'integer|required|gt:0',
            'type_id' => 'required|in:1,2,3,4,5,6',
            'date_expiration' => 'required'
        ]);
 
        if ( $validateData ) {

            $update = Stream::find($id);
            $update->update($validateData);
 
            return $update;
        } else {
            
            return back()->withErrors($validateData)->withInput();
        }
    }

    public function delete($id){

        return Stream::destroy($id);

    }

    protected function validator(array $data){

        return Validator::make($data, [
                'title'=>['required','string','max:255'],
                'description' =>['string','max:255'],
                'tokens_price' => ['required','integer'],
                'type_id' =>[ 'required'],
                'date_expiration' =>['']
        ]);
    }

}