<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use RealRashid\SweetAlert\Facades\Alert;

class CompanyController extends Controller
{
    function index()
    {
        $company = Company::get();
        return view('company.index', compact('company'));
    }

    function submit(Request $request)
    {
        $company = new Company();
        $company->company_name = $request->company_name;
        $company->code_name = $request->code_name;
        $company->contact = $request->contact;
        $company->save();

        alert()->success('Success', 'Company submitted successfully!');
        return redirect()->route('company.index');
    }

    function update(Request $request, $company_id)
    {
        $company = Company::find($company_id);
        if (!$company) {
            return redirect()->route('company.index')->with('error', 'Company not found');
        }
        $company->company_name = $request->company_name;
        $company->code_name = $request->code_name;
        $company->contact = $request->contact;
        $company->update();

        alert()->success('Success', 'Company update successfully!');
        return redirect()->route('company.index');
    }

    function destroy($company_id)
    {
        $company = Company::find($company_id);
        $company->delete();

        alert()->success('Success', 'Company deleted successfully!');
        return redirect()->route('company.index');
    }
}
