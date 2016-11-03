@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-head style-primary">
            <header>
                <ol class="breadcrumb custom-breadcrumb">
                    <li class="active"><em class="glyphicon glyphicon-home"></em> Home</li>
                </ol>
            </header>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="btn btn-primary btn-flat btn-group-lg btn-block ink-reaction btn-menu" onclick="window.location.href='{!! 'events/create' !!}'">
                        <div class="btn-menu-conference"></div>
                        {{--<em class="glyphicon glyphicon-book glyphicon-menu"></em>--}}
                        <div class="btn-menu-label">Book Conference</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="btn btn-primary btn-flat btn-group-lg btn-block ink-reaction btn-menu" onclick="window.location.href='{!! 'events' !!}'">
                        <div class="btn-menu-events"></div>
                        <div class="btn-menu-label">Event List</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="btn btn-primary btn-flat btn-group-lg btn-block ink-reaction btn-menu" onclick="window.location.href='{!! 'calendar' !!}'">
                        <div class="btn-menu-calendar"></div>
                        <div class="btn-menu-label">Calendar</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="btn btn-primary btn-flat btn-group-lg btn-block ink-reaction btn-menu" onclick="window.location.href='{!! 'contacts' !!}'">
                        <div class="btn-menu-contacts"></div>
                        <div class="btn-menu-label">Contacts</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="btn btn-primary btn-flat btn-group-lg btn-block ink-reaction btn-menu" onclick="window.location.href='{!! 'settings' !!}'">
                        <div class="btn-menu-settings"></div>
                        <div class="btn-menu-label">Settings</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="btn btn-primary btn-flat btn-group-lg btn-block ink-reaction btn-menu" onclick="window.location.href='{!! 'contactUs' !!}'">
                        <div class="btn-menu-contact_us"></div>
                        <div class="btn-menu-label">Contact Us</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="btn btn-primary btn-flat btn-group-lg btn-block ink-reaction btn-menu" onclick="window.location.href='{!! 'logout' !!}'">
                        <div class="btn-menu-logout"></div>
                        <div class="btn-menu-label">Logout</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
