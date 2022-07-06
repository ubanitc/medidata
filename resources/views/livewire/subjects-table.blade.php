<div>
    @section('name')
        {{ ucwords($site->site_name) }} -
    @endsection


            <div class="d-flex justify-content-between mb-3 ">
                <div>
                <div class="text-white d-inline" style="background-color: #37cc6e; border-radius: 10px; padding: 5px 10px; width: 150px; text-align: center; height: 30px">
                        Completed {{ $completed->count()}}
                </div>
                <div class="text-white d-inline ms-2" style="background-color: #008ec0; border-radius: 10px; padding: 5px 10px; width: 150px; text-align: center; height: 30px">
                        Enrolled {{ $enrolled->count()}}
                </div>

                </div>
    @can('create-study')
        <div class="empty-action pb-3" >
            <a href="#" class="btn btn-primary " href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-team">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                Create New Subject
            </a>
        </div>
    @endcan
            </div>
    <div>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="input-icon  d-flex">
                    <div class="col">
                        <input wire:model="searchData" type="text" class="form-control" placeholder="Search for…">
                    </div>
                    <div class="d-inline">
                        <a href="#" class="btn btn-white btn-icon" aria-label="Button">
                            <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="10" cy="10" r="7" /><line x1="21" y1="21" x2="15" y2="15" /></svg>
                        </a>
                    </div>
                </div>


            </div>
        </div>
        <table
            class="table table-vcenter table-mobile-md card-table">
            <thead>
            <tr>
                <th>Subject Information</th>
                <th>Subject Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                @forelse($subjects as $subject)
                <a href="#">
                    <tr class="table-hover">
                        <td data-label="Name" >

                            <a href="{{ route('study.sites.subject.dashboard.index', ['study'=>$study->id,'site'=>$site->id,'subject'=>$subject->id]) }}">
                                <div class="d-flex py-1 align-items-center">
                                        {{ $site->site_number }}-{{ $subject->subject_id }}
{{--                                    {{ str_pad($site->site_number, 3, 0, STR_PAD_LEFT) }}--}}
                                </div>
                            </a>
                        </td>
                        <td data-label="Title" >
                            {{ $subject->subject_status }}
                        </td>

                        @can('create-study')

                        <td>
                            <div class="btn-list flex-nowrap">
                                <a href="#" wire:click.prevent="setSubjectDetails({{ $subject->id }}, '{{$subject->subject_status}}')" class="btn" data-bs-toggle="modal" data-bs-target="#modal-edit-folder">
                                    Modify
                                </a>
{{--                                <div class="dropdown">--}}
{{--                                    <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">--}}
{{--                                        Modify--}}
{{--                                    </button>--}}
{{--                                    <div class="dropdown-menu dropdown-menu-end">--}}
{{--                                        <a class="dropdown-item" href="#">--}}
{{--                                            Action--}}
{{--                                        </a>--}}
{{--                                        <a class="dropdown-item" href="#">--}}
{{--                                            Another action--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </td>
                        @endcan
                    </tr>
                </a>
                @empty
                <div class="text-center w-100">
                    <tr >No available Result</tr>
                </div>
                @endforelse
            </tbody>


        </table>

{{--        <div class="card w-100">--}}
{{--            <div style="float: right" class="pt-2">--}}
{{--                {{ $sites->links() }}--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>

        <div class="modal modal-blur fade" id="modal-team" tabindex="-1" role="dialog" aria-hidden="true">
            <form action="{{ url('/study/'.$study->id.'/sites/'.$site->id.'/subject') }}" method="post">

            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create a new Subject</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            @csrf
                            <div class="row mb-3 align-items-end">
                                <div class="col">
                                    <div class="form-label">Subject Status</div>
                                    <select class="form-select" name="subject_status">
                                        <option value="Enrolled">Enrolled</option>
                                        <option value="Screening">Screening</option>
                                        <option value="Screen Failed">Screen Failed</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Discontinued">Discontinued</option>
                                    </select>
                                </div>
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
                                <div class="form-label">Subject Status</div>
                                <select wire:ignore class="form-select" wire:model="subjectStatus" name="subject_status">
                                    <option @if($subjectStatus == 'Enrolled') selected @endif  value="Enrolled">Enrolled</option>
                                    <option @if($subjectStatus == 'Screening') selected @endif value="Screening">Screening</option>
                                    <option @if($subjectStatus == 'Screen Failed') selected @endif value="Screen Failed">Screen Failed</option>
                                    <option @if($subjectStatus == 'Completed') selected @endif value="Completed">Completed</option>
                                    <option @if($subjectStatus == 'Discontinued') selected @endif value="Discontinued">Discontinued</option>
                                </select>
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
                        <a href="#" wire:click.prevent="editSubject" x-show="editTextBox" class="btn btn-success ms-auto" data-bs-dismiss="modal">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            Save
                        </a>
                        <a href="#" wire:click.prevent="deleteSubject" x-show="!editTextBox" class="btn btn-danger ms-auto" data-bs-dismiss="modal">
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
