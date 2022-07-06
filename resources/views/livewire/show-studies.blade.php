<div>
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show " role="alert">
            <strong>{{ Session::get('success') }}</strong> Created Successfully
        </div>
    @endif

    @can('create-study')
        @if( $studies != null )
            <div class="empty-action pb-3" style="text-align: right">
                <a href="#" class="btn btn-primary" href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-team">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                    Create New Study
                </a>
            </div>
        @endif

    @endcan
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h2>Studies (                @if($studies)
                    {{ $studies->count() }}
                @else
                    {{ '0' }}
                @endif
            <span>)</span>
              </h2>
            <div class="input-icon mb-3">
                <input type="text" class="form-control" wire:model="searchData" placeholder="Search…">
                <span class="input-icon-addon" >
                                                      <div wire:loading class="spinner-border spinner-border-sm text-muted" role="status"></div>

                    <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                  <svg wire:loading.remove xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="10" cy="10" r="7" /><line x1="21" y1="21" x2="15" y2="15" /></svg>
                                </span>
            </div>
        </div>
        <div class="card-body p-0">

            <div class="row m-0">

                {{--                --}}
                {{--                start of studies section--}}
                {{--                --}}
                {{--                --}}
                @forelse( $studies as $study)
                    <div class="col-12 col-md-6 col-lg-4 border p-4 " style="height: 200px">
                        <div style="width: 100%;" class="d-flex justify-content-center flex-column text-center">
                            <div class="d-flex justify-content-center m-2">
                                <svg version="1.1" id="Layer_1" height="40" width="40" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
<g>
    <g>
        <path @if(request()->get('theme') == 'dark')fill="#f8fafc" @endif d="M256,0C136.384,0,42.667,42.176,42.667,96v320c0,53.824,93.717,96,213.333,96s213.333-42.176,213.333-96V96
			C469.333,42.176,375.616,0,256,0z M448,416c0,35.307-78.848,74.667-192,74.667S64,451.307,64,416v-64.384
			c34.197,32.043,106.347,53.717,192,53.717s157.803-21.675,192-53.717V416z M448,309.333C448,344.64,369.152,384,256,384
			S64,344.64,64,309.333v-64.384c34.197,32.043,106.347,53.717,192,53.717s157.803-21.675,192-53.717V309.333z M448,202.667
			c0,35.307-78.848,74.667-192,74.667s-192-39.36-192-74.667v-64.384C98.197,170.325,170.347,192,256,192s157.803-21.675,192-53.717
			V202.667z M256,170.667c-113.152,0-192-39.36-192-74.667c0-35.307,78.848-74.667,192-74.667S448,60.693,448,96
			C448,131.307,369.152,170.667,256,170.667z"/>
    </g>
</g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
</svg>
                                <span style="display: grid; place-self: center">{{ strtoupper($study->study_name) }}</span>
                            </div>
                            <div>
                                <a href="{{ url('/study/'.$study->id).'/sites' }}" class="d-block">Rave EDC</a>
{{--                                <a href="{{ route('users.index') }}" class="d-block">Rave Modules</a>--}}
                                @can('create-study')
                                    <a href="#" wire:click.prevent="setStudyName({{$study->id}},'{{$study->study_name}}','{{ $study->phase }}', '{{ $study->indication }}')" data-bs-toggle="modal" data-bs-target="#modal-edit-folder" class="d-block">Modify</a>
                                @endcan
                            </div>
                        </div>

                    </div>

                @empty
                    <div class="empty">
                        <div class="empty-img"><img src="{{ asset('static/illustrations/undraw_printing_invoices_5r4r.svg') }}" height="128"  alt="">
                        </div>
                        <p class="empty-title">Not Found</p>
                        <p class="empty-subtitle text-muted">
                            Try adjusting your search or filter to find what you're looking for.
                        </p>

                        @can('create-study')
                            @if( $studies == null )

                            <div class="empty-action">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-team">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                                    Create New Study
                                </a>
                            </div>
                            @endif
                        @endcan

                    </div>
                @endforelse


                {{--                --}}
                {{--                end of study section--}}
                {{--                --}}
                {{--                --}}

            </div>
        </div>

        @if($studies && $studies->hasPages())
            <div class="card-footer">
                <div style="float: right">
                    {{ $studies->links() }}
                </div>
            </div>
        @endif
    </div>

        <div class="modal modal-blur fade" id="modal-team" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create a new Study</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/') }}" method="post">
                        @csrf
                        <div class="row mb-3 align-items-end">
                            <div class="col">
                                <label class="form-label">Study Name <span class="text-muted">Required*</span></label>
                                <input name="study_name" type="text" placeholder="Study Name" class="form-control" />
                            </div>
                        </div>
                        <div class="row mb-3 align-items-end">

                            <div class="col">

                                <label class="form-label">Phase <span class="text-muted">Required*</span></label>
                                <input name="phase" type="text" placeholder="Phase" class="form-control" />
                            </div>
                        </div>
                        <div>
                            <label class="form-label">Indication</label>
                            <textarea name="indication" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Create</button>
                    </div>

                </div>
            </div>
            </form>

        </div>

        {{--    folder edit and delete part--}}
        {{--    folder edit and delete part--}}
        {{--    folder edit and delete part--}}
        {{--    folder edit and delete part--}}
        <div class="modal modal-blur fade" wire:ignore.self id="modal-edit-folder" tabindex="-1" role="dialog" aria-hidden="true" x-data="{
        editTextBox : true,
    }">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-body" >
                        <div class="row mb-3" x-show="editTextBox">
                            <div class="col-12">
                                <label class="form-label">Name</label>

                                <input type="text" wire:model="studyName" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3" x-show="editTextBox">
                            <div class="col-12">
                                <label class="form-label">Phase</label>

                                <input type="text" wire:model="studyPhase" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3" x-show="editTextBox">
                            <div class="col-12">
                                <label class="form-label">Indication</label>

                                <input type="text" wire:model="studyIndication" class="form-control">
                            </div>
                        </div>
                        <div class="form-selectgroup-boxes row mb-3">
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="report-type" value="1" class="form-selectgroup-input" checked @change="editTextBox = !editTextBox">
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
                                    <input type="radio" name="report-type"  value="1" @change="editTextBox = !editTextBox" class="form-selectgroup-input" >
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
                        <a href="#" wire:click.prevent="editStudyName" x-show="editTextBox" class="btn btn-success ms-auto" data-bs-dismiss="modal">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            Save
                        </a>
                        <a href="#" wire:click.prevent="deleteStudy" x-show="!editTextBox" class="btn btn-danger ms-auto" data-bs-dismiss="modal">
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
</div>
