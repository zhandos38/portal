<li class="{{ Request::is('home*') ? 'active' : '' }} ">
    <a href="{{ route('home') }}"><i class="fa fa-home"></i><span>Главная</span></a>
</li>
@administrator
<ul class="sidebar-menu tree">
    <li class="treeview">
        <a href="#"><i class="fa fa-mortar-board"></i> <span>Учебный процесс</span>
            <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
        </a>
        <ul class="treeview-menu">
            <li class="treeview">
                <a href="#"><i class="fa fa-users"></i><span>Пользователи</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('users*') ? 'active' : '' }} ">
                        <a href="{{ route('users.index') }}"><i class="fa fa-users"></i><span>Все Пользователи</span></a>
                    </li>
                    @superadmin
                    <li class="{{ Request::is('superAdmins') ? 'active' : '' }} ">
                        <a href="{{ route('users.superAdmin') }}"><i class="fa fa-users"></i><span>Суперадмины</span></a>
                    </li>
                    <li class="{{ Request::is('administrators') ? 'active' : '' }} ">
                        <a href="{{ route('users.administrator') }}"><i class="fa fa-users"></i><span>Администраторы</span></a>
                    </li>
                    @endsuperadmin
                    <li class="{{ Request::is('moderators') ? 'active' : '' }} ">
                        <a href="{{ route('users.moderator') }}"><i class="fa fa-users"></i><span>Модераторы</span></a>
                    </li>
                    <li class="{{ Request::is('teachers') ? 'active' : '' }} ">
                        <a href="{{ route('users.teacher') }}"><i class="fa fa-users"></i><span>Преподаватели</span></a>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-users"></i><span>Студенты</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Request::is('students') ? 'active' : '' }} ">
                                <a href="{{ route('users.students') }}"><i class="fa fa-users"></i><span>Все Студенты</span></a>
                            </li>
                            <li class="{{ Request::is('active-students') ? 'active' : '' }} ">
                                <a href="{{ route('users.active') }}"><i class="fa fa-user-plus"></i><span>Активные студенты</span></a>
                            </li>
                            <li class="{{ Request::is('expelled') ? 'active' : '' }} ">
                                <a href="{{ route('users.expelled') }}"><i class="fa fa-user-times"></i><span>Отчисленные студенты</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            @superadmin
            <li class="{{ Request::is('faculties*') ? 'active' : '' }} ">
                <a href="{{ route('faculties.index') }}"><i class="fa fa-building"></i><span>Факультеты</span></a>
            </li>
            @endsuperadmin
            <li class="{{ Request::is('departments*') ? 'active' : '' }}">
                <a href="{{ route('departments.index') }}"><i class="fa fa-institution"></i><span>Кафедры</span></a>
            </li>
            <li class="{{ Request::is('groups*') ? 'active' : '' }}">
                <a href="{{ route('groups.index') }}"><i class="fa fa-sitemap"></i><span>Группы</span></a>
            </li>
            <li class="{{ Request::is('languages*') ? 'active' : '' }}">
                <a href="{{ route('languages.index') }}"><i class="fa fa-language"></i><span>Языки обучения</span></a>
            </li>
            @superadmin
            <li class="{{ Request::is('lessonTypes*') ? 'active' : '' }}">
                <a href="{{ route('lessonTypes.index') }}"><i class="fa fa-font"></i><span>Тип занятия</span></a>
            </li>
            <li class="{{ Request::is('nationalities*') ? 'active' : '' }}">
                <a href="{{ route('nationalities.index') }}"><i class="fa fa-flag"></i><span>Национальность</span></a>
            </li>

            <li class="{{ Request::is('countries*') ? 'active' : '' }}">
                <a href="{{ route('countries.index') }}"><i class="fa fa-globe"></i><span>Страны</span></a>
            </li>
            @endsuperadmin
            <li class="{{ Request::is('subjects*') ? 'active' : '' }}">
                <a href="{{ route('subjects.index') }}"><i class="fa fa-book"></i><span>Дициплины</span></a>
            </li>
            <li class="{{ Request::is('subjectLists*') ? 'active' : '' }}">
                <a href="{{ route('subjectLists.index') }}"><i class="fa  fa-map"></i><span>Списки занятий</span></a>
            </li>
        </ul>
    </li>
</ul>
<li class="{{ Request::is('print') ? 'active' : '' }}">
    <a href="{{ route('print') }}"><i class="fa fa-print"></i><span>Распечатка</span></a>
</li>
@endadministrator
@moderator
<ul class="sidebar-menu tree">
    <li class="treeview">
        <a href="#"><i class="fa fa-hourglass-start"></i> <span>Учебное время</span>
            <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
        </a>
        <ul class="treeview-menu">
            @superadmin
            <li class="{{ Request::is('years*') ? 'active' : '' }}">
                <a href="{{ route('years.index') }}"><i class="fa fa-clock-o"></i><span>Уч.годы</span></a>
            </li>

            <li class="{{ Request::is('semesters*') ? 'active' : '' }}">
                <a href="{{ route('semesters.index') }}"><i class="fa fa-database"></i><span>Семестры</span></a>
            </li>
            @endsuperadmin

            <li class="{{ Request::is('shedules*') ? 'active' : '' }}">
                <a href="{{ route('shedules.index') }}"><i class="fa fa-calendar"></i><span>Расписание</span></a>
            </li>

            <li class="{{ Request::is('examSchedules*') ? 'active' : '' }}">
                <a href="{{ route('examSchedules.index') }}"><i class="fa fa-calendar-check-o"></i><span>Расписание экзаменов</span></a>
            </li>
            @administrator
            <li class="{{ Request::is('active-schedules') ? 'active' : '' }}">
                <a href="{{ route('examSchedules.active') }}"><i class="fa fa-calendar-plus-o"></i><span>Активные экзамены</span></a>
            </li>

            <li class="{{ Request::is('disactive-schedules') ? 'active' : '' }}">
                <a href="{{ route('examSchedules.disactive') }}"><i class="fa fa-calendar-times-o"></i><span>Не активные экзамены</span></a>
            </li>

            @endadministrator
        </ul>
    </li>
</ul>

<ul class="sidebar-menu tree">
    <li class="treeview">
        <a href="#"><i class="fa fa-check-square-o"></i> <span>Тестирование</span>
            <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ Request::is('quizzes*') ? 'active' : '' }}">
                <a href="{{ route('quizzes.index') }}"><i class="fa fa-folder-o"></i><span>База тестов</span></a>
            </li>

            <li class="{{ Request::is('questions*') ? 'active' : '' }}">
                <a href="{{ route('questions.index') }}"><i class="fa fa-cloud"></i><span>База вопросов</span></a>
            </li>
        </ul>
    </li>
</ul>

@endmoderator

@teacher
    @onlyTeacher
        <li class="{{ Request::is('teacher-info') ? 'active' : '' }}">
            <a href="{{ route('teacherInfo') }}"><i class="fa fa-info"></i><span>Личные данные</span></a>
        </li>
        <li class="{{ Request::is('teacher-schedule') ? 'active' : '' }}">
            <a href="{{ route('teacher.schedule') }}"><i class="fa fa-calendar"></i><span>Расписание</span></a>
        </li>
        <li class="{{ Request::is('teacher-examschedule') ? 'active' : '' }}">
            <a href="{{ route('teacher.examschedule') }}"><i class="fa fa-calendar-check-o"></i><span>Расписание экзаменов</span></a>
        </li>
        <li class="{{ Request::is('materials*') ? 'active' : '' }}">
            <a href="{{ route('materials.index') }}"><i class="fa fa-edit"></i><span>УМКД</span></a>
        </li>
        <li class="{{ Request::is('teacher-envelope') ? 'active' : '' }}">
            <a href="{{ route('teacherEnvelope') }}"><i class="fa fa-envelope"></i><span>Рассылка</span></a>
        </li>
    @endonlyTeacher
        <li class="{{ Request::is('libraries*') ? 'active' : '' }}">
            <a href="{{ route('libraries.index') }}"><i class="fa fa-database"></i><span>Библиотека</span></a>
        </li>
        <li class="{{ Request::is('assignments*') ? 'active' : '' }}">
            <a href="{{ route('assignments.index') }}"><i class="fa fa-signal"></i><span>Рейтинг</span></a>
        </li>
@endteacher


@student
<li class="{{ Request::is('student-info') ? 'active' : '' }}">
    <a href="{{ route('studentInfo') }}"><i class="fa fa-info"></i><span>Личные данные</span></a>
</li>
<li class="{{ Request::is('student-subject') ? 'active' : '' }}">
    <a href="{{ route('student.subject') }}"><i class="fa fa-briefcase"></i><span>Списки занятий</span></a>
</li>
<li class="{{ Request::is('student-assignment') ? 'active' : '' }}">
    <a href="{{ route('student.assignment') }}"><i class="fa fa-mortar-board"></i><span>Успеваемость</span></a>
</li>
<li class="{{ Request::is('student-schedule') ? 'active' : '' }}">
    <a href="{{ route('student.schedule') }}"><i class="fa fa-calendar"></i><span>Расписание семестра</span></a>
</li>
<li class="{{ Request::is('student-examschedule') ? 'active' : '' }}">
    <a href="{{ route('student.examschedule') }}"><i class="fa fa-calendar-check-o"></i><span>Расписание экзаменов</span></a>
</li>
<li class="{{ Request::is('student-current-assignment') ? 'active' : '' }}">
    <a href="{{ route('student.current-assignment') }}"><i class="fa fa-signal"></i><span>Рейтинг</span></a>
</li>
<li class="{{ Request::is('student-material') ? 'active' : '' }}">
    <a href="{{ route('student.material') }}"><i class="fa fa-book"></i><span>УМКД</span></a>
</li>
<li class="{{ Request::is('student-envelope') ? 'active' : '' }}">
    <a href="{{ route('studentEnvelope') }}"><i class="fa fa-envelope"></i><span>Рассылка</span></a>
</li>

<li class="{{ Request::is('student-exam') ? 'active' : '' }}">
    <a href="{{ route('student.exam') }}"><i class="fa fa-check-square-o"></i><span>Тестирование</span></a>
</li>
@endstudent









<li class="{{ Request::is('forums') ? 'active' : '' }}">
    <a href="{{ route('chatter.home') }}"><i class="fa fa-wechat"></i><span>Форум</span></a>
</li>
@administrator

<li class="treeview">
    <a href="#"><i class="fa fa-search"></i><span>Поиск</span>
        <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
    </a>

    <ul class="treeview-menu">
        <li class="{{ Request::is('search') ? 'active' : '' }}">
            <a href="{{ route('search') }}"><i class="fa fa-search"></i><span>Поиск</span></a>
        </li>
        <li class="{{ Request::is('search-schedule') ? 'active' : '' }}">
            <a href="{{ route('search.schedule') }}"><i class="fa fa-search"></i><span>Поиск по расписанию</span></a>
        </li>

    </ul>
</li>

@endadministrator
<li>
    <a href="{{ route('logout') }}"><i class="fa fa-power-off"></i><span>Выход</span></a>
</li>




