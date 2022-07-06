<?php

namespace App\Http\Livewire;

use App\Models\Sites;
use App\Models\Study;
use Livewire\Component;
use Livewire\WithPagination;

class SitesTable extends Component
{

    use WithPagination;

    public $searchData = '';
    public $study;
    public $siteName;
    public $siteCountry;
    public $investigatorName;
    public $investigatorEmail;
    public $siteId;

    protected $paginationTheme = 'bootstrap';
    protected $rules = [
        'searchData'=>'required'
    ];

    public function updatingSearchData()
    {
        $this->resetPage();

    }
    public function render()
    {
            return view('livewire.sites-table',['sites'=>Sites::where('study_id',$this->study->id)->where(function ($query){
                $query->where('site_number','LIKE','%'.$this->searchData.'%')->orWhere('site_name','LIKE','%'.$this->searchData.'%');
            })->paginate(10),]);

    }


    public function setSiteDetails($id,$siteName, $country, $investigatorName, $investigatorEmail){
        $this->siteId = $id;
        $this->siteName = $siteName;
        $this->siteCountry = $country;
        $this->investigatorName = $investigatorName;
        $this->investigatorEmail = $investigatorEmail;
    }

    public function editSite()
    {
        $this->validate([
            'siteName'=>'required',
            'siteCountry'=>'required'
        ]);

       $site = Sites::find($this->siteId);

       $site->site_name =$this->siteName;
       $site->country = $this->siteCountry;
       $site->investigator_name = $this->investigatorName;
       $site->investigator_email = $this->investigatorEmail;
       $site->save();

       $this->emit('$refresh');
    }

    public function deleteSite()
    {
        Sites::find($this->siteId)->delete();

        $this->emit('$refresh');
    }
}
