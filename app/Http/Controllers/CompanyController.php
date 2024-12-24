<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company; 

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
        $company->name = $request->name;
        $company->code_name = $request->code_name;
        $company->contact = $request->contact;
        $company->save();

        return redirect()->route('company.index')->with('success', 'Company created successfully.');
    }

    function update(Request $request, $company_id)
    {
        $company = Company::find($company_id);
        if (!$company) {
            return redirect()->route('company.index')->with('error', 'Company not found');
        }
        $company->name = $request->name;
        $company->code_name = $request->code_name;
        $company->contact = $request->contact;
        $company->update();

        return redirect()->route('company.index')->with('success', 'Company update successfully.');
    }

    function destroy($company_id)
    {
        $company = Company::find($company_id);
        $company->delete();

        return redirect()->route('company.index')->with('success', 'Company deleted successfully.');
    }
}
