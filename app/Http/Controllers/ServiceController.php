<?php

namespace App\Http\Controllers;

use App\Models\ServiceModel;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $model = new ServiceModel();
        $dbResults = $model->getAllServiceEntries();
        $data = [
            'serviceList' => $dbResults 
        ];
        return view('service/index', $data);
    }

    public function add()
    {
        return view('service/add');
    }

    public function create(Request $request)
    {
        $serviceName = $request->input('service_name');
        $description = $request->input('description');
        $duration = $request->input('duration');
        $price = $request->input('price');

        $model = new ServiceModel();
        $model->setNewServiceEntry($serviceName, $description, $duration, $price); 
        return redirect('/service');
    }

    public function edit($id)
    {
        $model = new ServiceModel();
        $dbResults = $model->getSpecificServiceEntry($id);
        $data = [
            'serviceEntry' => $dbResults
        ];
        return view('service/edit', $data); 
    }

    public function update($id, Request $request)
    {
        $serviceName = $request->input('service_name');
        $description = $request->input('description');
        $duration = $request->input('duration');
        $price = $request->input('price');

        $model = new ServiceModel();
        $model->setUpdateServiceEntry($id, $serviceName, $description, $duration, $price);
        return redirect('/service');
    }

    public function delete($id)
    {
        $model = new ServiceModel();
        $dbResults = $model->getSpecificServiceEntry($id);
        $data = [
            'serviceEntry' => $dbResults
        ];
        return view('service/delete', $data);
    }

    public function destroy($id)
    {
        $model = new ServiceModel();
        $model->setDestroyServiceEntry($id);
        return redirect('/service');
    }   
}
