<div class="list-group">
    <a href="#" class="list-group-item active"><i class="fa fa-info fa-fw"></i>&nbsp; Berechtigungen</a>
    <a href="{{ action('CourseController@coursesUser',[Auth::user()->id ]) }}" class="list-group-item"><i class="fa fa-shopping-basket fa-fw"></i>&nbsp; Meine Anmeldungen</a>
    @can('manage_courses')
        <a href="{{ action('CourseController@coursesTeacher',[Auth::user()->id ]) }}" class="list-group-item"><i class="fa fa-graduation-cap"></i>&nbsp; Eigene Kurse</a>
    @endcan
    <a href="{{action('UserController@billsUser',[Auth::user()->id ])}}" class="list-group-item"><i class="fa fa-money fa-fw"></i>&nbsp; Rechnungen</a>
    <!--  <a href="#" class="list-group-item"><i class="fa fa-wrench fa-fw"></i>&nbsp; Einstellungen</a> -->
</div>