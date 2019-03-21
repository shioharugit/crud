<?php

namespace App\Http\Controllers;

use App\Http\Requests\PreregisterRequest;
use App\Services\PreregisterService as PreregisterService;

class PreregisterController extends Controller
{
    private $preregister;

    public function __construct()
    {
        $this->preregister = new PreregisterService();
    }

    /**
     * 仮登録
     */
    public function preregister()
    {
        return view('preregister.index');
    }

    /**
     * 仮登録完了
     *
     * @param PreregisterRequest $request
     */
    public function preregisterComplete(PreregisterRequest $request)
    {
        $this->preregister->createPreregisterData($request);
        return view('preregister.complete');
    }
}
