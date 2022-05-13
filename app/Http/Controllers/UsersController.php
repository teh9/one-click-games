<?php

namespace App\Http\Controllers;

use App\Lib\Responser;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    private $user;

    public function __construct (
        Users $user,
        Request $request,
        Responser $response
    ) {
        $this->user = $user;
        $this->request = $request;
        $this->json = $response;
    }

    public function indexAction () {
        $users = $this->user->select('*')->get();

        return view('pages.users', compact('users'));
    }

    public function ajaxRetrieverAction () {
        $method = $this->request->action;
        return $this->$method();
    }

    public function userCreate () {

        $validator = Validator::make($this->request->all(), [
            'name'     => 'required|string',
            'password' => 'required|between:8,100',
            'email'    => 'required|unique:users|email',
            'age'      => 'required|integer|min:18|max:100'
        ]);

        //I don’t know why, the field name was not checked as a string (done according to the documentation),
        // so I made such a stub.
        if(is_numeric($this->request->name)){
            return $this->json->response('error', 'Name must be string');
        }

        if($validator->fails()){
            return $this->json->response('error', $validator->getMessageBag());
        }

        try {
            $this->user->insert([
                'name'     => $this->request->name,
                'email'    => $this->request->email,
                'password' => Hash::make($this->request->password),
                'age'      => $this->request->age
            ]);
        }catch (\Throwable $e) {
            return $this->json->response('error', $e->getMessage());
        }

        return $this->json->response('success','User was successfully added');
    }

    public function updateUser () {
        $validator = Validator::make($this->request->all(), [
            'name'     => 'nullable|string',
            'password' => 'nullable|between:8,100',
            'email'    => 'nullable|unique:users|email',
            'age'      => 'nullable|integer|min:18|max:100'
        ]);

        if($validator->fails()){
            return $this->json->response('error', $validator->getMessageBag());
        }

        foreach ($this->request->all() as $key => $value) {
            if(in_array($key, $this->user->data, true) && !empty($value)) {
                $updateData[$key] = $value;
            }
        }

        if(!empty($updateData)){
            try {
                $this->user->where('id', $this->request->user_id)
                            ->update($updateData);
            }catch (\Throwable $e) {
                return $this->json->response('error', $e->getMessage());
            }

            return $this->json->response('success','User was successfully updated');
        }

        return $this->json->response('error', 'Nothing to update');
    }

    public function deleteUser () {
        if(!empty($this->request->user_id)){
            try {
                $this->user->where('id', $this->request->user_id)->delete();
            }catch (\Throwable $e){
                return $this->json
                        ->response('error', 'There is error, while user delete - '.$e->getMessage());
            }

            return $this->json->response('success', 'User was successfully deleted');
        }

        return $this->json->response('error', 'User id was missing or not provided');
    }
}
