<?php

namespace App\Http\Livewire;

use App\Models\Study;
use Livewire\Component;
use Livewire\WithPagination;

class ShowStudies extends Component
{
    use WithPagination;

    public $searchData = '';
    public $studyName;
    public $studyId;
    public $studyPhase;
    public $studyIndication;



    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'searchData'=>'required'
    ];


    public function render()
    {
        return view('livewire.show-studies', ['studies'=>Study::where('study_name','LIKE','%'.$this->searchData.'%')->paginate(9),]);
    }
    public function updatingSearchData()

    {

        $this->resetPage();

    }
    public function setStudyName($id, $name, $phase, $indication){
        $this->studyId = $id;
        $this->studyName = $name;
        $this->studyPhase = $phase;
        $this->studyIndication = $indication;
    }

    public function editStudyName()
    {
        $this->validate([
            'studyName'=>'required',
            'studyPhase'=>'required'
        ]);
      $study =  Study::find($this->studyId);
      $study->study_name = $this->studyName;
      $study->protocol_id = $this->studyName;
      $study->phase = $this->studyPhase;
      $study->indication = $this->studyIndication;
      $study->save();

      $this->emit('$refresh');
    }

    public function deleteStudy(){
        Study::find($this->studyId)->delete();

        $this->emit('$refresh');

    }


}
