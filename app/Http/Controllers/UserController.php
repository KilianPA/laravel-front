<?php

namespace App\Http\Controllers;

use App\Http\Resources\User;
use App\Http\Resources\UserCollection;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getAllUsers()
    {
        $response = $this->clientApi->request('GET', 'users');
        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            return view('user.user-list', ['data' => UserCollection::make($data)->resolve()]);
        } elseif ($response->getStatusCode() == 401) {
            $this->authorized();
        }
    }

    public function getUserById ($id) {
        try {
            $response = $this->clientApi->request('GET', 'users/' . $id);
            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody(), true);
                return UserCollection::make($data)->resolve()['data'];
            } elseif ($response->getStatusCode() == 401) {
                $this->authorized();
            }
        } catch (\Exception $exception) {
            if ($exception->getCode() == 401) {
                return $this->authorized();
            }
        }
    }

    public function create()
    {
        return view('user.user-create');
    }

    public function edit($id)
    {
        $user = ($this->getUserById($id));
        return view('user.user-edit', ['user' => $user['data']]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'surname' => 'required',
            'password' => 'required',
            'email' => 'required|email',
            'birthday' => 'required|date'
        ];
        $rulesMessage = [
            'name.required' => 'Le champ nom est requis',
            'surname.required' => 'Le champ prénom est requis',
            'password.required' => 'Le champ mot de passe est requis',
            'email.required' => 'Le champ e-mail est requis',
            'birthday.required' => 'Le champ date de naissance est requis'
        ];
        $validator = Validator::make($request->all(), $rules, $rulesMessage);
        if ($validator->fails()) {
            return redirect()
                ->back()->withErrors($validator)->withInput();
        } else {
            $data = $request->all();
            try {
                $response = $this->clientApi->request('post', 'users', ['form_params' =>
                    [
                        'name' => $data['name'],
                        'surname' => $data['surname'],
                        'email' => $data['email'],
                        'password' => $data['password'],
                        'birthday' => $data['birthday']
                    ]
                ]);
                if ($response->getStatusCode() == 200) {
                    return back()->with('success', 'Utilisateur bien créé.');
                } else {
                    return back()->with('errors', $response);
                }
            } catch (ServerException $exception) {
                $errors = (json_decode($exception->getResponse()->getBody(), true)['error']['errors']);
                foreach ($errors as $error) {
                    $validator->getMessageBag()->add($error['path'], $error['message']);
                }
                return redirect()
                    ->back()->withErrors($validator)->withInput();
            }
        }
    }

    public function update(Request $request, $id) {
        $rules = [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'birthday' => 'required|date'
        ];
        $rulesMessage = [
            'name.required' => 'Le champ nom est requis',
            'surname.required' => 'Le champ prénom est requis',
            'email.required' => 'Le champ e-mail est requis',
            'birthday.required' => 'Le champ date de naissance est requis'
        ];
        $validator = Validator::make($request->all(), $rules, $rulesMessage);
        if ($validator->fails()) {
            return redirect()
                ->back()->withErrors($validator)->withInput();
        } else {
            $data = $request->all();
            try {
                $response = $this->clientApi->request('put', 'users/' . $id, ['form_params' =>
                    [
                        'name' => $data['name'],
                        'surname' => $data['surname'],
                        'email' => $data['email'],
                        'birthday' => $data['birthday']
                    ]
                ]);
                if ($response->getStatusCode() == 200) {
                    return back()->with('success', 'Utilisateur mis à jour.');
                } elseif ($response->getStatusCode() == 401) {
                    $this->authorized();
                }
            } catch (ServerException $exception) {
                $errors = (json_decode($exception->getResponse()->getBody(), true)['error']['errors']);
                foreach ($errors as $error) {
                    $validator->getMessageBag()->add($error['path'], $error['message']);
                }
                return redirect()
                    ->back()->withErrors($validator)->withInput();
            }
        }
    }
    public function remove ($id) {
        $user = ($this->getUserById($id));
        if ($user) {
            return view('user.user-delete', ['user' => $user['data']]);
        } else {
            return redirect()->to('users');
        }
    }
    public function delete ($id) {
        $response = $this->clientApi->request('delete', 'users/' . $id);
        if ($response->getStatusCode() == 204) {
            return redirect()->to('users');
        }
    }
}
