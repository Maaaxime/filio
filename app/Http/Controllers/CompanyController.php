<?php

namespace App\Http\Controllers;

use App\Models\Company;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CompanyController extends Controller
{
    //region Types
    public const TYPES = [
        0 => 'PARENTAL',
        1 => 'ASSOCIATIF',
        2 => 'MUNICIPAL',
        3 => 'GARDERIE_PERISCOLAIRE',
        4 => 'MICRO_CRECHE',
        5 => 'ASSISTANTE_MATERNELLE',
        6 => 'FAMILIAL',
        7 => 'MULTI_ACCUEIL'
    ];

    /**
     * Returns the id of a given type
     *
     * @param string $type  Company's type
     * @return int typeId
     */
    public static function getTypeID($type)
    {
        return array_search($type, self::TYPES);
    }

    /**
     * Get Company Type
     */
    public function getTypeAttribute()
    {
        return self::TYPES[$this->attributes['typeId']];
    }

    /**
     * Set Company Type
     */
    public function setTypeAttribute($value)
    {
        $typeId = self::getTypeID($value);
        if ($typeId) {
            $this->attributes['typeId'] = $typeId;
        }
    }

    //endregion

    function __construct()
    {
        $this->middleware('permission:company-list|company-mngt', ['only' => ['index', 'store']]);
        $this->middleware('permission:company-mngt', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companies = Company::orderBy('id', 'DESC')->paginate(5);
        return view('companies.index', compact('companies'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('companies.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:companies,name',
            'permission' => 'required',
        ]);

        $company = Company::create(['name' => $request->input('name')]);
        $company->syncPermissions($request->input('permission'));

        return redirect($request->url)
            ->with('success', 'company created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        $companyPermissions = Permission::join("company_has_permissions", "company_has_permissions.permission_id", "=", "permissions.id")
            ->where("company_has_permissions.company_id", $id)
            ->get();

        return view('companies.show', compact('company', 'companyPermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        $permission = Permission::get();
        $companyPermissions = DB::table("company_has_permissions")->where("company_has_permissions.company_id", $id)
            ->pluck('company_has_permissions.permission_id', 'company_has_permissions.permission_id')
            ->all();

        return view('companies.edit', compact('company', 'permission', 'companyPermissions'));
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
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $company = Company::find($id);
        $company->name = $request->input('name');
        $company->save();

        $company->syncPermissions($request->input('permission'));

        return redirect($request->url)
            ->with('success', 'company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        DB::table("companies")->where('id', $id)->delete();
        return redirect($request->url)
            ->with('success', 'company deleted successfully');
    }
}
