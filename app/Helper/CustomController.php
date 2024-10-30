<?php

namespace App\Helper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class CustomController extends Controller
{

    protected $validationRules = [];

    protected $validationMessage = [];

    /** @var Request $request */
    protected $request;

    /**
     * CustomController constructor.
     */
    public function __construct()
    {
        $this->request = Request::createFromGlobals();
    }

    public function checkValidation(Request $request)
    {
        $data = $request->all();

        return Validator::make($data, $this->getValidationRules(), $this->getValidationMessage());
    }

    public function isAuth($credentials = [])
    {
        if (count($credentials) > 0 && Auth::attempt($credentials)) {
            return true;
        }

        return false;
    }

    /**
     * @param $field
     *
     * @return string
     */
    public function generateImageName($field = '')
    {
        $value = '';
        if (request()->hasFile($field)) {
            $files     = request()->file($field);
            $extension = $files->getClientOriginalExtension();
            $name      = $this->uuidGenerator();
            $value     = $name . '.' . $extension;
        }

        return $value;
    }

    /**
     * @return string
     */
    public function uuidGenerator()
    {
        return Uuid::uuid1()->toString();
    }

    public function uploadImage($field, $targetName = '', $disk = 'upload')
    {
        $file = request()->file($field);
        return Storage::disk($disk)->put($targetName, File::get($file));
    }


    public function postJsonField()
    {
        return json_decode($this->request->getContent());
    }

    public function jsonResponse($msg = '', $status = 200, $data = null)
    {
        return response()->json([
            'status' => $status,
            'message' => $msg,
            'payload' => $data
        ], $status);
    }
}
