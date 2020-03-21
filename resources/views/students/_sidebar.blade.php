<div class="col-md-3">
    <a href="{{route('studentEnvelope')}}" class="btn btn-primary btn-block margin-bottom">Обновить</a>

    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Преподы</h3>
            <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
                @foreach($teachers as $teacher)
                    <li class="active">
                        <a href="{{route('studentEnvelopeGetTeachers', ['id' => $teacher->id])}}"><i class="fa fa-inbox"></i> {{$teacher->infos->firstName}} {{$teacher->infos->lastName}}</a>
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
                <li><a href="{{route('studentEnvelopeRed', ['id' => $incoming->id])}}"><i class="fa fa-circle-o text-red"></i> {{$incoming->teachers->infos->firstName}}</a></li>
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
                    <li><a href="{{route('studentEnvelopeRed', ['id' => $readEnvelope->id])}}"><i class="fa fa-circle-o text-green"></i> {{$readEnvelope->teachers->infos->firstName}}</a></li>
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
                    <li><a href="{{route('studentEnvelopeSend', ['id' => $v])}}"><i class="fa fa-circle-o text-green"></i> {{$student->infos->firstName}}</a></li>
                @endforeach
            </ul>
        </div>
        <!-- /.box-body -->
    </div>
</div>
