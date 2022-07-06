<?php

namespace App\Http\Livewire;

use App\Models\Sites;
use App\Models\Study;
use App\Models\Subject;
use Hamcrest\Thingy;
use Livewire\Component;
use Livewire\WithPagination;

class SubjectsTable extends Component
{
    use WithPagination;

    public $study;
    public $site;
    public $subject;
    public $searchData;
    public $subjectId;
    public $subjectStatus;
    public $completed;
    public $enrolled;

    protected $paginationTheme = 'bootstrap';
    protected $rules = [
        'searchData'=>'required'
    ];

    public function updatingSearchData()
    {
        $this->resetPage();

    }
    public function mount(Study $study, Sites $sites){
       $this->completed = Subject::where('sites_id', $this->site->id)->where('subject_status','Completed')->get();
        $this->enrolled = Subject::where('sites_id', $this->site->id)->where('subject_status','Enrolled')->get();


    }
    public function render()
    {
        return view('livewire.subjects-table',['subjects'=>Subject::where('sites_id', $this->site->id)->where(function ($query){
        $query->where('subject_id','LIKE','%'.$this->searchData.'%');
    })->paginate(10),]);
    }

    public function setSubjectDetails($subjectId, $subjectStatus)
    {
        $this->subjectId = $subjectId;
        $this->subjectStatus = $subjectStatus;
    }

    public function editSubject()
    {
      $subject =  Subject::find($this->subjectId);
      $subject->subject_status = $this->subjectStatus;
      $subject->save();

      $this->emit('$refresh');
    }

    public function deleteSubject()
    {
        Subject::find($this->subjectId)->delete();

        $this->emit('$refresh');

    }

}
