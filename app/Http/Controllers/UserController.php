<?php

namespace App\Http\Controllers;

use App\Models\ForwarderUser;
use App\Models\User;
use App\Notifications\ShipperConfirmationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;

class UserController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = User::class;
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'company_email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'is_terms_and_conditions' => 'required'
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], Response::HTTP_BAD_REQUEST);
        }
        $request['is_terms_and_conditions'] = $request->has('is_terms_and_conditions');
        $user = $this->model::create($request->toArray());
        $address = $request->get('address');
        $user->address()->create($address);

        $service_ids = $request->get('service_ids');
        if (count($service_ids) > 0) {
            $user->services()->attach($service_ids);
        }
        $response['user'] = $user;
        $response['token'] = $user->createToken('Naov')->accessToken;
        $response['message'] = "successfully user added";
        return response()->json($response, Response::HTTP_OK);
    }

    //    user Login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], Response::HTTP_BAD_REQUEST);
        }

        $user = $this->model::where('company_email', $request->company_email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Naov')->accessToken;
                $response['user'] = $user;
                $response['token'] = $token;
                $response['message'] = "Successfully logged In";
                return response()->json($response, Response::HTTP_OK);
            } else {
                $response = ["message" => "Password mismatch"];
                return response()->json($response, Response::HTTP_UNAUTHORIZED);
            }
        } else {
            $response = ["message" => 'User does not exist'];
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }
    }


    //    Reset Password
    public function resetPassword(Request $request)
    {
    }

    //    Forgot Password
    public function forgotPassword(Request $request)
    {
    }


    //    Update Vendor Profile
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'sometimes|required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        try {
            $user = request()->user();
            $user->update($request->all());

            if (request('image'))
                $user->image = $this->uploadbase64Image(request('image'));

            $user->save();
            $response['user'] = $user;
            $response['message'] = 'Profile Updated Successfully.';
            return response()->json($response, Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json(['errors' => 'Server Internal Error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    // LOGOUT OR REVOKE THE ACCESS TOKEN
    public function logout()
    {
        Auth::user()->token()->revoke();
        return response()->json('User Logged Out', 200);
    }


    //    To get the logged in user
    public function getLoggedInUser()
    {
        return response()->json(['user' => request()->user()], Response::HTTP_OK);
    }


    public function addUserServices(Request $request)
    {
        $user = request()->user();
        $user->services()->detach($request->get('service_ids'));
        $user->services()->attach($request->get('service_ids'));
        return response()->json(
            ['message' => 'succesfully added the user services'],
            Response::HTTP_OK
        );
    }


    public function addGetServices()
    {
        $user = request()->user();
        return response()->json(
            ['services' => $user->services],
            Response::HTTP_OK
        );
    }

    public function addForwarders(Request $request)
    {
        $user = request()->user();
        $forwarder = $this->model::where('company_email', $request->company_email)->first();
        if (!$forwarder) {
            $forwarder = $this->model::create($request->all());
            $forwarder['url'] = 'naovinc.com/signup/service-provider/' . $forwarder->id;
            Notification::route('mail', $forwarder->company_email)
                ->notify(new ShipperConfirmationNotification($forwarder));
        }
        $user->forwarders()->attach($forwarder->id);
        return response()->json(
            ['message' => 'succesfully added the user forwarders'],
            Response::HTTP_OK
        );
    }

    public function getForwarders()
    {
        $user = request()->user();
        return response()->json(
            ['forwarders' => $user->forwarders],
            Response::HTTP_OK
        );
    }

    public function removeForwarder($forwarder_id)
    {
        $user = request()->user();
        ForwarderUser::where('user_id',$user->id)->where('forwarder_id')->delete();
        return response()->json(
            ['message' => 'successfully removed the forwarder' ],
            Response::HTTP_OK
        );
    }

    public function addShipper(Request $request)
    {
        $user = request()->user();
        $shipper = $this->model::where('company_email', $request->company_email)->first();
        if (!$shipper) {
            $shipper = $this->model::create($request->all());
            $shipper['url'] = 'naovinc.com/signup/importer-exporter/' . $shipper->id;
            Notification::route('mail', $shipper->company_email)
                ->notify(new ShipperConfirmationNotification($shipper));
            $address = $request->get('address');
            $shipper->address()->create($address);
        }

        $user->shippers()->attach($shipper->id);
        return response()->json(
            ['message' => 'Succesfully added the user shipper'],
            Response::HTTP_OK
        );
    }

    public function getShippers()
    {
        $user = request()->user();
        return response()->json(
            ['shippers' => $user->shippers],
            Response::HTTP_OK
        );
    }

    public function shipperValidation(Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(401, 'This link is not valid.');
        }
    }

    public function getUser($id, $role_id)
    {
        $user = User::where('id', $id)
            ->where('role_id', $role_id)->first();
        return response()->json(
            ['user' => $user],
            Response::HTTP_OK
        );
    }

    public function preSignup($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'company_email' => 'required|string|email|max:255',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], Response::HTTP_BAD_REQUEST);
        }
        $user = $this->model::find($id);
        $user->update($request->all());
        $userAddress = $user->address()->first();
        if ($request->has('address')) {
            $address = $request->get('address');
            if ($userAddress) {
                $userAddress->update($address);
            } else {
                $user->address()->create($address);
            }
        }
        if ($request->has('service_ids')) {
            $service_ids = $request->get('service_ids');
            if (count($service_ids) > 0) {
                $user->services()->attach($service_ids);
            }
        }

        $respone['user'] = $user;
        $respone['token'] = $user->createToken('Naov')->accessToken;
        $respone['message'] = "successfully user added";
        return response()->json($respone, Response::HTTP_OK);
    }

    //    public function getForwarder($id)
    //    {
    //        $forwarder = User::find($id);
    //        return response()->json(
    //            ['forwarder' => $forwarder],
    //            Response::HTTP_OK
    //        );
    //    }
}
