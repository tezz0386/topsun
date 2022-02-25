<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Http\Requests\SettingUpdateRequest;
use App\Models\Admin\Setting\Setting;
use App\Support\ImageSupport;
use Illuminate\Http\Request;
use Kamaln7\Toastr\Facades\Toastr;

class SettingController extends Controller
{
    protected $folderName='admin.setting.';
    protected $iconWidth=80;
    protected $iconHeight=80;
    protected $logoWidth=500;
    protected $logoHeight=500;
    function __construct(ImageSupport $imageSupport, Setting $setting)
    {
        $this->middleware('auth');
        $this->imageSupport = $imageSupport;
        $this->setting=$setting;
        $this->data['page']='setting_list';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->setting = Setting::find(1);
        if(!$this->setting){
            return view($this->folderName.'form', [
                'activePage'=>'setting_list',
            ]);
        }else{
            return view($this->folderName.'index', [
                'activePage'=>'setting_list',
                'setting'=>$this->setting,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->setting = Setting::find(1);
        if(!$this->setting){
            return view($this->folderName.'form', [
                'activePage'=>'setting',
            ]);
        }else{
            return view($this->folderName.'index', [
                'activePage'=>'setting',
                'setting'=>$this->setting,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        
        //
        $this->setting->fill($request->all());
        $icon = $this->imageSupport->saveAnyImg($request, 'setting', 'icon', $this->iconWidth, $this->iconHeight);
        $logo = $this->imageSupport->saveAnyImg($request, 'setting', 'logo', $this->logoWidth, $this->logoHeight);
        $this->setting->icon = $icon;
        $this->setting->logo = $logo;
        if($this->setting->save()){
            Toastr::success('Successfully Setting has saved', 'Success !!!', ['positionClass'=>'toast-buttom-right']);
            return redirect()->route('setting.index')->with('success', 'Successfully Setting has saved');
        }else{
            return back()->withInput()->with('error', 'Could not be saved your site setting please try again later');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Setting\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(SettingUpdateRequest $request, Setting $setting)
    {

       
        $rules=$setting->getRules();
        $request->validate($rules);
        $data=$request->except(['logo','icon']);

        if($request->icon)
        {
            $icon=$this->imageSupport->saveAnyImg($request, 'setting', 'icon', $this->iconWidth, $this->iconHeight);
            if($icon)
            {
                if($setting->icon && $setting->icon !=null)
                {
                    $this->imageSupport->deleteImg('setting',$setting->icon);
                }
                $data['icon']=$icon;
            }
        }

        if($request->logo)
        {
            $logo=$this->imageSupport->saveAnyImg($request, 'setting', 'logo', $this->logoWidth, $this->logoHeight);
            if($logo)
            {
                
                if($setting->logo && $setting->logo !=null)
                {
                    $this->imageSupport->deleteImg('setting',$setting->logo);
                }
                $data['logo']=$logo;
            }
        }

        $setting->fill($data);
        $status=$setting->save();
        if($status)
        {
            Toastr::success('Successfully Setting Section has Updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Updating  Setting Section', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('setting.index')->with('success', 'Successfully Setting Section has Updated');

       
    }
}
