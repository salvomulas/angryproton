<div class="list-group">
    <a href="{{ action('UserController@index') }}" class="list-group-item {{ Request::is('dashboard') ? 'active' : '' }}"><i class="fa fa-info fa-fw"></i>&nbsp; Berechtigungen</a>
    <a href="{{ action('CourseController@coursesUser',[Auth::user()->id ]) }}" class="list-group-item"><i class="fa fa-shopping-basket fa-fw"></i>&nbsp; Meine Anmeldungen</a>
    @can('manage_courses')
        <a href="{{ action('CourseController@coursesTeacher',[Auth::user()->id ]) }}" class="list-group-item"><i class="fa fa-graduation-cap"></i>&nbsp; Eigene Kurse</a>
    @endcan
    @can('manage_institutions')
    <a href="{{ action('InstitutionController@myInstitutions', Auth::user()->id) }}" class="list-group-item"><i
                class="fa fa-institution fa-fw"></i>&nbsp; Meine
        Institutionen</a>
    @endcan
    <a href="{{action('UserController@billsUser',[Auth::user()->id ])}}" class="list-group-item {{ Request::is('user/'.Auth::user()->id.'/bills') ? 'active' : '' }}"><i class="fa fa-money fa-fw"></i>&nbsp; Rechnungen</a>
    <!--  <a href="#" class="list-group-item"><i class="fa fa-wrench fa-fw"></i>&nbsp; Einstellungen</a> -->
</div>