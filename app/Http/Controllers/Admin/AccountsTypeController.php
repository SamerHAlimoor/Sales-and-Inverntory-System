<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountType;
use Illuminate\Http\Request;

class AccountsTypeController extends Controller
{
    //
    public function index()
    {
        $data = get_cols(new AccountType(), array("*"), 'related_internal_accounts', 'ASC');
        return view('admin.account_types.index', ['data' => $data]);
    }
}