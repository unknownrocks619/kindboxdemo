@extends("layouts.app")

@section("content")
<div id="content">
    @include("inc.nav")
    <!-- Begin Page Content -->
    <div class="container-fluid">
            <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Organiser</h1>
            <a
            href="{{ route('organiser.project.create') }}"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
            ><i class="fas fa-plus fa-sm text-white-50"></i> 
            New Project
            </a
            >
        </div>

        <div class="row">
            <div class="col-md-12">
                <x-alert></x-alert>
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Projects
                        </h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Project Title</th>
                                    <th>
                                        Project Budget
                                    </th>
                                    <th>
                                        Budget Collected
                                    </th>
                                    <th>Total Gallery</th>
                                    <th>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $project->project_title }}
                                        </td>

                                        <td>
                                            AUD {{ number_format($project->total_budget,2) }}
                                        </td>
                                        <td>
                                            AUD {{  number_format($project->total_collected,2) }}
                                            @if($project->total_collected)
                                            <small>
                                                <br />
                                                [
                                                    <a href="{{ route('organiser.project_transaction',[$project->id]) }}">
                                                        view transaction
                                                    </a>    
                                                ]
                                            </small>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $project->images_count }}
                                        </td>
                                        <td>
                                            <a href="{{ route('organiser.project.edit',$project->id) }}">Edit</a>
                                             | 
                                            <a href="{{ route('organiser.list_project_images',$project->id) }}">
                                                View Gallery
                                            </a>
                                             | 
                                             <form style="display:inline" onsubmit="return confirm ('Are you sure? This action cannot be undone.')" action="{{ route('organiser.project.destroy',$project->id) }}" method="post">
                                                 @csrf
                                                 @method("DELETE")
                                                 <button type="submit" class='btn btn-link px-0 mx-0 text-danger'>Delete</button>
                                             </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection