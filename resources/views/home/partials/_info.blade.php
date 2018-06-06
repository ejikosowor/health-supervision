<div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="icon-big icon-warning text-center">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="numbers">
                            <p><a href="{{ route('users.index') }}">Users</a></p>
                            {{ $users->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="icon-big icon-success text-center">
                            <i class="fa fa-hospital-o"></i>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="numbers">
                            <p><a href="{{ route('facilities.index') }}">Facilities</a></p>
                            {{ $facilities->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="icon-big icon-danger text-center">
                            <i class="fa fa-tasks"></i>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="numbers">
                            <p><a href="{{ route('categories.index') }}">Categories</a></p>
                            {{ $categories->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="icon-big icon-info text-center">
                            <i class="fa fa-pencil"></i>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="numbers">
                            <p><a href="{{ route('supervisions.index') }}">Supervisions</a></p>
                            {{ $supervisions->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>