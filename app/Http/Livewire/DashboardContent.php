<?php

namespace App\Http\Livewire;

use App\Models\MainFilesContent;
use App\Models\MainFolder;
use App\Models\MainFolderFile;
use App\Models\Note;
use App\Models\Query;
use App\Models\SubFilesContent;
use App\Models\SubFolder;
use App\Models\SubFolderFile;
use App\Models\SubNote;
use App\Models\SubQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardContent extends Component
{
    public $content = [];
    public $subject;
    public $body;
    public $content_id;
    public $content_type;
    public $main_folder_id;
    public $replyorNot;
    public $parentId;
    public $note;
    public $deleteContentId;
    public $deleteContentType;
    public $editQuestion;
    public $editAnswer;
    public $editId;
    public $editType;
    public $folderName;
    public $folderType;
    public $folderId;
    public $state;

    protected $listeners = ['some-event' => '$refresh'];


    public function mainFileContent(MainFolderFile $id){
          $this->content = $id->contents ;

    }

    public function subFileContent(SubFolderFile $id){
        $this->content = $id->contents ;


    }



    public function toggleProperties( $id, $status , $type ){
        if ($type == 1){
          $file =  MainFilesContent::find($id);
          $file->status = !$status;
        }else{
            $file = SubFilesContent::find($id);
            $file->status = !$status;
        }
        $file->save();
        $this->emit('$refresh');
    }

    public function render()
    {
        return view('livewire.dashboard-content',['content'=>$this->content]);
    }

    public function store( ){


        $this->validate([

            'body'=>'required',

        ]);


        $input['body'] = $this->body;
        $input['user_id'] = Auth::id();

        if ($this->replyorNot == 0){
            if ($this->content_type == 1){
                $input['main_files_content_id'] = $this->content_id;
                Query::create($input);

            }else{
                $input['sub_files_content_id'] = $this->content_id;
                SubQuery::create($input);
            }
        }else{
            if ($this->content_type == 1){
                $input['main_files_content_id'] = $this->content_id;
                $input['parent_id'] = $this->parentId;
                Query::create($input);

            }else{
                $input['sub_files_content_id'] = $this->content_id;
                $input['parent_id'] = $this->parentId;
                SubQuery::create($input);
            }
        }



        $this->emit('some-event');
        $this->reset('body');
        $this->reset('content_id');
        $this->reset('content_type');


    }

    public function storeNote(){


        $this->validate([

            'note'=>'required',

        ]);


        $input['note'] = $this->note;
        $input['user_id'] = Auth::id();

            if ($this->content_type == 1){
                $input['main_files_content_id'] = $this->content_id;
                Note::create($input);

            }else{
                $input['sub_files_content_id'] = $this->content_id;
                SubNote::create($input);
            }





        $this->emit('some-event');
        $this->reset('note');
        $this->reset('content_id');
        $this->reset('content_type');

    }
    public function setDeleteRecords($id,$type){
        $this->deleteContentId = $id;
        $this->deleteContentType = $type;

    }

    public function setEditRecords($id,$type, $question, $answer){
        $this->editId = $id;
        $this->editType = $type;
        $this->editQuestion = $question;
        $this->editAnswer = $answer;

    }

    public function deleteContent(){

        if ($this->deleteContentType == 1){
            MainFilesContent::find($this->deleteContentId)->delete();
        }else{
            SubFilesContent::find($this->deleteContentId)->delete();
        }
        $this->emit('some-event');

    }

    public function editContent(){

        if ($this->editType == 1){
            if ($this->editQuestion != ''){
                $edit =  MainFilesContent::find($this->editId);
                $edit->question = $this->editQuestion;
                $edit->answer = $this->editAnswer;
                $edit->save();
            }

        }else{
            if ($this->editQuestion != '') {
                $edit = SubFilesContent::find($this->editId);
                $edit->question = $this->editQuestion;
                $edit->answer = $this->editAnswer;
                $edit->save();
            }
        }
        $this->emit('some-event');

    }
    public function folderDetails($folderId, $folderType, $folderName){
        $this->folderId = $folderId;
        $this->folderType = $folderType;
        $this->folderName = $folderName;
    }
    public function editFolderName(){
        switch ($this->folderType){
            case 1:
               $folder = MainFolder::find($this->folderId);
                $folder->folder_name = $this->folderName;
                $folder->save();
            break;
            case 2:
                $folder = SubFolder::find($this->folderId);
                $folder->folder_name = $this->folderName;
                $folder->save();
            break;
            case 3:
             $file =   SubFolderFile::find($this->folderId);
                $file->file_name = $this->folderName;
                $file->save();
            break;
            case 4:
                $file = MainFolderFile::find($this->folderId);
                $file->file_name = $this->folderName;
                $file->save();
            break;
        }

        return redirect(request()->header('Referer'));
    }

    public function deleteFolder(){
        switch ($this->folderType){
            case 1:
                MainFolder::find($this->folderId)->delete();
                break;
            case 2:
                SubFolder::find($this->folderId)->delete();
                break;
            case 3:
                SubFolderFile::find($this->folderId)->delete();
                break;
            case 4:
                MainFolderFile::find($this->folderId)->delete();
                break;
        }

        return redirect(request()->header('Referer'));
    }
public function closeQuery($id, $type){
    if ($type == 1){
        $query = Query::find($id);
        $query->opened = 1;
        $query->save();
    }else{
        $query = SubQuery::find($id);
        $query->opened = 1;
        $query->save();
    }

    return redirect(request()->header('Referer'));
}



}
