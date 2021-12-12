<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateSystemSettingRequest;
use App\Http\Requests\UpdateSystemSettingRequest;
use App\Repositories\SystemSettingRepository;
use Flash;

class SystemSettingController extends Controller
{
    private $systemSettingRepository;

    public function __construct(SystemSettingRepository $systemSettingRepository)
    {
        $this->systemSettingRepository = $systemSettingRepository;
    }

    public function index(Request $request)
    {
        $systemSettings = $this->systemSettingRepository->all();

        return view('system_settings.index')
            ->with('systemSettings', $systemSettings);
    }

    public function create()
    {
        return view('system_settings.create');
    }

    public function store(CreateSystemSettingRequest $request)
    {
        $input = $request->all();

        $setting = $this->systemSettingRepository->create($input);

        Flash::success('Setting saved successfully.');

        return redirect(route('system_settings.index'));
    }

    public function edit($id)
    {
        $setting = $this->systemSettingRepository->find($id);

        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(route('system_settings.index'));
        }

        return view('system_settings.edit')->with('setting', $setting);
    }

    public function update($id, UpdateSystemSettingRequest $request)
    {
        $data = $request->all();
        $setting = $this->systemSettingRepository->find($id);

        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(route('system_settings.index'));
        }

        $setting = $this->systemSettingRepository->update($data, $id);

        Flash::success('User updated successfully.');

        return redirect(route('system_settings.index'));
    }
}
