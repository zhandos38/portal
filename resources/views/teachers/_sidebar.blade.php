<div class="col-md-3">
    <a href="{{route('teacherEnvelope')}}" class="btn btn-primary btn-block margin-bottom">Обновить</a>

    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Группы</h3>
            <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
                @foreach($groups as $group)
                    <li class="active">
                        <a href="{{route('teacherEnvelopeGetStudents', ['id' => $group->id])}}"><i class="fa fa-inbox"></i> {{$group->title}}
                            <span class="label label-primary pull-right">{{count($group->users)}}</span>
                        </a>
                    </li>
                @endforeach

                {{--                            <li><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>--}}
                {{--                            <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>--}}
                {{--                            <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a>--}}
                {{--                            </li>--}}
                {{--                            <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>--}}
            </ul>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /. box -->
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Входящее -- ({{count($incomings)}})</h3>

            <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
                @foreach($incomings as $incoming)
                <li><a href="{{route('teacherEnvelopeRed', ['id' => $incoming->id])}}"><i class="fa fa-circle-o text-red"></i> {{$incoming->users->infos->firstName}}</a></li>
                @endforeach
            </ul>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Прочитанные -- ({{count($readEnvelopes)}})</h3>

            <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
                @foreach($readEnvelopes as $readEnvelope)
                    <li><a href="{{route('teacherEnvelopeRed', ['id' => $readEnvelope->id])}}"><i class="fa fa-circle-o text-green"></i> {{$readEnvelope->users->infos->firstName}}</a></li>
                @endforeach
            </ul>
        </div>
        <!-- /.box-body -->
    </div>

    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Отправленные -- ({{count($sendEnvelopes)}})</h3>

            <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
                @foreach($sendEnvelopes as $k => $v)
                    @php $student = \App\Models\User::find($k); @endphp
                    <li><a href="{{route('teacherEnvelopeSend', ['id' => $v])}}"><i class="fa fa-circle-o text-green"></i> {{$student->infos->firstName}}</a></li>
                @endforeach
            </ul>
        </div>
        <!-- /.box-body -->
    </div>
</div>
