<div>
    @can('create-study')
            <div class="empty-action pb-3" style="text-align: right">
                <a href="#" class="btn btn-primary" href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-team">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                    Create New Site
                </a>
            </div>
    @endcan
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
            <h4>
                <a href="{{ route('view-tasks',['id'=>$study->id]) }}" ><span>EDC Tasks</span></a>
            </h4>

        </div>
    </div>
    <table
        class="table table-vcenter table-mobile-md card-table">
        <thead>
        <tr>
            <th>Site Number</th>
            <th>Site Name</th>
            <th>Country</th>
            <th>Investigator Name</th>
            <th>Investigator Email</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        @forelse($sites as $site)
            <a href="#">
                <tr class="table-hover">
            <td data-label="Name" >
                <a href="{{ url('/study/'.$study->id.'/sites/'.$site->id.'/subject') }}">
                <div class="d-flex py-1 align-items-center">
                    {{ str_pad($site->site_number, 3, 0, STR_PAD_LEFT) }}
                </div>
                </a>
            </td>
            <td data-label="Title" >
                {{$site->site_name}}
            </td>
            <td class="text-muted" data-label="Role" >
                {{ $site->country }}
            </td>
            <td>
                {{ $site->investigator_name }}
            </td>
            <td>
                {{ $site->investigator_email }}

            </td>
                    @can('create-study')
                        <td>
                            <div class="btn-list flex-nowrap">
                                <a href="#" wire:click.prevent="setSiteDetails({{ $site->id }},'{{$site->site_name}}','{{ $site->country }}','{{ $site->investigator_name }}','{{ $site->investigator_email }}')" data-bs-toggle="modal" data-bs-target="#modal-edit-folder" class="btn">
                                    Modify
                                </a>
                                {{--                    <div class="dropdown">--}}
                                {{--                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">--}}
                                {{--                            Actions--}}
                                {{--                        </button>--}}
                                {{--                        <div class="dropdown-menu dropdown-menu-end">--}}
                                {{--                            <a class="dropdown-item" href="#">--}}
                                {{--                                Action--}}
                                {{--                            </a>--}}
                                {{--                            <a class="dropdown-item" href="#">--}}
                                {{--                                Another action--}}
                                {{--                            </a>--}}
                                {{--                        </div>--}}
                                {{--                    </div>--}}
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

        <div class="card w-100">
        <div style="float: right" class="pt-2">
            {{ $sites->links() }}
        </div>
        </div>

        <div class="modal modal-blur fade" id="modal-team" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create a new Site</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/study/'.$study->id.'/sites') }}" method="post">
                            @csrf
                            <div class="row mb-3 align-items-end">
                                <div class="col">
                                    <label class="form-label">Site Name</label>
                                    <input name="site_name" type="text" placeholder="Site Name" class="form-control" />
                                </div>
                            </div>
                            <div class="row mb-3 align-items-end">

                                <div class="col">
                                    <label class="form-label">Country</label>
                                    <input name="country" type="text" placeholder="Country" class="form-control" />
                                </div>
                            </div>
{{--                            <div>--}}
{{--                                <label class="form-label">Indication</label>--}}
{{--                                <textarea name="indication" class="form-control"></textarea>--}}
{{--                            </div>--}}
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
                                <label class="form-label">Site Name</label>

                                <input type="text" wire:model="siteName" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3" x-show="editTextBox">
                            <div class="col-12">
                                <label class="form-label">Country</label>

                                <input type="text" wire:model="siteCountry" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3" x-show="editTextBox">
                            <div class="col-12">
                                <label class="form-label">Investigator Name</label>

                                <input type="text" wire:model="investigatorName" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3" x-show="editTextBox">
                            <div class="col-12">
                                <label class="form-label">Investigator Email</label>

                                <input type="text" wire:model="investigatorEmail" class="form-control">
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
                        <a href="#" wire:click.prevent="editSite" x-show="editTextBox" class="btn btn-success ms-auto" data-bs-dismiss="modal">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            Save
                        </a>
                        <a href="#" wire:click.prevent="deleteSite" x-show="!editTextBox" class="btn btn-danger ms-auto" data-bs-dismiss="modal">
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
