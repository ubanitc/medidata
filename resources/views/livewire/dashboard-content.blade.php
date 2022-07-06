<div x-data="{main_folder_id : '', mainid(id){
        this.main_folder_id = id;
},
    main_file_id : '',
    mainFileId(id){
        this.main_file_id = id;
    },
    sub_file_id : '',
    subFileId(id){
        this.sub_file_id = id;
    },

    file_id : '',
    type_id : '',
    getClicked(file_id){
    this.file_id = file_id;
    this.type_id = 0;
    },

    getMainClicked(file_id){
    this.file_id = file_id;
    this.type_id = 1;
    },
    submitButtonShow : 0,

    fileNameChange : 'None Selected',

    fileNameChanged(name){
        this.fileNameChange = name;
    },

    folderNameChange : 'None Selected',

    folderNameChanged(name){
    this.folderNameChange = name
    },

    subFolderNameChanged(name, subName){
    this.folderNameChange = name+'/'+subName;
    }


}">
    <aside class="navbar navbar-vertical navbar-expand-lg navbar-transparent" style="margin-top: 60px">
        <div class="container-fluid" style="margin-right: 0 !important;">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="text-center" wire:ignore>
                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="7" r="4" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>  <h4 class="d-inline">{{ str_pad(Request::segment(4), 3, 0, STR_PAD_LEFT) }}-{{ str_pad(Request::segment(6), 4, 0, STR_PAD_LEFT) }}</h4>

            </div>
{{--            <h1 class="navbar-brand navbar-brand-autodark">--}}
{{--                <a href="{{ url('/') }}">--}}
            <div class="text-center">
                  Subject Status:  <span style="font-weight: bold">{{ $subject->subject_status }}</span>
            </div>
{{--                    <img src="./static/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">--}}
{{--                </a>--}}
{{--            </h1>--}}

            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="navbar-nav pt-lg-3" wire:ignore>
{{--                                        <li class="nav-item">--}}
{{--                                            <a class="nav-link" href="./index.html" >--}}
{{--                                      <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->--}}
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>--}}
{{--                                      </span>--}}
{{--                                                <span class="nav-link-title">--}}
{{--                                        Home--}}
{{--                                           --}}{{--                        </a>--}}
{{--                        </span>--}}
{{--                                        </li>--}}

                    @foreach($subject->main_folders as $main_folders)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                               data-bs-auto-close="false" role="button" aria-expanded="false">
                  <span wire:click="folderDetails({{$main_folders->id}}, 1, '{{ $main_folders->folder_name }}')"
                        style="cursor: crosshair"
                        @can('create-study')
                            data-bs-toggle="modal" data-bs-target="#modal-edit-folder"
                        @endcan
                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/folder -->
	<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
         stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none"
                                                                                                d="M0 0h24v24H0z"
                                                                                                fill="none"/><path
            d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2"/></svg>
                  </span>
                                <span class="nav-link-title">
                    {{$main_folders->folder_name}}
                  </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <div class="dropend">
                                            @can('create-study')
                                                <a class="dropdown-item" href="#"
                                                   x-on:click.prevent="mainid({{$main_folders->id}})"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#modal-report-1">
                                                    Create Sub-Folder
                                                </a>

                                                <a class="dropdown-item" href="#"
                                                   x-on:click.prevent="mainFileId({{$main_folders->id}})"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#modal-report-2">
                                                    Create File
                                                </a>
                                            @endcan


                                            @foreach($subject->sub_folders as $sub_folders)
                                                @if($sub_folders->main_folder_id == $main_folders->id)
                                                    <a class="dropdown-item dropdown-toggle"
                                                       href="#sidebar-authentication" data-bs-toggle="dropdown"
                                                       data-bs-auto-close="false" role="button" aria-expanded="false">
                                                      <span
                                                          wire:click="folderDetails({{$sub_folders->id}}, 2, '{{ $sub_folders->folder_name }}')"
                                                          style="cursor: crosshair"
                                                          @can('create-study')
                                                              data-bs-toggle="modal"
                                                          data-bs-target="#modal-edit-folder"
                                                          @endcan
                                                          class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/folders -->
	<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
         stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none"
                                                                                                d="M0 0h24v24H0z"
                                                                                                fill="none"/><path
            d="M9 4h3l2 2h5a2 2 0 0 1 2 2v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2"/><path
            d="M17 17v2a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2h2"/></svg>
                  </span> {{$sub_folders->folder_name}}
                                                    </a>

                                                    <div class="dropdown-menu">
                                                        @can('create-study')
                                                            <a href="#"
                                                               x-on:click.prevent="subFileId({{$sub_folders->id}})"
                                                               data-bs-toggle="modal"
                                                               data-bs-target="#modal-report-3"
                                                               class="dropdown-item">New File</a>
                                                        @endcan

                                                        @foreach($subject->sub_folder_files as $sub_folder_files)

                                                            @if($sub_folder_files->sub_folder_id == $sub_folders->id)
                                                                <a href="#"
                                                                   @click="getClicked({{ $sub_folder_files->id}}); fileNameChanged('{{ $sub_folder_files->file_name }}'); subFolderNameChanged('{{ $main_folders->folder_name }}','{{ $sub_folders->folder_name    }}') "
                                                                   wire:click.prevent="subFileContent({{ $sub_folder_files->id }}); "
                                                                   class="dropdown-item">

                                                                    <span
                                                                        wire:click="folderDetails({{$sub_folder_files->id}}, 3, '{{ $sub_folder_files->file_name }}')"
                                                                        style="cursor: crosshair"
                                                                        @can('create-study')
                                                                            data-bs-toggle="modal"
                                                                        data-bs-target="#modal-edit-folder"
                                                                        @endcan
                                                                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/file -->
	<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
         stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none"
                                                                                                d="M0 0h24v24H0z"
                                                                                                fill="none"/><path
            d="M14 3v4a1 1 0 0 0 1 1h4"/><path
            d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"/></svg>
                  </span>
                                                                    {{$sub_folder_files->file_name}}</a>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endif

                                            @endforeach
                                        </div>
                                        @foreach($subject->main_folder_files as $main_folder_files)
                                            @if($main_folder_files->main_folder_id == $main_folders->id)
                                                <a class="dropdown-item" href="#"
                                                   @click="getMainClicked({{ $main_folder_files->id}}); fileNameChanged('{{ $main_folder_files->file_name }}'); folderNameChanged('{{ $main_folders->folder_name }}')"
                                                   wire:click.prevent="mainFileContent({{ $main_folder_files->id }})">
                                                    <span
                                                        wire:click="folderDetails({{$main_folder_files->id}}, 4, '{{ $main_folder_files->file_name }}')"
                                                        style="cursor: crosshair"
                                                        @can('create-study')
                                                            data-bs-toggle="modal"
                                                        data-bs-target="#modal-edit-folder"
                                                        @endcan
                                                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                         stroke-width="2"
                         stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path
                            stroke="none"
                            d="M0 0h24v24H0z"
                            fill="none"/><path
                            d="M14 3v4a1 1 0 0 0 1 1h4"/><path
                            d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"/></svg>
                  </span>{{$main_folder_files->file_name}}
                                                </a>
                                            @endif

                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </aside>
    <div class="page-wrapper">

        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="" wire:ignore>
                            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="7" r="4" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>  <h4 class="d-inline">{{ str_pad(Request::segment(4), 3, 0, STR_PAD_LEFT) }}-{{ str_pad(Request::segment(6), 4, 0, STR_PAD_LEFT) }}</h4>

                        </div>
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
	<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
         stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none"
                                                                                                d="M0 0h24v24H0z"
                                                                                                fill="none"/><path
            d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2"/></svg>
                  </span><span x-text="folderNameChange"></span>
                        </div>

                        <h2 class="page-title">

                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                         stroke-width="2"
                         stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path
                            stroke="none"
                            d="M0 0h24v24H0z"
                            fill="none"/><path
                            d="M14 3v4a1 1 0 0 0 1 1h4"/><path
                            d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"/></svg>
                  </span><span x-text="fileNameChange"></span>
                        </h2>
                    </div>

                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            {{--                  <span class="d-none d-sm-inline">--}}
                            {{--                    <a href="#" wire:click.prevent="$refresh" class="btn btn-white">--}}
                            {{--                      New view--}}
                            {{--                    </a>--}}
                            {{--                  </span>--}}
                            @can('create-study')
                                <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                   data-bs-target="#modal-report">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <line x1="12" y1="5" x2="12" y2="19"/>
                                        <line x1="5" y1="12" x2="19" y2="12"/>
                                    </svg>
                                    Create new Folder
                                </a>
                            @endcan

                            {{--                            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"--}}
                            {{--                               data-bs-target="#modal-report" aria-label="Create new report">--}}
                            {{--                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->--}}
                            {{--                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"--}}
                            {{--                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"--}}
                            {{--                                     stroke-linecap="round" stroke-linejoin="round">--}}
                            {{--                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>--}}
                            {{--                                    <line x1="12" y1="5" x2="12" y2="19"/>--}}
                            {{--                                    <line x1="5" y1="12" x2="19" y2="12"/>--}}
                            {{--                                </svg>--}}
                            {{--                            </a>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                @foreach($content as $contents)
                    <div class="col-12">
                        <div class="card">
                            <div class="card-status-start bg-primary"></div>
                            <div class="card-body">
                                <div class="row" x-data="{
                                    query: false,
                                    note: false,
                                    protocol: false,
                                    query_input: '',


                                }">
                                    <div class="col-md-4"> {{ $contents->question }}</div>
                                    <div class="col-md-3"><b>{{ $contents->answer }}</b></div>
                                    <div class="col-md-3">
                                        <div class="col-auto ms-auto">
                                            <label class="form-check form-switch m-0">
                                                <div class="w-50" >
                                                    <label class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" wire:click="toggleProperties({{$contents->id}}, {{ $contents->status }}, {{ $contents->type }})"  {{ $contents->status ? 'checked': '' }}>
                                                    </label>
{{--                                                    <button x-data="{--}}
{{--                                                    checkSign :  {{ $contents->status}}--}}
{{--                                                }"--}}
{{--                                                            wire:click="toggleProperties({{$contents->id}}, {{ $contents->status }}, {{ $contents->type }})"--}}
{{--                                                            class="btn btn-light btn-square w-100" >--}}
{{--                                                            <svg x-show="checkSign"--}}
{{--                                                                 style="background-color: #008000; border-radius: 50%; color: white;"--}}
{{--                                                                 xmlns="http://www.w3.org/2000/svg" class="icon" width="24"--}}
{{--                                                                 height="24" viewBox="0 0 24 24" stroke-width="2"--}}
{{--                                                                 stroke="currentColor" fill="none" stroke-linecap="round"--}}
{{--                                                                 stroke-linejoin="round">--}}
{{--                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>--}}
{{--                                                                <circle cx="12" cy="12" r="9"/>--}}
{{--                                                                <path d="M9 12l2 2l4 -4"/>--}}
{{--                                                            </svg>--}}
{{--                                                            <svg x-show="!checkSign" xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                                 class="icon" width="24" height="24" viewBox="0 0 24 24"--}}
{{--                                                                 stroke-width="2" stroke="currentColor" fill="none"--}}
{{--                                                                 stroke-linecap="round" stroke-linejoin="round">--}}
{{--                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>--}}
{{--                                                                <circle cx="12" cy="12" r="9"/>--}}
{{--                                                            </svg>--}}


{{--                                                        Verify--}}
{{--                                                    </button>--}}
                                                </div>
                                                {{--                                                <input class="form-check-input position-static"--}}
                                                {{--                                                       wire:click="toggleProperties({{$contents->id}}, {{ $contents->status }}, {{ $contents->type }})"--}}
                                                {{--                                                       type="checkbox" @if($contents->status) checked @endif>--}}
                                            </label>
                                        </div>
                                        <div class="mb-3 mt-3">
                                            @foreach($contents->queries as $queries)
                                                <p><b>
                                                        <!-- Download SVG icon from http://tabler-icons.io/i/message-circle-2 -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                             height="24" viewBox="0 0 24 24" stroke-width="2"
                                                             stroke="currentColor" fill="none" stroke-linecap="round"
                                                             stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1"/>
                                                            <line x1="12" y1="12" x2="12" y2="12.01"/>
                                                            <line x1="8" y1="12" x2="8" y2="12.01"/>
                                                            <line x1="16" y1="12" x2="16" y2="12.01"/>
                                                        </svg>{{ $queries->body }}</p></b>

                                                    @if($queries->opened == 0 )
                                                    <a class="d-inline-flex"
                                                       @click.prevent="query = true; $wire.set('content_id', {{ $contents->id}}); $wire.set('content_type', {{ $contents->type}}); $wire.set('replyorNot', 1); $wire.set('parentId', {{ $queries->id}}) "
                                                       style="float: right"
                                                       href="#"><span
                                                            class="d-block">Reply</span></a>
                                                @can('create-study')
                                                        <a href="#" wire:click.prevent="closeQuery({{ $queries->id }}, {{ $contents->type}})" class="d-inline-flex">Close Query</a>
                                                    @endcan
                                                    @endif


                                                @foreach($queries->replies as $replies)
                                                    <p class="ms-2">
                                                        <!-- Download SVG icon from http://tabler-icons.io/i/corner-down-right-double -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                             height="24" viewBox="0 0 24 24" stroke-width="2"
                                                             stroke="currentColor" fill="none" stroke-linecap="round"
                                                             stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M4 5v6a3 3 0 0 0 3 3h7"/>
                                                            <path d="M10 10l4 4l-4 4m5 -8l4 4l-4 4"/>
                                                        </svg> {{ $replies->body }} </p>
                                                @endforeach

                                            @endforeach
                                            @foreach($contents->notes as $notes)
                                                <p>
                                                        <span><!-- Download SVG icon from http://tabler-icons.io/i/note -->
	<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
         stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none"
                                                                                                d="M0 0h24v24H0z"
                                                                                                fill="none"/><line
            x1="13" y1="20" x2="20" y2="13"/><path
            d="M13 20v-6a1 1 0 0 1 1 -1h6v-7a2 2 0 0 0 -2 -2h-12a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7"/></svg></span>{{ $notes->note }}
                                                </p>
                                            @endforeach
                                        </div>
                                        <form x-on:click.outside="query = false" x-on:submit="query = false"
                                              wire:submit.prevent="store()" method="post" x-show="query"
                                              class="mt-1 mb-2">
                                            @csrf
                                            <input type="hidden" id="content_id" wire:model="content_id">
                                            <input type="hidden" id="content_type" wire:model="content_type">
                                            @error('body'){{$message}}@enderror

                                            <textarea wire:model="body" class="form-control mt-1"></textarea>
{{--                                            <select class="form-control w-50 mt-1">--}}
{{--                                                <option label="Site from CRA" value="" selected>--}}
{{--                                                    Site from CRA--}}
{{--                                                </option>--}}
{{--                                            </select>--}}

{{--                                            <label class="form-check">--}}
{{--                                                <input class="form-check-input" name="reply_needed" type="checkbox">--}}
{{--                                                <span class="form-check-label">Response Required</span>--}}
{{--                                            </label>--}}
                                            <div class="mt-2">
                                                <button @click="query = false;" type="submit"
                                                        class="btn btn-outline-success d-inline">
                                                    Send
                                                </button>
                                                <a @click.prevent="query = false" href="#"
                                                   class="btn btn-ghost-secondary d-inline">
                                                    Cancel
                                                </a>
                                            </div>
                                        </form>

                                        {{--                                        <form action="#" class="mt-1 mb-2" x-show="protocol">--}}

                                        {{--                                            <input type="text" class="form-control">--}}
                                        {{--                                            <select class="form-control w-25 mt-1">--}}
                                        {{--                                                <optgroup label="Codes">--}}
                                        {{--                                                    <option label="A" value="" selected="selected">A</option>--}}
                                        {{--                                                    <option label="B" value="">B</option>--}}
                                        {{--                                                    <option label="Major" value="">Major</option>--}}
                                        {{--                                                    <option label="Minor" value="">Minor</option>--}}
                                        {{--                                                </optgroup>--}}
                                        {{--                                            </select>--}}
                                        {{--                                            <select class="form-control w-50 mt-1">--}}
                                        {{--                                                <optgroup label="Classes">--}}
                                        {{--                                                    <option label="10" value="object:9486" selected="selected">10--}}
                                        {{--                                                    </option>--}}
                                        {{--                                                    <option label="20" value="object:9487">20</option>--}}
                                        {{--                                                    <option label="1. Informed consent" value="object:9488">1. Informed--}}
                                        {{--                                                        consent--}}
                                        {{--                                                    </option>--}}
                                        {{--                                                    <option label="2. Eligibility" value="object:9489">2. Eligibility--}}
                                        {{--                                                    </option>--}}
                                        {{--                                                    <option label="3. Clinical trial material" value="object:9490">3.--}}
                                        {{--                                                        Clinical trial material--}}
                                        {{--                                                    </option>--}}
                                        {{--                                                    <option label="4. Source documents or eCRF" value="object:9491">4.--}}
                                        {{--                                                        Source documents or eCRF--}}
                                        {{--                                                    </option>--}}
                                        {{--                                                    <option label="5. AE/SAE" value="object:9492">5. AE/SAE</option>--}}
                                        {{--                                                    <option label="6. Biologic samples" value="object:9493">6. Biologic--}}
                                        {{--                                                        samples--}}
                                        {{--                                                    </option>--}}
                                        {{--                                                    <option label="7. Central review" value="object:9494">7. Central--}}
                                        {{--                                                        review--}}
                                        {{--                                                    </option>--}}
                                        {{--                                                    <option label="8. Investigator responsibilities"--}}
                                        {{--                                                            value="object:9495">8. Investigator responsibilities--}}
                                        {{--                                                    </option>--}}
                                        {{--                                                    <option label="9. Missed assessment" value="object:9496">9. Missed--}}
                                        {{--                                                        assessment--}}
                                        {{--                                                    </option>--}}
                                        {{--                                                    <option label="10. Time and events" value="object:9497">10. Time and--}}
                                        {{--                                                        events--}}
                                        {{--                                                    </option>--}}
                                        {{--                                                    <option label="11. Other" value="object:9498">11. Other</option>--}}
                                        {{--                                                </optgroup>--}}
                                        {{--                                            </select>--}}
                                        {{--                                            <div class="mt-2">--}}
                                        {{--                                                <a href="#" class="btn btn-outline-primary d-inline">--}}
                                        {{--                                                    Add Protocol Deviation--}}
                                        {{--                                                </a>--}}
                                        {{--                                                <a @click.prevent="protocol = false" href="#"--}}
                                        {{--                                                   class="btn btn-ghost-secondary d-inline">--}}
                                        {{--                                                    Cancel--}}
                                        {{--                                                </a>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </form>--}}


                                        <form action="#" class="mt-1 mb-2" x-show="note"
                                              x-on:click.outside="note = false" x-on:submit="note = false"
                                              wire:submit.prevent="storeNote()" method="post">
                                            <input type="text" wire:model="note" class="form-control">

{{--                                            <select class="form-control w-50 mt-1">--}}
{{--                                                <optgroup label="Open To">--}}
{{--                                                    <option label="Site from CRA" value="object:2313"--}}
{{--                                                            selected="selected">Site from CRA--}}
{{--                                                    </option>--}}
{{--                                                    <option label="CRA from System" value="object:2314">CRA from--}}
{{--                                                        System--}}
{{--                                                    </option>--}}
{{--                                                    <option label="CRA from Medical Monitor" value="object:2315">CRA--}}
{{--                                                        from Medical Monitor--}}
{{--                                                    </option>--}}
{{--                                                </optgroup>--}}
{{--                                            </select>--}}
                                            <div class="mt-2">
                                                <button type="submit" class="btn btn-outline-info d-inline">
                                                    Add Note
                                                </button>
                                                <a @click.prevent="note = false" href="#"
                                                   class="btn btn-ghost-secondary d-inline">
                                                    Cancel
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="col-auto">
                                            <div class="dropdown">
                                                <a href="#" class="card-dropdown" data-bs-toggle="dropdown"
                                                   aria-expanded="false">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                         height="24" viewBox="0 0 24 24" stroke-width="2"
                                                         stroke="currentColor" fill="none" stroke-linecap="round"
                                                         stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <circle cx="12" cy="12" r="1"/>
                                                        <circle cx="12" cy="19" r="1"/>
                                                        <circle cx="12" cy="5" r="1"/>
                                                    </svg>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <button
                                                        @click.prevent="query = true; $wire.set('content_id', {{ $contents->id}}); $wire.set('content_type', {{ $contents->type}}); $wire.set('replyorNot', 0) "
                                                        class="dropdown-item"
                                                        x-bind:disabled="query">Open
                                                        Query
                                                    </button>
                                                    {{--                                                    <button @click.prevent="protocol = !protocol" class="dropdown-item"--}}
                                                    {{--                                                            x-bind:disabled="protocol" class="dropdown-item">Add--}}
                                                    {{--                                                        Protocol Deviation--}}
                                                    {{--                                                    </button>--}}
                                                    <button
                                                        @click.prevent="note = true; $wire.set('content_id', {{ $contents->id}}); $wire.set('content_type', {{ $contents->type}});"
                                                        class="dropdown-item"
                                                        x-bind:disabled="note" class="dropdown-item">Add Note
                                                    </button>
                                                    @can('create-study')

                                                        <button class="dropdown-item"
                                                                wire:click="setDeleteRecords({{ $contents->id}},{{ $contents->type}})"
                                                                data-bs-toggle="modal" data-bs-target="#modal-danger">
                                                            Delete Record
                                                        </button>

                                                        <button class="dropdown-item"
                                                                wire:click="setEditRecords({{ $contents->id}},{{ $contents->type}},'{{ $contents->question }}','{{ $contents->answer }}')"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-report-edit">Edit Record
                                                        </button>
                                                    @endcan

                                                    {{--                                                    <a href="#" class="dropdown-item">Audit History</a>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
                @can('create-study')

                    @if($content != null)
                        <form action="{{ route('create-folder-content') }}" method="post">
                            @csrf
                            <div x-data="addRemove()">
                                <input type="hidden" name="file_id" x-bind:value="file_id">
                                <input type="hidden" name="type_id" x-bind:value="type_id">

                                <template x-for="(field, index) in fields" :key="field.id">
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="questions[]">
                                        </div>
                                        <div class="col-md-3"><b>
                                                <input type="text" class="form-control" name="answers[]">

                                            </b>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-sm btn-ghost-danger"
                                                    @click="removeField(field); submitButtonShow--">remove
                                            </button>

                                        </div>
                                    </div>
                                </template>
                                <button type="button" class="btn btn-sm btn-secondary mt-3"
                                        @click="addNewField(); submitButtonShow++ ">+ Add Row
                                </button>
                            </div>
                            <button class="btn btn-success" type="submit" x-show="submitButtonShow > 0">Save</button>
                        </form>
                    @endif
                @endcan

            </div>
        </div>
    </div>

    {{--    modal for creating folder --}}

    <form action="{{ route('create-main-folder') }}" wire:ignore method="post">
        @csrf
        <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Folder</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <div x-data="addRemove()">
                                <div>
                                    <input type="text" name="folder_name[]" class="form-control mb-2">
                                </div>
                                <template x-for="(field, index) in fields" :key="field.id">
                                    <div>

                                        <input type="text" class="form-control" name="folder_name[]">
                                        <button type="button" class="btn btn-sm btn-ghost-danger"
                                                @click="removeField(field)">remove
                                        </button>
                                    </div>
                                </template>
                                <button type="button" class="btn btn-sm btn-secondary mt-3" @click="addNewField()">+ Add
                                    Row
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24"
                                 stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Create new folder
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
    {{--    end modal for creating folder--}}




    {{--    modal for creating sub-folder --}}

    <form action="{{ route('create-sub-folder') }}" wire:ignore method="post">
        @csrf
        <div class="modal modal-blur fade" id="modal-report-1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Folder</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" name="main_folder_id" x-bind:value="main_folder_id">
                            <div x-data="addRemove()">
                                <div>
                                    <input type="text" name="sub_folder_name[]" class="form-control mb-2">
                                </div>
                                <template x-for="(field, index) in fields" :key="field.id">
                                    <div>
                                        <input type="text" class="form-control" name="sub_folder_name[]">
                                        <button type="button" class="btn btn-sm btn-ghost-danger"
                                                @click="removeField(field)">remove
                                        </button>
                                    </div>
                                </template>
                                <button type="button" class="btn btn-sm btn-secondary mt-3" @click="addNewField()">+ Add
                                    Row
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24"
                                 stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Create new sub-folder
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
    {{--    end modal for creating sub-folder--}}


    {{--    modal for creating main-files --}}

    <form action="{{ route('create-main-file') }}" wire:ignore method="post">
        @csrf
        <div class="modal modal-blur fade" id="modal-report-2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New File</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <div x-data="addRemove()">
                                <input type="hidden" name="main_file_id_get" x-bind:value="main_file_id">

                                <div>
                                    <input type="text" name="main_file_name[]" class="form-control mb-2">
                                </div>
                                <template x-for="(field, index) in fields" :key="field.id">
                                    <div>
                                        <input type="text" class="form-control" name="main_file_name[]">
                                        <button type="button" class="btn btn-sm btn-ghost-danger"
                                                @click="removeField(field)">remove
                                        </button>
                                    </div>
                                </template>
                                <button type="button" class="btn btn-sm btn-secondary mt-3" @click="addNewField()">+ Add
                                    Row
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24"
                                 stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Create new File
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
    {{--    end modal for creating main-files--}}



    {{--    modal for creating sub-folder-files --}}

    <form action="{{ route('create-sub-folder-file') }}" wire:ignore method="post">
        @csrf
        <div class="modal modal-blur fade" id="modal-report-3" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New File</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <div x-data="addRemove()">
                                <input type="hidden" name="sub_file_id" x-bind:value="sub_file_id">

                                <div>
                                    <input type="text" name="sub_file_name[]" class="form-control mb-2">
                                </div>
                                <template x-for="(field, index) in fields" :key="field.id">
                                    <div>
                                        <input type="text" class="form-control" name="sub_file_name[]">
                                        <button type="button" class="btn btn-sm btn-ghost-danger"
                                                @click="removeField(field)">remove
                                        </button>
                                    </div>
                                </template>
                                <button type="button" class="btn btn-sm btn-secondary mt-3" @click="addNewField()">+ Add
                                    Row
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24"
                                 stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Create new File
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
    {{--    end modal for creating sub-folder-files--}}

    {{--    modal for deleting internal content--}}
    {{--    modal for deleting internal content--}}
    {{--    modal for deleting internal content--}}

    <div class="modal modal-blur fade" wire:ignore.self id="modal-danger" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 9v2m0 4v.01"/>
                        <path
                            d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75"/>
                    </svg>
                    <h3>Are you sure?</h3>
                    <div class="text-muted">Do you really want to Delete this Record?</div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                    Cancel
                                </a></div>
                            <div class="col">
                                <a href="#" wire:click.prevent="deleteContent" class="btn btn-danger w-100"
                                   data-bs-dismiss="modal">
                                    Yes
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--  end  modal for deleting internal content--}}
    {{--  end  modal for deleting internal content--}}
    {{--  end  modal for deleting internal content--}}

    {{--    --}}
    {{--    start of edit modal--}}
    {{--    start of edit modal--}}
    {{--    start of edit modal--}}
    {{--    start of edit modal--}}


    <div class="modal modal-blur fade" wire:ignore.self id="modal-report-edit" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <div>
                            <label for="folder_name">Question</label>
                            <textarea type="text" wire:model="editQuestion" name="folder_name" rows="3"
                                      class="form-control mb-2"> </textarea>
                            <label for="folder_name">Answer</label>
                            <textarea type="text" wire:model="editAnswer" name="folder_name" rows="3"
                                      class="form-control mb-2"> </textarea>
                        </div>


                    </div>
                </div>

                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button wire:click.prevent="editContent" class="btn btn-success ms-auto" data-bs-dismiss="modal">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <line x1="12" y1="5" x2="12" y2="19"/>
                            <line x1="5" y1="12" x2="19" y2="12"/>
                        </svg>
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>


    {{--    end of edit modal--}}
    {{--    end of edit modal--}}
    {{--    end of edit modal--}}
    {{--    end of edit modal--}}

    {{--    folder edit and delete part--}}
    {{--    folder edit and delete part--}}
    {{--    folder edit and delete part--}}
    {{--    folder edit and delete part--}}
    <div class="modal modal-blur fade" wire:ignore.self id="modal-edit-folder" tabindex="-1" role="dialog"
         aria-hidden="true" x-data="{
        editTextBox : true,
    }">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="row mb-3" x-show="editTextBox">
                        <div class="col-12">
                            <label class="form-label">Name</label>

                            <input type="text" wire:model="folderName" class="form-control">
                        </div>
                    </div>
                    <div class="form-selectgroup-boxes row mb-3">
                        <div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="report-type" value="1" class="form-selectgroup-input" checked
                                       @change="editTextBox = !editTextBox">
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                    <span class="me-3">
                      <span class="form-selectgroup-check"></span>
                    </span>
                    <span class="form-selectgroup-label-content">
                      <span class="form-selectgroup-title strong mb-1">Edit</span>
                    </span>
                  </span>
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="report-type" value="1" @change="editTextBox = !editTextBox"
                                       class="form-selectgroup-input">
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                    <span class="me-3">
                      <span class="form-selectgroup-check"></span>
                    </span>
                    <span class="form-selectgroup-label-content">
                      <span class="form-selectgroup-title strong mb-1">Delete</span>
                    </span>
                  </span>
                            </label>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <a href="#" wire:click.prevent="editFolderName" x-show="editTextBox" class="btn btn-success ms-auto"
                       data-bs-dismiss="modal">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        Save
                    </a>
                    <a href="#" wire:click.prevent="deleteFolder" x-show="!editTextBox" class="btn btn-danger ms-auto"
                       data-bs-dismiss="modal">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        Delete
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{--    folder edit and delete part--}}
    {{--    folder edit and delete part--}}
    {{--    folder edit and delete part--}}

    <script>
        function addRemove() {
            return {
                fields: [],
                addNewField() {
                    this.fields.push({id: new Date().getTime() + this.fields.length});
                },
                removeField(field) {
                    this.fields.splice(this.fields.indexOf(field), 1);
                }
            }
        }


    </script>
</div>

