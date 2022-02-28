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
            href="{{ route('organiser.organiser.create') }}"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
            ><i class="fas fa-plus fa-sm text-white-50"></i> 
            New Organiser
            </a
            >
        </div>

        <div class="row">
            <div class="col-md-12">
                <x-alert></x-alert>
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                        Organisers
                        </h6>
                    </div>
                    <div class="card-body">
                        <table class="table bordered table-heading table-hover">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>
                                        Total project
                                    </th>
                                    <th>
                                        Location
                                    </th>
                                    <th>Website</th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($organisers as $organiser)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $organiser->name }}
                                            <br />
                                            <small>[Add Project]</small>
                                        </td>
                                        <td>
                                            {{ $organiser->projects_count }}
                                        </td>
                                        <td>
                                            {{ $organiser->country }}
                                        </td>
                                        <td>
                                            <a href='{{$organiser->website}}' target='_blank'>
                                                Vist Site
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('organiser.organiser.edit',[$organiser->id]) }}" class="text-info">
                                            Edit </a>
                                            | 
                                            <form style="display:inline" action="{{ route('organiser.organiser.destroy',[$organiser->id]) }}" onsubmit="return confirm('Are your sure? this action cannot be undone.')" method="post">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit" class='text-danger btn btn-link px-0 mx-0'>Delete</button>
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