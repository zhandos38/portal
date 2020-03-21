<div class="table-responsive">
    <table class="table" id="examSchedules-table">
        <thead>
        <tr>
            <th>Семестр</th>
            <th>Дисциплина</th>
            <th>Действие</th>

        </tr>
        </thead>
        <tbody>
        @foreach($exams as $exam)
            <tr>
            <td>{{ $exam->semester->title }}</td>
            <td>{{ $exam->subject->title }}</td>
                <td><a class="btn btn-info" onclick="return confirm('Сдавая тест, вы не сможете его пересдать, результаты попадут в рейтинг! Вы уверены что хотите пройти тест?')" href = "{{route("student.exampass",["id"=>$exam->quiz->id,"examId"=>$exam->id])}}">Пройти</a> </td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
