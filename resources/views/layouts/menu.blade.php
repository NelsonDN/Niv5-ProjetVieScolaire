<div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
               <div class="mobile-sidebar-header d-md-none">
                    <div class="header-logo">
                        <a href="index.html"><img src="{{asset('asset/img/logo1.png')}}" alt="logo"></a>
                    </div>
               </div>
                <div class="sidebar-menu-content">
                    <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                        @can('access-manager')
                        <li class="nav-item">
                            <a href="{{route('dashboard_manage.Sections.create')}}" class="nav-link"><i
                                    class="flaticon-dashboard"></i><span>@lang('Dashboard')</span></a>
                        </li>
                        @endcan
                        @can('access-manager')
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="fas fa-coins"></i><span>@lang('Sections & Cycles')</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="{{route('dashboard_manage.Sections.index')}}" class="nav-link"><i class="fas fa-angle-right"></i>@lang('Section')</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('dashboard_manage.Cycles.index')}}" class="nav-link"><i
                                            class="fas fa-angle-right"></i>@lang('Cycle')</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>@lang('Teaching')</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="{{route('dashboard_manage.teaching.index')}}" class="nav-link"><i class="fas fa-angle-right"></i>@lang('Add')</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('dashboard_manage.subject.index')}}" class="nav-link"><i
                                    class="flaticon-open-book"></i><span>@lang('Subject')</span></a>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i
                                    class="fas fa-clock"></i><span>@lang('Period')</span></a>
                            <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                    <a href="{{route('dashboard_manage.day.index')}}" class="nav-link"><i class="fas fa-angle-right"></i>@lang('Days')</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('dashboard_manage.period.index')}}" class="nav-link"><i class="fas fa-angle-right"></i>@lang('All Periods')</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('dashboard_manage.period.create')}}" class="nav-link"><i class="fas fa-angle-right"></i>@lang('Add New Period')</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('dashboard_manage.type_of_lesson.index')}}" class="nav-link"><i
                                    class="fas fa-window-restore"></i><span>@lang('Type of Lesson')</span></a>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i
                                    class="fas fa-book-reader"></i><span>@lang('Class')</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="{{route('dashboard_manage.class.index')}}" class="nav-link"><i class="fas fa-angle-right"></i>@lang('All Classes')</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('dashboard_manage.class.create')}}" class="nav-link"><i class="fas fa-angle-right"></i>@lang('Add New Class')</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i
                                    class="flaticon-multiple-users-silhouette"></i><span>@lang('Teachers')</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="{{route('dashboard_manage.teachers.index')}}" class="nav-link"><i class="fas fa-angle-right"></i>@lang('All Teachers')</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('dashboard_manage.teachers.create')}}" class="nav-link"><i class="fas fa-angle-right"></i>@lang('Add Teacher')</a>
                                </li>
                                <li class="nav-item">
                                    <a href="teacher-payment.html" class="nav-link"><i
                                            class="fas fa-angle-right"></i>@lang('Payment')</a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        @can('access-teacher')
                        <li class="nav-item">
                            <a href="{{route('dashboard_manage.teacher_Schedule.index')}}" class="nav-link"><i
                                    class="fas fa-calendar-alt"></i><span>@lang('Teachers schedule')</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('dashboard_manage.textbookTeacher.index')}}" class="nav-link"><i
                                    class="flaticon-open-book"></i><span>@lang('TextBook')</span></a>
                        </li>
                        @endcanany
                        @can('access-manager')
                        <!-- <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-classmates"></i><span>@lang('Students')</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="all-student.html" class="nav-link"><i class="fas fa-angle-right"></i>@lang('All Students')</a>
                                </li>
                                <li class="nav-item">
                                    <a href="student-details.html" class="nav-link"><i
                                            class="fas fa-angle-right"></i>@lang('Student Details')</a>
                                </li>
                                <li class="nav-item">
                                    <a href="admit-form.html" class="nav-link"><i
                                            class="fas fa-angle-right"></i>@lang('Admission Form')</a>
                                </li>
                                <li class="nav-item">
                                    <a href="student-promotion.html" class="nav-link"><i
                                            class="fas fa-angle-right"></i>@lang('Student Promotion')</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-couple"></i><span>@lang('Parents')</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="all-parents.html" class="nav-link"><i class="fas fa-angle-right"></i>@lang('All Parents')</a>
                                </li>
                                <li class="nav-item">
                                    <a href="parents-details.html" class="nav-link"><i
                                            class="fas fa-angle-right"></i>@lang('Parents Details')</a>
                                </li>
                                <li class="nav-item">
                                    <a href="add-parents.html" class="nav-link"><i class="fas fa-angle-right"></i>@lang('Add Parent')</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-books"></i><span>@lang('Library')</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="all-book.html" class="nav-link"><i class="fas fa-angle-right"></i>@lang('All Book')</a>
                                </li>
                                <li class="nav-item">
                                    <a href="add-book.html" class="nav-link"><i class="fas fa-angle-right"></i>@lang('Add New Book')</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-technological"></i><span>@lang('Account')</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="all-fees.html" class="nav-link"><i class="fas fa-angle-right"></i>@lang('All Fees Collection')</a>
                                </li>
                                <li class="nav-item">
                                    <a href="all-expense.html" class="nav-link"><i
                                            class="fas fa-angle-right"></i>@lang('Expenses')</a>
                                </li>
                                <li class="nav-item">
                                    <a href="add-expense.html" class="nav-link"><i class="fas fa-angle-right"></i>@lang('Add Expenses')</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="class-routine.html" class="nav-link"><i class="flaticon-calendar"></i><span>@lang('Class Routine')</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="student-attendence.html" class="nav-link"><i
                                    class="flaticon-checklist"></i><span>@lang('Attendence')</span></a>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-shopping-list"></i><span>@lang('Exam')</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="exam-schedule.html" class="nav-link"><i class="fas fa-angle-right"></i>@lang('Exam Schedule')</a>
                                </li>
                                <li class="nav-item">
                                    <a href="exam-grade.html" class="nav-link"><i class="fas fa-angle-right"></i>@lang('Exam Grades')</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="transport.html" class="nav-link"><i
                                    class="flaticon-bus-side-view"></i><span>@lang('Transport')</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="hostel.html" class="nav-link"><i class="flaticon-bed"></i><span>@lang('Hostel')</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="notice-board.html" class="nav-link"><i
                                    class="flaticon-script"></i><span>@lang('Notice')</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="messaging.html" class="nav-link"><i
                                    class="flaticon-chat"></i><span>@lang('Message')</span></a>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-menu-1"></i><span>@lang('UI Elements')</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="button.html" class="nav-link"><i class="fas fa-angle-right"></i>@lang('Button')</a>
                                </li>
                                <li class="nav-item">
                                    <a href="grid.html" class="nav-link"><i class="fas fa-angle-right"></i>@lang('Grid')</a>
                                </li>
                                <li class="nav-item">
                                    <a href="ui-tab.html" class="nav-link"><i class="fas fa-angle-right"></i>@lang('Tab')</a>
                                </li>
                                <li class="nav-item">
                                    <a href="progress-bar.html" class="nav-link"><i
                                            class="fas fa-angle-right"></i>@lang('Progress Bar')</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="map.html" class="nav-link"><i
                                    class="flaticon-planet-earth"></i><span>@lang('Map')</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="account-settings.html" class="nav-link"><i
                                    class="flaticon-settings"></i><span>@lang('Account')</span></a>
                        </li> -->
                        @endcan
                    </ul>
                </div>
            </div>