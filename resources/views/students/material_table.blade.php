<div class="table-responsive">
    <table class="table" id="materials-table">
        <thead>
        <tr>
            <th>Семестр</th>
            <th>Группа</th>
            <th>Преподаватель</th>
            <th>Дисциплина</th>
            <th>Файл</th>
            <th>Наименование</th>
            <th>Описание</th>

        </tr>
        </thead>
        <tbody>
        @foreach($materials as $material)
            <tr>
                <td>{{ $material->semester->title }}</td>
                <td>{{ $material->group->title }}</td>
                <td>{{ $material->teacher->infos->firstName }} {{ $material->teacher->infos->lastName }} {{ $material->teacher->infos->middleName }}</td>
                <td>{{ $material->subject->title }}</td>
                <td><a href="{{ route('libraries.download', [$material->library->id]) }}" class='btn btn-default btn-xs' download><i class="fa fa-cloud-download"></i></a></td>
                <td>{{ $material->title }}</td>
                <td>{{ $material->description }}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
